
<!DOCTYPE html>
<html lang="es" xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="../css/style.css" type="text/css" />
        <script src="js/script.js"></script>
        <title>Vida Sostenible</title>
    </head>
    <body>
        <section id="box-container">

        <?php
        $servername = "localhost";
$user = "root";
$password = "";
$dbname = "vidasostenible";
$conn = new mysqli($servername, $user,$password,$dbname);
$conn->set_charset("utf8");
        


        $lastId=($_GET['lastId']);

        $sql2="SELECT responde.idPersona, pregunta.pregunta, respuesta.respuesta, depende.valorRespuesta, textoInformativo.texto 
        FROM responde 
        JOIN depende ON responde.idRespuesta=depende.id 
        JOIN pregunta ON pregunta.id=depende.idPregunta 
        JOIN respuesta ON respuesta.id=depende.idRespuesta 
        LEFT JOIN textoInformativo ON depende.idTexto=textoInformativo.id 
        WHERE responde.idPersona=".$lastId;
        $result2 = $conn->query($sql2);

        $valorRespuesta=0;
        if ($result2->num_rows > 0) {
            while($row2 = $result2->fetch_assoc()) {

            $pregunta=$row2["pregunta"];
            $respuesta=$row2["respuesta"];
            $texto=$row2["texto"];
            $valorRespuesta=$row2["valorRespuesta"]+$valorRespuesta;
                
            echo "<div class='preguntas' style='display: flex'>";
            echo "<p>".$pregunta."<p>";
            echo "<div class='respuestas'>";
            echo "<h4>Tu Respuesta:</h4>";
            echo "<a>".$respuesta."</a>";
            echo "<h4>Texto informativo:</h4>";
            echo "<a>".$texto."</a>";
            echo "</div>"; 
            echo "</div>";
                
            
        }
        }
            
            
            if($valorRespuesta<25){
                echo "<div class='res'>";
            echo "<h3> Tus puntos totales son:</h3>";
            echo "<h2>".$valorRespuesta."</h2>";
                echo " <h2> Un planeta </h2>";
                echo " <img src='../img/mundo.jpg'>";
            }
            else if($valorRespuesta>=25 && $valorRespuesta<=50){
                echo "<div class='res2'>";
            echo "<h3> Tus puntos totales son:</h3>";
            echo "<h2>".$valorRespuesta."</h2>";
                echo " <h2> Tres planetas </h2>";
                echo " <img src='../img/mundoAmarillo.jpg'>";
                echo " <img src='../img/mundoAmarillo.jpg'>";
                echo " <img src='../img/mundoAmarillo.jpg'>";
                
            }else{
                echo "<div class='res3'>";
            echo "<h3> Tus puntos totales son:</h3>";
            echo "<h2>".$valorRespuesta."</h2>";
                echo " <h2> Cinco planetas </h2>";
                echo " <img src='../img/mundoRojo.jpg'>";
                echo " <img src='../img/mundoRojo.jpg'>";
                echo " <img src='../img/mundoRojo.jpg'>";
                echo " <img src='../img/mundoRojo.jpg'>";
                echo " <img src='../img/mundoRojo.jpg'>";
            }
            echo "</div>";    

        ?>
        </section>
    </body>
</html>