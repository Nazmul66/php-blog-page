

<?php 

    $dbName     = "blog_page";
    $dbUser     = "root";
    $userPass   = "";
    $host       = "localhost";

    $db = mysqli_connect($host, $dbUser, $userPass, $dbName);

    if(!$db){
        die("mysql database not connected");
    }
 
?>