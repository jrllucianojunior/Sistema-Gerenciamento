<?php
include('protect.php');
include('conexao.php');



if (!isset($_SESSION['nome']) || !isset($_SESSION['senha'])) {
    header('Location: login.php');
    exit();
}
?>


<!DOCTYPE html>
<html>
<head>

    <style>
        /* Estilos para os botões */
     
        .panel {
            width: 70%;
            margin: 0 auto;
            background-color: #fff;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.2);
        }

        .panel-header {
            background-color: #3498db;
            color: #fff;
            padding: 10px;
            border-radius: 5px 5px 0 0;
        }

        .panel-body {
            padding: 20px;
        }

        table {
            width: 100%;
            margin-top: 3%;
        }

        table th,
        table td {
            padding: 10px;
            text-align: center;
            border: 1px solid #ccc;
        }

        table th {
            background-color: #3498db;
            color: #fff;
        }

        .button-container {
            text-align: left;
            margin-top: 20px;
        }

        input[type="button"] {
            background-color: #3498db;
            color: #fff;
            padding: 10px 15px;
            border: none;
            border-radius: 3px;
            cursor: pointer;
            margin-right: 10px; /* Adiciona um espaçamento entre os botões */

        }

   
        input[type="button"]:hover {
            background-color: #2980b9;
        }
        
        
    </style>

<meta charset="UTF-8">
    <title>Página Inicial</title>
    <link rel="stylesheet" href="menu.css">

 

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

      
</head>
<body>
   
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
      <!-- Botões -->
        <div class="top-right">
            <a href="permissoes.php"><button>Permissões</button></a>
            <a href="usuarios.php"><button>Novo Usuário</button></a>
        </div>

        <!-- Tabela para listar os usuários -->
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <!-- Outros cabeçalhos, se necessário -->
                </tr>
            </thead>
            <tbody>
                <?php
                include_once('conexao.php');

                // Consulta SQL para obter todos os usuários
                $query = "SELECT id_usuario, nome FROM tb_usuarios";
                $result = mysqli_query($con, $query);

                // Exibir os usuários em linhas da tabela
                while ($row = mysqli_fetch_assoc($result)) {
                    echo '<tr>';
                    echo '<td>' . $row['id_usuario'] . '</td>';
                    echo '<td>' . $row['nome'] . '</td>';
                    // Adicione outras colunas, se necessário
                    echo '</tr>';
                }

                // Fecha a conexão
                mysqli_close($con);
                ?>
            </tbody>
        </table>
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
