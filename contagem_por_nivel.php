<?php
require_once("conexao.php");
require_once("gerar_logs.php");
logMsg("Iniciando Consulta de Dados para fazer contagem por nível ...");

logMsg("Tentando conexão com Banco de Dados...", 'warning');

//Pegando dados via Get
$data = $_GET['dataAtualizacao'];
$data = date_create($data);
$data = date_format($data, 'Y-m-d');

$sql = " SELECT nivel, count(nivel) as qtd FROM alagamentos 
        WHERE DATE_FORMAT(`dataAtualizacao`, '%Y-%m-%d') = '$data' 
        GROUP BY nivel";

$result = mysqli_query($mysqli, $sql) or die("Erro ao retornar dados");
logMsg("Consulta de ".$data." realizada com sucesso...");

$res = array();
while($registro = mysqli_fetch_assoc($result))
{
    logMsg($registro['nivel']." - ".$registro['qtd']);
    $res[] = $registro;
}
logMsg("Finalizada consulta de dados...");
echo json_encode($res);
