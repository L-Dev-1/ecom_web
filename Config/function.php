<?php

session_start();

require 'dbcon.php';

function validate($inputData)
{
    global $conn;
    return mysqli_real_escape_string($conn, $inputData);
}
