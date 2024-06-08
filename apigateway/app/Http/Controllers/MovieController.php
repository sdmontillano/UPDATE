<?php

$client = new \GuzzleHttp\Client();

$response = $client->request('GET', 'https://moviesdatabase.p.rapidapi.com/titles', [
	'headers' => [
		'x-rapidapi-host' => 'moviesdatabase.p.rapidapi.com',
		'x-rapidapi-key' => '742d3d8282msh31c6c1dfb8c579cp13e9d2jsn0b7f94f806e3',
	],
]);

echo $response->getBody();