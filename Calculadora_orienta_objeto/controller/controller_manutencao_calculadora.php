<?php

/**
 *  Controller da calculadora
 * 
 * @package Controller Calculadora
 * @author Samuel Chiodini 
 * @since 27/03/2022
 */
require_once ('./enum/enum_calculadora.php');

class Calculadora{
    
    /**
     *  Para começar a calculadora
     */
    public function abreCalculadora() {
        $this->montaTela();
    }
    
    
    public function processRequest() {
        if (!empty($_GET))
        {
            if (isset($_GET[EnumCalculadora::NUMERO])) 
            {
                $_SESSION[EnumCalculadora::LAST] = EnumCalculadora::NUMERO;
                $_SESSION[EnumCalculadora::OPERATION] .= $this->getNumeroSelecionado();
                $_SESSION[EnumCalculadora::VISOR] .= $this->getNumeroSelecionado();
            } 
            else if (isset($_GET[EnumCalculadora::OPERADOR])) 
            {
                if ($_SESSION[EnumCalculadora::GUARDANUMERO] != EnumCalculator::OPERADOR) 
                {
                    $_SESSION[EnumCalculadora::QUANTIDADE_OPERADORES]++;
                    if ($_SESSION[EnumCalculadora::QUANTIDADE_OPERADORES] >= 2) 
                    {
                        $this->calcula();
                    } 
                    else 
                    {
                        $_SESSION[EnumCalculadora::LAST] = EnumCalculadora::OPERADOR;
                        $this->setOperadorTratado();
                        $this->limpaVisor();
                    }
                }
            }
            else if (isset($_GET[EnumCalculadora::IGUAL])) 
            {
                $this->efetuaCalculo();
            }
            else if (isset($_GET[EnumCalculadora::CLEAR])) 
            {
                $_SESSION[EnumCalculadora::OPERATION] = '';
                $this->limpaVisor();
            }
        }
    }
    
    private function limpaVisor() : void
    {
        $_SESSION[EnumCalculatorEnumCalculadora::VISOR] = '';
    }
    
    private function efetuaCalculo() {
        $xResultado = null;
        $_SESSION[EnumCalculadora::QUANTIDADE_OPERADORES] = 0;
        $sOperacao = $_SESSION[EnumCalculadora::OPERACAO];
        eval('$xResultado = '.$sOperacao.';');
        $this->setValorVisor($xResultado);
        $this->setValorOperacao($xResultado);
    }
    
    private function setValorVisor($xValor) {
        $_SESSION[EnumCalculadora::VISOR] = $xValor;
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
         return htmlspecialchars($_GET[EnumCalculator::OPERADOR], ENT_COMPAT);
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

    /**
     *  Montagem da Tela
     */
    public function montaTela() {
        return require_once('./view/view_manutencao_calculadora.php');
    }
}