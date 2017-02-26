<?php
session_start();
require "../../Modelo/Cita.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Inicio</title>

    <?php include ("includes/imports.php"); ?>

</head>

<body>

<div id="wrapper">

    <?php include ("includes/barra-navegacion.php"); ?>

    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Actualizar Cita</h1>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Datos Basicos de la Cita
                    </div>
                    <div class="panel-body">
                        <div class="row">

                            <div id="alertas">
                                <?php if(!empty($_GET["respuesta"]) && $_GET["respuesta"] == "correcto"){ ?>
                                    <div class="alert alert-success alert-dismissable">
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                        La informacion de la cita se ha actualizado correctamente. Puede administrar las citas desde <a href="adminCita.php" class="alert-link">Aqui</a> .
                                    </div>
                                <?php } ?>
                                <?php if(!empty($_GET["respuesta"]) && $_GET["respuesta"] == "error"){ ?>
                                    <div class="alert alert-danger alert-dismissable">
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                        No se pudo actualizar la cita. <a href="#" class="alert-link">Error: <?php echo $_GET["Mensaje"] ?></a> .
                                    </div>
                                <?php } ?>
                            </div>
                            <?php if(!isset($_GET["IdPaciente"])){ ?>
                                <div class="alert alert-danger alert-dismissable">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                    No se pudo actualizar la cita.<strong>Error: no se encontro informacion la cita.</strong> Puede administrar las citas desde <a href="adminCita.php" class="alert-link">Aqui</a>.
                                </div>
                            <?php }else{
                                $idEspecialista = $_GET["idCita"];
                                $_SESSION["idCita"] = $idCita;
                                $ObjeCita = Cita::buscarForId($idCita);
                                ?>
                                <div class="col-lg-12">
                                    <form role="form" method="post" action="../../Controlador/CitaController.php?action=editar">
                                        <div class="form-group">
                                            <label>Codigo</label>
                                            <input required maxlength="45" id="Codigo" name="Codigo" minlength="3" class="form-control" placeholder="Ingrese Codigo">
                                        </div>
                                        <div class="form-group">
                                            <label>Estado</label>
                                            <select required id="Estado" name="Estado" class="form-control">
                                                <option>Seleccione</option>
                                                <option <?php echo ($ObjeCita->getTipo() == "Cancelado") ? "selected" : ""; ?> value="Cancelado">Cancelado</option>
                                                <option <?php echo ($ObjeCita->getTipo() == "Solicitada") ? "selected" : ""; ?> value="Solicitada">Solicitada</option>
                                                <option <?php echo ($ObjeCita->getTipo() == "Activa") ? "selected" : ""; ?> value="Activa">Activa</option>
                                                <option <?php echo ($ObjeCita->getTipo() == "Suspendida") ? "selected" : ""; ?> value="Suspendida">Suspendida</option>
                                                <option <?php echo ($ObjeCita->getTipo() == "Finalizado") ? "selected" : ""; ?> value="Finalizado">Finalizado</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Valor</label>
                                            <input type="number" required max="3000000000" min="0" id="Valor" name="Valor" minlength="1" class="form-control" placeholder="Ingrese Valor">
                                        </div>
                                        <div class="form-group">
                                            <label>Número de Consultorio</label>
                                            <input type="number" required max="2000" min="0" id="NConsulorio" name="NConsulorio" minlength="1" class="form-control" placeholder="Ingrese Número de Consultorio">
                                        </div>

                                        <div class="form-group">
                                            <label>Paciente</label>
                                            <?php echo pacienteController::selectPacientes(true,"idPaciente","idPaciente","form-control"); ?>
                                        </div>

                                        <div class="form-group">
                                            <label>Observaciones</label>
                                            <textarea required  id="Observaciones" name="Observaciones" minlength="4" class="form-control" placeholder="Ingrese Observaciones"></textarea>
                                        </div>

                                        <div class="form-group">
                                            <label>Motivo</label>
                                            <textarea required  id="Motivo" name="Motivo" minlength="4" class="form-control" placeholder="Ingrese Motivo de la Cita"></textarea>
                                        </div>

                                        <button type="submit" class="btn btn-primary">Enviar</button>
                                        <button type="reset" class="btn btn-warning">Cancelar</button>
                                    </form>
                                </div>
                            <?php }?>
                        </div>
                        <!-- /.row (nested) -->
                    </div>
                    <!-- /.panel-body -->
                </div>
                <!-- /.panel -->
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->

    </div>
    <!-- /#page-wrapper -->

</div>

<?php include ("includes/includes-footer.php"); ?>

</body>

</html>