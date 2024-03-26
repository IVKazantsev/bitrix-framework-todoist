<?php

use Up\Tasks\Task\TaskManager;

class TaskCreateComponent extends CBitrixComponent
{
	public function executeComponent(): void
	{
		$this->addTask();
	}

	protected function addTask(): void
	{
		$title = $this->arParams['TITLE'];
		TaskManager::addTask($title);
		LocalRedirect('/tasks/');
	}
}