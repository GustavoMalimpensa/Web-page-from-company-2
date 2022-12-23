<?php

    if(isset($_POST['submit']))
    {
        // print_r('motivo_uso: ' . $_POST['motivo_uso']);
        // print_r('<br>');
        // print_r('data_locacao: ' . $_POST['data_locacao']);
        // print_r('<br>');
        // print_r('imagem: ' . $_POST['imagem']);
        // print_r('<br>');
        // print_r('tipo_imagem: ' . $_POST['tipo_imagem']);
        // print_r('<br>');
        // print_r('descricao: ' . $_POST['descricao']);
        
        include_once('config.php');
        $motivo_uso = $_POST['motivo_uso'];
        $data_locacao = $_POST['data_locacao'];
        $imagem = $_POST['imagem'];
        $vtipo_imagem = $_POST['tipo_imagem'];
        $descricao = $_POST['descricao'];
        $result = mysqli_query($conexao, "INSERT INTO car(motivo_uso,data_locacao,imagem,tipo_imagem,descricao) 
        VALUES ('$motivo_uso','$data_locacao','$imagem,','$tipo_imagem','$descricao')");
        header('Location: login.php');
    }

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
     
     
        fieldset{
            border: 3px solid MediumVioletRed;
        }
        legend{
            border: 1px solid MediumVioletRed;
            padding: 10px;
            text-align: center;
            background-color: MediumVioletRed;
            border-radius: 8px;
        }
        .inputBox{
            position: relative;
        }
        .inputUser{
            background: none;
            border: none;
            border-bottom: 1px solid white;
            outline: none;
            color: white;
            font-size: 15px;
            width: 100%;
            letter-spacing: 2px;
        }
        .labelInput{
            position: absolute;
            top: 0px;
            left: 0px;
            pointer-events: none;
            transition: .5s;
        }
        .inputUser:focus ~ .labelInput,
        .inputUser:valid ~ .labelInput{
            top: -20px;
            font-size: 12px;
            color: MediumVioletRed;
        }
        #data_nascimento{
            border: none;
            padding: 8px;
            border-radius: 10px;
            outline: none;
            font-size: 15px;
        }
        #submit{
            background-image: linear-gradient(to right,rgb(199,21,133), rgb(255,20,147));
            width: 100%;
            border: none;
            padding: 15px;
            color: white;
            font-size: 15px;
            cursor: pointer;
            border-radius: 10px;
        }
        #submit:hover{
            background-image: linear-gradient(to right,rgb(255,105,180), rgb(219,112,147));
        }
    </style>
</head>
<body>
    <!--barra-menu-->
    <nav class="navbar navbar-expand-lg navbar-light" style="background-color: 	#C71585;">
        <a class="navbar-brand" >Estrutura Dinamica</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#conteudoNavbarSuportado" aria-controls="conteudoNavbarSuportado" aria-expanded="false" aria-label="Alterna navegação">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="conteudoNavbarSuportado">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="/teste/sistema.php">Home </a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="/teste/check_in.php">Check in</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="/teste/check_out.php">Check out</a>
                </li>
            </ul>
        </div>
    </nav>
    <!--barra-menu-->
    
    <!--Formulario checkin-->
    <div class="box">
        <form action="formulario.php" method="POST">
            <fieldset>
                <legend><b>Fórmulário de Check-in</b></legend>
                <br>
                <div class="inputBox">
                    <input type="text" name="name" id="name" class="inputUser" required>
                    <label for="name" class="labelInput">motivo_uso </label>motivo_uso

                </div>
                <div class="inputBox">
                    <input type="text" name="name" id="name" class="inputUser" required>
                    <label for="name" class="labelInput">data_locacao</label>
                </div>
                <br>
                <div class="inputBox">
                    <input type="text" name="email" id="email" class="inputUser" required>
                    <label for="email" class="labelInput">imagem/label>
                </div>
                <br>
                <label for="data_nascimento"><b>Dtipo_imagem</b></label>
                <input type="date" name="data_nascimento" id="data_nascimento" required>
                <br><br>
                <div class="form-group col-md-4">
                    <label for="inputState">State</label>
                    <select id="inputState" class="form-control">descricao
                        <option selected>Choose...</option>
                        <option>...</option>
                    </select>
                </div>
                <fieldset class="form-group">
    <div class="row">
      <legend class="col-form-label col-sm-2 pt-0">Radios</legend>
      <div class="col-sm-10">
        <div class="form-check">
          <input class="form-check-input" type="radio" name="gridRadios" id="gridRadios1" value="option1" checked>
          <label class="form-check-label" for="gridRadios1">
            First radio
          </label>
        </div>
        <div class="form-check">
          <input class="form-check-input" type="radio" name="gridRadios" id="gridRadios2" value="option2">
          <label class="form-check-label" for="gridRadios2">
            Second radio
          </label>
        </div>
        <div class="form-check disabled">
          <input class="form-check-input" type="radio" name="gridRadios" id="gridRadios3" value="option3" disabled>
          <label class="form-check-label" for="gridRadios3">
            Third disabled radio
          </label>
        </div>
      </div>
    </div>
  </fieldset>

  <form class="form-inline">
  <label class="my-1 mr-2" for="inlineFormCustomSelectPref">Preference</label>
  <select class="custom-select my-1 mr-sm-2" id="inlineFormCustomSelectPref">
    <option selected>Choose...</option>
    <option value="1">One</option>
    <option value="2">Two</option>
    <option value="3">Three</option>
  </select>
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
   
                <form enctype="multipart/form-data" action="upload.php" method="post">
                    <div><input name="nome_evento" type="text"/></div>
                    <div><input name="descricao_evento" type="textarea"/></div>
                    <input type="hidden" name="MAX_FILE_SIZE" value="99999999"/>
                        <div><input name="imagem" type="file"/></div>
                        <div><input type="submit" value="Salvar"/></div>
                </form>
                <br><br>         
                <input type="submit" name="submit" id="submit">
            </fieldset> 
        </form>
    </div>
    <!--formulario imagem-->
</body>
</html>



        

