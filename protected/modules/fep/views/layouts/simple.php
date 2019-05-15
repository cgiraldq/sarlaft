<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php echo Yii::app()->language; ?>" lang="<?php echo Yii::app()->language; ?>">
    <head>
		<meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
        <meta name="HandheldFriendly" content="true">
        <meta http-equiv="Content-Type" content="text/html; charset=<?php echo Yii::app()->charset; ?>" />
        <meta name="language" content="<?php echo Yii::app()->language; ?>" />
		

		<?php 
		
		if(isset($_GET['st']) && $_GET['st'])
			
			Yii::app()->clientScript->registerCssFile(Yii::app()->theme->baseUrl . '/css/formstyle' . $_GET['st'] . '.css');
			
		// if(isset($_GET['st']) && $_GET['st']=='1')
			// Yii::app()->clientScript->registerCssFile(Yii::app()->theme->baseUrl . '/css/formstyle1.css');
		// elseif(isset($_GET['st']) && $_GET['st']=='2')
			// Yii::app()->clientScript->registerCssFile(Yii::app()->theme->baseUrl . '/css/formstyle2.css');
		// elseif(isset($_GET['st']) && $_GET['st']=='3')
			// Yii::app()->clientScript->registerCssFile(Yii::app()->theme->baseUrl . '/css/formstyle3.css');
		// elseif(isset($_GET['st']) && $_GET['st']=='4')
			// Yii::app()->clientScript->registerCssFile(Yii::app()->theme->baseUrl . '/css/formstyle4.css');
		?>
       
		<?php Yii::app()->clientScript->registerCssFile(Yii::app()->theme->baseUrl . '/css/jquery.motionCaptcha.0.2.css?ez_orig=1'); ?>
		<style>
			/* MotionCAPTCHA canvas */
			#mc-canvas {
				margin:0 auto 20px;
				padding:1px;
				display: block;
				border: 2px solid #433e45;
				-webkit-border-radius: 4px;
				   -moz-border-radius: 4px;
						border-radius: 4px;
			}
			/* Red border when invalid */
			#mc-canvas.mc-invalid {
				border: 2px solid #aa4444;
			}
			/* Green border when valid */
			#mc-canvas.mc-valid {
				border: 2px solid #44aa44;
			}
		</style>		

        <?php Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl . '/js/global/jquery.motionCaptcha.0.2.js');?>
        <?php Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl . '/js/global/jquery.form.min.js');?>
        
		<script type="text/javascript">  
			function showComplemento() {
				if(document.getElementById('Formulario_fep_complemento').checked)
					document.getElementById('div_complemento_id').style.display = 'block';
				else
					document.getElementById('div_complemento_id').style.display = 'none'
			}
						
			function addElement() {

			  var ni = document.getElementById('otrasPersonas');
			  var numi = document.getElementById('contador');
			  var num = (document.getElementById('contador').value -1)+ 2;

			  numi.value = num;
			  var newdiv = document.createElement('div');
			  var divIdName = 'my'+num+'Div';

			  newdiv.setAttribute('id',divIdName);
			  newdiv.innerHTML = '<p>Otra persona '+(num+1)+'</p><div class="row"><label for="per_nombre">Nombre completo o Razón Social</label><input type="text" id="per_nombre_'+num+'" name="Persona_formulario[per_nombre_'+num+']" maxlength="255"></div><div class="row"><label for="per_tipo_identificacion_id">Tipo Identificación</label><select id="per_tipo_identificacion_id_'+num+'" name="Persona_formulario[per_tipo_identificacion_id_'+num+']"><option value=""></option><option value="1">Cédula de ciudadanía</option><option value="4">Cédula de Extranjería</option><option value="2">NIT</option><option value="5">Numero de Pasaporte</option><option value="3">RUT</option></select></div><div class="row"><label for="per_identificacion">Número Identificación</label><input type="text" id="per_identificacion_'+num+'" name="Persona_formulario[per_identificacion_'+num+']" maxlength="255"></div><div class="row"><label for="per_descripcion_consulta">Observación</label><textarea id="per_descripcion_consulta_'+num+'" name="Persona_formulario[per_descripcion_consulta_'+num+']"></textarea></div>';
			  /* '<div class="row"><a onclick="addElement();" href="javascript:;">Adicionar otra persona</a></div>' */ /* Enlace para nuevo div */
			  /* '<a href=\'#\' onclick=\'removeElement('+divIdName+')\'>Remove the div "'+divIdName+'"</a>' */ /* Sirve para remover el nuevo div */
			  ni.appendChild(newdiv);

			}			
					
			function removeElement() {

			  var numi = document.getElementById('contador');
			  var num = document.getElementById('contador').value;
			  var d = document.getElementById('otrasPersonas');
			  var olddiv = document.getElementById('my'+num+'Div');
			  d.removeChild(olddiv);
			  numi.value = num-1;

			}

			function validarFechaMenorActual(date){
				  var x=new Date();
				  var fecha = date.split("/");
				  x.setFullYear(fecha[2],fecha[0]-1,fecha[1]);
				  var today = new Date();
			 
				  if (x > today)
					return false;
				  else
					return true;
			}	

