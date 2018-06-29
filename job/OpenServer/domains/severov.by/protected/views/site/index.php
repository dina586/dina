<?php $this->seo($model->seo_title, $model->seo_keywords, $model->seo_description, $model->name); ?>
<script>

    /*
     
     HW Slider - простой слайдер на jQuery. 
     
     Настройки скрипта:
     
     hwSlideSpeed - Скорость анимации перехода слайда.
     hwTimeOut - время до автоматического перелистывания слайдов.
     hwNeedLinks - включает или отключает показ ссылок "следующий - предыдущий". Значения true или false
     
     */
    (function ($) {
        var hwSlideSpeed = 700;
        var hwTimeOut = 3000;
        var hwNeedLinks = true;

        $(document).ready(function (e) {
            $('.slide').css(
                    {"position": "absolute",
                        "top": '0', "left": '0'}).hide().eq(0).show();
            var slideNum = 0;
            var slideTime;
            slideCount = $("#slider .slide").size();
            var animSlide = function (arrow) {
                clearTimeout(slideTime);
                $('.slide').eq(slideNum).fadeOut(hwSlideSpeed);
                if (arrow == "next") {
                    if (slideNum == (slideCount - 1)) {
                        slideNum = 0;
                    }
                    else {
                        slideNum++
                    }
                }
                else if (arrow == "prew")
                {
                    if (slideNum == 0) {
                        slideNum = slideCount - 1;
                    }
                    else {
                        slideNum -= 1
                    }
                }
                else {
                    slideNum = arrow;
                }
                $('.slide').eq(slideNum).fadeIn(hwSlideSpeed, rotator);
                $(".control-slide.active").removeClass("active");
                $('.control-slide').eq(slideNum).addClass('active');
            }
            if (hwNeedLinks) {
                var $linkArrow = $('<a id="prewbutton" href="#">&lt;</a><a id="nextbutton" href="#">&gt;</a>')
                        .prependTo('#slider');
                $('#nextbutton').click(function () {
                    animSlide("next");
                    return false;
                })
                $('#prewbutton').click(function () {
                    animSlide("prew");
                    return false;
                })
            }
            var $adderSpan = '';
            //$('.slide').each(function(index) {
            //	$adderSpan += '<span class = "control-slide">' + index + '</span>';
            //	});
            //$('<div class ="sli-links">' + $adderSpan +'</div>').appendTo('#slider-wrap');
            $(".control-slide:first").addClass("active");
            $('.control-slide').click(function () {
                var goToNum = parseFloat($(this).text());
                animSlide(goToNum);
            });
            var pause = false;
            var rotator = function () {
                if (!pause) {
                    slideTime = setTimeout(function () {
                        animSlide('next')
                    }, hwTimeOut);
                }
            }
            $('#slider-wrap').hover(
                    function () {
                        clearTimeout(slideTime);
                        pause = true;
                    },
                    function () {
                        pause = false;
                        rotator();
                    });
            rotator();
        });
    })(jQuery);

