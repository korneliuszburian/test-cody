<?php /* TODO: Sprawdzić */ ?>

<script>
	const mediaTypes = ['braille', 'embossed', 'handheld', 'print', 'projection', 'screen', 'speech', 'tty', 'tv'];
	let mediaType = '';
	mediaTypes.forEach(el => {
		if (window.matchMedia(el).matches)
			mediaType += `${el}, `;
	});
</script>
<a href="/wp-admin/admin.php?page=global-fields" target="_blank" class="js-bar jcc ais c-main pos-fix d-flex f-c" style="font-size:20px;padding:15px 20px;background:currentColor;bottom:10%;left:0;z-index:9999;border:2px solid #fff;gap:5px;">
	<p class="c-white">DPR: <script>
			document.write(window.devicePixelRatio);
		</script>
	</p>
	<p class="c-white">IW: <script>
			document.write(`${window.innerWidth}px`);
		</script>
	</p>
	<p class="c-white">AW / SW: <script>
			document.write(`${window.screen.availWidth}px / ${screen.width}px`);
		</script>
	</p>
	<p class="c-white">MediaType: <script>
			document.write(mediaType);
		</script>
	</p>
</a>