<?php 
    if(isset($_SESSION['admin'])){
      echo "Вход выполнен!";
      exit;
    }


    if(isset($_POST['name']) && isset($_POST['email']) && isset($_POST['message'])) {

      $name = $_POST['name']; 
      $email = $_POST['email'];   
      $msg = $_POST['message']; 


      $db_host = "localhost";
      $db_user = "root";
      $db_password = "";
      $db_base = "tasks";
      $db_table = "task";

      $mysqli = new mysqli($db_host,$db_user,$db_password,$db_base);

      if($mysqli->connect_error) {
          die('Ошибка : (' . $mysqli->connect_errno .') '. $mysqli->coonnect_error);
      }

      $mysqli->set_charset('utf8');

      $result = $mysqli->query("INSERT INTO ".$db_table."(name,email,message) VALUES ('$name','$email','$msg')");

      if ($result == true){
          echo "Информация занесена в базу данных";
      }else{
          echo "Информация не занесена в базу данных";
      }

  }


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Задачник</title>
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

    <hr />
    <p><a href="index.php">Главная</a> | <a href="admin.php">Админка</a></p>
    <hr />
    
    
<div class="margin-8"></div>
    
    <a href="admin.php?do=logout">Выход</a>


    
<div class="margin-8"></div>

      <h2>Задачи для выполнения при помощи PHP</h2>
      <hr>


<?php

//----------------------------------------------------------------------------------------------------------------/////
        
          
        $link = mysqli_connect("localhost","root", "","tasks");
          if ($link->connect_errno)
            die ('Ошибка! Не удалось подключиться к базе данных!' . $link->connect_errno);
                
          




        
        if (isset($_GET['page']))
          {
            $page = $_GET['page'];
          }	
        else
          $page = 1;
        
        $msg_on_page = 3;	//Количество записей на странице
        $start_from = ($page - 1) * $msg_on_page;
        $sql = "SELECT `name`, `email`, `message`
            FROM `task` 
            ORDER BY 'name' LIMIT $start_from, $msg_on_page";
            
        $result = mysqli_query($link,$sql);

        
        
          if (!$result){
            die('Error: ' . mysqli_error($link));
          }
          else
            {
              echo "<table class='table table_sort' id='myTable2'><thead>
              <tr>
                <th scope='col' onclick='sortTable(0)'>Имя</th>
                <th scope='col' onclick='sortTable(1)'>Email</th>
                <th scope='col'>Текст задачи</th>
              </tr>
            </thead>";

        
          
              while ($row = mysqli_fetch_array($result))
                {
                  echo "<tr>";
                  echo "<td>" . $row['name'] . "</td>";
                  echo "<td>" . $row['email'] . "</td>";
                  echo "<td>" . $row['message'] . "</td>";
                }
                    
              echo "</table>";
          }		 
        
        
      //------------------------------------------------------------------------------------------------------		
        
      
      //Пагинация
      $sql = "SELECT COUNT(id) FROM task";
      $result = mysqli_query($link,$sql);
      
      if (!$result)
        die('Error: ' . mysqli_error($link));
          
      else
        {
          $row = mysqli_fetch_array($result);
          $total_records = $row[0];
          $total_records = ceil($total_records / $msg_on_page);
          echo "<br>";
          for ($i = 1; $i <= $total_records; $i++)
          echo "<a href = 'index.php?page=" . $i . "'> " . $i . " </a>";
                        
        }		 
      
      mysqli_close($link);		
?>

<script>
function sortTable(n) {
  var table, rows, switching, i, x, y, shouldSwitch, dir, switchcount = 0;
  table = document.getElementById("myTable2");
  switching = true;
  dir = "asc";
  while (switching) {
    switching = false;
    rows = table.rows;
    for (i = 1; i < (rows.length - 1); i++) {
      shouldSwitch = false;
      x = rows[i].getElementsByTagName("TD")[n];
      y = rows[i + 1].getElementsByTagName("TD")[n];
      if (dir == "asc") {
        if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
          shouldSwitch = true;
          break;
        }
      } else if (dir == "desc") {
        if (x.innerHTML.toLowerCase() < y.innerHTML.toLowerCase()) {
          shouldSwitch = true;
          break;
        }
      }
    }
    if (shouldSwitch) {
      rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
      switching = true;
      switchcount ++;
    } else {
      if (switchcount == 0 && dir == "asc") {
        dir = "desc";
        switching = true;
      }
    }
  }
}
</script>

<div class="margin-8"></div>

  <h2>Добавить задачу</h2>
      <hr>

      <form method="POST" action="" >
        <div class="form-group">
          <input name="name" type="text" placeholder="ваше имя" class="form-control input-lg" >
        </div>
        <div class="form-group">
              <input name="email" type="text" placeholder="ваш email" class="form-control input-lg" >
            </div>
        <div class="form-group">
          <textarea name="message" type="text" class="form-control" ></textarea>
        </div>
        <input class="btn btn-lg btn-warning pull-right" type="submit" value="Отправить">
      </form>

<div class="margin-8 clear"></div>
</body>
</html>