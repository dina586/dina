<!DOCTYPE html>
<!--[if IE 8]> <html class="no-js lt-ie9"> <![endif]-->
<!--[if IE 9]> <html class="no-js lt-ie10"> <![endif]-->
<!--[if gt IE 9]><!--> <html class="no-js"> <!--<![endif]-->
	<head>
		<meta charset="utf-8">


		<meta name="author" content="wemadefoxnever">
		<meta name="robots" content="noindex, nofollow">

		<meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1.0">

		<link rel="shortcut icon" href="<?= Yii::app()->theme->baseUrl ?>/img/favicon.png">
		<?=SeoHelper::getInstance()->renderMetaTags(); ?>
	</head>
	<body>

		<div id="page-wrapper">
			<!-- Preloader -->
			<div class="preloader themed-background">
				<h1 class="push-top-bottom text-light text-center"><strong>Pro</strong>UI</h1>
				<div class="inner">
					<h3 class="text-light visible-lt-ie9 visible-lt-ie10"><strong>Loading..</strong></h3>
					<div class="preloader-spinner hidden-lt-ie9 hidden-lt-ie10"></div>
				</div>
			</div>
			<!-- END Preloader -->

			<div id="page-container" class="header-fixed-top sidebar-partial sidebar-visible-lg">

				<!-- Main Sidebar -->
				<div id="sidebar">
					<!-- Wrapper for scrolling functionality -->
					<div id="sidebar-scroll">
						<!-- Sidebar Content -->
						<div class="sidebar-content">
							<!-- Brand -->
							<a href="<?= Yii::app()->createUrl('/site/index') ?>" class="sidebar-brand">
								<span class="sidebar-nav-mini-hide"><?= Settings::getVal('site_name') ?></span>
							</a>
							<!-- END Brand -->

							<!-- User Info -->
							<div class="sidebar-section sidebar-user clearfix sidebar-nav-mini-hide">
								<div class="sidebar-user-avatar">
									<a href="<?= Yii::app()->createUrl('/user/view/profile') ?>">
										<?=UserHelper::avatar(false, 'thumbnail');?>
									</a>
								</div>
								<div class="sidebar-user-name"><?= UserHelper::getName() ?></div>
								<div class="sidebar-user-links">
									<a href="<?= Yii::app()->createUrl('/user/view/profile') ?>" data-toggle="tooltip" data-placement="bottom" title="Profile"><i class="gi gi-user"></i></a>
									<a href="<?= Yii::app()->createUrl('/user/view/edit') ?>" class="enable-tooltip" data-placement="bottom" title="Settings"><i class="gi gi-cogwheel"></i></a>
									<a href="<?= Yii::app()->createUrl('/user/auth/logout') ?>" data-toggle="tooltip" data-placement="bottom" title="Logout"><i class="gi gi-exit"></i></a>
								</div>
							</div>
							<!-- END User Info -->
							<?php $this->renderPartial('//layouts/parts/_admin_menu') ?>
						</div>
						<!-- END Sidebar Content -->
					</div>
					<!-- END Wrapper for scrolling functionality -->
				</div>
				<!-- END Main Sidebar -->

				<!-- Main Container -->
				<div id="main-container">
					<!-- Header -->

					<header class="navbar navbar-default navbar-fixed-top">
						<!-- Left Header Navigation -->
						<ul class="nav navbar-nav-custom">
							<!-- Main Sidebar Toggle Button -->
							<li>
								<a href="javascript:void(0)" onclick="App.sidebar('toggle-sidebar');
                                        this.blur();">
									<i class="fa fa-bars fa-fw"></i>
								</a>
							</li>
							<!-- END Main Sidebar Toggle Button -->

						</ul>
						<!-- END Left Header Navigation -->

						<!-- Search Form -->
						<form action="page_ready_search_results.html" method="post" class="navbar-form-custom" role="search">
							<div class="form-group">
								<input type="text" id="top-search" name="top-search" class="form-control" placeholder="Search..">
							</div>
						</form>
						<!-- END Search Form -->

						<!-- Right Header Navigation -->
						<ul class="nav navbar-nav-custom pull-right">
							<!-- User Dropdown -->
							<li class="dropdown">
								<a href="javascript:void(0)" class="dropdown-toggle" data-toggle="dropdown">
									<?=UserHelper::avatar(false, 'thumbnail');?> <i class="fa fa-angle-down"></i>
								</a>
								<ul class="dropdown-menu dropdown-custom dropdown-menu-right">
									<li>
										<a href="<?= Yii::app()->createUrl('/user/view/profile') ?>">
											<i class="fa fa-user fa-fw pull-right"></i>
											Profile
										</a>
										<a href="#modal-user-settings" data-toggle="modal">
											<i class="fa fa-cog fa-fw pull-right"></i>
											Settings
										</a>
									</li>
									<li class="divider"></li>
									<li>
										<a href="<?= Yii::app()->createUrl('/user/auth/logout') ?>">
											<i class="fa fa-ban fa-fw pull-right"></i> 
											Logout
										</a>
									</li>
								</ul>
							</li>
							<!-- END User Dropdown -->
						</ul>
						<!-- END Right Header Navigation -->
					</header>
					<!-- END Header -->

					<!-- Page content -->
					<div id="page-content">
						<?php echo $content; ?>
					</div>
					<!-- END Page Content -->

					<!-- Footer -->
					<footer class="clearfix">
						<div class="pull-right">
							Powered by <a href="http://365-solutions.com/" target="_blank">365-solutions.com/</a>
						</div>
						<div class="pull-left">
							<?= date('Y'); ?>
							&copy; 
							<a href="<?= Yii::app()->createUrl('/site/index') ?>" target="_blank">
								<?= Settings::getVal('site_name') ?>
							</a>
						</div>
					</footer>
					<!-- END Footer -->
				</div>
				<!-- END Main Container -->
			</div>
			<!-- END Page Container -->
		</div>
		<!-- END Page Wrapper -->

		<!-- Scroll to top link, initialized in js/app.js - scrollToTop() -->
		<a href="#" id="to-top"><i class="fa fa-angle-double-up"></i></a>

		<?php
		$cs = Yii::app()->clientScript;
		$cs->registerPackage('admin_theme');
		$cs->registerScriptFile(Yii::app()->theme->baseUrl . '/js/vendor/bootstrap.min.js');
		$cs->registerScriptFile(Yii::app()->theme->baseUrl . '/js/plugins.js');
		$cs->registerScriptFile(Yii::app()->theme->baseUrl . '/js/app.js');
		$cs->registerScriptFile(Yii::app()->baseUrl . '/js/system.jquery.js');
		?>
	</body>
</html>
