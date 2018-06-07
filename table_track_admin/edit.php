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
            <div><p><a href='../home.php'>Về trang chủ </a></p></div>
        <strong>ID:</strong><?php echo $id ;?>
        <form action="" method="POST" enctype="multipart/form-data"><!--enctype la bat buoc thi moi gui file dc-->
            <strong>track_avt    </strong><input type="file" name="UpLoadIMG" /><br/>
            <strong>track_link</strong><input type="file" name="UpLoadMP3" /><br/> <!--name phan biet ca dau space :(( mat ca buoi chieu))-->
            <strong>publishment(*year)</strong><input type="text" name="years" /><br/>
            <strong>track_name  </strong><input type="text" name="nametrack" /><br/>
            <strong>name_art    </strong><input type="text" name="nameartist" /><br/>
            <input type="submit" name="submit" value="Update"/>
        </form>
        </body>
    </head>
</html>
<?php

    require '../configs/connect.php';
    $result = mysqli_query($conn,"SELECT * FROM track WHERE track_id=$id");
    if(!$result) echo "query fail lòi".$result->$error;
    $row=mysqli_fetch_array($result);
    $cat = $row['category'];
    $result2 = mysqli_query($conn,"SELECT * FROM category WHERE cate_id=$cat");
    if(!$result2) echo "query fail lòi".$result2->$error;
    $row2=mysqli_fetch_array($result2);
  echo "<table border='1' cellpadding='10'>";
    echo "<tr>  <th>track_id</th> 
                <th>category</th>
                <th>publishment</th>
                <th>track_name</th>
                <th>track_link</th>
                <th>track_avt</th>
                <th>name_art</th>
                
         </tr>";
    echo "<tr>  <th>".$row['track_id']."</th> 
                <th>".$row2['cate_name']."</th>
                <th>".$row['publishment']."</th>
                <th>".$row['track_name']."</th>
                <th>".$row['track_link']."</th>
                <th>".$row['track_avt']."</th>
                <th>".$row['name_art']."</th>
                
         </tr>";
    if(isset($_POST['submit']))
    {   
           $publishment=mysqli_real_escape_string($conn,$_POST['years']);// cai nay de loai bo ki tu dac biet chua hieu lam
            $track_name=mysqli_real_escape_string($conn,$_POST['nametrack']);
           $name_art=mysqli_real_escape_string($conn,$_POST['nameartist']);
           
        if($publishment==''||$track_name==''||$name_art=='')
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
            
        //upmp3
    

     
            $folderMP3="uploads/";
            $folderMP32="../uploads/";
            $error2=array();
           $name_endMP3=$_FILES['UpLoadMP3']['name'];
           $file_sizeMP3=$_FILES['UpLoadMP3']['size'];
            $name_firstMP3=$_FILES['UpLoadMP3']['tmp_name'];
            $file_typeMP3=pathinfo($name_endMP3,PATHINFO_EXTENSION);
            $file_arrayMP3=array('mp3');
            if(!in_array(strtolower($file_typeMP3),$file_arrayMP3)){ $error2['UpLoadMP3']= "this file is ko nhan.\n"; }
            if($file_sizeMP3>50000000){$error2['UpLoadMP3']="file is lager(phai duoi 50MB)-->failed\n";}
            if(file_exists($folderMP32.$name_endMP3)){$error2['UpLoadMP3']="file da ton tai\n";}

            //up lentnao
            if(empty($error2)&&empty($error))
            {   move_uploaded_file($name_firstIMG,$folderIMG2.$name_endIMG);
                echo "upfileIMG successfully\n";
                move_uploaded_file($name_firstMP3,$folderMP32.$name_endMP3);
                echo "upfileMP3 successfully\n";
                $upALL=mysqli_query($conn,"UPDATE track SET track_link='$folderMP3$name_endMP3', publishment='$publishment',track_avt='$folderIMG$name_endIMG',name_art='$name_art',track_name='$track_name'  WHERE track_id='$id'  ");
            }
            else {echo 'failed: '.$error2['UpLoadMP3'];echo "failed: \n".$error['UpLoadIMG'];}
        
        }


    }
    }  else { header('location:../home.php');}
 

?>