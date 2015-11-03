<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Reporte_model extends My_Model {

    

	public $table = 'captura_incidencias'; // you MUST mention the table name
    public $primary_key = 'id'; // you MUST mention the primary key
    public $fillable = array(); // If you want, you can set an array with the fields that can be filled by insert/update
    public $protected = array(); // ...Or you can set an array with the fields that cannot be filled by insert/update
    

    public function __construct()
    {
     parent::__construct();  
    }
    

 public function get_total_pendientes($qna_id, $centro){
    
        $this->db->select("captura_incidencias.*, 
            
            empleado_id AS emp_id,
            incidencias.id AS inc_id,
            incidencias.incidencia_cod,
            incidencias.grupo,

            adscripciones.id AS adscrip_id,
            adscripciones.adscripcion,
            adscripciones.descripcion,
            
            empleados.adscripcion_id,

        ");

        $this->db->from('captura_incidencias');
        $this->db->join('qnas', 'qnas.id = captura_incidencias.qna_id');
        $this->db->join('empleados', 'empleados.id = captura_incidencias.empleado_id');
        $this->db->join('incidencias', 'incidencias.id = captura_incidencias.incidencia_id');
        $this->db->join('adscripciones', 'adscripciones.id = empleados.adscripcion_id');
        $this->db->where('qna_id', $qna_id);
        $this->db->where('adscripcion_id', $centro);
        
        $query = $this->db->get();
        return $query->num_rows();
 }
 public function get_incidencias($qna_id, $centro){
    
        $this->db->select("captura_incidencias.*, 
            
            empleado_id AS emp_id,
            incidencias.id AS inc_id,
            incidencias.incidencia_cod,
            incidencias.grupo,

            adscripciones.id AS adscrip_id,
            adscripciones.adscripcion,
            adscripciones.descripcion,
            
            empleados.adscripcion_id,

        ");

        $this->db->from('captura_incidencias');
        $this->db->join('qnas', 'qnas.id = captura_incidencias.qna_id');
        $this->db->join('empleados', 'empleados.id = captura_incidencias.empleado_id');
        $this->db->join('incidencias', 'incidencias.id = captura_incidencias.incidencia_id');
        $this->db->join('adscripciones', 'adscripciones.id = empleados.adscripcion_id');
        $this->db->where('qna_id', $qna_id);
        $this->db->where('adscripcion_id', $centro);
        
        $query = $this->db->get();
        return $query->result();
 }
	

}

/* End of file Reporte_model.php */
/* Location: ./application/models/Reporte_model.php */