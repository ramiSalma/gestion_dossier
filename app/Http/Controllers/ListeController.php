<?php

namespace App\Http\Controllers;

use App\Models\dossier;
use App\Models\Liste;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class ListeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $listes = Liste::with('dossier')->paginate(9); 
        return view('listes.index', compact('listes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Redirect to index page since we're using a modal now
        return redirect()->route('listes.index');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'date_creation' => 'nullable|date',
            'title' => 'nullable|string|max:255',
        ]);

        $liste = new Liste([
            'date_creation' => $request->date_creation ?? now(),
            'date_envoi' => null,
            'title' => $request->title,
        ]);

        $liste->save();

        return redirect()->route('listes.index')->with('success', 'تمت إضافة البطاقة بنجاح');
    }


    public function addFile(Request $request, $id)
    {
        $liste = Liste::findOrFail($id);

        $query = dossier::query()->where('liste_id', null);

        if ($request->filled('num')) {
            $query->where('num', 'like', '%' . $request->num . '%');
        }

        if ($request->filled('code')) {
            $query->where('code', 'like', '%' . $request->code . '%');
        }

        if ($request->filled('annee')) {
            $query->where('annee', 'like', '%' . $request->annee . '%');
        }

        $dossiers = $query->get();

        return view('listes.addfile', compact('liste', 'dossiers'));
    }

    public function storeFile(Request $request, $id)
    {
        $request->validate([
            'dossiers' => 'required|array',
            'dossiers.*' => 'exists:dossiers,id',
        ]);
    
        $liste = Liste::findOrFail($id);
    
        // Only attach dossiers to liste, without setting date_envoi
        Dossier::whereIn('id', $request->dossiers)->update([
            'liste_id' => $liste->id,
            'date_archivage' => null, // Optional: or leave as is
        ]);
    
        return redirect()->route('listes.show', $liste->id)->with('success', 'تم إضافة الملفات بنجاح');
    }
    

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        // Find the liste with eager loading of dossier relationship and related data
        $liste = Liste::with(['dossier', 'dossier.parties'])->findOrFail($id);
        
        // Get search and sort parameters
        $search = request()->query('search');
        $sort = request()->query('sort', 'id');
        $direction = request()->query('direction', 'asc');
        
        // Base query for dossiers
        $dossierQuery = $liste->dossier();
        
        // Apply search if provided (search across multiple columns)
        if ($search) {
            $dossierQuery->where(function($query) use ($search) {
                $query->where('num', 'like', "%{$search}%")
                      ->orWhere('code', 'like', "%{$search}%")
                      ->orWhere('annee', 'like', "%{$search}%");
            });
        }
        
        // Apply specific filters if provided
        if (request()->filled('num')) {
            $dossierQuery->where('num', 'like', '%' . request()->num . '%');
        }
        
        if (request()->filled('code')) {
            $dossierQuery->where('code', 'like', '%' . request()->code . '%');
        }
        
        if (request()->filled('annee')) {
            $dossierQuery->where('annee', 'like', '%' . request()->annee . '%');
        }
        
        if (request()->filled('archived')) {
            if (request()->archived === 'yes') {
                $dossierQuery->whereNotNull('date_archivage');
            } elseif (request()->archived === 'no') {
                $dossierQuery->whereNull('date_archivage');
            }
        }
        
        // Apply sorting - handle different sort formats
        if (in_array($sort, ['num', 'code', 'annee', 'date_archivage', 'id'])) {
            $dossierQuery->orderBy($sort, $direction);
        } elseif ($sort === 'num_asc') {
            $dossierQuery->orderBy('num', 'asc');
        } elseif ($sort === 'num_desc') {
            $dossierQuery->orderBy('num', 'desc');
        } elseif ($sort === 'code_asc') {
            $dossierQuery->orderBy('code', 'asc');
        } elseif ($sort === 'code_desc') {
            $dossierQuery->orderBy('code', 'desc');
        } elseif ($sort === 'annee_asc') {
            $dossierQuery->orderBy('annee', 'asc');
        } elseif ($sort === 'annee_desc') {
            $dossierQuery->orderBy('annee', 'desc');
        } elseif ($sort === 'date_asc') {
            $dossierQuery->orderBy('date_archivage', 'asc');
        } elseif ($sort === 'date_desc') {
            $dossierQuery->orderBy('date_archivage', 'desc');
        }
        
        // Get paginated results with query string preserved
        $dossiers = $dossierQuery->paginate(10)->withQueryString();
        
        // Get summary statistics
        $stats = [
            'total' => $liste->dossier()->count(),
            'archived' => $liste->dossier()->whereNotNull('date_archivage')->count(),
            'not_archived' => $liste->dossier()->whereNull('date_archivage')->count(),
        ];
        
        return view('listes.show', compact('liste', 'dossiers', 'search', 'sort', 'direction', 'stats'));
    }

    public function send($id)
    {
        $liste = Liste::findOrFail($id);
    
        if ($liste->date_envoi) {
            return redirect()->route('listes.index')->with('error', 'البطاقة قد تم إرسالها بالفعل');
        }
    
        $liste->date_envoi = now();
        $liste->save();
    
        // Archive all dossiers
        $liste->dossier()->update(['date_archivage' => now()]);
    
        return redirect()->route('listes.index')->with('success', 'تم إرسال البطاقة بنجاح');
    }
    
    public function print($id)
    {
        $liste = Liste::findOrFail($id);
        $dossiers = $liste->dossier; // assuming relation name is dossier

        $pdf = Pdf::loadView('listes.pdf', compact('liste', 'dossiers'));
        return $pdf->download("Liste_{$liste->id}.pdf");
    }
    

    public function removeDossier($listeId, $dossierId)
    {
        // First verify that both the liste and dossier exist and are related
        $liste = Liste::findOrFail($listeId);
        $dossier = Dossier::where('id', $dossierId)
                         ->where('liste_id', $listeId)
                         ->firstOrFail();
        
        // Check if the liste has been sent already - prevent modification if sent
        if ($liste->date_envoi) {
            return redirect()->back()->with('error', 'لا يمكن تعديل القائمة بعد إرسالها.');
        }
        
        // Remove the dossier from the liste by setting liste_id to null
        $dossier->liste_id = null;
        $dossier->save();
        
        return redirect()->back()->with('success', 'تم إزالة الملف من القائمة بنجاح.');
    }
    /**
     * Show the form for editing the specified resource.
     */
   
}




