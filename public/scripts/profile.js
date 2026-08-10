document.addEventListener('DOMContentLoaded', function (){
	const input = document.getElementById('photoInput');
	const preview = document.getElementById('preview');

	preview.addEventListener('click', () => {
	input.click(); // trigger hidden input
	});

	input.addEventListener('change', (event) => {
	const file = event.target.files[0];
	if (!file) return;

	const reader = new FileReader();
	reader.onload = (e) => {
		const img = new Image();
		img.onload = () => {
		const canvas = document.createElement('canvas');
		canvas.width = 150;
		canvas.height = 150;
		const ctx = canvas.getContext('2d');
		ctx.drawImage(img, 0, 0, 150, 150);

		// Show preview
		preview.innerHTML = `<img src="${canvas.toDataURL('image/jpeg')}" 
								style="width:150px;height:150px;border-radius:50%;" 
								alt="Preview">`;

		// Convert to File and put back into input
		canvas.toBlob((blob) => {
			const resizedFile = new File([blob], 'profile.jpg', { type: 'image/jpeg' });
			const dataTransfer = new DataTransfer();
			dataTransfer.items.add(resizedFile);
			input.files = dataTransfer.files;
		}, 'image/jpeg', 0.8);
		};
		img.src = e.target.result;
	};
	reader.readAsDataURL(file);
	});
});
