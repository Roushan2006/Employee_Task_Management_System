<?php session_start(); 
if(!isset($_SESSION['admin_id'])) // admin check
{
  session_destroy();
  header("location:../Logout.php");    
}?>
<!DOCTYPE html>
<html>
<head>
  <title>Task Details</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="keywords" content="Slide Login Form template Responsive, Login form web template, Flat Pricing tables, Flat Drop downs Sign up Web Templates, Flat Web Templates, Login sign up Responsive web template, SmartPhone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />
  <!-- <script>
    
    addEventListener("load", function () {
      setTimeout(hideURLbar, 0);
    }, false);

    function hideURLbar() {
      window.scrollTo(0, 1);
    }
  </script> -->
  <script src="https://code.jquery.com/jquery-2.1.1.min.js" type="text/javascript"></script>

  <!-- Custom Theme files -->
  <link href="../css/style.css" rel="stylesheet" type="text/css" media="all" />
  <link href="../css/font-awesome.min.css" rel="stylesheet" type="text/css" media="all" />
  <!-- //Custom Theme files -->

  <!-- web font -->
  <link href="//fonts.googleapis.com/css?family=Hind:300,400,500,600,700" rel="stylesheet">
  <!-- //web font -->

  
  <style type="text/css">

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

      div.field {

        width: 540px;
        height: 318px;
        overflow:auto; 
       
      }

    </style>
    <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
    <script type="text/javascript">
/* function to save comments in the DB */
      function subm(){        
        var comment=$("#comment").val();
        var task_id=$("#task_id").val();
        var mineId=$("#mineId").val();
        var recId=$("#recId").val();
        var myName=$("#myName").val();
        var myImage=$("#myImage").val();
    
        jQuery.ajax({
          url: "CommentSave.php",
          data:{comment:comment,task_id:task_id,mineId:mineId,recId:recId,myName:myName,myImage:myImage}, 
          type: "POST",
          success:function(data){
            $("#").html(data);
          },
          error:function (){}
        });    
      };
/* //function to save comments in the DB */

/*tiny mc comment box*/
      tinymce.init({
        selector: "#comment",
        setup: function (editor) { 
          editor.on('change', function () {
            tinymce.triggerSave();
          });
        }
      });
