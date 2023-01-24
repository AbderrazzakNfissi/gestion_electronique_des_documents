@extends('layouts.navbar')



@section('content')

  
<div class="card text-center" style="width: 77%">
  <div class="card-header nombre-elements"  style="text-align: center;">

    @if(Auth::user()->est_admin==1)
    <button type="button" class="btn btn-outline-dark" data-toggle="modal" title="Ajouter un nouveau employé" data-target="#ajouterEmp" >
    <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30 " fill="currentColor" class="bi bi-person-plus" viewBox="0 0 16 16">
        <path d="M6 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0zm4 8c0 1-1 1-1 1H1s-1 0-1-1 1-4 6-4 6 3 6 4zm-1-.004c-.001-.246-.154-.986-.832-1.664C9.516 10.68 8.289 10 6 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10z"/>
        <path fill-rule="evenodd" d="M13.5 5a.5.5 0 0 1 .5.5V7h1.5a.5.5 0 0 1 0 1H14v1.5a.5.5 0 0 1-1 0V8h-1.5a.5.5 0 0 1 0-1H13V5.5a.5.5 0 0 1 .5-.5z"/>
      </svg>  
     </button>
    @else
     {{ $entreprise->nom }}
    @endif


   <!------------------------------------   Ajouter un employé ------------------------------------>

   <div class="modal fade" id="ajouterEmp" tabindex="-1" role="dialog" aria-labelledby="ajouterEmpTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle"> <strong>Ajouter un Employé</strong></h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div align="center">
          <div  style="width: 18rem;">
            <img class="card-img-top" src="/images/user.png"  alt="user image" id="user-img">
            <div class="card-body">
             
             
              
            </div>
          </div>
          </div>
        <form method="POST" action="{{ route('ajouterEmp') }}">
          @csrf
          <div class="input-group mb-3" style="padding-left:12px;padding-right:12px">
              
            <input type="text"  name="nom" class="form-control"  aria-label="Entreprise_name" aria-describedby="basic-addon1" placeholder="nom complet" required>
            
            <div class="input-group-prepend">
              <span class="input-group-text" id="basic-addon1" style="color: red">*</span>
            </div>
          </div>
    <!--  input : numéro de téléphone  -->
          <div class="input-group mb-3" style="padding-left:12px;padding-right:12px">
            
            <input type="text"  name="telephone" class="form-control"  aria-label="Entreprise_name" aria-describedby="basic-addon1" placeholder="Numéro de téléphone" required>
            <div class="input-group-prepend">
              <span class="input-group-text" id="basic-addon1" style="color: red">*</span>
            </div>
          </div>
    
    <!-- input : email -->
          <div class="input-group mb-3" style="padding-left:12px;padding-right:12px">
            
            <input type="text"  name="email" class="form-control"  aria-label="Entreprise_name" aria-describedby="basic-addon1" placeholder="Email" required>
            <div class="input-group-prepend">
              <span class="input-group-text" id="basic-addon1" style="color: red">*</span>
            </div>
          </div>
    
   <!--  cin -->        
          <div class="input-group mb-3" style="padding-left:12px;padding-right:12px">
            
            <input type="text"  name="cin" class="form-control"  aria-label="CIN" aria-describedby="basic-addon1" placeholder="carte d'identité nationale" required>
            <div class="input-group-prepend">
              <span class="input-group-text" id="basic-addon1" style="color: red">*</span>
            </div>
          </div>
  
        
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">annuler</button>
          <button type="submit" class="btn btn-success">ajouter</button>
        </div>
        </form>
      </div>
    </div>
  </div>


  <!----------------------------------------------------------------------------------------->





  <!----------------------------------Message de confirmation --------------------------------->

    
@isset($email)
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle" style="color:green">succès</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        l'employé a été ajouté avec succès, un mot de passe sera anvoyé a l'email suivant :
                                       <strong style="color:chocolate">
                                      
                                        {{ $email }}
                                       
                                       </strong>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-dismiss="modal" onclick="window.location.href='/liste';">OK</button>
        
      </div>
    </div>
  </div>
