<?php

    $maildb = array(
        "hostname" => "203.159.94.111",
        "username" => "p0ndja",
        "password" => "P0ndJ@1103",
        "table" => "p0ndja"
    );

    $mailsender = array(
        "name"=>"Grader.ga",
        "email"=>"p0ndja.dev@gmail.com",
        "password"=>"nlertkybrcvwvssg"
    );
    $mailsenderData = json_encode($mailsender);

    global $mailconn;
    $mailconn = new mysqli($maildb["hostname"], $maildb["username"], $maildb["password"], $maildb["table"]);
    mysqli_set_charset($mailconn, 'utf8mb4');

    if(!$mailconn)
        die('Cannot established connection with database: ' . mysqli_connect_error());
    
    date_default_timezone_set('Asia/Bangkok');

?>