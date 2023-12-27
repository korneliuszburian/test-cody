<?php /* TODO: Sprawdzić */ ?>

<div class="cursor cursor--hidden d-flex aic jcc pos-fix">
	<div class="cursor__inner"></div>
</div>
<script>
	const cursor = document.getElementsByClassName('cursor')[0];
	let cursorSize = 32;

	function update(e) {
		let x = e.clientX || e.touches[0].clientX;
		let y = e.clientY || e.touches[0].clientY;

		cursor.style.left = `${x - (cursorSize / 2)}px`;
		cursor.style.top = `${y - (cursorSize / 2)}px`;
	}

	document.addEventListener('mousemove', update);
	document.addEventListener('touchmove', update);

	document.body.addEventListener('mousemove', () => {
		cursor.classList.toggle('cursor--hidden');
	}, {
		once: true
	});
</script>