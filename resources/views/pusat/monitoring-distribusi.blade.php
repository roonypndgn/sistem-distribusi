
@extends('layouts.pusat')

@section('title', 'Monitoring Distribusi - PT. Mardua Holong')

@section('page-title', 'Monitoring Distribusi')
@section('page-subtitle', 'Pantau real-time pengiriman seluruh armada')

@section('content')
<div class="content-wrapper">
    <!-- Header -->
    <div class="content-header">
        <div class="header-left">
            <h1>Monitoring Distribusi</h1>
            <p>Pantau pergerakan seluruh armada dalam waktu nyata</p>
        </div>
        <div class="header-right">
            <div class="header-stats">
                <div class="stat-item">
                    <span class="stat-label">Armada Aktif</span>
                    <span class="stat-value" id="armadaAktif">12</span>
                </div>
                <div class="stat-item">
                    <span class="stat-label">Dalam Perjalanan</span>
                    <span class="stat-value" id="dalamPerjalanan">8</span>
                </div>
            </div>
            <button type="button" id="refreshBtn" class="btn btn-primary">
                <i class="fas fa-sync-alt"></i> Refresh
            </button>
        </div>
    </div>
    
    <!-- Dashboard Stats -->
    <div class="dashboard-stats">
        <div class="stat-card stat-card-primary">
            <div class="stat-icon">
                <i class="fas fa-truck"></i>
            </div>
            <div class="stat-info">
                <div class="stat-label">Total Pengiriman Hari Ini</div>
                <div class="stat-value">24</div>
                <div class="stat-change positive">+3 dari kemarin</div>
            </div>
        </div>
        
        <div class="stat-card stat-card-success">
            <div class="stat-icon">
                <i class="fas fa-check-circle"></i>
            </div>
            <div class="stat-info">
                <div class="stat-label">Selesai Hari Ini</div>
                <div class="stat-value">16</div>
                <div class="stat-change positive">Selesai 67%</div>
            </div>
        </div>
        
        <div class="stat-card stat-card-warning">
            <div class="stat-icon">
                <i class="fas fa-clock"></i>
            </div>
            <div class="stat-info">
                <div class="stat-label">Dalam Proses</div>
                <div class="stat-value">8</div>
                <div class="stat-change negative">3 terlambat</div>
            </div>
        </div>
        
        <div class="stat-card stat-card-info">
            <div class="stat-icon">
                <i class="fas fa-road"></i>
            </div>
            <div class="stat-info">
                <div class="stat-label">Total Jarak Tempuh</div>
                <div class="stat-value">1,240 km</div>
                <div class="stat-change">Rata-rata 155 km/armada</div>
            </div>
        </div>
    </div>
    
    <!-- Filter dan Kontrol -->
    <div class="content-card" style="margin-bottom: 30px;">
        <div class="card-header">
            <div class="card-title">
                <i class="fas fa-filter"></i>
                <span>Filter Monitoring</span>
            </div>
            <div class="card-actions">
                <div class="toggle-view">
                    <button type="button" id="mapViewBtn" class="btn btn-outline-primary active">
                        <i class="fas fa-map"></i> Peta
                    </button>
                    <button type="button" id="listViewBtn" class="btn btn-outline-primary">
                        <i class="fas fa-list"></i> Daftar
                    </button>
                </div>
            </div>
        </div>
        
        <div class="filter-options">
            <div class="filter-group">
                <label class="filter-label">Status</label>
                <select id="filterStatus" class="form-control">
                    <option value="">Semua Status</option>
                    <option value="dipanen">Dipanen</option>
                    <option value="dikemas">Dikemas</option>
                    <option value="dikirim">Dikirim</option>
                    <option value="diterima">Diterima</option>
                </select>
            </div>
            
            <div class="filter-group">
                <label class="filter-label">Supir</label>
                <select id="filterSupir" class="form-control">
                    <option value="">Semua Supir</option>
                    <option value="SUP-001">Budi Santoso</option>
                    <option value="SUP-002">Agus Wijaya</option>
                    <option value="SUP-003">Rudi Hartono</option>
                </select>
            </div>
            
            <div class="filter-group">
                <label class="filter-label">Kendaraan</label>
                <select id="filterKendaraan" class="form-control">
                    <option value="">Semua Kendaraan</option>
                    <option value="B-1234-ABC">B 1234 ABC (Truk Box)</option>
                    <option value="B-5678-XYZ">B 5678 XYZ (Pickup)</option>
                    <option value="B-9012-DEF">B 9012 DEF (Truk Besar)</option>
                </select>
            </div>
            
            <div class="filter-group">
                <label class="filter-label">&nbsp;</label>
                <div style="display: flex; gap: 10px;">
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
    
    <!-- Map View -->
    <div id="mapView" class="content-card" style="display: block; margin-bottom: 30px;">
        <div class="card-header">
            <div class="card-title">
                <i class="fas fa-map-marked-alt"></i>
                <span>Peta Monitoring Distribusi</span>
            </div>
            <div class="card-info">
                <span id="mapVehicleCount">8</span> kendaraan aktif ditampilkan
            </div>
        </div>
        
        <div class="map-container">
            <!-- Simulasi Map -->
            <div class="map-placeholder">
                <div class="map-grid">
                    <!-- Map area dengan marker -->
                    <div class="map-area">
                        <!-- Gudang Pusat -->
                        <div class="map-location warehouse" style="top: 45%; left: 30%;">
                            <div class="location-marker">
                                <i class="fas fa-warehouse"></i>
                            </div>
                            <div class="location-label">Gudang Pusat</div>
                        </div>
                        
                        <!-- Markers untuk pengiriman -->
                        <div class="map-marker marker-1" style="top: 40%; left: 35%;" data-id="1">
                            <div class="marker-icon">
                                <i class="fas fa-truck"></i>
                            </div>
                            <div class="marker-pulse"></div>
                            <div class="marker-info">
                                <div class="marker-title">PGN-2024-001</div>
                                <div class="marker-status">Dalam Perjalanan</div>
                            </div>
                        </div>
                        
                        <div class="map-marker marker-2" style="top: 50%; left: 40%;" data-id="2">
                            <div class="marker-icon">
                                <i class="fas fa-truck"></i>
                            </div>
                            <div class="marker-pulse"></div>
                            <div class="marker-info">
                                <div class="marker-title">PGN-2024-002</div>
                                <div class="marker-status">Loading</div>
                            </div>
                        </div>
                        
                        <div class="map-marker marker-3" style="top: 35%; left: 50%;" data-id="3">
                            <div class="marker-icon">
                                <i class="fas fa-truck"></i>
                            </div>
                            <div class="marker-pulse"></div>
                            <div class="marker-info">
                                <div class="marker-title">PGN-2024-003</div>
                                <div class="marker-status">Tiba di Tujuan</div>
                            </div>
                        </div>
                        
                        <!-- Tujuan Pengiriman -->
                        <div class="map-location destination" style="top: 30%; left: 60%;">
                            <div class="location-marker">
                                <i class="fas fa-map-marker-alt"></i>
                            </div>
                            <div class="location-label">Toko Pusat Jakarta</div>
                        </div>
                        
                        <div class="map-location destination" style="top: 55%; left: 55%;">
                            <div class="location-marker">
                                <i class="fas fa-map-marker-alt"></i>
                            </div>
                            <div class="location-label">Pasar Induk Bandung</div>
                        </div>
                        
                        <div class="map-location destination" style="top: 40%; left: 70%;">
                            <div class="location-marker">
                                <i class="fas fa-map-marker-alt"></i>
                            </div>
                            <div class="location-label">Toko Cabang Surabaya</div>
                        </div>
                        
                        <!-- Rute -->
                        <div class="map-route route-1"></div>
                        <div class="map-route route-2"></div>
                        <div class="map-route route-3"></div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="map-legend">
            <div class="legend-item">
                <span class="legend-color" style="background-color: #2D6A4F;"></span>
                <span class="legend-text">Gudang Pusat</span>
            </div>
            <div class="legend-item">
                <span class="legend-color" style="background-color: #1565C0;"></span>
                <span class="legend-text">Armada Aktif</span>
            </div>
            <div class="legend-item">
                <span class="legend-color" style="background-color: #C2185B;"></span>
                <span class="legend-text">Tujuan Pengiriman</span>
            </div>
            <div class="legend-item">
                <span class="legend-color" style="background-color: #FF9800;"></span>
                <span class="legend-text">Dalam Perjalanan</span>
            </div>
            <div class="legend-item">
                <span class="legend-color" style="background-color: #2E7D32;"></span>
                <span class="legend-text">Selesai</span>
            </div>
        </div>
    </div>
    
    <!-- List View -->
    <div id="listView" class="content-card" style="display: none;">
        <div class="card-header">
            <div class="card-title">
                <i class="fas fa-list"></i>
                <span>Daftar Pengiriman Aktif</span>
            </div>
            <div class="card-info">
                Menampilkan <span id="showingCount">8</span> dari <span id="totalCount">24</span> pengiriman
            </div>
        </div>
        
        <div class="table-responsive">
            <table class="data-table">
                <thead>
                    <tr>
                        <th style="width: 50px;">No</th>
                        <th>Kode</th>
                        <th>Tanggal</th>
                        <th>Supir</th>
                        <th>Kendaraan</th>
                        <th>Tujuan</th>
                        <th>Status</th>
                        <th>Lokasi Terakhir</th>
                        <th style="width: 150px;">Aksi</th>
                    </tr>
                </thead>
                <tbody id="monitoringTableBody">
                    <!-- Data akan diisi oleh JavaScript -->
                </tbody>
            </table>
        </div>
        
        <!-- Pagination -->
        <div class="table-footer">
            <div class="showing-count">
                Halaman <span id="currentPage">1</span> dari <span id="totalPages">3</span>
            </div>
            <div class="pagination">
                <button type="button" class="btn-pagination prev">
                    <i class="fas fa-chevron-left"></i>
                </button>
                <div class="page-numbers" id="pageNumbers">
                    <button class="page-number active">1</button>
                    <button class="page-number">2</button>
                    <button class="page-number">3</button>
                </div>
                <button type="button" class="btn-pagination next">
                    <i class="fas fa-chevron-right"></i>
                </button>
            </div>
        </div>
    </div>
    
    <!-- Detail Armada -->
    <div id="detailSidebar" class="detail-sidebar">
        <div class="sidebar-header">
            <h3>Detail Pengiriman</h3>
            <button type="button" id="closeDetailBtn">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <div class="sidebar-body" id="detailSidebarBody">
            <!-- Detail akan diisi oleh JavaScript -->
        </div>
    </div>
