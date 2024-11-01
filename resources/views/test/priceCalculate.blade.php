<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
</head>
<body>
	<form action="{{ route('calculate.shipping') }}" method="post">
		@csrf
		<div class="row">
			<input type="text" name="recipient_name" id="">
			<input type="text" name="recipient_phone" id="">
			<input type="text" name="recipient_address" id="">
					<div class="col mb-3">
						<label for="recipient_city" class="form-label">City</label>
						<select class="form-control" id="recipient_city" name="recipient_city" required onchange="fetchZones()">
							<option value="">Select City</option>
							<!-- Add your city options here -->
						</select>
					</div>
					<div class="col mb-3">
						<label for="recipient_zone" class="form-label">Zone</label>
						<select class="form-select" id="recipient_zone" name="recipient_zone" required onchange="fetchAreas()">
							<option value="">Select Zone</option>
							<!-- Add your zone options here -->
						</select>
					</div>
					<div class="col mb-3">
						<label for="recipient_area" class="form-label">Area</label>
						<select class="form-select" id="recipient_area" name="recipient_area" required>
							<option value="">Select Area</option>
							<!-- Add your area options here -->
						</select>
					</div>
				</div>
				<button type="submit">Submit</button>
	</form>
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

	<script>
	async function fetchCities() {
	const citySelect = document.getElementById("recipient_city");

		try {
			const response = await fetch('/cities');
			const result = await response.json();

			// Check if 'data' is an array before looping through it
			if (Array.isArray(result.data)) {
				result.data.forEach(city => {
					citySelect.innerHTML += `<option value="${city.city_id}">${city.city_name}</option>`;
				});
			} else {
				console.error('Data format is unexpected:', result);
			}
		} catch (error) {
			console.error('Error fetching cities:', error);
		}
	}

	// Call fetchCities when the page loads
	window.onload = fetchCities;

	// Fetch zones based on selected city
	async function fetchZones() {
		const cityId = document.getElementById("recipient_city").value;
		const zoneSelect = document.getElementById("recipient_zone");
		const areaSelect = document.getElementById("recipient_area");

		// Reset zone and area dropdowns
		zoneSelect.innerHTML = '<option value="">Select Zone</option>';
		areaSelect.innerHTML = '<option value="">Select Area</option>';

		if (!cityId) return;

		try {
			const response = await fetch(`/zones/${cityId}`);
			const data = await response.json();

			if (data && data.data) {
				data.data.forEach(zone => {
					zoneSelect.innerHTML += `<option value="${zone.zone_id}">${zone.zone_name}</option>`;
				});
			}
		} catch (error) {
			console.error('Error fetching zones:', error);
		}
	}

	// Fetch areas based on selected zone
	async function fetchAreas() {
		const zoneId = document.getElementById("recipient_zone").value;
		const areaSelect = document.getElementById("recipient_area");

		// Reset area dropdown
		areaSelect.innerHTML = '<option value="">Select Area</option>';

		if (!zoneId) return;

		try {
			const response = await fetch(`/areas/${zoneId}`);
			const data = await response.json();

			if (data && data.data) {
				data.data.forEach(area => {
					areaSelect.innerHTML += `<option value="${area.area_id}">${area.area_name}</option>`;
				});
			}
		} catch (error) {
			console.error('Error fetching areas:', error);
		}
	}


</script>
</body>
</html>