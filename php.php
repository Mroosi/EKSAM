<?php
function connect_db(){
    global $connection;
    $host="localhost";
    $user="test";
    $pass="t3st3r123";
    $db="test";
    $connection = mysqli_connect($host, $user, $pass, $db) or die("ei saa ".mysqli_error());
        mysqli_query($connection, "SET CHARACTER SET UTF8") or die("Ei saa utf-8-sse - ".mysqli_error($connection));
}



function kontrolliIPd(){
    connect_db();
    global $connection;

    $ip=$_SERVER['REMOTE_ADDR'];

    $KasutajaIP = htmlspecialchars($ip);
    $IPsisse = mysqli_real_escape_string($connection, $KasutajaIP);
    $_SESSION["IP"] =  $IPsisse;
    
    $paring = "SELECT id FROM Mroosi_IP WHERE IP='$IPsisse'";
    $vastused = mysqli_query($connection, $paring);
    $rida = mysqli_num_rows($vastused);
    
    if($rida == 0){
            $pane = "INSERT INTO Mroosi_IP (`IP`) VALUES ('$IPsisse')";
            $Sisestus = mysqli_query($connection, $pane);
            $_SESSION["teade"] = "Sa pole seda lehte enne külastanud, tere tulemast";
        }else{
           $_SESSION["teade"] = "Hea, et tagasi oled";
        }
    
    $paringII = "SELECT IP FROM Mroosi_IP";
    $vastusedII = mysqli_query($connection, $paringII);
    $ridaII = mysqli_num_rows($vastusedII);
    $_SESSION["kylastused"] = $ridaII;
    
        mysqli_close($connection);
    }



require_once('lugeja.html');

?>