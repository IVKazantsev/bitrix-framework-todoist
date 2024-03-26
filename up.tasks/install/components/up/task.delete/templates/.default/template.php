<?php

/**
 * @var array $arResult
 */

use Bitrix\Main\UI\Extension;

Extension::load('up.task-list');

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
{
	die();
}
?>
<div class="columns is-size-4 is-centered mb-6">
	<?php if($arResult['IS_DELETED']): ?>
			Task deleted successfully✔️
	<?php else: ?>
			Failed to delete task❌
	<?php endif; ?>
</div>
<div class="columns is-size-4 is-centered">
	<a href="/tasks/" class="button is-link is-light">Return to tasks</a>
</div>
