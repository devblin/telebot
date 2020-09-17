<?php
require_once __DIR__ . "/setup/connection.php";
require_once __DIR__ . "/setup/autoload.php";
function opData($sql0, $bindtyp, $bindval)
{
    global $conn;
    $sql = $sql0;
    $stmt = $conn->stmt_init();
    $stmt->prepare($sql);
    $stmt->bind_param($bindtyp, ...$bindval);
    $stmt->execute();
}

function getArray($sql0, $bindtyp, $bindval)
{
    global $conn;
    $sql = $sql0;
    $stmt = $conn->stmt_init();
    $stmt->prepare($sql);
    $stmt->bind_param($bindtyp, ...$bindval);
    $stmt->execute();
    $result = $stmt->get_result();
    $data = array();
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            array_push($data, $row);
        }
        return $data;
    } else {
        return null;
    }
}
function getData($sql0, $bindtyp, $bindval, $out)
{
    global $conn;
    $sql = $sql0;
    $stmt = $conn->stmt_init();
    $stmt->prepare($sql);
    $stmt->bind_param($bindtyp, ...$bindval);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    if ($result->num_rows > 0) {
        return $row[$out];
    } else {
        return 0;
    }
}
function checkData($sql, $bindtyp, $bindval)
{
    global $conn;
    $stmt = $conn->stmt_init();
    $stmt->prepare($sql);
    $stmt->bind_param($bindtyp, ...$bindval);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result->num_rows;
}