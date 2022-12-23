<?php

    //incluimos nosso arquivo config
    include 'config/config.php'; 

    // Incluimos nosso arquivo funciones
    include 'config/funciones.php';

    // Obter o ID do evento
    $id  = evaluar($_GET['id']);

    // procurando o banco de dados
    $bd  = $conexion->query("SELECT * FROM agenda WHERE id=$id");

    // Obtendo os resultados
    $row = $bd->fetch_assoc();

    // titulo 
    $titulo=$row['title'];

    // corpo
    $evento=$row['body'];

    // Fecha inicio
    $inicio=$row['inicio_normal'];

    // Fecha Termino
    $final=$row['final_normal'];

// Eliminar evento
if (isset($_POST['eliminar_evento'])) 
{
    $id  = evaluar($_GET['id']);
    $sql = "DELETE FROM agenda WHERE id = $id";
    if ($conexion->query($sql)) 
    {
        echo "Evento eliminado";
        
       
    }
    else
    {
        echo "El evento no se pudo eliminar";
    }
}
 ?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title><?=$titulo?></title>
        <link rel="stylesheet" type="text/css" href="./css/bootstrap.min.css">
</head>
<body>
	 <h3><?=$titulo?></h3>
	 <hr>
     <b>Data de início:</b> <?=$inicio?> <br>
     <b>Data do Termino:</b> <?=$final?>  <br>
 	 <b>Descrição:</b><p><?=$evento?></p>
</body>
<form action="" method="post">
     <div class="modal-footer">
    <button type="submit" class="btn btn-danger" name="eliminar_evento">Eliminar</button>
</div>
</form>
</html>