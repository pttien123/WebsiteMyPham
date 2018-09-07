<?php
class Brand extends MY_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('brand_model');
    }

    /*
    *  Hiển thị danh sách các nhãn hiệu
    */
    function index()
    {
        //Lấy danh sách dữ liệu trong bảng từ csdl
        $list = $this->brand_model->get_list();
        $this->data['list'] = $list;

        //Lấy nội dung thông báo
        $message = $this->session->flashdata('message');

        //Load dữ liệu view của trang
        $this->data['message'] = $message;

        //Load view trang index
        $this->data['title'] = 'Trang Quản lý Nhãn Hiệu';
        $this->data['temp'] = 'admin/brand/index';
        $this->load->view('admin/layoutmaster',$this->data);
    }

    /*
    *  thêm nhãn hiệu
    */
    function add()
    {
        //Load thư viện form_validation của CI
        $this->load->library('form_validation');
        $this->load->helper('form');

        //Nhấn submit Thêm
        if($this->input->post())
        {
            $this->form_validation->set_rules('tenNH','Tên nhãn hiệu', 'required');
            if($this->form_validation->run())
            {
                $tenNH = $this->input->post('tenNH');
                $mota = $this->input->post('mota');
                $ghichu = $this->input->post('ghichu');

                $data = array(
                  'TenNH' => $tenNH,
                  'MoTa' => $mota,
                  'GhiChu' => $ghichu
                );

                if($this->brand_model->insert($data))
                {
                    $this->session->set_flashdata('message','Thêm thành công');
                }
                else
                {
                    $this->session->set_flashdata('message','Thêm thất bại');
                }

                //Chuyển về trang index
                redirect(admin_url('brand'));
            }
        }
        $this->data['title'] = 'Thêm Nhãn Hiệu';
        $this->data['temp'] = 'admin/brand/add';
        $this->load->view('admin/layoutmaster',$this->data);
    }

    /*
    *  Sửa nhãn hiệu
    */
    function edit()
    {
      //Load thư viện form_validation của CI
      $this->load->library('form_validation');
      $this->load->helper('form');

      //Lấy thông tin nhãn hiệu cần sửa
      $id = $this->uri->rsegment(3);
      $info = $this->brand_model->get_info($id);
      if(!$info)
      {
          $this->session->set_flashdata('message','Nhãn hiệu không tồn tại!');
          redirect(admin_url('brand'));
      }
      //Nhấn submit Cập nhật
      if($this->input->post())
      {
          $this->form_validation->set_rules('tenNH','Tên nhãn hiệu', 'required');
          if($this->form_validation->run())
          {
              $tenNH = $this->input->post('tenNH');
              $mota = $this->input->post('mota');
              $ghichu = $this->input->post('ghichu');

              $data = array(
                'TenNH' => $tenNH,
                'MoTa' => $mota,
                'GhiChu' => $ghichu
              );

              if($this->brand_model->update($id,$data))
              {
                  $this->session->set_flashdata('message','Cập nhật thành công');
              }
              else
              {
                  $this->session->set_flashdata('message','Cập nhật thất bại');
              }
              redirect(admin_url('brand'));
          }
      }
      // //Load view trang index
      $this->data['title'] = 'Chỉnh sửa Nhãn Hiệu';
      $this->data['info'] = $info;
      $this->data['temp'] = 'admin/brand/edit';
      $this->load->view('admin/layoutmaster',$this->data);
    }

    /*
    * Xóa nhãn hiệu
    */
    function delete()
    {
      $id = $this->uri->rsegment(3);
      $info = $this->brand_model->get_info($id);
      if(!$info)
      {
          $this->session->set_flashdata('message','Nhãn hiệu không tồn tại!');
          redirect(admin_url('brand'));
      }

      //Xóa dữ liệu
      $this->brand_model->delete($id);
      $this->session->set_flashdata('message','Xoá thành công');
      redirect(admin_url('brand'));
    }
}


 ?>
