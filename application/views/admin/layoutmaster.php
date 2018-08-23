<!DOCTYPE html>
<html>
  <head>
      <?php $this->load->view('admin/headtag'); ?>
  </head>
  <body>
    <!-- Left side content -->
      <div id="left_content">
          <?php $this->load->view('admin/left') ?>
      </div>
    <!-- Right side -->
      <div id ="rightSide">
        <?php $this->load->view('admin/header') ?>

        <!--Phần nội dung chính-->
        <?php $this->load->view($temp,$this->data) ?>

        <!--Kết thúc phần nội dung chính-->

        <?php $this->load->view('admin/footer') ?>
      </div>
      <div class="clear"></div>

  </body>
</html>
