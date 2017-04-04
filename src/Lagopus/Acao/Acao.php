<?php 

/**
 *  @pacote: Acao
 *  @responsabilidade: Representar um evento.
 *  @autor: Djavan Fernando (Djavan Ryuuzaki)
 *  @desde: 27/07/2016
 */

namespace Lagopus\Acao;

use Lagopus\Vulpes\Essencia;

class Acao extends Essencia {
	
	private $teste;
	
	public function __construct(){
		echo "EXECUTOU CONSTRUCT <br />";
	}
	
	public function teste(){
		echo "EXECUTOU TESTE <br />";
	}
	
	public function __call($method,$arguments) {		
		if(method_exists($this, $method)) {
			echo "EXECUTOU ANTES DA ";
			return call_user_func_array(array($this,$method),$arguments);
		}
	}
	
}

?>