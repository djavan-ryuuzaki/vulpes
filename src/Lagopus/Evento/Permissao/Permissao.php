<?php

namespace Lagopus\Evento\Permissao;

/**
 *  @pacote: Lagopus.Permissao
 *  @responsabilidade: Representar um conjunto de permissões.
 *  @comentario: Níveis de Permissão:
 *   - escopo: permissão ampla e pode se refere ao dominio a que o evento pode ser utilizador:
 *   Ex: o evento editar.usuario só pode ser usado se para quem tiver permissão ao escopo usuario.
 *   - papel: permissão exclusiva para quem possuir o papel (role) correto.
 *   - ids: permissão específica para um ou mais usuários em especial. 
 *  @autor: Djavan Fernando (Djavan Ryuuzaki)
 *  @desde: 04/04/2017
 */

use Lagopus\Vulpes\Essencia;


class Permissao extends Essencia {
	
	private $escopo;
	
	private $papel;
	
	private $ids;
	
	public function __construct($escopo = 'GLOBAL', $papel = '',  $ids = []){
		
		$this->escopo = $escopo;
		$this->papel = $papel;
		$this->ids = $ids;
		
	}
	
	
	
}
?>
