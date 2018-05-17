<?php
    session_start();
    if(isset($_SESSION['admin']))
    {
    //display data from table track
    //1.connect to database
    echo "<p><a href='view_part.php'>View part</a>";
    require '../configs/connect.php';
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
    $resul=mysqli_query($conn,"SELECT * FROM user_info");
    if(!$resul) echo 'cant query!!'.$resul->error;
    else echo 'query successfully (connection)';
    //loop by result to display all database on table:
    while($row=mysqli_fetch_array($resul)){
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
    echo "</table>";
    echo " <div><p><a href='new_user.php'>Add New Record</a></p></div>";
 }
    else { header('location:../home.php');}

?>