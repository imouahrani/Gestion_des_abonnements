<?php
session_start();

if(isset($_SESSION['role'])){

	if($_SESSION['role']=='Admin' OR $_SESSION['role']=='su'){
		header('Location:../app/admin/admin.php');

	}else if($_SESSION['role']=='Simple'){
		header('Location:../app/simple/simple.php');

	}else{
		header('Location:conn_form.php');
	}
}else{
header('Location:conn_form.php');
}

?>

