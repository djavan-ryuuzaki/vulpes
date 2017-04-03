<?php

namespace Lagopus\Evento\Permissao;

/**
 *  @pacote: Lagopus.Seguranca
 *  @responsabilidade: Fornecer métodos auxiliares verificar de permissoes.
 *  @comentario: Fornece métodos que auxiliam a utilização das permissoes.
 *  @autor: Djavan Fernando (Djavan Ryuuzaki)
 *  @desde: 18/11/2016
 */
use Lagopus\Evento\Acao\Acao;
use Lagopus\Vulpes\Essencia;
//require_once "nucleo/i18n/Tradutor.php";
//require_once "nucleo/excecoes/Erro.php";
//require_once "nucleo/excecoes/Erros.php";

class Permissao extends Essencia {
	
	private $retorno;
	
	public function __construct(){
		
	}
	
	public function verificarPermissoes( Acao $acao, $escopo, $papel, $ids ){
		
		//$tradutor = Tradutor::instancia();
		
		$this->retorno = NULL;
		
		if( !$this->verificaEscopo($acao->permEscopo(), $escopo) ){
			
			//$erro = $tradutor->traduzErro("0403");
			$erro= "ERRO ESCOPO";
			
			$this->retorno = $erro;
			
			return false;
		}
		
		if( !$this->verificaPapel($acao->permPapel(), $papel) ){
			
			//$erro = $tradutor->traduzErro("0403");
			$erro= "ERRO PAPEL";
			$this->retorno = $erro;
			
			return false;
		}
		
		if( !$this->verificaIds($acao->permIds(), $ids) ){
			
			//$erro = $tradutor->traduzErro("0403");
			$erro= "ERRO ID";
			
			$this->retorno = $erro;
			
			return false;
		}
		
		return true;
		
	}
	
	public function verificaEscopo($necessario, $informado){
		return $this->verifca($necessario, $informado);
	}
	
	public function verificaPapel($necessario, $informado){
		return $this->verifca($necessario, $informado);
	}
	
	public function verificaIds($necessario, $informado){
		return $this->verifca($necessario, $informado);
	}
	
	public function mensagem(){
		return $this->retorno;
	}
	
	private function verifca($necessario, $informado){
		
		
		if( !is_array($necessario) ){		
			$valorNecessario = explode(' ', trim($necessario));
		}else{
			$valorNecessario = $necessario;
		}
		
		if( !is_array($informado) ){
			$valorInformado  = explode(' ', trim($informado));
		}else{
			$valorInformado = $informado;
		}
		
		return (count(array_diff( $valorInformado, $valorNecessario)) == 0);
	}
	
}
?>
