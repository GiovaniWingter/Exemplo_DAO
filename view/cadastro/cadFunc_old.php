<h1>Em construção.......</h1>
<h2>Volte mais tarde!!!!</h2>
<h2>Teste da Classe FuncionarioDAO</h2>

<?php

    require_once 'controller/conecta.class.php';
    require_once 'model/Funcionario.class.php';
    require_once 'model/FuncionarioDAO.class.php';

    $conn = Conecta::getConexao('config/bd_mysql.ini');
    
    $func = new funcionario();
    $func->initObj(NULL, 'Well', '132654789', '654879132', 'well@llington.com.br', 06549000, '113', 'Casa 1', NULL, 
            'we11', '12345', NULL, 2, 2, 'Supervisor', 'Acesso limitado ao sistema');
    
    //print_r($func);

    $funcDAO = new FuncionarioDAO();
    
   // $funcDAO->addFuncionario($conn, $func);
    
   echo  $funcDAO->addCmbGrupoAcesso($conn);
    
?>