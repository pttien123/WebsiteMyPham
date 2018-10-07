<?php
class User extends MY_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('user_model');
        date_default_timezone_set("Asia/Ho_Chi_Minh");
    }

    /*
    * Kiểm tra email tài khoản
    */
    function check_email()
    {
        //Lấy dữ liệu email
        $email = $this->input->post('email');
        //Tạo biến đkiện
        $where = array('Email' => $email);

        if($this->user_model->check_exists($where))
        {
          $this->form_validation->set_message(__FUNCTION__,'Email đã tồn tại');
          return FALSE;
        }
        return TRUE;
    }

    /*
    * Đăng ký tài khoản
    */
    function sign_up()
    {
        //Load thư viện form_validation của CI
        $this->load->library('form_validation');
        $this->load->helper('form');

        //Khi nhấn submit
        if($this->input->post())
        {
             //giatri1: tên ; giatri2: Nội dung xuất; giatri3: điều kiện kiểm tra
            $this->form_validation->set_rules('email','Email','required|valid_email|trim|callback_check_email');
            $this->form_validation->set_rules('password','Mật khẩu','required|trim|min_length[8]|max_length[32]');
            $this->form_validation->set_rules('re_password','Nhập lại mật khẩu','required|trim|matches[password]');
            $this->form_validation->set_rules('last_name','Họ và tên lót','required|trim|max_length[50]');
            $this->form_validation->set_rules('name','Tên','required|trim|max_length[20]');
            $this->form_validation->set_rules('address','Địa chỉ','trim|required');
            $this->form_validation->set_rules('phone','Số điện thoại','required|trim|max_length[15]|min_length[9]');
            //$this->form_validation->set_rules('recaptcha','recaptcha','required');
            if($this->form_validation->run())
            {
                $email      = $this->input->post('email');
                $password   = $this->input->post('password');
                $last_name  = $this->input->post('last_name');
                $name       = $this->input->post('name');
                $address    = $this->input->post('address');
                $phone      = $this->input->post('phone');
                $type       = 0;
                $today      = date("Y/m/d");


                $data = array(
                  'Email'     => $email,
                  'Password'  => md5($password),
                  'HoKH'      => $last_name,
                  'TenKH'     => $name,
                  'DiaChi'    => $address,
                  'Phone'     => $phone,
                  'LoaiKH'    => $type,
                  'NgayTao'   => $today

                );


                if($this->user_model->insert($data))
                {
                  $user = $this->get_user_info($email,md5($password));

                  $this->session->set_userdata('user_id_logged',$user->MaKH);
                  redirect(base_url('user/confirm'));
                }
                else {
                    $this->session->set_flashdata('message','Đăng ký thất bại! Xin vui lòng thử lại.');
                }

            }
        }

        //Load giao diện trang
        $this->data['message'] = $this->session->flashdata('message');
        $this->data['title'] = 'Đăng ký tài khoản';
        $this->data['temp'] = 'site/user/sign_up';
        $this->load->view('site/layoutmaster',$this->data);
    }


    /*
    * Đăng nhập
    */
    function login()
    {
      //Load thư viện form_validation của CI
      $this->load->library('form_validation');
      $this->load->helper('form');

      if($this->input->post())
      {
            $this->form_validation->set_rules('login','Đăng nhập','callback_check_login');
            if($this->form_validation->run())
            {
              //Đặt trạng thái đã login là true, tức biến cho biết đã đăng nhập thành công
              $email = $this->input->post('email');
              $password = $this->input->post('password');
              $password = md5($password);

              $user = $this->get_user_info($email,$password);
              $this->session->set_userdata('user_id_logged',$user->MaKH);

              redirect(base_url());
            }
      }
      $this->data['title'] = 'Đăng nhập';
      $this->data['temp'] = 'site/user/login';
      $this->load->view('site/layoutmaster',$this->data);
    }

    /*
    * Kiểm tra logged in ?
    */
    function check_login()
    {
      $email = $this->input->post('email');

      $password = $this->input->post('password');
      $password = md5($password);


      $user = $this->get_user_info($email,$password);

      if($user)
      {
          return TRUE;
      }
      $this->form_validation->set_message(__FUNCTION__,'Tên đăng nhập hoặc mật khẩu không đúng');
      return FALSE;
    }

    /*
    * Lấy thông tin thành viên
    */
    private function get_user_info($u_email='',$u_pass='')
    {
      $email = $u_email;
      $password = $u_pass;

      $where = array(
          'Email' => $email,
          'Password' => $password
        );
      $user = $this->user_model->get_info_rule($where);
      return $user;
    }

    /*
     * Đăng xuất khỏi trang
     */
     function logout()
     {
       //Nếu đang ở trạng thái đăng nhập thì xóa trạng thái đó đi
         if($this->session->userdata('user_id_logged'))
         {
             $this->session->unset_userdata('user_id_logged');
         }
         redirect(base_url());
     }

    /*
    * Hiển thị thong tin khach hang
    */
    function index()
    {
        if(!$this->session->userdata('user_id_logged'))
        {
            redirect(base_url('user/login'));
        }
        $id = $this->session->userdata('user_id_logged');
        $user = $this->user_model->get_info($id);
        if(!$user)
        {
            redirect(base_url());
        }
        $this->data['user'] = $user;

        $message = $this->session->flashdata('message');
        $this->data['message'] = $message;
        $this->load->model('usertype_model');
        $type = $this->usertype_model->get_info($user->LoaiKH);
        $this->data['type'] = $type;
        //Load view
        $this->data['title'] = 'Thông tin tài khoản';
        $this->data['temp'] = 'site/user/index';
        $this->load->view('site/user/layoutmaster',$this->data);
    }
    /*
    * Chỉnh sửa thong tin tài khoản
    */
    function edit()
    {
      if(!$this->session->userdata('user_id_logged'))
      {
          redirect(base_url('user/login'));
      }
      $id = $this->session->userdata('user_id_logged');
      $user = $this->user_model->get_info($id);
      if(!$user)
      {
          $this->session->set_flashdata('message','Không tồn tại tài khoản này');
          redirect(base_url('user/index'));
      }
      $this->data['user'] = $user;

      //Load thư viện form_validation của CI
      $this->load->library('form_validation');
      $this->load->helper('form');

      //Khi nhấn submit
      if($this->input->post())
      {
           //giatri1: tên ; giatri2: Nội dung xuất; giatri3: điều kiện kiểm tra

          $this->form_validation->set_rules('last_name','Họ và tên lót','required|max_length[50]');
          $this->form_validation->set_rules('name','Tên','required|max_length[20]');
          $this->form_validation->set_rules('address','Địa chỉ','required');
          $this->form_validation->set_rules('phone','Số điện thoại','required|max_length[15]|min_length[9]');
          //Nếu có thay đổi mật khẩu
          $password = $this->input->post('password');
          if($password)
          {
            $this->form_validation->set_rules('password','Mật khẩu','required|min_length[8]|max_length[32]');
            $this->form_validation->set_rules('repassword','Nhập lại mật khẩu','required|matches[password]');
          }
          if($this->form_validation->run())
          {
              $last_name  = $this->input->post('last_name');
              $name       = $this->input->post('name');
              $address    = $this->input->post('address');
              $phone      = $this->input->post('phone');

              $data = array(
                'HoKH'      => $last_name,
                'TenKH'     => $name,
                'DiaChi'    => $address,
                'Phone'     => $phone
              );

              //Nếu thay đổi password
              if($password)
              {
                  $data['Password'] = md5($password);
              }

              //Cập nhật thông tin
              if($this->user_model->update($id, $data))
              {
                  $this->session->set_flashdata('message','Cập nhật thành công! ');
              }
              else
              {
                  $this->session->set_flashdata('message','Cập nhật thất bại! ');
              }
              redirect(base_url('user/index'));
          }
      }

      //Load view
      $this->data['title'] = 'Chỉnh sửa thông tin tài khoản';
      $this->data['temp'] = 'site/user/edit';
      $this->load->view('site/user/layoutmaster',$this->data);
    }

    /*
    * Thông báo xác nhận
    */
    function confirm()
    {
      //Load view
      $this->data['title'] = 'Xác nhận đăng ký';
      $this->data['temp'] = 'site/user/confirm';
      $this->load->view('site/layoutmaster',$this->data);
    }

    /*
    * Lịch sử mua hàng
    */
    function history()
    {
        if(!$this->session->userdata('user_id_logged'))
        {
            redirect(base_url('user/login'));
        }

        $id = $this->session->userdata('user_id_logged');
        $input['where'] = array('MaKH' => $id);

        $this->load->model('order_model');
        $order_list = $this->order_model->get_list($input);
        foreach ($order_list as $row )
        {
            switch ($row->TinhTrang)
            {
              case 0:
                $row->TinhTrang = 'Chưa xử lý';
                break;
                case 1:
                  $row->TinhTrang = 'Đang vận chuyển';
                  break;
                  case 2:
                    $row->TinhTrang = 'Giao thành công';
                    break;
                    case 3:
                      $row->TinhTrang = 'Hủy';
                      break;
          }
        }
        // prt($order_list);

        $this->data['order_list'] = $order_list;

        //Load view
        $this->data['title'] = 'Lịch sử mua hàng';
        $this->data['temp'] = 'site/user/history';
        $this->load->view('site/user/layoutmaster',$this->data);
    }

    /*
    * Chi tiết đơn hàng
    */
    function detail()
    {
        if(!$this->session->userdata('user_id_logged'))
        {
            redirect(base_url('user/login'));
        }
        //Thông tin user
        $this->load->model('user_model');
        $id = $this->session->userdata('user_id_logged');
        $user = $this->user_model->get_info($id);
        //LoaiKH
        $this->load->model('usertype_model');
        $type = $this->usertype_model->get_info($user->LoaiKH);
        $this->data['type'] = $type;

        $order_id = $this->uri->segment(3);
        $input['where'] = array('MaDH' => $order_id);

        $this->load->model('orderdetail_model');
        $orderdetail_list = $this->orderdetail_model->get_list($input);
        $this->data['orderdetail_list'] = $orderdetail_list;



        $this->load->model('product_model');
        foreach ($orderdetail_list as $row) {
            $product = $this->product_model->get_info($row->MaSP);
            $row->Ten = $product->TenSP;
            $row->Hinh = $product->Hinh;
        }
        // prt($orderdetail_list);

        //Load view
        $this->data['title'] = 'Chi tiết đơn hàng';
        $this->data['temp'] = 'site/user/detail';
        $this->load->view('site/user/layoutmaster',$this->data);
    }

}
 ?>
