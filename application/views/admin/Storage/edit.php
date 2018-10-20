<!--Phần header của trang-->
<?php $this->load->view('admin/storage/header',$this->data) ?>
<div class="line"></div>
<!-- Main content wrapper -->
<div class="wrapper">
  	<div class="widget">
      		<div class="title">
        			<h6>Thêm mới Hàng tồn</h6>
      		</div>
          <form class="form" id="form" action="" method="post" enctype="multipart/form-data">
			         <fieldset>
                 <!--Hàng tên sản phẩm-->
                 <div class="formRow">
                   <label class="formLeft" for="param_sanpham">
                     Sản phẩm:<span class="req">*</span>
                   </label>
                   <div class="formRight">
                     <select name="sanpham" _autocheck="true" id="param_sanpham" class="left">
                           <option value="">Lựa chọn sản phẩm</option>
                           <?php foreach ($catalog as $row):?>

                                  <optgroup label="<?php echo $row->TenDM ?>">
                                    <?php foreach ($row->product as $product): ?>
                                           <option value="<?php echo $product->MaSP ?>" <?php if($info->MaSP == $product->MaSP) echo 'selected'; ?>>
                                               <?php echo $product->TenSP ?>
                                           </option>
                                   <?php endforeach; ?>
                                  </optgroup>

                             <?php endforeach; ?>
                     </select>
                     <span name="cat_autocheck" class="autocheck"></span>
                     <div name="cat_error" class="clear error"><?php echo form_error('sanpham'); ?></div>
                   </div>
                   <div class="clear"></div>
                 </div>
                      <!--Hàng HSD-->
                      <div class="formRow">
                             <label class="formLeft" for="param_HSD">
                                 Hạn sử dụng:<span class="req">*</span>
                             </label>
                             <div class="formRight">
                                   <span class="oneTwo">
                                       <input name="HSD" id="param_HSD" _autocheck="true" type="date" value="<?php echo $info->HSD ?>"/>
                                   </span>
                                   <span name="name_autocheck" class="autocheck"></span>
                                   <div name="name_error" class="clear error"><?php echo form_error('HSD'); ?></div>
                             </div>
                             <div class="clear"></div>
                       </div>
                       <!--Hàng Ngày nhập-->
                            <div class="formRow">
                                    <label class="formLeft" for="param_ngayNhap">
                                        Ngày nhập:<span class="req">*</span>
                                    </label>
                                    <div class="formRight">
                                        <span class="oneTwo">
                                            <input name="ngayNhap" id="param_ngayNhap" _autocheck="true" type="date" value="<?php echo $info->NgayNhap?>"/>
                                        </span>
                                        <span name="name_autocheck" class="autocheck"></span>
                                        <div name="name_error" class="clear error"><?php echo form_error('ngayNhap'); ?></div>
                                    </div>
                                    <div class="clear"></div>
                            </div>
                       <!--Hàng số lượng nhập-->
                            <div class="formRow">
                                    <label class="formLeft" for="param_SLNhap">
                                        Số lượng nhập:<span class="req">*</span>
                                    </label>
                                    <div class="formRight">
                                        <span class="oneTwo">
                                            <input style="height:25px;"name="SLNhap" id="param_SLNhap" _autocheck="true" type="number" value="<?php  echo $info->SoLuongGoc ?>"/>
                                        </span>
                                        <span name="name_autocheck" class="autocheck"></span>
                                        <div name="name_error" class="clear error"><?php echo form_error('SLNhap'); ?></div>
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
                                        <input name="ghichu" id="param_ghichu" _autocheck="true" type="text" value="<?php  echo $info->GhiChu?>"/>
                                  </span>
                                  <span name="name_autocheck" class="autocheck"></span>
                                  <div name="name_error" class="clear error"></div>
                              </div>
                              <div class="clear"></div>
                        </div>


                    <!--Hàng nút submit thêm QTV-->
                    <div class="formSubmit">
                   <input type="submit" value="Sửa" class="redB">
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
