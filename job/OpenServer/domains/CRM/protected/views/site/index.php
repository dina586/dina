

<div class = "b-header_about j-header_about">
	<div class = "b-header_about_hands">
		<div class = "g-site_width">
			<article>
				<h1><?=$model->name;?></h1>
				<?=$model->content;?>
			</article>
		</div>

		<div class = "g-clear_fix"></div>

		<div class = "b-header_about_slider">
			<div class = "g-site_width">
				<?php $this->widget('application.modules.slider.widgets.SliderWidget'); ?>
			</div>
		</div>
	</div>
</div>

<div class = "g-clear_fix"></div>

<div class = "b-solutions staggered-animation-container">
	<div class = "g-site_width">
		<p class = "soluionts_for">Индивидуальные решения <br/>для</p>
		<div class = "b-solutions_images">
			<div class = "b-solutions_img staggered-animation" data-os-animation="fadeInLeft" data-os-animation-delay="0.6s" style = "background-image: url('/images/solutions_img1.jpg')">
				<div class = "b-solutions_hover">Жилых квартир</div>
			</div>
			<div class = "b-solutions_img staggered-animation" data-os-animation="fadeInLeft" data-os-animation-delay="0.3s" style = "background-image: url('/images/solutions_img2.jpg')">
				<div class = "b-solutions_hover">Домов и коттеджей</div>
			</div>
			<div class = "b-solutions_img staggered-animation" data-os-animation="fadeInRight" data-os-animation-delay="0.3s" style = "background-image: url('/images/solutions_img3.jpg')">
				<div class = "b-solutions_hover">Офисов и деловых центров</div>
			</div>
			<div class = "b-solutions_img staggered-animation" data-os-animation="fadeInRight" data-os-animation-delay="0.6s" style = "background-image: url('/images/solutions_img4.jpg')">
				<div class = "b-solutions_hover">Ресторанов и гостиниц</div>
			</div>
		</div>
	</div>
</div>

<div class = "g-clear_fix"></div>

<div class = "b-capabilities os-animation" id = "j-capabilities" data-os-animation="fadeInLeft">
	<div class = "g-site_width">
		<?php $this->widget('application.modules.block.components.GetBlocks', array('view' => 'capabilities', 'tag'=>'h2')); ?>
	</div>
</div>

<div class = "g-clear_fix"></div>

<div class = "b-design os-animation" data-os-animation="fadeIn" data-os-animation-delay="0.3s">
	<div class = "g-site_width">
		<div class = "b-design_bg_base">
			<div class = "b-design_bg_inner j-design_bg_inner">
				<div class = "b-design_column">
					<?php $this->widget('application.modules.design.widgets.DesignWidget'); ?>
				</div>
			</div>
		</div>
	</div>
</div>

<div class = "g-clear_fix"></div>

