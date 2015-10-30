<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Qna_model extends My_Model {

    

	public $table = 'qnas'; // you MUST mention the table name
    public $primary_key = 'id'; // you MUST mention the primary key
    public $fillable = array(); // If you want, you can set an array with the fields that can be filled by insert/update
    public $protected = array(); // ...Or you can set an array with the fields that cannot be filled by insert/update
    

    public function __construct()
    {
       parent::__construct();
    }
     


}

/* End of file qna_model.php */
/* Location: ./application/models/qna_model.php */