<div class="comment-box">	
    <div id="yw0" class="list-view">
        <div class="items">
            <div class = "comment">
                <div class="comment-text">		
                    <article class = "g-styles">
                        
                        <?php   foreach ($dataProvider as $data)
                                {
                                    echo '<h2>'.$data->name .'</h2>';
                                    
                                    echo '<span>'.$data->create_date.'</span>';
                                    
                                    echo '<p>'.$data->content.'</p><br/>';
                                 }
                         ?>
                                
                    </article>
                </div>
            </div>
        </div>
    </div>
</div>
