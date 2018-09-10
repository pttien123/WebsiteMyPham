<?php

//if(!define('BASEPATH')) exit ('No direct script access allowed');
class Home extends MY_Controller{
    function index()
    {
      //Đường dẫn chứa nội dung chính hiển thị của trang --view/site/home/index
      $this->data['temp'] = 'site/Home/index';
      $this->data['title'] = 'Trang bán mỹ phẩm chất lượng';
      //Dùng để load view của trang --view site/layoutmaster
      $this->load->view('site/layoutmaster',$this->data);
    }
}
