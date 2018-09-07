<!--Phần header của trang-->
<?php $this->load->view('admin/unit/header',$this->data) ?>
<div class="line"></div>
<!-- Main content wrapper -->
<div class="wrapper">
  	<div class="widget">
      		<div class="title">
        			<h6>Thêm mới Đơn vị (tính/ khối lượng) của sản phẩm</h6>
      		</div>
          <form class="form" id="form" action="" method="post" enctype="multipart/form-data">
			         <fieldset>
                 <!--Hàng Tên đơn vị-->
                      <div class="formRow">
                              <label class="formLeft" for="param_tenDV">
                                  Tên đơn vị:<span class="req">*</span>
                              </label>
                              <div class="formRight">
                                  <span class="oneTwo">
                                      <input name="tenDV" id="param_tenDV" _autocheck="true" type="text" value="<?php echo set_value('tenDV') ?>"/>
                                  </span>
                                  <span name="name_autocheck" class="autocheck"></span>
                                  <div name="name_error" class="clear error"><?php echo form_error('tenDV'); ?></div>
                              </div>
                              <div class="clear"></div>
                      </div>

                       <!--Hàng ghi chú-->
                       <div class="formRow">
                              <label class="formLeft" for="param_ghichu">
                                    Ghi chú:
                              </label>
                              <div class="formRight">
                                  <span class="oneTwo">
                                        <input name="ghichu" id="param_ghichu" _autocheck="true" type="text" value="<?php echo set_value('ghichu') ?>"/>
                                  </span>
                                  <span name="name_autocheck" class="autocheck"></span>
                                  <div name="name_error" class="clear error"></div>
                              </div>
                              <div class="clear"></div>
                        </div>


                    <!--Hàng nút submit thêm QTV-->
                    <div class="formSubmit">
                   <input type="submit" value="Thêm mới" class="redB">
                </div>

               </fieldset>

          </form>
  	</div>
</div>
<!-- Kết thúc main content -->
<div class="clear mt30"></div>
<!--Footer-->
<?php $this->load->view('admin/footer') ?>
<div class="clear"></div>
