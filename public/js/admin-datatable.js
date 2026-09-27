/**
 * Advanced Admin Datatable Engine for NNSRC UMRAH CMS
 * Provides reactive live search, column sorting, faceted filters, pagination,
 * density switcher, bulk selection, column visibility, client-side CSV export, and toast notifications.
 */

document.addEventListener('alpine:init', () => {
    Alpine.data('adminTable', (config = {}) => ({
        // Search & Filters
        search: '',
        categoryFilter: '',
        statusFilter: '',
        roleFilter: '',
        
        // Sorting
        sortCol: config.defaultSortCol || '',
        sortAsc: config.defaultSortAsc !== undefined ? config.defaultSortAsc : true,
        sortType: config.defaultSortType || 'text', // 'text', 'number', 'date'

        // Pagination
        pageSize: config.defaultPageSize || 10,
        currentPage: 1,

        // Display Preferences
        density: config.defaultDensity || 'comfortable', // 'comfortable' | 'compact'
        viewMode: config.defaultViewMode || 'table', // 'table' | 'grid'
        
        // Selection
        selectedIds: [],

        // Column Visibility
        visibleCols: config.columns ? config.columns.reduce((acc, col) => ({ ...acc, [col]: true }), {}) : {},
        showColDropdown: false,

        // UI State
        totalRows: 0,
        filteredCount: 0,
        allRows: [],
        filteredRowElements: [],
        
        // Toast Notification
        toast: {
            show: false,
            message: '',
            type: 'success'
        },

        init() {
            this.$nextTick(() => {
                this.indexRows();
                this.applyFilters();
            });

            // Reset to page 1 on filter changes
            this.$watch('search', () => { this.currentPage = 1; this.applyFilters(); });
            this.$watch('categoryFilter', () => { this.currentPage = 1; this.applyFilters(); });
            this.$watch('statusFilter', () => { this.currentPage = 1; this.applyFilters(); });
            this.$watch('roleFilter', () => { this.currentPage = 1; this.applyFilters(); });
            this.$watch('pageSize', () => { this.currentPage = 1; this.updatePagination(); });
            this.$watch('currentPage', () => { this.updatePagination(); });

            // Keyboard shortcut: '/' or 'Cmd/Ctrl + K' focuses search input
            window.addEventListener('keydown', (e) => {
                if ((e.key === '/' || ((e.ctrlKey || e.metaKey) && e.key === 'k')) && 
                    document.activeElement.tagName !== 'INPUT' && 
                    document.activeElement.tagName !== 'TEXTAREA') {
                    e.preventDefault();
                    const searchInput = this.$el.querySelector('input[data-table-search]');
                    if (searchInput) {
                        searchInput.focus();
                        searchInput.select();
                    }
                }
            });
        },

        // Index all row elements in the tbody
        indexRows() {
            const tbody = this.$el.querySelector('tbody[data-table-body]');
            if (!tbody) return;

            // Only index rows with data-table-row
            const rows = Array.from(tbody.querySelectorAll('tr[data-table-row]'));
            this.totalRows = rows.length;
            this.allRows = rows;
            this.filteredRowElements = [...rows];
        },

        // Apply real-time search, category, status, and role filters
        applyFilters() {
            const q = (this.search || '').trim().toLowerCase();
            const cat = (this.categoryFilter || '').trim().toLowerCase();
            const status = (this.statusFilter || '').trim().toLowerCase();
            const role = (this.roleFilter || '').trim().toLowerCase();

            const matched = [];

            this.allRows.forEach(row => {
                let isMatch = true;

                // 1. Text Search (matches row text content or data-search attribute)
                if (q) {
                    const rowSearchText = (row.dataset.search || row.innerText || '').toLowerCase();
                    if (!rowSearchText.includes(q)) {
                        isMatch = false;
                    }
                }

                // 2. Category Filter
                if (isMatch && cat) {
                    const rowCat = (row.dataset.category || '').toLowerCase();
                    if (rowCat !== cat && !rowCat.includes(cat)) {
                        isMatch = false;
                    }
                }

                // 3. Status Filter
                if (isMatch && status) {
                    const rowStatus = (row.dataset.status || '').toLowerCase();
                    if (rowStatus !== status) {
                        isMatch = false;
                    }
                }

                // 4. Role Filter
                if (isMatch && role) {
                    const rowRole = (row.dataset.role || '').toLowerCase();
                    if (rowRole !== role) {
                        isMatch = false;
                    }
                }

                if (isMatch) {
                    matched.push(row);
                }
            });

            this.filteredRowElements = matched;
            this.filteredCount = matched.length;

            // If a sort column is set, sort the filtered items
            if (this.sortCol) {
                this.sortRowsInternal();
            }

            this.updatePagination();
        },

        // Sort rows by column
        sortBy(colName, type = 'text') {
            if (this.sortCol === colName) {
                this.sortAsc = !this.sortAsc;
            } else {
                this.sortCol = colName;
                this.sortAsc = true;
            }
            this.sortType = type;
            this.sortRowsInternal();
            this.updatePagination();
        },

        sortRowsInternal() {
            if (!this.sortCol) return;
            const tbody = this.$el.querySelector('tbody[data-table-body]');
            if (!tbody) return;

            const colKey = this.sortCol;
            const isAsc = this.sortAsc;
            const type = this.sortType;

            this.filteredRowElements.sort((a, b) => {
                let valA = a.dataset[colKey] !== undefined ? a.dataset[colKey] : '';
                let valB = b.dataset[colKey] !== undefined ? b.dataset[colKey] : '';

                if (type === 'number') {
                    const numA = parseFloat(valA.toString().replace(/[^0-9.-]+/g, '')) || 0;
                    const numB = parseFloat(valB.toString().replace(/[^0-9.-]+/g, '')) || 0;
                    return isAsc ? numA - numB : numB - numA;
                } else if (type === 'date') {
                    const dateA = new Date(valA).getTime() || 0;
                    const dateB = new Date(valB).getTime() || 0;
                    return isAsc ? dateA - dateB : dateB - dateA;
                } else {
                    valA = valA.toString().toLowerCase();
                    valB = valB.toString().toLowerCase();
                    return isAsc ? valA.localeCompare(valB) : valB.localeCompare(valA);
                }
            });

            // Re-order in DOM
            this.filteredRowElements.forEach(row => {
                tbody.appendChild(row);
            });
        },

        // Update pagination visibility and empty search state
        updatePagination() {
            const tbody = this.$el.querySelector('tbody[data-table-body]');
            const noMatchRow = this.$el.querySelector('tr[data-table-nomatch]');

            if (this.filteredCount === 0) {
                this.allRows.forEach(row => { row.style.display = 'none'; });
                if (noMatchRow) noMatchRow.style.display = '';
                return;
            }

            if (noMatchRow) noMatchRow.style.display = 'none';

            const limit = parseInt(this.pageSize, 10);
            const isAll = (limit === -1 || isNaN(limit));
            const startIdx = isAll ? 0 : (this.currentPage - 1) * limit;
            const endIdx = isAll ? this.filteredCount : startIdx + limit;

            // Hide all rows first
            this.allRows.forEach(row => { row.style.display = 'none'; });

            // Show only rows in current page range
            this.filteredRowElements.forEach((row, idx) => {
                if (idx >= startIdx && idx < endIdx) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        },

        // Pagination Computed Helpers
        get totalPages() {
            const limit = parseInt(this.pageSize, 10);
            if (limit === -1 || isNaN(limit) || this.filteredCount === 0) return 1;
            return Math.ceil(this.filteredCount / limit);
        },

        get pageStart() {
            if (this.filteredCount === 0) return 0;
            const limit = parseInt(this.pageSize, 10);
            if (limit === -1 || isNaN(limit)) return 1;
            return (this.currentPage - 1) * limit + 1;
        },

        get pageEnd() {
            if (this.filteredCount === 0) return 0;
            const limit = parseInt(this.pageSize, 10);
            if (limit === -1 || isNaN(limit)) return this.filteredCount;
            return Math.min(this.currentPage * limit, this.filteredCount);
        },

        get pageNumbers() {
            const total = this.totalPages;
            const cur = this.currentPage;
            if (total <= 7) {
                return Array.from({ length: total }, (_, i) => i + 1);
            }
            if (cur <= 4) {
                return [1, 2, 3, 4, 5, '...', total];
            }
            if (cur >= total - 3) {
                return [1, '...', total - 4, total - 3, total - 2, total - 1, total];
            }
            return [1, '...', cur - 1, cur, cur + 1, '...', total];
        },

        goToPage(p) {
            if (p === '...' || p < 1 || p > this.totalPages) return;
            this.currentPage = p;
        },

        prevPage() {
            if (this.currentPage > 1) {
                this.currentPage--;
            }
        },

        nextPage() {
            if (this.currentPage < this.totalPages) {
                this.currentPage++;
            }
        },

        // Check if any filter is active
        get hasActiveFilters() {
            return Boolean(this.search || this.categoryFilter || this.statusFilter || this.roleFilter);
        },

        resetFilters() {
            this.search = '';
            this.categoryFilter = '';
            this.statusFilter = '';
            this.roleFilter = '';
            this.currentPage = 1;
            this.applyFilters();
        },

        // Selection & Bulk Actions
        get allSelected() {
            if (this.filteredCount === 0) return false;
            const visibleIds = this.getVisiblePageIds();
            return visibleIds.length > 0 && visibleIds.every(id => this.selectedIds.includes(id));
        },

        get someSelected() {
            const visibleIds = this.getVisiblePageIds();
            const selectedVisible = visibleIds.filter(id => this.selectedIds.includes(id));
            return selectedVisible.length > 0 && selectedVisible.length < visibleIds.length;
        },

        getVisiblePageIds() {
            const limit = parseInt(this.pageSize, 10);
            const isAll = (limit === -1 || isNaN(limit));
            const startIdx = isAll ? 0 : (this.currentPage - 1) * limit;
            const endIdx = isAll ? this.filteredCount : startIdx + limit;
            
            return this.filteredRowElements
                .slice(startIdx, endIdx)
                .map(r => r.dataset.id)
                .filter(Boolean);
        },

        toggleSelectAll() {
            const visibleIds = this.getVisiblePageIds();
            if (this.allSelected) {
                // Deselect current visible page IDs
                this.selectedIds = this.selectedIds.filter(id => !visibleIds.includes(id));
            } else {
                // Add all visible IDs without duplicates
                const set = new Set([...this.selectedIds, ...visibleIds]);
                this.selectedIds = Array.from(set);
            }
        },

        toggleRow(id) {
            id = id.toString();
            if (this.selectedIds.includes(id)) {
                this.selectedIds = this.selectedIds.filter(item => item !== id);
            } else {
                this.selectedIds.push(id);
            }
        },

        isSelected(id) {
            return this.selectedIds.includes(id.toString());
        },

        clearSelection() {
            this.selectedIds = [];
        },

        copySelectedIds() {
            if (this.selectedIds.length === 0) return;
            this.copyToClipboard(this.selectedIds.join(', '), 'ID Terpilih');
        },

        // Clipboard Helper
        copyToClipboard(text, label = 'Teks') {
            if (!navigator.clipboard) {
                const ta = document.createElement('textarea');
                ta.value = text;
                document.body.appendChild(ta);
                ta.select();
                document.execCommand('copy');
                document.body.removeChild(ta);
                this.showToast(`${label} berhasil disalin!`);
                return;
            }

            navigator.clipboard.writeText(text).then(() => {
                this.showToast(`${label} berhasil disalin!`);
            }).catch(() => {
                this.showToast(`Gagal menyalin ${label}`, 'error');
            });
        },

        // Toast Helper
        showToast(message, type = 'success') {
            this.toast.message = message;
            this.toast.type = type;
            this.toast.show = true;
            setTimeout(() => {
                this.toast.show = false;
            }, 2500);
        },

        // Client-side instant CSV Export
        exportCSV(filename = 'data-export.csv') {
            const table = this.$el.querySelector('table');
            if (!table) return;

            const headerCells = Array.from(table.querySelectorAll('thead tr th'));
            const exportHeaders = [];
            const validColIndexes = [];

            headerCells.forEach((th, idx) => {
                // Skip checkbox and actions column
                if (th.hasAttribute('data-no-export')) return;
                exportHeaders.push('"' + th.innerText.trim().replace(/\s+/g, ' ').replace(/"/g, '""') + '"');
                validColIndexes.push(idx);
            });

            const rows = [exportHeaders.join(',')];

            // Export all currently filtered items (not just current page)
            this.filteredRowElements.forEach(tr => {
                const cells = Array.from(tr.querySelectorAll('td'));
                const rowData = [];
                validColIndexes.forEach(idx => {
                    const td = cells[idx];
                    let text = td ? (td.dataset.exportValue || td.innerText || '') : '';
                    text = text.trim().replace(/\s+/g, ' ').replace(/"/g, '""');
                    rowData.push('"' + text + '"');
                });
                if (rowData.length > 0) {
                    rows.push(rowData.join(','));
                }
            });

            // Prepend UTF-8 BOM so Excel opens accented characters seamlessly
            const blob = new Blob(['\uFEFF' + rows.join('\r\n')], { type: 'text/csv;charset=utf-8;' });
            const url = URL.createObjectURL(blob);
            const a = document.createElement('a');
            a.href = url;
            a.download = filename;
            document.body.appendChild(a);
            a.click();
            document.body.removeChild(a);
            URL.revokeObjectURL(url);

            this.showToast(`Berhasil mengekspor ${this.filteredRowElements.length} data ke CSV!`);
        },

        // Clean Print
        printTable() {
            window.print();
        }
    }));
});

