<?php

namespace App\Http\Controllers;

use App\Models\Entreprise;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
class EntrepriseController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store(Request $request){

          // dd($request);
         $entreprise = new Entreprise();
         $user = new User();
         $entreprise->nom = $request->nom;
         $entreprise->telephone = $request->telephone;
         $entreprise->email = $request->email;
         $entreprise->pays = $request->pays;
         $entreprise->industrie = $request->industrie;
         $entreprise->password = Crypt::encryptString($request->password);
         $entreprise->save();
         $entreprise_id = DB::table('entreprises')->where('email', $entreprise->email)->value('id');;
         $user->nom = 'admin';
         $user->telephone = $entreprise->telephone;
         $user->email = $entreprise->email;
         $user->est_admin = 1;
         $user->password = $entreprise->password;
         $user->entreprise_id = $entreprise_id; 
         $user->save();
         return redirect()->route('login');
    }


    public function compte(){

        $user = Auth::user();
        $entreprises = Entreprise::all();
        $entreprise = $entreprises->find($user->entreprise_id);
        $sections = DB::table('sections')->where('user_id',$user->entreprise_id)->get();
        return view('pages.compte',[
            'user'=>$user,
            'entreprise'=>$entreprise,
            'sections'=>$sections
        ]);
        
    }


    public function listeUsers(){
        $user = Auth::user();
        $entreprises = Entreprise::all();
        $users = DB::table('users')->where('entreprise_id',$user->entreprise_id)->paginate(6);
        $entreprise = $entreprises->find($user->entreprise_id);
        $sections = DB::table('sections')->where('user_id',$user->entreprise_id)->get();
        return view('pages.listeUsers',[
            'user'=>$user,
            'entreprise'=>$entreprise,
            'users'=>$users,
            'sections'=>$sections
        ]); 

    }

    public function supprimerUser($user_id){
        $user = Auth::user();
        $entreprises = Entreprise::all();
        $users = DB::table('users')->where('entreprise_id',$user->entreprise_id)->get();
        $entreprise = $entreprises->find($user->entreprise_id);
        $sections = DB::table('sections')->where('user_id',$user->entreprise_id)->get();
        $userToDelete = User::find($user_id);
        return view('pages.listeUsers',[
            'user'=>$user,
            'entreprise'=>$entreprise,
            'users'=>$users,
            'sections'=>$sections,
            'userToDelete' =>$userToDelete
        ]); 
    }

    public function oui($user_id){
        $userToDelete = User::find($user_id);
        $userToDelete->delete();
        return redirect()->back();
    }

    public function updateEntreprise(Request $request){
        $user = Auth::user();
        
        if (Hash::check($request->AncienPassword, $user->password)){
           if(empty($request->newPassword)==false){
               DB::table('entreprises')->where('id', $user->entreprise_id)->update(['nom'=>$request->nom]);
               DB::table('entreprises')->where('id', $user->entreprise_id)->update(['telephone'=>$request->telephone]);
               DB::table('entreprises')->where('id',$user->entreprise_id)->update(['email'=>$request->email]);
               DB::table('entreprises')->where('id',$user->entreprise_id)->update(['pays'=>$request->pays]);
               DB::table('entreprises')->where('id',$user->entreprise_id)->update(['industrie'=>$request->industrie]);
               DB::table('entreprises')->where('id', $user->id)->update(['password'=>Hash::make($request->newPassword)]);
               DB::table('users')->where('id', $user->id)->update(['password'=>Hash::make($request->newPassword)]);
              }
      
              $entreprises = Entreprise::all();
              $entreprise = $entreprises->find($user->entreprise_id);
              $sections = DB::table('sections')->where('user_id',$user->entreprise_id)->get();
              $user = User::find($user->id);
              return view('pages.compte',['user'=>$user,
                                        'entreprise'=>$entreprise,
                                        'sections'=>$sections,
                                        'change'=>1]);
        }else{   
              $entreprises = Entreprise::all();
              $entreprise = $entreprises->find($user->entreprise_id);
              $sections = DB::table('sections')->where('user_id',$user->entreprise_id)->get();
              $user = User::find($user->id);
              return view('pages.compte',['user'=>$user,
                                     'entreprise'=>$entreprise,
                                     'sections'=>$sections,
                                     'change'=>0]);
        }

       
    }
}
