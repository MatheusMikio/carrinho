<?php

class Carrinho
{
    public array $produtos = [];
    public float $subTotal = 0;
    public float $desconto = 0;

    public function listarCarrinho(): void
    {
        if (empty($this->produtos)) {
            echo "Carrinho vazio.<br>";
            return;
        }

        foreach ($this->produtos as $p) {
            echo "Produto: {$p['nome']} | Quantidade: {$p['quantidade']} | Preço: R$ " . number_format($p['preco'], 2, ',', '.') . " | Subtotal: R$ " . number_format($p['subtotal'], 2, ',', '.') . "<br>";
        }

        $totalComDesconto = $this->subTotal * (1 - $this->desconto / 100);
        echo "Total: R$ " . number_format($this->subTotal, 2, ',', '.') . "<br>";
        if ($this->desconto > 0) {
            echo "Desconto: {$this->desconto}%<br>";
            echo "Total com desconto: R$ " . number_format($totalComDesconto, 2, ',', '.') . "<br>";
        }
    }

    public function addProduto(array $products, int $id, int $quantity): bool
    {
        if ($quantity <= 0) {
            return false;
        }

        $productOriginal = $this->getProdutoById($products, $id);
        if (!$productOriginal) {
            return false;
        }

        if (!$this->validarProduto($productOriginal, $quantity, $products)) {
            return false;
        }

        foreach ($this->produtos as $index => $p) {
            if ($p['id_produto'] === $id) {
                $this->produtos[$index]['quantidade'] += $quantity;
                $this->produtos[$index]['subtotal'] = $this->produtos[$index]['quantidade'] * $p['preco'];
                $productOriginal->estoque -= $quantity;
                $this->atualizarSubTotal();
                return true;
            }
        }

        $this->produtos[] = [
            'id_produto' => $productOriginal->id,
            'nome'       => $productOriginal->nome,
            'quantidade' => $quantity,
            'preco'      => $productOriginal->preco,
            'subtotal'   => $productOriginal->preco * $quantity,
        ];

        $productOriginal->estoque -= $quantity;
        $this->atualizarSubTotal();
        return true;
    }

    public function removeProduto(int $id, int $quantity, array $products): bool
    {
        if ($quantity <= 0) {
            return false;
        }

        foreach ($this->produtos as $index => $p) {
            if ($p['id_produto'] !== $id) {
                continue;
            }

            $productOriginal = $this->getProdutoById($products, $id);
            if (!$productOriginal) {
                return false;
            }

            if ($p['quantidade'] > $quantity) {
                $this->produtos[$index]['quantidade'] -= $quantity;
                $this->produtos[$index]['subtotal'] = $this->produtos[$index]['quantidade'] * $p['preco'];
                $productOriginal->estoque += $quantity;
                $this->atualizarSubTotal();
                return true;
            }

            $productOriginal->estoque += $p['quantidade'];
            unset($this->produtos[$index]);
            $this->produtos = array_values($this->produtos); 
            $this->atualizarSubTotal();
            return true;
        }
        return false;
    }

    private function atualizarSubTotal(): void
    {
        $this->subTotal = 0;
        foreach ($this->produtos as $p) {
            $this->subTotal += $p['preco'] * $p['quantidade'];
        }
    }

    private function validarProduto(object $product, int $quantity, array $products): bool
    {
        return $product->estoque >= $quantity;
    }

    private function getProdutoById(array $products, int $id): ?object
    {
        foreach ($products as $prod) {
            if ($prod->id === $id) {
                return $prod;
            }
        }
        return null;
    }

    public function aplicarCupom(string $cupom): bool
    {
        if ($cupom === "DESCONTO10") {
            $this->desconto = 10;
            return true;
        }

        $this->desconto = 0;
        return false;
    }
}