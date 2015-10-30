<?php defined('BASEPATH') OR exit('No direct script access allowed');
class MY_Controller extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $this->load->model('tank_auth');
        if (!$this->tank_auth->is_logged_in()) {
            // save the visitors entry point and redirect to login
            $this->session->set_userdata('redirect', $this->uri->uri_string());
            redirect('auth/login');
        }
    }
}