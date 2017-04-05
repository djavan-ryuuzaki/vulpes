<?php

/**
 *  @pacote: Evento
 *  @responsabilidade: Representar um evento.
 *  @autor: Djavan Fernando (Djavan Ryuuzaki)
 *  @desde: 27/07/2016
 */

namespace Lagopus\Evento;

use Lagopus\Vulpes\Essencia;
use Lagopus\Evento\Emissor;
use Lagopus\Evento\Permissao\Permissao;
use Lagopus\Evento\Permissao\GerenciadorPermissao;


class Evento extends Essencia {
	
	private $nome;
	
	private $metodo;
	
	private $permissao;
	
	private $gerenciadorPermissao;
	
	private $emite;
	
	private $retorno;
	
	private $emissor;
	
	
	public function __construct( $nome = '',  callable $metodo,  Permissao $permissao = NULL, $emite = ''){
		$this->nome       = $nome;
		$this->metodo     = $metodo;		
		$this->permissao  = $permissao;
		$this->gerenciadorPermissao = new GerenciadorPermissao();	
		$this->emissor = Emissor::instancia();		
		$this->emite = $emite;
	}
	
		
	public function executar($params = NULL, Permissao $permissaoFornecida){
		
		if( !$this->gerenciadorPermissao->valida($this, $permissaoFornecida) ){	
			
			return $this->gerenciadorPermissao->mensagem();			
		}
		
		try{
			if (is_array($params)){
				return call_user_func_array($this->metodo, $params);
			} else {
				return call_user_func($this->metodo, $params);
			}
			
		}catch (Exception $ex){
			
			//$tradutor = Tradutor::$instancia();
			
			//$erro = $tradutor->traduzErro("0417");
		}
		
		return false;
		
	}
	
	
	
}

?>