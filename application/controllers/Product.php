<?php
class Product extends MY_Controller
{
    function __construct()
    {
        parent::__construct();
        //load model sản phẩm
        $this->load->model('product_model');
    }
    /*
    * Hiển thị các sản phẩm theo danh mục
    */
    function catalog()
    {
        //Phương thức show tất cả sp khi click vào một danh mục
        //Lấy mã của thể loại, ép kiểu thành số nguyên
        $id = intval($this->uri->segment(3));
        //Lấy danh mục
        $this->load->model('catalog_model');
        $catalog = $this->catalog_model->get_info($id);
        if(!$catalog)
        {
            redirect();
        }

        $this->data['catalog'] = $catalog;
        $input = array();
        //Kiểm tra là danh mục con hay cha
        //Nếu là danh mục cha
        if($catalog->DMCha == 0)
        {
          //Lấy danh sách các danh mục con
            $input_catalog = array();
            $input_catalog['where'] = array('DMCha'=>$id);
            $catalog_sub = $this->catalog_model->get_list($input_catalog);

            //Nếu danh mục hiện tại có danh mục con
            if(!empty($catalog_sub))
            {
                //Lấy tất cả mã của các danh mục con đó
                $catalog_sub_id = array();
                foreach ($catalog_sub as $sub) {
                    $catalog_sub_id[] = $sub->MaDM;
                }

                //Lấy tất cả sản phảm thuộc danh mục con đó
                $this->db->where_in('MaDM',$catalog_sub_id);


            }
            else
            {
                $input['where'] = array('MaDM' =>$id);
            }
        }
        else
        {
            $input['where'] = array('MaDM' =>$id);
        }



        //Lấy tổng số lượng sp có danh mục là $id
        $total_rows = $this->product_model->get_total($input);
        $this->data['total_rows'] = $total_rows;

        //Load thu vien phan trang
        $this->load->library('pagination');
        $config = array();
        $config['total_rows'] = $total_rows;
        $config['base_url'] = base_url('product/catalog/'.$id); // link hien thi danh sach sp
        $config['per_page'] = 4; // so luong hien thi tren 1 trang
        $config['uri_segment'] = 4; // phan doan tren segment
        $config['next_link'] = 'Trang kế';
        $config['prev_link'] = 'Trang trước';

        //cấu hình phân trang
        $this->pagination->initialize($config);

        //Lay thong tin segment o vtri 4
        $segment = $this->uri->segment(4);
        $segment = intval($segment);
        //Lay 4 sp, bat dau tu vi tri thu $segment
        $input['limit'] = array($config['per_page'], $segment);

        //load csdl lay danh sach san pham theo dieu kien phan trang
        if(isset($catalog_sub_id))
        {
            $this->db->where_in('MaDM', $catalog_sub_id);
        }

        $list = $this->product_model->get_list($input);
        $this->data['list'] = $list;

        //Load view
        $this->data['title'] = 'Sản phẩm thuộc '.$catalog->TenDM;
        $this->data['temp'] = 'site/product/catalog';
        $this->load->view('site/layoutmaster',$this->data);
    }

    /*
    * Hiển thị chi tiết sản phẩm
    */
    function view()
    {
        //Lấy id sp
        $id = intval($this->uri->segment(3));
        $product = $this->product_model->get_info($id);
        if(!$product)
        {
            redirect();
        }
        $this->data['product'] = $product;
        //Lấy danh sách ảnh sản phẩm kèm theo
        $image_list = json_decode($product->DSHinh);
        $this->data['image_list'] = $image_list;

        $this->load->model('catalog_model');
        $catalog = $this->catalog_model->get_info($product->MaDM);
        $this->data['catalog'] = $catalog;

        $this->load->model('unit_model');
        $unit = $this->unit_model->get_info($product->MaDV);
        $this->data['unit'] = $unit;

        $this->load->model('brand_model');
        $brand = $this->brand_model->get_info($product->MaNH);
        $this->data['brand'] = $brand;

        $this->data['title'] = 'Thông tin sản phẩm '.$product->TenSP;
        $this->data['temp'] = 'site/product/view';
        $this->load->view('site/layoutmaster', $this->data);
    }

