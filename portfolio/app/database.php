<?php

    $db_server = "mysql";
    $db_user = "app";
    $db_pass = "secret";
    $db_name = "worksdb";
    $conn = "";

    $conn = mysqli_connect($db_server, $db_user, $db_pass, $db_name);

?>