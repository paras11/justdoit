

<!doctype html>
<html lang="en">
<head>
<meta charset="UTF-8">
  <title>ToDo</title>
  <link rel="stylesheet" type="text/css" href="style.css">
   
   <?php
   include("connect.php");
   
   ?>

</head>
<body>
     <div class="wrapper">
	<header>
	 
	 <div class="he">
	 <img src="get.jpg" height="80px"></img>
	 <img src="click.png" id="click" onclick="toggle_visibility('f');"></img>
	 </div>
	 <script type="text/javascript">
   function toggle_visibility(id) {
       var e = document.getElementById(id);
       if(e.style.display == 'block')
          e.style.display = 'none';
       else
          e.style.display = 'block';
   }
</script>

	 <div id="f">
	   <form  method="post" action="index.php">
            <input class="a" type="text" placeholder="Enter A Task..." name="tasktitle" size="30" required/><br>
		    <textarea name="taskdesc" id="description" placeholder="Enter Description here...." required></textarea><br>
		    <input id="submit" type="submit" name="submit" value="Submit"/>
	   </form>
		</div>
		
		    <div class="tile">
		       <form class="p" method="post" action="index.php">
		           <input type="submit" name="pending" value="Pending" id="pending"></input>
		           <input type="submit" name="completed" id="completed" value="Completed"></input>
		       </form>
		   </div>
	
	
	</header>
	
	            
	            <?php
	
    $pend=@$_POST['pending'];
	$comp=@$_POST['completed'];
	
	
	if(isset($comp))
	{
		
		$show="select * from data where status ='1'";
		  
				  
		if($result=$con->query($show))
	{
		if($result->num_rows>0)
		{ while($row=$result->fetch_array())
			{   $id=$row[0];
				$title=$row[1];
				$descript=$row[2];
				
			echo '<div class="post">';
			echo '<u><b><text>'.$title.'</text></b></u><br>';
			echo '<text>'.$descript.'</text>';
			
                
		 
			
			echo'</div>';
			}
		}
		else{
			echo"No Completed Task.";
		    }
	}
	else{
		echo"query error";
	     }
	
	}
	else{
		$show="select * from data where status ='0'";
		if($result=$con->query($show))
	{
		if($result->num_rows>0)
		{ while($row=$result->fetch_array())
			{   $id=$row[0];
				$title=$row[1];
				$descript=$row[2];
				
			echo '<div class="post">';
		    echo '<u><b>'.$title.'</b></u><br>';
			echo $descript;
			echo'<div class="but"><form method="post" action="index.php">
		                           <input type="image" name="delete'.$id.'" src="delred.png" width="30" height="30" id="butdel"></input>
		                           <input type="image" name="done'.$id.'"  src="done.png" width="35" height="33" id="butdone" ></input>
		                          </form></div>';
			
		
		  if(isset($_POST['delete'.$id.'_x'])||isset($_POST['delete'.$id.'_y']))
		  {
			  $del="delete from data where id='$id'";
			  if($con->query($del)==true)
			  {
				  header("Location: index.php"); 
			  }
			  else
			  {echo"query err";
				 
			  }
		  }
		  if(isset($_POST['done'.$id.'_x'])||isset($_POST['done'.$id.'_y']))
		  {
			  $up="update data set status='1' where id='$id'";
			  if($con->query($up)==true)
			  {
				  header("location:index.php");
			  }
		  }
		
			
			echo'</div>';
			}
		}
		else{
			echo"No pending tasks";
		}
	}
	else{
		echo"query error";
	}
		
	}
	$newtitle=@$_POST['tasktitle'];
	$newdesc=@$_POST['taskdesc'];
	if(isset($_POST['submit']))
	{
		if($con==true)
		{    
			$quer="insert into data values('0','$newtitle','$newdesc','0')";
			if($con->query($quer)==true)
			{
				header("Location: index.php");
			}
			else{
				echo"query prob";
			}
		}
	}
	
		
	?>
	
	</div>
	</body>


</html>