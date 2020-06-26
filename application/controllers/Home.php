<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

  private $_uname, $_passwd, $_remember;

  public function __construct() {
    parent::__construct();
    if ($this->session->userdata('is_login') AND get_cookie('is_login')) {
      redirect( base_url('admin') );
    }
    $this->load->model('m_users');
  }

  public function f_valid() {
    $this->form_validation->set_rules('username', 'Username', 'required|trim');
    $this->form_validation->set_rules('password', 'Password', 'required|trim');
  }

  public function index() {
    $this->f_valid();

    if ( !$this->form_validation->run() ) {
      $this->load->view('v_login');
    } else {
      $this->_uname = $this->input->post('username');
      $this->_passwd = $this->input->post('password');
      $this->_remember = $this->input->post('remember');

      $this->auth();
    }
  }

  public function auth() {
    // $hash_passwd = $this->m_users->getPassword(htmlentities($this->_uname, ENT_QUOTES, 'UTF-8'))->row_array()['password'];

    // var_dump(htmlentities($this->_uname, ENT_QUOTES, 'UTF-8'));
    // var_dump($hash_passwd); die;

    // if (!$hash_passwd) {
    //   $this->session->set_flashdata('notif', 'Username tidak ditemukan');
    //   redirect( base_url('home') );
    // }

    $user = $this->m_users->validUser($this->_uname, $this->_passwd);

    if ($user['error']) {
      $this->session->set_flashdata('notif', $user['error']);
      redirect( base_url('home') );
    }

    if ($this->_remember) {
      set_cookie('is_login', TRUE, 31536000);
      set_cookie('username', $this->_uname, 31536000);
      set_cookie('role', $user['role'], 31536000);
    } else {
      $data = ['is_login' => TRUE, 'username' => $this->_uname, 'role' => $user['role']];
      $this->session->set_userdata($data);
    }

    redirect( base_url('admin') );
  }

  public function daftar() {
    $this->f_valid();

    if( !$this->form_validation->run() ) {
      $this->load->view('v_daftar');
    } else {
      $this->_uname = htmlentities( $this->input->post('username'), ENT_QUOTES, 'UTF-8' );
      $this->_passwd = htmlentities( $this->input->post('password'), ENT_QUOTES, 'UTF-8' );


      if ( $this->m_users->getPassword($this->_uname)->row_array() ) {
        $this->session->set_flashdata('notif', 'Username sudah dipakai');
        // var_dump($this->m_users->getPassword($this->_uname)->row_array()); die;
        redirect( base_url('home/daftar') );
      }

      $this->m_users->addUser($this->_uname, $this->_passwd);

      $this->auth();
    }
  }

  public function hello() {
    $this->f_valid();

    if ( !$this->form_validation->run() ) {
      $this->load->view('v_daftar');
    } else {
      echo $this->input->post('username');
      echo $this->input->post('password');
    }
  }


}
?>
