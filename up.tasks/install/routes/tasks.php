<?php

use Bitrix\Main\Routing\Controllers\PublicPageController;
use Bitrix\Main\Routing\RoutingConfigurator;

return static function(RoutingConfigurator $routes) {
	$routes->get('/', new PublicPageController('/local/modules/up.tasks/views/task-list.php'));
	$routes->get('/tasks/', new PublicPageController('/local/modules/up.tasks/views/task-list.php'));
	$routes->post('/tasks/', new PublicPageController('/local/modules/up.tasks/views/task-create.php'));
	$routes->get('/tasks/{id}/delete/', new PublicPageController('/local/modules/up.tasks/views/task-delete.php'));
};