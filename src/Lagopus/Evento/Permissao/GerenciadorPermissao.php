<?php

namespace Lagopus\Evento\Permissao;

/**
 *  @pacote: Lagopus.Permissao
 *  @responsabilidade: Fornecer métodos auxiliares validar as permissões de acesso a eventos.
 *  @autor: Djavan Fernando (Djavan Ryuuzaki)
 *  @desde: 04/04/2017
 */
use Lagopus\Evento\Evento;
use Lagopus\Vulpes\Essencia;
//require_once "nucleo/i18n/Tradutor.php";
//require_once "nucleo/excecoes/Erro.php";
//require_once "nucleo/excecoes/Erros.php";

class GerenciadorPermissao extends Essencia {
	
	private $retorno;
	
	public function __construct(){
		
	}
	
	public function valida( Evento $evento, Permissao $fornecida ){
		
		//$tradutor = Tradutor::instancia();
		
		$this->retorno = NULL;
		
		if( !$this->verifica( $evento->permissao(), $fornecida ) ){
			
			return false;
		}		
		
		
		return true;
		
	}
	
		
	public function mensagem(){
		return $this->retorno;
	}
	
	private function verificaPermissoes( $necessario, $fornecida){
		
		if( !is_array($necessario) ){
			$valorNecessario = explode(' ', trim($necessario));
		}else{
			$valorNecessario = $necessario;
		}
		
		if( !is_array($fornecida) ){
			$valorInformado  = explode(' ', trim($fornecida));
		}else{
			$valorInformado = $fornecida;
		}
		
		return (count(array_diff( $valorNecessario, $valorInformado)) == 0);
		
	}
	
	private function verifica(Permissao $necessaria = null, Permissao $fornecida = null){
		
		
		if ( $necessaria != null && $necessaria->escopo() != ''){		
			return $this->verificaPermissoes( $necessaria->escopo(), $fornecida->escopo() );
		}
		
		if ( $necessaria != null && $necessaria->papel() != ''){			
			return $this->verificaPermissoes( $necessaria->papel(), $fornecida->papel() );
		}
		
		if ( $necessaria != null && $necessaria->ids() != ''){
			return $this->verificaPermissoes( $necessaria->ids(), $fornecida->ids() );
		}
	}
	
}
?>
