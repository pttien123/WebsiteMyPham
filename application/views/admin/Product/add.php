<!--Phần header của trang-->
<?php $this->load->view('admin/product/header',$this->data) ?>
<div class="line"></div>


<!-- Main content wrapper -->
<div class="wrapper">
	   	<!-- Form -->
		<form class="form" id="form" action="<?php echo admin_url('product/add'); ?>" method="post" enctype="multipart/form-data">
			<fieldset>
				<div class="widget">
				    <div class="title">
								<img src="<?php echo public_url('admin/images/')?>icons/dark/add.png" class="titleIcon">
								<h6>Thêm mới Sản phẩm</h6>
						</div>

				    <ul class="tabs">
		                <li><a href="#tab1">Thông tin chung</a></li>
										<li><a href="#tab2">Hình ảnh</a></li>
		                <li><a href="#tab3">Bài viết</a></li>
					  </ul>

						<div class="tab_container">
					     <div id="tab1" class="tab_content pd0">
						         	<div class="formRow">
													<label class="formLeft" for="param_tenSP">
															Tên:<span class="req">*</span>
													</label>
													<div class="formRight">
																<span class="oneTwo"><input name="tenSP" id="param_tenSP" _autocheck="true" type="text"></span>
																<span name="name_autocheck" class="autocheck"></span>
																<div name="name_error" class="clear error"><?php echo form_error('tenSP'); ?></div>
													</div>
													<div class="clear"></div>
											</div>


										<div class="formRow">
											<label class="formLeft" for="param_danhmuc">
												Danh Mục:<span class="req">*</span>
											</label>
											<div class="formRight">
												<select name="danhmuc" _autocheck="true" id="param_danhmuc" class="left">
															<option value="">Lựa chọn danh mục</option>
															<?php foreach ($catalog as $row):?>
																<?php if(count($row->sub) >0):?>
															 <!-- kiem tra danh muc co danh muc con hay khong -->
																		 <optgroup label="<?php echo $row->TenDM ?>">
																			 <?php foreach ($row->sub as $sub): ?>
																							<option value="<?php echo $sub->MaDM ?>" <?php ($this->input->get('catalog') == $sub->MaDM)?'selected':''; ?>>
																									<?php echo $sub->TenDM ?>
																							</option>
																			<?php endforeach; ?>
																		 </optgroup>
																	 <?php else: ?>
																		 <option value="<?php echo $row->MaDM ?>" <?php ($this->input->get('catalog') == $row->MaDM)?'selected':''; ?>><?php echo $row->TenDM ?></option>
																	 <?php endif; ?>
																<?php endforeach; ?>
												</select>
												<span name="cat_autocheck" class="autocheck"></span>
												<div name="cat_error" class="clear error"><?php echo form_error('danhmuc'); ?></div>
											</div>
											<div class="clear"></div>
										</div>
										<!-- Nhãn hiệu -->
										<div class="formRow">
											<label class="formLeft" for="param_nhanhieu">Nhãn Hiệu:<span class="req">*</span></label>
											<div class="formRight">
												<select name="nhanhieu" _autocheck="true" id="param_nhanhieu" class="left">
														<option value="">Lựa chọn nhãn hiệu</option>
														<?php foreach ($brand as $row): ?>
																 <!--  -->
														      	<option value="<?php echo $row->MaNH ?>">
																        <?php echo $row->TenNH ?>
																		</option>
														<?php endforeach; ?>
												</select>
												<span name="nhanhieu_autocheck" class="autocheck"></span>
												<div name="nhanhieu_error" class="clear error"><?php echo form_error('nhanhieu'); ?></div>
											</div>
											<div class="clear"></div>
										</div>
										<!-- DVKL -->
										<div class="formRow">
												<label class="formLeft" for="param_khoiluong">Khối lượng:<span class="req">*</span></label>
												<div class="formRight">
															<span class="oneTwo"><input name="khoiluong" id="param_khoiluong" _autocheck="true" type="text"></span>
															<span name="khoiluong_autocheck" class="autocheck"></span>
															<div name="khoiluong_error" class="clear error"><?php echo form_error('khoiluong'); ?></div>
												</div>
												<div class="clear"></div>
										</div>

										<div class="formRow">
											<label class="formLeft" for="param_dvkl">Đơn vị khối lượng:<span class="req">*</span></label>
											<div class="formRight">
												<select name="dvkl" _autocheck="true" id="param_dvkl" class="left">
														<option value="">Lựa chọn đơn vị</option>
																<?php foreach ($unit as $row): ?>
																 <!-- kiem tra  -->
																		 <option value="<?php echo $row->MaDV ?>">
																				 <?php echo $row->TenDV ?>
																		 </option>
																<?php endforeach; ?>
												</select>
												<span name="dvkl_autocheck" class="autocheck"></span>
												<div name="dvkl_error" class="clear error"><?php echo form_error('dvkl'); ?></div>
											</div>
											<div class="clear"></div>
										</div>

										<!-- Price -->
										<div class="formRow">
											<label class="formLeft" for="param_dongia">
													Giá :
													<span class="req">*</span>
											</label>
											<div class="formRight">
													<span class="oneTwo">
															<input name="dongia" style="width:100px" id="param_dongia" class="format_number" _autocheck="true" type="text">
															<img class="tipS" title="Giá bán sử dụng để giao dịch" style="margin-bottom:-8px" src="<?php echo public_url('admin/crown/')?>images/icons/notifications/information.png">
													</span>
													<span name="dongia_autocheck" class="autocheck"></span>
													<div name="dongia_error" class="clear error"><?php echo form_error('dongia'); ?></div>
											</div>
											<div class="clear"></div>
										</div>

									<!-- Price -->
										<div class="formRow">
												<label class="formLeft" for="param_giamgia">
													Giảm giá (%):
												</label>
												<div class="formRight">
														<span>
																<input name="giamgia" style="width:100px" id="param_giamgia" class="" type="text">
																<img class="tipS" title="Số tiền giảm giá" style="margin-bottom:-8px" src="<?php echo public_url('admin/crown/')?>images/icons/notifications/information.png">
														</span>
														<span name="giamgia_autocheck" class="autocheck"></span>
														<div name="giamgia_error" class="clear error"></div>
												</div>
												<div class="clear"></div>
										</div>

										<div class="formRow">
											 <label class="formLeft" for="param_tenLo">Tên lô:<span class="req">*</span></label>
											 <div class="formRight">
														 <span class="oneTwo"><input name="tenLo" id="param_tenLo" _autocheck="true" type="text"></span>
														 <span name="name_autocheck" class="autocheck"></span>
														 <div name="name_error" class="clear error"><?php echo form_error('tenLo'); ?></div>
											 </div>
											 <div class="clear"></div>
										</div>

										<div class="formRow">
											 <label class="formLeft" for="param_ghichu">Ghi chú:</label>
											 <div class="formRight">
														 <span class="oneTwo"><input name="ghichu" id="param_ghichu" _autocheck="true" type="text"></span>
														 <span name="name_autocheck" class="autocheck"></span>
														 <div name="name_error" class="clear error"></div>
											 </div>
											 <div class="clear"></div>
									 </div>
					 </div>
					<!--End tab1-->

					<div id="tab2" class="tab_content pd0">
						<div class="formRow">
								<label class="formLeft">Hình ảnh:<span class="req">*</span></label>
								<div class="formRight">
										<div class="left">
											<input type="file" id="image" name="image"></div>
										<div name="image_error" class="clear error"><?php echo form_error('hinh'); ?></div>
								</div>
								<div class="clear"></div>
						</div>

						<div class="formRow">
								<label class="formLeft">Ảnh kèm theo:</label>
								<div class="formRight">
										<div class="left">
											<input type="file" id="image_list" name="image_list[]" multiple=""></div>
										<div name="image_list_error" class="clear error"></div>
								</div>
								<div class="clear"></div>
						</div>
					</div>
					<!--End tab2-->

				  <div id="tab3" class="tab_content pd0">
							 <div class="formRow">
									<label class="formLeft">Nội dung:</label>
									<div class="formRight">
												<textarea name="content" id="param_content" class="editor"></textarea>
												<div name="content_error" class="clear error"></div>
									</div>
									<div class="clear"></div>
								</div>
								<div class="formRow hide"></div>
					</div>
					<!--End tab3-->

	     	</div><!-- End tab_container-->

	        		<div class="formSubmit">
	           			<input type="submit" value="Thêm mới" class="redB">
	           	</div>
	        		<div class="clear"></div>
				</div>
			</fieldset>
		</form>
</div>
