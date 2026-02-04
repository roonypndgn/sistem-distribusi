{{-- resources/views/pusat/analitik-tren-harga.blade.php --}}
@extends('layouts.pusat')

@section('title', 'Analitik Tren Harga - PT. Mardua Holong')

@section('page-title', 'Analitik Tren Harga')
@section('page-subtitle', 'Analisis statistik harga pembelian jeruk dari berbagai ladang')

@section('content')
<div class="content-wrapper">
    <!-- Header -->
    <div class="content-header">
        <div class="header-left">
        </div>
        <div class="header-right">
            <button type="button" id="exportAnalyticsBtn" class="btn btn-success">
                <i class="fas fa-file-excel"></i> Export Data
            </button>
            <button type="button" id="printReportBtn" class="btn btn-primary">
                <i class="fas fa-print"></i> Cetak Laporan
            </button>
        </div>
    </div>
    
    <!-- Statistik Utama -->
    <div class="stats-grid" style="margin-bottom: 30px;">
        <div class="stat-card">
            <div class="stat-icon">
                <i class="fas fa-chart-line"></i>
            </div>
            <div class="stat-content">
                <div class="stat-value" id="avgPrice">Rp 0</div>
                <div class="stat-label">Rata-rata Harga</div>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon">
                <i class="fas fa-arrow-up"></i>
            </div>
            <div class="stat-content">
                <div class="stat-value" id="maxPrice">Rp 0</div>
                <div class="stat-label">Harga Tertinggi</div>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon">
                <i class="fas fa-arrow-down"></i>
            </div>
            <div class="stat-content">
                <div class="stat-value" id="minPrice">Rp 0</div>
                <div class="stat-label">Harga Terendah</div>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon">
                <i class="fas fa-percentage"></i>
            </div>
            <div class="stat-content">
                <div class="stat-value" id="priceVariance">0%</div>
                <div class="stat-label">Variansi Harga</div>
            </div>
        </div>
    </div>
    
    <!-- Filter -->
    <div class="content-card" style="margin-bottom: 30px;">
        <div class="card-header">
            <div class="card-title">
                <i class="fas fa-filter"></i>
                <span>Filter Analitik</span>
            </div>
        </div>
        
        <div class="filter-options">
            <div class="filter-group">
                <label class="filter-label">Rentang Waktu</label>
                <select id="filterPeriod" class="form-control">
                    <option value="7-days">7 Hari Terakhir</option>
                    <option value="30-days" selected>30 Hari Terakhir</option>
                    <option value="3-months">3 Bulan Terakhir</option>
                    <option value="6-months">6 Bulan Terakhir</option>
                    <option value="year">1 Tahun Terakhir</option>
                    <option value="custom">Custom</option>
                </select>
            </div>
            
            <div class="filter-group" id="customDateGroup" style="display: none;">
                <label class="filter-label">Tanggal Custom</label>
                <div class="input-group">
                    <input type="date" id="filterDateFrom" class="form-control" placeholder="Dari Tanggal">
                    <span style="padding: 0 10px; display: flex; align-items: center;">s/d</span>
                    <input type="date" id="filterDateTo" class="form-control" placeholder="Sampai Tanggal">
                </div>
            </div>
            
            <div class="filter-group">
                <label class="filter-label">Jenis Analisis</label>
                <select id="filterAnalysisType" class="form-control">
                    <option value="daily">Harian</option>
                    <option value="weekly">Mingguan</option>
                    <option value="monthly">Bulanan</option>
                    <option value="quarterly">Triwulan</option>
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
                <button type="button" id="applyAnalyticsFilterBtn" class="btn btn-primary">
                    <i class="fas fa-chart-bar"></i> Analisis
                </button>
                <button type="button" id="resetAnalyticsFilterBtn" class="btn btn-secondary">
                    <i class="fas fa-redo"></i> Reset
                </button>
            </div>
        </div>
    </div>
    
    <!-- Chart Container -->
    <div class="content-card" style="margin-bottom: 30px;">
        <div class="card-header">
            <div class="card-title">
                <i class="fas fa-chart-line"></i>
                <span>Tren Harga Jeruk</span>
            </div>
            <div class="card-actions">
                <button type="button" id="toggleChartType" class="btn btn-sm btn-outline-secondary">
                    <i class="fas fa-exchange-alt"></i> Ubah Grafik
                </button>
            </div>
        </div>
        
        <div class="chart-container">
            <canvas id="priceTrendChart" height="300"></canvas>
        </div>
    </div>
    
    <!-- Komparasi Harga Ladang -->
    <div class="content-card" style="margin-bottom: 30px;">
        <div class="card-header">
            <div class="card-title">
                <i class="fas fa-balance-scale"></i>
                <span>Komparasi Harga per Ladang</span>
            </div>
        </div>
        
        <div class="comparison-grid">
            <div class="comparison-chart">
                <canvas id="ladangComparisonChart" height="250"></canvas>
            </div>
            <div class="comparison-stats">
                <h4>Statistik Ladang</h4>
                <div id="ladangStatsContainer">
                    <!-- Stats will be populated by JavaScript -->
                </div>
            </div>
        </div>
    </div>
    
    <!-- Distribusi Harga -->
    <div class="content-card" style="margin-bottom: 30px;">
        <div class="card-header">
            <div class="card-title">
                <i class="fas fa-chart-pie"></i>
                <span>Distribusi Harga</span>
            </div>
        </div>
        
        <div class="distribution-container">
            <div class="distribution-chart">
                <canvas id="priceDistributionChart" height="250"></canvas>
            </div>
            <div class="distribution-table">
                <h4>Distribusi Frekuensi Harga</h4>
                <div class="table-responsive">
                    <table class="data-table">
                        <thead>
                            <tr>
                                <th>Rentang Harga</th>
                                <th>Jumlah Transaksi</th>
                                <th>Persentase</th>
                                <th>Total Berat (Kg)</th>
                            </tr>
                        </thead>
                        <tbody id="distributionTableBody">
                            <!-- Data akan diisi oleh JavaScript -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Tabel Detail Transaksi -->
    <div class="content-card">
        <div class="card-header">
            <div class="card-title">
                <i class="fas fa-table"></i>
                <span>Data Transaksi</span>
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
                        <th>Manajer</th>
                        <th>Status</th>
                        <th>Tren</th>
                    </tr>
                </thead>
                <tbody id="transactionsTableBody">
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

