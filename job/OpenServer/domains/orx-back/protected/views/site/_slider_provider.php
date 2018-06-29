<?php
$url = Yii::app()->createUrl('/shop/product/view', array('url'=>$data->url));
				if(isset($data->share_price) && $data->share_price != 0) {
					$cost = $data->share_price;	
					$price = '
						<div class = "b-price b-share_price">
							<p><b>Старая цена: </b><span class = "k-price">'.$data->price.'</span></p>
						</div>
						<div class = "b-price">
							<p><b>Цена: </b><span class = "k-share_price">'.$data->share_price.'</span></p>
						</div>
						';
				}
				else {
					$cost = $data->price;
					$price = '
						<div class = "b-price">
							<p><b>Цена: </b><span class = "k-share_price">'.$data->price.'</span></p>
						</div>
						';
				}
				if(is_file(ROOT_PATH.DIRECTORY_SEPARATOR.'upload'.DIRECTORY_SEPARATOR.'product'.DIRECTORY_SEPARATOR.$data->id.DIRECTORY_SEPARATOR.'thumbnails'.DIRECTORY_SEPARATOR.$data->front_image)){
					$img = '<img src = "/upload/product/'.$data->id.'/thumbnails/'.$data->front_image.'"/>';
				}
				else {
					$img = '<img src = "/images/no-img.png"/>';
				}
				$view .= '
					<li>
						<div class = "b-product_view b-add_to_cart">
							<a class = "slider_img_cont" href = "'.$url.'">'.$img .'</a>
							<a href = "'.$url.'" class = "slider_link">
								'.$data->name.'
							</a>
							'.$data->description.'
							<div class = "b-price_wrap">'.$price.'</div>
							<input type = "hidden" name = "k-prod_id" value = "'.$data->id.'" />
							<input type = "hidden" name = "k-prod_cost" value = "'.$cost.'" />
							<a class = "add_to_cart_button j-add_to_cart" href = "#">в корзину</a>
						</div>
					</li>';
echo $view;
?>