<?php
class Produtos {
    public array $produtos;

    public function __construct(){
        $this->produtos = [
            new Produto(1, "Água", 2.50, 100),
            new Produto(2, "Refrigerante", 6.00, 50),
            new Produto(3, "Suco", 4.50, 30),
            new Produto(4, "Cerveja", 7.90, 200),
            new Produto(5, "Energético", 9.90, 80),
        ];
    }

    public function listarProdutos(){
        foreach($this->produtos as $p){
            echo "ID: {$p->id} | Nome: {$p->nome} | Preço: R$ {$p->preco} | Estoque: {$p->estoque}<br>";
        }
    }
}