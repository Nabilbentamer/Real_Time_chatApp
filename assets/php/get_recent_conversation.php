<?php
    session_start();
    include_once "config.php";

    $current_user_id = $_SESSION['id'];

    if($current_user_id!="1"){


    $query = "SELECT * FROM users Where not id='{$current_user_id}'";
    $result = mysqli_query($conn,$query);
    
    while($row = mysqli_fetch_assoc($result)){

        $sql1 = "SELECT * FROM messages WHERE incoming_msg_id ='{$current_user_id}' and outgoing_msg_id='{$row['id']}' or incoming_msg_id ='{$row['id']}' and outgoing_msg_id='{$current_user_id}' order By msg_id DESC Limit 1 ";
        $result1 = mysqli_query($conn,$sql1);

        $row1 = mysqli_fetch_assoc($result1);

        if(mysqli_num_rows($result1)>0){
            $message = $row1['message_content'];
            if(strlen($message)>34){
                $message = substr($message,0,34);
            }
        }
        else{
            $message = "No message are available";
        }
        $you=null;

        if(isset($row1['outgoing_msg_id'])){
            if($row1['outgoing_msg_id']==$current_user_id){
                $you = "You :";
            }
            else{
                $you=$row['name']." :";
            }
            $messages[] = array("user_image"=>$row['image'],"user_id"=>$row['id'],"user_name"=>$row['name'],"you"=>$you,"message_content"=>$message,"msg_id"=>$row1['msg_id']);

        }

//        $messages[] = array("user_image"=>$row['image'],"user_id"=>$row['id'],"user_name"=>$row['name'],"you"=>$you,"message_content"=>$message,"msg_id"=>$row1['msg_id']);


    }

    array_multisort(array_column($messages, 'msg_id'), SORT_DESC, $messages);

    foreach($messages as $msg){
        echo "                  <header class='user-list'>
        <div class='content'>
            <img src='php/images/".$msg['user_image']."'>
            <input type='hidden' value='".$msg['user_id']."' name='ingoing_id'>
            
            <div class='details-user-message'>
                <span>".$msg['user_name']."</span>
                <i class='fas fa-circle center'></i>
                <div class='message'>                                
                    <p>".$msg['you'] .$msg['message_content']."</p>
                </div>
                
            </div>
        </div>
        </header>";
    }

}
else{
    $query = "SELECT * FROM users";
    $result = mysqli_query($conn,$query);
    
    while($row = mysqli_fetch_assoc($result)){

        $id =$row['id'];
        $next_query = "SELECT * from users where id >".$id." order by id Asc" ;
        $next_result = mysqli_query($conn,$next_query);

        while($row2 =mysqli_fetch_assoc($next_result) ){
            $next_id = $row2['id'];
            $sql1 = "SELECT * FROM messages WHERE  outgoing_msg_id='{$row['id']}' and incoming_msg_id ='{$next_id}'or outgoing_msg_id ='{$next_id}' and incoming_msg_id='{$row['id']}'  order By msg_id DESC Limit 1 ";
            $result1 = mysqli_query($conn,$sql1);
    
            $row1 = mysqli_fetch_assoc($result1);

            if(mysqli_num_rows($result1)>0){
                $message = $row1['message_content'];
                if(strlen($message)>34){
                    $message = substr($message,0,34);
                }
            }
            else{
                $message = "No message are available";
            }
            $you=null;
    
            if(isset($row1['outgoing_msg_id'])){
                if($row1['outgoing_msg_id']==$current_user_id){
                    $you = "You :";
                }
                else{
                    $you=$row['name']." :";
                }
                $messages[] = array("user_image_2"=>$row['image'],"user_image"=>$row2['image'],"user_id"=>$row2['id'],"user_name"=>$row2['name'],"you"=>$you,"message_content"=>$message,"msg_id"=>$row1['msg_id'],"user_name_2"=>$row['name'],"user_id_2"=>$row['id']);
    
            }
        }






    }

    if(!empty($messages)){

    
    array_multisort(array_column($messages, 'msg_id'), SORT_DESC, $messages);

    foreach($messages as $msg){
        
        
        if(str_contains($msg['message_content'],"commande_id") || str_contains($msg['message_content'],"product_id")){
            $msg['message_content']="<i class='fa fa-paperclip' style='margin-right:8px' aria-hidden='true'></i>Attachement";
        }
        $images = "<img src='php/images/".$msg['user_image']."'>";
        $between_names=" & ".$msg['user_name_2'];


        if($msg['user_id']=="1" || $msg['user_id_2']=="1"){
            $between_names="";
            
        }
        else{
            $images="<span class='avatar'>
            <img src='php/images/".$msg['user_image']."'>
            <img src='php/images/".$msg['user_image_2']."'>

            </span>";
        }
        echo "                  <header class='user-list' style='cursor:pointer'>
        <div class='content'>
            ".$images."
            <input type='hidden' value='".$msg['user_id']."' name='ingoing_id'>
            <input class='input_user' type='hidden' value='".$msg['user_id_2']."' name='outgoing_id'>
            <div class='details-user-message'>
                <span>".$msg['user_name'].$between_names."</span>
                <i class='fas fa-circle center'></i>
                <div class='message'>                                
                    <p>".$msg['you'] .$msg['message_content']."</p>
                </div>
            </div>
        </div>
        </header>";
    }
}
}

?>