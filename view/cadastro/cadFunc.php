<?php
require_once 'controller/conecta.class.php';
require_once 'model/Funcionario.class.php';
require_once 'model/FuncionarioDAO.class.php';
$conn = Conecta::getConexao('config/bd_mysql.ini');

$funcDAO = new FuncionarioDAO();

$acao = isset($_GET['acao']) ? $_GET['acao'] : 0;
$idFunc = isset($_GET['id']) ? $_GET['id'] : 0;

//somente quando enviado via formulário
$acaoPost = isset($_POST['acao']) ? $_POST['acao'] : 0 ; 

//recupera dados se enviados via post
        $nome = isset($_POST['txtNome']) ? $_POST['txtNome'] : "" ;
        $rg = isset($_POST['txtRg']) ? $_POST['txtRg'] : "" ;
        $cpf = isset($_POST['txtCpf']) ? $_POST['txtCpf'] : "" ;
        $email = isset($_POST['txtEmail']) ? $_POST['txtEmail'] : "" ;
        $cep = isset($_POST['txtCep']) ? $_POST['txtCep'] : "" ;
        
        $numero = isset($_POST['txtNum']) ? $_POST['txtNum'] : "" ;
        $complemento = isset($_POST['txtComple']) ? $_POST['txtComple'] : "" ;
        $cargo = isset($_POST['cmbCargo']) ? $_POST['cmbCargo'] : "" ;        
        $nomeUser = isset($_POST['txtNomeUsuario']) ? $_POST['txtNomeUsuario'] : "" ;
        $senhaUser = isset($_POST['txtSenha']) ? $_POST['txtSenha'] : "" ;
       
        //crio o objeto do tipo funcionário
        $objFunc = new funcionario();
        $objFunc->initObj(NULL, $nome, $rg, $cpf, $email, $cep,
                $numero, $complemento, NULL, $nomeUser, $senhaUser,
                NULL, NULL, $cargo, NULL, NULL);
        
//insert
    if($acaoPost == 1){
        $aux = explode("-", $cep);
        $cep = $aux[0].$aux[1];
        $objFunc->setCep($cep);
        $funcDAO->addFuncionario($conn, $objFunc);        
    }
//update
    if($acaoPost == 2){

    }


    if($acao == 0 || $acao == 3){
        //verificar se é exclusão
        if($acao == 3){
            //codificação da exclusão;
            $funcDAO->apagaFunc($conexao, $idFunc);
            
        }
?>
<table>
    <caption>Funcionários</caption>
    <thead>
        <tr>
            <th>Nome</th>
            <th>e-mail</th>
            <th>RG</th>
            <th>CPF</th>
            <th colspan="2">Ação</th>
        </tr>
    </thead>
    <tbody>
    <?php echo $funcDAO->funcionariosToHTML($conexao); ?>
    </tbody>
</table>
<input type="button" class="btn" onclick="window.location='index.php?view=cadastro&page=cadFunc&acao=1'" name="novoCliente" value="Novo">
<?php
    }else{
        if($acao == 2){
            $objFunc = $funcDAO->funcionarioToObj($conn, $idFunc, $objFunc);
        }
?>


<form method="post" action="index.php?view=cadastro&page=cadFunc">
    <h2>Cadastro de Funcionário</h2>
    <input type="hidden" name="acao" value="<?php echo $acao; ?>">
    <input type="hidden" name="idFunc" value="<?php echo $idFunc; ?>">
    <label>Nome:</label><input required type="text" name="txtNome" value="<?php echo $objFunc->getNome_func(); ?>"/> <br />
    <label>RG:</label><input class="peq" type="text" name="txtRg" value="<?php echo $objFunc->getRg_func() ;?>"/> <br />
    <label>CPF:</label><input pattern="\d{3}\.\d{3}\.\d{3}-\d{2}" title="999.999.999-99" placeholder="999.999.999-99" required class="peq" type="text" name="txtCpf" value="<?php echo $objFunc->getCpf_func(); ?>"/> <br />
    <label>e-mail:</label><input required type="email" name="txtEmail" id="txtEmail" value="<?php echo $objFunc->getEmail_func() ;?>"/><br />
    <label>CEP:</label><input pattern="\d{5}-\d{3}" title="99999-99" placeholder="99999-999" onblur="carregaConteudoXMl('controller/endxml.php','cep='+ this.value)" class="mini" required type="text" name="txtCep" id="txtCep" value="<?php echo $objFunc->getCep() ;?>"/><br />
    <label>Rua:</label><input readonly="true" type="text" name="txtRua" id="txtRua" value="<?php echo $objFunc->getRua() ;?>"/><br />
    <label>Número:</label><input class="mini" required type="text" name="txtNum" id="txtNum" value="<?php echo $objFunc->getNumero() ;?>"/><br />
    
    <label>Bairro:</label><input class="med" readonly="true" type="text" name="txtBairro" id="txtBairro" value="<?php echo $objFunc->getBairro() ;?>"/><br />
    <label>Cidade:</label><input class="med" readonly="true" type="text" name="txtCidade" id="txtCidade" value="<?php echo $objFunc->getCidade() ;?>"/><br />
    <label>UF:</label><input class="mini" readonly="true" type="text" name="txtUf" id="txtUf" value="<?php echo $objFunc->getUf() ;?>"/><br />
    
    <label>Complemento:</label><input class="peq" type="text" name="txtComple" id="txtComple" value="<?php echo $objFunc->getComplemento() ;?>"/><br />
    
    <label>Cargo:</label><?php  echo  $funcDAO->addCmbGrupoAcesso($conn, $objFunc->getIdgrupo_acesso());?><br />
    
    <label>Nome de usuário:</label><input class="med"  required type="text" name="txtNomeUsuario" id="txtNomeUsuario" value="<?php echo $objFunc->getNome_usuario() ;?>"/><br />
    <label>Senha:</label><input class="peq"  required type="password" name="txtSenha" id="txtSenha"/><br />
    <label>Confirme a senha:</label><input class="peq"  onInput="checaSenha(this)" required type="password" name="txtSenhaConf" id="txtSenhaConf"/><br />
    <input class="btn" type="reset" value="Limpar"><input class="btn" type="submit" value="Enviar"/>
    <br>
    <input type="button" class="btn" value="Voltar" onclick="window.location='index.php?view=cadastro&page=cadFunc'">
</form>


<?php
   }
?>