<div class = "b-choose staggered-animation-container" id = "j-choose">
	<div class = "g-site_width">
		<h2 class = "l-page_title">Почему выбирают "Умный дом"</h2>

		<div class = "b-choose_area">
			<div class = "b-choose_item staggered-animation" data-os-animation="fadeInLeft" data-os-animation-delay="0.3s">
				<div class = "b-choose_item_img">
					<img src = "/images/choose_img1.png" alt = "Согласованная работа систем"/>
				</div>
				<article>
					<h4>Согласованная <br/>работа систем</h4>
					<p>Системы регулируются автоматически. Вы сразу же узнаете о всех важных изменениях и процессах</p>
				</article>
			</div>
			<div class = "b-choose_item staggered-animation" data-os-animation="fadeIn" data-os-animation-delay="0.5s">
				<div class = "b-choose_item_img">
					<img src = "/images/choose_img2.png" alt = "Простое управление"/>
				</div>
				<article>
					<h4>Простое <br/>управление</h4>
					<p>Отдать команду, установить сценарий или получить уведомление - все это легко сделать через настенную панель, планшет или даже телефон</p>
				</article>
			</div>
			<div class = "b-choose_item staggered-animation" data-os-animation="fadeInRight" data-os-animation-delay="0.3s">
				<div class = "b-choose_item_img">
					<img src = "/images/choose_img3.png" alt = "Безопасность"/>
				</div>
				<article>
					<h4>Безопасность</h4>
					<p>"Умный дом" не только оповестит о возможной аварии, но и сам примет меры по ее предотвращению: перекроет воду или газ, откроет окно для проветривания и т.д.</p>
				</article>
			</div>
			<div class = "b-choose_item staggered-animation" data-os-animation="fadeInLeft" data-os-animation-delay="0.3s">
				<div class = "b-choose_item_img">
					<img src = "/images/choose_img4.png" alt = "Экономия ресурсов"/>
				</div>
				<article>
					<h4>Экономия <br/>ресурсов</h4>
					<p>Четкий контроль и автоматизированные системы обеспечивают экономию газа, воды и электричества</p>
				</article>
			</div>
			<div class = "b-choose_item staggered-animation" data-os-animation="fadeIn" data-os-animation-delay="0.5s">
				<div class = "b-choose_item_img">
					<img src = "/images/choose_img5.png" alt = "Программирование сценариев"/>
				</div>
				<article>
					<h4>Программирование <br/> сценариев</h4>
					<p>"Домашний вечер", "Романтический ужин", "Никого нет дома", "Сон ребенка" - нужная атмосфера в доме всего в один клик</p>
				</article>
			</div>
			<div class = "b-choose_item staggered-animation" data-os-animation="fadeInRight" data-os-animation-delay="0.3s">
				<div class = "b-choose_item_img">
					<img src = "/images/choose_img6.png" alt = "Дистанционное управление"/>
				</div>
				<article>
					<h4>Дистанционное <br/>управление</h4>
					<p>Защищенный протокол связи для включения и выключения системы. Легко подготовить дом к приезду или контролировать на расстоянии</p>
				</article>
			</div>
			<div class = "b-choose_item staggered-animation" data-os-animation="fadeIn" data-os-animation-delay="0.5s">
				<div class = "b-choose_item_img">
					<img src = "/images/choose_img7.png" alt = "Комфорт "/>
				</div>
				<article>
					<h4>Комфорт </h4>
					<p>Умный дом сделает за вас все многочисленные рутинные действия для обеспечения максимального комфорта в зависимости от ситуации и поддержания желаемых параметров (температуры, уровня освещенности и т.п.)</p>
				</article>
			</div>
		</div>
	</div>
</div>


<div class = "g-clear_fix"></div>
<div class = "b-site_form">
	<div class = "g-site_width">
		<?php
			$this->widget('application.widgets.OrderFormWidget');
		?>
	</div>
	<div class = "g-clear_fix"></div>
</div>
<div class = "g-clear_fix"></div>

<!--
<div class = "b-video os-animation" data-os-animation="fadeIn" data-os-animation-delay="0.5s">
	
	<link href="http://vjs.zencdn.net/5.0.0/video-js.css" rel="stylesheet">
	<video id="my-video" class="video-js vjs-default-skin" controls loop preload="auto" poster="/images/video_bg.jpg" data-setup="{}">
		<source src="/upload/video/video.mp4" type='video/mp4'>
		<p class="vjs-no-js">
			Ваш браузер не поддреживает видео.
			<a href="http://videojs.com/html5-video-support/" target="_blank">Данные браузеры поддерживают HTML5 видео</a>
		</p>
	</video>
	<script src="http://vjs.zencdn.net/5.0.0/video.js"></script>
</div>
-->
<link href="http://vjs.zencdn.net/c/video-js.css" rel="stylesheet">
<script src="http://vjs.zencdn.net/c/video.js"></script>


<div class = "b-video os-animation" data-os-animation="fadeIn" data-os-animation-delay="0.5s">
	<video id="example_video_1" class="video-js vjs-default-skin" controls preload="auto" poster="/images/video_bg.jpg" data-setup="{}">
	  <source src="/upload/video/video.mp4" type='video/mp4'>
	</video>
</div>


<div class = "g-clear_fix"></div>

