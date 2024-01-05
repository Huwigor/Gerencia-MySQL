<?php
function excluirProdutoPorNome($nome) {
    $host = "localhost";
    $usuario = "root";
    $senha = "bakuri78";
    $banco = "gerencia";

    try {
        $conexao = new PDO("mysql:host=$host;dbname=$banco", $usuario, $senha);
        
        $conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sqlExcluir = "DELETE FROM produto WHERE nome = :nome";
        
        $consultaExcluir = $conexao->prepare($sqlExcluir);

        $consultaExcluir->bindParam(":nome", $nome);

        $consultaExcluir->execute();

        return true;
    } catch (PDOException $e) {
        echo "Erro: " . $e->getMessage();
        return false;
    } finally {
        $conexao = null;
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["excluir"])) {
    $nomeParaExcluir = $_POST["nome_excluir"];
    
    if (excluirProdutoPorNome($nomeParaExcluir)) {
        echo "Item excluído com sucesso!";
    } else {
        echo "Erro ao excluir o item.";
    }
}
?>