<?php

namespace App\Exports;

use App\Models\Transaction;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class TransactionExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Transaction::all();
    }
    public function headings(): array
    {
        //Put Here Header Name That you want in your excel sheet 
        return [
            'ID',
            'Transaction Id',
            'Amount',
            'Meter Id',
            'Meter Name',
            'Token'
        ];}
}
