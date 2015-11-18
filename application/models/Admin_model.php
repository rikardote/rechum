<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_model extends My_Model {
     public $table = 'users'; // you MUST mention the table name
     public $primary_key = 'id'; // you MUST mention the primary key
     public $fillable = array(); // If you want, you can set an array with the fields that can be filled by insert/update
     public $protected = array(); // ...Or you can set an array with the fields that cannot be filled by insert/update
     protected $timestamps = FALSE;
    function __construct()
    {
       parent::__construct();
    }
   public function get_empleados(){
                   
            $this->db->select("empleados.*, 
                    empleados.id AS empl_id, 
                    empleados.num_empleado, 
                    users.activated, 
                    users.is_admin, 
                    users.centros,
                    users.id,
                    adscripciones.id AS ads_id, 
                    adscripciones.descripcion
               ");

            $this->db->from($this->table);
            $this->db->join('empleados', 'username = empleados.num_empleado');
            $this->db->join('adscripciones', 'adscripcion_id = adscripciones.id');
            $this->db->order_by('is_admin', 'DESC');
            $this->db->order_by('empleados.num_empleado', 'ASC');
            $query = $this->db->get();
            return $query->result();
     }
       public function get_usuario_centros($empl_id){
            $this->db->select("users.centros");

            $this->db->from($this->table);
          
            $this->db->where('users.id', $empl_id);
            

            $query = $this->db->get();
            return $query->row_array();         
          
     } 




}

/* End of file modelName.php */
/* Location: ./application/models/modelName.php */