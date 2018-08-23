<?php
class Admin extends MY_Controller
{
    function __contruct()
    {
        parent::__contruct();
        $this->load->model('admin_model');
    }
     /*
     *  Lấy danh sách admin
     */
    function index()
    {
      //Load dữ liệu view của trang
      $message = $this->session->flashdata('message');
      $this->data['message'] = $message;
      $this->data['temp'] = 'admin/Admin/index';
      $this->load->view('admin/layoutmaster',$this->data);
    }

    function check_username()
    {
        //Lấy dữ liệu cần kiểm tra
        $username = $this->input->post('username');
        //Tạo biến điều kiện
        $where = array('username' => $username);
        //Kiểm tra username đã tồn tại chưa
        if($this->admin_model->check_exists($where))
        {
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
      //Kiểm tra nếu có dữ liệu post thì sẽ kiểm tra dữ liệu có hợp lệ hay không
      if($this->input->post())
      {
          $this->form_validation->set_rules('username','Username','required|max_length[30]|callback_check_username');
          $this->form_validation->set_rules('ho','Họ và tên lót','required|max_length[50]');
          $this->form_validation->set_rules('ten','Tên','required|max_length[20]');
          $this->form_validation->set_rules('email','Email','required|valid_email');
          $this->form_validation->set_rules('phone','Số điện thoại','required|max_length[12]');
          $this->form_validation->set_rules('password','Mật khẩu','required|min_length[8]');
          $this->form_validation->set_rules('repassword','Nhập lại mật khẩu','required|matches');

          //Nhập liệu chính xác
          if($this->form_validation->run())
          {
              //Thêm vào cơ sở dữ liệu
              //tạo biến lấy dữ liệu trong thẻ input
              $username = $this->input->post('username');
              $ho = $this->input->post('ho');
              $ten = $this->input->post('ten');
              $email = $this->input->post('email');
              $phone = $this->input->post('phone');
              $password = $this->input->post('password');
              //Tạo biến data chứa mảng dữ liệu
              $data = array(
                //'tencot' => tenbien,
              );
              /*if($this->admin_model->insert($data)
              {
                  $this->session->set_flashdata('message','Thêm dữ liệu thành công');
              }
              else {
                  $this->session->set_flashdata('message','Thêm dữ liệu thất bại');
              }
              //Chuyển về trang danh sách admin
              redirect(admin_url('admin/index'));
              */
          }
      }
      //Load view của trang
      $this->data['temp'] = 'admin/Admin/add';
      $this->load->view('admin/layoutmaster',$this->data);
    }
}
 ?>
