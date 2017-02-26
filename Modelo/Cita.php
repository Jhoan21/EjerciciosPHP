<?php
require_once('db_abstract_class.php');

class Cita extends db_abstract_class
{
    private $idCita;
    private $Fecha;
    private $Codigo;
    Private $Estado;
    Private $Valor;
    Private $NConsultorio;
    private $Observaciones;
    Private $Motivo;
    Private $idPaciente;
    private $idEspecialista;

    public function __construct($odontologos_data=array())
    {
        parent::__construct();
        if(count($odontologos_data)>1){
            foreach ($odontologos_data as $campo => $valor){
                $this->$campo = $valor;
            }
        }else {
            $this->idCita = "";
            $this->Fecha = "";
            $this->Codigo = "";
            $this->Estado = "";
            $this->Valor = "";
            $this->NConsultorio = "";
            $this->Observaciones = "";
            $this->Motivo = "";
            $this->idPaciente = "";
            $this->idEspecialista = "";
        }
    }

    /* Metodo destructor cierra la conexion. */
    function __destruct() {
        $this->Disconnect();
        unset($this);
    }

    /**
     * @return string
     */
    public function getIdCita()
    {
        return $this->idCita;
    }

    /**
     * @param string $idCita
     */
    public function setIdCita($idCita)
    {
        $this->idCita = $idCita;
    }

    /**
     * @return string
     */
    public function getFecha()
    {
        return $this->Fecha;
    }

    /**
     * @param string $Fecha
     */
    public function setFecha($Fecha)
    {
        $this->Fecha = $Fecha;
    }

    /**
     * @return string
     */
    public function getCodigo()
    {
        return $this->Codigo;
    }

    /**
     * @param string $Codigo
     */
    public function setCodigo($Codigo)
    {
        $this->Codigo = $Codigo;
    }

    /**
     * @return string
     */
    public function getEstado()
    {
        return $this->Estado;
    }

    /**
     * @param string $Estado
     */
    public function setEstado($Estado)
    {
        $this->Estado = $Estado;
    }

    /**
     * @return string
     */
    public function getValor()
    {
        return $this->Valor;
    }

    /**
     * @param string $Valor
     */
    public function setValor($Valor)
    {
        $this->Valor = $Valor;
    }

    /**
     * @return string
     */
    public function getNConsultorio()
    {
        return $this->NConsultorio;
    }

    /**
     * @param string $NConsultorio
     */
    public function setNConsultorio($NConsultorio)
    {
        $this->NConsultorio = $NConsultorio;
    }

    /**
     * @return string
     */
    public function getObservaciones()
    {
        return $this->Observaciones;
    }

    /**
     * @param string $Observaciones
     */
    public function setObservaciones($Observaciones)
    {
        $this->Observaciones = $Observaciones;
    }

    /**
     * @return string
     */
    public function getMotivo()
    {
        return $this->Motivo;
    }

    /**
     * @param string $Motivo
     */
    public function setMotivo($Motivo)
    {
        $this->Motivo = $Motivo;
    }

    /**
     * @return string
     */
    public function getIdPaciente()
    {
        return $this->idPaciente;
    }

    /**
     * @param string $idPaciente
     */
    public function setIdPaciente($idPaciente)
    {
        $this->idPaciente = $idPaciente;
    }

    /**
     * @return string
     */
    public function getIdEspecialista()
    {
        return $this->idEspecialista;
    }

    /**
     * @param string $idEspecialista
     */
    public function setIdEspecialista($idEspecialista)
    {
        $this->idEspecialista = $idEspecialista;
    }


    public static function buscarForId($id)
    {
        $cita = new Cita();
        if ($id > 0){
            $getrow = $cita->getRow("SELECT * FROM odontologos.cita WHERE idCita =?", array($id));
            $cita->idCita = $getrow['idCita'];
            $cita->Fecha = $getrow['Fecha'];
            $cita->Codigo = $getrow['Codigo'];
            $cita->Estado = $getrow['Estado'];
            $cita->Valor = $getrow['Valor'];
            $cita->NConsultorio = $getrow['NConsultorio'];
            $cita->Observaciones = $getrow['Observaciones'];
            $cita->Motivo = $getrow['Motivo'];
            $cita->idPaciente = $getrow['idPaciente'];
            $cita->idEspecialista = $getrow['idEspecialista'];
            $cita->Disconnect();
            return $cita;
        }else{
            return NULL;
        }
    }

    public static function buscar($query)
    {
        $arrCita = array();
        $tmp = new Cita();
        $getrows = $tmp->getRows($query);

        foreach ($getrows as $valor) {
            $cita = new Cita();
            $cita->idCita = $valor['idCita'];
            $cita->Fecha = $valor['Fecha'];
            $cita->Codigo = $valor['Codigo'];
            $cita->Estado = $valor['Estado'];
            $cita->Valor = $valor['Valor'];
            $cita->NConsultorio = $valor['NConsultorio'];
            $cita->Observaciones = $valor['Observaciones'];
            $cita->Motivo = $valor['Motivo'];
            $cita->idPaciente = $valor['idPaciente'];
            $cita->idEspecialista = $valor['idEspecialista'];
            array_push($arrCita, $cita);
        }
        $tmp->Disconnect();
        return $arrCita;
    }

    public static function getAll()
    {
        return Cita::buscar("SELECT * FROM odontologos.cita");
    }

    public function insertar()
    {
        $this->insertRow("INSERT INTO odontologos.cita VALUES ('NULL', ?, ?, ?, ?, ?, ?, ?, ?, ?)", array(
                $this->Fecha,
                $this->Codigo,
                $this->Estado,
                $this->Valor,
                $this->NConsultorio,
                $this->Observaciones,
                $this->Motivo,
                $this->idPaciente,
                $this->idEspecialista
            )
        );
        $this->Disconnect();
    }

    public function editar()
    {
        $arrUser = (array) $this;
        $this->updateRow("UPDATE odontologos.cita SET Fecha = ?, Codigo = ?, Estado = ?, Valor = ?, NConsultorio = ?, Observaciones = ?, Motivo = ?, Paciente_idPaciente = ?, Especialista_idEspecialista = ? WHERE idCita = ?", array(
            $this->idPaciente,
            $this->Fecha,
            $this->Codigo,
            $this->Estado,
            $this->Valor,
            $this->NConsultorio,
            $this->Observaciones,
            $this->Motivo,
            $this->idPaciente,
            $this->idEspecialista
        ));
        $this->Disconnect();
    }

    public function getObjectPaciente (){
        return Paciente::buscarForId($this->idPaciente);
    }

    public function getObjectEspecialista (){
        return Especialista::buscarForId($this->idEspecialista);
    }

    public function eliminar($id)
    {
        if ($id > 0){
            return $this->deleteRow("DELETE FROM odontologos.cita WHERE id = ?", array($id));
        }else{
            return false;
        }
    }


}