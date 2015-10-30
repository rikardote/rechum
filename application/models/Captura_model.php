<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Captura_model extends My_Model {

	public $table = 'captura_incidencias'; // you MUST mention the table name
 	public $primary_key = 'id'; // you MUST mention the primary key
    public $fillable = array(); // If you want, you can set an array with the fields that can be filled by insert/update
   	public $protected = array(); // ...Or you can set an array with the fields that cannot be filled by insert/update
	
    function __construct()
    {
        
    	
    	parent::__construct();
    }

    public function get_incidencias($emp_id,$qn_id){
    
        $this->db->select("captura_incidencias.*, 
            incidencias.id AS inc_id,count(incidencia_id) AS conteo,incidencias.incidencia_cod,
            periodos.id AS perio_id, periodos.period, periodos.year
        ");

        $this->db->from('captura_incidencias');
        $this->db->join('qnas', 'qnas.id = captura_incidencias.qna_id');
        $this->db->join('empleados', 'empleados.id = captura_incidencias.empleado_id');
        $this->db->join('incidencias', 'incidencias.id = captura_incidencias.incidencia_id');
        $this->db->join('periodos', 'periodos.id = captura_incidencias.periodo_id');
        $this->db->select_min('captura_incidencias.fecha_inicial');
        $this->db->where('qna_id', $qn_id);
        $this->db->where('empleado_id', $emp_id);
        $this->db->order_by('fecha_inicial','ASC');
        $this->db->order_by('incidencia_cod','DESC');
        $this->db->group_by("token"); 
        
        $query = $this->db->get();
        return $query->result();
 }
 

function get_search($centros=NULL) {
          $match = $this->input->post('search');
          $this->db->select("empleados.*, adscripciones.id AS ads_id, adscripciones.adscripcion");
          $this->db->from('empleados');
          $this->db->join('adscripciones', 'adscripcion_id = adscripciones.id');
          $this->db->where('empleados.num_empleado', $match);
                 

          $this->db->where_in('adscripcion_id',$centros);
          $this->db->order_by('num_empleado');
          
          $query = $this->db->get();
          return $query->result();
        }

 public function get_empleado_join($id){
        
            $this->db->select("empleados.*, adscripciones.id AS ads_id, adscripciones.adscripcion");
            $this->db->from('empleados');
            $this->db->join('adscripciones', 'adscripcion_id = adscripciones.id');
            $this->db->where('empleados.id', $id);
            
            $query = $this->db->get();
            return $query->row();
  } 
  public function verificar_ya_capturado($qna_id,$empleado_id,$incidencia_id,$fecha_inicial,$fecha_final){
    $this->db->select('*');
    $this->db->from($this->table);
    $this->db->where('empleado_id', $empleado_id);
    $this->db->where('incidencia_id', $incidencia_id);
    $this->db->where('fecha_inicial', $fecha_inicial);
    
    $query = $this->db->get();
    return $query->row();
  }  
  public function get_report($qna_id, $centros){
    
        $this->db->select("captura_incidencias.*, 
            incidencias.id AS inc_id,
            count(incidencia_id) AS conteo,
            incidencias.incidencia_cod,
            
            periodos.id AS perio_id, 
            periodos.period, 
            periodos.year,
            empleados.num_empleado,
            empleados.nombres,
            empleados.apellido_pat,
            empleados.apellido_mat,
            empleados.adscripcion_id,
            adscripciones.adscripcion,
            adscripciones.descripcion,
            qnas.qna_descripcion,
            qnas.qna_mes,
            qnas.qna_year,

           
        ");
        $this->db->from('captura_incidencias');
        $this->db->join('qnas', 'qnas.id = captura_incidencias.qna_id');
        $this->db->join('empleados', 'empleados.id = captura_incidencias.empleado_id');
        $this->db->join('incidencias', 'incidencias.id = captura_incidencias.incidencia_id');
        $this->db->join('periodos', 'periodos.id = captura_incidencias.periodo_id');
        $this->db->join('adscripciones', 'adscripcion_id = adscripciones.id');
        $this->db->where('qna_id', $qna_id);
        $this->db->where_in('adscripcion_id',$centros);
        $this->db->select_min('captura_incidencias.fecha_inicial');
        $this->db->order_by("num_empleado", 'ASC'); 
        $this->db->order_by("fecha_inicial"); 
        $this->db->group_by("token"); 
        
        $query = $this->db->get();
        return $query->result();
 }
public function get_report2($qna_id, $centros){
    
        $this->db->select("captura_incidencias.*, 
            incidencias.id AS inc_id,
            count(incidencia_id) AS conteo,
            incidencias.incidencia_cod,
            
            periodos.id AS perio_id, 
            periodos.period, 
            periodos.year,
            empleados.num_empleado,
            empleados.nombres,
            empleados.apellido_pat,
            empleados.apellido_mat,
            empleados.adscripcion_id,
            adscripciones.adscripcion,
            adscripciones.descripcion,
            qnas.qna_descripcion,
            qnas.qna_mes,
            qnas.qna_year,

           
        ");
        $this->db->from('captura_incidencias');
        $this->db->join('qnas', 'qnas.id = captura_incidencias.qna_id');
        $this->db->join('empleados', 'empleados.id = captura_incidencias.empleado_id');
        $this->db->join('incidencias', 'incidencias.id = captura_incidencias.incidencia_id');
        $this->db->join('periodos', 'periodos.id = captura_incidencias.periodo_id');
        $this->db->join('adscripciones', 'adscripcion_id = adscripciones.id');
        $this->db->where('qna_id', $qna_id);
        $this->db->where_in('adscripcion_id',$centros);
        $this->db->select_min('captura_incidencias.fecha_inicial');
        $this->db->order_by("num_empleado", 'ASC'); 
        $this->db->order_by("fecha_inicial"); 
        $this->db->group_by("token"); 
        
        $query = $this->db->get();
        return $query->row();
 }


    


}

/* End of file captura_model.php */
/* Location: ./application/models/captura_model.php */