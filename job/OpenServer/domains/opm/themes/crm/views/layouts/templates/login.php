<!DOCTYPE html>
<html lang="en" class="body-full-height">
    <head>        
        <!-- META SECTION -->
        <title>Atlant - Responsive Bootstrap Admin Template</title>            
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
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
        
        <div class="login-container">
        
            <div class="login-box animated fadeInDown">
                <div class="login-logo"></div>
                <div class="login-body">
                    <?php echo $content;?>
                </div>
                <div class="login-footer">
                    <div class="pull-left">
                        &copy; <?=date('Y')?> <?=Yii::app()->name;?>
                    </div>
                    <div class="pull-right">
                        <a href="#">About</a> |
                        <a href="#">Privacy</a> |
                        <a href="#">Contact Us</a>
                    </div>
                </div>
            </div>
            
        </div>
        
    </body>
</html>






