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
  error_reporting(-1);
ini_set('display_errors', 'On');
  $task_id=$_GET['task_id']; // getting task id
  require '../Classes/init.php';
  $func = new Operation();

  // $sql = "SELECT * FROM comments WHERE comment_task_id = '".$task_id."'  ORDER BY comment_id desc ";
   $result = $func->select_with_condition_orderby(array('*'),'comments',"comment_task_id = '".$task_id."'",'comment_id','desc'); // fetching all comments associated with specific task
   ?>
   <!-- all comment area -->
   <center><div class="field">
      <?php
      if ($result->num_rows > 0) 
      {
        while($row = $result->fetch_assoc()) 
        {
          ?>
          <table >
      <col width="60" height="40">
      <col width="100" height="40">
      <col width="280"  height="40">
     
          <tr>
           <td><img src="<?php echo $row["commenter_image"];?> " alt="No Profile" width="42" height="42" style=" border-radius: 50%;"></td>
           <td align="center"><?php echo $row["commenter_name"]; ?></td>
           <td align="center"><?php echo $row["comment_text"]; ?></td>
            <td>
              <label class="switch">
              <input type="checkbox" name="enabledisable" value="1" <?php echo ($row['comment_display']=='1' ? 'checked' : ''); ?> onclick="hide_show_comments(this.checked ? 1 : 0,<?php echo $row['comment_id'];?>)" >
              <span class="slider round"></span></label></td>
            <td><button class="buttons" onclick="delete_comment(<?php echo $row["comment_id"];?>)" class="button">Delete</button></td>
         </tr><br> </table>
         <!-- //all comment area -->
         <?php
       }     
     }
                 
   ?>
 </body>
 </html>
