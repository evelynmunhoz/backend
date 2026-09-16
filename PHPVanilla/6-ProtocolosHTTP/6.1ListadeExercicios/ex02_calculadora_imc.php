<?php
declare(strict_types=1);

function calcularIMC(float $peso, float $altura): float {
    return $peso / ($altura * $altura);
}

function classificarIMC(float $imc): string {
    if ($imc < 18.5)return 'Abaixo do peso';
    if ($imc < 25) return "Normal";
    if ($imc < 30) return "Sobrepeso";
    return "Obesidade";
}

$nome = $_POST["nome"] ?? "";
$peso = $_POST["peso"] ?? "";
$altura = $_POST["altura"] ?? "";
$resultado = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!is_numeric($peso) || $peso < 20 || $peso > 300)
        $resultado = "Peso inválido!";
    elseif (!is_numeric($altura) || $altura < 0.5 || $altura > 2.5)
        $resultado = "Altura inválida!";
    else {
        $imc = calcularIMC((float)$peso, (float)$altura);
        $resultado = classificarIMC($imc);
    }
}
?>

<form method="POST">
    <input name="nome" placeholder="Nome"
        value="<?= htmlspecialchars($nome) ?>">

    <input name="peso" type="number" placeholder="Peso (kg)"
        value="<?= htmlspecialchars($peso) ?>">

    <input name="altura" type="number" step="0.01"
        placeholder="Altura (m)"
        value="<?= htmlspecialchars($altura) ?>">

    <button>Calcular</button>
</form>

<p><?= htmlspecialchars($resultado) ?></p>
```
