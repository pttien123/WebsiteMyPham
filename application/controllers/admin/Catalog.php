<?php
class Catalog extends MY_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('catalog_model');
    }

    /*
    * Lấy danh sách danh mục sản phẩm
    */
    function index()
    {
      //lấy tổng số
      $list = $this->catalog_model->get_list();
      $this->data['list'] = $list;

      //Lấy nội dung thông báo
      $message = $this->session->flashdata('message');
      //Load dữ liệu view của trang
      $this->data['message'] = $message;

      //load view
      $this->data['temp'] = 'admin/catalog/index';
      $this->load->view('admin/layoutmaster',$this->data);
    }

    /*
    * Thêm mới  loại sản phẩm
    */
   function add()
    {
        //Load thư viện form_validation của CI
        $this->load->library('form_validation');
        $this->load->helper('form');

        $MaDM = $this->uri->rsegment(3);
        $info = $this->catalog_model->get_info($MaDM);
        //Khi nhấn nút submit -> kiểm tra dữ liệu nhập
        if($this->input->post())
        {
            //giatri1: tên ; giatri2: Nội dung xuất; giatri3: điều kiện kiểm tra
            $this->form_validation->set_rules('MaDM','Mã_DM','required|min_length[6]');
            $this->form_validation->set_rules('TenLoai','Tên danh mục','required|max_length[50]');
            $this->form_validation->set_rules('MaDM_Cha','Danh mục cha','required|max_length[20]');


            //có cái if này nó mới in mấy cái kiểm tra
            //bên add.php form_error, form_value,...(không cần nội dung bên trong)
            //Chạy form_validation
            if($this->form_validation->run())
            {
                //Thêm mới hàng trong bảng
                $TenLoai = $this->input->post('TenLoai');
                $MaDM_Cha = $this->input->post('MaDM_Cha');
                $VTHT = $this->input->post('ViTriHienThi');

                $data = array(
                    'TenLoai' => $TenLoai,
                    'MaDM_Cha' => $MaDM_Cha,
                    'ViTriHienThi' => intval($VTHT)
                );
                // thêm mới vào CSDL
                if($this->admin_model->create($data))
                {
                    //Tạo nội dung thông báo
                    //giatri1: tên biến; giatri2: Nội dung biến
                    $this->session->set_flashdata('message','Thêm thành công');
                }
                else
                {
                    $this->session->set_flashdata('message','Thêm thất bại');
                }
                //Chuyển tới trang danh sách
                redirect(admin_url('catalog'));
            }
        }

        //lấy danh sach danh mục cha
        $input = array();
        $input['where'] = array('MaDM_Cha' => 0);
        $list = $this->catalog_model->get_list($input);
        $this->data['list'] = $list;

        //Load view của trang
        $this->data['temp'] = 'admin/catalog/edit';
        $this->load->view('admin/layoutmaster',$this->data);
      }
}
