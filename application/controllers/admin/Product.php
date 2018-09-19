<?php
Class Product extends MY_Controller
{
  function __construct()
  {
      parent::__construct();
      //load ra file model
      $this->load->model('product_model');
      date_default_timezone_set("Asia/Ho_Chi_Minh");
  }

  /*
  *Hiển thị danh sách sản phẩm
  */
  function index()
  {
    $total_rows = $this->product_model->get_total();
    $this->data['total_rows'] = $total_rows;
    //Load thu vien phan trang
    $this->load->library('pagination');
    $config = array();
    $config['total_rows'] = $total_rows;
    $config['base_url'] = admin_url('product/index'); // link hien thi danh sach sp
    $config['per_page'] = 8; // so luong hien thi tren 1 trang
    $config['uri_segment'] = 4; // phan doan tren segment
    $config['next_link'] = 'Trang kế';
    $config['prev_link'] = 'Trang trước';
    //cấu hình phân trang
    $this->pagination->initialize($config);
    //Lay thong tin segment o vtri 4
    $segment = $this->uri->segment(4);
    $segment = intval($segment);

    $input = array();
    //Lay 2 sp, bat dau tu vi tri thu $segment
    $input['limit'] = array($config['per_page'], $segment);
    //Kiểm tra có lọc hay không
    //Lọc theo mã sp
    $id = $this->input->get('id');
    $id = intval($id);
    $input['where'] = array();
    if($id > 0 )
    {
        $input['where']['MaSP'] = $id;
    }
    //Lọc theo tên
    $name = $this->input->get('name');
    if($name)
    {
        $input['like'] = array('TenSP',$name);
    }
    //Lọc theo danh mục
    $catalog_id = $this->input->get('catalog');
    $catalog_id = intval($catalog_id);
    //prt($catalog_id);
    if($catalog_id > 0)
    {
        $input['where']['MaDM'] = $catalog_id;
    }
    //Kết thúc phần kt lọc

    //load csdl lay danh sach san pham theo dieu kien phan trang
    $list = $this->product_model->get_list($input);
    $this->data['list'] = $list;



    //Lấy danh sách danh mục sản Phẩm
    $this->load->model('catalog_model');
    $input = array();
    $input['where'] = array('DMCha' => 0 );
    //Danh sách danh mục là danh mục cha
    $catalog = $this->catalog_model->get_list($input);
    //Danh sách các danh mục con
    foreach ($catalog as $row) {
        $input['where'] = array('DMCha' => $row->MaDM );
        $sub = $this->catalog_model->get_list($input);
        $row->sub = $sub;
    }
    $this->data['catalog'] =$catalog ;
    //prt($catalog);

    //Lấy nội dung của biến message
    $message = $this->session->flashdata('message');
    $this->data['message'] = $message;

    //load view
    $this->data['title'] = 'Trang Quản lý Sản Phẩm';
    $this->data['temp'] = 'admin/product/index';
    $this->load->view('admin/layoutmaster', $this->data);
  }

  /*
  * Thêm sản phẩm
  */
  function add()
  {
    //Load thư viện form_validation của CI
    $this->load->library('form_validation');
    $this->load->helper('form');

    //Lấy danh sách danh mục sản Phẩm
    $this->load->model('catalog_model');
    $input = array();
    $input['where'] = array('DMCha' => 0 );
    //Danh sách danh mục là danh mục cha
    $catalog = $this->catalog_model->get_list($input);
    //Danh sách các danh mục con
    foreach ($catalog as $row) {
        $input['where'] = array('DMCha' => $row->MaDM );
        $sub = $this->catalog_model->get_list($input);
        $row->sub = $sub;
    }
    $this->data['catalog'] =$catalog ;

    //Lấy danh sách nhãn hiệu
    $this->load->model('brand_model');
    $brand = $this->brand_model->get_list();
    $this->data['brand'] =$brand;
    //Lấy danh sách dvkl
    $this->load->model('unit_model');
    $unit = $this->unit_model->get_list();
    $this->data['unit'] =$unit;

    //Nhấn submit Thêm
    if($this->input->post())
    {
        $this->form_validation->set_rules('tenSP','Tên nhãn hiệu', 'required');
        $this->form_validation->set_rules('danhmuc','Tên danh mục', 'required');
        $this->form_validation->set_rules('nhanhieu','Tên nhãn hiệu', 'required');
        $this->form_validation->set_rules('khoiluong','Khối lượng', 'required');
        $this->form_validation->set_rules('dvkl','Đơn vị', 'required');
        $this->form_validation->set_rules('dongia','Đơn giá', 'required');
        $this->form_validation->set_rules('tenLo','Tên lô', 'required');


        if($this->form_validation->run())
        {
            //Lấy dữ liệu
            $tenSP       = $this->input->post('tenSP');
            $danhmuc     = $this->input->post('danhmuc');
            $nhanhieu    = $this->input->post('nhanhieu');
            $khoiluong   = $this->input->post('khoiluong');
            $dvkl        = $this->input->post('dvkl');
            $dongia      = $this->input->post('dongia');
            $dongia      =  str_replace(',','',$dongia);
            $giamgia     = $this->input->post('giamgia');
            $giamgia     = $giamgia/100;
            $tenLo       = $this->input->post('tenLo');
            $ghichu      = $this->input->post('ghichu');
            $baiviet     = $this->input->post('content');

            $this->load->library('upload_library');
            $upload_path = './upload/product';
            $upload_data = $this->upload_library->upload($upload_path,'image');
            if(isset($upload_data['file_name']))
            {
                $hinh = $upload_data['file_name'];
            }

            $dshinh = array();
            $dshinh = $this->upload_library->upload_files($upload_path,'image_list');
            //Chuyển mảng thành một chuỗi json để lưu vào csdl
            $dshinh = json_encode($dshinh);
            $today = date('Y/m/d');


            //Tạo biến data chứa các mảng dữ liệu
            $data = array(
              'TenSP' => $tenSP,
              'MaDM' => $danhmuc,
              'MaNH' => $nhanhieu,
              'KhoiLuong' => $khoiluong,
              'MaDV' => $dvkl,
              'DonGia' => $dongia,
              'GiamGia' => $giamgia,
              'TenLo' => $tenLo,
              'GhiChu' => $ghichu,
              'BaiViet' => $baiviet,
              'Hinh' => $hinh,
              'DSHinh' => $dshinh,
              'NgayTao' => $today
            );

            if($this->product_model->insert($data))
            {
                $this->session->set_flashdata('message','Thêm thành công');
            }
            else
            {
                $this->session->set_flashdata('message','Thêm thất bại');
            }

            //Chuyển về trang index
            redirect(admin_url('product'));
        }
    }
    //load view
    $this->data['title'] = 'Trang Thêm Sản Phẩm';
    $this->data['temp'] = 'admin/product/add';
    $this->load->view('admin/layoutmaster', $this->data);
  }

  /*
  *Chỉnh sửa sản phẩm
  */
  function edit()
  {
    //Load thư viện form_validation của CI
    $this->load->library('form_validation');
    $this->load->helper('form');

    $id = $this->uri->rsegment(3);
    $info = $this->product_model->get_info($id);
    if(!$info)
    {
        $this->session->set_flashdata('message','Không tồn tại sản phẩm này');
        redirect(admin_url('product'));
    }
    $this->data['info'] = $info;


    //Lấy danh sách danh mục sản Phẩm
    $this->load->model('catalog_model');
    $input = array();
    $input['where'] = array('DMCha' => 0 );
    //Danh sách danh mục là danh mục cha
    $catalog = $this->catalog_model->get_list($input);
    //Danh sách các danh mục con
    foreach ($catalog as $row) {
        $input['where'] = array('DMCha' => $row->MaDM );
        $sub = $this->catalog_model->get_list($input);
        $row->sub = $sub;
    }
    $this->data['catalog'] =$catalog ;

    //Lấy danh sách nhãn hiệu
    $this->load->model('brand_model');
    $brand = $this->brand_model->get_list();
    $this->data['brand'] =$brand;
    //Lấy danh sách dvkl
    $this->load->model('unit_model');
    $unit = $this->unit_model->get_list();
    $this->data['unit'] =$unit;

    //Nhấn submit Cập nhật
    if($this->input->post())
    {
        $this->form_validation->set_rules('tenSP','Tên nhãn hiệu', 'required');
        $this->form_validation->set_rules('danhmuc','Tên danh mục', 'required');
        $this->form_validation->set_rules('nhanhieu','Tên nhãn hiệu', 'required');
        $this->form_validation->set_rules('khoiluong','Khối lượng', 'required');
        $this->form_validation->set_rules('dvkl','Đơn vị', 'required');
        $this->form_validation->set_rules('dongia','Đơn giá', 'required');
        $this->form_validation->set_rules('tenLo','Tên lô', 'required');


        if($this->form_validation->run())
        {
            //Lấy dữ liệu
            $tenSP       = $this->input->post('tenSP');
            $danhmuc     = $this->input->post('danhmuc');
            $nhanhieu    = $this->input->post('nhanhieu');
            $khoiluong   = $this->input->post('khoiluong');
            $dvkl        = $this->input->post('dvkl');
            $dongia      = $this->input->post('dongia');
            $dongia      =  str_replace(',','',$dongia);
            $giamgia     = $this->input->post('giamgia');
            $giamgia     = $giamgia/100;
            $tenLo       = $this->input->post('tenLo');
            $ghichu      = $this->input->post('ghichu');
            $baiviet     = $this->input->post('content');

            $this->load->library('upload_library');
            $upload_path = './upload/product';
            $upload_data = $this->upload_library->upload($upload_path,'image');
            if(isset($upload_data['file_name']))
            {
                $hinh = $upload_data['file_name'];
            }

            $dshinh = array();
            $dshinh = $this->upload_library->upload_files($upload_path,'image_list');
            //Chuyển mảng thành một chuỗi json để lưu vào csdl
            $dshinh_json = json_encode($dshinh);

            //Tạo biến data chứa các mảng dữ liệu
            $data = array(
              'TenSP' => $tenSP,
              'MaDM' => $danhmuc,
              'MaNH' => $nhanhieu,
              'KhoiLuong' => $khoiluong,
              'MaDV' => $dvkl,
              'DonGia' => $dongia,
              'GiamGia' => $giamgia,
              'TenLo' => $tenLo,
              'GhiChu' => $ghichu,
              'BaiViet' => $baiviet
            );
            //Mếu có thay đổi hình đại diện
            if($hinh != '')
            {
                $data['Hinh'] = $hinh;
                //Xóa file hiện có
                $delete_path = './upload/product/'.$info->Hinh;
                unlink($delete_path);
            }
            //Nếu có thay đổi hình đính kèm
            if(!empty($dshinh))
            {
                $data['DSHinh'] = $dshinh_json;
                //Xóa hình hiện có
                $img = json_decode($info->DSHinh);
                foreach ($img as $link)
                {
                    $delete_path = './upload/product/'.$link;
                    unlink($delete_path);
                }
            }

            if($this->product_model->update($info->MaSP,$data))
            {
                $this->session->set_flashdata('message','Chỉnh sửa thành công');
            }
            else
            {
                $this->session->set_flashdata('message','Chỉnh sửa thất bại');
            }

            //Chuyển về trang index
            redirect(admin_url('product'));
        }
    }
    //load view
    $this->data['title'] = 'Trang Chỉnh sửa Sản Phẩm';
    $this->data['temp'] = 'admin/product/edit';
    $this->load->view('admin/layoutmaster', $this->data);
  }
  /*
  * Xóa sản phẩm
  */
  function delete()
  {
    $id = $this->uri->rsegment(3);
    $info = $this->product_model->get_info($id);
    if(!$info)
    {
        $this->session->set_flashdata('message','Không tồn tại sản phẩm này');
        redirect(admin_url('product'));
    }

    //Xoa hinh
    $hinh = $info->Hinh;
    //Xóa file hiện có
    $delete_path = './upload/product/'.$info->Hinh;
    unlink($delete_path);


    //Xóa hình hiện có
    $img = json_decode($info->DSHinh);
    foreach ($img as $link)
    {
        $delete_path = './upload/product/'.$link;
        unlink($delete_path);
    }
    $this->product_model->delete($id);
    $this->session->set_flashdata('message','Xóa thành công');
    redirect(admin_url('product'));
  }
}
