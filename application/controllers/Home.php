<?php

//if(!define('BASEPATH')) exit ('No direct script access allowed');
class Home extends MY_Controller{
    function index()
    {
      //Lấy dữ liệu hình ảnh slide
      // $this->load->model('slide_model');
      // $list = $this->slide_model->get_list();
      // $this->data['slide_list'] = $list;

      //Lấy sản phẩm mới
      $this->load->model('product_model');
      $input = array();
      $input['limit'] = array(3,0);
      $new_product = $this->product_model->get_list($input);
      $this->data['new_product'] = $new_product;
      // $input['where'] = array('KhuyenMai !=' =>0);
      // $discount_product =  $this->product_model->get_list($input);
      //Đường dẫn chứa nội dung chính hiển thị của trang --view/site/home/index
      $this->data['temp'] = 'site/Home/index';
      $this->data['title'] = 'Trang bán mỹ phẩm chất lượng';

      $message = $this->session->flashdata('message');
      $this->data['message'] = $message;

      //Dùng để load view của trang --view site/layoutmaster
      $this->load->view('site/layoutmaster',$this->data);
    }
    function about()
    {
      $this->data['temp'] = 'site/Home/about';
      $this->data['title'] = 'Giới thiệu';
      //Dùng để load view của trang --view site/layoutmaster
      $this->load->view('site/layoutmaster',$this->data);
    }
    function guide()
    {
      $this->data['temp'] = 'site/Home/guide';
      $this->data['title'] = 'Hướng dẫn mua hàng';
      //Dùng để load view của trang --view site/layoutmaster
      $this->load->view('site/layoutmaster',$this->data);
    }
}
