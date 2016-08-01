<?php

use Silex\Application;
use Symfony\Component\HttpFoundation\Response;

$user = $app['controllers_factory'];

$user->get('/{id}', function($id, Application $app){
	if(is_null($id))
		return new Response('profile!', 200);
	return new Response($app->escape($id), 200);
})-> value('id', null);

return $user;