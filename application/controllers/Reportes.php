<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Reportes extends My_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('qna_model');
		$this->load->library('m_pdf');	
			
	}

	public function por_empleado()
	{
		$data['user_id']    = $this->tank_auth->get_user_id();
        $this->load->model('empleado_model');
        $username   = $this->tank_auth->get_username();
        $data['nombre_de_usuario'] = $this->empleado_model->getName($username);
        $data['is_admin']   = $this->tank_auth->is_admin();

		$data['panelheading'] = "Reportes por empleado";
		
		$data['index'] = "reportes/por_empleado";
		

		

		$this->load->view('layouts/index', $data);	

	}
	public function general()
	{
	    $this->load->model('empleado_model');
	    $this->load->helper('dropdown');
        $this->load->model('qna_model');
        $this->load->model('adscripcion_model');
        $this->load->model('admin/capturas');
    	$data['user_id']    = $this->tank_auth->get_user_id();
        $username   = $this->tank_auth->get_username();
        $data['nombre_de_usuario'] = $this->empleado_model->getName($username);
        $data['is_admin']   = $this->tank_auth->is_admin();
        $centros = explode(",",$this->tank_auth->get_user_centros());
        $data['qnas'] = listData('qnas','id','qna_mes' ,'qna_year','DESC','/');
        
      	$data['get_all_centros'] = $this->adscripcion_model->getCentros($centros);
      	

		$data['panelheading'] = "Reporte General";
		
		$data['index'] = "reportes/general";
		
		$this->load->view('layouts/index', $data);	

}
	public function show(){
	

		$this->load->model('captura_model');
		$this->load->model('empleado_model');
		$this->load->model('qna_model');
		$data['user_id']    = $this->tank_auth->get_user_id();
        $username   = $this->tank_auth->get_username();
        $data['nombre_de_usuario'] = $this->empleado_model->getName($username);
        $data['is_admin']   = $this->tank_auth->is_admin();

	
		$centro_id 	  = $this->input->post('centro');
		$qna_id  	  = $this->input->post('qna_id');

        $username   = $this->tank_auth->get_username();
        $data['nombre_de_usuario'] = $this->empleado_model->getName($username);
        $data['qna'] = $this->qna_model->where('id', $qna_id)->get();
		$link = $qna_id.'/'.$centro_id;
		$data['panelheading'] = "Reporte QNA:    ".
							$data['qna']->qna_mes.'/'.
							$data['qna']->qna_year.' - '.
							$data['qna']->qna_descripcion.
							'<div class="acrobat pull-right">'.
							anchor('reportes/generar_pdf/'.$link, '<i class="fa fa-file-pdf-o "></i>').
							'</div>'
							;
		$centros = explode(",",$this->tank_auth->get_user_centros());
		$data['reporte'] = $this->captura_model->get_report($qna_id, $centro_id);
		$data['index'] = 'qnas/reporte';

		$this->load->view('layouts/index', $data);	
	}

    public function delete($token) {
    $this->load->model('captura_model');
    if ($this->uri->segment(4)) {
      $qna_id = $this->uri->segment(4);

      $this->captura_model->where('token', $token)->delete();
      
      redirect('qnas/report/'.$qna_id);
    }
    redirect('qnas/report/'.$qna_id);
  
  }
  public function generar_pdf(){
	$params = "('', 'Letter', 0, '', 12.7, 12.7, 14, 12.7, 8, 8)";
	$pdf = $this->m_pdf->load($params);
	$user_id    = $this->tank_auth->get_user_id();
	if ($this->uri->segment(3) != '' && $this->uri->segment(4) != '') {
		$qna_id = $this->uri->segment(3);
		$centro_id = $this->uri->segment(4);
	}
	$this->load->model('captura_model');
	$this->load->model('empleado_model');
	$this->load->model('qna_model');
    $username   = $this->tank_auth->get_username();
    $data['nombre_de_usuario'] = $this->empleado_model->getName($username);
    $data['qna'] = $this->qna_model->where('id', $qna_id)->get();
	
	//$centros_id = explode(",",$this->tank_auth->get_user_centros());
	$data['reporte'] = $this->captura_model->get_report($qna_id, $centro_id);

	 //load the view and saved it into $html variable
	$html=$this->load->view('qnas/report_pdf', $data, true);
	
	//this the the PDF filename that user will get to download
	$data['reporte2'] = $this->captura_model->get_report2($qna_id, $centro_id);
	$pdf->setAutoTopMargin = 'stretch';
  	$pdf->setAutoBottomMargin = 'stretch';
  	
  	$pdfFilePath = $data['reporte2']->qna_mes.'-'.$data['reporte2']->qna_year.'-'.$data['reporte2']->descripcion.'.pdf';
  	
  	$header = $this->load->view('reportes/header', $data, true);
	$pdf->setHTMLHeader($header);
  	$pdf->SetFooter($data['reporte2']->descripcion.'|Generado el: {DATE j-m-Y} |Hoja {PAGENO} de {nb}');
	//load mPDF library
	$pdf->SetDisplayMode('fullpage');
	
	//generate the PDF from the given html
	$pdf->WriteHTML($html);
	 
	//download it.
	$pdf->Output($pdfFilePath, "D");
 
}
	public function sin_derecho(){
		$this->load->model('empleado_model');
		$this->load->model('captura_model');
		$data['user_id']    = $this->tank_auth->get_user_id();
	    $username   = $this->tank_auth->get_username();
	    $data['nombre_de_usuario'] = $this->empleado_model->getName($username);
	    $data['is_admin']   = $this->tank_auth->is_admin();
	    //$data['sin_derecho'] = $this->captura_model->get_sin_derecho($fecha_inicio, $fecha_final);





	    $data['panelheading'] = "Reporte Sin derecho a nota buena por desempeno";
	    $data['index'] = 'reportes/sin_derecho';
		$this->load->view('layouts/index', $data);	
	}
	public function get_reporte_sin_derecho(){
		$this->load->model('captura_model');
		$this->load->model('empleado_model');
		$this->load->model('reporte_model');
	
		$data['user_id']    = $this->tank_auth->get_user_id();
	    $username   = $this->tank_auth->get_username();
	    $data['nombre_de_usuario'] = $this->empleado_model->getName($username);
	    $data['is_admin']   = $this->tank_auth->is_admin();

		$fecha_inicial  = fecha_ymd($this->input->post('fecha_inicial'));
        $fecha_final  = fecha_ymd($this->input->post('fecha_final'));
		$centros = explode(",",$this->tank_auth->get_user_centros());
		$array = "01,02,03,04,08,09,10,18,19,25,40,41,46,47,53,54,55,79";
		$data['inc2'] = explode(",",$array);
		
		$array = "40,41,46,47,53,54,55";
		$inc = explode(",",$array);
		$sin_derecho_lic = $this->reporte_model->get_sin_derecho($fecha_inicial, $fecha_final,$inc,$centros);
		
		$array = "01,02,03,04,08,09,10,18,19,25,79";
		$data['inc'] = explode(",",$array);
		$sin_derecho_inc = $this->reporte_model->get_sin_derecho_inc($fecha_inicial, $fecha_final,$data['inc'],$centros);		
		
		$obj_merged = array_merge($sin_derecho_lic, $sin_derecho_inc);
		$data['sortedObjectArray'] = PHPArrayObjectSorter($obj_merged,'num_empleado','asc');
	    $data['panelheading'] = "Reporte Sin derecho a nota buena por desempeno del: ".fecha_dma($fecha_inicial).' Al '.fecha_dma($fecha_final);
	    $data['index'] = 'reportes/reporte_sin_derecho';
		$this->load->view('layouts/index', $data);	
	}

	public function search(){
    	$data['user_id']    = $this->tank_auth->get_user_id();
        $this->load->model('empleado_model');
        $this->load->helper('dropdown');
        $username   = $this->tank_auth->get_username();
        $data['nombre_de_usuario'] = $this->empleado_model->getName($username);
        $data['is_admin']   = $this->tank_auth->is_admin();
    	$data['panelheading'] = "Reporte Sin derecho a nota buena por desempeno";
		
		$centros = explode(",",$this->tank_auth->get_user_centros());
       	$data['empleado'] = $this->empleado_model->get_search($centros);
		
		if (empty($data['empleado'])) {
			$data['noencontrado'] = " <strong><i class='fa fa-exclamation-triangle'></i> Atencion!</strong><br>Empleado no encontrado o no pertenece a su adscripcion<br>Informacion en Recursos Humanos";
			$data['empleado'] = NULL;
		}
		$data['options'] = listData('adscripciones','id','adscripcion' ,'descripcion','ASC',' - ');
		 $data['index'] = 'reportes/sin_derecho';
		$this->load->view('layouts/index', $data);
		
	}
		

}

/* End of file qnasController.php */
/* Location: ./application/controllers/qnasController.php */