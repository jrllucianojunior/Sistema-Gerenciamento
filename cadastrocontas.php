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

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['data_emissao']) && isset($_POST['data_vencimento']) && isset($_POST['valor_conta']) && isset($_POST['projeto'])) {
        $Data_emissao = $_POST['data_emissao'];
        $Data_vencimento = $_POST['data_vencimento'];
        $Valor = $_POST['valor_conta'];
        $grupo_despesas = $_POST['grupo_despesas'];
        $nome_projeto = $_POST['projeto'];


        $query = "SELECT id_projeto FROM tb_projeto WHERE nome like '$nome_projeto'";
        $result_query = mysqli_query($con, $query);


        if ($row = mysqli_fetch_assoc($result_query)) {
            $cod_projeto = $row['id_projeto'];
        
            // Inserir na tabela de tarefas com o código do projeto obtido
            $result = mysqli_query($con, "INSERT INTO tb_contas (data_emissao, data_vencimento, valor_conta, grupo_despesas,cod_projeto)
             VALUES ('$Data_emissao', '$Data_vencimento', '$Valor', '$grupo_despesas', '$cod_projeto')");
            // Executar a inserção
            
        if ($result) {
            echo "<script>
                function openContaModal() {
                    var modal = document.getElementById('myModalConta');
                    modal.style.display = 'block';
                    document.getElementById('contaMessage').innerText = 'Conta inserida com sucesso';
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
                    document.getElementById('contaMessage').innerText = 'Erro ao inserir a Conta: <?php echo mysqli_error($con); ?>';
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
        
            
        } else {
            echo "Projeto não encontrado.";
        }
        }
    }





        
    $query_projetos = "SELECT nome FROM tb_projeto"; // Substitua 'tabela_usuarios' pelo nome da sua tabela de usuários
    $result_projetos = mysqli_query($con, $query_projetos);

    $projetos = array();

    while ($row = mysqli_fetch_assoc($result_projetos)) {
        $projetos[] = $row['nome'];
    }


    $query_grupo_despesas = "SELECT descricao FROM tb_grupo_despesas"; // Substitua 'tabela_usuarios' pelo nome da sua tabela de usuários
    $result_grupos = mysqli_query($con, $query_grupo_despesas);

    $grupos = array();

    while ($row = mysqli_fetch_assoc($result_grupos)) {
        $grupos[] = $row['descricao'];
    }




?>







<!DOCTYPE html>
<html>
<head>
    
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

    
        input[type="date"],
        input[type="number"],
        input[type="text"] {
            padding: 10px;
            width: calc(100% - 22px); /* Considera o padding de 10px em cada lado */
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 3px;
            box-sizing: border-box;
        }

      
     
        input[type="submit"]:hover {
            background-color: #2980b9;
        }

        input[type="button"]:hover {
            background-color: #c0392b;
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
            <li><a href="http://localhost/PI3/cadastroequipes.php">Cadastrar Projeto</a></li>
            <li><a href="http://localhost/PI3/consultaprojetos.php">Consultar Projetos</a></li>
        </ul>
        
        <a href="#" onclick="toggleSubMenu('equipes')">Equipes</a>
        <ul id="equipes" class="submenu">
            <li><a href="http://localhost/PI3/cadastroequipes.php">Cadastrar Equipe</a></li>
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

    <h2>Cadastro de contas</h2>

        <div class="panel">
            <div class="panel-body">
              <form method="post">
                
                <div class="input-group flex-container">
                  <div class="flex-item">
                    <label for="data_emissao">Data de Emissão:</label>
                    <input type="date" id="data_emissao" name="data_emissao">
 
                  </div>

                  <div class="flex-item"> 
                    <label for="data_vencimento">Data de Vencimento:</label>
                    <input type="date" id="data_vencimento" name="data_vencimento">

                  </div>
                </div>


                <label for="valor_conta">Valor da Conta:</label>
                <input type="number" id="valor_conta" name="valor_conta" step="0.01">


                <div class="input-group flex-container">
                    <div class="flex-item">
                    <label for="grupo_despesas">Grupo de despesas:</label>
                        <select id="grupo_despesas" name="grupo_despesas" required>
                            <?php foreach ($grupos as $grupo) { ?>
                                                <option value="<?php echo $grupo; ?>"><?php echo $grupo; ?></option>
                                            <?php } ?>
                        </select>
                    </div>

                    <div class="flex-item">
                    <label for="projeto">Projeto:</label>
                        <select id="projeto" name="projeto" required>
                            <?php foreach ($projetos as $projeto) { ?>
                                                <option value="<?php echo $projeto; ?>"><?php echo $projeto; ?></option>
                                            <?php } ?>
                        </select>
                    </div>
                </div>
            

                <input type="submit" value="Cadastrar">
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

