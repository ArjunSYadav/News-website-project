<?php

    include "_db_pdo.php";

    $obj1 =new database();
    $obj1->select('category', "*", null, null, null, null);

    echo"<pre>";
    print_r($obj1->getResult());
    echo "</pre>";
?>