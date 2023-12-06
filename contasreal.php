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

    // Consulta para obter os gastos por mês e grupo de despesas
    $sql = "SELECT grupo_despesas, 
            SUM(CASE WHEN MONTH(data_emissao) = 1 THEN valor_conta ELSE 0 END) AS Jan,
            SUM(CASE WHEN MONTH(data_emissao) = 2 THEN valor_conta ELSE 0 END) AS Fev,
            SUM(CASE WHEN MONTH(data_emissao) = 3 THEN valor_conta ELSE 0 END) AS Mar,
            SUM(CASE WHEN MONTH(data_emissao) = 4 THEN valor_conta ELSE 0 END) AS Abr,
            SUM(CASE WHEN MONTH(data_emissao) = 5 THEN valor_conta ELSE 0 END) AS Maio,
            SUM(CASE WHEN MONTH(data_emissao) = 6 THEN valor_conta ELSE 0 END) AS Jun,
            SUM(CASE WHEN MONTH(data_emissao) = 7 THEN valor_conta ELSE 0 END) AS Jul,
            SUM(CASE WHEN MONTH(data_emissao) = 8 THEN valor_conta ELSE 0 END) AS Ago,
            SUM(CASE WHEN MONTH(data_emissao) = 9 THEN valor_conta ELSE 0 END) AS 'Set',
            SUM(CASE WHEN MONTH(data_emissao) = 10 THEN valor_conta ELSE 0 END) AS 'Out',
            SUM(CASE WHEN MONTH(data_emissao) = 11 THEN valor_conta ELSE 0 END) AS Nov,
            SUM(CASE WHEN MONTH(data_emissao) = 12 THEN valor_conta ELSE 0 END) AS Dez,
            SUM(valor_conta) AS total_gasto 
            FROM tb_contas 
            GROUP BY grupo_despesas 
            ORDER BY grupo_despesas";

    $result = $con->query($sql);

   
    $con->close();
?>





<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Análise de Despesas</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
        }

        h2 {
            text-align: center;
        }

        .table-container {
            width: 80%;
            margin: 20px auto;
            background-color: #fff;
            border: 1px solid #cccccc;
            border-radius: 5px;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.2);
            overflow-x: auto;
            margin-left: 19%
        }

        table {
            border-collapse: collapse;
            width: 100%;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: center;
        }

        th {
            background-color: #3498db;
            color: #fff;
        }

        td:nth-child(2) {
            background-color: #ddd; /* Cinza para a coluna "Total" */
        }

        .selecioneprojeto {
            display: inline-block;
            vertical-align: middle;
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            margin-right: 5%;
            width: 80%;
        }

        .select {
        width: 80%;
        padding: 8px;
        margin-bottom: 10px;
        border-radius: 3px;
        border: 1px solid #ccc;
        box-sizing: border-box;
        margin-left: 20%;
        }

        .edit-button {
            background-color: #3498db;
            color: #fff;
            margin-left: 92%;
            display: inline-block;
            vertical-align: middle;
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;

        }

        /* Estilos do formulário modal */
        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.4);
        }

        .modal-content {
            background-color: #fefefe;
            margin: 15% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
        }

        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }

        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }
    </style>    

    <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
  integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
  <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
  <link rel="stylesheet" href="menu.css"
  
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
    
    
<<div class="content">
<h2>Análise de Despesas por Projeto</h2>
    
    <div>
        <!-- Selecione o Projeto -->
        <label class="selecioneprojeto" for="projeto">Selecione o Projeto:</label>
        <select id="projeto" name="projeto">
            <!-- Inclua opções do projeto aqui -->
            <option value="projeto1">Projeto 1</option>
            <option value="projeto2">Projeto 2</option>
            <option value="projeto3">Projeto 3</option>
        </select>

        <!-- Botão Editar -->
        <button class="edit-button" onclick="openModal()">Editar</button>
    </div>
    </div>
    <!-- Tabela de Análise de Despesas -->
    <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th>Grupo de Despesa</th>
                    <th>Total</th>
                    <th>Jan</th>
                    <th>Fev</th>
                    <th>Mar</th>
                    <th>Abr</th>
                    <th>Maio</th>
                    <th>Jun</th>
                    <th>Jul</th>
                    <th>Ago</th>
                    <th>Set</th>
                    <th>Out</th>
                    <th>Nov</th>
                    <th>Dez</th>
                </tr>
            </thead>
            <tbody>
            <?php
            while ($row = $result->fetch_assoc()) {
                echo '<tr>';
                echo '<td>' . $row['grupo_despesas'] . '</td>';
                echo '<td>' . number_format($row['total_gasto'], 2, ',', '.') . '</td>';
                echo '<td>' . number_format($row['Jan'], 2, ',', '.') . '</td>';
                echo '<td>' . number_format($row['Fev'], 2, ',', '.') . '</td>';
                echo '<td>' . number_format($row['Mar'], 2, ',', '.') . '</td>';
                echo '<td>' . number_format($row['Abr'], 2, ',', '.') . '</td>';
                echo '<td>' . number_format($row['Maio'], 2, ',', '.') . '</td>';
                echo '<td>' . number_format($row['Jun'], 2, ',', '.') . '</td>';
                echo '<td>' . number_format($row['Jul'], 2, ',', '.') . '</td>';
                echo '<td>' . number_format($row['Ago'], 2, ',', '.') . '</td>';
                echo '<td>' . number_format($row['Set'], 2, ',', '.') . '</td>';
                echo '<td>' . number_format($row['Out'], 2, ',', '.') . '</td>';
                echo '<td>' . number_format($row['Nov'], 2, ',', '.') . '</td>';
                echo '<td>' . number_format($row['Dez'], 2, ',', '.') . '</td>';
                echo '</tr>';
            }
            ?>
            </tbody>
        </table>
    </div>

    <!-- Formulário Modal -->
    <div id="myModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeModal()">&times;</span>
            <h3>Adicionar Novo Grupo de Despesa</h3>
            <form id="addExpenseForm">
                <label for="newExpense">Nome do Grupo de Despesa:</label>
                <input type="text" id="newExpense" name="newExpense" required>
                <button type="button" onclick="addExpense()">Adicionar</button>
            </form>
        </div>
    </div>
       
    <script>
        // Funções JavaScript para abrir, fechar o modal e adicionar novo grupo de despesa
        function openModal() {
            document.getElementById("myModal").style.display = "block";
        }

        function closeModal() {
            document.getElementById("myModal").style.display = "none";
        }

        function addExpense() {
            // Adicione lógica para adicionar nova linha (grupo de despesa)
            // Aqui você pode manipular o DOM para inserir a nova linha na tabela
            closeModal();
        }
    </script>
</body>
</html>
