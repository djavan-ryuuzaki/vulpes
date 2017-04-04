<?php

namespace Lagopus\Evento;

/**
 *  EventoInterface
 *  Contrato para um Evento
 *  @author Djavan "Ryuuzaki" Fernando
 *  @since	03/04/2017
 *  @version 1.0.0
 */

use Lagopus\Evento\Evento;
use Lagopous\Evento\Permissao\Permissao;

interface EmissorEventoInterface {
	
		
	public function on(Evento $evento);
	public function once(Evento $evento);
	public function removeListener(Evento $evento);
	public function removeAllListeners(Evento $evento);
	public function ouvintes($nomeEvento);
	public function emit($nomeEvento, array $argumentos = [], \Permissao $permissao);
	
	
}

?>