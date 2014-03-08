<?php

class   Funcionario {

        protected $id_func = NULL;
        protected $nome_func = NULL;
        protected $rg_func = NULL;
        protected $cpf_func = NULL;
        protected $email_func = NULL;
        protected $cep = NULL;
        protected $numero = NULL;
        protected $complemento = NULL;

        protected $id_acesso = NULL;
        protected $nome_usuario = NULL;
        protected $senha_usuario = NULL;
        protected $funcionario_id_func = NULL;
        protected $grupo_acesso_idgrupo_acesso = NULL;

        protected $idgrupo_acesso = NULL;
        protected $grupo = NULL;
        protected $descr_grupo = NULL;
        
        protected $rua = NULL;
        protected $bairro = NULL;
        protected $cidade = NULL;
        protected $uf = NULL;

        public function __construct() {
        }

        public function initObj($id_func, $nome_func, $rg_func, $cpf_func, $email_func, $cep, $numero, $complemento, $id_acesso, $nome_usuario, $senha_usuario, $funcionario_id_func, $grupo_acesso_idgrupo_acesso, $idgrupo_acesso, $grupo, $descr_grupo) {
            $this->id_func = $id_func;
            $this->nome_func = $nome_func;
            $this->rg_func = $rg_func;
            $this->cpf_func = $cpf_func;
            $this->email_func = $email_func;
            $this->cep = $cep;
            $this->numero = $numero;
            $this->complemento = $complemento;
            $this->id_acesso = $id_acesso;
            $this->nome_usuario = $nome_usuario;
            $this->senha_usuario = $senha_usuario;
            $this->funcionario_id_func = $funcionario_id_func;
            $this->grupo_acesso_idgrupo_acesso = $grupo_acesso_idgrupo_acesso;
            $this->idgrupo_acesso = $idgrupo_acesso;
            $this->grupo = $grupo;
            $this->descr_grupo = $descr_grupo;
        }

    public function getRua() {
        return $this->rua;
    }

    public function getBairro() {
        return $this->bairro;
    }

    public function getCidade() {
        return $this->cidade;
    }

    public function getUf() {
        return $this->uf;
    }

    public function setRua($rua) {
        $this->rua = $rua;
    }

    public function setBairro($bairro) {
        $this->bairro = $bairro;
    }

    public function setCidade($cidade) {
        $this->cidade = $cidade;
    }

    public function setUf($uf) {
        $this->uf = $uf;
    }
        
    public function getId_func() {
        return $this->id_func;
    }

    public function setId_func($id_func) {
        $this->id_func = $id_func;
    }

    public function getNome_func() {
        return $this->nome_func;
    }

    public function setNome_func($nome_func) {
        $this->nome_func = $nome_func;
    }

    public function getRg_func() {
        return $this->rg_func;
    }

    public function setRg_func($rg_func) {
        $this->rg_func = $rg_func;
    }

    public function getCpf_func() {
        return $this->cpf_func;
    }

    public function setCpf_func($cpf_func) {
        $this->cpf_func = $cpf_func;
    }

    public function getEmail_func() {
        return $this->email_func;
    }

    public function setEmail_func($email_func) {
        $this->email_func = $email_func;
    }

    public function getCep() {
        return $this->cep;
    }

    public function setCep($cep) {
        $this->cep = $cep;
    }

    public function getNumero() {
        return $this->numero;
    }

    public function setNumero($numero) {
        $this->numero = $numero;
    }

    public function getComplemento() {
        return $this->complemento;
    }

    public function setComplemento($complemento) {
        $this->complemento = $complemento;
    }

    public function getId_acesso() {
        return $this->id_acesso;
    }

    public function setId_acesso($id_acesso) {
        $this->id_acesso = $id_acesso;
    }

    public function getNome_usuario() {
        return $this->nome_usuario;
    }

    public function setNome_usuario($nome_usuario) {
        $this->nome_usuario = $nome_usuario;
    }

    public function getSenha_usuario() {
        return $this->senha_usuario;
    }

    public function setSenha_usuario($senha_usuario) {
        $this->senha_usuario = $senha_usuario;
    }

    public function getFuncionario_id_func() {
        return $this->funcionario_id_func;
    }

    public function setFuncionario_id_func($funcionario_id_func) {
        $this->funcionario_id_func = $funcionario_id_func;
    }

    public function getGrupo_acesso_idgrupo_acesso() {
        return $this->grupo_acesso_idgrupo_acesso;
    }

    public function setGrupo_acesso_idgrupo_acesso($grupo_acesso_idgrupo_acesso) {
        $this->grupo_acesso_idgrupo_acesso = $grupo_acesso_idgrupo_acesso;
    }

    public function getIdgrupo_acesso() {
        return $this->idgrupo_acesso;
    }

    public function setIdgrupo_acesso($idgrupo_acesso) {
        $this->idgrupo_acesso = $idgrupo_acesso;
    }

    public function getGrupo() {
        return $this->grupo;
    }

    public function setGrupo($grupo) {
        $this->grupo = $grupo;
    }

    public function getDescr_grupo() {
        return $this->descr_grupo;
    }

    public function setDescr_grupo($descr_grupo) {
        $this->descr_grupo = $descr_grupo;
    }

}

?>
