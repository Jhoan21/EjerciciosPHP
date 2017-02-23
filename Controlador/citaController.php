<?php

require_once (__DIR__.'/../Modelo/Cita.php');

if(!empty($_GET['action'])){
    citaController::main($_GET['action']);
}else{
    echo "No se encontro ninguna accion...";
}

class citaController{

    static function main($action){
        if ($action == "crear"){
            citaController::crear();
        }/*else if ($action == "editar"){
            citaController::editar();
        }else if ($action == "buscarID"){
            citaController::buscarID(1);
        }*/
    }

    static public function crear (){
        try {
            $arrayCita = array();
            $arrayCita['Fecha'] = $_POST['Fecha'];
            $arrayCita['Codigo'] = $_POST['Codigo'];
            $arrayCita['Estado'] = $_POST['Estado'];
            $arrayCita['Valor'] = $_POST['Valor'];
            $arrayCita['NConsultorio'] = $_POST['NConsultorio'];
            $arrayCita['Observaciones'] = $_POST['Observaciones'];
            $arrayCita['Motivo'] = $_POST['Motivo'];
            $arrayCita['idPaciente'] = $_POST['idPaciente'];
            $arrayCita['idEspecialista'] = $_POST['idEspecialista'];
            $cita = new Cita($arrayCita);
            $cita->insertar();
            header("Location: ../Vista/pages/registroCita.php?respuesta=correcto");
        } catch (Exception $e) {
            header("Location: ../Vista/pages/registroCita.php?respuesta=error");
        }
    }
    /*
    static public function editar (){
        try {
            $arrayOdonto = array();
            $arrayOdonto['nombres'] = $_POST['nombres'];
            $arrayOdonto['apellidos'] = $_POST['apellidos'];
            $arrayOdonto['especialidad'] = $_POST['especialidad'];
            $arrayOdonto['direccion'] = $_POST['direccion'];
            $arrayOdonto['celular'] = $_POST['celular'];
            $arrayOdonto['user'] = $_POST['user'];
            $arrayOdonto['pass'] = $_POST['pass'];
            $arrayOdonto['estado'] = $_POST['estado'];
            $arrayOdonto['idodontologos'] = $_POST['idodontologos'];
            $odonto = new Odontologos ($arrayOdonto);
            $odonto->editar();
            header("Location: ../registroPaciente.php?respuesta=correcto");
        } catch (Exception $e) {
            header("Location: ../registroPaciente.php?respuesta=error");
        }
    }*/

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