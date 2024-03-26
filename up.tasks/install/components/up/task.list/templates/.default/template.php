<?php

/**
 * @var array $arResult
 * @var array $arParams
 */

use Bitrix\Main\UI\Extension;

Extension::load('main.core');
Extension::load('up.task-list');

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
{
	die();
}
?>

<?php if(!$arParams['IS_HISTORY']): ?>
	<form action="/tasks/" method="post">
		<div class="columns is-centered mb-6">
			<div class="column is-half">
				<div class="field">
					<div class="control">
						<label>
							<input type="text" class="input" name="title" placeholder="Add a task">
						</label>
					</div>
				</div>
			</div>
			<div class="column is-1 has-text-centered">
				<button class="button is-link has-text-weight-bold" type="submit">+</button>
			</div>
		</div>
	</form>
<?php endif; ?>

<?php if(!$arResult['TASKS']): ?>
	<div class="columns is-size-5 is-centered">
		There's nothing to do here😔
	</div>
<?php endif; ?>

<div class="column is-7 is-offset-one-fifth mb-6">
	<div class='list'>
		<ul>
			<?php foreach ($arResult['TASKS'] as $task): ?>
				<div class='list-item task-item is-size-5 box mb-1'>
					<li class="is-flex">
						<label for="<?= $task['ID'] ?>"></label><input type="checkbox" id="<?= $task['ID'] ?>" class="checkbox" <?= $task['COMPLETED'] ? 'checked' : '' ?> <?= $arParams['IS_HISTORY'] ? 'disabled' : '' ?>>
						<div class="ml-2">
							<?= $task['TITLE'] ?>
						</div>
						<a href="/tasks/<?= $task['ID'] ?>/delete/" class="button ml-auto is-danger is-outlined" <?= $arParams['IS_HISTORY'] ? 'disabled' : '' ?>>X</a>
					</li>
				</div>
			<?php endforeach; ?>
		</ul>
	</div>
</div>

<div class="columns is-centered mt-6">
	<nav class="pagination" role="navigation" aria-label="pagination">
		<ul class="pagination-list">
			<li>
				<a href="/?date=<?= date('Y-m-d', strtotime($arParams['NEEDED_DAY'] . '-1 day')) ?>" class="pagination-link"><</a>
			</li>
			<li>
				<div class="pagination-link is-current"><?= $arParams['NEEDED_DAY_TITLE'] ?></div>
			</li>
			<li>
				<a href="/?date=<?= date('Y-m-d', strtotime($arParams['NEEDED_DAY'] . '+1 day')) ?>" class="pagination-link">></a>
			</li>
		</ul>
	</nav>
</div>