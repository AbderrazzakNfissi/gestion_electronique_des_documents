<?php

namespace App\Http\Controllers;

use App\Models\Demande;
use App\Models\Document;
use App\Models\Entreprise;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;


class UserController extends Controller

{

    public function __construct()
    {
        $this->middleware('auth');
    }

    //
    public function login(){
        $user = DB::table('users');
    }

    public function show(){
        $user = Auth::user();

        $entreprises = Entreprise::all();
        $entreprise = $entreprises->find($user->entreprise_id);
        $sections = DB::table('sections')->where('user_id',$user->entreprise_id)->get();
        return view('pages.user',['user'=>$user,'entreprise'=>$entreprise,'sections'=>$sections]);
    }

    public function ajouter(){
        $user = Auth::user();

       // $password = Crypt::decryptString($user->password);
       
        $entreprises = Entreprise::all();
        $entreprise = $entreprises->find($user->entreprise_id);
        $sections = DB::table('sections')->where('user_id',$user->entreprise_id)->get();
        return view('pages.ajouter',['user'=>$user,'entreprise'=>$entreprise,'sections'=>$sections]);
    }


    public function ajouterEmp(Request $request){
     
        $user = Auth::user();

        $entreprises = Entreprise::all();
        $entreprise = $entreprises->find($user->entreprise_id);
        
        User::create([
            'nom'=>$request->nom,
            'telephone'=>$request->telephone,
            'email'=>$request->email,
            'logo_path'=>'/storage/imageUser/user.png',
            'password' => Hash::make($request->cin),
            'entreprise_id'=>$user->entreprise_id
        ]);

        $users = DB::table('users')->where('entreprise_id',$user->id)->paginate(7);
        $sections = DB::table('sections')->where('user_id',$user->entreprise_id)->get();
        
        return view('pages.listeUsers',[
            'user'=>$user,
            'entreprise'=>$entreprise,
            'success'=>1,
            'email'=>$request->email,
            'users'=>$users,
            'sections'=>$sections
        ]);

    }


  
    public function update(Request $request){
        $user = User::find($request->idEmp);
        
         if (Hash::check($request->AncienPassword, $user->password)){
            if(empty($request->newPassword)==false){
                DB::table('users')->where('id', $request->idEmp)->update(['nom'=>$request->nom]);
                DB::table('users')->where('id', $request->idEmp)->update(['telephone'=>$request->telephone]);
                DB::table('users')->where('id', $request->idEmp)->update(['email'=>$request->email]);
                DB::table('users')->where('id', $request->idEmp)->update(['password'=>Hash::make($request->newPassword)]);
               }
       
               $entreprises = Entreprise::all();
               $entreprise = $entreprises->find($user->entreprise_id);
               $sections = DB::table('sections')->where('user_id',$user->entreprise_id)->get();
               $user = User::find($request->idEmp);
               return view('pages.user',['user'=>$user,
                                         'entreprise'=>$entreprise,
                                         'sections'=>$sections,
                                         'change'=>1]);
         }else{   
            $entreprises = Entreprise::all();
            $entreprise = $entreprises->find($user->entreprise_id);
            $sections = DB::table('sections')->where('user_id',$user->entreprise_id)->get();
            $user = User::find($request->idEmp);
            return view('pages.user',['user'=>$user,
                                      'entreprise'=>$entreprise,
                                      'sections'=>$sections,
                                      'change'=>0]);
         }

        
       
       
    }


    public function changeImage(Request $request){
        $user = Auth::user();
        $entreprises = Entreprise::all();
        $entreprise = $entreprises->find($user->entreprise_id);
        $sections = DB::table('sections')->where('user_id',$user->entreprise_id)->get();
       
        $originalName =  $request->file('imageUser')->getClientOriginalName(); 
       
        $name = $request->imageUser->storeAs(
            'public/imageUser',
            $originalName
        );
       
        $url = Storage::url($name);
        DB::table('users')->where('id', Auth::user()->id)->update(['logo_path'=>$url]);
        $user = User::find($user->id);
        return view('pages.user',['user'=>$user,'entreprise'=>$entreprise,'sections'=>$sections]);
       
    }

