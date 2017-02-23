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
                <h1 class="page-header">Registro Especialista</h1>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Datos Basicos del Especialista
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <form role="form" method="post" action="../../Controlador/especialistaController.php?action=crear">

                                    <div class="form-group">
                                        <label>Tipo Especialista</label>
                                        <select required id="Tipo" name="Tipo" class="form-control">
                                            <option>Seleccione</option>
                                            <option value="Ortodoncista">Ortodoncista</option>
                                            <option value="Endodoncista">Endodoncista</option>
                                            <option value="Periodoncista">Periodoncista</option>
                                            <option value="Protesista">Protesista</option>
                                            <option value="Cirujano Oral">Cirujano Oral</option>
                                            <option value="Odontopediatra">Odontopediatra</option>>
                                        </select>
                                    </div>
                                    <div class="form-group">

                                        <label>Nombres</label>
                                        <input required maxlength="60" id="Nombre" name="Nombre" minlength="2" class="form-control" placeholder="Ingrese Sus Nombre Completos">
                                    </div>
                                    <div class="form-group">
                                        <label>Apellidos</label>
                                        <input required maxlength="60" id="Apellido" name="Apellido" minlength="2" class="form-control" placeholder="Ingrese Sus Apellidos Completos">
                                    </div>
                                    <div class="form-group">
                                        <label>Direccion</label>
                                        <input required maxlength="60" id="Direccion" name="Direccion" minlength="7" class="form-control" placeholder="Ingrese su direccion de residencia">
                                    </div>

                                    <div class="form-group">
                                        <label>Tipo Documento</label>
                                        <select required id="TipoDocumento" name="TipoDocumento" class="form-control">
                                            <option>Seleccione</option>
                                            <option value="C.C">Cedula de Ciudadania</option>
                                            <option value="T.I">Tarjeta de Identidad</option>
                                            <option value="C.E">Cedula de Extranjeria</option>
                                            <option value="RegistroCivil">Registro Civil</option>
                                            <option value="RUT">Registro Unico Tributario</option>
                                            <option value="Otro">Otro</option>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label>Documento</label>
                                        <input type="number" required max="3000000000" min="1000000" maxlength="12" id="Documento" name="Documento" minlength="7" class="form-control" placeholder="Ingrese Documento Completo">
                                    </div>

                                    <label>Email</label>
                                    <div class="form-group input-group">
                                        <span class="input-group-addon">@</span>
                                        <input type="email" required maxlength="45" id="Email" name="Email" minlength="7" class="form-control" placeholder="Ingrese su correo electronico">
                                    </div>

                                    <div class="form-group">
                                        <label>Genero</label>
                                        <select required id="Genero" name="Genero" class="form-control">
                                            <option>Seleccione</option>
                                            <option value="Masculino">Masculino</option>
                                            <option value="Femenino">Femenino</option>
                                            <option value="Indefinido">Indefinido</option>
                                        </select>
                                    </div>
                                    <label>Telefono</label>
                                    <div class="form-group input-group">
                                        <span class="input-group-addon">#</span>
                                        <input type="tel" required maxlength="20" id="Email" name="Telefono" minlength="7" class="form-control" placeholder="Ingrese su Telefono">
                                    </div>

                                    <button type="submit" class="btn btn-primary">Enviar</button>
                                    <button type="reset" class="btn btn-warning">Cancelar</button>
                                </form>
                            </div>
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
