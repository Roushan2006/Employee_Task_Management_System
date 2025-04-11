<?php
 session_start(); 

 require '../Classes/init.php';
 $func = new Operation();
if ($conn->connect_error) 
{
  die("Connection failed: " . $conn->connect_error);
} 
else
{       
 $commentText=$_POST['comment'];
 $task_id=$_POST['task_id'];
 $mineId=$_POST['mineId'];
 $recId=$_POST['recId'];
 $mineName=$_POST['myName'];
 $mineImage=$_POST['myImage'];

 if(empty($commentText)|| empty($task_id) || empty($mineId) || empty($recId))
 {                              
  echo "<span class='status-not-available'> First write something..</span>";
}
else 
{                           

 $result = $func->insert('comments',array('comment_text','comment_by','comment_to','comment_task_id','commenter_name','commenter_image'),array("'$commentText'","'$mineId'","'$recId'","'$task_id'","'$mineName'","'$mineImage'"));


 if ($result === TRUE) 
 {                         
  echo "<span class='status-available'>".$recId."</span>";       
} 
else
{
 echo "<span class='status-not-available'> Post Failed...</span>";
} 
}                                       
}
?>