<?php
// application/controllers/admin.php
require 'admin_base.php';
class Admin extends admin_base {
    
   public function __construct()
   {
     parent::__construct();
    $this->load->model('admin_model');
    $this->load->helper(array('form', 'url'));
    $this->load->library('form_validation');
    $this->load->library('../core/security');
    $this->load->library('tank_auth');
    $this->lang->load('tank_auth');
      
   }
    function index()
    {

    redirect('admin/dashboard');
    }
    function dashboard()
    {
       $data['user_id']    = $this->tank_auth->get_user_id();
       $this->load->model('empleado_model');
        $username   = $this->tank_auth->get_username();
        $data['nombre_de_usuario'] = $this->empleado_model->getName($username);
       $data['panelheading'] = "Dashboard";
       $data['index'] = "admin/dashboard";
       $this->load->view('layouts/index', $data);
    }
    function usuarios(){
       $data['user_id']    = $this->tank_auth->get_user_id();
       $this->load->model('empleado_model');
       $this->load->model('adscripcion_model');
       $username   = $this->tank_auth->get_username();
       $data['nombre_de_usuario'] = $this->empleado_model->getName($username);
       $data['centros'] = $this->adscripcion_model->get_all();
       $data['panelheading'] = "Usuarios";

       $data['users'] = $this->admin_model->get_empleados();
             
       $data['index'] = "admin/usuarios";
       $this->load->view('layouts/index', $data); 

    }
    function addlist(){
      $centros = $this->input->post('listbox1[]');
      $centros = implode(",",$centros);
      echo $centros;
    }
    

