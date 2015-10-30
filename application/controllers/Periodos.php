<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require 'admin_base.php';
class Periodos extends admin_base {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('periodo_model');
		
		
	}

	public function index()
	{
		$data['user_id']    = $this->tank_auth->get_user_id();
        $this->load->model('empleado_model');
        $username   = $this->tank_auth->get_username();
        $data['nombre_de_usuario'] = $this->empleado_model->getName($username);
		$data['is_admin']   = $this->tank_auth->is_admin();
		$data['panelheading'] = "Periodos";
		$data['index'] = "periodos/index";

		///PAGINACION
		$config["base_url"] = base_url() . "periodos/index";
		$total_row = $this->periodo_model->count();
		$config["total_rows"] = $total_row;
		$config["per_page"] = 4;
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

		$data['periodos'] = $this->periodo_model->order_by('year', 'DESC')->order_by('period', 'DESC')->paginate($config["per_page"],$total_row);

		
		$this->load->view('layouts/index', $data);

		
	}
	public function add() {
		
		$this->form_validation->set_rules('period', 'Periodo', 'trim|required|numeric|min_length[1]|max_length[2]');
		$this->form_validation->set_rules('year', 'Ano', 'trim|required|min_length[4]|max_length[4]');
		if($this->form_validation->run() == FALSE) {
			$data = array(
					'errors' => validation_errors()
				);
			$this->session->set_flashdata($data);
			echo '<div class="label label-danger" role="alert">Llene todos los campos correctamente</div>';
		}
		else {
			$periodo 	= $this->input->post('period');
			$year 	= strtoupper($this->input->post('year'));

			$this->periodo_model->insert(array(
				'period' => $periodo,
				'year' => $year
			
			));
			echo '<div class="label label-success" role="alert">Periodo capturado satisfactoriamente</div>';
		}



	}

		public function delete($id) {

		
		$this->periodo_model->delete($id);
		$this->session->set_flashdata('correct', 'Borrado Exitosamente');

		redirect('periodos');
	
	}
	public function edit($id){
		if ($this->uri->segment(3) != '') {
			$id = $this->uri->segment(3);
			$data['actualizar'] = $this->periodo_model->get($id);
						
			$this->load->view('periodos/form_update', $data);	
		}
		
	}
	public function update() {
		
		$this->form_validation->set_rules('period', 'Periodo', 'trim|required|numeric|min_length[1]|max_length[2]');
		$this->form_validation->set_rules('year', 'Ano', 'trim|required|min_length[4]|max_length[4]');
		if($this->form_validation->run() == FALSE) {
			$data = array(
					'errors' => validation_errors()
				);
			$this->session->set_flashdata($data);
			echo '<div class="label label-danger" role="alert">Llene todos los campos correctamente</div>';
		}
		else {
			$periodo 	= $this->input->post('periodo');
			$year 	= strtoupper($this->input->post('year'));

			$id	   		     = $this->input->post('id');
			

			$this->periodo_model->update(array(
					'period' => $periodo,
					'year' => $year),
					$id
				
				);

			echo '<div class="label label-success" role="alert">Periodo actualizado satisfactoriamente</div>';
		}
	
	}
	public function activate(){
		if ($this->uri->segment(3) != '') {
			$id = $this->uri->segment(3);
			$activate = $this->periodo_model->get_one($id);
		}
		$activo = ($activate->activo) ? FALSE : TRUE; 
		
		$this->periodo_model->update(array(
					'activo' => $activo),
					$id
				);
		redirect('periodos');
	}

	  
		

}

/* End of file qnasController.php */
/* Location: ./application/controllers/qnasController.php */