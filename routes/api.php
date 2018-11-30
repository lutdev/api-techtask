<?php
$router->get('offers', 'ApiController@index');
$router->get('offers/{offer_id}', 'ApiController@show');
