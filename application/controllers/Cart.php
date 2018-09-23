<?php
class Cart extends MY_Controller
{
    function __construct()
    {
        parent::__construct();

    }

    /*
    * Hiển thị giỏ hàng
    */
    function index()
    {
        //Thông tin sp trong giỏ hàng
        $cart = $this->cart->contents();
        $this->data['cart'] = $cart;
        
        //Tổng số sp trong giỏ hàng
        $total_items = $this->cart->total_items();
        $this->data['total_items'] = $total_items;

        //Load view giỏ hàng
        $this->data['title'] = 'Giỏ hàng';
        $this->data['temp'] = 'site/cart/index';
        $this->load->view('site/layoutmaster',$this->data);
    }

    /*
    * Thêm sản phẩm vào giỏ hàng
    */
    function add()
    {
        $id = $this->uri->segment(3);

        $this->load->model('product_model');
        $product = $this->product_model->get_info($id);
        if(!$product)
        {
            redirect();
        }
        //Biến tổng số sp
        $qty = 1;
        $price = $product->DonGia;
        $discount = $product->GiamGia;
        if($product->GiamGia >0)
        {
            $price = $product->DonGia * (1-$product->GiamGia);
        }

        //Gắn dữ liệu sp. Các biến id, name, qty, price là key bắt buộc, không được sửa
        $data = array(
          'id'    => $product->MaSP,
          'name'  => url_title($product->TenSP),
          'qty'   => $qty,
          'image_link' => $product->Hinh,
          'unit_price' => $product->DonGia,
          'discount' => $discount,
          'price' => $price
        );

        //Thêm vào giỏ hàng
        if($this->cart->insert($data))
        {
            redirect(base_url('cart/index'));
        }
    }

    /*
    * Cập nhật sản phẩm trong giỏ hàng
    */
    function update()
    {
        //Thông tin sp trong giỏ hàng
        $cart = $this->cart->contents();

        foreach ($cart as $row)
        {
            //Lấy tổng số lượng mua của sp
            $qty = $this->input->post('qty_'.$row['id']);
            if($qty != $row['qty'])
            {
                $row['qty'] = $qty;
                $data = array(
                  'rowid' => $row['rowid'],
                  'qty'   => $row['qty']
                 );
                $this->cart->update($data);
            }

        }
        redirect(base_url('cart/index'));

    }
    /*
    * Xóa một sản phẩm trong giỏ hàng
    */
    function delete()
    {
        //Thông tin sp trong giỏ hàng
        $id = intval($this->uri->segment(3));
        //Xóa một sản phẩm
        if($id > 0)
        {
          //Thông tin sp trong giỏ hàng
          $cart = $this->cart->contents();
          //Xóa bằng cách cập nhật qty bằng 0
          foreach ($cart as $row)
          {
              if($row['id'] == $id)
              {
                  $data = array(
                      'rowid' => $row['rowid'],
                      'qty'   => 0
                  );
                  $this->cart->update($data);
              }
          }
        }
        else
        {
            //Xóa toàn bộ sản phẩm
            $this->cart->destroy();
        }

        redirect(base_url('cart/index'));

    }
}
 ?>
