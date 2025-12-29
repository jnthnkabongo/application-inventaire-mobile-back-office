<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthSave;
use App\Models\materiels;
use App\Models\regions;
use App\Models\shops;
use App\Models\type_materiels;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class indexController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function apiConnexion(AuthSave $request){
       $user = User::where('email', $request->email)->first();
       if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json(['message' => 'Les informations sont invalides'], 401);
       }
       $token = $user->createToken('token')->plainTextToken;

       return response()->json([
        'message' => 'Connexion reussie',
        'token' => $token,
        'user' => [
            'id' =>$user->id,
            'name' => $user->name,
            'email' => $user->email,
            'role_id' => $user->role_id
        ]
    ], 200);
    }

    public function getUser(Request $request){
        $user = $request->user();
        if (!$user) {
            return response()->json([
                'message' => 'Aucun utilisateur connecté'
            ], 401);
        }

        $token = $request->bearerToken();

        if ($user) {
            return response()->json([
                'message' => 'Utilisateur connecté',
                'user' => [
                    'id' => $user->id,
                    'name' => $user->name,
                    'email' => $user->email,
                    'role_id' => $user->role_id
                ],
                'token' => $token
            ], 200);
        }else {
            return response()->json([
                'message' => 'Aucun utilisateur connecté'
            ], 401);

        }
    }
    public function logout(Request $request){
        $request->user()->currentAccesstoken()->delete();

        return response()->json([
            'message' => 'Token supprimé session API terminée'
        ]);
    }

    //**************************  PARTIE WEB ******************************/
    public function index()
    {
         // // Créez un utilisateur uniquement si nécessaire
        // if (!User::where('email', 'j.kabondo@bboxx.com')->exists()) {
        //     User::create([
        //         'name' => 'Jonathan Kabongo Ngoy',
        //         'email' => 'j.kabondo@bboxx.com',
        //         'password' => Hash::make('12345'),
        //         'role_id' => 1
        //     ]);
        // }
        return view('login');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(AuthSave $request)
    {
        $credentials = $request->validated();

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()
                ->intended(route('administration'))
                ->with('message', 'Bienvenue dans l\'application d\'inventaire');
        }

        return redirect()
            ->back()
            ->withErrors([
                'email' => 'Les informations saisies ne sont pas correctes',
            ])
            ->onlyInput('email');
    }

    public function administration(){
        $typesMateriel = type_materiels::orderBy('id','desc')->get();
        $regions = regions::orderBy('id', 'desc')->get();
        $shops = shops::orderBy('id','desc')->get();
        $users = User::orderBy('id','desc')->get();
        $sommes_users = User::count();
        $sommes_materiels = materiels::count();
        $sommes_regions = regions::count();
        $sommes_shop = shops::count();
        $liste_materiels_incedents = materiels::where('etat', '4')->count();
        $liste_materiels = materiels::with('User','Type_materiel')->paginate(10);
        return view('index', compact('liste_materiels','typesMateriel','regions','shops',
        'users','sommes_users','sommes_materiels','sommes_regions','sommes_shop','liste_materiels_incedents'));
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
    public function destroy(Request $request)
    {
         Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('');
    }
}
