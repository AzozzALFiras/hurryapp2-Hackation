<div class="col-xl-12 col-md-12">
     <div class="card overflow-hidden">
         <div class="card-datatable table-responsive pt-0">
            <div class="dataTables_wrapper dt-bootstrap5 no-footer">
            <div class="card-header flex-column flex-md-row">
                <div class="head-label text-center">
                    <h5 class="card-title mb-0">{{ $name }}</h5>
                </div>
                <div class="dt-action-buttons text-end pt-3 pt-md-0">
                    <div class="dt-buttons btn-group flex-wrap"> 
                        <div class="btn-group">
                            <button class="btn btn-secondary buttons-collection dropdown-toggle btn-label-primary me-4 waves-effect waves-light border-none" type="button" data-bs-toggle="dropdown">
                                <span><i class="ri-external-link-line me-sm-1"></i> 
                                    <span class="d-none d-sm-inline-block">@lang('dashboard.export')</span>
                                </span>
                            </button>
                            <ul class="dropdown-menu">
                                <li><a href="#" onclick="printTable()" class="dropdown-item d-flex align-items-center">
                                    <i class="ri-printer-line me-1"></i>Print</a>
                                </li>
                                <li><a href="#" onclick="exportCsv()" class="dropdown-item d-flex align-items-center">
                                    <i class="ri-file-text-line me-1"></i>Csv</a>
                                </li>
                                <li><a href="#" onclick="exportExcel()" class="dropdown-item d-flex align-items-center">
                                    <i class="ri-file-excel-line me-1"></i>Excel</a>
                                </li>
                                <li><a href="#" onclick="copyData()" class="dropdown-item d-flex align-items-center">
                                    <i class="ri-file-copy-line me-1"></i>Copy</a>
                                </li>
                            </ul>
                            </div> 
                        <a href="{{ $url }}" class="btn btn-secondary create-new btn-primary waves-effect waves-light" tabindex="0" aria-controls="DataTables_Table_0" type="button">
                            <span>
                                <i class="ri-add-line"></i> 
                                <span class="d-none d-sm-inline-block">@lang('dashboard.add')</span>
                            </span>
                        </a> 
                        </div>
                    </div>
                </div>
                <hr class="my-0">
                <div class="row">
                    <div class="col-sm-12 col-md-6">
                        <div class="dataTables_length" id="DataTables_Table_0_length">
                            <label>@lang('dashboard.show') 
                                <select id="lengthSelect" name="DataTables_Table_0_length" aria-controls="DataTables_Table_0" class="form-select form-select-sm">
                                    <option value="10" {{ Request::get('length') == 10 ? 'selected' : '' }}>10</option>
                                    <option value="25" {{ Request::get('length') == 25 ? 'selected' : '' }}>25</option>
                                    <option value="50" {{ Request::get('length') == 50 ? 'selected' : '' }}>50</option>
                                    <option value="75" {{ Request::get('length') == 75 ? 'selected' : '' }}>75</option>
                                    <option value="100" {{ Request::get('length') == 100 ? 'selected' : '' }}>100</option>
                                </select> @lang('dashboard.entries')
                            </label>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-6 d-flex justify-content-center justify-content-md-end">
                        <div id="DataTables_Table_0_filter" class="dataTables_filter">
                            <label>@lang('dashboard.search')<input type="search" id="searchInput" class="form-control form-control-sm" placeholder="" aria-controls="DataTables_Table_0">
                            </label>
                        </div>
                    </div>
                </div>
             <table class="table table-hover">
                 {{ $slot }}
             </table>
             <div class="row p-3">
                <div class="col-sm-12 col-md-6">
                    <div class="dataTables_info" role="status" aria-live="polite">
                        @lang('dashboard.showing') {{ $firstItem }} @lang('dashboard.to') {{ $lastItem }} @lang('dashboard.of') {{ $total }} @lang('dashboard.entries')
                    </div>
                </div>
                <div class="col-sm-12 col-md-6 b-white">
                    <div class="dataTables_paginate paging_simple_numbers" id="DataTables_Table_0_paginate">
                        {!! $dataTable !!}
                    </div>
                </div>
              </div>
            </div>
        </div>
     </div>
 </div>
