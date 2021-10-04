# WAiT


WAiT is a project that track the movement of wild animal at the application area, identify the animal class and report it on the webserver.

This repository contains following two applications:

# Wild Animal Tracker Firmware
This is the firmware source code that you need to compile and upload on sensor node using Arduino IDE. Before uploading this firmware please develop model using EdgeImpulse as the steps describe in this documentation and then download model as Arduino zip library, import the library and then compile this sketch.

# Wild Animal Tracker Web Application
To run this application, first install XAMPP server, create the database and the table and then copy paste this application folder to htdocs folder of web server. Before running update settings in DBController.php file and upload.php file as described in this documentation. Then execute the application in web browser.
