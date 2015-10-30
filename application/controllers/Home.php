<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends My_Controller {
	public function __construct()
	{
		parent::__construct();
		//Do your magic here
	}
	public function index()
	{
		
		$data['user_id']    = $this->tank_auth->get_user_id();
        $this->load->model('empleado_model');
        $username   = $this->tank_auth->get_username();
        $data['nombre_de_usuario'] = $this->empleado_model->getName($username);
		$data['panelheading'] = "Inicio";
		//var_dump($data['nombre_de_usuario']);
		$data['index'] = "home";
		$this->load->view('layouts/index', $data);
		
	}

}

/* End of file home.php */
/* Location: ./application/controllers/home.php */