<?php
 session_start(); 
if(!isset($_SESSION['admin_id']))
{
  session_destroy();
  header("location:../Logout.php");    
}
 require '../Classes/init.php';
        $func = new Operation();

	$comment_id=$_POST['comment_id'];
	

	//$sql="DELETE from  comments  WHERE comment_id = '".$comment_id."'"; 
	$result = $func->delete('comments',"comment_id = '".$comment_id."'");

	if ($result === TRUE) 
	{
		
		echo "updated";       
	}
	else
	{
		echo "Cannot update";
	}


?>