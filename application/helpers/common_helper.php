
<?php
//Chứa những hàm dùng chung cho cả admin và site
function public_url($url='')
{
    return base_url('public/'.$url);
    //Trả về đường dẫn localhost/webmypham/public/
}

function prt($list, $exit = true)
{
    echo "<pre>";
    print_r($list);
    if($exit)
    {
        die();
    }
}
