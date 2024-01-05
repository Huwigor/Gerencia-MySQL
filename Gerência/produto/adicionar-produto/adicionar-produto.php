<?php
$host = 'localhost';
$db = 'gerencia';
$user = 'root';
$pass = 'bakuri78';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erro na conexão com o banco de dados: " . $e->getMessage());
}

$resultadoAdicao = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $stmt = $pdo->prepare("INSERT INTO produto (nome, quantidade, tipo, entrada) VALUES (:nome, :quantidade, :tipo, :entrada)");

        $stmt->bindParam(':nome', $_POST['nome']);
        $stmt->bindParam(':quantidade', $_POST['quantidade']);
        $stmt->bindParam(':tipo', $_POST['tipo']);
        $stmt->bindParam(':entrada', $_POST['entrada']);

        $stmt->execute();

        $resultadoAdicao = 'success'; 
    } catch (PDOException $e) {
        $resultadoAdicao = 'error: ' . $e->getMessage();
        
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerência</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="adicionar-produto.css">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/3.3.4/jquery.inputmask.bundle.min.js"></script>
    
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



    <form action="adicionar-produto.php" method="post">
        <fieldset id="formulario">
            <label for="nome" class="d-block mb-2">Produto</label>
            <input type="text" id="form-input" class="mb-2" name="nome" required placeholder="Nome">

            <label for="quantidade" class="d-block mb-2">Quantidade</label>
            <input type="text" id="form-input" class="mb-2" name="quantidade" required placeholder="00">

            <label for="tipo" class="d-block mb-2">Tipo</label>
            <input type="text" id="form-input" class="mb-2" name="tipo" required placeholder="Ex: Laticínio">

            <label for="entrada" class="d-block mb-2">Data Entrada</label>
            <input type="text" id="form-input" name="entrada" required placeholder="00/00/0000">

            <button class="btn btn-dark d-block" type="submit" id="button-form">Adicionar</button>
            <div id="mensagem" class= "<?php echo $resultadoAdicao === 'success' || strpos($resultadoAdicao, 'error') === 0 ? 'visible' : ''; ?>">
                <?php
                    if ($resultadoAdicao === 'success') {
                        echo 'Produto adicionado com sucesso!';
                    } elseif (strpos($resultadoAdicao, 'error') === 0) {
                        echo 'Falha ao adicionar o Produto. Tente novamente.';
                    }
                    ?></div>
        </fieldset>
    </form>


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
            window.location.href = "adicionar-produto.php";
        });
        botaoConProduto.addEventListener('click', function(){
            window.location.href = "../consultar-produto/consultar.produto.php";
        });
        
    });
  </script>

</body>
</html>