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
    <title>Consulta de Contas</title>
    <style>
        /* Estilos CSS existentes aqui */
        /* ... */

        .panel {
            width: 100%;
            margin: 0 auto;
            background-color: #fff;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.2);
            margin-top: 20px;
            height: 100%; /*teste*/
        }

        .panel-header {
            background-color: #3498db;
            color: #fff;
            padding: 10px;
            border-radius: 5px 5px 0 0;
        }

        .panel-body {
            padding: 20px;
            width: 100%;
        }

       label {
             display: block;
            margin-bottom: 5px;
        }

        input[type="date"],
        input[type="number"],
        input[type="text"] {
            padding: 8px;
            width: 150px; /* Aumentado o tamanho dos campos */
            border: 1px solid #ccc;
            border-radius: 3px;
            box-sizing: border-box;
            margin-bottom: 10px;
            margin-right: 02px; /* Aumente o valor para aumentar o espaçamento */
           
        }

        input[type="submit"] {
            padding: 8px 12px;
            background-color: #3498db;
            color: #fff;
            cursor: pointer;
            border: none;
            border-radius: 3px;
        }

        input[type="submit"]:hover {
            background-color: #2980b9;
        }

        /* Estilos específicos para a tela de consulta */
        .search-panel {
            width: 80%;
            margin: 0 auto;
            background-color: #fff;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.2);
            margin-top: 20px;
            padding: 20px;
        }

        .search-panel label {
            display: inline-block;
            margin-bottom: 5px;
            width: 100px;
            margin-left: 10px; /* Aumente o valor para aumentar o espaçamento */
           
        }

        .results {
            width: 80%;
            margin: 0 auto;
            margin-top: 20px;
            background-color: #fff;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.2);
            padding: 20px;
            height: 300px;
            overflow-y: auto; 
        }

        .results table {
            width: 100%;
            border-collapse: collapse;
        }

        .results th, .results td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #ccc;
        }

        .results th {
            background-color: #3498db;
            color: #fff;
        }
    </style>

        <meta charset="UTF-8">

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
        <div class="search-panel">
            <form method="post">
                <label for="data_emissao">Data de Emissão:</label>
                <input type="date" id="data_emissao" name="data_emissao">

                <label for="data_vencimento">Data de Vencimento:</label>
                <input type="date" id="data_vencimento" name="data_vencimento">

                <label for="projeto">Projeto:</label>
                <input type="number" id="projeto" name="projeto">

                <input type="submit" value="Buscar">
            </form>
        </div>

        <div class="results">
            <div class="panel">
                <div class="panel-header">
                    Resultados da Consulta
                </div>
                <div class="panel-body">
                    <?php
                    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                        include_once('conexao.php');

                        $data_emissao = $_POST['data_emissao'] ?? '';
                        $data_vencimento = $_POST['data_vencimento'] ?? '';
                        $projeto = $_POST['projeto'] ?? '';

                        $query = "SELECT * FROM tb_contas WHERE 1=1";

                        if (!empty($data_emissao)) {
                            $query .= " AND data_emissao = '$data_emissao'";
                        }

                        if (!empty($data_vencimento)) {
                            $query .= " AND data_vencimento = '$data_vencimento'";
                        }

                        if (!empty($projeto)) {
                            $query .= " AND cod_projeto = $projeto";
                        }

                        $result = mysqli_query($con, $query);

                        if ($result && mysqli_num_rows($result) > 0) {
                            echo '<table>';
                            echo '<tr><th>Data de Emissão</th><th>Data de Vencimento</th><th>Valor</th><th>Projeto</th></tr>';

                            while ($row = mysqli_fetch_assoc($result)) {
                                echo '<tr>';
                                echo '<td>' . $row['data_emissao'] . '</td>';
                                echo '<td>' . $row['data_vencimento'] . '</td>';
                                echo '<td>' . $row['valor_conta'] . '</td>';
                                echo '<td>' . $row['cod_projeto'] . '</td>';
                                echo '</tr>';
                            }

                            echo '</table>';
                        } else {
                            echo 'Nenhum resultado encontrado.';
                        }
                    } else {
                        echo '<p>Nenhum resultado encontrado.</p>';
                    }
                    ?>
                </div>
            </div>
        </div>
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
