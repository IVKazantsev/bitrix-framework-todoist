<?php
/**
 * @var CMain $APPLICATION
 */

use Bitrix\Main\Context;

require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetTitle("Tasks");

$APPLICATION->IncludeComponent('up:task.list', '', [
	'DATE' => strtotime(Context::getCurrent()->getRequest()->get('date')),
]);

require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php");