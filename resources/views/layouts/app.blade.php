<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard') - SMKN 8 Kota Serang</title>
    
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <style>
        [x-cloak] { display: none !important; }

        @media print {
            body * { visibility: hidden; }
            .print-area, .print-area * { visibility: visible; }
            .print-area { position: absolute; left: 0; top: 0; width: 100%; }
            .print-area th:last-child, .print-area td:last-child { display: none; }
            .no-print { display: none !important; }
        }
    </style>
</head>
<body class="bg-gray-100 text-gray-800">

    <div x-data="{ sidebarOpen: false }" class="flex h-screen bg-gray-200" x-cloak>
        @include('layouts.partials.sidebar')
        <div class="flex-1 flex flex-col overflow-hidden">
            @include('layouts.partials.header')
            <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-100 p-6">
                @yield('content')
            </main>
            @include('layouts.partials.footer')
        </div>
    </div>

    {{-- ====================================================== --}}
    {{-- SEMUA SCRIPT FUNGSIONALITAS ADA DI BAWAH INI --}}
    {{-- ====================================================== --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.full.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.23/jspdf.plugin.autotable.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/FileSaver.js/2.0.5/FileSaver.min.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Fungsi untuk mendapatkan judul halaman yang lebih bersih
            const getPageTitle = () => {
                const titleElement = document.querySelector('h2');
                return titleElement ? titleElement.textContent.trim() : "Laporan";
            };

            const pageTitle = getPageTitle();
            const fileName = pageTitle.replace(/ /g, '_'); // Contoh: Riwayat_Barang_Keluar

            // --- FUNGSI PENCARIAN (SEARCH) ---
            const searchInput = document.getElementById('searchInput');
            const tableBody = document.getElementById('tableBody');
            if (searchInput && tableBody) {
                searchInput.addEventListener('keyup', function() {
                    const searchTerm = this.value.toLowerCase();
                    const rows = tableBody.getElementsByTagName('tr');
                    let found = false;
                    for (let row of rows) {
                        // Hanya filter baris data (yang punya <td>), bukan baris pesan error
                        if (row.getElementsByTagName('td').length > 0) {
                            const rowText = row.textContent.toLowerCase();
                            const isVisible = rowText.includes(searchTerm);
                            row.style.display = isVisible ? '' : 'none';
                            if (isVisible) found = true;
                        }
                    }

                    // Menampilkan pesan jika tidak ada hasil pencarian
                    let noResultRow = tableBody.querySelector('.no-result');
                    if (!found && tableBody.querySelector('tr[style="display: none;"]')) {
                        if (!noResultRow) {
                            noResultRow = tableBody.insertRow();
                            noResultRow.classList.add('no-result');
                            const cell = noResultRow.insertCell();
                            cell.colSpan = 100; // Span ke semua kolom
                            cell.className = "text-center py-10 text-gray-500";
                            cell.textContent = "Data tidak ditemukan.";
                        }
                    } else if (noResultRow) {
                        noResultRow.remove();
                    }
                });
            }

            const dataTable = document.getElementById('dataTable');
            if (!dataTable) return; // Jika tidak ada tabel di halaman ini, hentikan eksekusi script

            // --- FUNGSI EKSPOR UMUM ---
            const exportTable = (format) => {
                const tableClone = dataTable.cloneNode(true);
                // Selalu hapus kolom terakhir (Aksi) dari hasil ekspor
                tableClone.querySelectorAll('th:last-child, td:last-child').forEach(el => el.remove());

                if (format === 'excel') {
                    // KUNCI PERBAIKAN TANGGAL: ubah data tanggal sebelum ekspor
                    tableClone.querySelectorAll('td[data-tgl]').forEach(td => {
                        td.textContent = td.getAttribute('data-tgl');
                    });
                    const wb = XLSX.utils.table_to_book(tableClone, { sheet: "Data", cellDates: true });
                    XLSX.writeFile(wb, fileName + '.xlsx');
                } 
                else if (format === 'pdf') {
                    const { jsPDF } = window.jspdf;
                    const doc = new jsPDF({ orientation: "landscape" });
                    doc.text(pageTitle, 14, 15);
                    doc.autoTable({ html: tableClone, startY: 20 });
                    doc.save(fileName + '.pdf');
                }
                else if (format === 'word') {
                    const header = `<html xmlns:o='urn:schemas-microsoft-com:office:office' xmlns:w='urn:schemas-microsoft-com:office:word' xmlns='http://www.w3.org/TR/REC-html40'><head><meta charset='utf-8'><title>${pageTitle}</title></head><body><h2>${pageTitle}</h2>`;
                    const footer = "</body></html>";
                    const sourceHTML = header + tableClone.outerHTML + footer;
                    const source = 'data:application/vnd.ms-word;charset=utf-8,' + encodeURIComponent(sourceHTML);
                    const fileLink = document.createElement("a");
                    fileLink.href = source;
                    fileLink.download = fileName + '.doc';
                    fileLink.click();
                }
            };

            // --- EVENT LISTENERS UNTUK TOMBOL ---
            document.getElementById('printButton')?.addEventListener('click', () => {
                const tableWrapper = document.createElement('div');
                tableWrapper.classList.add('print-area');
                tableWrapper.innerHTML = `<h2>${pageTitle}</h2>` + dataTable.outerHTML;
                document.body.appendChild(tableWrapper);
                window.print();
                document.body.removeChild(tableWrapper);
            });

            document.getElementById('excelButton')?.addEventListener('click', () => exportTable('excel'));
            document.getElementById('pdfButton')?.addEventListener('click', () => exportTable('pdf'));
            document.getElementById('wordButton')?.addEventListener('click', () => exportTable('word'));
        });
    </script>
</body>
</html>