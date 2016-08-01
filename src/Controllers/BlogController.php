<?php

use Silex\Application;
use Symfony\Component\HttpFoundation\Response;

$blog = $app['controllers_factory'];

/**
 * Rota Blog
 */
$blog->get('/{slug}', function($slug, Application $app){
	if(is_null($slug))
		return new Response('Blog', 200);
	return new Response($app->escape($slug), 200);
})->value('slug', null);

return $blog;