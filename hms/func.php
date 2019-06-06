<?php
session_start();
$con=mysqli_connect("localhost","root","","hmsdb");
if(isset($_POST['login_submit'])){
	$username=$_POST['username'];
	$password=$_POST['password'];
	$query="select * from logintb where username='$username' and password='$password';";
	$result=mysqli_query($con,$query);
	if(mysqli_num_rows($result)==1)
	{
		$_SESSION['username']=$username;
		header("Location:admin-panel.php");
	}
	else
		header("Location:error.php");
}
if(isset($_POST['update_data']))
{
	$stu_id=$_POST['stu_id'];
	$status=$_POST['status'];
	$query="update appointmenttb set payment='$status' where stu_id='$stu_id';";
	$result=mysqli_query($con,$query);
	if($result)
		header("Location:updated.php");
}
function display_student_details()
{
	global $con;
	$query="select * from appointmenttb";
	$result=mysqli_query($con,$query);
	while($row=mysqli_fetch_array($result))
	{
		 $stu_name=$row['stu_name'];
    $stu_id=$row['stu_id'];
    $email=$row['email'];
    $contact=$row['contact'];
    $payment=$row['payment'];
    echo '<tr>
      <td>'.$stu_name.'</td>
      <td>'.$stu_id.'</td>
      <td>'.$email.'</td>
      <td>'.$contact.'</td>
      <td>'.$payment.'</td>
    </tr>';
	}
}

?>