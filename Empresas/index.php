<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link type="text/css" rel="stylesheet" href="../css/materialize.min.css" media="screen,projection" />
    <link type="text/css" rel="stylesheet" href="../css/default.css" />
    <link rel="icon" type="image/x-icon" href="../fonts/favicon.ico" />

</head>

<body>
    <div class="row">
        <div class="col s12 m8 offset-m2">
            <div class="card">
          
          <span class="card-title" >Catalogo Empresas</span>
       
                <div class="card-content">
                    <form action="actEst.php" name="frm1" id="frm1" method="GET">
                        <div class="row">
                            <div class="input-field col s10">
                                <input type="text" name="idempresa" id="idempresa">
                                <label for="idempresa">ID Empresa:</label>
                            </div>
                            <div class="input-field col s2">
                                <button id="btnBuscar" name="btnBuscar" type="button" class="btn waves-effect waves-light purple" value="Buscar">
                                        <i class="material-icons right">search</i>
                                </button>
                            </div>
                            <div class="input-field col s12">
                                <input type="text" name="nomempresa" id="nomempresa">
                                <label for="nomempresa">Nombre Empresa: </label>
                            </div>
                            <div class="input-field col s12">
                                <input type="text" name="dirempresa" id="dirempresa">
                                <label for="dirempresa">Direccion Empresa: </label>
                            </div>
                            <div class="input-field col s12">
                                <input type="text" name="corrempresa" id="corrempresa">
                                <label for="corrempresa">Correo empresa: </label>
                            </div>
                            <div class="input-field col s12">
                                <input type="text" name="descripempresa" id="descripempresa">
                                <label for="descripempresa">Descripción empresa: </label>
                            </div>
                            <div class="input-field col s3">
                                <button id="btnGuardar" name="btnGuardar" type="button" class="btn waves-effect waves-light purple" value="Guardar">
                                        <i class="material-icons right" >save</i>Guardar</button>
                            </div>
                            <div class="input-field col s3">
                                <button id="btnEliminar" name="btnEliminar" type="button" class="btn waves-effect waves-light purple" value="Eliminar">
                                        <i class="material-icons right">delete</i>Eliminar</button>
                            </div>
                            <div class="input-field col s3">

                                <button id="btnLimpiar" name="btnLimpiar" type="button" class="btn waves-effect waves-light purple" value="Limpiar">
                                        <i class="material-icons right">clear_all</i>Limpiar</button>
                            </div>
                            <div class="input-field col s3">

                                <button id="btnConsultar" name="btnConsultar" type="button" class="btn waves-effect waves-light purple" value="Cunsultar">
                                        <i class="material-icons right">cloud_done</i>Cunsultar</button>
                            </div>
                        </div>
                    </form>
                </div>
                </div>

    </div>
    <!-------------------------------------------------------------------------------- Ventana Modal---------------------------------------------------------------------------->
<div class="modal" id="TablaEmpresas">
        <div class="modal-content">
            <h4 align="center">Consulta de Empresas</h4>
            <br>
            <div class="row" id="tabla">
               
            </div>
        </div>
        <div class="modal-foter">
            <a id="Cerrar" class="modal-action waves-effect waves-orange btn-flat">Cerrar</a>
        </div>
</div>
<!--------------------------------------------------------------------------------- FIN VENTANA MODAL---------------------------------------------------------------------->


    <script type="text/javascript" src="../js/jquery-3.0.0.min.js"></script>
    <script type="text/javascript" src="../js/materialize.min.js"></script>
    <script type="text/javascript" src="../js/jquery.validate.min.js"></script>
    <script>
 //INICIALIZA LA VENTANA MODAL--------------------------------------------------------------------------------------------------------------------------------------------
            $("#TablaEmpresas").modal();
            $("#tabla").load("TablaEmpresas.php");
            $("#btnConsultar").click(function(){
                $("#tabla").load("TablaEmpresas.php");
                $("#TablaEmpresas").modal('open');
                
            });
//-----------------------------------------------------------------------------------------------------------------------------------------------------------------------------
            $("#tabla").on("click",".edit",function(){

                var ide = $(this).attr("data-ide");
                var nome = $(this).attr("data-namee");
                var dire = $(this).attr("data-adde");
                var maile = $(this).attr("data-maile");
                var descripe = $(this).attr("data-descripe");
                $("#idempresa").val(ide);
                $("#nomempresa").val(nome);
                $("#dirempresa").val(dire);
                $("#corrempresa").val(maile);
                $("#descripempresa").val(descripe);
                $("#TablaEmpresas").modal('close');
                $("#idempresa").focus();

            });

