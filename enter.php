<?php 
    //echo md5('123');

    $admin = 'admin';
    $pass = '202cb962ac59075b964b07152d234b70';


    

       
if(isset($_POST['submit'])){
    if($admin == $_POST['user'] AND $pass == md5($_POST['pass'])){
     $_SESSION['admin'] = $admin;
     header("Location: index.php");
     echo "Вход выполнен!";
     exit;
    }else {
        echo '<p>Логин или пароль неверны!</p>';
    } 
   }


   if(isset($_SESSION['admin'])){
        header("Location: admin.php");
        exit;
       }

    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Авторизация</title>
    <!-- Bootstrap -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    <!-- CSS -->
    <link href="assets/css/style.css" rel="stylesheet">
</head>
<body>

<div class="container-fluid">
        <div class="row">
          
          <nav role="navigation" class="navbar navbar-inverse">
            <div class="container">
  
  
              <div class="navbar-header header">
  
                <div class="container">
                  <div class="row">
                    <div class="col-lg-12">
                      <h1><a href="index.php">Задачник для BeeJee</a> </h1>
                      <p>Читай и решай!</p>
                    </div>
                  </div>
                </div>


<p><a href="index.php">Главная</a> | <a href="admin.php">Админка</a></p>
<hr />
<div class="panel panel-info">
        <div class="panel-heading"><div class="sidebar-header">Вход</div></div>
        <div class="panel-body">
<br />

<form role="form" method="post">
            <div class="form-group">
                <input type="text"  class="form-control input-lg" placeholder="Логин" name="user" >
            </div>
            <div class="form-group">
                <input type="password" class="form-control input-lg" placeholder="Пароль" name="pass">
            </div>

            <input type="submit" class="btn btn-warning pull-right" name="submit" value="Войти">

            </form>

</body>
</html>

