<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	
	<?php
		Yii::app()->getClientScript()->registerCoreScript('jquery' );
		Yii::app()->getClientScript()->registerCoreScript('jquery.ui');
		$cs = Yii::app ()->clientScript;
		$cs->registerCssFile(Yii::app()->baseUrl.'/themes/'.Yii::app()->theme->name.'/css/theme-default.css');
		$cs->registerScriptFile(Yii::app()->baseUrl . '/js/system.jquery.js');
	?>
	<!--[if lt IE 9]>
		<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->
	<?php
	Yii::app ()->controller->widget ( 'ext.seo.widgets.SeoHead', 
		array (
			'defaultDescription' => Settings::getVal ( 'default_seo_description' ),
			'defaultKeywords' => Settings::getVal ( 'default_seo_keywords' ) 
	));
	?>
	
</head>
<body>
	<!-- START PAGE CONTAINER -->
	<div class="page-container page-navigation-top-fixed">

		<!-- START PAGE SIDEBAR -->
		<div class="page-sidebar mCustomScrollbar _mCS_1 mCS-autoHide page-sidebar-fixed scroll">
			
			<!-- START X-NAVIGATION -->
			<ul class="x-navigation">
				<li class="xn-logo">
					<a href="<?=Yii::app()->createUrl('site/front')?>">OPM</a> 
					<a href="#"class="x-navigation-control"></a>
				</li>
				<li class="xn-profile">
					<a href="#" class="profile-mini"> 
						<img src="/images/logo.png" alt="John Doe" />
					</a>
					<div class="profile g-logo">
						<div class="profile-image">
							<a href = "<?=Yii::app()->createUrl('site/index')?>">
								<img src="/images/logo.png" alt="OPM" />
							</a>
						</div>
						<div class="profile-data">
							<div class="profile-data-name">
								<a href = "<?=Yii::app()->createUrl('site/index')?>"><?=Yii::app()->name?></a>
							</div>
						</div>

					</div>
				</li>
				<li class="xn-title">Navigation</li>
				<li class="xn-openable">
					<a href = "<?=Yii::app()->createUrl('/user/admin/admin')?>">
						<?=BsHtml::icon(BsHtml::GLYPHICON_USER);?>
						<span class="xn-text">Clients List</span>
					</a>
					<ul>
						<li>
							<a href="<?=Yii::app()->createUrl('user/admin/create')?>">
								<span class="fa fa-plus-circle"></span>
								Add new Client
							</a>
						</li>
						<li>
							<a href="<?=Yii::app()->createUrl('user/admin/admin')?>">
								<span class="fa fa-users"></span>
								View Clients
							</a>
						</li>
						<li>
							<a href="<?=Yii::app()->createUrl('user/admin/list')?>">
								<span class="fa fa-gears"></span>
								Clients List
							</a>
						</li>
						<?php if(Yii::app()->user->checkAccess('developer')):?>
						<li>
							<a href="<?=Yii::app()->createUrl('user/regType/admin')?>">
								<span class="fa fa-gears"></span>
								User registration type
							</a>
						</li>
						<li>
							<a href="<?=Yii::app()->createUrl('user/group/admin')?>">
								<span class="fa fa-gears"></span>
								User group
							</a>
						</li>
						<?php endif;?>
					</ul>
				</li>
				<li class="xn-openable">
					<a href = "<?=Yii::app()->createUrl('/service/view/admin')?>">
						<span class="fa fa-book"></span> 
						<span class="xn-text">Manage services</span>
					</a>
					<ul>
						<li>
							<a href="<?=Yii::app()->createUrl('service/view/create')?>">
								<span class="fa fa-plus-circle"></span>
								Add new Service
							</a>
						</li>
						<li>
							<a href="<?=Yii::app()->createUrl('service/view/admin')?>">
								<span class="fa fa-gears"></span>
								Manage Services
							</a>
						</li>
						<li>
							<a href="<?=Yii::app()->createUrl('service/procedure/create')?>">
								<span class="fa fa-plus"></span>
								Add new procedure
							</a>
						</li>
						<li>
							<a href="<?=Yii::app()->createUrl('service/procedure/admin')?>">
								<span class="fa fa-gear"></span>
								Manage Procedures
							</a>
						</li>
					</ul>
				</li>
				<li class="xn-openable">
					<a href = "<?=Yii::app()->createUrl('/video/view/admin')?>">
						<span class="fa fa-book"></span> 
						<span class="xn-text">Video</span>
					</a>
					<ul>
						<li>
							<a href="<?=Yii::app()->createUrl('video/view/create')?>">
								<span class="fa fa-plus-circle"></span>
								Add new Video
							</a>
						</li>
						<li>
							<a href="<?=Yii::app()->createUrl('video/view/admin')?>">
								<span class="fa fa-gears"></span>
								Manage Video
							</a>
						</li>
					</ul>
				</li>
				
				<li class="xn-openable">
					<a href = "<?=Yii::app()->createUrl('/store/product/admin')?>">
						<span class="fa fa-leaf"></span>
						<span class="xn-text">Products</span>
					</a>
					<ul>
						<li>
							<a href="<?=Yii::app()->createUrl('store/product/create')?>">
								<span class="fa fa-plus-circle"></span>
								Add new Product
							</a>
						</li>
						<li>
							<a href="<?=Yii::app()->createUrl('store/product/admin')?>">
								<span class="fa fa-gears"></span>
								Manage Products
							</a>
						</li>
						<li>
							<a href="<?=Yii::app()->createUrl('store/catalog/create')?>">
								<span class="fa fa-plus"></span>
								Add new Catalog
							</a>
						</li>
						<li>
							<a href="<?=Yii::app()->createUrl('store/catalog/admin')?>">
								<span class="fa fa-gear"></span>
								Manage Catalogs
							</a>
						</li>
						<li>
							<a href="<?=Yii::app()->createUrl('store/delivery/create')?>">
								<span class="fa fa-plus"></span>
								Add new Delivery
							</a>
						</li>
						<li>
							<a href="<?=Yii::app()->createUrl('store/delivery/admin')?>">
								<span class="fa fa-gear"></span>
								Manage Delivery
							</a>
						</li>
					</ul>
				</li>
				<li>
					<a href = "<?=Yii::app()->createUrl('/store/history/admin')?>">
						<span class="fa fa-shopping-cart"></span>
						<span class="xn-text">Purchase history</span>
					</a>
				</li>
				<li class="xn-openable">
					<a href = "<?=Yii::app()->createUrl('/invoice/view/admin')?>">
					<?=BsHtml::icon(BsHtml::GLYPHICON_CERTIFICATE);?> 
					<span class="xn-text">Billing</span></a>
					<ul>
						<li>
							<a href="<?=Yii::app()->createUrl('invoice/view/create')?>">
								<span class="fa fa-plus-circle"></span>
								Create Invoice
							</a>
						</li>
						<li>
							<a href="<?=Yii::app()->createUrl('invoice/view/admin')?>">
								<span class="fa fa-gears"></span>
								Billing
							</a>
						</li>
					</ul>	
				</li>
				<li><a href = "<?=Yii::app()->createUrl('/helper/settings/admin')?>"><?=BsHtml::icon(BsHtml::GLYPHICON_COG);?><span class="xn-text">Settings</span></a></li>
				
				<li class="xn-openable">
					<a href = "<?=Yii::app()->createUrl('/calendar/view/index')?>">
						<span class="fa fa-calendar"></span>
						<span class="xn-text">Calendar</span>
					</a>
					<ul>
						<li>
							<a href="<?=Yii::app()->createUrl('/calendar/view/index')?>">
								<span class = "glyphicon glyphicon-certificate"></span>
								View Calendar
							</a>
						</li>
						<li>
							<a href="<?=Yii::app()->createUrl('calendar/view/create')?>">
								<span class="fa fa-plus-circle"></span>
								Add new Event
							</a>
						</li>
						<li>
							<a href="<?=Yii::app()->createUrl('calendar/view/admin')?>">
								<span class="fa fa-gears"></span>
								Manage Events
							</a>
						</li>
						<li>
							<a href="<?=Yii::app()->createUrl('calendar/worker/create')?>">
								<span class="fa fa-plus-circle"></span>
								Add new Employee
							</a>
						</li>
						<li>
							<a href="<?=Yii::app()->createUrl('calendar/worker/admin')?>">
								<span class="fa fa-gears"></span>
								Manage Employees
							</a>
						</li>
					</ul>	
				</li>
			</ul>
			<!-- END X-NAVIGATION -->
		</div>
		<!-- END PAGE SIDEBAR -->

		<!-- PAGE CONTENT -->
		<div class="page-content">

			<!-- START X-NAVIGATION VERTICAL -->
			<ul class="x-navigation x-navigation-horizontal x-navigation-panel">
				<!-- TOGGLE NAVIGATION -->
				<li class="xn-icon-button">
					<a href="#" class="x-navigation-minimize">
						<span class="fa fa-dedent"></span>
					</a>
				</li>
	
				<!-- END TOGGLE NAVIGATION -->

				<!-- SIGN OUT -->
				<li class="xn-icon-button pull-right">
					<a href="#" class="mb-control" data-box="#mb-signout"><span class="fa fa-sign-out"></span></a>
				</li>
				<!-- END SIGN OUT -->
			</ul>
			<!-- END X-NAVIGATION VERTICAL -->

			<!-- START BREADCRUMB -->
			<?php	
				$this->widget('bootstrap.widgets.BsBreadcrumb', 
				array(
					'links'=>CRM::getBreadcrumbs(),
					'homeLink'=>false,
					'encodeLabel'=>false,
			));?>
			
			<!-- END BREADCRUMB -->

			<!-- PAGE CONTENT WRAPPER -->
			<div class="page-content-wrap">
				
				<div class="page-title">                    
					<h2><span class="fa fa-folder"></span> <?=$this->pageTitle?></h2>
				</div>
			
				<?=$content;?>

			</div>
			<!-- END PAGE CONTENT WRAPPER -->
		</div>
		<!-- END PAGE CONTENT -->
	</div>
	<!-- END PAGE CONTAINER -->

	<!-- MESSAGE BOX-->
	<div class="message-box animated fadeIn" data-sound="alert"
		id="mb-signout">
		<div class="mb-container">
			<div class="mb-middle">
				<div class="mb-title">
					<span class="fa fa-sign-out"></span> Log <strong>Out</strong> ?
				</div>
				<div class="mb-content">
					<p>Are you sure you want to log out?</p>
					<p>Press No if youwant to continue work. Press Yes to logout
						current user.</p>
				</div>
				<div class="mb-footer">
					<div class="pull-right">
						<a href="<?=Yii::app()->createUrl('user/logout')?>" class="btn btn-success btn-lg">Yes</a>
						<button class="btn btn-default btn-lg mb-control-close">No</button>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- END MESSAGE BOX-->


	<!-- START SCRIPTS -->
	<!-- START PLUGINS -->
	<script type="text/javascript" src="/themes/crm/js/plugins/bootstrap/bootstrap.min.js"></script>
	<!-- END PLUGINS -->

	<!-- START THIS PAGE PLUGINS-->
	<script type='text/javascript' src='/themes/crm/js/plugins/icheck/icheck.min.js'></script>
	<script type="text/javascript"
		src="/themes/crm/js/plugins/mcustomscrollbar/jquery.mCustomScrollbar.min.js"></script>
	<script type="text/javascript" src="/themes/crm/js/plugins/scrolltotop/scrolltopcontrol.js"></script>
	<!-- 
	<script type="text/javascript" src="/themes/crm/js/plugins/morris/raphael-min.js"></script>
	<script type="text/javascript" src="/themes/crm/js/plugins/morris/morris.min.js"></script>
	<script type="text/javascript" src="/themes/crm/js/plugins/rickshaw/d3.v3.js"></script>
	<script type="text/javascript" src="/themes/crm/js/plugins/rickshaw/rickshaw.min.js"></script>
	<script type='text/javascript' src='/themes/crm/js/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js'></script>
	<script type='text/javascript' src='/themes/crm/js/plugins/jvectormap/jquery-jvectormap-world-mill-en.js'></script>
	<script type='text/javascript' src='/themes/crm/js/plugins/bootstrap/bootstrap-datepicker.js'></script>
	<script type="text/javascript" src="/themes/crm/js/plugins/owl/owl.carousel.min.js"></script>
	 -->
	<!-- END THIS PAGE PLUGINS-->

	<!-- START TEMPLATE -->

	<script type="text/javascript" src="/themes/crm/js/plugins.js"></script>
	<script type="text/javascript" src="/themes/crm/js/actions.js"></script>
	<script type="text/javascript" src=//userlike-cdn-widgets.s3-eu-west-1.amazonaws.com/8d5c38cfcf5e0490ebd90c46b29468b36f09a254bbe16372dad269664eb5329d.js></script>
	
	<!-- END TEMPLATE -->
	<!-- END SCRIPTS -->
</body>
</html>






