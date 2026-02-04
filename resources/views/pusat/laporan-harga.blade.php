{{-- resources/views/pusat/laporan-pembelian.blade.php --}}
@extends('layouts.pusat')

@section('title', 'Laporan Pembelian - PT. Mardua Holong')

@section('page-title', 'Laporan Pembelian')
@section('page-subtitle', 'Data seluruh pembelian jeruk dari manajemen lapangan')

@section('content')
<div class="content-wrapper">
    <!-- Header -->
    <div class="content-header">
        <div class="header-left">
        </div>
        <div class="header-right">
            <button type="button" id="printBtn" class="btn btn-primary">
                <i class="fas fa-print"></i> Cetak Laporan
            </button>
            <button type="button" id="exportBtn" class="btn btn-success">
                <i class="fas fa-file-excel"></i> Export Excel
            </button>
        </div>
    </div>
    
    <!-- Statistik -->
    <div class="stats-grid" style="margin-bottom: 30px;">
        <div class="stat-card">
            <div class="stat-icon">
                <i class="fas fa-shopping-cart"></i>
            </div>
            <div class="stat-content">
                <div class="stat-value" id="totalTransaksi">0</div>
                <div class="stat-label">Total Transaksi</div>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon">
                <i class="fas fa-weight"></i>
            </div>
            <div class="stat-content">
                <div class="stat-value" id="totalBerat">0 Kg</div>
                <div class="stat-label">Total Berat</div>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon">
                <i class="fas fa-money-bill-wave"></i>
            </div>
            <div class="stat-content">
                <div class="stat-value" id="totalNilai">Rp 0</div>
                <div class="stat-label">Total Nilai</div>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon">
                <i class="fas fa-check-circle"></i>
            </div>
            <div class="stat-content">
                <div class="stat-value" id="totalVerified">0</div>
                <div class="stat-label">Terverifikasi</div>
            </div>
        </div>
    </div>
    
    <!-- Filter -->
    <div class="content-card" style="margin-bottom: 30px;">
        <div class="card-header">
            <div class="card-title">
                <i class="fas fa-filter"></i>
                <span>Filter Laporan</span>
            </div>
        </div>
        
        <div class="filter-options">
            <div class="filter-group">
                <label class="filter-label">Periode</label>
                <select id="filterPeriode" class="form-control">
                    <option value="">Semua Periode</option>
                    <option value="hari-ini">Hari Ini</option>
                    <option value="minggu-ini">Minggu Ini</option>
                    <option value="bulan-ini">Bulan Ini</option>
                    <option value="bulan-lalu">Bulan Lalu</option>
                    <option value="custom">Custom</option>
                </select>
            </div>
            
            <div class="filter-group" id="customDateGroup" style="display: none;">
                <label class="filter-label">Tanggal Custom</label>
                <div class="input-group">
                    <input type="date" id="filterTanggalAwal" class="form-control" placeholder="Tanggal Awal">
                    <span style="padding: 0 10px; display: flex; align-items: center;">s/d</span>
                    <input type="date" id="filterTanggalAkhir" class="form-control" placeholder="Tanggal Akhir">
                </div>
            </div>
            
            <div class="filter-group">
                <label class="filter-label">Status</label>
                <select id="filterStatus" class="form-control">
                    <option value="">Semua Status</option>
                    <option value="Pending">Pending</option>
                    <option value="Verifikasi">Verifikasi</option>
                    <option value="Reject">Reject</option>
                </select>
            </div>
            
            <div class="filter-group">
                <label class="filter-label">Ladang</label>
                <select id="filterLadang" class="form-control">
                    <option value="">Semua Ladang</option>
                    <option value="Pandiangan">Ladang Pandiangan</option>
                    <option value="Siregar">Ladang Siregar</option>
                    <option value="Silalahi">Ladang Silalahi</option>
                </select>
            </div>
            
            <div class="filter-group">
                <label class="filter-label">&nbsp;</label>
                <button type="button" id="applyFilterBtn" class="btn btn-primary">
                    <i class="fas fa-search"></i> Terapkan
                </button>
                <button type="button" id="resetFilterBtn" class="btn btn-secondary">
                    <i class="fas fa-redo"></i> Reset
                </button>
            </div>
        </div>
    </div>
    
    <!-- Tabel Laporan -->
    <div class="content-card">
        <div class="card-header">
            <div class="card-title">
                <i class="fas fa-file-invoice-dollar"></i>
                <span>Daftar Pembelian Jeruk</span>
            </div>
            <div class="card-info">
                Menampilkan <span id="showingCount">0</span> dari <span id="totalCount">0</span> transaksi
            </div>
        </div>
        
        <div class="table-responsive">
            <table class="data-table">
                <thead>
                    <tr>
                        <th style="width: 50px;">No</th>
                        <th>Tanggal</th>
                        <th>Ladang</th>
                        <th>Harga/Kg</th>
                        <th>Jumlah (Kg)</th>
                        <th>Total Harga</th>
                        <th>Status</th>
                        <th>Manajer</th>
                        <th style="width: 100px;">Aksi</th>
                    </tr>
                </thead>
                <tbody id="laporanTableBody">
                    <!-- Data akan diisi oleh JavaScript -->
                </tbody>
            </table>
        </div>
        
        <!-- Pagination -->
        <div class="table-footer">
            <div class="showing-count">
                Halaman <span id="currentPage">1</span> dari <span id="totalPages">1</span>
            </div>
            <div class="pagination">
                <button type="button" class="btn-pagination prev">
                    <i class="fas fa-chevron-left"></i>
                </button>
                <div class="page-numbers" id="pageNumbers">
                    <!-- Page numbers will be generated here -->
                </div>
                <button type="button" class="btn-pagination next">
                    <i class="fas fa-chevron-right"></i>
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Detail Pembelian -->
<div id="detailModal" class="modal">
    <div class="modal-content modal-lg">
        <div class="modal-header">
            <h3 class="modal-title">Detail Pembelian</h3>
            <button type="button" class="close-detail-modal">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <div class="modal-body" id="detailModalBody">
            <!-- Detail akan diisi oleh JavaScript -->
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary close-detail-modal">
                Tutup
            </button>
            <button type="button" class="btn btn-primary" id="printDetailBtn">
                <i class="fas fa-print"></i> Cetak Detail
            </button>
            <button type="button" class="btn btn-success" id="verifyBtn">
                <i class="fas fa-check"></i> Verifikasi
            </button>
        </div>
    </div>
