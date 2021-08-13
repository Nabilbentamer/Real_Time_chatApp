<?php
    session_start();
    include_once "config.php";

    if($_SESSION['id']=="1"){
            
        if(isset($_COOKIE['ingoing_id'])){

            $first_user = $_COOKIE['ingoing_id'];

            $second_user=null;
            if(isset($_COOKIE['outgoing_id']) && $_COOKIE['outgoing_id']!="1" ){
                $second_user = $_COOKIE['outgoing_id'];
                }
                
                $query_users = "SELECT * FROM users where id ='{$first_user}' or id ='{$second_user}'";
                $result_users = mysqli_query($conn,$query_users);
                while($row_users = mysqli_fetch_assoc($result_users)){

                    echo '
                    <img src="php/images/'.$row_users["image"].'" alt="">
                    <div class="location">
                        <p>'.$row_users["name"] . '<span> ' .$row_users["lastname"].'</span></p>
        
                    </div>
        
                    <div class="bio" style="margin-bottom:10px">
                    <i class="fas fa-envelope"></i> '.$row_users["email"].'
                    </div> ';


                }
            }
        }
        else{
            echo "notadmin";
        }
        ?>
                    
                    

                     