<div class = "b-lider">
	<div class = "g-site_width">
		<h2 class = "l-page_title"> <img src = "/images/gira_logo.png"/> - лидер в сфере "интеллектуальных зданий"</h2>
		<div class ="b-lider_row b-lider_row_top">
			<div class = "b-lider_row_cell">
				<div class = "b-lider_number">
					<p class = "lider_number"><?=Settings::getVal('lider1_number')?></p>
				</div>
				<div class = "b-lider_text">
					<p> <?=Settings::getVal('lider1_letter')?>
					</p>
				</div>
			</div>
			<div class = "b-lider_row_cell">
				<div class = "b-lider_number">
					<p class = "lider_number"><?=Settings::getVal('lider2_number')?></p>
				</div>
				<div class = "b-lider_text">
					<p> 
						<?=Settings::getVal('lider2_text')?>
					</p>
				</div>
			</div>
			<div class = "b-lider_row_cell">
				<div class = "b-lider_number">
					<p class = "lider_number"><?=Settings::getVal('lider3_number')?></p>
				</div>
				<div class = "b-lider_text">
					<p> 
						<?=Settings::getVal('lider3_text')?>
					</p>
				</div>
			</div>
			<div class = "b-lider_row_cell">
				<div class = "b-lider_number">
					<p class = "lider_number"><?=Settings::getVal('lider4_number')?></p>
				</div>
				<div class = "b-lider_text">
					<p>
						<?=Settings::getVal('lider4_text')?>
					</p>
				</div>
			</div>
		</div>
		
		<div class ="b-lider_row b-lider_row_mid">
			<div class = "b-lider_row_cell">
				<div class = "b-lider_number">
					<p class = "lider_number"><?=Settings::getVal('lider5_number')?></p>
				</div>
				<div class = "b-lider_text">
					<p> <?=Settings::getVal('lider5_text')?>
					</p>
				</div>
			</div>
			<div class = "b-lider_row_cell">
				<img src = "/images/lider_img2.jpg" alt = ""/>
			</div>
			<div class = "b-lider_row_cell">
				<div class = "b-lider_number">
					<p class = "lider_number"><?=Settings::getVal('lider6_number')?></p>
				</div>
				<div class = "b-lider_text">
					<p> <?=Settings::getVal('lider6_text')?>
					</p>
				</div>
			</div>
			<div class = "b-lider_row_cell">
				<img src = "/images/lider_img4.jpg" alt = ""/>
			</div>
		</div>
		
		<div class ="b-lider_row b-lider_row_bottom">
			<div class = "b-lider_row_cell">
				<img src = "/images/lider_img1.jpg" alt = ""/>
			</div>
			<div class = "b-lider_row_cell">
				<div class = "b-lider_number">
					<img src = "/images/lider_icon1.png" alt = ""/>
				</div>
				<div class = "b-lider_text">
					<p> Вся продукция <br/>
						<a href = "#" class = "j-open_fancy1">имеет сертификаты</a>
						соответствия и отвечает <br/>
						требованиям<br/>
						электро и пожаробезопасности
					</p>
				</div>
			</div>
			<div class = "b-lider_row_cell">
				<img src = "/images/lider_img3.jpg" alt = ""/>
			</div>
			<div class = "b-lider_row_cell">
				<div class = "b-lider_number">
					<img src = "/images/lider_icon2.png" alt = ""/>
				</div>
				<div class = "b-lider_text">
					<p> <br/>Ежегодно <br/>наши специалисты<br/>
						<a href = "#" class = "j-open_fancy2">проходят обучение</a>
						в учебных центрах<br/> компании
						<img src = "/images/gira_logo.png" alt = "" style = "height: 14px; width: auto;"/>
					</p>
				</div>
			</div>
		</div>
		
		<div class = "g-clear_fix"></div>
		
		<div class = "b-projects" id = "j-projects">
			<h2 class = "l-page_title">Наши работы</h2>
			<?php $this->widget('application.modules.objects.widgets.ObjectsWidget'); ?>
		<div class = "g-clear_fix"></div>
	</div>
</div>

<div class = "g-clear_fix"></div>

<div class = "b-show" id = "j-show">
	<div class = "b-show_left os-animation" data-os-animation="fadeInLeft" data-os-animation-delay="0.5s">
		<div class = "b-show_content">
			<div class = "g-styles">
				<?php $this->widget('application.modules.block.components.GetBlocks', array('view' => 'show', 'tag'=>'h2')); ?>
			</div>
			<a href = "#" class = "j-show_call_dialog l-order_btn">Отправить заявку</a>
		</div>
		<div class = "g-clear_fix"></div>
	</div>
	<div class = "b-show_right os-animation" data-os-animation="fadeInRight" data-os-animation-delay="0.5s">
		<?php $this->widget('application.modules.block.components.GetBlocks', array('view' => 'show_img')); ?>
	</div>
</div>

<div class = "g-clear_fix"></div>

