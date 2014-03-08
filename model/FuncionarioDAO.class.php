<?php


class FuncionarioDAO {

    private static $SELECT_FUNC_ID = "select 
                                      * 
                                    from 
                                      base_php.funcionario f, 
                                      base_php.acesso a, 
                                      base_php.grupo_acesso g,
                                      base_php.logradouros l,
                                      base_php.bairros b,
                                      base_php.cidades c
                                    where 
                                      f.id_func = a.funcionario_id_func and
                                      g.idgrupo_acesso = a.grupo_acesso_idgrupo_acesso and
                                      f.cep = l.num_cep and
                                      l.bairro_id = b.bairro_id and
                                      b.cidade_id = c.cidade_id and
                                      f.id_func = :id";

        private static $AUT_FUNC = "select 
                                    f.id_func,
                                    a.nome_usuario,
                                    a.senha_usuario,
                                    a.id_acesso,
                                    g.idgrupo_acesso,
                                    count(f.id_func) as total
                                from
                                    funcionario f, acesso a, grupo_acesso g
                                where
                                    f.id_func = a.funcionario_id_func and
                                    a.grupo_acesso_idgrupo_acesso = g.idgrupo_acesso and
                                    a.nome_usuario = :nome and
                                    a.senha_usuario = :senha";
    
  private static $SELECT_FUNC = "select 
                                       * 
                                   from 
                                        base_php.funcionario f, 
                                        base_php.acesso a, 
                                        base_php.grupo_acesso g
                                   where 
                                        f.id_func = a.funcionario_id_func and
                                        g.idgrupo_acesso = a.grupo_acesso_idgrupo_acesso";
    
  private static $INS_FUNC = "INSERT INTO `base_php`.`funcionario`
                                            (`id_func`,`nome_func`,`rg_func`,
                                            `cpf_func`,`email_func`,`cep`,`numero`,`complemento`)
                                            VALUES
                                            (null,:nome_func,:rg_func,:cpf_func,:email_func,:cep,:numero,:complemento);";
  
  private static $SEL_PK_FUNC = "select last_insert_id() as ultimaPK from funcionario limit 0,1";

  private static $INS_ACESSO = "INSERT INTO `base_php`.`acesso`
                                            (`id_acesso`,`nome_usuario`,`senha_usuario`,`funcionario_id_func`,
                                            `grupo_acesso_idgrupo_acesso`)
                                            VALUES
                                            (null,:nome_usuario,:senha_usuario,:func_id_func,:grupo_acesso_id_grupo_acesso)";
 
  private static $SEL_GRUPO_ACESSO = "SELECT
                                        `grupo_acesso`.`idgrupo_acesso`,
                                        `grupo_acesso`.`grupo`,
                                        `grupo_acesso`.`descr_grupo`
                                      FROM `base_php`.`grupo_acesso`;";
  
  private static $DEL_ACESSO = "DELETE FROM `base_php`.`acesso`
                                    WHERE funcionario_id_func = :id";

  private static $DEL_FUNCIONARIO = "DELETE FROM `base_php`.`funcionario`
                                                WHERE id_func = :id";


  
    public function apagaFunc(PDO $conexao , $idFunc){
      try{
         $stmtDelAcesso = $conexao->prepare(FuncionarioDAO::$DEL_ACESSO);         
         $stmtDelFuncionario =$conexao->prepare(FuncionarioDAO::$DEL_FUNCIONARIO);
         
         $stmtDelAcesso->execute(array(':id'=>$idFunc));
         $stmtDelFuncionario->execute(array(':id'=>$idFunc));
         echo "<script type=\"text/javascript\" > showSuccessToast('Dados Excluídos com sucesso!!'); </script>";
      } catch (PDOException $ex) {
          print_r($ex);
      }
    }


    public function funcionariosToHTML(PDO $conexao){
      try{
          $stmtConsFunc = $conexao->query(FuncionarioDAO::$SELECT_FUNC);
          $nroLinhas = $stmtConsFunc->rowCount();
          $tabela = "";
          if($nroLinhas == 0){
              $tabela = "<tr><td colspan='6'>Não existe funcionário cadastrado!!</td></tr>";
          }  else {
              $linhas = $stmtConsFunc->fetchAll();
              foreach ($linhas as $colunas){
                  $tabela = $tabela . "<tr>"
                                          . "<td>$colunas[1]</td>"
                                          . "<td>$colunas[4]</td>"
                                          . "<td>$colunas[2]</td>"
                                          . "<td>$colunas[3]</td>"
                                          . "<td><a href='index.php?view=cadastro&page=cadfunc&acao=2&id=$colunas[0]'><img src='img/editar.jpg'/></a></td>"
                                          . "<td><a href='index.php?view=cadastro&page=cadfunc&acao=3&id=$colunas[0]'><img src='img/excluir.jpg'/></a></td>"
                                  . "</tr>";
              }
          }
          
      } catch (PDOException $ex) {
          print_r($ex);
      }
      return $tabela;
  }

