<?php

    if(isset($_POST['submit']))
    {
        // print_r('Nome: ' . $_POST['nome']);
        // print_r('<br>');
        // print_r('Email: ' . $_POST['email']);
        // print_r('<br>');
        // print_r('data_nascimento: ' . $_POST['telefone']);
        // print_r('<br>');
        // print_r('cnh: ' . $_POST['cidade']);
        // print_r('<br>');
        // print_r('validade: ' . $_POST['estado']);
        // print_r('<br>');
        // print_r('senha: ' . $_POST['endereco']);

        include_once('config/config.php');

        $nome = $_POST['nome'];
        $email = $_POST['email'];
        $data_nascimento = $_POST['data_nascimento'];
        $cnh = $_POST['cnh'];
        $validade = $_POST['validade'];
        $senha = $_POST['senha'];
        
        $result = mysqli_query($conexao, "INSERT INTO user(nome,email,data_nascimento,cnh,validade,senha) 
        VALUES ('$nome','$email','$data_nascimento','$cnh','$validade','$senha')");

        header('Location: login.php');
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EDcard</title>
    <link rel="stylesheet" href="./css/formulario.style.css">
</head>
<body>
    <a href="home.php">Voltar</a>
    <div class="box">
        <form action="formulario.php" method="POST">
            <fieldset>
                <legend><b>Fórmulário do Colaborado</b></legend>
                <br>
                <div class="inputBox">
                    <input type="text" name="name" id="name" class="inputUser" required>
                    <label for="name" class="labelInput">Nome completo</label>
                </div>
                <br>
                <div class="inputBox">
                    <input type="text" name="email" id="email" class="inputUser" required>
                    <label for="email" class="labelInput">E-mail</label>
                </div>
                <br>
                <label for="data_nascimento"><b>Data de Nascimento:</b></label>
                <input type="date" name="data_nascimento" id="data_nascimento" required>
                <br><br>
                <div class="inputBox">
                    <input type="text" name="cnh" id="cnh" class="inputUser" required>
                    <label for="cnh" class="labelInput">Numero da Cnh</label>
                </div>
                <br>
                <label for="validade"><b>Validade da Cnh</b></label>
                <input type="date" name="validade" id="data_nascimento" required>
                <br><br>
                <div class="inputBox">
                    <input type="password" name="senha" id="senha" class="inputUser" required>
                    <label for="senha" class="labelInput">Senha</label>
                </div>
                <br><br>         
                <input type="submit" name="submit" id="submit">
            </fieldset>
        </form>
    </div>  
</body>
</html>