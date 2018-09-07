<!--Phần header của trang-->
<?php $this->load->view('admin/catalog/header',$this->data) ?>
<div class="line"></div>
<!-- Main content wrapper -->
<div class="wrapper">
  	<div class="widget">
      		<div class="title">
        			<h6>Chỉnh sửa danh mục sản phẩm</h6>
      		</div>

          <form class="form" id="form" method="post" enctype="multipart/form-data" action="">
			         <fieldset>
                 <!--Hàng TenDM-->
                 <div class="formRow">
                      <label class="formLeft" for="param_tenDM">
                          Tên Danh mục:<span class="req">*</span>
                      </label>
                      <div class="formRight">
                          <span class="oneTwo">
                              <input name="tenDM" id="param_tenDM" _autocheck="true" type="text" value="<?php echo $info->TenDM ?>" />
                          </span>
                          <span name="name_autocheck" class="autocheck"></span>
                          <div name="name_error" class="clear error"><?php echo form_error('tenDM'); ?></div>
                      </div>
                      <div class="clear"></div>
                 </div>

                 <!--Hàng DMCha-->
                 <div class="formRow">
                      <label class="formLeft" for="param_dmcha">
                          Danh mục cha:<span class="req">*</span>
                      </label>
                      <div class="formRight">
                          <span class="oneTwo">
                              <select name="dmcha" id="param_dmcha" _autocheck="true">
                                  <option value="0">Là danh mục cha</option>
                                  <?php foreach ($list as $row):?>
                                    <option value="<?php echo $row->MaDM ?>" <?php echo ($row->MaDM == $info->DMCha) ? 'selected' : '';?>> <?php echo $row->TenDM ?></option>
                                  <?php endforeach ?>
                              </select>
                          </span>
                          <span name="name_autocheck" class="autocheck"></span>
                          <div name="name_error" class="clear error"></div>
                      </div>
                      <div class="clear"></div>
                 </div>
                 <!--Hàng TTHienThi-->
                 <div class="formRow">
                      <label class="formLeft" for="param_tt_hienthi">
                          Thứ tự hiển thị:
                      </label>
                      <div class="formRight">
                          <span class="oneTwo">

                              <input name="tt_hienthi" id="param_tt_hienthi" _autocheck="true" type="text" value="<?php echo $info->TTHienThi ?>" />

                          </span>
                          <span name="name_autocheck" class="autocheck"></span>
                          <div name="name_error" class="clear error"><?php echo form_error('tt_hienthi'); ?></div>
                      </div>
                      <div class="clear"></div>
                 </div>
                 <!--Hàng MoTa-->
                 <div class="formRow">
                      <label class="formLeft" for="param_mota">
                          Mô tả:
                      </label>
                      <div class="formRight">
                          <span class="oneTwo">
                              <input name="mota" id="param_mota" _autocheck="true" type="text" value="<?php echo $info->MoTa ?>" />
                          </span>
                          <span name="name_autocheck" class="autocheck"></span>
                          <div name="name_error" class="clear error"><?php echo form_error('mota'); ?></div>
                      </div>
                      <div class="clear"></div>
                 </div>
                 <!--Hàng GhiChu-->
                 <div class="formRow">
                      <label class="formLeft" for="param_ghichu">
                          Ghi chú:
                      </label>
                      <div class="formRight">
                          <span class="oneTwo">
                              <input name="ghichu" id="param_ghichu" _autocheck="true" type="text" value="<?php echo $info->GhiChu ?>" />
                          </span>
                          <span name="name_autocheck" class="autocheck"></span>
                          <div name="name_error" class="clear error"><?php echo form_error('ghichu'); ?></div>
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
