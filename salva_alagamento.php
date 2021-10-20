<?php 
    include_once('conexao.php');

    //Pegando dados do web service
    $link = "http://servicos.cptec.inpe.br/XML/estacao/SBSP/condicoesAtuais.xml";
    $xml = simplexml_load_file($link);
    
    //Armazenando todos os dados no banco de dados
    $sql = "INSERT INTO alagamentos (titulo, descricao, nivel, longitude, latitude, dataAtualizacao, pressao, temperatura, tempo, umidade, visibilidade ) 
            VALUES ('".$_GET['titulo']."', 
                    '".$_GET['descricao']."', 
                    '".$_GET['nivel']."', 
                    '".$_GET['longitude']."', 
                    '".$_GET['latitude']."', 
                    '".$xml -> atualizacao."', 
                    '".$xml -> pressao."', 
                    '".$xml -> temperatura."', 
                    '".$xml -> tempo."', 
                    '".$xml -> umidade."', 
                    '".$xml -> visibilidade."')";

    if (mysqli_query($mysqli, $sql)) {
        echo "SALVO!";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($mysqli);
    }
    mysqli_close($mysqli);

?>