<div class="g-content">
    <div class="l-base_wraper b-portfolio">

		<div class = "l-page_title_wrap">
			<h1 class = "l-page_title"><?=$this->titles(); ?></h1>
		</div>

		<div class = "g-clear_fix"></div>

		<div class = "content-section clearfix">
			<div class = "content-inner-left">
				<?php
				$this->widget('bootstrap.widgets.BsListView', array(
					'dataProvider' => $dataProvider,
					'itemView' => '_view',
				));
				?>
			</div>

			<aside class = "sidebar">
				<h4 class="widget-title">Теги</h4>
				<div class = "widget widget_categories">

					<?php
						$this->widget('TagCloud', array(
							'maxTags' => 30,
							'portfolio_type'=>$type,
						));
					?>

				</div>
			</aside>
		</div>
    </div>
</div>
<div class = "g-clear_fix"></div>