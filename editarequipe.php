<?php
include('protect.php');
include('conexao.php');



if (!isset($_SESSION['nome']) || !isset($_SESSION['senha'])) {
    header('Location: login.php');
    exit();
}
?>



<?php
// Incluir arquivo de conexão com o banco de dados
include_once('conexao.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Verificar se os dados foram enviados corretamente
    if (isset($_POST['equipes']) && is_array($_POST['equipes'])) {
        $equipes = $_POST['equipes'];

        // Iterar sobre as equipes enviadas pelo formulário
        foreach ($equipes as $id_equipe => $dados_equipe) {
            // Verificar se os dados estão presentes e não estão vazios
            if (isset($dados_equipe['nome_equipe']) && isset($dados_equipe['cod_grupo_desp'])) {
                $nome_equipe = $dados_equipe['nome_equipe'];
                $cod_grupo_desp = $dados_equipe['cod_grupo_desp'];
                $id_equipe = $id_equipe; // Capturar o ID da equipe

                // Query para atualizar a equipe no banco de dados
                $query = "UPDATE tb_equipe SET nome = '$nome_equipe', cod_grupo_desp = '$cod_grupo_desp' WHERE id_equipe = '$id_equipe'";
                
                // Executar a query no banco de dados
                $result = mysqli_query($con, $query);

                // Verificar se a query foi executada com sucesso
                if ($result) {
                    echo "<script>
                        function openModal() {
                            var modal = document.getElementById('myModal');
                            modal.style.display = 'block';
                            document.getElementById('Message').innerText = 'Equipe alterada com sucesso';
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
                            document.getElementById('Message').innerText = 'Erro ao alterar equipe: <?php echo mysqli_error($con); ?>';
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
            }
        }

        // Redirecionar de volta para a página principal após salvar
        header("Location: editarequipe.php"); 
        exit();
    }
}
?>





<!DOCTYPE html>
<html>
<head>
    <title>Alterar Equipes</title>
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



       <link rel="stylesheet" href="menu.css">
       <link rel="stylesheet" href="forms.css">

 

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


    <div id="myModal" class="modal">
            <div class="modal-content">
                <span class="close" onclick="closeModal()">&times;</span>
                    <h2>Status do Cadastro</h2>
                    <p id="Message"></p>
            </div>
    </div>






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
        <div class="container">  
       
                <form method="post">
                <table id="equipesTable">
                    <tr>
                        <th>Equipe</th>
                        <th>Grupo de Despesas</th>
                    </tr>
                <?php
                    // Conexão com o banco de dados
                

                include_once('conexao.php');
                    // Query para obter todas as equipes com seus grupos de despesas
                    $sql = "SELECT e.id_equipe, e.nome AS nome_equipe, e.cod_grupo_desp, e.nome_grupo_desp, g.descricao AS descricao_grupo
                            FROM tb_equipe e
                            INNER JOIN tb_grupo_despesas g ON e.cod_grupo_desp = g.id_grupo";
                    $result = $con->query($sql);

                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr id='equipe_" . $row['id_equipe'] . "'>";
                            echo "<td class='editable' contenteditable='true'>" . $row['nome_equipe'] . "</td>";
                            echo "<td class='editable' contenteditable='false'>";
                            
                            
                            
                            echo "<select>";
                            
                            // Código PHP para buscar grupos de despesas do banco de dados e criar as opções do combobox
                            $sqlGruposDespesas = "SELECT id_grupo, descricao FROM tb_grupo_despesas";
                            $resultGruposDespesas = $con->query($sqlGruposDespesas);
                
                            if ($resultGruposDespesas->num_rows > 0) {
                                while ($grupo = $resultGruposDespesas->fetch_assoc()) {
                                    $selected = ($grupo['id_grupo'] == $row['cod_grupo_desp']) ? 'selected' : '';
                                    echo "<option value='" . $grupo['id_grupo'] . "' " . $selected . ">" . $grupo['descricao'] . "</option>";
                                }
                            }
                
                            echo "</select>";
                            echo "</td>";
                            echo "</tr>";
                            
                        }
                    }
                ?>
                        
                </table>

                <input type="submit" value="Salvar Alterações">
                </form>
          
        </div>
    </div>

   

</body>
</html>
