@extends('layouts.navbar')


@section('content')

    
    
    
    
    <div class="card text-center" style="width: 77%">
      <div class="card-header" class="nombre-elements" style="text-align: center;">
        <a href="/compte" style="text-decoration: none;"><strong>
          <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-arrow-return-right" viewBox="0 0 16 16">
            <path fill-rule="evenodd" d="M1.5 1.5A.5.5 0 0 0 1 2v4.8a2.5 2.5 0 0 0 2.5 2.5h9.793l-3.347 3.346a.5.5 0 0 0 .708.708l4.2-4.2a.5.5 0 0 0 0-.708l-4-4a.5.5 0 0 0-.708.708L13.293 8.3H3.5A1.5 1.5 0 0 1 2 6.8V2a.5.5 0 0 0-.5-.5z"/>
          </svg> 
          {{ $entreprise->nom }} / </strong></a>
      </div>
      <div class="card-body">
        
       <!-- -------------  Partie Dynamique ------------------>
      
       <div class="card text-center">
        
        <div class="card-body search-list">
          <span id="indication" style="color:orange"> </span>
              <span style="color:orange" id="iconIndication">
                
              </span> 
          <h5 class="card-title">{{$entreprise->nom}}</h5>
          
             
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

    <form method="POST" action="{{ route('updateEntreprise') }}">
      @csrf
      <div align="center"> 
      <div  style="width: 50%" >
          <div class="input-group mb-3">
            
            <input type="text" class="form-control" name="nom"  aria-label="Entreprise_name" aria-describedby="basic-addon1" value="{{$entreprise->nom}}" @if($user->est_admin==0) disabled @endif>
            
            <div class="input-group-prepend">
              <span class="input-group-text" id="basic-addon1">nom</span>
            </div>
          </div>
    
          <div class="input-group mb-3">
            
            <input type="text" class="form-control" name="telephone"  aria-label="Entreprise_name" aria-describedby="basic-addon1" value="{{$entreprise->telephone}}" @if($user->est_admin==0) disabled @endif>
            <div class="input-group-prepend">
              <span class="input-group-text" id="basic-addon1">téléphone</span>
            </div>
          </div>
    
    
          <div class="input-group mb-3">
            
            <input type="text" class="form-control" name="email" aria-label="Entreprise_name" aria-describedby="basic-addon1" value="{{$entreprise->email}}" @if($user->est_admin==0) disabled @endif>
            <div class="input-group-prepend">
              <span class="input-group-text" id="basic-addon1">Email</span>
            </div>
          </div>
    
           
          <div class="input-group mb-3">
            
            <select class="custom-select" name="pays" id="inputGroupSelect02" @if($user->est_admin==0) disabled @endif>
              
              <option value="{{$entreprise->pays}}" selected>{{$entreprise->pays}}</option>
              <option value="France" >France </option>
              <option value="Afghanistan">Afghanistan </option>
              <option value="Afrique_Centrale">Afrique_Centrale </option>
              <option value="Afrique_du_sud">Afrique_du_Sud </option>
              <option value="Albanie">Albanie </option>
              <option value="Algerie">Algerie </option>
              <option value="Allemagne">Allemagne </option>
              <option value="Andorre">Andorre </option>
              <option value="Angola">Angola </option>
              <option value="Anguilla">Anguilla </option>
              <option value="Arabie_Saoudite">Arabie_Saoudite </option>
              <option value="Argentine">Argentine </option>
              <option value="Armenie">Armenie </option>
              <option value="Australie">Australie </option>
              <option value="Autriche">Autriche </option>
              <option value="Azerbaidjan">Azerbaidjan </option>
              
              <option value="Bahamas">Bahamas </option>
              <option value="Bangladesh">Bangladesh </option>
              <option value="Barbade">Barbade </option>
              <option value="Bahrein">Bahrein </option>
              <option value="Belgique">Belgique </option>
              <option value="Belize">Belize </option>
              <option value="Benin">Benin </option>
              <option value="Bermudes">Bermudes </option>
              <option value="Bielorussie">Bielorussie </option>
              <option value="Bolivie">Bolivie </option>
              <option value="Botswana">Botswana </option>
              <option value="Bhoutan">Bhoutan </option>
              <option value="Boznie_Herzegovine">Boznie_Herzegovine </option>
              <option value="Bresil">Bresil </option>
              <option value="Brunei">Brunei </option>
              <option value="Bulgarie">Bulgarie </option>
              <option value="Burkina_Faso">Burkina_Faso </option>
              <option value="Burundi">Burundi </option>
              
              <option value="Caiman">Caiman </option>
              <option value="Cambodge">Cambodge </option>
              <option value="Cameroun">Cameroun </option>
              <option value="Canada">Canada </option>
              <option value="Canaries">Canaries </option>
              <option value="Cap_vert">Cap_Vert </option>
              <option value="Chili">Chili </option>
              <option value="Chine">Chine </option>
              <option value="Chypre">Chypre </option>
              <option value="Colombie">Colombie </option>
              <option value="Comores">Colombie </option>
              <option value="Congo">Congo </option>
              <option value="Congo_democratique">Congo_democratique </option>
              <option value="Cook">Cook </option>
              <option value="Coree_du_Nord">Coree_du_Nord </option>
              <option value="Coree_du_Sud">Coree_du_Sud </option>
              <option value="Costa_Rica">Costa_Rica </option>
              <option value="Cote_d_Ivoire">Côte_d_Ivoire </option>
              <option value="Croatie">Croatie </option>
              <option value="Cuba">Cuba </option>
              
              <option value="Danemark">Danemark </option>
              <option value="Djibouti">Djibouti </option>
              <option value="Dominique">Dominique </option>
              
              <option value="Egypte">Egypte </option>
              <option value="Emirats_Arabes_Unis">Emirats_Arabes_Unis </option>
              <option value="Equateur">Equateur </option>
              <option value="Erythree">Erythree </option>
              <option value="Espagne">Espagne </option>
              <option value="Estonie">Estonie </option>
              <option value="Etats_Unis">Etats_Unis </option>
              <option value="Ethiopie">Ethiopie </option>
              
              <option value="Falkland">Falkland </option>
              <option value="Feroe">Feroe </option>
              <option value="Fidji">Fidji </option>
              <option value="Finlande">Finlande </option>
              <option value="France">France </option>
              
              <option value="Gabon">Gabon </option>
              <option value="Gambie">Gambie </option>
              <option value="Georgie">Georgie </option>
              <option value="Ghana">Ghana </option>
              <option value="Gibraltar">Gibraltar </option>
              <option value="Grece">Grece </option>
              <option value="Grenade">Grenade </option>
              <option value="Groenland">Groenland </option>
              <option value="Guadeloupe">Guadeloupe </option>
              <option value="Guam">Guam </option>
              <option value="Guatemala">Guatemala</option>
              <option value="Guernesey">Guernesey </option>
              <option value="Guinee">Guinee </option>
              <option value="Guinee_Bissau">Guinee_Bissau </option>
              <option value="Guinee equatoriale">Guinee_Equatoriale </option>
              <option value="Guyana">Guyana </option>
              <option value="Guyane_Francaise ">Guyane_Francaise </option>
              
              <option value="Haiti">Haiti </option>
              <option value="Hawaii">Hawaii </option>
              <option value="Honduras">Honduras </option>
              <option value="Hong_Kong">Hong_Kong </option>
              <option value="Hongrie">Hongrie </option>
              
              <option value="Inde">Inde </option>
              <option value="Indonesie">Indonesie </option>
              <option value="Iran">Iran </option>
              <option value="Iraq">Iraq </option>
              <option value="Irlande">Irlande </option>
              <option value="Islande">Islande </option>
              <option value="Israel">Israel </option>
              <option value="Italie">italie </option>
              
              <option value="Jamaique">Jamaique </option>
              <option value="Jan Mayen">Jan Mayen </option>
              <option value="Japon">Japon </option>
              <option value="Jersey">Jersey </option>
              <option value="Jordanie">Jordanie </option>
              
              <option value="Kazakhstan">Kazakhstan </option>
              <option value="Kenya">Kenya </option>
              <option value="Kirghizstan">Kirghizistan </option>
              <option value="Kiribati">Kiribati </option>
              <option value="Koweit">Koweit </option>
              
              <option value="Laos">Laos </option>
              <option value="Lesotho">Lesotho </option>
              <option value="Lettonie">Lettonie </option>
              <option value="Liban">Liban </option>
              <option value="Liberia">Liberia </option>
              <option value="Liechtenstein">Liechtenstein </option>
              <option value="Lituanie">Lituanie </option>
              <option value="Luxembourg">Luxembourg </option>
              <option value="Lybie">Lybie </option>
              
              <option value="Macao">Macao </option>
              <option value="Macedoine">Macedoine </option>
              <option value="Madagascar">Madagascar </option>
              <option value="Madère">Madère </option>
              <option value="Malaisie">Malaisie </option>
              <option value="Malawi">Malawi </option>
              <option value="Maldives">Maldives </option>
              <option value="Mali">Mali </option>
              <option value="Malte">Malte </option>
              <option value="Man">Man </option>
              <option value="Mariannes du Nord">Mariannes du Nord </option>
              <option value="Maroc">Maroc </option>
              <option value="Marshall">Marshall </option>
              <option value="Martinique">Martinique </option>
              <option value="Maurice">Maurice </option>
              <option value="Mauritanie">Mauritanie </option>
              <option value="Mayotte">Mayotte </option>
              <option value="Mexique">Mexique </option>
              <option value="Micronesie">Micronesie </option>
              <option value="Midway">Midway </option>
              <option value="Moldavie">Moldavie </option>
              <option value="Monaco">Monaco </option>
              <option value="Mongolie">Mongolie </option>
              <option value="Montserrat">Montserrat </option>
              <option value="Mozambique">Mozambique </option>
              
              <option value="Namibie">Namibie </option>
              <option value="Nauru">Nauru </option>
              <option value="Nepal">Nepal </option>
              <option value="Nicaragua">Nicaragua </option>
              <option value="Niger">Niger </option>
              <option value="Nigeria">Nigeria </option>
              <option value="Niue">Niue </option>
              <option value="Norfolk">Norfolk </option>
              <option value="Norvege">Norvege </option>
              <option value="Nouvelle_Caledonie">Nouvelle_Caledonie </option>
              <option value="Nouvelle_Zelande">Nouvelle_Zelande </option>
              
              <option value="Oman">Oman </option>
              <option value="Ouganda">Ouganda </option>
              <option value="Ouzbekistan">Ouzbekistan </option>
              
              <option value="Pakistan">Pakistan </option>
              <option value="Palau">Palau </option>
              <option value="Palestine">Palestine </option>
              <option value="Panama">Panama </option>
              <option value="Papouasie_Nouvelle_Guinee">Papouasie_Nouvelle_Guinee </option>
              <option value="Paraguay">Paraguay </option>
              <option value="Pays_Bas">Pays_Bas </option>
              <option value="Perou">Perou </option>
              <option value="Philippines">Philippines </option>
              <option value="Pologne">Pologne </option>
              <option value="Polynesie">Polynesie </option>
              <option value="Porto_Rico">Porto_Rico </option>
              <option value="Portugal">Portugal </option>
              
              <option value="Qatar">Qatar </option>
              
              <option value="Republique_Dominicaine">Republique_Dominicaine </option>
              <option value="Republique_Tcheque">Republique_Tcheque </option>
              <option value="Reunion">Reunion </option>
              <option value="Roumanie">Roumanie </option>
              <option value="Royaume_Uni">Royaume_Uni </option>
              <option value="Russie">Russie </option>
              <option value="Rwanda">Rwanda </option>
              
              <option value="Sahara Occidental">Sahara Occidental </option>
              <option value="Sainte_Lucie">Sainte_Lucie </option>
              <option value="Saint_Marin">Saint_Marin </option>
              <option value="Salomon">Salomon </option>
              <option value="Salvador">Salvador </option>
              <option value="Samoa_Occidentales">Samoa_Occidentales</option>
              <option value="Samoa_Americaine">Samoa_Americaine </option>
              <option value="Sao_Tome_et_Principe">Sao_Tome_et_Principe </option>
              <option value="Senegal">Senegal </option>
              <option value="Seychelles">Seychelles </option>
              <option value="Sierra Leone">Sierra Leone </option>
              <option value="Singapour">Singapour </option>
              <option value="Slovaquie">Slovaquie </option>
              <option value="Slovenie">Slovenie</option>
              <option value="Somalie">Somalie </option>
              <option value="Soudan">Soudan </option>
              <option value="Sri_Lanka">Sri_Lanka </option>
              <option value="Suede">Suede </option>
              <option value="Suisse">Suisse </option>
              <option value="Surinam">Surinam </option>
              <option value="Swaziland">Swaziland </option>
              <option value="Syrie">Syrie </option>
              
              <option value="Tadjikistan">Tadjikistan </option>
              <option value="Taiwan">Taiwan </option>
              <option value="Tonga">Tonga </option>
              <option value="Tanzanie">Tanzanie </option>
              <option value="Tchad">Tchad </option>
              <option value="Thailande">Thailande </option>
              <option value="Tibet">Tibet </option>
              <option value="Timor_Oriental">Timor_Oriental </option>
              <option value="Togo">Togo </option>
              <option value="Trinite_et_Tobago">Trinite_et_Tobago </option>
              <option value="Tristan da cunha">Tristan de cuncha </option>
              <option value="Tunisie">Tunisie </option>
              <option value="Turkmenistan">Turmenistan </option>
              <option value="Turquie">Turquie </option>
              
              <option value="Ukraine">Ukraine </option>
              <option value="Uruguay">Uruguay </option>
              
              <option value="Vanuatu">Vanuatu </option>
              <option value="Vatican">Vatican </option>
              <option value="Venezuela">Venezuela </option>
              <option value="Vierges_Americaines">Vierges_Americaines </option>
              <option value="Vierges_Britanniques">Vierges_Britanniques </option>
              <option value="Vietnam">Vietnam </option>
              
              <option value="Wake">Wake </option>
              <option value="Wallis et Futuma">Wallis et Futuma </option>
              
              <option value="Yemen">Yemen </option>
              <option value="Yougoslavie">Yougoslavie </option>
              
              <option value="Zambie">Zambie </option>
              <option value="Zimbabwe">Zimbabwe </option>
              
            </select>
    
            <div class="input-group-prepend">
              <label class="input-group-text" for="inputGroupSelect02">Pays </label>
            </div>
          </div>
    
    
    
          <div class="input-group mb-3">


              
            <select class="custom-select" name="industrie" id="inputGroupSelect02" name="industrie"  :value="old('industrie')" required @if($user->est_admin==0) disabled @endif placeholder="Industrie">
              <option value="{{$entreprise->industrie}}" selected>{{$entreprise->industrie}}</option>
              <option value="Services informatiques">Services informatiques</option>
              <option value="Activités à but non lucratif">Activités à but non lucratif</option>
              <option value="Architecture">Architecture</option>
              <option value="Assurances">Assurances</option>
              <option value="Commerce de détail">Commerce de détail</option>
              <option value="Comptabilité">Comptabilité</option>
              <option value="Conseil">Conseil</option>
              <option value="Construction">Construction</option>
              <option value="Education">Education</option>
              <option value="Energie &amp; Services publics">Energie &amp; Services publics</option>
              <option value="Engineering">Engineering</option>
              <option value="Fabrication">Fabrication</option>
              <option value="Finance">Finance</option>
              <option value="Gouvernement">Gouvernement</option>
              <option value="Immobilier">Immobilier</option>
              <option value="Marketing">Marketing</option>
              <option value="Santé">Santé</option>
              <option value="Sciences de la vie">Sciences de la vie</option>
              <option value="Transport &amp; Logistique">Transport &amp; Logistique</option>
              <option value="Autre">Autre</option>
              </select>    
            
            
            <div class="input-group-prepend">
              <label class="input-group-text" for="inputGroupSelect02">Industrie</label>
            </div>
          </div>
    
    
    
          <div class="input-group mb-3">
           
            <input type="password" name="AncienPassword" class="form-control" @if($user->est_admin==0) disabled @endif  aria-label="Entreprise_name" aria-describedby="basic-addon1" >
            <div class="input-group-prepend">
              <span class="input-group-text" id="basic-addon1">Ancien mot de passe</span>
            </div>
          </div>
    
    
          <div class="input-group mb-3">
            
            <input type="password" class="form-control" id="nv-pass" name="newPassword"  aria-label="Entreprise_name" aria-describedby="basic-addon1" @if($user->est_admin==0) disabled @endif >
            <div class="input-group-prepend">
              <span class="input-group-text"  id="basic-addon1">Nouveau mot de passe</span>
            </div>
          </div>
    
    
          <div class="input-group mb-3">
            
            <input type="password" id="cf-pass" class="form-control" onkeyup="verify();"  name="confPassword"   aria-label="Entreprise_name" aria-describedby="basic-addon1" @if($user->est_admin==0) disabled @endif >
            <div class="input-group-prepend">
              <span class="input-group-text" id="basic-addon1">Confirmez le mot de passe</span>
            </div>
          </div>
    
    
          
    
    
    
          
    
    
          <button class="btn btn-primary" @if($user->est_admin==0) disabled @endif>Annuler</button>
          <button type="submit" class="btn btn-success" @if($user->est_admin==0) disabled @endif>Enregistrer</button>
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