<?php
//Yii::setPathOfAlias('bootstrap', dirname(__FILE__).'/../extensions/bootstrap');
/**
 * Subdireccion Aplicaciones Corporativas
 * @author Joan Harriman Navarro M - jnavarrm@asesor.une.com.co
 * @copyright UNE TELECOMUNICACIONES
 */
/**
  MENUS
 */  
  /* Asi se crea un menu personalizado diferente al de YiiBOOSTER
        if (!empty($modelMenu) && count($modelMenu)) {
            $this->widget('ext.widgets.menus.horizontal.top', array('modelMenu' => $modelMenu, 'htmloptions' => $htmloptions));
        } else {
            $message = 'No se encontraron datos para crear el Menú';
            $this->widget('ext.widgets.stateMessages.Messages', array('message' => $message, 'type' => 'warning'));
        }*/

$modelMenu = Yii::app()->menuManager->getMenu("menu_type='general' or menu_type='administration'");
/**
 * Si se quiere customizar parametros envia el nombre del parametro y su valor Ejemplo array('pagina'=>'link')
 */
        $menu       = Yii::app()->menuManager->build_menu($modelMenu,array('label'=>'name','url'=>'href','icon'=>'icon')); 
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
        <meta name="viewport" content="width=device-width, user-scalable=no"/>
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
        <meta name="HandheldFriendly" content="true">
        <meta http-equiv="Content-Type" content="text/html; charset=<?php echo Yii::app()->charset; ?>" />
        <meta name="language" content="<?php echo Yii::app()->language; ?>" />
        <meta http-equiv="X-Frame-Options" content="SAMEORIGIN">

	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/jquery-ui.custom.css" />
        <?php Yii::app()->clientScript->registerCssFile(Yii::app()->theme->baseUrl . '/css/fonts.css');?>
        <?php Yii::app()->clientScript->registerCssFile(Yii::app()->theme->baseUrl . '/css/template.css');?>
        <?php Yii::app()->clientScript->registerCssFile(Yii::app()->theme->baseUrl . '/css/templateGrid.css');?>
	
	<script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl; ?>/jquery.min.js"></script>	
	<script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl; ?>/jquery-ui.custom.min.js"></script>	
        <?php Yii::app()->clientScript->scriptMap['jquery-ui.css'] = false; ?>
	<?php Yii::app()->clientScript->scriptMap['jquery.min.js'] = false; ?>
	<?php Yii::app()->clientScript->scriptMap['jquery-ui.min.js'] = false; ?>
	<?php Yii::app()->clientScript->scriptMap['jquery.js'] = false; ?>        
	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
        <meta name="keywords" content="proveedores, UNE, EPM, Servicios de Telecomunicaciones, Internet, comunicaciones, tecnologías, Banda Ancha, Movilidad, Internet Móvil, Televisión, Televisión Digital, Televisión Interactiva, Telefonía, Telefonía Móvil, Larga Distancia, Medidor de velocidad, alta velocidad, 4G, 4GLTE, Revolution, speedtest, Paquetes, Correo" />
        <link rel="icon" href="<?php echo Yii::app()->theme->baseUrl; ?>/images/global/favicon.ico" type="image/x-icon" title="PROVEEDORES" />      
</head>
<body>
        <div id="outer-center">
            <div>                                    
                <div style="width: auto">
                    <div class="ui-layout-north" style="z-index: 9;">
                           <header>
                                <div class="centerdiv">
                                  <?php
                                  $this->widget(
                            'bootstrap.widgets.TbNavbar',
                            array(
                                'type' => null, // null or 'inverse'
                                'brand' => SITENAME,
                                'brandUrl' => '?r=FrontEnd',
                                'collapse' => true, // requires bootstrap-responsive.css
                                'fixed' => false,
                                'items' => array(
                                    array(
                                        'class' => 'bootstrap.widgets.TbMenu',
                                        'items' => $menu,
                                    ),
                                ),
                            )
                        );
                                  ?>
                                </div>
                              </header>
                    </div>
                    <section id="top">
                        <div id="title1">&nbsp;</div>
                        <div id="Breadcrumb">
                            <?php if(isset($this->breadcrumbs)){?>
                                <?php 
                                $this->widget('bootstrap.widgets.TbBreadcrumbs', array(
                                        'links'=> $this->breadcrumbs));
                                ?><!-- breadcrumbs -->
                            <?php } ?>
                        </div>
                      </section>
                      <div style="padding-left: 5%; padding-right: 5%; padding-bottom: 3%; padding-top: 3%;">  
                        <?php echo $content; ?>
                      </div>
                    <?php include_once 'footer.php'; ?>
                </div>
            </div>	
        </div>   
    </body>
</html>
