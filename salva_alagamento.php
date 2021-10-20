<?php 
    include_once('conexao.php');
    require_once("gerar_logs.php");
    logMsg("Iniciando amarzenamento de reporte...");

    logMsg("Tentando consultar WerbService...", 'warning');
    //Pegando dados do web service
    $link = "http://servicos.cptec.inpe.br/XML/estacao/SBSP/condicoesAtuais.xml";
    $xml = simplexml_load_file($link);
    logMsg("Dados CPTEC (Condições Atuais)...");

    logMsg("Atualização: ".$xml -> atualizacao);
    logMsg("Pressão: ".$xml -> pressao);
    logMsg("Temperatura: ".$xml -> temperatura);
    logMsg("Tempo: ".$xml -> tempo);
    logMsg("Umidade: ".$xml -> umidade);
    logMsg("Visibilidade: ".$xml -> visibilidade);
    logMsg("--------------------------------------------");
    logMsg("Dados vindo do aplicativo...");
    logMsg("Título: ".$_GET['titulo']);
    logMsg("Descrição: ".$_GET['descricao']);
    logMsg("Nível: ".$_GET['nivel']);
    logMsg("Longitude: ".$_GET['longitude']);
    logMsg("Latitude: ".$_GET['latitude']);

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
        logMsg("Dados Cadastrado com sucesso...");

    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($mysqli);
        logMsg("Erro ao cadastrar dados...".mysqli_error($mysqli),"error");

    }

    mysqli_close($mysqli);

?>