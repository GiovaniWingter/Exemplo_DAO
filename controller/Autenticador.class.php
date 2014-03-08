<?php


final class Autenticador {

    
    public static function autenticaFunc($conexao,$nomeUser,$senhaUser){
        $objFuncionarioDAO = new FuncionarioDAO();
        if($objFuncionarioDAO->autenticarFunc($conexao, $nomeUser, $senhaUser)){
            header('location:index.php');           
        }
    }

    public static function logout($array){
        foreach ($array as $item){
            setcookie($item, null,time()- 1,"/");
            header('location:index.php');            
        }
    }
}

?>
