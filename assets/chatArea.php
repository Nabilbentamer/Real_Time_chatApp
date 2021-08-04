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
                        <div class="test">
                <header class="user-list">
                    <div class="content">
                        <img src="images/ecospare.png" alt="">
                        <input type="hidden" value="1" name="ingoing_id">
                        <div class="details-user-message">
                            <span>EcoSpare Support</span>
                            <i class="fas fa-circle center"></i>
                            <div class="message">                                
                                <p>Do you have any questions? let's chat!</p>
                            </div>
                            
                        </div>
                    </div>
                    </header>
                    </div>
                    <?php
                        /*$query1 = "SELECT * FROM users Where not id='{$user_id}'";
                        $result1 = mysqli_query($conn,$query1);
                        
                        while($row_new = mysqli_fetch_assoc($result1)){}*/
    
                    ?>
                    <div class="recent_conversations">
                        <header class='user-list'>
        <div class='content'>

            <div class="avatars">
                <span class="avatar">
                <img src='php/images/img1.jpg'>
                <img src='php/images/img2.jpg'>

                </span>
            </div>

            <div class='details-user-message'>
                <span>Admin and jane</span>
                <i class='fas fa-circle center'></i>
                <div class='message'>                                
                    <p>this is a test message</p>
                </div>
            </div>
        </div>
        </header>
                    </div>
                    <!--
                    <header class="user-list">
                    <div class="content">

                        <img src="php/images/<?php echo $row_new['image']?>" alt="">
                        <input type="hidden" value="<?php echo $row_new['id']?>" name="ingoing_id">
                        
                        <div class="details-user-message">
                            <span><?php  echo $row_new['name'] ?></span>
                            <i class="fas fa-circle center"></i>
                            <div class="message">                                
                                <p>No message are available now.</p>
                            </div>
                            
                        </div>
                    </div>
                    </header>

                    !-->

                </div>
    
            </section>
        </div>

        <div class="users-container chatArea">
            <div class="recipient-details">
                <p>Message To : <span>EcoSpare Support</span> </p>
                <i class="fas fa-circle"></i>
            </div>

            <div class="chat-section">
                
            <div class="chatbox">

            </div>

                    <form method="POST" action="#" autocomplete="off">
                        <div class="typing-area">
                            <input type="file" size="60" hidden id="file_image"/>
                            <button for="fileimage"><i class="fas fa-link"></i></button>
                            <input id="typing_input" type="text" placeholder="write a message to send" name="message_content">
                            <button type="submit"><i class="fab fa-telegram"></i> </button>
                        </div>
                    </form>

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
                <?php 
                    if($row['type']=="vendeur"){

                    
                ?>
                
                <button id="commande_contact_acheteur"> Contacter acheteur </button>
                <button id="admin_contact"> Contacter Administration </button>
                <?php
                }
                else{

                
                ?>        
                <button> Contacter à propos une commande </button>
                <button> Contacter à propos un produit </button>
                <button> Contacter un vendeur </button>
                <?php
                }
                ?>
            </div>

        </div>

    

    <script src="js/users.js"></script>    

</body>
</html>