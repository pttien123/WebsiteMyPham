<?php
class Admin extends MY_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('admin_model');
    }

     /*
     *  Hiển thị danh sách các admin
     */
    function index()
    {
      //Tạo các biến giữ giá trị trong bảng
      $info = array();
      $list = $this->admin_model->get_list($info);
      //Biến cho biết tổng các hàng dữ liệu trong bảng
      $total = $this->admin_model->get_total();
      //Lấy nội dung thông báo bên function add()
      $message = $this->session->flashdata('message');
      //Load dữ liệu view của trang
      $this->data['list'] = $list;
      $this->data['total'] = $total;
      $this->data['message'] = $message;
      $this->data['temp'] = 'admin/Admin/index';
      $this->load->view('admin/layoutmaster',$this->data);
    }

    //Hàm kiểm tra dữ liệu của username có trùng hay không
    function check_username()
    {
        //Lấy dữ liệu cần kiểm tra
        $username = $this->input->post('username');
        //Tạo biến điều kiện
        $where = array('username' => $username);
        //Kiểm tra username đã tồn tại chưa
        if($this->admin_model->check_exists($where))
        {
            //Nếu tồn tại
            //Trả về thông báo lỗi
            $this->form_validation->set_message(__FUNCTION__,'Username đã tồn tại');
            return FALSE;
        }
        return TRUE;
    }
    /*
    * Thêm mới một quản trị viên
    */
    function add()
    {
        //Load thư viện form_validation của CI
        $this->load->library('form_validation');
        $this->load->helper('form');
        //Khi nhấn nút submit -> kiểm tra dữ liệu nhập
        if($this->input->post())
        {
            //giatri1: tên của input cần kiểm tra; giatri2: Nội dung xuất; giatri3: điều kiện kiểm tra
            $this->form_validation->set_rules('username','Username','required|min_length[6]|callback_check_username');
            $this->form_validation->set_rules('ho','Họ và tên lót','required|max_length[50]');
            $this->form_validation->set_rules('ten','Tên','required|max_length[20]');
            $this->form_validation->set_rules('email','Email','required|valid_email');
            $this->form_validation->set_rules('phone','Số điện thoại','required|max_length[15]');
            $this->form_validation->set_rules('password','Mật khẩu','required|min_length[8]|max_length[32]');
            $this->form_validation->set_rules('repassword','Nhập lại mật khẩu','required|matches[password]');

            //có cái if này nó mới in mấy cái kiểm tra
            //bên add.php form_error, form_value,...(không cần nội dung bên trong)
            if($this->form_validation->run())
            {
                //Thêm mới hàng trong bảng
                $username = $this->input->post('username');
                $ho = $this->input->post('ho');
                $ten = $this->input->post('ten');
                $email = $this->input->post('email');
                $phone = $this->input->post('phone');
                $password = $this->input->post('password');
                $today = date("Y/m/d");
                $data = array(
                    'Username' => $username,
                    'Ho' => $ho,
                    'Ten' => $ten,
                    'Email' => $email,
                    'Phone' => $phone,
                    'Password' => $password,
                    'NgayTao' => $today,
                    'NgayCapNhat' => $today
                );

                if($this->admin_model->insert($data))
                {
                    //Tạo nội dung thông báo
                    //giatri1: tên biến; giatri2: Nội dung biến
                    $this->session->set_flashdata('message','Thêm thành công');
                }
                else
                {
                    $this->session->set_flashdata('message','Thêm thất bại');
                }
                //Chuyển về trang index
                redirect(admin_url('admin'));
            }

        }
        //Load view của trang
        $this->data['temp'] = 'admin/Admin/add';
        $this->load->view('admin/layoutmaster',$this->data);
    }

    /*
     * Chỉnh sửa dữ liệu một quản trị viên
     */
     function update()
     {


     }

     function delete()
     {
       // code...
     }


}
 ?>
