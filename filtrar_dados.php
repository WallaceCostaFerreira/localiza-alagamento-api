<?php
require_once("conexao.php");
require_once("gerar_logs.php");
logMsg("Iniciando Consulta de Dados...");

logMsg("Tentando Consultar Banco de Dados...", 'warning');
//Pegando dados via Get
// $nivel = $_GET['nivel'];
$data = $_GET['dataAtualizacao'];
$data = date_create($data);
$data = date_format($data, 'Y-m-d');

// $timestamp = strtotime($data);
// $new_date = date("d/m/Y", $timestamp);
$sql = " SELECT * FROM alagamentos WHERE DATE_FORMAT(`dataAtualizacao`, '%Y-%m-%d') = '$data' ";
// echo $sql;

// SELECT DATE_FORMAT(`dataAtualizacao`, "%Y %m %d") from alagamentos

$result = mysqli_query($mysqli, $sql) or die("Erro ao retornar dados");
logMsg("Consulta realizada com sucesso...");

$res = array();
while($registro = mysqli_fetch_assoc($result))
{
    logMsg("Título: ".$registro['titulo']);
    logMsg("Descrição: ".$registro['descricao']);
    logMsg("Nível: ".$registro['nivel']);
    logMsg("Longitude: ".$registro['longitude']);
    logMsg("Latitude: ".$registro['latitude']);
    logMsg("Data Atualização: ".$registro['dataAtualizacao']);
    logMsg("Pressão: ".$registro['pressao']);
    logMsg("Temperatura: ".$registro['temperatura']);
    logMsg("Tempo: ".$registro['tempo']);
    logMsg("Umidade: ".$registro['umidade']);
    logMsg("Visibilidade: ".$registro['visibilidade']);

    $res[] = $registro;
}
logMsg("Finalizada consulta de dados...");
echo json_encode($res);
