<?php

/**
 *  Controller da calculadora
 * 
 * @package Controller Calculadora
 * @author Samuel Chiodini 
 * @since 27/03/2022
 */
class Calculadora{
    
    /**
     *  Para começar a calculadora
     */
    public function abreCalculadora() {
        $this->montaTela();
    }

    

    /**
     *  Montagem da Tela
     */
    public function montaTela() {
        return require_once('./view/view_manutencao_calculadora.php');
    }
}