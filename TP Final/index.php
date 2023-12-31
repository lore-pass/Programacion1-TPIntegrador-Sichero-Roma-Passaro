<?php
require_once 'clases/Anuncio.php';
require_once 'clases/RepositorioAnuncios.php';
require_once 'clases/ControladorSesion.php';

$controlador = new ControladorSesion();
$totalAnuncios = $controlador->obtenerTotalAnuncios();
$totalVigentes = $controlador->obtenerTotalAnunciosVigentes();
$totalNoVigentes = $controlador->obtenerTotalAnunciosNoVigentes();

// Verifica si se ha enviado un filtro de vigencia
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["vigencia"])) {
    $vigenciaSeleccionada = $_POST["vigencia"];
    if ($vigenciaSeleccionada === "all") {
        $anuncios = $controlador->obtenerAnuncios();
    } else {
        $anuncios = $controlador->obtenerAnunciosPorVigencia($vigenciaSeleccionada);
    }
} else {
    $anuncios = $controlador->obtenerAnuncios();
}

// Verifica si se ha solicitado un orden específico
if (isset($_POST["ordenar_reciente"])) {
    $anuncios = $controlador->obtenerAnuncios("reciente");
} elseif (isset($_POST["ordenar_antiguo"])) {
    $anuncios = $controlador->obtenerAnuncios("antiguo");
}
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width">
    <title>Pizarra de Anuncios</title>
    <link rel="stylesheet" href="css/styles.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="bootstrap.min (1).css">
</head>

<body class="container">
    <div class="jumbotron text-center">
        <h1>PIZARRA DE ANUNCIOS</h1><br>
        <p><a href="linkLogin.php">Login Personal</a></p>
    </div>
    <div class="text-center">
        <span>
            <h3>ANUNCIOS PUBLICADOS</h3>
        </span>
        <table border="1">
            <thead>
                <tr>
                    <th>Titulo</th>
                    <th>Descripción</th>
                    <th>Fecha de Publicación</th>
                    <th>Carrera</th>
                    <th>Año</th>
                    <th>Comisión</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($anuncios as $anuncio): ?>
                    <tr>
                        <td>
                            <?= $anuncio->titulo ?>
                        </td>
                        <td>
                            <?= $anuncio->texto ?>
                        </td>
                        <td>
                            <?= $anuncio->fecha_publicacion ?>
                        </td>
                        <td>
                            <?= $anuncio->carrera ?>
                        </td>
                        <td>
                            <?= $anuncio->anio ?>
                        </td>
                        <td>
                            <?= $anuncio->comision ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <div class="total-info">
            <p>Total de anuncios publicados: <span>
                    <?= $totalAnuncios ?>
                </span></p>
            <p>Total de anuncios vigentes: <span>
                    <?= $totalVigentes ?>
                </span></p>
            <p style="
    margin-bottom: 0px">Total de anuncios no vigentes: <span>
                    <?= $totalNoVigentes ?>
                </span></p>
        </div>
    </div>
    <div class="text-center">
        <form action="index.php" method="post">
            <input type="submit" name="ordenar_reciente" value="Ordenar por fecha reciente" class="btn btn-secondary">
            <input type="submit" name="ordenar_antiguo" value="Ordenar por fecha antigua" class="btn btn-secondary">
        </form>
        <br>
        <form method="post" action="">
            <label for="vigencia">Filtrar por vigencia:</label>
            <select name="vigencia">
                <option value="all">Todos los anuncios</option>
                <option value="1">Vigente</option>
                <option value="0">No Vigente</option>
            </select>
            <input type="submit" value="Filtrar">
        </form>
    </div>
    <script src="scripts/scripts.js"></script>

</body>

</html>