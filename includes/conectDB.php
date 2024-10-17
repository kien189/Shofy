<?php 

function conectDB()  {
    $serverName = "localhost";
    $userName = "root";
    $password = "";
    $myDB = "du_an_1";

    try {
        $conn = new PDO("mysql:host=$serverName;dbname=$myDB", $userName, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $conn;
    } catch (\Throwable $th) {
        echo "Connection failed: " . $th->getMessage();
        return null;
    }

    
}

