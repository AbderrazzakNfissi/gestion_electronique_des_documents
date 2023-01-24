function modalOnLoad(){
  $('#exampleModalCenter').modal('show');
}

function deleteEmpOnLoad(){
  $('#deleteEmp').modal('show');
}



function verify(){
    //Les Données Saisies Sont valides, Merci
    //le mot de passe doit être le même
    
  var nv_password =  document.getElementById('nv-pass').value;
  var cf_password =  document.getElementById('cf-pass').value;

  if(nv_password!=cf_password){
    document.getElementById('indication').innerHTML = "le mot de passe doit être le même";
    document.getElementById('iconIndication').innerHTML = '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-exclamation-octagon" viewBox="0 0 16 16">'+
    '<path d="M4.54.146A.5.5 0 0 1 4.893 0h6.214a.5.5 0 0 1 .353.146l4.394 4.394a.5.5 0 0 1 .146.353v6.214a.5.5 0 0 1-.146.353l-4.394 4.394a.5.5 0 0 1-.353.146H4.893a.5.5 0 0 1-.353-.146L.146 11.46A.5.5 0 0 1 0 11.107V4.893a.5.5 0 0 1 .146-.353L4.54.146zM5.1 1 1 5.1v5.8L5.1 15h5.8l4.1-4.1V5.1L10.9 1H5.1z"/>'+
    '<path d="M7.002 11a1 1 0 1 1 2 0 1 1 0 0 1-2 0zM7.1 4.995a.905.905 0 1 1 1.8 0l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 4.995z"/></svg>';
    
    $('#indication').css('color','orange');
    $('#iconIndication').css('color','orange');
  }else if(nv_password==cf_password){
    document.getElementById('indication').innerHTML = "Les Données Saisies Sont valides, Merci";
    document.getElementById('iconIndication').innerHTML = '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-emoji-smile" viewBox="0 0 16 16">'+
    '<path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>'+
    '<path d="M4.285 9.567a.5.5 0 0 1 .683.183A3.498 3.498 0 0 0 8 11.5a3.498 3.498 0 0 0 3.032-1.75.5.5 0 1 1 .866.5A4.498 4.498 0 0 1 8 12.5a4.498 4.498 0 0 1-3.898-2.25.5.5 0 0 1 .183-.683zM7 6.5C7 7.328 6.552 8 6 8s-1-.672-1-1.5S5.448 5 6 5s1 .672 1 1.5zm4 0c0 .828-.448 1.5-1 1.5s-1-.672-1-1.5S9.448 5 10 5s1 .672 1 1.5z"/>'+
    '</svg>';

    $('#iconIndication').css('color','green');
    $('#indication').css('color','green');
  }

}



$(document).ready(function(){
  $('#search').on('keyup',function(){
    var x  = document.getElementById('Rechercher').options[0].selected;
    if(x==true){
      var query= $(this).val();
      $.ajax({
         url:"/searchNbDoc",
         type:"GET",
         data:{'search':query},
         success:function(data){
             $('.nombre-elements').html(data);
         }
     });
    } 
 });
 });


 $(document).ready(function(){
  $('#search').on('keyup',function(){
    var x  = document.getElementById('Rechercher').options[0].selected;
    if(x==true){
      var query= $(this).val();
      $.ajax({
         url:"/searchDoc",
         type:"GET",
         data:{'search':query},
         success:function(data){
          $('.search-list').html(data);
         }
  });
    }
 });
 });



 $(document).ready(function(){
  $('#search').on('keyup',function(){
    var x  = document.getElementById('Rechercher').options[1].selected;
    if(x==true){
      var query= $(this).val();
      $.ajax({
         url:"/searchNbEmp",
         type:"GET",
         data:{'search':query},
         success:function(data){
             $('.nombre-elements').html(data);
         }
  });
    }
 });
 });


 
 $(document).ready(function(){
  $('#search').on('keyup',function(){
    var x  = document.getElementById('Rechercher').options[1].selected;
    if(x==true){
      var query= $(this).val();
      $.ajax({
         url:"/searchEmp",
         type:"GET",
         data:{'search':query},
         success:function(data){
             $('.search-list').html(data);
         }
  });
}
 });
 });




function detailDoc(){
$(document).ready(function(){
  $('.detail').on('click',function(){
    var id = $(this).attr('name');
   
   
      $.ajax({
         url:'/detailDocument',
         type:"GET",
         data:{'id':id},
         success:function(data){
             $('#detailEmployee').html(data);
         }
  });
  $('#detailDocument').modal('show');
 });
 });
}


$(document).ready(function(){
  $('.detail').on('click',function(){
    var id = $(this).attr('name');
   
   
      $.ajax({
         url:'/detailDocument',
         type:"GET",
         data:{'id':id},
         success:function(data){
             $('#detailEmployee').html(data);
         }
  });
  $('#detailDocument').modal('show');
 });
 });



 $(document).ready(function(){
  $('.demande').on('click',function(){
    var ids = $(this).attr('name');
      $.ajax({
         url:'/envoyerDemande',
         type:"GET",
         data:{'ids':ids},
         success:function(data){
                if(data==true){
                  
                  Swal.fire({
                    position: 'top-end',
                    icon: 'success',
                    title: 'demande envoyé avec succès',
                    showConfirmButton: false,
                    timer: 2000
                  })
                 // sleep(2000);
                  setTimeout(() => {
                    location.reload();
                  }, "1500")    
                }     
         }
  });
 });
 });



 $(document).ready(function(){
  $('.annuler').on('click',function(){
    var ids = $(this).attr('name');
      $.ajax({
         url:'/annulerDemande',
         type:"GET",
         data:{'ids':ids},
         success:function(data){
                if(data==true){    
                  Swal.fire({
                    position: 'top-end',
                    icon: 'success',
                    title: 'la demande a été annulé avec succès',
                    showConfirmButton: false,
                    timer: 2000
                  })
                 
                  setTimeout(() => {
                    location.reload();
                  }, "1500")    
                }     
         }
});
});
});

/***********************************  accepter ou refuser une demande ****************************************/

/******************************* Accepter une demande ****************************/
$(document).ready(function(){
  $('.accepter').on('click',function(){
    var demande_id = $(this).attr('name');
      $.ajax({
         url:'/accepterDemande',
         type:"GET",
         data:{'demande_id':demande_id},
         success:function(data){
                if(data==true){    
                 document.getElementById(demande_id).innerHTML = '<div class="alert alert-success" role="alert">'+
                 'demande Accepté'+
                 '</div>';

                 $("#"+demande_id).hide();
                 $("#"+demande_id).show(500);
  
                }     
         }
});
});
});


/************************************ refuser une demande ************************************/

$(document).ready(function(){
  $('.refuser').on('click',function(){
    var demande_id = $(this).attr('name');
      $.ajax({
         url:'/refuserDemande',
         type:"GET",
         data:{'demande_id':demande_id},
         success:function(data){
                if(data==true){    
                  //Afficher un message qui indique que la demande est refusé  
                  document.getElementById(demande_id).innerHTML = '<div class="alert alert-danger" role="alert">'+
                 'demande Refusé'+
                 '</div>';

                 $("#"+demande_id).hide();
                 $("#"+demande_id).show(500);
                }     
         }
});
});
});










