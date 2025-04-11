  <?php
  session_start();  
    if(!isset($_SESSION['user_id']))
    {       
      header("location:../Logout.php");    
    }
  ?>
<!DOCTYPE html>
<html>
<head>
  <title>Update Profile</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="keywords" content="Slide Login Form template Responsive, Login form web template, Flat Pricing tables, Flat Drop downs Sign up Web Templates, Flat Web Templates, Login sign up Responsive web template, SmartPhone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />

  <script>
    addEventListener("load", function () {
      setTimeout(hideURLbar, 0);
    }, false);

    function hideURLbar() {
      window.scrollTo(0, 1);
    }
  </script>

  <!-- Custom Theme files -->
  <link href="../css/style.css" rel="stylesheet" type="text/css" media="all" />
  <link href="../css/font-awesome.min.css" rel="stylesheet" type="text/css" media="all" />
  <!-- //Custom Theme files -->
  <!-- web font -->
  <link href="//fonts.googleapis.com/css?family=Hind:300,400,500,600,700" rel="stylesheet">
  <!-- //web font -->

</head>
<body>
  <?php 
  
  include("html/Header.php");
  
  $myId=$_SESSION['user_id'];
  $sql = "SELECT * FROM user WHERE user_id = '".$myId."'";
  $result = $func->select_with_condition(array('*'),'user',"user_id = '".$myId."'");
  while($row = $result->fetch_assoc())
  {
    $fname=$row["user_fname"];
    $lname=$row["user_lname"];
    $email=$row["user_email"];
    $password=$row["user_password"];         
    //$gender=$row["gender"];
    $image=$row["user_image"];
  }

  ?>       
  <!-- main -->
  <div class="w5layouts-main">    
   <div class="updateprofile-layer">
    <h1 style="color: white;text-shadow: 1px 1px 8px black;">Update Profile</h1>
    <div class="header-main1">
     <div class="main-icon">
      <img src="<?php echo "$image";?>" class="rounded_img" >
    </div>
    <div class="header-left-bottom">

      <form action="#" method="post">	

        <div class="icon1">
          <span class="fa fa-id-card-o"></span>
          Email Address :<?php echo $email; ?>                           
        </div>

        <div class="icon1">
          <span class="fa fa-user"></span>
          <input type="text" placeholder="First Name" name="fname" value="<?php echo $fname; ?> "required=""/>
        </div>	

        <div class="icon1">
          <span class="fa fa-user"></span>
          <input type="text" placeholder="Last Name" name="lname" value="<?php echo $lname; ?> "required=""/>
        </div>	
        
        <div class="bottom">
          <button class="btn" type="submit" name="updateName" >Update</button>
        </div><br>
        
      </form>	

      <form action="#" method="post">	

       <div class="icon1">
        <span class="fa fa-lock"></span>
        Current Password : <?php echo $password; ?>                           
      </div>  

      <div class="icon1">
        <span class="fa fa-lock"></span>
        <input type="password" placeholder="Enter New Password" name="password"  required>
      </div>
      
      <div class="bottom">
        <button class="btn" type="submit" name="updatePassword">Update Password</button>
      </div><br>
      
    </form>	

    <form enctype="multipart/form-data"action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">
      <div class="icon1">
        <span class="fa fa-photo"></span>
        <input type="file" name="profile" required>
      </div>	
      
      <div class="bottom">
        <button class="btn" type="submit" name="updatePic">Update Pic</button>
      </div><br>

    </form>	
  </div>	
</div>
</div>
</div>	
<!-- //main -->
<?php
if(isset($_POST['updateName']))
{

// $sql="UPDATE user set user_fname='" . $_POST['fname'] . "', user_lname='" . $_POST['lname'] . "' WHERE user_id='" . $myId . "'"; 

 $result = $func->update('user',array("user_fname='" . $_POST['fname'] . "'", "user_lname='" . $_POST['lname'] . "'"),"user_id='" . $myId . "'"); 
 
 if ($result === TRUE) 
 {
  ?>
  <form id="myForm" action="UpdateUserProfile.php" method="post">
    <input type="hidden" name="myId" id="myId" value="<?php echo $myId; ?>">
  </form>   
  <?php 
}
else
{
 echo "Cannot update";
}

}

if(isset($_POST['updatePassword']))
{
  
  //$sql="UPDATE user  set user_password ='" . $_POST['password'] . "'  WHERE user_id ='" . $myId . "'"; 

   $result = $func->update('user',array("user_password ='" . $_POST['password'] . "'"),"user_id ='" . $myId . "'"); 

  if ($result === TRUE) 
  {
    ?>
    <form id="myForm" action="UpdateUserProfile.php" method="post">
      <input type="hidden" name="myId" id="myId" value="<?php echo $myId; ?>">
    </form>   
    <?php        
  }
  else
  {
   echo "Cannot update";
 }      
}

if(isset($_POST['updatePic']))
{
  
  //$uploaddir = '/var/www/html/new-traning/Shivam_Yadav/Shivam/PHP/DataBase/Uploads/';
  $uploaddir = '../images/Profile_Images/';
 $uploadfile = $uploaddir . basename($_FILES['profile']['name'].time());
 error_reporting(E_ALL);
 echo "<p>";
 if (move_uploaded_file($_FILES['profile']['tmp_name'], $uploadfile)) {
  
 } else {
   echo "Upload failed";
 }

 echo "</p>";
 //$address=$uploadfile;
// $arr=(explode('../images/Profile_Images/',$address));
 //$imagePath=$arr[1];

// $sql="UPDATE user set user_image='" . $imagePath . "' WHERE user_id='" . $myId . "'"; 
 $result = $func->update('user',array("user_image='" . $uploadfile . "'"),"user_id ='" . $myId . "'"); 
 if ($result === TRUE) 
  {?>
    <form id="myForm" action="UpdateUserProfile.php" method="post">
      <input type="hidden" name="myId" id="myId" value="<?php echo $myId; ?>">
    </form>   
    <?php 
    
  }
  else
  {
    echo "Cannot update";
  }
  
}
?>
<script type="text/javascript">
  document.getElementById('myForm').submit();
</script>
</body>
</html>