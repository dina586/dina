
<div class="body">
    <div class="body-round"></div>
    <div class="body-wrapper">
        <div class="body-page">
            <div id="main">
                <div id="content">
                    <div class="pagecontent">
                        <div class="post">

                            <div class="new-coupon">

								<div class="main-coupon-body">
									<div class="image-container">
										<img itemprop="image" class="coupon-image" src=<?=$coupon->img;?>  alt="coupon-image" kasperskylab_antibanner="on">
									</div>
									<div class="headline"><?=$coupon->name;?> </div>
									<div class="original_price"></div>
									<div class="details">
										<span itemprop="description"><?=$coupon->content;?></span>
									</div> 
									<hr/>
									<div class="disclaimer-section">
										<div class="disclaimer">
											<span itemprop="availability"><?=$coupon->description;?></span>  
										</div>
										<div class="expiration">Expires - <?=$coupon->expire_date;?> </div>
									</div>
								</div>	

                                <div class="coupon-footer">
                                    <div class="footer-top">
                                        <div class="business-name">MJ Car Stereo (714)288-8882</div>
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
                                    <div class="coupon-code"><?=$coupon->code;?></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


