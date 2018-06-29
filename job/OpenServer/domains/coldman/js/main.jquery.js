function front_slider() {
	$(document).ready(function() {
            $('.revolution-slider').revolution(
            {
                dottedOverlay:"none",
                delay: 15000,
                startwidth:1170,
                startheight:646,
                onHoverStop:"on",
                hideThumbs:10,
                fullWidth:"on",
                forceFullWidth:"on",
                navigationType:"none",
                shadow:0,
                spinner:"spinner4",
                hideTimerBar:"on",
            });
        });
}