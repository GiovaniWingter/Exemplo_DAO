<?php
$cep = isset ($_POST['cep']) ? $_POST['cep'] : 0 ; 
$cep = str_replace("-", "", $cep);
require_once 'conecta.class.php';
require_once '../model/EnderecoDAO.class.php';
$conexao = Conecta::getConexao("../config/bd_mysql.ini");
$objEnd = new EnderecoDAO();
echo $objEnd->selectEndToXML($conexao, $cep);
?>