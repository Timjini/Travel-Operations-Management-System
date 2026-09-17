<x-app-layout>

    <!-- Breadcrumbs -->
    <nav class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-3" aria-label="Breadcrumb">
        <ol class="flex items-center space-x-2 text-sm text-gray-500">
            <li>
                <a href="{{ route('dashboard') }}" class="hover:text-blue-600">Dashboard</a>
            </li>
            <li>
                <svg class="w-4 h-4 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 3a1 1 0 01.707.293l6 6a1 1 0 010 1.414l-6 6A1 1 0 0110 17V3z" clip-rule="evenodd"></path>
                </svg>
            </li>
            <li class="text-gray-800 font-medium">Customers</li>
        </ol>
    </nav>

    <!-- Main Container -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">

        <!-- Header and Controls -->
        <div class="mb-8">

            <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 mb-6">
                <div>
                    <h1 class="text-2xl font-bold text-gray-900">Customers Management</h1>
                    <p class="text-sm text-gray-500 mt-1">Manage, find customers</p>
                </div>
                <div class="flex flex-col sm:flex-row gap-3 w-full md:w-auto">
                    <x-link-button :href="route('customers.create')" class="">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                        </svg>
                        New Customer 
                    </x-link-button>

                    <form action="{{ route('customers.bulkUpload') }}" method="POST" enctype="multipart/form-data" class="bg-white p-1 rounded-lg flex flex-row" x-data="{ loading: false }" @submit="loading = true">
                        @csrf
                        <input type="file" name="csvFile" class="p-2">
                        <x-loading-button label=" {{ __('Upload') }}" />
                    </form>



                </div>
            </div>
        </div>

        <!-- Search Bar -->
        <form method="GET" action="{{ route('customers.index') }}" class="mb-6" x-data="{ loading: false }" @submit="loading = true">
            <div class="flex flex-col md:flex-row gap-3">
                <div class="relative flex-1">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </div>
                    <input
                        type="text"
                        name="search"
                        value="{{ request('search') }}"
                        placeholder="Search by reference, customer, or destination..."
                        class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-md leading-5 bg-white placeholder-gray-500 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                </div>
                <div>
                     <x-loading-button label=" {{ __('Search') }}" />
                </div>
            </div>
        </form>


            <!-- Table -->
            <div class="overflow-x-auto bg-white shadow-sm rounded-lg md:flex flex-col hidden">
                <table class="min-w-full divide-y divide-gray-200 text-sm">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="px-6 py-3 text-left font-medium text-gray-600 uppercase">Name</th>
                            <th class="px-6 py-3 text-left font-medium text-gray-600 uppercase">Email</th>
                            <th class="px-6 py-3 text-left font-medium text-gray-600 uppercase">Phone</th>
                            <th class="px-6 py-3 text-left font-medium text-gray-600 uppercase">Address</th>
                            <th class="px-6 py-3 text-left font-medium text-gray-600 uppercase">Created</th>
                            <th class="px-6 py-3 text-left font-medium text-gray-600 uppercase">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @forelse ($customers as $customer)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $customer->name }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $customer->email }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $customer->phone_1 }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $customer->address }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-gray-500">
                                    {{ $customer->created_at->format('Y-m-d') }}
                                </td>
                                <td class="px-6 py-4">
                                    <x-action-buttons 
                                        viewRoute="{{ route('customers.show', $customer) }}"
                                        editRoute="{{ route('customers.edit', $customer) }}"
                                        deleteRoute="{{ route('customers.destroy', $customer) }}"
                                    />
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-6 py-4 text-center text-gray-500">No customers found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            
            <div class="bg-white border border-slate-800 shadow-xl rounded-xl overflow-hidden">
                    <!-- Mobile Card View (Visible on screens smaller than md) -->
                    <div class="block md:hidden divide-y divide-slate-800">
                        @forelse ($customers as $customer)
                            <div class="p-4 space-y-3 bg-slate-900/60 hover:bg-slate-800/40 transition-colors">
                                <!-- Header: Name & Actions -->
                                <div class="flex items-center justify-between border-b border-slate-800/60 pb-2">
                                    <div>
                                        <h4 class="text-sm font-bold ">{{ $customer->name }}</h4>
                                        <p class="text-xs text-slate-400">{{ $customer->created_at->format('Y-m-d') }}</p>
                                    </div>
                                    <div class="shrink-0">
                                        <x-action-buttons 
                                            viewRoute="{{ route('customers.show', $customer) }}"
                                            editRoute="{{ route('customers.edit', $customer) }}"
                                            deleteRoute="{{ route('customers.destroy', $customer) }}"
                                        />
                                    </div>
                                </div>
                
                                <!-- Body Details Grid -->
                                <div class="grid grid-cols-1 gap-2 text-xs">
                                    <div class="flex items-center justify-between">
                                        <span class="font-medium text-slate-500 uppercase tracking-wider text-[10px]">Email</span>
                                        <a href="mailto:{{ $customer->email }}" class="text-blue-400 hover:underline truncate max-w-[200px]">{{ $customer->email }}</a>
                                    </div>
                                    <div class="flex items-center justify-between">
                                        <span class="font-medium text-slate-500 uppercase tracking-wider text-[10px]">Phone</span>
                                        <a href="tel:{{ $customer->phone_1 }}" class="text-slate-300 hover:text-white">{{ $customer->phone_1 ?? 'N/A' }}</a>
                                    </div>
                                    <div class="flex items-start justify-between">
                                        <span class="font-medium text-slate-500 uppercase tracking-wider text-[10px]">Address</span>
                                        <span class="text-slate-300 text-right truncate max-w-[200px]">{{ $customer->address ?? 'N/A' }}</span>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="p-6 text-center text-slate-500 text-sm">No customers found.</div>
                        @endforelse
                    </div>
                
                    <!-- Desktop Table View (Visible on md screens and up) -->
                    <div class="hidden md:block overflow-x-auto">
                        <table class="min-w-full divide-y divide-slate-800 text-sm text-left">
                            <thead class="bg-slate-950/60">
                                <tr>
                                    <th scope="col" class="px-6 py-3.5 font-semibold text-slate-400 uppercase tracking-wider text-xs">Name</th>
                                    <th scope="col" class="px-6 py-3.5 font-semibold text-slate-400 uppercase tracking-wider text-xs">Email</th>
                                    <th scope="col" class="px-6 py-3.5 font-semibold text-slate-400 uppercase tracking-wider text-xs">Phone</th>
                                    <th scope="col" class="px-6 py-3.5 font-semibold text-slate-400 uppercase tracking-wider text-xs">Address</th>
                                    <th scope="col" class="px-6 py-3.5 font-semibold text-slate-400 uppercase tracking-wider text-xs">Created</th>
                                    <th scope="col" class="px-6 py-3.5 font-semibold text-slate-400 uppercase tracking-wider text-xs text-right">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-800/60 bg-slate-900/40">
                                @forelse ($customers as $customer)
                                    <tr class="hover:bg-slate-800/40 transition-colors">
                                        <td class="px-6 py-4 whitespace-nowrap font-medium text-white">{{ $customer->name }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-slate-300">{{ $customer->email }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-slate-300">{{ $customer->phone_1 }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-slate-300 max-w-xs truncate">{{ $customer->address }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-slate-400 text-xs">
                                            {{ $customer->created_at->format('Y-m-d') }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-right">
                                            <x-action-buttons 
                                                viewRoute="{{ route('customers.show', $customer) }}"
                                                editRoute="{{ route('customers.edit', $customer) }}"
                                                deleteRoute="{{ route('customers.destroy', $customer) }}"
                                            />
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="px-6 py-8 text-center text-slate-500">No customers found.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

            <!-- Pagination -->
            <div class="mt-6">
                {{ $customers->links() }}
            </div>

        </div>
    </div>

</x-app-layout>
