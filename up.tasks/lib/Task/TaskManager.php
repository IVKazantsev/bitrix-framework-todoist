<?php

namespace Up\Tasks\Task;

use Up\Tasks\Model\TasksTable;
use Bitrix\Main\Type\Date;

class TaskManager
{
	public static function getTaskList(Date $neededDay = new Date()): array
	{
		$from = new Date($neededDay);
		$to = $neededDay->add('1 day -1 second');

		return TasksTable::query()
						 ->setSelect(['ID', 'TITLE', 'COMPLETED'])
						 ->whereBetween('CREATED_AT', $from, $to)
						 ->addOrder('CREATED_AT', 'DESC')
						 ->fetchAll();
	}

	public static function deleteTask(int $id): bool
	{
		$task = TasksTable::getByPrimary($id)->fetchObject();

		return $task && $task->delete();
	}

	public static function addTask(string $title): bool
	{
		return TasksTable::add(['TITLE' => $title])->isSuccess();
	}
}