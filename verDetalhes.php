<?php
require '../TrabalhoLoja/conexao.php';

$id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
if ($id === false || $id === null) {
    echo "<p>Pneu inválido!</p>";
    exit();
}

$stmt = $pdo->prepare("SELECT p.*, m.nome AS marca FROM pneus p JOIN marcas m ON p.marca_id = m.id WHERE p.id = ?");
$stmt->execute([$id]);
$p = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$p) {
    echo "<p>Pneu não encontrado!</p>";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>VER DETALHES</title>
    <link rel="stylesheet" href="estilo.css">
</head>
<body class="paginaPrincipal">

<header class="menuTopo">
    <h1>DETALHES DO PNEU</h1> 
    <ul class="listaPersonalizada">
        <li><a href="catalogo.php">VOLTAR</a></li>
    </ul>

</header>

<section class="cadastroProdutos">
    <h1><?= htmlspecialchars($p['modelo']) ?> - <?= htmlspecialchars($p['marca']) ?></h1>
    <p><?= nl2br(htmlspecialchars($p['descricao'])) ?></p>
    <ul>
        <li><strong>Tamanho:</strong> <?= $p['largura'] ?>/<?= $p['perfil'] ?>R<?= $p['aro'] ?></li>
        <li><strong>Preço:</strong> R$ <?= number_format($p['preco'], 2, ',', '.') ?></li>
        <li><strong>Estoque:</strong> <?= $p['estoque'] ?> unidades</li>
    </ul>
</section>
    
</body>
</html>