</script>
<div class="wrapper">
	<div class="container">
		<div class="content_block row no-sidebar">
			<div class="fl-container">
				<div class="posts-block">
					<div class="contentarea">  
						<!-- Slider -->                                        
						<div class="fw_block bg_start wall_wrap b-slider">
							<div class="row">
								<div class="col-sm-12 first-module module_slider module_cont pb0">
									<div class="slider_container">
										<div class="fullscreen_slider slider_bg">
											<ul>
												<!-- SLIDE 1 -->
												<li data-transition="fade" data-slotamount="5" data-masterspeed="700" >
													<img src="images/slider/transparent.png" alt="slide1" data-bgposition="center top" data-bgfit="cover" data-bgrepeat="no-repeat" />              
													<!-- LAYER NR. 1 -->
													<div class="tp-caption lfb ltb tp-resizeme slide_img slide_left_img"
														 data-x="0"
														 data-y="130"
														 data-speed="800"
														 data-start="700"
														 data-easing="Power4.easeOut"
														 data-endspeed="500"
														 data-endeasing="Power4.easeIn"><img style="padding-left: 15%;"src="images/slider/chair_left1.png" alt=""/>
													</div>

													<!-- LAYER NR. 2 -->
													<div class="tp-caption lfb ltb tp-resizeme slide_img slide_right_img"
														 data-x="0"
														 data-y="170"
														 data-speed="1000"
														 data-start="1200"
														 data-easing="Power4.easeOut"
														 data-endspeed="500"
														 data-endeasing="Power4.easeIn"><img style="padding-right: 30%;" src="images/slider/chair_right1.png" alt=""/>
													</div> 

													<!-- LAYER NR. 3 -->                
													<div class="tp-caption lft ltt tp-resizeme slide_title slide_info_center"
														 data-x="0"
														 data-y="70"
														 data-speed="600"
														 data-start="1200"
														 data-easing="Power4.easeOut"
														 data-endspeed="300"
														 data-endeasing="Power4.easeIn"><span style="font-size: 35px; font-weight: normal; color: #ffffff;">Ваша жизнь уникальна</span>
													</div>

													<!-- LAYER NR. 4 -->
													<div class="tp-caption lfb ltb tp-resizeme slide_descr slide_info_center"
														 data-x="0"
														 data-y="200"
														 data-speed="600"
														 data-start="1200"
														 data-easing="Power4.easeOut"
														 data-endspeed="600"
														 data-endeasing="Power4.easeIn"><span style="font-size: 22px; color: #ffffff; padding-left: 40px;">Мы вкладываем душу, сердце и разум в работу с каждым клиентом<br />Работаем настолько хорошо, насколько это возможно</span>
													</div>  
													<!-- LAYER NR. 5 -->
                                                      <div class="tp-caption lfb ltb tp-resizeme slide_btn"
                                                           data-x="510"
                                                           data-y="350"
                                                           data-speed="800"
                                                           data-start="1400"
                                                           data-easing="Power4.easeOut"
                                                           data-endspeed="600"
                                                           data-endeasing="Power4.easeIn">
														   <a href="#" class = "j-show_order_dialog">Записаться</a>
                                                      </div>
												</li>

												<!-- SLIDE 2 -->
												<li data-transition="fade" data-slotamount="5" data-masterspeed="700" > 
													<img src="images/slider/transparent.png" alt="slide2" data-bgposition="center top" data-bgfit="cover" data-bgrepeat="no-repeat" />             
													<!-- LAYER NR. 1 -->                
													<div class="tp-caption lft ltt tp-resizeme slide_title slide_info_center"
														 data-x="0"
														 data-y="15"
														 data-speed="800"
														 data-start="1400"
														 data-easing="Power4.easeOut"
														 data-endspeed="300"
														 data-endeasing="Power4.easeIn"><span style="font-size: 33px; font-weight: normal; color: #ffffff;">Лучшая помощь и решения для Вас</span>
													</div>

													<!-- LAYER NR. 2 -->
													<div class="tp-caption lft ltt tp-resizeme slide_descr slide_info_center"
														 data-x="0"
														 data-y="125"
														 data-speed="700"
														 data-start="1200"
														 data-easing="Power4.easeOut"
														 data-endspeed="600"
														 data-endeasing="Power4.easeIn"><span style="font-size: 30px;">Даем  лучшие и наиболее эффективные решения для Вас</span>
													</div>  
													<!--data-x="185"
														 data-y="227"-->
													<!-- LAYER NR. 3 -->
													<div class="tp-caption lfb ltb tp-resizeme slide_img z_index2"
														 data-x="0"
														 data-y="160"
														 data-speed="800"
														 data-start="700"
														 data-easing="Power4.easeOut"
														 data-endspeed="500"
														 data-endeasing="Power4.easeIn"><img style="padding-left: 25%;" src="images/slider/laptop1.png" alt=""/>
													</div>
													
													<div class="tp-caption lfb ltb tp-resizeme slide_btn"
                                                           data-x="800"
                                                           data-y="200"
                                                           data-speed="800"
                                                           data-start="1400"
                                                           data-easing="Power4.easeOut"
                                                           data-endspeed="600"
                                                           data-endeasing="Power4.easeIn">
														   <a href="#" class = "j-show_order_dialog">Записаться</a>
                                                      </div>
												</li>

												<!-- SLIDE 3 -->
												<li data-transition="fade" data-slotamount="5" data-masterspeed="700" >
													<img src="images/slider/transparent.png" alt="slide3" data-bgposition="center top" data-bgfit="cover" data-bgrepeat="no-repeat" />              
													<!-- LAYER NR. 1 -->
													<div class="tp-caption customin z_index2 slide_right_img"
														 data-x="0"
														 data-y="130"
														 data-customin="x:0;y:0;z:0;rotationX:0;rotationY:0;rotationZ:0;scaleX:0;scaleY:0;skewX:0;skewY:0;opacity:0;transformPerspective:1000;transformOrigin:50% 50%;"
														 data-speed="1500"
														 data-start="500"
														 data-easing="Power3.easeInOut"
														 data-endspeed="300"><img src="images/slider/desktop1.png" alt="" style="padding-right: 35%;"/>
													</div>

													<!-- LAYER NR. 4 -->                
													<div class="tp-caption lft ltt tp-resizeme slide_title font_size130"
														 data-x="0"
														 data-y="70"
														 data-speed="1000"
														 data-start="1800"
														 data-easing="Power4.easeOut"
														 data-endspeed="300"
														 data-endeasing="Power4.easeIn"><span style="font-size: 36px; font-weight: normal; color: #ffffff;">Высокие стандарты работы</span>
													</div>

													<!-- LAYER NR. 5 -->                
													<!-- <div class="tp-caption lft ltt tp-resizeme slide_title font_size130"
														 data-x="0"
														 data-y="205"
														 data-speed="1000"
														 data-start="1600"
														 data-easing="Power4.easeOut"
														 data-endspeed="300"
														 data-endeasing="Power4.easeIn"><span style="font-size: 33px; font-weight: normal; color: #ffffff;">работы</span>
													</div>-->

													<!-- LAYER NR. 6 -->
													<div class="tp-caption lfb ltb tp-resizeme slide_descr"
														 data-x="0"
														 data-y="175"
														 data-speed="1000"
														 data-start="1600"
														 data-easing="Power4.easeOut"
														 data-endspeed="600"
														 data-endeasing="Power4.easeIn"><span style="font-size: 30px;">Наш успех зависит не только от качества<br /> нашей работы. Его истоки в наших способах и<br /> индивидуальном подходе, с которыми мы<br /> работаем с нашими клиентами.</span>
													</div> 
													<div class="tp-caption lfb ltb tp-resizeme slide_btn"
                                                           data-x="170"
                                                           data-y="400"
                                                           data-speed="1000"
                                                           data-start="1600"
                                                           data-easing="Power4.easeOut"
                                                           data-endspeed="600"
                                                           data-endeasing="Power4.easeIn">
														   <a href="#" class = "j-show_order_dialog">Записаться</a>
                                                      </div>                                                    
												</li>                                                                                                                                
											</ul>
										</div>
									</div>                                        	
								</div>
							</div>
						</div>  
						<!-- //Slider -->

						<div class="row">
							<div class="col-sm-12 module_cont pb0">
								<div class="bg_title">
									<p style="font-size: 24px; line-height: 28px; font-weight: 700;">Добро пожаловать! Меня зовут Денис Северов</p>
								</div>                                  
							</div>
						</div>

						<div class="row">
							<div class="col-sm-6 module_cont pb30">
								<div class="module_content shortcode_iconbox type4 animate" data-anim-type="fadeInLeft" data-anim-delay="200">
									<a href="javascript:void(0);">			
										<div class="iconbox_wrapper">
											<div class="icon_title_wrap">
												<div class="ico"><img src="img/icons/icon8.png" class="icon_def" width="80" height="80" alt="" /><img src="img/retina/icons/icon8.png" class="icon_retina" width="80" height="80" alt="" /></div>
												<h5 class="iconbox_title">Индивидуальный подход</h5>
											</div>
											<div class="iconbox_body">						
												<p>Мы работаем с каждым клиентом индивидуально. Мы хорошо понимаем, что каждый человек уникален и каждому нужен свой, особенный подход и последующая поддержка.</p>
											</div>					
										</div>
									</a>
								</div>
								<div class="module_content shortcode_iconbox type4 animate" data-anim-type="fadeInLeft" data-anim-delay="250">
									<a href="javascript:void(0);">			
										<div class="iconbox_wrapper">
											<div class="icon_title_wrap">
												<div class="ico"><img src="img/icons/icon9.png" class="icon_def" width="80" height="80" alt="" /><img src="img/retina/icons/icon9.png" class="icon_retina" width="80" height="56" alt="" /></div>
												<h5 class="iconbox_title">Высокое качество</h5>
											</div>
											<div class="iconbox_body">						
												<p>Эмоциональное и психологическое присутствие и глубина проработки Ваших проблем</p>
											</div>					
										</div>
									</a>
								</div>
								<div class="module_content shortcode_iconbox type4 animate" data-anim-type="fadeInLeft" data-anim-delay="300">
									<a href="javascript:void(0);">			
										<div class="iconbox_wrapper">
											<div class="icon_title_wrap">
												<div class="ico"><img src="img/icons/icon16.png" class="icon_def" width="80" height="80" alt="" /><img src="img/retina/icons/icon16.png" class="icon_retina" width="80" height="56" alt="" /></div>
												<h5 class="iconbox_title">Абсолютная конфиденциальность</h5>
											</div>
											<div class="iconbox_body">						
												<p>Мы умеем хранить секреты. Полная конфиденциальность в соответствии с международными стандартами и нормами.</p>
											</div>					
										</div>
									</a>
								</div>
							</div> 
							<div class="col-sm-6 module_cont pb30 animate" data-anim-type="fadeIn" data-anim-delay="250">
								<img src="/images/4.jpg" class="img-responsive" alt="" />
							</div>        	
						</div>  

						<div class="row">
							<div class="col-sm-12 module_cont animate" data-anim-type="fadeInUp" data-anim-delay="250">
								<div class="shortcode_promoblock">
									<div class="promoblock_wrapper">
										<div class="promo_text_block">
											<div class="promo_text_block_wrapper">
												<h2 class="promo_text_main_title">100% гарантия результата по улучшению Вашего самочувствия. Мы умеем создавать самую благоприятную атмосферу для работы со сложностями и трудностями в Вашей жизни и находить наиболее оптимальные  решения для Вас.</h2>
												<h6 class="promo_text_additional_title">Высокий уровень подготовки и большой опыт работы позволяют нам увидеть главное в Вашей проблеме и подобрать для Вас самые эффективные и верные пути, чтобы вернуть Вас в то гармоничное состояние, к которому Вы хотите прийти.</h6>
											</div>
										</div>
										<div class="clear"></div>                                                                                
									</div>
								</div>
								<div class="clear"></div>
							</div>                             	
						</div>                                                                               

						<div class="row">
							<div class="col-sm-12 module_cont pb0">
								<div class="bg_title">
									<h2>С какими проблемами Вы можете к нам обратиться?</h2>
								</div>                                   
							</div>
						</div> 

						<div class="row">                             	
							<div class="col-sm-6 module_cont pb55 animate" data-anim-type="bounceInLeft" data-anim-delay="250">
								<img src="/images/5.jpg" class="img-responsive mt_23" alt="">
							</div>
							<div class="col-sm-6 module_cont module_accordion pb45 animate" data-anim-type="bounceInRight" data-anim-delay="250">
								<div class="shortcode_accordion_shortcode accordion">
									<h5 data-count="1" class="shortcode_accordion_item_title expanded_yes" >ВАША ЛИЧНОСТЬ И САМООЦЕНКА<span class="ico"></span></h5>
									<div class="shortcode_accordion_item_body">
										<div class="ip">
											<ol>
												<li>Чувство одиночества</li>
												<li>Чувства вины, стыда, тревожности</li>
												<li>Неуверенность в себе</li>
												<li>Поиск партнера</li>
												<li>Беспокойство и страхи</li>
												<li>Повышенная агрессивность</li>
												<li>Поиск себя и смысла жизни</li>
												<li>Навязчивые действия и мысли</li>
												<li>Проблемы с принятием решений</li>
												<li>Зависимости</li>
												<li>Конфликтность</li>
												<li>Возрастные кризисы</li>
											</ol>
										</div>
									</div>
									<h5 data-count="2" class="shortcode_accordion_item_title expanded_no">МЕЖЛИЧНОСТНЫЕ ОТНОШЕНИЯ. СЕМЕЙНАЯ ПСИХОЛОГИЯ<span class="ico"></span></h5>
									<div class="shortcode_accordion_item_body">
										<div class="ip">
											<ol>
												<li>Любовная зависимость</li>
												<li>Трудности построения отношений с мужчинами</li>
												<li>Измена и расставание</li>
												<li>Поиски любви</li>
												<li>Любовный треугольник</li>
												<li>Проблемы в молодой семье: недопонимание партнера, конфликтность отношений, бескомпромиссность и неуважение к партнеру</li>
												<li>Развод, родительские отношения в период развода и после. Выработка собственной самоподдержки</li>
												<li>Сложные отношения с родными и близкими.   Проработка конфликтных ситуаций и улучшение отношений</li>
											</ol>
										</div>
									</div>
									<h5 data-count="3" class="shortcode_accordion_item_title expanded_no">ПСИХОЛОГИЯ ИНТИМНОЙ ЖИЗНИ. СЕКСУАЛЬНОСТЬ И ПРИТЯГАТЕЛЬНОСТЬ<span class="ico"></span></h5>
									<div class="shortcode_accordion_item_body">
										<div class="ip">
											<ol>
												<li>Гармония интимных отношений</li>
												<li>Психология секса</li>
												<li>Снижение сексуального влечения</li>
												<li>Сексуальная зависимость</li>
											</ol>
										</div>
									</div>
									<h5 data-count="4" class="shortcode_accordion_item_title expanded_no">ДОСТИЖЕНИЕ ПОСТАВЛЕННЫХ ЦЕЛЕЙ<span class="ico"></span></h5>
									<div class="shortcode_accordion_item_body">
										<div class="ip">
											<ol>
												<li>Раскрытие Вашего потенциала на пути к конкретной цели</li>
												<li>Помощь в выборе оптимального пути достижения этой цели</li>
											</ol>
										</div>
									</div>
									<h5 data-count="5" class="shortcode_accordion_item_title expanded_no">СЛОЖНЫЕ ПСИХИЧЕСКИЕ СОСТОЯНИЯ<span class="ico"></span></h5>
									<div class="shortcode_accordion_item_body">
										<div class="ip">
											<ol>
												<li>Депрессия</li>
												<li>Навязчивые состояния</li>
												<li>Страхи</li>
												<li>Психосоматические симптомы</li>
											</ol>
										</div>
									</div>
								</div>
							</div>
						</div>

						<!-- <div class="wrapper">
							 <div class="row">
								 <div class="col-sm-12 module_cont pb0">
									 <div class="bg_title">
										 <h2 class="fleft">Какие техники мы используем в работе</h2>
										 <div class="clear"></div>
									 </div>                                   
								 </div>
							 </div> 
							 
							 <div class="row">
								 <div class="sorting_block image-grid featured_items photo_gallery" id="list">
						<?php
						$this->widget('application.modules.technics.components.LatestTechnics');
						?>                                                                                                                         
								 </div>
								 <div class="clear"></div>
							 </div>                             
						 </div>     -->                           	

						<div class="fw_block bg_start pt74 pb50 grey_bg mb0">
							<div class="row">
								<div class="col-sm-12 module_cont pb0">
									<div class="bg_title">
										<h2>Наш опыт</h2>
									</div>                                   
								</div>
							</div>

							<div class="row skills_start">
								<div class="col-sm-12 module_cont pb0">
									<div class="shortcode_diagram items4">
										<ul class="diagram_list" data-bg="#ffffff" data-color="#22a1c4" data-width="5px" data-size="130px" data-fontsize="40px">
											<li class="diagram_li animate" data-anim-type="fadeInLeft" data-anim-delay="300">
												<div class="diagram_wrapper">
													<div class="diagram_item">
														<div class="chart_wrapper">
															<div class="chart" data-percent="100">85<span>%</span></div>
														</div>
														<div class="diagram_content">
															<div class="diagram_descr">
																Наших клиентов приходят к нам по рекомендации тех, кому мы уже помогли
															</div>
														</div>
													</div>
												</div>
											</li>
											<li class="diagram_li animate" data-anim-type="fadeInUp" data-anim-delay="250">
												<div class="diagram_wrapper">
													<div class="diagram_item">
														<div class="chart_wrapper">
															<div class="chart" data-percent="100">500<span></span></div>
														</div>
														<div class="diagram_content">
															<div class="diagram_descr">
																И более клиентов выбрали нас и продолжают выбирать
															</div>
														</div>
													</div>
												</div>
											</li>
											<li class="diagram_li animate" data-anim-type="fadeInUp" data-anim-delay="250">
												<div class="diagram_wrapper">
													<div class="diagram_item">
														<div class="chart_wrapper">
															<div class="chart" data-percent="100">10<span></span></div>
														</div>
														<div class="diagram_content">
															<div class="diagram_descr">
																Лет наш стаж работы по оказанию консультационной помощи</div>
														</div>
													</div>
												</div>
											</li>
											<li class="diagram_li animate" data-anim-type="fadeInRight" data-anim-delay="300">
												<div class="diagram_wrapper">
													<div class="diagram_item">
														<div class="chart_wrapper">
															<div class="chart" data-percent="100">100<span>%</span></div>
														</div>
														<div class="diagram_content">
															<div class="diagram_descr">
																Мы постоянно повышаем свою квалификацию для того, чтобы еще лучше работать с Вами
															</div>
														</div>
													</div>
												</div>
											</li>                                                                                                 
										</ul>
										<div class="clear"></div> 
									</div>                                  
								</div>
							</div>
						</div>

						<div class="fw_block bg_start block_plus type1">
							<div class="item animate" data-anim-type="fadeInLeft" data-anim-delay="400">
								<h2 class="item_title">Почему выбирают нас?</h2>
								<p>Гарантируется <strong>100% анонимность</strong> и сохранность всей изложенной Вами информации. Это является как Вашей, так и нашей безопасностью.
									У вас есть возможность <strong>обратиться к нам в любое время</strong>, независимо от дня недели или времени суток. В нашей работе мы никогда не останавливаемся на одном уровне, а постоянно повышаем свою квалификацию и получаем дополнительные знания, участвуя в специализированных конференциях. </p>
								<p>В совместной работе с Вами используются не только современные, но и подтвержденные своей эффективностью методы. С помощью <strong>индивидуального подхода</strong> и подбора к каждому клиенту различных техник и методик, мы <strong>всегда находим ответы и решения</strong> по всем Вашим психологическим проблемам.</p>
							</div>
							<div class="item bg_color2 animate" data-anim-type="fadeIn" data-anim-delay="250">
								<h2 class="item_title">Что Вы получите?</h2>
								<ul class="b-what-you-get">
									<li>Обретете чувство уверенности в себе и в Вашем завтрашнем дне;</li>
									<li>Избавитесь от негативных чувств, которые мешают Вам жить;</li>
									<li>Вернете себе внутреннее состояние гармонии и счастья;</li>
									<li>Лучше узнаете себя и увидите свои слабые и сильные стороны;</li>
									<li>Улучшите свои взаимоотношения с другими людьми;</li>
									<li>Карьерный рост и улучшение Вашего финансового положения;</li>
									<li>Научитесь лучше владеть собой и управлять своими эмоциями;</li>
									<li>Избавитесь от переживаемой боли;</li>
									<li>Поймете, как можно сделать Вашу жизнь лучше;</li>
									<li>Повысите Вашу самооценку и самоуважение.</li>
								</ul>
								<div class="slide_btn b-content_btn_order">
									<a href="#" class = "j-show_order_dialog">Записаться</a>
								</div>
							</div>
							<div class="item animate" data-anim-type="fadeInRight" data-anim-delay="400">
								<h2 class="item_title">С какими темами мы НЕ работаем?</h2>
								<ul class="b-what-you-get">
									<li>С химическими, алкогольными и табачными зависимостями;</li>
									<li>С клиентами, имеющими психиатрический статус;</li>
									<li>С желаниями научиться скрытому манипулированию людей.</li>
								</ul>
							</div>
						</div>  

						<?php //$this->widget('application.modules.opinion.widgets.SiteOpinionWidget', array('modelName'=>'Opinion'));?>
						<div class="row">
							
							<div class="col-sm-12 module_cont pb0">
								<div class="bg_title text-center">
									<h2>Отзывы</h2>
								</div>                                   
							</div>
							
							<div class="col-sm-12 module_cont pb80">   
								<div class="section-clients featured_items">
									<div class="items3">
										<ul class="client-list item_list">
											<li class="animate" data-anim-type="fadeInLeft" data-anim-delay="250">
												<i>
													<img class="icon-cl-sweden" src="/images/18080.jpg" alt="">
												</i>
												<blockquote>
													<p class="quote">Хочу сказать огромное спасибо Денису Северову за оказанную помощь. Для меня всегда было неприемлемо обращаться к совершенно посторонним людям и рассказывать им о своих проблемах. За время проведенных консультаций я узнала много нового о себе, хотя многие вещи я отрицала и просто не хотела их признавать. Это достаточно сильно портило мою жизнь. Благодаря Вам я практически полностью избавилась от своих комплексов и смотрю сейчас на жизнь позитивно. Спасибо!</p>
													<div class="author">
														<p>
															<span class="img"><img src="/images/110110.png" alt=""></span>
															<span class="cont">
																<b>Ольга 32 года</b>
																<span class="title">г. Минск</span>
															</span>
														</p>
													</div>
												</blockquote>
											</li>
											<li class="animate" data-anim-type="fadeInLeft" data-anim-delay="350">
												<i>
													<img class="icon-cl-sweden" src="/images/18080.jpg" alt="">
												</i>
												<blockquote>
													<p class="quote">Сейчас  я чувствую себя так, как никогда не чувствовала за последние несколько лет. За это я благодарна такому человеку, как Денис Северов. После скандального и очень трудного развода я перестала быть похожей на саму себя. Долгое время меня не покидало стрессовое состояние и вдобавок к нему начало появляться физическое недомогание.  Спасибо, что вернули мне мою яркую и наполненную прекрасными событиями жизнь. Я искренне благодарна Вам за это.</p>
													<div class="author">
														<p>
															<span class="img"><img src="/images/110110.png" alt=""></span>
															<span class="cont">
																<b>Виктория 29 лет</b>
																<span class="title">г. Минск</span>
															</span>
														</p>
													</div>
												</blockquote>
											</li>
											<li class="animate" data-anim-type="fadeInLeft" data-anim-delay="300">
												<i>
													<img class="icon-cl-sweden" src="/images/18080.jpg" alt="">
												</i>
												<blockquote>
													<p class="quote">Сразу хочу сказать, что жалею, что не обратилась за консультацией к Северову Денису сразу, а лишь спустя 11 месяцев после начала сложного периода в моей жизни. Из плюсов, у меня было четкое понимание того, каких целей я хочу достичь, но не было понимания того, как я могу их достичь. Из-за этого мое беспокойство быстро нарастало и в моей личной жизни, и в работе начали появляться проблемы. Спасибо за консультации, сейчас я осознала свои ошибки и чувствую себя действительно счастливой!</p>
													<div class="author">
														<p>
															<span class="img"><img src="/images/110110.png" alt=""></span>
															<span class="cont">
																<b>Анна 24 года</b>
																<span class="title">г. Минск</span>
															</span>
														</p>
													</div>
												</blockquote>
											</li>
											<li class="animate" data-anim-type="fadeInLeft" data-anim-delay="300">
												<i>
													<img class="icon-cl-sweden" src="/images/18080.jpg" alt="">
												</i>
												<blockquote>
													<p class="quote">Огромное Вам спасибо! Теперь, когда у меня есть знание и представление, как действовать я не буду бояться делать следующие шаги в моей жизни. По началу, было ощущение, что все будет намного страшнее и сложнее, но на деле все было очень даже познавательно.  Благодарна Вам за те слова, которые оказывали на меня целебное свойство. За то, что обучили простым, но таким эффективным техникам, как медитация и аутогенная тренировка. Спасибо.</p>
													<div class="author">
														<p>
															<span class="img"><img src="/images/110110.png" alt=""></span>
															<span class="cont">
																<b>Светлана 35 лет</b>
																<span class="title">г. Минск</span>
															</span>
														</p>
													</div>
												</blockquote>
											</li>
											<li class="animate" data-anim-type="fadeInLeft" data-anim-delay="350">
												<i>
													<img class="icon-cl-sweden" src="/images/18080.jpg" alt="">
												</i>
												<blockquote>
													<p class="quote">Огромное спасибо за то, что Вы вкладываете в своих клиентов. За то, насколько Вы умеете слушать их и сопереживать им. За то, что действительно оказываете действенную помощь и даёте им, с помощью Ваших подсказок, самим находить верные решения. Это дорого стоит.</p>
													<div class="author">
														<p>
															<span class="img"><img src="/images/110110.png" alt=""></span>
															<span class="cont">
																<b>Надежда 39 лет</b>
																<span class="title">г. Минск</span>
															</span>
														</p>
													</div>
												</blockquote>
											</li>
											<li class="animate" data-anim-type="fadeInLeft" data-anim-delay="400">
												<i>
													<img class="icon-cl-sweden" src="/images/18080.jpg" alt="">
												</i>
												<blockquote>
													<p class="quote">За всю жизнь я обращалась к психологам два раза. От общения с Денисом  Анатольевичем остаются только самые положительные впечатления и чувства. Он помог донести моему сознанию вполне обыденные, но необходимые вещи, которые, долгое время я не могла решить сама. Я очень благодарна Вам за терпение и тот индивидуальные метод решения моих жизненных проблем.</p>
													<div class="author">
														<p>
															<span class="img"><img src="/images/110110.png" alt=""></span>
															<span class="cont">
																<b>Ирина Викторовна 48 лет</b>
																<span class="title">г. Минск</span>
															</span>
														</p>
													</div>
												</blockquote>
											</li>
										</ul>
									</div>
								</div>    
							</div>
						</div> 


					</div>
				</div>
			</div>
		</div>
	</div> 
</div>

    <?php 
		$this->widget('application.widgets.OrderWidget');
	?>