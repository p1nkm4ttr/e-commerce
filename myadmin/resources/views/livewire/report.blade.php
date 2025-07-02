<div>
    <div class="flex justify-between mb-4">
        <h1 class="text-2xl font-bold">All Orders Report</h1>
        <div>
            <button wire:click="exportCsv" class="bg-teal-600 text-white px-4 py-2 rounded">Export</button>
            <button class="bg-gray-200 px-4 py-2 rounded" wire:click="resetFilters">Reset Filters</button>
        </div>
    </div>

    <!-- Table Section -->
    <div class="bg-white overflow-x-auto">
        <table class="min-w-full">
            <thead>
                <tr class="bg-gray-100">
                    <th class="px-4 py-2 cursor-pointer" wire:click="sortBy('payment_id')">
                        Payment ID @if($sortField === 'payment_id') 
                            @if($sortDirection === 'asc') ↑ @else ↓ @endif 
                        @endif
                    </th>
                    <th class="px-4 py-2 cursor-pointer" wire:click="sortBy('total_amount')">
                        Total Amount @if($sortField === 'total_amount') 
                            @if($sortDirection === 'asc') ↑ @else ↓ @endif 
                        @endif
                    </th>
                    <th class="px-4 py-2 cursor-pointer" wire:click="sortBy('tax_amount')">
                        Tax Amount @if($sortField === 'tax_amount') 
                            @if($sortDirection === 'asc') ↑ @else ↓ @endif 
                        @endif
                    </th>
                    <th class="px-4 py-2 cursor-pointer" wire:click="sortBy('payment_status')">
                        Status @if($sortField === 'payment_status') 
                            @if($sortDirection === 'asc') ↑ @else ↓ @endif 
                        @endif
                    </th>
                    <th class="px-4 py-2">Items</th>
                </tr>
                <tr class="bg-gray-50">
                    <th class="px-4 py-2">
                        <input type="text" 
                            wire:model.live="filters.payment_id" 
                            class="w-full border rounded px-2 py-1 text-sm" 
                            placeholder="Search ID">
                    </th>
                    <th class="px-4 py-2">
                        <input type="number" 
                            wire:model.live="filters.amount" 
                            class="w-full border rounded px-2 py-1 text-sm" 
                            placeholder="Enter Amount" 
                            step="0.01">
                    </th>
                    <th class="px-4 py-2">
                        <input type="number" 
                            wire:model.live="filters.tax" 
                            class="w-full border rounded px-2 py-1 text-sm" 
                            placeholder="Enter Tax" 
                            step="0.01">
                    </th>
                    <th class="px-4 py-2">
                        <select wire:model.live="filters.payment_status" 
                            class="w-full border rounded px-2 py-1 text-sm">
                            <option value="">All</option>
                            <option value="completed">Completed</option>
                            <option value="pending">Pending</option>
                        </select>
                    </th>
                    <th class="px-4 py-2"></th>
                </tr>
            </thead>
            <tbody>
                @foreach($payments as $payment)
                <tr class="border-t">
                    <td class="px-4 py-2">{{ $payment->payment_id }}</td>
                    <td class="px-4 py-2">${{ number_format($payment->total_amount, 2) }}</td>
                    <td class="px-4 py-2">${{ number_format($payment->tax_amount, 2) }}</td>
                    <td class="px-4 py-2">
                        <span class="px-2 py-1 rounded-full text-sm 
                            {{ $payment->payment_status === 'completed' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                            {{ ucfirst($payment->payment_status) }}
                        </span>
                    </td>
                    <td class="px-4 py-2">
                        <div class="text-sm">
                            @foreach($payment->items as $item)
                                <div class="mb-1">
                                    {{ $item->quantity }}x {{ $item->item_name }}
                                    <span class="text-gray-500">
                                        (${{ number_format($item->price, 2) }})
                                    </span>
                                </div>
                            @endforeach
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <div class="p-4">
            {{ $payments->links() }}
        </div>
    </div>
</div>
