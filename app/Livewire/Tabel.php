<?php

namespace App\Livewire;

use App\Exports\DataExport;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Log;
use Livewire\Component;
use Maatwebsite\Excel\Facades\Excel;

class Tabel extends Component
{
    public $title;
    public $action;
    public $searchbar;
    public $header;
    public $colum;
    public $search = ''; // Search keyword with proper initialization
    public $searchableHeaders = []; // Searchable columns

    public function mount($title = '', $action = false, $searchbar = false, $header = [], $colum = [], $searchableHeaders = [])
    {
        $this->title = $title;
        $this->action = $action;
        $this->searchbar = $searchbar;
        $this->header = $header;
        $this->colum = $colum;
        $this->searchableHeaders = $searchableHeaders;
    }

    public function exportCSV()
    {
        $fileName = 'export-' . $this->title . '-' . now()->format('Y-m-d-His') . '.csv';

        $handle = fopen(storage_path('app/public/' . $fileName), 'w');

        // Write headers
        fputcsv($handle, $this->header);

        // Write data rows
        foreach ($this->filteredColumns as $row) {
            $rowData = [];
            foreach ($this->header as $column) {
                $rowData[] = strip_tags(html_entity_decode($row[$column]));
            }
            fputcsv($handle, $rowData);
        }

        fclose($handle);

        return response()->download(storage_path('app/public/' . $fileName))->deleteFileAfterSend();
    }

    // Export to Excel
    public function exportExcel()
    {
        $fileName = 'export-'  . $this->title . '-' . now()->format('Y-m-d-His') . '.xlsx';

        return Excel::download(new DataExport($this->filteredColumns, $this->header), $fileName);
    }

    public function exportPDF()
    {
        $data = [
            'header' => $this->header,
            'filteredColumns' => $this->filteredColumns
        ];

        $pdf = Pdf::loadView('exports.table-pdf', $data);

        return response()->streamDownload(function () use ($pdf) {
            echo $pdf->output();
        }, 'export-' . $this->title . '-' . now()->format('Y-m-d-His') . '.pdf');
    }

    public function printTable()
    {

        $this->dispatch(
            'print-table',
            header: $this->header,
            data: $this->filteredColumns
        );
    }

    public function copyTable()
    {

        $this->dispatch(
            'copy-table',
            header: $this->header,
            data: $this->filteredColumns
        );
    }

    public function getFilteredColumnsProperty()
    {
        if (empty($this->search)) {
            return $this->colum;
        }

        return collect($this->colum)->filter(function ($row) {
            foreach ($this->searchableHeaders as $key) {
                if (isset($row[$key]) && stripos(strtolower($row[$key]), strtolower($this->search)) !== false) {
                    return true;
                }
            }
            return false;
        })->toArray();
    }

    public function render()
    {
        return view('livewire.tabel', [
            'filteredColumns' => $this->getFilteredColumnsProperty(),
        ]);
    }
}
