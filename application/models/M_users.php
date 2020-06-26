<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_users extends CI_Model {

  private $_tblname = 'users';

  public function __consctuct() {
    parent::__construct();
  }

  public function getPassword($uname) {
    $this->db->select('password');
    $this->db->where('username', $uname);
    return $this->db->get($this->_tblname);
  }

  public function validUser($uname, $passwd) {
    $hash_passwd = $this->getPassword($uname)->row_array()['password'];
    $result = [];

    if (!$hash_passwd) {
      $result['error'] = "Username tidak ditemukan";
      return $result;
    }

    if ( password_verify($passwd, $hash_passwd) ) {
      $where = ['username' => $uname, 'password' => $hash_passwd];
      return $this->db->get_where($this->_tblname, $where)->row_array();
    } else {
      $result['error'] = "Password Salah";
      return $result;
    }
  }

  public function addUser($uname, $passwd) {
    $data = ['username' => $uname, 'password' => password_hash($passwd, PASSWORD_DEFAULT)];
    $this->db->insert($this->_tblname, $data);
  }
}
?>
