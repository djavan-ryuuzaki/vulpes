<?php

namespace Lagopus\Evento;

/**
 *  EventoInterface
 *  Contrato para um Evento
 *  @author Djavan "Ryuuzaki" Fernando
 *  @since	03/04/2017
 *  @version 1.0.0
 */

use Lagopus\Evento\Acao\Acao;

interface EventoInterface {
	
		
	public function on(Acao $acao);
	public function once(Acao $acao);
	public function removeListener(Acao $acao);
	public function removeAllListeners($event = null);
	public function ouvintes($event);
	public function emit($event, array $arguments = []);
	
	
}

?>