<!-- Modal Detail Analitik -->
<div id="analyticsDetailModal" class="modal">
    <div class="modal-content modal-lg">
        <div class="modal-header">
            <h3 class="modal-title">Detail Analisis Harga</h3>
            <button type="button" class="close-analytics-modal">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <div class="modal-body" id="analyticsDetailBody">
            <!-- Detail akan diisi oleh JavaScript -->
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary close-analytics-modal">
                Tutup
            </button>
            <button type="button" class="btn btn-primary" id="exportDetailBtn">
                <i class="fas fa-download"></i> Export Detail
            </button>
        </div>
    </div>
</div>

<style>
    /* Variables tetap sama */
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
    
    /* Content Header Styles */
    .content-header {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        margin-bottom: 30px;
        flex-wrap: wrap;
        gap: 15px;
    }
    
    .header-left h1 {
        font-size: 24px;
        font-weight: 700;
        color: var(--text-dark);
        margin: 0 0 5px 0;
    }
    
    .header-left p {
        color: var(--text-light);
        font-size: 14px;
        margin: 0;
    }
    
    .header-right {
        display: flex;
        gap: 10px;
        align-items: center;
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
        text-decoration: none;
        white-space: nowrap;
    }
    
    .btn-primary {
        background-color: var(--primary);
        color: white;
    }
    
    .btn-primary:hover {
        background-color: var(--primary-dark);
        transform: translateY(-2px);
    }
    
    .btn-secondary {
        background-color: var(--secondary);
        color: white;
    }
    
    .btn-secondary:hover {
        background-color: #5a6268;
        transform: translateY(-2px);
    }
    
    .btn-success {
        background-color: var(--success);
        color: white;
    }
    
    .btn-success:hover {
        background-color: #218838;
        transform: translateY(-2px);
    }
    
    .btn-sm {
        padding: 6px 12px;
        font-size: 13px;
    }
    
    .btn-outline-secondary {
        background-color: transparent;
        border: 1px solid var(--secondary);
        color: var(--secondary);
    }
    
    .btn-outline-secondary:hover {
        background-color: var(--secondary);
        color: white;
        transform: translateY(-2px);
    }
    
    /* Stats Grid */
    .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
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
        gap: 20px;
        transition: var(--transition);
        cursor: pointer;
    }
    
    .stat-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        border-color: var(--primary-light);
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
        flex-shrink: 0;
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
        min-width: 0;
    }
    
    .stat-value {
        font-size: 22px;
        font-weight: 700;
        color: var(--text-dark);
        margin-bottom: 5px;
        line-height: 1.2;
        word-break: break-word;
    }
    
    .stat-label {
        font-size: 13px;
        color: var(--text-light);
        line-height: 1.4;
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
    
    .card-actions {
        display: flex;
        gap: 10px;
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
        padding: 10px 12px;
        border: 1px solid var(--border);
        border-radius: 8px;
        font-size: 14px;
        color: var(--text-dark);
        background-color: white;
        transition: var(--transition);
        box-sizing: border-box;
    }
    
    .form-control:focus {
        outline: none;
        border-color: var(--primary);
        box-shadow: 0 0 0 3px rgba(45, 106, 79, 0.1);
    }
    
    /* Input Group */
    .input-group {
        display: flex;
        align-items: center;
        gap: 10px;
    }
    
    /* Chart Container */
    .chart-container {
        position: relative;
        height: 300px;
        padding: 10px;
        box-sizing: border-box;
    }
    
    /* Comparison Grid */
    .comparison-grid {
        display: grid;
        grid-template-columns: 2fr 1fr;
        gap: 30px;
        margin-top: 20px;
    }
    
    .comparison-stats {
        padding: 20px;
        background: var(--light);
        border-radius: 8px;
        border: 1px solid var(--border);
    }
    
    .comparison-stats h4 {
        margin: 0 0 20px 0;
        color: var(--text-dark);
        font-size: 16px;
        font-weight: 600;
    }
    
    .ladang-stat-item {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 10px 0;
        border-bottom: 1px solid var(--border);
    }
    
    .ladang-stat-item:last-child {
        border-bottom: none;
    }
    
    .ladang-stat-label {
        display: flex;
        align-items: center;
        gap: 10px;
        font-size: 14px;
    }
    
    .ladang-color-dot {
        width: 12px;
        height: 12px;
        border-radius: 50%;
        display: inline-block;
        flex-shrink: 0;
    }
    
    .ladang-stat-value {
        font-weight: 600;
        font-size: 14px;
        color: var(--text-dark);
        text-align: right;
    }
    
    /* Distribution Container */
    .distribution-container {
        display: grid;
        grid-template-columns: 1fr 2fr;
        gap: 30px;
        margin-top: 20px;
    }
    
    .distribution-chart {
        padding: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    
    .distribution-table {
        min-width: 0;
    }
    
    .distribution-table h4 {
        margin: 0 0 20px 0;
        color: var(--text-dark);
        font-size: 16px;
        font-weight: 600;
    }
    
    /* Table Styles */
    .table-responsive {
        width: 100%;
        overflow-x: auto;
        -webkit-overflow-scrolling: touch;
    }
    
    .data-table {
        width: 100%;
        border-collapse: collapse;
        min-width: 800px;
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
        white-space: nowrap;
    }
    
    .data-table td {
        padding: 12px;
        font-size: 14px;
        border-bottom: 1px solid var(--border);
        vertical-align: middle;
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
    
    .badge-Verifikasi {
        background-color: #E8F5E9;
        color: #2E7D32;
        border: 1px solid #C8E6C9;
    }
    
    .badge-Pending {
        background-color: #FFF3E0;
        color: #EF6C00;
        border: 1px solid #FFE0B2;
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
        white-space: nowrap;
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
        white-space: nowrap;
    }
    
    /* Price Trend Indicator */
    .price-trend-indicator {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        padding: 4px 8px;
        border-radius: 4px;
        font-size: 12px;
        font-weight: 600;
        white-space: nowrap;
    }
    
    .trend-up {
        background-color: #E8F5E9;
        color: #2E7D32;
    }
    
    .trend-down {
        background-color: #FFEBEE;
        color: #C62828;
    }
    
    .trend-stable {
        background-color: #FFF3E0;
        color: #EF6C00;
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
        flex-shrink: 0;
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
        flex-wrap: wrap;
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
        padding: 0 5px;
        flex-shrink: 0;
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
        box-sizing: border-box;
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
    
    .close-analytics-modal {
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
    
    .close-analytics-modal:hover {
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
        flex-wrap: wrap;
    }
    
    /* Responsive Styles */
    @media (max-width: 1200px) {
        .comparison-grid,
        .distribution-container {
            grid-template-columns: 1fr;
        }
    }
    
    @media (max-width: 992px) {
        .chart-container {
            height: 250px;
        }
    }
    
    @media (max-width: 768px) {
        .content-header {
            flex-direction: column;
            align-items: stretch;
        }
        
        .header-right {
            width: 100%;
            justify-content: flex-start;
            flex-wrap: wrap;
        }
        
        .stats-grid {
            grid-template-columns: repeat(2, 1fr);
        }
        
        .filter-options {
            grid-template-columns: 1fr;
        }
        
        .card-header {
            flex-direction: column;
            align-items: flex-start;
        }
        
        .card-actions {
            align-self: flex-end;
        }
        
        .chart-container {
            height: 200px;
        }
        
        .modal-footer {
            flex-direction: column;
        }
        
        .btn {
            width: 100%;
            justify-content: center;
        }
    }
    
    @media (max-width: 576px) {
        .stats-grid {
            grid-template-columns: 1fr;
        }
        
        .header-right {
            flex-direction: column;
        }
        
        .btn {
            width: 100%;
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
        
        .modal-header,
        .modal-body,
        .modal-footer {
            padding: 15px;
        }
    }
    
    @media (max-width: 480px) {
        .content-card {
            padding: 15px;
        }
        
        .chart-container {
            height: 180px;
            padding: 5px;
        }
        
        .stat-card {
            padding: 15px;
            gap: 15px;
        }
        
        .stat-icon {
            width: 50px;
            height: 50px;
            font-size: 20px;
        }
        
        .stat-value {
            font-size: 18px;
        }
        
        .btn {
            padding: 8px 16px;
            font-size: 13px;
        }
    }
</style>

<!-- Include Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Data dummy untuk analitik
    let analyticsData = [
        { id: 1, date: '2024-03-01', ladang: 'Pandiangan', harga: 12000, jumlah_kg: 500, total: 6000000, manajer: 'Ronny', status: 'Verifikasi' },
        { id: 2, date: '2024-03-02', ladang: 'Siregar', harga: 11500, jumlah_kg: 300, total: 3450000, manajer: 'Risto', status: 'Verifikasi' },
        { id: 3, date: '2024-03-03', ladang: 'Silalahi', harga: 12500, jumlah_kg: 450, total: 5625000, manajer: 'Rieno', status: 'Verifikasi' },
        { id: 4, date: '2024-03-04', ladang: 'Pandiangan', harga: 12200, jumlah_kg: 550, total: 6710000, manajer: 'Ronny', status: 'Verifikasi' },
        { id: 5, date: '2024-03-05', ladang: 'Siregar', harga: 11700, jumlah_kg: 320, total: 3744000, manajer: 'Risto', status: 'Verifikasi' },
        { id: 6, date: '2024-03-06', ladang: 'Silalahi', harga: 12400, jumlah_kg: 480, total: 5952000, manajer: 'Rieno', status: 'Verifikasi' },
        { id: 7, date: '2024-03-07', ladang: 'Pandiangan', harga: 12300, jumlah_kg: 520, total: 6396000, manajer: 'Ronny', status: 'Verifikasi' },
        { id: 8, date: '2024-03-08', ladang: 'Siregar', harga: 11600, jumlah_kg: 310, total: 3596000, manajer: 'Risto', status: 'Verifikasi' },
        { id: 9, date: '2024-03-09', ladang: 'Silalahi', harga: 12600, jumlah_kg: 460, total: 5796000, manajer: 'Rieno', status: 'Verifikasi' },
        { id: 10, date: '2024-03-10', ladang: 'Pandiangan', harga: 12400, jumlah_kg: 530, total: 6572000, manajer: 'Ronny', status: 'Verifikasi' },
        { id: 11, date: '2024-03-11', ladang: 'Siregar', harga: 11800, jumlah_kg: 330, total: 3894000, manajer: 'Trhesya', status: 'Verifikasi' },
        { id: 12, date: '2024-03-12', ladang: 'Silalahi', harga: 12700, jumlah_kg: 470, total: 5969000, manajer: 'Rieno', status: 'Verifikasi' },
        { id: 13, date: '2024-03-13', ladang: 'Pandiangan', harga: 12500, jumlah_kg: 510, total: 6375000, manajer: 'Ronny', status: 'Verifikasi' },
        { id: 14, date: '2024-03-14', ladang: 'Siregar', harga: 11900, jumlah_kg: 340, total: 4046000, manajer: 'Trhesya', status: 'Verifikasi' },
        { id: 15, date: '2024-03-15', ladang: 'Silalahi', harga: 12800, jumlah_kg: 490, total: 6272000, manajer: 'Rieno', status: 'Verifikasi' }
    ];

    // Tambah data untuk memperkaya dataset
    for (let i = 16; i <= 45; i++) {
        const ladangList = ['Pandiangan', 'Siregar', 'Silalahi'];
        const manajerList = ['Ronny', 'Risto', 'Rieno', 'Trhesya', 'Maharani'];
        const randomLadang = ladangList[Math.floor(Math.random() * ladangList.length)];
        const randomManager = manajerList[Math.floor(Math.random() * manajerList.length)];
        const randomPrice = Math.floor(Math.random() * 2000) + 11500; // Harga antara 11500-13500
        const randomKg = Math.floor(Math.random() * 200) + 300; // Berat antara 300-500 kg
        
        analyticsData.push({
            id: i,
            date: `2024-03-${i.toString().padStart(2, '0')}`,
            ladang: randomLadang,
            harga: randomPrice,
            jumlah_kg: randomKg,
            total: randomPrice * randomKg,
            manajer: randomManager,
            status: 'Verifikasi'
        });
    }

    // Variabel global
    let currentPage = 1;
    const itemsPerPage = 10;
    let filteredData = [...analyticsData];
    let priceTrendChart = null;
    let ladangComparisonChart = null;
    let priceDistributionChart = null;
    let currentChartType = 'line';

    // Chart.js colors
    const chartColors = {
        pandiangan: 'rgba(76, 175, 80, 0.8)',
        siregar: 'rgba(33, 150, 243, 0.8)',
        silalahi: 'rgba(156, 39, 176, 0.8)',
        gridLines: 'rgba(0, 0, 0, 0.1)',
        tooltipBg: 'rgba(0, 0, 0, 0.7)'
    };

    // Fungsi format angka
    function formatRupiah(angka) {
        return 'Rp ' + angka.toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.');
    }

    // Fungsi format tanggal
    function formatDate(dateString) {
        try {
            const date = new Date(dateString);
            const options = { day: '2-digit', month: 'short' };
            return date.toLocaleDateString('id-ID', options);
        } catch (e) {
            return dateString;
        }
    }

    // Fungsi untuk menghitung statistik
    function calculateStatistics(data) {
        if (data.length === 0) {
            document.getElementById('avgPrice').textContent = 'Rp 0';
            document.getElementById('maxPrice').textContent = 'Rp 0';
            document.getElementById('minPrice').textContent = 'Rp 0';
            document.getElementById('priceVariance').textContent = '0%';
            return { avgPrice: 0, maxPrice: 0, minPrice: 0, variance: 0 };
        }

        const prices = data.map(item => item.harga);
        const total = prices.reduce((sum, price) => sum + price, 0);
        const avgPrice = total / prices.length;
        const maxPrice = Math.max(...prices);
        const minPrice = Math.min(...prices);
        const priceRange = maxPrice - minPrice;
        const variance = priceRange / avgPrice * 100;

        // Update statistik utama
        document.getElementById('avgPrice').textContent = formatRupiah(Math.round(avgPrice));
        document.getElementById('maxPrice').textContent = formatRupiah(maxPrice);
        document.getElementById('minPrice').textContent = formatRupiah(minPrice);
        document.getElementById('priceVariance').textContent = variance.toFixed(1) + '%';

        return { avgPrice, maxPrice, minPrice, variance };
    }

    // Fungsi untuk membuat chart tren harga
    function createPriceTrendChart(data) {
        const ctx = document.getElementById('priceTrendChart');
        if (!ctx) return;
        
        // Hancurkan chart sebelumnya jika ada
        if (priceTrendChart) {
            priceTrendChart.destroy();
        }

        // Kelompokkan data berdasarkan ladang
        const ladangGroups = {};
        data.forEach(item => {
            if (!ladangGroups[item.ladang]) {
                ladangGroups[item.ladang] = [];
            }
            ladangGroups[item.ladang].push(item);
        });

        // Ambil semua tanggal unik dan urutkan
        const allDates = [...new Set(data.map(item => item.date))].sort();
        
        // Batasi jumlah label untuk performa
        const maxLabels = 15;
        let labels;
        if (allDates.length > maxLabels) {
            // Ambil beberapa titik data secara merata
            const step = Math.ceil(allDates.length / maxLabels);
            labels = [];
            for (let i = 0; i < allDates.length; i += step) {
                labels.push(allDates[i]);
            }
        } else {
            labels = allDates;
        }

        const datasets = [];

        // Warna untuk setiap ladang
        const ladangColors = {
            'Pandiangan': chartColors.pandiangan,
            'Siregar': chartColors.siregar,
            'Silalahi': chartColors.silalahi
        };

        Object.keys(ladangGroups).forEach(ladang => {
            const ladangData = ladangGroups[ladang];
            const pricesByDate = {};
            
            // Kelompokkan harga berdasarkan tanggal
            ladangData.forEach(item => {
                pricesByDate[item.date] = item.harga;
            });

            // Buat array harga sesuai urutan labels
            const prices = labels.map(date => {
                const price = pricesByDate[date];
                return price !== undefined ? price : null;
            });

            datasets.push({
                label: ladang,
                data: prices,
                borderColor: ladangColors[ladang],
                backgroundColor: ladangColors[ladang].replace('0.8', '0.1'),
                borderWidth: 2,
                fill: false,
                tension: 0.4,
                pointRadius: 3,
                pointHoverRadius: 5
            });
        });

        priceTrendChart = new Chart(ctx, {
            type: currentChartType,
            data: {
                labels: labels.map(date => formatDate(date)),
                datasets: datasets
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'top',
                        labels: {
                            font: {
                                size: 12
                            },
                            padding: 10,
                            usePointStyle: true
                        }
                    },
                    tooltip: {
                        mode: 'index',
                        intersect: false,
                        backgroundColor: 'rgba(0, 0, 0, 0.8)',
                        titleFont: {
                            size: 12
                        },
                        bodyFont: {
                            size: 12
                        },
                        padding: 10,
                        callbacks: {
                            label: function(context) {
                                const value = context.raw;
                                return value !== null ? `${context.dataset.label}: ${formatRupiah(value)}/kg` : 'Tidak ada data';
                            }
                        }
                    }
                },
                scales: {
                    x: {
                        grid: {
                            display: true,
                            color: 'rgba(0, 0, 0, 0.05)'
                        },
                        ticks: {
                            font: {
                                size: 11
                            },
                            maxRotation: 45
                        }
                    },
                    y: {
                        beginAtZero: false,
                        grid: {
                            display: true,
                            color: 'rgba(0, 0, 0, 0.05)'
                        },
                        ticks: {
                            font: {
                                size: 11
                            },
                            callback: function(value) {
                                return formatRupiah(value);
                            }
                        }
                    }
                },
                interaction: {
                    intersect: false,
                    mode: 'nearest'
                }
            }
        });
    }

    // Fungsi untuk membuat chart komparasi ladang
    function createLadangComparisonChart(data) {
        const ctx = document.getElementById('ladangComparisonChart');
        if (!ctx) return;
        
        if (ladangComparisonChart) {
            ladangComparisonChart.destroy();
        }

        // Kelompokkan data berdasarkan ladang
        const ladangStats = {};
        data.forEach(item => {
            if (!ladangStats[item.ladang]) {
                ladangStats[item.ladang] = {
                    totalPrice: 0,
                    totalKg: 0,
                    count: 0,
                    prices: []
                };
            }
            
            ladangStats[item.ladang].totalPrice += item.harga;
            ladangStats[item.ladang].totalKg += item.jumlah_kg;
            ladangStats[item.ladang].count++;
            ladangStats[item.ladang].prices.push(item.harga);
        });

        // Hitung rata-rata per ladang
        const ladangLabels = Object.keys(ladangStats);
        const avgPrices = ladangLabels.map(ladang => 
            ladangStats[ladang].count > 0 ? 
            Math.round(ladangStats[ladang].totalPrice / ladangStats[ladang].count) : 0
        );

        // Warna untuk setiap ladang
        const backgroundColors = ladangLabels.map(ladang => {
            switch(ladang) {
                case 'Pandiangan': return chartColors.pandiangan;
                case 'Siregar': return chartColors.siregar;
                case 'Silalahi': return chartColors.silalahi;
                default: return '#CCCCCC';
            }
        });

        ladangComparisonChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ladangLabels,
                datasets: [
                    {
                        label: 'Rata-rata Harga',
                        data: avgPrices,
                        backgroundColor: backgroundColors,
                        borderColor: backgroundColors.map(color => color.replace('0.8', '1')),
                        borderWidth: 1,
                        borderRadius: 4
                    }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false
                    },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                const ladang = ladangLabels[context.dataIndex];
                                const stats = ladangStats[ladang];
                                const avgPrice = avgPrices[context.dataIndex];
                                return [
                                    `Rata-rata: ${formatRupiah(avgPrice)}/kg`,
                                    `Transaksi: ${stats.count}`,
                                    `Total Berat: ${stats.totalKg} Kg`
                                ];
                            }
                        }
                    }
                },
                scales: {
                    x: {
                        grid: {
                            display: false
                        }
                    },
                    y: {
                        beginAtZero: true,
                        grid: {
                            display: true,
                            color: 'rgba(0, 0, 0, 0.05)'
                        },
                        ticks: {
                            callback: function(value) {
                                return formatRupiah(value);
                            }
                        }
                    }
                }
            }
        });

        // Update statistik ladang
        updateLadangStats(ladangStats);
    }

    // Fungsi untuk membuat chart distribusi harga
    function createPriceDistributionChart(data) {
        const ctx = document.getElementById('priceDistributionChart');
        if (!ctx) return;
        
        if (priceDistributionChart) {
            priceDistributionChart.destroy();
        }

        if (data.length === 0) {
            // Buat chart kosong jika tidak ada data
            priceDistributionChart = new Chart(ctx, {
                type: 'pie',
                data: {
                    labels: ['Tidak ada data'],
                    datasets: [{
                        data: [1],
                        backgroundColor: ['#CCCCCC']
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: false
                        }
                    }
                }
            });
            updateDistributionTable([], 0);
            return;
        }

        // Tentukan rentang harga
        const prices = data.map(item => item.harga);
        const minPrice = Math.min(...prices);
        const maxPrice = Math.max(...prices);
        
        // Buat 5 interval harga
        const intervalCount = 5;
        const intervalSize = Math.ceil((maxPrice - minPrice) / intervalCount / 500) * 500;
        
        const intervals = [];
        for (let i = 0; i < intervalCount; i++) {
            const start = Math.floor(minPrice / 500) * 500 + (i * intervalSize);
            const end = start + intervalSize;
            intervals.push({
                start: start,
                end: end,
                count: 0,
                totalKg: 0
            });
        }

        // Hitung distribusi
        data.forEach(item => {
            for (let interval of intervals) {
                if (item.harga >= interval.start && item.harga < interval.end) {
                    interval.count++;
                    interval.totalKg += item.jumlah_kg;
                    break;
                }
            }
        });

        // Filter interval yang memiliki data
        const validIntervals = intervals.filter(interval => interval.count > 0);
        
        // Siapkan data untuk chart
        const labels = validIntervals.map(interval => 
            `${formatRupiah(interval.start)} - ${formatRupiah(interval.end)}`
        );
        const counts = validIntervals.map(interval => interval.count);

        // Warna untuk pie chart
        const pieColors = [
            'rgba(76, 175, 80, 0.8)',
            'rgba(33, 150, 243, 0.8)',
            'rgba(156, 39, 176, 0.8)',
            'rgba(255, 152, 0, 0.8)',
            'rgba(244, 67, 54, 0.8)',
            'rgba(0, 150, 136, 0.8)'
        ];

        priceDistributionChart = new Chart(ctx, {
            type: 'pie',
            data: {
                labels: labels,
                datasets: [{
                    data: counts,
                    backgroundColor: pieColors.slice(0, validIntervals.length),
                    borderWidth: 1,
                    borderColor: 'white'
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'right',
                        labels: {
                            font: {
                                size: 11
                            },
                            padding: 10,
                            usePointStyle: true,
                            pointStyle: 'circle'
                        }
                    },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                const interval = validIntervals[context.dataIndex];
                                const percentage = ((interval.count / data.length) * 100).toFixed(1);
                                return [
                                    `Transaksi: ${interval.count} (${percentage}%)`,
                                    `Total Berat: ${interval.totalKg} Kg`
                                ];
                            }
                        }
                    }
                },
                cutout: '50%'
            }
        });

        // Update tabel distribusi
        updateDistributionTable(validIntervals, data.length);
    }

    // Fungsi update statistik ladang
    function updateLadangStats(ladangStats) {
        const container = document.getElementById('ladangStatsContainer');
        if (!container) return;
        
        let html = '';

        Object.keys(ladangStats).forEach((ladang, index) => {
            const stats = ladangStats[ladang];
            const avgPrice = stats.count > 0 ? 
                Math.round(stats.totalPrice / stats.count) : 0;
            
            // Tentukan warna dot berdasarkan ladang
            let dotColor = '';
            switch(ladang) {
                case 'Pandiangan': dotColor = '#4CAF50'; break;
                case 'Siregar': dotColor = '#2196F3'; break;
                case 'Silalahi': dotColor = '#9C27B0'; break;
                default: dotColor = '#CCCCCC';
            }

            html += `
                <div class="ladang-stat-item">
                    <div class="ladang-stat-label">
                        <span class="ladang-color-dot" style="background-color: ${dotColor};"></span>
                        <span>${ladang}</span>
                    </div>
                    <div class="ladang-stat-value">
                        ${formatRupiah(avgPrice)}
                    </div>
                </div>
                <div style="padding: 5px 10px; font-size: 12px; color: var(--text-light); background: white; border-radius: 4px; margin-bottom: 10px;">
                    <i class="fas fa-exchange-alt"></i> ${stats.count} transaksi • 
                    <i class="fas fa-weight-hanging"></i> ${stats.totalKg.toLocaleString()} Kg
                </div>
            `;
        });

        if (Object.keys(ladangStats).length === 0) {
            html = '<div style="text-align: center; padding: 20px; color: var(--text-light);">Tidak ada data ladang</div>';
        }

        container.innerHTML = html;
    }

    // Fungsi update tabel distribusi
    function updateDistributionTable(intervals, totalTransactions) {
        const tbody = document.getElementById('distributionTableBody');
        if (!tbody) return;
        
        let html = '';

        if (intervals.length === 0) {
            html = `
                <tr>
                    <td colspan="4" style="text-align: center; padding: 20px; color: var(--text-light);">
                        <i class="fas fa-chart-pie"></i> Tidak ada data distribusi
                    </td>
                </tr>
            `;
        } else {
            intervals.forEach(interval => {
                const percentage = totalTransactions > 0 ? 
                    ((interval.count / totalTransactions) * 100).toFixed(1) : 0;

                html += `
                    <tr>
                        <td><strong>${formatRupiah(interval.start)} - ${formatRupiah(interval.end)}</strong></td>
                        <td>${interval.count}</td>
                        <td>
                            <div style="display: flex; align-items: center; gap: 8px;">
                                <span>${percentage}%</span>
                                <div style="flex: 1; height: 6px; background: var(--border); border-radius: 3px; overflow: hidden;">
                                    <div style="width: ${percentage}%; height: 100%; background: var(--primary);"></div>
                                </div>
                            </div>
                        </td>
                        <td>${interval.totalKg.toLocaleString()} Kg</td>
                    </tr>
                `;
            });
        }

        tbody.innerHTML = html;
    }

    // Fungsi render tabel transaksi
    function renderTransactionsTable() {
        const tbody = document.getElementById('transactionsTableBody');
        if (!tbody) return;
        
        const startIndex = (currentPage - 1) * itemsPerPage;
        const endIndex = startIndex + itemsPerPage;
        const currentData = filteredData.slice(startIndex, endIndex);

        tbody.innerHTML = '';

        if (currentData.length === 0) {
            tbody.innerHTML = `
                <tr>
                    <td colspan="9" style="text-align: center; padding: 40px;">
                        <div style="color: var(--text-light); font-size: 14px;">
                            <i class="fas fa-chart-bar" style="font-size: 48px; margin-bottom: 15px; color: var(--border);"></i>
                            <div>Tidak ada data transaksi ditemukan</div>
                        </div>
                    </td>
                </tr>
            `;
            return;
        }

        currentData.forEach((item, index) => {
            const rowNumber = startIndex + index + 1;
            
            // Tentukan tren sederhana (acak untuk demo)
            const trendOptions = ['up', 'down', 'stable'];
            const randomTrend = trendOptions[Math.floor(Math.random() * trendOptions.length)];
            
            let trendClass, trendIcon, trendText;
            switch(randomTrend) {
                case 'up':
                    trendClass = 'trend-up';
                    trendIcon = 'fas fa-arrow-up';
                    trendText = 'Naik';
                    break;
                case 'down':
                    trendClass = 'trend-down';
                    trendIcon = 'fas fa-arrow-down';
                    trendText = 'Turun';
                    break;
                default:
                    trendClass = 'trend-stable';
                    trendIcon = 'fas fa-equals';
                    trendText = 'Stabil';
            }

            // Tentukan class status badge
            let statusClass = '';
            switch(item.status) {
                case 'Verifikasi': statusClass = 'badge-Verifikasi'; break;
                case 'Pending': statusClass = 'badge-Pending'; break;
                case 'Reject': statusClass = 'badge-Reject'; break;
            }

            const row = document.createElement('tr');
            row.innerHTML = `
                <td>${rowNumber}</td>
                <td>
                    <div style="font-weight: 500;">${formatDate(item.date)}</div>
                    <div style="font-size: 12px; color: var(--text-light);">TRX-${item.id.toString().padStart(3, '0')}</div>
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
                        ${formatRupiah(item.harga)}/kg
                    </span>
                </td>
                <td>${item.jumlah_kg.toLocaleString()} Kg</td>
                <td>${formatRupiah(item.total)}</td>
                <td>${item.manajer}</td>
                <td>
                    <span class="status-badge ${statusClass}">${item.status}</span>
                </td>
                <td>
                    <span class="price-trend-indicator ${trendClass}">
                        <i class="${trendIcon}"></i>
                        ${trendText}
                    </span>
                </td>
            `;
            tbody.appendChild(row);
        });

        updatePagination();
        updateShowingCount();
    }

    // Fungsi update pagination
    function updatePagination() {
        const totalPages = Math.ceil(filteredData.length / itemsPerPage);
        document.getElementById('currentPage').textContent = currentPage;
        document.getElementById('totalPages').textContent = totalPages;

        const pageNumbersContainer = document.getElementById('pageNumbers');
        if (!pageNumbersContainer) return;
        
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
        const prevBtn = document.querySelector('.btn-pagination.prev');
        const nextBtn = document.querySelector('.btn-pagination.next');
        if (prevBtn) prevBtn.disabled = currentPage === 1;
        if (nextBtn) nextBtn.disabled = currentPage === totalPages || totalPages === 0;
    }

    // Fungsi pergi ke halaman tertentu
    function goToPage(page) {
        currentPage = page;
        renderTransactionsTable();
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
        const period = document.getElementById('filterPeriod').value;
        const ladang = document.getElementById('filterLadang').value;
        const dateFrom = document.getElementById('filterDateFrom').value;
        const dateTo = document.getElementById('filterDateTo').value;

        filteredData = analyticsData.filter(item => {
            // Filter ladang
            if (ladang && item.ladang !== ladang) return false;

            // Filter tanggal berdasarkan periode
            const itemDate = new Date(item.date);
            
            if (period === '7-days') {
                const weekAgo = new Date();
                weekAgo.setDate(weekAgo.getDate() - 7);
                return itemDate >= weekAgo;
            } else if (period === '30-days') {
                const monthAgo = new Date();
                monthAgo.setDate(monthAgo.getDate() - 30);
                return itemDate >= monthAgo;
            } else if (period === '3-months') {
                const threeMonthsAgo = new Date();
                threeMonthsAgo.setMonth(threeMonthsAgo.getMonth() - 3);
                return itemDate >= threeMonthsAgo;
            } else if (period === '6-months') {
                const sixMonthsAgo = new Date();
                sixMonthsAgo.setMonth(sixMonthsAgo.getMonth() - 6);
                return itemDate >= sixMonthsAgo;
            } else if (period === 'year') {
                const yearAgo = new Date();
                yearAgo.setFullYear(yearAgo.getFullYear() - 1);
                return itemDate >= yearAgo;
            } else if (period === 'custom') {
                if (!dateFrom || !dateTo) return true;
                
                const start = new Date(dateFrom);
                start.setHours(0, 0, 0, 0);
                
                const end = new Date(dateTo);
                end.setHours(23, 59, 59, 999);
                
                return itemDate >= start && itemDate <= end;
            }

            return true;
        });

        // Urutkan berdasarkan tanggal terbaru
        filteredData.sort((a, b) => new Date(b.date) - new Date(a.date));

        currentPage = 1;
        updateAnalytics();
    }

    // Fungsi update semua analitik
    function updateAnalytics() {
        calculateStatistics(filteredData);
        createPriceTrendChart(filteredData);
        createLadangComparisonChart(filteredData);
        createPriceDistributionChart(filteredData);
        renderTransactionsTable();
    }

    // Fungsi reset filter
    function resetFilter() {
        document.getElementById('filterPeriod').value = '30-days';
        document.getElementById('filterLadang').value = '';
        document.getElementById('filterDateFrom').value = '';
        document.getElementById('filterDateTo').value = '';
        document.getElementById('customDateGroup').style.display = 'none';
        
        filteredData = [...analyticsData];
        currentPage = 1;
        updateAnalytics();
    }

    // Fungsi toggle chart type
    function toggleChartType() {
        currentChartType = currentChartType === 'line' ? 'bar' : 'line';
        const toggleBtn = document.getElementById('toggleChartType');
        if (toggleBtn) {
            toggleBtn.innerHTML = `
                <i class="fas fa-exchange-alt"></i> Ubah ke ${currentChartType === 'line' ? 'Bar' : 'Line'}
            `;
        }
        createPriceTrendChart(filteredData);
    }

    // Fungsi export analytics
    function exportAnalytics() {
        alert('Fitur export analytics berhasil dijalankan! Data akan diunduh sebagai Excel.');
        // Di sini bisa ditambahkan logika export ke Excel
    }

    // Fungsi print report
    function printReport() {
        alert('Fitur print report berhasil dijalankan! Membuka dialog print.');
        // Di sini bisa ditambahkan logika print
    }

    // Event Listeners
    document.addEventListener('click', function(e) {
        if (e.target && e.target.id === 'applyAnalyticsFilterBtn') {
            filterData();
        }
        
        if (e.target && e.target.id === 'resetAnalyticsFilterBtn') {
            resetFilter();
        }
        
        if (e.target && e.target.id === 'exportAnalyticsBtn') {
            exportAnalytics();
        }
        
        if (e.target && e.target.id === 'printReportBtn') {
            printReport();
        }
        
        if (e.target && e.target.id === 'toggleChartType') {
            toggleChartType();
        }
        
        if (e.target && e.target.id === 'exportDetailBtn') {
            alert('Export detail berhasil!');
        }
        
        if (e.target && e.target.classList.contains('close-analytics-modal')) {
            document.getElementById('analyticsDetailModal').style.display = 'none';
        }
    });

    document.getElementById('filterPeriod').addEventListener('change', function() {
        const customGroup = document.getElementById('customDateGroup');
        if (customGroup) {
            customGroup.style.display = this.value === 'custom' ? 'block' : 'none';
        }
    });

    // Event listener untuk pagination
    document.addEventListener('click', function(e) {
        if (e.target && e.target.closest('.btn-pagination.prev')) {
            if (currentPage > 1) goToPage(currentPage - 1);
        }
        
        if (e.target && e.target.closest('.btn-pagination.next')) {
            const totalPages = Math.ceil(filteredData.length / itemsPerPage);
            if (currentPage < totalPages) goToPage(currentPage + 1);
        }
    });

    // Close modal when clicking outside
    window.addEventListener('click', function(event) {
        const modal = document.getElementById('analyticsDetailModal');
        if (event.target === modal) {
            modal.style.display = 'none';
        }
    });

    // Set default dates for custom filter
    const today = new Date();
    const oneMonthAgo = new Date();
    oneMonthAgo.setMonth(today.getMonth() - 1);
    
    document.getElementById('filterDateFrom').valueAsDate = oneMonthAgo;
    document.getElementById('filterDateTo').valueAsDate = today;

    // Initialize
    updateAnalytics();
});
</script>
@endsection