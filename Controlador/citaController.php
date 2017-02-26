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
        }else if ($action == "editar"){
            citaController::editar();
        }else if ($action == "selectcita"){
            citaController::selectcita();
        }else if ($action == "adminTablecita"){
            citaController::adminTablecita();
        }else if ($action == "Inactivarcita"){
            citaController::CambiarEstado("Inactivo");
        }else if ($action == "ActivarEspecialista"){
            citaController::CambiarEstado("Activo");
        }
        /*else if ($action == "buscarID"){
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

    static public function editar (){
        try {
            $arrayCita = array();
            $arrayCita['Fecha'] = $_POST['Fecha'];
            $arrayCita['Codigo'] = $_POST['Codigo'];
            $arrayCita['Estado'] = $_POST['Estado'];
            $arrayCita['Valor'] = $_POST['Valor'];
            $arrayCita['NConsultorio'] = $_POST['NConsultorio'];
            $arrayCita['Observacion'] = $_POST['Observacion'];
            $arrayCita['Motivo'] = $_POST['Motivo'];
            $arrayCita['idPaciente'] = $_POST['idPaciente'];
            $arrayCita['idEspecialista'] = $_POST['idEspecialista'];
            $arrayCita['idCita'] = $_POST['idCita'];
            $Cita = new Paciente ($arrayCita);
            var_dump($arrayCita);
            $Cita->editar();
            unset($_SESSION["idCita"]);
            header("Location: ../Vista/pages/actualizarCita.php?respuesta=correcto&idCita=".$arrayCita['idCita']);
        } catch (Exception $e) {
            $txtMensaje = $e->getMessage();
            header("Location: ../Vista/pages/actualizarCita.php?respuesta=error&Mensaje=".$txtMensaje);
        }
    }
    static public function CambiarEstado ($Estado){
        try {
            $idCita = $_GET["idCita"];
            $ObjCita = Cita::buscarForId($idCita);
            $ObjCita->setEstado($Estado);
            var_dump($ObjCita);
            $ObjCita->editar();
            header("Location: ../Vista/pages/adminCita.php?respuesta=correcto");
        }catch (Exception $e){
            $txtMensaje = $e->getMessage();
            header("Location: ../Vista/pages/adminCita.php?respuesta=error&Mensaje=".$txtMensaje);
        }
    }
     static public function selectCita ($isRequired=true, $id="idCita", $nombre="idCita", $class=""){
     $arrCitas = Especialista::getAll(); /*  */
        $htmlSelect = "<select ".(($isRequired) ? "required" : "")." id= '".$id."' name='".fecha."' class='".$class."'>";
        $htmlSelect .= "<option >Seleccione</option>";
        if(count($arrCitas) > 0){
            foreach ($arrCitas as $cita)
                $htmlSelect .= "<option value='".$cita->getIdCita()."'>".$cita->getFecha()." ".$cita->getCodigo()."</option>";
            }
        $htmlSelect .= "</select>";
        return $htmlSelect;

    }

    static public function adminTableCita (){
        $arrCita = Cita::getAll(); /*  */
        $tmpCita = new Cita();
        $arrColumnas = [/*"idCita",*/"Fecha","Codigo","Estado","Valor","NConsultorio","Observacion","Motivo","idPaciente","idEspecialista"];
        $htmlTable = "<thead>";
        $htmlTable .= "<tr>";
        foreach ($arrColumnas as $NameColumna){
            $htmlTable .= "<th>".$NameColumna."</th>";
        }
        $htmlTable .= "<th>Acciones</th>";
        $htmlTable .= "</tr>";
        $htmlTable .= "</thead>";

        $htmlTable .= "<tbody>";
        foreach ($arrCita as $ObjCita){
            $htmlTable .= "<tr>";
            //$htmlTable .= "<td>".$ObjCita->getIdCita()."</td>";
            $htmlTable .= "<td>".$ObjCita->getFecha()."</td>";
            $htmlTable .= "<td>".$ObjCita->getCodigo()."</td>";
            $htmlTable .= "<td>".$ObjCita->getEstado()."</td>";
            $htmlTable .= "<td>".$ObjCita->getValor()."</td>";
            $htmlTable .= "<td>".$ObjCita->getNConsultorio()."</td>";
            $htmlTable .= "<td>".$ObjCita->getObservacion()."</td>";
            $htmlTable .= "<td>".$ObjCita->getMotivo()."</td>";
            $htmlTable .= "<td>".$ObjCita->getIdPaciente()."</td>";
            $htmlTable .= "<td>".$ObjCita->getIdEspecialista()."</td>";

            $icons = "";
            if($ObjCita->getEstado() == "Activo"){
                $icons .= "<a data-toggle='tooltip' title='Inactivar Usuario' data-placement='top' class='btn btn-social-icon btn-danger newTooltip' href='../../Controlador/citaController.php?action=InactivarCita&IdCita=".$ObjCita->getIdCita()."'><i class='fa fa-times'></i></a>";
            }else{
                $icons .= "<a data-toggle='tooltip' title='Activar Usuario' data-placement='top' class='btn btn-social-icon btn-success newTooltip' href='../../Controlador/citaController.php?action=ActivarCita&IdCita=".$ObjCita->getIdCita()."'><i class='fa fa-check'></i></a>";
            }
            $icons .= "<a data-toggle='tooltip' title='Actualizar Usuario' data-placement='top' class='btn btn-social-icon btn-primary newTooltip' href='actualizarCita.php?IdCita=".$ObjCita->getIdCita()."'><i class='fa fa-pencil'></i></a>";
            $icons .= "<a data-toggle='tooltip' title='Ver Usuario' data-placement='top' class='btn btn-social-icon btn-warning newTooltip' href='../../Controlador/citaController.php?action=InactivarCita&IdCita=".$ObjCita->getIdCita()."'><i class='fa fa-eye'></i></a>";

            $htmlTable .= "<td>".$icons."</td>";
            $htmlTable .= "</tr>";
        }
        $htmlTable .= "</tbody>";
        return $htmlTable;
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