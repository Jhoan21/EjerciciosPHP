<?php

require_once (__DIR__.'/../Modelo/Especialista.php');

if(!empty($_GET['action'])){
    EspecialistaController::main($_GET['action']);
}else{
    echo "No se encontro ninguna accion...";
}

class EspecialistaController{

    static function main($action){
        if ($action == "crear"){
            EspecialistaController::crear();
        }/*else if ($action == "editar"){
            EspecialistaController::editar();
        }else if ($action == "buscarID"){
            EspecialistaController::buscarID(1);
        }*/
    }

    static public function crear (){
        try {
            $arrayEspecialista = array();
            $arrayEspecialista['Tipo'] = $_POST['Tipo'];
            $arrayEspecialista['Nombre'] = $_POST['Nombre'];
            $arrayEspecialista['Apellido'] = $_POST['Apellido'];
            $arrayEspecialista['Direccion'] = $_POST['Direccion'];
            $arrayEspecialista['TipoDocumento'] = $_POST['TipoDocumento'];
            $arrayEspecialista['Documento'] = $_POST['Documento'];
            $arrayEspecialista['Email'] = $_POST['Email'];
            $arrayEspecialista['Genero'] = $_POST['Genero'];
            $arrayEspecialista['Telefono'] = $_POST['Telefono'];
            $Especialista = new Especialista ($arrayEspecialista);
            $Especialista->insertar();
            header("Location: ../Vista/pages/registroEspecialista.php?respuesta=correcto");
        } catch (Exception $e) {
           header("Location: ../Vista/pages/registroEspecialista.php?respuesta=error");
        }
    }

    static public function selectEspecialista ($isRequired=true, $id="idEspecialista", $nombre="idEspecialista", $class=""){
        $arrEspecialistas = Especialista::getAll(); /*  */
        $htmlSelect = "<select ".(($isRequired) ? "required" : "")." id= '".$id."' name='".$nombre."' class='".$class."'>";
        $htmlSelect .= "<option >Seleccione</option>";
        if(count($arrEspecialistas) > 0){
            foreach ($arrEspecialistas as $especialista)
                $htmlSelect .= "<option value='".$especialista->getIdEspecialista()."'>".$especialista->getNombre()." ".$especialista->getApellido()."</option>";
        }
        $htmlSelect .= "</select>";
        return $htmlSelect;
    }

    /*
    static public function editar (){
        try {
            $arrayOdonto = array();
            $arrayOdonto['nombre'] = $_POST['nombre'];
            $arrayOdonto['apellidos'] = $_POST['apellidos'];
            $arrayOdonto['especialidad'] = $_POST['especialidad'];
            $arrayOdonto['direccion'] = $_POST['direccion'];
            $arrayOdonto['celular'] = $_POST['celular'];
            $arrayOdonto['user'] = $_POST['user'];
            $arrayOdonto['pass'] = $_POST['pass'];
            $arrayOdonto['Telefono'] = $_POST['Telefono'];
            $arrayOdonto['idodontologos'] = $_POST['idodontologos'];
            $odonto = new Odontologos ($arrayOdonto);
            $odonto->editar();
            header("Location: ../registroEspecialista.php?respuesta=correcto");
        } catch (Exception $e) {
            header("Location: ../registroEspecialista.php?respuesta=error");
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