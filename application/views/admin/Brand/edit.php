<!--Phần header của trang-->
<?php $this->load->view('admin/brand/header',$this->data) ?>
<div class="line"></div>
<!-- Main content wrapper -->
<div class="wrapper">
  	<div class="widget">
      		<div class="title">
        			<h6>Chỉnh sửa Nhãn Hiệu Sản Phẩm</h6>
      		</div>
          <form class="form" id="form" action="" method="post" enctype="multipart/form-data">
			         <fieldset>
                 <!--Hàng username-->
                      <div class="formRow">
                              <label class="formLeft" for="param__tenNH">
                                  Tên nhãn hiệu:<span class="req">*</span>
                              </label>
                              <div class="formRight">
                                  <span class="oneTwo">
                                      <input name="tenNH" id="param_tenNH" _autocheck="true" type="text" value="<?php echo $info->TenNH ?>"/>
                                  </span>
                                  <span name="name_autocheck" class="autocheck"></span>
                                  <div name="name_error" class="clear error"><?php echo form_error('tenNH'); ?></div>
                              </div>
                              <div class="clear"></div>
                      </div>
                      <!--Hàng mô tả-->
                      <div class="formRow">
                             <label class="formLeft" for="param__mota">
                                 Mô tả:
                             </label>
                             <div class="formRight">
                                   <span class="oneTwo">
                                       <input name="mota" id="param_mota" _autocheck="true" type="text" value="<?php echo $info->MoTa ?>"/>
                                   </span>
                                   <span name="name_autocheck" class="autocheck"></span>
                                   <div name="name_error" class="clear error"></div>
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
                                        <input name="ghichu" id="param_ghichu" _autocheck="true" type="text" value="<?php echo $info->GhiChu ?>"/>
                                  </span>
                                  <span name="name_autocheck" class="autocheck"></span>
                                  <div name="name_error" class="clear error"></div>
                              </div>
                              <div class="clear"></div>
                        </div>


                    <!--Hàng nút submit thêm QTV-->
                    <div class="formSubmit">
                   <input type="submit" value="Cập nhật" class="redB">
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
