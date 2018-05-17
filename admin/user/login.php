<?php 
session_start();
/*if(isset($_SESSION['user'] || isset($_SESSION['admin']){
  		header('location:../../../index2.php');}
*/
if (isset($_SESSION['user'])||(isset($_SESSION['admin']))){
	header('location:../../../home.php');
}
require '../../../models/user.php';


 if(isset($_POST['username'])  && !empty($_POST['username']) &&  isset($_POST['password']) && !empty($_POST['password'])){
// //Gán tài khoản, mật khẩu và quyền tài khoản nhận được từ form vào 3 biến tương ứng
 $username = $_POST['username'];
 $password = $_POST['password'];
 //insert_user($username,$password);
 try{
 	$user = get_user_by_username($username);
}
catch(Exception $e){
	echo'this is a stupid test';
}
 //insert_user($username,$password);
 if($user['passwd'] === ($password)){
// //Tạo session lưu thông tin thành viên đăng nhập thành công
 	if($user['isAdmin']==0){
 		$_SESSION['user'] = $user['user_name'];
 	}
 	else{
 		$_SESSION['admin'] = $user['user_name'];
 	}

 echo "Login sucessfull <br>";
 header('location:../../../home.php');
 }
else{
//Bật cờ lỗi
$error = true;
 }
 }


?>
