<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class Empleados extends MY_Controller {
	public function __construct()
	{

		parent::__construct();
		$this->load->model('empleado_model');
		$this->load->helper('dropdown');
	

	
	}

	public function index()
	{			
		$data['user_id']    = $this->tank_auth->get_user_id();
    
        $username   = $this->tank_auth->get_username();
        $data['nombre_de_usuario'] = $this->empleado_model->getName($username);
		$data['is_admin']   = $this->tank_auth->is_admin();
		$data['panelheading'] = "Empleados";
		$data['options'] = listData('adscripciones','id','adscripcion' ,'descripcion','ASC',' - ');
		$this->load->model('puesto_model');
        $this->load->model('horario_model');
		$data['horarios'] = $this->horario_model->as_dropdown('horario')->order_by('horario', 'ASC')->get_all();
		$data['puestos'] = $this->puesto_model->as_dropdown('puesto')->get_all();
		$data['index'] = "empleados/index";
		$this->load->view('layouts/index', $data);
		

	}
	public function show($id) {
		$data['user_id']    = $this->tank_auth->get_user_id();
        $this->load->model('pase_model');
        $this->load->model('qna_model');
        $username   = $this->tank_auth->get_username();
        $data['nombre_de_usuario'] = $this->empleado_model->getName($username);
	    $data['is_admin']   = $this->tank_auth->is_admin();
		if ($this->uri->segment(3) != '') {
			$id = $this->uri->segment(3);
		}
		$data['empleado_id'] = $id;
		$data['pases'] = $this->pase_model->get_pases($id);
		$data['qnas'] = listData2('qnas','id','qna_mes' ,'qna_year','activa');

		$data['empleado'] = $this->empleado_model->get_empleado_join($id);
		$data['options'] = listData('adscripciones','id','adscripcion' ,'descripcion','ASC',' - ');
		$data['index'] = "empleados/show";


		$this->load->model('puesto_model');
        $this->load->model('horario_model');
		$data['horarios'] = $this->horario_model->as_dropdown('horario')->order_by('horario', 'ASC')->get_all();
		$data['puestos'] = $this->puesto_model->as_dropdown('puesto')->get_all();
		$data['panelheading'] = "Empleados";
			
		$this->load->view('layouts/index', $data);
		
	}

	public function add() {
		
		$this->form_validation->set_rules('num_empleado', 'Numero de empleado', 'trim|required|xss_clean|numeric|min_length[5]|max_length[6]');
		$this->form_validation->set_rules('nombres', 'Nombre(s)', 'trim|required|min_length[4]|xss_clean|max_length[20]');
		$this->form_validation->set_rules('apellido_pat', 'Apellido Paterno', 'trim|required|xss_clean|min_length[4]|max_length[20]');
		$this->form_validation->set_rules('apellido_mat', 'Apellido Materno', 'trim|required|xss_clean|min_length[4]|max_length[20]');
		$this->form_validation->set_rules('adscripcion_id','Adscripcion', 'required|xss_clean|callback_require_dropdown');
		
		
		if($this->form_validation->run() == FALSE) {
			$data = array(
					'errors' => validation_errors()
				);
			$this->session->set_flashdata($data);
			echo '<div class="label label-danger" role="alert">Llene todos los campos correctamente</div>';
			
		}
		else {
			
			$num_empleado 	= $this->input->post('num_empleado');
			$nombres 		= strtoupper($this->input->post('nombres'));
			$apellido_pat 	= strtoupper($this->input->post('apellido_pat'));
			$apellido_mat 	= strtoupper($this->input->post('apellido_mat'));
			$adscripcion_id = $this->input->post('adscripcion_id');
			$activo 		= 1;//$this->input->post('activo');
			$horario_id 	= $this->input->post('horario_id');
			$puesto_id 		= $this->input->post('puesto_id');
			$adscripcion_id = $this->input->post('adscripcion_id');
		

			$this->empleado_model->insert(array(
				'num_empleado' => $num_empleado,
				'nombres' => $nombres,
				'apellido_pat' => $apellido_pat,
				'apellido_mat' => $apellido_mat,
				'adscripcion_id' => $adscripcion_id,
				'horario_id' => $horario_id,
				'puesto_id' => $puesto_id,
				'num_seguro' => $num_seguro,
				'num_plaza' => $num_plaza,
				'activo' => $activo
			));
	

			$insert_id = $this->db->insert_id();

			if (isset($insert_id)) {
				//redirect('empleados/'.$insert_id,'refresh'); 
				echo $insert_id;
				
			}
		

		}

	}
	public function edit($id){
		if ($this->uri->segment(3) != '') {
			$id = $this->uri->segment(3);
			
			$data['options'] = listData('adscripciones','id','adscripcion' ,'descripcion','ASC',' - ');
			$data['actualizar'] = $this->empleado_model->get_empleado_join($id);
			$this->load->model('puesto_model');
        	$this->load->model('horario_model');
			$data['horarios'] = $this->horario_model->as_dropdown('horario')->order_by('horario', 'ASC')->get_all();
			$data['puestos'] = $this->puesto_model->as_dropdown('puesto')->get_all();
			$this->load->view('empleados/form_update', $data);	
		}
		
	}



	public function update() {
		
		$this->form_validation->set_rules('num_empleado', 'Numero de empleado', 'trim|required|numeric|min_length[5]|max_length[6]');
		$this->form_validation->set_rules('nombres', 'Nombre(s)', 'trim|required|min_length[4]|max_length[20]');
		$this->form_validation->set_rules('apellido_pat', 'Apellido Paterno', 'trim|required|min_length[4]|max_length[20]');
		$this->form_validation->set_rules('apellido_mat', 'Apellido Materno', 'trim|required|min_length[4]|max_length[20]');
		$this->form_validation->set_rules('adscripcion_id','Adscripcion', 'required|callback_require_dropdown');
		
		
		if($this->form_validation->run() == FALSE) {
			$data = array(
					'errors' => validation_errors()
				);
			$this->session->set_flashdata($data);
			echo '<div class="label label-danger" role="alert">Llene todos los campos correctamente</div>';
			
		}
		else {
			$id	   		    = $this->input->post('id');
			$num_empleado 	= $this->input->post('num_empleado');
			$num_seguro 	= $this->input->post('num_seguro');
			$num_plaza	 	= $this->input->post('num_plaza');
			$nombres 		= strtoupper($this->input->post('nombres'));
			$apellido_pat 	= strtoupper($this->input->post('apellido_pat'));
			$apellido_mat 	= strtoupper($this->input->post('apellido_mat'));
			$horario_id 	= $this->input->post('horario_id');
			$puesto_id 		= $this->input->post('puesto_id');
			$adscripcion_id = $this->input->post('adscripcion_id');
			$activo 		= $this->input->post('activo');

			$this->empleado_model->update(array(
				'num_empleado' => $num_empleado,
				'nombres' => $nombres,
				'apellido_pat' => $apellido_pat,
				'apellido_mat' => $apellido_mat,
				'adscripcion_id' => $adscripcion_id,
				'horario_id' => $horario_id,
				'puesto_id' => $puesto_id,
				'num_seguro' => $num_seguro,
				'num_plaza' => $num_plaza),
				$id
			);

			echo '<div class="label label-success" role="alert">Adscripcion actualizada satisfactoriamente</div>';
		}
	
	}
	public function delete(){
		if ($this->uri->segment(3) != '') {
			$id = $this->uri->segment(3);
			$activate = $this->empleado_model->get_one($id);
		}
		$activo = ($activate->activo) ? FALSE : TRUE; 
		
		$this->empleado_model->update(array(
					'activo' => $activo),
					$id
				);
		redirect('empleados/'.$id);
		
	
	}



	function require_dropdown($str) { 
        if ($str == 0) {
            $this->form_validation->set_message('require_dropdown', 'Selecciona una adscripcion');
            return FALSE;
        } else {
            return TRUE;

        }
    }
    public function search(){
    	$data['user_id']    = $this->tank_auth->get_user_id();
       
        $username   = $this->tank_auth->get_username();
        $data['nombre_de_usuario'] = $this->empleado_model->getName($username);
        $data['is_admin']   = $this->tank_auth->is_admin();
    	$data['panelheading'] = "Empleados";
		
		$centros = explode(",",$this->tank_auth->get_user_centros());
       	$data['empleado'] = $this->empleado_model->get_search($centros);
		
		if (empty($data['empleado'])) {
			$data['noencontrado'] = " <strong><i class='fa fa-exclamation-triangle'></i> Atencion!</strong><br>Empleado no encontrado o no pertenece a su adscripcion<br>Informacion en Recursos Humanos";
			$data['empleado'] = NULL;
		}
		$data['options'] = listData('adscripciones','id','adscripcion' ,'descripcion','ASC',' - ');
		$data['index'] = "empleados/index";
		$this->load->view('layouts/index', $data);
		
	}
	public function agregar_pase(){
		$this->load->model('pase_model');
		
		$qna_id 	= $this->input->post('qna_id');
		$empleado_id 	= $this->input->post('empleado_id');
		$motivo 	= $this->input->post('motivo');
		$horario 	= $this->input->post('horario');
		$fecha_salida 	= fecha_ymd($this->input->post('fecha_salida'));

		$this->pase_model->insert(array(
				'qna_id' => $qna_id,
				'empleado_id' => $empleado_id,
				'motivo' => $motivo,
				'horario' => $horario,
				'fecha_salida' => $fecha_salida,
				
			));
		$data['pases'] = $this->pase_model->get_pases($empleado_id);
		$this->load->view('empleados/show_pases', $data);
	}
	public function delete_pase(){
		$this->load->model('pase_model');
		$id 	= $this->input->post('id');
		$empleado_id 	= $this->input->post('empleado_id');
		$this->pase_model->delete($id);
		$data['pases'] = $this->pase_model->get_pases($empleado_id);
		$this->load->view('empleados/show_pases', $data);

		
	}
	
	

}

/* End of file qnasController.php */
/* Location: ./application/controllers/qnasController.php */