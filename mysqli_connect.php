<?php
try{
    DEFINE('HOSTNAME','localhost');
    DEFINE('USERNAME','root');
    DEFINE('DBPASS','');
    DEFINE('DBNAME','app-dev');

    $dbcon = new mysqli(HOSTNAME, USERNAME, DBPASS, DBNAME);
    //if connection fails
    if ($dbcon->connect_error) echo "Connection failed";
    //if connection is succesfull
    else echo "Connection sucefull";
}
//database exception
catch (mysqli_sql_exception $e){
    echo "Database Exception".$e->getMessage();

}
//general exception
catch (Exception $e){
    echo "General Exception".$e->getMessage();
}
