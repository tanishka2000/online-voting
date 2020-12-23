<?php
session_start();
require('../connection.php');
?>
<html><head>
<link href="css/admin_styles.css" rel="stylesheet" type="text/css" />
<meta name="viewport" content="width=device-width,initial-scale=1.0" />
<script language="JavaScript" src="js/admin.js">
</script>
</head><body bgcolor="tan">
<center><a href ="https://sourceforge.net/projects/pollingsystem/"><img src = "images/logo" alt="site logo"></a></center><br>     
<center><b><font color = "black" size="6" style="font-size: 36px">VI-Voting Platform</font></b></center><br><br>
<div id="page">
<div id="header" style="font-size:20px;color:white">
    <h1 style="padding: 20px;">MANAGE ADMINISTRATORS  </h1>
    <a href="student.php" style="font-size:20px;">Home</a> | 
    <a href="vote.php" style="font-size:20px;">Current Polls</a> | 
    <a href="manage-profile.php" style="font-size:20px;">Manage My Profile</a> | 
    <a href="changepass.php" style="font-size:20px;">Change Password</a>| 
    <a href="logout.php" style="font-size:20px;">Logout</a></div>
<div id="container">
<?php
//If your session isn't valid, it returns you to the login screen for protection
if(empty($_SESSION['admin_id'])){
 header("location:access-denied.php");
}

//fetch data for update file
$result=mysqli_query($con, "SELECT * FROM tbadministrators WHERE admin_id = '$_SESSION[admin_id]'");
if (mysqli_num_rows($result)<1){
    $result = null;
}
$row = mysqli_fetch_array($result);
if($row)
 {
 // get data from db
 $adminId = $row['admin_id'];
 $firstName = $row['first_name'];
 $lastName = $row['last_name'];
 $email = $row['email'];
 }

//Process
if (isset($_GET['id']) && isset($_POST['update']))
{
$myId = addslashes( $_GET['id']);
$myFirstName = addslashes( $_POST['firstname'] ); //prevents types of SQL injection
$myLastName = addslashes( $_POST['lastname'] ); //prevents types of SQL injection
$myEmail = $_POST['email'];

$sql = mysqli_query($con, "UPDATE tbAdministrators SET first_name='$myFirstName', last_name='$myLastName', email='$myEmail' WHERE admin_id = '$myId'" );
}
?>
<table align="center">
<tr>
<td>
<form action="manage-admins.php?id=<?php echo $_SESSION['admin_id']; ?>" method="post" onSubmit="return updateProfile(this)">
<table align="center">
<CAPTION><h2>UPDATE ACCOUNT</h2></CAPTION>
<tr><td style="font-size:14px">First Name:</td><td><input class="effect-2" type="text" name="firstname" maxlength="15" value="<?php echo $firstName ?>"></td></tr>
<tr><td style="font-size:14px">Last Name:</td><td><input class="effect-2" type="text" name="lastname" maxlength="15" value="<?php echo $lastName ?>"></td></tr>
<tr><td style="font-size:14px">Email Address:</td><td><input class="effect-2" type="text" name="email" maxlength="100" value="<?php echo $email?>"></td></tr>
<tr><td>&nbsp;</td><td><input class="butn" type="submit" name="update" value="Update Account"></td></tr>
</table>
</form>
</td>
</tr>
</table>
</div>
</div>
</body></html>