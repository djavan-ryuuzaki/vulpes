<?php 

require_once "../../vendor/autoload.php";

use Lagopus\Evento\Acao;

$acao = new Acao(array(), "acaoTeste",  "escopo" , "papel", array(1,2));

$acao->nome("MUDEI NOME");

var_dump($acao);

?>