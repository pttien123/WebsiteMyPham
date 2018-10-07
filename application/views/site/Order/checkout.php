<div class="box-center"><!-- The box-center register-->
             <div class="tittle-box-center">
		        <h2>Đơn hàng</h2>
		      </div>
		      <div class="box-content-center register"><!-- The box-content-center -->
            <h1>Thông tin nhận hàng</h1>
            <form enctype="multipart/form-data" action="<?php echo base_url('order/checkout') ?>" method="post" class="t-form form_action">

              <div class="form-row">

              <label class="form-label" for="param_type">Loại thành viên</label>
              <div class="form-item">
                    <b style="color:red;"><?php echo $type->TenLoai?></b>
              </div>
              <div class="clear"></div>
            </div>
              <div class="form-row">

              <label class="form-label" for="param_email">Giảm giá thành viên:</label>
              <div class="form-item">
                    <b style="color:red;"><?php echo $type->GiamGia *100?>%</b>
              </div>
              <div class="clear"></div>
            </div>
              <div class="form-row">

              <label class="form-label" for="param_email">Tổng tiền thanh toán:</label>
              <div class="form-item">
                    <b style="color:red;"><?php echo number_format($total_money) ?>đ</b>
              </div>
              <div class="clear"></div>
            </div>

                <div class="form-row">
                <label class="form-label" for="param_email">Email nhận đơn hàng:<span class="req">*</span></label>
                <div class="form-item">
                  <input type="text" value="<?php  echo $user->Email?>" name="email" id="email" class="input">
                  <div class="clear"></div>
                  <div id="email_error" class="error"><?php echo form_error('email') ?></div>
                </div>
                <div class="clear"></div>
              </div>


				  <div class="form-row">
						<label class="form-label" for="param_last_name">Họ và tên lót:<span class="req">*</span></label>
						<div class="form-item">
							<input type="text" value="<?php echo $user->HoKH?>" name="last_name" id="last_name" class="input">
							<div class="clear"></div>
							<div id="name_error" class="error"><?php echo form_error('last_name') ?></div>
						</div>
						<div class="clear"></div>
				  </div>

          <div class="form-row">
						<label class="form-label" for="param_name">Tên:<span class="req">*</span></label>
						<div class="form-item">
							<input type="text" value="<?php echo $user->TenKH?>" name="name" id="name" class="input">
							<div class="clear"></div>
							<div id="name_error" class="error"><?php echo form_error('name') ?></div>
						</div>
						<div class="clear"></div>
				  </div>

				  <div class="form-row">
						<label class="form-label" for="param_phone">Số điện thoại:<span class="req">*</span></label>
						<div class="form-item">
							<input type="text" value="<?php echo $user->Phone ?>" name="phone" id="phone" class="input">
							<div class="clear"></div>
							<div id="phone_error" class="error"><?php echo form_error('phone') ?></div>
						</div>
						<div class="clear"></div>
				  </div>

				  <div class="form-row">
						<label class="form-label" for="param_address">Địa chỉ nhận hàng:<span class="req">*</span></label>
						<div class="form-item">
							<textarea name="address" id="address" class="input"><?php echo $user->DiaChi ?></textarea>
							<div class="clear"></div>
							<div id="address_error" class="error"><?php echo form_error('address') ?></div>
						</div>
						<div class="clear"></div>
				  </div>

          <div class="form-row">
						<label class="form-label" for="param_note">Ghi chú:</label>
						<div class="form-item">
							<textarea name="note" id="note" class="input"></textarea>
							<div class="clear"></div>
							<div id="note_error" class="error"></div>
						</div>
						<div class="clear"></div>
				  </div>

				  <div class="form-row">
						<label class="form-label">&nbsp;</label>
						<div class="form-item">
				           	<input type="submit" name="submit" value="Đặt hàng" class="button">
                    <input type="button" name="button" value="Quay lại giỏ hàng" class="button" onclick="location.href='<?php echo base_url('cart/index') ?>';">
						</div>
				   </div>
            </form>
         </div><!-- End box-content-center register-->
 </div>
