<?php
require '../TrabalhoLoja/conexao.php';

$id = (int)($_GET['id'] ?? 0);

$stmt = $pdo->prepare("SELECT * FROM pneus WHERE id = ?");
$stmt->execute([$id]);
$p = $stmt->fetch();

if (!$p) {
    echo "<p>Pneu não encontrado!</p>";
    exit();
}

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

    $stmt = $pdo->prepare('UPDATE pneus SET modelo = ?, marca_id = ?, largura = ?, perfil = ?, aro = ?, preco = ?, estoque = ?, descricao = ? WHERE id = ?');
    $stmt->execute([
        $modelo,
        $marca_id,
        $largura,
        $perfil,
        $aro,
        $preco,
        $estoque,
        $descricao,
        $id
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
    <title>EDITAR PNEU</title>
    <link rel="stylesheet" href="estilo.css">
</head>
<body class="paginaPrincipal">

<header class="menuTopo">
    <h1>EDITAR PNEU</h1> 
    <ul class="listaPersonalizada">
        <li><a href="index.php">VOLTAR</a></li>
    </ul>
    </header>

    <main>
    <form class="cadastroProdutos" action="" method="post" enctype="multipart/form-data">

        <label>Modelo</label>
        <input type="text" name="modelo" value="<?= htmlspecialchars($p['modelo']) ?>" required>
        <br><br>
    
        <label>Marca<select name="marca_id" required>
            <?php foreach ($marcas as $m): ?>
                <option value="<?= $m['id']; ?>" <?= $m['id'] == $p['marca_id'] ? 'selected' : '' ?>><?= htmlspecialchars($m['nome']) ?></option>
            <?php endforeach; ?>
        </select></label>
        <br><br>
        
        <label>Largura
        <input type="number" name="largura" value="<?= $p['largura'] ?>" required>
        </label>
        <br><br>

        <label>Perfil
        <input type="number" name="perfil" value="<?= $p['perfil'] ?>" required>
        </label>
        <br><br>

        <label>Aro
        <input type="number" name="aro" value="<?= $p['aro'] ?>" required>
        </label>
        <br><br>

        <label>Preço
        <input type="number" step="0.01" name="preco" value="<?= $p['preco'] ?>" required>
        </label>
        <br><br>

        <label>Estoque
        <input type="number" name="estoque" value="<?= $p['estoque'] ?>" required>
        </label>
        <br><br>

        <label>Descrição
        <textarea name="descricao"><?= htmlspecialchars($p['descricao']) ?></textarea>
        </label>
        <br><br>

                <button class="botaoCadastrar" type="submit">Salvar alterações</button>

    </form>
    </main>
    
</body>
</html>