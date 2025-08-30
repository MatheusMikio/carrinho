<?php

require_once 'Produto.php';
require_once 'Produtos.php';
require_once 'Carrinho.php';

$listaProdutos = new Produtos();
$carrinho = new Carrinho();

echo "<h2>Lista de produtos:</h2>";
$listaProdutos->listarProdutos();

echo "<hr><h2>Caso 1 — Adicionar produto válido (Água x2)</h2>";
if ($carrinho->addProduto($listaProdutos->produtos, 1, 2)) {
    echo "Produto adicionado com sucesso.<br>";
} 
else {
    echo "Falha ao adicionar produto.<br>";
}
$carrinho->listarCarrinho();
$listaProdutos->listarProdutos();

echo "<hr><h2>Caso 2 — Tentar adicionar além do estoque (Suco x50)</h2>";
if ($carrinho->addProduto($listaProdutos->produtos, 3, 50)) {
    echo "Produto adicionado com sucesso.<br>";
} 
else {
    echo "Estoque insuficiente.<br>";
}
$carrinho->listarCarrinho();
$listaProdutos->listarProdutos();

echo "<hr><h2>Caso 3 — Remover produto do carrinho (Refrigerante x5)</h2>";
$carrinho->addProduto($listaProdutos->produtos, 2, 5);
$carrinho->listarCarrinho();

if ($carrinho->removeProduto(2, 5, $listaProdutos->produtos)) {
    echo "Produto removido do carrinho com sucesso.<br>";
} 
else {
    echo "Falha ao remover produto.<br>";
}
$carrinho->listarCarrinho();
$listaProdutos->listarProdutos();

echo "<hr><h2>Caso 4 — Aplicar cupom de desconto (DESCONTO10)</h2>";
if ($carrinho->aplicarCupom("DESCONTO10")) {
    echo "Cupom aplicado com sucesso.<br>";
} 
else {
    echo "Cupom inválido.<br>";
}
$carrinho->listarCarrinho();
