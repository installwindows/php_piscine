<?php
class Jaime extends Lannister {
	function sleepWith($who) {
		if (get_parent_class($who) !== 'Lannister')
			print("Let's do this." . PHP_EOL);
		else if (get_class($who) === 'Cersei')
			print("With pleasure, but only in a tower in Winterfell, then." . PHP_EOL);
		else
			print("Not even if I'm drunk !" . PHP_EOL);
			
	}
}
