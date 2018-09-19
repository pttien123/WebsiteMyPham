<!--Tải slider chạy -->
<?php $this->load->view('site/slide',$this->data); ?>
<div class="clear">

</div>
<!--Tải sản phẩm -->
<div class="box-center"><!-- The box-center product-->
    <div class="tittle-box-center">
		   <h2>Sản phẩm mới</h2>
		</div>
		<div class="box-content-center product"><!-- The box-content-center -->
		     <?php foreach ($new_product as $row) : ?>
         <div class="product_item"style="width:170px;">
              <h3>
                <a href="<?php echo base_url('product/view/'.$row->MaSP) ?>" title="<?php echo $row->TenSP ?>"><?php echo $row->TenSP ?></a>
              </h3>
              <div class="product_img">
                  <a href="<?php echo base_url('product/view/'.$row->MaSP) ?>" title="<?php echo $row->TenSP ?>">
                      <img src="<?php echo base_url('upload/product/'.$row->Hinh) ?>" alt="<?php echo $row->TenSP ?>">
                  </a>
              </div>

              <p class="price">
                <?php if($row->GiamGia >0): ?>
                  <?php echo number_format($row->DonGia * (1-$row->GiamGia)) ?>đ
                  <span class="price_old"><?php echo number_format($row->DonGia) ?>đ</span>
                <?php else: ?>
                  <?php echo number_format($row->DonGia) ?>đ
		          </p>

            <?php endif; ?>
              <center>
                  <div class="raty" style="margin: 10px 0px; width: 100px;" id="8" data-score="3.4">

                  </div>
              </center>
              <div class="action">
                  <p style="float:left;margin-left:10px">Giảm: <b style="color:red;"><?php echo $row->GiamGia *100 ?>%</b></p>
	                <a class="button" href="<?php echo base_url('product/view/'.$row->MaSP) ?>" title="Mua ngay" >Mua ngay</a>
	                <div class="clear"></div>
              </div>
          </div>
        <?php endforeach; ?>


		          <div class="clear"></div>
		  </div><!-- End box-content-center -->
</div>
