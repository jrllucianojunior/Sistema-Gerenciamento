<?php
// Incluir arquivo de conexão com o banco de dados
include_once('conexao.php');



if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Verificar se os dados foram enviados corretamente
    if (isset($_POST['permissoes']) && is_array($_POST['permissoes'])) {
        $permissoes = $_POST['permissoes'];

        // Iterar sobre as permissões enviadas pelo formulário
        foreach ($permissoes as $permissao => $usuarios) {
            foreach ($usuarios as $nomeUsuario => $liberado) {
                // Atualizar o banco de dados com as novas permissões
                // Aqui você precisará construir e executar a query para atualizar/inserir as permissões alteradas no banco de dados
                // Um exemplo de query UPDATE seria algo assim:
                 $query = "UPDATE tb_permissoes_user SET liberado = '$liberado' WHERE id_relusuario = (SELECT id_usuario FROM tb_usuarios WHERE nome = '$nomeUsuario') AND cod_permissao = (SELECT codigo FROM tb_permissoes WHERE desc_permissao = '$permissao')";
                
                // Execute a query no banco de dados
                 $resultado = mysqli_query($con, $query);

                // Verifique se a query foi executada com sucesso e lide com quaisquer erros, se necessário
                 if ($resultado) {
                    $successMessage = "Permissões salvas com sucesso!";
                //     // Query executada com sucesso
                 } else {
                     $errorMessage = "Não foi possível salvar as permissões";  
                  // Lidar com o erro na execução da query
                 }
            }
        }

        // Redirecionar de volta para a página principal após salvar
        header("Location: permissoes.php"); // Substitua "index.php" pelo nome da sua página principal
        exit();
    }
}
?>

