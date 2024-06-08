<?php

$client = new \GuzzleHttp\Client();

$response = $client->request('GET', 'https://streaming-availability.p.rapidapi.com/shows/%7Bid%7D?series_granularity=episode&output_language=en', [
	'headers' => [
		'x-rapidapi-host' => 'streaming-availability.p.rapidapi.com',
		'x-rapidapi-key' => '742d3d8282msh31c6c1dfb8c579cp13e9d2jsn0b7f94f806e3',
	],
]);

echo $response->getBody();