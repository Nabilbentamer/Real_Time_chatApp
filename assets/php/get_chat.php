<?php
    session_start();
    include_once "config.php";
    
    $outgoing_msg_id = $_SESSION['id'];
    $incoming_msg_id = $_COOKIE['ingoing_id'];

    $contact_type = $_COOKIE['type'];

    $query = "SELECT * FROM messages WHERE incoming_msg_id ='{$incoming_msg_id}' and outgoing_msg_id='{$outgoing_msg_id}' or incoming_msg_id ='{$outgoing_msg_id}' and outgoing_msg_id='{$incoming_msg_id}' order By msg_id ";
    $result = mysqli_query($conn,$query);

    $query1 = "SELECT * from users where id='{$incoming_msg_id}'";
    $result1 = mysqli_query($conn,$query1);
    $row1 = mysqli_fetch_assoc($result1);

    
    while($row = mysqli_fetch_assoc($result)){


        if($row['type']== "conversation")
        {
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
        else {


            $message_array = unserialize($row['message_content']);

            if(isset($contact_type)){

                if($contact_type=="produit"){

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

                    else{
                        echo "            <div class='chat outgoing commande_chat'>
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