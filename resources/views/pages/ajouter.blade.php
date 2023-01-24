@extends('layouts.navbar')


@section('content')

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
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        
      </div>
    </div>
  </div>
</div>  
@endisset

    
    
    <div class="card text-center" style="width: 77%">
      <div class="card-header nombre-elements"  style="text-align: center;">
       
      </div>
      <div class="card-body">
        
       <!-- -------------  Partie Dynamique ------------------>
      
       <div class="card text-center">
        
        <div class="card-body">
          <div align="center">
          <div  style="width: 18rem;">
            <img class="card-img-top" src="/images/user.png"  alt="user image" id="user-img">
            <div class="card-body">
             
              <strong>Ajouter un Employé</strong>
              
            </div>
          </div>
          </div>
          
      <div align="center">
      <div  style="width: 50%" >

       <!-- input : nom complet  -->

       <form method="POST" action="{{ route('ajouterEmp') }}">
        @csrf
          <div class="input-group mb-3">
            
            <input type="text"  name="nom" class="form-control"  aria-label="Entreprise_name" aria-describedby="basic-addon1" placeholder="nom complet" required>
            
            <div class="input-group-prepend">
              <span class="input-group-text" id="basic-addon1" style="color: red">*</span>
            </div>
          </div>
    <!--  input : numéro de téléphone  -->
          <div class="input-group mb-3">
            
            <input type="text"  name="telephone" class="form-control"  aria-label="Entreprise_name" aria-describedby="basic-addon1" placeholder="Numéro de téléphone" required>
            <div class="input-group-prepend">
              <span class="input-group-text" id="basic-addon1" style="color: red">*</span>
            </div>
          </div>
    
    <!-- input : email -->
          <div class="input-group mb-3">
            
            <input type="text"  name="email" class="form-control"  aria-label="Entreprise_name" aria-describedby="basic-addon1" placeholder="Email" required>
            <div class="input-group-prepend">
              <span class="input-group-text" id="basic-addon1" style="color: red">*</span>
            </div>
          </div>
    
   <!--  cin -->        
          <div class="input-group mb-3">
            
            <input type="text"  name="cin" class="form-control"  aria-label="CIN" aria-describedby="basic-addon1" placeholder="carte d'identité nationale" required>
            <div class="input-group-prepend">
              <span class="input-group-text" id="basic-addon1" style="color: red">*</span>
            </div>
          </div>

        
    

         
          <a href="#" class="btn btn-danger">
             
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-square-fill" viewBox="0 0 16 16">
                <path d="M2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2zm3.354 4.646L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 1 1 .708-.708z"/>
              </svg>

            Annuler
        
         </a>
          <button type="submit" class="btn btn-success">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-plus" viewBox="0 0 16 16">
                <path d="M6 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0zm4 8c0 1-1 1-1 1H1s-1 0-1-1 1-4 6-4 6 3 6 4zm-1-.004c-.001-.246-.154-.986-.832-1.664C9.516 10.68 8.289 10 6 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10z"/>
                <path fill-rule="evenodd" d="M13.5 5a.5.5 0 0 1 .5.5V7h1.5a.5.5 0 0 1 0 1H14v1.5a.5.5 0 0 1-1 0V8h-1.5a.5.5 0 0 1 0-1H13V5.5a.5.5 0 0 1 .5-.5z"/>
              </svg>  
            Ajouter</button>

       </form>

          </div>
          </div>

        
    
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