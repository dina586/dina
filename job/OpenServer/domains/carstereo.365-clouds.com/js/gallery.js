
jQuery(document).ready(function($){
    if($('.gallery-caption a').length) {
         $('.gallery-caption a').click(function(){
             var tmp = $(this).parents('.gallery-item').find('.gallery-icon a');
             if(tmp.length)
                 tmp.click();
             return false;
         });
    }
    
    if ($('#camera_wrap_0').length) {
      $('#camera_wrap_0').camera({
        pagination: false,
        thumbnails: false,
        loader: 'none',
        height: '337px',
        width: '100%',
        fx: 'scrollLeft'
      });
    }

    //used on gallery
    if ($('#camera_wrap_1').length) {
      $('#camera_wrap_1').camera({
        pagination: false,
        thumbnails: true,
        fx: 'scrollLeft'
      });
    }

});  




