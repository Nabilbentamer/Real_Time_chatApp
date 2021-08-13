<?php
    session_start();
    include_once "config.php";

    $outgoing_msg_id = $_COOKIE['ingoing_id'];
    $incoming_msg_id = $_SESSION['id'];

    $query = "update messages set status='seen' where incoming_msg_id ='{$incoming_msg_id}' and outgoing_msg_id='{$outgoing_msg_id}'";
    $result = mysqli_query($conn,$query);

    while($row = mysqli_fetch_assoc($result)){

    }

    echo "it's working";

?>