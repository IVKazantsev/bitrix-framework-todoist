<?php

use Bitrix\Main\ModuleManager;
use Bitrix\Main\Config\Option;

function __tasksMigrate(int $nextVersion, callable $callback): void
{
	global $DB;
	$moduleId = 'up.tasks';

	if (!ModuleManager::isModuleInstalled($moduleId))
	{
		return;
	}

	$currentVersion = (int)Option::get($moduleId, '~database_schema_version', 0);
	var_dump($currentVersion);
	if ($currentVersion < $nextVersion)
	{
		include_once($_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/main/classes/general/update_class.php');
		$updater = new CUpdater();
		$updater->Init('', 'mysql', '', '', $moduleId, 'DB');

		$callback($updater, $DB, 'mysql');
		Option::set($moduleId, '~database_schema_version', $nextVersion);
	}
}

__tasksMigrate(2, static function($updater, $DB)
{
	if($updater->CanUpdateDatabase())
	{
		$DB->query('CREATE TABLE IF NOT EXISTS up_tasks_task (
				ID           INT AUTO_INCREMENT,
				TITLE        VARCHAR(512) NOT NULL,
				COMPLETED    BOOLEAN      NOT NULL DEFAULT FALSE,
				CREATED_AT   DATETIME     NOT NULL DEFAULT CURRENT_TIMESTAMP,
				UPDATED_AT   DATETIME     NULL     DEFAULT NULL,
				COMPLETED_AT DATETIME     NULL     DEFAULT NULL,
				PRIMARY KEY (ID)
			);');
	}
});