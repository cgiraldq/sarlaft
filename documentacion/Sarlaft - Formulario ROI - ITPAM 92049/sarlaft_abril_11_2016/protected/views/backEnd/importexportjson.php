<?php $this->pageTitle = Yii::app()->name . ' - Telnet'; ?>

<div class="well_content" style=" margin-top: 40px;">
    <?php
    $this->renderPartial('../comunes/mensajes');
    ?>
    <div class="container-fluid" align="center">
        <div class="row-fluid">                
                    <!-- block -->
                    <div class="block">
                        <div class="block-content collapse in" >
                            <?php
                            $form = $this->beginWidget(
                                    'bootstrap.widgets.TbActiveForm', array(
                                'id' => 'ImportarExportarJsonForm',
                                'htmlOptions' => array('autocomplete' => 'off'), // for inset effect
                                'enableClientValidation' => true,
                                'clientOptions' => array('validateOnSubmit' => true,),
                                    )
                            );
                            ?> 
                            <div class="span12">
                                    <fieldset>
                                        <legend style="text-align: center;"><h3>Importar/Exportar Permisos JSON</h3></legend>                                        
                                        
                                        <div class="row-fluid">
                                            <div class="span8">
                                                <!-- block -->
                                                <div class="block">
                                                        <div class="controls">
                                                            <?php
                                                            echo $form->textAreaRow($model, 'json', array('class' => 'span12'));
                                                            ?>
                                                        </div>                                                    
                                                </div>
                                                <!-- /block -->
                                            </div>
                                                                                    
                                        </div>
                                         <div class="control-group">
                                                <div class="controls">
                                                <?php
                                                $this->widget('bootstrap.widgets.TbButton', array('buttonType' => 'submit',
                                                                                                    'label' => 'Importar',
                                                                                                    'type' => 'danger',
                                                                                                    'size' => 'normal'));
                                                ?>
                                                <?php
                                                $this->widget('bootstrap.widgets.TbButton', array('buttonType' => 'submit',
                                                                                                    'label' => 'Exportar',
                                                                                                    'size' => 'normal'));
                                                ?>
                                                </div>
                                            </div>
                                    </fieldset>
                            <?php $this->endWidget(); ?>
                            </div>
                        </div>
                    </div>
        </div>
    </div> 
    
 <fieldset>

</div>
