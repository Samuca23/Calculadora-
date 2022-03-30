<?php

/**
 *  Controller da calculadora
 * 
 * @package Controller Calculadora
 * @author Samuel Chiodini 
 * @since 27/03/2022
 */
require_once ('./enum/enum_calculadora.php');
require_once ('./enum/enum_operador.php');

class Calculadora{
    
    /**
     *  Para começar a calculadora
     */
    public function abreCalculadora() {
        $oCalculadota = Calculadora::getInstance();
        $oCalculadota->initSession();
        $oCalculadota->loadSession();
        $oCalculadota->montaTela();
    }
    
    
     /**
     * Inicia a sessão caso não tenha sido iniciada.
     */
    public function initSession() : void
    {
        session_start();
        if (!isset($_SESSION[EnumCalculadora::GUARDANUMERO]) && !isset($_SESSION[EnumCalculadora::VISOR]) && !isset($_SESSION[EnumCalculadora::OPERACAO]))
        {
            $_SESSION[EnumCalculadora::GUARDANUMERO] = EnumCalculadora::NUMERO;
            $_SESSION[EnumCalculadora::VISOR] = '';
            $_SESSION[EnumCalculadora::OPERACAO] = '';
            $_SESSION[EnumCalculadora::QUANTIDADE_OPERADORES] = 0;
        }
    }
    
    public function loadSession() {
        if (!empty($_GET))
        {
            if (isset($_GET[EnumCalculadora::NUMERO])) 
            {
                $_SESSION[EnumCalculadora::GUARDANUMERO] = EnumCalculadora::NUMERO;
                $_SESSION[EnumCalculadora::OPERACAO] .= $this->getNumeroSelecionado();
                $_SESSION[EnumCalculadora::VISOR] .= $this->getNumeroSelecionado();
            } 
            else if (isset($_GET[EnumCalculadora::OPERADOR])) 
            {
                if ($_SESSION[EnumCalculadora::GUARDANUMERO] != EnumCalculadora::OPERADOR) 
                {
                    $_SESSION[EnumCalculadora::QUANTIDADE_OPERADORES]++;
                    if ($_SESSION[EnumCalculadora::QUANTIDADE_OPERADORES] >= 2) 
                    {
                        $this->efetuaCalculo();
                    } 
                    else 
                    {
                        $_SESSION[EnumCalculadora::GUARDANUMERO] = EnumCalculadora::OPERADOR;
                        $this->setOperadorTratado();
                        $this->limpaVisor();
                    }
                }
            }
            else if (isset($_GET[EnumOperador::IGUAL])) 
            {
                $this->efetuaCalculo();
            }
            else if (isset($_GET[EnumCalculadora::LIMPA])) 
            {
                $_SESSION[EnumCalculadora::OPERACAO] = '';
                $this->limpaVisor();
            }
        }
    }
    
    /**
     * Retorna uma instância da classe.
     * @return \self
     */
    public static function getInstance() : self
    {
        return new self();
    }
    
    /**
     * Para limpar o visor
     * 
     */
    private function limpaVisor() 
    {
        $_SESSION[EnumCalculadora::VISOR] = '';
    }
    
    /**
     * Para efetuar o calculo
     */
    private function efetuaCalculo() {
        $xResultado = null;
        $_SESSION[EnumCalculadora::QUANTIDADE_OPERADORES] = 0;
        $sOperacao = $_SESSION[EnumCalculadora::OPERACAO];
        eval('$xResultado = '.$sOperacao.';');
        $this->setValorVisor($xResultado);
        $this->setValorOperacao($xResultado);
    }
    
    /**
     * Para setar o valor do visor
     * 
     * @param bool $xValor
     */
    private function setValorVisor($xValor) {
        $_SESSION[EnumCalculadora::VISOR] = $xValor;
    }
    
    /**
     * Para setar o valor da operacao
     * 
     * @param bool $xOperacao
     */
    private function setValorOperacao($xOperacao) {
        $_SESSION[EnumCalculadora::OPERACAO] = $xOperacao;
    }

    /**
     * Método para retornar o valor
     * 
     * @return $_GET
     */
    private function getNumeroSelecionado() {
        return filter_var($_GET[EnumCalculadora::NUMERO], FILTER_SANITIZE_NUMBER_INT);
    }
    
    /**
     * Método para retornar o tipo de operador
     * 
     * @return $_GET
     */
    private function getOperadorSelecionado() {
         return htmlspecialchars($_GET[EnumCalculadora::OPERADOR], ENT_COMPAT);
    }
    
    /**
     * Método para tratar o operador selecionado
     * 
     * @return string
     * @throws Message
     */
    private function trataOperador() {
        $sOperador = '';
        switch ($this->getOperadorSelecionado()) {
            case EnumOperador::MAIS:
                $sOperador = '+';
                break;
            case EnumOperador::MENOS:
                $sOperador = '-';
                break;
            case EnumOperador::MULTIPLICACAO:
                $sOperador = '*';
                break;
            case EnumOperador::DIVISAO:
                $sOperador = '/';
                break;
            default:
                throw new Message('Selecione um operador');
        }
        return $sOperador;
    }
    
    private function setOperadorTratado() {
        $_SESSION[EnumCalculadora::OPERACAO] .= $this->trataOperador();
    }
    
    private function getVisor() {
        $oCalculadora = Calculadora::getInstance();
        return $_SESSION[EnumCalculadora::VISOR];
    }

    /**
     *  Montagem da Tela
     */
    public function montaTela() {
        return require_once('./view/view_manutencao_calculadora.php');
    }
}