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
      $this->data['title'] = 'Trang Quản lý Danh mục';
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

        //Khi nhấn nút submit -> kiểm tra dữ liệu nhập
        if($this->input->post())
        {
            //giatri1: tên ; giatri2: Nội dung xuất; giatri3: điều kiện kiểm tra

            $this->form_validation->set_rules('tenDM','Tên danh mục','required');

            //Chạy form_validation
            if($this->form_validation->run())
            {
                //Thêm mới hàng trong bảng
                $tenDM = $this->input->post('tenDM');
                $dmCha = $this->input->post('dmcha');
                $hienthi = $this->input->post('tt_hienthi');
                $mota = $this->input->post('mota');
                $ghichu = $this->input->post('ghichu');


                $data = array(
                    'TenDM' => $tenDM,
                    'DMCha' => $dmCha,
                    'TTHienThi' => intval($hienthi),
                    'MoTa' => $mota,
                    'GhiChu' => $ghichu
                );
                // thêm mới vào CSDL
                if($this->catalog_model->insert($data))
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
        $input['where'] = array('DMCha' => 0);
        $list = $this->catalog_model->get_list($input);
        $this->data['list'] = $list;

        //Load view của trang
        $this->data['title'] = 'Thêm Danh mục';
        $this->data['temp'] = 'admin/catalog/add';
        $this->load->view('admin/layoutmaster',$this->data);
      }

    /*
    * Cập nhật loại sản phẩm
    */
    function edit()
    {
      //Load thư viện form_validation của CI
      $this->load->library('form_validation');
      $this->load->helper('form');

      $id = $this->uri->rsegment(3);
      $info = $this->catalog_model->get_info($id);

      //Nếu không có thông tin
      if(!$info)
      {
          $this->session->set_flashdata('message','Danh mục không tồn tại');
          redirect(admin_url('catalog'));
      }
      $this->data['info'] = $info;

      //Nhấn nút cập nhật
      if($this->input->post())
      {
          $this->form_validation->set_rules('tenDM','Tên Danh mục','required');
          //Chạy form_validation
              if($this->form_validation->run())
              {
                  //Cập nhật hàng trong bảng
                  $tenDM = $this->input->post('tenDM');
                  $dmCha = $this->input->post('dmcha');
                  $hienthi = $this->input->post('tt_hienthi');
                  $mota = $this->input->post('mota');
                  $ghichu = $this->input->post('ghichu');

                  $data = array(
                      'TenDM' => $tenDM,
                      'DMCha' => $dmCha,
                      'TTHienThi' => intval($hienthi),
                      'MoTa' => $mota,
                      'GhiChu' => $ghichu
                  );

                  if($this->catalog_model->update($id,$data))
                  {
                      $this->session->set_flashdata('messsage','Chỉnh sửa thành công');
                  }
                  else
                  {
                      $this->session->set_flashdata('messsage','Chỉnh sửa thất bại');
                  }

                  redirect(admin_url('catalog'));
                }
      }
      //lấy danh sach danh mục cha
      $input = array();
      $input['where'] = array('DMCha' => 0);
      $list = $this->catalog_model->get_list($input);
      $this->data['list'] = $list;
      //Load view của trang
      $this->data['title'] = 'Chỉnh sửa Danh mục';
      $this->data['temp'] = 'admin/catalog/edit';
      $this->load->view('admin/layoutmaster',$this->data);
    }

    /*
    * Xóa loại sản phẩm
    */
    function delete()
    {
      //Lấy id của danh mục cần xóa
      $id = $this->uri->rsegment('3');
      //Lấy thông tin danh mục
      $info = $this->catalog_model->get_info($id);
      if(!$info)
      {
         $this->session->set_flashdata('message','Không tồn tại danh mục này');
         redirect(admin_url('catalog'));
      }
      //Thực hiện xóa
      $this->catalog_model->delete($id);
      $this->session->set_flashdata('message','Đã xóa thành công');
      redirect(admin_url('catalog'));
    }


}
