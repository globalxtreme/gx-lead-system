<?php

namespace App\Excel;

use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;

class GeneralExcel implements FromArray, WithEvents
{
    public $properties;

    public function __construct($properties)
    {
        $this->properties = $properties;
    }

    /**
     * @return array
     */
    public function array(): array
    {
        return $this->properties;
    }

    /**
     * @return array
     */
    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $styleArray = [
                    'font' => [
                        'bold' => true,
                    ]
                ];

                $event->sheet->getDelegate()->getStyle('A1:' . $event->sheet->getDelegate()->getHighestColumn() . '1')->applyFromArray($styleArray);
            },
        ];
    }

}
