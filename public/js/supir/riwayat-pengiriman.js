document.addEventListener('DOMContentLoaded', function() {
    // Data dummy supir (sama dengan sebelumnya)
    const supirData = {
        id: "SUP-001",
        nama: "Kelompok 2"
    };
    
    // Data dummy riwayat pengiriman (lebih banyak data selesai)
    let riwayatData = [
        {
            id: 1,
            kode_pengiriman: "PGN-2024-001",
            supir_id: "SUP-001",
            tanggal_kirim: "2024-03-15",
            tanggal_kirim_formatted: "15 Maret 2024",
            waktu_kirim: "08:00",
            waktu_selesai: "12:30",
            kendaraan: {
                jenis: "Truk Box",
                plat_nomor: "B 1234 ABC",
                kapasitas: "8 Ton"
            },
            tujuan_akhir: "Toko Utama - Jakarta",
            alamat_tujuan: "Jl. Sudirman No. 123, Jakarta Pusat",
            jarak_tempuh: 45.5, // km
            durasi_jam: 4.5,
            durasi_formatted: "4 jam 30 menit",
            status: "selesai",
            catatan: "Pengiriman lancar, barang diterima dengan baik",
            estimasi_tiba: "2024-03-15T12:00",
            actual_tiba: "2024-03-15T12:30",
            muatan: [
                { nama: "Jeruk Medan", jumlah: 100, satuan: "kg" },
                { nama: "Jeruk Sunkist", jumlah: 50, satuan: "kg" }
            ],
            total_muatan: 150,
            log_tracking: [
                {
                    id: 1,
                    timestamp_log: "2024-03-15 07:00:00",
                    koordinat_gps: "-6.2088,106.8456",
                    status: "loading_barang",
                    note: "Memuat barang di gudang",
                    location_description: "Gudang Utama PT. Mardua Holong"
                },
                {
                    id: 2,
                    timestamp_log: "2024-03-15 08:00:00",
                    koordinat_gps: "-6.2088,106.8456",
                    status: "berangkat",
                    note: "Berangkat dari gudang",
                    location_description: "Gudang Utama"
                },
                {
                    id: 3,
                    timestamp_log: "2024-03-15 09:30:00",
                    koordinat_gps: "-6.2349,106.8090",
                    status: "dalam_perjalanan",
                    note: "Sedang dalam perjalanan",
                    location_description: "Tol Jakarta-Cikampek KM 45"
                },
                {
                    id: 4,
                    timestamp_log: "2024-03-15 11:45:00",
                    koordinat_gps: "-6.2088,106.8456",
                    status: "tiba_ditujuan",
                    note: "Tiba di lokasi tujuan",
                    location_description: "Parkiran Toko Utama"
                },
                {
                    id: 5,
                    timestamp_log: "2024-03-15 12:30:00",
                    koordinat_gps: "-6.2088,106.8456",
                    status: "selesai",
                    note: "Pengiriman selesai, semua barang diterima",
                    location_description: "Toko Utama Jakarta"
                }
            ]
        },
        {
            id: 2,
            kode_pengiriman: "PGN-2024-003",
            supir_id: "SUP-001",
            tanggal_kirim: "2024-03-14",
            tanggal_kirim_formatted: "14 Maret 2024",
            waktu_kirim: "09:00",
            waktu_selesai: "17:00",
            kendaraan: {
                jenis: "Truk Box Besar",
                plat_nomor: "B 9012 DEF",
                kapasitas: "12 Ton"
            },
            tujuan_akhir: "Toko Pusat - Surabaya",
            alamat_tujuan: "Jl. Tunjungan No. 1, Surabaya",
            jarak_tempuh: 750, // km
            durasi_jam: 8,
            durasi_formatted: "8 jam",
            status: "selesai",
            catatan: "Pengiriman sukses, pelanggan puas",
            estimasi_tiba: "2024-03-14T13:00",
            actual_tiba: "2024-03-14T17:00",
            muatan: [
                { nama: "Jeruk Medan", jumlah: 200, satuan: "kg" },
                { nama: "Jeruk Sunkist", jumlah: 100, satuan: "kg" },
                { nama: "Jeruk Bali", jumlah: 150, satuan: "kg" }
            ],
            total_muatan: 450,
            log_tracking: [
                {
                    id: 1,
                    timestamp_log: "2024-03-14 08:00:00",
                    koordinat_gps: "-6.2088,106.8456",
                    status: "loading_barang",
                    note: "Loading barang",
                    location_description: "Gudang Utama"
                },
                {
                    id: 2,
                    timestamp_log: "2024-03-14 09:00:00",
                    koordinat_gps: "-6.2088,106.8456",
                    status: "berangkat",
                    note: "Berangkat menuju Surabaya",
                    location_description: "Gudang Utama"
                },
                {
                    id: 3,
                    timestamp_log: "2024-03-14 12:00:00",
                    koordinat_gps: "-6.9778,110.4081",
                    status: "dalam_perjalanan",
                    note: "Istirahat di Semarang",
                    location_description: "Rest Area Semarang"
                },
                {
                    id: 4,
                    timestamp_log: "2024-03-14 15:00:00",
                    koordinat_gps: "-7.2575,112.7521",
                    status: "tiba_ditujuan",
                    note: "Tiba di lokasi tujuan",
                    location_description: "Parkiran Toko Pusat"
                },
                {
                    id: 5,
                    timestamp_log: "2024-03-14 16:00:00",
                    koordinat_gps: "-7.2575,112.7521",
                    status: "unloading",
                    note: "Proses unloading",
                    location_description: "Toko Pusat Surabaya"
                },
                {
                    id: 6,
                    timestamp_log: "2024-03-14 17:00:00",
                    koordinat_gps: "-7.2575,112.7521",
                    status: "selesai",
                    note: "Pengiriman selesai, barang diterima",
                    location_description: "Toko Pusat Surabaya"
                }
            ]
        },
        {
            id: 3,
            kode_pengiriman: "PGN-2024-005",
            supir_id: "SUP-001",
            tanggal_kirim: "2024-03-10",
            tanggal_kirim_formatted: "10 Maret 2024",
            waktu_kirim: "07:00",
            waktu_selesai: "10:30",
            kendaraan: {
                jenis: "Pickup",
                plat_nomor: "B 5678 XYZ",
                kapasitas: "2 Ton"
            },
            tujuan_akhir: "Pasar Induk - Bandung",
            alamat_tujuan: "Jl. Astana Anyar No. 100, Bandung",
            jarak_tempuh: 140, // km
            durasi_jam: 3.5,
            durasi_formatted: "3 jam 30 menit",
            status: "selesai",
            catatan: "Barang sampai tepat waktu",
            estimasi_tiba: "2024-03-10T10:30",
            actual_tiba: "2024-03-10T10:30",
            muatan: [
                { nama: "Jeruk Bali", jumlah: 80, satuan: "kg" },
                { nama: "Jeruk Medan", jumlah: 70, satuan: "kg" }
            ],
            total_muatan: 150,
            log_tracking: [
                {
                    id: 1,
                    timestamp_log: "2024-03-10 06:30:00",
                    koordinat_gps: "-6.2088,106.8456",
                    status: "loading_barang",
                    note: "Loading barang",
                    location_description: "Gudang Packing"
                },
                {
                    id: 2,
                    timestamp_log: "2024-03-10 07:00:00",
                    koordinat_gps: "-6.2088,106.8456",
                    status: "berangkat",
                    note: "Berangkat ke Bandung",
                    location_description: "Gudang Utama"
                },
                {
                    id: 3,
                    timestamp_log: "2024-03-10 09:00:00",
                    koordinat_gps: "-6.9175,107.6191",
                    status: "dalam_perjalanan",
                    note: "Sedang dalam perjalanan",
                    location_description: "Tol Pasteur KM 12"
                },
                {
                    id: 4,
                    timestamp_log: "2024-03-10 10:15:00",
                    koordinat_gps: "-6.9272,107.6045",
                    status: "tiba_ditujuan",
                    note: "Tiba di pasar",
                    location_description: "Pasar Induk Bandung"
                },
                {
                    id: 5,
                    timestamp_log: "2024-03-10 10:30:00",
                    koordinat_gps: "-6.9272,107.6045",
                    status: "selesai",
                    note: "Pengiriman selesai",
                    location_description: "Pasar Induk Bandung"
                }
            ]
        },
        {
            id: 4,
            kode_pengiriman: "PGN-2024-007",
            supir_id: "SUP-001",
            tanggal_kirim: "2024-03-05",
            tanggal_kirim_formatted: "5 Maret 2024",
            waktu_kirim: "10:00",
            waktu_selesai: "14:45",
            kendaraan: {
                jenis: "Truk Box",
                plat_nomor: "B 1234 ABC",
                kapasitas: "8 Ton"
            },
            tujuan_akhir: "Supermarket Central - Tangerang",
            alamat_tujuan: "Jl. MH. Thamrin No. 50, Tangerang",
            jarak_tempuh: 35, // km
            durasi_jam: 4.75,
            durasi_formatted: "4 jam 45 menit",
            status: "selesai",
            catatan: "Macet di tol, terlambat 45 menit",
            estimasi_tiba: "2024-03-05T14:00",
            actual_tiba: "2024-03-05T14:45",
            muatan: [
                { nama: "Jeruk Sunkist", jumlah: 120, satuan: "kg" },
                { nama: "Jeruk Medan", jumlah: 180, satuan: "kg" }
            ],
            total_muatan: 300,
            log_tracking: [
                {
                    id: 1,
                    timestamp_log: "2024-03-05 09:00:00",
                    koordinat_gps: "-6.2088,106.8456",
                    status: "loading_barang",
                    note: "Loading barang",
                    location_description: "Gudang Utama"
                },
                {
                    id: 2,
                    timestamp_log: "2024-03-05 10:00:00",
                    koordinat_gps: "-6.2088,106.8456",
                    status: "berangkat",
                    note: "Berangkat ke Tangerang",
                    location_description: "Gudang Utama"
                },
                {
                    id: 3,
                    timestamp_log: "2024-03-05 12:30:00",
                    koordinat_gps: "-6.1781,106.6300",
                    status: "dalam_perjalanan",
                    note: "Macet di tol",
                    location_description: "Tol Jakarta-Merak KM 15"
                },
                {
                    id: 4,
                    timestamp_log: "2024-03-05 14:30:00",
                    koordinat_gps: "-6.1781,106.6300",
                    status: "tiba_ditujuan",
                    note: "Tiba di supermarket",
                    location_description: "Parkiran Supermarket"
                },
                {
                    id: 5,
                    timestamp_log: "2024-03-05 14:45:00",
                    koordinat_gps: "-6.1781,106.6300",
                    status: "selesai",
                    note: "Pengiriman selesai",
                    location_description: "Supermarket Central"
                }
            ]
        },
        {
            id: 5,
            kode_pengiriman: "PGN-2024-010",
            supir_id: "SUP-001",
            tanggal_kirim: "2024-03-01",
            tanggal_kirim_formatted: "1 Maret 2024",
            waktu_kirim: "06:00",
            waktu_selesai: "09:15",
            kendaraan: {
                jenis: "Pickup",
                plat_nomor: "B 5678 XYZ",
                kapasitas: "2 Ton"
            },
            tujuan_akhir: "Toko Cabang - Bogor",
            alamat_tujuan: "Jl. Suryakencana No. 25, Bogor",
            jarak_tempuh: 60, // km
            durasi_jam: 3.25,
            durasi_formatted: "3 jam 15 menit",
            status: "selesai",
            catatan: "Pengiriman cepat, cuaca cerah",
            estimasi_tiba: "2024-03-01T09:00",
            actual_tiba: "2024-03-01T09:15",
            muatan: [
                { nama: "Jeruk Bali", jumlah: 60, satuan: "kg" },
                { nama: "Jeruk Sunkist", jumlah: 40, satuan: "kg" }
            ],
            total_muatan: 100,
            log_tracking: [
                {
                    id: 1,
                    timestamp_log: "2024-03-01 05:30:00",
                    koordinat_gps: "-6.2088,106.8456",
                    status: "loading_barang",
                    note: "Loading pagi",
                    location_description: "Gudang Packing"
                },
                {
                    id: 2,
                    timestamp_log: "2024-03-01 06:00:00",
                    koordinat_gps: "-6.2088,106.8456",
                    status: "berangkat",
                    note: "Berangkat ke Bogor",
                    location_description: "Gudang Utama"
                },
                {
                    id: 3,
                    timestamp_log: "2024-03-01 08:00:00",
                    koordinat_gps: "-6.5971,106.8060",
                    status: "dalam_perjalanan",
                    note: "Menuju Bogor",
                    location_description: "Jl. Raya Bogor"
                },
                {
                    id: 4,
                    timestamp_log: "2024-03-01 09:00:00",
                    koordinat_gps: "-6.5971,106.8060",
                    status: "tiba_ditujuan",
                    note: "Tiba di toko",
                    location_description: "Toko Cabang Bogor"
                },
                {
                    id: 5,
                    timestamp_log: "2024-03-01 09:15:00",
                    koordinat_gps: "-6.5971,106.8060",
                    status: "selesai",
                    note: "Pengiriman selesai",
                    location_description: "Toko Cabang Bogor"
                }
            ]
        },
        {
            id: 6,
            kode_pengiriman: "PGN-2024-015",
            supir_id: "SUP-001",
            tanggal_kirim: "2024-02-25",
            tanggal_kirim_formatted: "25 Februari 2024",
            waktu_kirim: "08:30",
            waktu_selesai: "16:00",
            kendaraan: {
                jenis: "Truk Box Besar",
                plat_nomor: "B 9012 DEF",
                kapasitas: "12 Ton"
            },
            tujuan_akhir: "Gudang Distribusi - Semarang",
            alamat_tujuan: "Jl. Kaligarang No. 10, Semarang",
            jarak_tempuh: 450, // km
            durasi_jam: 7.5,
            durasi_formatted: "7 jam 30 menit",
            status: "dibatalkan",
            catatan: "Dibatalkan karena kendaraan rusak",
            estimasi_tiba: "2024-02-25T16:00",
            actual_tiba: null,
            muatan: [
                { nama: "Jeruk Medan", jumlah: 300, satuan: "kg" },
                { nama: "Jeruk Bali", jumlah: 200, satuan: "kg" }
            ],
            total_muatan: 500,
            log_tracking: [
                {
                    id: 1,
                    timestamp_log: "2024-02-25 07:30:00",
                    koordinat_gps: "-6.2088,106.8456",
                    status: "loading_barang",
                    note: "Loading barang",
                    location_description: "Gudang Utama"
                },
                {
                    id: 2,
                    timestamp_log: "2024-02-25 08:30:00",
                    koordinat_gps: "-6.2088,106.8456",
                    status: "berangkat",
                    note: "Berangkat ke Semarang",
                    location_description: "Gudang Utama"
                },
                {
                    id: 3,
                    timestamp_log: "2024-02-25 10:00:00",
                    koordinat_gps: "-6.9778,110.4081",
                    status: "dalam_perjalanan",
                    note: "Kendaraan rusak di tol",
                    location_description: "KM 78 Tol Cipali"
                },
                {
                    id: 4,
                    timestamp_log: "2024-02-25 12:00:00",
                    koordinat_gps: "-6.9778,110.4081",
                    status: "dibatalkan",
                    note: "Pengiriman dibatalkan",
                    location_description: "Bengkel Tol Cipali"
                }
            ]
        },
        {
            id: 7,
            kode_pengiriman: "PGN-2024-018",
            supir_id: "SUP-001",
            tanggal_kirim: "2024-02-20",
            tanggal_kirim_formatted: "20 Februari 2024",
            waktu_kirim: "07:00",
            waktu_selesai: "11:30",
            kendaraan: {
                jenis: "Truk Box",
                plat_nomor: "B 1234 ABC",
                kapasitas: "8 Ton"
            },
            tujuan_akhir: "Pasar Modern - Bekasi",
            alamat_tujuan: "Jl. Jend. Ahmad Yani No. 200, Bekasi",
            jarak_tempuh: 40, // km
            durasi_jam: 4.5,
            durasi_formatted: "4 jam 30 menit",
            status: "selesai",
            catatan: "Pengiriman tepat waktu",
            estimasi_tiba: "2024-02-20T11:30",
            actual_tiba: "2024-02-20T11:30",
            muatan: [
                { nama: "Jeruk Sunkist", jumlah: 150, satuan: "kg" },
                { nama: "Jeruk Medan", jumlah: 100, satuan: "kg" }
            ],
            total_muatan: 250,
            log_tracking: [
                {
                    id: 1,
                    timestamp_log: "2024-02-20 06:30:00",
                    koordinat_gps: "-6.2088,106.8456",
                    status: "loading_barang",
                    note: "Loading pagi",
                    location_description: "Gudang Utama"
                },
                {
                    id: 2,
                    timestamp_log: "2024-02-20 07:00:00",
                    koordinat_gps: "-6.2088,106.8456",
                    status: "berangkat",
                    note: "Berangkat ke Bekasi",
                    location_description: "Gudang Utama"
                },
                {
                    id: 3,
                    timestamp_log: "2024-02-20 09:30:00",
                    koordinat_gps: "-6.2349,107.0000",
                    status: "dalam_perjalanan",
                    note: "Menuju Bekasi",
                    location_description: "Tol Bekasi Barat"
                },
                {
                    id: 4,
                    timestamp_log: "2024-02-20 11:15:00",
                    koordinat_gps: "-6.2349,107.0000",
                    status: "tiba_ditujuan",
                    note: "Tiba di pasar",
                    location_description: "Pasar Modern Bekasi"
                },
                {
                    id: 5,
                    timestamp_log: "2024-02-20 11:30:00",
                    koordinat_gps: "-6.2349,107.0000",
                    status: "selesai",
                    note: "Pengiriman selesai",
                    location_description: "Pasar Modern Bekasi"
                }
            ]
        }
    ];
    
    // Elemen DOM
    const refreshBtn = document.getElementById('refreshBtn');
    const exportPdfBtn = document.getElementById('exportPdfBtn');
    const applyFilterBtn = document.getElementById('applyFilterBtn');
    const resetFilterBtn = document.getElementById('resetFilterBtn');
    const filterPeriode = document.getElementById('filterPeriode');
    const filterDariTanggal = document.getElementById('filterDariTanggal');
    const filterSampaiTanggal = document.getElementById('filterSampaiTanggal');
    const filterStatus = document.getElementById('filterStatus');
    const riwayatTableBody = document.getElementById('riwayatTableBody');
    
    // Modals
    const detailModal = document.getElementById('detailModal');
    const detailModalBody = document.getElementById('detailModalBody');
    const reportModal = document.getElementById('reportModal');
    const reportModalBody = document.getElementById('reportModalBody');
    
    // Buttons
    const printDetailBtn = document.getElementById('printDetailBtn');
    const printReportBtn = document.getElementById('printReportBtn');
    
    // State
    let currentPage = 1;
    const itemsPerPage = 5;
    let currentFilter = {
        periode: '',
        dari_tanggal: '',
        sampai_tanggal: '',
        status: ''
    };
    
    let selectedRiwayatId = null;
    
    // Initialize
    loadRiwayatTable();
    updateStatistics();
    
    // Apply filter
    applyFilterBtn.addEventListener('click', function() {
        currentFilter = {
            periode: filterPeriode.value,
            dari_tanggal: filterDariTanggal.value,
            sampai_tanggal: filterSampaiTanggal.value,
            status: filterStatus.value
        };
        
        // Auto set date range based on period
        if (currentFilter.periode && currentFilter.periode !== 'custom') {
            setDateRangeByPeriod(currentFilter.periode);
        }
        
        currentPage = 1;
        loadRiwayatTable();
        updateStatistics();
    });
    
    // Reset filter
    resetFilterBtn.addEventListener('click', function() {
        filterPeriode.value = '';
        filterDariTanggal.value = '';
        filterSampaiTanggal.value = '';
        filterStatus.value = '';
        
        currentFilter = {
            periode: '',
            dari_tanggal: '',
            sampai_tanggal: '',
            status: ''
        };
        
        currentPage = 1;
        loadRiwayatTable();
        updateStatistics();
    });
    
    // Export PDF
    exportPdfBtn.addEventListener('click', function() {
        exportPdfBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Generating...';
        exportPdfBtn.disabled = true;
        
        setTimeout(() => {
            // In real implementation, call API to generate PDF
            showNotification('Laporan PDF sedang diproses', 'info');
            
            exportPdfBtn.innerHTML = '<i class="fas fa-file-pdf"></i> Export PDF';
            exportPdfBtn.disabled = false;
            
            // Show report modal
            showReportModal();
        }, 1000);
    });
    
    // Refresh button
    refreshBtn.addEventListener('click', function() {
        refreshBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Loading...';
        refreshBtn.disabled = true;
        
        setTimeout(() => {
            loadRiwayatTable();
            updateStatistics();
            refreshBtn.innerHTML = '<i class="fas fa-sync-alt"></i> Refresh';
            refreshBtn.disabled = false;
            showNotification('Data berhasil direfresh', 'success');
        }, 1000);
    });
    
    // Load riwayat table
    function loadRiwayatTable() {
        riwayatTableBody.innerHTML = '';
        
        const filteredData = filterData(riwayatData);
        const startIndex = (currentPage - 1) * itemsPerPage;
        const endIndex = startIndex + itemsPerPage;
        const pageData = filteredData.slice(startIndex, endIndex);
        
        if (pageData.length === 0) {
            riwayatTableBody.innerHTML = `
                <tr>
                    <td colspan="9" style="text-align: center; padding: 40px; color: var(--text-light);">
                        <i class="fas fa-history" style="font-size: 40px; margin-bottom: 10px; opacity: 0.5; display: block;"></i>
                        <div>Tidak ada data riwayat pengiriman</div>
                    </td>
                </tr>
            `;
        } else {
            pageData.forEach((riwayat, index) => {
                const globalIndex = startIndex + index + 1;
                const row = document.createElement('tr');
                
                row.innerHTML = `
                    <td style="color: var(--text-light);">${globalIndex}</td>
                    <td>
                        <div style="font-weight: 600; color: var(--primary);">${riwayat.kode_pengiriman}</div>
                    </td>
                    <td>
                        <div style="font-weight: 600; color: var(--text-dark);">${riwayat.tanggal_kirim_formatted}</div>
                        <div style="font-size: 12px; color: var(--text-light);">${riwayat.waktu_kirim} - ${riwayat.waktu_selesai}</div>
                    </td>
                    <td>
                        <div class="vehicle-badge">
                            <i class="fas fa-truck"></i>
                            ${riwayat.kendaraan.jenis}
                        </div>
                        <div style="font-size: 12px; color: var(--text-light); margin-top: 3px;">${riwayat.kendaraan.plat_nomor}</div>
                    </td>
                    <td>
                        <div style="font-weight: 600; color: var(--text-dark);">${riwayat.tujuan_akhir}</div>
                        <div style="font-size: 12px; color: var(--text-light); margin-top: 3px;">${riwayat.jarak_tempuh} km</div>
                    </td>
                    <td>
                        <div class="duration-badge">
                            <i class="fas fa-clock"></i>
                            ${riwayat.durasi_formatted}
                        </div>
                    </td>
                    <td>
                        <div class="load-badge">
                            <i class="fas fa-box"></i>
                            ${riwayat.total_muatan} kg
                        </div>
                    </td>
                    <td>
                        <span class="status-badge badge-${riwayat.status}">
                            ${riwayat.status === 'selesai' ? 'Selesai' : 'Dibatalkan'}
                        </span>
                    </td>
                `;
                
                riwayatTableBody.appendChild(row);
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
            const itemDate = new Date(item.tanggal_kirim);
            
            // Filter periode
            if (currentFilter.periode) {
                const today = new Date();
                let startDate, endDate;
                
                switch(currentFilter.periode) {
                    case 'hari-ini':
                        startDate = new Date(today);
                        endDate = new Date(today);
                        break;
                    case 'minggu-ini':
                        startDate = new Date(today);
                        startDate.setDate(today.getDate() - today.getDay());
                        endDate = new Date(today);
                        break;
                    case 'minggu-lalu':
                        startDate = new Date(today);
                        startDate.setDate(today.getDate() - today.getDay() - 7);
                        endDate = new Date(today);
                        endDate.setDate(today.getDate() - today.getDay() - 1);
                        break;
                    case 'bulan-ini':
                        startDate = new Date(today.getFullYear(), today.getMonth(), 1);
                        endDate = new Date(today.getFullYear(), today.getMonth() + 1, 0);
                        break;
                    case 'bulan-lalu':
                        startDate = new Date(today.getFullYear(), today.getMonth() - 1, 1);
                        endDate = new Date(today.getFullYear(), today.getMonth(), 0);
                        break;
                    case '3-bulan':
                        startDate = new Date(today);
                        startDate.setMonth(today.getMonth() - 3);
                        endDate = new Date(today);
                        break;
                    case 'custom':
                        if (currentFilter.dari_tanggal) {
                            startDate = new Date(currentFilter.dari_tanggal);
                        }
                        if (currentFilter.sampai_tanggal) {
                            endDate = new Date(currentFilter.sampai_tanggal);
                        }
                        break;
                }
                
                if (startDate && itemDate < startDate) return false;
                if (endDate && itemDate > endDate) return false;
            }
            
            // Filter custom date range
            if (currentFilter.dari_tanggal && !currentFilter.periode) {
                const dariDate = new Date(currentFilter.dari_tanggal);
                if (itemDate < dariDate) return false;
            }
            
            if (currentFilter.sampai_tanggal && !currentFilter.periode) {
                const sampaiDate = new Date(currentFilter.sampai_tanggal);
                if (itemDate > sampaiDate) return false;
            }
            
            // Filter status
            if (currentFilter.status && item.status !== currentFilter.status) return false;
            
            return true;
        }).sort((a, b) => new Date(b.tanggal_kirim) - new Date(a.tanggal_kirim));
    }
    
    // Set date range based on period
    function setDateRangeByPeriod(period) {
        const today = new Date();
        let startDate, endDate;
        
        switch(period) {
            case 'hari-ini':
                startDate = today;
                endDate = today;
                break;
            case 'minggu-ini':
                startDate = new Date(today);
                startDate.setDate(today.getDate() - today.getDay());
                endDate = today;
                break;
            case 'minggu-lalu':
                startDate = new Date(today);
                startDate.setDate(today.getDate() - today.getDay() - 7);
                endDate = new Date(today);
                endDate.setDate(today.getDate() - today.getDay() - 1);
                break;
            case 'bulan-ini':
                startDate = new Date(today.getFullYear(), today.getMonth(), 1);
                endDate = new Date(today.getFullYear(), today.getMonth() + 1, 0);
                break;
            case 'bulan-lalu':
                startDate = new Date(today.getFullYear(), today.getMonth() - 1, 1);
                endDate = new Date(today.getFullYear(), today.getMonth(), 0);
                break;
            case '3-bulan':
                startDate = new Date(today);
                startDate.setMonth(today.getMonth() - 3);
                endDate = today;
                break;
        }
        
        if (startDate) {
            filterDariTanggal.value = startDate.toISOString().split('T')[0];
            currentFilter.dari_tanggal = filterDariTanggal.value;
        }
        
        if (endDate) {
            filterSampaiTanggal.value = endDate.toISOString().split('T')[0];
            currentFilter.sampai_tanggal = filterSampaiTanggal.value;
        }
    }
    
    // Update statistics
    function updateStatistics() {
        const filteredData = filterData(riwayatData);
        
        // Hitung statistik
        const totalSelesai = filteredData.filter(item => item.status === 'selesai').length;
        const totalJarak = filteredData.reduce((sum, item) => sum + (item.jarak_tempuh || 0), 0);
        const totalBarang = filteredData.reduce((sum, item) => sum + (item.total_muatan || 0), 0);
        const rataRataWaktu = filteredData.length > 0 
            ? (filteredData.reduce((sum, item) => sum + (item.durasi_jam || 0), 0) / filteredData.length).toFixed(1)
            : 0;
        
        // Update UI
        document.getElementById('totalSelesai').textContent = totalSelesai;
        document.getElementById('totalJarak').textContent = `${totalJarak.toFixed(1)} km`;
        document.getElementById('totalBarang').textContent = `${totalBarang} kg`;
        document.getElementById('rataRataWaktu').textContent = `${rataRataWaktu} jam`;
        
        // Hitung perubahan (dummy data untuk contoh)
        const lastMonthData = riwayatData.filter(item => {
            const itemDate = new Date(item.tanggal_kirim);
            const lastMonth = new Date();
            lastMonth.setMonth(lastMonth.getMonth() - 1);
            return itemDate >= lastMonth && itemDate < new Date();
        });
        
        const lastMonthSelesai = lastMonthData.filter(item => item.status === 'selesai').length;
        const lastMonthJarak = lastMonthData.reduce((sum, item) => sum + (item.jarak_tempuh || 0), 0);
        const lastMonthBarang = lastMonthData.reduce((sum, item) => sum + (item.total_muatan || 0), 0);
        
        // Update perubahan
        updateChange('totalSelesaiChange', totalSelesai, lastMonthSelesai);
        updateChange('totalJarakChange', totalJarak, lastMonthJarak, 'km');
        updateChange('totalBarangChange', totalBarang, lastMonthBarang, 'kg');
        updateChange('rataRataWaktuChange', parseFloat(rataRataWaktu), 0, 'jam');
    }
    
    function updateChange(elementId, currentValue, previousValue, suffix = '') {
        const element = document.getElementById(elementId);
        
        if (previousValue === 0) {
            element.textContent = '-';
            element.className = 'stat-change';
            return;
        }
        
        const change = ((currentValue - previousValue) / previousValue * 100).toFixed(1);
        
        if (change > 0) {
            element.textContent = `+${change}% ${suffix ? 'dari bulan lalu' : ''}`;
            element.className = 'stat-change positive';
        } else if (change < 0) {
            element.textContent = `${change}% ${suffix ? 'dari bulan lalu' : ''}`;
            element.className = 'stat-change negative';
        } else {
            element.textContent = `0% ${suffix ? 'dari bulan lalu' : ''}`;
            element.className = 'stat-change';
        }
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
                loadRiwayatTable();
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
                const riwayatId = parseInt(this.dataset.id);
                const riwayat = riwayatData.find(p => p.id === riwayatId);
                if (riwayat) {
                    showDetailModal(riwayat);
                }
            });
        });
        
        // History buttons
        document.querySelectorAll('.btn-action.btn-history').forEach(btn => {
            btn.addEventListener('click', function() {
                const riwayatId = parseInt(this.dataset.id);
                const riwayat = riwayatData.find(p => p.id === riwayatId);
                if (riwayat) {
                    showTrackingHistoryModal(riwayat);
                }
            });
        });
        
        // Print buttons
        document.querySelectorAll('.btn-action.btn-success').forEach(btn => {
            btn.addEventListener('click', function() {
                const riwayatId = parseInt(this.dataset.id);
                const riwayat = riwayatData.find(p => p.id === riwayatId);
                if (riwayat) {
                    generateDeliveryReport(riwayat);
                }
            });
        });
    }
    
    // Show detail modal
    function showDetailModal(riwayat) {
        selectedRiwayatId = riwayat.id;
        
        // Format tanggal
        const formatDate = (dateString) => {
            if (!dateString) return '-';
            const date = new Date(dateString);
            return date.toLocaleDateString('id-ID', {
                day: 'numeric',
                month: 'long',
                year: 'numeric',
                hour: '2-digit',
                minute: '2-digit'
            });
        };
        
        // Buat timeline HTML khusus riwayat
        const timelineHTML = riwayat.log_tracking?.map(track => {
            const date = new Date(track.timestamp_log);
            const formattedDate = date.toLocaleDateString('id-ID', {
                day: 'numeric',
                month: 'long',
                year: 'numeric',
                hour: '2-digit',
                minute: '2-digit',
                second: '2-digit'
            });
            
            const icon = getStatusIcon(track.status);
            const statusLabel = getStatusLabel(track.status);
            
            return `
                <div class="timeline-step-complete completed">
                    <div class="step-label-complete">${statusLabel}</div>
                    <div class="step-value-complete">${formattedDate}</div>
                    ${track.location_description ? `
                        <div class="step-duration">
                            <i class="fas fa-map-marker-alt"></i> ${track.location_description}
                        </div>
                    ` : ''}
                    ${track.note ? `
                        <div style="font-size: 13px; color: var(--text-light); margin-top: 5px;">
                            <i class="fas fa-sticky-note"></i> ${track.note}
                        </div>
                    ` : ''}
                </div>
            `;
        }).join('') || '<div style="text-align: center; padding: 20px; color: var(--text-light);">Tidak ada data tracking</div>';
        
        // Buat muatan HTML
        const muatanHTML = riwayat.muatan.map(item => `
            <tr>
                <td>${item.nama}</td>
                <td>${item.jumlah}</td>
                <td>${item.satuan}</td>
                <td>${item.jumlah} ${item.satuan}</td>
            </tr>
        `).join('');
        
        // Hitung waktu loading, perjalanan, unloading
        const timelineData = calculateTimelineData(riwayat);
        
        detailModalBody.innerHTML = `
            <div class="shipment-header">
                <div class="company-name">PT. Mardua Holong</div>
                <div style="font-size: 14px; color: var(--text-light); margin-bottom: 10px;">
                    Riwayat Pengiriman
                </div>
                <h2 class="shipment-title">${riwayat.kode_pengiriman}</h2>
                <div style="font-size: 14px; color: var(--primary); font-weight: 600;">
                    Status: ${riwayat.status === 'selesai' ? 'SELESAI' : 'DIBATALKAN'}
                </div>
            </div>
            
            <div class="summary-card">
                <div class="summary-header">
                    <div class="summary-title">Ringkasan Pengiriman</div>
                    <div class="summary-subtitle">${riwayat.tanggal_kirim_formatted}</div>
                </div>
                <div class="summary-grid">
                    <div class="summary-item">
                        <div class="summary-label">Durasi</div>
                        <div class="summary-value">${riwayat.durasi_formatted}</div>
                    </div>
                    <div class="summary-item">
                        <div class="summary-label">Jarak</div>
                        <div class="summary-value">${riwayat.jarak_tempuh} km</div>
                    </div>
                    <div class="summary-item">
                        <div class="summary-label">Total Muatan</div>
                        <div class="summary-value">${riwayat.total_muatan} kg</div>
                    </div>
                    <div class="summary-item">
                        <div class="summary-label">Waktu Loading</div>
                        <div class="summary-value">${timelineData.loadingTime}</div>
                    </div>
                    <div class="summary-item">
                        <div class="summary-label">Waktu Perjalanan</div>
                        <div class="summary-value">${timelineData.travelTime}</div>
                    </div>
                    <div class="summary-item">
                        <div class="summary-label">Waktu Unloading</div>
                        <div class="summary-value">${timelineData.unloadingTime}</div>
                    </div>
                </div>
            </div>
            
            <div class="shipment-info-grid">
                <div class="info-card-small">
                    <div class="info-label">Kendaraan</div>
                    <div class="info-value">${riwayat.kendaraan.jenis}</div>
                    <div class="info-subvalue">${riwayat.kendaraan.plat_nomor} • ${riwayat.kendaraan.kapasitas}</div>
                </div>
                
                <div class="info-card-small">
                    <div class="info-label">Supir</div>
                    <div class="info-value">${supirData.nama}</div>
                    <div class="info-subvalue">ID: ${supirData.id}</div>
                </div>
                
                <div class="info-card-small">
                    <div class="info-label">Waktu Mulai</div>
                    <div class="info-value">${riwayat.tanggal_kirim_formatted}</div>
                    <div class="info-subvalue">Jam ${riwayat.waktu_kirim}</div>
                </div>
                
                <div class="info-card-small">
                    <div class="info-label">Waktu Selesai</div>
                    <div class="info-value">${riwayat.tanggal_kirim_formatted}</div>
                    <div class="info-subvalue">Jam ${riwayat.waktu_selesai}</div>
                </div>
            </div>
            
            <div style="margin-top: 30px;">
                <div style="font-size: 16px; font-weight: 600; color: var(--text-dark); margin-bottom: 15px;">
                    Tujuan Pengiriman
                </div>
                <div style="background: var(--light); padding: 15px; border-radius: 8px;">
                    <div style="font-weight: 600; margin-bottom: 5px;">${riwayat.tujuan_akhir}</div>
                    <div style="color: var(--text-light);">${riwayat.alamat_tujuan}</div>
                </div>
            </div>
            
            <div class="load-details">
                <div style="font-size: 16px; font-weight: 600; color: var(--text-dark); margin-bottom: 15px;">
                    Detail Muatan
                </div>
                <table class="load-table">
                    <thead>
                        <tr>
                            <th>Jenis Barang</th>
                            <th>Jumlah</th>
                            <th>Satuan</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        ${muatanHTML}
                        <tr style="font-weight: 600;">
                            <td colspan="3" style="text-align: right;">Total Muatan:</td>
                            <td>${riwayat.total_muatan} kg</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            
            <div style="margin-top: 30px;">
                <div style="font-size: 16px; font-weight: 600; color: var(--text-dark); margin-bottom: 15px;">
                    Timeline Pengiriman Lengkap
                </div>
                <div class="timeline-complete">
                    ${timelineHTML}
                </div>
            </div>
            
            ${riwayat.catatan ? `
            <div class="notes-box">
                <i class="fas fa-info-circle"></i>
                <strong>Catatan Pengiriman:</strong> ${riwayat.catatan}
            </div>
            ` : ''}
        `;
        
        detailModal.style.display = 'flex';
        document.body.style.overflow = 'hidden';
    }
    
    // Calculate timeline data
    function calculateTimelineData(riwayat) {
        if (!riwayat.log_tracking || riwayat.log_tracking.length === 0) {
            return {
                loadingTime: '-',
                travelTime: '-',
                unloadingTime: '-'
            };
        }
        
        const sortedLogs = [...riwayat.log_tracking].sort((a, b) => 
            new Date(a.timestamp_log) - new Date(b.timestamp_log)
        );
        
        let loadingStart = null;
        let travelStart = null;
        let unloadingStart = null;
        let endTime = null;
        
        for (const log of sortedLogs) {
            const logTime = new Date(log.timestamp_log);
            
            if (log.status === 'loading_barang' && !loadingStart) {
                loadingStart = logTime;
            } else if (log.status === 'berangkat' && !travelStart) {
                travelStart = logTime;
            } else if (log.status === 'tiba_ditujuan' && !unloadingStart) {
                unloadingStart = logTime;
            } else if (log.status === 'selesai' || log.status === 'dibatalkan') {
                endTime = logTime;
            }
        }
        
        const formatDuration = (minutes) => {
            const hours = Math.floor(minutes / 60);
            const mins = Math.round(minutes % 60);
            return `${hours} jam ${mins} menit`;
        };
        
        const loadingTime = loadingStart && travelStart 
            ? formatDuration((travelStart - loadingStart) / (1000 * 60))
            : '-';
            
        const travelTime = travelStart && unloadingStart
            ? formatDuration((unloadingStart - travelStart) / (1000 * 60))
            : '-';
            
        const unloadingTime = unloadingStart && endTime
            ? formatDuration((endTime - unloadingStart) / (1000 * 60))
            : '-';
        
        return {
            loadingTime,
            travelTime,
            unloadingTime
        };
    }
    
    // Show tracking history modal (reuse from previous code)
    function showTrackingHistoryModal(riwayat) {
        if (!riwayat.log_tracking || riwayat.log_tracking.length === 0) {
            showNotification('Belum ada riwayat tracking untuk pengiriman ini', 'info');
            return;
        }
        
        // Buat modal tracking history baru
        const trackingModal = document.createElement('div');
        trackingModal.className = 'modal';
        trackingModal.id = 'trackingHistoryModal';
        trackingModal.innerHTML = `
            <div class="modal-content modal-lg">
                <div class="modal-header">
                    <h3 class="modal-title">Riwayat Tracking - ${riwayat.kode_pengiriman}</h3>
                    <button type="button" class="close-tracking-modal">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <div id="trackingHistoryContent">
                        ${generateTrackingHistoryHTML(riwayat.log_tracking)}
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary close-tracking-modal">
                        Tutup
                    </button>
                </div>
            </div>
        `;
        
        document.body.appendChild(trackingModal);
        trackingModal.style.display = 'flex';
        document.body.style.overflow = 'hidden';
        
        // Add close event
        trackingModal.querySelector('.close-tracking-modal').addEventListener('click', function() {
            trackingModal.remove();
            document.body.style.overflow = 'auto';
        });
        
        trackingModal.addEventListener('click', function(e) {
            if (e.target === trackingModal) {
                trackingModal.remove();
                document.body.style.overflow = 'auto';
            }
        });
    }
    
    function generateTrackingHistoryHTML(trackingLogs) {
        const sortedTracking = [...trackingLogs].sort((a, b) => 
            new Date(b.timestamp_log) - new Date(a.timestamp_log)
        );
        
        return sortedTracking.map(track => {
            const date = new Date(track.timestamp_log);
            const formattedDate = date.toLocaleDateString('id-ID', {
                day: 'numeric',
                month: 'long',
                year: 'numeric',
                hour: '2-digit',
                minute: '2-digit',
                second: '2-digit'
            });
            
            const icon = getStatusIcon(track.status);
            
            return `
                <div class="tracking-item">
                    <div class="tracking-icon">
                        <i class="${icon}"></i>
                    </div>
                    <div class="tracking-content">
                        <div class="tracking-header">
                            <div class="tracking-title">${getStatusLabel(track.status)}</div>
                            <div class="tracking-time">${formattedDate}</div>
                        </div>
                        ${track.location_description ? `
                            <div class="tracking-location">
                                <i class="fas fa-map-marker-alt"></i> ${track.location_description}
                            </div>
                        ` : ''}
                        ${track.koordinat_gps ? `
                            <div class="tracking-coordinates">
                                <i class="fas fa-globe"></i> ${track.koordinat_gps}
                            </div>
                        ` : ''}
                        ${track.note ? `
                            <div class="tracking-note">
                                <i class="fas fa-sticky-note"></i> ${track.note}
                            </div>
                        ` : ''}
                    </div>
                </div>
            `;
        }).join('');
    }
    
    // Generate delivery report
    function generateDeliveryReport(riwayat) {
        selectedRiwayatId = riwayat.id;
        
        const formatDate = (dateString) => {
            if (!dateString) return '-';
            const date = new Date(dateString);
            return date.toLocaleDateString('id-ID', {
                weekday: 'long',
                day: 'numeric',
                month: 'long',
                year: 'numeric',
                hour: '2-digit',
                minute: '2-digit'
            });
        };
        
        const today = new Date();
        const todayFormatted = today.toLocaleDateString('id-ID', {
            day: 'numeric',
            month: 'long',
            year: 'numeric'
        });
        
        reportModalBody.innerHTML = `
            <div style="font-family: Arial, sans-serif;">
                <!-- Header Laporan -->
                <div style="text-align: center; margin-bottom: 30px; border-bottom: 2px solid var(--primary); padding-bottom: 20px;">
                    <h1 style="color: var(--primary); margin-bottom: 5px;">PT. Mardua Holong</h1>
                    <p style="color: var(--text-light); margin-bottom: 10px;">Perkebunan Jeruk Terpadu</p>
                    <h2 style="color: var(--text-dark);">LAPORAN PENGIRIMAN BARANG</h2>
                    <p style="color: var(--text-light);">No: ${riwayat.kode_pengiriman}/LAP/${today.getFullYear()}</p>
                </div>
                
                <!-- Info Utama -->
                <table style="width: 100%; margin-bottom: 25px; border-collapse: collapse;">
                    <tr>
                        <td style="width: 50%; padding: 10px; vertical-align: top;">
                            <strong>Tanggal Pengiriman:</strong><br>
                            ${riwayat.tanggal_kirim_formatted}<br>
                            ${riwayat.waktu_kirim} - ${riwayat.waktu_selesai}
                        </td>
                        <td style="width: 50%; padding: 10px; vertical-align: top;">
                            <strong>Status:</strong><br>
                            <span class="status-badge badge-${riwayat.status}" style="margin-top: 5px;">
                                ${riwayat.status === 'selesai' ? 'SELESAI' : 'DIBATALKAN'}
                            </span>
                        </td>
                    </tr>
                </table>
                
                <!-- Info Supir dan Kendaraan -->
                <table style="width: 100%; margin-bottom: 25px; border-collapse: collapse; border: 1px solid var(--border);">
                    <tr>
                        <th style="background: var(--light); padding: 12px; text-align: left; width: 50%; border-bottom: 1px solid var(--border);">
                            SUPIR
                        </th>
                        <th style="background: var(--light); padding: 12px; text-align: left; width: 50%; border-bottom: 1px solid var(--border);">
                            KENDARAAN
                        </th>
                    </tr>
                    <tr>
                        <td style="padding: 12px; border-bottom: 1px solid var(--border);">
                            <strong>Nama:</strong> ${supirData.nama}<br>
                            <strong>ID Supir:</strong> ${supirData.id}
                        </td>
                        <td style="padding: 12px; border-bottom: 1px solid var(--border);">
                            <strong>Jenis:</strong> ${riwayat.kendaraan.jenis}<br>
                            <strong>Plat Nomor:</strong> ${riwayat.kendaraan.plat_nomor}<br>
                            <strong>Kapasitas:</strong> ${riwayat.kendaraan.kapasitas}
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2" style="padding: 12px;">
                            <strong>Tujuan:</strong> ${riwayat.tujuan_akhir}<br>
                            <strong>Alamat:</strong> ${riwayat.alamat_tujuan}<br>
                            <strong>Jarak Tempuh:</strong> ${riwayat.jarak_tempuh} km
                        </td>
                    </tr>
                </table>
                
                <!-- Statistik Pengiriman -->
                <div style="background: var(--light); padding: 15px; border-radius: 8px; margin-bottom: 25px;">
                    <h3 style="color: var(--text-dark); margin-bottom: 15px;">Statistik Pengiriman</h3>
                    <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 15px;">
                        <div style="text-align: center;">
                            <div style="font-size: 12px; color: var(--text-light);">Durasi</div>
                            <div style="font-size: 20px; font-weight: 700; color: var(--primary);">${riwayat.durasi_formatted}</div>
                        </div>
                        <div style="text-align: center;">
                            <div style="font-size: 12px; color: var(--text-light);">Total Muatan</div>
                            <div style="font-size: 20px; font-weight: 700; color: var(--primary);">${riwayat.total_muatan} kg</div>
                        </div>
                        <div style="text-align: center;">
                            <div style="font-size: 12px; color: var(--text-light);">Waktu Rata-rata</div>
                            <div style="font-size: 20px; font-weight: 700; color: var(--primary);">${(riwayat.jarak_tempuh / riwayat.durasi_jam).toFixed(1)} km/jam</div>
                        </div>
                    </div>
                </div>
                
                <!-- Detail Muatan -->
                <h3 style="color: var(--text-dark); margin-bottom: 15px;">Detail Muatan</h3>
                <table style="width: 100%; border-collapse: collapse; border: 1px solid var(--border); margin-bottom: 25px;">
                    <thead>
                        <tr style="background: var(--light);">
                            <th style="padding: 10px; text-align: left;">Jenis Barang</th>
                            <th style="padding: 10px; text-align: right;">Jumlah</th>
                            <th style="padding: 10px; text-align: left;">Satuan</th>
                            <th style="padding: 10px; text-align: right;">Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        ${riwayat.muatan.map(item => `
                            <tr>
                                <td style="padding: 10px; border-bottom: 1px solid var(--border);">${item.nama}</td>
                                <td style="padding: 10px; text-align: right; border-bottom: 1px solid var(--border);">${item.jumlah}</td>
                                <td style="padding: 10px; border-bottom: 1px solid var(--border);">${item.satuan}</td>
                                <td style="padding: 10px; text-align: right; border-bottom: 1px solid var(--border);">${item.jumlah} ${item.satuan}</td>
                            </tr>
                        `).join('')}
                        <tr style="font-weight: 700;">
                            <td colspan="3" style="padding: 10px; text-align: right;">TOTAL MUATAN:</td>
                            <td style="padding: 10px; text-align: right;">${riwayat.total_muatan} kg</td>
                        </tr>
                    </tbody>
                </table>
                
                <!-- Timeline Singkat -->
                <h3 style="color: var(--text-dark); margin-bottom: 15px;">Timeline Pengiriman</h3>
                <div style="border: 1px solid var(--border); border-radius: 8px; padding: 15px; margin-bottom: 25px;">
                    ${riwayat.log_tracking?.map(track => {
                        const date = new Date(track.timestamp_log);
                        const time = date.toLocaleTimeString('id-ID', {
                            hour: '2-digit',
                            minute: '2-digit'
                        });
                        return `
                            <div style="display: flex; align-items: center; padding: 8px 0; border-bottom: 1px solid var(--border);">
                                <div style="width: 80px; color: var(--text-light);">${time}</div>
                                <div style="flex: 1;">
                                    <div style="font-weight: 600;">${getStatusLabel(track.status)}</div>
                                    <div style="font-size: 12px; color: var(--text-light);">${track.location_description || ''}</div>
                                </div>
                            </div>
                        `;
                    }).join('') || '<div style="text-align: center; padding: 20px; color: var(--text-light);">Tidak ada data timeline</div>'}
                </div>
                
                <!-- Catatan -->
                ${riwayat.catatan ? `
                <div style="background: #FFF3E0; padding: 15px; border-radius: 8px; border-left: 4px solid #FF9800; margin-bottom: 25px;">
                    <strong style="color: #5D4037;">Catatan Pengiriman:</strong><br>
                    ${riwayat.catatan}
                </div>
                ` : ''}
                
                <!-- Tanda Tangan -->
                <div style="margin-top: 50px;">
                    <table style="width: 100%;">
                        <tr>
                            <td style="width: 50%; text-align: center;">
                                <div style="height: 100px; border-bottom: 1px solid var(--border); margin-bottom: 10px;"></div>
                                <strong>Supir Pengirim</strong><br>
                                ${supirData.nama}<br>
                                ID: ${supirData.id}
                            </td>
                            <td style="width: 50%; text-align: center;">
                                <div style="height: 100px; border-bottom: 1px solid var(--border); margin-bottom: 10px;"></div>
                                <strong>Disetujui Oleh,</strong><br>
                                Manajer Logistik<br>
                                PT. Mardua Holong
                            </td>
                        </tr>
                    </table>
                </div>
                
                <!-- Footer -->
                <div style="margin-top: 30px; padding-top: 15px; border-top: 1px solid var(--border); text-align: center; color: var(--text-light); font-size: 12px;">
                    <p>Dokumen ini dicetak pada: ${formatDate(today.toISOString())}</p>
                    <p>PT. Mardua Holong - Jl. Perkebunan No. 123, Jakarta | Telp: (021) 12345678</p>
                </div>
            </div>
        `;
        
        reportModal.style.display = 'flex';
        document.body.style.overflow = 'hidden';
    }
    
    // Print detail button
    printDetailBtn?.addEventListener('click', function() {
        window.print();
    });
    
    // Print report button
    printReportBtn?.addEventListener('click', function() {
        window.print();
    });
    
    // Close modals
    document.querySelectorAll('.close-detail-modal').forEach(btn => {
        btn.addEventListener('click', function() {
            detailModal.style.display = 'none';
            document.body.style.overflow = 'auto';
        });
    });
    
    document.querySelectorAll('.close-report-modal').forEach(btn => {
        btn.addEventListener('click', function() {
            reportModal.style.display = 'none';
            document.body.style.overflow = 'auto';
        });
    });
    
    // Close modal when clicking outside
    [detailModal, reportModal].forEach(modal => {
        modal?.addEventListener('click', function(e) {
            if (e.target === modal) {
                modal.style.display = 'none';
                document.body.style.overflow = 'auto';
            }
        });
    });
    
    // Pagination buttons
    document.querySelector('.btn-pagination.prev').addEventListener('click', function() {
        if (currentPage > 1) {
            currentPage--;
            loadRiwayatTable();
        }
    });
    
    document.querySelector('.btn-pagination.next').addEventListener('click', function() {
        const filteredData = filterData(riwayatData);
        const totalPages = Math.ceil(filteredData.length / itemsPerPage);
        
        if (currentPage < totalPages) {
            currentPage++;
            loadRiwayatTable();
        }
    });
    
    // Helper functions
    function getStatusLabel(status) {
        const labels = {
            'loading_barang': 'Loading Barang',
            'berangkat': 'Berangkat',
            'dalam_perjalanan': 'Dalam Perjalanan',
            'tiba_ditujuan': 'Tiba di Tujuan',
            'unloading': 'Unloading',
            'selesai': 'Selesai',
            'dibatalkan': 'Dibatalkan'
        };
        return labels[status] || status;
    }
    
    function getStatusIcon(status) {
        const icons = {
            'loading_barang': 'fas fa-box-open',
            'berangkat': 'fas fa-play-circle',
            'dalam_perjalanan': 'fas fa-truck-moving',
            'tiba_ditujuan': 'fas fa-map-marker-alt',
            'unloading': 'fas fa-dolly',
            'selesai': 'fas fa-check-circle',
            'dibatalkan': 'fas fa-times-circle'
        };
        return icons[status] || 'fas fa-info-circle';
    }
    
    function showNotification(message, type = 'info') {
        const existingNotification = document.querySelector('.notification');
        if (existingNotification) {
            existingNotification.remove();
        }
        
        const notification = document.createElement('div');
        notification.className = `notification notification-${type}`;
        notification.innerHTML = `
            <div style="display: flex; align-items: center; gap: 10px;">
                <i class="fas fa-${type === 'success' ? 'check-circle' : type === 'warning' ? 'exclamation-triangle' : type === 'danger' ? 'times-circle' : 'info-circle'}"></i>
                <span>${message}</span>
            </div>
            <button class="close-notification">
                <i class="fas fa-times"></i>
            </button>
        `;
        
        notification.style.cssText = `
            position: fixed;
            top: 20px;
            right: 20px;
            background: ${type === 'success' ? '#43A047' : type === 'warning' ? '#FB8C00' : type === 'danger' ? '#E53935' : '#1E88E5'};
            color: white;
            padding: 15px 20px;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.15);
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 15px;
            z-index: 9999;
            animation: slideIn 0.3s ease;
            max-width: 400px;
        `;
        
        const style = document.createElement('style');
        style.textContent = `
            @keyframes slideIn {
                from {
                    transform: translateX(100%);
                    opacity: 0;
                }
                to {
                    transform: translateX(0);
                    opacity: 1;
                }
            }
        `;
        document.head.appendChild(style);
        
        notification.querySelector('.close-notification').addEventListener('click', function() {
            notification.remove();
        });
        
        document.body.appendChild(notification);
        
        setTimeout(() => {
            if (notification.parentNode) {
                notification.remove();
            }
        }, 5000);
    }
});