    public function activate(){
    if ($this->uri->segment(3) != '') {
      $id = $this->uri->segment(3);
      $activate = $this->admin_model->get_one($id);
    }
    $activa = ($activate->activated) ? FALSE : TRUE; 
    
    $this->admin_model->update(array(
          'activated' => $activa),
          $id
        );
    redirect('admin/usuarios');
  }
  public function activate_admin(){
    if ($this->uri->segment(3) != '') {
      $id = $this->uri->segment(3);
      $activate = $this->admin_model->get_one($id);
    }
    $activa = ($activate->is_admin) ? FALSE : TRUE; 
    
    $this->admin_model->update(array(
          'is_admin' => $activa),
          $id
        );
    redirect('admin/usuarios');
  }
   function estadistica(){
       $this->load->helper('dropdown');
       $this->load->model('empleado_model');
       $this->load->model('qna_model');

       $data['user_id']    = $this->tank_auth->get_user_id();
       
       $username   = $this->tank_auth->get_username();
       $data['nombre_de_usuario'] = $this->empleado_model->getName($username);
       $data['panelheading'] = "Estadistica";
       
       $data['qnas'] = listData('qnas','id','qna_mes' ,'qna_year', 'DESC','/');
       //$data['qnas'] = $this->qna_model->order_by('qna_year','ASC')->order_by('qna_mes','ASC')->get_all();             

       $data['index'] = "admin/estadistica/index";
       $this->load->view('layouts/index', $data); 
  }
  function estadistica_por_centro($qna_id = NULL){
       $this->load->helper('dropdown');
       $this->load->model('empleado_model');
       $this->load->model('qna_model');
       $this->load->model('adscripcion_model');
       $this->load->model('admin/capturas');
      
      
      if ($this->uri->segment(3) != "" && $this->uri->segment(4)) {
            $data['fecha_inicial'] = $this->uri->segment(3);
            $data['fecha_final'] = $this->uri->segment(4);
          
      }
      else {
       $data['fecha_inicial']  = fecha_ymd($this->input->post('fecha_inicial2'));
       $data['fecha_final']  = fecha_ymd($this->input->post('fecha_final2'));
      }
       
       $data['user_id']    = $this->tank_auth->get_user_id();
       $data['get_all_incidencias'] = $this->capturas->get_all_incidencias_fecha($data['fecha_inicial'],$data['fecha_final']);  
       //$data['total'] = $this->capturas->as_array()->where('qna_id',$qna_id)->count();
      
       $username   = $this->tank_auth->get_username();
       $data['nombre_de_usuario'] = $this->empleado_model->getName($username);
       
       $data['panelheading'] = "Estadistica por centro de trabajo";
       
    
       $data['index'] = "admin/estadistica/por_centro";
       $this->load->view('layouts/index', $data); 
  }
  function estadistica_totales(){
      $this->load->helper('dropdown');
       $this->load->model('empleado_model');
       $this->load->model('qna_model');
       $this->load->model('adscripcion_model');
       $this->load->model('admin/capturas');
      
       if ($this->uri->segment(3) != "" && $this->uri->segment(4) != "" ){
          $qna_id = $this->uri->segment(3);
          $adscripcion_id = $this->uri->segment(4);
          $data['total_10'] = $this->capturas->get_total_incidencias_por_concepto($qna_id,$adscripcion_id,10);
          $data['total_14'] = $this->capturas->get_total_incidencias_por_concepto($qna_id,$adscripcion_id,14);
          $data['total_17'] = $this->capturas->get_total_incidencias_por_concepto($qna_id,$adscripcion_id,17);
          $data['total_40'] = $this->capturas->get_total_incidencias_por_concepto($qna_id,$adscripcion_id,40);
          $data['total_41'] = $this->capturas->get_total_incidencias_por_concepto($qna_id,$adscripcion_id,41);
          $data['total_46'] = $this->capturas->get_total_incidencias_por_concepto($qna_id,$adscripcion_id,46);
          $data['total_47'] = $this->capturas->get_total_incidencias_por_concepto($qna_id,$adscripcion_id,47);
          $data['total_48'] = $this->capturas->get_total_incidencias_por_concepto($qna_id,$adscripcion_id,48);
          $data['total_49'] = $this->capturas->get_total_incidencias_por_concepto($qna_id,$adscripcion_id,49);
          $data['total_51'] = $this->capturas->get_total_incidencias_por_concepto($qna_id,$adscripcion_id,51);
          $data['total_53'] = $this->capturas->get_total_incidencias_por_concepto($qna_id,$adscripcion_id,53);
          $data['total_54'] = $this->capturas->get_total_incidencias_por_concepto($qna_id,$adscripcion_id,54);
          $data['total_55'] = $this->capturas->get_total_incidencias_por_concepto($qna_id,$adscripcion_id,55);
          $data['total_60'] = $this->capturas->get_total_incidencias_por_concepto($qna_id,$adscripcion_id,60);
          $data['total_62'] = $this->capturas->get_total_incidencias_por_concepto($qna_id,$adscripcion_id,62);
          $data['total_63'] = $this->capturas->get_total_incidencias_por_concepto($qna_id,$adscripcion_id,63);
          $data['total_94'] = $this->capturas->get_total_incidencias_por_concepto($qna_id,$adscripcion_id,94);
          $data['total_100'] = $this->capturas->get_total_incidencias_por_concepto($qna_id,$adscripcion_id,100);

        }elseif ($this->uri->segment(3) != "" && $this->uri->segment(4) != "" && $this->uri->segment(5) != "" ){
            $adscripcion_id = $this->uri->segment(3);
            $fecha_inicial = $this->uri->segment(4);
            $fecha_final = $this->uri->segment(5);
            $data['total_10'] = $this->capturas->get_total_incidencias_por_concepto2($fecha_inicial,$fecha_final,$adscripcion_id,10);
            $data['total_14'] = $this->capturas->get_total_incidencias_por_concepto2($fecha_inicial,$fecha_final,$adscripcion_id,14);
            $data['total_17'] = $this->capturas->get_total_incidencias_por_concepto2($fecha_inicial,$fecha_final,$adscripcion_id,17);
            $data['total_40'] = $this->capturas->get_total_incidencias_por_concepto2($fecha_inicial,$fecha_final,$adscripcion_id,40);
            $data['total_41'] = $this->capturas->get_total_incidencias_por_concepto2($fecha_inicial,$fecha_final,$adscripcion_id,41);
            $data['total_46'] = $this->capturas->get_total_incidencias_por_concepto2($fecha_inicial,$fecha_final,$adscripcion_id,46);
            $data['total_47'] = $this->capturas->get_total_incidencias_por_concepto2($fecha_inicial,$fecha_final,$adscripcion_id,47);
            $data['total_48'] = $this->capturas->get_total_incidencias_por_concepto2($fecha_inicial,$fecha_final,$adscripcion_id,48);
            $data['total_49'] = $this->capturas->get_total_incidencias_por_concepto2($fecha_inicial,$fecha_final,$adscripcion_id,49);
            $data['total_51'] = $this->capturas->get_total_incidencias_por_concepto2($fecha_inicial,$fecha_final,$adscripcion_id,51);
            $data['total_53'] = $this->capturas->get_total_incidencias_por_concepto2($fecha_inicial,$fecha_final,$adscripcion_id,53);
            $data['total_54'] = $this->capturas->get_total_incidencias_por_concepto2($fecha_inicial,$fecha_final,$adscripcion_id,54);
            $data['total_55'] = $this->capturas->get_total_incidencias_por_concepto2($fecha_inicial,$fecha_final,$adscripcion_id,55);
            $data['total_60'] = $this->capturas->get_total_incidencias_por_concepto2($fecha_inicial,$fecha_final,$adscripcion_id,60);
            $data['total_62'] = $this->capturas->get_total_incidencias_por_concepto2($fecha_inicial,$fecha_final,$adscripcion_id,62);
            $data['total_63'] = $this->capturas->get_total_incidencias_por_concepto2($fecha_inicial,$fecha_final,$adscripcion_id,63);
            $data['total_94'] = $this->capturas->get_total_incidencias_por_concepto2($fecha_inicial,$fecha_final,$adscripcion_id,94);
            $data['total_100'] = $this->capturas->get_total_incidencias_por_concepto2($fecha_inicial,$fecha_final,$adscripcion_id,100);
        }
       
        
       $data['user_id']    = $this->tank_auth->get_user_id();
     
       $data['qna_id'] = $qna_id;       
       $username   = $this->tank_auth->get_username();
       $data['nombre_de_usuario'] = $this->empleado_model->getName($username);
       
       $data['panelheading'] = "Estadistica por centro de trabajo";
       
    
       $data['index'] = "admin/estadistica/totales";
       $this->load->view('layouts/index', $data); 
  }
  function estadistica_totales_centro(){
      $this->load->helper('dropdown');
       $this->load->model('empleado_model');
       $this->load->model('qna_model');
       $this->load->model('adscripcion_model');
       $this->load->model('admin/capturas');
      
       if ($this->uri->segment(3) != "" && $this->uri->segment(4) != "" && $this->uri->segment(5) != "" ){
            $adscripcion_id = $this->uri->segment(3);
            $data['fecha_inicial'] = $this->uri->segment(4);
            $data['fecha_final'] = $this->uri->segment(5);
        }
        
            $data['total_10'] = $this->capturas->get_total_incidencias_por_concepto2($data['fecha_inicial'],$data['fecha_final'],$adscripcion_id,10);
            $data['total_14'] = $this->capturas->get_total_incidencias_por_concepto2($data['fecha_inicial'],$data['fecha_final'],$adscripcion_id,14);
            $data['total_17'] = $this->capturas->get_total_incidencias_por_concepto2($data['fecha_inicial'],$data['fecha_final'],$adscripcion_id,17);
            $data['total_40'] = $this->capturas->get_total_incidencias_por_concepto2($data['fecha_inicial'],$data['fecha_final'],$adscripcion_id,40);
            $data['total_41'] = $this->capturas->get_total_incidencias_por_concepto2($data['fecha_inicial'],$data['fecha_final'],$adscripcion_id,41);
            $data['total_46'] = $this->capturas->get_total_incidencias_por_concepto2($data['fecha_inicial'],$data['fecha_final'],$adscripcion_id,46);
            $data['total_47'] = $this->capturas->get_total_incidencias_por_concepto2($data['fecha_inicial'],$data['fecha_final'],$adscripcion_id,47);
            $data['total_48'] = $this->capturas->get_total_incidencias_por_concepto2($data['fecha_inicial'],$data['fecha_final'],$adscripcion_id,48);
            $data['total_49'] = $this->capturas->get_total_incidencias_por_concepto2($data['fecha_inicial'],$data['fecha_final'],$adscripcion_id,49);
            $data['total_51'] = $this->capturas->get_total_incidencias_por_concepto2($data['fecha_inicial'],$data['fecha_final'],$adscripcion_id,51);
            $data['total_53'] = $this->capturas->get_total_incidencias_por_concepto2($data['fecha_inicial'],$data['fecha_final'],$adscripcion_id,53);
            $data['total_54'] = $this->capturas->get_total_incidencias_por_concepto2($data['fecha_inicial'],$data['fecha_final'],$adscripcion_id,54);
            $data['total_55'] = $this->capturas->get_total_incidencias_por_concepto2($data['fecha_inicial'],$data['fecha_final'],$adscripcion_id,55);
            $data['total_60'] = $this->capturas->get_total_incidencias_por_concepto2($data['fecha_inicial'],$data['fecha_final'],$adscripcion_id,60);
            $data['total_62'] = $this->capturas->get_total_incidencias_por_concepto2($data['fecha_inicial'],$data['fecha_final'],$adscripcion_id,62);
            $data['total_63'] = $this->capturas->get_total_incidencias_por_concepto2($data['fecha_inicial'],$data['fecha_final'],$adscripcion_id,63);
            $data['total_94'] = $this->capturas->get_total_incidencias_por_concepto2($data['fecha_inicial'],$data['fecha_final'],$adscripcion_id,94);
            $data['total_100'] = $this->capturas->get_total_incidencias_por_concepto2($data['fecha_inicial'],$data['fecha_final'],$adscripcion_id,100);
            $data['link_back'] = 'estadistica_por_centro/'.$data['fecha_inicial'].'/'.$data['fecha_final'];
        
       
        
       $data['user_id']    = $this->tank_auth->get_user_id();
       
        
       $username   = $this->tank_auth->get_username();
       $data['nombre_de_usuario'] = $this->empleado_model->getName($username);
       
       $data['panelheading'] = "Estadistica por centro de trabajo";
       
    
       $data['index'] = "admin/estadistica/totales";
       $this->load->view('layouts/index', $data); 
  }
  function estadistica_por_delegacion(){
      $this->load->model('empleado_model');
      $this->load->model('admin/capturas');
            
         
      if ($this->uri->segment(3) != "" && $this->uri->segment(4)) {
            $data['fecha_inicial'] = $this->uri->segment(3);
            $data['fecha_final'] = $this->uri->segment(4);
          
      }
      else {
       $data['fecha_inicial']  = fecha_ymd($this->input->post('fecha_inicial'));
       $data['fecha_final']  = fecha_ymd($this->input->post('fecha_final'));
      }
       
        
          $data['total_10'] = $this->capturas->get_total_incidencias_por_concepto_del($data['fecha_inicial'],$data['fecha_final'],10);
          $data['total_14'] = $this->capturas->get_total_incidencias_por_concepto_del($data['fecha_inicial'],$data['fecha_final'],14);
          $data['total_17'] = $this->capturas->get_total_incidencias_por_concepto_del($data['fecha_inicial'],$data['fecha_final'],17);
          $data['total_40'] = $this->capturas->get_total_incidencias_por_concepto_del($data['fecha_inicial'],$data['fecha_final'],40);
          $data['total_41'] = $this->capturas->get_total_incidencias_por_concepto_del($data['fecha_inicial'],$data['fecha_final'],41);
          $data['total_46'] = $this->capturas->get_total_incidencias_por_concepto_del($data['fecha_inicial'],$data['fecha_final'],46);
          $data['total_47'] = $this->capturas->get_total_incidencias_por_concepto_del($data['fecha_inicial'],$data['fecha_final'],47);
          $data['total_48'] = $this->capturas->get_total_incidencias_por_concepto_del($data['fecha_inicial'],$data['fecha_final'],48);
          $data['total_49'] = $this->capturas->get_total_incidencias_por_concepto_del($data['fecha_inicial'],$data['fecha_final'],49);
          $data['total_51'] = $this->capturas->get_total_incidencias_por_concepto_del($data['fecha_inicial'],$data['fecha_final'],51);
          $data['total_53'] = $this->capturas->get_total_incidencias_por_concepto_del($data['fecha_inicial'],$data['fecha_final'],53);
          $data['total_54'] = $this->capturas->get_total_incidencias_por_concepto_del($data['fecha_inicial'],$data['fecha_final'],54);
          $data['total_55'] = $this->capturas->get_total_incidencias_por_concepto_del($data['fecha_inicial'],$data['fecha_final'],55);
          $data['total_60'] = $this->capturas->get_total_incidencias_por_concepto_del($data['fecha_inicial'],$data['fecha_final'],60);
          $data['total_62'] = $this->capturas->get_total_incidencias_por_concepto_del($data['fecha_inicial'],$data['fecha_final'],62);
          $data['total_63'] = $this->capturas->get_total_incidencias_por_concepto_del($data['fecha_inicial'],$data['fecha_final'],63);
          $data['total_94'] = $this->capturas->get_total_incidencias_por_concepto_del($data['fecha_inicial'],$data['fecha_final'],94);
          $data['total_100'] = $this->capturas->get_total_incidencias_por_concepto_del($data['fecha_inicial'],$data['fecha_final'],100);

        
       $data['user_id']    = $this->tank_auth->get_user_id();
     
            
       $username   = $this->tank_auth->get_username();
       $data['nombre_de_usuario'] = $this->empleado_model->getName($username);
       
       $data['panelheading'] = "Estadistica por Delegacion del: ".fecha_dma($data['fecha_inicial'])." Al ".fecha_dma($data['fecha_final']);
       $data['link_back'] = 'estadistica';
    
       $data['index'] = "admin/estadistica/totales";
       $this->load->view('layouts/index', $data); 
  }
  function capturar(){
       $data['user_id']    = $this->tank_auth->get_user_id();
       $this->load->model('empleado_model');
        $username   = $this->tank_auth->get_username();
        $data['nombre_de_usuario'] = $this->empleado_model->getName($username);
       $data['panelheading'] = "Captura en Meta-4";
       $this->load->model('qna_model');
       //$data['users'] = $this->admin_model->get_empleados();
       $data['qnas'] = $this->qna_model->where('activa','1')->get_all();             
       $data['index'] = "admin/capturar/index";
       $this->load->view('layouts/index', $data); 
  }
   public function capturar_all_centro(){
    $this->load->model('adscripcion_model');
    
    $this->load->model('admin/capturas');
    
    $data['user_id']    = $this->tank_auth->get_user_id();
    $this->load->model('empleado_model');
        $username   = $this->tank_auth->get_username();
        $data['nombre_de_usuario'] = $this->empleado_model->getName($username);
    

    ///PAGINACION
    $config["base_url"] = base_url() . "admin/capturar_por_centro";
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
      
    
    if($this->uri->segment(3) && $this->uri->segment(4)){
      $qna_id = ($this->uri->segment(3)) ;
      $adscripcion_id = ($this->uri->segment(4)) ;

      $data['get_all_incidencias'] = $this->capturas->get_all_incidencias($qna_id, $adscripcion_id);  
    }
    foreach ($data['get_all_incidencias'] as $row) {
      $data['panelheading'] = $row->descripcion;
    }
    
    
    //$data['adscripciones'] = $this->adscripcion_model->order_by('adscripcion', 'ASC')->paginate($config["per_page"],$total_row);
      $data['link_qna'] =  $qna_id;
      $data['link_adscripcion'] = $adscripcion_id;


       $data['index'] = "admin/capturar/all_centro";
       $this->load->view('layouts/index', $data);
    }
  public function capturar_por_incidencia(){
    $this->load->model('admin/capturas');
    $data['user_id']    = $this->tank_auth->get_user_id();
    $this->load->model('empleado_model');
        $username   = $this->tank_auth->get_username();
        $data['nombre_de_usuario'] = $this->empleado_model->getName($username);
    $data['panelheading'] = "Captura por grupo de incidencias";
    if($this->uri->segment(3)){
      $qna_id = ($this->uri->segment(3)) ;
      $data['qna_id'] = $qna_id;
      $data['incidencias'] = $this->capturas->get_total_por_incidencia($qna_id, 100);
      $data['licencias'] = $this->capturas->get_total_por_incidencia($qna_id, 200);
      $data['vacaciones'] = $this->capturas->get_total_por_incidencia($qna_id, 300);
      $data['otros'] = $this->capturas->get_total_por_incidencia($qna_id,400);
      
    }
    if($this->uri->segment(3) && $this->uri->segment(4)){
      $qna_id = ($this->uri->segment(3));
      $grupo_id = ($this->uri->segment(4));
      $data['get_all_incidencias'] = $this->capturas->get_all_grupos($qna_id, $grupo_id);
    }
    
    
    $data['index'] = "admin/capturar/por_grupo";
    $this->load->view('layouts/index', $data);

  }
  public function delete($token) {
    $this->load->model('captura_model');
    if ($this->uri->segment(4) != '' && $this->uri->segment(5) != '') {
      $qna_id = $this->uri->segment(4);
      $adscripcion_id = $this->uri->segment(5);
      //$this->captura_model->borrar_incidencias($token);
      $this->captura_model->where('token', $token)->delete();
      
      redirect('admin/capturar_all_centro/'.$qna_id.'/'.$adscripcion_id);
    }
  
  }



