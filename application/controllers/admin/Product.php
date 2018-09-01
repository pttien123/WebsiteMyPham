<?php
Class Product extends MY_Controller
{
  function __construct()
  {
      parent::__construct();
      //load ra file model
      $this->load->model('Product_model');
  }

  /*
  *Hiển thị danh sách sản phẩm
  */
  function index()
  {
    //Lấy nội dung của biến message
    $message = $this->session->flashdata('message');
    $this->data['message'] = $message;

    //load view
    $this->data['temp'] = 'admin/product/index';
    $this->load->view('admin/layoutmaster', $this->data);
  }
}
