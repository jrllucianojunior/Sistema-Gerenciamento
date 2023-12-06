<?php
include('protect.php');
include('conexao.php');



if (!isset($_SESSION['nome']) || !isset($_SESSION['senha'])) {
    header('Location: login.php');
    exit();
}
?>


<?php

$query_equipes = "SELECT nome FROM tb_equipe"; 
$result_equipes = mysqli_query($con, $query_equipes);

$equipes = array();

while ($row = mysqli_fetch_assoc($result_equipes)) {
    $equipes[] = $row['nome'];
}
?>




<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <title>Lista de Projetos</title>
  <link rel="stylesheet" href="menu.css">


  <style>

    form {
    display: flex;
    justify-content: center;
    margin-bottom: 20px;
    }

    label {
    margin-right: 10px;
    }

    select {
    padding: 5px;
    }

    button {
    padding: 5px 10px;
    background-color: #007bff;
    color: #fff;
    border: none;
    border-radius: 3px;
    cursor: pointer;
    }

    button:hover {
    background-color: #0056b3;
    }

    #projectsTable {
    max-width: 100%;
    overflow-x: auto;
    }

    table {
    width: 100%;
    border-collapse: collapse;
    }

    table th, table td {
    border: 1px solid #ddd;
    padding: 8px;
    }

    table th {
    background-color: #f2f2f2;
    text-align: left;
    }

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
    background-color: #e7f0ff;
    margin: 15% auto;
    padding: 20px;
    border: 1px solid #ccc;
    width: 50%;
    border-radius: 8px;
    box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
    }


  </style>  
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

    <h1>Lista de Projetos</h1>

    <form method="POST" action="">
     <label for="equipe">Equipe:</label>
            <select id="equipe" name="equipe" required>
                <?php foreach ($equipes as $equipe) { ?>
                      <option value="<?php echo $equipe; ?>"><?php echo $equipe; ?></option>
                <?php } ?>
            </select>
      <button type="submit">Buscar</button>
    </form>





    <?php
    include_once('conexao.php');
    

    // Verificar se o formulário foi submetido
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
      $team = $_POST["equipe"];
      $sql = "SELECT id_projeto, nome, descricao, date_format(data_inicio, '%d/%m/%Y') as data_inicio, 
      objetivo, date_format(data_previsao_termino, '%d/%m/%Y') as data_previsao_termino FROM tb_projeto WHERE equipe = '$team'";
      $result = $con->query($sql);

      if ($result->num_rows > 0) {
        echo "<table>";
        echo "<tr><th>ID do Projeto</th><th>Nome</th><th>Descrição</th><th>Data de Início</th><th>Previsão de término</th><th>Objetivo</th></tr>";
        while ($row = $result->fetch_assoc()) {
          echo "<tr><td>".$row["id_projeto"].
          "</td><td>".$row["nome"].
          "</td><td>".$row["descricao"].
          "</td><td>".$row["data_inicio"]. 
         "</td><td>".$row["data_previsao_termino"].
         "<td><button onclick='openModal(\"".$row["objetivo"]."\")'>Ver Obj</button></td>".
 
         "</td></tr>";
          
        }
        echo "</table>";
      } else {
        echo "Nenhum projeto encontrado para esta equipe.";
      }
    }

    $con->close();
    ?>

<div id="myModal" class="modal">
    <div class="modal-content">
      <span class="close" onclick="closeModal()">&times;</span>
      <h2>Observação da Tarefa</h2>
      <p id="goalContent"></p>
    </div>
  </div>
</div>

    </div>

 
 <script>
  var selectedGoal = '';

  function openModal(goal) {
    selectedGoal = goal;
    var modal = document.getElementById("myModal");
    modal.style.display = "block";
    document.getElementById("goalContent").innerText = selectedGoal;
  }

  function closeModal() {
    var modal = document.getElementById("myModal");
    modal.style.display = "none";
    selectedGoal = '';
  }

  window.onclick = function (event) {
    var modal = document.getElementById("myModal");
    if (event.target == modal) {
      closeModal();
    }
  }
</script>
</body>
</html>
