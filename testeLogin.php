<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
    integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
   <!--  <link rel="stylesheet" href="css/style.css"> -->
  
  <link rel="stylesheet" href="Assets/Css/usuario.css">
  <link rel="stylesheet" href="vaga.css">

  <link rel="icon" href="Assets/Img/Icone.png" type="image/png">

    <title>Carregando...</title>
  
  <style>
   .loading-message {
      color: darkslateblue;
      font-size: larger;
      font-weight: 500; /* Valor intermediário */
      margin-bottom: 100px; /* Aumente esse valor para adicionar mais espaçamento */
    }

    .center-container {
      position: relative; /* Adicionado */
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
    }

    .loading-circle {
      position: absolute; /* Adicionado */
      top: 50%; /* Adicionado */
      left: 50%; /* Adicionado */
      transform: translate(-50%, -50%); /* Adicionado */
      width: 40px;
      height: 40px;
      border: 4px solid #f3f3f3;
      border-top: 4px solid #3498db;
      border-radius: 50%;
      animation: spin 1s linear infinite;
    }

    @keyframes spin {
      0% {
        transform: rotate(0deg);
      }
      100% {
        transform: rotate(360deg);
      }
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


      
    </div>
  </nav>







    <?php
    session_start();

    if (isset($_POST['entrar']) && !empty($_POST['nome']) && !empty($_POST['senha'])) {
        include_once('conexao.php');
        $nome = $_POST['nome'];
        $senha = $_POST['senha'];

        $sql = "SELECT * FROM tb_usuarios WHERE nome = '$nome' and senha = '$senha'";
        $result = $con->query($sql) or die($con->error);

        if (mysqli_num_rows($result) < 1) {
            unset($_SESSION['nome']);
            echo "<script>alert('Credenciais Inválidas, tente novamente.'); location.href='login.php';</script>";
        } else {
            $row = mysqli_fetch_assoc($result);
            $_SESSION['nome'] = $row['nome'];
            $_SESSION['senha'] = $senha;
            $_SESSION['id_usuario'] = $row['id_usuario'];
            $id = $row['id_usuario'];
            header('Location: index.php');
            ?>
            <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
           
           
            <?php
        }
    } else {
        echo "<script>alert('Ops, algo de errado aconteceu!'); location.href='login2.php';</script>";
    }
    ?>

</body>
</html>
