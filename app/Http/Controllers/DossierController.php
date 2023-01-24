<?php

namespace App\Http\Controllers;

use App\Models\Document;
use Illuminate\Http\Request;
use App\Models\Dossier;
use App\Models\Entreprise;
use App\Models\Section;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
class DossierController extends Controller
{
    //
    public function creerDossier(Request $request,$section_id){
        $sections = Section::all();
        $section = $sections->find($section_id);
        $entreprises = Entreprise::all();
        $entreprise = $entreprises->find(Auth::user()->entreprise_id);
        $chemin = $entreprise->nom."/".$section->nom."/".$request->Folder_name;
     
         Dossier::create([
             'nom'=>$request->Folder_name,
             'chemin'=>$chemin,
             'taille'=>0,
             'section_id'=>$section_id
         ]);  
             
        return redirect()->back();  
    }

    public function deleteFolder($id_folder){
        $dossiers = Dossier::all();
        $dossier = $dossiers->find($id_folder);
        $documents =  DB::table('documents')->where('dossier_id',$id_folder)->get();
        foreach($documents as $document){
        $doc = Document::find($document->id);
        $doc->delete();
        Storage::delete($doc->chemin);
        }
        $dossier->delete();
        return redirect()->back();
    }

    public function show($section_id,$dossier_id){
        
        $user = Auth::user();
        $entreprises = Entreprise::all();
        $entreprise = $entreprises->find($user->entreprise_id);
        $allSections = Section::all();
        $section =  $allSections->find($section_id);
        $documentsInFolder = DB::table('documents')->where('dossier_id',$dossier_id)->get();
        $sections = DB::table('sections')->where('user_id',$user->entreprise_id)->get();
        $folder = Dossier::find($dossier_id);
        $demandes = DB::table('demandes')->where('emetteur_id',Auth::user()->id)->get();
      
        
       
        return view('pages.sections',[
            'user'=>$user,
            'entreprise'=>$entreprise,
            'section'=>$section,
            'documentsInFolder'=>$documentsInFolder,
            'sections'=>$sections,
            'folder'=>$folder,
            'dossier_id'=>$dossier_id,
            'demandes'=>$demandes
        ]);
    }

    public function hello(){
        return 'hello';
    }
}
