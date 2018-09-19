
<!-- video -->
<script type='text/javascript' src='<?php echo public_url()?>site/tivi/jwplayer.js'></script>
<script type='text/javascript'>
jQuery('document').ready(function(){
	 jwplayer('mediaspace').setup({
    'flashplayer': '<?php echo public_url()?>site/tivi/player.swf',
    'file': 'https://www.youtube.com/watch?v=JLj_Lpdg5Nw',
    'controlbar': 'bottom',
    'width': '560',
    'height': '315',
    'autoplay' : true
  });
})
</script>

<script type="text/javascript">
$(document).ready(function(){
    $('a.tab').click(function(){
    var an_di=$('a.selected').attr('rel');//lấy title của thẻ <a class='active'>
    $('div#'+an_di).hide();//ẩn thẻ <div id='an_di'>
    $('a.selected').removeClass('selected');
    $(this).addClass('selected');
    var hien_thi=$(this).attr('rel');//lấy title của thẻ <a> khi ta kick vào nó
    $('div#'+hien_thi).show();//hiện lên thẻ <div id='hien_thi'>
    });
});
</script>

<!-- zoom image -->
<script src="<?php echo public_url('site/')?>jqzoom_ev/js/jquery.jqzoom-core.js" type="text/javascript"></script>
<link rel="stylesheet" href="<?php echo public_url('site/')?>jqzoom_ev/css/jquery.jqzoom.css" type="text/css">
<script type="text/javascript">
$(document).ready(function() {
	$('.jqzoom').jqzoom({
            zoomType: 'standard',
    });
});
</script>
<!-- end zoom image -->

<!-- Raty -->
<script type="text/javascript">
$(document).ready(function() {
	//raty
	$('.raty_detailt').raty({
    	  score: function() {
    	    return $(this).attr('data-score');
    	  },
    	  half    : true,
    	  click: function(score, evt) {
        	  var rate_count = $('.rate_count');
        	  var rate_count_total = rate_count.text();
    		  $.ajax({
	  				url: 'http://localhost/webphp/product/raty.html',
	  				type: 'POST',
	  				data: {'id':'9','score':score},
	  				dataType: 'json',
	  				success: function(data)
	  				{
	  					if(data.complete)
	  					{
		  					var total = parseInt(rate_count_total)+1;
	  						rate_count.html(parseInt(total));
		  				}
	  					alert(data.msg);
	  				}
    		  });
  		  }
      });
});
</script>
<!--End Raty -->
 <div class="box-center"><!-- The box-center product-->
             <div class="tittle-box-center">
		        <h2>Chi tiết sản phẩm</h2>
		      </div>
		      <div class="box-content-center product"><!-- The box-content-center -->
		           <div class='product_view_img'>
		                <a href="<?php echo base_url('upload/product/'.$product->Hinh) ?>" class="jqzoom" rel='gal1'  title="triumph" >
				            <img  src="<?php echo base_url('upload/product/'.$product->Hinh) ?>" alt='<?php echo $product->TenSP ?>' style="width:280px !important">
				        </a>
				         <div class='clear' style='height:10px'></div>
				         <div class="clearfix" >
							<ul id="thumblist" >

								<li>
									 <a  href='javascript:void(0);' rel="{gallery: 'gal1', smallimage: '<?php echo base_url('upload/product/'.$product->Hinh) ?>',largeimage: '<?php echo base_url('upload/product/'.$product->Hinh) ?>'}">
									 <img src='<?php echo base_url('upload/product/'.$product->Hinh) ?>'>
									 </a>
							 </li>

                  <?php if(is_array($image_list)):?>
                    <?php foreach($image_list as $img): ?>
                        <li>
                           <a  href='javascript:void(0);' rel="{gallery: 'gal1', smallimage: '<?php echo base_url('upload/product/'.$img) ?>',largeimage: '<?php echo base_url('upload/product/'.$img) ?>'}">
                           <img src='<?php echo base_url('upload/product/'.$img) ?>'>
                           </a>
                       </li>
                    <?php endforeach; ?>
                  <?php endif; ?>
							</ul>
						</div>
		           </div>

		           <div class='product_view_content'>
		               <h1><?php echo $product->TenSP ?></h1>

		               <p class='option'>
                     Giá:
                     <?php if($product->GiamGia >0): ?>
                       <span class='product_price'><?php echo number_format($product->DonGia * (1-$product->GiamGia)) ?>đ</span>
                       <span class="price_old"><?php echo number_format($product->DonGia) ?>đ</span>
                     <?php else: ?>
		                   <span class='product_price'><?php echo number_format($product->DonGia) ?>đ</span>
                     <?php endif; ?>
		               </p>
									 <p class='option' style="color:red;" >
		                  Giảm giá: <b><?php echo $product->GiamGia *100 ?>%</b>
		               </p>

		                <p class='option'>
		                  Danh mục:
		                  <a href="<?php echo base_url('product/catalog/'.$catalog->MaDM) ?>" title="<?php echo $catalog->TenDM ?>">
		                     <b><?php echo $catalog->TenDM ?></b>
		                  </a>
		               </p>
                   <p class='option'>
                    Nhãn hiệu:
                        <b><?php echo $brand->TenNH ?></b>
                  </p>

		               <p class='option'>
		                  Khối lượng: <b><?php echo $product->KhoiLuong ?></b>
		               </p>
		               <p class='option'>
		                  Đơn vị: <b><?php echo $unit->TenDV ?></b>
		               </p>
		               		               		               <p class='option'>
		                  Tặng quà: <b></b>
		               </p>
									 <?php $product->LuotDG != 0? $score = $product->DiemDG /  $product->LuotDG : $score=0; ?>
		               Đánh giá &nbsp;
                       <span class='raty_detailt' style = 'margin:5px' id='<?php echo $product->MaSP ?>' data-score='<?php echo $score ?>'></span>
                       | Tổng số: <b  class='rate_count'><?php echo $product->LuotDG ?></b>

		               <div class='action'>
				            <a class='button' style='float:left;padding:8px 15px;font-size:16px' href="<?php echo base_url('cart/add/'.$product->MaSP) ?>" title='Mua ngay'>Thêm vào giỏ hàng</a>
				            <div class='clear'></div>
			            </div>

		           </div>
		           <div class='clear' style='height:15px'></div>
		           <center>
  <!-- AddThis Button BEGIN -->

