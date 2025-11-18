<?php
require '../TrabalhoLoja/conexao.php';

if(!isset($_GET['id'])){
    echo "<p>ID do produto não fornecido!</p>";
    exit;
}

$id = (int)$_GET["id"];

$stmt = $pdo->prepare("SELECT * FROM pneus WHERE id = ?");
$stmt->execute([$id]);
$pneus = $stmt->fetch(PDO::FETCH_ASSOC);

if(!$pneus){
    echo "Pneu não encontrado!";
    exit;
}

$stmt = $pdo->prepare("DELETE FROM pneus WHERE id = ?");
$stmt->execute([$id]);

header("Location: index.php");
exit;