<!-- Include SheetJS xlsx library -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.3/xlsx.full.min.js"></script>

 <script>
    
    function printTable() {
        window.print();
    }

    // Implement other export functions as per your application's requirements
    function exportCsv() {
        // Retrieve the table element
        let table = document.querySelector('.table');

        // Define an empty array to store rows of data
        let rows = [];

        // Iterate over each row in the table
        table.querySelectorAll('tr').forEach(function(row) {
            let rowData = [];

            // Iterate over each cell in the row
            row.querySelectorAll('td').forEach(function(cell) {
                // Push the text content of each cell into the rowData array
                rowData.push(cell.textContent.trim());
            });

            // Join rowData array into a CSV formatted string and push to rows array
            rows.push(rowData.join(','));
        });

        // Join rows array into a single CSV formatted string with new line characters
        let csvContent = rows.join('\n');

        // Create a blob object from the CSV content
        let blob = new Blob([csvContent], { type: 'text/csv;charset=utf-8;' });

        // Create a temporary anchor element
        let link = document.createElement('a');
        if (link.download !== undefined) { // feature detection
            // Create a URL to the blob and set it as the href attribute of the anchor element
            let url = URL.createObjectURL(blob);
            link.setAttribute('href', url);
            link.setAttribute('download', 'data.csv');
            link.style.visibility = 'hidden';
            document.body.appendChild(link);
            link.click(); // Programmatically trigger the click event to download the CSV
            document.body.removeChild(link); // Clean up - remove the anchor element from the DOM
        }
    }

    function exportExcel() {
        // Retrieve the table element
        let table = document.querySelector('.table');

        // Convert table to Excel sheet
        let wb = XLSX.utils.table_to_book(table, { sheet: "Sheet1" });

        // Generate XLSX (Excel) file
        XLSX.writeFile(wb, 'data.xlsx');
    }


    function copyData() {
        // Retrieve the table element
        let table = document.querySelector('.table');

        // Create a range object
        let range = document.createRange();

        // Select the contents of the table
        range.selectNodeContents(table);

        // Create a selection object
        let selection = window.getSelection();
        selection.removeAllRanges(); // Clear any existing selection
        selection.addRange(range); // Add range to selection

        // Copy the selected content to clipboard
        document.execCommand('copy');

        // Clean up - deselect the content
        selection.removeAllRanges();
    }

    document.addEventListener('DOMContentLoaded', function () {
        let lengthSelect = document.getElementById('lengthSelect');

        lengthSelect.addEventListener('change', function () {
            let selectedLength = this.value;
            let currentUrl = window.location.href;
            let newUrl;

            // Check if URL already contains query parameters
            if (currentUrl.includes('?')) {
                // URL has existing query parameters
                if (currentUrl.includes('length=')) {
                    // Replace existing length parameter
                    newUrl = currentUrl.replace(/(length=)[^\&]+/, '$1' + selectedLength);
                } else {
                    // Append length parameter
                    newUrl = currentUrl + '&length=' + selectedLength;
                }
            } else {
                // URL does not have query parameters
                newUrl = currentUrl + '?length=' + selectedLength;
            }

            // Navigate to the new URL
            window.location.href = newUrl;
        });
    });
    // Get the input element
    let searchInput = document.getElementById('searchInput');
  
    // Add an event listener to the input element
    searchInput.addEventListener('input', function() {
        let filter = searchInput.value.toUpperCase();
        let table = document.querySelector('.table');
        let trs = table.getElementsByTagName('tr');
  
        // Loop through all table rows, and hide those who don't match the search query
        for (let i = 0; i < trs.length; i++) {
            let tds = trs[i].getElementsByTagName('td');
            let found = false;
            for (let j = 0; j < tds.length; j++) {
                let td = tds[j];
                if (td) {
                    if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
                        found = true;
                        break;
                    }
                }
            }
            if (found) {
                trs[i].style.display = '';
            } else {
                trs[i].style.display = 'none';
            }
        }
    });
  </script>
 