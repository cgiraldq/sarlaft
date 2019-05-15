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



	 echo '<center><p><a href="export/output.php"><img src="images/pdf.png" width="50px"></a></p>
	<a href="index.php?r=consulta/formulario/create&st=1"><img src="images/volver.gif" ></a><br>';
	
	$html='<table  witdth="100%"  cellspacing="1" cellpadding="1" style="border-color: black; margin: 0 auto;	 ">
	<tbody>
	<tr>
	<td   bgcolor="#00C6F4" colspan="6"><h3 style="color: #fff;"><center>Resultados de Consulta Sarlaft</center></h3></td>
	
	</tr>
	<tr   style="color: #fff;"><td bgcolor="#002A70">Nombre/ID</td><td bgcolor="#002A70">Nombre/ID(Sarlaft)</td><td bgcolor="#002A70">Semejanza/Confianza</td><td bgcolor="#002A70">Semejanza<br>Nombre/ID</td><td bgcolor="#002A70">Fecha</td><td bgcolor="#002A70">Lista</td></tr>
	';

	
//var_dump($datos2);die;


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
	$fecha=$fila[21];
	$html.= '<tr style="color: #AB162B;"><td>'.$fila[1].'<br>'.$fila[4].'</td><td>'.$fila[2].'<br>'.$fila[5].'</td><td><b>Semejanza:</b>'.$fila[17].'<br><b>Confianza:</b>'.$fila[18].'</td><td><b>Nombre:</b>'.$fila[19].'<br><b>ID:</b>'.$fila[20].'</td><td width="50px">'.$fecha.'</td><td width="40px"><b>'.$fila[16].'</b></td>';
		//echo $fila[1].' | '.$fila[3].' | '.$fila[4].' | '.$fila[7].' | '.$fila[9].' | '.$fila[15].' | '.$fila[16].';
		$html.='</tr>';
	$id[].=$fila[4];
	}
	//var_dump($id);
		foreach ($datos2 as $fila) {
    
		$html.= '<tr style="color: black !important;"><td>'.$fila[0].'<br>'.$fila[1].'<td>'.$fila[2].'<br>'.$fila[3].'</td><td><b>Semejanza: </b>'.$fila[19].'<br><b>Confianza:  </b>'.$fila[20].'</td><td><b>Nombre:  </b>'.$fila[21].'<br><b>ID:  </b>'.$fila[22].'</td><td width="70px">'.date('Y-m-d').'</td><td width="40px"><b>'.$fila[18].'</b></td>';
		//echo $fila[1].' | '.$fila[3].' | '.$fila[4].' | '.$fila[7].' | '.$fila[9].' | '.$fila[15].' | '.$fila[16].';
		$html.= '</tr>';
	

	
	}
$html.= '	</tbody>
	</table></center>';
	$_SESSION["html"]=$html;
	echo $html;
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