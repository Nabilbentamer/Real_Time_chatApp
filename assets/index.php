<?php 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" >
    <title>Real time chat App </title>
</head>

<body>
    <div class="container">
        <section class="signup form">
            <header> Messagerie</header>

            <form method="POST" action="#" enctype='multipart/form-data' autocomplete="off">

                <div class="error_text"> This is an error message </div>

                <div class="name_details">
                    <div class="field input">
                        <label> First Name</label>
                        <input type="text" placeholder="First Name" name="fname">
                    </div>

                    <div class="field input">
                        <label> Last Name</label>
                        <input type="text" placeholder="Last Name" name="lname">
                    </div>                    
                </div>

                    <div class="field input">
                        <label> Email Adresse</label>
                        <input type="text" placeholder="Email adresse" name="email">
                    </div>
                    
                    <div class="field input">
                        <label> Password</label>
                        <input type="password" placeholder="Enter your password" name="password">
                    </div> 

                    <div class="field_type">
                        <label>type :</label>
                        <input type="radio"  name="type" value="vendeur"> <label for="Vendeur">Vendeur</label>
                        <input type="radio" name="type" value="acheteur"> <label for="Acheteur">Acheteur</label>
                    </div> 

                    <div class="field_image">
                        <label> Image</label>
                        <input type="file" name="image" accept="image/jpeg,image/png,image/jpg">
                    </div>
                    
                    <div class="field button">
                        <input type="submit" value="Continue to chat">
                    </div>

            </form>

            <div class="link">
                Already signed up? <a href="login.php">Login now</a>
            </div>
        </section>
    </div>

    <script src="js/signup.js"></script>

</body>

</html>