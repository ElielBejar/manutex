$(document).ready(function(){
     let activo = false;
     
     $(".menu_responsive").click(function(){
         if(activo == false){
             $(".nav_responsive").animate({
                 left:'0'
             });
             activo = true;
         }else{
            $(".nav_responsive").animate({
                left:'-100%'
            });
             activo = false;
         }
     });
});