<?php

//if(!define('BASEPATH')) exit ('No direct script access allowed');
class Home extends CI_Controller{
    function index()
    {
      $data = array();
      //Đường dẫn chứa nội dung hiển thị của trang --view/site/home/index
      $data['temp'] = 'site/home/index';
      //Dùng để load view của trang --view site/layoutmaster
      $this->load->view('site/layoutmaster',$data);
    }
}