    /*
    * Tìm kiếm sp theo tên
    */
    function search()
    {
        if($this->uri->segment(3) == 'auto')
        {
              $key = $this->input->get('term');
        }
        else {
              $key = $this->input->get('key-search');
        }

        $this->data['key'] = $key;

        $input = array();
        $input['like'] = array('TenSP',$key);
        $list = $this->product_model->get_list($input);
        $this->data['list'] = $list;

        if($this->uri->segment(3) == 'auto')
        {
            //Xử lý autocomplete
            $result = array();
            foreach ($list as $row)
            {
                $item = array(
                  'id' => $row->MaSP,
                  'label' => $row->TenSP,
                  'value' => $row->TenSP
                );
                $result[]= $item;
            }
            //Lấy dữ liệu dưới dạng json code
            die(json_encode($result));
        }
        else {
          //Laod giao diện
          $this->data['title'] = 'Tìm kiếm sản phẩm tên "'.$key .'"';
          $this->data['temp'] = 'site/product/search';
          $this->load->view('site/layoutmaster', $this->data);
        }
    }

    /*
    * Tìm kiếm sp theo giá
    */
    function search_price()
    {
        //Lấy thông tin khoảng giá mà khách muốn tìm kiếm
        $price_from = intval($this->input->get('price_from'));
        $price_to = intval($this->input->get('price_to'));
        $this->data['price_from'] = $price_from;
        $this->data['price_to'] = $price_to;
        //Tạo biến điều kiện lọc
        $input = array();
        $input['where'] = array(
            'DonGia >=' => $price_from,
            'DonGia <=' => $price_to
        );

        //Lấy danh sách với đk lọc
        $list = $this->product_model->get_list($input);
        $this->data['list'] = $list;

        //Laod giao diện
        $this->data['title'] = 'Tìm kiếm sản phẩm theo giá';
        $this->data['temp'] = 'site/product/search_price';
        $this->load->view('site/layoutmaster', $this->data);
    }

    /*
    * Xử lý việc đánh giá
    */
    function raty()
    {
        $result = array();

        $id = $this->input->post('id'); //Lấy mã sản phẩm gửi lên từ trang ajax
        //$id = (!is_numberic($id))?0:$id;
        $info = $this->product_model->get_info($id);
        if(!$info)
        {
            exit();
        }
        // //Kiểm tra đã đăng nhập hay chưa
        if(!$this->session->userdata('user_id_logged'))
        {
            $result['msg'] = "Bạn cần đăng nhập để thực hiện chức năng này";
            $output        = json_encode($result); //trả về mã json
            echo $output;
            exit();
        }

        //Kiểm tra đã bình chọn hay chưa
        $raty = $this->session->userdata('session_raty');
        $raty = (!is_array($raty)) ? array() : $raty;
        
        //Nếu đã tồn tại mã sp này trong session đánh giá
        if(isset($raty[$id]))
        {
            $result['msg'] = "Bạn chỉ được đánh giá 1 lần";
            $output        = json_encode($result); //trả về mã json
            echo $output;
            exit();
        }
        //Cập nhật trạng thái đã bình chọn
        $raty[$id] = true;
        $this->session->set_userdata('session_raty',$raty);

        //Cập nhật vào csdl
        $score = $this->input->post('score');//Lấy điểm gửi lên từ trang ajax
        $data = array(
          'DiemDG' => $info->DiemDG + $score, //Tổng điểm đánh giá
          'LuotDG' => $info->LuotDG + 1 //Tổng lượt đánh giá
        );
        $this->product_model->update($id,$data);

        //Khai báo dữ liệu trả về
        $result['complete'] = TRUE;
        $result['msg'] = "Cảm ơn bạn đã đánh giá cho sản phẩm";
        $output        = json_encode($result); //trả về mã json
        echo $output;
        exit();

    }
}
 ?>
