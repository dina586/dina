<?php 
	$cs=Yii::app()->clientScript;
    $cs->registerScriptFile(Yii::app()->baseUrl . '/js/index.js');
	
?>

<div class="body b-front_page">
    <div class="body-round"></div>
    <div class="body-wrapper">
		
        <div class="side-shadows"></div>
        <div class="content">
            <div class="container callout">

                <div class="twelve columns">
                    <h4 class="red-text">We are an authorized dealer for top brands</h4>
                    <!--<p class="subtitle">We offer <span>Lifetime Warranty</span> on all our installations.</p>-->
                </div>

                <div class="four columns button-wrap">
                    <div class="wrapper"><a href="<?=Yii::app()->createUrl('contacts');?>" class="medium-button"><span>GET A FREE QUOTE</span></a></div>
                </div>
            </div>
            <div class="callout-hr"></div>                        
            <div class="container">


                <div class="sixteen columns">         
                    <!-- carousel starts -->
                    <div class="slidewrap">
                        <?php
                            $this->widget('application.modules.offers.widgets.OffersWidget');
                        ?>                        
                    </div><!-- end of carousel -->                            

                    <div class="clear"></div>
                    <span class="hr"></span>

                    <div class="callout intext">

                        <div class="alpha twelve columns">
                                <div class="content">
                                   <h4 class="gray-text">Discounts on Car Audio & Tint!</h4>
                                </div>
                        </div>

                        <div class="omega four columns">
                           <div class="intext-button">
                                <a href="<?=Yii::app()->createUrl('/coupons');?>" class="big-button"><span>GET COUPONS</span></a>
                           </div>
                        </div>

                        <div class="clear"></div>
                    </div>

                </div>

                <div class="clients columns sixteen slidewrap2">
				<?php
                    $this->widget('application.modules.chance.widgets.ChanceWidget');
                ?>
				    <!--<div class="title-wrapper">
                        <div class="section-title">
                            <h4 class="title"><span class="red-text">Specials</span> <span class="gray-text">We Carry</span></h4>
                        </div>
                        <ul class="slidecontrols">
                            <li><a href="#clientSlider" class="next">Next</a></li>
                            <li><a href="#clientSlider" class="prev">Prev</a></li>
                        </ul>
                            <span class="divider"></span>
                        <div class="clear"></div>
                    </div>
                    <ul class="slider carousel" id="clientSlider">
                        <li class="slide">
                            <div class="client alpha">
                                <a href="#"><img src="images/Pioneer-logo.png" alt="Pioneer" title="Pioneer"/></a>
                            </div>
                            <div class="client beta">
                                <a href="#"><img src="images/kenwood-logo.png" alt="kenwood" title="kenwood"/></a>
                            </div>
                            <div class="client delta">
                                <a href="#"><img src="images/Sony-logo.png" alt="Sony" title="Sony"/></a>
                            </div>
                        </li>

                        <li class="slide">
                            <div class="client alpha">
                                <a href="#"><img src="images/JVC-logo.png" alt="JVC" title="JVC"/></a>
                            </div>
                            <div class="client beta">
                                <a href="#"><img src="images/Kicker-logo.png" alt="Kicker" title="Kicker"/></a>
                            </div>
                            <div class="client delta">
                                <a href="#"><img src="images/NVX.png" alt="NVX" title="NVX"/></a>
                            </div>
                        </li>

                        <li class="slide">
                            <div class="client alpha">
                                <a href="#"><img src="images/RockfordFosgate.png" alt="RockfordFosgate" title="RockfordFosgate"/></a>
                            </div>
                            <div class="client beta">
                                <a href="#"><img src="images/cervin-logo.png" alt="cervin" title="cervin"/></a>
                            </div>
                            <div class="client delta">
                                <a href="#"><img src="images/JL.png" alt="JL" title="JL"/></a>
                            </div>
                        </li>

                        <li class="slide">
                            <div class="client alpha">
                                <a href="#"><img src="images/Jbl-logo.jpg" alt="Jbl" title="Jbl"/></a>
                            </div>
                            <div class="client beta">
                                <a href="#"><img src="images/python-logo.png" alt="python" title="python"/></a>
                            </div>
                            <div class="client delta">
                                <a href="#"><img src="images/Avital-logo.png" alt="Avital" title="Avital"/></a>
                            </div>
                        </li>
                        
                        <li class="slide">
                            <div class="client alpha">
                                <a href="#"><img src="images/savv-logo.png" alt="savv" title="savv"/></a>
                            </div>
                            <div class="client beta">
                                <a href="#"><img src="images/iSimple.jpg"  alt="iSimple" title="iSimple"/></a>
                            </div>
                            <div class="client delta">
                                <a href="#"><img src="images/pac-logo.png" alt="pac" title="pac"/></a>
                            </div>                            
                        </li>
                        
                        <li class="slide">
                            <div class="client alpha">
                                <a href="#"><img src="images/Metra-logo.png" alt="Metra" title="Metra"/></a>
                            </div>
                            <div class="client beta">
                                <a href="#"><img src="images/BOYO.png" alt="BOYO" title="BOYO"/></a>
                            </div>
                            <div class="client delta">
                                <a href="#"><img src="images/SiriusXM-logo.png" alt="SiriusXM" title="SiriusXM"/></a>
                            </div>                            
                        </li>
                    </ul>-->

                </div>  
                <div class="clear"></div>
                <br/><br/><br/>
            </div>
        </div>
    </div>
</div>
