<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

  public function __construct() {
    parent::__construct();
    if (!$this->session->userdata('is_login') AND !get_cookie('is_login')) {
      die("access forbidden");
    }
  }

  public function index() {
    $data['uname'] = '';
    $data['role'] = '';
    if(get_cookie('is_login')) {
      $data['uname'] = get_cookie('username');
      $data['role'] = get_cookie('role');
    } else {
      $data['uname'] = $this->session->userdata('username');
      $data['role'] = $this->session->userdata('role');
    }


    $this->load->view('v_admin', $data);
  }

  public function logout() {
    $this->session->sess_destroy();
    delete_cookie('is_login');
    delete_cookie('username');
    delete_cookie('role');
    redirect( base_url() );
  }
}
?>
