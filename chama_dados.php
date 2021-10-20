<?php
    require_once("conexao.php");

    $link = "http://servicos.cptec.inpe.br/XML/cidade/244/previsao.xml";

    $xml = simplexml_load_file($link);

    if($xml !== false){
        foreach($xml -> previsao as $previsao){
            echo "<strong>Dia:</strong> " . $previsao -> dia ;
            echo "<strong>Tempo:</strong> ". $previsao -> tempo ;
            echo "<strong>Máxima:</strong> ". $previsao -> maxima ;
            echo "<strong>Mínima:</strong> ". $previsao -> minima ;
            echo "<strong>IUV:</strong> ". $previsao -> iuv ;
            echo "<br />";

            $sql = "INSERT INTO previsao_teste (dia, tempo, maxima, minima, iuv) VALUES ('".$previsao -> dia."', '".$previsao -> tempo."', '".$previsao -> maxima."', '".$previsao -> minima."', '".$previsao -> iuv."')";
            if (mysqli_query($mysqli, $sql)) {
                echo "SALVO!";
            } else {
                echo "Error: " . $sql . "<br>" . mysqli_error($mysqli);
            }
        }

        mysqli_close($mysqli);
    }
?>