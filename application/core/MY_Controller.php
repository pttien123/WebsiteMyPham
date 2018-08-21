<?php
//Tiền tố của tên file sẽ theo trong file config ->config.php
//Muốn đổi tiền tố khác thì vào file đổi lại
//--------------------------------------------

//Tạo controller dùng chung kế thừa từ CI
class MY_Controller extends CI_Controller
{
  function __construct()
  {
    //Hàm khởi tạo kế thừa CI controller
    //Dùng parent để tránh ghi đè, sử dụng được các thư viện của CI Controller
    parent::__construct();

    //biến controller giữ giá trị thư mục chứa Controller
    //ví dụ www.localhost/webmypham/admin/login
    //thì segment thứ 1 sẽ là 'admin'
    $controller = $this->uri->segment(1);
    switch($controller)
    {
      case 'admin':
      {
        //Xử lý các dữ liệu cho trang admin
        $this->check_login();
      }
      default:
      {
        //Xử lý các dữ liệu cho trang ngoài
      }
    }
  }
  private function check_login()
  {

  }
}
