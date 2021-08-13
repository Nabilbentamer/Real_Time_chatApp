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


    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
	<script>
		$(document).ready(function(){
			$(".profile .icon_wrap").click(function(){
			  $(this).parent().toggleClass("active");
			  $(".notifications").removeClass("active");
			});

			$(".notifications .icon_wrap").click(function(){
			  $(this).parent().toggleClass("active");
			   $(".profile").removeClass("active");
			});

			$(".show_all .link").click(function(){
			  $(".notifications").removeClass("active");
			  $(".popup").show();
			});

			$(".close").click(function(){
			  $(".popup").hide();
			});
		});
	</script>
</head>
<body>
<?php
                        $user_id = $_SESSION['id'];
                        $query = "SELECT * FROM users where id ='{$user_id}' ";
                        $result = mysqli_query($conn,$query);
                        if(mysqli_num_rows($result)>0){
                            $row = mysqli_fetch_assoc($result);
                        }

                    ?>
<div class="wrapper">
  <div class="navbar">
    <div class="navbar_left">
      <div class="logo">
        <a href="#">Spare World</a>
      </div>
    </div>

    <div class="navbar_right">
      <div class="notifications">
        <div class="icon_wrap">
            <i class="far fa-envelope"></i>
            <span class="badge" id="MessageCount"></span>
        </div>
        
        <div style="z-index: 100" class="notification_dd">
            <ul class="notification_ul">
                <li class="starbucks success">
                    <div class="notify_icon">
                        <span class="icon"></span>  
                    </div>
                    <div class="notify_data">
                        <div class="title">
                            Lorem, ipsum dolor.  
                        </div>
                        <div class="sub_title">
                          Lorem ipsum dolor sit amet consectetur.
                      </div>
                    </div>
                    <div class="notify_status">
                        <p>Success</p>  
                    </div>
                </li>  
                <li class="baskin_robbins failed">
                    <div class="notify_icon">
                        <span class="icon"></span>  
                    </div>
                    <div class="notify_data">
                        <div class="title">
                            Lorem, ipsum dolor.  
                        </div>
                        <div class="sub_title">
                          Lorem ipsum dolor sit amet consectetur.
                      </div>
                    </div>
                    <div class="notify_status">
                        <p>Failed</p>  
                    </div>
                </li> 
                <li class="mcd success">
                    <div class="notify_icon">
                        <span class="icon"></span>  
                    </div>
                    <div class="notify_data">
                        <div class="title">
                            Lorem, ipsum dolor.  
                        </div>
                        <div class="sub_title">
                          Lorem ipsum dolor sit amet consectetur.
                      </div>
                    </div>
                    <div class="notify_status">
                        <p>Success</p>  
                    </div>
                </li>  
                <li class="pizzahut failed">
                    <div class="notify_icon">
                        <span class="icon"></span>  
                    </div>
                    <div class="notify_data">
                        <div class="title">
                            Lorem, ipsum dolor.  
                        </div>
                        <div class="sub_title">
                          Lorem ipsum dolor sit amet consectetur.
                      </div>
                    </div>
                    <div class="notify_status">
                        <p>Failed</p>  
                    </div>
                </li> 
                <li class="kfc success">
                    <div class="notify_icon">
                        <span class="icon"></span>  
                    </div>
                    <div class="notify_data">
                        <div class="title">
                            Lorem, ipsum dolor.  
                        </div>
                        <div class="sub_title">
                          Lorem ipsum dolor sit amet consectetur.
                      </div>
                    </div>
                    <div class="notify_status">
                        <p>Success</p>  
                    </div>
                </li> 
                <li class="show_all">
                    <p class="link">Show All Activities</p>
                </li> 
            </ul>
        </div>
        
      </div>
      <div class="profile">
        <div class="icon_wrap">
          <img src="php/images/<?php echo $row['image'] ?>" style='border-radius:50%;width:35px; height:35px;object-fit: cover;' alt="profile_pic">
          <span class="name"><?php echo $row['name'] ?></span>
          <i class="fas fa-chevron-down"></i>
        </div>

        <div class="profile_dd">
          <ul class="profile_ul">
            <li class="profile_li"><a class="profile" href="#"><span class="picon"><i class="fas fa-user-alt"></i>
                </span>Profile</a>
              <div class="btn">My Account</div>
            </li>
            <li><a class="address" href="#"><span class="picon"><i class="fas fa-map-marker"></i></span>Address</a></li>
            <li><a class="settings" href="#"><span class="picon"><i class="fas fa-cog"></i></span>Settings</a></li>
            <li><a class="logout" href="#"><span class="picon"><i class="fas fa-sign-out-alt"></i></span>Logout</a></li>
          </ul>
        </div>
      </div>
    </div>
  </div>
  
  <div class="popup">
    <div class="shadow"></div>
    <div class="inner_popup">
        <div class="notification_dd">
            <ul class="notification_ul">
                <li class="title">
                    <p>All Notifications</p>
                    <p class="close"><i class="fas fa-times" aria-hidden="true"></i></p>
                </li> 
                <li class="starbucks success">
                    <div class="notify_icon">
                        <span class="icon"></span>  
                    </div>
                    <div class="notify_data">
                        <div class="title">
                            Lorem, ipsum dolor.  
                        </div>
                        <div class="sub_title">
                          Lorem ipsum dolor sit amet consectetur.
                      </div>
                    </div>
                    <div class="notify_status">
                        <p>Success</p>  
                    </div>
                </li>  
                <li class="baskin_robbins failed">
                    <div class="notify_icon">
                        <span class="icon"></span>  
                    </div>
                    <div class="notify_data">
                        <div class="title">
                            Lorem, ipsum dolor.  
                        </div>
                        <div class="sub_title">
                          Lorem ipsum dolor sit amet consectetur.
                      </div>
                    </div>
                    <div class="notify_status">
                        <p>Failed</p>  
                    </div>
                </li> 
                <li class="mcd success">
                    <div class="notify_icon">
                        <span class="icon"></span>  
                    </div>
                    <div class="notify_data">
                        <div class="title">
                            Lorem, ipsum dolor.  
                        </div>
                        <div class="sub_title">
                          Lorem ipsum dolor sit amet consectetur.
                      </div>
                    </div>
                    <div class="notify_status">
                        <p>Success</p>  
                    </div>
                </li>  
                <li class="baskin_robbins failed">
                    <div class="notify_icon">
                        <span class="icon"></span>  
                    </div>
                    <div class="notify_data">
                        <div class="title">
                            Lorem, ipsum dolor.  
                        </div>
                        <div class="sub_title">
                          Lorem ipsum dolor sit amet consectetur.
                      </div>
                    </div>
                    <div class="notify_status">
                        <p>Failed</p>  
                    </div>
                </li> 
                <li class="pizzahut failed">
                    <div class="notify_icon">
                        <span class="icon"></span>  
                    </div>
                    <div class="notify_data">
                        <div class="title">
                            Lorem, ipsum dolor.  
                        </div>
                        <div class="sub_title">
                          Lorem ipsum dolor sit amet consectetur.
                      </div>
                    </div>
                    <div class="notify_status">
                        <p>Failed</p>  
                    </div>
                </li> 
                <li class="kfc success">
                    <div class="notify_icon">
                        <span class="icon"></span>  
                    </div>
                    <div class="notify_data">
                        <div class="title">
                            Lorem, ipsum dolor.  
                        </div>
                        <div class="sub_title">
                          Lorem ipsum dolor sit amet consectetur.
                      </div>
                    </div>
                    <div class="notify_status">
                        <p>Success</p>  
                    </div>
                </li>
            </ul>
        </div>
    </div>
  </div>
  
