<?php

namespace App\Http\Controllers;

use App\Models\Demande;
use App\Models\Document;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Entreprise;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class DemandeController extends Controller
{
    //

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function demandes(){
        $user = Auth::user();
        $entreprises = Entreprise::all();
        $entreprise = $entreprises->find($user->entreprise_id);
        $sections = DB::table('sections')->where('user_id',$user->entreprise_id)->get();
        $demandes = DB::table('demandes')->where('entreprise_id',Auth::user()->entreprise_id)
                                         ->where('etat',0)->paginate(6);
        $users = DB::table("users")->where('entreprise_id',Auth::user()->entreprise_id)->get();
        $documents = DB::table('documents')->where('entreprise_id',Auth::user()->entreprise_id)->get();
        $responseDemande = DB::table('demandes')->where('emetteur_id',Auth::user()->id)->where('etat','1')
                                                 ->orWhere('etat','2')->orderBy('updated_at', 'desc')->paginate(6);
        return view('pages.demandes',[
                                 'user'=>$user,
                                 'entreprise'=>$entreprise,
                                 'sections'=>$sections,
                                 'demandes'=>$demandes,
                                 'users'=>$users,
                                 'documents'=>$documents,
                                 'responseDemande'=>$responseDemande
                                ]);
       
    }

    public function envoyerDemande(Request $request){
      if($request->ajax()){
        $ids = explode("_", $request->ids);
        $document_id = $ids[0];
        $user_id = $ids[1];
        $document = Document::find($document_id);
        
      }
      Demande::create([
        'etat'=>0, // 0: en cours  1: accepté   2 : refusé
        'emetteur_id'=>$user_id,
        'recepteur_id'=>$document->user_id,
        'document_id'=>$document_id,
        
        'entreprise_id'=>Auth::user()->entreprise_id
    ]);
       return true;
    }

    public function annulerDemande(Request $request){
      if($request->ajax()){
        $ids = explode("_", $request->ids);
        $document_id = $ids[0];
        $user_id = $ids[1];
        $demandes = DB::table('demandes')->where('document_id',$document_id)
                                        ->where('emetteur_id',$user_id)->get();
          $demande_id = 0;
          foreach($demandes as $demande){
            $demande_id = $demande->id;
          }
          $demande = Demande::find($demande_id);
          $demande->delete();
      }
      
       return true;
    }

    public function accepterDemande(Request $request){
      DB::table('demandes')->where('id', $request->demande_id)->update(['etat'=>1]); // 1 :  Demande accepté
      return true;

    }

    public function refuserDemande(Request $request){
      DB::table('demandes')->where('id', $request->demande_id)->update(['etat'=>2]); // 2 : Demande refusé
      return true;
    }
    
}