<div class = "b-work">
	<div class = "g-site_width">
		<h2 class = "l-page_title">Схема работы</h2>
		<div class = "b-work_content">
			
			<div class = "b-work_cell b-work_cell_bottom os-animation" data-os-animation="fadeIn" data-os-animation-delay="0.1s">
				<div class = "b-work_cell_round">
					Ваша <br/>заявка
				</div>
			</div>
			<div class = "b-work_arrow b-work_arrow_top os-animation" data-os-animation="fadeIn" data-os-animation-delay="0.2s"></div>
			
			<div class = "b-work_cell b-work_cell_top os-animation" data-os-animation="fadeIn" data-os-animation-delay="0.3s">
				<div class = "b-work_cell_round">
					Предварительный <br/>
					расчет стоимости<br/>
					проекта
				</div>
			</div>
			<div class = "b-work_arrow b-work_arrow_bottom os-animation" data-os-animation="fadeIn" data-os-animation-delay="0.4s"></div>
					
			<div class = "b-work_cell b-work_cell_bottom os-animation" data-os-animation="fadeIn" data-os-animation-delay="0.5s">
				<div class = "b-work_cell_round">
					Выезд на <br/>
					объект,<br/>
					составление <br/>
					техзадания
				</div>
			</div>
			<div class = "b-work_arrow b-work_arrow_top os-animation" data-os-animation="fadeIn" data-os-animation-delay="0.6s"></div>
				
			<div class = "b-work_cell b-work_cell_top os-animation" data-os-animation="fadeIn" data-os-animation-delay="0.7s">
				<div class = "b-work_cell_round">
					Проектирование,<br/>
					диагностика и<br/>
					экспертиза
				</div>
			</div>
			<div class = "b-work_arrow b-work_arrow_bottom os-animation" data-os-animation="fadeIn" data-os-animation-delay="0.8s"></div>
			
			<div class = "b-work_cell b-work_cell_bottom os-animation" data-os-animation="fadeIn" data-os-animation-delay="0.9s">
				<div class = "b-work_cell_round">
					Монтаж <br/>
					оборудования,<br/>
					пусконаладочные <br/>
					работы
				</div>
			</div>
			<div class = "b-work_arrow b-work_arrow_top os-animation" data-os-animation="fadeIn" data-os-animation-delay="1s"></div>
			
			<div class = "b-work_cell b-work_cell_top os-animation" data-os-animation="fadeIn" data-os-animation-delay="1.1s">
				<div class = "b-work_cell_round">
					Гарантийное и <br/>
					послегарантийное <br/>
					обслуживание <br/>
				</div>
			</div>
			
		</div>
	</div>
	<div class = "g-clear_fix"></div>
</div>

<div class = "g-clear_fix"></div>

<div class = "b-opinion" id = "j-opinions">
	<div class = "g-site_width">
		<h2 class = "l-page_title">Отзывы наших клиентов</h2>
		<div class = "b-opinions_container">
			<?php $this->widget('application.modules.opinion.widgets.OpinionWidget'); ?>
		</div>
	</div>
</div>

<div class = "g-clear_fix"></div>

<div class="b-show b-questions">
	<div class="b-show_left">
		<div class = "b-show_content">
			<div class = "g-styles">
				<?php $this->widget('application.modules.block.components.GetBlocks', array('view' => 'question', 'tag'=>'h2')); ?>
			</div>
			<a href = "#" class = "j-show_call_dialog l-order_btn">Отправить заявку</a>
		</div>
		<div class="g-clear_fix"></div>
	</div>
	<div class="b-show_right os-animation" data-os-animation="fadeInRight" data-os-animation-delay="1s">
		<img alt="" src="/images/bottom_img1.jpg" alt = ""/>
	</div>
</div>

<div class="b-show b-map">
	<div class="b-show_right os-animation" data-os-animation="fadeInLeft" data-os-animation-delay="1s">
		<script type="text/javascript" charset="utf-8" src="https://api-maps.yandex.ru/services/constructor/1.0/js/?sid=4Ab3NRAroe1ekbOJxC6IgcoGHf6CeCie&width=100%&height=100%&lang=ru_RU&sourceType=constructor"></script>
	</div>
	
	<div class="b-show_left">
		<div class="b-show_content">
			<div class = "g-styles">
				<?php $this->widget('application.modules.block.components.GetBlocks', array('view' => 'contacts', 'tag'=>'h2')); ?>
			</div>
		</div>
		<div class="g-clear_fix"></div>
	</div>
</div>