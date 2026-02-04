{{-- resources/views/pusat/laporan-pengiriman.blade.php --}}
@extends('layouts.pusat')

@section('title', 'Laporan Data Pengiriman - PT. Mardua Holong')

@section('page-title', 'Laporan Data Pengiriman')
@section('page-subtitle', 'Monitor seluruh pengiriman jeruk dari gudang ke tujuan')

@section('content')
<div class="content-wrapper">
    <!-- Header -->
    <div class="content-header">
        <div class="header-left">
        </div>
        <div class="header-right">
            <div class="btn-group">
                <button type="button" id="printBtn" class="btn btn-primary">
                    <i class="fas fa-print"></i> Cetak Laporan
                </button>
                <button type="button" id="exportExcelBtn" class="btn btn-success">
                    <i class="fas fa-file-excel"></i> Export Excel
                </button>
            </div>
        </div>
    </div>
    
    <!-- Statistik Utama -->
    <div class="stats-grid">
        <div class="stat-card">
            <div class="stat-icon">
                <i class="fas fa-truck"></i>
            </div>
            <div class="stat-content">
                <div class="stat-value" id="totalPengiriman">0</div>
                <div class="stat-label">Total Pengiriman</div>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon">
                <i class="fas fa-boxes"></i>
            </div>
            <div class="stat-content">
                <div class="stat-value" id="totalBarang">0 Item</div>
                <div class="stat-label">Total Barang</div>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon">
                <i class="fas fa-weight-hanging"></i>
            </div>
            <div class="stat-content">
                <div class="stat-value" id="totalBerat">0 Kg</div>
                <div class="stat-label">Total Berat</div>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon">
                <i class="fas fa-map-marker-alt"></i>
            </div>
            <div class="stat-content">
                <div class="stat-value" id="activeDelivery">0</div>
                <div class="stat-label">Dalam Perjalanan</div>
            </div>
        </div>
    </div>
    
    <!-- Filter Section -->
    <div class="content-card filter-section">
        <div class="filter-header">
            <div class="filter-title">
                <i class="fas fa-filter"></i>
                <span>Filter Laporan</span>
            </div>
            <button type="button" id="toggleFilterBtn" class="btn-toggle">
                <i class="fas fa-chevron-down"></i>
            </button>
        </div>
        
        <div class="filter-content">
            <div class="filter-grid">
                <div class="filter-group">
                    <label class="filter-label">Periode Waktu</label>
                    <select id="filterPeriode" class="form-control">
                        <option value="">Semua Periode</option>
                        <option value="hari-ini">Hari Ini</option>
                        <option value="minggu-ini">Minggu Ini</option>
                        <option value="bulan-ini">Bulan Ini</option>
                        <option value="triwulan">Triwulan Terakhir</option>
                        <option value="custom">Custom</option>
                    </select>
                </div>
                
                <div class="filter-group custom-date-group" style="display: none;">
                    <label class="filter-label">Tanggal Custom</label>
                    <div class="date-range">
                        <input type="date" id="filterTanggalAwal" class="form-control" placeholder="Tanggal Awal">
                        <span class="date-separator">s/d</span>
                        <input type="date" id="filterTanggalAkhir" class="form-control" placeholder="Tanggal Akhir">
                    </div>
                </div>
                
                <div class="filter-group">
                    <label class="filter-label">Status Pengiriman</label>
                    <select id="filterStatus" class="form-control">
                        <option value="">Semua Status</option>
                        <option value="dipanen">Dipanen</option>
                        <option value="dikemas">Dikemas</option>
                        <option value="dikirim">Dalam Pengiriman</option>
                        <option value="diterima">Diterima</option>
                        <option value="batal">Dibatalkan</option>
                    </select>
                </div>
                
                <div class="filter-group">
                    <label class="filter-label">Supir</label>
                    <select id="filterSupir" class="form-control">
                        <option value="">Semua Supir</option>
                        <option value="Ronny">Ronny</option>
                        <option value="Rieno">Rieno</option>
                        <option value="Risto">Risto</option>
                        <option value="Yekris">Yekris</option>
                        <option value="Trhesya">Trhesya</option>
                        <option value="Maharani">Maharani</option>
                    </select>
                </div>
                
                <div class="filter-group">
                    <label class="filter-label">Tujuan</label>
                    <select id="filterTujuan" class="form-control">
                        <option value="">Semua Tujuan</option>
                        <option value="Medan">Medan</option>
                        <option value="Jakarta">Jakarta</option>
                        <option value="Surabaya">Surabaya</option>
                        <option value="Makassar">Makassar</option>
                        <option value="Palembang">Palembang</option>
                        <option value="Bandung">Bandung</option>
                    </select>
                </div>
                
                <div class="filter-group filter-actions-group">
                    <label class="filter-label">&nbsp;</label>
                    <div class="filter-actions">
                        <button type="button" id="applyFilterBtn" class="btn btn-primary">
                            <i class="fas fa-search"></i> Terapkan
                        </button>
                        <button type="button" id="resetFilterBtn" class="btn btn-secondary">
                            <i class="fas fa-redo"></i> Reset
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Tabel Data Pengiriman -->
    <div class="content-card">
        <div class="card-header">
            <div class="card-title">
                <i class="fas fa-truck-loading"></i>
                <span>Data Pengiriman Jeruk</span>
            </div>
            <div class="card-info">
                Menampilkan <span id="showingData">0</span> dari <span id="totalData">0</span> pengiriman
            </div>
        </div>
        
        <div class="table-container">
            <div class="table-responsive">
                <table class="data-table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Kode Pengiriman</th>
                            <th>Tanggal Kirim</th>
                            <th>Barang</th>
                            <th>Supir</th>
                            <th>Kendaraan</th>
                            <th>Rute</th>
                            <th>Tujuan</th>
                            <th>Status</th>
                            <th>Progress</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="pengirimanTableBody">
                        <!-- Data akan diisi oleh JavaScript -->
                    </tbody>
                </table>
            </div>
        </div>
        
        <div class="table-footer">
            <div class="showing-count">
                Halaman <span id="currentPage">1</span> dari <span id="totalPages">1</span>
            </div>
            <div class="pagination">
                <button type="button" class="btn-pagination prev">
                    <i class="fas fa-chevron-left"></i>
                </button>
                <div class="page-numbers" id="pageNumbers"></div>
                <button type="button" class="btn-pagination next">
                    <i class="fas fa-chevron-right"></i>
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Detail Pengiriman -->
<div id="detailModal" class="modal">
    <div class="modal-content modal-lg">
        <div class="modal-header">
            <h3 class="modal-title">Detail Data Pengiriman</h3>
            <button type="button" class="close-modal" data-modal="detailModal">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <div class="modal-body" id="detailModalBody">
            <!-- Detail akan diisi oleh JavaScript -->
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary close-modal" data-modal="detailModal">
                Tutup
            </button>
            <button type="button" class="btn btn-primary" id="printDetailBtn">
                <i class="fas fa-print"></i> Cetak Detail
            </button>
            <button type="button" class="btn btn-success" id="updateStatusBtn">
                <i class="fas fa-sync-alt"></i> Update Status
            </button>
        </div>
    </div>
</div>

