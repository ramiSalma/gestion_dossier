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
        return view('listes.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'date_creation' => 'nullable|date',
        ]);

        $liste = new Liste([
            'date_creation' => $request->date_creation ?? now(),
            'date_envoi' => null,
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
        $liste = Liste::with('dossier')->findOrFail($id);
        $dossiers = $liste->dossier()->paginate(10);

        return view('listes.show', compact('liste', 'dossiers'));
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
        $dossier = Dossier::where('id', $dossierId)->where('liste_id', $listeId)->firstOrFail();
    
        // Unlink the dossier by nullifying the liste_id
        $dossier->update(['liste_id' => null]);
    
        return redirect()->back()->with('success', 'تمت إزالة الملف من القائمة بنجاح.');
    }
    /**
     * Show the form for editing the specified resource.
     */
   
}
