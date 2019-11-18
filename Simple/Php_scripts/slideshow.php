<?php

function getImages($eventId) {
    $conn=connect();
    $sql = "SELECT * FROM images, event where images.event_id = event.id and event.id = $eventId";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // output data of each row
        while ($row = $result->fetch_assoc()) {
            $images[] = array("caption" => $row["caption"], "src" => $row["src"], "id" => $row["id"]);
        }
    }
    
    
    $conn->close();
    return  $images;
}

?>