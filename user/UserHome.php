<?php session_start(); 
if(!isset($_SESSION['user_id']))
{
  session_destroy();
  header("location:../Logout.php");    
}?>
<!DOCTYPE html>
<html>
<head>
	<title>User Home</title>
  <style type="text/css">
    body {
      background-image: url('../images/flies.jpg');
    }

    .headers{
      position: fixed;
    }

    table {
      font-family: arial, sans-serif;
      border-collapse: collapse;

    }

    td {

      text-align: left;
      padding: 8px;
      background-color: #d6cece;
    }

    tr:nth-child(even) {
      background-color: red;
    }
    table tr td:first-child{ border-top-left-radius: 25px;
      border-bottom-left-radius: 5px;}
      table tr td:last-child{ border-top-right-radius: 5px;
        border-bottom-right-radius: 25px;}

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
        .button2 {
          border-radius: 8px;
          border: bold 17px Arial;
          text-decoration: none;
          background-color:#da6856;
          color: #333333;
          padding: 2px 6px 2px 6px;
          border-top: 1px solid #CCCCCC;
          border-right: 2px solid #333333;
          border-bottom: 2px solid #333333;
          border-left: 1px solid #CCCCCC;
        }

        div.field {

          width: 540px;
          height: 418px;
          overflow: auto;
        }
      </style>
    </head>
    <body >
     <?php
     include("html/Header.php"); 
     include("html/UserSidebar.html"); 
   
    $myId=$_SESSION['user_id'];  
    $display=1;
   // $sql = "SELECT * FROM task WHERE task_receiver = '".$myId."' AND task_display = '1'";
    $result = $func->select_with_multiple_condition(array('*'),'task',"task_receiver = '".$myId."'",'AND',"task_display = '".$display."'");
    ?>
    <br><br>
    <center><div class="field"> 
     <h1 style="color: white;">My Tasks</h1>
        <?php
         if($result->num_rows > 0) 
        {     
          while($row = $result->fetch_assoc()) 
          {
       ?>     <table>
        <col width="60">
        <col width="150">
        <col width="150">
        <col width="150">  
            <tr>
             <td align="center"><image src="<?php echo $row["task_sender_image"];?>" alt="No Profile" width="42" height="42" style=" border-radius: 50%;"></td>
               <td align="center"><?php echo $row["task_sender_name"];?></td> 
               <td align="center"><?php echo $row["task_name"]; ?></td> 
               <td><a href="UserTaskDetails.php?task_id=<?php echo $row["task_id"]; ?>" class="button">SEE DETAILS</a></td>
             </tr>
             <br>
       <?php  
           } 
         }
         else
         {
          echo "<h2>no task so far</h2>";
        }
        ?>
      </table><br>
    </div></center>
  </body>
  </html>