<?php
	error_reporting(0);
	$q = $_GET['q'];

/*
	$data = array(
		0 => array(
			'year' => '1936',
			'value' => 'The Great Ziegfeld',
			'tokens' => array(
				'The', 'Great', 'Ziegfeld',
			),
		),
		1 => array(
			'year' => '1937',
			'value' => 'The Life of Emile Zola',
			'tokens' => array(
				'The', 'Life', 'of', 'Emile', 'Zola', 
			),
		),
	);
*/

	$mysqli = new mysqli("localhost", "root", "1234", "examsys");
	if ($mysqli->connect_errno) {
		echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
	}
	$mysqli->query("SET NAMES UTF8");
	//echo $mysqli->host_info . "\n";
	$result = $mysqli->query("SELECT * FROM Teachers WHERE CONCAT(name,lname) like '%$q%' LIMIT 10 ");

	$result->data_seek(0);
	for ($i = 0 ; $row = $result->fetch_assoc() ; $i++) {
		$data[$i] = array(
			'tid' => $row['tea_id'],
			'value' => $row['name'] . ' ' . $row['lname'],
			'tokens' => array($row['name'],$row['lname']),
		);
	}

	echo json_encode($data);