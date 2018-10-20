<?php
class Order extends MY_Controller
{
    function __construct()
    {
        parent::__construct();
        date_default_timezone_set("Asia/Ho_Chi_Minh");
    }

    function checkout()
    {
        //Load thư viện form_validation của CI
        $this->load->library('form_validation');
        $this->load->helper('form');

        //Nếu chưa đăng nhập
        if(!$this->session->userdata('user_id_logged'))
        {
            redirect(base_url('user/login'));
        }

        //Lấy thông tin thành viên
        $this->load->model('user_model');
        $id = $this->session->userdata('user_id_logged');
        $user = $this->user_model->get_info($id);
        if(!$user)
        {
            $this->session->set_flashdata('message','Không tồn tại tài khoản này');
            redirect(base_url('user/index'));
        }
        $this->data['user'] = $user;

        //Lấy loại kh
        $this->load->model('usertype_model');
        $type = $this->usertype_model->get_info($user->LoaiKH);
        $this->data['type'] = $type;

        //Thông tin sp trong giỏ hàng
        $cart = $this->cart->contents();
        $this->data['cart'] = $cart;
        //Tổng số sp trong giỏ hàng
        $total_items = $this->cart->total_items();

        if($total_items <=0)
        {
            redirect();
        }
        //Tổng số tiền thanh toán
        $total_money = 0;
        foreach ($cart as $row) {
            $total_money = $total_money + $row['subtotal'];
        }

        $total_money += 30000;
        $total_money = $total_money*(1-$type->GiamGia);


        $this->data['total_money'] = $total_money;


        //Khi nhấn submit
        if($this->input->post())
        {
             //giatri1: tên ; giatri2: Nội dung xuất; giatri3: điều kiện kiểm tra
            $this->form_validation->set_rules('email','Email','required|valid_email');
            $this->form_validation->set_rules('last_name','Họ và tên lót','required|max_length[50]');
            $this->form_validation->set_rules('name','Tên','required|max_length[20]');
            $this->form_validation->set_rules('address','Địa chỉ','required');
            $this->form_validation->set_rules('phone','Số điện thoại','required|max_length[15]|min_length[9]');

            if($this->form_validation->run())
            {
                $user_id    = $user->MaKH;
                $today      = date("Y/m/d");
                $email      = $this->input->post('email');
                $last_name  = $this->input->post('last_name');
                $name       = $this->input->post('name');
                $address    = $this->input->post('address');
                $phone      = $this->input->post('phone');
                $note       = $this->input->post('note');

                $data = array(
                  'MaKH'      => $user_id,
                  'Email'     => $email,
                  'NgayDat'   => $today,
                  'NoiGiao'   =>  $address,
                  'Phone'     => $phone,
                  'LoaiKH'    => $type->MaLoaiKH,
                  'GiamGiaThanhVien' =>$type->GiamGia,
                  'TinhTrang' => 0, //0: chưa xử lý, 1: đang vận chuyển, 2: giao thành công, 3: thất bại
                  'TongTien'  => $total_money,
                  'GhiChu'    => $note
                );

                $this->load->model('order_model');
                $this->load->model('orderdetail_model');

                //Thêm đơn hàng
                $this->order_model->insert($data);

                //Lấy mã đơn hàng vừa thêm
                $order_id = $this->db->insert_id();
                $this->data['order_id'] = $order_id;

                foreach ($cart as $row ) {
                    $data = array(
                      'MaDH'      => $order_id,
                      'MaSP'      => $row['id'],
                      'SoLuong'   => $row['qty'],
                      'DonGia'    => $row['unit_price'],

                      'GiamGia'   => $row['discount']
                    );

                    //Tiến hành trừ sản phẩm
                    $input = array();
                    $input['where'] = array(
                            'MaSP' => $row['id'],
                            'SoLuongConLai >' => 0,

                    );
                    $input['order'] = array('HSD', 'ASC');
                    $input['limit'] = array(1,0);
                    $this->load->model('storage_model');
                    //List sản phẩm ở trong bảng hàng tồn
                    $pd = $this->storage_model->get_list($input);
                    
                    //Mã hàng tồn
                    $id_storage = $pd[0]->MaHT;
                    //Trừ SoLuongConLai trong bảng hàng tồn ở sản phầm tương ứng
                    $storage_data = array(
                      'SoLuongConLai ' =>$pd[0]->SoLuongConLai - $row['qty']
                    );
                    $this->storage_model->update($id_storage, $storage_data);

                    //Tiến hành bỏ vào CTDH
                    $this->orderdetail_model->insert($data);


                }


                //Xóa toàn bộ sản phẩm
                $this->cart->destroy();
                $this->session->set_userdata('order_id',$order_id);

                redirect(base_url('order/confirm'));
            }
        }
        //Load view giỏ hàng
        $this->data['title'] = 'Đơn hàng của bạn';
        $this->data['temp'] = 'site/order/checkout';
        $this->load->view('site/layoutmaster',$this->data);

    }
    function confirm()
    {
      $id = $this->session->userdata('order_id');
      $this->data['order_id'] = $id;

      // //Gửi mail thông báo
      // $message = $this->load->view('site/order/mail',$this->data,TRUE);
      // prt($message);
      // $this->load->library('email_library');
      // if($this->email_library->send_mail($message,$email))
      // {
      //   redirect(base_url);
      // }

      //Xác nhận đặt hàng
      $this->data['title'] = 'Xác nhận đặt hàng';
      $this->data['temp'] = 'site/order/confirm';
      $this->load->view('site/layoutmaster',$this->data);
    }

}
 ?>
