<?php
session_start();
    if(isset($_SESSION['admin']))
    {
    if(isset($_GET['id'])&&is_numeric($_GET['id']))
    $id=$_GET['id'];
?>
<!DOCTYPE html>
<html>
    <title>Delete_Record-<?php echo $id ;?></title>
    <head>
        <body>
        <strong>ID:</strong><?php echo $id ;?>
        <form action="" method="POST" ><!--enctype la bat buoc thi moi gui file dc-->
            <strong>!!!Cân nhắc trước khi xóa</strong>
            <input type="submit" name="UpLoadIMG" value="Delete" /><br/>
        </form>
        </body>
    </head>
</html>
<?php
    require '../configs/connect.php';
    if(isset($_POST['UpLoadIMG']))
    {
        
            $upIMG=mysqli_query($conn,"DELETE FROM track WHERE track.track_id=$id");
             echo" da xoa"; 
        
    
    }
    else echo 'Nếu Xóa thì ấn Delete';
    }
    else { header('location:../home.php');}
?>