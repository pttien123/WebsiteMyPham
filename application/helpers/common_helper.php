
<?php
//Chứa những hàm dùng chung cho cả admin và site
function public_url($url ='')
{
  return base_url('public/'.$url)
}
