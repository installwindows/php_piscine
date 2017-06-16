<?php
abstract class Fighter {
	abstract function fight($f);
	public $type;

	function __construct($t) {
		$this->type = $t;
	}

	function getType() {
		return $this->type;
	}

	function __clone() {
	}
}
?>
