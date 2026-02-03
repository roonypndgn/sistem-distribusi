{{-- resources/views/supir/pengiriman.blade.php --}}
@extends('layouts.supir')

@section('title', 'Daftar Pengiriman - PT. Mardua Holong')

@section('page-title', 'Daftar Pengiriman')
@section('page-subtitle', 'Pengiriman yang ditugaskan kepada Anda')

@section('content')
<div class="content-wrapper">
    <!-- Header -->
    <div class="content-header">
        <div class="header-left">
            <h1>Daftar Pengiriman</h1>
            <p>Lihat dan update status pengiriman Anda</p>
        </div>
        <div class="header-right">
            <button type="button" id="refreshBtn" class="btn btn-primary">
                <i class="fas fa-sync-alt"></i> Refresh
            </button>
        </div>
    </div>
    
    <!-- Info Supir -->
    <div class="info-card" style="margin-bottom: 30px;">
        <div class="info-content">
            <div class="info-icon">
                <i class="fas fa-user-tie"></i>
            </div>
            <div class="info-details">
                <div class="info-name" id="namaSupir">-</div>
                <div class="info-id" id="idSupir">-</div>
            </div>
            <div class="info-stats">
                <div class="stat-item">
                    <div class="stat-label">Total Pengiriman</div>
                    <div class="stat-value" id="totalPengiriman">-</div>
                </div>
                <div class="stat-item">
                    <div class="stat-label">Dalam Perjalanan</div>
                    <div class="stat-value" id="dalamPerjalananCount">-</div>
                </div>
                <div class="stat-item">
                    <div class="stat-label">Selesai Hari Ini</div>
                    <div class="stat-value" id="selesaiCount">-</div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Filter -->
    <div class="content-card" style="margin-bottom: 30px;">
        <div class="card-header">
            <div class="card-title">
                <i class="fas fa-filter"></i>
                <span>Filter Pengiriman</span>
            </div>
        </div>
        
        <div class="filter-options">
            <div class="filter-group">
                <label class="filter-label">Tanggal</label>
                <select id="filterTanggal" class="form-control">
                    <option value="">Semua Tanggal</option>
                    <option value="hari-ini">Hari Ini</option>
                    <option value="minggu-ini">Minggu Ini</option>
                    <option value="bulan-ini">Bulan Ini</option>
                    <option value="besok">Besok</option>
                </select>
            </div>
            
            <div class="filter-group">
                <label class="filter-label">Status</label>
                <select id="filterStatus" class="form-control">
                    <option value="">Semua Status</option>
                    <option value="loading_barang">Loading Barang</option>
                    <option value="berangkat">Berangkat</option>
                    <option value="dalam_perjalanan">Dalam Perjalanan</option>
                    <option value="tiba_ditujuan">Tiba di Tujuan</option>
                    <option value="unloading">Unloading</option>
                    <option value="selesai">Selesai</option>
                </select>
            </div>
            
            <div class="filter-group">
                <label class="filter-label">&nbsp;</label>
                <button type="button" id="applyFilterBtn" class="btn btn-primary">
                    <i class="fas fa-search"></i> Terapkan
                </button>
            </div>
        </div>
    </div>
    
    <!-- Daftar Pengiriman -->
    <div class="content-card">
        <div class="card-header">
            <div class="card-title">
                <i class="fas fa-truck"></i>
                <span>Daftar Pengiriman</span>
            </div>
            <div class="card-info">
                Menampilkan <span id="showingCount">0</span> dari <span id="totalCount">0</span> pengiriman
            </div>
        </div>
        
        <div class="table-responsive">
            <table class="data-table">
                <thead>
                    <tr>
                        <th style="width: 50px;">No</th>
                        <th>Kode</th>
                        <th>Tanggal</th>
                        <th>Kendaraan</th>
                        <th>Tujuan</th>
                        <th>Status</th>
                        <th style="width: 150px;">Aksi</th>
                    </tr>
                </thead>
                <tbody id="pengirimanTableBody">
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

<!-- Modal Detail Pengiriman -->
<div id="detailModal" class="modal">
    <div class="modal-content modal-lg">
        <div class="modal-header">
            <h3 class="modal-title">Detail Pengiriman</h3>
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
            <button type="button" class="btn btn-primary" id="updateStatusBtn">
                <i class="fas fa-edit"></i> Update Status
            </button>
            <button type="button" class="btn btn-success" id="trackLocationBtn">
                <i class="fas fa-map-marker-alt"></i> Update Lokasi
            </button>
        </div>
    </div>
</div>

<!-- Modal Update Status -->
<div id="updateStatusModal" class="modal">
    <div class="modal-content">
        <div class="modal-header">
            <h3 class="modal-title">Update Status Pengiriman</h3>
            <button type="button" class="close-update-modal">
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
                    <option value="loading_barang">Loading Barang</option>
                    <option value="berangkat">Berangkat</option>
                    <option value="dalam_perjalanan">Dalam Perjalanan</option>
                    <option value="tiba_ditujuan">Tiba di Tujuan</option>
                    <option value="unloading">Unloading</option>
                    <option value="selesai">Selesai</option>
                </select>
            </div>
            <div class="form-group">
                <label class="form-label">Catatan (Opsional)</label>
                <textarea id="statusNote" class="form-control" rows="3" placeholder="Masukkan catatan jika perlu..."></textarea>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary close-update-modal">
                Batal
            </button>
            <button type="button" class="btn btn-primary" id="confirmUpdateBtn">
                <i class="fas fa-save"></i> Simpan Status
            </button>
        </div>
    </div>
</div>

