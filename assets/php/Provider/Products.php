<?php 

    $product_id = $_POST['product_id'];

    $product_list[] = array("product_id"=>"1","product_name"=>"siemens","product_image"=>"img1.jpg","product_url_edition"=>"produit_edition.php","product_url_fiche"=>"produit_fiche.php","product_vendeur_id"=>"1459242294");
    $product_list[] = array("product_id"=>"2","product_name"=>"siemens","product_image"=>"img1.jpg","product_url_edition"=>"produit_edition.php","product_url_fiche"=>"produit_fiche.php","product_vendeur_id"=>"1459242294");
    $product_list[] = array("product_id"=>"3","product_name"=>"siemens","product_image"=>"img2.jpg","product_url_edition"=>"produit_edition.php","product_url_fiche"=>"produit_fiche.php","product_vendeur_id"=>"1184081459");
    $product_list[] = array("product_id"=>"4","product_name"=>"siemens","product_image"=>"img2.jpg","product_url_edition"=>"produit_edition.php","product_url_fiche"=>"produit_fiche.php","product_vendeur_id"=>"1184081459");
    $product_list[] = array("product_id"=>"5","product_name"=>"siemens","product_image"=>"img2.jpg","product_url_edition"=>"produit_edition.php","product_url_fiche"=>"produit_fiche.php","product_vendeur_id"=>"1343900828");
    $product_list[] = array("product_id"=>"6","product_name"=>"siemens","product_image"=>"img2.jpg","product_url_edition"=>"produit_edition.php","product_url_fiche"=>"produit_fiche.php","product_vendeur_id"=>"1343900828");


    foreach($product_list as $product){

        if($product["product_id"]== $product_id){
            echo json_encode($product);
        }

        
    
    }
?>