<!-- Modal Update Status -->
<div id="updateStatusModal" class="modal">
    <div class="modal-content">
        <div class="modal-header">
            <h3 class="modal-title">Update Status Pengiriman</h3>
            <button type="button" class="close-modal" data-modal="updateStatusModal">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <div class="modal-body">
            <div class="form-group">
                <label class="form-label">Status Saat Ini</label>
                <div id="currentStatus" style="padding: 10px; background-color: var(--bg-light); border-radius: 6px; margin-bottom: 15px;">
                    -</div>
            </div>
            <div class="form-group">
                <label class="form-label">Update Status Menjadi</label>
                <select id="newStatus" class="form-control">
                    <option value="dipanen">Dipanen</option>
                    <option value="dikemas">Dikemas</option>
                    <option value="dikirim">Dalam Pengiriman</option>
                    <option value="diterima">Diterima</option>
                    <option value="batal">Dibatalkan</option>
                </select>
            </div>
            <div class="form-group">
                <label class="form-label">Catatan Update</label>
                <textarea id="statusNote" class="form-control" rows="3" placeholder="Masukkan catatan update status..."></textarea>
                <small class="text-muted">Catatan ini akan ditampilkan di riwayat status</small>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary close-modal" data-modal="updateStatusModal">
                Batal
            </button>
            <button type="button" class="btn btn-primary" id="confirmUpdateBtn">
                <i class="fas fa-check-circle"></i> Konfirmasi
            </button>
        </div>
    </div>
</div>

<!-- Modal Tracking Pengiriman -->
<div id="trackingModal" class="modal">
    <div class="modal-content modal-lg">
        <div class="modal-header">
            <h3 class="modal-title">Tracking Pengiriman</h3>
            <button type="button" class="close-modal" data-modal="trackingModal">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <div class="modal-body">
            <div id="trackingMap" style="height: 300px; background-color: var(--bg-light); border-radius: 8px; margin-bottom: 20px; display: flex; align-items: center; justify-content: center; color: var(--text-light);">
                <div style="text-align: center;">
                    <i class="fas fa-map" style="font-size: 48px; margin-bottom: 10px; opacity: 0.5;"></i>
                    <div>Peta tracking akan ditampilkan di sini</div>
                </div>
            </div>
            
            <h4 style="margin-bottom: 15px; color: var(--text-dark);">
                <i class="fas fa-history"></i> Riwayat Status
            </h4>
            <div id="trackingHistory">
                <!-- Riwayat akan diisi oleh JavaScript -->
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary close-modal" data-modal="trackingModal">
                Tutup
            </button>
        </div>
    </div>
</div>

<!-- Modal Detail Barang -->
<div id="barangModal" class="modal">
    <div class="modal-content">
        <div class="modal-header">
            <h3 class="modal-title">Detail Barang Pengiriman</h3>
            <button type="button" class="close-modal" data-modal="barangModal">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <div class="modal-body">
            <div id="barangList">
                <!-- Daftar barang akan diisi oleh JavaScript -->
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary close-modal" data-modal="barangModal">
                Tutup
            </button>
        </div>
    </div>
</div>

