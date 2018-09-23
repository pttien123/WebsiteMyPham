<?php
//kế thừa từ MY_Controller bên thư mục core
class Login extends MY_Controller
{
  function index()
  {
      //Load thư viện form_validation và helper form
      $this->load->library('form_validation');
      $this->load->helper('form');


      //Nhấn nút submit->kiểm tra dữ liệu
      if($this->input->post())
      {
          $this->form_validation->set_rules('login','Login','callback_check_login');
          if($this->form_validation->run())
          {
              //Lấy tên của user lúc đăng nhập
              $username = $this->input->post('username');

              //Gán thông tin của user vào biến info
              $info = $this->admin_model->get_info($username);

              //lấy dữ liệu Ho và Ten ra và gán vào biến $name
              $name = $info->Ho.' ' .$info->Ten;

              //tạo session cho name sau đó qua bên admin/left.php rồi echo session ra
              $this->session->set_userdata('name',$name);

              //Đặt trạng thái đã login là true, tức biến cho biết đã đăng nhập thành công
              $this->session->set_userdata('login',TRUE);
              redirect(admin_url('Home'));
          }
      }
      //Load view của trang login
      $this->data['title'] = 'Đăng nhập';
      $this->load->view('admin/Login/index',$this->data);
  }

  /*
  * Kiểm tra tên đăng nhập và mật khẩu có chính xác không
  */
  function check_login()
  {
      $username = $this->input->post('username');
      $password = $this->input->post('password');
      $password = md5($password);

      $this->load->model('admin_model');
      $where = array(
          'Username' => $username,
          'Password' => $password
        );

      if($this->admin_model->check_exists($where))
      {
          return TRUE;
      }
      $this->form_validation->set_message(__FUNCTION__,'Tên đăng nhập hoặc mật khẩu không đúng');
      return FALSE;
  }
}