</div>

<!-- Modal Verifikasi -->
<div id="verifyModal" class="modal">
    <div class="modal-content">
        <div class="modal-header">
            <h3 class="modal-title">Verifikasi Pembelian</h3>
            <button type="button" class="close-verify-modal">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <div class="modal-body">
            <div class="form-group">
                <label class="form-label">Status Saat Ini</label>
                <div id="currentStatus" style="padding: 10px; background-color: #f8f9fa; border-radius: 6px; margin-bottom: 15px;">
                    -</div>
            </div>
            <div class="form-group">
                <label class="form-label">Update Status Menjadi</label>
                <select id="newStatus" class="form-control">
                    <option value="Pending">Pending</option>
                    <option value="Verifikasi">Verifikasi</option>
                    <option value="Reject">Reject</option>
                </select>
            </div>
            <div class="form-group">
                <label class="form-label">Catatan Verifikasi</label>
                <textarea id="verifikasiNote" class="form-control" rows="3" placeholder="Masukkan catatan verifikasi..."></textarea>
                <small class="text-muted">Catatan ini akan dikirim ke manajer lapangan</small>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary close-verify-modal">
                Batal
            </button>
            <button type="button" class="btn btn-primary" id="confirmVerifyBtn">
                <i class="fas fa-check-circle"></i> Konfirmasi
            </button>
        </div>
    </div>
</div>

<!-- Modal Lihat Bukti -->
<div id="buktiModal" class="modal">
    <div class="modal-content modal-lg">
        <div class="modal-header">
            <h3 class="modal-title">Bukti Pembelian</h3>
            <button type="button" class="close-bukti-modal">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <div class="modal-body" style="text-align: center;">
            <div id="buktiImageContainer">
                <!-- Gambar bukti akan ditampilkan di sini -->
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary close-bukti-modal">
                Tutup
            </button>
            <button type="button" class="btn btn-primary" id="downloadBuktiBtn">
                <i class="fas fa-download"></i> Download
            </button>
        </div>
    </div>
</div>

