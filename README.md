# Controlling an ONVIF PTZ CCTV Camera
I used to control my PTZ cameras using the keyboard keys (up, down, left & right)
But now I can do that using any cheap USB game controller

The Gamepad API is available in HTML5. It is also available for NodeJS - the project(https://github.com/creationix/node-gamepad).

What I am doing is creating a request to send direction parameters (up, down, left, right) a PHP handler that in turn sends the relevant commands to the CCTV PTZ indoor IP camera using a PHP ONVIF library (https://github.com/ltoscano/ponvif).

# installing the gamepad api to your Linux system
```
npm install gamepad
```
# running the code
```
node joystick.js
```
Check out the rest of the code inside joystick.js.
