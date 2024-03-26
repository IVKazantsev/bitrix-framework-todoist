<?php

use Up\Tasks\Task\TaskManager;

class TaskDeleteComponent extends CBitrixComponent
{
	public function executeComponent(): void
	{
		$this->deleteTask();
		$this->includeComponentTemplate();
	}

	protected function deleteTask(): void
	{
		$id = (int)$this->arParams['ID'];
		$isDeleted = TaskManager::deleteTask($id);
		$this->arResult['IS_DELETED'] = $isDeleted;
	}
}