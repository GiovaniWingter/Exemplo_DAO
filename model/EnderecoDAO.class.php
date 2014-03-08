<?php

class EnderecoDAO {

    
    private static $SELECT_CEP="select 
            l.num_cep as cep,
            concat(l.desc_tipo,' ',l.desc_logradouro) as logradouro,
            b.desc_bairro as bairro,c.desc_cidade as cidade,c.flg_estado as uf 

            from logradouros l, bairros b, cidades c 

            where 
            l.bairro_id = b.bairro_id and
            b.cidade_id = c.cidade_id and 
            l.num_cep = :cep";
    
    
        public function selectEndToXML(PDO $conexao, $cep){        
            try{
               $stmtEnd = $conexao->prepare(EnderecoDAO::$SELECT_CEP);
               $stmtEnd->execute(
                   array(
                       ':cep'=> $cep                   )
                 );
                $rows = $stmtEnd->fetch(PDO::FETCH_BOTH);

                $xmlEnd = "<?xml version= '1.0' ?><root cep='$rows[0]'>";
                $xmlEnd = $xmlEnd ."<rua >$rows[1]</rua>";
                $xmlEnd = $xmlEnd ."<bairro >$rows[2]</bairro>";
                $xmlEnd = $xmlEnd ."<cidade >$rows[3]</cidade>";
                $xmlEnd = $xmlEnd ."<uf >$rows[4]</uf>";
                $xmlEnd = $xmlEnd ."</root>";
                Header("Content-type: application/xml; charset=iso-8859-1"); 
                echo $xmlEnd;
               
            }catch (PDOException $e){
                return $e; 
            }   
    }
}

?>
