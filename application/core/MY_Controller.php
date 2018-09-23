<?php
//Tiền tố của tên file sẽ theo trong file config ->config.php
//Muốn đổi tiền tố khác thì vào file đổi lại
//--------------------------------------------

//Tạo controller dùng chung kế thừa từ CI
class MY_Controller extends CI_Controller
{
  //biến gửi dữ liệu cho bên view
  public $data = array();

  /*
  * Hàm khỏi tạo
  */
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
        $this->load->helper('admin');
        $this->check_login();
      }
      default:
      {
        //Xử lý các dữ liệu cho trang ngoài
        $this->load->library('session');
        //Lấy dữ liệu danh mục
        $this->load->model('catalog_model');
        //Lấy các danh mục cha
        $input =array();
        $input['where'] = array('DMCha' => 0);
        $input['order'] = array('MaDM' , 'ASC' );
        $catalog_list = $this->catalog_model->get_list($input);
        //Lấy các danh mục con
        foreach ($catalog_list as $row)
        {
            $input['where'] = array('DMCha' => $row->MaDM);
            $sub = $this->catalog_model->get_list($input);
            $row->sub = $sub;
        }
        $this->data['catalog_list'] = $catalog_list;

        //Kiểm tra đăng nhập hay chưa
        $user_id = $this->session->userdata('user_id_logged');
        $this->data['user_id'] = $user_id;
        if($user_id)
        {
            $this->load->model('user_model');
            $user_info = $this->user_model->get_info($user_id);
            $this->data['user_info'] = $user_info;
        }
        else
        {

        }

        //Load thư viện cart - thư viện giỏ hàng
        $this->load->library('cart');
        $this->data['total_items'] = $this->cart->total_items();
      }
    }
  }
  private function check_login()
  {
      //in ra giá trị admin từ đường dẫn www.localhost/webmypham/admin/admin/
      $controller = $this->uri->rsegment(1);
      $controller = strtolower($controller);
      //userdata khai báo bên controller Login.php
      $login = $this->session->userdata('login');
      //Nếu chưa đăng nhập mà truy cập vào trang chủ admin
      if(!$login && ($controller != 'login') )
      {
          redirect(admin_url('login'));
      }
      //Nếu đâ đăng nhập thành công -> chuyển sang trang chủ admin
      if($login && ($controller == 'login'))
      redirect(admin_url('home'));
  }
}
