<?php

require "../config.php";

use App\User;

try {
	User::register('Apolinario', 'Mabini', 'apolinario@mabini.ph', 'FILIPINAS', '1984-07-23', 'Male', 'Talaga, Tanauan, Batangas', '0919840723');
	echo "<li>Added 1 record";

	$users = [
		[
			'first_name' => 'Jose',
			'middle_name' => 'Alonzo',
			'last_name' => 'Rizal',
			'email' => 'jose@rizal.ph',
			'pass' => 'TAGAILOG',
			'birthdate' => '1861-06-19',
			'gender' =>  'Male',
			'address' => 'Calamba, Laguna',
			'contact_number' => '0918610619'
		],
		[
			'first_name' => 'Antonio',
			'middle_name' => 'Novicio',
			'last_name' => 'Luna',
			'email' => 'antonio@luna.ph',
			'pass' => 'ARTIKULOUNO',
			'birthdate' => '1866-10-29',
			'gender' =>  'Male',
			'address' => 'Cabanatuan, Nueva Ecija',
			'contact_number' => '0918661029'
		]
	];

	User::registerMany($users);
	echo "<li>Added " . count($users) . " more records";

} catch (PDOException $e) {
	error_log($e->getMessage());
	echo "<h1 style='color: red'>" . $e->getMessage() . "</h1>";
}