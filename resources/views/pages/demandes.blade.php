@extends('layouts.navbar')


@section('content')

    
    
   @if(isset($responseDemande) && Auth::user()->est_admin==0)
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
    <div class="card-body">
      
     <!-- -------------  Partie Dynamique ------------------>
       
     <div class="card">
      
      <div class="card-body search-list">
        <h6 class="card-title" style="background-color: #f7f4f4;color:rgb(0, 0, 0);padding:13px"> 
        Vos demandes d'accès
        </h6>

        
       

          
         <!-------------------------------------------- Demande     ----------------------------->
        <div class="card w-80">
         
           
                 
              @foreach($responseDemande as $demande)


              @if($demande->etat==1)
                <div class="alert alert-primary" role="alert">
                
                  @foreach ($users->where('est_admin',1)->toArray() as $key=>$value)
                 
                  <a  href="/details/{{$value->id}}" style="text-decoration: none;">
                  <img class="card-img-top" src="{{asset($value->logo_path)}}" style="width: 40px;" alt="user image" id="user-img">
                
                  {{$value->nom}}
                  </a>
                  @endforeach
                  a accepté votre demande d'accéder a 
                  @foreach ($documents->where('id',$demande->document_id)->toArray() as $key=>$document_value)
               
                  <a href="#" style="text-decoration: none" title="voire plus" class="detail" name="{{$document_value->id}}">
                    
                    {{$document_value->nom}}
                  </a>
                  @endforeach  
                  
                </div>
              @elseif($demande->etat==2)
              <div class="alert alert-warning" role="alert">
                
                @foreach ($users->where('est_admin',1)->toArray() as $key=>$value)
                <a  href="/details/{{$value->id}}" style="text-decoration: none;">
                  <img class="card-img-top" src="{{asset($value->logo_path)}}" style="width: 40px;" alt="user image" id="user-img">
                 
                {{$value->nom}}
                </a>
                @endforeach
                a refusé votre demande d'accéder a 
                @foreach ($documents->where('id',$demande->document_id)->toArray() as $key=>$document_value)
             
                <a href="#" style="text-decoration: none" title="voire plus" class="detail" name="{{$document_value->id}}">
                  {{$document_value->nom}}
                </a>
                @endforeach  
                
              </div>

              @endif
               
               
                @endforeach
                  
            

            {{ $responseDemande->links('pagination::bootstrap-4') }}
          
          </div>
         

         

         
        
          <!-------------------------------------------- Fin Demande     ----------------------------->
       
      </div>
    </div>

    
     <!--------------------Fin Partie Dynamique ------------>
    </div>
  
   
  </div>

  </div>
 


   @else
    
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
      <div class="card-body">
        
       <!-- -------------  Partie Dynamique ------------------>
         
       
        
        <div class="card-body search-list">
          <h6 class="card-title" style="background-color: #f7f4f4;color:rgb(0, 0, 0);padding:13px"> 
          Demandes d'accès
          </h6>

          @php  
             $nb_demandes = 0;
          @endphp
          @isset($demandes)
         
          @if(Auth::user()->est_admin==1)
          
          @foreach ($demandes as $demande)
           
            @if($demande->etat==0)
            @php  
            $nb_demandes++;
            @endphp
           <!-------------------------------------------- Demande     ----------------------------->
          <div class="card w-80">
            <div class="card-body"  id="{{$demande->id}}">
             

                <div style="float: left">
                <a href="/details/{{$demande->emetteur_id}}" style="text-decoration: none;">
               
                
                    @foreach ($users->where('id',$demande->emetteur_id)->toArray() as $key=>$value)
                    <img class="card-img-top" src="{{asset($value->logo_path)}}" style="width: 40px;" alt="user image" id="user-img">
                     {{$value->nom}}
                     @endforeach
              </a> demande l'accès à 
              
                @foreach ($documents->where('id',$demande->document_id)->toArray() as $key=>$document_value)
               
                <a href="#" style="text-decoration: none" title="voire plus" class="detail" name="{{$document_value->id}}">
                  {{$document_value->nom}}
                </a>
              
                
                </div>
                  
                  <div style="float: right">
                    
                      <button type="button" class="btn btn-success accepter" name="{{$demande->id}}">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check2" viewBox="0 0 16 16">
                            <path d="M13.854 3.646a.5.5 0 0 1 0 .708l-7 7a.5.5 0 0 1-.708 0l-3.5-3.5a.5.5 0 1 1 .708-.708L6.5 10.293l6.646-6.647a.5.5 0 0 1 .708 0z"/>
                          </svg>
                           accepter
                      </button>
                    

                     
                     
                      <button type="button" class="btn btn-danger refuser" name="{{$demande->id}}">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-octagon-fill" viewBox="0 0 16 16">
                            <path d="M11.46.146A.5.5 0 0 0 11.107 0H4.893a.5.5 0 0 0-.353.146L.146 4.54A.5.5 0 0 0 0 4.893v6.214a.5.5 0 0 0 .146.353l4.394 4.394a.5.5 0 0 0 .353.146h6.214a.5.5 0 0 0 .353-.146l4.394-4.394a.5.5 0 0 0 .146-.353V4.893a.5.5 0 0 0-.146-.353L11.46.146zm-6.106 4.5L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 1 1 .708-.708z"/>
                          </svg>
                            refuser
                     </button>
                    
                
                    </div>
                
                  @endforeach
              </div>
            
            </div>
            @endif
            @endforeach
            
           

            @if($nb_demandes==0)
            <div class="alert alert-secondary" role="alert">
              Aucune demandes
            </div>
            @endif

            @endif
           
            
           @endisset
            <!-------------------------------------------- Fin Demande     ----------------------------->
         
        </div>
      
      <br>
      
       <!--------------------Fin Partie Dynamique ------------>
      </div>
      
        <div align="center">
        {{ $demandes->links('pagination::bootstrap-4') }}
         </div>
     
    </div>

    </div>
    @endif
      <!-- Optional JavaScript -->
      <!-- jQuery first, then Popper.js, then Bootstrap JS -->
     
      <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    </body>
    
    </html>


@endSection