<?php
namespace Lagopus\Evento;

use Lagopus\Evento\Evento;
use Lagopus\Evento\Permissao\Permissao;
use Lagopus\Evento\Mensagem\Mensagem;

trait EmissorEventoTrait {
	
	protected $ouvintes = [];
	
	public function on(Evento $evento)	{
		
		if(!isset( $this->ouvintes[$evento->nome()]) ) {
			$this->ouvintes[$evento->nome()] = array();
		}
		
		if (is_callable( $evento->metodo() ) ){
			$this->ouvintes[$evento->nome()][] = $evento;			
			return true;
		}
		
	}
	
	public function once(Evento $evento)	{
		
		unset( $this->ouvintes[$evento->nome()] );
		
		$this->on($acao);
	}
	
	
	public function removeListener(Evento $evento)	{
		
		if (isset($this->ouvintes[$evento->nome()])) {			
			$index = array_search($evento, $this->ouvintes[$evento->nome()], true);
			if (false !== $index) {
				unset($this->ouvintes[$evento->nome()][$index]);
			}
		}
	}
	
	public function removeAllListeners(Evento $evento = null)	{
		
		if (isset($evento) && $evento->nome() != null) {
			
			unset($this->ouvintes[$evento->nome()]);
		} else {
			$this->ouvintes= [];
		}
	}
	
	
	public function ouvintes($nomeEvento)	{
		return isset($this->ouvintes[$nomeEvento]) ? $this->ouvintes[$nomeEvento] : [];
	}
	
	
	public function emit($nomeEvento, Mensagem $mensagem, Permissao $permissao)	{
		$retorno = "";
		
		foreach ($this->ouvintes($nomeEvento) as $evento) {	
			
			if( $evento->emite() != "" ){
				$argumentos = array( $evento->executar($mensagem, $permissao) );
				$retorno = $this->emit( $evento->emite(), $mensagem, $permissao );
				 $argumentos = array( $retorno );
			}else{
				$retorno = $evento->executar($mensagem, $permissao);
				 $argumentos = array( $retorno );
			}
			
		}
		
		return $retorno;
	}
	
	
	

}

?>