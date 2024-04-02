<?php

// variablen 
const SERVERNAME = "localhost";
const USERNAME = "root";
const PASSWORD = "";
const DBNAME = "gojoshop";


// connecting to database
$con = mysqli_connect(SERVERNAME, USERNAME, '', DBNAME);

//connection check
if (mysqli_connect_errno())  {
    echo "Failed to connect";
    exit();
}
