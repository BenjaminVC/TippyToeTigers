## Running the application:

### The following steps will tell you how to launch this application using Docker from the cli and within Docker Desktop.
<br>
<h5> 1. Launch a linux-based terminal and navigate your cwd to the top level of the TippyToeTigers directory <br>
<h5> 2. Run the following command: sudo docker build -t ttt/php . <br>
<h5> 3. Launch Docker Desktop and navigate to Images where you should see ttt/php under LOCAL <br> 
<h5> 4. Next to ttt/php, on the right hand side click Run and then click the drop-down arrow <br> 
<h5> 5. Fill in the following information: <br>
    <li> ports: 80 </li>
    <li> Host path: ./TippyToeTigers (or wherever you placed the TippyToeTigers folder)</li>
    <li> Container path: /var/www/html </li> <br>
<h5> 6. Finally, open your browser and enter the following URL: http://localhost/source/homePage.php
