<?php 
    session_start();
    include_once "config.php";
    
    
    if(isset($_COOKIE['outgoing_id']) && $_COOKIE['outgoing_id']!="1"  && $_SESSION['id']=='1' ){
        $incoming_msg_id = $_COOKIE['ingoing_id'].$_COOKIE['outgoing_id'];
    }
    else{
        $incoming_msg_id = $_COOKIE['ingoing_id'];
    }

    $outgoing_msg_id = $_SESSION['id'];
    
    $message_content = $_POST['message_content'];
    $query = "INSERT into messages(incoming_msg_id,outgoing_msg_id,message_content) values({$incoming_msg_id},{$outgoing_msg_id},'{$message_content}') ";


    if(isset($_POST['type']) && $_POST['type'] =="automatic"){

        $message_array = json_decode($message_content,true);
        $message_serialised = serialize($message_array);
        $query_1 = "INSERT into messages(incoming_msg_id,outgoing_msg_id,message_content,type) values({$incoming_msg_id},{$outgoing_msg_id},'{$message_serialised}','automatic') ";
        $result_1 = mysqli_query($conn,$query_1);
 
    }
    else{
            if(file_exists($_FILES['file_name']['tmp_name']) && is_uploaded_file($_FILES['file_name']['tmp_name'])){

            if(!empty($message_content))
            {
                $result = mysqli_query($conn,$query);
            }

            $image_name = $_FILES['file_name']['name'];
            $tmp_name = $_FILES['file_name']['tmp_name'];

            $file_explode = explode(".",$image_name);
            $file_extension = end($file_explode);


            $extensions = ['jpg','jpeg','png','docx','pdf','doc'];
            
            if(in_array($file_extension,$extensions)){
                $time = time();
                $new_img_name = $time.$image_name;
                move_uploaded_file($tmp_name,'images/'.$new_img_name);
    
                $message_content = $new_img_name;
                $query = "INSERT into messages(incoming_msg_id,outgoing_msg_id,message_content) values({$incoming_msg_id},{$outgoing_msg_id},'{$message_content}') ";
                $result = mysqli_query($conn,$query);
                echo $new_img_name;
                

            }
            else{
                echo "no success";
            }


            }
            else if(!empty($message_content))
            {
                $result = mysqli_query($conn,$query);
            }
        }
        


    
    
?>