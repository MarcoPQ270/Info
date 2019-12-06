<?php
include_once("../Utilerias/BaseDatos.php");
$post=$_POST;
$ide = $post['idempresa'];
$est=cargaEmpresa($ide);
$response = array();
if ($est) {
$response['status']=1;
foreach ($est as $tupla) {
    //----------en index------------en BD---------
    $response['idempresa']=$tupla['idempresa'];
    $response['nomempresa']=$tupla['nameempresa'];
    $response['dirempresa']=$tupla['addresempresa'];
    $response['corrempresa']=$tupla['mailempresa'];
    $response['descripempresa']=$tupla['descriptionempresa'];
}
}else{
    $response['status']=0;
    //----------index
    $response['idempresa']="";
    $response['nomempresa']="";
    $response['dirempresa']="";
    $response['corrempresa']="";
    $response['descripempresa']="";

}
echo json_encode($response)
?>

