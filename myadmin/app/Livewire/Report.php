<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Pos;
use Symfony\Component\HttpFoundation\Response;

class Report extends Component
{
    use WithPagination;

    public $filters = [
        'payment_id' => '',
        'amount' => '',
        'tax' => '',
        'payment_status' => ''
    ];

    public $sortField = 'payment_id';
    public $sortDirection = 'desc';

    public function render()
    {
        $payments = Pos::query()
            ->with('items') 
            ->when($this->filters['payment_id'], function($query, $payment_id) {
                $query->where('payment_id', 'like', '%' . $payment_id . '%');
            })
            ->when($this->filters['amount'], function($query, $amount) {
                $amount = str_replace(['$', ','], '', $amount);
                if (is_numeric($amount)) {
                    $query->where('total_amount', '>=', floatval($amount));
                }
            })
            ->when($this->filters['tax'], function($query, $tax) {
                $tax = str_replace(['$', ','], '', $tax);
                if (is_numeric($tax)) {
                    $query->where('tax_amount', '>=', floatval($tax));
                }
            })
            ->when($this->filters['payment_status'], function($query, $status) {
                $query->where('payment_status', $status);
            })
            ->orderBy($this->sortField, $this->sortDirection)
            ->paginate(10);

        return view('livewire.report', [
            'payments' => $payments
        ]);
    }

    public function updatedFilters()
    {
        $this->resetPage();
    }

    public function resetFilters()
    {
        $this->reset('filters');
    }

    public function sortBy($field)
    {
        if ($this->sortField === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortDirection = 'asc';
        }
        
        $this->sortField = $field;
    }

    public function exportCsv()
    {
        $payments = Pos::query()
            ->with('items')
            ->when($this->filters['payment_id'], function($query, $payment_id) {
                $query->where('payment_id', 'like', '%' . $payment_id . '%');
            })
            ->when($this->filters['amount'], function($query, $amount) {
                $amount = str_replace(['$', ','], '', $amount);
                if (is_numeric($amount)) {
                    $query->where('total_amount', '>=', floatval($amount));
                }
            })
            ->when($this->filters['tax'], function($query, $tax) {
                $tax = str_replace(['$', ','], '', $tax);
                if (is_numeric($tax)) {
                    $query->where('tax_amount', '>=', floatval($tax));
                }
            })
            ->when($this->filters['payment_status'], function($query, $status) {
                $query->where('payment_status', $status);
            })
            ->orderBy($this->sortField, $this->sortDirection)
            ->get();

        $filename = 'payments-report-' . date('Y-m-d') . '.csv';
        
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => "attachment; filename={$filename}",
            'Pragma' => 'no-cache',
            'Cache-Control' => 'must-revalidate, post-check=0, pre-check=0',
            'Expires' => '0'
        ];

        $callback = function() use ($payments) {
            $file = fopen('php://output', 'w');
            
            
            fputcsv($file, [
                'Payment ID',
                'Total Amount',
                'Tax Amount',
                'Status',
                'Items'
            ]);

            
            foreach ($payments as $payment) {
                $items = $payment->items->map(function($item) {
                    return "{$item->quantity}x {$item->item_name} (\${$item->price})";
                })->join(', ');

                fputcsv($file, [
                    $payment->payment_id,
                    number_format((float)$payment->total_amount, 2),
                    number_format((float)$payment->tax_amount, 2),
                    ucfirst($payment->payment_status),
                    $items
                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, Response::HTTP_OK, $headers);
    }
}
