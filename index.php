<?php
    // definindo o  fuso horário
    date_default_timezone_set("America/Sao_Paulo");

    // incluindo arquivo função
    include 'config/funciones.php';

    // incluindo arquivo configuração
    include 'config/config.php';

    // Verificamos se o campo com nome de foi enviado
    if (isset($_POST['from'])) {

        // Se foi enviado, verificamos se não vêm vazios
        if ($_POST['from'] != "" and $_POST['to'] != "") {

            // Recebemos a data de início e a data de término do formulário
            $Datein = date('d/m/Y H:i:s', strtotime($_POST['from']));
            $Datefi = date('d/m/Y H:i:s', strtotime($_POST['to']));
            $inicio = _formatear($Datein);
            // e formate-o com a função _format

            $final = _formatear($Datefi);

            // Recebemos a data de início e a data de término do formulário
            $orderDate = date('d/m/Y H:i:s', strtotime($_POST['from']));
            $inicio_normal = $orderDate;

            // e formate-o com a função _format
            $orderDate2 = date('d/m/Y H:i:s', strtotime($_POST['to']));
            $final_normal = $orderDate2;

            // Recebemos os demais dados do formulário
            $titulo = evaluar($_POST['title']);

            // e com a função de avaliação
            $body = evaluar($_POST['event']);

            // nós substituímos os caracteres não permitidos
            $clase = evaluar($_POST['class']);

            // inserimos o evento
            $query = "INSERT INTO agenda VALUES(null,'$titulo','$body','','$clase','$inicio','$final','$inicio_normal','$final_normal')";

            // executamos a sentença sql
            $conexion->query($query) or die('<script type="text/javascript">alert("Horario No Disponible ")</script>');

            header("Location: ??pra onde vai depois?
             ");
            // Obter o último id inserido

            $im = $conexion->query("SELECT MAX(id) AS id FROM agenda");
            $row = $im->fetch_row();
            $id = trim($row[0]);

            // para gerar o link do evento
            $link = "./config/descripcion_evento.php";

            // utilizamos seu link
            $query = "UPDATE agenda SET url = '$link' WHERE id = $id";

            // Executando a sentença sql
            $conexion->query($query);

            // redirecionamos para o nosso calendário 
        }
    }

    session_start();

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
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" type="text/css" href="./consultas/bootstrap.min.css">
    <link rel="stylesheet" href="./css/calendar.css">
    <link href="./consultas/font-awesome.min.css" rel="stylesheet">
    <script type="text/javascript" src="./js/es-ES.js"></script>
    <script src="./consultas/jquery.min.js"></script>
    <script src="./js/moment.js"></script>
    <script src="./consultas/bootstrap.min.js"></script>
    <script src="./consultas/bootstrap-datetimepicker.js"></script>
    <link rel="stylesheet" href="./consultas/bootstrap-datetimepicker.min.css" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="./consultas/bootstrap.min.css" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="./css/index.style.css">
    <title> EDcar</title>
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
    <div class="apresentação">
        <br>
        <?php
            echo "<h1>Bem vindo <u>$logado</u></h1>";
        ?> 
    </div>
    <!--apresentação-->

    <header style="background: DeepPink;">
        <div class="container">
            <!--cabeçario-->
            <div class="row">
                <div class="pull-left form-inline"><br>
                    <div class="btn-group">
                        <button class="btn btn-primary" data-calendar-nav="prev"><i class="fa fa-arrow-left"></i>  </button>
                        <button class="btn" data-calendar-nav="today">Hoje</button>
                        <button class="btn btn-primary" data-calendar-nav="next"><i class="fa fa-arrow-right"></i>  </button>
                    </div>
                    <div class="btn-group">
                        <button class="btn btn-warning" data-calendar-view="year">Ano</button>
                        <button class="btn btn-warning active" data-calendar-view="month">Mês</button>
                        <button class="btn btn-warning" data-calendar-view="week">Semana</button>
                        <button class="btn btn-warning" data-calendar-view="day">Dia</button>
                    </div>
                </div>
                <div class="pull-right form-inline"><br>
                    <button class="btn btn-info" data-toggle='modal' data-target='#add_evento'>Adicionar Evento</button>
                </div>
            </div>
            <!--cabeçario-->
            <br><br><br>
            <!-- calendário-->
            <div class="row">
                <div id="calendar"></div>   
            </div>
            <!-- calendário-->
            <!--janela modal para calendário-->
            <div class="modal fade" id="events-modal">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <a href="#" data-dismiss="modal" style="float: right;"> <i class="glyphicon glyphicon-remove "></i> </a>
                            <br>
                        </div>
                        <div class="modal-body" style="height: 400px">
                            <p>One fine body&hellip;</p>
                        </div> 
                    </div><!-- /.modal-content -->
                </div><!-- /.modal-dialog -->
            </div><!-- /.modal -->
        </div>
    </header>

    <script src="./consultas/underscore-min.js"></script>
    <script src="./js/calendar.js"></script>
    <script type="text/javascript">
        (function($){
                //criamos a data atual
                var date = new Date();
                var yyyy = date.getFullYear().toString();
                var mm = (date.getMonth()+1).toString().length == 1 ? "0"+(date.getMonth()+1).toString() : (date.getMonth()+1).toString();
                var dd  = (date.getDate()).toString().length == 1 ? "0"+(date.getDate()).toString() : (date.getDate()).toString();

                //definimos os valores do calendário
                var options = {

                    // Definimos que as agendas serão exibidas em uma janela modal
                    modal: '#events-modal', 

                        // dentro de um iframe
                        modal_type:'iframe',    

                        //obter a agenda do banco de dados
                        events_source: './config/obtener_eventos.php', 

                        // mostramos o calendário no mês
                        view: 'month',             

                        // e dia atual
                        day: yyyy+"-"+mm+"-"+dd,   

                        // definimos o idioma por padrão
                        language: 'es-ES', 

                        //Modelo do nosso calendário
                        tmpl_path: './tmpls/', 
                        tmpl_cache: false,

                        // Hora de inicio
                        time_start: '08:00', 

                        // e Hora final de cada dia
                        time_end: '22:00',   

                        // intervalo de tempo entre as hora, neste caso são 30 minutos
                        time_split: '30',    

                        // Definimos uma largura de 100% para o nosso calendário
                        width: '100%', 

                        onAfterEventsLoad: function(events)
                        {
                            if(!events)
                            {
                                return;
                            }
                            var list = $('#eventlist');
                            list.html('');

                            $.each(events, function(key, val)
                            {
                                $(document.createElement('li'))
                                .html('<a href="' + val.url + '">' + val.title + '</a>')
                                .appendTo(list);
                            });
                        },
                        onAfterViewLoad: function(view)
                        {
                            $('#page-header').text(this.getTitle());
                            $('.btn-group button').removeClass('active');
                            $('button[data-calendar-view="' + view + '"]').addClass('active');
                        },
                        classes: {
                            months: {
                                general: 'label'
                            }
                        }
                    };

                // id do div onde o calendário será exibido
                var calendar = $('#calendar').calendar(options); 

                $('.btn-group button[data-calendar-nav]').each(function()
                {
                    var $this = $(this);
                    $this.click(function()
                    {
                        calendar.navigate($this.data('calendar-nav'));
                    });
                });

                $('.btn-group button[data-calendar-view]').each(function()
                {
                    var $this = $(this);
                    $this.click(function()
                    {
                        calendar.view($this.data('calendar-view'));
                    });
                });

                $('#first_day').change(function()
                {
                    var value = $(this).val();
                    value = value.length ? parseInt(value) : null;
                    calendar.setOptions({first_day: value});
                    calendar.view();
                });
            }(jQuery));
        </script>
         <!-- cara responsavel pelo adicionar evento-->
        <div class="modal fade" id="add_evento" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="false">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Adicionar novo evento</h4>
            </div>
            <div class="modal-body">
                <form action="" method="post">
                    <label for="from">Inicio</label>
                    <div class='input-group date' id='from'>
                        <input type='text' id="from" name="from" class="form-control" readonly />
                        <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span>
                    </div>

                    <br>

                    <label for="to">Final</label>
                    <div class='input-group date' id='to'>
                        <input type='text' name="to" id="to" class="form-control" readonly />
                        <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span>
                    </div>

                    <br>

                    <label for="tipo">Tipo de evento</label>
                    <select class="form-control" name="class" id="tipo">
                        <option value="event-info">Informação</option>
                        <option value="event-success">Exito</option>
                        <option value="event-important">Importante</option>
                        <option value="event-warning">Aviso</option>
                        <option value="event-special">Especial</option>
                    </select>

                    <br>

                    <label for="title">Título</label>
                    <input type="text" required autocomplete="off" name="title" class="form-control" id="title" placeholder="Introduce un título">

                    <br>

                    <label for="body">Evento</label>
                    <textarea id="body" name="event" required class="form-control" rows="3"></textarea>

                    <script type="text/javascript">
                        $(function () {
                            $('#from').datetimepicker({
                                language: 'pt',
                                minDate: new Date()
                            });
                            $('#to').datetimepicker({
                                language: 'pt',
                                minDate: new Date()
                            });

                        });
                    </script>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i> Cancelar</button>
                  <button type="submit" class="btn btn-success"><i class="fa fa-check"></i>Adicionar</button>
              </form>
          </div>
           <!-- cara responsavel pelo adicionar evento-->
      </div>
  </div>
</div>
</body>
</html>
  