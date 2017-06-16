<?php
class NightsWatch implements IFighter {
	private $recruits = [];

	function recruit($r) {
		$this->recruits[] = $r;
	}
	function fight() {
		foreach ($this->recruits as $r) {
			if ($r instanceof IFighter)
				$r->fight();
		}
	}
}
