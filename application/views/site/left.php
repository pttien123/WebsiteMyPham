<?php
 	$prict_from_selected = isset($price_from)?intval($price_from):0;
	$prict_to_selected = isset($price_to)?intval($price_to):0;
 ?>
<div class="box-left">
		<div class="title tittle-box-left">
				<h2> Tìm kiếm theo giá </h2>
		</div>
		<div class="content-box"><!-- The content-box -->
				<form class="t-form form_action" method="get" style="padding:10px" action="<?php echo base_url('product/search_price') ?>" name="search">

						<div class="form-row">
								<label for="param_price_from" class="form-label" style="width:70px">
									Giá từ:<span class="req">*</span>
								</label>
								<div class="form-item" style="width:90px">
										<select class="input" id="price_from" name="price_from">
												<?php for($i = 0; $i <= 500000; $i = $i +50000): ?>
													<option <?php echo ($prict_from_selected == $i)?'selected':'' ?> value="<?php echo $i ?>">
														<?php echo number_format($i) ?>đ
													</option>
													<?php endfor; ?>
										</select>
										<div class="clear"></div>
										<div class="error" id="price_from_error"></div>
								</div>
								<div class="clear"></div>
					</div>

					<div class="form-row">
							<label for="param_price_from" class="form-label" style="width:70px">
								Giá tới:<span class="req">*</span>
							</label>
							<div class="form-item" style="width:90px">
									<select class="input" id="price_to" name="price_to">
										<?php for($i = 50000; $i <= 1000000; $i = $i +50000): ?>
											<option <?php echo ($prict_to_selected == $i)?'selected':'' ?> value="<?php echo $i ?>">
												<?php echo number_format($i) ?>đ
											</option>
										<?php endfor; ?>
									</select>
									<div class="clear"></div>
									<div class="error" id="price_from_error"></div>
							</div>
							<div class="clear"></div>
				</div>

				<div class="form-row">
						<label class="form-label">&nbsp;</label>
						<div class="form-item">
								<input type="submit" class="button" name="search" value="Tìm kiếm" style="height:30px !important;line-height:30px !important;padding:0px 10px !important">
						</div>
						<div class="clear"></div>
				</div>
				</form>
		</div><!-- End content-box -->
</div>


<div class="box-left">
		<div class="title tittle-box-left">
				<h2> Danh mục sản phẩm </h2>
		</div>
		<div class="content-box"><!-- The content-box -->
						<ul class="catalog-main">
							<?php foreach ($catalog_list as $row ):?>
								<li>
										<span><a href="<?php echo base_url('product/catalog/'.$row->MaDM) ?>" title="<?php echo $row->TenDM ?>"><?php echo $row->TenDM ?></a></span>
										<!-- lay danh sach danh muc con -->
										<?php if(!empty($row->sub)):?>
										<ul class="catalog-sub">
											<?php foreach ($row->sub as $sub ): ?>
												<li>
														<a href="<?php echo base_url('product/catalog/'.$sub->MaDM) ?>" title=" <?php echo $sub->TenDM ?>">
														<?php echo $sub->TenDM ?>
													  </a>
												</li>
											<?php endforeach; ?>
										</ul>
									<?php endif; ?>
								</li>
							<?php endforeach; ?>
						</ul>
		</div><!-- End content-box -->
</div>
