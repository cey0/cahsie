<?php

namespace App\Http\Controllers;
use Elibyy\TCPDF\Facades\TCPDF as PDF;
use App\Models\Transaction;
use Illuminate\Http\Request;

class TransaksiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('transaksi.pdf');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validate the incoming request data based on your requirements
        $request->validate([
            'cart' => 'required|array',
            'total' => 'required|numeric',
            'discount' => 'required|numeric',
            'moneyGiven' => 'required|numeric',
            'change' => 'required|numeric',
        ]);

        // Assuming your Transaction model has 'cart', 'total', 'discount', 'money_given', 'change' columns
        $transaction = new Transaction();
        $transaction->cart = json_encode($request->input('cart')); // Store cart as JSON
        $transaction->total = $request->input('total');
        $transaction->discount = $request->input('discount');
        $transaction->money_given = $request->input('moneyGiven');
        $transaction->change = $request->input('change');

        // Save the transaction
        $transaction->save();

        // Redirect to the receipt page with transaction data
    return redirect()->route('receipt', [
        'total' => $request->input('total'),
        'discount' => $request->input('discount'),
        'moneyGiven' => $request->input('moneyGiven'),
        'change' => $request->input('change'),
    ]);

        // Return a response indicating success
        return response()->json(['message' => 'Transaction stored successfully']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    public function generatePDF()
    {
        try {
            $transactions = Transaction::all();

            if ($transactions->isEmpty()) {
                throw new \Exception('No transactions found.');
            }

            // Prepare data for PDF
            $pdfData = [];
            foreach ($transactions as $transaction) {
                $pdfData[] = [
                    'ID' => $transaction->id,
                    'Nama Barang' => $transaction->nama_barang,
                    'Harga' => $transaction->harga,
                    // Add more attributes as needed
                ];
            }

            // Create TCPDF instance
            $pdf = new PDF();
            $pdf->SetTitle('Transactions Report');

            // Add a page
            $pdf->AddPage();

            // Set font
            $pdf->SetFont('times', '', 12);

            // Add data to PDF
            foreach ($pdfData as $data) {
                $pdf->Cell(40, 10, 'ID: ' . $data['ID']);
                $pdf->Cell(40, 10, 'Nama Barang: ' . $data['Nama Barang']);
                $pdf->Cell(40, 10, 'Harga: ' . $data['Harga']);
                $pdf->Ln(); // Move to the next line
            }

            // Output PDF
            return $pdf->Output('transactions_report.pdf', 'D');
        } catch (\Exception $e) {
            // Handle exceptions appropriately (e.g., log, display a message, redirect)
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
