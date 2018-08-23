<?php
//kế thừa từ MY_Controller bên thư mục core
class Login extends MY_Controller
{
  function index()
  {
    $this->load->view('admin/Login/index');
  }
}
