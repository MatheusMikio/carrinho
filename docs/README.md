# Sistema de Carrinho de Compras em PHP

## Integrantes
- Nome: Matheus Mikio
- RA: 123456

## Como executar
1. Instale o XAMPP e inicie Apache + MySQL.
2. Coloque a pasta `carrinho` dentro de `htdocs`.
3. Acesse: http://localhost/carrinho/src/index.php

## Funcionalidades
- Listar produtos disponíveis
- Adicionar produto ao carrinho (validando estoque)
- Remover produto do carrinho
- Aplicar cupom de desconto (`DESCONTO10`)
- Calcular subtotal e total com desconto

## Exemplos de uso (Casos de Teste)

### Caso 1 — Adicionar produto válido
Produto: Água x2 → Adicionado com sucesso.

### Caso 2 — Adicionar além do estoque
Produto: Suco x50 → Estoque insuficiente.

### Caso 3 — Remover produto
Produto: Refrigerante → Removido com sucesso.

### Caso 4 — Aplicar cupom
Cupom: DESCONTO10 → 10% de desconto aplicado.