</div>

<!-- Modal Real-time Tracking -->
<div id="trackingModal" class="modal">
    <div class="modal-content modal-lg">
        <div class="modal-header">
            <h3 class="modal-title">Real-time Tracking</h3>
            <button type="button" class="close-tracking-modal">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <div class="modal-body">
            <div id="trackingMap" class="tracking-map-placeholder">
                <!-- Simulasi peta tracking -->
                <div class="tracking-map">
                    <div class="route-path"></div>
                    <div class="current-location">
                        <div class="location-pulse"></div>
                        <div class="location-marker">
                            <i class="fas fa-truck-moving"></i>
                        </div>
                    </div>
                    <div class="start-location">
                        <i class="fas fa-warehouse"></i>
                        <div class="location-label">Gudang</div>
                    </div>
                    <div class="end-location">
                        <i class="fas fa-map-marker-alt"></i>
                        <div class="location-label">Tujuan</div>
                    </div>
                </div>
            </div>
            
            <div class="tracking-info">
                <div class="tracking-header">
                    <div class="tracking-title" id="trackingPengirimanKode">PGN-2024-001</div>
                    <div class="tracking-time" id="trackingUpdateTime">Update: 14:30</div>
                </div>
                
                <div class="tracking-stats">
                    <div class="tracking-stat">
                        <div class="stat-label">Jarak Tempuh</div>
                        <div class="stat-value" id="trackingJarak">45.5 km</div>
                    </div>
                    <div class="tracking-stat">
                        <div class="stat-label">Estimasi Tiba</div>
                        <div class="stat-value" id="trackingEstimasi">12:00 WIB</div>
                    </div>
                    <div class="tracking-stat">
                        <div class="stat-label">Kecepatan</div>
                        <div class="stat-value" id="trackingKecepatan">60 km/jam</div>
                    </div>
                </div>
                
                <div class="tracking-history">
                    <h4>Riwayat Tracking</h4>
                    <div id="trackingHistoryList">
                        <!-- Tracking history akan diisi oleh JavaScript -->
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary close-tracking-modal">
                Tutup
            </button>
            <button type="button" class="btn btn-primary" id="refreshTrackingBtn">
                <i class="fas fa-sync-alt"></i> Refresh
            </button>
        </div>
    </div>
</div>

<!-- Modal Kontrol Armada -->
<div id="controlModal" class="modal">
    <div class="modal-content">
        <div class="modal-header">
            <h3 class="modal-title">Kontrol Armada</h3>
            <button type="button" class="close-control-modal">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <div class="modal-body">
            <div class="form-group">
                <label class="form-label">Armada</label>
                <div class="vehicle-selected" id="controlVehicleInfo">
                    <!-- Info kendaraan akan diisi oleh JavaScript -->
                </div>
            </div>
            
            <div class="form-group">
                <label class="form-label">Aksi Kontrol</label>
                <div class="control-actions">
                    <button type="button" class="btn-control-action btn-warning" data-action="pause">
                        <i class="fas fa-pause"></i> Jeda Sementara
                    </button>
                    <button type="button" class="btn-control-action btn-info" data-action="reroute">
                        <i class="fas fa-route"></i> Ubah Rute
                    </button>
                    <button type="button" class="btn-control-action btn-danger" data-action="emergency">
                        <i class="fas fa-exclamation-triangle"></i> Darurat
                    </button>
                </div>
            </div>
            
            <div class="form-group">
                <label class="form-label">Pesan ke Supir</label>
                <textarea id="messageToDriver" class="form-control" rows="3" placeholder="Tulis pesan untuk supir..."></textarea>
            </div>
            
            <div class="form-group">
                <label class="form-label">Status Darurat</label>
                <select id="emergencyStatus" class="form-control">
                    <option value="">Pilih Status Darurat</option>
                    <option value="kecelakaan">Kecelakaan</option>
                    <option value="mogok">Kendaraan Mogok</option>
                    <option value="pencurian">Pencurian/Begal</option>
                    <option value="kesehatan">Masalah Kesehatan</option>
                    <option value="lainnya">Lainnya</option>
                </select>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary close-control-modal">
                Batal
            </button>
            <button type="button" class="btn btn-primary" id="sendControlBtn">
                <i class="fas fa-paper-plane"></i> Kirim Kontrol
            </button>
        </div>
    </div>
</div>

<!-- Modal Laporan Distribusi -->
<div id="reportModal" class="modal">
    <div class="modal-content modal-lg">
        <div class="modal-header">
            <h3 class="modal-title">Laporan Distribusi</h3>
            <button type="button" class="close-report-modal">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <div class="modal-body">
            <div class="report-filters">
                <div class="filter-group">
                    <label class="filter-label">Periode</label>
                    <select id="reportPeriod" class="form-control">
                        <option value="hari-ini">Hari Ini</option>
                        <option value="minggu-ini">Minggu Ini</option>
                        <option value="bulan-ini">Bulan Ini</option>
                        <option value="custom">Custom</option>
                    </select>
                </div>
                
                <div class="filter-group">
                    <label class="filter-label">Dari Tanggal</label>
                    <input type="date" id="reportStartDate" class="form-control">
                </div>
                
                <div class="filter-group">
                    <label class="filter-label">Sampai Tanggal</label>
                    <input type="date" id="reportEndDate" class="form-control">
                </div>
                
                <div class="filter-group">
                    <label class="filter-label">&nbsp;</label>
                    <button type="button" id="generateReportBtn" class="btn btn-primary">
                        <i class="fas fa-chart-bar"></i> Generate
                    </button>
                </div>
            </div>
            
            <div class="report-content">
                <div class="report-charts">
                    <!-- Chart akan diisi oleh JavaScript -->
                    <div class="chart-container">
                        <canvas id="deliveryChart" width="400" height="200"></canvas>
                    </div>
                </div>
                
                <div class="report-summary">
                    <h4>Ringkasan Distribusi</h4>
                    <div class="summary-grid">
                        <!-- Summary akan diisi oleh JavaScript -->
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary close-report-modal">
                Tutup
            </button>
            <button type="button" class="btn btn-success" id="exportReportBtn">
                <i class="fas fa-file-export"></i> Export PDF
            </button>
        </div>
    </div>