</div>



<!------------------------------- End of  Notifications Bar  !--------------------->
    


<div class="body_similar">
        <div class="users-container">
            <section class="users">
                <header class="user-details">

                    <div class="content">
                        <img src="php/images/<?php echo $row['image'] ?>" alt="">
                        <input type="hidden" value="<?php echo $row['id'] ?>" id="current_id_user">

                        <div class="details">
                            <span><?php echo $row['name']. " " . $row['lastname']; ?> </span>
                            
                            <div class="status">
                                <i class="fas fa-circle"></i>
                                <p><?php echo $row['status'] ?> </p>
                            </div>
                            
                        </div>
                    </div>
                </header>

                <div class="search">
                    <input type="text" placeholder="enter a user to search">
                    <button><i class="fas fa-search"></i></button>
                </div>

                <div class="users-list">

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

                    <div class="recent_conversations">
                    </div>

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

                    <form method="POST" action="#" autocomplete="off" enctype='multipart/form-data'>
                        <div class="typing-area">
                            <input type="file" size="60" hidden id="input_image" name="file_name"/>
                            <button for="input_image" id="button_image" type="button"><i class="fas fa-link"></i></button>
                            <input id="typing_input" type="text" placeholder="write a message to send" name="message_content">
                            <button type="submit"><i class="fab fa-telegram"></i> </button>
                        </div>
                    </form>

            </div>



        </div>

        <div class="user-profile">
         

        <?php 
        if($row['type']!="admin" ){

        ?>
            <img src="images/ecospare.png" alt="">
            <div class="location">
                <i class="fas fa-map-marker-alt"></i>
                <p>Rabat ,<span>Morocco</span></p>

            </div>
            

            <div class="bio">
                EcoSpare is a rising company based in France that offer a Marketplace where you can find usefull items for your needs.
            </div>
        <?php
        }
        ?>
            <div class="contact_buttons">
                <?php 
                    if($row['type']=="vendeur"){

                    
                ?>
                
                <button id="commande_contact_acheteur"> Contacter acheteur </button>
                <button id="admin_contact"> Contacter Administration </button>
                <?php
                }
                elseif($row['type']=="acheteur"){

                
                ?>        
                <button> Contacter à propos une commande </button>
                <button> Contacter à propos un produit </button>
                <button> Contacter un vendeur </button>
                <?php
                }
                ?>
            </div>

        </div>

        </div>

    <script src="js/users.js"></script>    


</body>
</html>