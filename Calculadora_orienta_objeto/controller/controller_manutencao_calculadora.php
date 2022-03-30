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



    /**
     *  Montagem da Tela
     */
    public function montaTela() {
        return require_once('./view/view_manutencao_calculadora.php');
    }
}