<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de Pedidos</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<body>
    <nav class="show-menu">
        <h1 class="logo">Logo</h1>
        <ul class="ul">
            <li>Login</li>
            <li>Produtos</li>
            <li>Contato</li>
            <li>Ajuda</li>
        </ul>
        <button class="button">Login</button>
        <div class="menu" onclick="menuShow()"><i class="fa-solid fa-bars"></i></div>
    </nav>

    <div class="li">
        <ul>
            <li>Login</li>
            <li>Produtos</li>
            <li>Contato</li>
            <li>Ajuda</li>
        </ul>
        <button class="button">Login</button>
    </div>

    <form method="post" action="salvar.php">

        <div class="container">
            <h1>Meus Pedidos</h1>
            <div class="row">
                <div class="mb-4">
                    <label class="form_label" for="data">
                        <h5 class="card-title mb- mt-1">Data:</h5>
                    </label>
                    <input class="form-control" type="date" name="data" id="data">
                </div>

                <div class="mb-4">
                    <label class="form_label" for="cliente">
                        <h5 class="card-title mb- mt-1">Cliente:</h5>
                    </label>
                    <input class="form-control" type="text" name="cliente" id="cliente">
                </div>

                <div class="mb-4 col-6">
                    <label class="form_label" for="produto">
                        <h5 class="card-title mb- mt-1">Produto:</h5>
                    </label>
                    <input class="form-control" type="text" name="produto" id="produto">
                </div>

                <div class="mb-4 col 6">
                    <label class="form_label" for="valor">
                        <h5 class="card-title mt-1">Valor:</h5>
                    </label>
                    <input class="form-control" type="number" name="valor">
                </div>

                <input name="salvar" id="salvar" class="btn btn-primary eeee" type="submit" value="Concluir Pedido" />
            </div>
        </div>

    </form>
    <hr>

    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Data</th>
                    <th scope="col">Cliente</th>
                    <th scope="col">Produto</th>
                    <th scope="col">Valor</th>
                    <th scope="col">Ações</th>
                </tr>
            </thead>

            <?php

            // Conecta ao banco de dados usando PDO

            $host = 'localhost';
            $dbname = 'pedidos';
            $username = 'root';
            $password = '';

            try {
                $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
            } catch (PDOException $e) {
                die("Erro ao conectar ao banco de dados" . $e->getMessage());
            }

            // Selecionar os dados da tabela pedidos

            $sql = "SELECT * FROM pedidos";
            $stmt = $pdo->prepare($sql);
            $stmt->execute();

            //Exibir os produtos em uma tabela

            while ($row = $stmt->fetch()) {
                echo "<tr>";
                echo "<td>" . $row['data'] . "</td>";
                echo "<td>" . $row['cliente'] . "</td>";
                echo "<td>" . $row['produto'] . "</td>";
                echo "<td>" . 'R$' . number_format($row['valor'], 2, ",", ".") . "</td>";
                echo "<td>";
                echo "<a class='btn btn-primary' href='editar.php?id=" . $row['id'] . "'>Editar</a>";
                echo "<a class='btn btn-danger' href='excluir.php?id=" . $row['id'] . "'>Excluir</a>";
                echo "</td>";
                echo "</tr>";
            }
            ?>
            </tbody>
        </table>
    </div>
</body>
</html>