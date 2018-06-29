<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<!--[if lt IE 7 ]><html class="ie ie6" lang="en"> <![endif]-->
<!--[if IE 7 ]><html class="ie ie7" lang="en"> <![endif]-->
<!--[if IE 8 ]><html class="ie ie8" lang="en"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!--><html lang="en"> <!--<![endif]-->
<head>

<meta charset="utf-8" />

<meta name="description" content="">
<meta name="author" content="">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
<link rel="icon"  href="/images/favicon.ico">
<link rel="SHORTCUT ICON" href="/images/favicon.ico">
<!--<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&amp;sensor=false"></script>
<script src="https://maps.googleapis.com/maps-api-v3/api/js/22/2/intl/ru_ALL/main.js"></script>-->
<!--[if (IE 6)|(IE 7)]>
    <link rel="stylesheet" href="css/ie.css" type="text/css" media="screen" />
<![endif]-->
<!--[if lt IE 9]>
    <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->
<?php 
//Yii::app()->getClientScript()->registerCoreScript('jquery');
	$cs=Yii::app()->clientScript;
	$cs->registerPackage('colorbox');
        
	$cs->registerCssFile(Yii::app()->baseUrl . '/css/base.css');
	$cs->registerCssFile(Yii::app()->baseUrl . '/css/skeleton.css');     
	$cs->registerCssFile(Yii::app()->baseUrl . '/css/layout.css');    
 	$cs->registerCssFile(Yii::app()->baseUrl . '/css/child.css');       
	$cs->registerCssFile(Yii::app()->baseUrl . '/css/animate.min.css');
	$cs->registerCssFile(Yii::app()->baseUrl . '/css/jquery.onebyone.css');
 	$cs->registerCssFile(Yii::app()->baseUrl . '/css/prettyPhoto.css');      
        
        
	$cs->registerScriptFile(Yii::app()->baseUrl . '/js/jquery-1-8-2.js');  
    $cs->registerScriptFile(Yii::app()->baseUrl . '/js/main.js');
	$cs->registerScriptFile(Yii::app()->baseUrl . '/js/jquery.easing.1.3.js');
	$cs->registerScriptFile(Yii::app()->baseUrl . '/js/jquery.carousel.js');   
	$cs->registerScriptFile(Yii::app()->baseUrl . '/js/jquery.color.animation.js');
	$cs->registerScriptFile(Yii::app()->baseUrl . '/js/jquery.prettyPhoto.js');   
	$cs->registerScriptFile(Yii::app()->baseUrl . '/js/default.js');
	$cs->registerScriptFile(Yii::app()->baseUrl . '/js/jquery.onebyone.min.js');   
	$cs->registerScriptFile(Yii::app()->baseUrl . '/js/jquery.touchwipe.min.js');
	$cs->registerScriptFile(Yii::app()->baseUrl . '/js/jquery.mobile.customized.min.js');
        
    /*    $cs->registerScriptFile(Yii::app()->baseUrl . '/packages/bootstrap/js/bootstrap.min.js');
	$cs->registerCssFile(Yii::app()->baseUrl . '/packages/bootstrap/css/bootstrap.css');*/
        
	?>
	<?=SeoHelper::getInstance()->renderMetaTags() ?>

</head>

