<?php
try{
        //$Cn = new PDO('pgsql:host=localhost;port=5432;dbname=estudiantes;user=postgres;password=hola');
        $Cn = new PDO('mysql:host=localhost; dbname=empresas','root','');
        $Cn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        //$Cn->exec("SET CLIENT_ENCODING TO 'UTF8';");
        $Cn->exec("SET CHARACTER SET utf8");
}catch(Exception $e){
    die("Error: " . $e->GetMessage());
}

// Función para ejecutar consultas SELECT
function Consulta($query)
{
    global $Cn;
    try{    
        $result =$Cn->query($query);
        $resultado = $result->fetchAll(PDO::FETCH_ASSOC); 
        $result->closeCursor();
        return $resultado;
    }catch(Exception $e){
        die("Error en la LIN: " . $e->getLine() . ", MSG: " . $e->GetMessage());
    }
}

// Función que recibe un insert y regresa el consecutivo que le genero
function EjecutaConsecutivo($sentencia){
    global $Cn;
    try {
        $result = $Cn->query($sentencia);
        $resultado = $result->fetchAll(PDO::FETCH_ASSOC);
        $result->closeCursor();
        return $resultado[0]['idcurso'];
    } catch (Exception $e) {
        die("Error en la linea: " + $e->getLine() + 
        " MSG: " + $e->GetMessage());
        return 0;
    }
}

function Ejecuta ($sentencia){
    global $Cn;
    try {
        $result = $Cn->query($sentencia);
        $result->closeCursor();
        return 1; // Exito  
    } catch (Exception $e) {
        //die("Error en la linea: " + $e->getLine() + " MSG: " + $e->GetMessage());
        return 0; // Fallo
    }
}
//------------------------------------------------------------
function registraUsr($post,$ids)
{
    $correo = $post["corr"];
    $nom = $post["nom"];
    $pwd = $post["pwd"];
    $pwdEnc = password_hash($pwd, PASSWORD_DEFAULT);
    $sql = 'INSERT INTO "Escuela".usuario(correo,nomusuario,contra,tipousr,idsession)' . 
    "values('$correo','$nom','$pwdEnc',1,'$ids')";

    return Ejecuta($sql);
}

function validaUsr($post,$idSess)
{
    $correo = $post["correo"];
    $contra = $post["contra"];
    $sql = 'SELECT contra,tipousr FROM "Escuela".usuario  WHERE correo like ' . "'" . $correo . "'";
    $res = Consulta($sql);
    $pwdEnc = "";
    $tipo = 0;
    foreach ($res as $tupla )
    {
        $pwdEnc = $tupla['contra'];
        $tipo = $tupla['tipousr'];
    }
    if (password_verify($contra, $pwdEnc) )
    {   
        $sql = 'UPDATE "Escuela".usuario SET ' . "idsession='$idSess' WHERE correo like'$correo'";
        //die($sql);
        if (Ejecuta($sql))
            return $tipo;
        else
            return 0;
    }
    else{
        return 0;
    }
}

function validaSess(&$correo, &$tu, &$idsess){
    $correo = $correo;
    $sql = 'SELECT idsession,tipousr FROM "Escuela".usuario  WHERE correo like ' . "'" . $correo . "'";
    $res = Consulta($sql);
    $tipo = 0;
    foreach ($res as $tupla )
    {
        $idsess = $tupla['idsession'];
        $tu = $tupla['tipousr'];
    }   
    return 0;
}

//-------------------EMPRESAS-----------------------------------------//


function cargaEmpresa($ide){
    $query = "SELECT idempresa,nameempresa,addresempresa,mailempresa,descriptionempresa FROM empresas WHERE idempresa= '{$ide}'";
    return Consulta($query);
}
function guardaEmpresa($ide,$namee,$adde,$maile,$descripe){
    $sentencia = "INSERT INTO empresas(idempresa,nameempresa,addresempresa,mailempresa,descriptionempresa) VALUES ({$ide},'{$namee}','{$adde}','{$maile}','{$descripe}')";
    if (Ejecuta($sentencia)) {
        return 1;
    } else{
        $sentencia = "UPDATE empresas SET nameempresa='{$namee}',addresempresa='{$adde}',mailempresa='{$maile}',descriptionempresa='{$descripe}' WHERE idempresa='{$ide}'";
       // echo $sentencia;
        //die('sosjosj');
        return Ejecuta($sentencia);

    }

}

function eliminarEmpresa($ide){
$sentencia = "DELETE FROM empresas WHERE idempresa = {$ide}";
return Ejecuta($sentencia);
}

function consultaEmpresa(){
$query = "SELECT idempresa,nameempresa,addresempresa,mailempresa,descriptionempresa FROM empresas ORDER BY idempresa";
return Consulta($query);
}