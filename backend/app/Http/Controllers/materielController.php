<?php

namespace App\Http\Controllers;

use App\Http\Requests\saveMateriel;
use App\Models\etat_mate;
use App\Models\materiels;
use App\Models\regions;
use App\Models\shops;
use App\Models\type_materiels;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class materielController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function enregistrerMateriel(saveMateriel $request)
    {
        $user = $request->user();
        if (!$user) {
            return response()->json([
                'message' => 'Aucun utilisateur connecté'
            ], 401);
        }

        $photoPath = null;

        // Vérifiez si une photo a été téléchargée
        if ($request->hasFile('photo')) {
            // Traitez la photo
            $photoName = 'materiel_' . $user->id . '_' . time() . '.' . $request->photo->extension();

            // Stockage de la photo dans public/materiels/photos
            $photoPath = $request->photo->move(base_path('materiels/photos'), $photoName);

            // Vérifiez si la photo a été correctement enregistrée
            if (!$photoPath) {
                return response()->json([
                    'message' => 'Erreur lors de l\'enregistrement de la photo.'
                ], 422);
            }
        } else {
            Log::info('Aucune photo reçue pour le matériel.');
        }

        // Enregistrement du matériel dans la base de données
        $soumission_materiel = materiels::create([
            'user_id' => $user->id,
            'marque' => $request->marque,
            'modele' => $request->modele,
            'numero_serie' => $request->numero_serie,
            'etat' => $request->etat,
            'observation' => $request->observation,
            'type_mat_id' => $request->type_mat_id,
            'region_id' => $request->region_id,
            'shop_id' => $request->shop_id,
            'photo' => 'materiels/photos/' . $photoName // Stockez le chemin relatif
        ]);

        return response()->json([
            'message' => 'Matériel enregistré avec succès',
            'data' => $soumission_materiel
        ], 201);
    }

    public function listeMateriel(Request $request){
        $user =$request->user();
        if (!$user) {
            return response()->json([
                'message' => 'Aucun utilisateur connecté'
            ], 401);
        }

        //$token = $request->bearerToken();
        $liste_materiels = materiels::where('user_id' , $user->id)->orderBy('created_at', 'desc')->get();
        return response()->json([
            'message' => 'Liste des materiels de l\'agent connecté',
            'data' => $liste_materiels
        ], 200);

    }

    public function combotype(Request $request){
         $user =$request->user();
        if (!$user) {
            return response()->json([
                'message' => 'Aucun utilisateur connecté'
            ], 401);
        }
        $combotype = type_materiels::orderBy('id', 'asc')->get();
        return response()->json([
            'message' => 'Le combo du type de materiel',
            'data' => $combotype
        ], 200);
    }
    public function comboregion(Request $request){
         $user =$request->user();
        if (!$user) {
            return response()->json([
                'message' => 'Aucun utilisateur connecté'
            ], 401);
        }
        $comboregion = regions::orderBy('id', 'asc')->get();
        return response()->json([
            'message' => 'Le combo du type de materiel',
            'data' => $comboregion
        ], 200);
    }
    public function comboshop(Request $request){
         $user =$request->user();
        if (!$user) {
            return response()->json([
                'message' => 'Aucun utilisateur connecté'
            ], 401);
        }
        $comboshop = shops::orderBy('id', 'asc')->get();
        return response()->json([
            'message' => 'Le combo du type de materiel',
            'data' => $comboshop
        ], 200);
    }
    public function comboetat(Request $request){
         $user =$request->user();
        if (!$user) {
            return response()->json([
                'message' => 'Aucun utilisateur connecté'
            ], 401);
        }
        $comboetat = etat_mate::orderBy('id', 'asc')->get();
        return response()->json([
            'message' => 'Le combo du type de materiel',
            'data' => $comboetat
        ], 200);
    }

    //********************** PARTIE WEB ****************************/
    public function liste_materiels(){
        $liste_materiels = materiels::with('Regions','Shops')->paginate(10);
        return view('liste-materiels', compact('liste_materiels'));
    }

    public function liste_utilisateurs(){
        $liste_users = User::with('Roles')->paginate(10);
        return view('liste-utilisateur', compact('liste_users'));
    }

    public function liste_regions(){
        $liste_regions = regions::orderBy('id', 'desc')->paginate(10);
        return view('liste-regions', compact('liste_regions'));
    }

    public function liste_shops(){
        $liste_shops = shops::orderBy('id', 'desc')->paginate(10);
        return view('liste-shops', compact('liste_shops'));
    }

    public function type_materiels(){
        $liste_type_mate = type_materiels::orderBy('id', 'desc')->paginate(10);
        return view('liste-type-materiel', compact('liste_type_mate'));
    }

    public function rapport(){
        return view('rapport');
    }

    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