function validarFechaMenor(date1,date2){
				  var x=new Date();
				  var y=new Date();
				  var fecha1 = date1.split("/");
				  x.setFullYear(fecha1[2],fecha1[0]-1,fecha1[1]);
				  var fecha2 = date2.split("/");
				  y.setFullYear(fecha2[2],fecha2[0]-1,fecha2[1]);
			 
				  if (x > y)
					return false;
				  else
					return true;
			}			

			function validaFechaOcurrencia() {
				//setInterval("", 3000);
				var fecIni = document.getElementById('Formulario_fep_fecha_declaracion').value;
				
				/*if(!validarFechaMenorActual(fecIni)) {
					alert('La fecha no puede ser superior a la fecha actual');
					document.getElementById('Formulario_fep_fecha_declaracion').value = '';
				}*/
			}

				function validaFechaInicio() {
				//setInterval("", 3000);
				var fecIni = document.getElementById('Formulario_fep_fecha_ini_even').value;
				var fecFin = document.getElementById('Formulario_fep_fecha_fin_even').value;
				
				/*if(!validarFechaMenorActual(fecIni)) {
					alert('La fecha no puede ser superior a la fecha actual');
					document.getElementById('Formulario_fep_fecha_ini_even').value = '';
				}*/
				
				if(!validarFechaMenor(fecIni,fecFin)) {
					alert('La fecha de inicio no puede ser superior a la fecha final');
					document.getElementById('Formulario_fep_fecha_ini_even').value = '';
				}
			}
			
			
				function validaFechaFin() {
				var fecIni = document.getElementById('Formulario_fep_fecha_ini_even').value;
				var fecFin = document.getElementById('Formulario_fep_fecha_fin_even').value;
			
				/*if(!validarFechaMenorActual(fecFin)) {
					alert('La fecha no puede ser superior a la fecha actual');
					document.getElementById('Formulario_fep_fecha_fin_even').value = '';
				}*/
			
				if(!validarFechaMenor(fecIni,fecFin)) {
					alert('La fecha final no puede ser menor a la fecha de inicio');
					document.getElementById('Formulario_fep_fecha_fin_even').value = '';
				}
			}

		</script>
    </head> 
    <body>
	
		<?php 
		/**
		* Subdireccion Aplicaciones Corporativas
		* @author Joan Harriman Navarro M - jnavarrm@asesor.une.com.co
		* @copyright UNE TELECOMUNICACIONES
		*/
		echo '<div class="ci" style="padding: 10px 40px 10px 40px; ">';
			echo '<img src="../../images/header-bg-fep.jpg" border="0" class="img-header" />';
			echo $content;
		echo '</div>';
		?>

    <script type="text/javascript">
        jQuery(document).ready(function($) {
            // Do the biznizz:
            $('#fep-form').motionCaptcha({
                shapes: ['triangle', 'x', 'rectangle', 'circle', 'check', 'zigzag', 'arrow', 'delete', 'pigtail', 'star']
            });

			//$("#submit_form").css("display", "none"); 
			//$("#form_conflicto").css("display", "none"); 
			//$("#msj_nocertifica").css("display", "none"); 

			if($('#sicertifica').is(':checked')){
			   //$("#form_conflicto").css("display", "block");
			   //$("#msj_nocertifica").css("display", "none");
			   $("#form_conflicto").show("slow");
			   $("#msj_nocertifica").hide("slow");
			}
			
			if ($("#nocertifica").is(':checked')){
			   //$("#msj_nocertifica").css("display", "block");
			   //$("#form_conflicto").css("display", "none");
			   $("#msj_nocertifica").show("slow");
			   $("#form_conflicto").hide("slow");
			}

			if($('#sideclara').is(':checked')){
			   //$("#form_tiene_conflicto").css("display", "block");
			   //$("#form_no_tiene_conflicto").css("display", "none");
			   $("#form_tiene_conflicto").show("slow");
			   $("#form_no_tiene_conflicto").hide("slow");
			   $("#submit_form").show("slow");
			}

			if ($("#nodeclara").is(':checked')){
			   //$("#form_no_tiene_conflicto").css("display", "block");
			   //$("#form_tiene_conflicto").css("display", "none");
			   $("#form_no_tiene_conflicto").show("slow");
			   $("#form_tiene_conflicto").hide("slow");
			   $("#submit_form").show("slow");
			}
				
			
		   $("#sicertifica").click(function(){
				if($('#sicertifica').is(':checked')){
				   //$("#form_conflicto").css("display", "block");
				   //$("#msj_nocertifica").css("display", "none");
				   $("#form_conflicto").show("slow");
				   $("#msj_nocertifica").hide("slow");
				}else{
				   //$("#form_conflicto").css("display", "none");
				   $("#form_conflicto").hide("slow");
				} 
		   });
		   
		   $("#nocertifica").click(function(){
				if ($("#nocertifica").is(':checked')){
				   //$("#msj_nocertifica").css("display", "block");
				   //$("#form_conflicto").css("display", "none");
				   $("#msj_nocertifica").show("slow");
				   $("#form_conflicto").hide("slow");
				}else{
				   //$("#msj_nocertifica").css("display", "none");
				   $("#msj_nocertifica").hide("slow");
				} 
		   });

		   
			$("#form_tiene_conflicto").css("display", "none"); 
			$("#form_no_tiene_conflicto").css("display", "none"); 
			
		   $("#sideclara").click(function(){
				if($('#sideclara').is(':checked')){
				   //$("#form_tiene_conflicto").css("display", "block");
				   //$("#form_no_tiene_conflicto").css("display", "none");
				   $("#form_tiene_conflicto").show("slow");
				   $("#form_no_tiene_conflicto").hide("slow");
				   $("#submit_form").show("slow");
				}else{
				   //$("#form_tiene_conflicto").css("display", "none");
				   $("#form_tiene_conflicto").hide("slow");
				} 
		   });
		   
		   $("#nodeclara").click(function(){
				if ($("#nodeclara").is(':checked')){
				   //$("#form_no_tiene_conflicto").css("display", "block");
				   //$("#form_tiene_conflicto").css("display", "none");
				   $("#form_no_tiene_conflicto").show("slow");
				   $("#form_tiene_conflicto").hide("slow");
				   $("#submit_form").show("slow");
				}else{
				   //$("#form_no_tiene_conflicto").css("display", "none");
				   $("#form_no_tiene_conflicto").hide("slow");
				} 
		   });
		   
        });
    </script>
		
	</body>
</html>