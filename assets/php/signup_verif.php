<?php 

require_once("config.php");

$fname = mysqli_real_escape_string($conn,$_POST['fname']);
$lname = mysqli_real_escape_string($conn,$_POST["lname"]);
$type = mysqli_real_escape_string($conn,$_POST["type"]);
$password = mysqli_real_escape_string($conn,$_POST["password"]);
$email = mysqli_real_escape_string($conn,$_POST["email"]);

if(!empty($fname) && !empty($lname) && !empty($password) && !empty($email)){
    
    if(filter_var($email,FILTER_VALIDATE_EMAIL)){ // if email is valid

        
        $query = "SELECT * FROM users WHERE email = '{$email}'";
        $result = mysqli_query($conn,$query);

        // if email already exist
        if(mysqli_num_rows($result)>0){
            echo "this email already exists";
        }
        else{

            if(file_exists($_FILES['image']['tmp_name']) && is_uploaded_file($_FILES['image']['tmp_name']))
            {
                $image_name = $_FILES['image']['name']; // the name of the image uploaded
                $tmp_name = $_FILES['image']['tmp_name']; // temporary name to save/move the file in our folder
                
                // explode image to get the last extension jpp/png

                $img_explode = explode(".",$image_name);
                $img_ext = end($img_explode); // we get the extension of the user uploaded image

                $extensions = ['png','jpeg','jpg']; // these are valid extension that we're gonna use to compare 
                
                if(in_array($img_ext,$extensions) === TRUE){

                    $time = time();

                    $new_image_name = $time.$image_name;

                    if(move_uploaded_file($tmp_name,"images/".$new_image_name)){

                        $status = "Active now";
                        $random_id = rand(time(),1000000000); // create random if for user_id

                        //inserting user data inside users table
                        
                        $query1 = "INSERT INTO users(id,name,lastname,email,type,status,password,image) VALUES ({$random_id}, '{$fname}','{$lname}', '{$email}','{$type}',  '{$status}', '{$password}','{$new_image_name}')";
                        $result1 = mysqli_query($conn,$query1);

                        if($result1){
                            echo "Data has been inserted successfully";
                        }
                        else{
                            echo "data has not been inserted";
                        }
                    }
                }
                else{
                    echo "the images extension available are jpg/jpeg/png";
                }
            }
            else{
                echo "no images has been uploaded";
            }
        }

    }
    else{
        echo "$email is not valid";
    }
}
else{
    echo "all fields are required";
}

?>