<?php

namespace Lagopus\Evento;


class Emissor implements EmissorEventoInterface {
	use EmissorEventoTrait;
	
	protected static $instancia;
	
	private function __construct(){
		
	}
	
	public static function instancia(){
		if( !isset(self::$instancia) || self::$instancia == null ){
			self::$instancia = new Emissor();
		}
		
		return self::$instancia;
	}
	
	public function na(Evento $evento){
		$this->on($evento);
	}
	
	public function no(Evento $evento){
		$this->on($evento);
	}
	
	
}

?>