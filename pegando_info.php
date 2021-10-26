<?php
require_once("conexao.php");
require_once("gerar_logs.php");
logMsg("Iniciando Consulta de Dados para estatísticas ...");

logMsg("Tentando conexão com Banco de Dados...", 'warning');

$data = $_GET['dataAtualizacao'];
$data = date_create($data);
$data = date_format($data, 'Y-m-d');

$sql = " SELECT dataAtualizacao, pressao, temperatura, tempo, umidade FROM alagamentos 
        WHERE DATE_FORMAT(`dataAtualizacao`, '%Y-%m-%d') = '$data'";

$result = mysqli_query($mysqli, $sql) or die("Erro ao retornar dados");
logMsg("Consulta de ".$data." realizada com sucesso...");

$res = array();
while($registro = mysqli_fetch_assoc($result))
{
    logMsg("DataAtualizacao: ".$registro['dataAtualizacao']);
    logMsg("Pressão: ".$registro['pressao']);
    logMsg("Temperatura: ".$registro['temperatura']);
    logMsg("Tempo: ".$registro['tempo']);
    logMsg("Umidade: ".$registro['umidade']);
    $res[] = $registro;
}
logMsg("Finalizada consulta de dados...");
echo json_encode($res);
