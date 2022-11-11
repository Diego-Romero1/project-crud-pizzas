<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" />
    <link rel="stylesheet" href="css/all.css">
    <link rel="stylesheet" href="css/styles.css">
    <title>Add categories</title>
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h3 class="text-center">Ingreso de Categorias</h3>
            </div>
            <div class="col-md-12">
                <form class="form-group" accept-charset="utf-8" action="save_categories.php" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <br>
                        <label class="control-label" for="categoria">Categoria</label>
                        <input type="text" required=" " placeholder="Ingrese la nueva categoria" class="form-control" id="categoria" name="categoria">
                    </div>
                   
                    <div class="form-group">
                        <br>
                        <label class="control-label" for="categoria">CATEGORIA DEL PRODUCTO</label>
                        <select id="categoria" name="categoria" class="form-control">
                            <?php
                            include_once("config_products.php");
                            include_once("db.php");
                            $link = new Db();
                            $sql = "select id_category, category_name from categories order by category_name asc";
                            $stmt = $link->prepare($sql);
                            $stmt->execute();
                            $data = $stmt->fetchAll();

                            ?>
                        </select>
                    </div>
                    
                    <div class="text-center">
                        <input type="submit" class="btn btn-success" value="Añadir Categoria">
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"></script>

</html>