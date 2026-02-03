document.addEventListener('DOMContentLoaded', function() {
    // Data dummy karyawan
    const karyawanData = {
        id: "KRY-001",
        nama: "Rudi Hartono",
        jabatan: "Karyawan Lapangan",
        bank: "BCA",
        noRekening: "123-456-7890"
    };
    
    // Data dummy slip gaji
    let slipGajiData = [
        {
            id: 1,
            id_user: "KRY-001",
            periode_gaji: "Maret 2024",
            periode_tahun: "2024",
            periode_bulan: "03",
            upah_dasar: 4500000,
            insentif: 750000,
            potongan: 320000,
            status_pembayaran: "dibayar",
            tanggal_transfer: "2024-03-30",
            komponen_insentif: [
                { nama: "Insentif Panen", jumlah: 500000 },
                { nama: "Tunjangan Makan", jumlah: 150000 },
                { nama: "Bonus Kehadiran", jumlah: 100000 }
            ],
            komponen_potongan: [
                { nama: "BPJS Kesehatan", jumlah: 150000 },
                { nama: "BPJS Ketenagakerjaan", jumlah: 100000 },
                { nama: "Pinjaman Koperasi", jumlah: 70000 }
            ],
            catatan: "Gaji dibayarkan tepat waktu. Terima kasih atas kerja kerasnya."
        },
        {
            id: 2,
            id_user: "KRY-001",
            periode_gaji: "Februari 2024",
            periode_tahun: "2024",
            periode_bulan: "02",
            upah_dasar: 4500000,
            insentif: 650000,
            potongan: 300000,
            status_pembayaran: "dibayar",
            tanggal_transfer: "2024-02-28",
            komponen_insentif: [
                { nama: "Insentif Panen", jumlah: 400000 },
                { nama: "Tunjangan Makan", jumlah: 150000 },
                { nama: "Bonus Kehadiran", jumlah: 100000 }
            ],
            komponen_potongan: [
                { nama: "BPJS Kesehatan", jumlah: 150000 },
                { nama: "BPJS Ketenagakerjaan", jumlah: 100000 },
                { nama: "Pinjaman Koperasi", jumlah: 50000 }
            ],
            catatan: "Pembayaran sesuai dengan periode kerja"
        },
        {
            id: 3,
            id_user: "KRY-001",
            periode_gaji: "Januari 2024",
            periode_tahun: "2024",
            periode_bulan: "01",
            upah_dasar: 4500000,
            insentif: 850000,
            potongan: 350000,
            status_pembayaran: "dibayar",
            tanggal_transfer: "2024-01-31",
            komponen_insentif: [
                { nama: "Insentif Panen", jumlah: 600000 },
                { nama: "Tunjangan Makan", jumlah: 150000 },
                { nama: "Bonus Kehadiran", jumlah: 100000 }
            ],
            komponen_potongan: [
                { nama: "BPJS Kesehatan", jumlah: 150000 },
                { nama: "BPJS Ketenagakerjaan", jumlah: 100000 },
                { nama: "Pinjaman Koperasi", jumlah: 100000 }
            ],
            catatan: "Terdapat bonus tambahan karena hasil panen melimpah"
        },
        {
            id: 4,
            id_user: "KRY-001",
            periode_gaji: "Desember 2023",
            periode_tahun: "2023",
            periode_bulan: "12",
            upah_dasar: 4500000,
            insentif: 1200000,
            potongan: 400000,
            status_pembayaran: "dibayar",
            tanggal_transfer: "2023-12-29",
            komponen_insentif: [
                { nama: "Insentif Panen", jumlah: 800000 },
                { nama: "Tunjangan Makan", jumlah: 150000 },
                { nama: "Bonus Kehadiran", jumlah: 100000 },
                { nama: "Bonus Akhir Tahun", jumlah: 150000 }
            ],
            komponen_potongan: [
                { nama: "BPJS Kesehatan", jumlah: 150000 },
                { nama: "BPJS Ketenagakerjaan", jumlah: 100000 },
                { nama: "Pinjaman Koperasi", jumlah: 80000 },
                { nama: "Pajak PPh 21", jumlah: 70000 }
            ],
            catatan: "Termasuk bonus akhir tahun. Selamat tahun baru!"
        },
        {
            id: 5,
            id_user: "KRY-001",
            periode_gaji: "November 2023",
            periode_tahun: "2023",
            periode_bulan: "11",
            upah_dasar: 4500000,
            insentif: 550000,
            potongan: 280000,
            status_pembayaran: "dibayar",
            tanggal_transfer: "2023-11-30",
            komponen_insentif: [
                { nama: "Insentif Panen", jumlah: 300000 },
                { nama: "Tunjangan Makan", jumlah: 150000 },
                { nama: "Bonus Kehadiran", jumlah: 100000 }
            ],
            komponen_potongan: [
                { nama: "BPJS Kesehatan", jumlah: 150000 },
                { nama: "BPJS Ketenagakerjaan", jumlah: 100000 },
                { nama: "Pinjaman Koperasi", jumlah: 30000 }
            ],
            catatan: "Pembayaran sesuai periode"
        },
        {
            id: 6,
            id_user: "KRY-001",
            periode_gaji: "April 2024",
            periode_tahun: "2024",
            periode_bulan: "04",
            upah_dasar: 4500000,
            insentif: 800000,
            potongan: 320000,
            status_pembayaran: "belum",
            tanggal_transfer: "",
            komponen_insentif: [
                { nama: "Insentif Panen", jumlah: 550000 },
                { nama: "Tunjangan Makan", jumlah: 150000 },
                { nama: "Bonus Kehadiran", jumlah: 100000 }
            ],
            komponen_potongan: [
                { nama: "BPJS Kesehatan", jumlah: 150000 },
                { nama: "BPJS Ketenagakerjaan", jumlah: 100000 },
                { nama: "Pinjaman Koperasi", jumlah: 70000 }
            ],
            catatan: "Gaji akan dibayarkan tanggal 30 April 2024"
        }
    ];
    
    // Elemen DOM
    const printBtn = document.getElementById('printBtn');
    const applyFilterBtn = document.getElementById('applyFilterBtn');
    const filterTahun = document.getElementById('filterTahun');
    const filterBulan = document.getElementById('filterBulan');
    const filterStatus = document.getElementById('filterStatus');
    const slipTableBody = document.getElementById('slipTableBody');
    const detailModal = document.getElementById('detailModal');
    const detailModalBody = document.getElementById('detailModalBody');
    const printDetailBtn = document.getElementById('printDetailBtn');
    
    // Info karyawan
    document.getElementById('namaKaryawan').textContent = karyawanData.nama;
    document.getElementById('idKaryawan').textContent = `ID: ${karyawanData.id}`;
    document.getElementById('jabatan').textContent = karyawanData.jabatan;
    document.getElementById('bank').textContent = karyawanData.bank;
    document.getElementById('noRekening').textContent = karyawanData.noRekening;
    
    // State
    let currentPage = 1;
    const itemsPerPage = 5;
    let currentFilter = {
        tahun: '2024',
        bulan: '',
        status: ''
    };
    
    // Initialize
    loadSlipTable();
    
    // Apply filter
    applyFilterBtn.addEventListener('click', function() {
        currentFilter = {
            tahun: filterTahun.value,
            bulan: filterBulan.value,
            status: filterStatus.value
        };
        
        currentPage = 1;
        loadSlipTable();
    });
    
    // Load slip table
    function loadSlipTable() {
        slipTableBody.innerHTML = '';
        
        const filteredData = filterData(slipGajiData);
        const startIndex = (currentPage - 1) * itemsPerPage;
        const endIndex = startIndex + itemsPerPage;
        const pageData = filteredData.slice(startIndex, endIndex);
        
        if (pageData.length === 0) {
            slipTableBody.innerHTML = `
                <tr>
                    <td colspan="8" style="text-align: center; padding: 40px; color: var(--text-light);">
                        <i class="fas fa-file-invoice-dollar" style="font-size: 40px; margin-bottom: 10px; opacity: 0.5; display: block;"></i>
                        <div>Tidak ada data slip gaji</div>
                    </td>
                </tr>
            `;
        } else {
            pageData.forEach((slip, index) => {
                const globalIndex = startIndex + index + 1;
                const row = document.createElement('tr');
                
                // Hitung take home pay
                const takeHomePay = slip.upah_dasar + slip.insentif - slip.potongan;
                
                // Format currency
                const formatCurrency = (amount) => {
                    return 'Rp ' + amount.toLocaleString('id-ID');
                };
                
                row.innerHTML = `
                    <td style="color: var(--text-light);">${globalIndex}</td>
                    <td style="font-weight: 600; color: var(--text-dark);">
                        ${slip.periode_gaji}
                    </td>
                    <td class="amount-positive">${formatCurrency(slip.upah_dasar)}</td>
                    <td class="amount-positive">${formatCurrency(slip.insentif)}</td>
                    <td class="amount-negative">${formatCurrency(slip.potongan)}</td>
                    <td class="amount-total">${formatCurrency(takeHomePay)}</td>
                    <td>
                        <span class="status-badge badge-${slip.status_pembayaran}">
                            ${getStatusLabel(slip.status_pembayaran)}
                        </span>
                    </td>
                    <td>
                        <div class="action-buttons">
                            <button type="button" class="btn-action btn-view" data-id="${slip.id}" title="Lihat Detail">
                                <i class="fas fa-eye"></i>
                            </button>
                        </div>
                    </td>
                `;
                
                slipTableBody.appendChild(row);
            });
        }
        
        // Update counts
        document.getElementById('showingCount').textContent = pageData.length;
        document.getElementById('totalCount').textContent = filteredData.length;
        
        // Update pagination
        updatePagination(filteredData.length);
        
        // Add event listeners
        addActionListeners();
    }
    
    // Filter data
    function filterData(data) {
        return data.filter(item => {
            // Filter tahun
            if (currentFilter.tahun && item.periode_tahun !== currentFilter.tahun) return false;
            
            // Filter bulan
            if (currentFilter.bulan && item.periode_bulan !== currentFilter.bulan) return false;
            
            // Filter status
            if (currentFilter.status) {
                if (currentFilter.status === 'dibayar' && item.status_pembayaran !== 'dibayar') return false;
                if (currentFilter.status === 'belum' && item.status_pembayaran !== 'belum') return false;
            }
            
            return true;
        });
    }
    
    // Update pagination
    function updatePagination(totalItems) {
        const totalPages = Math.ceil(totalItems / itemsPerPage);
        const pageNumbers = document.getElementById('pageNumbers');
        pageNumbers.innerHTML = '';
        
        document.getElementById('currentPage').textContent = currentPage;
        document.getElementById('totalPages').textContent = totalPages;
        
        // Show max 5 page numbers
        let startPage = Math.max(1, currentPage - 2);
        let endPage = Math.min(totalPages, startPage + 4);
        
        if (endPage - startPage < 4) {
            startPage = Math.max(1, endPage - 4);
        }
        
        for (let i = startPage; i <= endPage; i++) {
            const pageNumber = document.createElement('button');
            pageNumber.type = 'button';
            pageNumber.className = `page-number ${i === currentPage ? 'active' : ''}`;
            pageNumber.textContent = i;
            pageNumber.addEventListener('click', function() {
                currentPage = i;
                loadSlipTable();
            });
            pageNumbers.appendChild(pageNumber);
        }
        
        const prevBtn = document.querySelector('.btn-pagination.prev');
        const nextBtn = document.querySelector('.btn-pagination.next');
        
        prevBtn.disabled = currentPage === 1;
        nextBtn.disabled = currentPage === totalPages;
        prevBtn.style.opacity = currentPage === 1 ? '0.5' : '1';
        nextBtn.style.opacity = currentPage === totalPages ? '0.5' : '1';
    }
    
    // Add action listeners
    function addActionListeners() {
        // View buttons
        document.querySelectorAll('.btn-action.btn-view').forEach(btn => {
            btn.addEventListener('click', function() {
                const slipId = parseInt(this.dataset.id);
                const slip = slipGajiData.find(s => s.id === slipId);
                if (slip) {
                    showDetailModal(slip);
                }
            });
        });
    }
    
    // Show detail modal
    function showDetailModal(slip) {
        // Hitung total
        const takeHomePay = slip.upah_dasar + slip.insentif - slip.potongan;
        
        // Format currency
        const formatCurrency = (amount) => {
            return 'Rp ' + amount.toLocaleString('id-ID');
        };
        
        // Format tanggal transfer
        const formatDate = (dateString) => {
            if (!dateString) return '-';
            const date = new Date(dateString);
            return date.toLocaleDateString('id-ID', {
                day: 'numeric',
                month: 'long',
                year: 'numeric'
            });
        };
        
        // Buat list insentif
        const insentifList = slip.komponen_insentif.map(item => `
            <tr>
                <td class="item-label">${item.nama}</td>
                <td class="item-amount amount-positive">${formatCurrency(item.jumlah)}</td>
            </tr>
        `).join('');
        
        // Buat list potongan
        const potonganList = slip.komponen_potongan.map(item => `
            <tr>
                <td class="item-label">${item.nama}</td>
                <td class="item-amount amount-negative">${formatCurrency(item.jumlah)}</td>
            </tr>
        `).join('');
        
        detailModalBody.innerHTML = `
            <div class="slip-header">
                <div class="company-name">PT. Mardua Holong</div>
                <div style="font-size: 14px; color: var(--text-light); margin-bottom: 10px;">
                    Perkebunan Jeruk Terpadu
                </div>
                <h2 class="slip-title">SLIP GAJI KARYAWAN</h2>
            </div>
            
            <div class="slip-info">
                <div>
                    <div class="info-row">
                        <span class="info-label">Nama Karyawan</span>
                        <span class="info-value">${karyawanData.nama}</span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">ID Karyawan</span>
                        <span class="info-value">${slip.id_user}</span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">Jabatan</span>
                        <span class="info-value">${karyawanData.jabatan}</span>
                    </div>
                </div>
                <div>
                    <div class="info-row">
                        <span class="info-label">Periode Gaji</span>
                        <span class="info-value">${slip.periode_gaji}</span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">Status Pembayaran</span>
                        <span class="info-value">
                            <span class="status-badge badge-${slip.status_pembayaran}">
                                ${getStatusLabel(slip.status_pembayaran)}
                            </span>
                        </span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">Tanggal Transfer</span>
                        <span class="info-value">${formatDate(slip.tanggal_transfer)}</span>
                    </div>
                </div>
            </div>
            
            <div class="earnings-section">
                <div class="section-title">
                    <i class="fas fa-plus-circle"></i>
                    <span>Pendapatan</span>
                </div>
                <table class="earnings-table">
                    ${insentifList}
                    <tr>
                        <td class="item-label">Total Insentif</td>
                        <td class="item-amount amount-positive total-row">${formatCurrency(slip.insentif)}</td>
                    </tr>
                    <tr>
                        <td class="item-label">Gaji Pokok</td>
                        <td class="item-amount amount-positive">${formatCurrency(slip.upah_dasar)}</td>
                    </tr>
                </table>
            </div>
            
            <div class="deductions-section">
                <div class="section-title">
                    <i class="fas fa-minus-circle"></i>
                    <span>Potongan</span>
                </div>
                <table class="deductions-table">
                    ${potonganList}
                    <tr>
                        <td class="item-label">Total Potongan</td>
                        <td class="item-amount amount-negative total-row">${formatCurrency(slip.potongan)}</td>
                    </tr>
                </table>
            </div>
            
            <div class="summary-section">
                <div class="section-title">
                    <i class="fas fa-calculator"></i>
                    <span>Ringkasan</span>
                </div>
                <div class="summary-grid">
                    <div class="summary-card">
                        <div class="summary-label">Gaji Pokok</div>
                        <div class="summary-value">${formatCurrency(slip.upah_dasar)}</div>
                    </div>
                    <div class="summary-card">
                        <div class="summary-label">Total Insentif</div>
                        <div class="summary-value">${formatCurrency(slip.insentif)}</div>
                    </div>
                    <div class="summary-card">
                        <div class="summary-label">Total Potongan</div>
                        <div class="summary-value">${formatCurrency(slip.potongan)}</div>
                    </div>
                    <div class="summary-card total">
                        <div class="summary-label">Take Home Pay</div>
                        <div class="summary-value">${formatCurrency(takeHomePay)}</div>
                    </div>
                </div>
            </div>
            
            <div class="payment-info">
                <div class="payment-status">
                    <span class="status-badge badge-${slip.status_pembayaran}">
                        ${getStatusLabel(slip.status_pembayaran)}
                    </span>
                    ${slip.status_pembayaran === 'dibayar' ? 
                        `<span><i class="fas fa-check-circle" style="color: #4CAF50;"></i> Sudah ditransfer</span>` :
                        `<span><i class="fas fa-clock" style="color: #FF9800;"></i> Menunggu pembayaran</span>`
                    }
                </div>
                <div class="payment-details">
                    <div>
                        <div class="info-label">Bank</div>
                        <div class="info-value">${karyawanData.bank}</div>
                    </div>
                    <div>
                        <div class="info-label">No. Rekening</div>
                        <div class="info-value">${karyawanData.noRekening}</div>
                    </div>
                    <div>
                        <div class="info-label">Tanggal Transfer</div>
                        <div class="info-value">${formatDate(slip.tanggal_transfer)}</div>
                    </div>
                </div>
            </div>
            
            ${slip.catatan ? `
            <div class="note-box">
                <i class="fas fa-info-circle"></i>
                <strong>Catatan:</strong> ${slip.catatan}
            </div>
            ` : ''}
            
            <div style="margin-top: 30px; text-align: center; font-size: 12px; color: var(--text-light);">
                <div style="border-top: 1px solid var(--border); padding-top: 15px;">
                    Slip gaji ini sah dan telah diverifikasi oleh Departemen HRD PT. Mardua Holong
                </div>
            </div>
        `;
        
        detailModal.style.display = 'flex';
        document.body.style.overflow = 'hidden';
    }
    
    // Print detail slip
    printDetailBtn.addEventListener('click', function() {
        const printContent = detailModalBody.innerHTML;
        const originalContent = document.body.innerHTML;
        
        document.body.innerHTML = `
            <!DOCTYPE html>
            <html>
            <head>
                <title>Slip Gaji - ${karyawanData.nama}</title>
                <style>
                    body { font-family: Arial, sans-serif; padding: 20px; }
                    .print-header { text-align: center; margin-bottom: 30px; }
                    .company-name { font-size: 24px; font-weight: bold; color: #2D6A4F; }
                    .slip-title { font-size: 20px; font-weight: 600; margin: 20px 0; }
                    .info-row { display: flex; justify-content: space-between; padding: 5px 0; }
                    .section-title { font-size: 16px; font-weight: 600; margin: 20px 0 10px; border-bottom: 1px solid #ddd; padding-bottom: 5px; }
                    table { width: 100%; border-collapse: collapse; margin: 10px 0; }
                    td { padding: 5px 0; border-bottom: 1px solid #eee; }
                    .total-row { font-weight: bold; }
                    .summary-grid { display: grid; grid-template-columns: repeat(2, 1fr); gap: 15px; margin: 20px 0; }
                    .summary-card { padding: 15px; border: 1px solid #ddd; border-radius: 5px; text-align: center; }
                    .summary-card.total { border: 2px solid #2D6A4F; background-color: #f0f9f4; }
                    .payment-info { background-color: #f8f9fa; padding: 15px; border-radius: 5px; margin: 20px 0; }
                    @media print {
                        body { padding: 0; }
                        .no-print { display: none; }
                    }
                </style>
            </head>
            <body>
                ${printContent}
                <div class="no-print" style="text-align: center; margin-top: 30px;">
                    <button onclick="window.print()" style="padding: 10px 20px; background-color: #2D6A4F; color: white; border: none; border-radius: 5px; cursor: pointer;">
                        Cetak Slip
                    </button>
                    <button onclick="window.close()" style="padding: 10px 20px; background-color: #6c757d; color: white; border: none; border-radius: 5px; cursor: pointer; margin-left: 10px;">
                        Tutup
                    </button>
                </div>
            </body>
            </html>
        `;
        
        window.print();
        document.body.innerHTML = originalContent;
        location.reload();
    });
    
    // Close detail modal
    document.querySelector('.close-detail-modal').addEventListener('click', function() {
        detailModal.style.display = 'none';
        document.body.style.overflow = 'auto';
    });
    
    document.querySelector('.modal-footer .btn-secondary').addEventListener('click', function() {
        detailModal.style.display = 'none';
        document.body.style.overflow = 'auto';
    });
    
    detailModal.addEventListener('click', function(e) {
        if (e.target === detailModal) {
            detailModal.style.display = 'none';
            document.body.style.overflow = 'auto';
        }
    });
    
    // Print button (main)
    printBtn.addEventListener('click', function() {
        if (window.print) {
            window.print();
        } else {
            alert('Fitur print tidak tersedia di browser ini.');
        }
    });
    
    // Pagination buttons
    document.querySelector('.btn-pagination.prev').addEventListener('click', function() {
        if (currentPage > 1) {
            currentPage--;
            loadSlipTable();
        }
    });
    
    document.querySelector('.btn-pagination.next').addEventListener('click', function() {
        const filteredData = filterData(slipGajiData);
        const totalPages = Math.ceil(filteredData.length / itemsPerPage);
        
        if (currentPage < totalPages) {
            currentPage++;
            loadSlipTable();
        }
    });
    
    // Helper functions
    function getStatusLabel(status) {
        switch(status) {
            case 'dibayar': return 'Dibayar';
            case 'belum': return 'Belum Dibayar';
            default: return status;
        }
    }
});