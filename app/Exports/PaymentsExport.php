<?php
namespace App\Exports;

use App\Models\Payments;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class PaymentsExport implements FromCollection, WithHeadings, ShouldAutoSize
{
    protected $startDate;
    protected $endDate;

    public function __construct($startDate, $endDate)
    {
        $this->startDate = $startDate;
        $this->endDate = $endDate;
    }

    public function collection()
    {
        return Payments::with('users')
            ->where('type', 'add_coins')
            ->whereBetween('datetime', [$this->startDate, $this->endDate])
            ->get()
            ->map(function ($payment) {
                $taxRate = 0.18; // 18% GST (CGST 9% + SGST 9%)
                $taxableAmount = round($payment->amount / (1 + $taxRate), 2);
                $cgst = round($taxableAmount * 0.09, 2);
                $sgst = round($taxableAmount * 0.09, 2);
                $totalAmount = $payment->amount;

                return [
                    'Invoice No'    => 'HIDUDE - ' . date('Y-m-d', strtotime($payment->datetime)) . $payment->invoice_no,
                    'To'            => 'HIDUDE - ' . substr($payment->users->id ?? '00000', -5),
                    'Item Name'     => 'In App Premium Purchase',
                    'Qty'           => 1,
                    'HSN Code'      => '998439',
                    'Amount'        => number_format($payment->amount, 2),
                    'Taxable Amt'   => number_format($taxableAmount, 2),
                    'CGST'          => number_format($cgst, 2),
                    'SGST'          => number_format($sgst, 2),
                    'Total Amt'     => number_format($totalAmount, 2),
                ];
            });
    }

    public function headings(): array
    {
        return ['Invoice No', 'To', 'Item Name', 'Qty', 'HSN Code', 'Amount', 'Taxable Amt', 'CGST', 'SGST', 'Total Amt'];
    }
}
