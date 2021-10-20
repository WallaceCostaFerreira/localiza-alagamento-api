<?php
    require_once("conexao.php");
    $response = array();
    if($mysqli){
        $sql = "SELECT * FROM previsao_teste";
        $result = mysqli_query($mysqli,$sql);
        if($result){
            header("Content-type: JSON");
            $i = 0;
            while($row = mysqli_fetch_assoc($result)){
                $response[$i]['id'] = $row['id'];
                $response[$i]['dia'] = $row['dia'];
                $response[$i]['tempo'] = $row['tempo'];
                $response[$i]['maxima'] = $row['maxima'];
                $response[$i]['minima'] = $row['minima'];
                $response[$i]['iuv'] = $row['iuv'];
                $i++;
            }
            echo json_encode($response, JSON_PRETTY_PRINT);
        }
    }else{
        echo "Sem conexão";
    }
           
?>