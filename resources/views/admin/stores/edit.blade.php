@extends('layouts.admin')
@section('title','Edit Store')
@section('content')
    <div class="bg-white border rounded p-6">
        <form method="post" action="{{ route('admin.stores.update', $store) }}">
            @method('PUT')
            @include('admin.stores._form', ['store'=>$store])
        </form>
    </div>

    <script src="https://maps.googleapis.com/maps/api/js?key={{ config('services.google_maps.api_key') }}&libraries=places&callback=initAutocomplete" async defer></script>
    <script>
        let map, marker, autocomplete;
        const codexSearchUrl = "{{ route('admin.codex.search') }}";
        let searchTimeout;

        function initAutocomplete() {
            const input = document.getElementById('places-search-input');
            const mapDiv = document.getElementById('map');

            // Initialize autocomplete with custom search that prioritizes local codex
            autocomplete = new google.maps.places.Autocomplete(input, {
                fields: ['place_id', 'name', 'formatted_address', 'address_components', 'geometry', 'utc_offset_minutes']
            });

            // Listen for local codex search first
            input.addEventListener('input', function(e) {
                clearTimeout(searchTimeout);
                const query = e.target.value;

                if (query.length < 2) return;

                searchTimeout = setTimeout(() => {
                    fetch(`${codexSearchUrl}?q=${encodeURIComponent(query)}`)
                        .then(response => response.json())
                        .then(results => {
                            if (results.length > 0) {
                                console.log('Found in local codex:', results);
                                // You can show a dropdown of local results here if desired
                            }
                        });
                }, 300);
            });

            autocomplete.addListener('place_changed', function() {
                const place = autocomplete.getPlace();

                if (!place.geometry) {
                    alert('No details available for this place.');
                    return;
                }

                // Show and initialize map
                mapDiv.classList.remove('hidden');
                if (!map) {
                    map = new google.maps.Map(mapDiv, {
                        center: place.geometry.location,
                        zoom: 15
                    });
                    marker = new google.maps.Marker({
                        map: map
                    });
                }

                // Update map
                map.setCenter(place.geometry.location);
                marker.setPosition(place.geometry.location);

                // Extract address components
                const components = {};
                place.address_components.forEach(component => {
                    const types = component.types;
                    if (types.includes('street_number')) {
                        components.street_number = component.long_name;
                    }
                    if (types.includes('route')) {
                        components.route = component.long_name;
                    }
                    if (types.includes('locality')) {
                        components.city = component.long_name;
                    }
                    if (types.includes('administrative_area_level_1')) {
                        components.state = component.long_name;
                    }
                    if (types.includes('country')) {
                        components.country = component.long_name;
                    }
                    if (types.includes('postal_code')) {
                        components.postal_code = component.long_name;
                    }
                });

                // Calculate timezone from UTC offset
                const offsetMinutes = place.utc_offset_minutes || 0;
                const offsetHours = offsetMinutes / 60;
                const timezone = getTimezoneFromOffset(offsetHours, components.country);

                // Autofill form fields
                document.getElementById('place_id').value = place.place_id;
                document.getElementById('store_name').value = place.name || '';

                let address = '';
                if (components.street_number) address += components.street_number + ' ';
                if (components.route) address += components.route;

                document.getElementById('address_line1').value = address || place.formatted_address || '';
                document.getElementById('city').value = components.city || '';
                document.getElementById('state').value = components.state || '';
                document.getElementById('country').value = components.country || '';
                document.getElementById('postal_code').value = components.postal_code || '';
                document.getElementById('lat').value = place.geometry.location.lat();
                document.getElementById('lng').value = place.geometry.location.lng();
                document.getElementById('timezone').value = timezone;
            });
        }

        function getTimezoneFromOffset(offsetHours, country) {
            // Default timezone mapping - adjust based on your needs
            const timezoneMap = {
                'Malaysia': 'Asia/Kuala_Lumpur',
                'Singapore': 'Asia/Singapore',
                'Indonesia': 'Asia/Jakarta',
                'Thailand': 'Asia/Bangkok',
                'Philippines': 'Asia/Manila',
                'Vietnam': 'Asia/Ho_Chi_Minh',
                'United States': 'America/New_York',
                'United Kingdom': 'Europe/London',
                'Australia': 'Australia/Sydney'
            };

            return timezoneMap[country] || `UTC${offsetHours >= 0 ? '+' : ''}${offsetHours}`;
        }
    </script>
@endsection
