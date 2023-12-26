<?php

require_once __DIR__ . "/vendor/autoload.php";

use MongoDB\Client;

// Replace 'your_password' with the actual password for the 'admin' user
//$password = 'admin';

// Connection string for MongoDB Atlas
$uri = "mongodb://localhost:27017";

// Create a new client and connect to the server
$mongoClient = new Client($uri);

// Specify the name of the database
$databaseName = 'perpustakaan_db';

// Select the database
$database = $mongoClient->selectDatabase($databaseName);

return $database;

?>
