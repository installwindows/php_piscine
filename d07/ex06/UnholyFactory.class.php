<?php
class UnholyFactory {
	private $absorbed = [];
	private $fabricated = [];

	function absorb($fighter) {
		if ($fighter instanceof Fighter)
		{
			if (in_array($fighter, $this->absorbed))
				print("(Factory already absorbed a fighter of type " . $fighter->getType() . ")" . PHP_EOL);
			else
			{
				print("(Factory absorbed a fighter of type " . $fighter->getType() . ")" . PHP_EOL);
				$this->absorbed[] = $fighter;
			}
		}
		else
			print("(Factory can't absorb this, it's not a fighter)" . PHP_EOL);
	}

	function fabricate($f) {
		foreach ($this->absorbed as $a) {
			if ($a->getType() === $f)
			{
				print("(Factory fabricates a fighter of type " . $f . ")". PHP_EOL);
				return clone $a;
			}
		}
		print("(Factory hasn't absorbed any fighter of type ". $f . ")". PHP_EOL);
	}
}
?>
