<?php
include_once("../Utilerias/BaseDatos.php");
$res = consultaEmpresa();
echo "<table class ='highlight bordered'>
<thead>
    <tr><th>ID Empresa</th><th>Nombre Empresa</th><th>Direccion Empresa</th><th>Correo Empresa</th><th>Descripcion Empresa</th><th>Selecciona</th></tr>
    </thead>
    <tbody>";
foreach ($res as $tupla) {
    $ide = $tupla['idempresa'];
    $namee = $tupla['nameempresa'];
    $adde = $tupla['addresempresa'];
    $maile = $tupla['mailempresa'];
    $descripe = $tupla['descriptionempresa'];
    echo "<tr><td>$ide</td><td>$namee</td><td>$adde</td><td>$maile</td><td>$descripe</td><td>
    <i class='material-icons edit' data-ide = '$ide' data-namee='$namee' data-adde = '$adde' data-maile = '$maile' data-descripe = '$descripe'> create </i>
    </td></tr>";
}
echo "</tbody>
</table>";
?>    