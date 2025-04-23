<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Illuminate\Support\Collection;

class DataExport implements FromCollection
{
    /**
     * @return \Illuminate\Support\Collection
     */

    protected $data;
    protected $header;

    public function __construct($data, $header)
    {
        $this->data = $data;
        $this->header = $header;
    }
    public function collection()
    {
        return collect($this->data)->map(function ($row) {
            $newRow = [];
            foreach ($this->header as $column) {
                $newRow[$column] = strip_tags(html_entity_decode($row[$column]));
            }
            return $newRow;
        });
    }

    public function headings(): array
    {
        return $this->header;
    }
}
