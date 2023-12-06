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




$queryUsuarios = "SELECT * FROM tb_usuarios";
$resultUsuarios = mysqli_query($con, $queryUsuarios);

$queryPermissoes = "SELECT * FROM tb_permissoes";
$resultPermissoes = mysqli_query($con, $queryPermissoes);


$queryPermissoesUser = "SELECT p.desc_permissao, u.nome, pu.liberado
                        FROM tb_permissoes p
                        INNER JOIN tb_permissoes_user pu ON p.codigo = pu.cod_permissao
                        INNER JOIN tb_usuarios u ON pu.id_relusuario = u.id_usuario";
$resultPermissoesUser = mysqli_query($con, $queryPermissoesUser);

$permissoesPorUsuario = array();

while ($rowPermissoesUser = mysqli_fetch_assoc($resultPermissoesUser)) {
    $permissao = $rowPermissoesUser['desc_permissao'];
    $nomeUsuario = $rowPermissoesUser['nome'];
    $liberado = $rowPermissoesUser['liberado'];

    // Adicionar permissão ao array associativo
    $permissoesPorUsuario[$permissao][$nomeUsuario] = $liberado;
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página Inicial</title>
    <link rel="stylesheet" href="menu.css">


        <style>

            h2 {
                text-align: center;
            }

            .content {
                margin-top: 70px; /* Altura da barra de navegação */
                margin-left: 250px; /* Largura da barra lateral */
                padding-top: 20px; 
                padding-left: 20px; /* Espaço para a tabela */
            }

            .panel {
                width: 70%;
                margin: 0 auto;
                background-color: #fff;
                border: 1px solid #ccc;
                border-radius: 5px;
                box-shadow: 0 0 5px rgba(0, 0, 0, 0.2);
                margin-top: 0; 
                height: calc(100vh - 100px);
            
            }

            .panel-header {
                background-color: #3498db;
                color: #fff;
                padding: 10px;
                border-radius: 5px 5px 0 0;
            }

            .panel-body {
                padding: 20px;
                height: 100%; 
                box-sizing: border-box; 
            }

            table {
                width: calc(100% - 40px); 
                border-collapse: collapse;
                margin-top: 20px; 
            }

            table th, table td {
                padding: 10px;
                text-align: center;
                border: 1px solid #ccc;
            }

            table th {
                background-color: #3498db;
                color: #fff;
            }

            .button-container {
                text-align: right;
                margin-top: 20px;
            }

            input[type="submit"] {
                background-color: #3498db;
                color: #fff;
                padding: 10px 15px;
                border: none;
                border-radius: 3px;
                cursor: pointer;
            }

            input[type="button"] {
                background-color: #e74c3c; /* Vermelho */
                color: #fff;
                padding: 10px 15px;
                border: none;
                border-radius: 3px;
                cursor: pointer;
            }

            input[type="submit"]:hover {
                background-color: #2980b9;
            }

            input[type="button"]:hover {
                background-color: #c0392b; /* Tom mais escuro de vermelho */
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


        <link rel="stylesheet" href="menu.css">
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

    <!-- Conteúdo da página -->
    <div class="content">
        <h2>Permissões para usuários</h2>
        <!-- Aqui entra o conteúdo específico da opção selecionada -->

      
            <form method="post" action="salvarpermissoes.php">
                <table border="1">
                    <tr>
                        <th>Permissões</th>

                        <?php
                        // Loop para criar coluna para cada usuário
                        while ($rowUsuarios = mysqli_fetch_assoc($resultUsuarios)) {
                            echo '<th>' . $rowUsuarios['nome'] . '</th>';
                        }
                        ?>

                    </tr>

                    <?php
                    // Reiniciar o ponteiro de resultados de usuários
                    mysqli_data_seek($resultUsuarios, 0);

                    // Loop para criar linhas de permissões
                    while ($rowPermissoes = mysqli_fetch_assoc($resultPermissoes)) {
                        echo '<tr>';
                        echo '<td>' . $rowPermissoes['desc_permissao'] . '</td>';

                        // Loop para criar coluna para cada usuário
                        while ($rowUsuarios = mysqli_fetch_assoc($resultUsuarios)) {
                            $idUsuario = $rowUsuarios['id_usuario'];
                            $permissaoAtual = $rowPermissoes['desc_permissao'];
                            $nomeUsuario = $rowUsuarios['nome']; 

                            // Verificar se a permissão está liberada para o usuário
                            $liberado = isset($permissoesPorUsuario[$permissaoAtual][$nomeUsuario]) ? $permissoesPorUsuario[$permissaoAtual][$nomeUsuario] : 'N';

                            // Mostrar o valor atual como um campo de edição
                            echo '<td>';
                            echo '<input type="text" name="permissoes[' . $permissaoAtual . '][' . $nomeUsuario . ']" value="' . $liberado . '">';
                            echo '</td>';
                        }

                        // Reiniciar o ponteiro de resultados de usuários para o próximo loop de permissões
                        mysqli_data_seek($resultUsuarios, 0);

                        echo '</tr>';
                    }
                    ?>

                </table>

                <div class="button-container">
                    <input type="submit" value="Salvar">
                    <input type="button" value="Cancelar">
                </div>

      
     
            </form>

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
