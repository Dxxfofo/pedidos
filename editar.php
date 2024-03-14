<?php
    // Conecta ao banco de dados usando PDO
    $host = 'localhost';
    $dbname = 'pedidos';
    $username = 'root';
    $password = '';
    
    try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    }
    catch (PDOException $e) {
    die("Erro ao conectar ao banco de dados" . $e->getMessage());
    }

    // Verifica se o ID do pedido foi fornecido como parâmetro
    
    if (!isset($_GET['id'])) {
    header('Location:index.php');
    exit();
    }

    // Obtém o ID do pedido a ser editado

    $id = $_GET['id'];

    // Busca o pedido correspondente na tabela 'pedidos'

    $sql = "SELECT * FROM pedidos WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(":id", $id);
    $stmt->bindValue(':id', $id);
    $stmt->execute();
    $pedido = $stmt->fetch();
    
    // Verifica se o pedido existe

    if (!$pedido) {
    header('Location: index.php');
    exit();
    }

    // Verifica se o formulário foi enviado

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $data = $_POST['data'];
    $cliente = $_POST['cliente'];
    $produto = $_POST['produto'];
    $valor = $_POST['valor'];

    // Atualiza os dados do pedido na tabela 'pedidos'

    $sql = "UPDATE pedidos SET data = :data, cliente =:cliente, produto =:produto, valor =:valor WHERE id=:id";
    $stmt= $pdo->prepare($sql);
    $stmt->bindValue(':data', $data);
    $stmt->bindValue(':cliente', $cliente);
    $stmt->bindValue(':produto', $produto);
    $stmt->bindValue(':valor', $valor);
    $stmt->bindValue(':id', $id);
    $stmt->execute();
    
    // Redireciona para a página principal após salvar as alterações

    header('Location:index.php');
    exit();
    }
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Editar Pedido</title>
<link rel="stylesheet" href="style.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<body>
<h1>Editar Pedido</h1>
    <form method="POST" action="editar.php?id=<?php echo $id; ?>">
    <div class="container">
        <div class="row">
            
                    <div class= "mb-4">
                    <label for= "data"><h5 class="card-title mb- mt-1">Data:</h5></label>
                    <input class="form-control" type="text" name="data" value="<?php echo $pedido['data']; ?>">
                    </div>
                    
                    <div class= "mb-4">
                    <label for= "cliente"><h5 class="card-title mb- mt-1">Cliente:</h5></label>
                    <input class="form-control" type="text" name="cliente" value="<?php echo $pedido['cliente']; ?>">
                    </div>
                    
                    <div class= "mb-4 col-6">
                    <label for= "produto"><h5 class="card-title mb- mt-1">Produto:</h5></label>
                    <input class="form-control" type="text" name="produto" value="<?php echo $pedido['produto'];?>">
                    </div>
                    
                    <div class= "mb-4 col-6">
                    <label for= "valor"><h5 class="card-title mb- mt-1">Valor:</h5></label>
                    <input class="form-control" type="text" name="valor" value="<?php echo $pedido['valor']; ?>">
                    </div>
                    
                    <input
                        name="salvar"
                        id="salvar"
                        class="btn btn-primary"
                        type="submit"
                        value="Salvar Alterações"
                    />
                    
        </div>
    </div>
<style>
    *{
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body{
    font-family: 'Times New Roman', Times, serif;
    justify-content: center;
    display: flex;
    align-items: center;
    flex-direction: column;
    align-items: center;
    padding: 15px;
}

label{
    text-align: center;
    
}
form{
    text-align: center;
    display: flex;
    flex-direction: column;
}

.container{
    width: 300px;
    padding: 15px;
}

input{
    margin: 5px 0px;
    height: 35px;
    padding: 7px;
    text-align: center;
}

</style>
</form>
</body>
</html>