<?php
/**
 * DashModule class file.
 *
 * @author Joan Harriman Navarro M
 * @license Lesser GPL License
 * @version 1.0
 */

/**
 * Roiation:
 *
 * Configuration:
 *
 * <pre>
 * return array(
 *    ...
 *    'modules' => array(
 *       ...
 *      'Roi',
 *    ),
 * );
 * </pre>
 *
 * Usage:
 *    To view simple visit 'massdataupload' 
 */

class RoiModule extends CWebModule
{
  /**
   * @property string Default module controller
   */
  public $defaultController = 'Formulario';

  /**
   * @property string Path to assets folder
   */
  public $assetsFolder = '';

  public function init()
  {
    $this->setImport(array(
      'roi.models.*',
      'roi.components.events.*',
      'roi.particularFunctions.particularFunction',
    ));  
	
	 $this->configure(array(
            'preload'=>array('bootstrap'),
             'components'=>array(
                'bootstrap'=>array(
                    'class'=>'application.extensions.yiibooster.components.Bootstrap'
                ),
            ),
    ));  
     
    //$this->setComponent('Roievents', new eventManager());    
    //$this->preloadComponents();

    define('UPLOADFILEPATH', '/archivos/tmp/');
    define('TABLE_PREFIX','tbl_');
    define('CODEMAIL','f8eaf860ef6bf14b6a52fdf35a5190fd');   // cambiar con el codigo de sarlaf en mailing
    define('MAILSETLOCATION','http://unevm-pmap.une.net.co/wsMailing/wsMailing.php');
	
    $this->assetsFolder = Yii::app()->assetManager->publish(
      Yii::getPathOfAlias('application.modules.roi.assets')
    );
   # Yii::app()->clientScript->registerCssFile($this->assetsFolder .'/css/style.css');	
    parent::init();
  }
}
