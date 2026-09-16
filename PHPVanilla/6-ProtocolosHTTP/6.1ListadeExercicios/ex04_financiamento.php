<?php
declare(strict_types=1);

$valor = $_POST["valor_veiculo"] ?? "";
$entrada = $_POST["valor_entrada"] ?? "";
$parcelas = $_POST["numero_parcelas"] ?? "";
$resultado = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (is_numeric($valor) && is_numeric($entrada)) {

        if ($entrada >= $valor * 0.20 &&
            in_array((int)$parcelas, [12, 24, 36, 48, 60])) {

            $financiado = $valor - $entrada;
            $juros = $financiado * 0.015 * $parcelas;
            $parcela = ($financiado + $juros) / $parcelas;

            $resultado = "Financiado: R$ " .
                number_format($financiado, 2, ",", ".") .
                "<br>Juros: R$ " .
                number_format($juros, 2, ",", ".") .
                "<br>Parcela: R$ " .
                number_format($parcela, 2, ",", ".");

        } else {
            $resultado = "Verifique a entrada e o número de parcelas.";
        }

    } else {
        $resultado = "Digite valores válidos.";
    }
}
?>

<form method="POST">

    <input name="valor_veiculo" placeholder="Valor do veículo"
        value="<?= htmlspecialchars((string)$valor) ?>">

    <input name="valor_entrada" placeholder="Valor da entrada"
        value="<?= htmlspecialchars((string)$entrada) ?>">

    <select name="numero_parcelas">
        <option value="">Parcelas</option>
        <option>12</option>
        <option>24</option>
        <option>36</option>
        <option>48</option>
        <option>60</option>
    </select>

    <button>Calcular</button>

</form>

<p><?= htmlspecialchars($resultado) ?></p>
```


