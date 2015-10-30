<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Capturas extends My_Model {
 	public $table = 'captura_incidencias'; // you MUST mention the table name
    public $primary_key = 'id'; // you MUST mention the primary key
    public $fillable = array(); // If you want, you can set an array with the fields that can be filled by insert/update
    public $protected = array(); // ...Or you can set an array with the fields that cannot be filled by insert/update
    protected $timestamps = FALSE;
   	
   	function __construct()  {
       parent::__construct();
    
    }
    public function get_i2ncidencias($qna_id){
    
        $this->db->select("captura_incidencias.*, 
            empleado_id AS emp_id,
            incidencias.id AS inc_id,
            count(incidencia_id) AS conteo,
            incidencias.incidencia_cod,
            incidencias.grupo,
            periodos.id AS perio_id, 
            periodos.period, 
            periodos.year,
            empleados.num_empleado, 
            empleados.nombres, 
            empleados.apellido_pat, 
            empleados.apellido_mat, 

        ");

        $this->db->from('captura_incidencias');
        $this->db->join('qnas', 'qnas.id = captura_incidencias.qna_id');
        $this->db->join('empleados', 'empleados.id = captura_incidencias.empleado_id');
        $this->db->join('incidencias', 'incidencias.id = captura_incidencias.incidencia_id');
        $this->db->join('periodos', 'periodos.id = captura_incidencias.periodo_id');
        $this->db->where('qna_id', $qna_id);
        
       
        $this->db->group_by("token"); 
        
        $query = $this->db->get();
        return $query->results();
 }
 public function get_total_incidencias($qna_id, $centro){
    
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
        
        //$this->db->where('adscripcion', $grupo);
       
      
        //$this->db->group_by($centro);  
        $query = $this->db->get();
        return $query->num_rows();
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
        $this->db->where('capturada !=', 1);
        //$this->db->where('adscripcion', $grupo);
       
      
        //$this->db->group_by($centro);  
        $query = $this->db->get();
        return $query->num_rows();
 }
  public function get_total_pendientes2($qna_id, $incidencia){
    
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
        
        $this->db->where('capturada !=', 1);
        $this->db->where('grupo', $incidencia);
        //$this->db->where('adscripcion', $grupo);
       
      
        //$this->db->group_by($centro);  
        $query = $this->db->get();
        return $query->num_rows();
 }
  public function get_incidencias($qna_id){
    
        $this->db->select("captura_incidencias.*, 
        	
            empleado_id AS emp_id,
            incidencias.id AS inc_id,
            count(incidencia_id) AS conteo,
            incidencias.incidencia_cod,
            incidencias.grupo,
            periodos.id AS perio_id, 
            periodos.period, 
            periodos.year,
            adscripciones.id AS adscrip_id,
            adscripciones.adscripcion,
            adscripciones.descripcion,
            empleados.num_empleado, 
            empleados.nombres, 
            empleados.apellido_pat, 
            empleados.apellido_mat, 
            empleados.adscripcion_id,

        ");

        $this->db->from('captura_incidencias');
        $this->db->join('qnas', 'qnas.id = captura_incidencias.qna_id');
        $this->db->join('empleados', 'empleados.id = captura_incidencias.empleado_id');
        $this->db->join('incidencias', 'incidencias.id = captura_incidencias.incidencia_id');
        $this->db->join('adscripciones', 'adscripciones.id = empleados.adscripcion_id');
        $this->db->join('periodos', 'periodos.id = captura_incidencias.periodo_id');
        $this->db->select_min('captura_incidencias.fecha_inicial');
        $this->db->where('qna_id', $qna_id);
        //$this->db->where('adscripcion_id', $centro);
        //$this->db->where('adscripcion', $grupo);
       
        //$this->db->group_by("token"); 
        $this->db->group_by('adscripcion_id');  
        $query = $this->db->get();
        return $query->result();
 }
 public function get_all_incidencias($qna_id, $adscripcion_id=NULL){
    
        $this->db->select("captura_incidencias.*, 
            
            empleado_id AS emp_id,
            incidencias.id AS inc_id,
            count(incidencia_id) AS conteo,
            incidencias.incidencia_cod,
            incidencias.grupo,
            periodos.id AS perio_id, 
            periodos.period, 
            periodos.year,
            adscripciones.id AS adscrip_id,
            adscripciones.adscripcion,
            adscripciones.descripcion,
            empleados.num_empleado, 
            empleados.nombres, 
            empleados.apellido_pat, 
            empleados.apellido_mat, 
            empleados.adscripcion_id,

        ");

        $this->db->from('captura_incidencias');
        $this->db->join('qnas', 'qnas.id = captura_incidencias.qna_id');
        $this->db->join('empleados', 'empleados.id = captura_incidencias.empleado_id');
        $this->db->join('incidencias', 'incidencias.id = captura_incidencias.incidencia_id');
        $this->db->join('adscripciones', 'adscripciones.id = empleados.adscripcion_id');
        $this->db->join('periodos', 'periodos.id = captura_incidencias.periodo_id');
        $this->db->where('qna_id', $qna_id);
        if (isset($adscripcion_id)) {
            $this->db->where('adscripcion_id', $adscripcion_id);
        }
        $this->db->select_min('captura_incidencias.fecha_inicial');
        $this->db->order_by("num_empleado", 'ASC'); 
        $this->db->order_by("fecha_inicial"); 
        if (isset($adscripcion_id)) {
            $this->db->group_by("token");     
        }else {
            $this->db->group_by("adscripciones.adscripcion");     
        }
        
        //$this->db->group_by('adscripcion_id');  
        $query = $this->db->get();
        return $query->result();
 }

 public function get_all_grupos($qna_id, $grupo_id){
    
        $this->db->select("captura_incidencias.*, 
            
            empleado_id AS emp_id,
            incidencias.id AS inc_id,
            count(incidencia_id) AS conteo,
            incidencias.incidencia_cod,
            incidencias.grupo,
            periodos.id AS perio_id, 
            periodos.period, 
            periodos.year,
            adscripciones.id AS adscrip_id,
            adscripciones.adscripcion,
            adscripciones.descripcion,
            empleados.num_empleado, 
            empleados.nombres, 
            empleados.apellido_pat, 
            empleados.apellido_mat, 
            empleados.adscripcion_id,

        ");

        $this->db->from('captura_incidencias');
        $this->db->join('qnas', 'qnas.id = captura_incidencias.qna_id');
        $this->db->join('empleados', 'empleados.id = captura_incidencias.empleado_id');
        $this->db->join('incidencias', 'incidencias.id = captura_incidencias.incidencia_id');
        $this->db->join('adscripciones', 'adscripciones.id = empleados.adscripcion_id');
        $this->db->join('periodos', 'periodos.id = captura_incidencias.periodo_id');
        $this->db->join('grupos_de_incidencias', 'grupos_de_incidencias.codigo = incidencias.grupo');
        $this->db->select_min('captura_incidencias.fecha_inicial');
        $this->db->where('qna_id', $qna_id);
        $this->db->where('grupo', $grupo_id);
        $this->db->where('capturada !=',1);
        //$this->db->where('adscripcion', $grupo);
       $this->db->order_by("num_empleado", 'ASC'); 
        $this->db->order_by("fecha_inicial"); 
        $this->db->group_by("token"); 
        //$this->db->group_by('adscripcion_id');  
        $query = $this->db->get();
        return $query->result();
 }
 public function get_total_por_incidencia($qna_id, $grupo){
    
        $this->db->select("captura_incidencias.*, 
            incidencias.id AS inc_id,
            incidencias.incidencia_cod,
            incidencias.grupo,
        ");

        $this->db->from('captura_incidencias');
        $this->db->join('incidencias', 'incidencias.id = captura_incidencias.incidencia_id');
        $this->db->join('grupos_de_incidencias', 'grupos_de_incidencias.codigo = incidencias.grupo');
        $this->db->where('qna_id', $qna_id);
        $this->db->where('grupo', $grupo);
       
        $query = $this->db->get();
        return $query->num_rows();
 }
 public function get_total_incidencias_por_concepto($qna_id, $centro=NULL,$concepto){
    
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
      
        $this->db->where('incidencia_cod', $concepto);
        //$this->db->where('adscripcion', $grupo);
       
      
        //$this->db->group_by($centro);  
        $query = $this->db->get();
        return $query->num_rows();
 }
 public function get_total_incidencias_por_concepto2($fecha_inicial,$fecha_final, $centro,$concepto){
    
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
        $this->db->where('adscripcion_id', $centro);
        $this->db->where('fecha_inicial BETWEEN "'. date('Y-m-d', strtotime($fecha_inicial)). '" and "'. date('Y-m-d', strtotime($fecha_final)).'"');
        $this->db->where('incidencia_cod', $concepto);
        //$this->db->where('adscripcion', $grupo);
       
      
        //$this->db->group_by($centro);  
        $query = $this->db->get();
        return $query->num_rows();
 }
 public function get_total_incidencias_por_concepto_del($fecha_inicial,$fecha_final,$concepto){
    
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
        $this->db->where('incidencia_cod', $concepto);
        $this->db->where('fecha_inicial BETWEEN "'. date('Y-m-d', strtotime($fecha_inicial)). '" and "'. date('Y-m-d', strtotime($fecha_final)).'"');
        
        //$this->db->where('adscripcion', $grupo);
       
      
        //$this->db->group_by($centro);  
        $query = $this->db->get();
        return $query->num_rows();
 }
  public function get_all_incidencias_fecha($fecha_inicial, $fecha_final){
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
       
        $this->db->where('fecha_inicial BETWEEN "'. date('Y-m-d', strtotime($fecha_inicial)). '" and "'. date('Y-m-d', strtotime($fecha_final)).'"');
        
        $this->db->group_by('adscripcion');  
        $query = $this->db->get();
        return $query->result();
      
 }
	

}

/* End of file capturas.php */
/* Location: ./application/models/admin/capturas.php */