<style >
    table td{border-bottom: 1px solid;padding: 5px; text-align: justify;font-size: 12px;margin: auto;}
    th{padding: 5px;border-bottom: 1px solid}
</style>
<div class="box-center"><!-- The box-center product-->
    <div class="tittle-box-center">
		   <h2>Thông tin đơn hàng <?php echo $order_id ?></h2>
       <?php foreach ($info as $row) : ?> 
       <p>
          Khách hàng nhận: <?php echo $row->name?><br>
          Ngày đặt:        <?php echo $row->NgayDat?><br>
          Nơi giao:        <?php echo $row->NoiGiao?><br>
          SĐT:             <?php echo $row->Phone?><br>
          Tổng tiền:       <?php echo $row->TongTien?><br>
          Ghi chú:         <?php echo $row->GhiChu?><br>

       </p>
      <?php endforeach; ?>
      <h3>Chi tiết đơn hàng</h2>
		</div>
    <div class="box-content-center product">
        <table id="cart_contents">
            <thead>
              <th>STT</th>
              <th>Sản Phẩm</th>
              <th>Đơn giá</th>
              <th>Số lượng</th>
              <th>Khuyến mãi</th>
              <th>Thành tiền</th>
            </thead>

            <tbody>
                <?php $count = 0; $sum = 0; ?>
                <?php foreach ($cart as $row):?>
                <tr>
                    <td><?php echo ++$count; ?></td>
                    <td>
                        <b><?php echo $row['name']?></b>
                    </td>
                    <td><?php echo number_format($row['unit_price']) ?>đ</td>
                    <td>
                      <?php echo $row['qty']?>
                    </td>
                    <td>
                      <?php echo $row['discount'] *100;?>%
                    </td>
                    <td><?php echo number_format($row['subtotal']) ?>đ</td>

                </tr>
                <?php endforeach; ?>
                <tr>
                  <td colspan="5">Tiền ship</td>
                  <td><?php echo number_format(30000); ?>đ</td>
                  <td></td>
                </tr>
                <tr>
                    <td colspan="5" style="color:red;"><b>Tổng tiền thanh toán: </b></td>
                    <td style="color:red;"><?php echo number_format($total_money+30000) ?>đ</td>
                </tr>

            </tbody>
        </table>

</div>
