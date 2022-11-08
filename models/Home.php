<?php
class Home extends model{
	private $return;
	//meses do ano
	public function getAllMeses() {
		$array = array(
			1 => 'Janeiro', 
			2 => 'Fevereiro', 
			3 => 'Março', 
			4 => 'Abril', 
			5 => 'Maio', 
			6 => 'Junho', 
			7 => 'Julho', 
			8 => 'Agosto', 
			9 => 'Setembro', 
			10 => 'Outubro', 
			11 => 'Novembro', 
			12 => 'Dezembro'
		);
		return $array;
	}
	//meses do ano abreviados
	public function getAllMesesAbr() {
		$array = array(
			1 => 'Jan', 
			2 => 'Fev', 
			3 => 'Mar', 
			4 => 'Abr', 
			5 => 'Mai', 
			6 => 'Jun', 
			7 => 'Jul', 
			8 => 'Ago', 
			9 => 'Set', 
			10 => 'Out', 
			11 => 'Nov', 
			12 => 'Dez'
		);
		return $array;
	}

	//verificar se existe algum campo vazio num array
	public function emptyFalse($array){
		foreach ($array as $key => $value) {
			if (!empty($array[$key])) {
				$return = true;
			} else {
				$return = false;
			}
		}
		
		return $return;
	}
}