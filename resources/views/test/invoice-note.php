<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>
	<script>
		function saveAsPDF() {
			const element = document.body; // Ensure the entire body content is captured

			const options = {
				margin: [-10, 0, 0, 0], // No margins to avoid cutting off content
				filename: `invoice-{{ $order->ref }}.pdf`,
				image: { type: 'jpeg', quality: 1 }, // High-quality images
				html2canvas: { 
					scale: 1, // Scale for better resolution while fitting content
					useCORS: true, // Enable cross-origin resource sharing for external assets
				},
				jsPDF: {
					unit: 'mm',
					format: 'a4', // Ensure output is A4-sized
					orientation: 'portrait', // Portrait mode
				}
			};

			html2pdf()
				.set(options)
				.from(element)
				.toPdf()
				.get('pdf')
				.then(function (pdf) {
					const totalHeight = element.scrollHeight;
					const pageHeight = pdf.internal.pageSize.height;
					
					if (totalHeight <= pageHeight) {
						// Content fits within one page
						pdf.save();
					} else {
						// Scale down the content to fit on a single page
						const scaleFactor = pageHeight / totalHeight;
						options.html2canvas.scale = scaleFactor * 5; // Adjust canvas scaling
						html2pdf().set(options).from(element).save();
					}
				});
		}

		function printInvoice() {
			window.print();
		}
	</script>