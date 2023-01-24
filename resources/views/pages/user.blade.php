@extends('layouts.navbar')


@section('content')

    
    
    
    
    <div class="card text-center" style="width: 77%">
      <div class="card-header nombre-elements"  style="text-align: center;">
        <a href="/compte" style="text-decoration: none;"><strong>
          <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-arrow-return-right" viewBox="0 0 16 16">
            <path fill-rule="evenodd" d="M1.5 1.5A.5.5 0 0 0 1 2v4.8a2.5 2.5 0 0 0 2.5 2.5h9.793l-3.347 3.346a.5.5 0 0 0 .708.708l4.2-4.2a.5.5 0 0 0 0-.708l-4-4a.5.5 0 0 0-.708.708L13.293 8.3H3.5A1.5 1.5 0 0 1 2 6.8V2a.5.5 0 0 0-.5-.5z"/>
          </svg> 
          {{ $entreprise->nom }} / </strong></a>
          @if(isset($section))
          <a href="/sections/{{ $section->id }}" style="text-decoration: none;color:chocolate"> <strong> {{$section->nom}} </strong></a>
          @else 
          
          @endif
          @isset($folder)
          <a href="/sections/{{ $section->id }}/{{$dossier_id}}" style="text-decoration: none;color:chocolate"> <strong>/ {{$folder->nom}} </strong></a>
          @endisset
                
      </div>
      <div class="card-body search-list">
        
       <!-- -------------  Partie Dynamique ------------------>
      
       <div class="card text-center">
        
        <div class="card-body">
          <div align="center">
          <div  style="width: 18rem;">
            <form id="myForm" action="{{ route('changeImage') }}" method="POST" enctype='multipart/form-data'>
              @csrf
            <label for="nv-image" id="label-user-img"  class="custom-file-upload" style="border-radius: 50px;padding:0px;">
              <img class="card-img-top" src="{{asset($user->logo_path)}}" alt="user image" id="user-img">
              <div style="position:absolute;top:60px; width:100px; height:20px;padding:0px; z-index:2;" id="ch-user">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-images" viewBox="0 0 16 16">
                <path d="M4.502 9a1.5 1.5 0 1 0 0-3 1.5 1.5 0 0 0 0 3z"/>
                <path d="M14.002 13a2 2 0 0 1-2 2h-10a2 2 0 0 1-2-2V5A2 2 0 0 1 2 3a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2v8a2 2 0 0 1-1.998 2zM14 2H4a1 1 0 0 0-1 1h9.002a2 2 0 0 1 2 2v7A1 1 0 0 0 15 11V3a1 1 0 0 0-1-1zM2.002 4a1 1 0 0 0-1 1v8l2.646-2.354a.5.5 0 0 1 .63-.062l2.66 1.773 3.71-3.71a.5.5 0 0 1 .577-.094l1.777 1.947V5a1 1 0 0 0-1-1h-10z"/>
                </svg>
              </div>
            </label>
              <input class="form-control" name="imageUser" type="file" id="nv-image" multiple style="background-color: #c2c4c7;color:rgb(44, 40, 40)">
            </form>
              <script>
                $(document).ready(function() {
                    $('input[type="file"]').change(function() {
                     var x = document.getElementById('user-img');
                     var valueFile = document.getElementById('nv-image').value;
                     x.setAttribute("src",valueFile);
                     document.getElementById('myForm').submit();
                    });
                });
             </script>


            <div class="card-body">
              <span id="indication" style="color:orange"> </span>
              <span style="color:orange" id="iconIndication">
                
              </span> 

              <h5 class="card-title">{{$user->nom}}</h5>
              
          
             
            </div>
           
          </div>
          @isset($change)
          @if($change==1)
          <div class="alert alert-success" role="alert">
            vos modifications ont été enregistrées
          </div>
          @elseif($change==0)
          <div class="alert alert-danger" role="alert">
            une erreur est survenue
          </div>
          @endif
          @endisset
          </div>
      <form action="{{ route('updateEmployee') }}"  method="POST" > 
        @csrf
      <div align="center">
      <div  style="width: 50%" >
          <div class="input-group mb-3">
            <input type="hidden" value="{{$user->id}}" name="idEmp">
            <input type="text" class="form-control"  aria-label="Entreprise_name" aria-describedby="basic-addon1" name="nom" value="{{$user->nom}}" >
            
            <div class="input-group-prepend">
              <span class="input-group-text" id="basic-addon1">nom</span>
            </div>
          </div>
    
          <div class="input-group mb-3">
            
            <input type="text" class="form-control"  aria-label="Entreprise_name" name="telephone" aria-describedby="basic-addon1" value="{{$user->telephone}}">
            <div class="input-group-prepend">
              <span class="input-group-text" id="basic-addon1">téléphone</span>
            </div>
          </div>
    
    
          <div class="input-group mb-3">
            
            <input type="text" class="form-control" name="email" aria-label="Entreprise_name" aria-describedby="basic-addon1" value="{{$user->email}}">
            <div class="input-group-prepend">
              <span class="input-group-text" id="basic-addon1">Email</span>
            </div>
          </div>
    
           
        
    
    
    
          <div class="input-group mb-3">
           
            <input type="password" class="form-control" name="AncienPassword" aria-label="Entreprise_name" aria-describedby="basic-addon1" >
            <div class="input-group-prepend">
              <span class="input-group-text" id="basic-addon1">Ancien mot de passe</span>
            </div>
          </div>
    
    
          <div class="input-group mb-3">
            
            <input type="password" id="nv-pass" class="form-control" name="newPassword"  aria-label="Entreprise_name" aria-describedby="basic-addon1" >
            <div class="input-group-prepend">
              <span class="input-group-text" >Nouveau mot de passe</span>
            </div>
          </div>
    
    
          <div class="input-group mb-3">
            
            <input type="password" id="cf-pass" class="form-control"  onkeyup="verify();" name="confPassword" aria-label="Entreprise_name" aria-describedby="basic-addon1" >
            <div class="input-group-prepend">
              <span class="input-group-text" >Confirmez le mot de passe</span>  
            </div>
           
          </div>

         
    
    

    
          <a href="#" class="btn btn-primary">Annuler</a>
          <button type="submit" class="btn btn-success">Enregistrer</button>
          </div>
          </div>
        </form>
        </div>
      </div>
    
       <!--------------------Fin Partie Dynamique ------------>
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