</div>

<style>
    /* ==============================
       VARIABLES & BASE STYLES
       ============================== */
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
    
    /* ==============================
       HEADER STYLES
       ============================== */
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
        align-items: center;
        gap: 30px;
    }
    
    .header-stats {
        display: flex;
        gap: 20px;
    }
    
    .stat-item {
        text-align: right;
    }
    
    .stat-label {
        display: block;
        font-size: 12px;
        color: var(--text-light);
        margin-bottom: 2px;
    }
    
    .stat-value {
        font-size: 24px;
        font-weight: 700;
        color: var(--primary);
    }
    
    /* ==============================
       DASHBOARD STATS
       ============================== */
    .dashboard-stats {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
        gap: 20px;
        margin-bottom: 30px;
    }
    
    .stat-card {
        background: white;
        border-radius: 12px;
        padding: 20px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.05);
        border: 1px solid var(--border);
        display: flex;
        align-items: center;
        gap: 15px;
        transition: var(--transition);
    }
    
    .stat-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(0,0,0,0.1);
    }
    
    .stat-card-primary {
        border-left: 4px solid var(--primary);
    }
    
    .stat-card-success {
        border-left: 4px solid var(--success);
    }
    
    .stat-card-warning {
        border-left: 4px solid var(--warning);
    }
    
    .stat-card-info {
        border-left: 4px solid var(--info);
    }
    
    .stat-icon {
        width: 50px;
        height: 50px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 24px;
        background: var(--primary-lighter);
        color: var(--primary);
    }
    
    .stat-card-success .stat-icon {
        background: #E8F5E9;
        color: var(--success);
    }
    
    .stat-card-warning .stat-icon {
        background: #FFF3E0;
        color: var(--warning);
    }
    
    .stat-card-info .stat-icon {
        background: #E3F2FD;
        color: var(--info);
    }
    
    .stat-info {
        flex: 1;
    }
    
    .stat-label {
        font-size: 12px;
        color: var(--text-light);
        margin-bottom: 5px;
    }
    
    .stat-value {
        font-size: 24px;
        font-weight: 700;
        color: var(--text-dark);
        margin-bottom: 3px;
    }
    
    .stat-change {
        font-size: 11px;
        color: var(--text-light);
    }
    
    .stat-change.positive {
        color: var(--success);
    }
    
    .stat-change.negative {
        color: var(--danger);
    }
    
    /* ==============================
       CARD STYLES
       ============================== */
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
    
    .card-actions {
        display: flex;
        gap: 10px;
    }
    
    .toggle-view .btn {
        padding: 8px 16px;
        font-size: 14px;
    }
    
    .toggle-view .btn.active {
        background-color: var(--primary);
        color: white;
        border-color: var(--primary);
    }
    
    /* ==============================
       FILTER STYLES
       ============================== */
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
        box-shadow: 0 0 0 3px rgba(45, 106, 79, 0.1);
    }
    
    /* ==============================
       MAP VIEW STYLES
       ============================== */
    .map-container {
        position: relative;
        height: 500px;
        background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
        border-radius: 12px;
        overflow: hidden;
        margin-bottom: 20px;
    }
    
    .map-placeholder {
        width: 100%;
        height: 100%;
        position: relative;
    }
    
    .map-grid {
        position: relative;
        width: 100%;
        height: 100%;
        background-image: 
            linear-gradient(rgba(0,0,0,0.1) 1px, transparent 1px),
            linear-gradient(90deg, rgba(0,0,0,0.1) 1px, transparent 1px);
        background-size: 50px 50px;
    }
    
    .map-area {
        position: relative;
        width: 100%;
        height: 100%;
    }
    
    /* Map Locations */
    .map-location {
        position: absolute;
        transform: translate(-50%, -50%);
        text-align: center;
        z-index: 10;
    }
    
    .map-location.warehouse .location-marker {
        background: var(--primary);
        color: white;
        width: 40px;
        height: 40px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 18px;
        margin: 0 auto 8px;
        box-shadow: 0 4px 8px rgba(0,0,0,0.2);
    }
    
    .map-location.destination .location-marker {
        background: #C2185B;
        color: white;
        width: 32px;
        height: 32px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 14px;
        margin: 0 auto 6px;
        box-shadow: 0 3px 6px rgba(0,0,0,0.2);
    }
    
    .location-label {
        font-size: 12px;
        font-weight: 600;
        color: var(--text-dark);
        background: white;
        padding: 4px 8px;
        border-radius: 4px;
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        white-space: nowrap;
    }
    
    /* Map Markers */
    .map-marker {
        position: absolute;
        transform: translate(-50%, -50%);
        cursor: pointer;
        z-index: 20;
        transition: var(--transition);
    }
    
    .map-marker:hover {
        transform: translate(-50%, -50%) scale(1.1);
        z-index: 30;
    }
    
    .map-marker .marker-icon {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        background: #1565C0;
        color: white;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 16px;
        position: relative;
        z-index: 2;
        box-shadow: 0 4px 8px rgba(0,0,0,0.2);
    }
    
    .map-marker .marker-pulse {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        width: 60px;
        height: 60px;
        border-radius: 50%;
        background: rgba(21, 101, 192, 0.3);
        animation: pulse 2s infinite;
        z-index: 1;
    }
    
    @keyframes pulse {
        0% {
            transform: translate(-50%, -50%) scale(0.8);
            opacity: 1;
        }
        100% {
            transform: translate(-50%, -50%) scale(1.2);
            opacity: 0;
        }
    }
    
    .map-marker .marker-info {
        position: absolute;
        top: 100%;
        left: 50%;
        transform: translateX(-50%);
        background: white;
        padding: 8px 12px;
        border-radius: 8px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.15);
        min-width: 160px;
        opacity: 0;
        visibility: hidden;
        transition: var(--transition);
        margin-top: 10px;
        z-index: 100;
    }
    
    .map-marker:hover .marker-info {
        opacity: 1;
        visibility: visible;
        margin-top: 0;
    }
    
    .marker-title {
        font-size: 12px;
        font-weight: 600;
        color: var(--text-dark);
        margin-bottom: 2px;
    }
    
    .marker-status {
        font-size: 11px;
        color: var(--success);
        font-weight: 500;
    }
    
    /* Map Routes */
    .map-route {
        position: absolute;
        height: 3px;
        background: var(--warning);
        border-radius: 2px;
        transform-origin: left center;
        z-index: 5;
    }
    
    .route-1 {
        top: 40%;
        left: 30%;
        width: 15%;
        transform: rotate(45deg);
    }
    
    .route-2 {
        top: 50%;
        left: 30%;
        width: 10%;
        transform: rotate(25deg);
    }
    
    .route-3 {
        top: 35%;
        left: 30%;
        width: 20%;
        transform: rotate(30deg);
    }
    
    /* Map Legend */
    .map-legend {
        display: flex;
        flex-wrap: wrap;
        gap: 20px;
        justify-content: center;
        padding: 15px;
        background: var(--light);
        border-radius: 8px;
    }
    
    .legend-item {
        display: flex;
        align-items: center;
        gap: 8px;
    }
    
    .legend-color {
        width: 16px;
        height: 16px;
        border-radius: 4px;
        display: inline-block;
    }
    
    .legend-text {
        font-size: 12px;
        color: var(--text-dark);
    }
    
    /* ==============================
       TABLE VIEW STYLES
       ============================== */
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
    
    .badge-dipanen {
        background-color: #FFF3E0;
        color: #EF6C00;
        border: 1px solid #FFE0B2;
    }
    
    .badge-dikemas {
        background-color: #E3F2FD;
        color: #1565C0;
        border: 1px solid #BBDEFB;
    }
    
    .badge-dikirim {
        background-color: #FFF8E1;
        color: #FF8F00;
        border: 1px solid #FFECB3;
    }
    
    .badge-diterima {
        background-color: #E8F5E9;
        color: #2E7D32;
        border: 1px solid #C8E6C9;
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
    
    /* ==============================
       PAGINATION STYLES
       ============================== */
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
    
    /* ==============================
       ACTION BUTTONS
       ============================== */
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
    
    .btn-track {
        background-color: #E3F2FD;
        color: #1565C0;
    }
    
    .btn-track:hover {
        background-color: #1565C0;
        color: white;
    }
    
    .btn-control {
        background-color: #FFF3E0;
        color: #EF6C00;
    }
    
    .btn-control:hover {
        background-color: #EF6C00;
        color: white;
    }
    
    .btn-report {
        background-color: #E8F5E9;
        color: #2E7D32;
    }
    
    .btn-report:hover {
        background-color: #2E7D32;
        color: white;
    }
    
    /* ==============================
       DETAIL SIDEBAR
       ============================== */
    .detail-sidebar {
        position: fixed;
        top: 0;
        right: -400px;
        width: 400px;
        height: 100vh;
        background: white;
        box-shadow: -4px 0 20px rgba(0,0,0,0.1);
        z-index: 1000;
        transition: right 0.3s ease;
        display: flex;
        flex-direction: column;
    }
    
    .detail-sidebar.open {
        right: 0;
    }
    
    .sidebar-header {
        padding: 20px;
        border-bottom: 1px solid var(--border);
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
    
    .sidebar-header h3 {
        margin: 0;
        font-size: 18px;
        font-weight: 600;
        color: var(--text-dark);
    }
    
    .sidebar-header button {
        background: none;
        border: none;
        font-size: 18px;
        color: var(--text-light);
        cursor: pointer;
        width: 36px;
        height: 36px;
        border-radius: 6px;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    
    .sidebar-header button:hover {
        background-color: var(--light);
    }
    
    .sidebar-body {
        flex: 1;
        padding: 20px;
        overflow-y: auto;
    }
    
    /* ==============================
       MODAL STYLES
       ============================== */
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
        max-width: 800px;
        max-height: 90vh;
        overflow-y: auto;
        animation: modalFadeIn 0.3s ease;
    }
    
    .modal-lg {
        max-width: 1000px;
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
    
    .close-tracking-modal,
    .close-control-modal,
    .close-report-modal {
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
    
    .close-tracking-modal:hover,
    .close-control-modal:hover,
    .close-report-modal:hover {
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
    
    /* ==============================
       TRACKING MODAL STYLES
       ============================== */
    .tracking-map-placeholder {
        position: relative;
        height: 300px;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border-radius: 12px;
        overflow: hidden;
        margin-bottom: 20px;
    }
    
    .tracking-map {
        position: relative;
        width: 100%;
        height: 100%;
    }
    
    .route-path {
        position: absolute;
        top: 50%;
        left: 20%;
        width: 60%;
        height: 4px;
        background: var(--warning);
        border-radius: 2px;
    }
    
    .current-location {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        z-index: 20;
    }
    
    .current-location .location-marker {
        width: 50px;
        height: 50px;
        border-radius: 50%;
        background: #1565C0;
        color: white;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 20px;
        position: relative;
        z-index: 2;
        box-shadow: 0 4px 8px rgba(0,0,0,0.3);
    }
    
    .current-location .location-pulse {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        width: 80px;
        height: 80px;
        border-radius: 50%;
        background: rgba(21, 101, 192, 0.3);
        animation: pulse 2s infinite;
        z-index: 1;
    }
    
    .start-location,
    .end-location {
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
        text-align: center;
        z-index: 10;
    }
    
    .start-location {
        left: 10%;
    }
    
    .end-location {
        right: 10%;
    }
    
    .start-location i,
    .end-location i {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        background: white;
        color: var(--primary);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 18px;
        margin: 0 auto 8px;
        box-shadow: 0 3px 6px rgba(0,0,0,0.2);
    }
    
    .end-location i {
        color: #C2185B;
    }
    
    .location-label {
        font-size: 12px;
        font-weight: 600;
        color: white;
        background: rgba(0,0,0,0.5);
        padding: 4px 8px;
        border-radius: 4px;
    }
    
    .tracking-info {
        margin-top: 20px;
    }
    
    .tracking-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px;
    }
    
    .tracking-title {
        font-size: 20px;
        font-weight: 700;
        color: var(--text-dark);
    }
    
    .tracking-time {
        font-size: 14px;
        color: var(--text-light);
    }
    
    .tracking-stats {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 20px;
        margin-bottom: 30px;
    }
    
    .tracking-stat {
        text-align: center;
        padding: 15px;
        background: var(--light);
        border-radius: 8px;
    }
    
    .tracking-stat .stat-label {
        font-size: 12px;
        color: var(--text-light);
        margin-bottom: 5px;
    }
    
    .tracking-stat .stat-value {
        font-size: 18px;
        font-weight: 700;
        color: var(--text-dark);
    }
    
    .tracking-history {
        margin-top: 30px;
    }
    
    .tracking-history h4 {
        font-size: 16px;
        font-weight: 600;
        color: var(--text-dark);
        margin-bottom: 15px;
    }
    
    .tracking-history-item {
        display: flex;
        align-items: flex-start;
        padding: 12px;
        border-bottom: 1px solid var(--border);
    }
    
    .tracking-history-item:last-child {
        border-bottom: none;
    }
    
    .tracking-history-time {
        width: 80px;
        font-size: 12px;
        color: var(--text-light);
        font-weight: 500;
    }
    
    .tracking-history-content {
        flex: 1;
    }
    
    .tracking-history-title {
        font-size: 14px;
        font-weight: 600;
        color: var(--text-dark);
        margin-bottom: 3px;
    }
    
    .tracking-history-location {
        font-size: 12px;
        color: var(--text-light);
    }
    
    /* ==============================
       CONTROL MODAL STYLES
       ============================== */
    .vehicle-selected {
        padding: 15px;
        background: var(--light);
        border-radius: 8px;
        margin-bottom: 20px;
    }
    
    .control-actions {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
        gap: 10px;
        margin-bottom: 20px;
    }
    
    .btn-control-action {
        padding: 12px;
        border-radius: 8px;
        border: none;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        font-size: 14px;
        font-weight: 500;
        transition: var(--transition);
    }
    
    .btn-control-action.btn-warning {
        background-color: #FFF3E0;
        color: #EF6C00;
    }
    
    .btn-control-action.btn-warning:hover {
        background-color: #EF6C00;
        color: white;
    }
    
    .btn-control-action.btn-info {
        background-color: #E3F2FD;
        color: #1565C0;
    }
    
    .btn-control-action.btn-info:hover {
        background-color: #1565C0;
        color: white;
    }
    
    .btn-control-action.btn-danger {
        background-color: #FFEBEE;
        color: #C62828;
    }
    
    .btn-control-action.btn-danger:hover {
        background-color: #C62828;
        color: white;
    }
    
    /* ==============================
       REPORT MODAL STYLES
       ============================== */
    .report-filters {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 20px;
        margin-bottom: 30px;
    }
    
    .report-content {
        margin-top: 20px;
    }
    
    .chart-container {
        height: 300px;
        margin-bottom: 30px;
    }
    
    .summary-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 20px;
    }
    
    .summary-item {
        padding: 15px;
        background: var(--light);
        border-radius: 8px;
        text-align: center;
    }
    
    /* ==============================
       BUTTON STYLES
       ============================== */
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
        background-color: #218838;
    }
    
    .btn-outline-primary {
        background-color: transparent;
        color: var(--primary);
        border: 1px solid var(--primary);
    }
    
    .btn-outline-primary:hover {
        background-color: var(--primary);
        color: white;
    }
    
    /* ==============================
       RESPONSIVE STYLES
       ============================== */
    @media (max-width: 1200px) {
        .detail-sidebar {
            width: 350px;
        }
    }
    
    @media (max-width: 992px) {
        .dashboard-stats {
            grid-template-columns: repeat(2, 1fr);
        }
        
        .filter-options {
            grid-template-columns: repeat(2, 1fr);
        }
        
        .tracking-stats {
            grid-template-columns: repeat(2, 1fr);
        }
    }
    
    @media (max-width: 768px) {
        .content-header {
            flex-direction: column;
            align-items: flex-start;
        }
        
        .header-right {
            width: 100%;
            justify-content: space-between;
        }
        
        .dashboard-stats {
            grid-template-columns: 1fr;
        }
        
        .filter-options {
            grid-template-columns: 1fr;
        }
        
        .card-header {
            flex-direction: column;
            align-items: flex-start;
        }
        
        .card-actions {
            width: 100%;
        }
        
        .map-container {
            height: 400px;
        }
        
        .tracking-stats {
            grid-template-columns: 1fr;
        }
        
        .detail-sidebar {
            width: 100%;
            right: -100%;
        }
        
        .table-footer {
            flex-direction: column;
            align-items: stretch;
        }
        
        .pagination {
            justify-content: center;
        }
        
        .modal-content {
            padding: 10px;
        }
        
        .control-actions {
            grid-template-columns: 1fr;
        }
    }
    
    @media (max-width: 576px) {
        .map-container {
            height: 300px;
        }
        
        .header-stats {
            flex-direction: column;
            gap: 10px;
        }
        
        .stat-item {
            text-align: left;
        }
        
        .action-buttons {
            flex-direction: row;
            justify-content: center;
        }
        
        .btn-action {
            width: 36px;
            height: 36px;
        }
    }
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Data dummy untuk monitoring
    const monitoringData = [
        {
            id: 1,
            kode_pengiriman: "PGN-2024-001",
            tanggal_kirim: "2024-03-15",
            waktu_kirim: "08:00",
            user_id: 1,
            supir_nama: "Budi Santoso",
            supir_kode: "SUP-001",
            kendaraan_id: 1,
            kendaraan_jenis: "Truk Box",
            kendaraan_plat: "B 1234 ABC",
            rute: "Gudang -> Tol Jagorawi -> Jakarta",
            tujuan_akhir: "Toko Utama Jakarta",
            alamat_tujuan: "Jl. Sudirman No. 123, Jakarta",
            status: "dikirim",
            jarak_tempuh: 45.5,
            estimasi_tiba: "2024-03-15T12:00:00",
            lokasi_terakhir: "Tol Jagorawi KM 32",
            koordinat_terakhir: "-6.2349,106.8090",
            catatan: "Pengiriman lancar",
            muatan: [
                { nama: "Jeruk Medan", jumlah: 100, satuan: "kg" },
                { nama: "Jeruk Sunkist", jumlah: 50, satuan: "kg" }
            ],
            log_tracking: [
                {
                    id: 1,
                    timestamp_log: "2024-03-15 07:00:00",
                    koordinat_gps: "-6.2088,106.8456",
                    status: "dipanen",
                    note: "Barang dipanen",
                    location_description: "Kebun Jeruk"
                },
                {
                    id: 2,
                    timestamp_log: "2024-03-15 08:00:00",
                    koordinat_gps: "-6.2088,106.8456",
                    status: "dikemas",
                    note: "Barang dikemas di gudang",
                    location_description: "Gudang Packing"
                },
                {
                    id: 3,
                    timestamp_log: "2024-03-15 08:30:00",
                    koordinat_gps: "-6.2088,106.8456",
                    status: "dikirim",
                    note: "Berangkat dari gudang",
                    location_description: "Gudang Utama"
                },
                {
                    id: 4,
                    timestamp_log: "2024-03-15 09:30:00",
                    koordinat_gps: "-6.2349,106.8090",
                    status: "dikirim",
                    note: "Sedang dalam perjalanan",
                    location_description: "Tol Jagorawi KM 32"
                }
            ]
        },
        {
            id: 2,
            kode_pengiriman: "PGN-2024-002",
            tanggal_kirim: "2024-03-15",
            waktu_kirim: "07:30",
            user_id: 2,
            supir_nama: "Agus Wijaya",
            supir_kode: "SUP-002",
            kendaraan_id: 2,
            kendaraan_jenis: "Pickup",
            kendaraan_plat: "B 5678 XYZ",
            rute: "Gudang -> Tol Cipularang -> Bandung",
            tujuan_akhir: "Pasar Induk Bandung",
            alamat_tujuan: "Jl. Astana Anyar No. 100, Bandung",
            status: "dikemas",
            jarak_tempuh: 140,
            estimasi_tiba: "2024-03-15T11:00:00",
            lokasi_terakhir: "Gudang Packing",
            koordinat_terakhir: "-6.2088,106.8456",
            catatan: "Menunggu packing selesai",
            muatan: [
                { nama: "Jeruk Bali", jumlah: 80, satuan: "kg" }
            ],
            log_tracking: [
                {
                    id: 5,
                    timestamp_log: "2024-03-15 06:30:00",
                    koordinat_gps: "-6.2088,106.8456",
                    status: "dipanen",
                    note: "Barang dipanen",
                    location_description: "Kebun Jeruk"
                },
                {
                    id: 6,
                    timestamp_log: "2024-03-15 07:30:00",
                    koordinat_gps: "-6.2088,106.8456",
                    status: "dikemas",
                    note: "Proses packing",
                    location_description: "Gudang Packing"
                }
            ]
        },
        {
            id: 3,
            kode_pengiriman: "PGN-2024-003",
            tanggal_kirim: "2024-03-15",
            waktu_kirim: "06:00",
            user_id: 3,
            supir_nama: "Rudi Hartono",
            supir_kode: "SUP-003",
            kendaraan_id: 3,
            kendaraan_jenis: "Truk Box Besar",
            kendaraan_plat: "B 9012 DEF",
            rute: "Gudang -> Tol Trans Jawa -> Surabaya",
            tujuan_akhir: "Toko Pusat Surabaya",
            alamat_tujuan: "Jl. Tunjungan No. 1, Surabaya",
            status: "diterima",
            jarak_tempuh: 750,
            estimasi_tiba: "2024-03-15T16:00:00",
            actual_tiba: "2024-03-15T15:45:00",
            lokasi_terakhir: "Toko Pusat Surabaya",
            koordinat_terakhir: "-7.2575,112.7521",
            catatan: "Barang diterima dengan baik",
            muatan: [
                { nama: "Jeruk Medan", jumlah: 200, satuan: "kg" },
                { nama: "Jeruk Sunkist", jumlah: 100, satuan: "kg" },
                { nama: "Jeruk Bali", jumlah: 150, satuan: "kg" }
            ],
            log_tracking: [
                {
                    id: 7,
                    timestamp_log: "2024-03-15 05:00:00",
                    koordinat_gps: "-6.2088,106.8456",
                    status: "dipanen",
                    note: "Barang dipanen pagi",
                    location_description: "Kebun Jeruk"
                },
                {
                    id: 8,
                    timestamp_log: "2024-03-15 06:00:00",
                    koordinat_gps: "-6.2088,106.8456",
                    status: "dikemas",
                    note: "Loading barang",
                    location_description: "Gudang Utama"
                },
                {
                    id: 9,
                    timestamp_log: "2024-03-15 06:00:00",
                    koordinat_gps: "-6.2088,106.8456",
                    status: "dikirim",
                    note: "Berangkat ke Surabaya",
                    location_description: "Gudang Utama"
                },
                {
                    id: 10,
                    timestamp_log: "2024-03-15 12:00:00",
                    koordinat_gps: "-6.9778,110.4081",
                    status: "dikirim",
                    note: "Istirahat di Semarang",
                    location_description: "Rest Area Semarang"
                },
                {
                    id: 11,
                    timestamp_log: "2024-03-15 15:30:00",
                    koordinat_gps: "-7.2575,112.7521",
                    status: "dikirim",
                    note: "Tiba di Surabaya",
                    location_description: "Parkiran Toko Pusat"
                },
                {
                    id: 12,
                    timestamp_log: "2024-03-15 15:45:00",
                    koordinat_gps: "-7.2575,112.7521",
                    status: "diterima",
                    note: "Barang diterima pelanggan",
                    location_description: "Toko Pusat Surabaya"
                }
            ]
        },
        {
            id: 4,
            kode_pengiriman: "PGN-2024-004",
            tanggal_kirim: "2024-03-14",
            waktu_kirim: "09:00",
            user_id: 1,
            supir_nama: "Budi Santoso",
            supir_kode: "SUP-001",
            kendaraan_id: 1,
            kendaraan_jenis: "Truk Box",
            kendaraan_plat: "B 1234 ABC",
            rute: "Gudang -> Tol Jakarta-Cikampek -> Bekasi",
            tujuan_akhir: "Pasar Modern Bekasi",
            alamat_tujuan: "Jl. Jend. Ahmad Yani No. 200, Bekasi",
            status: "dipanen",
            jarak_tempuh: 40,
            estimasi_tiba: "2024-03-14T13:00:00",
            lokasi_terakhir: "Kebun Jeruk",
            koordinat_terakhir: "-6.2088,106.8456",
            catatan: "Sedang dipanen",
            muatan: [
                { nama: "Jeruk Sunkist", jumlah: 150, satuan: "kg" },
                { nama: "Jeruk Medan", jumlah: 100, satuan: "kg" }
            ],
            log_tracking: [
                {
                    id: 13,
                    timestamp_log: "2024-03-14 09:00:00",
                    koordinat_gps: "-6.2088,106.8456",
                    status: "dipanen",
                    note: "Proses panen jeruk",
                    location_description: "Kebun Jeruk"
                }
            ]
        },
        {
            id: 5,
            kode_pengiriman: "PGN-2024-005",
            tanggal_kirim: "2024-03-14",
            waktu_kirim: "10:00",
            user_id: 4,
            supir_nama: "Joko Susilo",
            supir_kode: "SUP-004",
            kendaraan_id: 4,
            kendaraan_jenis: "Truk Box",
            kendaraan_plat: "B 3456 GHI",
            rute: "Gudang -> Tol Lingkar Luar -> Tangerang",
            tujuan_akhir: "Supermarket Central Tangerang",
            alamat_tujuan: "Jl. MH. Thamrin No. 50, Tangerang",
            status: "dikirim",
            jarak_tempuh: 35,
            estimasi_tiba: "2024-03-14T14:00:00",
            lokasi_terakhir: "Tol Lingkar Luar KM 15",
            koordinat_terakhir: "-6.1781,106.6300",
            catatan: "Macet di tol",
            muatan: [
                { nama: "Jeruk Sunkist", jumlah: 120, satuan: "kg" },
                { nama: "Jeruk Medan", jumlah: 180, satuan: "kg" }
            ],
            log_tracking: [
                {
                    id: 14,
                    timestamp_log: "2024-03-14 09:00:00",
                    koordinat_gps: "-6.2088,106.8456",
                    status: "dipanen",
                    note: "Barang dipanen",
                    location_description: "Kebun Jeruk"
                },
                {
                    id: 15,
                    timestamp_log: "2024-03-14 09:30:00",
                    koordinat_gps: "-6.2088,106.8456",
                    status: "dikemas",
                    note: "Proses packing",
                    location_description: "Gudang Packing"
                },
                {
                    id: 16,
                    timestamp_log: "2024-03-14 10:00:00",
                    koordinat_gps: "-6.2088,106.8456",
                    status: "dikirim",
                    note: "Berangkat ke Tangerang",
                    location_description: "Gudang Utama"
                },
                {
                    id: 17,
                    timestamp_log: "2024-03-14 12:00:00",
                    koordinat_gps: "-6.1781,106.6300",
                    status: "dikirim",
                    note: "Macet di tol",
                    location_description: "Tol Lingkar Luar KM 15"
                }
            ]
        }
    ];

    // Elemen DOM
    const refreshBtn = document.getElementById('refreshBtn');
    const mapViewBtn = document.getElementById('mapViewBtn');
    const listViewBtn = document.getElementById('listViewBtn');
    const applyFilterBtn = document.getElementById('applyFilterBtn');
    const resetFilterBtn = document.getElementById('resetFilterBtn');
    const filterStatus = document.getElementById('filterStatus');
    const filterSupir = document.getElementById('filterSupir');
    const filterKendaraan = document.getElementById('filterKendaraan');
    const mapView = document.getElementById('mapView');
    const listView = document.getElementById('listView');
    const monitoringTableBody = document.getElementById('monitoringTableBody');
    const closeDetailBtn = document.getElementById('closeDetailBtn');
    const detailSidebar = document.getElementById('detailSidebar');
    const detailSidebarBody = document.getElementById('detailSidebarBody');
    
    // Modals
    const trackingModal = document.getElementById('trackingModal');
    const controlModal = document.getElementById('controlModal');
    const reportModal = document.getElementById('reportModal');
    
    // State
    let currentPage = 1;
    const itemsPerPage = 10;
    let currentFilter = {
        status: '',
        supir: '',
        kendaraan: ''
    };
    
    let selectedPengirimanId = null;
    
    // Initialize
    loadMonitoringData();
    updateMapMarkers();
    
    // Toggle View
    mapViewBtn.addEventListener('click', function() {
        mapViewBtn.classList.add('active');
        listViewBtn.classList.remove('active');
        mapView.style.display = 'block';
        listView.style.display = 'none';
    });
    
    listViewBtn.addEventListener('click', function() {
        listViewBtn.classList.add('active');
        mapViewBtn.classList.remove('active');
        listView.style.display = 'block';
        mapView.style.display = 'none';
    });
    
    // Apply filter
    applyFilterBtn.addEventListener('click', function() {
        currentFilter = {
            status: filterStatus.value,
            supir: filterSupir.value,
            kendaraan: filterKendaraan.value
        };
        
        loadMonitoringData();
        updateMapMarkers();
    });
    
    // Reset filter
    resetFilterBtn.addEventListener('click', function() {
        filterStatus.value = '';
        filterSupir.value = '';
        filterKendaraan.value = '';
        
        currentFilter = {
            status: '',
            supir: '',
            kendaraan: ''
        };
        
        loadMonitoringData();
        updateMapMarkers();
    });
    
    // Refresh button
    refreshBtn.addEventListener('click', function() {
        refreshBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Loading...';
        refreshBtn.disabled = true;
        
        setTimeout(() => {
            loadMonitoringData();
            updateMapMarkers();
            refreshBtn.innerHTML = '<i class="fas fa-sync-alt"></i> Refresh';
            refreshBtn.disabled = false;
            showNotification('Data monitoring berhasil direfresh', 'success');
        }, 1000);
    });
    
    // Load monitoring data
    function loadMonitoringData() {
        monitoringTableBody.innerHTML = '';
        
        const filteredData = filterData(monitoringData);
        const startIndex = (currentPage - 1) * itemsPerPage;
        const endIndex = startIndex + itemsPerPage;
        const pageData = filteredData.slice(startIndex, endIndex);
        
        if (pageData.length === 0) {
            monitoringTableBody.innerHTML = `
                <tr>
                    <td colspan="9" style="text-align: center; padding: 40px; color: var(--text-light);">
                        <i class="fas fa-truck" style="font-size: 40px; margin-bottom: 10px; opacity: 0.5; display: block;"></i>
                        <div>Tidak ada data monitoring</div>
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
                        <div style="font-weight: 600; color: var(--text-dark);">${formatDate(pengiriman.tanggal_kirim)}</div>
                        <div style="font-size: 12px; color: var(--text-light);">${pengiriman.waktu_kirim}</div>
                    </td>
                    <td>
                        <div style="font-weight: 600; color: var(--text-dark);">${pengiriman.supir_nama}</div>
                        <div style="font-size: 12px; color: var(--text-light); margin-top: 3px;">${pengiriman.supir_kode}</div>
                    </td>
                    <td>
                        <div class="vehicle-badge">
                            <i class="fas fa-truck"></i>
                            ${pengiriman.kendaraan_jenis}
                        </div>
                        <div style="font-size: 12px; color: var(--text-light); margin-top: 3px;">${pengiriman.kendaraan_plat}</div>
                    </td>
                    <td>
                        <div style="font-weight: 600; color: var(--text-dark);">${pengiriman.tujuan_akhir}</div>
                        <div style="font-size: 12px; color: var(--text-light); margin-top: 3px;">${pengiriman.jarak_tempuh} km</div>
                    </td>
                    <td>
                        <span class="status-badge badge-${pengiriman.status}">
                            ${getStatusLabel(pengiriman.status)}
                        </span>
                    </td>
                    <td>
                        <div style="font-size: 13px; color: var(--text-dark);">${pengiriman.lokasi_terakhir || '-'}</div>
                        <div style="font-size: 11px; color: var(--text-light); margin-top: 2px;">
                            ${getLastUpdateTime(pengiriman)}
                        </div>
                    </td>
                    <td>
                        <div class="action-buttons">
                            <button type="button" class="btn-action btn-view" data-id="${pengiriman.id}" title="Lihat Detail">
                                <i class="fas fa-eye"></i>
                            </button>
                            <button type="button" class="btn-action btn-track" data-id="${pengiriman.id}" title="Live Tracking">
                                <i class="fas fa-map-marked-alt"></i>
                            </button>
                            <button type="button" class="btn-action btn-report" data-id="${pengiriman.id}" title="Laporan">
                                <i class="fas fa-chart-bar"></i>
                            </button>
                        </div>
                    </td>
                `;
                
                monitoringTableBody.appendChild(row);
            });
        }
        
        // Update counts
        document.getElementById('showingCount').textContent = pageData.length;
        document.getElementById('totalCount').textContent = filteredData.length;
        
        // Update stats
        updateStats(filteredData);
        
        // Add event listeners
        addActionListeners();
    }
    
    // Filter data
    function filterData(data) {
        return data.filter(item => {
            // Filter status
            if (currentFilter.status && item.status !== currentFilter.status) return false;
            
            // Filter supir
            if (currentFilter.supir && item.supir_kode !== currentFilter.supir) return false;
            
            // Filter kendaraan
            if (currentFilter.kendaraan && !item.kendaraan_plat.includes(currentFilter.kendaraan)) return false;
            
            return true;
        }).sort((a, b) => new Date(b.tanggal_kirim) - new Date(a.tanggal_kirim));
    }
    
    // Update stats
    function updateStats(data) {
        const armadaAktif = data.length;
        const dalamPerjalanan = data.filter(item => item.status === 'dikirim').length;
        
        document.getElementById('armadaAktif').textContent = armadaAktif;
        document.getElementById('dalamPerjalanan').textContent = dalamPerjalanan;
        document.getElementById('mapVehicleCount').textContent = armadaAktif;
    }
    
    // Update map markers
    function updateMapMarkers() {
        const filteredData = filterData(monitoringData);
        
        // Update map markers based on filtered data
        // In real implementation, this would update actual map markers
        console.log('Map markers updated for', filteredData.length, 'vehicles');
    }
    
    // Add action listeners
    function addActionListeners() {
        // View buttons
        document.querySelectorAll('.btn-action.btn-view').forEach(btn => {
            btn.addEventListener('click', function() {
                const pengirimanId = parseInt(this.dataset.id);
                const pengiriman = monitoringData.find(p => p.id === pengirimanId);
                if (pengiriman) {
                    showDetailSidebar(pengiriman);
                }
            });
        });
        
        // Track buttons
        document.querySelectorAll('.btn-action.btn-track').forEach(btn => {
            btn.addEventListener('click', function() {
                const pengirimanId = parseInt(this.dataset.id);
                const pengiriman = monitoringData.find(p => p.id === pengirimanId);
                if (pengiriman) {
                    showTrackingModal(pengiriman);
                }
            });
        });
        
        // Control buttons
        document.querySelectorAll('.btn-action.btn-control').forEach(btn => {
            btn.addEventListener('click', function() {
                const pengirimanId = parseInt(this.dataset.id);
                const pengiriman = monitoringData.find(p => p.id === pengirimanId);
                if (pengiriman) {
                    showControlModal(pengiriman);
                }
            });
        });
        
        // Report buttons
        document.querySelectorAll('.btn-action.btn-report').forEach(btn => {
            btn.addEventListener('click', function() {
                const pengirimanId = parseInt(this.dataset.id);
                const pengiriman = monitoringData.find(p => p.id === pengirimanId);
                if (pengiriman) {
                    showReportModal(pengiriman);
                }
            });
        });
        
        // Map markers click events
        document.querySelectorAll('.map-marker').forEach(marker => {
            marker.addEventListener('click', function() {
                const pengirimanId = parseInt(this.dataset.id);
                const pengiriman = monitoringData.find(p => p.id === pengirimanId);
                if (pengiriman) {
                    showDetailSidebar(pengiriman);
                }
            });
        });
    }
    
    // Show detail sidebar
    function showDetailSidebar(pengiriman) {
        selectedPengirimanId = pengiriman.id;
        
        // Format tanggal
        const formatDateTime = (dateString, timeString) => {
            const date = new Date(dateString);
            const options = { day: 'numeric', month: 'long', year: 'numeric' };
            return `${date.toLocaleDateString('id-ID', options)} ${timeString}`;
        };
        
        // Buat muatan HTML
        const muatanHTML = pengiriman.muatan.map(item => `
            <div style="display: flex; justify-content: space-between; padding: 8px 0; border-bottom: 1px solid var(--border);">
                <span>${item.nama}</span>
                <span style="font-weight: 600;">${item.jumlah} ${item.satuan}</span>
            </div>
        `).join('');
        
        // Buat tracking history HTML
        const trackingHTML = pengiriman.log_tracking.map(track => {
            const date = new Date(track.timestamp_log);
            const time = date.toLocaleTimeString('id-ID', {
                hour: '2-digit',
                minute: '2-digit'
            });
            
            return `
                <div style="display: flex; align-items: flex-start; padding: 10px 0; border-bottom: 1px solid var(--border);">
                    <div style="width: 60px; color: var(--text-light); font-size: 12px;">${time}</div>
                    <div style="flex: 1;">
                        <div style="font-weight: 600; font-size: 14px; color: var(--text-dark);">${getStatusLabel(track.status)}</div>
                        <div style="font-size: 12px; color: var(--text-light);">${track.location_description}</div>
                        ${track.note ? `<div style="font-size: 11px; color: var(--text-light); margin-top: 3px;">${track.note}</div>` : ''}
                    </div>
                </div>
            `;
        }).join('');
        
        detailSidebarBody.innerHTML = `
            <div class="detail-header">
                <div style="font-size: 18px; font-weight: 700; color: var(--primary); margin-bottom: 5px;">
                    ${pengiriman.kode_pengiriman}
                </div>
                <div style="font-size: 14px; color: var(--text-light);">
                    ${formatDateTime(pengiriman.tanggal_kirim, pengiriman.waktu_kirim)}
                </div>
            </div>
            
            <div style="margin-top: 20px;">
                <div style="font-size: 14px; font-weight: 600; color: var(--text-dark); margin-bottom: 10px;">
                    Status Pengiriman
                </div>
                <div style="display: flex; align-items: center; gap: 15px; margin-bottom: 20px;">
                    <span class="status-badge badge-${pengiriman.status}" style="font-size: 14px;">
                        ${getStatusLabel(pengiriman.status)}
                    </span>
                    ${pengiriman.estimasi_tiba ? `
                        <div style="font-size: 12px; color: var(--text-light);">
                            <i class="fas fa-clock"></i> Estimasi: ${formatTime(pengiriman.estimasi_tiba)}
                        </div>
                    ` : ''}
                </div>
            </div>
            
            <div style="margin-top: 20px;">
                <div style="font-size: 14px; font-weight: 600; color: var(--text-dark); margin-bottom: 10px;">
                    Detail Supir & Kendaraan
                </div>
                <div style="background: var(--light); padding: 15px; border-radius: 8px;">
                    <div style="display: flex; justify-content: space-between; margin-bottom: 10px;">
                        <div>
                            <div style="font-weight: 600;">${pengiriman.supir_nama}</div>
                            <div style="font-size: 12px; color: var(--text-light);">${pengiriman.supir_kode}</div>
                        </div>
                        <div style="text-align: right;">
                            <div style="font-weight: 600;">${pengiriman.kendaraan_jenis}</div>
                            <div style="font-size: 12px; color: var(--text-light);">${pengiriman.kendaraan_plat}</div>
                        </div>
                    </div>
                    <div style="font-size: 12px; color: var(--text-light);">
                        Jarak tempuh: ${pengiriman.jarak_tempuh} km
                    </div>
                </div>
            </div>
            
            <div style="margin-top: 20px;">
                <div style="font-size: 14px; font-weight: 600; color: var(--text-dark); margin-bottom: 10px;">
                    Tujuan Pengiriman
                </div>
                <div style="background: var(--light); padding: 15px; border-radius: 8px;">
                    <div style="font-weight: 600; margin-bottom: 5px;">${pengiriman.tujuan_akhir}</div>
                    <div style="font-size: 13px; color: var(--text-light);">${pengiriman.alamat_tujuan}</div>
                    <div style="font-size: 12px; color: var(--text-light); margin-top: 5px;">
                        <i class="fas fa-route"></i> ${pengiriman.rute}
                    </div>
                </div>
            </div>
            
            <div style="margin-top: 20px;">
                <div style="font-size: 14px; font-weight: 600; color: var(--text-dark); margin-bottom: 10px;">
                    Detail Muatan
                </div>
                <div style="background: var(--light); padding: 15px; border-radius: 8px;">
                    ${muatanHTML}
                </div>
            </div>
            
            <div style="margin-top: 20px;">
                <div style="font-size: 14px; font-weight: 600; color: var(--text-dark); margin-bottom: 10px;">
                    Riwayat Tracking
                </div>
                <div style="max-height: 300px; overflow-y: auto; background: var(--light); padding: 15px; border-radius: 8px;">
                    ${trackingHTML}
                </div>
            </div>
            
            <div style="margin-top: 20px; display: flex; gap: 10px;">
                <button type="button" class="btn btn-primary" onclick="showTrackingModalById(${pengiriman.id})" style="flex: 1;">
                    <i class="fas fa-map-marked-alt"></i> Live Tracking
                </button>
            </div>
        `;
        
        detailSidebar.classList.add('open');
    }
    
    // Show tracking modal
    function showTrackingModal(pengiriman) {
        selectedPengirimanId = pengiriman.id;
        
        // Update tracking info
        document.getElementById('trackingPengirimanKode').textContent = pengiriman.kode_pengiriman;
        document.getElementById('trackingJarak').textContent = `${pengiriman.jarak_tempuh} km`;
        document.getElementById('trackingEstimasi').textContent = formatTime(pengiriman.estimasi_tiba);
        
        // Hitung kecepatan rata-rata
        const kecepatan = pengiriman.jarak_tempuh > 0 ? Math.round(pengiriman.jarak_tempuh / 2) : 0;
        document.getElementById('trackingKecepatan').textContent = `${kecepatan} km/jam`;
        
        // Update tracking history
        const trackingHistoryList = document.getElementById('trackingHistoryList');
        const trackingHTML = pengiriman.log_tracking.map(track => {
            const date = new Date(track.timestamp_log);
            const time = date.toLocaleTimeString('id-ID', {
                hour: '2-digit',
                minute: '2-digit'
            });
            
            return `
                <div class="tracking-history-item">
                    <div class="tracking-history-time">${time}</div>
                    <div class="tracking-history-content">
                        <div class="tracking-history-title">${getStatusLabel(track.status)}</div>
                        <div class="tracking-history-location">${track.location_description}</div>
                    </div>
                </div>
            `;
        }).join('');
        
        trackingHistoryList.innerHTML = trackingHTML;
        
        trackingModal.style.display = 'flex';
        document.body.style.overflow = 'hidden';
    }
    
    // Show control modal
    function showControlModal(pengiriman) {
        selectedPengirimanId = pengiriman.id;
        
        // Update vehicle info
        document.getElementById('controlVehicleInfo').innerHTML = `
            <div style="display: flex; justify-content: space-between; align-items: center;">
                <div>
                    <div style="font-weight: 600;">${pengiriman.kode_pengiriman}</div>
                    <div style="font-size: 12px; color: var(--text-light);">
                        ${pengiriman.supir_nama} • ${pengiriman.kendaraan_jenis} (${pengiriman.kendaraan_plat})
                    </div>
                </div>
                <span class="status-badge badge-${pengiriman.status}">
                    ${getStatusLabel(pengiriman.status)}
                </span>
            </div>
        `;
        
        controlModal.style.display = 'flex';
        document.body.style.overflow = 'hidden';
    }
    
    // Show report modal
    function showReportModal(pengiriman) {
        selectedPengirimanId = pengiriman.id;
        
        reportModal.style.display = 'flex';
        document.body.style.overflow = 'hidden';
        
        // Initialize chart
        initializeDeliveryChart();
    }
    
    // Close detail sidebar
    closeDetailBtn.addEventListener('click', function() {
        detailSidebar.classList.remove('open');
    });
    
    // Close modal when clicking outside
    [trackingModal, controlModal, reportModal].forEach(modal => {
        modal.addEventListener('click', function(e) {
            if (e.target === modal) {
                modal.style.display = 'none';
                document.body.style.overflow = 'auto';
            }
        });
    });
    
    // Close modal buttons
    document.querySelectorAll('.close-tracking-modal, .close-control-modal, .close-report-modal').forEach(btn => {
        btn.addEventListener('click', function() {
            const modal = this.closest('.modal');
            modal.style.display = 'none';
            document.body.style.overflow = 'auto';
        });
    });
    
    // Control action buttons
    document.querySelectorAll('.btn-control-action').forEach(btn => {
        btn.addEventListener('click', function() {
            const action = this.dataset.action;
            handleControlAction(action);
        });
    });
    
    // Send control button
    document.getElementById('sendControlBtn').addEventListener('click', function() {
        const message = document.getElementById('messageToDriver').value;
        const emergencyStatus = document.getElementById('emergencyStatus').value;
        
        if (message || emergencyStatus) {
            showNotification('Perintah kontrol berhasil dikirim ke supir', 'success');
            controlModal.style.display = 'none';
            document.body.style.overflow = 'auto';
        } else {
            showNotification('Silakan isi pesan atau pilih status darurat', 'warning');
        }
    });
    
    // Generate report button
    document.getElementById('generateReportBtn').addEventListener('click', function() {
        showNotification('Laporan sedang diproses...', 'info');
        setTimeout(() => {
            showNotification('Laporan berhasil digenerate', 'success');
        }, 1500);
    });
    
    // Export report button
    document.getElementById('exportReportBtn').addEventListener('click', function() {
        showNotification('Exporting PDF report...', 'info');
        setTimeout(() => {
            showNotification('Laporan berhasil diexport ke PDF', 'success');
        }, 1500);
    });
    
    // Refresh tracking button
    document.getElementById('refreshTrackingBtn').addEventListener('click', function() {
        const btn = this;
        const originalHtml = btn.innerHTML;
        
        btn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Loading...';
        btn.disabled = true;
        
        setTimeout(() => {
            showNotification('Data tracking diperbarui', 'success');
            btn.innerHTML = originalHtml;
            btn.disabled = false;
        }, 1000);
    });
    
    // Helper functions
    function formatDate(dateString) {
        const date = new Date(dateString);
        return date.toLocaleDateString('id-ID', {
            day: 'numeric',
            month: 'short',
            year: 'numeric'
        });
    }
    
    function formatTime(dateTimeString) {
        if (!dateTimeString) return '-';
        const date = new Date(dateTimeString);
        return date.toLocaleTimeString('id-ID', {
            hour: '2-digit',
            minute: '2-digit'
        });
    }
    
    function getStatusLabel(status) {
        const labels = {
            'dipanen': 'Dipanen',
            'dikemas': 'Dikemas',
            'dikirim': 'Dikirim',
            'diterima': 'Diterima'
        };
        return labels[status] || status;
    }
    
    function getLastUpdateTime(pengiriman) {
        if (!pengiriman.log_tracking || pengiriman.log_tracking.length === 0) {
            return '-';
        }
        
        const lastLog = pengiriman.log_tracking[pengiriman.log_tracking.length - 1];
        const date = new Date(lastLog.timestamp_log);
        const now = new Date();
        const diffMinutes = Math.floor((now - date) / (1000 * 60));
        
        if (diffMinutes < 1) {
            return 'Baru saja';
        } else if (diffMinutes < 60) {
            return `${diffMinutes} menit lalu`;
        } else {
            return `${Math.floor(diffMinutes / 60)} jam lalu`;
        }
    }
    
    function handleControlAction(action) {
        const actions = {
            'pause': 'Armada dijeda sementara',
            'reroute': 'Permintaan ubah rute dikirim',
            'emergency': 'Status darurat diaktifkan'
        };
        
        if (actions[action]) {
            showNotification(actions[action], 'info');
        }
    }
    
    function initializeDeliveryChart() {
        // In real implementation, this would use Chart.js
        console.log('Chart initialized');
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
    
    // Global functions for sidebar buttons
    window.showTrackingModalById = function(id) {
        const pengiriman = monitoringData.find(p => p.id === id);
        if (pengiriman) {
            detailSidebar.classList.remove('open');
            setTimeout(() => {
                showTrackingModal(pengiriman);
            }, 300);
        }
    };
    
    window.showControlModalById = function(id) {
        const pengiriman = monitoringData.find(p => p.id === id);
        if (pengiriman) {
            detailSidebar.classList.remove('open');
            setTimeout(() => {
                showControlModal(pengiriman);
            }, 300);
        }
    };
});
</script>
@endsection