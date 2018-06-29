<?php /*
	$path = Yii::getPathOfAlias('webroot').DS."upload".DS."coupons".DS.$data->img;
	if(file_exists($path))
		$src = '<img itemprop="image" class="coupon-image" src = "/upload/coupons/'.$data->img.'" title = "'.$data->name.'" alt = "'.$data->name.'" kasperskylab_antibanner="on"/>';
	else
		$src = '';
	*/
?>
<?php 
	$path = Yii::getPathOfAlias('webroot').DS."upload".DS.Yii::app()->controller->module->folder.DS.$data->id.".jpg";
	if(file_exists($path))
		$src = '<img  itemprop="image" class="coupon-image" src = "/upload/'.Yii::app()->controller->module->folder.'/'.$data->id.'.jpg" title = "'.$data->name.'" alt = "'.$data->name.'" kasperskylab_antibanner="on"/>';
	else
		$src = '';
?>
<div class="new-coupon">                            

    <div class="main-coupon-body">
            <div class="image-container">
                    <?=$src;?>
            </div>
            <div class="headline"><?=$data->name;?> </div>
            <div class="original_price"></div>
            <div class="details">
                    <span itemprop="description"><?=$data->content;?></span>
            </div> 
            <hr/>
            <div class="disclaimer-section">
                    <div class="disclaimer">
                            <span itemprop="availability"><?=$data->description;?></span>  
                    </div>
                    <div class="expiration">Expires - <?=Helper::stockDate($data->expire_date);;?> </div>
            </div>
    </div>						

    <div class="coupon-footer">
        <div class="footer-top">
            <a class="print-link" href="/coupons/view/pdf/<?=$data->id;?>">
                <img src="/images/print-img.png" kasperskylab_antibanner="on">
            </a>
            <div class="business-name">MJ Car Stereo</div>
            <div class="business-phone">(714)288-8882</div>
            <a class="website-address" href="/">http://www.mjcarstereo.com/</a>
        </div>
        <div class="logo-container">
            <img class="business-logo" src="/images/MJ-Logo-283x300.png" alt="business-logo" kasperskylab_antibanner="on">
        </div>
        <div class="valid-at-container">
            <div class="valid-at">
                <div class="valida-at-address">
                    <div class="address-1">810, West Katella Ave., </div>
                    <div class="address-2">Orange, CA 92867</div>
                </div>
                <div class="valid-at-phone">(714)288-8882</div>
                <div class="valid-at-hours"></div>
            </div>
        </div>
        <div class="coupon-code"><?=$data->code;?></div>
    </div>
</div>
          