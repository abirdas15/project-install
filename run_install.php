<?php

define('GENIUSOCEAN', 'https://geniusocean.com/verify/');
ini_set('max_execution_time', 300);

if (!isset($_POST['database_host']) || $_POST['database_host'] == "") {
    echo "Please Enter Database Host";
} else if (!isset($_POST['database_name']) || $_POST['database_name'] == "") {
    echo "Please Enter Database Name";
} else if (!isset($_POST['database_username']) || $_POST['database_username'] == "") {
    echo "Please Enter Database Username";
} else {
    //if (isset($_POST['p_code']) && $_POST['p_code'] != ""){
    // Name of the file
    $filename = 'database/database.sql';
    // MySQL host
    $mysql_host = $_POST['database_host'];
    // MySQL username
    $mysql_username = $_POST['database_username'];
    // MySQL password
    $mysql_password = $_POST['database_password'];
    // Database name
    $mysql_database = $_POST['database_name'];
    //restoreDatabaseTables($mysql_host, $mysql_username, $mysql_password, $mysql_database);
    setEnvironmentValue($mysql_host, $mysql_database, $mysql_username, $mysql_password);
//    setEnvironmentValue('DB_DATABASE', 'database_name', $mysql_database);
//    setEnvironmentValue('DB_USERNAME', 'database_user', $mysql_username);
//    setEnvironmentValue('DB_PASSWORD', 'database_pass', $mysql_password);
//    setUp($p1, $p3, $dtmr);
    echo "success";
}

function setEnvironmentValue($dbHost, $dbDatabase, $dbUsername, $dbPassword) {
    error_reporting(0);
    $ctFile = '../project/.env';
    $str = file_get_contents($ctFile);
    $str = str_replace(_HostName_, $dbHost, $str);
    $str = str_replace(_Database_, $dbDatabase, $str);
    $str = str_replace(_UserName_, $dbUsername, $str);
    $str = str_replace(_Password_, $dbPassword, $str);
    $fp = fopen($ctFile, 'w');
    fwrite($fp, $str);
}

function restoreDatabaseTables($dbHost, $dbUsername, $dbPassword, $dbName) {
    // Create connection
    $conn = new mysqli($dbHost, $dbUsername, $dbPassword);
// Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

// Create database
    $sql = "CREATE DATABASE $dbName";
    if ($conn->query($sql) === TRUE) {
        echo "Database created successfully";
    } else {
        echo "Error creating database: " . $conn->error;
    }
    $conn->close();
}