<!-- AddThis Button END -->
</center>
		            <div class='clear' style='height:10px'></div>
		            <table width="100%" cellspacing="0" cellpadding="3" border="0" class="tbsicons">
					           <tbody>
					           <tr>
					                    <td width="25%"><img alt="Phục vụ chu đáo" src="<?php echo public_url('site/images/')?>icon-services.png"> <div>Phục vụ chu đáo</div></td>
					                    <td width="25%"><img alt="Giao hàng đúng hẹn" src="<?php echo public_url('site/images/')?>icon-shipping.png"><div>Giao hàng đúng hẹn</div></td>
					                    <td width="25%"><img alt="Đổi hàng trong 24h" src="<?php echo public_url('site/images/')?>icon-delivery.png"> <div>Đổi hàng trong 24h</div></td>
					           </tr>
					          </tbody>
					</table>
		      </div>
</div>
<div class="usual" id="usual1">
     <ul>
	       <li><a title="Chi tiết sản phẩm" rel='tab2' href='javascript:void(0)' class="tab selected">Chi tiết sản phẩm</a></li>
	       <li><a title="Video" rel='tab3' href='javascript:void(0)' class="tab">Video</a></li>

	</ul>
</div><!-- end  <div class="usual" id="usual1">-->
  <div class="usual-content">
    	<div id="tab2" >
        		<p>
        	       <?php echo $product->BaiViet ?></p>
        		<!-- comment facebook -->
        		<center>
            <!-- <div id="fb-root"></div>
            <script src="http://connect.facebook.net/en_US/all.js#appId=170796359666689&amp;xfbml=1"></script>
            <div class="fb-comments" data-href="<?php echo current_url() ?>" data-num-posts="5" data-width="550" data-colorscheme="light"></div>
            </center> -->
    	</div>
      <div id="tab3" style="display: none;">
  	    <!-- the div chay video -->
  	    <div id='mediaspace' style="margin:5px;"></div>
	   </div>
</div>