  public function capturar_por_centro(){
    $this->load->model('adscripcion_model');
    
    $this->load->model('admin/capturas');
    
    $data['user_id']    = $this->tank_auth->get_user_id();
    $this->load->model('empleado_model');
        $username   = $this->tank_auth->get_username();
        $data['nombre_de_usuario'] = $this->empleado_model->getName($username);
    $data['panelheading'] = "Captura por centro";

    ///PAGINACION
    $config["base_url"] = base_url() . "admin/capturar_por_centro";
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
      $qna_id = ($this->uri->segment(3)) ;
      $data['get_incidencias'] = $this->capturas->get_incidencias($qna_id);
    }
   
    
    //$data['total_por_centro'] = $this->capturas->get_total_incidencias(40,$centro);
    
    
    //$data['adscripciones'] = $this->adscripcion_model->order_by('adscripcion', 'ASC')->paginate($config["per_page"],$total_row);


       $data['index'] = "admin/capturar/por_centro";
       $this->load->view('layouts/index', $data);
    }
    public function capturada($token){
      $this->load->model('captura_model');
      if ($this->uri->segment(4) != "" && $this->uri->segment(5) != "" ){
        $qna_id = $this->uri->segment(4);
        $adscripcion_id = $this->uri->segment(5);

        $activate = $this->captura_model->where('token', $token)->get_all();
      }
      
      foreach ($activate as $row) {
        $activa = ($row->capturada) ? FALSE : TRUE; 
        $this->captura_model->update(array(
            'capturada' => $activa),
            $row->id
          );
      }
      
      redirect('admin/capturar_all_centro/'.$qna_id.'/'.$adscripcion_id);
  }
  public function capturada2($token){
      $this->load->model('captura_model');
      if ($this->uri->segment(4) != "" && $this->uri->segment(5) != "" ){
        $qna_id = $this->uri->segment(4);
        $grupo_id = $this->uri->segment(5);

        $activate = $this->captura_model->where('token', $token)->get_all();
      }
      
      foreach ($activate as $row) {
        $activa = ($row->capturada) ? FALSE : TRUE; 
        $this->captura_model->update(array(
            'capturada' => $activa),
            $row->id
          );
      }
      
      redirect('admin/capturar_por_incidencia/'.$qna_id.'/'.$grupo_id);
  }


  function logout()
    {
    $this->tank_auth->logout();

    $this->_show_message($this->lang->line('auth_message_logged_out'));
  }

  /**
   * Register user on the site
   *
   * @return void
   */
  function register()
  {
      $data['user_id']    = $this->tank_auth->get_user_id();
      $this->load->model('empleado_model');
        $username   = $this->tank_auth->get_username();
        $data['nombre_de_usuario'] = $this->empleado_model->getName($username);
      $data['panelheading'] = "Dashboard/Nuevo Usuario";
      
      $use_username = $this->config->item('use_username', 'tank_auth');
      if ($use_username) {
        $this->form_validation->set_rules('username', 'Username', 'trim|required|xss_clean|min_length['.$this->config->item('username_min_length', 'tank_auth').']|max_length['.$this->config->item('username_max_length', 'tank_auth').']|alpha_dash');
      }
      $this->form_validation->set_rules('email', 'Email', 'trim|required|xss_clean|valid_email');
      $this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean|min_length['.$this->config->item('password_min_length', 'tank_auth').']|max_length['.$this->config->item('password_max_length', 'tank_auth').']|alpha_dash');
      $this->form_validation->set_rules('confirm_password', 'Confirm Password', 'trim|required|xss_clean|matches[password]');

      $captcha_registration = $this->config->item('captcha_registration', 'tank_auth');
      $use_recaptcha      = $this->config->item('use_recaptcha', 'tank_auth');
      if ($captcha_registration) {
        if ($use_recaptcha) {
          $this->form_validation->set_rules('recaptcha_response_field', 'Confirmation Code', 'trim|xss_clean|required|callback__check_recaptcha');
        } else {
          $this->form_validation->set_rules('captcha', 'Confirmation Code', 'trim|xss_clean|required|callback__check_captcha');
        }
      }
      $data['errors'] = array();

      $email_activation = $this->config->item('email_activation', 'tank_auth');

      if ($this->form_validation->run()) {                // validation ok
        if (!is_null($data = $this->tank_auth->create_user(
            $use_username ? $this->form_validation->set_value('username') : '',
            $this->form_validation->set_value('email'),
            $this->form_validation->set_value('password'),
            $email_activation))) {                  // success

          $data['site_name'] = $this->config->item('website_name', 'tank_auth');

          if ($email_activation) {                  // send "activate" email
            $data['activation_period'] = $this->config->item('email_activation_expire', 'tank_auth') / 3600;

            $this->_send_email('activate', $data['email'], $data);

            unset($data['password']); // Clear password (just for any case)

            $this->_show_message($this->lang->line('auth_message_registration_completed_1'));

          } else {
            if ($this->config->item('email_account_details', 'tank_auth')) {  // send "welcome" email

              $this->_send_email('welcome', $data['email'], $data);
            }
            unset($data['password']); // Clear password (just for any case)

            $data['index'] = "admin/dashboard";
            $this->load->view('layouts/index', $data);
            //$this->_show_message($this->lang->line('auth_message_registration_completed_2').' '.anchor('/auth/login/', 'Login'));
          }
        } else {
          $errors = $this->tank_auth->get_error_message();
          foreach ($errors as $k => $v) $data['errors'][$k] = $this->lang->line($v);
        }
      }
      if ($captcha_registration) {
        if ($use_recaptcha) {
          $data['recaptcha_html'] = $this->_create_recaptcha();
        } else {
          $data['captcha_html'] = $this->_create_captcha();
        }
      }
      $data['use_username'] = $use_username;
      $data['captcha_registration'] = $captcha_registration;
      $data['use_recaptcha'] = $use_recaptcha;
      
      $data['index'] = "auth/register_form";
      $this->load->view('layouts/index', $data);
    
  }

  /**
   * Send activation email again, to the same or new email address
   *
   * @return void
   */
  function send_again()
  {
    if (!$this->tank_auth->is_logged_in(FALSE)) {             // not logged in or activated
      redirect('/auth/login/');

    } else {
      $this->form_validation->set_rules('email', 'Email', 'trim|required|xss_clean|valid_email');

      $data['errors'] = array();

      if ($this->form_validation->run()) {                // validation ok
        if (!is_null($data = $this->tank_auth->change_email(
            $this->form_validation->set_value('email')))) {     // success

          $data['site_name']  = $this->config->item('website_name', 'tank_auth');
          $data['activation_period'] = $this->config->item('email_activation_expire', 'tank_auth') / 3600;

          $this->_send_email('activate', $data['email'], $data);

          $this->_show_message(sprintf($this->lang->line('auth_message_activation_email_sent'), $data['email']));

        } else {
          $errors = $this->tank_auth->get_error_message();
          foreach ($errors as $k => $v) $data['errors'][$k] = $this->lang->line($v);
        }
      }
      $this->load->view('auth/send_again_form', $data);
    }
  }

  /**
   * Activate user account.
   * User is verified by user_id and authentication code in the URL.
   * Can be called by clicking on link in mail.
   *
   * @return void
   */

  /**
   * Generate reset code (to change password) and send it to user
   *
   * @return void
   */
  function forgot_password()
  {
    if ($this->tank_auth->is_logged_in()) {                 // logged in
      redirect('');

    } elseif ($this->tank_auth->is_logged_in(FALSE)) {            // logged in, not activated
      redirect('/auth/send_again/');

    } else {
      $this->form_validation->set_rules('login', 'Email or login', 'trim|required|xss_clean');

      $data['errors'] = array();

      if ($this->form_validation->run()) {                // validation ok
        if (!is_null($data = $this->tank_auth->forgot_password(
            $this->form_validation->set_value('login')))) {

          $data['site_name'] = $this->config->item('website_name', 'tank_auth');

          // Send email with password activation link
          $this->_send_email('forgot_password', $data['email'], $data);

          $this->_show_message($this->lang->line('auth_message_new_password_sent'));

        } else {
          $errors = $this->tank_auth->get_error_message();
          foreach ($errors as $k => $v) $data['errors'][$k] = $this->lang->line($v);
        }
      }
      $this->load->view('auth/forgot_password_form', $data);
    }
  }

  /**
   * Replace user password (forgotten) with a new one (set by user).
   * User is verified by user_id and authentication code in the URL.
   * Can be called by clicking on link in mail.
   *
   * @return void
   */
  function reset_password()
  {
    $user_id    = $this->uri->segment(3);
    $new_pass_key = $this->uri->segment(4);

    $this->form_validation->set_rules('new_password', 'New Password', 'trim|required|xss_clean|min_length['.$this->config->item('password_min_length', 'tank_auth').']|max_length['.$this->config->item('password_max_length', 'tank_auth').']|alpha_dash');
    $this->form_validation->set_rules('confirm_new_password', 'Confirm new Password', 'trim|required|xss_clean|matches[new_password]');

    $data['errors'] = array();

    if ($this->form_validation->run()) {                // validation ok
      if (!is_null($data = $this->tank_auth->reset_password(
          $user_id, $new_pass_key,
          $this->form_validation->set_value('new_password')))) {  // success

        $data['site_name'] = $this->config->item('website_name', 'tank_auth');

        // Send email with new password
        $this->_send_email('reset_password', $data['email'], $data);

        $this->_show_message($this->lang->line('auth_message_new_password_activated').' '.anchor('/auth/login/', 'Login'));

      } else {                            // fail
        $this->_show_message($this->lang->line('auth_message_new_password_failed'));
      }
    } else {
      // Try to activate user by password key (if not activated yet)
      if ($this->config->item('email_activation', 'tank_auth')) {
        $this->tank_auth->activate_user($user_id, $new_pass_key, FALSE);
      }

      if (!$this->tank_auth->can_reset_password($user_id, $new_pass_key)) {
        $this->_show_message($this->lang->line('auth_message_new_password_failed'));
      }
    }
    $this->load->view('auth/reset_password_form', $data);
  }

  /**
   * Change user password
   *
   * @return void
   */
  function change_password()
  {
    if (!$this->tank_auth->is_logged_in()) {                // not logged in or not activated
      redirect('/auth/login/');

    } else {
      $this->form_validation->set_rules('old_password', 'Old Password', 'trim|required|xss_clean');
      $this->form_validation->set_rules('new_password', 'New Password', 'trim|required|xss_clean|min_length['.$this->config->item('password_min_length', 'tank_auth').']|max_length['.$this->config->item('password_max_length', 'tank_auth').']|alpha_dash');
      $this->form_validation->set_rules('confirm_new_password', 'Confirm new Password', 'trim|required|xss_clean|matches[new_password]');

      $data['errors'] = array();

      if ($this->form_validation->run()) {                // validation ok
        if ($this->tank_auth->change_password(
            $this->form_validation->set_value('old_password'),
            $this->form_validation->set_value('new_password'))) { // success
          $this->_show_message($this->lang->line('auth_message_password_changed'));

        } else {                            // fail
          $errors = $this->tank_auth->get_error_message();
          foreach ($errors as $k => $v) $data['errors'][$k] = $this->lang->line($v);
        }
      }
      $this->load->view('auth/change_password_form', $data);
    }
  }

  /**
   * Change user email
   *
   * @return void
   */
  function change_email()
  {
    if (!$this->tank_auth->is_logged_in()) {                // not logged in or not activated
      redirect('/auth/login/');

    } else {
      $this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean');
      $this->form_validation->set_rules('email', 'Email', 'trim|required|xss_clean|valid_email');

      $data['errors'] = array();

      if ($this->form_validation->run()) {                // validation ok
        if (!is_null($data = $this->tank_auth->set_new_email(
            $this->form_validation->set_value('email'),
            $this->form_validation->set_value('password')))) {      // success

          $data['site_name'] = $this->config->item('website_name', 'tank_auth');

          // Send email with new email address and its activation link
          $this->_send_email('change_email', $data['new_email'], $data);

          $this->_show_message(sprintf($this->lang->line('auth_message_new_email_sent'), $data['new_email']));

        } else {
          $errors = $this->tank_auth->get_error_message();
          foreach ($errors as $k => $v) $data['errors'][$k] = $this->lang->line($v);
        }
      }
      $this->load->view('auth/change_email_form', $data);
    }
  }

  /**
   * Replace user email with a new one.
   * User is verified by user_id and authentication code in the URL.
   * Can be called by clicking on link in mail.
   *
   * @return void
   */
  function reset_email()
  {
    $user_id    = $this->uri->segment(3);
    $new_email_key  = $this->uri->segment(4);

    // Reset email
    if ($this->tank_auth->activate_new_email($user_id, $new_email_key)) { // success
      $this->tank_auth->logout();
      $this->_show_message($this->lang->line('auth_message_new_email_activated').' '.anchor('/auth/login/', 'Login'));

    } else {                                // fail
      $this->_show_message($this->lang->line('auth_message_new_email_failed'));
    }
  }

  /**
   * Delete user from the site (only when user is logged in)
   *
   * @return void
   */
  function unregister()
  {
    if (!$this->tank_auth->is_logged_in()) {                // not logged in or not activated
      redirect('/auth/login/');

    } else {
      $this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean');

      $data['errors'] = array();

      if ($this->form_validation->run()) {                // validation ok
        if ($this->tank_auth->delete_user(
            $this->form_validation->set_value('password'))) {   // success
          $this->_show_message($this->lang->line('auth_message_unregistered'));

        } else {                            // fail
          $errors = $this->tank_auth->get_error_message();
          foreach ($errors as $k => $v) $data['errors'][$k] = $this->lang->line($v);
        }
      }
      $this->load->view('auth/unregister_form', $data);
    }
  }

  /**
   * Show info message
   *
   * @param string
   * @return  void
   */
  function _show_message($message)
  {
    $this->session->set_flashdata('message', $message);
    redirect('/auth/');
  }

  /**
   * Send email message of given type (activate, forgot_password, etc.)
   *
   * @param string
   * @param string
   * @param array
   * @return  void
   */
  function _send_email($type, $email, &$data)
  {
    $this->load->library('email');
    $this->email->from($this->config->item('webmaster_email', 'tank_auth'), $this->config->item('website_name', 'tank_auth'));
    $this->email->reply_to($this->config->item('webmaster_email', 'tank_auth'), $this->config->item('website_name', 'tank_auth'));
    $this->email->to($email);
    $this->email->subject(sprintf($this->lang->line('auth_subject_'.$type), $this->config->item('website_name', 'tank_auth')));
    $this->email->message($this->load->view('email/'.$type.'-html', $data, TRUE));
    $this->email->set_alt_message($this->load->view('email/'.$type.'-txt', $data, TRUE));
    $this->email->send();
  }

  /**
   * Create CAPTCHA image to verify user as a human
   *
   * @return  string
   */
  function _create_captcha()
  {
    $this->load->helper('captcha');

    $cap = create_captcha(array(
      'img_path'    => './'.$this->config->item('captcha_path', 'tank_auth'),
      'img_url'   => base_url().$this->config->item('captcha_path', 'tank_auth'),
      'font_path'   => './'.$this->config->item('captcha_fonts_path', 'tank_auth'),
      'font_size'   => $this->config->item('captcha_font_size', 'tank_auth'),
      'img_width'   => $this->config->item('captcha_width', 'tank_auth'),
      'img_height'  => $this->config->item('captcha_height', 'tank_auth'),
      'show_grid'   => $this->config->item('captcha_grid', 'tank_auth'),
      'expiration'  => $this->config->item('captcha_expire', 'tank_auth'),
    ));

    // Save captcha params in session
    $this->session->set_flashdata(array(
        'captcha_word' => $cap['word'],
        'captcha_time' => $cap['time'],
    ));

    return $cap['image'];
  }

  /**
   * Callback function. Check if CAPTCHA test is passed.
   *
   * @param string
   * @return  bool
   */
  function _check_captcha($code)
  {
    $time = $this->session->flashdata('captcha_time');
    $word = $this->session->flashdata('captcha_word');

    list($usec, $sec) = explode(" ", microtime());
    $now = ((float)$usec + (float)$sec);

    if ($now - $time > $this->config->item('captcha_expire', 'tank_auth')) {
      $this->form_validation->set_message('_check_captcha', $this->lang->line('auth_captcha_expired'));
      return FALSE;

    } elseif (($this->config->item('captcha_case_sensitive', 'tank_auth') AND
        $code != $word) OR
        strtolower($code) != strtolower($word)) {
      $this->form_validation->set_message('_check_captcha', $this->lang->line('auth_incorrect_captcha'));
      return FALSE;
    }
    return TRUE;
  }

  /**
   * Create reCAPTCHA JS and non-JS HTML to verify user as a human
   *
   * @return  string
   */
  function _create_recaptcha()
  {
    $this->load->helper('recaptcha');

    // Add custom theme so we can get only image
    $options = "<script>var RecaptchaOptions = {theme: 'custom', custom_theme_widget: 'recaptcha_widget'};</script>\n";

    // Get reCAPTCHA JS and non-JS HTML
    $html = recaptcha_get_html($this->config->item('recaptcha_public_key', 'tank_auth'));

    return $options.$html;
  }

  /**
   * Callback function. Check if reCAPTCHA test is passed.
   *
   * @return  bool
   */
  function _check_recaptcha()
  {
    $this->load->helper('recaptcha');

    $resp = recaptcha_check_answer($this->config->item('recaptcha_private_key', 'tank_auth'),
        $_SERVER['REMOTE_ADDR'],
        $_POST['recaptcha_challenge_field'],
        $_POST['recaptcha_response_field']);

    if (!$resp->is_valid) {
      $this->form_validation->set_message('_check_recaptcha', $this->lang->line('auth_incorrect_captcha'));
      return FALSE;
    }
    return TRUE;
  }

}
