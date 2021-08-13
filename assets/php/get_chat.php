<?php
    session_start();
    include_once "config.php";
    
    if($_SESSION['id']=='1' && isset($_COOKIE['outgoing_id'])){
        $outgoing_msg_id =$_COOKIE['outgoing_id']; 
    }
    else{
        $outgoing_msg_id = $_SESSION['id'];
    }
    
    if(isset($_COOKIE['ingoing_id'])){
        $incoming_msg_id = $_COOKIE['ingoing_id'];

    

    $combined_msg_id = $outgoing_msg_id.$incoming_msg_id;
    $inverse_msg_id = $incoming_msg_id.$outgoing_msg_id;

    $query = "SELECT * FROM messages WHERE incoming_msg_id ='{$incoming_msg_id}' and outgoing_msg_id='{$outgoing_msg_id}' or incoming_msg_id ='{$outgoing_msg_id}' and outgoing_msg_id='{$incoming_msg_id}' or incoming_msg_id ='{$combined_msg_id}' and outgoing_msg_id=1 or incoming_msg_id ='{$inverse_msg_id}' and outgoing_msg_id=1  order By msg_id ";
    $result = mysqli_query($conn,$query);

    $query1 = "SELECT * from users where id='{$incoming_msg_id}'";
    $result1 = mysqli_query($conn,$query1);
    $row1 = mysqli_fetch_assoc($result1);

    $query2 = "SELECT * from users where id='{$outgoing_msg_id}'";
    $result2 = mysqli_query($conn,$query2);
    $row2 = mysqli_fetch_assoc($result2);

    $query_admin = "SELECT * from users where id=1";
    $result_admin = mysqli_query($conn,$query_admin);
    $row_admin = mysqli_fetch_assoc($result_admin);


    while($row = mysqli_fetch_assoc($result)){

        
        if($row['type'] == "conversation")
        {

            // check message type (image or doc). if none display text!
            $message_expode = explode(".",$row['message_content']);
            $file_extension = end($message_expode);
            $image_extensions = ['jpg','png','jpeg'];
            $doc_extensions = ['pdf','docx','doc'];
            
            if(in_array($file_extension,$image_extensions)){
                $row['message_content']="<img src='php/images/".$row['message_content']."' style='height:150px;
                width: 150px;
                border-radius: 100%;
                object-fit: cover;'>";
            }
            else if(in_array($file_extension,$doc_extensions)){
                $row['message_content']="<a href='php/images/".$row['message_content']."'download style='color:grey'>file.".$file_extension."</a>";

            }

            /*-------------------check message type (image or doc). if none display text! -------------------------*/ 

            
            if($row['outgoing_msg_id'] == $outgoing_msg_id){
                echo "<div class='chat outgoing'>
                <div class='details'>
                    <p>".$row['message_content']."</p>
                    
                </div>
                <img src='php/images/".$row2['image']."'>
            </div>";
            }

            else if( $row['incoming_msg_id']== $combined_msg_id ||  $row['incoming_msg_id']==$inverse_msg_id){
               
                echo "<div class='chat incoming'>
                        <img src='php/images/".$row_admin['image']."'>
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
        else if($row['type']== "automatic") {

                $message_array = unserialize($row['message_content']);

                
                    if(isset($message_array['product_id'])){
    
                        if($row1['type']=='acheteur'){
                            $url_type=$message_array['product_url_fiche'];
                        }
                        else{
                            $url_type=$message_array['product_url_edition'];
                        }
                        echo "<div class='chat outgoing'>
                                <div class='details'>
                                    <p>Des infos sur ce produit </p>
                                    <a href='".$url_type."'><img src='php/images/".$message_array['product_image']."' style='height:120px;width:120px'></a>
                                </div>
                            </div>";
                        }
    
                        else if(isset($message_array['commande_id'])){

                            echo "<div class='chat outgoing commande_chat'>
                                    <div class='details'>
                                        <span>Commande N: ".$message_array['commande_id']."</span></br>
                                        <span>Date :".$message_array['commande_date']."</span>
            
                                        <div class='side_bar_details'>
                                            <img src='php/images/".$message_array['commande_image']."' style='height:120px;width:120px'>
                                            <div class='commande-details'>
                                                <span>Montant: ".$message_array['commande_montant']."$</span></br>
                                                <span>Quantité: ".$message_array['commande_qte']."</span>
                                            </div>
                                        </div>
                                    </div>
                        </div>";                
                        }                
        }
        

    }

    }


?>