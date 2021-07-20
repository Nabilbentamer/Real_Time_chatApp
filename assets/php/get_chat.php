<?php
    session_start();
    include_once "config.php";
    
    $outgoing_msg_id = $_SESSION['id'];
    $incoming_msg_id = $_COOKIE['ingoing_id'];

    $query = "SELECT * FROM messages WHERE incoming_msg_id ='{$incoming_msg_id}' and outgoing_msg_id='{$outgoing_msg_id}' or incoming_msg_id ='{$outgoing_msg_id}' and outgoing_msg_id='{$incoming_msg_id}' order By msg_id ";
    $result = mysqli_query($conn,$query);

    $query1 = "SELECT * from users where id='{$incoming_msg_id}'";
    $result1 = mysqli_query($conn,$query1);
    $row1 = mysqli_fetch_assoc($result1);

    
    while($row = mysqli_fetch_assoc($result)){
        //echo $row["message_content"];

        if($row['outgoing_msg_id'] == $outgoing_msg_id){
            echo "<div class='chat outgoing'>
            <div class='details'>
                <p>".$row['message_content']."</p>
            </div>
        </div>";
        }
        else{
            echo "<div class='chat incoming'>
                    <img src='php/images/".$row1['image']."'>
                    <div class='details'>
                        <p>".$row['message_content']."</p>
                    </div>
                </div>";
            
        }
        

    }




?>