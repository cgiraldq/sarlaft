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
       
        <?php Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl . '/js/global/jquery.form.min.js');?>
        
    </head> 
    <body>
	
		<?php 
		/**
		* Subdireccion Aplicaciones Corporativas
		* @author Joan Harriman Navarro M - jnavarrm@asesor.une.com.co
		* @copyright UNE TELECOMUNICACIONES
		*/
		echo '<div style="padding: 10px 40px 10px 40px;" >';
			echo '<img src="images/header-bg-con.png" border="0" class="img-header" />';
			echo $content;
		echo '</div>';
		?>

    <script type="text/javascript">
       
    </script>
		
	</body>
</html>