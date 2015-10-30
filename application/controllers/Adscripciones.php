<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require 'admin_base.php';
class Adscripciones extends admin_base {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('adscripcion_model');
		
		
	}

	public function index()
	{
		$data['user_id']    = $this->tank_auth->get_user_id();
        $this->load->model('empleado_model');
        $username   = $this->tank_auth->get_username();
        $data['nombre_de_usuario'] = $this->empleado_model->getName($username);
        $data['is_admin']   = $this->tank_auth->is_admin();
		$data['panelheading'] = "Adscripciones";
		$data['index'] = "adscripciones/index";

		///PAGINACION
		$config["base_url"] = base_url() . "adscripciones/index";
		$total_row = $this->adscripcion_model->count();
		$config["total_rows"] = $total_row;
		$config["per_page"] = 6;
		$config['use_page_numbers'] = TRUE;
		$config['num_links'] = $total_row;
		$config['cur_tag_open'] = '<li class="active"><a href="#">';
	    $config['cur_tag_close'] = '</a></li>';
	    $config['num_tag_open'] = '<li>';
	    $config['num_tag_close'] = '</li>';
	    $config['last_link'] = FALSE;
	    $config['first_link'] = FALSE;
	    $config['next_link'] = '&raquo;';
	    $config['next_tag_open'] = '<li>';
	    $config['next_tag_close'] = '</li>';
	    $config['prev_link'] = '&laquo;';
	    $config['prev_tag_open'] = '<li>';
	    $config['prev_tag_close'] = '</li>';
		$this->pagination->initialize($config); 
		  
		if($this->uri->segment(3)){
			$page = ($this->uri->segment(3)) ;
		}
		else{
			$page = 1;
		}

		$data['adscripciones'] = $this->adscripcion_model->order_by('adscripcion', 'ASC')->paginate($config["per_page"],$total_row);

		
		$this->load->view('layouts/index', $data);

		
	}
	public function add() {
		
		$this->form_validation->set_rules('adscripcion', 'Codigo de Adscripcion', 'trim|required|numeric|min_length[2]|max_length[3]');
		$this->form_validation->set_rules('descripcion', 'Descripcion del centro', 'trim|required|min_length[5]|max_length[40]');
		if($this->form_validation->run() == FALSE) {
			$data = array(
					'errors' => validation_errors()
				);
			$this->session->set_flashdata($data);
			echo '<div class="label label-danger" role="alert">Llene todos los campos correctamente</div>';
		}
		else {
			$adscripcion 	= $this->input->post('adscripcion');
			$descripcion 	= strtoupper($this->input->post('descripcion'));

			$this->adscripcion_model->insert(array(
				'adscripcion' => $adscripcion,
				'descripcion' => $descripcion
			
			));
			echo '<div class="label label-success" role="alert">Adscripcion capturada satisfactoriamente</div>';
		}



	}

		public function delete($id) {

		
		$this->adscripcion_model->delete($id);
		$this->session->set_flashdata('correct', 'Borrado Exitosamente');

		redirect('adscripciones');
	
	}
	public function edit($id){
		if ($this->uri->segment(3) != '') {
			$id = $this->uri->segment(3);
			$data['actualizar'] = $this->adscripcion_model->get_one($id);
						
			$this->load->view('adscripciones/form_update', $data);	
		}
		
	}
	public function update() {
		
		$this->form_validation->set_rules('adscripcion', 'Codigo de Adscripcion', 'trim|required|numeric|min_length[2]|max_length[5]');
		$this->form_validation->set_rules('descripcion', 'Descripcion del centro', 'trim|required|min_length[5]|max_length[40]');
		
		if($this->form_validation->run() == FALSE) {
			$data = array(
					'errors' => validation_errors()
				);
			$this->session->set_flashdata($data);
			echo '<div class="label label-danger" role="alert">Llene todos los campos correctamente</div>';
		}
		else {

			$id	   		     = $this->input->post('id');
			$adscripcion     = $this->input->post('adscripcion');
			$descripcion 	 = strtoupper($this->input->post('descripcion'));

			$this->adscripcion_model->update(array(
					'adscripcion' => $adscripcion,
					'descripcion' => $descripcion),
					$id
				
				);

			echo '<div class="label label-success" role="alert">Adscripcion actualizada satisfactoriamente</div>';
		}
	
	}

	  
		

}

/* End of file qnasController.php */
/* Location: ./application/controllers/qnasController.php */