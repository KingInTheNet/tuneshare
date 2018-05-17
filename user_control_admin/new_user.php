<?php
    session_start();
?>
<?php
 if(isset($_SESSION['admin']))
    {
?>
<!DOCTYPE html>
<html>
    <title>New_Record</title>
    <head>
        <body>
        <form action="" method="POST" enctype="multipart/form-data"><!--enctype la bat buoc thi moi gui file dc-->
            <strong>user_id</strong><input type="text" name="user_id" /><br/>
            <strong>user_avr    </strong><input type="file" name="UpLoadIMG" /><br/>
            <!-- <strong>artist_cover</strong><input type="file" name="UpLoadMP3" /><br/>  --><!--name phan biet ca dau space :(( mat ca buoi chieu))-->
            <strong>username</strong><input type="text" name="user_name" /><br/>
            <strong>password</strong><input type="text" name="passwd" /><br/>
      
            <input type="submit" name="submit" value="Upload"/>
        </form>
        </body>
    </head>
</html>
<?php

    require '../configs/connect.php';
    if(isset($_POST['submit']))
    {   
           $user_id=mysqli_real_escape_string($conn,$_POST['user_id']);// cai nay de loai bo ki tu dac biet chua hieu lam
           $user_name=mysqli_real_escape_string($conn,$_POST['user_name']);
            $passwd=mysqli_real_escape_string($conn,$_POST['passwd']);
           
        if($name==''||$country=='')
        {       echo "Ban phai dien het cac o\n";}
        else{
          //Upload img
            
            $folderIMG="uploads/";
            $folderIMG2="../uploads/";
            $error=array();
            $name_endIMG=$_FILES['UpLoadIMG']['name'];// **['name'] o day la mac dinh ['tmp'] cung vay-->name la file minh co the nhin thay dc con tmp name no thuoc phan sever() chua hieu lam
            $name_firstIMG=$_FILES['UpLoadIMG']['tmp_name'];
            $file_size=$_FILES['UpLoadIMG']['size'];
            $file_type=pathinfo($name_endIMG,PATHINFO_EXTENSION);// de lấy đuôi file day 
            $file_arrayIMG=array('png','jpeg','jpg','gif');
            if(!in_array(strtolower($file_type),$file_arrayIMG)){ $error['UpLoadIMG']= "this file is ko nhan.\n"; }//strtolower de HOA thanh thường
            if($file_size>50000000){$error['UpLoadIMG']="file is lager(phai duoi 50MB)-->failed\n";}
            if(file_exists($folderIMG2.$name_endIMG)){$error['UpLoadIMG']="file da ton tai\n";}
            
        //upmp3
    

     
           
            //up lentnao
            if(empty($error))
            {   move_uploaded_file($name_firstIMG,$folderIMG2.$name_endIMG);
                echo "upfileIMG successfully\n";
            
                $upALL=mysqli_query($conn,"INSERT INTO user_info (user_id,avr,user_name,passwd) VALUES ('$user_id','$folderIMG$name_endIMG','$user_name','$passwd') ");
            }
            else {echo "failed: \n".$error['UpLoadIMG'];}
        
        }


    }
    } else { header('location:../home.php');}
 

?>
