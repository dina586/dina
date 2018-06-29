function gallery_init() {
	Galleria.loadTheme('/packages/galleria/galleria.classic.min.js'); 
	$('#j-portfolio_gallery').galleria({
		autoplay: 7000,
		imageCrop: true,
		lightbox: true,
		showInfo: false
	});
	$('#j-portfolio_gallery').css({'opacity':'1'});
}