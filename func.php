<?php

// Connessione al database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "biblioteca";

$conn = new mysqli($servername, $username, $password, $dbname)
or die("Connessione al database fallita: " . $conn->connect_error);


