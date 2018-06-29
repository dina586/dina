<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en"><head>
    <title>MJ Car Stereo</title>
    <?php Yii::app()->getClientScript()->registerCoreScript('jquery');
	$cs=Yii::app()->clientScript;
	$cs->registerPackage('colorbox');
        $cs->registerCssFile(Yii::app()->baseUrl . '/css/coupon.css');  ?>
</head>

<body>
    <table width="600">
	<tbody>
            <tr>
		<td>
                    <div id="main">
			<div id="content">
                            <div class="pagecontent">
            			<div class="post">									        
                                    <a style="margin-left: 10px;" href="javascript:window.print();">Print Coupon</a>
                                    <a href="javascript:window.print();">
                                        <img src="/images/printer.png" border="0" alt="Print" kasperskylab_antibanner="on"></a>
                  
                                        <div class="new-coupon">
                                            
                                            <?php $coupon->content; ?>

                                            <div class="coupon-footer">
                                                <div class="footer-top">
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
                                                <div class="coupon-code"><?=$coupon->code;?></div>
                                            </div>
                                        </div>
                                    </div>
            			</div>
                            </div>
                        </div>
                    </td>
		</tr>
            </tbody>
        </table>
    </body>
</html>

