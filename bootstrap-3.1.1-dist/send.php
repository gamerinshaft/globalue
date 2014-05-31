<?php

if (filter_input(INPUT_SERVER, 'REQUEST_METHOD') === 'POST') {

	$shimei = filter_input(INPUT_POST, 'shimei');
	$shozoku = filter_input(INPUT_POST, 'shozoku');
	$gakunen = filter_input(INPUT_POST, 'gakunen');
	$tel = filter_input(INPUT_POST, 'tel');
	$email = filter_input(INPUT_POST, 'email');
	$sns = filter_input(INPUT_POST, 'sns');
	$suisen = filter_input(INPUT_POST, 'suisen');
	$suisenbun = filter_input(INPUT_POST, 'suisenbun');
	$jisseki = filter_input(INPUT_POST, 'jisseki');
	
}