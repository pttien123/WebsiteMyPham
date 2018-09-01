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
    <a href="#" id="back_to_top" style="display: block;">
		   <img src="<?php echo public_url() ?>site/images/top.png">
	  </a>
    <div class= "wrapper">
        <div class ="header">
            <?php $this->load->view('site/header');?>
        </div>
        <div class ="container">
            <div class ="left">
                <?php $this->load->view('site/left');?>
            </div>

            <div class ="content" style="align=center;">
                <?php $this->load->view($temp); ?>
            </div>
            <div class ="right ">
                  <?php $this->load->view('site/right');?>
            </div>
            <div class="clear">

            </div>
        </div>

        <div class ="footer">
            <?php $this->load->view('site/footer');?>
        </div>
    </div>
  </body>

</html>
