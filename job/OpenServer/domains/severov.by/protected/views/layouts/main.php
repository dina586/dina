<!DOCTYPE html>
<html lang="<?=Yii::app()->language;?>">
<head>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=1168" />
	<link rel="icon" type="image/vnd.microsoft.icon" href="/images/favicon.ico" />
	<link rel="SHORTCUT ICON" href="/images/favicon.ico" />
    <link href="http://fonts.googleapis.com/css?family=Roboto:400,300,300italic,100,400italic,700,500,900" rel="stylesheet" type="text/css" />
    <link href="http://fonts.googleapis.com/css?family=Nothing+You+Could+Do" rel="stylesheet" type="text/css" /> 
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
	
	<?php Yii::app()->getClientScript()->registerCoreScript('jquery');
	$cs=Yii::app()->clientScript;
	$cs->registerPackage('colorbox');
	
    $cs->registerScriptFile(Yii::app()->baseUrl . '/packages/bootstrap/js/bootstrap.min.js');
	$cs->registerScriptFile(Yii::app()->baseUrl . '/js/modules.js');
	$cs->registerScriptFile(Yii::app()->baseUrl . '/js/theme.js');
	$cs->registerScriptFile(Yii::app()->baseUrl . '/js/jquery.themepunch.plugins.min.js');
	$cs->registerScriptFile(Yii::app()->baseUrl . '/js/jquery.themepunch.revolution.min.js');
	$cs->registerScriptFile(Yii::app()->baseUrl . '/js/jquery.isotope.min.js');
	$cs->registerScriptFile(Yii::app()->baseUrl . '/js/sorting.js');
    $cs->registerScriptFile(Yii::app()->baseUrl . '/js/system.jquery.js');
	$cs->registerScriptFile(Yii::app()->baseUrl . '/js/main.jquery.js');
	
	$cs->registerCssFile(Yii::app()->baseUrl . '/packages/bootstrap/css/bootstrap.css');
    $cs->registerCssFile(Yii::app()->baseUrl . '/css/revslider.css');
    $cs->registerCssFile(Yii::app()->baseUrl . '/css/custom.css');
    $cs->registerCssFile(Yii::app()->baseUrl . '/css/theme.css');
	//$cs->registerCssFile(Yii::app()->baseUrl . '/css/main.css');
	$cs->registerCssFile(Yii::app()->baseUrl . '/css/admin.css');
	?>
	<!--[if lt IE 9]>
		<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->
	<?php Yii::app()->controller->widget('ext.seo.widgets.SeoHead',array(
	   	'defaultDescription'=>Settings::getVal('default_seo_description'),
	    'defaultKeywords'=>Settings::getVal('default_seo_keywords'),
	)); 
	if(Yii::app()->user->isGuest)
		Settings::getVal('google_analytics')
	?>
	   
	
</head>

<body>
<?php 
if(Yii::app()->user->checkAccess('admin'))
	$this->renderPartial('//layouts/parts/_admin_menu');
?>

