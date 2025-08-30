<?php
class Produto {
    public int $id;
    public string $nome;
    public float $preco;
    public int $estoque;

    public function __construct(int $id, string $nome, float $preco, int $estoque){
        $this->id = $id;
        $this->nome = $nome;
        $this->preco = $preco;
        $this->estoque = $estoque;
    }
}