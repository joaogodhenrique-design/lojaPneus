<?php 
require '../TrabalhoLoja/conexao.php';

$stmt = $pdo->query("SELECT p.*, m.nome AS marca FROM pneus p JOIN marcas m ON p.marca_id = m.id ORDER BY p.id DESC");
$pneus = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="estilo.css">
    <title>CATÁLOGO</title>
</head>
<body class="paginaPrincipal">

<header class="menuTopo">
    <h1>CATÁLOGO DE PNEUS</h1> 
    <ul class="listaPersonalizada">
        <li><a href="index.php">VOLTAR</a></li>
    </ul>

</header>

<div class="tabelaCatalogo">
    <?php if ($pneus): ?>
    <?php foreach ($pneus as $p): ?>
        <article>
            <h2>Modelo: <?= htmlspecialchars($p['modelo']) ?></h2>
            <p><strong>Marca:</strong> <?= htmlspecialchars($p['marca']) ?></p>
            <p><strong>Tamanho:</strong> <?= $p['largura'] ?>/<?= $p['perfil'] ?>R<?= $p['aro'] ?></p>
            <p><strong>Preço:</strong> R$ <?= number_format($p['preco'], 2, ',', '.') ?></p>
            <p><strong>Estoque:</strong> <?= $p['estoque'] ?> unidades</p>
            <a href="verDetalhes.php?id=<?= $p['id']; ?>"class="btnCatalogo">Ver detalhes</a>
        </article>
    <?php endforeach; ?>
    <?php else: ?>
        <p>Nenhum pneu cadastrado.</p>
    <?php endif; ?>
</div>
    
</body>
</html>

