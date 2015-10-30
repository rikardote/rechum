<?php
error_reporting(E_ALL | E_WARNING | E_NOTICE);
ini_set('display_errors', TRUE);
defined('BASEPATH') OR exit('No direct script access allowed');

class Captura extends My_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('captura_model');
		
	}
	

	public function index()
	{	
		$this->load->helper('dropdown');
		$data['user_id']    = $this->tank_auth->get_user_id();
        $this->load->model('empleado_model');
        $username   = $this->tank_auth->get_username();
        $data['nombre_de_usuario'] = $this->empleado_model->getName($username);

		$data['is_admin']   = $this->tank_auth->is_admin();
		$data['panelheading'] = "Captura de Incidencias";
		
		$data['index'] = "capturar/index";
		$this->load->view('layouts/index', $data);
		
	}
	public function show() {
		$data['user_id']    = $this->tank_auth->get_user_id();
       	$this->load->model('empleado_model');
       	$this->load->helper('dropdown');
        $username   = $this->tank_auth->get_username();
        $data['nombre_de_usuario'] = $this->empleado_model->getName($username);

		$data['panelheading'] = "Captura de incidencias";

		if ($this->uri->segment(3) != '' && $this->uri->segment(4) != '') {
			$id = $this->uri->segment(3);
			$qna = $this->uri->segment(4);
			$this->load->model('qna_model');
			$data['qna'] = $this->qna_model->get($qna);
			if ($data['qna']->activa) {
				$data['index'] = "capturar/show";
			}
			else {
				redirect('captura/index');
			}
			
		}
		else{
			$id = $this->uri->segment(3);
			$data['index'] = "capturar";
		}
			
			$data['empleado'] = $this->captura_model->get_empleado_join($id);
			$this->load->helper('dropdown');
			$data['options'] = listData('incidencias','id','incidencia_cod' ,'inc_descripcion','ASC',' - ');
			$data['periodos'] = listData2('periodos','id','period' ,'year');
					
			$data['capturas'] = $this->captura_model->get_incidencias($id,$qna);

			$this->load->view('layouts/index', $data);
	}
	

	public function add() {
		$capturado_por    =  $this->tank_auth->get_username();
		$qna_id  	  = $this->input->post('qna_id');
		$empleado_id  = $this->input->post('empleado_id');
		$qna_id  	  = $this->input->post('qna_id');
		$empleado_id  = $this->input->post('empleado_id');
		$fecha_inicial  = $this->input->post('fecha_inicial');
		$fecha_final  = $this->input->post('fecha_final');
		$token = generateRandomString();
		$fechaInicio	= fecha_ymd($fecha_inicial);
		$fechaFin	= fecha_ymd($fecha_final);
		
		$fechaInicio=strtotime($fechaInicio);
		$fechaFin=strtotime($fechaFin);

		$this->form_validation->set_rules('qna_id', 'qna id', 'trim|required|xss_clean|numeric');
		$this->form_validation->set_rules('incidencia_id','Incidencia', 'required|xss_clean|callback_require_dropdown');
		$this->form_validation->set_rules('fecha_inicial', 'Fecha Inicial', 'trim|xss_clean|required');
		$this->form_validation->set_rules('fecha_final', 'Fecha Final', 'trim|required|xss_clean|callback_validate_dates');
		$this->form_validation->set_message('validate_dates', 'Error en fechas intente nuevamente');
		$this->form_validation->set_rules('validar_ya_capturado','callback_validar_ya_capturado');
//VALIDANDO PERIODO VACACIONAL		
		$this->load->model('incidencia_model');
		$incidencia_id = $this->input->post('incidencia_id');
   		$data['incidencia'] = $this->incidencia_model->where('id', $incidencia_id)->get();
       	$periodo  = $this->input->post('periodo_id');
       	if ($data['incidencia']->incidencia_cod == 60 || $data['incidencia']->incidencia_cod == 62 || $data['incidencia']->incidencia_cod == 63 ) {
           	$this->form_validation->set_rules('periodo_id','periodo', 'required|xss_clean|callback_require_dropdown2');
       	} else {
			$periodo  = 10;
       	}
///////////////////////////////

		if($this->form_validation->run() == FALSE) {
			$data = array(
					'errors' => validation_errors()
				);
			$this->session->set_flashdata($data);
			echo "Error intente de nuevo";
			
			
		}
		else {
			
        	
			$test = $this->captura_model->verificar_ya_capturado($qna_id,$empleado_id,$incidencia_id,fecha_ymd($fecha_inicial),fecha_ymd($fecha_final));
			if ($test == NULL){
				for($i=$fechaInicio; $i<=$fechaFin; $i+=86400){
				 	
				 	$fecha = date("Y-m-d", $i);
					$this->captura_model->insert(array(
						'qna_id' => $qna_id,
						'empleado_id' => $empleado_id,
						'incidencia_id' => $incidencia_id,
						'fecha_inicial' => $fecha,
						'fecha_final' => fecha_ymd($fecha_final),
						'periodo_id' => $periodo,
						'token' => $token,
						'capturado_por' => $capturado_por,

					));
				}
				
			$data['capturas'] = $this->captura_model->get_incidencias($empleado_id,$qna_id);
			$this->load->view('capturar/ver_incidencias', $data);
			}else{
				$this->form_validation->set_message('', 'Incidencia ya Capturada');
				$this->session->set_flashdata($data);
				echo "Incidencia ya capturada";

			}
			
					 
		}
	}

	public function delete($token) {

		if ($this->uri->segment(4) != '' && $this->uri->segment(5) != '') {
			$empleado_id = $this->uri->segment(4);
			$qna_id = $this->uri->segment(5);
			//$this->captura_model->borrar_incidencias($token);
			$this->captura_model->where('token', $token)->delete();
			
			$this->session->set_flashdata('correct', 'Borrado Exitosamente');

			redirect('captura/show/'.$empleado_id.'/'.$qna_id);
		}
	
	}

	public function search(){
		$data['user_id']    = $this->tank_auth->get_user_id();
       	$this->load->model('empleado_model');
        $username   = $this->tank_auth->get_username();
        $data['nombre_de_usuario'] = $this->empleado_model->getName($username);
    	$data['panelheading'] = "Captura de Incidencias";
		
		
		$centros = explode(",",$this->tank_auth->get_user_centros());
       		$data['empleado'] = $this->captura_model->get_search($centros);
		if (empty($data['empleado'])) {
			$data['noencontrado'] = " <strong>Atencion!</strong><br>Empleado no encontrado o no pertenece a su adscripcion<br>Informacion en Recursos Humanos";
			$data['empleado'] = NULL;
		}
		$this->load->model('qna_model');
		$data['qnas_activas'] = $this->qna_model->where('activa','1')->order_by('qna_mes','DESC')->get_all();

		$data['index'] = "capturar/index";
		$this->load->view('layouts/index', $data);
		
	}
	function require_dropdown($str) { 
        if ($str == 0) {
        	$this->form_validation->set_message('require_dropdown', 'Selecciona una Incidencia');
            return FALSE;
        } else {
            return TRUE;

        }
    }
    function require_dropdown2($str) { 
        if ($str == 0) {
        	$this->form_validation->set_message('require_dropdown2', 'Selecciona un Periodo');
            return FALSE;
        } else {
            return TRUE;

        }
    }

    function validate_dates(){
      
      $fecha_inicial  = $this->input->post('fecha_inicial');
      $fecha_final  = $this->input->post('fecha_final');
      
      $fecha1 = fecha_ymd($fecha_inicial);
      $fecha2 = fecha_ymd($fecha_final);

      $fecha1 = strtotime($fecha1);
      $fecha2 = strtotime($fecha2);

      return ($fecha1 > $fecha2)? FALSE : TRUE;
    
    }  
 	

}

/* End of file capturaController.php */
/* Location: ./application/controllers/capturaController.php */