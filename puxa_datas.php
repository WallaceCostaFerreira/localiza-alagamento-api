<?php
require_once("conexao.php");
require_once("gerar_logs.php");
logMsg("Iniciando Consulta de Datas...");

logMsg("Tentando Consultar Banco de Dados...", 'warning');

$sql = " SELECT dataAtualizacao FROM alagamentos";

$result = mysqli_query($mysqli, $sql) or die("Erro ao retornar dados");
logMsg("Consulta realizada com sucesso...");

$res = array();
while($registro = mysqli_fetch_assoc($result))
{
    logMsg("Data trazida : ".$registro['dataAtualizacao']);

    $res[] = $registro;
}
logMsg("Finalizada consulta de datas...");
echo json_encode($res);