<div class="main_header type1">
        <div class="tagline">
            <div class="container">
                <div class="fright">
                	<div class="tagline_items">
                       <!-- <div class="log_in_out"><a href="<?=Yii::app()->createUrl('user/login');?>"><i class="icon-sign-in"></i> Login</a></div>-->
                    </div>                  
                </div>
                <div class="fleft">
                    
                    <div class="email"><a href="mailto:#"><i class="icon-envelope"></i>severov-consult@mail.ru</a></div>
                </div>
				<div class ="pull-right">
					<div class="phone"><i class="icon-phone"></i>+375 29 121-50-00</div>
					<div class = "b-header_get_call">
						<a class="btn btn-primary j-show_call_dialog btn-sm" href="#">Заказать звонок</a>
					</div>
				</div>
                <div class="clear"></div>
            </div>
        </div>
        <div class="header_parent_wrap">
            <header>
                <div class="container">
                    <a class="top_menu_toggler" href="javascript:void(0)"></a>
                	<div class="logo_sect">
                        <a href="/" class="logo"><p>Денис Северов<br />
						<span class="span-logo2">Психологическая помощь в Минске</span></p></a>     
						          
                    </div> 
                    <nav>
						
						<?php //$this->widget('application.components.MenuSite');?>
						
                        <ul class="menu">
                            <li class="current-menu-parent menu-item-has-children"><a href="/">Главная</a></li>
                            <li class="menu-item-has-children"><a href="<?=Helper::getPageLink(2);?>">Обо мне</a></li>
                            <li class="menu-item-has-children"><a href="<?=Yii::app()->createUrl('/services');?>">Услуги</a>
								<div class="sub-nav">
                                    <ul class="sub-menu">
                                         <?php $this->widget('application.widget.SiteMenuWidget', array('modelName'=>'Service'));?>                
                                    </ul> 
                                </div>	
                            </li>
                            <li class="menu-item-has-children"><a href="<?=Yii::app()->createUrl('/blogs');?>">Блог</a></li>
                            <li class="menu-item-has-children"><a href="<?=Yii::app()->createUrl('/technics');?>">Техники</a>
								<div class="sub-nav">
                                    <ul class="sub-menu">
                                         <?php $this->widget('application.widget.SiteMenuWidget', array('modelName'=>'Technics'));?>                     
                                    </ul> 
                                </div>	
                            </li>
                            <li class="menu-item-has-children"><a href="<?=Yii::app()->createUrl('/contacts');?>">Контакты</a></li>
                            <!--<li class="menu-item-has-children"><a href="<?=Yii::app()->createUrl('/article');?>">Статьи</a></li>-->
                            <li class="menu-item-has-children"><a href="<?=Yii::app()->createUrl('/opinion');?>">Отзывы</a></li>
                        </ul>
                    </nav>                   
                    <div class="clear"></div>
                </div>
            </header>
        </div>
    </div>
    
    <?php echo $content; ?>
            
    <div class="clear"></div>
    <div class="footer">
    	<div class="container">
        	<div class="pre_footer">
            	<div class="row">
                	<div class="col-sm-4">
                    	<div class="sidepanel widget_text">
                        	<h4 class="title">Контакты</h4>
                            <p><span>Телефон:</span> +375 29 121-50-00</p>
                            <p><span>Адрес:</span> г.Минск, ул. Максима Танка 20, Центр "Вдохновение"</p>
                            <p><span>Email:</span> <a href="mailto:#">severov-consult@mail.ru</a></p>
                        </div>	
                    </div>
                    <div class="col-sm-4">
                    	<div class="sidepanel widget_posts">
                        	<h4 class="title">Блоги</h4>
                            <ul class="recent_posts">
                                <?php $this->widget('application.modules.blog.widgets.BlogWidget'); ?>                     
                            </ul>
                        </div>
                    </div>
                    <div class="col-sm-4">
                    	<div class="sidepanel widget_review">
                        	<h4 class="title">Последний отзыв</h4>
                            <div class="last_review">
                            	<p class="review_text">За всю жизнь я обращалась к психологам два раза. От общения с Денисом  Анатольевичем остаются только самые положительные впечатления и чувства. Он помог донести моему сознанию вполне обыденные, но необходимые вещи, которые, долгое время я не могла решить сама. Я очень благодарна Вам за терпение и тот индивидуальные метод решения моих жизненных проблем.</p>
                                <div class="clear"></div>
                                <div class="last_review_author">
                                	<h5>Денис Северов</h5>
                                    <h6>Психологические консультации</h6>
                                    <img src="/img/imgs/review_author12.jpg" alt="" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="footer_bottom">
            	<div class="copyright">Copyright © 2004-<?=date('Y');?>. Компания SeverovGroup.</div>
                <div class="clear"></div>
            </div>
        </div>
    </div>   
    
    <div class="fixed-menu"></div>
    <?php 
		$this->widget('application.widgets.CallFormWidget');
	?>
    <script type="text/javascript">
		jQuery(document).ready(function() {
		   "use strict";			   						
		   jQuery('.fullscreen_slider').show().revolution({
				delay: 5000,
				startwidth: 1170,
				startheight: 510,
				fullWidth:"off",
				fullScreen:"off",
				navigationType:"bullet",
				fullScreenOffsetContainer: ".main_header",
				fullScreenOffset: ""
			});							
		});
	</script> 
    
    <!-- Portfolio -->
    <script>	
		items_set = [                    
			{src : '/img/portfolio/370_300/10.jpg', zoom : '/img/portfolio/370_300/10.jpg', url : 'portfolio_post_fullwidth.html', columnclass: 'col-sm-4', sortcategory: 'webui', title: 'Unde Sed ut', itemcategory: 'Print Design'},
			{src : '/img/portfolio/370_300/11.jpg', zoom : '/img/portfolio/370_300/11.jpg', url : 'portfolio_post_fullwidth.html', columnclass: 'col-sm-4', sortcategory: 'polygraphy', title: 'Tempore Nam Libero', itemcategory: 'Business'},
			{src : '/img/portfolio/370_300/12.jpg', zoom : '/img/portfolio/370_300/12.jpg', url : 'portfolio_post_fullwidth.html', columnclass: 'col-sm-4', sortcategory: 'textstyle', title: 'Dolores Magni', itemcategory: 'People'}
		];
		jQuery('#list').portfolio_addon({
			type : 2, // 2-4 columns portfolio
			load_count : 3,
			items : items_set
		});
	</script> 
	
	<!-- Google Tag Manager -->
	<noscript><iframe src="//www.googletagmanager.com/ns.html?id=GTM-559NNL"
	height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
	<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
	new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
	j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
	'//www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
	})(window,document,'script','dataLayer','GTM-559NNL');</script>
</body>
</html>
