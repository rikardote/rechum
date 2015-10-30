<?php
// application/controllers/admin_base.php
class Admin_Base extends CI_Controller {
    
   function __construct()
   {
      parent::__construct();
          $this->load->library('session');
       
        $this->load->library('tank_auth');     
     
                
      if(!$this->tank_auth->is_admin())
      {
         redirect('auth/login');
      }
      
   }
} 
?>