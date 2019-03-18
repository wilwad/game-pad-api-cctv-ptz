# Controlling an ONVIF PTZ CCTV Camera
I used to control my PTZ cameras using the keyboard keys (up, down, left & right)

But now I can do that using any cheap USB game controller and the Gamepad API.

The Gamepad API is available in HTML5. It is also available for NodeJS - the project(https://github.com/creationix/node-gamepad).

What I am doing is creating a request to send direction parameters (up, down, left, right) to a PHP handler that in turn sends the relevant commands to the CCTV PTZ indoor IP camera using a PHP ONVIF library (https://github.com/ltoscano/ponvif).

# installing the gamepad api to your Linux system
```
npm install gamepad
```
# the ONVIF PTZ controller in PHP
You should copy ponvif directory to your webserver. 
Check the lib folder therein, so you can supply the login details for your ip camera if needed. 

I added a super simple handler that uses the ONVIF library (ponvif_server.php) which takes two parameters, namely:
```
url - the PTZ control URL of the CCTV camera
move - left, right, up, down
```
The basic request looks like this & you can test it with curl by subsituting the control URL of course
```
curl 'http://localhost/_your_path_/lib/ponvif/ponvif_server.php?url=192.168.8.106:5000&move=left'
```
# running the code
```
node joystick.js
```
Press any keys on your joystick (axes, buttons and you should get feedback in the console). 
Check out the rest of the code inside joystick.js.

![my generic USB game controller](https://github.com/wilwad/game-pad-api-cctv-ptz/blob/master/ipcam-gameapi.jpeg)
