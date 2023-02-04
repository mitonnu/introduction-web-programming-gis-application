window.onload = () => {
    console.log(L);
    let maymap = L.map('mapdiv');
    maymap.setView([19.4, -99.1], 11);

    let backgroundLayer = L.tileLayer(
        'http://{s}.tile.osm.org/{z}/{x}/{y}.png'
    );
    maymap.addLayer(backgroundLayer);
};
