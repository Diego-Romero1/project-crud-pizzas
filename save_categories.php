<?php
//this adds new category's name
$category = $_POST['categoria'];

include_once("config_products.php");
include_once("db.php");
$link = new Db();
$sql = "INSERT INTO categories (category_name) VALUES (:category)";
$stmt = $link->prepare($sql);
$stmt->bindValue(':category', $category);

if ($stmt->execute()) {
?>
    <script>
        alert("Categoria Ingresada Correctamente!");
        window.location = "welcome.php";
    </script>
<?php
}
?>

