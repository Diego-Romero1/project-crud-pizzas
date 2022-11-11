<!DOCTYPE html>
<html lang="en">

<head>
  <script src="js/jquery-3.6.1.min.js"> </script>
  <script src="js/bootbox.min.js"></script>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Welcome</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css">
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Kalam&display=swap" rel="stylesheet" />
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@200&display=swap" rel="stylesheet" />
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Work+Sans:ital,wght@1,300&display=swap" rel="stylesheet">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Lobster&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="css/all.css">
  <link rel="stylesheet" href="css/styles.css">
  <script>
    function deleteProduct(cod) {
      bootbox.confirm("Desea eliminar el producto" + cod, function(result) {
        if (result) {
          window.location = "delete.php?q=" + cod;
        }
      });
    }

    function updateProduct(cod) {
      window.location = "edit.php?q=" + cod;
    }
  </script>
</head>

<body>
  <?php
  session_start();
  if ($_SESSION['logueado']) {

    echo "<strong>" . "Bienvenid@ " . $_SESSION['username'] . "</strong>";
    echo "<br>";
    echo "<br>";
    echo "Horario de ingreso " . $_SESSION['time'];
  } else {
    header('location:login.html');
  }
  ?>
  <br>
  <br>
  <a href="insert_products.php" class="btn btn-primary">Ingresar Producto</a>
  <br>
  <br>
  <?php


  include_once("config_products.php");
  include_once("db.php");

  $link = new Db();/*Objeto*/
  $sql = "SELECT p.id_product, p.product_name, p.price, date_format(p.start_date,'%d/%m/%Y') as date , c.category_name from products p inner join categories c on c.id_category=p.id_category order by c.category_name asc;";
  $stmt = $link->prepare($sql);
  $stmt->execute();
  $data = $stmt->fetchAll();
  $table = "<table class='table table-bordered table-striped'>
<thead class='thead-dark'>
<tr> <th> Id </th>
      <th>Producto</th>
      <th>Categoria</th>
      <th>Precio</th>
      <th>Fecha de Alta</th>
      <th>Eliminar</th>
      <th>Actualizar</th>
                          </tr>
                                </thead> <tbody>";
  echo $table;
  foreach ($data as $row) {
  ?>
    <tr>
      <td>
        <?php echo $row['id_product'] ?>
      </td>
      <td>
        <?php echo $row['product_name'] ?>
      </td>
      <td>
        <?php echo $row['category_name'] ?>
      </td>
      <td>
        <?php echo $row['price'] ?>
      </td>
      <td>
        <?php echo $row['date'] ?>
      </td>
      <td>
        <a href="#" onclick="deleteProduct(<?php echo $row['id_product'] ?>)">Eliminar Producto </a>
      </td>
      <td>
        <a href="#" onclick="updateProduct(<?php echo $row['id_product'] ?>)">Actualizar Producto</a>
      </td>
    </tr>

  <?php
  }
  echo "</tbody>";
  echo "</table>";
  ?>

  <br>
  <br>
  <br>

  <a href="insert_category.php" class="btn btn-primary">Ingresar Categoria</a>
  <br>
  <br>
  <?php
  $sqlCtg = "select id_category, category_name from categories order by id_category asc";
  $stmtCtg = $link->prepare($sqlCtg);
  $stmtCtg->execute();
  $dataCtg = $stmtCtg->fetchAll();

  $table = "<table class='table table-bordered table-striped'>
<thead class='thead-dark'>
  <tr>
    <th> Id </th>
    <th>Nombre de Categoria</th>
    <th>Eliminar</th>
  </tr>
</thead> <tbody>";
  echo $table;
  foreach ($dataCtg as $row) {
  ?>
    <tr>
      <td>
        <?php echo $row['id_category'] ?>
      </td>
      <td>
        <?php echo $row['category_name'] ?>
      </td>
      <td>
        <a href="#" onclick="deleteCategory(<?php echo $row['id_category'] ?>)">Eliminar Categoria </a>
      </td>
    </tr>

  <?php
  }
  echo "</tbody>";
  echo "</table>";

  $stmt = $link->query("select count(*) from products");
  $column = $stmt->fetchColumn();
  echo "<div class='font-weight-bold'>la cantidad de productos existentes es: $column</div>"
  ?>


  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>

<?php
echo "<a href= 'logout.php'>Logout</a>";
?>
<br>
<br>
<br>