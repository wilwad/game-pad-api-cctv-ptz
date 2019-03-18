var request = require('request');
var gamepad = require("gamepad");

const onvif_server = 'http://localhost/ponvif/ponvif_server.php';

var PTZbusy = false;
var direction;

// Set the headers
var headers = {
    'User-Agent':       'Super Agent/0.0.1',
    'Content-Type':     'application/x-www-form-urlencoded'
}

// Initialize the library
gamepad.init()

// List the state of all currently attached devices
for (var i = 0, l = gamepad.numDevices(); i < l; i++) {
  console.log('JoyStick', i, gamepad.deviceAtIndex());
}

// Create a game loop and poll for events
setInterval(gamepad.processEvents, 16);
// Scan for new gamepads as a slower rate
setInterval(gamepad.detectDevices, 500);

// Listen for move events on all gamepads
gamepad.on("move", function (id, axis, value) {
  console.log("move", {
    id: id,
    axis: axis,
    value: value,
  });

  if (PTZbusy){
	console.log('Waiting for last PTZ move:', direction);
	return;
  }

  switch (parseInt(axis)){
	case 0:
	    if (value ==-1){
		direction = 'left';
  	        ipcamPTZ(direction)
	    }

	    if (value == 1){
                direction = 'right';
 	        ipcamPTZ(direction)
             }
	    break;


	case 1:
	    if (value ==-1){
		 direction = 'up';
                 ipcamPTZ(direction);
	    }

	    if (value == 1){
		 direction = 'down';
 	         ipcamPTZ(direction);
	    }
	    break;

	default:
	    console.log('Error: not expected direction:', num);
	    return;
  }
});

function ipcamPTZ(direction){
	// Configure the request
	var options = {
	    url: onvif_server,
	    method: 'GET',
	    headers: headers,
	    qs: {'url': '192.168.8.106:5000', 'move': direction}
	}

	PTZbusy = true;

	// Start the request
	request(options, function (error, response, body) {
	    console.log(body);
	    PTZbusy = false;

	    /*
	    if (!error && response.statusCode == 200) {
		// Print out the response body
		console.log(body)
	    }
	    */

	})
}

// Listen for button up events on all gamepads
gamepad.on("up", function (id, num) {
  console.log("up", {
    id: id,
    num: num,
  });
});


// Listen for button down events on all gamepads
gamepad.on("down", function (id, num) {
  console.log("down", {
    id: id,
    num: num,
  });
});