<!-- Modal Update Lokasi -->
<div id="updateLocationModal" class="modal">
    <div class="modal-content">
        <div class="modal-header">
            <h3 class="modal-title">Update Lokasi Saat Ini</h3>
            <button type="button" class="close-location-modal">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <div class="modal-body">
            <div class="form-group">
                <label class="form-label">Koordinat GPS</label>
                <div class="input-group">
                    <input type="text" id="gpsLat" class="form-control" placeholder="Latitude" readonly>
                    <input type="text" id="gpsLng" class="form-control" placeholder="Longitude" readonly>
                    <button type="button" id="getLocationBtn" class="btn btn-secondary">
                        <i class="fas fa-location-arrow"></i> Dapatkan Lokasi
                    </button>
                </div>
                <small class="text-muted">Klik "Dapatkan Lokasi" untuk mendapatkan koordinat GPS saat ini</small>
            </div>
            
            <div class="form-group">
                <label class="form-label">Lokasi (Deskripsi)</label>
                <input type="text" id="locationDescription" class="form-control" placeholder="Contoh: Jl. Merdeka No. 123, Jakarta">
            </div>
            
            <div class="form-group">
                <label class="form-label">Catatan</label>
                <textarea id="locationNote" class="form-control" rows="3" placeholder="Masukkan catatan lokasi..."></textarea>
            </div>
            
            <div class="form-group">
                <label class="form-label">Estimasi Tiba</label>
                <input type="datetime-local" id="estimasiTiba" class="form-control">
                <small class="text-muted">Estimasi waktu tiba di tujuan</small>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary close-location-modal">
                Batal
            </button>
            <button type="button" class="btn btn-primary" id="confirmLocationBtn">
                <i class="fas fa-save"></i> Simpan Lokasi
            </button>
        </div>
    </div>
</div>

