<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title>Calculadora</title>
</head>

<body>
    <form action="calcula.php" method="POST">
        <table>
            <tr>
                <div names="resultado" action="?valor1?valor2"></div>
            </tr>
            <tr>
                <td><button class="btn btn-dark" value="1" name="valor">1</button></td>
                <td><button class="btn btn-dark" value="2" name="valor">2</button></td>
                <td><button class="btn btn-dark" value="3" name="valor">3</button></td>
                <td><button class="btn btn-success" name="operador" value="adi">+</button></td>
            </tr>
            <tr>
                <td><button class="btn btn-dark" value="4" name="valor">4</button></td>
                <td><button class="btn btn-dark" value="5" name="valor">5</button></td>
                <td><button class="btn btn-dark" value="6" name="valor">6</button></td>
                <td><button class="btn btn-success" name="operador" value="sub">-</button></td>

            </tr>
            <tr>
                <td><button class="btn btn-dark" value="7" name="valor">7</button></td>
                <td><button class="btn btn-dark" value="8" name="valor">8</button></td>
                <td><button class="btn btn-dark" value="9" name="valor">9</button></td>
                <td><button class="btn btn-success" name="operador" value="multi">X</button></td>
            </tr>
            <tr>
                <td><button class="btn btn-dark" value="0" name="valor">0</button></td>
                <td><button class="btn btn-success" name="operador" value="div">/</button></td>
                <td><button class="btn btn-success" name="limpa">C</button></td>
                <td><button class="btn btn-success" name="igual">=</button></td>
            </tr>
        </table>
    </form>
</body>

</html>