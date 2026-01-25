<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight capitalize">
            File Details
        </h2>
    </x-slot>

    <nav class="max-w-3xl sm:px-6 lg:px-8" aria-label="Breadcrumb">
        <ol class="flex items-center space-x-2 text-sm text-gray-500">
            <li>
                <a href="{{ route('dashboard') }}" class="hover:text-blue-600">Dashboard</a>
            </li>
            <li>
                <svg class="w-4 h-4 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 3a1 1 0 01.707.293l6 6a1 1 0 010 1.414l-6 6A1 1 0 0110 17V3z" clip-rule="evenodd"></path>
                </svg>
            </li>
            <li>
                <a href="{{ route('files.index') }}" class="hover:text-blue-600">Files</a>
            </li>
            <li>
                <svg class="w-4 h-4 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 3a1 1 0 01.707.293l6 6a1 1 0 010 1.414l-6 6A1 1 0 0110 17V3z" clip-rule="evenodd"></path>
                </svg>
            </li>
            <li class="text-gray-800 font-medium">{{ $file->reference }}</li>
        </ol>
    </nav>

    <div class="max-w-8xl px-4 sm:px-6 lg:px-8 py-6">
        <div class="bg-white shadow rounded-lg overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-200">
                <div class="flex justify-between items-center">
                    <h3 class="text-lg font-medium text-gray-900">File Information</h3>
                    <div class="flex space-x-2">
                        <!-- Dropdown menu -->
                        <div class="relative inline-block text-left" x-data="{ open: false }" @click.away="open = false">
                            <button
                                type="button"
                                class="inline-flex justify-center w-full rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                                id="file-actions-menu"
                                aria-expanded="false"
                                aria-haspopup="true"
                                @click="open = !open">
                                Actions
                                <svg class="-mr-1 ml-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </button>

                            <div
                                x-show="open"
                                x-transition:enter="transition ease-out duration-100"
                                x-transition:enter-start="transform opacity-0 scale-95"
                                x-transition:enter-end="transform opacity-100 scale-100"
                                x-transition:leave="transition ease-in duration-75"
                                x-transition:leave-start="transform opacity-100 scale-100"
                                x-transition:leave-end="transform opacity-0 scale-95"
                                class="origin-top-right absolute right-0 mt-2 w-56 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 focus:outline-none"
                                role="menu" aria-orientation="vertical" aria-labelledby="file-actions-menu"
                                style="display: none;">
                                <div class="py-1" role="none">
                                    <div class="py-1" role="none">
                                    <!-- Manage Items Link -->
                                    <a href="{{ route('files.items.add', $file) }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-gray-900" role="menuitem">
                                        Manage Items
                                    </a>
                                    <!-- Create Invoice Button -->
                                    @if($file->proformas->isNotEmpty())
                                        <form method="POST" action="{{ route('proformas.convert-to-invoice', $file->proformas->first()) }}" role="none">
                                            @csrf
                                            <button 
                                                type="submit" 
                                                class="w-full text-left block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-gray-900"
                                                role="menuitem" 
                                                onclick="return confirm('Are you sure you want to create an invoice from this proforma?')">
                                                Create Invoice
                                            </button>
                                        </form>
                                    @else
                                        <button 
                                            type="button" 
                                            class="w-full text-left block px-4 py-2 text-sm text-gray-400 cursor-not-allowed" 
                                            disabled>
                                            Create Invoice
                                        </button>
                                    @endif


                                    <!-- Proforma Button -->
                                    @if($file->proformas->isEmpty())
                                        <form method="POST" action="{{ route('proformas.store', $file->id) }}" role="none">
                                            @csrf
                                            <button 
                                                type="submit" 
                                                class="w-full text-left block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-gray-900"
                                                role="menuitem" 
                                                onclick="return confirm('Are you sure you want to confirm this file?')">
                                                Proformas
                                            </button>
                                        </form>
                                    @else
                                        <button 
                                            type="button" 
                                            class="w-full text-left block px-4 py-2 text-sm text-gray-400 cursor-not-allowed" 
                                            disabled>
                                            Proformas
                                        </button>
                                    @endif

                                </div>
                                </div>
                            </div>
                        </div>


                        <x-link-button :href="route('files.edit', $file)">
                            Edit
                        </x-link-button>
                        <form method="POST" action="{{ route('files.destroy', $file) }}">
                            @csrf
                            @method('DELETE')
                            <x-danger-button type="submit" onclick="return confirm('Are you sure you want to delete this file?')">
                                Delete
                            </x-danger-button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="px-6 py-4">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <p class="text-sm font-medium text-gray-500">Reference</p>
                        <p class="mt-1 text-sm text-gray-900">{{ $file->reference }}</p>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-500">Customer</p>
                        <p class="mt-1 text-sm text-gray-900">{{ $file->customer->name ?? 'N/A' }}</p>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-500">Number of People</p>
                        <p class="mt-1 text-sm text-gray-900">{{ $file->number_of_people }}</p>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-500">Date Range</p>
                        <p class="mt-1 text-sm text-gray-900">
                            {{ $file->start_date->format('M d, Y') }} - {{ $file->end_date->format('M d, Y') }}
                        </p>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-500">Program</p>
                        <p class="mt-1 text-sm text-gray-900">{{ $file->program->name ?? 'N/A' }}</p>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-500">Destination</p>
                        <p class="mt-1 text-sm text-gray-900">{{ $file->destination->name ?? 'N/A' }}</p>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-500">Currency</p>
                        <p class="mt-1 text-sm text-gray-900">{{ $file->currency->code ?? 'N/A' }}</p>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-500">Guide</p>
                        <p class="mt-1 text-sm text-gray-900">{{ $file->guide ?? 'N/A' }}</p>
                    </div>
                </div>

                @if($file->note)
                <div class="mt-4">
                    <p class="text-sm font-medium text-gray-500">Notes</p>
                    <p class="mt-1 text-sm text-gray-900 whitespace-pre-line">{{ $file->note }}</p>
                </div>
                @endif
            </div>
            <div class="px-6 py-4 border-t border-gray-200 text-sm text-gray-500">
                Created {{ $file->created_at->diffForHumans() }} | Last updated {{ $file->updated_at->diffForHumans() }}
            </div>
        </div>

        <!-- Display file items if they exist -->
        @if($file->items->count() > 0)
        <div class="mt-6 bg-white shadow rounded-lg overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-200">
                <h3 class="text-lg font-medium text-gray-900">File Items</h3>
            </div>
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Service</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Description</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Qty</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Unit Price</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Total</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Currency</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @foreach($file->items as $item)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $item->service_name }}</td>
                            <td class="px-6 py-4 text-sm text-gray-500">
                                {{ Str::limit(is_array($item->description) ? json_encode($item->description) : ($item->description ?? ''), 50) }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $item->quantity }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ number_format($item->unit_price, 2) }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ number_format($item->total_price, 2) }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $item->currency->code ?? 'N/A' }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot class="bg-gray-50">
                        <tr>
                            <td colspan="4" class="px-6 py-3 text-right text-sm font-medium text-gray-500">Grand Total</td>
                            <td class="px-6 py-3 text-sm font-medium text-gray-900">{{ number_format($file->items->sum('total_price'), 2) }}</td>
                            <td></td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
        @endif

        <!-- Add assignee -->
            <!-- Assignees Section -->
        <div class="bg-gray-200 shadow rounded-lg overflow-hidden mt-4" x-data="{open: false}">
            <!-- Table Header with Create Button -->
            <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
                <div class="flex justify-between items-center">
                    <h3 class="text-lg font-medium text-gray-900">File Assignees</h3>
                    <x-primary-button @click="open = !open">
                        {{ __('Add New Assignee') }}
                    </x-primary-button>
                </div>
            </div>

            <!-- Table -->
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Information</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Assigned At</th>
                            <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($file->assignees()->get() as $fileAssignee)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                    {{ $fileAssignee->assignee->name ?? ''}}
                                </td>

                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                    {{ $fileAssignee->assignee->email }}
                                </td>

                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                    {{ $fileAssignee->assignee->company_info ?? ''}}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{ $fileAssignee->assignee->created_at->format('M d, Y') }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    <div class="flex justify-end space-x-2">
                                        <a href="#" class="text-indigo-600 hover:text-indigo-900">Edit</a>
                                        <form method="POST" action="#">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:text-red-900" onclick="return confirm('Remove this assignee?')">
                                                Remove
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            <!-- Adding assignee data -->
                            <tr x-show="open">
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                    <x-text-input name="name" type="text"/>
                                </td>

                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                      <x-text-input name="email" type="email" />
                                </td>

                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                    <x-text-input name="company_info" type="text" />
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    <div class="flex justify-end space-x-2">
                                        <form method="POST" action="#">
                                            <button type="submit" href="#" class="text-green-600 hover:text-green-900">Create</button>
                                        </form>
                                        <a href="#" class="text-indigo-600 hover:text-indigo-900">Edit</a>
                                        <form method="POST" action="#">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:text-red-900" onclick="return confirm('Remove this assignee?')">
                                                Remove
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="px-6 py-10 text-center text-sm text-gray-500">
                                    No assignees found for this file.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>