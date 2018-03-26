    
$(document).ready(function(){
    
    //editor  CKEditor 5 builds
    ClassicEditor
    .create( document.querySelector( '#body' ) )
    .catch( error => {
        console.error( error );
    } );
    
    
    $('#selectAllBoxes').click(function(event){
        
        if(this.checked){
            $('.checkBoxes').each(function(){
               this.checked = true; 
            });
        } else {
            $('.checkBoxes').each(function(){
               this.checked = false; 
            });
        }
    });
    
   
    
   // var div_box = "<div id='load-screen'><div id='loading'></div></div>";
   
   // $(document.body).prepend(div_box);
   
   // $('#load-screen').delay(700).fadeOut(600, function(){
   //     $(this).remove();
   // });
    
});


// AJAH users online

function loadUsersOnline(){

  $.get("functions.php?onlineusers=result", function(data){

    $(".usersonline").text(data);

  });

}

setInterval(function(){ loadUsersOnline(); }, 500);    // 500 miliseconds  =  1/2 second



 






