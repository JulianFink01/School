<?php

function getEvents() {
    $conn = connect();
    $sql = "SELECT * FROM event";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // output data of each row
        while ($row = $result->fetch_assoc()) {
            $events[] = array("id" => $row["id"], "name" => $row["name"], "datum" => $row["datum"], "location" => $row["location"], "thumbnail" => $row["thumbnail"]);
        }
    }

    $conn->close();
    return $events;
}

?>