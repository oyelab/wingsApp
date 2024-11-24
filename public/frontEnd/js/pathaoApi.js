const oldCity = "{{ old('recipient_city') }}";
const oldZone = "{{ old('recipient_zone') }}";
const oldArea = "{{ old('recipient_area') }}";

// Fetch and set cities with old selection, if available
async function fetchCities() {
    const citySelect = document.getElementById("recipient_city");

    try {
        const response = await fetch("/cities");
        const result = await response.json();

        if (Array.isArray(result.data)) {
            result.data.forEach((city) => {
                const selected = city.city_id == oldCity ? "selected" : "";
                citySelect.innerHTML += `<option value="${city.city_id}" ${selected}>${city.city_name}</option>`;
            });

            // Fetch zones if an old city is set
            if (oldCity) fetchZones();
        }
    } catch (error) {
        console.error("Error fetching cities:", error);
    }
}

// Fetch and set zones with old selection, if available
async function fetchZones() {
    const cityId = document.getElementById("recipient_city").value;
    const zoneSelect = document.getElementById("recipient_zone");
    const areaSelect = document.getElementById("recipient_area");

    zoneSelect.innerHTML = '<option value="">Select Zone</option>';
    areaSelect.innerHTML = '<option value="">Select Area</option>';

    if (!cityId) return;

    try {
        const response = await fetch(`/zones/${cityId}`);
        const data = await response.json();

        if (data && data.data) {
            data.data.forEach((zone) => {
                const selected = zone.zone_id == oldZone ? "selected" : "";
                zoneSelect.innerHTML += `<option value="${zone.zone_id}" ${selected}>${zone.zone_name}</option>`;
            });

            // Fetch areas if an old zone is set
            if (oldZone) fetchAreas();
        }
    } catch (error) {
        console.error("Error fetching zones:", error);
    }
}

// Fetch and set areas with old selection, if available
async function fetchAreas() {
    const zoneId = document.getElementById("recipient_zone").value;
    const areaSelect = document.getElementById("recipient_area");

    areaSelect.innerHTML = '<option value="">Select Area</option>';

    if (!zoneId) return;

    try {
        const response = await fetch(`/areas/${zoneId}`);
        const data = await response.json();

        if (data && data.data) {
            data.data.forEach((area) => {
                const selected = area.area_id == oldArea ? "selected" : "";
                areaSelect.innerHTML += `<option value="${area.area_id}" ${selected}>${area.area_name}</option>`;
            });
        }
    } catch (error) {
        console.error("Error fetching areas:", error);
    }
}

// Call fetchCities when the page loads
window.onload = fetchCities;