$("#Cerrar").click(function(){
    $("#TablaEmpresas").modal('close');
    $("#no").focus();  
});
//----------------------------------------------------------------------------------------------------------------------------------------------------------------------------
        $("#btnGuardar").click(function() {
           
            $.ajax({
                type: "post",
                url: "GuardaEmp.php",
                dataType: 'json',
                data: $("#frm1").serialize(),
                success: function(response) {
                        if (response['status'] == 1) {
                            $("#idempresa").val(response['idempresa']);
                            $("#nomempresa").val(response['nomempresa']);
                            $("#dirempresa").val(response['dirempresa']);
                            $("#corrempresa").val(response['corrempresa']);
                            $("#descripempresa").val(response['descripempresa']);
                            $("#idempresa").focus();
                            M.toast({
                                html: 'Empresa Guardada',
                                classes: 'rounded',
                                displayLenght: 4000
                            });
                            $("#idempresa").val("");
                            $("#nomempresa").val("");
                            $("#dirempresa").val("");
                            $("#corrempresa").val("");
                            $("#descripempresa").val("");
                            $("#idempresa").focus();
                        } else {
                            M.toast({
                                html: 'Empresa no guardada',
                                classes: 'rounded',
                                displayLenght: 4000
                            });
                        } //fin del else
                    } //din success
            }); //fin del ajax
        });

        $("#btnEliminar").click(function() {

            $.ajax({
                type: "post",
                url: "EliminaEmp.php",
                dataType: 'json',
                data: $("#frm1").serialize(),
                success: function(response) {
                        if (response['status'] == 1) {
                            $("#idempresa").val("");
                            $("#nomempresa").val("");
                            $("#dirempresa").val("");
                            $("#corrempresa").val("");
                            $("#descripempresa").val("");
                            $("#idempresa").focus();
                            M.toast({
                                html: 'Empresa Eliminada',
                                classes: 'rounded',
                                displayLenght: 4000
                            });
                        } else {
                            M.toast({
                                html: 'Empresa no Eliminada',
                                classes: 'rounded',
                                displayLenght: 4000
                            });
                        } //fin del else
                    } //din success
            }); //fin del ajax
            /* M.toast({
                 html: 'Diste CLick en Eliminar',
                 classes: 'rounded',
                 displayLenght: 4000
             });*/
        });
        $("#btnLimpiar").click(function() {
            $("#idempresa").val("");
            $("#nomempresa").val("");
            $("#dirempresa").val("");
            $("#corrempresa").val("");
            $("#descripempresa").val("");
            $("#idempresa").focus();
            M.toast({
                html: 'Cajas Limpias',
                classes: 'rounded',
                displayLenght: 4000
            });
        });
        $("#btnBuscar").click(function() {
            $.ajax({
                type: "post",
                url: "BuscaEmp.php",
                dataType: 'json',
                data: $("#frm1").serialize(),
                success: function(response) {
                        if (response['status'] == 1) {
                            $("#nomempresa").val(response['nomempresa']);
                            $("#dirempresa").val(response['dirempresa']);
                            $("#corrempresa").val(response['corrempresa']);
                            $("#descripempresa").val(response['descripempresa']);
                            $("#idempresa").focus();
                            M.toast({
                                html: 'Empresa encontrada',
                                classes: 'rounded',
                                displayLenght: 4000
                            });
                        } else {
                            M.toast({
                                html: 'Empresa no encontrada',
                                classes: 'rounded',
                                displayLenght: 4000
                            });
                        } //fin del else
                    } //din success
            }); //fin del ajax
            /* M.toast({
                html: 'Diste CLick en Buscar',
                classes: 'rounded',
                displayLenght: 4000
            });*/
        }); //fin del click
      
        $('#frm1').validate({
        rules: {
            idempresa:{required:true,number:true, minlength:1, maxlength:600220},
            nomempresa:{required:true,text:true,  maxlength:50},
            dirempresa:{required:true,text:true,  maxlength:150},
            corrempresa:{required:true,email:true,  maxlength:50},
            descripempresa:{required:true,text:true,  maxlength:350},         
        },
        messages: {
            idempresa:{number:"El formato tiene que ser un numero", minlength:"Debes ingresar al menos 1 caracteres", maxlength:"No puedes ingresar más de 600220 caracteres"},
            nomempresa:{required:"No puedes dejar este campo vacío", maxlength:"No puedes ingresar más de 50 caracteres"},
            dirempresa:{required:"No puedes dejar este campo vacío", maxlength:"No puedes ingresar más de 50 caracteres"}, 
            corrempresa:{required:"No puedes dejar este campo vacío",email:"El formato tiene que ser un correo", maxlength:"No puedes ingresar más de 50 caracteres"}, 
            descripempresa:{required:"No puedes dejar este campo vacío", maxlength:"No puedes ingresar más de 350 caracteres"}, 
            
        },
        errorElement: "div",
        errorClass: "invalid",
        errorPlacement: function(error, element){
            error.insertAfter(element)                
        },
        submitHandler: function(form){
            saveData();
        }
    });

    </script>
    <script type="text/javascript" src="../js/jquery.validate.min.js"></script>  
    <script type="text/javascript" src="../js/jquery-3.0.0.min.js"></script>


</body>

</html>