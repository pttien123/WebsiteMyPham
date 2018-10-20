<!--Phần header của trang-->
<?php $this->load->view('admin/storage/header',$this->data) ?>

<div class="line"></div>
<div class="wrapper" id="main_product">
	<?php $this->load->view('admin/message',$this->data) ?>
	<div class="widget">

		<div class="title">
			<span class="titleIcon"><input type="checkbox" id="titleCheck" name="titleCheck"></span>
			<h6>
				Danh sách hàng tồn			</h6>
		 	<div class="num f12">Số lượng: <b><?php echo count($list) ?></b></div>
		</div>

		<table cellpadding="0" cellspacing="0" width="100%" class="sTable mTable myTable" id="checkAll">

			<thead class="filter"><tr><td colspan="10  ">
				<form class="list_filter form" action="<?php echo admin_url('storage') ?>" method="get">
					<table cellpadding="0" cellspacing="0" width="80%"><tbody>

						<tr>
							<td class="label" style="width:40px;"><label for="filter_id">Tên sản phẩm</label></td>
							<td class="item">
								<select name="sanpham" _autocheck="true" id="param_sanpham" class="left">
										 <option value="">Lựa chọn sản phẩm</option>
										 <?php foreach ($product as $row):?>
																		 <option value="<?php echo $row->MaSP ?>" <?php ($this->input->get('sanpham') == $row->MaSP)?'selected':''; ?>>
																				 <?php echo $row->TenSP ?>
																		 </option>
											 <?php endforeach; ?>
							 </select>
						 </td>



							<td style="width:150px">
							<input type="submit" class="button blueB" value="Lọc">
							<input type="reset" class="basic" value="Reset" onclick="window.location.href = '<?php echo admin_url('storage') ?>'; ">
							</td>

						</tr>
						<tr>
							<td class="label" style="width:90px;"><label for="filter_id">HSD từ ngày</label></td>
							<td class="item" style="width:155px;"><input name="expday_from" value="<?php echo $this->input->get('expday_from'); ?>" id="filter_iname" type="date" style="width:155px;"></td>

							<td class="label" style="width:40px;"><label for="filter_id">đến ngày</label></td>
							<td class="item" style="width:155px;"><input name="expday_to" value="<?php echo $this->input->get('expday_to'); ?>" id="filter_iname" type="date" style="width:155px;"></td>


							<td class="label" style="width:60px;"><label for="filter_status"></label></td>
						</tr>
						<tr>

							<td class="label" style="width:40px;"><label for="filter_id">Ngày nhập từ ngày</label></td>
							<td class="item" style="width:155px;"><input name="inday_from" value="<?php echo $this->input->get('inday_from'); ?>" id="filter_iname" type="date" style="width:155px;"></td>

							<td class="label" style="width:40px;"><label for="filter_id">đến ngày</label></td>
							<td class="item" style="width:155px;"><input name="inday_to" value="<?php echo $this->input->get('inday_to'); ?>" id="filter_iname" type="date" style="width:155px;"></td>

						</tr>
					</tbody></table>
				</form>
			</td></tr></thead>

			<thead>
        <tr>
        					<td style="width:10px;"><img src="<?php echo public_url('admin/images/')?>icons/tableArrows.png" /></td>

                  <td style="width:80px;">Mã HT</td>
                  <td>Mã sản phẩm</td>
                  <td>Tên Sản phẩm</td>
        					<td>HSD</td>
                  <td>Ngày nhập</td>
                  <td>Số lượng nhập</td>
                  <td>Số lượng tồn</td>
                  <td>Ghi chú</td>

                  <td style="width:100px;">Hành động</td>
        </tr>
			</thead>

 			<tfoot class="auto_check_pages">
				<tr>
					<td colspan="10">
						 <div class="list_action itemActions">
								<a href="#submit" id="submit" class="button blueB" url="admin/product/del_all.html">
									<span style="color:white;">Xóa hết</span>
								</a>
						 </div>

					     <div class="pagination">
								 	<!-- <?php// echo $this->pagination->create_links(); ?> -->
							 </div>
					</td>
				</tr>
			</tfoot>

			<tbody class="list_item">
        <!-- Filter -->
                      <?php foreach ($list as $row): ?>
                        <tr>
                            <td>
                                <input type="checkbox" name="id[]" value="<?php echo $row->MaHT ?>" />
                            </td>

                            <td class="textC"><?php echo $row->MaHT ?></td>

                            <td>
                                <span title="" class="tipS">
                                           <?php echo $row->MaSP?>
                                </span>
                            </td>
                            <td>
                                <span title="" class="tipS">
                                           <?php echo $row->TenSP?>
                                </span>
                            </td>

                            <td>
                                <span title="" class="tipS">
                                <?php echo $row->HSD ?>
                                </span>
                            </td>
                            <td><?php echo $row->NgayNhap ?></td>
                            <td> 	<?php echo $row->SoLuongGoc ?>	</td>
                            <td> 	<?php echo $row->SoLuongConLai ?>	</td>
                            <td> 	<?php echo $row->GhiChu ?>	</td>



                						<td class="option">
                    							<a href="<?php echo admin_url('storage/edit/').$row->MaHT?>" title="Chỉnh sửa" class="tipS ">
                    							     <img src="<?php echo public_url('admin/images/')?>icons/color/edit.png" />
                    							</a>

                    							<a href="<?php echo admin_url('storage/delete/').$row->MaHT?>" title="Xóa" class="tipS verify_action" >
                    							    <img src="<?php echo public_url('admin/images/')?>icons/color/delete.png" />
                    							</a>
                						</td>
              					</tr>
                      <?php endforeach; ?>
		   </tbody>

		</table>
	</div>

</div>
