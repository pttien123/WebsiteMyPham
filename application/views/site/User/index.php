<style >
    table td{
      border: 1px;
      padding: 8px;
      text-align: justify;
    }
</style>
<div class="box-center"><!-- The box-center register-->
     <div class="tittle-box-center">
		    <h2>Thông tin tài khoản</h2>
		</div>
    <div class="box-content-center register"><!-- The box-content-center -->
        <h1>Thông tin tài khoản thành viên</h1>
    </div><!-- End box-content-center register-->
    <table>
          <tr>
            <td>Email:</td>
            <td><?php echo $user->Email ?></td>
          </tr>

          <tr>
            <td>Họ và tên:</td>
            <td><?php echo $user->HoKH.' '.$user->TenKH?></td>
          </tr>

          <tr>
            <td>Số điện thoại:</td>
            <td><?php echo $user->Phone?></td>
          </tr>

          <tr>
            <td>Địa chỉ:</td>
            <td><?php echo $user->DiaChi?></td>
          </tr>

          <tr>
            <td>Loại tài khoản: </td>
            <td><?php echo $type->TenLoai?></td>
          </tr>

          <tr>
            <td>Ngày gia nhập:</td>
            <td><?php echo $user->NgayTao?></td>
          </tr>
    </table>
    <a href="<?php echo base_url('user/edit') ?>" class="button" style="float:right;font-size:14px;font-style:italic;color:darkorange;font-weight:bold;">Chỉnh sửa >></a>
 </div>
 <?php if(isset($message) && $message):?>
 <div >
   <p style="color:red;"><?php echo $message ?></p>
 </div>
<?php endif; ?>
