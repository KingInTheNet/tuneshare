<!DOCTYPE html>
<?php require 'admin/user/login.php';?>
<html>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>Đăng nhập</title>
  <style type="text/css">
          /* Bordered form */
      form {
          border: 3px solid #f1f1f1;
      }

      /* Full-width inputs */
      input[type=text], input[type=password] {
          width: 100%;
          padding: 12px 20px;
          margin: 8px 0;
          display: inline-block;
          border: 1px solid #ccc;
          box-sizing: border-box;
      }

      /* Set a style for all buttons */
      button {
          background-color: #4CAF50;
          color: white;
          padding: 14px 20px;
          margin: 8px 0;
          border: none;
          cursor: pointer;
          width: 100%;
      }

      /* Add a hover effect for buttons */
      button:hover {
          opacity: 0.8;
      }

      /* Extra style for the cancel button (red) */
      .cancelbtn {
          width: auto;
          padding: 10px 18px;
          background-color: #f44336;
      }

      /* Center the avatar image inside this container */
      .imgcontainer {
          text-align: center;
          margin: 15px 0 12px 0;
      }

      /* Avatar image */
      /*img.avatar {
          width: 40%;
          border-radius: 50%;
      }
  */
      /* Add padding to containers */
      .container {
          padding: 16px;
      }

      /* The "Forgot password" text */
      span.psw {
          float: right;
          padding-top: 16px;
      }

      /* Change styles for span and cancel button on extra small screens */
      @media screen and (max-width: 100px) {
          span.psw {
              display: block;
              float: none;
          }
          .cancelbtn {
              width: 100%;
          }
      }
        /* The Modal (background) */
    .modal {
        display: none; /* Hidden by default */
        position: fixed; /* Stay in place */
        z-index: 1; /* Sit on top */
        left: 0;
        top: 0;
        width: 100%; /* Full width */
        height: 100%; /* Full height */
        overflow: auto; /* Enable scroll if needed */
        background-color: rgb(0,0,0); /* Fallback color */
        background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
        padding-top: 60px;
    }

    /* Modal Content/Box */
    .modal-content {
        background-color: #fefefe;
        margin: 5px auto; /* 15% from the top and centered */
        border: 1px solid #888;
        width: 80%; /* Could be more or less, depending on screen size */
    }

    /* The Close Button */
    .close {
        /* Position it in the top right corner outside of the modal */
        position: absolute;
        right: 25px;
        top: 0; 
        color: #000;
        font-size: 35px;
        font-weight: bold;
    }

    /* Close button on hover */
    .close:hover,
    .close:focus {
        color: red;
        cursor: pointer;
    }

    /* Add Zoom Animation */
    .animate {
        -webkit-animation: animatezoom 0.6s;
        animation: animatezoom 0.6s
    }

    @-webkit-keyframes animatezoom {
        from {-webkit-transform: scale(0)} 
        to {-webkit-transform: scale(1)}
    }

    @keyframes animatezoom {
        from {transform: scale(0)} 
        to {transform: scale(1)}
    }
  </style>
</head>
<body>
  <!-- Button to open the modal login form -->
  <button onclick="document.getElementById('id01').style.display='block'">Login</button>

  <!-- The Modal -->
  <div id="id01" class="modal">
    <span onclick="document.getElementById('id01').style.display='none'" 
  class="close" title="Close Modal">&times;</span>

    <!-- Modal Content -->
    <form class="modal-content animate" name="login" method="POST" action="<?php $_PHP_SELF ?>">
      <div class="imgcontainer">
        <h1>Login</h1>
      </div>

      <div class="container">
        <?php if(isset($error) && $error == true): ?>
        <p style="color:red;">Sai Tài khoản hoặc Mật khẩu!</p>
        <?php endif; ?>
        <label><b>Username</b></label>
        <input type="text" placeholder="Enter Username" name="username" required>

        <label><b>Password</b></label>
        <input type="password" placeholder="Enter Password" name="password" required>

        <button type="submit" value="Đăng nhập">Login</button>
        <input type="checkbox" checked="checked"> Remember me
      </div>

      <div class="container" style="background-color:#f1f1f1">
        <button type="button" onclick="document.getElementById('id01').style.display='none'" class="cancelbtn">Cancel</button>
        <span class="psw">Forgot <a href="#">password?</a></span>
      </div>
    </form>
  </div>
</body>
</html>