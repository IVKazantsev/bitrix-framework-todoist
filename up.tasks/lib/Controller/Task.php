<?php

namespace Up\Tasks\Controller;
use Bitrix\Main\Engine;
use Up\Tasks\Model\TasksTable;

class Task extends Engine\Controller
{
	public function changeTaskReadinessAction(int $id, string $completed): void
	{
		$completed = filter_var($completed, FILTER_VALIDATE_BOOLEAN);
		TasksTable::update($id, [
			'COMPLETED' => $completed,
		]);
	}
}