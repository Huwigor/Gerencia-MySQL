<?php
$host = "localhost";
$usuario = "root";
$senha = "bakuri78";
$banco = "gerencia";

function excluirClientePorNome($nome) {
}

try {
    $conexao = new PDO("mysql:host=$host;dbname=$banco", $usuario, $senha);

    $conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $nome = isset($_POST["nome"]) ? $_POST["nome"] : "";
        $entrada = isset($_POST["entrada"]) ? $_POST["entrada"] : "";
        $geral = isset($_POST["geral"]);

        $sql = "SELECT nome, quantidade, tipo, entrada FROM produto WHERE 1";

        $parametros = [];

        if (!empty($nome)) {
            $sql .= " AND nome LIKE :nome";
            $parametros[':nome'] = "%$nome%";
        }

        if (!empty($entrada)) {
            $sql .= " AND entrada = :entrada";
            $parametros[':entrada'] = $entrada;
        }

        $consulta = $conexao->prepare($sql);

        foreach ($parametros as $parametro => $valor) {
            $consulta->bindParam($parametro, $valor);
        }

        $consulta->execute();

        $resultado = $consulta->fetchAll(PDO::FETCH_ASSOC);

        echo "<form method='post' action='excluir-cliente.php'>";
echo "<table class='table custom-table'>";
echo "<thead class='thead-dark'>";
echo "<tr><th>Nome</th><th>Tipo</th><th>Quantidade</th><th>Data Entrada</th><th>Remover</th></tr>";
echo "</thead>";
echo "<tbody>";
foreach ($resultado as $linha) {
    echo "<tr>";
    echo "<td>" . $linha['nome'] . "</td>";
    echo "<td>" . $linha['tipo'] . "</td>";
    echo "<td>" . $linha['quantidade'] . "</td>";
    echo "<td>" . $linha['entrada'] . "</td>";
    echo "<td>";
    echo "<input type='hidden' name='nome_excluir' value='" . $linha['nome'] . "'>";
    echo "<input type='submit' name='excluir' value='Excluir' class='btn btn-danger'>";
    echo "</td>";
    echo "</tr>";
}
echo "</tbody>";
echo "</table>";
echo "</form>";
    }
} catch (PDOException $e) {
    echo "Erro: " . $e->getMessage();
}

$conexao = null;
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Consulta</title>
    <link rel="stylesheet" type="text/css" href="consulta-produto.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
</head>
<body>



    <header class="container-flex">
        <div id="box-titulo">
            <h1>H.M Gerência</h1>
        </div>
    </header>

    <div id="box-botoes">
        <button id="botao-adicionar" class="btn btn-danger buttons ml-2 mb-2">Clientes
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
              </svg>
        </button>
        <div id="box-cliente">
            <button id="botao-ad-cliente" class="btn btn-success  mb-2 mt-2 ml-2">Adicionar Clientes
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v6m3-3H9m12 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                  </svg>
            </button>
            <button id="botao-con-cliente" class="btn btn-info  mb-3 ml-2">Consultar Clientes
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" data-slot="icon" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                  </svg>
            </button>
        </div>
        </div>
        <div id="box-botoes2">
        <button class="btn btn-danger buttons ml-2" id="botao-estoque">Estoque
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M20.25 6.375c0 2.278-3.694 4.125-8.25 4.125S3.75 8.653 3.75 6.375m16.5 0c0-2.278-3.694-4.125-8.25-4.125S3.75 4.097 3.75 6.375m16.5 0v11.25c0 2.278-3.694 4.125-8.25 4.125s-8.25-1.847-8.25-4.125V6.375m16.5 0v3.75m-16.5-3.75v3.75m16.5 0v3.75C20.25 16.153 16.556 18 12 18s-8.25-1.847-8.25-4.125v-3.75m16.5 0c0 2.278-3.694 4.125-8.25 4.125s-8.25-1.847-8.25-4.125" />
              </svg>
        </button>
        <div id="box-produto">
            <button id="botao-ad-produto" class="btn btn-success mb-2 mt-3 ml-2" >Adicionar Produtos
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v6m3-3H9m12 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                  </svg>
            </button>
            <button id="botao-con-produto" class="btn btn-info mb-2 ml-2" >Consultar Produtos
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" data-slot="icon" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                  </svg>
            </button>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $("#botao-adicionar").on("click", function() {
                $("#box-cliente").slideToggle("slow");
            });
    
            $("#botao-estoque").on("click", function() {
                $("#box-produto").slideToggle("slow");
            });
        });
    </script>

    <form action="consultar.produto.php" method="post">
        <fieldset id="formulario1" class="">
            <label for="nome" class="d-block mb-2 label-formulario">Consulta por Nome</label>
            <input type="text" name="nome" class="d-block input-formulario" required placeholder="Nome">

            <button type="submit" class="btn btn-dark mt-3">Consultar</button>
        </fieldset>
    </form>
    <form action="consultar.produto.php" method="post">
        <fieldset id="formulario2" >
            <label for="entrada" class="d-block mb-2 label-formulario">Consulta por Data</label>
            <input type="text" name="entrada" class="d-block input-formulario" required placeholder="00/00/0000">

            <button type="submit" class="btn btn-dark mt-3 mb-2">Consultar</button>
        </fieldset>
    </form>
    <form action="consultar.produto.php" method="post">
        <fieldset id="formulario3" >
            <label for="geral" class="d-block label-formulario">Consulta Geral</label>
            

            <button type="submit" class="btn btn-dark mt-3">Consultar</button>
        </fieldset>
    </form>

    <script>
        document.addEventListener('DOMContentLoaded',function(){
        
        var botaoAdCliente = document.getElementById('botao-ad-cliente');
        var botaoConCliente = document.getElementById('botao-con-cliente');            
        var botaoAdProduto = document.getElementById('botao-ad-produto');
        var botaoConProduto = document.getElementById('botao-con-produto');
            
            botaoAdCliente.addEventListener('click', function(){
                window.location.href = "../../cliente/adicionar-cliente/adicionar-cliente.php";
            });
            botaoConCliente.addEventListener('click', function(){
                window.location.href = "../../cliente/consultar-cliente/consultar-cliente.php";
            });
            
            botaoAdProduto.addEventListener('click', function(){
                window.location.href = "../adicionar-produto/adicionar-produto.php";
            });
            botaoConProduto.addEventListener('click', function(){
                window.location.href = "consultar.produto.php";
            });
            
        });
      </script>
</body>
</html>