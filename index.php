<?php
include('protect.php');
include('conexao.php');



if (!isset($_SESSION['nome']) || !isset($_SESSION['senha'])) {
    header('Location: login.php');
    exit();
}
?>


<!DOCTYPE html>
<html lang="en">
<head>

   <style>
       
    
        .dashboard-container {
            display: flex;
            justify-content: space-between;
            padding: 20px;
        }

        .dashboard {
            width: 45%;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
            border-radius: 5px;
        }

        .dashboard-title {
            font-size: 24px;
            margin-bottom: 15px;
        }

        .project-expenses {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .project-expense {
            margin-bottom: 10px;
        }

        .project-name {
            font-weight: bold;
        }

        .expense-amount {
            color: #FF6347;
        }

        .chart-container {
            width: 100%;
            margin-top: 20px;
        }

        canvas {
            width: 100% !important;
            height: auto !important;
        }
    </style>
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
    <div class="dashboard-container">
        <div class="dashboard">
            <div class="dashboard-title">Dashboard Geral</div>
            <p>Gráficos, estatísticas gerais e informações sobre despesas totais, lucro, etc., podem ser exibidos aqui.</p>
            <div class="chart-container">
                <!-- Gráfico de despesas gerais -->
                <canvas id="expensesChart" width="400" height="200"></canvas>
            </div>
        </div>

        <div class="dashboard">
            <div class="dashboard-title">Despesas por Projetos</div>
            <ul class="project-expenses">
                <li class="project-expense">
                    <span class="project-name">Projeto A:</span>
                    <span class="expense-amount">R$5000</span>
                </li>
                <li class="project-expense">
                    <span class="project-name">Projeto B:</span>
                    <span class="expense-amount">R$3000</span>
                </li>
                <li class="project-expense">
                    <span class="project-name">Projeto C:</span>
                    <span class="expense-amount">R$7000</span>
                </li>
                <!-- Adicionar mais projetos e despesas conforme necessário -->
            </ul>
        </div>
    </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Dados fictícios para os gráficos (poderiam ser dados reais)
        const projectLabels = ['Projeto A', 'Projeto B', 'Projeto C'];
        const projectExpenses = [5000, 3000, 7000];

        // Criar o gráfico de despesas
        const ctx = document.getElementById('expensesChart').getContext('2d');
        const expensesChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: projectLabels,
                datasets: [{
                    label: 'Despesas por Projeto',
                    data: projectExpenses,
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.6)',
                        'rgba(54, 162, 235, 0.6)',
                        'rgba(255, 206, 86, 0.6)'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
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
