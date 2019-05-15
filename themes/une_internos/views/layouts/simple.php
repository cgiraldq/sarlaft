<div id="Breadcrumb">
            <?php if(isset($this->breadcrumbs)){?>
                                <?php 
                                $this->widget('bootstrap.widgets.TbBreadcrumbs', array(
                                        'links'=> $this->breadcrumbs));
                                ?><!-- breadcrumbs -->
                            <?php } ?>
            </div> 
<?php 
/**
* Subdireccion Aplicaciones Corporativas
* @author Joan Harriman Navarro M - jnavarrm@asesor.une.com.co
* @copyright UNE TELECOMUNICACIONES
*/

echo $content;
 ?>
