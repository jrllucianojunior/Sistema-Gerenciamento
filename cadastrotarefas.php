<?php
include('protect.php');
include('conexao.php');



if (!isset($_SESSION['nome']) || !isset($_SESSION['senha'])) {
    header('Location: login.php');
    exit();
}
?>



<?php
include_once('conexao.php');



if (isset($_POST['submit'])) {
    include_once('conexao.php');

    $nome_projeto = $_POST['projeto'];
    $usuario = $_POST['usuario'];
    $descricao = $_POST['descricao'];
    $observacao = $_POST['observacao'];
    $data_inicio = $_POST['data_inicio'];
    $data_prev_termino = $_POST['data_prev_termino'];
    $urgencia = $_POST['urgencia'];
    $finalizada = 0;


    

    // Consulta para buscar o código do projeto a partir do nome
    $query = "SELECT id_projeto FROM tb_projeto WHERE nome like '$nome_projeto'";
    $result = mysqli_query($con, $query);

    if ($row = mysqli_fetch_assoc($result)) {
        $cod_projeto = $row['id_projeto'];

        // Inserir na tabela de tarefas com o código do projeto obtido
        $insert_query = "INSERT INTO tb_tarefas(cod_projeto, nome_usuario, descricao, observacao, data_previsao_termino, urgencia, finalizada, data_inicio) 
                        VALUES ('$cod_projeto', '$usuario', '$descricao', '$observacao','$data_prev_termino', '$urgencia', '$finalizada', '$data_inicio')";

        // Executar a inserção
        if (mysqli_query($con, $insert_query)) {
            echo "<script>
            function openModal() {
                var modal = document.getElementById('myModal');
                modal.style.display = 'block';
                document.getElementById('Message').innerText = 'Tarefa cadastrada com sucesso';
            }

            function closeModal() {
                var modal = document.getElementById('myModal');
                modal.style.display = 'none';
            }

            // Chama a função ao carregar a página
            window.onload = function() {
                openModal();
            };
        </script>";
        } else {
            echo "<script>
            function openModal(message) {
                var modal = document.getElementById('myModal');
                modal.style.display = 'block';
                document.getElementById('Message').innerText = 'Erro ao cadastrar tarefa: <?php echo mysqli_error($con); ?>';
            }

            function closeModal() {
                var modal = document.getElementById('myModal');
                modal.style.display = 'none';
            }

            // Chama a função ao carregar a página
            window.onload = function() {
                openModal();
            };
        </script>";
        }
    } else {
        echo "Projeto não encontrado.";
    }
}
  

    $query_usuarios = "SELECT nome FROM tb_usuarios"; // Substitua 'tabela_usuarios' pelo nome da sua tabela de usuários
    $result_usuarios = mysqli_query($con, $query_usuarios);

    $usuarios = array();

    while ($row = mysqli_fetch_assoc($result_usuarios)) {
        $usuarios[] = $row['nome'];
    }



        
    $query_projetos = "SELECT nome FROM tb_projeto"; // Substitua 'tabela_usuarios' pelo nome da sua tabela de usuários
    $result_projetos = mysqli_query($con, $query_projetos);

    $projetos = array();

    while ($row = mysqli_fetch_assoc($result_projetos)) {
        $projetos[] = $row['nome'];
    }


?>





<!DOCTYPE html>
<html>
<head>
    <title>Cadastro de Tarefas</title>
    <style>
 

        .panel-header {
            background-color: #3498db;
            color: #fff;
            padding: 10px;
            border-radius: 5px 5px 0 0;
        }

        .panel-body {
            padding: 20px;
        }

    

        input[type="text"],
        textarea,
        select {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            border-radius: 3px;
            border: 1px solid #ccc;
            box-sizing: border-box;
        }

        input[type="date"] {
            width: calc(100% - 18px); /* Considerando a largura do padding e da borda */
        }

      

        /* Adicionando bolinhas ao lado das opções da urgência */
        select#urgencia {
            position: relative;
        }

        select#urgencia option {
            padding-left: 25px;
        }

        select#urgencia option::before {
            content: '';
            display: inline-block;
            width: 12px;
            height: 12px;
            border-radius: 50%;
            margin-right: 8px;
            vertical-align: middle;
        }

        /* Cores das bolinhas */
        select#urgencia option[value="baixa"]::before {
            background-color: green;
        }

        select#urgencia option[value="normal"]::before {
            background-color: yellow;
        }

        select#urgencia option[value="alta"]::before {
            background-color: red;
        }
    </style>
   
   <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"
        integrity="sha512-5LTi9lBRH5vVHvC+HVT8fNnsjyHsSgGqivZmRifdEIbh9C8rdNSpOWldqPQ8tuJXeUypRJ9BZw21grW8yjzJjw=="
        crossorigin="anonymous" />

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <link rel="stylesheet" href="forms.css">
    <link rel="stylesheet" href="modal.css">
    <link rel="stylesheet" href="menu.css">


