<?php

require_once (__DIR__.'/../Modelo/Paciente.php');

if(!empty($_GET['action'])){
    pacienteController::main($_GET['action']);
}else{
    echo "No se encontro ninguna accion...";
}

class pacienteController{

    static function main($action){
        if ($action == "crear"){
            pacienteController::crear();
        }else if ($action == "editar"){
            pacienteController::editar();
        }else if ($action == "selectPacientes"){
            pacienteController::selectPacientes();
        }
        /*else if ($action == "buscarID"){
            pacienteController::buscarID(1);
        }*/
    }

    static public function crear (){
        try {
            $arrayPaciente = array();
            $arrayPaciente['Nombres'] = $_POST['Nombres'];
            $arrayPaciente['Apellidos'] = $_POST['Apellidos'];
            $arrayPaciente['TipoDocumento'] = $_POST['TipoDocumento'];
            $arrayPaciente['Documento'] = $_POST['Documento'];
            $arrayPaciente['Direccion'] = $_POST['Direccion'];
            $arrayPaciente['Email'] = $_POST['Email'];
            $arrayPaciente['Genero'] = $_POST['Genero'];
            $arrayPaciente['Estado'] = "Activo";
            $paciente = new Paciente ($arrayPaciente);
            $paciente->insertar();
            header("Location: ../Vista/pages/registroPaciente.php?respuesta=correcto");
        } catch (Exception $e) {
            //var_dump($e);
            header("Location: ../Vista/pages/registroPaciente.php?respuesta=error");
        }
    }

    static public function editar (){
        try {
            $arrayPaciente = array();
            $arrayPaciente['Nombres'] = $_POST['Nombres'];
            $arrayPaciente['Apellidos'] = $_POST['Apellidos'];
            $arrayPaciente['TipoDocumento'] = $_POST['TipoDocumento'];
            $arrayPaciente['Documento'] = $_POST['Documento'];
            $arrayPaciente['Direccion'] = $_POST['Direccion'];
            $arrayPaciente['Email'] = $_POST['Email'];
            $arrayPaciente['Genero'] = $_POST['Genero'];
            $arrayPaciente['Estado'] = $_POST['Estado'];
            $arrayPaciente['idPaciente'] = $_POST['idPaciente'];
            $paciente = new Paciente ($arrayPaciente);
            $paciente->editar();
            header("Location: ../Vista/pages/registroPaciente.php?respuesta=correcto");
        } catch (Exception $e) {
            $txtMensaje = $e->getMessage();
            header("Location: ../Vista/pages/registroPaciente.php?respuesta=error&Mensaje=".$txtMensaje);
        }
    }

    static public function selectPacientes ($isRequired=true, $id="idPaciente", $nombres="idPaciente", $class=""){
        $arrPacientes = Paciente::getAll(); /*  */
        $htmlSelect = "<select ".(($isRequired) ? "required" : "")." id= '".$id."' name='".$nombres."' class='".$class."'>";
        $htmlSelect .= "<option >Seleccione</option>";
        if(count($arrPacientes) > 0){
            foreach ($arrPacientes as $paciente)
                $htmlSelect .= "<option value='".$paciente->getIdPaciente()."'>".$paciente->getNombres()." ".$paciente->getApellidos()."</option>";
        }
        $htmlSelect .= "</select>";
        return $htmlSelect;
    }


    /*
    static public function buscarID ($id){
        try {
            return Odontologos::buscarForId($id);
        } catch (Exception $e) {
            header("Location: ../buscarOdontologos.php?respuesta=error");
        }
    }

    public function buscarAll (){
        try {
            return Odontologos::getAll();
        } catch (Exception $e) {
            header("Location: ../buscarOdontologos.php?respuesta=error");
        }
    }

    public function buscar ($campo, $parametro){
        try {
            return Odontologos::getAll();
        } catch (Exception $e) {
            header("Location: ../buscarOdontologos.php?respuesta=error");
        }
    }*/

}
?>