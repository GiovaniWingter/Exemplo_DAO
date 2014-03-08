<?php
require_once 'controller/conecta.class.php';
require_once './model/FuncionarioDAO.class.php';
require_once 'model/Cliente.class.php';
require_once 'model/ClienteDAO.class.php';
require 'model/DataFormatter.class.php';
require_once './controller/Autenticador.class.php';

$conexao = Conecta::getConexao("config/bd_mysql.ini");

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <title>Área Administrativa</title>
    <link rel="stylesheet" href="css/estilo.css">
    <link rel="stylesheet" href="css/jquery.toastmessage.css">
    <script type="text/javascript" src="js/scripts.js"></script>
    <script type="text/javascript" src="js/jquery.min.js"></script>
    <script type="text/javascript" src="js/jquery.toastmessage.js"></script>
    <script type="text/javascript" src="js/jquery.maskedinput.min.js"></script>
    <script type="text/javascript" src="js/ajax.js"></script>
</head>
<body>
    <?php
    $url = "";
    
    // verifica se foi enviado informações para o login
    if(isset($_POST['txtUser']) && isset($_POST['txtSenha'])){
        $nomeUser = $_POST['txtUser']; 
        $senhaUser = $_POST['txtSenha'];
        // realiza a autenticação        
        Autenticador::autenticaFunc($conexao, $nomeUser, $senhaUser);
    }
    // faz o logout --> saída da area restrita
    if(isset($_GET['sair'])){
        Autenticador::logout(array(0=>"login"));

    }
    
    // define o que irá ser mostrado --> menu ou caixa de autenticação
    if(isset($_COOKIE['login']) && $_COOKIE['login']!=0 ){
        $urlNav = "view/adm/menu.php";
    }else{
        $urlNav = "view/adm/login.php";        
    }
    
    // monta a url solicitada pelo menu de opções
    if(isset($_GET['view']) && isset($_GET['page'])){
        $diretorio = $_GET['view'];
        $pagina = $_GET['page'];
        $url = "view/$diretorio/$pagina";
    }
?>  
    <div id="a">
        <header>
                <a href="index.php" title="Go to Homepage">Área <strong> Administrativa</strong></a>
                <p>Sr. Administrador,  <br /> 
                  <b style="text-align: center; width: 100%; display: block;">utilize o menu abaixo
                  </b><br /><b style="text-align: right; width: 100%; display: block;">para o gerenciamento do sitema </b> </p>
        </header>
        <div id="b">            
            <aside>
                <?php include_once $urlNav ;?>
            </aside>
            
            <article>
                <?php 
                    if($url != ""){
                        try{
                            include_once  $url.".php";
                        }  catch (ErrorException $e){
                            echo "<script type=\"text/javascript\" > showErrorToast('".$e->getMessage()."'); </script>";
                        }
                    }
                ?>    

            </article>
        </div>
        <footer>
            <ul class="icons">
                <li><a href="#"><img src="img/icon1.jpg" alt="">Facebook</a></li>
                <li><a href="#"><img src="img/icon2.jpg" alt="">Twitter</a></li>
                <li><a href="#"><img src="img/icon3.jpg" alt="">LinkedIn</a></li>
            </ul>
        </footer>
    </div>


</html>