    public function page(){
        
        $user = Auth::user();
        
        $entreprises = Entreprise::all();
        $entreprise = $entreprises->find($user->entreprise_id);
        $sections = DB::table('sections')->where('user_id',$user->entreprise_id)->get();
        return view('pages.page',[
            'user'=>$user,
            'entreprise'=>$entreprise,
            'sections'=>$sections
            ]);
    }


    public function detaille($id){
        $user = Auth::user();
        $entreprises = Entreprise::all();
        $entreprise = $entreprises->find($user->entreprise_id);
        $users = User::all();
        $employee = $users->find($id);
        $sections = DB::table('sections')->where('user_id',$user->entreprise_id)->get();
        return view('pages.detailsEmp',[
            'user'=>$user,
            'entreprise'=>$entreprise,
            'employee'=>$employee,
            'sections'=>$sections
        ]);
    }

   // return the number of documents 
    public function searchNbDoc(Request $request){
         if($request->ajax()){
          $data = Document::where([
            ['nom','like','%'.$request->search.'%'],
            ['entreprise_id','=',Auth::user()->entreprise_id]
              ])->get();
           }     
          $outputs = "";
          if(count($data)){
              if(count($data)>1){
                $outputs = "<p style='color:green'>".count($data)." Documents trouvés</p>";
              }else{
                $outputs = "<p style='color:green'>".count($data)." Document trouvé</p>";
              }
              
          }else{
              $outputs = '<p style="color:red">Aucun document n\'est trouvé !</p>';
          }
          return $outputs;
    }  

    // return documents
    public function searchDoc(Request $request){
        if($request->ajax()){
         $documents = Document::where([
            ['nom','like','%'.$request->search.'%'],
            ['entreprise_id','=',Auth::user()->entreprise_id]
              ])->get();
          }     
         $outputs = '<table class="table">
         <thead>
         <tr>
           <th scope="col" style="text-align: left">Nom</th>
           <th scope="col" style="text-align: left">Type</th>
           <th scope="col" style="text-align: left">Taille</th>
           <th scope="col" style="text-align: left">Action</th>
         </tr>
         </thead>
          <tbody>';
         
         if(count($documents)){
           foreach($documents as $document){
            $outputs.= '<tr><td style="text-align: left">'.$document->nom.'</td>';
            $outputs.= '<td style="text-align: left">'.$document->type.'</td>';
            $outputs.= '<td style="text-align: left">'.$document->taille.' ko</td><td>';
           
         
         
          $outputs.='<!--    Details d un Document -->
          <button type="button" title="voire plus" class="btn btn-info detail" onclick="detailDoc();" name="'.$document->id.'">
           <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-info-square" viewBox="0 0 16 16">
             <path d="M14 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h12zM2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2z"/>
             <path d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"/>
           </svg>
         </button>
          ';

            // demander l'accès a un document

           
            
          if(!($document->visibility=="public" || $document->user_id==Auth::user()->id || Auth::user()->est_admin==1)){
            $outputs .= ' <a  title="demander l\'accès a ce document" class="btn btn-warning" >
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-send-plus-fill" viewBox="0 0 16 16">
              <path d="M15.964.686a.5.5 0 0 0-.65-.65L.767 5.855H.766l-.452.18a.5.5 0 0 0-.082.887l.41.26.001.002 4.995 3.178 1.59 2.498C8 14 8 13 8 12.5a4.5 4.5 0 0 1 5.026-4.47L15.964.686Zm-1.833 1.89L6.637 10.07l-.215-.338a.5.5 0 0 0-.154-.154l-.338-.215 7.494-7.494 1.178-.471-.47 1.178Z"/>
              <path d="M16 12.5a3.5 3.5 0 1 1-7 0 3.5 3.5 0 0 1 7 0Zm-3.5-2a.5.5 0 0 0-.5.5v1h-1a.5.5 0 0 0 0 1h1v1a.5.5 0 0 0 1 0v-1h1a.5.5 0 0 0 0-1h-1v-1a.5.5 0 0 0-.5-.5Z"/>
            </svg>
           </a>';
           
           }
          
         
          if($document->visibility=="public" || $document->user_id==Auth::user()->id || Auth::user()->est_admin==1){
            $outputs.= '<!------------Télécharger un Document -->
             <a class="btn btn-success" title="télécharger ce document" href="/download/'.$document->id.'">
             
             <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-download" viewBox="0 0 16 16">
               <path d="M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5z"/>
               <path d="M7.646 11.854a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293V1.5a.5.5 0 0 0-1 0v8.793L5.354 8.146a.5.5 0 1 0-.708.708l3 3z"/>
             </svg> </a>';
          }
          if($document->user_id==Auth::user()->id || Auth::user()->est_admin==1){
          $outputs.= ' 
          <!--   Supprimer document-->
                 <a  class="btn btn-danger" title="supprimer ce document" href="/delete/'.$document->id.'">
                
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
              <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
              <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
            </svg>

          </a>';
          }

          $outputs.='</button></td></tr>';
           }

           $outputs.='</tbody></table><div>';
         
            
         }else{
            $outputs = '<p>Aucun document n\'est trouvé !</p>';
         }
         return $outputs;
   }  

