
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

    $nome = $_POST['nome'];
    $equipe = $_POST['equipe'];
    $descricao = $_POST['descricao'];
    $objetivo = $_POST['objetivo'];
    $data_inicio = $_POST['data_inicio'];
    $data_previsao_termino = $_POST['data_previsao_termino'];
    $custo_esperado = $_POST['custo_esperado'];


  
        $result = mysqli_query($con,"INSERT INTO tb_projeto (nome, equipe, descricao, objetivo, data_inicio, data_previsao_termino, custo_esperado) 
                        VALUES ('$nome', '$equipe', '$descricao', '$objetivo', '$data_inicio', '$data_previsao_termino', '$custo_esperado')");

        // Executar a inserção
        if ($result) {
            echo "<script>
                function openContaModal() {
                    var modal = document.getElementById('myModalConta');
                    modal.style.display = 'block';
                    document.getElementById('contaMessage').innerText = 'Projeto cadastrado com sucesso';
                }

                function closeModalConta() {
                    var modal = document.getElementById('myModalConta');
                    modal.style.display = 'none';
                }

                // Chama a função ao carregar a página
                window.onload = function() {
                    openContaModal();
                };
            </script>";
        } else {
            echo "<script>
                function openContaModal(message) {
                    var modal = document.getElementById('myModalConta');
                    modal.style.display = 'block';
                    document.getElementById('contaMessage').innerText = 'Erro ao cadastrar projeto: <?php echo mysqli_error($con); ?>';
                }

                function closeModalConta() {
                    var modal = document.getElementById('myModalConta');
                    modal.style.display = 'none';
                }

                // Chama a função ao carregar a página
                window.onload = function() {
                    openContaModal();
                };
            </script>";
        }
        
    }


    
$query_equipes = "SELECT nome FROM tb_equipe"; // Substitua 'tabela_usuarios' pelo nome da sua tabela de usuários
$result_equipes = mysqli_query($con, $query_equipes);

$equipes = array();

while ($row = mysqli_fetch_assoc($result_equipes)) {
    $equipes[] = $row['nome'];
}

?>
<!DOCTYPE html>
<html>
<head>
    <title>Cadastro de Projetos</title>


    <link rel="stylesheet" href="menu.css">
    <link rel="stylesheet" href="forms.css">
    <link rel="stylesheet" href="modal.css">
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

    
</head>
<body>

  
<div id="myModalConta" class="modal">
            <div class="modal-content">
                <span class="close" onclick="closeModalConta()">&times;</span>
                    <h2>Status do Cadastro</h2>
                    <p id="contaMessage"></p>
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
    </div>



    <div class="content">
        
        <div class="container">
        <h2>Cadastro de Projetos </h2>
            <div class="panel">
                <form  method="post">
                  
                <div class="input-group flex-container">
                  <div class="flex-item"> 
                    <label for="nome">Nome do Projeto:</label>
                    <input type="text" id="nome" name="nome">
                  </div> 

                  <div class="flex-item">  
                    <label for="equipe">Equipe:</label>
                    <select id="equipe" name="equipe" required>
                        <?php foreach ($equipes as $equipe) { ?>
                                            <option value="<?php echo $equipe; ?>"><?php echo $equipe; ?></option>
                                        <?php } ?>
                    </select>
                  </div>
                </div>    
                    
                    <label for="descricao">Descricao:</label>
                    <textarea id="descricao" name="descricao" rows="1" cols="50"></textarea>

                    <label for="objetivo">Objetivo:</label>
                    <textarea id="objetivo" name="objetivo" rows="4" cols="50"></textarea>
                    
                    <div class="input-group flex-container">
                    <div class="flex-item">
                        <label for="data_inicio">Data de Início:</label>
                        <input type="date" id="data_inicio" name="data_inicio">
                    </div>
                    <div class="flex-item">
                        <label for="data_previsao_termino">Previsão de Término:</label>
                        <input type="date" id="data_previsao_termino" name="data_previsao_termino">
                    </div>
                    </div>
                    
                    <label for="custo_esperado">Custo Esperado:</label>
                    <input type="number" id="custo_esperado" name="custo_esperado" step="1">

                    <input type="submit" name= "submit" id= "submit" value="Cadastrar">
                    <input type="button" value="Cancelar" onclick="window.location.href='index.html'">

                </form>
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
