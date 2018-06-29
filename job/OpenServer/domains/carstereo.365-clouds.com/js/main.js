$(window).load(function(){
     // Setup Slider
     $(".onebyone.hide").fadeIn(1000);
     $('.onebyone').oneByOne({
         className: 'oneByOne1',	             
         easeType: 'random',
         autoHideButton: false,
         width: 960,
         height: 840,
         minWidth: 680,
         slideShow: true,
		 slideShowDelay: 8000,
     });
      $("a[class^='prettyPhoto']").prettyPhoto({social_tools: '' });
 });
 $(document).ready(function() {
     $('.slidewrap, .slidewrap2').carousel({
         slider: '.slider',
         slide: '.slide',
         slideHed: '.slidehed',
         nextSlide : '.next',
         prevSlide : '.prev',
         addPagination: false,
         addNav : false
     });
        $('.slide.testimonials').contentSlide();
        $('.bbss').contentSlide();
                                
     window.setInterval(function(){
         $(".slidewrap2 .next").trigger("click");         
     }, 3000);
  
 });


