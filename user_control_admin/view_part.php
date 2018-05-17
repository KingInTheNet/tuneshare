<?php session_start();
if(isset($_SESSION['admin']))
    {?>
<!DOCTYPE html>
<html>
    <head>
        <title>View_Trang</title>
    </head>
    <body>
        <?php
        // khao bao bien de phan trang
        require'../configs/connect.php';
        $display_perpages=5;
        $result=mysqli_query($conn,"SELECT * FROM user_info");
        $total_rows= mysqli_num_rows($result);
        $number_pages=ceil($total_rows/$display_perpages);
        if(isset($_GET['page'])&&is_numeric($_GET['page']))
        {
            $pages=$_GET['page'];
            if($pages>0&&$pages<=$number_pages){ $start=($pages-1)*$display_perpages;
            $end= $display_perpages;}                                                      
            else{ $start=0;$end=$display_perpages;}
        }
        else{ $page=1;$start=0;$end=$display_perpages;}
        // content
        echo "<p><a href='view_all.php'>View All</a> | <b>View Page:</b> ";
            for ($i = 1; $i <= $number_pages; $i++)
            {
                echo "<a href='view_part.php?page=$i'>$i</a> ";
            }
        echo "<table border='1' cellpadding='10'>";
        echo "<tr>  <th>user_id</th>
                <th>user_avr</th> 
                <th>username</th>
                <th>password</th>
                <th>fav</th>
                <th>playlist</th>
                <th></th>
                <th></th>
         </tr>";
         $result2=mysqli_query($conn,"SELECT * FROM user_info");
         while($row=mysqli_fetch_array($result2))
         {
            echo "  <tr>";
    echo        '<td>'.$row['user_id'].'</td>';
    echo         '<td><img style="width:150px; height:150px; "src="../'.$row['avr'].'"></td>';
    echo       '<td>'.$row['user_name'].'</td>';
    echo       '<td>'.$row['passwd'].'</td>';
    echo       '<td>'.$row['fav'].'</td>';
    echo       '<td><a href="edit_user.php?id='.$row['user_id'].'">edit</a></td>';
    echo       '<td><a href="delete_user.php?id='.$row['user_id'].'">delete</a></td>';
          
    echo     "</tr>"
        ;
         }
        
        ?>
        <div><p><a href='new_user.php'>Add New Record</a></p></div>
    </body>
</html>
<?php
}
    else { header('location:../home.php');} ?>