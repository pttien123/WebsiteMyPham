<!--Phần header của trang-->
<?php $this->load->view('admin/catalog/header',$this->data) ?>
<div class="line"></div>
<!-- Main content wrapper -->
<div class="wrapper">
  	<div class="widget">
      		<div class="title">
        			<h6>Thêm mới danh mục sản phẩm</h6>
      		</div>

          <form class="form" id="form" method="post" enctype="multipart/form-data" action="">
			         <fieldset>
                 <!--Hàng username-->
                 <div class="formRow">
                      <label class="formLeft" for="param_ten">
                          Tên:<span class="req">*</span>
                      </label>
                      <div class="formRight">
                          <span class="oneTwo">
                              <input name="ten" id="param_ten" _autocheck="true" type="text" value="<?php echo set_value('ten') ?>" />
                          </span>
                          <span name="name_autocheck" class="autocheck"></span>
                          <div name="name_error" class="clear error"><?php echo form_error('ten'); ?></div>
                      </div>
                      <div class="clear"></div>
                 </div>

                 <div class="formRow">
                      <label class="formLeft" for="param_ten">Thứ tự hiển thị:<span class="req">*</span>
                      </label>
                      <div class="formRight">
                          <span class="oneTwo">
                              <input name="ho" id="param_ViTriHienThi" _autocheck="true" type="text" value="<?php echo set_value('ViTriHienThi') ?>"/>
                          </span>
                          <span name="name_autocheck" class="autocheck"></span>
                          <div name="name_error" class="clear error"><?php echo form_error('ho'); ?></div>
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
