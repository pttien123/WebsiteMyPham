<!--Phần header của trang-->
<?php $this->load->view('admin/unit/header',$this->data) ?>

<div class="line"></div>

<!-- Main content wrapper -->
<div class="wrapper">
  <!--Load phần message-->
    <?php $this->load->view('admin/message',$this->data) ?>
  	<div class="widget">
      		<div class="title">
        			<span class="titleIcon">
                  <input type="checkbox" id="titleCheck" name="titleCheck">
              </span>
        			<h6>Đơn vị (tính/ khối lượng) của sản phẩm</h6>
        		 	<div class="num f12"> Tổng số: <b><?php echo count($list)?></b></div>
      		</div>

          <table cellpadding="0" cellspacing="0" width="100%" class="sTable mTable myTable withCheck" id="checkAll">
        			<thead>
        				<tr>
        					<td style="width:10px;"><img src="<?php echo public_url('admin/images/')?>icons/tableArrows.png" /></td>

                  <td style="width:80px;">Mã ĐV</td>
                  <td>Tên đơn vị</td>
                  <td>Ghi chú</td>

                  <td style="width:100px;">Hành động</td>
        				</tr>
        			</thead>

         			<tfoot>
        				<tr>
        					<td colspan="6">
        					     <div class="list_action itemActions">
        								<a href="#submit" id="submit" class="button blueB" url="user/del_all.html">
        									<span style='color:white;'>Xóa hết</span>
        								</a>
        						 </div>

        					     <div class='pagination'>
        			       </div>
        					</td>
        				</tr>
        			</tfoot>

        			<tbody>
        				<!-- Filter -->
                <?php foreach ($list as $row): ?>
                  <tr>
                      <td>
                          <input type="checkbox" name="id[]" value="<?php echo $row->MaDV ?>" />
                      </td>

                      <td class="textC"><?php echo $row->MaDV ?></td>

                      <td>
                          <span title="" class="tipS">
                                     <?php echo $row->TenDV?>
                          </span>
                      </td>

                      <td> 	<?php echo $row->GhiChu ?>	</td>



          						<td class="option">
              							<a href="<?php echo admin_url('unit/edit/').$row->MaDV?>" title="Chỉnh sửa" class="tipS ">
              							     <img src="<?php echo public_url('admin/images/')?>icons/color/edit.png" />
              							</a>

              							<a href="<?php echo admin_url('unit/delete/').$row->MaDV?>" title="Xóa" class="tipS verify_action" >
              							    <img src="<?php echo public_url('admin/images/')?>icons/color/delete.png" />
              							</a>
          						</td>
        					</tr>
                <?php endforeach; ?>
        			</tbody>
        </table>
  	</div>
</div>
<!--End main content wrapper-->
<div class="clear mt30"></div>
