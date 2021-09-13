<?php 

if (isset($_SESSION['email'])) { 


    $result = mysqli_query($db, "SELECT token FROM user_token where username='".$_SESSION['email']."'");
 
    if (mysqli_num_rows($result) > 0) {
      
        $row = mysqli_fetch_array($result); 
        $token = $row['token']; 
        

        if($_SESSION['token'] != $token){
          
            session_destroy();
            header('Location: index.php');
        }
    }
      
}