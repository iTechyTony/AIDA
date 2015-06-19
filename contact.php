<?php require_once 'templates/_header.php'; ?>
<?php

// Captcha setup
$captcha = array(rand(1,10),rand(1,10));

$ops = array('+','-','x');
$op = $ops[rand(0,2)];

switch ($op) {
    case '+':
        $_SESSION['expected'] = $captcha[0] + $captcha[1];
        break;
    case '-':
        if($captcha[0] < $captcha[1]){
            $temp = $captcha[0];
            $captcha[0] = $captcha[1];
            $captcha[1] = $temp;
        }
        $_SESSION['expected'] = $captcha[0] - $captcha[1];
        break;
    case 'x':
        $_SESSION['expected'] = $captcha[0] * $captcha[1];
        break;
}
// Captcha setup end

?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>Advanced Internet Development | By Tony Ampomah</title>
<?php require_once 'templates/_head.php';?>
<link rel='stylesheet' href='assets/css/map.css' type='text/css'media='all' />	
<script src="assets/js/easy-contact.js" type="text/javascript"></script>
</head>

<body>
<?php require_once 'templates/_topNav.php';?>

<div class="container-fluid">
	<div class="row">
 <?php require_once 'templates/_leftnav.php'; ?>  
    <div class="col-md-9">

<div class="panel panel-primary">
				<div class="panel-heading">
					
				</div>
				<div class="panel-body">

 <section class="contact" id="contact">
     
            <div class="row">
                <div class="col-md-12">
                    <h2>Contact Me<i class="fa fa-paper-plane-o"></i></h2>
                </div>
            </div>
             <div id ="panel">
      <input type="button" class="btn btn-danger btn-lg" value="Hide Overlay" onclick="overlay.toggle();"></input>
      <input type="button" class="btn btn-warning btn-lg" value="Show Overlay" onclick="overlay.toggleDOM();"></input>
    </div>
            <div id="map-canvas"></div>
            <div class="row">
                
                 <div class="col-md-12 ">
            <p class="alert alert-danger" id="eac-alert" style="display: none"></p>
            <p class="alert alert-success" id="eac-thanks" style="display: none"></p>
                </div>
            <form class="form form-horizontal " id="eac-form" method="post" >

              <div class="col-md-6">
                 
                   
                        <input type="text" name="name" class="form-control" required placeholder="Name (*)">
                  
                        <br>

              
                        <input type="email" name="email" class="form-control" required placeholder="Email (*)" >
               
                        <br>
                
                        <input type="text" name="subject" class="form-control" required placeholder="Subject (*)">

                        <br>
                        <input type="text" name="captcha" class="form-control" required placeholder="<?php echo $captcha[0].' '.$op.' '.$captcha[1]?>">
                        <br>
                
                </div>

                <div class="col-md-6">

                        <textarea name="message" class="form-control" rows="6" required placeholder="Message:"></textarea>
                        <br>
                        <button type="submit"  class="btn btn-success btn-lg">Send Message</button>
                 </div>

            

            </form>

        </div>
    </div>

 </div>
           
     
    </section>


		</div>
</div></div>

		<!-- end of col-md-9 -->
	</div>
	<!-- end of row -->
</div>
<!-- end of container fluid -->


<?php require_once 'templates/_footer.php'; ?>
    <!--Google Maps API-->
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAurMFy2fes-c8UujC3i8Dlv3-uNArTZ5M&amp;sensor=true"></script>
<script type="text/javascript">
// This example adds hide() and show() methods to a custom overlay's prototype.
// These methods toggle the visibility of the container <div>.
// Additionally, we add a toggleDOM() method, which attaches or detaches the
// overlay to or from the map.

var overlay;

USGSOverlay.prototype = new google.maps.OverlayView();

function initialize() {
  var myLatLng = new google.maps.LatLng(62.323907, -150.109291);
  var mapOptions = {
    zoom: 11,
    center: myLatLng,
   
  };

  var map = new google.maps.Map(document.getElementById('map-canvas'),
      mapOptions);

  var swBound = new google.maps.LatLng(62.281819, -150.287132);
  var neBound = new google.maps.LatLng(62.400471, -150.005608);
  var bounds = new google.maps.LatLngBounds(swBound, neBound);

  // The photograph is courtesy of the U.S. Geological Survey.
  var srcImage = 'https://developers.google.com/maps/documentation/javascript/';
  srcImage += 'examples/full/images/talkeetna.png';

  overlay = new USGSOverlay(bounds, srcImage, map);
}

/** @constructor */
function USGSOverlay(bounds, image, map) {

  // Now initialize all properties.
  this.bounds_ = bounds;
  this.image_ = image;
  this.map_ = map;

  // Define a property to hold the image's div. We'll
  // actually create this div upon receipt of the onAdd()
  // method so we'll leave it null for now.
  this.div_ = null;

  // Explicitly call setMap on this overlay
  this.setMap(map);
}

/**
 * onAdd is called when the map's panes are ready and the overlay has been
 * added to the map.
 */
USGSOverlay.prototype.onAdd = function() {

  var div = document.createElement('div');
  div.style.border = 'none';
  div.style.borderWidth = '0px';
  div.style.position = 'absolute';

  // Create the img element and attach it to the div.
  var img = document.createElement('img');
  img.src = this.image_;
  img.style.width = '100%';
  img.style.height = '100%';
  div.appendChild(img);

  this.div_ = div;

  // Add the element to the "overlayImage" pane.
  var panes = this.getPanes();
  panes.overlayImage.appendChild(this.div_);
};

USGSOverlay.prototype.draw = function() {

  // We use the south-west and north-east
  // coordinates of the overlay to peg it to the correct position and size.
  // To do this, we need to retrieve the projection from the overlay.
  var overlayProjection = this.getProjection();

  // Retrieve the south-west and north-east coordinates of this overlay
  // in LatLngs and convert them to pixel coordinates.
  // We'll use these coordinates to resize the div.
  var sw = overlayProjection.fromLatLngToDivPixel(this.bounds_.getSouthWest());
  var ne = overlayProjection.fromLatLngToDivPixel(this.bounds_.getNorthEast());

  // Resize the image's div to fit the indicated dimensions.
  var div = this.div_;
  div.style.left = sw.x + 'px';
  div.style.top = ne.y + 'px';
  div.style.width = (ne.x - sw.x) + 'px';
  div.style.height = (sw.y - ne.y) + 'px';
};

USGSOverlay.prototype.onRemove = function() {
  this.div_.parentNode.removeChild(this.div_);
};

// Set the visibility to 'hidden' or 'visible'.
USGSOverlay.prototype.hide = function() {
  if (this.div_) {
    // The visibility property must be a string enclosed in quotes.
    this.div_.style.visibility = 'hidden';
  }
};

USGSOverlay.prototype.show = function() {
  if (this.div_) {
    this.div_.style.visibility = 'visible';
  }
};

USGSOverlay.prototype.toggle = function() {
  if (this.div_) {
    if (this.div_.style.visibility == 'hidden') {
      this.show();
    } else {
      this.hide();
    }
  }
};

// Detach the map from the DOM via toggleDOM().
// Note that if we later reattach the map, it will be visible again,
// because the containing <div> is recreated in the overlay's onAdd() method.
USGSOverlay.prototype.toggleDOM = function() {
  if (this.getMap()) {
    // Note: setMap(null) calls OverlayView.onRemove()
    this.setMap(null);
  } else {
    this.setMap(this.map_);
  }
};

google.maps.event.addDomListener(window, 'load', initialize);
</script>
</body>
</html>