<?php

/**
 *  @pacote: Evento.Acao
 *  @responsabilidade: Registrar um método para uma determinada ação.
 *  @autor: Djavan Fernando (Djavan Ryuuzaki)
 *  @desde: 27/07/2016
 */

namespace Lagopus\Evento\Acao;

use Lagopus\Vulpes\Essencia;
use Lagopus\Evento\Permissao\Permissao;

class Acao extends Essencia {
	
	private $nome;
	
	private $metodo;
	
	private $permEscopo;
	
	private $permPapel;
	
	private $permIds;
	
	private $permissao;
	
	
	public function __construct(callable $metodo, $nome = '',  $permEscopo = '', $permPapel = '', $permIds = null){
		$this->nome       = $nome;
		$this->metodo     = $metodo;
		$this->permEscopo = $permEscopo;
		$this->permPapel  = $permPapel;
		$this->permIds    = $permIds;
		$this->permissao  = new Permissao();
	}
	
	public function executar($params = NULL, $escopo = '', $papel = '', $ids = ''){
		
		//$erros = Erros::instancia();
		
		
		if( !$this->permissao->verificarPermissoes($this, $escopo, $papel, $ids) ){
			
			return $this->permissao->mensagem();
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