</head>
<body>



    <div id="myModal" class="modal">
            <div class="modal-content">
                <span class="close" onclick="closeModal()">&times;</span>
                    <h2>Status do Cadastro</h2>
                    <p id="Message"></p>
            </div>
    </div>



    
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#"></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#conteudoNavbarSuportado"
        aria-controls="conteudoNavbarSuportado" aria-expanded="false" aria-label="Alterna navegação">
        <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="conteudoNavbarSuportado">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
            <a class="nav-link " href="http://localhost/PI3/indx.php">Inicio <span
                class="sr-only">(página atual)</span></a>
            </li>

        </ul>
        
        Bem vindo(a), <?php echo $_SESSION['nome']; ?>.

        </div>
    </nav>
      
</head>
<body>
    <!-- Menu lateral -->
    <div class="sidebar" style="height: calc(100%); top: 9%;  position: fixed; left: 0; background-color: #333; padding-top: 20px; margin-top: 0;">
      
        <a href="#" onclick="toggleSubMenu('projetos')">Projetos</a>
        <ul id="projetos" class="submenu">
            <li><a href="http://localhost/PI3/cadastroprojeto.php">Cadastrar Projeto</a></li>
            <li><a href="http://localhost/PI3/consultaprojetos.php">Consultar Projetos</a></li>
        </ul>
        
        <a href="#" onclick="toggleSubMenu('equipes')">Equipes</a>
        <ul id="equipes" class="submenu">
            <li><a href="http://localhost/PI3/cadastroequipe.php">Cadastrar Equipe</a></li>
            <li><a href="http://localhost/PI3/editarequipe.php">Consultar Equipe</a></li>
        </ul>
        
        <a href="#" onclick="toggleSubMenu('tarefas')">Tarefas</a>
        <ul id="tarefas" class="submenu">
            <li><a href="http://localhost/PI3/cadastrotarefas.php">Cadastrar Tarefa</a></li>
            <li><a href="http://localhost/PI3/cadastrotarefas.php">Consultar Tarefa</a></li>
        </ul>
        
        <a href="#" onclick="toggleSubMenu('compra')">Compra</a>
        <ul id="compra" class="submenu">
            <li><a href="http://localhost/PI3/cadastrocontas.php">Importar Nota</a></li>
            <li><a href="http://localhost/PI3/consultacontas.php">Consultar Compras</a></li>
        </ul>
        
        <a href="#" onclick="toggleSubMenu('contas')">Contas</a>
        <ul id="contas" class="submenu">
            <li><a href="http://localhost/PI3/cadastrocontas.php">Cadastrar Compras</a></li>
            <li><a href="http://localhost/PI3/consultacontas.php">Visualizar Compras</a></li>
        </ul>

        <a href="#" onclick="toggleSubMenu('contas')">Chat</a>
        <ul id="contas" class="submenu">
            <li><a href="http://localhost/PI3/Chat/index.html">Cadastrar Compras</a></li>
            
        </ul>
    </div>





    <div class="content">
        <div class="panel">   
            <div class="panel-body">
                <form  method="post">
                <div class="input-group flex-container">
                <div class = "flex-item">
                    <label for="projeto">Projeto:</label>
                        <select id="projeto" name="projeto" required>
                            <?php foreach ($projetos as $projeto) { ?>
                                                <option value="<?php echo $projeto; ?>"><?php echo $projeto; ?></option>
                                            <?php } ?>
                        </select>
                    </div>
                        <div class="flex-item">
                            <label for="usuario">Usuário:</label>
                            <select id="usuario" name="usuario">
                                <?php foreach ($usuarios as $user) { ?>
                                    <option value="<?php echo $user; ?>"><?php echo $user; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>

                    <div class="input-group">
                        <label for="descricao">Descrição:</label>
                        <textarea id="descricao" name="descricao" rows="1" cols="50"></textarea>
                    </div>
                    <div class="input-group">
                        <label for="observacao">Observação:</label>
                        <textarea id="observacao" name="observacao" rows="4" cols="50"></textarea>
                    </div>
                    <div class="input-group flex-container">
                        <div class="flex-item">
                            <label for="data">Data de inicio:</label>
                            <input type="date" id="data_inicio" name="data_inicio">
                        </div>

                        <div class="flex-item">
                            <label for="data_ini">Data de Previsão de Finalizar:</label>
                            <input type="date" id="data_prev_termino" name="data_prev_termino">
                        </div>

                        <div class="flex-item">
                            <label for="urgencia">Urgência:</label>
                            <select id="urgencia" name="urgencia">
                                <option value="baixa">Baixa</option>
                                <option value="normal">Normal</option>
                                <option value="alta">Alta</option>
                            </select>
                        </div>
                    </div>

                    <input type="submit" id = "submit" name="submit" value="Cadastrar Tarefa">
                </form>
            </div>
        </div> <!-- Aqui entra o conteúdo específico da opção selecionada -->
    </div>
   



    <script>
        function toggleSubMenu(id) {
            var submenu = document.getElementById(id);
            if (submenu.classList.contains('active')) {
                submenu.classList.remove('active');
            } else {
                submenu.classList.add('active');
            }
        }
    </script>
    
</body>
</html>
