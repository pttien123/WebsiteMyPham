<?php
class Admin_model extends MY_Model
{
  //ghi đè các biến
    var $table = 'admin';
    var $key   ='Username';
    var $order = array('NgayTao','desc');
}


 ?>
