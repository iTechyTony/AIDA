<?php require_once 'templates/_header.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>About | By Tony Ampomah</title>
<?php require_once 'templates/_head.php';?>
<link rel='stylesheet' href='assets/css/map.css' type='text/css'media='all' />  
    <script src="https://maps.googleapis.com/maps/api/js?v=3.exp"></script>
<script type="text/javascript">
  
var map;

function initialize() {
  var mapOptions = {
    zoom: 6
  };
  map = new google.maps.Map(document.getElementById('map-canvas'),
      mapOptions);

  // Try HTML5 geolocation
  if(navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(function(position) {
      var pos = new google.maps.LatLng(position.coords.latitude,
                                       position.coords.longitude);

      var infowindow = new google.maps.InfoWindow({
        map: map,
        position: pos,
        content: 'We found you at'
      });

      map.setCenter(pos);
    }, function() {
      handleNoGeolocation(true);
    });
  } else {
    // Browser doesn't support Geolocation
    handleNoGeolocation(false);
  }
}

function handleNoGeolocation(errorFlag) {
  if (errorFlag) {
    var content = 'Error: The Geolocation service failed.';
  } else {
    var content = 'Error: Your browser doesn\'t support geolocation.';
  }

  var options = {
    map: map,
    position: new google.maps.LatLng(60, 105),
    content: content
  };

  var infowindow = new google.maps.InfoWindow(options);
  map.setCenter(options.position);
}

google.maps.event.addDomListener(window, 'load', initialize);

</script>

</head>

<body>
<?php require_once 'templates/_topNav.php';?>

<div class="container-fluid">
  <div class="row">
 <?php require_once 'templates/_leftnav.php'; ?>  
    <div class="col-md-9">

      <div class="panel panel-primary">
        <div class="panel-heading">
          <h3 class="panel-title">About</h3>
        </div>
        <div class="panel-body">
         <div id="map-canvas"></div>
      </div>

      </div>
    </div><!-- end of col-md-9 -->
  </div><!-- end of row -->
</div><!-- end of container fluid -->

<?php require_once 'templates/_footer.php'; ?>

</body>
</html>

