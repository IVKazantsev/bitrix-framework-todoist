<?php

use Bitrix\Main\Type\Date;
use Up\Tasks\Task\TaskManager;

class TaskListComponent extends CBitrixComponent
{
	public function executeComponent(): void
	{
		$this->fetchTaskList();
		$this->includeComponentTemplate();
	}

	protected function fetchTaskList(): void
	{
		$time = $this->arParams['DATE'];
		if ($time === false)
		{
			$time = time();
		}
		$neededDay = Date::createFromTimestamp($time);

		$today = new Date();

		if ($today->format('Y-m-d') === $neededDay->format('Y-m-d'))
		{
			$this->arParams['IS_HISTORY'] = false;
			$this->arParams['NEEDED_DAY_TITLE'] = 'Today';
		}
		else
		{
			$this->arParams['IS_HISTORY'] = true;
			$this->arParams['NEEDED_DAY_TITLE'] = date("d.m.Y", $time);
		}

		$this->arParams['NEEDED_DAY'] = $neededDay->format('Y-m-d');

		$tasks = TaskManager::getTaskList($neededDay);
		$this->arResult['TASKS'] = $tasks;
	}
}