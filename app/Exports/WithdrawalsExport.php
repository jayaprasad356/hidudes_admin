<?php
namespace App\Exports;

use App\Models\Withdrawals;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class WithdrawalsExport implements FromCollection, WithHeadings
{
    protected $filters;

    public function __construct($filters = [])
    {
        $this->filters = $filters;
    }

    public function collection()
    {
        $query = Withdrawals::query()
            ->select(
                'withdrawals.id',
                'users.name as user_name',
                'users.mobile as user_mobile',
                'withdrawals.amount',
                'withdrawals.status',
                'withdrawals.datetime',
                'users.bank as bank_name',
                'users.branch as branch_name',
                'users.account_num as account_number',
                'users.holder_name as account_holder_name',
                'users.ifsc as ifsc_code',
                'users.upi_id as upi_id'
            )
            ->join('users', 'withdrawals.user_id', '=', 'users.id');
    
        // Apply filters if they exist
        if (isset($this->filters['status'])) {
            $query->where('withdrawals.status', $this->filters['status']);
        }
    
        if (isset($this->filters['filter_date'])) {
            $query->whereDate('withdrawals.datetime', $this->filters['filter_date']);
        }
    
        $withdrawalsData = $query->get();
    
        return $withdrawalsData->map(function ($withdrawal) {
            $statusDescription = match($withdrawal->status) {
                0 => 'Pending',
                1 => 'Paid',
                2 => 'Cancelled',
                default => 'Unknown',
            };
    
            return [
                'Beneficiary Name' => $withdrawal->user_name, // Unique user name again
                'Beneficiary Account number' => $withdrawal->account_number,
                'IFSC code' => $withdrawal->ifsc_code,
                'Amount' => $withdrawal->amount,
                'Description / Purpose' => 'salary', // Unique user name
            ];
        });
    }

    public function headings(): array
    {
        return [
            'Beneficiary Name (Mandatory)',
            'Beneficiary Account number (Mandatory)',
            'IFSC code (Mandatory)',
            'Amount (Mandatory)', // Column for descriptive status
            'Description / Purpose (Optional)',
        ];
    }
}