<body>
	
    <div class="page-wrapper">  
	<?php 
		if(Yii::app()->user->checkAccess('admin')):
	?>
		<div class = "b-admin_menu">
			   <nav class="navbar navbar-static-top navbar-default" role="navigation">
				   <div class="container"> 
						<?php 

						if(Yii::app()->user->checkAccess('admin'))
							 $this->renderPartial('//layouts/parts/_admin_menu');
						 ?>
						<div class="sidebar-nav-exit">
							<a href="<?= Yii::app()->createUrl('/user/auth/logout') ?>">Exit</a>
						</div>      
						
					</div>
			   </nav>
		</div>
		<?php endif;?>
        <div class="header-contact">
               <div class="container">
                   <div class="column">
                       <a href="/"><img src="/images/logo.png" alt="logo" title="logo"/>
                            <span>Car Audio, Navigation, Car Alarms & Window Tint</span>
                       </a>
                   </div>
                     <div class="columns">
                        <span>(714) 288-8882</span><br/>
                        810 West Katella Ave.<br/>
                                Orange, CA 92867
                        <br/>
                        <a href="http://www.yelp.com/biz/mj-car-stereo-orange" target="_blank"><img src="/images/icons/yelp_icon.png" alt="Yelp" title="yelp_button"/></a>
                        <a href="http://plus.google.com/105634301423334095387" target="_blank"><img src="/images/icons/google_icon.png" alt="google" title="Google+"/></a>                        
                        <a href="https://facebook.com/452143571536614" target="_blank"><img src="/images/icons/facebook_icon.png" alt="Facebook" title="facebook"/></a>   
						<a href="http://www.linkedin.com" target="_blank"><img src="/images/icons/linekdin_icon.png" alt="LinkedIn" title="LinkedIn"/></a>
						<a href="https://twitter.com" target="_blank"><img src="/images/icons/twitter_icon.png" alt="Twitter" title="Twitter"/></a>
                     </div>
               
                </div>
        </div>
        <div class="clear"></div>
        <div class="slug-pattern slider-expand">
            <div class="background-image" id="1"></div>
            <div class="overlay">
                <div class="slug-cut"></div>
            </div>                
        </div>     
        <div class="header slider-expand">
			<div class="container">
				<div class="nav">    
					<div class="container">
					
						<!-- Standard Nav (x >= 768px) -->
						<div class="standard">   
							<div class="eleven column omega tabwrapper">
								<div class="menu-wrapper">
									<ul class="tabs menu">
										<li>
										   <a href="/"><span>Home</span></a>                                        
										</li>
										<li><a href="<?=Helper::getPageLink(3);?>">About Us</a></li>
										<li><a href="<?=Yii::app()->createUrl('/product');?>">Products</a></li>
										<li><a href="<?=Yii::app()->createUrl('/gallery');?>">Gallery</a></li>
										<li><a href="<?=Yii::app()->createUrl('/coupons');?>">Coupons</a></li>
										<li><a href="<?=Helper::getPageLink(4);?>">Financing</a></li>
										<li><a href="<?=Yii::app()->createUrl('contacts');?>">Contact Us</a></li>
									</ul>
							  </div>
							</div>
						</div>
						<!-- Standard Nav Ends, Start of Mini -->
						
						<div class="mini">
							<div class="twelve column alpha omega mini">
								<div class="logo">
									<a href="/"><img src="/images/mini-logo.png" alt="mini-logo" title="mini-logo"/></a><!-- Small Logo -->
								</div>
							</div>
							
							<div class="twelve column alpha omega navagation-wrapper">
								<select class="navagation">
									<option value="" selected="selected">Site Navagation</option>
								</select>
							</div>
						</div>
						<!-- Start of Mini Ends -->
					</div> 
					
				</div>
				
				<div class="shadow"></div>
			</div>
		</div>
        
		<div class="slug">
			<div class="container">
				<div class="onebyone-wrapper">
					<div class="preload">
						<center><img src="images/design/preloader.gif" /></center>
					</div>
					<div class="outer">

						<div class="onebyone hide" id="onebyone">

							<div id="slide-01" class="oneByOne_item">
								<div id="right">
									<h1>NO CREDIT CHECK FINANCING!</h1>
									<h2>HUGE DISCOUNTS ON ALL CAR AUDIO SALES & INSTALLATION.</h2>
									<h3>Welcome to MJ Car Stereo in Orange, California! If you are looking for a car audio system, affordable prices on In Dash Navigations, subwoofers, speakers, amplifiers, or a low cost car stereo installation or window tint, you've come to the right place! We value all our customers and want to provide you with a great experience here at MJ Car Stereo. Stop by today!</h3>
								</div>
								<img src="images/_PNG__car-stereo.png" class="img2" />
								<img src="images/car-stereos.png" class="img1" />
								<img src="images/Picture1.png" class="img3" />

							</div>

							<div id="slide-02" class="oneByOne_item">
								<div id="right">                                        
									<h1>WE HAVE THE SOLUTION!</h1>
									<h2>The World's Most Innovative Bluetooth Upgrade! Call today for more information. 714-288-8882.</h2>
									<h3>Features:
										<ul>
											<li>Wireless connection with Smartphones via special Bluetooth technology with automatic re-connection.</li>
											<li>Read and display entire library from most smart devices on car display.</li>
											<li>Access and control play. stop. next and previous song via multi-functional steering wheel.</li>
											<li>You can still keep connected with the original or aftermarket Bluetooth hands-free device.</li>
											<li>Compatible with most High End Cars.</li>
										</ul> 
									</h3>
								</div>
								<span>BLUETOOTH STREAMING TO YOUR FACTORY RADIO</span>
								<img src="images/Bluetooth-Streaming.png" class="img1" />                                    
							</div>

							 <div id="slide-03" class="oneByOne_item">
								<div id="right">                                        
									<h1>WE HAVE THE SOLUTION!</h1>
									<h2>The World's Most Innovative Bluetooth Upgrade! Call today for more information. 714-288-8882.</h2>
									<h3>Features:
										<ul>
											<li>Wireless connection with Smartphones via special Bluetooth technology with automatic re-connection.</li>
											<li>Read and display entire library from most smart devices on car display.</li>
											<li>Access and control play. stop. next and previous song via multi-functional steering wheel.</li>
											<li>You can still keep connected with the original or aftermarket Bluetooth hands-free device.</li>
											<li>Compatible with most High End Cars.</li>
										</ul> 
									</h3>
								</div>
								<span>CUSTOM INSTALLATION</span>
								<img src="images/_PNG__20113390.png" class="img2" />
								<img src="images/_PNG__audiophile_av_system.png" class="img1" />
								<img src="images/_PNG__caraudio.png" class="img3" />                                    
							</div>
							
							<div id="slide-04" class="oneByOne_item">
								<div id="right">
									<h1>APPLE CARPLAY&reg;</h1>
									<h2>FOR THE VEHICLE YOU ALREADY OWN</h2>
									<h3>MJ Car Stereo in Orange, CA is happy to announce to you the Apple's CarPlay&reg;. It is a great smartphone integration aftermarket in-dash car multimedia systems to provide Apple CarPlay&reg;, allowing consumers the ability to upgrade the vehicle they already own to the smarter, safer and more fun way to use iPhone&reg; in the car. Call us today (714) 288-8882 and make an appointment for your Apple CarPlay&reg; installation at MJ Car Stereo.</h3>
								</div>
								<img src="images/_PNG__apple-car-play2.png" class="img2" />
								<img src="images/carplay_icon.png" class="img1" />
								<img src="images/Google-car-play-101.jpg" class="img3" />

							</div>

						</div>
					</div>
				</div>
			</div>
		</div>
		
		
        <?=$content?>

        <div class="footer style-2">
	            <div class="background"><div class="stitch"></div></div>
            <div class="content">
                <div class="patch"></div>
                <div class="blur"></div>
                <div class="pattern">
                    <div class="container">
                            <div class="stitch"></div>
                        <div class="sixteen columns">
                            <div class="first column alpha">

                                <div class="left">                                       
                                    <?php $this->widget('application.modules.block.components.GetBlocks', array('view' => 'footerblock')); ?>
                                </div>
                            </div>
                            <div class="column ct">
                                <h5>We Accept</h5>
                                <img src="/images/InstallerNetLogo.gif" alt="InstallerNetLogo" title="InstallerNetLogo"/>
                            </div>
                            <div class="last column omega">
                                <h5>Our Address</h5>
                                <p>810 West Katella Ave. <br/>Orange, CA 92867 <br/>(714) 288-8882</p>

                                <div class="right">
                                    <a href="<?=Yii::app()->createUrl('contacts');?>" class="button color"><span>CONTACT US</span></a>
                                </div>
                                <div class="clear"></div>

                                <h5>Stay in Touch</h5>
                                <div class="social">                                                            
                                    <a href="http://www.yelp.com/biz/mj-car-stereo-orange" target="_blank"><img src="/images/icons/yelp_icon.png" alt="Yelp" title="yelp_button"/></a>
									<a href="http://plus.google.com/105634301423334095387" target="_blank"><img src="/images/icons/google_icon.png" alt="google" title="Google+"/></a>                        
									<a href="https://facebook.com/452143571536614" target="_blank"><img src="/images/icons/facebook_icon.png" alt="Facebook" title="facebook"/></a>   
									<a href="http://www.linkedin.com" target="_blank"><img src="/images/icons/linekdin_icon.png" alt="LinkedIn" title="LinkedIn"/></a>
									<a href="https://twitter.com" target="_blank"><img src="/images/icons/twitter_icon.png" alt="Twitter" title="Twitter"/></a>
                                </div> 
                            </div>
                        </div>
                        <div class="clear"></div>
                    </div>
                    <div class="sixteen columns alpha omega">
                            <div class="foot-nav-bg"></div>
                        <div class="foot-nav">
                            <div class="copy">&copy; 2015 MJ Car Stereo</div>
                            <div class="powered">Powered by: 365-Solutions.com</div>
                            <div class="nav">
                                <a href="<?=Yii::app()->createUrl('page/view/admin');?>">Login</a>
                                <a href="<?=Yii::app()->createUrl('/gallery');?>">Gallery</a>
                                <a href="#">Privacy</a>
                                <a href="#">Policy</a>
                                <a href="<?=Yii::app()->createUrl('contacts');?>">Contact Us</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
     </div>
</body>

</html>