  public function funcionarioToObj(PDO $conexao, $id, Funcionario $objFunc){
      try {
          $stmtConsFuncId = $conexao->prepare(FuncionarioDAO::$SELECT_FUNC_ID);
          $stmtConsFuncId->execute(array(':id'=>$id));
          $objeto = $stmtConsFuncId->fetch(PDO::FETCH_OBJ);
          $objFunc->setNome_func($objeto->nome_func);
          $objFunc->setCpf_func($objeto->cpf_func);
          $objFunc->setRg_func($objeto->rg_func);
          $objFunc->setEmail_func($objeto->email_func);
          $objFunc->setCep($objeto->cep);
          $objFunc->setNumero($objeto->numero);
          $objFunc->setComplemento($objeto->complemento);
          $objFunc->setId_acesso($objeto->id_acesso);
          $objFunc->setIdgrupo_acesso($objeto->idgrupo_acesso);
          $objFunc->setNome_usuario($objeto->nome_usuario);          
          $objFunc->setRua($objeto->desc_tipo ." ".$objeto->desc_logradouro);
          $objFunc->setBairro($objeto->desc_bairro);
          $objFunc->setCidade($objeto->desc_cidade);
          $objFunc->setUf($objeto->flg_estado);
      
      } catch (PDOException $ex) {
            print_r($ex);
      }
      return $objFunc;
  }

  

  public function addFuncionario(PDO $conexao, Funcionario $objFunc) {
      try{
          //1ª Etapa insert na tabela funcionario
          $stmtInsFunc = $conexao->prepare(FuncionarioDAO::$INS_FUNC);
          $stmtInsFunc->execute(
                  array(
                      ':nome_func'=>$objFunc->getNome_func(),
                      ':rg_func'=>$objFunc->getRg_func(),
                      ':cpf_func'=>$objFunc->getCpf_func(),
                      ':email_func'=>$objFunc->getEmail_func(),
                      ':cep'=>$objFunc->getCep(),
                      ':numero'=>$objFunc->getNumero(),
                      ':complemento'=>$objFunc->getComplemento()
                    )
                  );
          //2ª Etapa select da PK inserida
          $stmtSelPkFunc = $conexao->query(FuncionarioDAO::$SEL_PK_FUNC);
          $resultSel = $stmtSelPkFunc->fetch(PDO::FETCH_OBJ);
          
          //3ª Etapa insert na tabela Acesso
          $stmtInsAcesso = $conexao->prepare(FuncionarioDAO::$INS_ACESSO);
          $stmtInsAcesso->execute(
                      array(
                          ':nome_usuario'=> $objFunc->getNome_usuario(),
                          ':senha_usuario'=> base64_encode($objFunc->getSenha_usuario()),
                          ':func_id_func'=> $resultSel->ultimaPK,
                          ':grupo_acesso_id_grupo_acesso'=>$objFunc->getIdgrupo_acesso()
                      )      
                  );
                  echo "<script type=\"text/javascript\" > showSuccessToast('Dados salvos com sucesso!!'); </script>";
      } catch (PDOException $ex) {
          echo "<script type=\"text/javascript\" > showErrorToast('".$ex->getMessage()."'); </script>";
        //print_r($ex);
      }
  }
    
  public function addCmbGrupoAcesso(PDO $conexao, $id = 0){
      try{
          $stmtSelGrAcesso = $conexao->query(FuncionarioDAO::$SEL_GRUPO_ACESSO);
          $linhas = $stmtSelGrAcesso->fetchAll();
          
          $comboBox = "<select class='med' name='cmbCargo'><option value='0'>selecione...</option>";          
          foreach ($linhas as $coluna) {
              if($id == $coluna['idgrupo_acesso'] ){
                  $comboBox = $comboBox . "<option selected value='".$coluna['idgrupo_acesso']."'>". $coluna['grupo'] ."</option>";
              }else{
                  $comboBox = $comboBox . "<option value='".$coluna['idgrupo_acesso']."'>". $coluna['grupo'] ."</option>";
              }
              
          }
          $comboBox .= "</select>"; 
          
          return $comboBox;
          
      } catch (PDOException $ex) {
          print_r($ex);
      }
      
  }

    public function autenticarFunc(PDO $conexao , $nomeUser, $senhaUser){
        try{
            $stmtAut = $conexao->prepare(FuncionarioDAO::$AUT_FUNC);
            $stmtAut->execute(array(':nome'=>$nomeUser,':senha'=> base64_encode($senhaUser)));
            $result = $stmtAut->fetch(PDO::FETCH_OBJ); 
            if($result->total == 1){
                setcookie('login', '1', 0, "/");
                return TRUE;
            }else{
                setcookie('login', '0', 0, "/");
                echo "<script type=\"text/javascript\" > showErrorToast('Nome de usuário ou senha inválido!'); </script>";                
            }

        }  catch (PDOException $e){
            //return $e;
            echo "<script type=\"text/javascript\" > showErrorToast('".$e->getMessage()."'); </script>";
        }
    }

}
?>