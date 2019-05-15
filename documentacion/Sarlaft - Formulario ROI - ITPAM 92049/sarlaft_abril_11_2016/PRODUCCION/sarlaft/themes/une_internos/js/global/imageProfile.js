$(function() {
    
    var elemento = $(".fin_menu");
    var posicion = elemento.offset();
    try {
        if (posicion.left < 1000) {
            $("#boton-menu").hide();
        }
    } catch (e) {
        $("#boton-menu").hide();
    }
    
    
    $("#div-name, #verPerfilbtn").click(function() {
        $("#div-foto").slideToggle("fast", function() {
            // Animation complete.
        });
    });

    $(document).on('change', ".uploadFile", function(e) {
        var options = {
            success: ajaxResponseImg,
            type: 'post',
            dataType: 'json',
            beforeSubmit: openLoader
        };

        var form = $("#mvc-users-form");
        form.ajaxForm(options);
        form.submit();

        function ajaxResponseImg(data) {
            
            if (data.error_ext == true) {
                mostrarMensajeError("La extención del archivo no es la permitida para imágenes", 'error');
                cerrarLoader();
            } else if (data.error_size == true) {
                mostrarMensajeError("El tamaño de la imagen es mayor a 500kb", 'error');
                cerrarLoader();
            } else if (data.error == true) {
                mostrarMensajeError("Ocurrió un error al guardar la imagen", 'error');
                cerrarLoader();
            } else {
                $("#img-perfil").html('<img src="index.php?r=mvcUsers/showImage&file='+data.filename+'" width="110px" height="120px" style="display:none"/>');
                setTimeout(function (){
                    $("#img-perfil img").css("display","block");
                    cerrarLoader();
                },1000); 

                $("#img-perfil-load").html('<img src="index.php?r=mvcUsers/showImage&file='+data.filename+'" width="90px" height="100px" style="display:none;float:left"/>');
                setTimeout(function (){
                    $("#img-perfil-load img").css("display","block");
                    cerrarLoader();
                },1000);                
            }
            return false;
        }
    });
    function openLoader(){
        $('.loadImg').css('display','block');
        $("#img-perfil").css('opacity','0.5');
    }
    function cerrarLoader(){
        $('.loadImg').css('display','none');
        $("#img-perfil").css('opacity','1');
    }
    
    
    /******* Fucionalidad scroll menu *******/
    
    $("#btn-right").click(function (){
        var obj = $("#cssmenu ul:first-child");
        var left = obj.css("left");
        left = left.split("px");
        left = left[0];
        left = left - 400;
        if(left < 0) {  
            if(left < -900)
               left = -900;
            obj.animate({
                left: left+"px"
            });            
        } else {
            obj.css("left","0px");
        }
    });
    
    $("#btn-left").click(function (){        
        var obj = $("#cssmenu ul:first-child");
        var left = obj.css("left");
        left = left.split("px");
        left = left[0];        
        left = parseInt(left);
        if(left > 0) { 
            obj.css("left","0px");                        
        } else {
            left = left + 400;
            if(left > 0)
                left = 0;
            obj.animate({
                left: left+"px"
            });
        }
    });
});