<?php
    session_start();
    include_once "config.php";

    $current_user_id = $_SESSION['id'];
    $user_status = $_SESSION['status'];



    $sql_message_number_new = "SELECT count(case when status ='not_seen' then 1 else null end) as MessageCount FROM messages where incoming_msg_id ='{$current_user_id}'";
    $result_message_number_new = mysqli_query($conn,$sql_message_number_new);
    $row_message_number_new = mysqli_fetch_assoc($result_message_number_new);

    $total_unread_messages =$row_message_number_new['MessageCount'];

    // if the user is not an admin 
    if($current_user_id!="1"){


    $query = "SELECT * FROM users Where not id='{$current_user_id}'";
    $result = mysqli_query($conn,$query);
    
    while($row = mysqli_fetch_assoc($result)){

        $sql1 = "SELECT * FROM messages WHERE incoming_msg_id ='{$current_user_id}' and outgoing_msg_id='{$row['id']}' or incoming_msg_id ='{$row['id']}' and outgoing_msg_id='{$current_user_id}' order By msg_id DESC Limit 1 ";
        $result1 = mysqli_query($conn,$sql1);
        $row1 = mysqli_fetch_assoc($result1);

        $sql_message_number = "SELECT count(case when status ='not_seen' then 1 else null end) as MessageCount FROM messages where incoming_msg_id ='{$current_user_id}' and outgoing_msg_id='{$row['id']}'";
        $result_message_number = mysqli_query($conn,$sql_message_number);
        $row_message_number = mysqli_fetch_assoc($result_message_number);

        if(mysqli_num_rows($result1)>0){
            $message = $row1['message_content'];
            $match_found = false;
            $attachements = ["commande_id","product_id","jpg","jpeg","png","docx","doc","pdf"];
            foreach($attachements as $attach){
                if(strpos($message,$attach)!== FALSE){
                    $message="<i class='fa fa-paperclip' style='margin-right:8px' aria-hidden='true'></i>Attachement";
                    $match_found=true;
                }
            }
            if(strlen($message)>26 && $match_found==false){
                $message = substr($message,0,26);
            }
        }
        else{
            $message = "No message are available";
        }
        
        $you=null;
        $message_number=null;
        if(isset($row1['outgoing_msg_id'])){
            if($row1['outgoing_msg_id']==$current_user_id){
                $you = "You :";
            }
            else{
                $you=$row['name']." :";
                $message_number = $row_message_number['MessageCount'];
            }
            $messages[] = array("user_image"=>$row['image'],"user_id"=>$row['id'],"user_name"=>$row['name'],
            "you"=>$you,"message_content"=>$message,"msg_id"=>$row1['msg_id'],"message_number"=>$message_number);

        }

    }

    array_multisort(array_column($messages, 'msg_id'), SORT_DESC, $messages);

    foreach($messages as $msg){
        $style='';
        if($msg['message_number']=='0'){
            $msg['message_number']='';
        }
        elseif($msg['message_number']>0){
            $style=" style='font-weight:bold;' ";
        }

        echo "                  <header class='user-list' onclick='update_message_status(this)'>
        <div class='content'>
            <img src='php/images/".$msg['user_image']."'>
            <input type='hidden' value='".$msg['user_id']."' name='ingoing_id'>
            <input id='message_num' type='hidden' value='".$total_unread_messages."'>
            <div class='details-user-message'>
                <span ".$style." >".$msg['user_name']."</span>
                <i class='fas fa-circle center'></i>
                <div class='message'>                                
                    <p ".$style.">".$msg['you'] .$msg['message_content']."</p>
                </div>
                
            </div>

            <span class='message_number' style='margin-left:70px; margin-top:auto;
            color:white;background:green;border-radius:50%;padding:0 5px;font-size:14px'>
            ".$msg['message_number']."</span>
        </div>
        </header>";
    }

}
// if the user is an admin
else{

    $query = "SELECT * FROM users";
    $result = mysqli_query($conn,$query);
    
    while($row = mysqli_fetch_assoc($result)){

        $sql_message_number = "SELECT count(case when status ='not_seen' then 1 else null end) as MessageCount FROM messages where incoming_msg_id ='{$current_user_id}' and outgoing_msg_id='{$row['id']}'";
        $result_message_number = mysqli_query($conn,$sql_message_number);
        $row_message_number = mysqli_fetch_assoc($result_message_number);


        $next_query = "SELECT * from users where id > '{$row['id']}' order by id" ;
        $next_result = mysqli_query($conn,$next_query);
        
        while($row2 =mysqli_fetch_assoc($next_result) ){            

            $combined_msg_id= $row2['id'].$row['id'];
            $inverse_combined_msg_id=$row['id'].$row2['id'];
            $sql1 = "SELECT * FROM messages WHERE  outgoing_msg_id='{$row['id']}' and incoming_msg_id ='{$row2['id']}'or outgoing_msg_id ='{$row2['id']}' and incoming_msg_id='{$row['id']}' or incoming_msg_id='{$combined_msg_id}' or incoming_msg_id='{$inverse_combined_msg_id}'  order By msg_id DESC Limit 1 ";
            $result1 = mysqli_query($conn,$sql1);            
            $row1 = mysqli_fetch_assoc($result1);
            
            if(mysqli_num_rows($result1)>0){

                $message = $row1['message_content'];
                $match_found = false;
                $attachements = ["commande_id","product_id","jpg","jpeg","png","docx","doc","pdf"];
                foreach($attachements as $attach){
                    if(strpos($message,$attach)!== FALSE){
                        $message="<i class='fa fa-paperclip' style='margin-right:8px' aria-hidden='true'></i>Attachement";
                        $match_found=true;
                    }
                }
                if(strlen($message)>26 && $match_found==false){
                    $message = substr($message,0,26);
                }

            }

            $you=null;
            $message_number=null;
            if(isset($row1['outgoing_msg_id'])){
                if($row1['outgoing_msg_id']== $current_user_id){
                    $you = "You :";
                }
                else{
                    $you=$row2['name']." :";
                    $message_number = $row_message_number['MessageCount'];

                }

                $messages[] = array("user_image_2"=>$row['image'],"user_image"=>$row2['image'],
                "user_id"=>$row2['id'],"user_name"=>$row2['name'],"you"=>$you,"message_content"=>$message,
                "msg_id"=>$row1['msg_id'],"user_name_2"=>$row['name'],"user_id_2"=>$row['id'],"message_number"=>$message_number);
    
            }
        }






    }

    if(!empty($messages)){

    // sort the messages array by msg_id so we can display them by the recent messages
    array_multisort(array_column($messages, 'msg_id'),SORT_DESC, $messages);

    foreach($messages as $msg){
        // if the messages is automatic and has an attachement like commande or product

        $style='';
        if($msg['message_number']=='0'){
            $msg['message_number']='';
        }
        elseif($msg['message_number']>0){
            $style=" style='font-weight:bold;' ";
        }

        $images = "<img src='php/images/".$msg['user_image']."'>";
        $between_names=" & ".$msg['user_name_2'];

        // if the conversation has only 2 members and admin is part of it, no need to add the admin name
        if($msg['user_id']=="1" || $msg['user_id_2']=="1"){
            $between_names="";
            
        }
        // if the conversation has 3 members: show 2 images of the members
        else{
            $images="<span class='avatar'>
            <img src='php/images/".$msg['user_image']."'>
            <img src='php/images/".$msg['user_image_2']."'>

            </span>";
        }

        echo "<header class='user-list' style='cursor:pointer'>
        <div class='content'>
            ".$images."
            <input type='hidden' value='".$msg['user_id']."' name='ingoing_id'>
            <input class='input_user' type='hidden' value='".$msg['user_id_2']."' name='outgoing_id'>
            <input id='message_num' type='hidden' value='0'>
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