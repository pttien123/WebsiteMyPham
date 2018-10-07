<style >
    table td{border-bottom: 1px solid;padding: 5px; text-align: justify;font-size: 12px;margin: auto;border-collapse: collapse;}
    th{padding: 5px;border-bottom: 1px solid}
</style>
<div class="box-center">
    <div class="tittle-box-center">
		     <h2>Lịch sử mua hàng</h2>
		</div>
		<div class="box-content-center register">
         <h1>Đơn hàng</h1>
         <hr>
    </div>
    <?php if(count($order_list)>0): ?>
    <table>
        <thead>
              <th>Mã ĐH</th>
              <th>Tổng tiền</th>
              <th>Ngày đặt</th>
              <th>Nơi giao</th>
              <th>Tình trạng</th>
              <th>Chi tiết</th>
        </thead>
        <?php foreach ($order_list as $row):?>
        <tbody>
          <tr>
            <td ><?php echo $row->MaDH?></td>
            <td><?php echo number_format($row->TongTien)?>đ</td>
            <td><?php echo $row->NgayDat?></td>
            <td><?php echo $row->NoiGiao?></td>
            <td><?php echo $row->TinhTrang ?></td>
            <td> <a href="<?php echo base_url('user/detail/'.$row->MaDH) ?>" style="font-style:italic;color:blue;"> Xem chi tiết</a> </td>
          </tr>

        </tbody>
      <?php endforeach; ?>
    </table>
    <?php else: ?>
    <p>Chưa có đơn hàng nào</p>
    <?php endif; ?>
 </div>
