<?php

namespace Lagopus\Evento;

use Lagopus\Evento\Evento;

class Emissor implements EventoInterface {
	use EmissorEventoTrait;
	
	public function na(Evento $evento){
		$this->on($evento);
	}
	
	public function no(Evento $evento){
		$this->on($evento);
	}
}

?>