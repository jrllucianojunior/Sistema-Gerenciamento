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
    <title>Visualização de Tarefas</title>
    <meta charset="UTF-8">

    <link rel="stylesheet" href="tarefas.css">

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

<?php
    // Se houver uma solicitação para finalizar a tarefa
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id_tarefa'])) {
        include_once('conexao.php');
        
        $id_tarefa = $_POST['id_tarefa'];
        $data_atual = date('Y-m-d');
        $query = "UPDATE tb_tarefas SET finalizada = 1, data_termino = '$data_atual' WHERE id_tarefa = $id_tarefa";

        if (mysqli_query($con, $query)) {
            echo "<script>alert('Tarefa finalizada com sucesso!');</script>";
        } else {
            echo "<script>alert('Erro ao finalizar a tarefa');</script>";
        }
    }
?>


<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="#"></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#conteudoNavbarSuportado"
    aria-controls="conteudoNavbarSuportado" aria-expanded="false" aria-label="Alterna navegação">
    <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="conteudoNavbarSuportado">
    <ul class="navbar-nav mr-auto">
        <li class="nav-item active">
        <a class="nav-link " href="http://localhost/PI3/index.php">Inicio <span
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





<!-- Seu HTML das tarefas... -->
<div id="myModal" class="modal">
    
    <div class="modal-content">
        <span class="close">&times;</span>
        <h2>Finalizar Tarefa</h2>
        <p>Deseja realmente finalizar esta tarefa?</p>
        <form id="confirmationForm" method="POST">
            <!-- Campo oculto para armazenar o ID da tarefa -->
            <input type="hidden" id="taskId" name="id_tarefa" value="">
            <!-- Campo de data de finalização (não editável) -->
            <label for="finalDate">Data de Finalização:</label>
            <input type="text" id="finalDate" name="data_finalizacao" readonly>
            <!-- Botão de envio do formulário -->
            <input type="submit" value="Finalizar">
        </form>
    </div>
</div>
<div class="task-container">

<?php
    // Estabelecer a conexão com o banco de dados
    include_once('conexao.php');

    // Consulta SQL para selecionar as tarefas não finalizadas
    $query = "SELECT id_tarefa, nome_usuario, descricao, observacao ,date_format(data_previsao_termino, '%d/%m/%Y') as 'data_previsao_termino', urgencia FROM tb_tarefas WHERE finalizada = 0";
    $result = mysqli_query($con, $query);

    // Verificar se a consulta retornou resultados
    if (mysqli_num_rows($result) > 0) {
        // Exibir os dados das tarefas
        while ($row = mysqli_fetch_assoc($result)) {
            $urgencyClass = '';
            switch ($row['urgencia']) {
                case 'alta':
                    $urgencyClass = 'red';
                    break;
                case 'normal':
                    $urgencyClass = 'yellow';
                    break;
                case 'baixa':
                    $urgencyClass = 'green';
                    break;
                default:
                    $urgencyClass = 'green'; // Defina um padrão para casos não tratados
                    break;
            }

            echo '<div class="task ' . $urgencyClass . '">';
            echo '<h3 class="task-title">Tarefa #' . $row['id_tarefa'] . '</h3>'; // Adicionando a classe task-title
            echo '<p>Descrição: ' . $row['descricao'] . '</p>';
            echo '<p>Obs: ' . $row['observacao'] . '</p>';
            echo '<p>Previsão: ' . $row['data_previsao_termino'] . '</p>';

            echo '<button class="finish-button" onclick="openModal(' . $row['id_tarefa'] . ')">Finalizar</button>';

            echo '</div>';
        }
    } else {
        echo "Nenhuma tarefa encontrada.";
    }

    // Fechar a conexão
    mysqli_close($con);
?>
</div>

<!-- JavaScript para abrir o modal -->
<script>
    function openModal(taskId) {
        var modal = document.getElementById("myModal");
        var currentDate = new Date().toISOString().split('T')[0];

        document.getElementById('taskId').value = taskId;
        document.getElementById('finalDate').value = currentDate;

        modal.style.display = "block";
    }

    var span = document.getElementsByClassName("close")[0];
    span.onclick = function() {
        var modal = document.getElementById("myModal");
        modal.style.display = "none";
    }

    window.onclick = function(event) {
        var modal = document.getElementById("myModal");
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }
</script>


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
