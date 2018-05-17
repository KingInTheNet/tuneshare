<?php session_start();    
if(isset($_SESSION['admin']))
    {
        if(isset($_GET['id'])&&is_numeric($_GET['id']))
        {
            $id=$_GET['id'];
        }
?>

<!DOCTYPE html>
<html>
    <title>Edit_Record-<?php echo $id ;?></title>
    <head>
        <body>
        <strong>ID:</strong><?php echo $id ;?>
        <form action="" method="POST" enctype="multipart/form-data"><!--enctype la bat buoc thi moi gui file dc-->
            <strong>user_avr   </strong><input type="file" name="UpLoadIMG" /><br/>
            <!-- <strong>artist_cover</strong><input type="file" name="UpLoadCOVER" /><br/> --> <!--name phan biet ca dau space :(( mat ca buoi chieu))-->
            <strong>user_name</strong><input type="text" name="name" /><br/>
            <strong>passwd</strong><input type="password" name="passwd" /><br/>
            <input type="submit" name="submit" value="Upload"/>
        </form>
        </body>
    </head>
</html>
<?php

    require '../configs/connect.php';
    if(isset($_POST['submit']))
    {   
           // $birthday=mysqli_real_escape_string($conn,$_POST['birthday']);// cai nay de loai bo ki tu dac biet chua hieu lam
            $name=mysqli_real_escape_string($conn,$_POST['name']);
           $passwd=mysqli_real_escape_string($conn,$_POST['passwd']);
           
        if($name==''||$country=='')
        {       echo "Ban phai dien het cac o\n";}
        else{
          //Upload img
            
            $folderIMG="uploads/";//gui duong dan link cho sql
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
            
        //Upload img 2
            
    

     
            

            //up lentnao
            if(empty($error))
            {   move_uploaded_file($name_firstIMG,$folderIMG2.$name_endIMG);
                echo "upfileIMG successfully\n";
                
                $upALL=mysqli_query($conn,"UPDATE user_info SET user_name='$name', artist_avr='$folderIMG$name_endIMG', passwd='$passwd'  WHERE artist_id='$id'  ");
            }
            else {echo "failed: \n".$error['UpLoadIMG'];}
        
        }


    }
    }  else { header('location:../home.php');}
 

?>