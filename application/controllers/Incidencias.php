<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require 'admin_base.php';
class Incidencias extends admin_base {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('incidencia_model');
		
	}

	public function index()
	{
		$data['user_id']    = $this->tank_auth->get_user_id();
        $this->load->model('empleado_model');
        $username   = $this->tank_auth->get_username();
        $data['nombre_de_usuario'] = $this->empleado_model->getName($username);
        $data['is_admin']   = $this->tank_auth->is_admin();
		$data['panelheading'] = "Tipos de Incidencias";
		$data['index'] = "incidencias/index";
		
		///PAGINACION
		$config["base_url"] = base_url() . "incidencias/index";
		$total_row = $this->incidencia_model->count();
		$config["total_rows"] = $total_row;
		$config["per_page"] = 8;
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

		$data['incidencias'] = $this->incidencia_model->order_by('incidencia_cod','ASC')->paginate($config["per_page"],$total_row);

		$this->load->view('layouts/index', $data);

		
	}
	public function add() {
		
		$this->form_validation->set_rules('incidencia_cod', 'Codigo de Incidencia', 'trim|required|numeric|min_length[1]|max_length[3]');
		$this->form_validation->set_rules('inc_descripcion', 'Descripcion', 'trim|required|min_length[4]|max_length[80]');
		$this->form_validation->set_rules('grupo', 'Grupo', 'trim|required');
		if($this->form_validation->run() == FALSE) {
			$data = array(
					'errors' => validation_errors()
				);
			$this->session->set_flashdata($data);
			echo '<div class="label label-danger" role="alert">Llene todos los campos correctamente</div>';
		}
		else {
			$codigo 	= $this->input->post('incidencia_cod');
			$descripcion 	= strtoupper($this->input->post('inc_descripcion'));
			$grupo 	= $this->input->post('grupo');

			$this->incidencia_model->insert(array(
				'incidencia_cod' => $codigo,
				'inc_descripcion' => $descripcion,
				'grupo' => $grupo,
			
			));
			echo '<div class="label label-success" role="alert">Incidencia actualizada satisfactoriamente</div>';
		}
	}
	public function delete($id) {

		
		$this->incidencia_model->delete($id);
		$this->session->set_flashdata('correct', 'Borrado Exitosamente');
		redirect('incidencias');
		
	
	}
	public function edit($id){
		if ($this->uri->segment(3) != '') {
			$id = $this->uri->segment(3);
			$data['actualizar'] = $this->incidencia_model->get_one($id);
						
			$this->load->view('incidencias/form_update', $data);	
		}
		
	}
	public function update() {
		$this->form_validation->set_rules('incidencia_cod', 'Codigo de Incidencia', 'trim|required|numeric|min_length[1]|max_length[3]');
		$this->form_validation->set_rules('inc_descripcion', 'Descripcion', 'trim|required|min_length[4]|max_length[80]');
		$this->form_validation->set_rules('grupo', 'Grupo', 'trim|required');
		if($this->form_validation->run() == FALSE) {
			$data = array(
					'errors' => validation_errors()
				);
			$this->session->set_flashdata($data);
			echo '<div class="label label-danger" role="alert">Llene todos los campos correctamente</div>';
		}
		else {



			$id	   		     	= $this->input->post('id');
			$incidencia_cod     = $this->input->post('incidencia_cod');
			$inc_descripcion 	= strtoupper($this->input->post('inc_descripcion'));
			$grupo 	= $this->input->post('grupo');

			$this->incidencia_model->update(array(
					'incidencia_cod' => $incidencia_cod,
					'inc_descripcion' => $inc_descripcion,
					'grupo' => $grupo),
					$id
				
				);

			echo '<div class="label label-success" role="alert">Incidencia actualizada satisfactoriamente</div>';
		}
	
	}
    
		

}

/* End of file qnasController.php */
/* Location: ./application/controllers/qnasController.php */