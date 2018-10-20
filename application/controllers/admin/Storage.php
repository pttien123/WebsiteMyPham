<?php
class Storage extends MY_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('storage_model');
        date_default_timezone_set("Asia/Ho_Chi_Minh");
    }

     /*
     *  Hiển thị danh sách hàng tồn
     */
     function index()
     {
       //Tạo các biến giữ giá trị trong bảng
       $list = $this->storage_model->get_list();
       //Biến cho biết tổng các hàng dữ liệu trong bảng
       $total = $this->storage_model->get_total();
       //Lấy nội dung thông báo từ bên function add()
       $message = $this->session->flashdata('message');

       $this->load->model('product_model');
       $product = $this->product_model->get_list();
       $this->data['product'] = $product;

       $this->data['list'] = $list;
       $this->data['total'] = $total;
       $this->data['message'] = $message;
       //Load dữ liệu view của trang
       $this->data['title'] = 'Trang Quản lý Hàng tồn';
       $this->data['temp'] = 'admin/storage/index';
       $this->load->view('admin/layoutmaster',$this->data);
     }

     /*
     *  Thêm hàng tồn
     */
     function add()
     {
         //Load thư viện form_validation của CI
         $this->load->library('form_validation');
         $this->load->helper('form');

         //Lấy danh sách danh mục sản Phẩm
         $this->load->model('catalog_model');
         $input = array();
         $input['where'] = array('DMCha <>' => 0 );
         //Danh sách danh mục là danh mục cha
         $catalog = $this->catalog_model->get_list($input);

         //Lấy danh sách sản phẩm trong danh mục
         $this->load->model('product_model');

         foreach ($catalog as $row) {
             $input['where'] = array('MaDM' => $row->MaDM );
             $product = $this->product_model->get_list($input);
             $row->product = $product;
         }

         $this->data['catalog'] =$catalog ;

         //Nhấn submit Thêm
         if($this->input->post())
         {
             $this->form_validation->set_rules('sanpham','Tên sản phẩm', 'required');
             $this->form_validation->set_rules('HSD','Hạn sử dụng', 'required');
             $this->form_validation->set_rules('ngayNhap','Ngày nhập', 'required');
             $this->form_validation->set_rules('SLNhap','Số lượng nhập', 'required');

             if($this->form_validation->run())
             {
                 $productID = $this->input->post('sanpham');
                 $product = $this->product_model->get_info($productID);
                 $product_name = $product->TenSP;
                 $HSD = $this->input->post('HSD');
                 $ngayNhap = $this->input->post('ngayNhap');
                 $SLNhap = $this->input->post('SLNhap');
                 $ghichu = $this->input->post('ghichu');

                 $data = array(
                   'MaSP' => $productID,
                   'TenSP' => $product_name,
                   'HSD'  =>$HSD,
                   'NgayNhap' =>$ngayNhap,
                   'SoLuongGoc' => $SLNhap,
                   'SoLuongConLai' => $SLNhap,
                   'GhiChu' => $ghichu
                 );

                 if($this->storage_model->insert($data))
                 {
                     $this->session->set_flashdata('message','Thêm thành công');
                 }
                 else
                 {
                     $this->session->set_flashdata('message','Thêm thất bại');
                 }

                 //Chuyển về trang index
                 redirect(admin_url('storage'));
             }
         }
         $this->data['title'] = 'Thêm hàng tồn';
         $this->data['temp'] = 'admin/storage/add';
         $this->load->view('admin/layoutmaster',$this->data);
     }

     /*
     *  Sửa hàng tồn
     */
     function edit()
     {
         //Load thư viện form_validation của CI
         $this->load->library('form_validation');
         $this->load->helper('form');
         $id = $this->uri->rsegment(3);

         $info = $this->storage_model->get_info($id);
         if(!$info)
         {
            $this->session->set_flashdata('message','Không tồn tại thông tin');
            redirect(admin_url('storage'));
         }
         $this->data['info'] = $info;
         //Lấy danh sách danh mục sản Phẩm
         $this->load->model('catalog_model');
         $input = array();
         $input['where'] = array('DMCha <>' => 0 );
         //Danh sách danh mục là danh mục cha
         $catalog = $this->catalog_model->get_list($input);

         //Lấy danh sách sản phẩm trong danh mục
         $this->load->model('product_model');

         foreach ($catalog as $row) {
             $input['where'] = array('MaDM' => $row->MaDM );
             $product = $this->product_model->get_list($input);
             $row->product = $product;
         }

         $this->data['catalog'] =$catalog ;

         //Nhấn submit Sửa
         if($this->input->post())
         {
             $this->form_validation->set_rules('sanpham','Tên sản phẩm', 'required');
             $this->form_validation->set_rules('HSD','Hạn sử dụng', 'required');
             $this->form_validation->set_rules('ngayNhap','Ngày nhập', 'required');
             $this->form_validation->set_rules('SLNhap','Số lượng nhập', 'required');

             if($this->form_validation->run())
             {
                 $productID = $this->input->post('sanpham');
                 $product = $this->product_model->get_info($productID);
                 $product_name = $product->TenSP;
                 $HSD = $this->input->post('HSD');
                 $ngayNhap = $this->input->post('ngayNhap');
                 $SLNhap = $this->input->post('SLNhap');
                 $ghichu = $this->input->post('ghichu');

                 $data = array(
                   'MaSP' => $productID,
                   'TenSP' => $product_name,
                   'HSD'  =>$HSD,
                   'NgayNhap' =>$ngayNhap,
                   'SoLuongGoc' => $SLNhap,
                   'SoLuongConLai' => $SLNhap,
                   'GhiChu' => $ghichu
                 );

                 if($this->storage_model->update($id,$data))
                 {
                     $this->session->set_flashdata('message','Sửa thành công');
                 }
                 else
                 {
                     $this->session->set_flashdata('message','Sửa thất bại');
                 }

                 //Chuyển về trang index
                 redirect(admin_url('storage'));
             }
         }

         $this->data['title'] = 'Sửa hàng tồn';
         $this->data['temp'] = 'admin/storage/edit';
         $this->load->view('admin/layoutmaster',$this->data);
     }

     /*
     * Xóa hàng tồn
     */
     function delete()
     {
         $id = $this->uri->rsegment(3);
         $info = $this->storage_model->get_info($id);
         if(!$info)
         {
            $this->session->set_flashdata('message','Không tồn tại thông tin');
            redirect(admin_url('storage'));
         }

         $this->storage_model->delete($id);
         $this->session->set_flashdata('message','Xóa thành công');
         //Chuyển về trang index
         redirect(admin_url('storage'));
     }
}
