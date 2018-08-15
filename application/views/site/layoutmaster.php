<!-- File chứa giao diện dùng chung cho một trang web. Trong một trang web,
sẽ có những phần sẽ được load lại nhiều lần, không that đổi. Để không phải viết
lại nhiều lần và tiện lợi hơn, nên để vào một file riêng
Các nội dung của từng thẻ <div> sẽ có một file tương ứng.
Nên để code vào file đó để nhìn gọn gàng hơn, dễ sửa hơn. 
-->
<html>
  <head>
      <?php $this->load->view('site/headtag'); ?>
  </head>

  <body>
    <div id= "wrapper">
        <div id ="header">
            <?php $this->load->view('site/header');?>
        </div>

        <div id ="container">
            <div id ="left">
                <?php $this->load->view('site/left');?>
            </div>

            <div id ="content">
                <?php $this->load->view($temp); ?>
            </div>
            <div id ="right ">
                  <?php $this->load->view('site/right');?>
            </div>
            <div id="clear">

            </div>
        </div>

        <div id ="footer">
            <?php $this->load->view('site/footer');?>
        </div>
    </div>
  </body>

</html>
