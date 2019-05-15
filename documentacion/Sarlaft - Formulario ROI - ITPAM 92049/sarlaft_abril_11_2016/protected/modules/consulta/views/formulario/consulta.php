<?php
/* @var $this MvcUsersController */
/* @var $model MvcUsers */
if(isset($_SESSION['login_user_consulta'])){	

// $this->breadcrumbs=array(
	// 'Formulario'=>array('index'),
	// 'Create',
// );

// $this->menu=array(
	// array('label'=>'List MvcUsers', 'url'=>array('index')),
	// array('label'=>'Manage MvcUsers', 'url'=>array('admin')),
// );
?>
<style>
table td, table th {
padding: 0px 0px!important;
font-size: 12px;

}

table th {
text-align: center !important;
color: #fff;
background: #002A70 !important;
} 

tr:nth-child(even) { background: #ddd }
tr:nth-child(odd) { background: #fff}

</style>
	<div class="form">

<?php
		$form=$this->beginWidget('CActiveForm', array(
		'id'=>'consulta-form',
		'htmlOptions'=>array('enctype'=>'multipart/form-data'),
		// Please note: When you enable ajax validation, make sure the corresponding
		// controller action is handling ajax validation correctly.
		// There is a call to performAjaxValidation() commented in generated controller code.
		// See class documentation of CActiveForm for details on this.
		'enableAjaxValidation'=>false,
	)); 



	echo '<center><a href="index.php?r=consulta/formulario/create&st=1">Volver</a><br><table  witdth="100%" border="1" cellspacing="1" cellpadding="1" style="border-color: #fff; ">
	<tbody>
	<tr>
	<td   bgcolor="#AB162B" colspan="10"><h3 style="color: #fff;"><center>Resultados de Consulta Sarlaft</center></h3></td>
	
	</tr>
	<tr bgcolor="#002A70"><th>Nombre/ID</th><th>Nombre/ID(Sarlaft)</th><th>Semejanza/Confianza</th><th>Semejanza<br>Nombre/ID</th><th>Fecha</th><th>Lista</th></tr>
	';

	


	foreach ($datos as $fila) {
	for($i=17;$i<=20;$i++){
	if (strpos($fila[$i], '.') ) {
	$fila[$i]=number_format($fila[$i],4,'.','');
	$fila[$i]=($fila[$i])*100;
	$fila[$i]=$fila[$i]."%";
	}elseif($fila[$i]==1){
	$fila[$i]=$fila[$i]."00%";
	}
	}
	echo '<tr style="color: #AB162B !important;"><td>'.$fila[1].'<br>'.$fila[4].'<td>'.$fila[2].'<br>'.$fila[5].'</td><td><b>Semejanza:</b>'.$fila[17].'<br><b>Confianza:</b>'.$fila[18].'</td><td><b>Nombre:</b>'.$fila[19].'<br><b>Identificaci&oacute;n:</b>'.$fila[20].'</td><td width="70px">'.$fila[21].'</td><td width="40px"><b>'.$fila[16].'</b></td>';
		//echo $fila[1].' | '.$fila[3].' | '.$fila[4].' | '.$fila[7].' | '.$fila[9].' | '.$fila[15].' | '.$fila[16].';
		echo '</tr>';
	$id[].=$fila[4];
	}
	//var_dump($id);
		foreach ($datos2 as $fila) {
    if(!in_array($fila[1],$id)){
		echo '<tr style="color: #black !important;"><td>'.$fila[0].'<br>'.$fila[1].'<td>'.$fila[2].'<br>'.$fila[3].'</td><td><b>Semejanza:</b>'.$fila[19].'<br><b>Confianza:</b>'.$fila[20].'</td><td><b>Nombre:</b>'.$fila[21].'<br><b>Identificaci&oacute;n:</b>'.$fila[22].'</td><td width="70px">'.$fila[23].'</td><td width="40px"><b>'.$fila[18].'</b></td>';
		//echo $fila[1].' | '.$fila[3].' | '.$fila[4].' | '.$fila[7].' | '.$fila[9].' | '.$fila[15].' | '.$fila[16].';
		echo '</tr>';
	}

	
	}
echo '	</tbody>
	</table></center>';
	$this->endWidget(); 

?>
</div>
<?php
}else{
 //$this->renderPartial('_form', array('model'=>$model,'model_persona'=>$model_persona,'row_parametros'=>$row_parametros,'env'=>$env,'msj'=>$msj));
//$this->redirect('www.google.com'));
$this->redirect(array('create', 'st'=>'1'));
 //echo "errr";
}
?>