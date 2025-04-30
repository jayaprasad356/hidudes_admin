<?php

namespace App\Http\Controllers;

use App\Models\Transactions;
use Illuminate\Http\Request;
require_once public_path('fpdf/fpdf.php');

class TransactionsController extends Controller
{
    public function index(Request $request)
    {
        $types = Transactions::select('type')->distinct()->pluck('type');
        $filterDate = $request->get('filter_date');

        $transactions = Transactions::with('users')
            ->when($filterDate, fn($query) => $query->whereDate('datetime', $filterDate))
            ->when($request->input('type'), fn($query, $type) => $query->where('type', $type))
            ->orderBy('datetime', 'desc')
            ->get();

        return view('transactions.index', compact('transactions', 'types'));
    }

    public function downloadInvoice($id)
    {
        $transaction = Transactions::with('users')->findOrFail($id);
        $pdf = new \FPDF();
        $pdf->AddPage();
        $pdf->SetFont('Arial', '', 12);
    
      // Invoice Header (Left)
        $pdf->SetFont('Arial', 'B', 16);
        $pdf->Cell(95, 10, 'Tax Invoice', 0, 1, 'L'); // Large title

        $pdf->SetFont('Arial', '', 12);
        $pdf->SetTextColor(150, 150, 150); // Soft gray text
        $pdf->Cell(25, 8, 'Invoice No:', 0, 0);
        $pdf->SetFont('Arial', 'B', 12);
        $pdf->SetTextColor(0, 0, 0); // Black text
        $pdf->Cell(55, 8,'HIDUDE - ' . date('Y-m-d', strtotime($transaction->datetime))  . $transaction->id, 0, 1);
    
            $pdf->SetTextColor(150, 150, 150);
            $pdf->Cell(25, 8, 'To :', 0, 0);
            $pdf->SetFont('Arial', 'B', 12);
            $pdf->SetTextColor(0, 0, 0);
            $pdf->Cell(55, 8, 'HIDUDE - ' . substr($payment->users->id ?? '00000', -5), 0, 1);
    
            // Move to Right for Company Details
            $pdf->SetY(10);
            $pdf->SetX(120);
    
            // Company Logo
            $pdf->Image('https://hidude.in/storage/uploads/logo/gm_site.png', 120, 10, 20, 20); // Adjust path & size as needed
    
        // Move Below Logo
        $pdf->SetY(35);
        $pdf->SetX(120);
        $pdf->SetFont('Arial', 'B', 12);
        $pdf->SetTextColor(150, 150, 150);
        $pdf->SetTextColor(0, 0, 0);
        $pdf->Cell(12, 8, 'Date:', 0, 0);
        $pdf->SetTextColor(0, 0, 0);
        $pdf->Cell(12, 8, date('d.m.Y', strtotime($transaction->datetime)), 0, 1);

        $pdf->SetX(120);
        $pdf->SetFont('Arial', 'B', 12);
        $pdf->Cell(75, 8, 'Graymatter Works', 0, 1);

        $pdf->SetFont('Arial', '', 11);
        $pdf->SetTextColor(100, 100, 100);
        $pdf->SetX(120);
        $pdf->MultiCell(75, 6, "No. 3 Ragavendra garden , Thiruvanai Kovil , Trichy, LPG Auto Gas Opposite Road , Tiruchirappalli - 620005 , Tamil Nadu, India", 0, 'L');

        $pdf->Ln(3);

        $pdf->SetX(120);
        $pdf->SetTextColor(150, 150, 150);
        $pdf->Cell(15, 8, 'GSTIN:', 0, 0);
        $pdf->Cell(15, 8, '33BUDPJ8188C1ZN', 0, 1);

        $pdf->Ln(10);
    
        $pdf->SetFont('Arial', '', 12);
        $pdf->Cell(10, 8, '#', 0, 0);
        $pdf->Cell(90, 8, 'Item Name', 0, 0);
        $pdf->Cell(10, 8, 'Qty', 0, 0);
        $pdf->Cell(20, 8, 'HSN', 0, 0);
        $pdf->Cell(50, 8, 'Amount', 0, 1, 'R'); // Align to the right
        $pdf->Line(10, $pdf->GetY(), 200, $pdf->GetY()); // Separator line
        
        // Table Content
        $pdf->SetFont('Arial', 'B', 12);
        $pdf->SetTextColor(0, 0, 0);
        $pdf->Cell(10, 8, '1', 0, 0);
        $pdf->SetFont('Arial', 'B', 12);
        $pdf->SetTextColor(0, 0, 0);
        $pdf->Cell(90, 8, " In App Premium Purchase", 0, 0);
        $pdf->SetFont('Arial', 'B', 12);
        $pdf->SetTextColor(0, 0, 0);
        $pdf->Cell(10, 8, '1', 0, 0);
        $pdf->SetFont('Arial', 'B', 12);
        $pdf->SetTextColor(0, 0, 0);
        $pdf->Cell(20, 8, '998439', 0, 0);
        $pdf->SetFont('Arial', 'B', 12);
        $pdf->SetTextColor(0, 0, 0);
        $pdf->Cell(50, 8, 'Rs ' . number_format($transaction->amount, 2), 0, 1, 'R'); // Align to the right
        $pdf->Ln(5);
        $pdf->Line(10, $pdf->GetY(), 200, $pdf->GetY()); // Separator line
        
          // Tax Calculation ensuring final amount remains same
          $taxRate = 0.18; // 18% GST (CGST 9% + SGST 9%)
          $baseAmount = round($transaction->amount / (1 + $taxRate), 2);
          $cgst = round($baseAmount * 0.09, 2);
          $sgst = round($baseAmount * 0.09, 2);
          $total = $transaction->amount; // Final amount remains the same
        // Tax Breakdown (Right-Aligned)

        $pdf->SetFont('Arial', '', 12);
        $pdf->SetX(120);
        $pdf->Cell(40, 8, 'Subtotal (Taxable Value)', 0, 0);
        $pdf->Cell(30, 8, 'Rs ' . number_format($baseAmount, 2), 0, 1, 'R');
        
        $pdf->SetX(120);
        $pdf->Cell(40, 8, 'Tax (CGST 9%)', 0, 0);
        $pdf->Cell(30, 8, 'Rs ' . number_format($cgst, 2), 0, 1, 'R');
        
        $pdf->SetX(120);
        $pdf->Cell(40, 8, 'Tax (SGST 9%)', 0, 0);
        $pdf->Cell(30, 8, 'Rs ' . number_format($sgst, 2), 0, 1, 'R');
        
        $pdf->SetX(120);
        $pdf->Cell(40, 8, 'Rounding Off', 0, 0);
        $pdf->Cell(30, 8, '-', 0, 1, 'R');
        
        // Grand Total (Bold)
        $pdf->SetFont('Arial', 'B', 12);
        $pdf->SetX(120);
        $pdf->SetTextColor(150, 150, 150);
        $pdf->SetTextColor(0, 0, 0);
        $pdf->SetFont('Arial', 'B', 12);
        $pdf->Cell(40, 10, 'Grand Total', 0, 0);
        $pdf->Cell(30, 10, 'Rs ' . number_format($total, 2), 0, 1, 'R');
        $pdf->Ln(5);
        
        $pdf->Output('D', "invoice_{$transaction->id}.pdf");
    }
   
    
 } 

   
