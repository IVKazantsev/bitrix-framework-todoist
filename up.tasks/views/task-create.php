<?php
/**
 * @var CMain $APPLICATION
 */

use Bitrix\Main\Context;

require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetTitle("Tasks");

$APPLICATION->IncludeComponent('up:task.create', '', [
	'TITLE' => Context::getCurrent()->getRequest()->getPost('title'),
]);

require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php");