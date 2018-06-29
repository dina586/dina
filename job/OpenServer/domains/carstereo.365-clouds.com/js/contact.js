   var map, pois, zoom;

    jQuery(document).ready(function($){
        initMap();

        $('.location_container').click(function(){
            centerMapToLocation($(this));
        });

        $('.location_container').dblclick(function(){
            centerMapToLocation($(this),true);
        });

        $('#map-area-reset').click(function(){
            initMap();

            return false;
        });
    });

    function initMap() {
        jQuery('#map-area').html('');

        var key, sc = new MQA.ShapeCollection();
        pois = {};
        key = 0; 
        pois[key] = new MQA.Poi({lat: 33.809027,lng: -117.860759});
        pois[key].setRolloverContent("810 West Katella Ave., Orange, CA 92867");
        MQA.EventManager.addListener(pois[key], 'rolloveropen', poirollstart);
        MQA.EventManager.addListener(pois[key], 'rolloverclose', poirollend);
        sc.add(pois[key]);
        
        map = new MQA.TileMap({
            elt:           document.getElementById('map-area'),
            collection:    sc,
            bestFitMargin: 100
        });

        MQA.withModule('mousewheel', function() {
            map.enableMouseWheelZoom();
        });

        MQA.withModule('smallzoom', function() {
            map.addControl(
                new MQA.SmallZoom(),
                new MQA.MapCornerPlacement(MQA.MapCorner.TOP_LEFT, new MQA.Size(3,3))
            );
        });
    }

    function poirollstart(evt) {
        for(key in pois)
           if(evt.srcObject === pois[key])
               jQuery('#location_' + key).addClass('location_active');
    }

    function poirollend(evt) {
        jQuery('.location_container').removeClass('location_active');
    }

    function centerMapToLocation(trigger,ifZoom) {
        if(ifZoom)
            map.setZoomLevel(15);
        var tmp = trigger.attr('id').split('_');
        map.setCenter({lat: pois[tmp[1]].latLng.lat, lng: pois[tmp[1]].latLng.lng});
    }

