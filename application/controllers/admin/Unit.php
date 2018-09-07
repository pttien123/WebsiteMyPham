<?php
class Unit extends MY_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('unit_model');
    }
    /*
    *  Hiển thị danh sách các đơn vị khối lượng
    */
    function index()
    {
        //Lấy danh sách dữ liệu trong bảng từ csdl
        $list = $this->unit_model->get_list();
        $this->data['list'] = $list;

        //Lấy nội dung thông báo
        $message = $this->session->flashdata('message');

        //Load dữ liệu view của trang
        $this->data['message'] = $message;

        //Load view trang index
        $this->data['title'] = 'Trang Quản lý Đơn vị khối lượng';
        $this->data['temp'] = 'admin/unit/index';
        $this->load->view('admin/layoutmaster',$this->data);
    }

    /*
    * Thêm đơn vị khối lượng
    */
    function add()
    {
      //Load thư viện form_validation của CI
      $this->load->library('form_validation');
      $this->load->helper('form');

      //Nhấn submit Thêm
      if($this->input->post())
      {
          $this->form_validation->set_rules('tenDV','Tên đơn vị', 'required');
          if($this->form_validation->run())
          {
              $tenDV = $this->input->post('tenDV');
              $ghichu = $this->input->post('ghichu');

              $data = array(
                'TenDV' => $tenDV,
                'GhiChu' => $ghichu
              );

              if($this->unit_model->insert($data))
              {
                  $this->session->set_flashdata('message','Thêm thành công');
              }
              else
              {
                  $this->session->set_flashdata('message','Thêm thất bại');
              }

              //Chuyển về trang index
              redirect(admin_url('unit'));
          }
        }

        $this->data['title'] = 'Thêm Đơn vị khối lượng';
        $this->data['temp'] = 'admin/unit/add';
        $this->load->view('admin/layoutmaster',$this->data);
    }

    /*
    * Chỉnh sửa đơn vị khối lượng
    */
    function edit()
    {
      //Load thư viện form_validation của CI
      $this->load->library('form_validation');
      $this->load->helper('form');
      //Lấy thông tin ĐvKL cần chỉnh sửa
      $id = $this->uri->rsegment(3);
      $info = $this->unit_model->get_info($id);
      if(!$info)
      {
          $this->session->set_flashdata('message','Đơn vị không tồn tại');
          redirect(admin_url('unit'));
      }
      $this->data['info'] = $info;

      //Nhấn submit cập nhật
      if($this->input->post())
      {
          $this->form_validation->set_rules('tenDV','Tên đơn vị', 'required');
          if($this->form_validation->run())
          {
              $tenDV = $this->input->post('tenDV');
              $ghichu = $this->input->post('ghichu');

              $data = array(
                'TenDV' => $tenDV,
                'GhiChu' => $ghichu
              );

              if($this->unit_model->update($id,$data))
              {
                  $this->session->set_flashdata('message','Chỉnh sửa thành công');
              }
              else
              {
                  $this->session->set_flashdata('message','Chỉnh sửa thất bại');
              }

              //Chuyển về trang index
              redirect(admin_url('unit'));
          }
        }

        $this->data['title'] = 'Chỉnh sửa Đơn vị khối lượng';
        $this->data['temp'] = 'admin/unit/edit';
        $this->load->view('admin/layoutmaster',$this->data);
    }

    /*
    * Xóa đơn vị khối lượng
    */
    function delete()
    {
        //Lấy thông tin ĐvKL cần chỉnh sửa
        $id = $this->uri->rsegment(3);
        $info = $this->unit_model->get_info($id);
        if(!$info)
        {
            $this->session->set_flashdata('message','Đơn vị không tồn tại');
            redirect(admin_url('unit'));
        }
        //Xóa dữ liệu
        $this->unit_model->delete($id);
        $this->session->set_flashdata('message','Xoá thành công');
        redirect(admin_url('unit'));
    }


}


 ?>
