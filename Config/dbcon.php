<?php

define('DB_SERVER', "localhost");
define('DB_USERNAME', "root");
define('DB_PASSWORD', "");
define('DB_DATABASE', "aga_db");

// natt
// define('DB_PASSWORD', "root");
// define('DB_DATABASE', "db_aga");

$conn = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
