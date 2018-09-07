<?php
class Upload_library
{
    // Khai báo biến siêu đối tượng CI, vì trong library không thể load trực tiếp mà phải
    // thông qua biến sieu doi tuong CI này
    var $CI ='';
    function __construct()
    {
        $this->CI = & get_instance();
    }

    /*
    *  Upload một file
    * $upload_path : đường dẫn lưu file
    * $file_name : tên thẻ <input> upload file
    */
    function upload($upload_path='',$file_name='')
    {
        //Cau hinh config va load thu vien upload
        $config = $this->config($upload_path);
        $this->CI->load->library('upload', $config);

        //Thuc hien viec upload file
        if($this->CI->upload->do_upload($file_name))
        {
            $data = $this->CI->upload->data();
        }
        else {
          // khong upload thanh cong
          $error = $this->CI->upload->display_errors();
        }

        return $data;
    }
    /*
    *  Upload nhiều file
    * $upload_path : đường dẫn lưu file
    * $file_name : tên thẻ <input> upload file
    */
    function upload_files($upload_path='',$file_name='')
    {
      //Cau hinh config va load thu vien upload
      $config = $this->config($upload_path);
      $this->CI->load->library('upload', $config);

      $file = $_FILES['image_list'];
      $count = count($file['name']); //tong so file duoc upload
      $image_list = array();

      for($i = 0; $i <$count; $i++)
      {
          $_FILES['userfile']['name']         = $file['name'][$i];
          $_FILES['userfile']['type']         = $file['type'][$i];
          $_FILES['userfile']['tmp_name']     = $file['tmp_name'][$i]; //duong dan tam cua file
          $_FILES['userfile']['error']        = $file['error'][$i];
          $_FILES['userfile']['size']         = $file['size'][$i];

          //Thuc hien viec upload file
          if($this->CI->upload->do_upload())
          {
              $data = $this->CI->upload->data();
              $image_list[] = $data['file_name'];
          }
          else {
            // khong upload thanh cong
            $error = $this->CI->upload->display_errors();
          }
      }     

      return $image_list;
    }


    /*
    *  Cấu hình file upload
    */
    function config($upload_path='')
    {
        //Khai bao cau hinh
        $config = array();
        //Thu muc chua file uplaod
        $config['upload_path'] = $upload_path;
        //Dinh dang file duoc phep tai len
        $config['allowed_types'] = 'jpg|png|gif';
        $config['max_size'] = '1028';
        $config['max_height'] = '1028';
        $config['max_width'] = '1028';

        return $config;
    }
}

 ?>
