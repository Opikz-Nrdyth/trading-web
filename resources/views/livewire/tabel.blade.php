<div class="mt-5 p-4 bg-base-side text-base-text">
    <h1 class="text-2xl font-semibold mb-4 text-white">{{ $title }}</h1>
    <div class="bg-base-card p-4 rounded-lg">
        <div class="flex flex-col md:flex-row justify-between items-center mb-4 space-y-4 md:space-y-0">
            @if ($action)
                <div class="flex items-center gap-2 w-full md:w-[50%] lg:w-auto">
                    <div class="w-full grid grid-cols-3 md:grid-cols-5 lg:grid-cols-5 gap-2">
                        <button wire:click="copyTable" target="_blank"
                            class="bg-primary
                        hover:bg-blue-600 text-sm text-white font-semibold py-2 px-4 rounded"
                            wire:loading.attr="disabled">Copy</button>
                        <button wire:click="exportCSV"
                            class="bg-primary hover:bg-blue-600 text-sm text-white font-semibold py-2 px-4 rounded"
                            wire:loading.attr="disabled">CSV</button>
                        <button wire:click="exportExcel"
                            class="bg-primary hover:bg-blue-600 text-sm text-white font-semibold py-2 px-4 rounded"
                            wire:loading.attr="disabled">Excel</button>
                        <button wire:click="exportPDF"
                            class="bg-primary hover:bg-blue-600 text-sm text-white font-semibold py-2 px-4 rounded"
                            wire:loading.attr="disabled">PDF</button>
                        <button wire:click="printTable" target="_blank"
                            class="bg-primary hover:bg-blue-600 text-sm text-white font-semibold py-2 px-4 rounded"
                            wire:loading.attr="disabled">Print</button>
                    </div>
                    <p wire:loading><i class="fa-solid fa-spinner animate-rotate"></i> Loading...</p>
                </div>
            @endif
            @if ($searchbar)
                <div class="flex items-center space-x-2">
                    <label for="search" class="mr-2">Search:</label>
                    <input type="text" id="search" wire:model.live="search"
                        class="py-2 px-4 text-sm rounded bg-base-input text-base-text w-[80%] lg:w-auto"
                        placeholder="Search {{ implode(', ', $searchableHeaders) }}...">
                </div>
            @endif
        </div>
        <div class="overflow-x-auto">
            <table class="min-w-full bg-base-card text-white">
                <thead>
                    <tr>
                        @foreach ($header as $h)
                            <th class="py-2 px-4 border-b border-white whitespace-nowrap">
                                {{ str_replace('_', ' ', strtolower($h)) }}</th>
                        @endforeach
                    </tr>
                </thead>
                <tbody>
                    @if (count($filteredColumns) > 0)
                        @foreach ($filteredColumns as $d)
                            <tr>
                                @foreach ($header as $h)
                                    <td class="py-4 px-4 text-center text-base-text">{!! html_entity_decode($d[$h]) !!}</td>
                                @endforeach
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="{{ count($header) }}" class="py-4 px-4 text-center text-base-text">
                                No data available in table
                            </td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
        <div class="flex flex-col md:flex-row justify-between items-center mt-4 text-base-text space-y-4 md:space-y-0">
            <div>Showing {{ count($filteredColumns) }} entries</div>
        </div>
    </div>

    @script
        <script>
            document.addEventListener('print-table', (e) => {
                const printWindow = window.open('', '_blank');
                printWindow.document.write(`
                <html>
                    <head>
                        <title>Print Table</title>
                        <style>
                            table { width: 100%; border-collapse: collapse; }
                            th, td { border: 1px solid black; padding: 8px; text-align: center; }
                        </style>
                    </head>
                    <body>
                        <table>
                            <thead>
                                <tr>
                                    ${e.detail.header.map(h => `<th>${h.replace(/_/g, ' ').toLowerCase()}</th>`).join('')}
                                </tr>
                            </thead>
                            <tbody>
                                ${e.detail.data.map(row => `
                                                                                                                                                                                                                                                                                                <tr>
                                                                                                                                                                                                                                                                                                    ${e.detail.header.map(h => `<td>${row[h]}</td>`).join('')}
                                                                                                                                                                                                                                                                                                </tr>
                                                                                                                                                                                                                                                                                            `).join('')}
                            </tbody>
                        </table>
                        <script>
                            window.onload = function() {
                                window.print();
                                window.close();
                            }
                        <\/script>
                    </body>
                </html>
            `);
                printWindow.document.close();
            });


            document.addEventListener('copy-table', () => {
                const table = document.querySelector('table');
                const rows = table.querySelectorAll('tr');
                let csvContent = '';

                rows.forEach(row => {
                    const cells = row.querySelectorAll('th, td');
                    const rowData = Array.from(cells).map(cell =>
                        cell.textContent.replace(/\t/g, ' ').replace(/\n/g, ' ')
                    );
                    csvContent += rowData.join('\t') + '\n';
                });

                navigator.clipboard.writeText(csvContent).then(() => {
                    alert('Tabel berhasil disalin');
                });
            });
        </script>
    @endscript
</div>
