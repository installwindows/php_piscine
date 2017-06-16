<?php
class Lannister {
	function sleepWith($who) {
		if (get_parent_class($who) !== 'Lannister')
			print("Let's do this." . PHP_EOL);
		else
			print("Not even if I'm drunk !" . PHP_EOL);
	}
}
?>
