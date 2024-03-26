<?php
namespace Up\Tasks\Model;

use Bitrix\Main\Localization\Loc,
	Bitrix\Main\ORM\Data\DataManager,
	Bitrix\Main\ORM\Fields\DatetimeField,
	Bitrix\Main\ORM\Fields\IntegerField,
	Bitrix\Main\ORM\Fields\StringField,
	Bitrix\Main\ORM\Fields\Validators\LengthValidator,
	Bitrix\Main\Type\DateTime;

Loc::loadMessages(__FILE__);

/**
 * Class TaskTable
 *
 * Fields:
 * <ul>
 * <li> ID int mandatory
 * <li> TITLE string(512) mandatory
 * <li> COMPLETED int optional default 0
 * <li> CREATED_AT datetime optional default current datetime
 * <li> UPDATED_AT datetime optional
 * <li> COMPLETED_AT datetime optional
 * </ul>
 *
 * @package Bitrix\Tasks
 **/

class TasksTable extends DataManager
{
	/**
	 * Returns DB table name for entity.
	 *
	 * @return string
	 */
	public static function getTableName(): string
	{
		return 'up_tasks_task';
	}

	/**
	 * Returns entity map definition.
	 *
	 * @return array
	 */
	public static function getMap(): array
	{
		return [
			new IntegerField(
				'ID',
				[
					'primary' => true,
					'autocomplete' => true,
					'title' => Loc::getMessage('TASK_ENTITY_ID_FIELD')
				]
			),
			new StringField(
				'TITLE',
				[
					'required' => true,
					'validation' => [__CLASS__, 'validateTitle'],
					'title' => Loc::getMessage('TASK_ENTITY_TITLE_FIELD')
				]
			),
			new IntegerField(
				'COMPLETED',
				[
					'default' => 0,
					'title' => Loc::getMessage('TASK_ENTITY_COMPLETED_FIELD')
				]
			),
			new DatetimeField(
				'CREATED_AT',
				[
					'default' => function()
					{
						return new DateTime();
					},
					'title' => Loc::getMessage('TASK_ENTITY_CREATED_AT_FIELD')
				]
			),
			new DatetimeField(
				'UPDATED_AT',
				[
					'title' => Loc::getMessage('TASK_ENTITY_UPDATED_AT_FIELD')
				]
			),
			new DatetimeField(
				'COMPLETED_AT',
				[
					'title' => Loc::getMessage('TASK_ENTITY_COMPLETED_AT_FIELD')
				]
			),
		];
	}

	/**
	 * Returns validators for TITLE field.
	 *
	 * @return array
	 */
	public static function validateTitle(): array
	{
		return [
			new LengthValidator(null, 512),
		];
	}
}