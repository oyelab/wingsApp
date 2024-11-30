<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload and Select Thumbnail</title>
	<script src="https://unpkg.com/dropzone@5/dist/min/dropzone.min.js"></script>
	<link
	rel="stylesheet"
	href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css"
	type="text/css"
	/>
</head>
<body>


	<div class="my-dropzone"></div>

	<script>
	// Dropzone has been added as a global variable.
	const dropzone = new Dropzone("div.my-dropzone", { url: "/file/post" });
	</script>
</body>
</html>
