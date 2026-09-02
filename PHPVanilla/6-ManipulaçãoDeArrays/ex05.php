<?php

$carrinho = [
    ["produto" => "Notebook", "preco" => 4000.00],
    ["produto" => "Mouse", "preco" => 150.00],
    ["produto" => "Teclado", "preco" => 300.00]
];

$carrinhoBlackFriday = array_map(
    function($item) {
        $item["preco"] = $item["preco"] * 0.80;

        return $item;
    },
    $carrinho
);

?>

<h2>Black Friday - Preços com 20% de desconto</h2>

<?php foreach ($carrinhoBlackFriday as $item) { ?>

    <p>
        <?php echo $item["produto"]; ?>
        - R$ <?php echo number_format($item["preco"], 2, ",", "."); ?>
    </p>

<?php } ?>
