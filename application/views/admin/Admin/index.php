<!--Phần header của trang-->
<?php $this->load->view('admin/admin/header',$this->data) ?>

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
        			<h6>Danh sách Quản Trị Viên</h6>
        		 	<div class="num f12"> Tổng số: <b><?php echo $total; ?></b></div>
      		</div>

          <table cellpadding="0" cellspacing="0" width="100%" class="sTable mTable myTable withCheck" id="checkAll">
        			<thead>
        				<tr>
        					<td style="width:10px;"><img src="<?php echo public_url('admin/images/')?>icons/tableArrows.png" /></td>
        					<td style="width:80px;">Username</td>
        					<td>Họ</td>
                  <td>Ten</td>
                  <td>Địa chỉ</td>
        					<td>Email</td>
        					<td>Điện thoại</td>
        					<td>Password</td>
                  <td>Ngày Tạo</td>
                  <td>Ghi Chú</td>

        					<td style="width:100px;">Hành động</td>
        				</tr>
        			</thead>

         			<tfoot>
        				<tr>
        					<td colspan="11">
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
                          <input type="checkbox" name="id[]" value="<?php echo $row->Username ?>" /></td>
          						<td class="textC"><?php echo $row->Username ?></td>

          						<td>
                          <span title="" class="tipS">
            							           <?php echo $row->Ho?>
                          </span>
                      </td>
                      <td>
                          <span title="" class="tipS">
            							           <?php echo $row->Ten?>
                          </span>
                      </td>
                      <td> <?php echo $row->DiaChi ?>		</td>

          						<td>
            							<?php echo $row->Email ?>
                      </td>

          						<td> <?php echo $row->Phone ?>		</td>

          						<td> 	<?php echo $row->Password ?>	</td>
                      <td> 	<?php echo $row->NgayTao?>	</td>
                      <td> 	<?php echo $row->GhiChu?>	</td>

          						<td class="option">
              							<a href="<?php echo admin_url('admin/edit/').$row->MaQTV ?>" title="Chỉnh sửa" class="tipS ">
              							     <img src="<?php echo public_url('admin/images/')?>icons/color/edit.png" />
              							</a>

              							<a href="<?php echo admin_url('admin/delete/').$row->MaQTV ?>" title="Xóa" class="tipS verify_action" >
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
<!--Footer-->
<?php $this->load->view('admin/footer') ?>
<div class="clear"></div>
