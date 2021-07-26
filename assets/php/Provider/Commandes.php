<?php 

    $commande_id = $_POST['commande_id'];

    $commande_list[] = array("commande_id"=>"1","commande_name"=>"siemens","commande_image"=>"img1.jpg","commande_montant"=>"200","commande_date"=>"2021-02-14","commande_vendeur_id"=>"1184081459","commande_qte"=>"2", "commande_acheteur_id"=>"1131926058");
    $commande_list[] = array("commande_id"=>"2","commande_name"=>"siemens","commande_image"=>"img1.jpg","commande_montant"=>"5540","commande_date"=>"2021-04-18","commande_vendeur_id"=>"1184081459","commande_qte"=>"1","commande_acheteur_id"=>"1131926058" );
    $commande_list[] = array("commande_id"=>"3","commande_name"=>"siemens","commande_image"=>"img2.jpg","commande_montant"=>"1200","commande_date"=>"2021-04-02","commande_vendeur_id"=>"1343900828","commande_qte"=>"3","commande_acheteur_id"=>"1131926058" );
    $commande_list[] = array("commande_id"=>"4","commande_name"=>"siemens","commande_image"=>"img2.jpg","commande_montant"=>"480","commande_date"=>"2021-06-12","commande_vendeur_id"=>"1343900828","commande_qte"=>"4", "commande_acheteur_id"=>"1625648741");
    $commande_list[] = array("commande_id"=>"5","commande_name"=>"siemens","commande_image"=>"img2.jpg","commande_montant"=>"180","commande_date"=>"2021-04-25","commande_vendeur_id"=>"1459242294","commande_qte"=>"1", "commande_acheteur_id"=>"1625648741");
    $commande_list[] = array("commande_id"=>"6","commande_name"=>"siemens","commande_image"=>"img2.jpg","commande_montant"=>"345","commande_date"=>"2021-06-18","commande_vendeur_id"=>"1459242294","commande_qte"=>"1", "commande_acheteur_id"=>"1625648741");


    foreach($commande_list as $commande){

        if($commande["commande_id"]== $commande_id){
            echo json_encode($commande);
        }

        
    
    }
?>