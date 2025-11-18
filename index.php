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
    <title>PÁGINA PRINCIPAL</title>
    <link rel="stylesheet" href="estilo.css">
</head>
<body class="paginaPrincipal">

<header class="menuTopo">
    <h1>MENU</h1> 
    <ul class="listaPersonalizada">
        <li><a href="cadastroProduto.php">ADICIONAR NOVO PRODUTO</a></li>
        <li><a href="catalogo.php">CATÁLOGO</a></li>
    </ul>
    
</header>



<section class="produtos">
      <h2>PRODUTOS</h2>

      <table>
        <thead>
        <tr>
          <th>ID</th>
          <th>Modelo</th>
          <th>Marca</th>
          <th>Preço</th>
          <th>Estoque</th>
          <th>Ações</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($pneus as $p): ?>
        <tr>
          <td><?= $p['id'] ?></td>
          <td><?= htmlspecialchars($p['modelo']) ?></td>
          <td><?= htmlspecialchars($p['marca']) ?></td>
          <td>R$ <?= number_format($p['preco'], 2, ',', '.') ?></td>
          <td><?= $p['estoque'] ?></td>
          <td>
            <a href="editar.php?id=<?= $p['id'] ?>">Editar</a>
            <a href="excluir.php?id=<?= $p['id'] ?>" onclick="return confirm('Tem certeza que deseja excluir este produto?');">Excluir</a>
          </td>
        </tr>
        <?php endforeach; ?> 
      </tbody>
      </table>

</section>
</body>
</html>