<?php

namespace App\Http\Controllers;

use App\Models\archive;
use App\Models\dossier;
use App\Models\Liste;
use App\Models\partie;
use Illuminate\Http\Request;

class DossierController extends Controller
{
    /** 
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Dossier::query();

        // Filter by num, code, annee if filled
        if ($request->filled('num')) {
            $query->where('num', 'like', '%' . $request->num . '%');
        }

        if ($request->filled('code')) {
            $query->where('code', 'like', '%' . $request->code . '%');
        }

        if ($request->filled('annee')) {
            $query->where('annee', 'like', '%' . $request->annee . '%');
        }

        // Sort
        if ($request->filled('sort')) {
            switch ($request->sort) {
                case 'num_asc':
                    $query->orderBy('num', 'asc');
                    break;
                case 'num_desc':
                    $query->orderBy('num', 'desc');
                    break;
                case 'code_asc':
                    $query->orderBy('code', 'asc');
                    break;
                case 'code_desc':
                    $query->orderBy('code', 'desc');
                    break;
                case 'annee_asc':
                    $query->orderBy('annee', 'asc');
                    break;
                case 'annee_desc':
                    $query->orderBy('annee', 'desc');
                    break;
                case 'date_asc':
                    $query->orderBy('date_archivage', 'asc');
                    break;
                case 'date_desc':
                    $query->orderBy('date_archivage', 'desc');
                    break;
            }
        }

        $dossiers = $query->paginate(10)->withQueryString();

        return view('dossiers.index', compact('dossiers'));
    }


    

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $listes = Liste::all();
        return view('dossiers.create', compact('listes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'num' => 'required|integer',
            'code' => 'required|integer',
            'annee' => 'required|string|max:4',
            'parties' => 'required|array',
            'parties.*.full_name' => 'required|string|max:255',
            'parties.*.type' => 'required|in:متهم,ضحية',
        ]);
    
        // Check if a dossier with the same num, code, and annee already exists
        $existing = Dossier::where('num', $request->num)
            ->where('code', $request->code)
            ->where('annee', $request->annee)
            ->first();
    
        if ($existing) {
            return redirect()->back()
                ->withInput()
                ->withErrors(['duplicate' => 'هذا الملف موجود بالفعل بنفس الرقم، القضية، والسنة.']);
        }
    
        // Store the dossier
        $dossier = Dossier::create([
            'num' => $request->num,
            'code' => $request->code,
            'annee' => $request->annee,
        ]);
    
        // Attach parties
        foreach ($request->parties as $partyData) {
            $partie = Partie::create($partyData);
            $dossier->parties()->attach($partie->id);
        }
    
        return redirect()->route('dossiers.index')->with('success', 'تم إضافة الملف بنجاح');
    }
    

    /**
     * Display the specified resource.
     */
    public function show(Dossier $dossier)
    {
        $dossier->load(['liste', 'parties']);
        return view('dossiers.show', compact('dossier'));
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Dossier $dossier)
    {
        $listes = Liste::all();
        $dossier->load('parties'); // load related parties
        return view('dossiers.edit', compact('dossier', 'listes'));

        
    }
    public function update(Request $request, Dossier $dossier)
    {
        $validated = $request->validate([
            'code' => 'required|digits:4',
            'annee' => 'required|string',
            'parties' => 'array',
            'parties.*.id' => 'required|exists:parties,id',
            'parties.*.full_name' => 'required|string',
            'parties.*.type' => 'required|in:متهم,ضحية',
        ]);
    
        // Update Dossier details
        $dossier->update([
            // 'liste_id' => $validated['liste_id'],
            'code' => $validated['code'],
            'annee' => $validated['annee'],
            // 'date_archivage' => $validated['date_archivage'],
        ]);
    
        // Sync parties
        $partyIds = [];

        foreach ($validated['parties'] as $item) {
            $party = \App\Models\Partie::find($item['id']);
            if ($party) {
                $party->update([
                    'full_name' => $item['full_name'],
                    'type' => $item['type'],
                ]);
                $partyIds[] = $party->id;
            }
        }

        $dossier->parties()->sync($partyIds);
        
    
        return redirect()->route('dossiers.index', request()->only(['num', 'code', 'annee']))
    ->with('success', 'تم تحديث الملف بنجاح.');

    }
    
    
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(dossier $dossier)
    {

        $dossier->delete();
        return redirect()->route('dossiers.index')
            ->with('success', 'Dossier deleted successfully.');
    }
}
