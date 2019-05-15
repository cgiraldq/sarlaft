/**
 * Panel Lateral
 */ 
jQuery(function($) {
    $(document).ready(function() {
        $('#panelHandle').hover(function() {
            $('#sidePanel').stop(true, false).animate({
                'left': '0px'
            }, 300);
        }, function() {
        });
        $('#sidePanel').hover(function() {
            // Nada para hacer
        }, function() {

            $('#sidePanel').animate({
                left: '-201px'
            }, 800);
        });

        /**
         * On/Off botones
         */        
      $('body').attr("class","js");     
      
      $('.checkbox').after(function(){
         if ($(this).is(":checked")) {
           return "<a href='#' class='toggle checked' ref='"+$(this).attr("id")+"'></a>";
         }else{
           return "<a href='#' class='toggle' ref='"+$(this).attr("id")+"'></a>";
         }         
       });
       
      $('.toggle').click(function(e) {
         var checkboxID = $(this).attr("ref");
         var checkbox = $('#'+checkboxID);

         if (checkbox.is(":checked")) {
           checkbox.removeAttr("checked");

         }else{
           checkbox.attr("checked","true");
         }
         $(this).toggleClass("checked");

         e.preventDefault();

      });
        
    });
});
