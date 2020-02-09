        
    var map = L.map('map').setView([-15.5, -70], 3);

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
     return d > 150000000 ? '#800026' :
            d > 120000000  ? '#BD0026' :
            d > 45000000  ? '#E31A1C' :
            d > 40000000  ? '#FC4E2A' :
            d > 10000000   ? '#FD8D3C' :
            d > 5000000   ? '#FEB24C' :
            d > 2000000   ? '#FED976' :
                        '#FFEDA0';
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

