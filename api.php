<?php
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $link = new mysqli('localhost', 'root', 'mysql', 'open');
    if ($link->connect_errno) {
        die("Failed to connect to MySQL: " . $link->connect_error);
    }

    $sql = "SELECT * FROM `members`";
    $res = $link->query($sql);

    if ($res === false) {
        http_response_code(404);
        die($link->error);
    }

    $allRecords = array();
    while ($record = $res->fetch_assoc()) {
        $allRecords[] = $record;
    }

    header('Content-Type: application/json');
    echo json_encode($allRecords);
    $link->close();
} else {
    http_response_code(404);
    die('Bad request');
}
