
<?php
require '../TrabalhoLoja/conexao.php';

$marcas = $pdo->query('SELECT * FROM marcas')->fetchAll();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
$modelo = trim($_POST['modelo']);
$marca_id = (int)$_POST['marca_id'];
$largura = (int)$_POST['largura'];
$perfil = (int)$_POST['perfil']; 
$aro = (int)$_POST['aro'];
$preco = (float)str_replace(',', '.', $_POST['preco']);
$estoque = (int)$_POST['estoque'];
$descricao = trim($_POST['descricao']);

$stmt = $pdo->prepare('INSERT INTO pneus (modelo, marca_id, largura, perfil, aro, preco, estoque, descricao) VALUES (?, ?, ?, ?, ?, ?, ?, ?)');
$stmt->execute([
    $modelo,
    $marca_id,
    $largura,
    $perfil,
    $aro,
    $preco,
    $estoque,
    $descricao,
]);

header('Location: PagPrincipal.php');
exit();
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CADASTRO DE NOVO PRODUTO</title>
    <link rel="stylesheet" href="estilo.css">
</head>
<body class="paginaPrincipal">
    
    <header class="menuTopo">
    <h1>CADASTRO DE NOVO PRODUTO</h1> 
    <ul class="listaPersonalizada">
        <li><a href="index.php">VOLTAR</a></li>
    </ul>
    </header>

    <main>
    <form class="cadastroProdutos" action="" method="post" enctype="multipart/form-data">

        <label>Modelo</label>
        <input type="text" name="modelo" required>
        <br><br>
    
        <label>Marca<select name="marca_id" required>
            <?php foreach ($marcas as $m): ?>
                <option value="<?= $m['id'] ?>"><?= htmlspecialchars($m['nome']) ?></option>
            <?php endforeach; ?>
        </select></label>
        <br><br>
        
        <label>Largura</label>
        <input type="number" name="largura" required>
        <br><br>

        <label>Perfil</label>
        <input type="number" name="perfil" required>
        <br><br>

        <label>Aro</label>
        <input type="number" name="aro" required>
        <br><br>

        <label>Preço</label>
        <input type="number" step="0.01" name="preco" required>
        <br><br>

        <label>Estoque</label>
        <input type="number" name="estoque" required>
        <br><br>

        <label>Descrição</label>
        <textarea name="descricao"></textarea>
        <br><br>

                <button type="submit" class="botaoCadastrar">Cadastrar</button>

    </form>
    </main>

</body>
</html>