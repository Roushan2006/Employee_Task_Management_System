<?php 
// error_reporting(-1);
// ini_set('display_errors', 'On');
session_start(); 
if(!isset($_SESSION['admin_id'])) // check admin or not
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
      background-image: url('../images/adminhome.jpg');
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

          width: 730px;
          height: 418px;
          overflow: auto;
        }

        .header {
          overflow: hidden;
          background-color: #f1f1f1;
          padding: 20px 10px;
        }

        .header a {
          float: left;
          color: black;
          text-align: center;
          padding: 12px;
          text-decoration: none;
          font-size: 18px; 
          line-height: 25px;
          border-radius: 4px;
        }

        .header a.logo {
          font-size: 25px;
          font-weight: bold;
        }

        .header a:hover {
          background-color: #ddd;
          color: black;
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

          .header-right {
            float: none;
          }
        }
      </style>
    </head>
    <body >
    <?php
  include("html/AdminHeader.php");
  //require '../Classes/init.php';
  // $func = new Operation();
  ?>   
      <div class="header">
        <div class="header-left">
         Search By Task Status : <select  id="sel" name="sel" onchange="search_by_status()">
           <option value="pending">pending</option>
           <option value="working">working</option>
           <option value="completed">completed</option>         
         </select>
         Search By Projects :
         <select  id="projects" name="projects" onchange="search_by_project()" >
          <?php
         
          $result=$func->selectAll('project');     
          while($row = $result->fetch_assoc())
          {       
           echo "<option value=".$row['project_id'].">".$row['project_name']."</option>";
          }
         ?>
       </select>
     </div>
  
   </div><br>
   <script type="text/javascript">

    function search_by_status() {
      var value=$("#sel").val();
      $.ajax({
        type:'post',
        url:'SearchByStatus.php',
        data:{value:value},
        success:function(result){
          $("#alltasks").html(result);
        }
      });
    }

    function search_by_project() {
      var select=$("#projects").val();
      $.ajax({
        type:'post',
        url:'SearchByProject.php',
        data:{select:select},
        success:function(result){
          $("#alltasks").html(result);
        }
      });
    }
  </script>

 <?php
  include("html/Sidebar.html"); // include sidebar file

 //$myId=$_SESSION['admin_id']; // getting my id from session
  //$sql = "SELECT * FROM task INNER JOIN user ON  task_receiver=user_id"; // query for user  
  $result1 = $func->select_with_join('*','task','user','INNER JOIN','task_receiver=user_id');                                  //and his respective task details
  ?>

  <center>
  
    <!-- All task shown here -->
    <div class="field" id="alltasks">
        <h3 style="color: white;">All Tasks</h3>
      <?php
      if($result1->num_rows > 0) 
      {
        while($row = $result1->fetch_assoc()) 
        {   
          ?> 
          <table>
            <col width="60">
            <col width="100">
            <col width="150">        
            <tr>      <!--fetching task details  -->
              <td align="center"><img src="<?php echo $row["user_image"];?>" alt="No Profile" width="42" height="42" style=" border-radius: 50%;"></td> 
              <td align="center"><?php echo $row["user_fname"]." ".$row["user_lname"]; ?></td>    
              <td align="center"><?php echo $row["task_name"]; ?></td> 
              <?php if($row["task_display"]==1)
              { ?>
               <td style="color: green;"><?php echo "✔" ;?></td>
             <?php }  else
             {
              ?>
              <td style="color: red;"><?php echo "✘" ;?></td>

            <?php } ?>
            <td><a href="TaskDetails.php?task_id=<?php echo $row["task_id"]; ?>" class="button">SEE DETAILS</a></td>
            <td><button onclick="delete_task(<?php echo $row["task_id"];?>)" class="button" >Delete</button></td>
          </tr></table><br>

          <?php 
        
        } 
      }
      else
      {
        echo "<h2>no task so far</h2>";
      }
      ?>
    <br>
  </div></center>
   <!-- //All task shown here -->

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script type="text/javascript">
   /*function to delete a perticular task by task id*/
   function delete_task(task_id) {
    if(confirm('Are you sure to remove this task ?'))
  { 
      $.ajax({
        type:'post',
        url:'TaskDelete.php',
        data:{task_id:task_id},
        success:function(result){
         $("#alltasks").html(result);
       }
     });
  }
  }
 /* //function to delete a perticular task by task id*/
</script>

</body>
</html>