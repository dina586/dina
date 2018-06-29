<div id="main">
    <div class="container">
	<div class="l-base_wraper">
		
		<div class = "l-page_title_wrap">
			<h1 class = "l-page_title"><?=$this->pageTitle?></h1>
		</div>
        </div>
    </div>        
		<div class = "g-clear_fix"></div>
	
				<?php $this->widget('bootstrap.widgets.BsListView', array(
                                        'dataProvider'=>$dataProvider,
                                        'itemView'=>'_view',
                                )); ?>
				
			
		<div class = "g-clear_fix"></div>

	
</div>
