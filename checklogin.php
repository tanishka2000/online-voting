<?php 
  if(isset($_POST['myusername']) && isset($_POST['mypassword'])){
?>
<!DOCTYPE html>
<html>
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
    <title>Simple PHP Polling System Access Denied</title>
    <link href="css/user_styles.css" rel="stylesheet" type="text/css" />
  </head>

  <body>
    <center><a href ="index.html"><img src="images/vitlogo.png" width="150px" alt="site logo"></a></center><br>     
    <center><b style="color:brown; font-size:30px;">Simple PHP Polling System</b></center><br><br>
    <div id="page">
      <div id="header">
        <h1>Invalid Credentials Provided </h1>
        <p align="center">&nbsp;</p>
      </div>
      <div id="container">
      <?php
        ini_set ("display_errors", "1");
        error_reporting(E_ALL);

        ob_start();
        session_start();
        require('connection.php');


        // Defining your login details into variables
        $myusername=$_POST['myusername'];
        $mypassword=$_POST['mypassword'];

        $encrypted_mypassword=md5($mypassword); //MD5 Hash for security
        // MySQL injection protections
        $myusername = stripslashes($myusername);
        echo $mypassword = stripslashes($mypassword);
        

        $sql=mysqli_query($con, "SELECT * FROM tbmembers WHERE `email`='$myusername' and `password`='$encrypted_mypassword'");

        // Checking table row
        $count = mysqli_num_rows($sql);
        // If username and password is a match, the count will be 1

        if($count == 1){
          // If everything checks out, you will now be forwarded to student.php
          $user = mysqli_fetch_assoc($sql);
          $_SESSION['member_id'] = $user['member_id'];
          header("location:student.php");
        }
        //If the username or password is wrong, you will receive this message below.
        else {
        echo "Wrong Username or Password<br><br>Return to <a href=\"index.html\">login</a>";
        }

        ob_end_flush();
      ?> 
      </div>
      <div id="footer"> 
        <div class="bottom_addr">&copy; 2012 Simple PHP Polling System. All Rights Reserved</div>
      </div>
    </div>
  </body>
</html>
<?php 
  }else{
    echo "<script>
            alert('Invalid access.');
            window.location.href='index.html';
          </script>";
  }
?>