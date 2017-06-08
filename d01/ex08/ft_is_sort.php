<?php
function ft_is_sort($array)
{
	$n = count($array);
	$i = 0;

	if ($n <= 1)
		return (true);
	while ($i < $n - 1)
	{
		if (strcmp($array[$i], $array[$i + 1]) > 0)
			return (false);
		$i++;
	}
	return (true);
}
