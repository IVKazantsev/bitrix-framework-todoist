<?php

use Bitrix\Main\Localization\Loc;
use Bitrix\Main\ModuleManager;

Loc::loadMessages(__FILE__);

class up_tasks extends CModule
{
	public $MODULE_ID = 'up.tasks';
	public $MODULE_VERSION;
	public $MODULE_VERSION_DATE;
	public $MODULE_NAME;
	public $MODULE_DESCRIPTION;

	public function __construct()
	{
		$arModuleVersion = [];
		include (__DIR__ . '/version.php');

		if(is_array($arModuleVersion) && $arModuleVersion['VERSION'] && $arModuleVersion['VERSION_DATE'])
		{
			$this->MODULE_VERSION = $arModuleVersion['VERSION'];
			$this->MODULE_VERSION_DATE = $arModuleVersion['VERSION_DATE'];
		}

		$this->MODULE_NAME = Loc::getMessage('UP_TASKS_MODULE_NAME');
		$this->MODULE_DESCRIPTION = Loc::getMessage('UP_TASKS_MODULE_DESCRIPTION');
	}

	public function InstallDB(): void
	{
		global $DB;

		$DB->RunSQLBatch($_SERVER['DOCUMENT_ROOT'] . '/local/modules/up.tasks/install/db/install.sql');

		ModuleManager::registerModule($this->MODULE_ID);
	}

	public function UnInstallDB($arParams = []): void
	{
		global $DB;

		$DB->RunSQLBatch($_SERVER['DOCUMENT_ROOT'] . '/local/modules/up.tasks/install/db/uninstall.sql');

		ModuleManager::registerModule($this->MODULE_ID);
	}

	public function InstallFiles(): void
	{
		CopyDirFiles(
			$_SERVER['DOCUMENT_ROOT'] . '/local/modules/up.tasks/install/components',
			$_SERVER['DOCUMENT_ROOT'] . '/local/components/',
			true,
			true
		);

		CopyDirFiles(
			$_SERVER['DOCUMENT_ROOT'] . '/local/modules/up.tasks/install/templates',
			$_SERVER['DOCUMENT_ROOT'] . '/local/templates/',
			true,
			true
		);

		CopyDirFiles(
			$_SERVER['DOCUMENT_ROOT'] . '/local/modules/up.tasks/install/routes',
			$_SERVER['DOCUMENT_ROOT'] . '/local/routes/',
			true,
			true
		);
	}

	public function UnInstallFiles(): void
	{
	}

	public function InstallEvents(): void
	{
	}

	public function UnInstallEvents(): void
	{
	}

	public function DoInstall(): void
	{
		global $USER, $APPLICATION;

		if (!$USER->isAdmin())
		{
			return;
		}

		$this->InstallDB();
		$this->InstallFiles();
		$this->InstallEvents();

		$APPLICATION->IncludeAdminFile(
			Loc::getMessage('UP_TASKS_INSTALL_TITLE'),
			$_SERVER['DOCUMENT_ROOT'] . '/local/modules/' . $this->MODULE_ID . '/install/step.php'
		);
	}

	public function DoUninstall(): void
	{
		global $USER, $APPLICATION, $step;

		if (!$USER->isAdmin())
		{
			return;
		}

		$step = (int)$step;
		if($step < 2)
		{
			$APPLICATION->IncludeAdminFile(
				Loc::getMessage('UP_TASKS_UNINSTALL_TITLE'),
				$_SERVER['DOCUMENT_ROOT'] . '/local/modules/' . $this->MODULE_ID . '/install/unstep1.php'
			);
		}
		elseif($step === 2)
		{
			$this->UnInstallDB();
			$this->UninstallFiles();
			$this->UninstallEvents();

			$APPLICATION->IncludeAdminFile(
				Loc::getMessage('UP_TASKS_UNINSTALL_TITLE'),
				$_SERVER['DOCUMENT_ROOT'] . '/local/modules/' . $this->MODULE_ID . '/install/unstep2.php'
			);
		}
	}
}