<!--Phần header của trang-->
<?php $this->load->view('admin/admin/header') ?>
<div class="line"></div>
<!-- Main content wrapper -->
<div class="wrapper">
  	<div class="widget">
      		<div class="title">
        			<h6>Thêm mới Quản Trị Viên</h6>
      		</div>
          <form class="form" id="form" action="" method="post" enctype="multipart/form-data">
			         <fieldset>
                 <!--Hàng username-->
                      <div class="formRow">
                              <label class="formLeft" for="param_username">
                                  Username<span class="req">*</span>
                              </label>
                              <div class="formRight">
                                  <span class="oneTwo">
                                      <input name="username" id="param_username" _autocheck="true" type="text" value="<?php echo set_value('username') ?>"/>
                                  </span>
                                  <span name="name_autocheck" class="autocheck"></span>
                                  <div name="name_error" class="clear error"><?php echo form_error('username'); ?></div>
                              </div>
                              <div class="clear"></div>
                      </div>
                 <!--Hàng nhập họ và tên lót-->
                       <div class="formRow">
                           	<label class="formLeft" for="param_ho">
                                Họ và tên lót:<span class="req">*</span>
                            </label>
                           	<div class="formRight">
                             		<span class="oneTwo">
                                    <input name="ho" id="param_ho" _autocheck="true" type="text" value="<?php echo set_value('ho') ?>"/>
                                </span>
                             		<span name="name_autocheck" class="autocheck"></span>
                             		<div name="name_error" class="clear error"><?php echo form_error('ho'); ?></div>
                           	</div>
                           	<div class="clear"></div>
                       </div>
                      <!--Hàng nhập tên-->
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

                    <!--Hàng Email-->
                    <div class="formRow">
                         <label class="formLeft" for="param_email">
                             Email<span class="req">*</span>
                         </label>
                         <div class="formRight">
                             <span class="oneTwo">
                                 <input name="email" id="param_email" _autocheck="true" type="text" value="<?php echo set_value('email') ?>"/>
                             </span>
                             <span name="name_autocheck" class="autocheck"></span>
                             <div name="name_error" class="clear error"><?php echo form_error('email'); ?></div>
                         </div>
                         <div class="clear"></div>
                    </div>
                    <!--Hàng nhập số điện thoại-->
                    <div class="formRow">
                        <label class="formLeft" for="param_phone">
                            Số điện thoại<span class="req">*</span>
                        </label>
                        <div class="formRight">
                            <span class="oneTwo">
                                <input name="phone" id="param_phone" _autocheck="true" type="text" value="<?php echo set_value('phone') ?>"/>
                            </span>
                            <span name="name_autocheck" class="autocheck"></span>
                            <div name="name_error" class="clear error"><?php echo form_error('phone'); ?></div>
                        </div>
                        <div class="clear"></div>
                    </div>
                    <!--Hàng nhập mật khẩu-->
                    <div class="formRow">
                       <label class="formLeft" for="param_password">
                           Mật khẩu<span class="req">*</span>
                       </label>
                       <div class="formRight">
                           <span class="oneTwo">
                               <input name="password" id="param_password" _autocheck="true" type="password" />
                           </span>
                           <span name="name_autocheck" class="autocheck"></span>
                           <div name="name_error" class="clear error"><?php echo form_error('password'); ?></div>
                       </div>
                       <div class="clear"></div>
                    </div>
                    <!--Hàng nhập nhập lại mật khẩu-->
                    <div class="formRow">
                      <label class="formLeft" for="param_repassword">
                          Nhập lại mật khẩu<span class="req">*</span>
                      </label>
                      <div class="formRight">
                          <span class="oneTwo">
                              <input name="repassword" id="param_repassword" _autocheck="true" type="password" />
                          </span>
                          <span name="name_autocheck" class="autocheck"></span>
                          <div name="name_error" class="clear error"><?php echo form_error('repassword'); ?></div>
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
