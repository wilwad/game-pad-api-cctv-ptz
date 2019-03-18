# game-pad-api-cctv-ptz
Controlling a PTZ CCTV camera using a USB game controller

The Gamepad API is available in HTML5. It is also available for NodeJS.

Here I am using a NodeJS, request to send directions (up, down, left, right) as parameters to a PHP handler that in turn sends the relevant commands to the CCTV PTZ indoor IP camera.

# installing the gamepad api to your Linux system
```
npm install gamepad
```
# running the code
```
node joystick.js
```
The code is inside joystick.js
