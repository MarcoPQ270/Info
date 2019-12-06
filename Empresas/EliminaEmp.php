<?php
include_once("../Utilerias/BaseDatos.php");
$post=$_POST;
//------------en index
$ide = $post['idempresa'];
$est=eliminarEmpresa($ide);
$response = array();
if ($est) {
$response['status']=1;
}else{
    $response['status']=0;
}
echo json_encode($response)
?>

