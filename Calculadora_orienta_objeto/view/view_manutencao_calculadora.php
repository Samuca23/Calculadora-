<?php
/**
 * View para a Calculadora
 * @package View Calculadora
 * @author Samuel Chiodini 
 * @since 27/03/2022
 */
require_once('./enum/enum_operador.php');
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="./estilo/estilo_calculadora.css">
    <title>Calculadora</title>
</head>

<body>
    <div class="calculadora">
        <input id="visor" type="text" class="form-action" value=" <?= Calculadora::getVisor() ?> ">
        <div class="valores">
            <a href="?numero=1" class="btn btn-success">1</a>
            <a href="?numero=2" class="btn btn-success">2</a>
            <a href="?numero=3" class="btn btn-success">3</a>
            <a href="?operador=<?= EnumOperador::MAIS?>" class="btn btn-success">+</a>
            <a href="?numero=4" class="btn btn-success">4</a>
            <a href="?numero=5" class="btn btn-success">5</a>
            <a href="?numero=6" class="btn btn-success">6</a>
            <a href="?operador=<?= EnumOperador::MENOS?>" class="btn btn-success">-</a>
            <a href="?numero=7" class="btn btn-success">7</a>
            <a href="?numero=8" class="btn btn-success">8</a>
            <a href="?numero=9" class="btn btn-success">9</a>
            <a href="?operador=<?= EnumOperador::DIVISAO?>" class="btn btn-success">/</a>
            <a href="?numero=0" class="btn btn-success">0</a>
            <a href="?limpa=<?= EnumCalculadora::LIMPA?>" class="btn btn-success">C</a>
            <a href="?igual=<?= EnumOperador::IGUAL?>" class="btn btn-success">=</a>
            <a href="?operador=<?= EnumOperador::MULTIPLICACAO?>" class="btn btn-success">*</a>
        </div>
    </div>
</body>

</html>
