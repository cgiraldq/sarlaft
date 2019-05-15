<?php
session_start();
/*$tipo = isset($_REQUEST['t']) ? $_REQUEST['t'] : 'excel';
$extension = '.xls';

if($tipo == 'word') $extension = '.doc';

// Si queremos exportar a PDF
if($tipo == 'pdf'){*/
//require_once '../protected/modules/consulta/views/formulario/pdf.php';
    require_once 'lib/dompdf/dompdf_config.inc.php';
    
   // Obtenemos el código html de la página web que nos interesa
$dompdf = new DOMPDF();
// Creamos una instancia a la clase
$dompdf->load_html($_SESSION["html"]);
$dompdf->set_paper('letter'); //Esta línea es para hacer la página del PDF más grande
$dompdf->render();
$dompdf->stream("consulta".$_SESSION['login_user_consulta']."-".date('Y-m-d-H:i').".pdf");
/*} else{
    require_once 'alumnos.php';
    
    header("Content-type: application/vnd.ms-$tipo");
    header("Content-Disposition: attachment; filename=mi_archivo$extension");
    header("Pragma: no-cache");
    header("Expires: 0");    
}*/