<!DOCTYPE html>
<html>
<head>
	<title>comment count</title>
   <style type="text/css">

     div.field {        
          width: 540px;
          height: 318px;
          overflow: auto;
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
       table tr td:third-child{ width: 600px;}
      table tr td:last-child{ border-top-right-radius: 5px;
        border-bottom-right-radius: 25px;}

          .buttons {
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

  </style>
</head>
<body>
	<?php
  $task_id=$_GET['task_id'];
  require '../Classes/init.php';
  $func = new Operation();
   $display=1;
   //$sql = "SELECT * FROM comments WHERE comment_task_id = '".$task_id."' AND comment_display = '1' ORDER BY comment_id desc ";

   //selet_with_multiple_condition_orderby($columns,$tableName,$whereConditon1 $operator,$whereConditon2,$orderByColumn,$asc_decs)

  $result = $func->select_with_multiple_condition_orderby(array('*'),'comments',"comment_task_id = '".$task_id."'",'AND',"comment_display = '".$display."'",'comment_id','desc');
   ?>
   <center><div class="field"> <br><br>
   
      <?php
      if ($result->num_rows > 0) 
      {
        while($row = $result->fetch_assoc()) 
        {
          ?>  
           <table >
      <col width="60">
      <col width="100">
      <col width="280">
      <col width="70"> 
           <tr>
           <td><img src="<?php echo $row["commenter_image"];?> " alt="No Profile" width="42" height="42" style=" border-radius: 50%;"></td>
           <td align="center"><?php echo $row["commenter_name"]; ?></td>
           <td align="center"><?php echo $row["comment_text"]; ?></td>
         </tr><br></table>
         <?php
       } 

      
     }
              
   ?>
 </body>
 </html>
