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

        		 	<div class="num f12">
                  Tổng số: <b>0</b>
              </div>
      		</div>
          <table cellpadding="0" cellspacing="0" width="100%" class="sTable mTable myTable withCheck" id="checkAll">
			<thead>
				<tr>
					<td style="width:10px;"><img src="<?php echo public_url('admin')?>/images/icons/tableArrows.png" /></td>
					<td style="width:80px;">Mã số</td>
					<td>Họ và tên</td>
					<td>Username</td>
					<td>Password</td>
					<td>Email</td>
					<td style="width:100px;">Hành động</td>
				</tr>
			</thead>

 			<tfoot>
				<tr>
					<td colspan="7">
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
        <tr>
						<td>
                <input type="checkbox" name="id[]" value="19" />
            </td>

						<td class="textC">19</td>

						<td>
                <span title="Hoàng văn Tuyền" class="tipS">
  							Hoàng văn Tuyền
                </span>
          </td>


						<td>
                <span title="hoangvantuyencnt@gmail.com" class="tipS">
  							         hoangvantuyencnt@gmail.com
                </span>
            </td>

						<td>01686039488			</td>

						<td>		111		</td>


						<td class="option">
							 <a href="user/edit/19.html" title="Chỉnh sửa" class="tipS ">
							<img src="<?php echo public_url('admin')?>/images/icons/color/edit.png" />
							</a>

							<a href="user/del/19.html" title="Xóa" class="tipS verify_action" >
							    <img src="<?php echo public_url('admin')?>/images/icons/color/delete.png" />
							</a>
						</td>
					</tr>
        </tbody>
      </table>
  	</div>
</div>
<!--End main content wrapper-->
<div class="clear mt30"></div>
<!--Footer-->
<?php $this->load->view('admin/footer') ?>
<div class="clear"></div>