</div>  
@endisset





  <!-----------------------------------end Message de confirmation------------------------------->
  </div>
  <div class="card-body search-list">
    <table class="table">
      <caption>Users</caption>
      <thead>
        <tr>
          <th scope="col">id</th>
          
          <th scope="col">Nom</th>
          <th scope="col">Dernier accès</th>
          <th scope="col">Rôle</th>
          <th scope="col">action</th>
        </tr>
      </thead>
      <tbody>
        

       @foreach ($users as $user)
           
      
        <tr >
            <td > <a href="{{ route('details',['id'=>$user->id]) }}" style="text-decoration: none"><img src="{{asset($user->logo_path)}}" id="img-user" style="width: 50px;border-radius:50px;"><br> {{$user->id}}<a></td>
            
             
         
            <td style="vertical-align: middle;">
              @if($user->id==Auth::user()->id) 
              <strong style="color:green"> Vous <strong>
             @else
             {{$user->nom}}
             @endif
            
            
            </td>
            <td style="vertical-align: middle;"> Le {{
             Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $user->created_at)->format('d/m/Y à H:i')  }}</td>
            <td style="vertical-align: middle;">
            
              @if($user->est_admin==1)
                admininstrateur
              @else
               Employé
              @endif
            
            </td>
            <td style="vertical-align: middle;">
              <!--   Bloquer un Employé-->
              
              @if(Auth::user()->est_admin==1)
              @if($user->id!=Auth::user()->id)          
              <a type="button" class="btn btn-danger" style="color:white" href="/liste/{{$user->id}}">
                    
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-x" viewBox="0 0 16 16">
                    <path d="M6 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0zm4 8c0 1-1 1-1 1H1s-1 0-1-1 1-4 6-4 6 3 6 4zm-1-.004c-.001-.246-.154-.986-.832-1.664C9.516 10.68 8.289 10 6 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10z"/>
                    <path fill-rule="evenodd" d="M12.146 5.146a.5.5 0 0 1 .708 0L14 6.293l1.146-1.147a.5.5 0 0 1 .708.708L14.707 7l1.147 1.146a.5.5 0 0 1-.708.708L14 7.707l-1.146 1.147a.5.5 0 0 1-.708-.708L13.293 7l-1.147-1.146a.5.5 0 0 1 0-.708z"/>
                </svg>
              </a>

              <!-------------------   Modal    --------------------->


            
              
              <!-- Modal -->
              <div class="modal fade" id="deleteEmp" tabindex="-1" role="dialog" aria-labelledby="deleteEmpTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="deleteEmpTitle"><svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                        <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                        <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                      </svg></h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      @isset($userToDelete)
                     voulez-vous vraiment Supprimer <strong style="color:red">{{ $userToDelete->nom }} </strong>de facon permanente ?
                     @endisset
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Non</button>
                      @isset($userToDelete)
                     <a  class="btn btn-primary" data-dismiss="modal" onclick="window.location.href='/DeleteUser/{{ $userToDelete->id }}';">OUI</a> 
                      @endisset </div>
                  </div>
                </div>
              </div>
               


              <!----------------------------------------------------->

              @endif

              @endif


           <!--    Details -->
           <button type="button" class="btn btn-primary" onclick="window.location.href='{{ route('details',['id'=>$user->id]) }}'" >
              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-info-circle" viewBox="0 0 16 16">
                   <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                   <path d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"/>
              </svg>
           </button>
  
  
          <!------------parameters <Admin>  -->
            @if(Auth::user()->est_admin==1)
              <button type="button" class="btn btn-success">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-gear" viewBox="0 0 16 16">
                <path d="M8 4.754a3.246 3.246 0 1 0 0 6.492 3.246 3.246 0 0 0 0-6.492zM5.754 8a2.246 2.246 0 1 1 4.492 0 2.246 2.246 0 0 1-4.492 0z"/>
                <path d="M9.796 1.343c-.527-1.79-3.065-1.79-3.592 0l-.094.319a.873.873 0 0 1-1.255.52l-.292-.16c-1.64-.892-3.433.902-2.54 2.541l.159.292a.873.873 0 0 1-.52 1.255l-.319.094c-1.79.527-1.79 3.065 0 3.592l.319.094a.873.873 0 0 1 .52 1.255l-.16.292c-.892 1.64.901 3.434 2.541 2.54l.292-.159a.873.873 0 0 1 1.255.52l.094.319c.527 1.79 3.065 1.79 3.592 0l.094-.319a.873.873 0 0 1 1.255-.52l.292.16c1.64.893 3.434-.902 2.54-2.541l-.159-.292a.873.873 0 0 1 .52-1.255l.319-.094c1.79-.527 1.79-3.065 0-3.592l-.319-.094a.873.873 0 0 1-.52-1.255l.16-.292c.893-1.64-.902-3.433-2.541-2.54l-.292.159a.873.873 0 0 1-1.255-.52l-.094-.319zm-2.633.283c.246-.835 1.428-.835 1.674 0l.094.319a1.873 1.873 0 0 0 2.693 1.115l.291-.16c.764-.415 1.6.42 1.184 1.185l-.159.292a1.873 1.873 0 0 0 1.116 2.692l.318.094c.835.246.835 1.428 0 1.674l-.319.094a1.873 1.873 0 0 0-1.115 2.693l.16.291c.415.764-.42 1.6-1.185 1.184l-.291-.159a1.873 1.873 0 0 0-2.693 1.116l-.094.318c-.246.835-1.428.835-1.674 0l-.094-.319a1.873 1.873 0 0 0-2.692-1.115l-.292.16c-.764.415-1.6-.42-1.184-1.185l.159-.291A1.873 1.873 0 0 0 1.945 8.93l-.319-.094c-.835-.246-.835-1.428 0-1.674l.319-.094A1.873 1.873 0 0 0 3.06 4.377l-.16-.292c-.415-.764.42-1.6 1.185-1.184l.292.159a1.873 1.873 0 0 0 2.692-1.115l.094-.319z"/>
                </svg>
              </button>
            @endif
          </td>
          </tr>
          @endforeach
      </tbody>
    </table>

   {{ $users->links('pagination::bootstrap-4') }}
    
  </div>

 
</div>
</div>
  <!-- Optional JavaScript -->
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
 
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>

</html>
@endSection