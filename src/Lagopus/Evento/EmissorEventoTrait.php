<?php
namespace Lagopus\Evento;

use Lagopus\Evento\Acao\Acao;

trait EmissorEventoTrait {
	
	protected $ouvintes = [];
	
	public function on(Acao $acao)	{
		
		if(!isset( $this->ouvintes[$acao->nome()]) ) {
			$this->ouvintes[$acao->nome()] = array();
		}
		
		if (is_callable( $acao->metodo() ) ){
			$this->ouvintes[$acao->nome()][] = $acao;			
			return true;
		}
		
	}
	
	public function once(Acao $acao)	{
		
		unset( $this->ouvintes[$acao->nome()] );
		
		$this->on($acao);
	}
	
	
	public function removeListener(Acao $acao)	{
		
		if (isset($this->ouvintes[$acao->nome()])) {			
			$index = array_search($acao, $this->ouvintes[$acao->nome()], true);
			if (false !== $index) {
				unset($this->ouvintes[$acao->nome()][$index]);
			}
		}
	}
	
	public function removeAllListeners($event = null)	{
		if ($event !== null) {
			unset($this->ouvintes[$event]);
		} else {
			$this->ouvintes= [];
		}
	}
	
	
	public function ouvintes($event)	{
		return isset($this->ouvintes[$event]) ? $this->ouvintes[$event] : [];
	}
	
	
	public function emit($event, array $arguments = [], $escopo = '', $papel = '', $ids = array())	{			
		foreach ($this->ouvintes($event) as $acao) {			
			$acao->executar($arguments, $escopo, $papel, $ids);
		}
	}
}

?>