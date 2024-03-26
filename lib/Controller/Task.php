<?php

namespace Up\Tasks\Controller;
use Bitrix\Main\Engine;
use Up\Tasks\Model\TasksTable;

class Task extends Engine\Controller
{
	public function changeTaskReadinessAction(int $id, bool $completed): void
	{
		TasksTable::update($id, [
			'COMPLETED' => $completed,
		]);
	}
}