<style >
    table td{border-bottom: 1px solid;padding: 5px; text-align: center;font-size: 12px;margin: auto;}
    th{padding: 5px;border-bottom: 1px solid}
</style>
<div class="box-center">
    <div class="tittle-box-center">
		     <h2>Chi tiết đơn hàng</h2>
		</div>
		<div class="box-content-center register">
         <h1>Các sản phẩm</h1>
         <hr>
    </div>
    <?php if(count($orderdetail_list)>0): ?>
    <table>
        <thead>
              <th>Mã SP</th>
              <th>Tên SP</th>
              <th>Số lượng</th>
              <th>Đơn giá</th>
              <th>Giảm giá</th>
              <th>Ghi Chú</th>
        </thead>
        <?php foreach ($orderdetail_list as $row):?>
        <tbody>
          <tr>
            <td><?php echo $row->MaSP?></td>
            <td>
              <div class="image_thumb">
                  <img src="<?php echo base_url('upload/product/').$row->Hinh?>" height="50">
                  <div class="clear"></div>
              </div>
              <b><?php echo $row->Ten?></b>
            </td>
            <td><?php echo $row->SoLuong?></td>
            <td><?php echo $row->DonGia?></td>
            <td><?php echo $row->GiamGia *100?>%</td>
            <td><?php echo $row->GhiChu ?></td>

          </tr>

        </tbody>
      <?php endforeach; ?>
    </table>
    <br>
    <br>
    <a href="<?php echo base_url('user/history') ?>" style="font-style:italic;color:darkorange;font-weight:bold;"> << Quay lại</a>
    <?php else: ?>
    <p>Không có sản phẩm nào</p>
    <?php endif; ?>
 </div>
