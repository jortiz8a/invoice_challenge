<?php

namespace App\Imports;

use App\Invoice;
use Maatwebsite\Excel\Concerns\ToModel;

class InvoiceImport implements ToModel
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        $invoice = new Invoice([
            'description'     => $row[0],
            'code'    => $row[1],
            'client_id' => $row[2],
            'Store_id' => $row[3],
        ]);
        $invoice->expires_at = date("Y-m-d H:i:s", strtotime($invoice->created_at . "+ 30 days"));
        return $invoice;
    }
}
