<?php
include_once("../Utilerias/BaseDatos.php");
$post=$_POST;
//------------en index  
$ide = $post['idempresa'];
$namee = $post['nomempresa'];
$adde = $post['dirempresa'];
$maile = $post['corrempresa'];
$descripe = $post['descripempresa'];
$est=guardaEmpresa($ide,$namee,$adde,$maile,$descripe);
$response = array();
if ($est) {
$response['status']=1;
}else{
    $response['status']=0;
}
echo json_encode($response)
?>

