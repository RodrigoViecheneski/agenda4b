<?php

class Funcoes {
	public function dtNasc($vlr, $tipo){
		switch ($tipo) {
			case 1:
				$rst = implode("-", array_reverse(explode("/", $vlr))); //converte data Brasil p/ Internacional
				break;
			
			case 2:
				$rst = implode("/", array_reverse(explode("-", $vlr))); //coverte data Internacional p/ Brasil
				break;
		}
		return $rst;
	}

	//novas funções
}