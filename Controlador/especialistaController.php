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
            especialistaController::crear();
        }else if ($action == "editar"){
            especialistaController::editar();
        }else if ($action == "selectEspecialista"){
            especialistaController::selectEspecialista();
        }else if ($action == "adminTableEspecialista"){
            especialistaController::adminTableEspecialista();
        }else if ($action == "InactivarEspecialista"){
            especialistaController::CambiarEstado("Inactivo");
        }else if ($action == "ActivarEspecialista"){
            especialistaController::CambiarEstado("Activo");
        }
        /*else if ($action == "buscarID"){
            especialistaController::buscarID(1);
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
            //var_dump($e);
           header("Location: ../Vista/pages/registroEspecialista.php?respuesta=error");
        }
    }
    static public function editar (){
        try {
            $TmpObject = Especialista::buscarForId($_SESSION["idEspecialista"]);
            $Estado = $TmpObject->getEstado();
            $arrayEspecialista = array();
            $arrayEspecialista['Tipo'] = $_POST['Tipo'];
            $arrayEspecialista['Nombre'] = $_POST['Nombre'];
            $arrayEspecialista['Apellido'] = $_POST['Apellido'];
            $arrayEspecialista['TipoDocumento'] = $_POST['TipoDocumento'];
            $arrayEspecialista['Documento'] = $_POST['Documento'];
            $arrayEspecialista['Direccion'] = $_POST['Direccion'];
            $arrayEspecialista['Email'] = $_POST['Email'];
            $arrayEspecialista['Genero'] = $_POST['Genero'];
            $arrayEspecialista['Estado'] = $Estado;
            $arrayEspecialista['idEspecialiasta'] = $_SESSION["idEspecialista"];
            $Especialista = new Paciente ($arrayEspecialista);
            var_dump($arrayEspecialista);
            $Especialista->editar();
            unset($_SESSION["idEspecialista"]);
            header("Location: ../Vista/pages/actualizarEspecialista.php?respuesta=correcto&idEspecialista=".$arrayEspecialista['idEspecialista']);
        } catch (Exception $e) {
            $txtMensaje = $e->getMessage();
            header("Location: ../Vista/pages/actualizarEspecialista.php?respuesta=error&Mensaje=".$txtMensaje);
        }
    }
    static public function CambiarEstado ($Estado){
        try {
            $idEspecialista = $_GET["idEspecialista"];
            $ObjEspecialista = Especialista::buscarForId($idEspecialista);
            $ObjEspecialista->setEstado($Estado);
            var_dump($ObjEspecialista);
            $ObjEspecialista->editar();
            header("Location: ../Vista/pages/adminEspecialista.php?respuesta=correcto");
        }catch (Exception $e){
            $txtMensaje = $e->getMessage();
            header("Location: ../Vista/pages/adminEspecialista.php?respuesta=error&Mensaje=".$txtMensaje);
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

    static public function adminTableEspecialista (){
        $arrEspecialista = Especialista::getAll(); /*  */
        $tmpEspecialista = new Especialista();
        $arrColumnas = [/*"idEspecialista",*/"Tipo,Nombre","Apellido",/*"TipoDocumento",*/"Documento","Direccion","Email","Genero","Telefono"];
        $htmlTable = "<thead>";
        $htmlTable .= "<tr>";
        foreach ($arrColumnas as $NameColumna){
            $htmlTable .= "<th>".$NameColumna."</th>";
        }
        $htmlTable .= "<th>Acciones</th>";
        $htmlTable .= "</tr>";
        $htmlTable .= "</thead>";

        $htmlTable .= "<tbody>";
        foreach ($arrEspecialista as $ObjEspecialista){
            $htmlTable .= "<tr>";
            //$htmlTable .= "<td>".$ObjEspecialista->getIdEspecialista()."</td>";
            $htmlTable .= "<td>".$ObjEspecialista->getTipo()."</td>";
            $htmlTable .= "<td>".$ObjEspecialista->getNombres()."</td>";
            $htmlTable .= "<td>".$ObjEspecialista->getApellidos()."</td>";
            //$htmlTable .= "<td>".$ObjEspecialista->getTipoDocumento()."</td>";
            $htmlTable .= "<td>".$ObjEspecialista->getDocumento()."</td>";
            $htmlTable .= "<td>".$ObjEspecialista->getDireccion()."</td>";
            $htmlTable .= "<td>".$ObjEspecialista->getEmail()."</td>";
            $htmlTable .= "<td>".$ObjEspecialista->getGenero()."</td>";
            $htmlTable .= "<td>".$ObjEspecialista->getEstado()."</td>";

            $icons = "";
            if($ObjEspecialista->getEstado() == "Activo"){
                $icons .= "<a data-toggle='tooltip' title='Inactivar Usuario' data-placement='top' class='btn btn-social-icon btn-danger newTooltip' href='../../Controlador/especialistaController.php?action=InactivarEspecialista&IdEspecialista=".$ObjEspecialista->getIdEspecialista()."'><i class='fa fa-times'></i></a>";
            }else{
                $icons .= "<a data-toggle='tooltip' title='Activar Usuario' data-placement='top' class='btn btn-social-icon btn-success newTooltip' href='../../Controlador/especialistaController.php?action=ActivarEspecialista&IdEspecialista=".$ObjEspecialista->getIdEspecialista()."'><i class='fa fa-check'></i></a>";
            }
            $icons .= "<a data-toggle='tooltip' title='Actualizar Usuario' data-placement='top' class='btn btn-social-icon btn-primary newTooltip' href='actualizarEspecialista.php?IdPaciente=".$ObjEspecialista->getIdEspecialista()."'><i class='fa fa-pencil'></i></a>";
            $icons .= "<a data-toggle='tooltip' title='Ver Usuario' data-placement='top' class='btn btn-social-icon btn-warning newTooltip' href='../../Controlador/especialistaController.php?action=InactivarPaciente&IdPaciente=".$ObjEspecialista->getIdEspecialista()."'><i class='fa fa-eye'></i></a>";

            $htmlTable .= "<td>".$icons."</td>";
            $htmlTable .= "</tr>";
        }
        $htmlTable .= "</tbody>";
        return $htmlTable;
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