<style>
    /* General Variables */
    :root {
        --primary: #2D6A4F;
        --primary-dark: #1B4332;
        --primary-light: #95D5B2;
        --primary-lighter: #D8F3DC;
        --secondary: #6C757D;
        --success: #28A745;
        --info: #17A2B8;
        --warning: #FFC107;
        --danger: #DC3545;
        --light: #F8F9FA;
        --dark: #212529;
        --border: #E9ECEF;
        --text-dark: #212529;
        --text-light: #6C757D;
        --transition: all 0.3s ease;
    }
    
    /* Content Header */
    .content-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 30px;
        flex-wrap: wrap;
        gap: 20px;
    }
    
    .header-left h1 {
        font-size: 24px;
        font-weight: 700;
        color: var(--text-dark);
        margin-bottom: 5px;
    }
    
    .header-left p {
        color: var(--text-light);
        font-size: 14px;
        margin: 0;
    }
    
    .header-right {
        display: flex;
        gap: 10px;
    }
    
    /* Stats Grid */
    .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 20px;
    }
    
    .stat-card {
        background: white;
        border-radius: 12px;
        padding: 20px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.05);
        border: 1px solid var(--border);
        display: flex;
        align-items: center;
        gap: 20px;
        transition: var(--transition);
    }
    
    .stat-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    }
    
    .stat-icon {
        width: 60px;
        height: 60px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 24px;
        color: white;
    }
    
    .stat-card:nth-child(1) .stat-icon {
        background: linear-gradient(135deg, #2196F3 0%, #1976D2 100%);
    }
    
    .stat-card:nth-child(2) .stat-icon {
        background: linear-gradient(135deg, #4CAF50 0%, #388E3C 100%);
    }
    
    .stat-card:nth-child(3) .stat-icon {
        background: linear-gradient(135deg, #FF9800 0%, #F57C00 100%);
    }
    
    .stat-card:nth-child(4) .stat-icon {
        background: linear-gradient(135deg, #00BCD4 0%, #0097A7 100%);
    }
    
    .stat-content {
        flex: 1;
    }
    
    .stat-value {
        font-size: 24px;
        font-weight: 700;
        color: var(--text-dark);
        margin-bottom: 5px;
    }
    
    .stat-label {
        font-size: 14px;
        color: var(--text-light);
    }
    
    /* Content Card */
    .content-card {
        background: white;
        border-radius: 12px;
        padding: 25px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.05);
        border: 1px solid var(--border);
        margin-bottom: 30px;
    }
    
    .card-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 25px;
        flex-wrap: wrap;
        gap: 15px;
    }
    
    .card-title {
        display: flex;
        align-items: center;
        gap: 12px;
        font-size: 16px;
        font-weight: 600;
        color: var(--text-dark);
    }
    
    .card-title i {
        color: var(--primary);
        font-size: 18px;
    }
    
    .card-info {
        font-size: 14px;
        color: var(--text-light);
    }
    
    /* Filter Options */
    .filter-options {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 20px;
        align-items: end;
    }
    
    .filter-group {
        margin-bottom: 0;
    }
    
    .filter-label {
        display: block;
        margin-bottom: 8px;
        font-weight: 500;
        color: var(--text-dark);
        font-size: 14px;
    }
    
    /* Form Control */
    .form-control {
        width: 100%;
        padding: 12px 15px;
        border: 1px solid var(--border);
        border-radius: 8px;
        font-size: 14px;
        color: var(--text-dark);
        background-color: white;
        transition: var(--transition);
    }
    
    .form-control:focus {
        outline: none;
        border-color: var(--primary);
        box-shadow: 0 0 0 3px rgba(33, 150, 243, 0.1);
    }
    
    /* Input Group */
    .input-group {
        display: flex;
        align-items: center;
        gap: 10px;
    }
    
    /* Table Styles */
    .table-responsive {
        overflow-x: auto;
    }
    
    .data-table {
        width: 100%;
        border-collapse: collapse;
    }
    
    .data-table thead {
        background-color: var(--light);
        border-bottom: 2px solid var(--border);
    }
    
    .data-table th {
        padding: 12px;
        text-align: left;
        font-weight: 600;
        color: var(--text-dark);
        font-size: 14px;
    }
    
    .data-table td {
        padding: 12px;
        font-size: 14px;
        border-bottom: 1px solid var(--border);
    }
    
    .data-table tbody tr {
        transition: var(--transition);
    }
    
    .data-table tbody tr:hover {
        background-color: var(--primary-lighter);
    }
    
    /* Status Badge */
    .status-badge {
        display: inline-block;
        padding: 6px 12px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 600;
        text-align: center;
        min-width: 100px;
    }
    
    .badge-Pending {
        background-color: #FFF3E0;
        color: #EF6C00;
        border: 1px solid #FFE0B2;
    }
    
    .badge-Verifikasi {
        background-color: #E8F5E9;
        color: #2E7D32;
        border: 1px solid #C8E6C9;
    }
    
    .badge-Reject {
        background-color: #FFEBEE;
        color: #C62828;
        border: 1px solid #FFCDD2;
    }
    
    /* Ladang Badge */
    .ladang-badge {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 6px 10px;
        border-radius: 6px;
        font-size: 12px;
        font-weight: 600;
        background-color: #F3E5F5;
        color: #7B1FA2;
    }
    
    /* Price Badge */
    .price-badge {
        display: inline-flex;
        align-items: center;
        gap: 4px;
        padding: 4px 8px;
        border-radius: 4px;
        font-size: 12px;
        font-weight: 600;
        background-color: #FFF3E0;
        color: #EF6C00;
    }
    
    /* Weight Badge */
    .weight-badge {
        display: inline-flex;
        align-items: center;
        gap: 4px;
        padding: 4px 8px;
        border-radius: 4px;
        font-size: 12px;
        font-weight: 600;
        background-color: #E8F5E9;
        color: #2E7D32;
    }
    
    /* Total Badge */
    .total-badge {
        display: inline-flex;
        align-items: center;
        gap: 4px;
        padding: 4px 8px;
        border-radius: 4px;
        font-size: 12px;
        font-weight: 600;
        background-color: #E3F2FD;
        color: #1565C0;
    }
    
    /* Table Footer */
    .table-footer {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-top: 20px;
        padding-top: 20px;
        border-top: 1px solid var(--border);
        flex-wrap: wrap;
        gap: 15px;
    }
    
    .showing-count {
        font-size: 14px;
        color: var(--text-light);
    }
    
    .pagination {
        display: flex;
        align-items: center;
        gap: 5px;
    }
    
    .btn-pagination {
        width: 36px;
        height: 36px;
        border-radius: 6px;
        border: 1px solid var(--border);
        background-color: white;
        color: var(--text-dark);
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: var(--transition);
    }
    
    .btn-pagination:hover:not(:disabled) {
        background-color: var(--primary-lighter);
        border-color: var(--primary);
        color: var(--primary);
    }
    
    .btn-pagination:disabled {
        opacity: 0.5;
        cursor: not-allowed;
    }
    
    .page-numbers {
        display: flex;
        gap: 5px;
    }
    
    .page-number {
        min-width: 36px;
        height: 36px;
        border-radius: 6px;
        border: 1px solid var(--border);
        background-color: white;
        color: var(--text-dark);
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 14px;
        transition: var(--transition);
    }
    
    .page-number:hover {
        background-color: var(--primary-lighter);
        border-color: var(--primary);
        color: var(--primary);
    }
    
    .page-number.active {
        background-color: var(--primary);
        border-color: var(--primary);
        color: white;
    }
    
    /* Action Buttons */
    .action-buttons {
        display: flex;
        gap: 8px;
    }
    
    .btn-action {
        width: 32px;
        height: 32px;
        border-radius: 6px;
        border: none;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 14px;
        transition: var(--transition);
    }
    
    .btn-view {
        background-color: var(--primary-lighter);
        color: var(--primary);
    }
    
    .btn-view:hover {
        background-color: var(--primary);
        color: white;
    }
    
    .btn-verify {
        background-color: #E8F5E9;
        color: #2E7D32;
    }
    
    .btn-verify:hover {
        background-color: #2E7D32;
        color: white;
    }
    
    .btn-reject {
        background-color: #FFEBEE;
        color: #C62828;
    }
    
    .btn-reject:hover {
        background-color: #C62828;
        color: white;
    }
    
    .btn-bukti {
        background-color: #FFF3E0;
        color: #EF6C00;
    }
    
    .btn-bukti:hover {
        background-color: #EF6C00;
        color: white;
    }
    
    /* Modal Styles */
    .modal {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5);
        z-index: 1000;
        align-items: center;
        justify-content: center;
        padding: 20px;
    }
    
    .modal-content {
        background: white;
        border-radius: 12px;
        width: 100%;
        max-width: 600px;
        max-height: 90vh;
        overflow-y: auto;
        animation: modalFadeIn 0.3s ease;
    }
    
    .modal-lg {
        max-width: 800px;
    }
    
    @keyframes modalFadeIn {
        from {
            opacity: 0;
            transform: scale(0.9);
        }
        to {
            opacity: 1;
            transform: scale(1);
        }
    }
    
    .modal-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 20px;
        border-bottom: 1px solid var(--border);
    }
    
    .modal-title {
        margin: 0;
        font-size: 18px;
        font-weight: 600;
        color: var(--text-dark);
    }
    
    .close-detail-modal,
    .close-verify-modal,
    .close-bukti-modal {
        background: none;
        border: none;
        font-size: 18px;
        color: var(--text-light);
        cursor: pointer;
        transition: var(--transition);
        width: 36px;
        height: 36px;
        border-radius: 6px;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    
    .close-detail-modal:hover,
    .close-verify-modal:hover,
    .close-bukti-modal:hover {
        background-color: var(--light);
        color: var(--text-dark);
    }
    
    .modal-body {
        padding: 20px;
    }
    
    .modal-footer {
        padding: 20px;
        border-top: 1px solid var(--border);
        display: flex;
        gap: 10px;
    }
    
    /* Detail Pembelian Design */
    .pembelian-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 30px;
        padding-bottom: 20px;
        border-bottom: 2px solid var(--border);
    }
    
    .pembelian-title h3 {
        margin: 0;
        font-size: 20px;
        font-weight: 700;
        color: var(--text-dark);
    }
    
    .pembelian-subtitle {
        color: var(--text-light);
        font-size: 14px;
        margin-top: 5px;
    }
    
    .pembelian-info-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 20px;
        margin-bottom: 30px;
    }
    
    .info-card {
        background: var(--light);
        padding: 20px;
        border-radius: 8px;
        border-left: 4px solid var(--primary);
    }
    
    .info-label {
        font-size: 12px;
        color: var(--text-light);
        margin-bottom: 5px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }
    
    .info-value {
        font-size: 16px;
        font-weight: 600;
        color: var(--text-dark);
        margin-bottom: 10px;
    }
    
    .info-subvalue {
        font-size: 14px;
        color: var(--text-light);
    }
    
    /* Price Summary */
    .price-summary {
        margin-top: 30px;
    }
    
    .summary-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
        gap: 15px;
        margin-top: 20px;
    }
    
    .summary-card {
        background: white;
        padding: 15px;
        border-radius: 8px;
        border: 1px solid var(--border);
        text-align: center;
    }
    
    .summary-value {
        font-size: 18px;
        font-weight: 700;
        color: var(--primary);
        margin-bottom: 5px;
    }
    
    .summary-label {
        font-size: 12px;
        color: var(--text-light);
    }
    
    /* Bukti Image */
    .bukti-image {
        max-width: 100%;
        max-height: 500px;
        border-radius: 8px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.1);
    }
    
    /* Verification History */
    .verification-history {
        margin-top: 30px;
    }
    
    .verification-item {
        display: flex;
        align-items: flex-start;
        padding: 15px;
        border-bottom: 1px solid var(--border);
    }
    
    .verification-item:last-child {
        border-bottom: none;
    }
    
    .verification-icon {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        background-color: var(--primary-lighter);
        color: var(--primary);
        display: flex;
        align-items: center;
        justify-content: center;
        margin-right: 15px;
        flex-shrink: 0;
    }
    
    .verification-content {
        flex: 1;
    }
    
    .verification-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 5px;
    }
    
    .verification-title {
        font-weight: 600;
        color: var(--text-dark);
    }
    
    .verification-time {
        font-size: 12px;
        color: var(--text-light);
    }
    
    .verification-note {
        font-size: 14px;
        color: var(--text-dark);
        margin-top: 5px;
        padding: 10px;
        background-color: #FFF3E0;
        border-radius: 6px;
        border-left: 3px solid #FF9800;
    }
    
    /* Form Group */
    .form-group {
        margin-bottom: 20px;
    }
    
    .form-label {
        display: block;
        margin-bottom: 8px;
        font-weight: 500;
        color: var(--text-dark);
        font-size: 14px;
    }
    
    textarea.form-control {
        resize: vertical;
        min-height: 80px;
    }
    
    /* Button Styles */
    .btn {
        padding: 10px 20px;
        border-radius: 8px;
        border: none;
        font-size: 14px;
        font-weight: 500;
        cursor: pointer;
        transition: var(--transition);
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
    }
    
    .btn-primary {
        background-color: var(--primary);
        color: white;
    }
    
    .btn-primary:hover {
        background-color: var(--primary-dark);
    }
    
    .btn-secondary {
        background-color: var(--secondary);
        color: white;
    }
    
    .btn-secondary:hover {
        background-color: #5a6268;
    }
    
    .btn-success {
        background-color: var(--success);
        color: white;
    }
    
    .btn-success:hover {
        background-color: #388E3C;
    }
    
    .btn-danger {
        background-color: var(--danger);
        color: white;
    }
    
    .btn-danger:hover {
        background-color: #D32F2F;
    }
    
    .btn-warning {
        background-color: var(--warning);
        color: white;
    }
    
    .btn-warning:hover {
        background-color: #F57C00;
    }
    
    /* Responsive Styles */
    @media (max-width: 768px) {
        .content-header {
            flex-direction: column;
            align-items: flex-start;
        }
        
        .header-right {
            width: 100%;
        }
        
        .header-right .btn {
            flex: 1;
        }
        
        .stats-grid {
            grid-template-columns: repeat(2, 1fr);
        }
        
        .card-header {
            flex-direction: column;
            align-items: flex-start;
        }
        
        .modal-footer {
            flex-direction: column;
        }
        
        .pembelian-info-grid {
            grid-template-columns: 1fr;
        }
        
        .pembelian-header {
            flex-direction: column;
            text-align: center;
        }
        
        .action-buttons {
            flex-direction: column;
        }
        
        .btn-action {
            width: 100%;
        }
    }
    
    @media (max-width: 576px) {
        .filter-options {
            grid-template-columns: 1fr;
        }
        
        .table-footer {
            flex-direction: column;
            align-items: stretch;
        }
        
        .pagination {
            justify-content: center;
        }
        
        .stats-grid {
            grid-template-columns: 1fr;
        }
        
        .summary-grid {
            grid-template-columns: repeat(2, 1fr);
        }
        
        .input-group {
            flex-direction: column;
        }
    }
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Data dummy laporan pembelian
    let laporanData = [
        {
            id: 1,
            kode_transaksi: "TRX-2024-001",
            tanggal_beli: "2024-03-15",
            ladang: "Pandiangan",
            harga_per_kg: 12500,
            jumlah_kg: 500,
            total_harga: 6250000,
            status: "Verifikasi",
            manajer: "Ronny",
            bukti_foto: "https://example.com/bukti1.jpg",
            catatan: "Pembelian jeruk musiman, kondisi baik",
            verifikasi_history: [
                { tanggal: "2024-03-16 10:30:00", oleh: "Admin Pusat", status: "Verifikasi", catatan: "Data lengkap dan valid" }
            ],
            created_at: "2024-03-15 14:20:00"
        },
        {
            id: 2,
            kode_transaksi: "TRX-2024-002",
            tanggal_beli: "2024-03-14",
            ladang: "Siregar",
            harga_per_kg: 11500,
            jumlah_kg: 300,
            total_harga: 3450000,
            status: "Pending",
            manajer: "Risto",
            bukti_foto: "https://example.com/bukti2.jpg",
            catatan: "Harga sesuai musim",
            verifikasi_history: [],
            created_at: "2024-03-14 11:15:00"
        },
        {
            id: 3,
            kode_transaksi: "TRX-2024-003",
            tanggal_beli: "2024-03-13",
            ladang: "Silalahi",
            harga_per_kg: 12000,
            jumlah_kg: 450,
            total_harga: 5400000,
            status: "Reject",
            manajer: "Rieno",
            bukti_foto: "https://example.com/bukti3.jpg",
            catatan: "Kualitas kurang baik",
            verifikasi_history: [
                { tanggal: "2024-03-13 16:45:00", oleh: "Admin Pusat", status: "Reject", catatan: "Bukti foto tidak jelas" }
            ],
            created_at: "2024-03-13 09:30:00"
        },
        {
            id: 4,
            kode_transaksi: "TRX-2024-004",
            tanggal_beli: "2024-03-12",
            ladang: "Pandiangan",
            harga_per_kg: 13000,
            jumlah_kg: 600,
            total_harga: 7800000,
            status: "Verifikasi",
            manajer: "Yekris",
            bukti_foto: "https://example.com/bukti4.jpg",
            catatan: "Pembelian untuk stock mingguan",
            verifikasi_history: [
                { tanggal: "2024-03-12 15:20:00", oleh: "Admin Pusat", status: "Verifikasi", catatan: "Semua dokumen lengkap" }
           ],
            created_at: "2024-03-12 08:45:00"
        },
        {
            id: 5,
            kode_transaksi: "TRX-2024-005",
            tanggal_beli: "2024-03-11",
            ladang: "Siregar",
            harga_per_kg: 11000,
            jumlah_kg: 350,
            total_harga: 3850000,
            status: "Pending",
            manajer: "Trhesya",
            bukti_foto: "https://example.com/bukti5.jpg",
            catatan: "Jeruk grade A",
            verifikasi_history: [],
            created_at: "2024-03-11 13:10:00"
        },
        {
            id: 6,
            kode_transaksi: "TRX-2024-005",
            tanggal_beli: "2024-03-11",
            ladang: "Siregar",
            harga_per_kg: 11000,
            jumlah_kg: 350,
            total_harga: 3850000,
            status: "Pending",
            manajer: "Maharani",
            bukti_foto: "https://example.com/bukti5.jpg",
            catatan: "Jeruk grade A",
            verifikasi_history: [],
            created_at: "2024-03-11 13:10:00"
        }
    ];

    // Variabel global untuk state
    let currentPage = 1;
    const itemsPerPage = 10;
    let filteredData = [...laporanData];
    let selectedTransactionId = null;

    // Fungsi format angka ke Rupiah
    function formatRupiah(angka) {
        return 'Rp ' + angka.toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.');
    }

    // Fungsi format tanggal
    function formatDate(dateString) {
        const options = { day: '2-digit', month: '2-digit', year: 'numeric' };
        return new Date(dateString).toLocaleDateString('id-ID', options);
    }

    // Fungsi update statistik
    function updateStatistics() {
        const totalTransaksi = filteredData.length;
        const totalBerat = filteredData.reduce((sum, item) => sum + item.jumlah_kg, 0);
        const totalNilai = filteredData.reduce((sum, item) => sum + item.total_harga, 0);
        const totalVerified = filteredData.filter(item => item.status === 'Verifikasi').length;

        document.getElementById('totalTransaksi').textContent = totalTransaksi;
        document.getElementById('totalBerat').textContent = totalBerat.toLocaleString() + ' Kg';
        document.getElementById('totalNilai').textContent = formatRupiah(totalNilai);
        document.getElementById('totalVerified').textContent = totalVerified;
    }

    // Fungsi render tabel
    function renderTable() {
        const tbody = document.getElementById('laporanTableBody');
        const startIndex = (currentPage - 1) * itemsPerPage;
        const endIndex = startIndex + itemsPerPage;
        const currentData = filteredData.slice(startIndex, endIndex);

        tbody.innerHTML = '';

        if (currentData.length === 0) {
            tbody.innerHTML = `
                <tr>
                    <td colspan="9" style="text-align: center; padding: 40px;">
                        <div style="color: var(--text-light); font-size: 14px;">
                            <i class="fas fa-search" style="font-size: 48px; margin-bottom: 15px; color: var(--border);"></i>
                            <div>Tidak ada data ditemukan</div>
                        </div>
                    </td>
                </tr>
            `;
            return;
        }

        currentData.forEach((item, index) => {
            const rowNumber = startIndex + index + 1;
            const row = document.createElement('tr');
            
            // Tentukan class status badge
            let statusClass = '';
            switch(item.status) {
                case 'Verifikasi':
                    statusClass = 'badge-Verifikasi';
                    break;
                case 'Pending':
                    statusClass = 'badge-Pending';
                    break;
                case 'Reject':
                    statusClass = 'badge-Reject';
                    break;
            }

            row.innerHTML = `
                <td>${rowNumber}</td>
                <td>
                    <div style="font-weight: 500;">${formatDate(item.tanggal_beli)}</div>
                    <div style="font-size: 12px; color: var(--text-light);">${item.kode_transaksi}</div>
                </td>
                <td>
                    <span class="ladang-badge">
                        <i class="fas fa-tractor"></i>
                        ${item.ladang}
                    </span>
                </td>
                <td>
                    <span class="price-badge">
                        <i class="fas fa-tag"></i>
                        ${formatRupiah(item.harga_per_kg)}/kg
                    </span>
                </td>
                <td>
                    <span class="weight-badge">
                        <i class="fas fa-weight-hanging"></i>
                        ${item.jumlah_kg.toLocaleString()} Kg
                    </span>
                </td>
                <td>
                    <span class="total-badge">
                        <i class="fas fa-money-bill-wave"></i>
                        ${formatRupiah(item.total_harga)}
                    </span>
                </td>
                <td>
                    <span class="status-badge ${statusClass}">${item.status}</span>
                </td>
                <td>${item.manajer}</td>
                <td>
                    <div class="action-buttons">
                        <button class="btn-action btn-view" onclick="showDetail(${item.id})" title="Detail">
                            <i class="fas fa-eye"></i>
                        </button>
                        <button class="btn-action btn-bukti" onclick="showBukti('${item.bukti_foto}')" title="Lihat Bukti">
                            <i class="fas fa-receipt"></i>
                        </button>
                        <button class="btn-action btn-verify" onclick="showVerifyModal(${item.id})" title="Verifikasi">
                            <i class="fas fa-check"></i>
                        </button>
                    </div>
                </td>
            `;
            tbody.appendChild(row);
        });

        updatePagination();
        updateStatistics();
        updateShowingCount();
    }

    // Fungsi update pagination
    function updatePagination() {
        const totalPages = Math.ceil(filteredData.length / itemsPerPage);
        document.getElementById('currentPage').textContent = currentPage;
        document.getElementById('totalPages').textContent = totalPages;

        const pageNumbersContainer = document.getElementById('pageNumbers');
        pageNumbersContainer.innerHTML = '';

        // Tentukan range halaman yang ditampilkan
        let startPage = Math.max(1, currentPage - 2);
        let endPage = Math.min(totalPages, currentPage + 2);

        // Pastikan selalu ada 5 halaman yang ditampilkan jika memungkinkan
        if (endPage - startPage < 4 && totalPages > 5) {
            if (currentPage < 3) {
                endPage = Math.min(5, totalPages);
            } else if (currentPage > totalPages - 2) {
                startPage = Math.max(totalPages - 4, 1);
            }
        }

        // Tambahkan button untuk halaman pertama jika perlu
        if (startPage > 1) {
            const firstPageBtn = document.createElement('button');
            firstPageBtn.className = 'page-number';
            firstPageBtn.textContent = '1';
            firstPageBtn.onclick = () => goToPage(1);
            pageNumbersContainer.appendChild(firstPageBtn);

            if (startPage > 2) {
                const ellipsis = document.createElement('span');
                ellipsis.className = 'page-number';
                ellipsis.textContent = '...';
                ellipsis.style.cursor = 'default';
                ellipsis.onclick = null;
                pageNumbersContainer.appendChild(ellipsis);
            }
        }

        // Tambahkan button untuk halaman-halaman
        for (let i = startPage; i <= endPage; i++) {
            const pageBtn = document.createElement('button');
            pageBtn.className = `page-number ${i === currentPage ? 'active' : ''}`;
            pageBtn.textContent = i;
            pageBtn.onclick = () => goToPage(i);
            pageNumbersContainer.appendChild(pageBtn);
        }

        // Tambahkan button untuk halaman terakhir jika perlu
        if (endPage < totalPages) {
            if (endPage < totalPages - 1) {
                const ellipsis = document.createElement('span');
                ellipsis.className = 'page-number';
                ellipsis.textContent = '...';
                ellipsis.style.cursor = 'default';
                ellipsis.onclick = null;
                pageNumbersContainer.appendChild(ellipsis);
            }

            const lastPageBtn = document.createElement('button');
            lastPageBtn.className = 'page-number';
            lastPageBtn.textContent = totalPages;
            lastPageBtn.onclick = () => goToPage(totalPages);
            pageNumbersContainer.appendChild(lastPageBtn);
        }

        // Update tombol previous/next
        document.querySelector('.btn-pagination.prev').disabled = currentPage === 1;
        document.querySelector('.btn-pagination.next').disabled = currentPage === totalPages || totalPages === 0;
    }

    // Fungsi pergi ke halaman tertentu
    function goToPage(page) {
        currentPage = page;
        renderTable();
    }

    // Fungsi update showing count
    function updateShowingCount() {
        const startIndex = (currentPage - 1) * itemsPerPage + 1;
        const endIndex = Math.min(startIndex + itemsPerPage - 1, filteredData.length);
        const total = filteredData.length;

        document.getElementById('showingCount').textContent = total === 0 ? '0' : `${startIndex}-${endIndex}`;
        document.getElementById('totalCount').textContent = total;
    }

    // Fungsi filter data
    function filterData() {
        const periode = document.getElementById('filterPeriode').value;
        const status = document.getElementById('filterStatus').value;
        const ladang = document.getElementById('filterLadang').value;
        const tanggalAwal = document.getElementById('filterTanggalAwal').value;
        const tanggalAkhir = document.getElementById('filterTanggalAkhir').value;

        filteredData = laporanData.filter(item => {
            // Filter status
            if (status && item.status !== status) return false;

            // Filter ladang
            if (ladang && item.ladang !== ladang) return false;

            // Filter periode
            const itemDate = new Date(item.tanggal_beli);
            const today = new Date();
            
            if (periode === 'hari-ini') {
                return itemDate.toDateString() === today.toDateString();
            } else if (periode === 'minggu-ini') {
                const startOfWeek = new Date(today);
                startOfWeek.setDate(today.getDate() - today.getDay());
                startOfWeek.setHours(0, 0, 0, 0);
                
                const endOfWeek = new Date(today);
                endOfWeek.setDate(today.getDate() + (6 - today.getDay()));
                endOfWeek.setHours(23, 59, 59, 999);
                
                return itemDate >= startOfWeek && itemDate <= endOfWeek;
            } else if (periode === 'bulan-ini') {
                const startOfMonth = new Date(today.getFullYear(), today.getMonth(), 1);
                const endOfMonth = new Date(today.getFullYear(), today.getMonth() + 1, 0, 23, 59, 59, 999);
                
                return itemDate >= startOfMonth && itemDate <= endOfMonth;
            } else if (periode === 'bulan-lalu') {
                const startOfLastMonth = new Date(today.getFullYear(), today.getMonth() - 1, 1);
                const endOfLastMonth = new Date(today.getFullYear(), today.getMonth(), 0, 23, 59, 59, 999);
                
                return itemDate >= startOfLastMonth && itemDate <= endOfLastMonth;
            } else if (periode === 'custom') {
                if (!tanggalAwal || !tanggalAkhir) return true;
                
                const start = new Date(tanggalAwal);
                start.setHours(0, 0, 0, 0);
                
                const end = new Date(tanggalAkhir);
                end.setHours(23, 59, 59, 999);
                
                return itemDate >= start && itemDate <= end;
            }

            return true;
        });

        currentPage = 1;
        renderTable();
    }

    // Fungsi reset filter
    function resetFilter() {
        document.getElementById('filterPeriode').value = '';
        document.getElementById('filterStatus').value = '';
        document.getElementById('filterLadang').value = '';
        document.getElementById('filterTanggalAwal').value = '';
        document.getElementById('filterTanggalAkhir').value = '';
        document.getElementById('customDateGroup').style.display = 'none';
        
        filteredData = [...laporanData];
        currentPage = 1;
        renderTable();
    }

    // Fungsi show detail modal
    window.showDetail = function(id) {
        selectedTransactionId = id;
        const transaction = laporanData.find(item => item.id === id);
        
        if (!transaction) return;

        let statusClass = '';
        let statusColor = '';
        switch(transaction.status) {
            case 'Verifikasi':
                statusClass = 'badge-Verifikasi';
                statusColor = '#2E7D32';
                break;
            case 'Pending':
                statusClass = 'badge-Pending';
                statusColor = '#EF6C00';
                break;
            case 'Reject':
                statusClass = 'badge-Reject';
                statusColor = '#C62828';
                break;
        }

        const detailHTML = `
            <div class="pembelian-header">
                <div class="pembelian-title">
                    <h3>${transaction.kode_transaksi}</h3>
                    <div class="pembelian-subtitle">Tanggal Pembelian: ${formatDate(transaction.tanggal_beli)}</div>
                </div>
                <div style="text-align: right;">
                    <span class="status-badge ${statusClass}" style="font-size: 14px; padding: 8px 16px;">
                        ${transaction.status}
                    </span>
                </div>
            </div>

            <div class="pembelian-info-grid">
                <div class="info-card">
                    <div class="info-label">Informasi Ladang</div>
                    <div class="info-value">
                        <i class="fas fa-tractor" style="margin-right: 8px;"></i>
                        ${transaction.ladang}
                    </div>
                    <div class="info-subvalue">
                        <i class="fas fa-user-tie" style="margin-right: 8px;"></i>
                        ${transaction.manajer}
                    </div>
                </div>

                <div class="info-card">
                    <div class="info-label">Detail Pembelian</div>
                    <div class="info-value">
                        <i class="fas fa-weight-hanging" style="margin-right: 8px;"></i>
                        ${transaction.jumlah_kg.toLocaleString()} Kg
                    </div>
                    <div class="info-subvalue">
                        <i class="fas fa-tag" style="margin-right: 8px;"></i>
                        ${formatRupiah(transaction.harga_per_kg)} per Kg
                    </div>
                </div>

                <div class="info-card">
                    <div class="info-label">Total Nilai</div>
                    <div class="info-value" style="color: var(--primary); font-size: 20px;">
                        ${formatRupiah(transaction.total_harga)}
                    </div>
                    <div class="info-subvalue">
                        <i class="fas fa-clock" style="margin-right: 8px;"></i>
                        ${new Date(transaction.created_at).toLocaleString('id-ID')}
                    </div>
                </div>
            </div>

            <div style="background: var(--light); padding: 20px; border-radius: 8px; margin-bottom: 20px;">
                <div style="font-weight: 600; margin-bottom: 10px; color: var(--text-dark);">
                    <i class="fas fa-sticky-note" style="margin-right: 8px;"></i>
                    Catatan Pembelian
                </div>
                <div style="color: var(--text-dark);">
                    ${transaction.catatan || 'Tidak ada catatan'}
                </div>
            </div>

            <div class="price-summary">
                <div style="font-weight: 600; margin-bottom: 15px; color: var(--text-dark);">
                    <i class="fas fa-calculator" style="margin-right: 8px;"></i>
                    Ringkasan Harga
                </div>
                <div class="summary-grid">
                    <div class="summary-card">
                        <div class="summary-value">${transaction.jumlah_kg.toLocaleString()}</div>
                        <div class="summary-label">Total Berat (Kg)</div>
                    </div>
                    <div class="summary-card">
                        <div class="summary-value">${formatRupiah(transaction.harga_per_kg)}</div>
                        <div class="summary-label">Harga per Kg</div>
                    </div>
                    <div class="summary-card">
                        <div class="summary-value">${formatRupiah(transaction.total_harga)}</div>
                        <div class="summary-label">Total Nilai</div>
                    </div>
                </div>
            </div>

            ${transaction.verifikasi_history.length > 0 ? `
            <div class="verification-history">
                <div style="font-weight: 600; margin-bottom: 15px; color: var(--text-dark);">
                    <i class="fas fa-history" style="margin-right: 8px;"></i>
                    Riwayat Verifikasi
                </div>
                ${transaction.verifikasi_history.map(history => `
                    <div class="verification-item">
                        <div class="verification-icon">
                            <i class="fas fa-check-circle"></i>
                        </div>
                        <div class="verification-content">
                            <div class="verification-header">
                                <div class="verification-title">${history.oleh}</div>
                                <div class="verification-time">${history.tanggal}</div>
                            </div>
                            <div style="display: flex; align-items: center; gap: 10px; margin-top: 5px;">
                                <span class="status-badge badge-${history.status}" style="font-size: 11px; padding: 4px 8px;">
                                    ${history.status}
                                </span>
                            </div>
                            ${history.catatan ? `
                                <div class="verification-note">
                                    <strong>Catatan:</strong> ${history.catatan}
                                </div>
                            ` : ''}
                        </div>
                    </div>
                `).join('')}
            </div>
            ` : ''}
        `;

        document.getElementById('detailModalBody').innerHTML = detailHTML;
        document.getElementById('detailModal').style.display = 'flex';
    };

    // Fungsi show bukti modal
    window.showBukti = function(imageUrl) {
        const buktiHTML = `
            <img src="${imageUrl}" alt="Bukti Pembelian" class="bukti-image">
            <div style="margin-top: 20px; color: var(--text-light); font-size: 14px;">
                <i class="fas fa-info-circle" style="margin-right: 8px;"></i>
                Bukti pembelian ini diupload oleh manajer lapangan
            </div>
        `;

        document.getElementById('buktiImageContainer').innerHTML = buktiHTML;
        document.getElementById('buktiModal').style.display = 'flex';
    };

    // Fungsi show verify modal
    window.showVerifyModal = function(id) {
        selectedTransactionId = id;
        const transaction = laporanData.find(item => item.id === id);
        
        if (!transaction) return;

        document.getElementById('currentStatus').innerHTML = `
            <span class="status-badge badge-${transaction.status}" style="font-size: 13px;">
                ${transaction.status}
            </span>
        `;

        document.getElementById('newStatus').value = transaction.status;
        document.getElementById('verifikasiNote').value = '';
        
        document.getElementById('verifyModal').style.display = 'flex';
    };

    // Fungsi verifikasi transaksi
    function verifyTransaction() {
        const newStatus = document.getElementById('newStatus').value;
        const note = document.getElementById('verifikasiNote').value;

        const transactionIndex = laporanData.findIndex(item => item.id === selectedTransactionId);
        
        if (transactionIndex === -1) return;

        // Update status transaksi
        laporanData[transactionIndex].status = newStatus;
        
        // Tambahkan history verifikasi
        laporanData[transactionIndex].verifikasi_history.push({
            tanggal: new Date().toLocaleString('id-ID'),
            oleh: 'Admin Pusat',
            status: newStatus,
            catatan: note
        });

        // Close modal
        document.getElementById('verifyModal').style.display = 'none';
        
        // Refresh data
        filterData();
        
        // Show success message
        alert('Status pembelian berhasil diperbarui!');
    }

    // Fungsi print laporan
    function printReport() {
        // Implement print functionality
        alert('Fitur cetak laporan akan diimplementasikan');
    }

    // Fungsi export Excel
    function exportToExcel() {
        // Implement export functionality
        alert('Fitur export Excel akan diimplementasikan');
    }

    // Event Listeners
    document.getElementById('applyFilterBtn').addEventListener('click', filterData);
    document.getElementById('resetFilterBtn').addEventListener('click', resetFilter);
    document.getElementById('printBtn').addEventListener('click', printReport);
    document.getElementById('exportBtn').addEventListener('click', exportToExcel);

    document.querySelector('.btn-pagination.prev').addEventListener('click', () => {
        if (currentPage > 1) goToPage(currentPage - 1);
    });

    document.querySelector('.btn-pagination.next').addEventListener('click', () => {
        const totalPages = Math.ceil(filteredData.length / itemsPerPage);
        if (currentPage < totalPages) goToPage(currentPage + 1);
    });

    document.getElementById('filterPeriode').addEventListener('change', function() {
        document.getElementById('customDateGroup').style.display = 
            this.value === 'custom' ? 'block' : 'none';
    });

    // Modal close handlers
    document.querySelectorAll('.close-detail-modal').forEach(btn => {
        btn.addEventListener('click', () => {
            document.getElementById('detailModal').style.display = 'none';
        });
    });

    document.querySelectorAll('.close-verify-modal').forEach(btn => {
        btn.addEventListener('click', () => {
            document.getElementById('verifyModal').style.display = 'none';
        });
    });

    document.querySelectorAll('.close-bukti-modal').forEach(btn => {
        btn.addEventListener('click', () => {
            document.getElementById('buktiModal').style.display = 'none';
        });
    });

    // Close modal when clicking outside
    window.addEventListener('click', (event) => {
        const modals = ['detailModal', 'verifyModal', 'buktiModal'];
        modals.forEach(modalId => {
            const modal = document.getElementById(modalId);
            if (event.target === modal) {
                modal.style.display = 'none';
            }
        });
    });

    // Verify button handler
    document.getElementById('confirmVerifyBtn').addEventListener('click', verifyTransaction);

    // Print detail button handler
    document.getElementById('printDetailBtn').addEventListener('click', () => {
        alert('Fitur cetak detail akan diimplementasikan');
    });

    // Download bukti button handler
    document.getElementById('downloadBuktiBtn').addEventListener('click', () => {
        alert('Fitur download bukti akan diimplementasikan');
    });

    // Initialize
    renderTable();
});
</script>

@endsection