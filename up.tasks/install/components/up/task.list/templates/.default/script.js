document.addEventListener("DOMContentLoaded", function() {
	const checkboxes = document.querySelectorAll('.checkbox');
	checkboxes.forEach(function(checkbox) {
		checkbox.addEventListener('change', function() {
			BX.ajax.runAction(
					'up:tasks.task.changeTaskReadiness',
					{
						data:
							{
								id: checkbox.id,
								completed: checkbox.checked,
							},
					})
				.then((response) => {
					console.log(response);
				})
				.catch((error) => {
					console.error(error);
				});
		});
	});
});