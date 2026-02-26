<div class="relative">
    <div class="relative" x-data="{ 
    search: '', 
    destinations: [], 
    selectedId: '', 
    showDropdown: false,
    async fetchDestinations() {
        if (this.search.length < 2) { 
            this.destinations = [];
            this.showDropdown = false;
            return; 
        }
        const response = await fetch(`/crm/api/destinations?search=${encodeURIComponent(this.search)}`);
        this.destinations = await response.json();
        this.showDropdown = true;
    },
    selectDestination(dest) {
        this.search = dest.name;
        this.selectedId = dest.id;
        this.showDropdown = false;
    }
}">
    <label for="destination_search" class="block text-sm font-medium text-gray-700">Destination</label>

    <div class="relative mt-1">
        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
            <svg class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
            </svg>
        </div>
        <input 
            type="text" 
            x-model="search"
            @input.debounce.500ms="fetchDestinations()"
            @keydown.escape="showDropdown = false"
            @click.away="showDropdown = false"
            placeholder="Search by name or country..." 
            class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-xl leading-5 bg-gray-50 placeholder-gray-500 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
        >
        <!-- This input ensures destination_id is sent with the form -->
        <input type="hidden" name="destination_id" x-model="selectedId">
    </div>

    <!-- Results Dropdown -->
    <div x-show="showDropdown && search.length >= 2" 
         class="absolute z-10 mt-1 w-full bg-white shadow-lg rounded-md py-1 ring-1 ring-black ring-opacity-5 max-h-60 overflow-auto"
         style="display: none;">
        
        <template x-if="destinations.length > 0">
            <ul>
                <template x-for="dest in destinations" :key="dest.id">
                    <li @click="selectDestination(dest)"
                        class="text-gray-900 cursor-pointer select-none relative py-2 pl-3 pr-9 hover:bg-blue-50">
                        <div class="flex flex-col">
                            <span class="font-medium" x-text="dest.name"></span>
                            <span class="text-xs text-gray-500" x-text="dest.country"></span>
                        </div>
                        <span x-show="selectedId == dest.id" class="absolute inset-y-0 right-0 flex items-center pr-4 text-blue-600">
                            <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" /></svg>
                        </span>
                    </li>
                </template>
            </ul>
        </template>

        <template x-if="destinations.length === 0">
            <div class="text-gray-500 py-2 pl-3">No destinations found</div>
        </template>
    </div>
</div>
</div>
