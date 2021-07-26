<?php 
    session_start();
    include_once "config.php";
    
    $outgoing_msg_id = $_SESSION['id'];
    $incoming_msg_id = $_COOKIE['ingoing_id'];

    $message_type = $_POST['type'];
    $message_content = $_POST['message_content'];

    $query = "INSERT into messages(incoming_msg_id,outgoing_msg_id,message_content) values({$incoming_msg_id},{$outgoing_msg_id},'{$message_content}') ";



    if($message_type =="automatic"){

        $message_array = json_decode($message_content,true);
        $message_serialised = serialize($message_array);
        $query_1 = "INSERT into messages(incoming_msg_id,outgoing_msg_id,message_content,type) values({$incoming_msg_id},{$outgoing_msg_id},'{$message_serialised}','automatic') ";
        $result_1 = mysqli_query($conn,$query_1);
 

    }
    else{
        if(!empty($message_content)){
            $result = mysqli_query($conn,$query);


            
        }
    }


?>