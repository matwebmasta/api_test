
$(document).ready(function(){
  
  var x = $('textarea[name*=textarea_info]');

  $("button.startGeo").on('touchstart mousedown',function(){
    startGeo();
    
  });
  
  function startGeo(){
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(showPosition, showError);
    } else { 
        x.val("Geolocation is not supported by this browser.");

    }
    
  }
function showPosition(position) {
    x.val("Latitude: " + position.coords.latitude + 
    "\n Longitude: " + position.coords.longitude);
}

function showError(error) {
    switch(error.code) {
        case error.PERMISSION_DENIED:
            x.val("User denied the request for Geolocation.");
            break;
        case error.POSITION_UNAVAILABLE:
            x.val("Location information is unavailable.");
            break;
        case error.TIMEOUT:
            x.val("The request to get user location timed out.");
            break;
        case error.UNKNOWN_ERROR:
            x.val("An unknown error occurred.");
            break;
    }
}



});
