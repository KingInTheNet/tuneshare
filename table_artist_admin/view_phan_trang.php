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
        $result=mysqli_query($conn,"SELECT * FROM artist");
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
        echo "<p><a href='view_artist.php'>View All</a> | <b>View Page:</b> ";
            for ($i = 1; $i <= $number_pages; $i++)
            {
                echo "<a href='view_phan_trang.php?page=$i'>$i</a> ";
            }
        echo "<table border='1' cellpadding='10'>";
        echo "<tr>  <th>artist_id</th>
                <th>artist_avr</th> 
                <th>artist_cover</th>
                <th>name</th>
                <th>artist_bỉrthday</th>
                <th>country</th>
                <th></th>
                <th></th>
         </tr>";
         $result2=mysqli_query($conn,"SELECT * FROM artist");
         while($row=mysqli_fetch_array($result2))
         {
            echo "  <tr>";
    echo        '<td>'.$row['artist_id'].'</td>';
    echo         '<td><img style="width:150px; height:150px; "src="'.$row['artist_avr'].'"></td>';
    echo       '<td><img style="width:150px; height:150px; "src="'.$row['artist_cover'].'"></td>';
    echo       '<td>'.$row['name'].'</td>';
    echo       '<td>'.$row['artist_birthday'].'</td>';
    echo       '<td>'.$row['country'].'</td>';
    echo       '<td><a href="edit_artist.php?id='.$row['artist_id'].'">edit</a></td>';
    echo       '<td><a href="delete_artist.php?id='.$row['artist_id'].'">delete</a></td>';
          
    echo     "</tr>"
        ;
         }
        
        ?>
        <div><p><a href='new_artist.php'>Thêm mới</a></p></div>
        <div><p><a href='../home.php'>Về trang chủ </a></p></div>
    </body>
</html>
<?php
}
    else { header('location:../home.php');} ?>