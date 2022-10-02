<?php

namespace App\Exports;

use App\Models\Transaction;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Events\BeforeSheet;


class TransactionExport implements FromCollection, WithHeadings, WithColumnWidths, WithStyles, WithEvents
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
            'Transaction State',
            'Amount',
            'Fee Amount',
            'Meter Id',
            'Meter Name',
            'Payment Type',
            'Users Name',
            'Users Phone',
            'Remarks ',
            'Refunded ',
            'Cashback ',
            'Token',
            'Transaction Time'
        ];
    }

    public function columnWidths(): array
    {
        return [
            'A' => 15,
            'B' => 30,            
            'C' => 35,            
            'D' => 15,            
            'E' => 18,            
            'F' => 28,            
            'G' => 18,            
            'H' => 28,            
            'I' => 36,            
            'J' => 28,            
            'K' => 28,            
            'L' => 28,            
            'M' => 28,            
            'N' => 28,            
            'O' => 28,            
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            // Style the first row as bold text.
            1    => ['font' => ['bold' => true]],
            1    => ['font' => ['size' => 15]],

            // Styling a specific cell by coordinate.
            // 'B2' => ['font' => ['italic' => true]],

            // // Styling an entire column.
          
        ];
        
    }

    public function registerEvents(): array
    {
        return [
            BeforeSheet::class    => function(BeforeSheet $event) {
   
                $event->sheet->getDelegate()->getStyle('A:O')
                                ->getAlignment()
                                ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
   
            },
            
        ];

       
        

    }

    public static function afterSheet(AfterSheet $event): array
    {
        return [

            AfterSheet::class    => function(AfterSheet $event) {


                $styleArray = [
                    'borders' => [
                        'outline' => [
                            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK,
                            'color' => ['argb' => 'FFFF0000'],
                        ],
                    ],
                ];

        $event->sheet->getDelegate()->getStyle('A1:O1')->applyFromArray($styleArray);
    },
            
];
 



    }
    
    


}