   // return the number of employees 


   public function searchNbEmp(Request $request){
    if($request->ajax()){
        $users = User::where([
                ['nom','like','%'.$request->search.'%'],
                ['entreprise_id','=',Auth::user()->entreprise_id]
                  ])->get();
         }     
        $outputs = "";
        if(count($users)){
            if(count($users)>1){
                $outputs = "<p style='color:green'>".count($users)." Employés trouvés</p>";
            }else{
                $outputs = "<p style='color:green'>".count($users)." Employé trouvé</p>";
            }
            
        }else{
            $outputs = "<p> Aucun Employé n'est trouvé</p>";
        }
        return $outputs;
}  
    
    public function searchEmp(Request $request){
        if($request->ajax()){
            $users = User::where([
                ['nom','like','%'.$request->search.'%'],
                ['entreprise_id','=',Auth::user()->entreprise_id]
                  ])->get();
             }     
            $outputs =' <table class="table">
            <caption>Users</caption>
            <thead>
              <tr>
                <th scope="col">id</th>
                
                <th scope="col">Nom</th>
                <th scope="col">Rôle</th>
                <th scope="col">action</th>
              </tr>
            </thead>
            <tbody>
              ';
            if(count($users)){
               foreach($users as $user){
               $outputs.='<tr>
                <td > 
                <a href="details/'.$user->id.'" style="text-decoration: none">
                <img src="'.asset($user->logo_path).'"  id="img-user" style="width: 50px;border-radius:50px;">
                <br> '.$user->id.'
                </a></td>
                <td>'.$user->nom.'</td>';
                if($user->est_admin==1){
                     $outputs.= '<td>Administrateur</td><td>';
                }else{
                    $outputs.= '<td>Employé</td><td> ';
                }
                if(Auth::user()->est_admin==1){
                $outputs.='<a type="button" class="btn btn-danger" style="color:white" href="/liste/'.$user->id.'">
                    
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-x" viewBox="0 0 16 16">
                    <path d="M6 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0zm4 8c0 1-1 1-1 1H1s-1 0-1-1 1-4 6-4 6 3 6 4zm-1-.004c-.001-.246-.154-.986-.832-1.664C9.516 10.68 8.289 10 6 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10z"/>
                    <path fill-rule="evenodd" d="M12.146 5.146a.5.5 0 0 1 .708 0L14 6.293l1.146-1.147a.5.5 0 0 1 .708.708L14.707 7l1.147 1.146a.5.5 0 0 1-.708.708L14 7.707l-1.146 1.147a.5.5 0 0 1-.708-.708L13.293 7l-1.147-1.146a.5.5 0 0 1 0-.708z"/>
                </svg>
               </a>';
                }

                $outputs.= ' <a  class="btn btn-primary" href="/details/'.$user->id.'" >
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-info-circle" viewBox="0 0 16 16">
                     <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                     <path d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"/>
                </svg>
                 </a></td></tr>';

                
               }

               $outputs.=' </tbody>
               </table>';
            }else{
                $outputs = "<p> Aucun Employé n'est trouvé</p>";
            }
            return $outputs;
   }  




   
}
