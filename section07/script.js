window.onload = () => {
    // Check Library Version
    console.log(L.version);

    // Generate Map
    let mymap = L.map('mapdiv');
    mymap.setView([19.4, -99.1], 11);

    let backgroundLayer = L.tileLayer(
        'http://{s}.tile.osm.org/{z}/{x}/{y}.png'
    );
    mymap.addLayer(backgroundLayer);

    // Generate Marker which has popup feature
    // zocaloMarker.bindPopup('Zocalo');
    let zocaloMarker = L.marker([19.43278, -99.13333]).addTo(mymap).bindPopup(`
        <h3 class="text-center">Zocalo</h3>
        <hr>
        <a href="https://ja.wikipedia.org/wiki/ソカロ" target="blank"><img src="./portada.jpg" width="200px"/></a>
    `);

    // Zoom and Move to Zocalo Button
    $('#zoomToZocalo').click(() => {
        mymap.setView([19.43278, -99.13333]);
    });

    // Mouse Move Handler
    mymap.on('mousemove', e => {
        let str = `Latitude: ${e.latlng.lat.toFixed(
            5
        )}  Longitude: ${e.latlng.lng.toFixed(
            5
        )}  Zoom Level: ${mymap.getZoom()}`;

        $('#map_coords').html(str);
    });

    // Add Ajax Feature
    // Add Attractions from GeoJSON Data
    let geojsonLayer = new L.GeoJSON.AJAX('data/attractions.geojson', {
        pointLayer: (feature, latlng) => {
            // Each Marker
            let str = `
                        <h4>${feature.properties.name}</h4>
                        <hr>
                        <a href="${feature.properties.web}" target="blank">
                            <img src="img/${feature.properties.image} " width="200px" />
                        </a>
                    `;
            return L.marker(latlng).bindPopup(str);
        },
    });
    geojsonLayer.addTo(mymap);

    // Create Each Attraction Zoom Button from GeoJSON Data
    geojsonLayer = new L.GeoJSON.AJAX('data/attractions.geojson', {
        pointToLayer: (feature, latlng) => {
            // Each Zoom Button
            let str = `
                    <button id="zoomTo${feature.properties.name.replace(
                        / /g,
                        ''
                    )}" class="form-control btn btn-primary attraction">${
                feature.properties.name
            }</button>
                `;
            $('#side_panel').append(str);
            $(`#zoomTo${feature.properties.name.replace(/  /g, '')}`).click(
                () => {
                    mymap.setView([latlng.lat, latlng.lng], 17);
                }
            );
            return L.marker(latlng).bindPopup(str);
        },
    });
    geojsonLayer.addTo(mymap);

    // Add Turf.js Buffer Feature
    let bufferLayer;
    $('#btnBuffer').click(() => {
        console.log('clicked');
        if ($('#btnBuffer').html() == 'Buffer') {
            console.log(geojsonLayer);
            console.log(geojsonLayer.toGeoJSON());
            let bufferedAttractions = turf.buffer(geojsonLayer.toGeoJSON(), 1, {
                units: 'miles',
            });
            console.log(bufferedAttractions);
            bufferLayer = L.geoJSON(bufferedAttractions).addTo(mymap);
            $('#btnBuffer').html('Remove Buffer');
        } else {
            mymap.removeLayer(bufferLayer);
            $('#btnBuffer').html('Buffer');
        }
    });
};
