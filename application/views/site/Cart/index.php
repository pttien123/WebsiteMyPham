<style >
    table#cart_contents
    td{padding: 10px; border: 1px solid; text-align: center;}
    tr{
        border: 1px solid; text-align: center;
    }
    th{
      border: 1px solid; text-align: center;
    }
</style>
<div class="box-center"><!-- The box-center product-->
    <div class="tittle-box-center">
		   <h2>Thông tin giỏ hàng của bạn (có  <?php echo $total_items ?> sản phẩm)</h2>
		</div>
    <div class="box-content-center product">
      <?php if($total_items>0): ?>
      <form class="" action="<?php echo base_url('cart/update') ?>" method="post">
        <table id="cart_contents">
            <thead>
              <th>STT</th>
              <th>Sản Phẩm</th>
              <th>Đơn giá</th>
              <th>Số lượng</th>
              <th>Khuyến mãi</th>
              <th>Thành tiền</th>
              <th>Xóa</th>
            </thead>

            <tbody>
                <?php $count = 0; $sum = 0; ?>
                <?php foreach ($cart as $row):?>
                  <?php $sum = $sum + $row['subtotal']; ?>
                <tr>
                    <td><?php echo ++$count; ?></td>
                    <td>
                        <div class="image_thumb">
                            <img src="<?php echo base_url('upload/product/').$row['image_link'] ?>" height="50">
                            <div class="clear"></div>
                        </div>
                        <b><?php echo $row['name']?></b>
                    </td>
                    <td><?php echo number_format($row['unit_price']) ?></td>
                    <td>
                      <input type="number" step="1" max="5" min="1" style="width:30px" name="qty_<?php echo $row['id'] ?>" value="<?php echo $row['qty']?>">
                    </td>
                    <td><?php echo $row['discount']?></td>
                    <td><?php echo number_format($row['subtotal']) ?></td>
                    <td>
                        <a href="<?php echo base_url('cart/delete/').$row['id'] ?>">Xóa</a>
                    </td>

                </tr>
                <?php endforeach; ?>
                <tr>
                    <td colspan="5" style="color:red;"><b>Tổng tiền thanh toán: </b></td>
                    <td style="color:red;"><?php echo number_format($sum) ?></td>
                    <td>
                        <a href="<?php echo base_url('cart/delete/')?>" type="button">Xóa toàn bộ</a>
                    </td>
                </tr>
                <tr>
                  <td colspan="7">
                      <button type="submit" name="update">Cập nhật </button>
                      <button type="" name="pay">Thanh toán</button>
                  </td>
                </tr>
            </tbody>
        </table>
      </form>
    <?php else: ?>
      <p>Không có sản phẩm trong giỏ hàng</p>
    <?php endif; ?>
    </div>
</div>
