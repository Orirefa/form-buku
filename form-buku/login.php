<?php
include 'koneksi.php';
session_start();
if (isset($_SESSION['username'])) {
    header("Location: index.php");
} 	
			if(isset($_POST['submit'])){
				

				$user= $_POST['user'];
				$pass = $_POST['pass'];

				$cek = mysqli_query($koneksi, "SELECT * FROM tb_login WHERE username = '".$user."' AND password = '".$pass."'");
				if(mysqli_num_rows($cek) > 0){
					$d = mysqli_fetch_assoc($cek);
					$_SESSION['status_login'] = true;
					$_SESSION['a_global'] = $d;
					$_SESSION['id'] = $d->admin_id;
					$_SESSION['username'] = $d['username'];
        header("Location: index.php");
				}else{
					echo '<script>alert("Username atau password Anda salah!")</script>';
				}

			}
        ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login | Book Store</title>
    <link rel="stylesheet" type="text/css" href="stylelogin.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300&display=swap" rel="stylesheet">
</head>



<body id="bg-login">
    <div class="box-login">
      <!--<h2>Login</h2>-->

        <form action="" method="POST">
            <input type="text" name="user" placeholder="Username" class="input-control">
            <input type="password" name="pass" placeholder="Password" class="input-control">
            <input type="submit" name="submit" value="Login" class="btn">
        </form>
        
    </div>
</body>
</html>