const fs = require('fs');
const path = require('path');
const { minify } = require('terser');

const dir = 'src/assets/js';

fs.readdir(dir, (err, files) => {
	if (err) throw err;

	files.forEach((file) => {
		const filePath = path.join(dir, file);

		// Check if the path is a file and not a directory
		if (fs.statSync(filePath).isFile() && !file.endsWith('.min.js')) {
			const minifiedFilePath = path.join(dir, file.replace('.js', '.min.js'));

			fs.readFile(filePath, 'utf8', async (err, data) => {
				if (err) throw err;
				try {
					const result = await minify(data);
					fs.writeFile(minifiedFilePath, result.code, (err) => {
						if (err) throw err;
						console.log(`Minified: ${minifiedFilePath}`);
					});
				} catch (error) {
					console.error(`Error minifying ${file}: ${error}`);
				}
			});
		}
	});
});
