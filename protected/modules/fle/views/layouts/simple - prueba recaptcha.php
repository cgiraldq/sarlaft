<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php echo Yii::app()->language; ?>" lang="<?php echo Yii::app()->language; ?>">
    <head>
        <meta name="viewport" content="width=device-width, user-scalable=no"/>
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
        <meta name="HandheldFriendly" content="true">
        <meta http-equiv="Content-Type" content="text/html; charset=<?php echo Yii::app()->charset; ?>" />
        <meta name="language" content="<?php echo Yii::app()->language; ?>" />

		<?php 
		if(isset($_GET['st']) && $_GET['st']=='1')
			Yii::app()->clientScript->registerCssFile(Yii::app()->theme->baseUrl . '/css/formstyle1.css');
		elseif(isset($_GET['st']) && $_GET['st']=='2')
			Yii::app()->clientScript->registerCssFile(Yii::app()->theme->baseUrl . '/css/formstyle2.css');
		elseif(isset($_GET['st']) && $_GET['st']=='3')
			Yii::app()->clientScript->registerCssFile(Yii::app()->theme->baseUrl . '/css/formstyle3.css');
		elseif(isset($_GET['st']) && $_GET['st']=='4')
			Yii::app()->clientScript->registerCssFile(Yii::app()->theme->baseUrl . '/css/formstyle4.css');
		?>
       
        <?php Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl . '/js/global/jquery.form.min.js');?>
        
		<script type="text/javascript">  
			function showComplemento() {
				if(document.getElementById('Formulario_fle_complemento').checked)
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

			function validaFechaOcurrencia() {
				//setInterval("", 3000);
				var fecIni = document.getElementById('Formulario_fle_fecha_ocurrencia').value;
				
				if(!validarFechaMenorActual(fecIni)) {
					alert('La fecha no puede ser superior a la fecha actual');
					document.getElementById('Formulario_fle_fecha_ocurrencia').value = '';
				}
			}

		</script>
		
		<script src='https://www.google.com/recaptcha/api.js'></script>
		
    </head> 
    <body>
	
		<?php 
		/**
		* Subdireccion Aplicaciones Corporativas
		* @author Joan Harriman Navarro M - jnavarrm@asesor.une.com.co
		* @copyright UNE TELECOMUNICACIONES
		*/
		echo '<div style="padding: 20px 40px 20px 40px;">';
			echo $content;
		echo '</div>';
		?>

    <script type="text/javascript">
        jQuery(document).ready(function($) {
            // Do the biznizz:
            $('#fle-form').motionCaptcha({
                shapes: ['triangle', 'x', 'rectangle', 'circle', 'check', 'zigzag', 'arrow', 'delete', 'pigtail', 'star']
            });

        });
    </script>
		
	</body>
</html>