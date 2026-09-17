<div class="relative">
    <label for="country_search" class="block text-sm font-medium text-gray-700">Country</label>
    
    <!-- Search Input -->
<div x-data="{ 
    search: '', 
    countries: [], 
    selectedCountryId: '', // Track the ID here
    showDropdown: false,
    async fetchCountries() {
        if (this.search.length < 2) { 
            this.countries = [];
            this.selectedCountryId = ''; // Reset ID if search is cleared
            return; 
        }
        const response = await fetch(`/crm/api/countries?search=${this.search}`);
        this.countries = await response.json();
        this.showDropdown = true;
    },
    selectCountry(country) {
        this.search = country.name; // Update visible text
        this.selectedCountryId = country.id; // Store the actual ID
        this.showDropdown = false;
    }
}" class="relative">
    
    <!-- This hidden input sends the ID to your server on form submit -->
    <input type="hidden" name="country_id" x-model="selectedCountryId">

    <input 
        type="text" 
        x-model="search" 
        @input.debounce.500ms="fetchCountries()"
        @click.away="showDropdown = false"
        placeholder="Search countries..."
        class="block w-full border rounded-xl p-2"
    >

    <!-- Results Dropdown -->
    <template x-if="showDropdown && countries.length > 0">
        <ul class="absolute z-10 w-full bg-white shadow-lg border mt-1 max-h-60 overflow-auto">
            <template x-for="country in countries" :key="country.id">
                <li 
                    @click="selectCountry(country)"
                    class="p-2 hover:bg-blue-50 cursor-pointer border-b last:border-0"
                >
                    <div class="flex flex-col">
                        <span class="font-bold" x-text="country.name"></span>
                        <span class="text-xs text-gray-500" x-text="'City: ' + country.city"></span>
                    </div>
                </li>
            </template>
        </ul>
    </template>
</div>
</div>