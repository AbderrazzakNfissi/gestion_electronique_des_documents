<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Models\Document;
use App\Models\Entreprise;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use Carbon\Carbon;
class DocumentController extends Controller
{
    //

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function documents($employee_id){
     $documents = DB::table('documents')->where('user_id',$employee_id)->get();
     $user = User::find($employee_id);
     $entreprise = Entreprise::find($user->entreprise_id);
     $demandes = DB::table('demandes')->where('emetteur_id',Auth::user()->id)->get();
     return view('pages.documents',
                ['documents'=>$documents,
                'user'=>$user,
                'entreprise'=>$entreprise,
                'demandes'=>$demandes
            ]);

    }

    public function settings(){
        return view('pages.settings');
    }


    public function editDoc(){
        return view('pages.editDoc');
    }

    public function uploaderDocInFolder(Request $request,$section_id,$dossier_id){
        $originalName =  $request->file('document')->getClientOriginalName(); 
        $taille  = $request->document->getSize()/1024;
        $extension = $request->document->extension();
        
        $type="";
        if($extension=="doc" || $extension=="docx"){
            $type = "fichier Word";
        }elseif($extension=="xls" || $extension=="xlsx"){
            $type = "fichier Excel";
        }elseif($extension=="exe"){
            $type = "Fichier exécutable";
        }elseif($extension=="htm" || $extension=="html"){
            $type = "Fichier HTML";
        }elseif($extension=="jpeg" || $extension=="png" || $extension=="jpg"){
            $type = "Fichier image";
        }elseif($extension=="pdf"){
            $type = "Fichier PDF";
        }elseif($extension=="ppt" || $extension=="pptx"){
           $type = "Fichier PowerPoint";
        }elseif($extension=="txt"){
            $type = "Fichier texte";
        }else{
            $type = "Fichier ".$extension;
        }

        $name = $request->file('document')->storeAs(
             'Documents',
             $originalName
        );
        
       
        Document::create([
           'nom' => $originalName,
           'chemin' => $name,
           'taille' => number_format($taille,2),
           'type' => $type,
           'logo_path'=>'default_logo',
           'content'=>$name,
           'user_id'=>Auth::user()->id,
           'dossier_id'=>$dossier_id,
           'visibility'=>$request->visibility,
           'section_id'=>$section_id,
           'entreprise_id'=>Auth::user()->entreprise_id
         ]);
         
         $documents = DB::table('documents')->where('entreprise_id',Auth::user()->entreprise_id)->get();
         return redirect()->back()->with('documents',$documents);
         
    }

    public function uploaderDoc(Request $request,$section_id){ 
        $originalName =  $request->file('document')->getClientOriginalName(); 
        $taille  = $request->document->getSize()/1024;
        $extension = $request->document->extension();
        
        $type="";
        if($extension=="doc" || $extension=="docx"){
            $type = "fichier Word";
        }elseif($extension=="xls" || $extension=="xlsx"){
            $type = "fichier Excel";
        }elseif($extension=="exe"){
            $type = "Fichier exécutable";
        }elseif($extension=="htm" || $extension=="html"){
            $type = "Fichier HTML";
        }elseif($extension=="jpeg" || $extension=="png" || $extension=="jpg"){
            $type = "Fichier image";
        }elseif($extension=="pdf"){
            $type = "Fichier PDF";
        }elseif($extension=="ppt" || $extension=="pptx"){
           $type = "Fichier PowerPoint";
        }elseif($extension=="txt"){
            $type = "Fichier texte";
        }else{
            $type = "Fichier ".$extension;
        }

        $name = $request->file('document')->storeAs(
             'Documents',
             $originalName
        );
        
       
        Document::create([
           'nom' => $originalName,
           'chemin' => $name,
           'taille' => number_format($taille,2),
           'type' => $type,
           'logo_path'=>'default_logo',
           'content'=>$name,
           'user_id'=>Auth::user()->id,
           'dossier_id'=>0,
           'visibility'=>$request->visibility,
           'section_id'=>$section_id,
           'entreprise_id'=>Auth::user()->entreprise_id
         ]);
         
         $documents = DB::table('documents')->where('entreprise_id',Auth::user()->entreprise_id)->get();
         return redirect()->back()->with('documents',$documents);
         
          
    }


    public function download($id_doc){
        $documents = Document::all();       
        $document = $documents->find($id_doc);
        return Storage::download($document->chemin);
    }

    public function delete($id_doc){
        $documents = Document::all();       
        $document = $documents->find($id_doc);
        Storage::delete($document->chemin);
        $document->delete();
        return redirect()->back();
    }


    public function deleteEmp($id){
        $user = User::all()->find($id);
        $user->delete();
        return redirect()->back();
    }

    public function detailDocument(Request $request){
        $document = null;
        $user = null;
        if($request->ajax()){
            $document = Document::find($request->id);
            $user = User::find($document->user_id);
        }
        $response = " <strong>Nom du document : </strong>";
        $response .= $document->nom."<br>";
        $response .= " <strong>Type du document : </strong>";
        $response .= $document->type."<br>";
        $response .= " <strong>Taille du document : </strong>";
        $response .= $document->taille." ko<br>";
        $response .= " <strong>visibilité : </strong>";
        $response .= $document->visibility=='private'? 'privé' : 'public';
        $response .= "<br><strong>partager Le : </strong>";
        $response .=  Carbon::createFromFormat('Y-m-d H:i:s', $user->created_at)->format('d/m/Y à H:i')."<br>";
        $response .= " <strong>Modifié Le : </strong>";
        $response .=  Carbon::createFromFormat('Y-m-d H:i:s', $user->updated_at)->format('d/m/Y à H:i')."<br>";
        $response .= "<strong> partager par : </strong>";
        $response .= $user->nom."<br>";
       
        return $response;
    }
}
