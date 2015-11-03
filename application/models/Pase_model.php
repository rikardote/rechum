<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pase_model extends My_Model {

    

	public $table = 'pases'; // you MUST mention the table name
    public $primary_key = 'id'; // you MUST mention the primary key
    public $fillable = array(); // If you want, you can set an array with the fields that can be filled by insert/update
    public $protected = array(); // ...Or you can set an array with the fields that cannot be filled by insert/update
    

    public function __construct()
    {
     parent::__construct();  
    }
    public function get_pases($id){
    	 $this->db->select("pases.*, 
            qnas.qna_descripcion,
            qnas.qna_mes,
            qnas.qna_year,

           
        ");
        $this->db->from('pases');
        $this->db->join('qnas', 'qnas.id = pases.qna_id');
       
        $this->db->where('empleado_id', $id);
        $this->db->order_by('qna_id','DESC');
        $query = $this->db->get();
        return $query->result();
    }
    
  

}

/* End of file qna_model.php */
/* Location: ./application/models/qna_model.php */
