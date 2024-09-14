<div id="map" class="h-80 md:h-auto"></div>
<script>
    if (navigator.geolocation) {
        q = navigator.geolocation.getCurrentPosition(getLocation, showPosition);
        function getLocation() {
          if (navigator.geolocation) {
              navigator.geolocation.getCurrentPosition(showPosition);
          } else {
              x.value = "Geolocation is not supported by this browser.";
          }
        }
        function showPosition(position) {
            var map = L.map('map').setView([position.coords.latitude,position.coords.longitude], 5);
            L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
                maxZoom: 50,
                attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
            }).addTo(map);
            
            var locationList = <?php echo json_encode($locations); ?>;

            var locations = [];
            for(var i = 0; i < locationList.length; i++){
                let text = String(locationList[i]['latitude_logitude']);
                locations.push(text.split(","));
            }

            for (var i = 0; i < locations.length; i++) {
                marker = new L.marker([locations[i][0],locations[i][1]])
                .addTo(map);
            }
        }
    }
</script>