<style>
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
        --bg-light: #F8F9FA;
        --text-dark: #212529;
        --text-light: #6C757D;
        --text-muted: #95A5A6;
        --transition: all 0.3s ease;
        --radius-sm: 6px;
        --radius-md: 10px;
        --radius-lg: 14px;
        --shadow-sm: 0 1px 3px rgba(0,0,0,0.12);
        --shadow-md: 0 4px 6px rgba(0,0,0,0.1);
    }
    
    /* Base Styles */
    .content-wrapper {
        padding: 20px;
    }
    
    /* Header */
    .content-header {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        margin-bottom: 30px;
        flex-wrap: wrap;
        gap: 20px;
    }
    
    .header-left h1 {
        font-size: 28px;
        font-weight: 700;
        color: var(--text-dark);
        margin: 0 0 8px 0;
    }
    
    .header-left p {
        color: var(--text-light);
        margin: 0;
        font-size: 15px;
    }
    
    .header-right .btn-group {
        display: flex;
        gap: 10px;
        flex-wrap: wrap;
    }
    
    /* Stats Grid */
    .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
        gap: 20px;
        margin-bottom: 30px;
    }
    
    .stat-card {
        background: white;
        border-radius: var(--radius-md);
        padding: 20px;
        box-shadow: var(--shadow-sm);
        border: 1px solid var(--border);
        display: flex;
        align-items: center;
        gap: 20px;
        transition: var(--transition);
    }
    
    .stat-card:hover {
        transform: translateY(-2px);
        box-shadow: var(--shadow-md);
    }
    
    .stat-icon {
        width: 60px;
        height: 60px;
        border-radius: var(--radius-md);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 24px;
        color: white;
        flex-shrink: 0;
        background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
    }
    
    .stat-card:nth-child(2) .stat-icon {
        background: linear-gradient(135deg, var(--success) 0%, #218838 100%);
    }
    
    .stat-card:nth-child(3) .stat-icon {
        background: linear-gradient(135deg, var(--warning) 0%, #e0a800 100%);
    }
    
    .stat-card:nth-child(4) .stat-icon {
        background: linear-gradient(135deg, var(--info) 0%, #138496 100%);
    }
    
    .stat-content {
        flex: 1;
    }
    
    .stat-value {
        font-size: 28px;
        font-weight: 700;
        color: var(--text-dark);
        margin-bottom: 4px;
        line-height: 1;
    }
    
    .stat-label {
        font-size: 14px;
        color: var(--text-light);
        font-weight: 500;
    }
    
    /* Filter Section */
    .filter-section {
        background: white;
        border-radius: var(--radius-md);
        padding: 20px;
        box-shadow: var(--shadow-sm);
        border: 1px solid var(--border);
        margin-bottom: 25px;
    }
    
    .filter-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px;
    }
    
    .filter-title {
        display: flex;
        align-items: center;
        gap: 10px;
        font-weight: 600;
        color: var(--text-dark);
        font-size: 16px;
    }
    
    .filter-title i {
        color: var(--primary);
    }
    
    .btn-toggle {
        background: none;
        border: none;
        width: 36px;
        height: 36px;
        border-radius: var(--radius-sm);
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        color: var(--text-light);
        transition: var(--transition);
    }
    
    .btn-toggle:hover {
        background-color: var(--bg-light);
        color: var(--text-dark);
    }
    
    .filter-content {
        overflow: hidden;
        transition: var(--transition);
    }
    
    .filter-content.collapsed {
        max-height: 0;
        opacity: 0;
        margin: 0;
    }
    
    .filter-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
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
    
    /* Form Controls */
    .form-control {
        width: 100%;
        padding: 12px 15px;
        border: 1px solid var(--border);
        border-radius: var(--radius-sm);
        font-size: 14px;
        color: var(--text-dark);
        background-color: white;
        transition: var(--transition);
    }
    
    .form-control:focus {
        outline: none;
        border-color: var(--primary);
        box-shadow: 0 0 0 3px rgba(45, 106, 79, 0.1);
    }
    
    .date-range {
        display: flex;
        align-items: center;
        gap: 10px;
    }
    
    .date-separator {
        color: var(--text-muted);
        font-size: 14px;
        flex-shrink: 0;
    }
    
    .filter-actions {
        display: flex;
        gap: 10px;
        flex-wrap: wrap;
    }
    
    /* Buttons */
    .btn {
        padding: 10px 20px;
        border-radius: var(--radius-sm);
        border: none;
        font-size: 14px;
        font-weight: 500;
        cursor: pointer;
        transition: var(--transition);
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        white-space: nowrap;
    }
    
    .btn-primary {
        background-color: var(--primary);
        color: white;
    }
    
    .btn-primary:hover {
        background-color: var(--primary-dark);
        transform: translateY(-1px);
        box-shadow: var(--shadow-sm);
    }
    
    .btn-secondary {
        background-color: var(--secondary);
        color: white;
    }
    
    .btn-secondary:hover {
        background-color: #5a6268;
        transform: translateY(-1px);
        box-shadow: var(--shadow-sm);
    }
    
    .btn-success {
        background-color: var(--success);
        color: white;
    }
    
    .btn-success:hover {
        background-color: #218838;
    }
    
    .btn-warning {
        background-color: var(--warning);
        color: var(--text-dark);
    }
    
    .btn-warning:hover {
        background-color: #e0a800;
    }
    
    .btn-danger {
        background-color: var(--danger);
        color: white;
    }
    
    .btn-danger:hover {
        background-color: #c82333;
    }
    
    /* Content Card */
    .content-card {
        background: white;
        border-radius: var(--radius-md);
        padding: 25px;
        box-shadow: var(--shadow-sm);
        border: 1px solid var(--border);
        margin-bottom: 25px;
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
        font-size: 18px;
        font-weight: 600;
        color: var(--text-dark);
    }
    
    .card-title i {
        color: var(--primary);
        font-size: 20px;
    }
    
    .card-info {
        font-size: 14px;
        color: var(--text-light);
        background: var(--bg-light);
        padding: 8px 16px;
        border-radius: var(--radius-sm);
        border: 1px solid var(--border);
    }
    
    /* Tables */
    .table-container {
        border-radius: var(--radius-sm);
        overflow: hidden;
        border: 1px solid var(--border);
    }
    
    .table-responsive {
        overflow-x: auto;
    }
    
    .data-table {
        width: 100%;
        border-collapse: collapse;
        min-width: 1200px;
    }
    
    .data-table thead {
        background-color: var(--bg-light);
    }
    
    .data-table th {
        padding: 16px;
        text-align: left;
        font-weight: 600;
        color: var(--text-dark);
        font-size: 14px;
        border-bottom: 2px solid var(--border);
        white-space: nowrap;
    }
    
    .data-table td {
        padding: 16px;
        font-size: 14px;
        color: var(--text-dark);
        border-bottom: 1px solid var(--border);
        vertical-align: middle;
    }
    
    .data-table tbody tr {
        transition: var(--transition);
    }
    
    .data-table tbody tr:hover {
        background-color: var(--primary-lighter);
    }
    
    /* Status Badges */
    .status-badge {
        display: inline-block;
        padding: 6px 12px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 600;
        text-align: center;
        min-width: 100px;
    }
    
    .status-dipanen {
        background-color: #D4EDDA;
        color: #155724;
        border: 1px solid #C3E6CB;
    }
    
    .status-dikemas {
        background-color: #D1ECF1;
        color: #0C5460;
        border: 1px solid #BEE5EB;
    }
    
    .status-dikirim {
        background-color: #FFF3CD;
        color: #856404;
        border: 1px solid #FFEAA7;
    }
    
    .status-diterima {
        background-color: #E2E3E5;
        color: #383D41;
        border: 1px solid #D6D8DB;
    }
    
    .status-batal {
        background-color: #F8D7DA;
        color: #721C24;
        border: 1px solid #F5C6CB;
    }
    
    /* Progress Bar */
    .progress-container {
        width: 120px;
        height: 8px;
        background-color: var(--border);
        border-radius: 4px;
        overflow: hidden;
        flex-shrink: 0;
    }
    
    .progress-bar {
        height: 100%;
        border-radius: 4px;
        transition: width 0.3s ease;
    }
    
    .progress-0 { background-color: var(--danger); width: 0%; }
    .progress-25 { background-color: #FF9800; width: 25%; }
    .progress-50 { background-color: #FFC107; width: 50%; }
    .progress-75 { background-color: #4CAF50; width: 75%; }
    .progress-100 { background-color: var(--success); width: 100%; }
    
    /* Action Buttons */
    .action-buttons {
        display: flex;
        gap: 8px;
    }
    
    .btn-action {
        width: 36px;
        height: 36px;
        border-radius: var(--radius-sm);
        border: none;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 14px;
        transition: var(--transition);
    }
    
    .btn-view {
        background-color: var(--primary-light);
        color: var(--primary-dark);
    }
    
    .btn-view:hover {
        background-color: var(--primary);
        color: white;
    }
    
    .btn-track {
        background-color: #D1ECF1;
        color: #0C5460;
    }
    
    .btn-track:hover {
        background-color: #0C5460;
        color: white;
    }
    
    .btn-update {
        background-color: #FFF3CD;
        color: #856404;
    }
    
    .btn-update:hover {
        background-color: #856404;
        color: white;
    }
    
    .btn-barang {
        background-color: #D4EDDA;
        color: #155724;
    }
    
    .btn-barang:hover {
        background-color: #155724;
        color: white;
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
        border-radius: var(--radius-sm);
        border: 1px solid var(--border);
        background-color: white;
        color: var(--text-dark);
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: var(--transition);
        font-size: 12px;
    }
    
    .btn-pagination:hover:not(:disabled) {
        background-color: var(--primary-light);
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
        border-radius: var(--radius-sm);
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
        background-color: var(--primary-light);
        border-color: var(--primary);
        color: var(--primary);
    }
    
    .page-number.active {
        background-color: var(--primary);
        border-color: var(--primary);
        color: white;
    }
    
    /* Modals */
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
        animation: fadeIn 0.3s ease;
    }
    
    .modal-content {
        background: white;
        border-radius: var(--radius-md);
        width: 100%;
        max-width: 600px;
        max-height: 90vh;
        overflow-y: auto;
        animation: slideIn 0.3s ease;
    }
    
    .modal-lg {
        max-width: 800px;
    }
    
    .modal-xl {
        max-width: 1200px;
    }
    
    @keyframes slideIn {
        from {
            opacity: 0;
            transform: translateY(-20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    
    .modal-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 20px;
        border-bottom: 1px solid var(--border);
        position: sticky;
        top: 0;
        background: white;
        z-index: 1;
    }
    
    .modal-title {
        margin: 0;
        font-size: 18px;
        font-weight: 600;
        color: var(--text-dark);
    }
    
    .close-modal {
        background: none;
        border: none;
        font-size: 18px;
        color: var(--text-light);
        cursor: pointer;
        transition: var(--transition);
        width: 36px;
        height: 36px;
        border-radius: var(--radius-sm);
        display: flex;
        align-items: center;
        justify-content: center;
    }
    
    .close-modal:hover {
        background-color: var(--bg-light);
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
        justify-content: flex-end;
    }
    
    /* Detail Styles */
    .detail-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 20px;
        margin-bottom: 25px;
    }
    
    .detail-card {
        background: var(--bg-light);
        padding: 20px;
        border-radius: var(--radius-md);
        border-left: 4px solid var(--primary);
    }
    
    .detail-label {
        font-size: 12px;
        color: var(--text-light);
        margin-bottom: 8px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        font-weight: 600;
    }
    
    .detail-value {
        font-size: 16px;
        font-weight: 600;
        color: var(--text-dark);
        margin-bottom: 8px;
        display: flex;
        align-items: center;
        gap: 8px;
    }
    
    .detail-subvalue {
        font-size: 14px;
        color: var(--text-light);
        display: flex;
        align-items: center;
        gap: 8px;
    }
    
    /* Tracking History */
    .tracking-timeline {
        position: relative;
        padding-left: 30px;
    }
    
    .tracking-timeline::before {
        content: '';
        position: absolute;
        left: 10px;
        top: 0;
        bottom: 0;
        width: 2px;
        background-color: var(--border);
    }
    
    .tracking-item {
        position: relative;
        margin-bottom: 20px;
    }
    
    .tracking-item:last-child {
        margin-bottom: 0;
    }
    
    .tracking-item::before {
        content: '';
        position: absolute;
        left: -20px;
        top: 5px;
        width: 12px;
        height: 12px;
        border-radius: 50%;
        background-color: var(--primary);
        border: 2px solid white;
        box-shadow: 0 0 0 2px var(--primary);
    }
    
    .tracking-item.completed::before {
        background-color: var(--success);
        box-shadow: 0 0 0 2px var(--success);
    }
    
    .tracking-item.pending::before {
        background-color: var(--warning);
        box-shadow: 0 0 0 2px var(--warning);
    }
    
    .tracking-item.cancelled::before {
        background-color: var(--danger);
        box-shadow: 0 0 0 2px var(--danger);
    }
    
    .tracking-content {
        background: var(--bg-light);
        padding: 15px;
        border-radius: var(--radius-sm);
    }
    
    .tracking-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 8px;
    }
    
    .tracking-title {
        font-weight: 600;
        color: var(--text-dark);
        font-size: 14px;
    }
    
    .tracking-time {
        font-size: 12px;
        color: var(--text-light);
    }
    
    .tracking-note {
        font-size: 13px;
        color: var(--text-dark);
        margin-top: 5px;
    }
    
    /* Barang List */
    .barang-item {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 15px;
        border-bottom: 1px solid var(--border);
    }
    
    .barang-item:last-child {
        border-bottom: none;
    }
    
    .barang-info h5 {
        margin: 0 0 5px 0;
        font-size: 14px;
        color: var(--text-dark);
    }
    
    .barang-info p {
        margin: 0;
        font-size: 12px;
        color: var(--text-light);
    }
    
    .barang-quantity {
        font-weight: 600;
        color: var(--text-dark);
        font-size: 16px;
    }
    
    /* Empty State */
    .empty-state {
        text-align: center;
        padding: 40px 20px;
        color: var(--text-light);
    }
    
    .empty-state i {
        font-size: 48px;
        margin-bottom: 16px;
        opacity: 0.5;
    }
    
    .empty-state h4 {
        margin: 0 0 8px 0;
        font-size: 16px;
        color: var(--text-dark);
    }
    
    .empty-state p {
        margin: 0;
        font-size: 14px;
    }
    
    /* Responsive */
    @media (max-width: 768px) {
        .content-header {
            flex-direction: column;
            align-items: stretch;
        }
        
        .header-right .btn-group {
            width: 100%;
        }
        
        .header-right .btn {
            flex: 1;
            min-width: 120px;
        }
        
        .filter-grid {
            grid-template-columns: 1fr;
        }
        
        .date-range {
            flex-direction: column;
            gap: 10px;
        }
        
        .date-separator {
            display: none;
        }
        
        .card-header {
            flex-direction: column;
            align-items: stretch;
        }
        
        .card-info {
            align-self: flex-start;
        }
        
        .table-footer {
            flex-direction: column;
            align-items: stretch;
            text-align: center;
        }
        
        .pagination {
            justify-content: center;
        }
        
        .modal-footer {
            flex-direction: column;
        }
        
        .modal-footer .btn {
            width: 100%;
        }
        
        .action-buttons {
            flex-direction: column;
        }
        
        .btn-action {
            width: 100%;
        }
    }
    
    @media (max-width: 480px) {
        .content-wrapper {
            padding: 15px;
        }
        
        .stats-grid {
            grid-template-columns: 1fr;
        }
        
        .stat-card {
            padding: 15px;
        }
        
        .content-card {
            padding: 20px;
        }
        
        .filter-actions {
            flex-direction: column;
        }
        
        .filter-actions .btn {
            width: 100%;
        }
        
        .detail-grid {
            grid-template-columns: 1fr;
        }
    }
</style>

<script>
// Data dummy pengiriman
const pengirimanData = [
    {
        id: 1,
        kode_pengiriman: "PENG-2024-03-001",
        tanggal_kirim: "2024-03-25 08:30",
        barang: [
            { id: 1, nama: "Jeruk Kualitas A", batch: "PNH-2024-03-001", kualitas: "A", jumlah: 50, satuan: "kardus", berat: 500 },
            { id: 2, nama: "Jeruk Kualitas B", batch: "PNH-2024-03-002", kualitas: "B", jumlah: 24, satuan: "keranjang", berat: 350 }
        ],
        supir: {
            id: 1,
            nama: "Ronny",
            kontak: "081234567890",
            sim: "B2 Umum",
            status: "Available"
        },
        kendaraan: {
            id: 1,
            kode: "TRK-001",
            jenis: "Truk Box 10 Ton",
            plat: "BK 1234 AB",
            kapasitas: 10000
        },
        rute: {
            id: "berastagi-medan",
            nama: "Berastagi → Medan",
            jarak: "80 km",
            estimasi: "3 jam",
            biaya_tol: "Rp 150.000",
            kondisi: "Normal"
        },
        tujuan_akhir: "Gudang Pusat Medan, Jl. Gatot Subroto No. 123",
        status: "dikirim",
        catatan: "Pengiriman prioritas, pengantaran pagi",
        created_at: "2024-03-25 07:45:00",
        tracking: [
            { waktu: "2024-03-25 07:00", status: "dipanen", catatan: "Barang siap dipanen" },
            { waktu: "2024-03-25 07:30", status: "dikemas", catatan: "Barang sedang dikemas" },
            { waktu: "2024-03-25 08:15", status: "dikirim", catatan: "Barang berangkat dari gudang" }
        ]
    },
    {
        id: 2,
        kode_pengiriman: "PENG-2024-03-002",
        tanggal_kirim: "2024-03-26 09:00",
        barang: [
            { id: 3, nama: "Jeruk Kualitas A", batch: "PNH-2024-03-003", kualitas: "A", jumlah: 21, satuan: "peti", berat: 420 }
        ],
        supir: {
            id: 2,
            nama: "Rieno",
            kontak: "081298765432",
            sim: "B1 Umum",
            status: "Available"
        },
        kendaraan: {
            id: 2,
            kode: "TRK-002",
            jenis: "Truk Fuso 7.5 Ton",
            plat: "BK 5678 CD",
            kapasitas: 7500
        },
        rute: {
            id: "berastagi-jakarta",
            nama: "Berastagi → Jakarta",
            jarak: "1,800 km",
            estimasi: "2 hari",
            biaya_tol: "Rp 2.500.000",
            kondisi: "Normal"
        },
        tujuan_akhir: "Toko Jeruk Sejahtera Jakarta, Jl. Sudirman No. 456",
        status: "diterima",
        catatan: "Pengiriman regular, sudah sampai tujuan",
        created_at: "2024-03-26 08:15:00",
        tracking: [
            { waktu: "2024-03-26 07:30", status: "dikemas", catatan: "Barang sedang dikemas" },
            { waktu: "2024-03-26 08:45", status: "dikirim", catatan: "Barang berangkat dari gudang" },
            { waktu: "2024-03-28 14:30", status: "diterima", catatan: "Barang diterima di tujuan" }
        ]
    },
    {
        id: 3,
        kode_pengiriman: "PENG-2024-03-003",
        tanggal_kirim: "2024-03-27 10:30",
        barang: [
            { id: 4, nama: "Jeruk Kualitas C", batch: "PNH-2024-03-004", kualitas: "C", jumlah: 28, satuan: "kardus", berat: 280 },
            { id: 5, nama: "Jeruk Kualitas B", batch: "PNH-2024-03-005", kualitas: "B", jumlah: 22, satuan: "keranjang", berat: 320 }
        ],
        supir: {
            id: 3,
            nama: "Risto",
            kontak: "081312345678",
            sim: "B2 Umum",
            status: "Available"
        },
        kendaraan: {
            id: 3,
            kode: "TRK-003",
            jenis: "Truk Engkel 4 Ton",
            plat: "BK 9012 EF",
            kapasitas: 4000
        },
        rute: {
            id: "berastagi-surabaya",
            nama: "Berastagi → Surabaya",
            jarak: "2,200 km",
            estimasi: "3 hari",
            biaya_tol: "Rp 3.000.000",
            kondisi: "Macet"
        },
        tujuan_akhir: "Pasar Jeruk Surabaya, Jl. Tunjungan No. 789",
        status: "dikirim",
        catatan: "Pengiriman berat, butuh monitoring ekstra",
        created_at: "2024-03-27 09:45:00",
        tracking: [
            { waktu: "2024-03-27 09:00", status: "dikemas", catatan: "Barang sedang dikemas" },
            { waktu: "2024-03-27 10:15", status: "dikirim", catatan: "Barang berangkat dari gudang" }
        ]
    },
    {
        id: 4,
        kode_pengiriman: "PENG-2024-03-004",
        tanggal_kirim: "2024-03-28 07:45",
        barang: [
            { id: 6, nama: "Jeruk Kualitas A", batch: "PNH-2024-03-006", kualitas: "A", jumlah: 23, satuan: "peti", berat: 450 }
        ],
        supir: {
            id: 4,
            nama: "Yekris",
            kontak: "081398765432",
            sim: "B1 Umum",
            status: "Available"
        },
        kendaraan: {
            id: 4,
            kode: "TRK-004",
            jenis: "Pickup 2 Ton",
            plat: "BK 3456 GH",
            kapasitas: 2000
        },
        rute: {
            id: "berastagi-makassar",
            nama: "Berastagi → Makassar",
            jarak: "1,500 km",
            estimasi: "2.5 hari",
            biaya_tol: "Rp 2.200.000",
            kondisi: "Normal"
        },
        tujuan_akhir: "Distributor Makassar, Jl. Urip Sumoharjo No. 321",
        status: "dikemas",
        catatan: "Menunggu dokumen kelengkapan",
        created_at: "2024-03-28 07:00:00",
        tracking: [
            { waktu: "2024-03-28 06:30", status: "dipanen", catatan: "Barang siap dipanen" },
            { waktu: "2024-03-28 07:20", status: "dikemas", catatan: "Barang sedang dikemas" }
        ]
    },
    {
        id: 5,
        kode_pengiriman: "PENG-2024-03-005",
        tanggal_kirim: "2024-03-29 11:00",
        barang: [
            { id: 7, nama: "Jeruk Kualitas B", batch: "PNH-2024-03-007", kualitas: "B", jumlah: 30, satuan: "kardus", berat: 300 }
        ],
        supir: {
            id: 5,
            nama: "Trhesya",
            kontak: "081412345678",
            sim: "B2 Umum",
            status: "Available"
        },
        kendaraan: {
            id: 5,
            kode: "TRK-005",
            jenis: "Truk Box 12 Ton",
            plat: "BK 7890 IJ",
            kapasitas: 12000
        },
        rute: {
            id: "berastagi-palembang",
            nama: "Berastagi → Palembang",
            jarak: "1,200 km",
            estimasi: "2 hari",
            biaya_tol: "Rp 1.800.000",
            kondisi: "Banyak Polisi Tidur"
        },
        tujuan_akhir: "Gudang Palembang, Jl. Jenderal Sudirman No. 654",
        status: "batal",
        catatan: "Dibatalkan karena kendala teknis kendaraan",
        created_at: "2024-03-29 10:15:00",
        tracking: [
            { waktu: "2024-03-29 09:30", status: "dikemas", catatan: "Barang sedang dikemas" },
            { waktu: "2024-03-29 10:45", status: "batal", catatan: "Pengiriman dibatalkan karena kendala teknis" }
        ]
    },
    {
        id: 6,
        kode_pengiriman: "PENG-2024-03-005",
        tanggal_kirim: "2024-03-29 11:00",
        barang: [
            { id: 7, nama: "Jeruk Kualitas B", batch: "PNH-2024-03-007", kualitas: "B", jumlah: 30, satuan: "kardus", berat: 300 }
        ],
        supir: {
            id: 6,
            nama: "Maharani",
            kontak: "081412345678",
            sim: "B2 Umum",
            status: "Available"
        },
        kendaraan: {
            id: 5,
            kode: "TRK-005",
            jenis: "Truk Box 12 Ton",
            plat: "BK 7890 IJ",
            kapasitas: 12000
        },
        rute: {
            id: "berastagi-palembang",
            nama: "Berastagi → Palembang",
            jarak: "1,200 km",
            estimasi: "2 hari",
            biaya_tol: "Rp 1.800.000",
            kondisi: "Banyak Polisi Tidur"
        },
        tujuan_akhir: "Gudang Palembang, Jl. Jenderal Sudirman No. 654",
        status: "batal",
        catatan: "Dibatalkan karena kendala teknis kendaraan",
        created_at: "2024-03-29 10:15:00",
        tracking: [
            { waktu: "2024-03-29 09:30", status: "dikemas", catatan: "Barang sedang dikemas" },
            { waktu: "2024-03-29 10:45", status: "batal", catatan: "Pengiriman dibatalkan karena kendala teknis" }
        ]
    }
];

// State variables
let currentPage = 1;
const itemsPerPage = 5;
let filteredData = [...pengirimanData];
let selectedPengirimanId = null;

// Utility functions
function formatDate(dateTimeString) {
    const date = new Date(dateTimeString);
    const options = { 
        day: '2-digit', 
        month: '2-digit', 
        year: 'numeric',
        hour: '2-digit',
        minute: '2-digit'
    };
    return date.toLocaleDateString('id-ID', options);
}

function formatDateOnly(dateTimeString) {
    const date = new Date(dateTimeString);
    const options = { 
        day: '2-digit', 
        month: '2-digit', 
        year: 'numeric'
    };
    return date.toLocaleDateString('id-ID', options);
}

function formatRupiah(angka) {
    return 'Rp ' + angka.toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.');
}

function getTotalBarang(pengiriman) {
    return pengiriman.barang.reduce((total, item) => total + item.jumlah, 0);
}

function getTotalBerat(pengiriman) {
    return pengiriman.barang.reduce((total, item) => total + item.berat, 0);
}

function getStatusProgress(status) {
    const progressMap = {
        'dipanen': 25,
        'dikemas': 50,
        'dikirim': 75,
        'diterima': 100,
        'batal': 0
    };
    return progressMap[status] || 0;
}

// Update statistics
function updateStatistics() {
    const totalPengiriman = filteredData.length;
    const totalBarang = filteredData.reduce((sum, item) => sum + getTotalBarang(item), 0);
    const totalBerat = filteredData.reduce((sum, item) => sum + getTotalBerat(item), 0);
    const activeDelivery = filteredData.filter(item => item.status === 'dikirim').length;

    document.getElementById('totalPengiriman').textContent = totalPengiriman;
    document.getElementById('totalBarang').textContent = totalBarang + ' Item';
    document.getElementById('totalBerat').textContent = totalBerat.toLocaleString() + ' Kg';
    document.getElementById('activeDelivery').textContent = activeDelivery;
}

// Render table
function renderTable() {
    const tbody = document.getElementById('pengirimanTableBody');
    const startIndex = (currentPage - 1) * itemsPerPage;
    const endIndex = startIndex + itemsPerPage;
    const currentData = filteredData.slice(startIndex, endIndex);

    if (currentData.length === 0) {
        tbody.innerHTML = `
            <tr>
                <td colspan="11">
                    <div class="empty-state">
                        <i class="fas fa-truck"></i>
                        <h4>Tidak ada data pengiriman ditemukan</h4>
                        <p>Coba gunakan filter yang berbeda</p>
                    </div>
                </td>
            </tr>
        `;
    } else {
        tbody.innerHTML = currentData.map((item, index) => {
            const rowNumber = startIndex + index + 1;
            const totalBarang = getTotalBarang(item);
            const totalBerat = getTotalBerat(item);
            const progress = getStatusProgress(item.status);

            return `
                <tr>
                    <td>${rowNumber}</td>
                    <td>
                        <div style="font-weight: 600; color: var(--text-dark);">${item.kode_pengiriman}</div>
                        <div style="font-size: 12px; color: var(--text-light);">${formatDateOnly(item.created_at)}</div>
                    </td>
                    <td>
                        <div>${formatDate(item.tanggal_kirim)}</div>
                    </td>
                    <td>
                        <div style="font-weight: 600; color: var(--text-dark);">${totalBarang} item</div>
                        <div style="font-size: 12px; color: var(--text-light);">${totalBerat.toLocaleString()} kg</div>
                    </td>
                    <td>
                        <div>${item.supir.nama}</div>
                        <div style="font-size: 12px; color: var(--text-light);">${item.supir.kontak}</div>
                    </td>
                    <td>
                        <div>${item.kendaraan.kode}</div>
                        <div style="font-size: 12px; color: var(--text-light);">${item.kendaraan.jenis}</div>
                    </td>
                    <td>
                        <div>${item.rute.nama.split('→')[1].trim()}</div>
                        <div style="font-size: 12px; color: var(--text-light);">${item.rute.jarak}</div>
                    </td>
                    <td>
                        <div style="max-width: 200px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">
                            ${item.tujuan_akhir}
                        </div>
                    </td>
                    <td>
                        <span class="status-badge status-${item.status}">
                            ${getStatusLabel(item.status)}
                        </span>
                    </td>
                    <td>
                        <div style="display: flex; align-items: center; gap: 10px;">
                            <div class="progress-container">
                                <div class="progress-bar progress-${progress}" style="width: ${progress}%"></div>
                            </div>
                            <span style="font-size: 12px; color: var(--text-light);">${progress}%</span>
                        </div>
                    </td>
                    <td>
                        <div class="action-buttons">
                            <button class="btn-action btn-view" onclick="showDetail(${item.id})" title="Detail">
                                <i class="fas fa-eye"></i>
                            </button>
                            <button class="btn-action btn-track" onclick="showTracking(${item.id})" title="Tracking">
                                <i class="fas fa-map-marker-alt"></i>
                            </button>
                            <button class="btn-action btn-update" onclick="showUpdateModal(${item.id})" title="Update Status">
                                <i class="fas fa-sync-alt"></i>
                            </button>
                            <button class="btn-action btn-barang" onclick="showBarang(${item.id})" title="Detail Barang">
                                <i class="fas fa-box"></i>
                            </button>
                        </div>
                    </td>
                </tr>
            `;
        }).join('');
    }

    updatePagination();
    updateShowingCount();
}

function getStatusLabel(status) {
    const labels = {
        'dipanen': 'Dipanen',
        'dikemas': 'Dikemas',
        'dikirim': 'Dalam Pengiriman',
        'diterima': 'Diterima',
        'batal': 'Dibatalkan'
    };
    return labels[status] || status;
}

// Pagination functions
function updatePagination() {
    const totalPages = Math.ceil(filteredData.length / itemsPerPage);
    document.getElementById('currentPage').textContent = currentPage;
    document.getElementById('totalPages').textContent = totalPages;
    updatePageNumbers('pageNumbers', currentPage, totalPages, goToPage);
    
    document.querySelector('.prev').disabled = currentPage === 1;
    document.querySelector('.next').disabled = currentPage === totalPages || totalPages === 0;
}

function updatePageNumbers(containerId, currentPage, totalPages, goToPageFunc) {
    const container = document.getElementById(containerId);
    container.innerHTML = '';

    if (totalPages <= 1) return;

    let startPage = Math.max(1, currentPage - 2);
    let endPage = Math.min(totalPages, currentPage + 2);

    if (endPage - startPage < 4 && totalPages > 5) {
        if (currentPage < 3) {
            endPage = Math.min(5, totalPages);
        } else if (currentPage > totalPages - 2) {
            startPage = Math.max(totalPages - 4, 1);
        }
    }

    if (startPage > 1) {
        addPageButton(container, 1, currentPage, goToPageFunc);
        if (startPage > 2) {
            addEllipsis(container);
        }
    }

    for (let i = startPage; i <= endPage; i++) {
        addPageButton(container, i, currentPage, goToPageFunc);
    }

    if (endPage < totalPages) {
        if (endPage < totalPages - 1) {
            addEllipsis(container);
        }
        addPageButton(container, totalPages, currentPage, goToPageFunc);
    }
}

function addPageButton(container, pageNumber, currentPage, goToPageFunc) {
    const button = document.createElement('button');
    button.className = `page-number ${pageNumber === currentPage ? 'active' : ''}`;
    button.textContent = pageNumber;
    button.onclick = () => goToPageFunc(pageNumber);
    container.appendChild(button);
}

function addEllipsis(container) {
    const ellipsis = document.createElement('span');
    ellipsis.className = 'page-number';
    ellipsis.textContent = '...';
    ellipsis.style.cursor = 'default';
    ellipsis.onclick = null;
    container.appendChild(ellipsis);
}

// Page navigation
function goToPage(page) {
    currentPage = page;
    renderTable();
}

// Showing count functions
function updateShowingCount() {
    const startIndex = (currentPage - 1) * itemsPerPage + 1;
    const endIndex = Math.min(startIndex + itemsPerPage - 1, filteredData.length);
    const total = filteredData.length;

    document.getElementById('showingData').textContent = total === 0 ? '0' : `${startIndex}-${endIndex}`;
    document.getElementById('totalData').textContent = total;
}

// Filter functions
function filterData() {
    const periode = document.getElementById('filterPeriode').value;
    const status = document.getElementById('filterStatus').value;
    const supir = document.getElementById('filterSupir').value;
    const tujuan = document.getElementById('filterTujuan').value;
    const tanggalAwal = document.getElementById('filterTanggalAwal').value;
    const tanggalAkhir = document.getElementById('filterTanggalAkhir').value;

    filteredData = pengirimanData.filter(item => {
        // Filter status
        if (status && item.status !== status) return false;
        
        // Filter supir
        if (supir && item.supir.nama !== supir) return false;
        
        // Filter tujuan
        if (tujuan && !item.tujuan_akhir.toLowerCase().includes(tujuan.toLowerCase())) return false;
        
        // Filter tanggal
        const itemDate = new Date(item.tanggal_kirim);
        if (!applyDateFilter(itemDate, periode, tanggalAwal, tanggalAkhir)) return false;
        
        return true;
    });

    currentPage = 1;
    renderTable();
    updateStatistics();
}

function applyDateFilter(itemDate, periode, tanggalAwal, tanggalAkhir) {
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
    } else if (periode === 'triwulan') {
        const startOfQuarter = new Date(today.getFullYear(), today.getMonth() - 2, 1);
        startOfQuarter.setHours(0, 0, 0, 0);
        const endOfQuarter = new Date(today);
        endOfQuarter.setHours(23, 59, 59, 999);
        
        return itemDate >= startOfQuarter && itemDate <= endOfQuarter;
    } else if (periode === 'custom') {
        if (!tanggalAwal || !tanggalAkhir) return true;
        
        const start = new Date(tanggalAwal);
        start.setHours(0, 0, 0, 0);
        
        const end = new Date(tanggalAkhir);
        end.setHours(23, 59, 59, 999);
        
        return itemDate >= start && itemDate <= end;
    }

    return true;
}

function resetFilter() {
    document.getElementById('filterPeriode').value = '';
    document.getElementById('filterStatus').value = '';
    document.getElementById('filterSupir').value = '';
    document.getElementById('filterTujuan').value = '';
    document.getElementById('filterTanggalAwal').value = '';
    document.getElementById('filterTanggalAkhir').value = '';
    document.querySelector('.custom-date-group').style.display = 'none';
    
    filteredData = [...pengirimanData];
    currentPage = 1;
    renderTable();
    updateStatistics();
}

// Modal functions
window.showDetail = function(id) {
    selectedPengirimanId = id;
    const pengiriman = pengirimanData.find(item => item.id === id);
    
    if (!pengiriman) return;

    const totalBarang = getTotalBarang(pengiriman);
    const totalBerat = getTotalBerat(pengiriman);

    const detailHTML = `
        <div style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 25px; padding-bottom: 20px; border-bottom: 2px solid var(--border);">
            <div>
                <h3 style="margin: 0; color: var(--text-dark);">${pengiriman.kode_pengiriman}</h3>
                <div style="color: var(--text-light); font-size: 14px; margin-top: 5px;">${formatDate(pengiriman.tanggal_kirim)}</div>
            </div>
            <div>
                <span class="status-badge status-${pengiriman.status}">
                    ${getStatusLabel(pengiriman.status)}
                </span>
            </div>
        </div>

        <div class="detail-grid">
            <div class="detail-card">
                <div class="detail-label">Informasi Barang</div>
                <div class="detail-value">
                    <i class="fas fa-boxes"></i>
                    ${totalBarang} Item
                </div>
                <div class="detail-subvalue">
                    <i class="fas fa-weight-hanging"></i>
                    ${totalBerat.toLocaleString()} Kg
                </div>
            </div>

            <div class="detail-card">
                <div class="detail-label">Informasi Supir</div>
                <div class="detail-value">
                    <i class="fas fa-user-tie"></i>
                    ${pengiriman.supir.nama}
                </div>
                <div class="detail-subvalue">
                    <i class="fas fa-phone"></i>
                    ${pengiriman.supir.kontak} | SIM: ${pengiriman.supir.sim}
                </div>
            </div>

            <div class="detail-card">
                <div class="detail-label">Informasi Kendaraan</div>
                <div class="detail-value">
                    <i class="fas fa-truck"></i>
                    ${pengiriman.kendaraan.jenis}
                </div>
                <div class="detail-subvalue">
                    <i class="fas fa-hashtag"></i>
                    ${pengiriman.kendaraan.kode} | Plat: ${pengiriman.kendaraan.plat}
                </div>
            </div>
        </div>

        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin-bottom: 25px;">
            <div style="background: var(--bg-light); padding: 20px; border-radius: var(--radius-md);">
                <div style="font-weight: 600; margin-bottom: 10px; color: var(--text-dark);">
                    <i class="fas fa-route"></i> Rute Pengiriman
                </div>
                <div style="font-size: 14px; color: var(--text-dark);">
                    <div style="margin-bottom: 5px;"><strong>Rute:</strong> ${pengiriman.rute.nama}</div>
                    <div style="margin-bottom: 5px;"><strong>Jarak:</strong> ${pengiriman.rute.jarak}</div>
                    <div style="margin-bottom: 5px;"><strong>Estimasi:</strong> ${pengiriman.rute.estimasi}</div>
                    <div><strong>Biaya Tol:</strong> ${pengiriman.rute.biaya_tol}</div>
                </div>
            </div>

            <div style="background: var(--bg-light); padding: 20px; border-radius: var(--radius-md);">
                <div style="font-weight: 600; margin-bottom: 10px; color: var(--text-dark);">
                    <i class="fas fa-map-marker-alt"></i> Tujuan Pengiriman
                </div>
                <div style="font-size: 14px; color: var(--text-dark);">
                    ${pengiriman.tujuan_akhir}
                </div>
            </div>
        </div>

        <div style="background: var(--bg-light); padding: 20px; border-radius: var(--radius-md);">
            <div style="font-weight: 600; margin-bottom: 10px; color: var(--text-dark);">
                <i class="fas fa-sticky-note"></i> Catatan Pengiriman
            </div>
            <div style="color: var(--text-dark);">
                ${pengiriman.catatan || 'Tidak ada catatan'}
            </div>
        </div>

        <div style="margin-top: 25px;">
            <div style="font-weight: 600; margin-bottom: 15px; color: var(--text-dark); display: flex; align-items: center; gap: 8px;">
                <i class="fas fa-info-circle"></i> Ringkasan Data
            </div>
            <div style="display: grid; grid-template-columns: repeat(4, 1fr); gap: 15px; text-align: center;">
                <div>
                    <div style="font-size: 24px; font-weight: 700; color: var(--primary); margin-bottom: 5px;">
                        ${totalBarang}
                    </div>
                    <div style="font-size: 12px; color: var(--text-light);">Total Item</div>
                </div>
                <div>
                    <div style="font-size: 24px; font-weight: 700; color: var(--success); margin-bottom: 5px;">
                        ${totalBerat.toLocaleString()}
                    </div>
                    <div style="font-size: 12px; color: var(--text-light);">Total Berat (Kg)</div>
                </div>
                <div>
                    <div style="font-size: 24px; font-weight: 700; color: var(--warning); margin-bottom: 5px;">
                        ${getStatusProgress(pengiriman.status)}%
                    </div>
                    <div style="font-size: 12px; color: var(--text-light);">Progress</div>
                </div>
                <div>
                    <div style="font-size: 24px; font-weight: 700; color: var(--info); margin-bottom: 5px;">
                        ${formatDateOnly(pengiriman.created_at)}
                    </div>
                    <div style="font-size: 12px; color: var(--text-light);">Dibuat</div>
                </div>
            </div>
        </div>
    `;

    document.getElementById('detailModalBody').innerHTML = detailHTML;
    document.getElementById('detailModal').style.display = 'flex';
};

window.showTracking = function(id) {
    const pengiriman = pengirimanData.find(item => item.id === id);
    
    if (!pengiriman) return;

    const trackingHTML = pengiriman.tracking.map((track, index) => {
        const isCompleted = index < pengiriman.tracking.length - 1 || pengiriman.status === 'diterima';
        const isPending = index === pengiriman.tracking.length - 1 && pengiriman.status === 'dikirim';
        const isCancelled = pengiriman.status === 'batal';
        
        let statusClass = 'completed';
        if (isPending) statusClass = 'pending';
        if (isCancelled) statusClass = 'cancelled';
        
        return `
            <div class="tracking-item ${statusClass}">
                <div class="tracking-content">
                    <div class="tracking-header">
                        <div class="tracking-title">${getStatusLabel(track.status)}</div>
                        <div class="tracking-time">${formatDate(track.waktu)}</div>
                    </div>
                    <div class="tracking-note">${track.catatan}</div>
                </div>
            </div>
        `;
    }).join('');

    const trackingHistoryHTML = `
        <div class="tracking-timeline">
            ${trackingHTML}
        </div>
    `;

    document.getElementById('trackingHistory').innerHTML = trackingHistoryHTML;
    document.getElementById('trackingModal').style.display = 'flex';
};

window.showUpdateModal = function(id) {
    selectedPengirimanId = id;
    const pengiriman = pengirimanData.find(item => item.id === id);
    
    if (!pengiriman) return;

    document.getElementById('currentStatus').innerHTML = `
        <span class="status-badge status-${pengiriman.status}" style="font-size: 13px;">
            ${getStatusLabel(pengiriman.status)}
        </span>
    `;

    document.getElementById('newStatus').value = pengiriman.status;
    document.getElementById('statusNote').value = '';
    
    document.getElementById('updateStatusModal').style.display = 'flex';
};

window.showBarang = function(id) {
    const pengiriman = pengirimanData.find(item => item.id === id);
    
    if (!pengiriman) return;

    const barangHTML = pengiriman.barang.map(item => {
        return `
            <div class="barang-item">
                <div class="barang-info">
                    <h5>${item.nama}</h5>
                    <p>Batch: ${item.batch} | Kualitas: ${item.kualitas} | ${item.berat} kg</p>
                </div>
                <div class="barang-quantity">${item.jumlah} ${item.satuan}</div>
            </div>
        `;
    }).join('');

    document.getElementById('barangList').innerHTML = barangHTML;
    document.getElementById('barangModal').style.display = 'flex';
};

function updateStatus() {
    const newStatus = document.getElementById('newStatus').value;
    const note = document.getElementById('statusNote').value;

    const pengirimanIndex = pengirimanData.findIndex(item => item.id === selectedPengirimanId);
    
    if (pengirimanIndex === -1) return;

    // Update status pengiriman
    pengirimanData[pengirimanIndex].status = newStatus;
    
    // Tambahkan tracking history
    const waktu = new Date().toISOString().replace('T', ' ').substr(0, 19);
    pengirimanData[pengirimanIndex].tracking.push({
        waktu: waktu,
        status: newStatus,
        catatan: note || 'Status diperbarui oleh admin pusat'
    });

    // Close modal
    document.getElementById('updateStatusModal').style.display = 'none';
    
    // Refresh data
    filterData();
    
    // Show success message
    alert('Status pengiriman berhasil diperbarui!');
}

// Initialize everything
document.addEventListener('DOMContentLoaded', function() {
    // Filter toggle
    document.getElementById('toggleFilterBtn').addEventListener('click', function() {
        const filterContent = document.querySelector('.filter-content');
        const icon = this.querySelector('i');
        
        if (filterContent.classList.contains('collapsed')) {
            filterContent.classList.remove('collapsed');
            icon.classList.remove('fa-chevron-up');
            icon.classList.add('fa-chevron-down');
        } else {
            filterContent.classList.add('collapsed');
            icon.classList.remove('fa-chevron-down');
            icon.classList.add('fa-chevron-up');
        }
    });

    // Period filter change
    document.getElementById('filterPeriode').addEventListener('change', function() {
        document.querySelector('.custom-date-group').style.display = 
            this.value === 'custom' ? 'grid' : 'none';
    });

    // Apply filter
    document.getElementById('applyFilterBtn').addEventListener('click', filterData);

    // Reset filter
    document.getElementById('resetFilterBtn').addEventListener('click', resetFilter);

    // Export buttons
    document.getElementById('exportExcelBtn').addEventListener('click', function() {
        alert('Fitur export data pengiriman ke Excel akan diimplementasikan');
    });

    document.getElementById('printBtn').addEventListener('click', function() {
        alert('Fitur cetak laporan pengiriman akan diimplementasikan');
    });

    // Print detail button
    document.getElementById('printDetailBtn').addEventListener('click', function() {
        alert('Fitur cetak detail pengiriman akan diimplementasikan');
    });

    // Update status button
    document.getElementById('updateStatusBtn').addEventListener('click', function() {
        if (selectedPengirimanId) {
            showUpdateModal(selectedPengirimanId);
        }
    });

    // Confirm update button
    document.getElementById('confirmUpdateBtn').addEventListener('click', updateStatus);

    // Pagination buttons
    document.querySelector('.prev').addEventListener('click', () => {
        if (currentPage > 1) goToPage(currentPage - 1);
    });

    document.querySelector('.next').addEventListener('click', () => {
        const totalPages = Math.ceil(filteredData.length / itemsPerPage);
        if (currentPage < totalPages) goToPage(currentPage + 1);
    });

    // Modal close handlers
    document.querySelectorAll('.close-modal').forEach(btn => {
        btn.addEventListener('click', function() {
            const modalId = this.getAttribute('data-modal');
            document.getElementById(modalId).style.display = 'none';
        });
    });

    // Close modal when clicking outside
    window.addEventListener('click', (event) => {
        const modals = ['detailModal', 'updateStatusModal', 'trackingModal', 'barangModal'];
        modals.forEach(modalId => {
            const modal = document.getElementById(modalId);
            if (event.target === modal) {
                modal.style.display = 'none';
            }
        });
    });

    // Initialize
    renderTable();
    updateStatistics();
});
</script>
@endsection