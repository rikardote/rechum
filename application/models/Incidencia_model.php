<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Incidencia_model extends My_Model {

	//public $has_many = array('qnas');
 	public $table = 'incidencias'; // you MUST mention the table name
 	public $primary_key = 'id'; // you MUST mention the primary key
    public $fillable = array(); // If you want, you can set an array with the fields that can be filled by insert/update
   	public $protected = array(); // ...Or you can set an array with the fields that cannot be filled by insert/update
	
    function __construct()
    {
        
    	
    	parent::__construct();
    }

  

}

/* End of file incidencias_model.php */
/* Location: ./application/models/incidencias_model.php */