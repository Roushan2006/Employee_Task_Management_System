<!DOCTYPE html>
<html>
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <style> 
   
    * {box-sizing: border-box;}

    body { 
      margin: 0;
      font-family: Arial, Helvetica, sans-serif;
    }

    .header {
      position: sticky;
      overflow: hidden;
      background-color: #f1f1f1;
      padding: 20px 10px;
      
    }

    .header a {
      /*float: left;*/
      color: black;
      text-align: center;
      padding: 12px;
      text-decoration: none;
      font-size: 18px; 
      line-height: 25px;
      border-radius: 4px;
    }
    .header a input {


      color: black;
      text-align: center;
      padding: 12px;
      text-decoration: none;
      font-size: 18px; 
      line-height: 25px;
      border-radius: 4px;

    }

    .header a.logo img{
     
      border-radius: 50%;
      width: 70px;
      height: 80px;

    }



    .header a.active {
      background-color: dodgerblue;
      color: white;
    }

    .header-right {
      float: right;
    }

    @media screen and (max-width: 500px) {
      .header a {
        float: none;
        display: block;
        text-align: left;
      }
      
      
      .header-left {
        float: none;
      }
      .header-center
      {
       text-align: center;
     }

     table {
      font-family: arial, sans-serif;
      border-collapse: collapse;
      
    }

    td {
      border: 5px solid  #dddddd;
      text-align: left;
      padding: 8px;
      background-color: #d6cece;
    }

    tr:nth-child(even) {
      background-color: red;
    }
    .button {
      border-radius: 8px;
      border: bold 17px Arial;
      text-decoration: none;
      background-color: #EEEEEE;
      color: #333333;
      padding: 2px 6px 2px 6px;
      border-top: 1px solid #CCCCCC;
      border-right: 2px solid #333333;
      border-bottom: 2px solid #333333;
      border-left: 1px solid #CCCCCC;
    }
    .button1 {
      border-radius: 8px;
      border: bold 17px Arial;
      text-decoration: none;
      background-color:#aae87c;
      color: #333333;
      padding: 2px 6px 2px 6px;
      border-top: 1px solid #CCCCCC;
      border-right: 2px solid #333333;
      border-bottom: 2px solid #333333;
      border-left: 1px solid #CCCCCC;
    }

  </style>
</head>
<body>
  <?php
  session_start();
  require '../Database/Connection.php';        
  if(!isset($_SESSION['user_id']))           
  {       
    header("location:../Logout.php");    
 }
 
 $imagePath="";
 $myId=$_SESSION['user_id'];
 if ($conn->connect_error) 
 {
  die("Connection failed: " . $conn->connect_error);
} 
else
{
 
 $sql = "SELECT * FROM user WHERE user_id = '".$myId."'";
 $result = $conn->query($sql);
 while($row = $result->fetch_assoc())
 {
  
  $imagePath=$row["user_image"];
  $fname=$row['user_fname'];
  $lname=$row['user_lname'];

}
}
?>
<div class="header">
 <a href="UserHome.php" class="logo"><img src="<?php echo " $imagePath";?>" ></a>
 <?php echo $fname." ".$lname; ?>  
 <div class="header-right" >
   <form>
    <a class="active" href="../Logout.php">Logout</a></form>
  </div>
</div>
<div class="header-center" >
</div>
<div style="padding-left:20px"> 
</div>
</body>
</html>
