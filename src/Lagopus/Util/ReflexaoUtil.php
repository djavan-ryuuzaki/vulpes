<?php

namespace Lagopus\Util;
/**
 *  @pacote: nucleo.util
 *  @responsabilidade: Fornecer métodos auxiliares para a Reflexão.
 *  @comentario: Fornece métodos que auxiliam a utilização da Reflexão.
 *  @autor: Djavan Fernando (Djavan Ryuuzaki)
 *  @desde: 17/11/2016
 */


use Lagopus\Evento\Evento;
use ReflectionMethod;
use ReflectionProperty;
use ReflectionClass;

class ReflexaoUtil{
	
	const ACAO = "ACAO";
	const RETORNO = "RETORNO"; 
	
	public static function montaAcao(ReflectionMethod $comportamento, Evento $acao){
	    
	    $matches = array();
		
		preg_match('/@acao\s+([^\s]+)/', $comportamento->getDocComment(), $matches);
		
		if ( count($matches) > 0){
			$acao->nome( $matches[1] );
		}else{
			$acao->nome( "" );
		}
		
		preg_match('/@escopo\s+([^\s]+)/', $comportamento->getDocComment(), $matches);
		
		if ( count($matches) > 0){
			$acao->escopo( $matches[1] );
		}else{
			$acao->escopo( "" );
		}
		
		preg_match('/@papel\s+([^\s]+)/', $comportamento->getDocComment(), $matches);
		
		if ( count($matches) > 0){
			$acao->papel( $matches[1] );
		}else{
			$acao->papel( "" );
		}
		
		preg_match('/@emite\s+([^\s]+)/', $comportamento->getDocComment(), $matches);
		
		if ( count($matches) > 0){
			$acao->emite( $matches[1] );
		}else{
			$acao->emite("");
		}
		
		return $acao;
	}
	
	public static function eAcaoOuHook(ReflectionMethod $comportamento){
	    $matches = array();
	    
		preg_match('/@acao\s+([^\s]+)/', $comportamento->getDocComment(), $matches);		
		
		if ( count($matches) > 0){			
			return self::ACAO;
		}else {
			preg_match('/@retorno\s+([^\s]+)/', $comportamento->getDocComment(), $matches);
			
			if ( count($matches) > 0){
				return self::RETORNO;
			}else {
				return false;
			
			}
		}
	}
	
	public static function pegaTipoAtributo(ReflectionProperty $atributo){
	    
	    $matches = array();
		
		preg_match('/@tipo\s+([^\s]+)/', $atributo->getDocComment(), $matches);
		
		if ( count($matches) > 0){		
			return $matches[1];
		}else{
			return "Mixed";
		}
	}
	
	public static function pegaPadraoData(ReflectionProperty $atributo){
	    $matches = array();
		preg_match('/@padrao\s+([^\s]+? ([^\s]+))/', $atributo->getDocComment(), $matches);
		if(count($matches) <= 0){
			preg_match('/@padrao\s+([^\s]+)/', $atributo->getDocComment(), $matches);
		}
		if ( count($matches) > 0){			
			return $matches[1];
		}else{
			return "d/m/Y H:i:s";
		}
	}
	
	public static function pegaColunaAtributo(ReflectionProperty $atributo){
	    $matches = array();
		preg_match('/@coluna\s+([^\s]+)/', $atributo->getDocComment(), $matches);		
		
		if ( count($matches) > 0){		
			return $matches[1];
		}else{
			return $atributo->getName();
		}
	}
	
	public static function pegaValorColuna($objeto, ReflectionProperty $atributo){
		
		$atributo->setAccessible(true);
		
		return $atributo->getValue($objeto);
	}		
	
	public static function pegaNomeTabela($objeto){
	
		
		$reflect = new ReflectionClass($objeto);
		
		$matches = array();
		
		preg_match('/@tabela\s+([^\s]+)/', $reflect->getDocComment(), $matches);	
		if ( count($matches) > 0){		
			return $matches[1];
		}else{
			return get_class($objeto);
		}	
	}
	
	public static function pegaObjeto(ReflectionProperty $atributo){
	    
	    $matches = array();
	    
		preg_match('/@objeto\s+([^\s]+)/', $atributo->getDocComment(), $matches);
		
		if ( count($matches) > 0){
			return trim($matches[1]);
		}
		
	}
	
	public static function pegaObjetos(ReflectionProperty $atributo){
		
	    $matches = array();
	    
		preg_match('/@lista\s+([^\s]+)/', $atributo->getDocComment(), $matches);
		
		if ( count($matches) > 0){			
			return trim($matches[1]);
		}
	
	}
	
	public static function poemFoxId($id, $objeto){
		$reflect = new ReflectionClass($objeto);
		$atributo = $reflect->getProperty("foxId");
		$atributo->setAccessible(true);
		$atributo->setValue( $objeto, $id);		
		return $objeto;
	}
	
	
	
	
	
	
}


?>