        
    var map = L.map('map').setView([-15.5, -70], 3);

    var hover_map = undefined;

    L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw', {
        maxZoom: 15,
        id: 'mapbox/light-v9'
    }).addTo(map);

    // control that shows state info on hover
    var info = L.control();

    info.onAdd = function (map) {
        this._div = L.DomUtil.create('div', 'info');
        this.update();
        return this._div;
    };

    info.update = function (props) {
    this._div.innerHTML =  (props ?
            '<h6>'+'<b>' + props.name + '</b><br /> Población:' + props.density + '</h6>'
            : 
            'Colocal el cursor sobre un pais'
        );
    };

    info.addTo(map);


    // get color depending on population density value
    function getColor(d) {
        return '#E19630';
    }

    function style (feature) {
        return {
            weight: 2,
            opacity: 1,
            color: 'white',
            dashArray: '3',
            fillOpacity: 0.7,
            fillColor: getColor(feature.properties.density)
        };
    }

    function highlightFeature(e) {
        var layer = e.target;

        hover_map_id = e.target.feature.properties.id;

        document.querySelector('#place-' + hover_map_id).classList.add('hover');

        layer.setStyle({
            weight: 2,
            color: '#666',
            dashArray: '',
            fillOpacity: 0.7
        });

        if (!L.Browser.ie && !L.Browser.opera && !L.Browser.edge) {
            layer.bringToFront();
        }

        info.update(layer.feature.properties);
    }

    var geojson;

    function resetHighlight(e) {

        hover_map_id = e.target.feature.properties.id;

        document.querySelector('#place-' + hover_map_id).classList.remove('hover');

        geojson.resetStyle(e.target);
        info.update();
    }

    function onEachFeature(feature, layer) {
        layer.on({
            mouseover: highlightFeature,
            mouseout: resetHighlight,
        });
    }

    geojson = L.geoJson(statesData, {
        style: style,
        onEachFeature: onEachFeature
    })
    .addTo(map);

