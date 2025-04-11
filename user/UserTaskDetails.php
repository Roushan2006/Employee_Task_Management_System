<?php
  session_start();
    if(!isset($_SESSION['user_id']))  // user check
    {
      header("location:../Logout.php");    
    }
?>
<!DOCTYPE html>
<html>
<head>
  <title>Task Details</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="keywords" content="Slide Login Form template Responsive, Login form web template, Flat Pricing tables, Flat Drop downs Sign up Web Templates, Flat Web Templates, Login sign up Responsive web template, SmartPhone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />

 <!--  <script>
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
  <style type="text/css">  
  </style>
  <!-- //web font -->
  <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
  <script type="text/javascript">
   
   tinymce.init({
    selector: "#comment",
    setup: function (editor) {
      editor.on('change', function () {
        tinymce.triggerSave();
      });
    }
  });

</script>
</head>
<body>
  <?php
  session_start();
  include("html/Header.php"); // header include
  include("html/UserSidebar.html");// sidebar include

  $task_id=$_REQUEST['task_id']; // getting taskid 
  $myId=$_SESSION['user_id']; // getttting myid

  //$sql = "SELECT * FROM task WHERE task_id = '".$task_id."'"; //  query will fetch task details by task id  
  $result = $func->select_with_condition(array('*'),'task',"task_id = '".$task_id."'");
  while($row = $result->fetch_assoc())
  {
    $taskName=$row["task_name"];  // task details
    $taskIssueDate=$row["task_issuedate"];
    $taskDeadLine=$row["dead_line"];
    $taskDetails=$row["task_details"];
    $taskReceiver=$row["task_receiver"];
    $taskSender=$row["task_sender_name"];
    $taskSenderImage=$row["task_sender_image"];
    $taskProject=$row["task_project"];
    $taskStatus=$row["task_status"];

  }

  //$sql1 = "SELECT * FROM user WHERE user_id = '".$myId."'"; 
  $result1 = $func->select_with_condition(array('*'),'user',"user_id = '".$myId."'");
  while($row = $result1->fetch_assoc())
  {
    $myName=$row["user_fname"];
    $myImage=$row["user_image"];
  }

  //$sql3 = "SELECT * FROM project WHERE project_id = '".$taskProject."'";
  $result3 = $func->select_with_condition(array('*'),'project',"project_id = '".$taskProject."'");
  while($row = $result3->fetch_assoc())
  {
    $projectName=$row["project_name"];
  }    

  ?>
  <!-- main -->
  <div class="w6layouts-main"> 
    <div class="seeprofile-layer">
      <h1></h1>
      <div class="header-main1">
       <!--    <div class="main-icon"> -->
         <div id="msg" name="msg"></div>
        <div id="countdown" style="color: white; float: right;"></div>
        <img src="<?php echo "$taskSenderImage";?>" class="rounded_img1" >
        <p style="color: white;"><?php echo "Sender Name:"."$taskSender"; ?></p>
        <!--  </div> -->
        <div class="header-left-bottom">     
          <div class="icon1">
            <span class="fa fa-tag"></span>
            Task Tittle :<?php echo $taskName; ?>                           
          </div>  

          <div class="icon1">
            <span class="fa fa-calendar"></span>
            Task Issue Date  :<?php echo $taskIssueDate; ?>
          </div>  

          <div class="icon1">
            <span class="fa fa-calendar"></span>
            Task Dead Line :  <?php echo $taskDeadLine;?>
            <input type="hidden" name="deadline" id="deadline" value="<?php echo $taskDeadLine; ?>">
          </div>  

          <div class="icon1">
            <span class="fa fa-list";></span>
            Task Details :
            <div style=" width: 990px;height: 118px;overflow: auto;">
             <?php echo "$taskDetails"; ?>
           </div>
         </div>

         <div class="icon1">
          <span class="fa fa-pencil";></span>
          Task Project : <?php echo $projectName; ?>    
        </div>

        <div class="icon1">
          <span class="fa fa-hand-rock-o";></span>
          Update Project Status : 
          <select onchange="update_task_status(this.value,<?php echo $task_id;?>)">
            <option value="pending" <?php echo ($taskStatus =='pending'? 'selected':'');?>>Pending</option>
            <option value="working" <?php echo ($taskStatus =='working'? 'selected':'');?>>Working</option>
            <option value="completed" <?php echo ($taskStatus =='completed'? 'selected':'');?>>Completed</option>
          </select>
        </div>
      </div>
      <h4 style="color: white;text-align: center;">....Comments....</h4>  
      <center><div id="load_comments" class="comments"></div></center>  
    </div>
    <center><div style="width:1100px;height:300px;">
      <form method="POST" name="f1" id="f1">
        <textarea id="comment" name ="comment"></textarea>
        <input type="number" name="task_id" id="task_id" value=<?php echo "$task_id";?> hidden> 
        <input type="number" name="mineId" id="mineId" value=<?php echo "$myId";?> hidden>
        <input type="number" name="recId" id="recId" value=<?php echo "$taskReceiver";?> hidden>
        <input type="hidden" name="myName" id="myName" value=<?php echo "$myName";?>>
        <input type="text" name="myImage" id="myImage" value=<?php echo "$myImage";?> hidden>
        <input type="button" class="btn" name="submit" id="submit" value="SUBMIT" onclick="subm()">
      </form></div></center>
    </div>  
  </div>
<!-- //main -->
<!-- 
<span id="msg"></span>
 -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
 <script>
  var auto_refresh = setInterval(

    function ()
    {
      $('#load_comments').load('comment_count_user.php?task_id=<?php echo $task_id; ?>').fadeIn("slow");
  }, 2000); // refresh  in every 2000 milliseconds

  function update_task_status(val,task_id) {
    $.ajax({
      type:'post',
      url:'UpdateTaskStatus.php',
      data:{val:val,task_id:task_id},
      success:function(result){
        if(result==1)
        {
         $('#str'+task_id).html('updated');
       }
       else
       {
        $('#str'+task_id).html('dont');
      }
    }
  });
  }

/* time remaining to deadline*/
  /*clock*/
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
            document.getElementById('countdown').innerHTML = 'DEADLINE EXPIRED!';

            return;
        }
        var days = Math.floor(distance / _day);
        var hours = Math.floor((distance % _day) / _hour);
        var minutes = Math.floor((distance % _hour) / _minute);
        var seconds = Math.floor((distance % _minute) / _second);
        document.getElementById('countdown').innerHTML = 'Time Remaining ';
        document.getElementById('countdown').innerHTML = days + 'days ';
        document.getElementById('countdown').innerHTML += hours + 'hrs ';
        document.getElementById('countdown').innerHTML += minutes + 'mins ';
        document.getElementById('countdown').innerHTML += seconds + 'secs';
    }

    timer = setInterval(showRemaining, 1000);
/* time remaining to deadline*/

/*Function to save comments*/
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
        $("#msg").html(data);

      },
      error:function (){}
    });
   };

/* //Function to save comments*/



</script>
</body>
</html>