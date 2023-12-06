
<?php
include('protect.php');
include('conexao.php');



if (!isset($_SESSION['nome']) || !isset($_SESSION['senha'])) {
    header('Location: login.php');
    exit();
}
?>

<?php
// ... (seu código existente)

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['nome_equipe']) && isset($_POST['grupo_despesas'])) {
        $nome_equipe = $_POST['nome_equipe'];
        $grupo_despesas = $_POST['grupo_despesas'];

        // Consulta para obter o código do grupo de despesas
        $query_cod_grupo = "SELECT id_grupo FROM tb_grupo_despesas WHERE descricao = '$grupo_despesas'";
        $result_cod_grupo = mysqli_query($con, $query_cod_grupo);

        if ($row = mysqli_fetch_assoc($result_cod_grupo)) {
            $cod_grupo_desp = $row['id_grupo'];

            // Aqui você tem o $cod_grupo_desp correspondente ao $grupo_despesas selecionado
            $query = "INSERT INTO tb_equipe (nome, cod_grupo_desp, nome_grupo_desp) VALUES ('$nome_equipe', $cod_grupo_desp, '$grupo_despesas')";
            $result = mysqli_query($con, $query);

            if ($result) {
                echo "<script>
                    function openModal() {
                        var modal = document.getElementById('myModal');
                        modal.style.display = 'block';
                        document.getElementById('Message').innerText = 'Equipe cadastrada com sucesso';
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
                        document.getElementById('Message').innerText = 'Erro ao cadastrar equipe: <?php echo mysqli_error($con); ?>';
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
            echo "<script>
                alert('Grupo de despesas não encontrado');
            </script>";
        }
    }
}



$query_grupos = "SELECT descricao FROM tb_grupo_despesas";
$result_grupos = mysqli_query($con, $query_grupos);

$grupos = array();

while ($row = mysqli_fetch_assoc($result_grupos)) {
    $grupos[] = $row['descricao'];
}
?>







<!DOCTYPE html>
<html lang="pt-br">
<head>
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
    </div>


    <div class="content">
       <div class="container">  
         <div class="panel">
            <form method="post">
                <div>
                    <label for="nome_equipe">Nome da Equipe:</label>
                    <input type="text" id="nome_equipe" name="nome_equipe" required>
                </div>
                <div>
                    <label for="grupo_despesas">Grupo de Despesas:</label>
                    <select id="grupo_despesas" name="grupo_despesas" required>
                        <?php foreach ($grupos as $descricao_grupo) { ?>
                                            <option value="<?php echo $descricao_grupo; ?>"><?php echo $descricao_grupo; ?></option>
                                        <?php } ?>
                    </select>
                </div>
                <div>
                    <input type="submit" value="Cadastrar Equipe">
                </div>
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
