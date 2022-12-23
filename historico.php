<?php
    session_start();
    include_once('config.php');
    // print_r($_SESSION);
    if((!isset($_SESSION['email']) == true) and (!isset($_SESSION['senha']) == true))
    {
        unset($_SESSION['email']);
        unset($_SESSION['senha']);
        header('Location: login.php');
    }
    $logado = $_SESSION['email'];
    if(!empty($_GET['search']))
    {
        $data = $_GET['search'];
        $sql = "SELECT * FROM user WHERE id LIKE '%$data%' or nome LIKE '%$data%' or email LIKE '%$data%' ORDER BY id DESC";
    }
    else
    {
        $sql = "SELECT * FROM user ORDER BY id DESC";
    }
    $result = $conexao->query($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title> EDcar</title>
    <style>
        body{
          background: linear-gradient(to right, rgb(255,20,147), rgb(255,105,180));
          color: white;
          text-align: center;
        }
        .table-bg{
            background: rgba(0, 0, 0, 0.3);
            border-radius: 15px 15px 0 0;
        }

        .box-search{
            display: flex;
            justify-content: center;
            gap: .1%;
        }
    </style>
</head>
<body>
    <!--menu-->
    <nav class="navbar navbar-expand-lg navbar-light" style="background-color: 	#C71585;">
        <img></img>
        <a class="navbar-brand" >Estrutura Dinamica</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#conteudoNavbarSuportado" aria-controls="conteudoNavbarSuportado" aria-expanded="false" aria-label="Alterna navegação">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="conteudoNavbarSuportado">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="/teste/sistema.php">Calendario</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="/teste/check_in.php">Check in</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="/teste/check_out.php">Check out</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="/teste/check_out.php">historico</a>
                </li>
                <li class="nav-item active">
            </ul>
        </div>
        <div class="d-flex">
            <a href="sair.php" class="btn btn-danger me-5">Sair</a>
        </div>
    </nav>
    <!--menu-->

    <!--apresentação-->
    <br>
    <?php
        echo "<h1>Bem vindo <u>$logado</u></h1>";
    ?>
    <!--apresentação-->

    <!--pesquisa-->
    <br>
    <div class="box-search">
        <input type="search" class="form-control w-25" placeholder="Pesquisar" id="pesquisar">
        <button onclick="searchData()" class="btn btn-outline-success my-2 my-sm-0" type="submit">Pesquisar
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
         </svg>
        </button>
     
    </div>
    <!--pesquisa-->

    <!--tabela dos ultimos usuario do carro-->
    <div class="m-5">
        <table class="table text-white table-bg">
            <thead>
                <tr>
                    <th scope="col">Nome</th>
                    <th scope="col">Carro Ultilizado</th>
                    <th scope="col">Data Check-In</th>
                    <th scope="col">Data Check-Out</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    while($user_data = mysqli_fetch_assoc($result)) {
                        echo "<tr>";
                        echo "<td>".$user_data['name']."</td>";
                        echo "<td>".$user_data['carro_ultilizado']."</td>";
                        echo "<td>".$user_data['data_check_in']."</td>";
                        echo "<td>".$user_data['data_nascimento']."</td>";
                    }
                    ?>
            </tbody>
        </table>
    </div>
</body>
<!--tabela dos ultimos usuario do carro-->

<!--back-and de pesquisa-->
<script>
    var search = document.getElementById('pesquisar');

    search.addEventListener("keydown", function(event) {
        if (event.key === "Enter") 
        {
            searchData();
        }
    });

    function searchData()
    {
        window.location = 'sistema.php?search='+search.value;
    }
</script>
<!--back-and de pesquisa-->
</html>