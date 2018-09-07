<?php
class Home extends MY_Controller
{
    function index()
    {
        //đường dẫn tới nội dung view của trang --view->admin->home->index.php
        $this->data['title'] = 'Trang chủ Quản lý';
        $this->data['temp'] = 'admin/Home/index';
        $this->load->view('admin/layoutmaster',$this->data);
    }
}
