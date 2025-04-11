  <?php
  session_start();  
    if(!isset($_SESSION['admin_id']))
    {       
      header("location:../Logout.php");    
    }
  ?>
<!DOCTYPE html>
<html>
<head>
  <title>User Details</title>
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
  
  include("html/AdminHeader.php");

 
  $user_id=$_REQUEST['user_id'];
  $result=$func->select_with_condition(array('*'),'user',"user_id = '".$user_id."'");
  while($row = $result->fetch_assoc())
  {
    $fname=$row["user_fname"];
    $lname=$row["user_lname"];
    $email=$row["user_email"];
    $password=$row["user_password"];         
    $gender=$row["gender"];
    $image=$row["user_image"];
  }

  ?>       
  <!-- main -->
  <div class="w5layouts-main">    
   <div class="updateprofile-layer">
    <h1 style="color: white;">User Details</h1>
    <div class="header-main1">
     <div class="main-icon">
      <img src="<?php echo "$image";?>" class="rounded_img" >
    </div>
    <div class="header-left-bottom">

      <form action="#" method="post">	

        <div class="icon1">
          <span class="fa fa-id-card-o"></span>Email :    
           <input type="email" placeholder="email" name="email" value="<?php echo $email; ?> "required=""/>                          
        </div>

        <div class="icon1">
          <span class="fa fa-user"></span>First Name :
          <input type="text" placeholder="First Name" name="fname" value="<?php echo $fname; ?> "required=""/>
        </div>	

        <div class="icon1">
          <span class="fa fa-user"></span>Last Name :
          <input type="text" placeholder="Last Name" name="lname" value="<?php echo $lname; ?> "required=""/>
        </div>	
        
        <div class="bottom">
          <button class="btn" type="submit" name="updateName" >Update</button>
        </div><br>
        
      </form>	

      <form action="#" method="post">	

      <div class="icon1">
        <span class="fa fa-lock"></span>Password :
        <input type="text" placeholder="Enter New Password" name="password" value="<?php echo $password; ?> "  required>
      </div>
      
      <div class="bottom"> 
        <button class="btn" type="submit" name="updatePassword">Update Password</button>
      </div><br>    
    </form>	

     <div class="bottom">
        <button class="btn" type="button" name="back"><a href="AllUsers.php" style="color: white">BACK</a></button>
      </div><br>
  </div>	
</div>
</div>
</div>	
<!-- //main -->
<?php
if(isset($_POST['updateName']))
{

 $sql="UPDATE user set user_fname='" . $_POST['fname'] . "', user_lname='" . $_POST['lname'] . "', user_email='" . $_POST['email'] . "' WHERE user_id='" . $user_id . "'"; 
 
 if ($conn->query($sql) === TRUE) 
 {
  ?>
  <form id="myForm" action="AdminUserDetails.php" method="post">
    <input type="hidden" name="user_id" id="user_id" value="<?php echo $user_id; ?>">
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
  
  $sql="UPDATE user  set user_password ='" . $_POST['password'] . "'  WHERE user_id ='" . $user_id . "'"; 

  if ($conn->query($sql) === TRUE) 
  {
    ?>
  <form id="myForm" action="AdminUserDetails.php" method="post">
    <input type="hidden" name="user_id" id="user_id" value="<?php echo $user_id; ?>">
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