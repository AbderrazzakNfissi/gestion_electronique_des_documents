@extends('layouts.navbar')


@section('content')

    
    
    
    
    <div class="card text-center" style="width: 77%">
      <div class="card-header nombre-elements" style="text-align: center;">
        
        <a href="/compte" style="text-decoration: none;color:chocolate"><strong>
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
            <img class="card-img-top" src="{{asset($employee->logo_path)}}"  alt="user image" id="user-img">
            <div class="card-body">
              <h5 class="card-title"><strong>{{$employee->nom}}
              
                @if($employee->est_admin==1)
                (Administrateur)
                @else
                (Employé)
                @endif

              </strong></h5>
             
            </div>
          </div>
          </div>
          
      <div align="center">
      <div  style="width: 50%" >
         
        <div class="card w-90">
          <div class="card-body">
            <a  href="/documents/{{ $employee->id }}" style="text-decoration: none"> <svg xmlns="http://www.w3.org/2000/svg" width="17" height="17" fill="currentColor" class="bi bi-file-earmark-text" viewBox="0 0 16 16">
              <path d="M5.5 7a.5.5 0 0 0 0 1h5a.5.5 0 0 0 0-1h-5zM5 9.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5zm0 2a.5.5 0 0 1 .5-.5h2a.5.5 0 0 1 0 1h-2a.5.5 0 0 1-.5-.5z"/>
              <path d="M9.5 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V4.5L9.5 0zm0 1v2A1.5 1.5 0 0 0 11 4.5h2V14a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h5.5z"/>
            </svg> La liste des Documents <svg xmlns="http://www.w3.org/2000/svg" width="17" height="17" fill="currentColor" class="bi bi-file-earmark-text" viewBox="0 0 16 16">
              <path d="M5.5 7a.5.5 0 0 0 0 1h5a.5.5 0 0 0 0-1h-5zM5 9.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5zm0 2a.5.5 0 0 1 .5-.5h2a.5.5 0 0 1 0 1h-2a.5.5 0 0 1-.5-.5z"/>
              <path d="M9.5 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V4.5L9.5 0zm0 1v2A1.5 1.5 0 0 0 11 4.5h2V14a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h5.5z"/>
            </svg></a>
            <p class="card-text" style="text-align: left"><strong>email :</strong> {{$employee->email}} .</p>
            <p class="card-text" style="text-align: left"><strong>numéro de téléphone :</strong> {{$employee->telephone}} .</p>
            <p class="card-text" style="text-align: left"><strong>Rôle :</strong> 
              @if($employee->est_admin==1)
              Administrateur
              @else
              Employé
              @endif
              .</p>
              <p class="card-text" style="text-align: left"><strong>Dernier accès au documents :</strong> 
              Le {{
                Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $user->created_at)->format('d/m/Y à H:i')  }}
              .</p>
            
              <p class="card-text" style="text-align: left"><strong>nombre de documents  :</strong> 20 .</p>
          </div>
        </div>
    
            
           
        
    
    
        
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