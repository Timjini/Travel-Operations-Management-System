<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard Overview') }}
        </h2>
    </x-slot>

    <div class="py-4 sm:py-8 px-4 sm:px-6 lg:px-8 max-w-7xl mx-auto space-y-6 sm:space-y-8">

        <!-- Top Stats: 2x2 grid on mobile, 4 columns on desktop -->
        <div class="grid grid-cols-2 lg:grid-cols-4 gap-3 sm:gap-6">
            
            <!-- Total Clients -->
            <div class="bg-white shadow-sm rounded-xl p-4 sm:p-5 flex flex-col justify-between">
                <div class="flex items-center justify-between sm:justify-start">
                    <div class="p-2.5 sm:p-3 rounded-xl bg-blue-50 text-blue-600 shrink-0">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 sm:w-6 sm:h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z" />
                        </svg>
                    </div>
                    <span class="text-xs font-semibold text-green-600 bg-green-50 px-2 py-0.5 rounded-full sm:hidden">+12%</span>
                </div>
                <div class="mt-3 sm:mt-4">
                    <p class="text-xs sm:text-sm text-gray-500 font-medium">Total Clients</p>
                    <div class="flex items-baseline justify-between">
                        <p class="text-xl sm:text-2xl font-bold text-gray-900">{{ $clientsCount ?? 0 }}</p>
                        <span class="hidden sm:inline-block text-green-600 text-xs sm:text-sm font-semibold">+12%</span>
                    </div>
                </div>
            </div>

            <!-- Active Suppliers -->
            <div class="bg-white shadow-sm rounded-xl p-4 sm:p-5 flex flex-col justify-between">
                <div class="flex items-center justify-between sm:justify-start">
                    <div class="p-2.5 sm:p-3 rounded-xl bg-green-50 text-green-600 shrink-0">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 sm:w-6 sm:h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 21h19.5m-18-18v18m10.5-18v18m6-13.5V21M6.75 6.75h.75m-.75 3h.75m-.75 3h.75m3-6h.75m-.75 3h.75m-.75 3h.75M6.75 21v-3.375c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21M3 3h12m-.75 4.5H21m-3.75 3.75h.008v.008h-.008v-.008Zm0 3h.008v.008h-.008v-.008Zm0 3h.008v.008h-.008v-.008Z" />
                        </svg>
                    </div>
                    <span class="text-xs font-semibold text-green-600 bg-green-50 px-2 py-0.5 rounded-full sm:hidden">+5%</span>
                </div>
                <div class="mt-3 sm:mt-4">
                    <p class="text-xs sm:text-sm text-gray-500 font-medium">Active Suppliers</p>
                    <div class="flex items-baseline justify-between">
                        <p class="text-xl sm:text-2xl font-bold text-gray-900">{{ $suppliersCount ?? 0 }}</p>
                        <span class="hidden sm:inline-block text-green-600 text-xs sm:text-sm font-semibold">+5%</span>
                    </div>
                </div>
            </div>

            <!-- Reservations -->
            <div class="bg-white shadow-sm rounded-xl p-4 sm:p-5 flex flex-col justify-between">
                <div class="flex items-center justify-between sm:justify-start">
                    <div class="p-2.5 sm:p-3 rounded-xl bg-purple-50 text-purple-600 shrink-0">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 sm:w-6 sm:h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 3v11.25A2.25 2.25 0 0 0 6 16.5h2.25M3.75 3h-1.5m1.5 0h16.5m0 0h1.5m-1.5 0v11.25A2.25 2.25 0 0 1 18 16.5h-2.25m-7.5 0h7.5m-7.5 0-1 3m8.5-3 1 3m0 0 .5 1.5m-.5-1.5h-9.5m0 0-.5 1.5m.75-9 3-3 2.148 2.148A12.061 12.061 0 0 1 16.5 7.605" />
                        </svg>
                    </div>
                    <span class="text-xs font-semibold text-green-600 bg-green-50 px-2 py-0.5 rounded-full sm:hidden">+18%</span>
                </div>
                <div class="mt-3 sm:mt-4">
                    <p class="text-xs sm:text-sm text-gray-500 font-medium">Reservations</p>
                    <div class="flex items-baseline justify-between">
                        <p class="text-xl sm:text-2xl font-bold text-gray-900">{{ $reservationsCount ?? 0 }}</p>
                        <span class="hidden sm:inline-block text-green-600 text-xs sm:text-sm font-semibold">+18%</span>
                    </div>
                </div>
            </div>

            <!-- Revenue -->
            <div class="bg-white shadow-sm rounded-xl p-4 sm:p-5 flex flex-col justify-between">
                <div class="flex items-center justify-between sm:justify-start">
                    <div class="p-2.5 sm:p-3 rounded-xl bg-orange-50 text-orange-600 shrink-0">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 sm:w-6 sm:h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 18.75a60.07 60.07 0 0 1 15.797 2.101c.727.198 1.453-.342 1.453-1.096V18.75M3.75 4.5v.75A.75.75 0 0 1 3 6h-.75m0 0v-.375c0-.621.504-1.125 1.125-1.125H20.25M2.25 6v9m18-10.5v.75c0 .414.336.75.75.75h.75m-1.5-1.5h.375c.621 0 1.125.504 1.125 1.125v9.75c0 .621-.504 1.125-1.125 1.125h-.375m1.5-1.5H21a.75.75 0 0 0-.75.75v.75m0 0H3.75m0 0h-.375a1.125 1.125 0 0 1-1.125-1.125V15m1.5 1.5v-.75A.75.75 0 0 0 3 15h-.75M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm3 0h.008v.008H18V10.5Zm-12 0h.008v.008H6V10.5Z" />
                        </svg>
                    </div>
                    <span class="text-xs font-semibold text-green-600 bg-green-50 px-2 py-0.5 rounded-full sm:hidden">+23%</span>
                </div>
                <div class="mt-3 sm:mt-4">
                    <p class="text-xs sm:text-sm text-gray-500 font-medium">Revenue</p>
                    <div class="flex items-baseline justify-between">
                        <p class="text-xl sm:text-2xl font-bold text-gray-900">${{ number_format($revenue ?? 0) }}</p>
                        <span class="hidden sm:inline-block text-green-600 text-xs sm:text-sm font-semibold">+23%</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Content Grid -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            
            <!-- Quick Actions (Stacked on top for fast mobile access) -->
            <div class="bg-white shadow-sm rounded-xl p-5 order-1 lg:order-2">
                <h3 class="text-base font-semibold text-gray-900 mb-4">Quick Actions</h3>
                <div class="grid grid-cols-2 gap-3">
                    <a href="{{ route('files.create') }}" class="flex items-center justify-center min-h-[48px] bg-blue-50 text-blue-600 hover:bg-blue-100 active:scale-95 transition-all rounded-xl p-3 text-sm font-medium text-center">
                        + New Booking
                    </a>
                    <a href="{{ route('customers.create') }}" class="flex items-center justify-center min-h-[48px] bg-green-50 text-green-600 hover:bg-green-100 active:scale-95 transition-all rounded-xl p-3 text-sm font-medium text-center">
                        + Add Client
                    </a>
                    <a href="{{ route('suppliers.create') }}" class="flex items-center justify-center min-h-[48px] bg-purple-50 text-purple-600 hover:bg-purple-100 active:scale-95 transition-all rounded-xl p-3 text-sm font-medium text-center">
                        + Add Supplier
                    </a>
                    <button class="hidden flex items-center justify-center min-h-[48px] bg-orange-50 text-orange-600 hover:bg-orange-100 active:scale-95 transition-all rounded-xl p-3 text-sm font-medium text-center">
                        Create Invoice
                    </button>
                </div>
            </div>

            <!-- Recent Activities -->
            <div class="bg-white shadow-sm rounded-xl p-5 order-2 lg:order-1">
                <h3 class="text-base font-semibold text-gray-900 mb-4">Recent Activities</h3>
                <ul class="space-y-4">
                    @foreach($recentActivities as $activity)
                    <li class="flex items-start min-w-0">
                        <span class="h-2 w-2 bg-blue-500 rounded-full mt-2 ring-4 ring-blue-50 shrink-0"></span>
                        <div class="ml-3 min-w-0 flex-1">
                            <p class="text-sm font-medium text-gray-900 truncate">
                                {{ $activity->file->customer->name ?? 'Unknown' }}
                            </p>
                            <p class="text-xs sm:text-sm text-gray-500 break-words mt-0.5">
                                @if($activity instanceof \App\Models\Invoice)
                                    Invoice #{{ $activity->invoice_number }} created · {{ $activity->updated_at->diffForHumans() }}
                                @elseif($activity instanceof \App\Models\File)
                                    File {{ $activity->reference }} updated · {{ $activity->updated_at->diffForHumans() }}
                                @elseif($activity instanceof \App\Models\FileItem)
                                    Item {{ $activity->service_name }} updated in File {{ $activity->file->reference ?? '' }} · {{ $activity->updated_at->diffForHumans() }}
                                @elseif($activity instanceof \App\Models\FileCost)
                                    Cost {{ $activity->description }} updated in File {{ $activity->file->reference ?? '' }} · {{ $activity->updated_at->diffForHumans() }}
                                @endif
                            </p>
                        </div>
                    </li>
                    @endforeach
                </ul>
            </div>

        </div>
    </div>
</x-app-layout>