/* // tiny mc comment box*/

    </script>
  </head>
  <body >
    <?php
   
      include("html/AdminHeader.php");  // some files include
      include("html/Sidebar.html");

      $task_id=$_REQUEST['task_id'];
      $myId=$_SESSION['admin_id'];

      //$sql = "SELECT * FROM task WHERE task_id = '".$task_id."'";  
      $result = $func->select_with_condition(array('*'),'task',"task_id = '".$task_id."'");//query for extracting task data
    
      while($row = $result->fetch_assoc())
      {
        $taskName=$row["task_name"];
        $taskIssueDate=$row["task_issuedate"];
        $taskDeadLine=$row["dead_line"];
        $taskDetails=$row["task_details"];
        $taskReceiver=$row["task_receiver"];
        $taskDisplay=$row["task_display"];
        $taskProject=$row["task_project"];
        $taskStatus=$row["task_status"];

      }

     // $sql1 ="SELECT * FROM user WHERE user_id = '".$taskReceiver."'";
      $result1 = $func->select_with_condition(array('*'),'user',"user_id = '".$taskReceiver."'"); // query for task receiver's info
      while($row = $result1->fetch_assoc())
      {
        $userImage=$row["user_image"];
        $userFname=$row["user_fname"];
        $userLname=$row["user_lname"];        
      }

      //$sql2 = "SELECT * FROM admin WHERE admin_id = '".$myId."'"; // query for task sender info
      $result2 = $func->select_with_condition(array('*'),'admin',"admin_id = '".$myId."'");
      while($row = $result2->fetch_assoc())
      {
        $myName=$row["admin_name"];
        $myImage=$row["admin_image"];
      } 

     // $sql3 = "SELECT * FROM project WHERE project_id = '".$taskProject."'"; // query for project info
      $result3 = $func->select_with_condition(array('*'),'project',"project_id = '".$taskProject."'");
      while($row = $result3->fetch_assoc())
      {
        $projectName=$row["project_name"];
      }           

      ?>
      <!-- task details shown here -->
      <div class="w6layouts-main"> 
        <div class="seeprofile-layer">
            
           
          <h1></h1>
          <div class="header-main1">

                <div id="countdown" style="color: white; float: right;"></div>
            <img src="<?php echo "$userImage";?>" class="rounded_img1" >
            <p style="color: white;"><?php echo " Task Receiver Name: "." $userFname"." "."$userLname"; ?></p>
           

            <div class="header-left-bottom">     
              <div class="icon1">
                <span class="fa fa-user"></span>
                Task Tittle :<?php echo $taskName; ?>                           
              </div>  

              <div class="icon1">
                <span class="fa fa-user"></span>
                Task Issue Date  :<?php echo $taskIssueDate; ?>
              </div>  

              <div class="icon1">
                <span class="fa fa-user"></span>
                Task Dead Line :  <?php  echo $taskDeadLine;?>
                 <input type="hidden" name="deadline" id="deadline" value="<?php echo $taskDeadLine; ?>">
              </div>  

              <div class="icon1">
                <span class="fa fa-user";></span>
                Task Details :
                <div style=" width: 990px;height: 118px;overflow: auto;">
                  <?php echo "$taskDetails"; ?>
                </div>
              </div>

              <div class="icon1">
                <span class="fa fa-user";></span>
                Task Project : <?php echo $projectName; ?>    
              </div>

              <div class="icon1">
                <span class="fa fa-user";></span>
                Task Working Status : <?php echo $taskStatus; ?>    
              </div>
            
              <div class="icon1" style="width: 100px;">

               <label class="switch">
                 <!-- show hide toggle button -->
                <input type="checkbox" name="enabledisable" value="1" <?php echo ($taskDisplay=='1' ? 'checked' : ''); ?> onclick="show_hide_task(this.checked ? 1 : 0,<?php echo $task_id;?>)" > 
                <span class="slider round"></span></label>
                      <!--//show hide toggle button  -->
              </div>

              <div class="bottom">
                <button class="btn" type="submit" name="updateTask" ><a href="TaskUpdate.php?task_id=<?php echo $task_id; ?>" class="button" style="color:white;">EDIT</a></button>
              </div>
              <h4 style="color: white;text-align: center;">....Comments....</h4>
            </div>  
            <center><div id="load_comments" class="field"  ></div></center> 
          </div>
          <!-- write comment area -->
          <center><div style="width:1100px;height:300px;">
            <form method="POST" name="f1" id="f1">
              <textarea id="comment" name ="comment"></textarea>
              <input type="number" name="task_id" id="task_id" value=<?php echo "$task_id";?> hidden> 
              <input type="number" name="mineId" id="mineId" value=<?php echo "$myId";?> hidden>
              <input type="number" name="recId" id="recId" value=<?php echo "$taskReceiver";?> hidden>
              <input type="hidden" name="myName" id="myName" value=<?php echo "$myName";?>>
              <input type="text" name="myImage" id="myImage" value=<?php echo "$myImage";?> hidden>
              <input type="button" class="btn" name="submit" id="submit" value="SUBMIT" onclick="subm();">
            </form>
          </div></center>
          <!-- //write comment area -->
        </div>  
      </div>

      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
      <script>

        /* function to refresh comment display area in every 2 sec */
        var auto_refresh = setInterval(
          function ()
          {
            $('#load_comments').load('comment_count.php?task_id=<?php echo $task_id; ?>').fadeIn("slow");
            scrollBac();
          }, 2000); // refresh  in every 2 seconds

        /*function to show or hide task */
        function show_hide_task(val,task_id) {
          $.ajax({
            type:'post',
            url:'ShowHideTask.php',
            data:{val:val,task_id:task_id},
            success:function(result){
              if(result==1)
              {
                $('#str'+task_id).html('Show');
              }
              else
              {
                $('#str'+task_id).html('Hide');
              }
            }
          });
        }
        /* function to delete comment*/
        function delete_comment(comment_id) {    
        if(confirm('Are you sure to remove this comment ?'))
        {
          $.ajax({
            type:'post',
            url:'DeleteComment.php',
            data:{comment_id:comment_id},
            success:function(result){
              if(result==1)
              {
                $('#str'+comment_id).html('Show');
              }
              else
              {
                $('#str'+comment_id).html('Hide');
              }
            }
          });
         }
        }

        /*--//function to delete comments--*/

        /*function to show/hide comments*/
        function hide_show_comments(val,comment_id) {
          $.ajax({
            type:'post',
            url:'ShowHideComments.php',
            data:{val:val,comment_id:comment_id},
            success:function(result){

            }
          });
        }
        /*--//function to show/hide comments--*/

        /*function to sroll back at last position*/
        var scrolled = false;
        function scrollBac(){
          if(!scrolled){
           var element = document.getElementById("load_comments");
           element.scrollTop = element.scrollHeight;
         }
       }

       $("#load_comments").on('scroll', function(){
         scrolled=true;
       });
       /* */

       /*clock --> will show time remaining to deadline*/
    var deadLine=$("#deadline").val();
    var end = new Date(deadLine);
    var _second = 1000;
    var _minute = _second * 60;
    var _hour = _minute * 60;
    var _day = _hour * 24;
    var timer;

    function showRemaining() {
        var now = new Date();
        var distance = end - now;
        if (distance < 0) {

            clearInterval(timer);
            document.getElementById('countdown').innerHTML = 'EXPIRED!';

            return;
        }
        var days = Math.floor(distance / _day);
        var hours = Math.floor((distance % _day) / _hour);
        var minutes = Math.floor((distance % _hour) / _minute);
        var seconds = Math.floor((distance % _minute) / _second);

        document.getElementById('countdown').innerHTML = days + 'days ';
        document.getElementById('countdown').innerHTML += hours + 'hrs ';
        document.getElementById('countdown').innerHTML += minutes + 'mins ';
        document.getElementById('countdown').innerHTML += seconds + 'secs';
    }

    timer = setInterval(showRemaining, 1000);
       /*clock*/
     </script>
  </body>
</html>