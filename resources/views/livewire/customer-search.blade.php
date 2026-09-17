<div class="relative">

    <!-- Search Input -->
   <div class="relative" x-data="{ 
    search: '', 
    customers: [], 
    selectedId: '', 
    showDropdown: false,
    async fetchCustomers() {
        if (this.search.length < 2) { 
            this.customers = [];
            this.showDropdown = false;
            return; 
        }
        const response = await fetch(`/crm/api/customers?search=${encodeURIComponent(this.search)}`);
        this.customers = await response.json();
        this.showDropdown = true;
    },
    selectCustomer(customer) {
        this.search = customer.name;
        this.selectedId = customer.id;
        this.showDropdown = false;
    }
}">
    <label for="customer_search" class="block text-sm font-medium text-gray-700">Customer</label>
    
    <div class="relative mt-1">
        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
            <svg class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
            </svg>
        </div>
        
        <input 
            type="text" 
            x-model="search"
            @input.debounce.500ms="fetchCustomers()"
            @keydown.escape="showDropdown = false"
            @click.away="showDropdown = false"
            placeholder="Search by name, email, phone..." 
            class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-xl bg-gray-50 focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
        >
        
        <!-- Hidden input ensures the ID is sent with the form -->
        <input type="hidden" name="customer_id" x-model="selectedId">
    </div>

    <!-- Results Dropdown -->
    <div x-show="showDropdown && search.length >= 2" 
         class="absolute z-10 mt-1 w-full bg-white shadow-lg rounded-md py-1 ring-1 ring-black ring-opacity-5 max-h-60 overflow-auto"
         style="display: none;">
        
        <template x-if="customers.length > 0">
            <ul>
                <template x-for="customer in customers" :key="customer.id">
                    <li @click="selectCustomer(customer)"
                        class="text-gray-900 cursor-pointer select-none relative py-2 pl-3 pr-9 hover:bg-blue-50">
                        <div class="flex flex-col">
                            <span class="font-medium" x-text="customer.name"></span>
                            <div class="flex flex-wrap gap-x-2 text-xs text-gray-500">
                                <span x-text="customer.email"></span>
                                <span x-text="customer.phone_1"></span>
                            </div>
                        </div>
                        <!-- Checkmark if selected -->
                        <span x-show="selectedId == customer.id" class="absolute inset-y-0 right-0 flex items-center pr-4 text-blue-600">
                            <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" /></svg>
                        </span>
                    </li>
                </template>
            </ul>
        </template>

        <template x-if="customers.length === 0">
            <div class="text-gray-500 py-2 pl-3">No customers found</div>
        </template>
    </div>
</div>
</div>