<!-- Modal Riwayat Tracking -->
<div id="trackingHistoryModal" class="modal">
    <div class="modal-content modal-lg">
        <div class="modal-header">
            <h3 class="modal-title">Riwayat Tracking</h3>
            <button type="button" class="close-tracking-modal">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <div class="modal-body">
            <div id="trackingHistoryContent">
                <!-- Data tracking akan diisi oleh JavaScript -->
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary close-tracking-modal">
                Tutup
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
    
    /* Info Card */
    .info-card {
        background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
        border-radius: 12px;
        padding: 25px;
        color: white;
    }
    
    .info-content {
        display: flex;
        align-items: center;
        gap: 25px;
        flex-wrap: wrap;
    }
    
    .info-icon {
        font-size: 48px;
        opacity: 0.9;
    }
    
    .info-details {
        flex: 1;
        min-width: 200px;
    }
    
    .info-name {
        font-size: 20px;
        font-weight: 600;
        margin-bottom: 5px;
    }
    
    .info-id {
        font-size: 14px;
        opacity: 0.9;
        font-family: monospace;
        background: rgba(255, 255, 255, 0.1);
        padding: 4px 10px;
        border-radius: 4px;
        display: inline-block;
    }
    
    .info-stats {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
        gap: 20px;
        flex: 2;
    }
    
    .stat-item {
        background: rgba(255, 255, 255, 0.1);
        padding: 12px 15px;
        border-radius: 8px;
        backdrop-filter: blur(10px);
        text-align: center;
    }
    
    .stat-label {
        font-size: 12px;
        opacity: 0.8;
        margin-bottom: 5px;
    }
    
    .stat-value {
        font-size: 24px;
        font-weight: 700;
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
        box-shadow: 0 0 0 3px rgba(30, 136, 229, 0.1);
    }
    
    /* Input Group */
    .input-group {
        display: flex;
        gap: 10px;
        margin-bottom: 10px;
    }
    
    .input-group .form-control {
        flex: 1;
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
        min-width: 120px;
    }
    
    .badge-loading_barang {
        background-color: #FFF3E0;
        color: #EF6C00;
        border: 1px solid #FFE0B2;
    }
    
    .badge-berangkat {
        background-color: #E3F2FD;
        color: #1565C0;
        border: 1px solid #BBDEFB;
    }
    
    .badge-dalam_perjalanan {
        background-color: #FFF8E1;
        color: #FF8F00;
        border: 1px solid #FFECB3;
    }
    
    .badge-tiba_ditujuan {
        background-color: #E8F5E9;
        color: #2E7D32;
        border: 1px solid #C8E6C9;
    }
    
    .badge-unloading {
        background-color: #F3E5F5;
        color: #7B1FA2;
        border: 1px solid #E1BEE7;
    }
    
    .badge-selesai {
        background-color: #E8F5E9;
        color: #1B5E20;
        border: 1px solid #A5D6A7;
    }
    
    /* Vehicle Badge */
    .vehicle-badge {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 6px 10px;
        border-radius: 6px;
        font-size: 12px;
        font-weight: 600;
        background-color: var(--primary-lighter);
        color: var(--primary-dark);
    }
    
    .vehicle-badge i {
        font-size: 14px;
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
        flex-wrap: wrap;
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
    
    .btn-update {
        background-color: #E8F5E9;
        color: #2E7D32;
    }
    
    .btn-update:hover {
        background-color: #2E7D32;
        color: white;
    }
    
    .btn-location {
        background-color: #E3F2FD;
        color: #1565C0;
    }
    
    .btn-location:hover {
        background-color: #1565C0;
        color: white;
    }
    
    .btn-history {
        background-color: #F3E5F5;
        color: #7B1FA2;
    }
    
    .btn-history:hover {
        background-color: #7B1FA2;
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
    .close-update-modal,
    .close-location-modal,
    .close-tracking-modal {
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
    .close-update-modal:hover,
    .close-location-modal:hover,
    .close-tracking-modal:hover {
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
    
    /* Detail Pengiriman Design */
    .shipment-header {
        text-align: center;
        margin-bottom: 30px;
        padding-bottom: 20px;
        border-bottom: 2px solid var(--primary);
    }
    
    .company-name {
        font-size: 24px;
        font-weight: 700;
        color: var(--primary);
        margin-bottom: 5px;
    }
    
    .shipment-title {
        font-size: 20px;
        font-weight: 600;
        color: var(--text-dark);
        margin-bottom: 20px;
    }
    
    .shipment-info-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 20px;
        margin-bottom: 30px;
    }
    
    .info-card-small {
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
    
    /* Status Timeline */
    .status-timeline {
        position: relative;
        padding-left: 30px;
        margin: 30px 0;
    }
    
    .status-timeline::before {
        content: '';
        position: absolute;
        left: 10px;
        top: 0;
        bottom: 0;
        width: 2px;
        background-color: var(--border);
    }
    
    .status-step {
        position: relative;
        margin-bottom: 25px;
        padding: 10px;
        background: white;
        border-radius: 8px;
        border: 1px solid var(--border);
    }
    
    .status-step:last-child {
        margin-bottom: 0;
    }
    
    .status-step::before {
        content: '';
        position: absolute;
        left: -30px;
        top: 50%;
        transform: translateY(-50%);
        width: 20px;
        height: 20px;
        border-radius: 50%;
        background-color: var(--border);
        border: 3px solid white;
        z-index: 1;
    }
    
    .status-step.active {
        border-color: var(--primary);
        background-color: var(--primary-lighter);
    }
    
    .status-step.active::before {
        background-color: var(--primary);
    }
    
    .status-step.completed {
        border-color: var(--success);
        background-color: #E8F5E9;
    }
    
    .status-step.completed::before {
        background-color: var(--success);
    }
    
    .step-label {
        font-size: 14px;
        color: var(--text-light);
        margin-bottom: 5px;
    }
    
    .step-value {
        font-size: 16px;
        font-weight: 600;
        color: var(--text-dark);
    }
    
    .step-date {
        font-size: 12px;
        color: var(--text-light);
        margin-top: 3px;
    }
    
    /* Tracking History */
    .tracking-item {
        display: flex;
        align-items: flex-start;
        padding: 15px;
        border-bottom: 1px solid var(--border);
    }
    
    .tracking-item:last-child {
        border-bottom: none;
    }
    
    .tracking-icon {
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
    
    .tracking-content {
        flex: 1;
    }
    
    .tracking-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 5px;
    }
    
    .tracking-title {
        font-weight: 600;
        color: var(--text-dark);
    }
    
    .tracking-time {
        font-size: 12px;
        color: var(--text-light);
    }
    
    .tracking-location {
        font-size: 14px;
        color: var(--text-light);
        margin-bottom: 5px;
    }
    
    .tracking-coordinates {
        font-size: 12px;
        color: var(--text-light);
        font-family: monospace;
        background-color: var(--light);
        padding: 2px 6px;
        border-radius: 4px;
        display: inline-block;
    }
    
    .tracking-note {
        font-size: 14px;
        color: var(--text-dark);
        margin-top: 5px;
        padding: 10px;
        background-color: #FFF3E0;
        border-radius: 6px;
        border-left: 3px solid #FF9800;
    }
    
    /* Load Details */
    .load-details {
        margin-top: 30px;
    }
    
    .load-table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 15px;
    }
    
    .load-table th {
        background-color: var(--light);
        padding: 10px;
        text-align: left;
        font-weight: 600;
        color: var(--text-dark);
        font-size: 14px;
    }
    
    .load-table td {
        padding: 10px;
        border-bottom: 1px solid var(--border);
        font-size: 14px;
    }
    
    /* Notes */
    .notes-box {
        background-color: #FFF3E0;
        padding: 15px;
        border-radius: 8px;
        margin-top: 20px;
        border-left: 4px solid #FF9800;
        font-size: 14px;
        color: #5D4037;
    }
    
    .notes-box i {
        color: #FF9800;
        margin-right: 8px;
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
        
        .info-content {
            flex-direction: column;
            text-align: center;
        }
        
        .info-stats {
            width: 100%;
        }
        
        .card-header {
            flex-direction: column;
            align-items: flex-start;
        }
        
        .modal-footer {
            flex-direction: column;
        }
        
        .shipment-info-grid {
            grid-template-columns: 1fr;
        }
        
        .input-group {
            flex-direction: column;
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
        
        .info-stats {
            grid-template-columns: 1fr;
        }
        
        .action-buttons {
            flex-direction: column;
        }
        
        .btn-action {
            width: 100%;
        }
    }
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Data dummy supir
    const supirData = {
        id: "SUP-001",
        nama: "Budi Santoso",
        total_pengiriman: 15,
        dalam_perjalanan_count: 3,
        selesai_count: 5
    };
    
    // Data dummy pengiriman
    let pengirimanData = [
        {
            id: 1,
            kode_pengiriman: "PGN-2024-001",
            supir_id: "SUP-001",
            tanggal_kirim: "2024-03-15",
            tanggal_kirim_formatted: "15 Maret 2024",
            waktu_kirim: "08:00",
            kendaraan: {
                jenis: "Truk Box",
                plat_nomor: "B 1234 ABC",
                kapasitas: "8 Ton"
            },
            tujuan_akhir: "Toko Utama - Jakarta",
            alamat_tujuan: "Jl. Sudirman No. 123, Jakarta Pusat",
            status: "dalam_perjalanan",
            catatan: "Kirim segera, barang mudah rusak",
            estimasi_tiba: "2024-03-15T12:00",
            muatan: [
                { nama: "Jeruk Medan", jumlah: 100, satuan: "kg" },
                { nama: "Jeruk Sunkist", jumlah: 50, satuan: "kg" }
            ],
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
                }
            ]
        },
        {
            id: 2,
            kode_pengiriman: "PGN-2024-002",
            supir_id: "SUP-001",
            tanggal_kirim: "2024-03-16",
            tanggal_kirim_formatted: "16 Maret 2024",
            waktu_kirim: "07:30",
            kendaraan: {
                jenis: "Pickup",
                plat_nomor: "B 5678 XYZ",
                kapasitas: "2 Ton"
            },
            tujuan_akhir: "Toko Cabang 1 - Bandung",
            alamat_tujuan: "Jl. Asia Afrika No. 67, Bandung",
            status: "loading_barang",
            catatan: "Barang sudah siap, tunggu konfirmasi packing",
            estimasi_tiba: "2024-03-16T11:00",
            muatan: [
                { nama: "Jeruk Bali", jumlah: 80, satuan: "kg" }
            ],
            log_tracking: [
                {
                    id: 4,
                    timestamp_log: "2024-03-16 07:00:00",
                    koordinat_gps: "-6.2088,106.8456",
                    status: "loading_barang",
                    note: "Menyiapkan barang",
                    location_description: "Gudang Packing"
                }
            ]
        },
        {
            id: 3,
            kode_pengiriman: "PGN-2024-003",
            supir_id: "SUP-001",
            tanggal_kirim: "2024-03-14",
            tanggal_kirim_formatted: "14 Maret 2024",
            waktu_kirim: "09:00",
            kendaraan: {
                jenis: "Truk Box Besar",
                plat_nomor: "B 9012 DEF",
                kapasitas: "12 Ton"
            },
            tujuan_akhir: "Toko Pusat - Surabaya",
            alamat_tujuan: "Jl. Tunjungan No. 1, Surabaya",
            status: "selesai",
            catatan: "Pengiriman sukses, pelanggan puas",
            estimasi_tiba: "2024-03-14T13:00",
            muatan: [
                { nama: "Jeruk Medan", jumlah: 200, satuan: "kg" },
                { nama: "Jeruk Sunkist", jumlah: 100, satuan: "kg" },
                { nama: "Jeruk Bali", jumlah: 150, satuan: "kg" }
            ],
            log_tracking: [
                {
                    id: 5,
                    timestamp_log: "2024-03-14 08:00:00",
                    koordinat_gps: "-6.2088,106.8456",
                    status: "loading_barang",
                    note: "Loading barang",
                    location_description: "Gudang Utama"
                },
                {
                    id: 6,
                    timestamp_log: "2024-03-14 09:00:00",
                    koordinat_gps: "-6.2088,106.8456",
                    status: "berangkat",
                    note: "Berangkat menuju Surabaya",
                    location_description: "Gudang Utama"
                },
                {
                    id: 7,
                    timestamp_log: "2024-03-14 12:00:00",
                    koordinat_gps: "-6.9778,110.4081",
                    status: "dalam_perjalanan",
                    note: "Istirahat di Semarang",
                    location_description: "Rest Area Semarang"
                },
                {
                    id: 8,
                    timestamp_log: "2024-03-14 15:00:00",
                    koordinat_gps: "-7.2575,112.7521",
                    status: "tiba_ditujuan",
                    note: "Tiba di lokasi tujuan",
                    location_description: "Parkiran Toko Pusat"
                },
                {
                    id: 9,
                    timestamp_log: "2024-03-14 16:00:00",
                    koordinat_gps: "-7.2575,112.7521",
                    status: "unloading",
                    note: "Proses unloading",
                    location_description: "Toko Pusat Surabaya"
                },
                {
                    id: 10,
                    timestamp_log: "2024-03-14 17:00:00",
                    koordinat_gps: "-7.2575,112.7521",
                    status: "selesai",
                    note: "Pengiriman selesai, barang diterima",
                    location_description: "Toko Pusat Surabaya"
                }
            ]
        }
    ];
    
    // Elemen DOM
    const refreshBtn = document.getElementById('refreshBtn');
    const applyFilterBtn = document.getElementById('applyFilterBtn');
    const filterTanggal = document.getElementById('filterTanggal');
    const filterStatus = document.getElementById('filterStatus');
    const pengirimanTableBody = document.getElementById('pengirimanTableBody');
    
    // Modals
    const detailModal = document.getElementById('detailModal');
    const detailModalBody = document.getElementById('detailModalBody');
    const updateStatusModal = document.getElementById('updateStatusModal');
    const updateLocationModal = document.getElementById('updateLocationModal');
    const trackingHistoryModal = document.getElementById('trackingHistoryModal');
    
    // Update Status Modal Elements
    const updateStatusBtn = document.getElementById('updateStatusBtn');
    const closeUpdateModalBtn = document.querySelector('.close-update-modal');
    const confirmUpdateBtn = document.getElementById('confirmUpdateBtn');
    const newStatusSelect = document.getElementById('newStatus');
    const statusNoteTextarea = document.getElementById('statusNote');
    const currentStatusDiv = document.getElementById('currentStatus');
    
    // Update Location Modal Elements
    const trackLocationBtn = document.getElementById('trackLocationBtn');
    const closeLocationModalBtn = document.querySelector('.close-location-modal');
    const confirmLocationBtn = document.getElementById('confirmLocationBtn');
    const getLocationBtn = document.getElementById('getLocationBtn');
    const gpsLatInput = document.getElementById('gpsLat');
    const gpsLngInput = document.getElementById('gpsLng');
    const locationDescriptionInput = document.getElementById('locationDescription');
    const locationNoteTextarea = document.getElementById('locationNote');
    const estimasiTibaInput = document.getElementById('estimasiTiba');
    
    // Tracking History Modal Elements
    const trackingHistoryContent = document.getElementById('trackingHistoryContent');
    const closeTrackingModalBtn = document.querySelector('.close-tracking-modal');
    
    // Info supir
    document.getElementById('namaSupir').textContent = supirData.nama;
    document.getElementById('idSupir').textContent = `ID: ${supirData.id}`;
    document.getElementById('totalPengiriman').textContent = supirData.total_pengiriman;
    document.getElementById('dalamPerjalananCount').textContent = supirData.dalam_perjalanan_count;
    document.getElementById('selesaiCount').textContent = supirData.selesai_count;
    
    // State
    let currentPage = 1;
    const itemsPerPage = 5;
    let currentFilter = {
        tanggal: '',
        status: ''
    };
    
    let selectedPengirimanId = null;
    let currentLat = null;
    let currentLng = null;
    
    // Initialize
    loadPengirimanTable();
    
    // Apply filter
    applyFilterBtn.addEventListener('click', function() {
        currentFilter = {
            tanggal: filterTanggal.value,
            status: filterStatus.value
        };
        
        currentPage = 1;
        loadPengirimanTable();
    });
    
    // Refresh button
    refreshBtn.addEventListener('click', function() {
        refreshBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Loading...';
        refreshBtn.disabled = true;
        
        setTimeout(() => {
            loadPengirimanTable();
            refreshBtn.innerHTML = '<i class="fas fa-sync-alt"></i> Refresh';
            refreshBtn.disabled = false;
            showNotification('Data berhasil direfresh', 'success');
        }, 1000);
    });
    
    // Load pengiriman table
    function loadPengirimanTable() {
        pengirimanTableBody.innerHTML = '';
        
        const filteredData = filterData(pengirimanData);
        const startIndex = (currentPage - 1) * itemsPerPage;
        const endIndex = startIndex + itemsPerPage;
        const pageData = filteredData.slice(startIndex, endIndex);
        
        if (pageData.length === 0) {
            pengirimanTableBody.innerHTML = `
                <tr>
                    <td colspan="7" style="text-align: center; padding: 40px; color: var(--text-light);">
                        <i class="fas fa-truck" style="font-size: 40px; margin-bottom: 10px; opacity: 0.5; display: block;"></i>
                        <div>Tidak ada data pengiriman</div>
                    </td>
                </tr>
            `;
        } else {
            pageData.forEach((pengiriman, index) => {
                const globalIndex = startIndex + index + 1;
                const row = document.createElement('tr');
                
                row.innerHTML = `
                    <td style="color: var(--text-light);">${globalIndex}</td>
                    <td>
                        <div style="font-weight: 600; color: var(--primary);">${pengiriman.kode_pengiriman}</div>
                    </td>
                    <td>
                        <div style="font-weight: 600; color: var(--text-dark);">${pengiriman.tanggal_kirim_formatted}</div>
                        <div style="font-size: 12px; color: var(--text-light);">${pengiriman.waktu_kirim}</div>
                    </td>
                    <td>
                        <div class="vehicle-badge">
                            <i class="fas fa-truck"></i>
                            ${pengiriman.kendaraan.jenis}
                        </div>
                        <div style="font-size: 12px; color: var(--text-light); margin-top: 3px;">${pengiriman.kendaraan.plat_nomor}</div>
                    </td>
                    <td>
                        <div style="font-weight: 600; color: var(--text-dark);">${pengiriman.tujuan_akhir}</div>
                        <div style="font-size: 12px; color: var(--text-light); margin-top: 3px;">${pengiriman.alamat_tujuan}</div>
                    </td>
                    <td>
                        <span class="status-badge badge-${pengiriman.status}">
                            ${getStatusLabel(pengiriman.status)}
                        </span>
                    </td>
                    <td>
                        <div class="action-buttons">
                            <button type="button" class="btn-action btn-view" data-id="${pengiriman.id}" title="Lihat Detail">
                                <i class="fas fa-eye"></i>
                            </button>
                            <button type="button" class="btn-action btn-update" data-id="${pengiriman.id}" title="Update Status">
                                <i class="fas fa-edit"></i>
                            </button>
                            <button type="button" class="btn-action btn-location" data-id="${pengiriman.id}" title="Update Lokasi">
                                <i class="fas fa-map-marker-alt"></i>
                            </button>
                            <button type="button" class="btn-action btn-history" data-id="${pengiriman.id}" title="Riwayat Tracking">
                                <i class="fas fa-history"></i>
                            </button>
                        </div>
                    </td>
                `;
                
                pengirimanTableBody.appendChild(row);
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
            // Filter tanggal
            if (currentFilter.tanggal) {
                const today = new Date();
                const itemDate = new Date(item.tanggal_kirim);
                
                switch(currentFilter.tanggal) {
                    case 'hari-ini':
                        if (itemDate.toDateString() !== today.toDateString()) return false;
                        break;
                    case 'minggu-ini':
                        const startOfWeek = new Date(today.setDate(today.getDate() - today.getDay()));
                        if (itemDate < startOfWeek) return false;
                        break;
                    case 'bulan-ini':
                        if (itemDate.getMonth() !== today.getMonth() || itemDate.getFullYear() !== today.getFullYear()) return false;
                        break;
                    case 'besok':
                        const tomorrow = new Date();
                        tomorrow.setDate(tomorrow.getDate() + 1);
                        if (itemDate.toDateString() !== tomorrow.toDateString()) return false;
                        break;
                }
            }
            
            // Filter status
            if (currentFilter.status && item.status !== currentFilter.status) return false;
            
            return true;
        }).sort((a, b) => new Date(b.tanggal_kirim) - new Date(a.tanggal_kirim));
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
                loadPengirimanTable();
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
                const pengirimanId = parseInt(this.dataset.id);
                const pengiriman = pengirimanData.find(p => p.id === pengirimanId);
                if (pengiriman) {
                    showDetailModal(pengiriman);
                }
            });
        });
        
        // Update buttons
        document.querySelectorAll('.btn-action.btn-update').forEach(btn => {
            btn.addEventListener('click', function() {
                const pengirimanId = parseInt(this.dataset.id);
                const pengiriman = pengirimanData.find(p => p.id === pengirimanId);
                if (pengiriman) {
                    showUpdateModal(pengiriman);
                }
            });
        });
        
        // Location buttons
        document.querySelectorAll('.btn-action.btn-location').forEach(btn => {
            btn.addEventListener('click', function() {
                const pengirimanId = parseInt(this.dataset.id);
                const pengiriman = pengirimanData.find(p => p.id === pengirimanId);
                if (pengiriman) {
                    showLocationModal(pengiriman);
                }
            });
        });
        
        // History buttons
        document.querySelectorAll('.btn-action.btn-history').forEach(btn => {
            btn.addEventListener('click', function() {
                const pengirimanId = parseInt(this.dataset.id);
                const pengiriman = pengirimanData.find(p => p.id === pengirimanId);
                if (pengiriman) {
                    showTrackingHistoryModal(pengiriman);
                }
            });
        });
    }
    
    // Show detail modal
    function showDetailModal(pengiriman) {
        selectedPengirimanId = pengiriman.id;
        
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
        
        // Status timeline
        const statusSteps = [
            { status: 'loading_barang', label: 'Loading Barang' },
            { status: 'berangkat', label: 'Berangkat' },
            { status: 'dalam_perjalanan', label: 'Dalam Perjalanan' },
            { status: 'tiba_ditujuan', label: 'Tiba di Tujuan' },
            { status: 'unloading', label: 'Unloading' },
            { status: 'selesai', label: 'Selesai' }
        ];
        
        // Buat timeline HTML
        const timelineHTML = statusSteps.map(step => {
            const statusData = pengiriman.log_tracking?.find(p => p.status === step.status);
            const isActive = pengiriman.status === step.status;
            const isCompleted = isStatusCompleted(pengiriman.status, step.status);
            
            return `
                <div class="status-step ${isActive ? 'active' : ''} ${isCompleted ? 'completed' : ''}">
                    <div class="step-label">${step.label}</div>
                    <div class="step-value">${getStatusLabel(step.status)}</div>
                    ${statusData ? `
                        <div class="step-date">${formatDate(statusData.timestamp_log)}</div>
                        ${statusData.location_description ? `
                            <div class="step-date" style="font-style: italic;">${statusData.location_description}</div>
                        ` : ''}
                    ` : ''}
                </div>
            `;
        }).join('');
        
        // Buat muatan HTML
        const muatanHTML = pengiriman.muatan.map(item => `
            <tr>
                <td>${item.nama}</td>
                <td>${item.jumlah} ${item.satuan}</td>
            </tr>
        `).join('');
        
        detailModalBody.innerHTML = `
            <div class="shipment-header">
                <div class="company-name">PT. Mardua Holong</div>
                <div style="font-size: 14px; color: var(--text-light); margin-bottom: 10px;">
                    Perkebunan Jeruk Terpadu
                </div>
                <h2 class="shipment-title">DETAIL PENGIRIMAN</h2>
                <div style="font-size: 16px; font-weight: 600; color: var(--primary);">
                    ${pengiriman.kode_pengiriman}
                </div>
            </div>
            
            <div class="shipment-info-grid">
                <div class="info-card-small">
                    <div class="info-label">Tanggal Pengiriman</div>
                    <div class="info-value">${pengiriman.tanggal_kirim_formatted}</div>
                    <div class="info-subvalue">Jam ${pengiriman.waktu_kirim}</div>
                </div>
                
                <div class="info-card-small">
                    <div class="info-label">Kendaraan</div>
                    <div class="info-value">${pengiriman.kendaraan.jenis}</div>
                    <div class="info-subvalue">${pengiriman.kendaraan.plat_nomor} • ${pengiriman.kendaraan.kapasitas}</div>
                </div>
                
                <div class="info-card-small">
                    <div class="info-label">Supir</div>
                    <div class="info-value">${supirData.nama}</div>
                    <div class="info-subvalue">ID: ${supirData.id}</div>
                </div>
                
                <div class="info-card-small">
                    <div class="info-label">Status</div>
                    <div class="info-value">
                        <span class="status-badge badge-${pengiriman.status}">
                            ${getStatusLabel(pengiriman.status)}
                        </span>
                    </div>
                    ${pengiriman.estimasi_tiba ? `
                        <div class="info-subvalue">Estimasi tiba: ${formatDate(pengiriman.estimasi_tiba)}</div>
                    ` : ''}
                </div>
            </div>
            
            <div class="status-timeline">
                <div style="font-size: 16px; font-weight: 600; color: var(--text-dark); margin-bottom: 20px;">
                    Timeline Pengiriman
                </div>
                ${timelineHTML}
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
                        </tr>
                    </thead>
                    <tbody>
                        ${muatanHTML}
                    </tbody>
                </table>
            </div>
            
            <div style="margin-top: 30px;">
                <div style="font-size: 16px; font-weight: 600; color: var(--text-dark); margin-bottom: 15px;">
                    Tujuan Pengiriman
                </div>
                <div style="background: var(--light); padding: 15px; border-radius: 8px;">
                    <div style="font-weight: 600; margin-bottom: 5px;">${pengiriman.tujuan_akhir}</div>
                    <div style="color: var(--text-light);">${pengiriman.alamat_tujuan}</div>
                </div>
            </div>
            
            ${pengiriman.catatan ? `
            <div class="notes-box">
                <i class="fas fa-info-circle"></i>
                <strong>Catatan:</strong> ${pengiriman.catatan}
            </div>
            ` : ''}
            
            <div style="margin-top: 20px; text-align: center;">
                <button type="button" class="btn btn-outline-primary" id="viewTrackingHistoryBtn" style="margin-right: 10px;">
                    <i class="fas fa-history"></i> Lihat Riwayat Tracking
                </button>
                <button type="button" class="btn btn-outline-success" id="updateLocationFromDetailBtn">
                    <i class="fas fa-map-marker-alt"></i> Update Lokasi
                </button>
            </div>
        `;
        
        // Add event listeners for buttons in detail modal
        setTimeout(() => {
            document.getElementById('viewTrackingHistoryBtn')?.addEventListener('click', function() {
                detailModal.style.display = 'none';
                const pengiriman = pengirimanData.find(p => p.id === selectedPengirimanId);
                if (pengiriman) {
                    showTrackingHistoryModal(pengiriman);
                }
            });
            
            document.getElementById('updateLocationFromDetailBtn')?.addEventListener('click', function() {
                detailModal.style.display = 'none';
                const pengiriman = pengirimanData.find(p => p.id === selectedPengirimanId);
                if (pengiriman) {
                    showLocationModal(pengiriman);
                }
            });
        }, 100);
        
        detailModal.style.display = 'flex';
        document.body.style.overflow = 'hidden';
    }
    
    // Show update modal
    function showUpdateModal(pengiriman) {
        selectedPengirimanId = pengiriman.id;
        
        // Set status saat ini
        currentStatusDiv.innerHTML = `
            <span class="status-badge badge-${pengiriman.status}">
                ${getStatusLabel(pengiriman.status)}
            </span>
        `;
        
        // Set pilihan status baru (hanya status setelah status saat ini)
        const statusOrder = ['loading_barang', 'berangkat', 'dalam_perjalanan', 'tiba_ditujuan', 'unloading', 'selesai'];
        const currentIndex = statusOrder.indexOf(pengiriman.status);
        
        newStatusSelect.innerHTML = '';
        for (let i = currentIndex + 1; i < statusOrder.length; i++) {
            const option = document.createElement('option');
            option.value = statusOrder[i];
            option.textContent = getStatusLabel(statusOrder[i]);
            if (i === currentIndex + 1) {
                option.selected = true;
            }
            newStatusSelect.appendChild(option);
        }
        
        // Reset catatan
        statusNoteTextarea.value = '';
        
        updateStatusModal.style.display = 'flex';
        document.body.style.overflow = 'hidden';
    }
    
    // Show location modal
    function showLocationModal(pengiriman) {
        selectedPengirimanId = pengiriman.id;
        
        // Reset form
        gpsLatInput.value = '';
        gpsLngInput.value = '';
        locationDescriptionInput.value = '';
        locationNoteTextarea.value = '';
        
        // Set estimasi tiba default
        const tomorrow = new Date();
        tomorrow.setDate(tomorrow.getDate() + 1);
        tomorrow.setHours(12, 0, 0, 0);
        estimasiTibaInput.value = tomorrow.toISOString().slice(0, 16);
        
        updateLocationModal.style.display = 'flex';
        document.body.style.overflow = 'hidden';
    }
    
    // Get current location
    getLocationBtn.addEventListener('click', function() {
        if (navigator.geolocation) {
            getLocationBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Mendapatkan...';
            getLocationBtn.disabled = true;
            
            navigator.geolocation.getCurrentPosition(
                function(position) {
                    currentLat = position.coords.latitude;
                    currentLng = position.coords.longitude;
                    
                    gpsLatInput.value = currentLat.toFixed(6);
                    gpsLngInput.value = currentLng.toFixed(6);
                    
                    getLocationBtn.innerHTML = '<i class="fas fa-location-arrow"></i> Dapatkan Lokasi';
                    getLocationBtn.disabled = false;
                    
                    // Auto-fill location description using reverse geocoding (simulated)
                    simulateReverseGeocoding(currentLat, currentLng);
                },
                function(error) {
                    showNotification('Gagal mendapatkan lokasi: ' + error.message, 'danger');
                    getLocationBtn.innerHTML = '<i class="fas fa-location-arrow"></i> Dapatkan Lokasi';
                    getLocationBtn.disabled = false;
                }
            );
        } else {
            showNotification('Browser tidak mendukung geolocation', 'danger');
        }
    });
    
    // Simulate reverse geocoding
    function simulateReverseGeocoding(lat, lng) {
        // In real implementation, you would call a reverse geocoding API
        setTimeout(() => {
            const locations = [
                "Jl. Sudirman No. 123, Jakarta Pusat",
                "Jl. Thamrin No. 45, Jakarta",
                "Jl. Gatot Subroto No. 67, Jakarta",
                "Jl. M.H. Thamrin No. 1, Jakarta"
            ];
            
            const randomLocation = locations[Math.floor(Math.random() * locations.length)];
            locationDescriptionInput.value = `Lokasi: ${randomLocation} (${lat.toFixed(4)}, ${lng.toFixed(4)})`;
        }, 1000);
    }
    
    // Confirm update status
    confirmUpdateBtn.addEventListener('click', function() {
        if (!selectedPengirimanId) return;
        
        const pengiriman = pengirimanData.find(p => p.id === selectedPengirimanId);
        if (!pengiriman) return;
        
        const newStatus = newStatusSelect.value;
        const note = statusNoteTextarea.value.trim();
        
        // Update status pengiriman
        pengiriman.status = newStatus;
        
        // Create timestamp
        const now = new Date();
        const formattedDate = now.toISOString().replace('T', ' ').substring(0, 19);
        
        // Add to tracking log
        if (!pengiriman.log_tracking) pengiriman.log_tracking = [];
        
        pengiriman.log_tracking.push({
            id: Date.now(),
            timestamp_log: formattedDate,
            koordinat_gps: currentLat && currentLng ? `${currentLat},${currentLng}` : "-6.2088,106.8456",
            status: newStatus,
            note: note || `Status diubah menjadi: ${getStatusLabel(newStatus)}`,
            location_description: locationDescriptionInput.value || "Lokasi tidak ditentukan"
        });
        
        // Close modal
        updateStatusModal.style.display = 'none';
        document.body.style.overflow = 'auto';
        
        // Refresh table
        loadPengirimanTable();
        
        // Show notification
        showNotification('Status pengiriman berhasil diupdate!', 'success');
    });
    
    // Confirm update location
    confirmLocationBtn.addEventListener('click', function() {
        if (!selectedPengirimanId) return;
        
        const pengiriman = pengirimanData.find(p => p.id === selectedPengirimanId);
        if (!pengiriman) return;
        
        const lat = gpsLatInput.value;
        const lng = gpsLngInput.value;
        const locationDesc = locationDescriptionInput.value.trim();
        const note = locationNoteTextarea.value.trim();
        const estimasiTiba = estimasiTibaInput.value;
        
        if (!lat || !lng) {
            showNotification('Silakan dapatkan koordinat GPS terlebih dahulu', 'warning');
            return;
        }
        
        // Update estimasi tiba
        if (estimasiTiba) {
            pengiriman.estimasi_tiba = estimasiTiba;
        }
        
        // Create timestamp
        const now = new Date();
        const formattedDate = now.toISOString().replace('T', ' ').substring(0, 19);
        
        // Add to tracking log
        if (!pengiriman.log_tracking) pengiriman.log_tracking = [];
        
        pengiriman.log_tracking.push({
            id: Date.now(),
            timestamp_log: formattedDate,
            koordinat_gps: `${lat},${lng}`,
            status: pengiriman.status,
            note: note || `Update lokasi: ${locationDesc || 'Lokasi diperbarui'}`,
            location_description: locationDesc || `Koordinat: ${lat}, ${lng}`
        });
        
        // Close modal
        updateLocationModal.style.display = 'none';
        document.body.style.overflow = 'auto';
        
        // Show notification
        showNotification('Lokasi berhasil diperbarui!', 'success');
    });
    
    // Show tracking history modal
    function showTrackingHistoryModal(pengiriman) {
        if (!pengiriman.log_tracking || pengiriman.log_tracking.length === 0) {
            trackingHistoryContent.innerHTML = `
                <div style="text-align: center; padding: 40px; color: var(--text-light);">
                    <i class="fas fa-history" style="font-size: 40px; margin-bottom: 10px; opacity: 0.5; display: block;"></i>
                    <div>Belum ada riwayat tracking</div>
                </div>
            `;
        } else {
            // Sort tracking by timestamp (newest first)
            const sortedTracking = [...pengiriman.log_tracking].sort((a, b) => 
                new Date(b.timestamp_log) - new Date(a.timestamp_log)
            );
            
            const trackingHTML = sortedTracking.map(track => {
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
            
            trackingHistoryContent.innerHTML = trackingHTML;
        }
        
        trackingHistoryModal.style.display = 'flex';
        document.body.style.overflow = 'hidden';
    }
    
    // Close modals
    document.querySelectorAll('.close-detail-modal').forEach(btn => {
        btn.addEventListener('click', function() {
            detailModal.style.display = 'none';
            document.body.style.overflow = 'auto';
        });
    });
    
    closeUpdateModalBtn.addEventListener('click', function() {
        updateStatusModal.style.display = 'none';
        document.body.style.overflow = 'auto';
    });
    
    closeLocationModalBtn.addEventListener('click', function() {
        updateLocationModal.style.display = 'none';
        document.body.style.overflow = 'auto';
    });
    
    closeTrackingModalBtn.addEventListener('click', function() {
        trackingHistoryModal.style.display = 'none';
        document.body.style.overflow = 'auto';
    });
    
    // Close modal when clicking outside
    [detailModal, updateStatusModal, updateLocationModal, trackingHistoryModal].forEach(modal => {
        modal.addEventListener('click', function(e) {
            if (e.target === modal) {
                modal.style.display = 'none';
                document.body.style.overflow = 'auto';
            }
        });
    });
    
    // Update status button in detail modal
    updateStatusBtn.addEventListener('click', function() {
        detailModal.style.display = 'none';
        
        if (selectedPengirimanId) {
            const pengiriman = pengirimanData.find(p => p.id === selectedPengirimanId);
            if (pengiriman) {
                showUpdateModal(pengiriman);
            }
        }
    });
    
    // Track location button in detail modal
    trackLocationBtn.addEventListener('click', function() {
        detailModal.style.display = 'none';
        
        if (selectedPengirimanId) {
            const pengiriman = pengirimanData.find(p => p.id === selectedPengirimanId);
            if (pengiriman) {
                showLocationModal(pengiriman);
            }
        }
    });
    
    // Pagination buttons
    document.querySelector('.btn-pagination.prev').addEventListener('click', function() {
        if (currentPage > 1) {
            currentPage--;
            loadPengirimanTable();
        }
    });
    
    document.querySelector('.btn-pagination.next').addEventListener('click', function() {
        const filteredData = filterData(pengirimanData);
        const totalPages = Math.ceil(filteredData.length / itemsPerPage);
        
        if (currentPage < totalPages) {
            currentPage++;
            loadPengirimanTable();
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
            'selesai': 'Selesai'
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
            'selesai': 'fas fa-check-circle'
        };
        return icons[status] || 'fas fa-info-circle';
    }
    
    function isStatusCompleted(currentStatus, checkStatus) {
        const statusOrder = ['loading_barang', 'berangkat', 'dalam_perjalanan', 'tiba_ditujuan', 'unloading', 'selesai'];
        const currentIndex = statusOrder.indexOf(currentStatus);
        const checkIndex = statusOrder.indexOf(checkStatus);
        
        return currentIndex > checkIndex;
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
</script>
@endsection