<?php
function ft_split($str)
{
	$array = [];
	$i = 0;
	$len = strlen($str);

	while ($i < $len)
	{
		while (isset($str[$i]) && $str[$i] == ' ')
			$i++;
		$start = $i;
		if (isset($str[$i]) == false)
			break ;
		while (isset($str[$i]) && $str[$i] != ' ')
			$i++;
		$array[] = substr($str, $start, $i - $start);
	}
	sort($array);
	return ($array);
}
?>
