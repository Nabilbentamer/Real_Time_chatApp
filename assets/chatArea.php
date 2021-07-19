<?php 
    session_start();
    include_once "php/config.php";
    if(!isset($_SESSION['id'])){
        header("location:login.php");
    }
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Chat Area</title>
    <link rel="stylesheet" href="css/chatarea.css">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" >
    
</head>
<body>

        <div class="users-container">
            <section class="users">
                <header class="user-details">
                    <?php
                        $user_id = $_SESSION['id'];
                        $query = "SELECT * FROM users where id ='{$user_id}' ";
                        $result = mysqli_query($conn,$query);
                        if(mysqli_num_rows($result)>0){
                            $row = mysqli_fetch_assoc($result);
                        }

                    ?>
                    <div class="content">
                        <img src="php/images/<?php echo $row['image'] ?>" alt="">
                        <div class="details">
                            <span><?php echo $row['name']. " " . $row['lastname']; ?> </span>
                            
                            <div class="status">
                                <i class="fas fa-circle"></i>
                                <p><?php echo $row['status'] ?> </p>
                            </div>
                            
                        </div>
                    </div>
                   <!---- <a href="#" class="logout">Logout</a> -->
                </header>

                <div class="search">
                    <input type="text" placeholder="enter a user to search">
                    <button><i class="fas fa-search"></i></button>
                </div>

                <div class="users-list">

                    <?php
                        $query1 = "SELECT * FROM users Where not id='{$user_id}'";
                        $result1 = mysqli_query($conn,$query1);
                        
                        while($row_new = mysqli_fetch_assoc($result1)){
    
                    ?>
                        
                <header class="user-list">
                    <div class="content">
                        <img src="php/images/<?php echo $row_new['image']?>" alt="">
                        <div class="details-user-message">
                            <span><?php  echo $row_new['name'] ?></span>
                            <i class="fas fa-circle center"></i>
                            <div class="message">                                
                                <p>No message are available now.</p>
                            </div>
                            
                        </div>
                    </div>
                </header>

                    <?php
                    }
                    ?>

                </div>
    
            </section>
        </div>

        <div class="users-container chatArea">
            <div class="recipient-details">
                <p>Message To : <span>EcoSpare Support</span> </p>
                <i class="fas fa-circle"></i>
            </div>

            <div class="chat-section">

                <div class="chat outgoing">
                    <div class="details">
                        <p>Hey, What's up?</p>
                    </div>
                </div>

                <div class="chat incoming">
                    <img src="images/image.jpg" alt="">
                    <div class="details">
                        <p>All is good. and you?</p>
                    </div>
                </div>
                <div class="typing-area">
                    <input type="text" placeholder="write a message to send">
                    <button> <i class="fab fa-telegram"></i></button>
                </div>
            </div>



        </div>

        <div class="user-profile">
            <img src="images/ecospare.png" alt="">
            <div class="location">
                <i class="fas fa-map-marker-alt"></i>
                <p>Rabat ,<span>Morocco</span></p>

            </div>
            

            <div class="bio">
                EcoSpare is a rising company based in France that offer a Marketplace where you can find usefull items for your needs.
            </div>

            <div class="contact_buttons">
                <button> Contacter à propos une commande </button>
                <button> Contacter à propos un produit </button>
                <button> Contacter un vendeur </button>

            </div>

        </div>

    

    <script src="js/users.js"></script>    

</body>
</html>