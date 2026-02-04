@extends('layouts.pusat')

@section('title', 'Laporan Data Produksi - PT. Mardua Holong')

@section('page-title', 'Laporan Data Produksi')
@section('page-subtitle', 'Monitor seluruh data produksi jeruk dari manajemen lapangan')

@section('content')
<div class="content-wrapper">
    <!-- Header -->
    <div class="content-header">
        <div class="header-left">
            <h1>Laporan Data Produksi Jeruk</h1>
            <p>Monitor seluruh aktivitas produksi mulai dari panen hingga pengemasan</p>
        </div>
        <div class="header-right">
            <div class="btn-group">
                <button type="button" id="exportPanenBtn" class="btn btn-primary">
                    <i class="fas fa-file-excel"></i> Export Panen
                </button>
                <button type="button" id="exportPengemasanBtn" class="btn btn-success">
                    <i class="fas fa-file-excel"></i> Export Pengemasan
                </button>
            </div>
        </div>
    </div>
    
    <!-- Statistik Utama -->
    <div class="stats-grid">
        <div class="stat-card">
            <div class="stat-icon bg-blue">
                <i class="fas fa-seedling"></i>
            </div>
            <div class="stat-content">
                <div class="stat-value" id="totalPanen">0</div>
                <div class="stat-label">Total Batch Panen</div>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon bg-green">
                <i class="fas fa-box"></i>
            </div>
            <div class="stat-content">
                <div class="stat-value" id="totalKemasan">0</div>
                <div class="stat-label">Total Batch Kemasan</div>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon bg-orange">
                <i class="fas fa-weight-hanging"></i>
            </div>
            <div class="stat-content">
                <div class="stat-value" id="totalBeratProduksi">0 Kg</div>
                <div class="stat-label">Total Berat Produksi</div>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon bg-purple">
                <i class="fas fa-chart-line"></i>
            </div>
            <div class="stat-content">
                <div class="stat-value" id="avgKualitas">A</div>
                <div class="stat-label">Rata-rata Kualitas</div>
            </div>
        </div>
    </div>
    
    <!-- Tabs Navigasi -->
    <div class="tabs-container">
        <div class="tabs">
            <button class="tab-btn active" data-tab="panen">
                <i class="fas fa-seedling"></i>
                <span>Data Panen</span>
            </button>
            <button class="tab-btn" data-tab="pengemasan">
                <i class="fas fa-box"></i>
                <span>Data Pengemasan</span>
            </button>
            <button class="tab-btn" data-tab="integrated">
                <i class="fas fa-link"></i>
                <span>Data Terintegrasi</span>
            </button>
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
                    <label class="filter-label">Kualitas</label>
                    <select id="filterKualitas" class="form-control">
                        <option value="">Semua Kualitas</option>
                        <option value="A">Kualitas A</option>
                        <option value="B">Kualitas B</option>
                        <option value="C">Kualitas C</option>
                    </select>
                </div>
                
                <div class="filter-group">
                    <label class="filter-label">Petani/Ladang</label>
                    <select id="filterPetani" class="form-control">
                        <option value="">Semua Petani</option>
                        <option value="1">Tuan Pandiangan</option>
                        <option value="2">Tuan Silalahi</option>
                        <option value="3">Tuan Siregar</option>
                        <option value="4">Ibu Munthe</option>
                        <option value="5">Pak Sinuhaji</option>
                        <option value="6">Ibu Ginting</option>
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
    
    <!-- Tab Content: Data Panen -->
    <div class="tab-content active" id="panenTab">
        <div class="content-card">
            <div class="card-header">
                <div class="card-title">
                    <i class="fas fa-seedling"></i>
                    <span>Data Panen Jeruk</span>
                </div>
                <div class="card-info">
                    Menampilkan <span id="showingPanen">0</span> dari <span id="totalPanenCount">0</span> data panen
                </div>
            </div>
            
            <div class="table-container">
                <div class="table-responsive">
                    <table class="data-table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Batch Panen</th>
                                <th>Tanggal Panen</th>
                                <th>Petani</th>
                                <th>Kualitas</th>
                                <th>Jumlah (Kg)</th>
                                <th>Lokasi</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody id="panenTableBody">
                            <!-- Data panen akan diisi oleh JavaScript -->
                        </tbody>
                    </table>
                </div>
            </div>
            
            <div class="table-footer">
                <div class="showing-count">
                    Halaman <span id="currentPanenPage">1</span> dari <span id="totalPanenPages">1</span>
                </div>
                <div class="pagination">
                    <button type="button" class="btn-pagination prev-panen">
                        <i class="fas fa-chevron-left"></i>
                    </button>
                    <div class="page-numbers" id="panenPageNumbers"></div>
                    <button type="button" class="btn-pagination next-panen">
                        <i class="fas fa-chevron-right"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Tab Content: Data Pengemasan -->
    <div class="tab-content" id="pengemasanTab">
        <div class="content-card">
            <div class="card-header">
                <div class="card-title">
                    <i class="fas fa-box"></i>
                    <span>Data Pengemasan Jeruk</span>
                </div>
                <div class="card-info">
                    Menampilkan <span id="showingPengemasan">0</span> dari <span id="totalPengemasanCount">0</span> data pengemasan
                </div>
            </div>
            
            <div class="table-container">
                <div class="table-responsive">
                    <table class="data-table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Batch Pengemasan</th>
                                <th>Batch Panen</th>
                                <th>Jenis Kemasan</th>
                                <th>Jumlah Unit</th>
                                <th>Tanggal Kemas</th>
                                <th>Berat Total</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody id="pengemasanTableBody">
                            <!-- Data pengemasan akan diisi oleh JavaScript -->
                        </tbody>
                    </table>
                </div>
            </div>
            
            <div class="table-footer">
                <div class="showing-count">
                    Halaman <span id="currentPengemasanPage">1</span> dari <span id="totalPengemasanPages">1</span>
                </div>
                <div class="pagination">
                    <button type="button" class="btn-pagination prev-pengemasan">
                        <i class="fas fa-chevron-left"></i>
                    </button>
                    <div class="page-numbers" id="pengemasanPageNumbers"></div>
                    <button type="button" class="btn-pagination next-pengemasan">
                        <i class="fas fa-chevron-right"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Tab Content: Data Terintegrasi -->
    <div class="tab-content" id="integratedTab">
        <div class="content-card">
            <div class="card-header">
                <div class="card-title">
                    <i class="fas fa-link"></i>
                    <span>Data Produksi Terintegrasi</span>
                </div>
                <div class="card-info">
                    Menampilkan hubungan data panen dengan pengemasan
                </div>
            </div>
            
            <div class="table-container">
                <div class="table-responsive">
                    <table class="data-table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Batch Panen</th>
                                <th>Tanggal Panen</th>
                                <th>Kualitas</th>
                                <th>Berat Panen</th>
                                <th>Batch Pengemasan</th>
                                <th>Jenis Kemasan</th>
                                <th>Unit Dikemas</th>
                                <th>Progress</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody id="integratedTableBody">
                            <!-- Data terintegrasi akan diisi oleh JavaScript -->
                        </tbody>
                    </table>
                </div>
            </div>
            
            <div class="table-footer">
                <div class="showing-count">
                    Halaman <span id="currentIntegratedPage">1</span> dari <span id="totalIntegratedPages">1</span>
                </div>
                <div class="pagination">
                    <button type="button" class="btn-pagination prev-integrated">
                        <i class="fas fa-chevron-left"></i>
                    </button>
                    <div class="page-numbers" id="integratedPageNumbers"></div>
                    <button type="button" class="btn-pagination next-integrated">
                        <i class="fas fa-chevron-right"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Detail Panen -->
<div id="detailPanenModal" class="modal">
    <div class="modal-content modal-lg">
        <div class="modal-header">
            <h3 class="modal-title">Detail Data Panen</h3>
            <button type="button" class="close-modal" data-modal="detailPanenModal">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <div class="modal-body" id="detailPanenBody">
            <!-- Detail panen akan diisi oleh JavaScript -->
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary close-modal" data-modal="detailPanenModal">
                Tutup
            </button>
            <button type="button" class="btn btn-primary" id="printPanenBtn">
                <i class="fas fa-print"></i> Cetak Detail
            </button>
        </div>
    </div>
</div>

<!-- Modal Detail Pengemasan -->
<div id="detailPengemasanModal" class="modal">
    <div class="modal-content modal-lg">
        <div class="modal-header">
            <h3 class="modal-title">Detail Data Pengemasan</h3>
            <button type="button" class="close-modal" data-modal="detailPengemasanModal">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <div class="modal-body" id="detailPengemasanBody">
            <!-- Detail pengemasan akan diisi oleh JavaScript -->
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary close-modal" data-modal="detailPengemasanModal">
                Tutup
            </button>
            <button type="button" class="btn btn-primary" id="printPengemasanBtn">
                <i class="fas fa-print"></i> Cetak Detail
            </button>
        </div>
    </div>
</div>

<!-- Modal Detail Terintegrasi -->
<div id="detailIntegratedModal" class="modal">
    <div class="modal-content modal-xl">
        <div class="modal-header">
            <h3 class="modal-title">Detail Produksi Terintegrasi</h3>
            <button type="button" class="close-modal" data-modal="detailIntegratedModal">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <div class="modal-body" id="detailIntegratedBody">
            <!-- Detail terintegrasi akan diisi oleh JavaScript -->
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary close-modal" data-modal="detailIntegratedModal">
                Tutup
            </button>
            <button type="button" class="btn btn-primary" id="printIntegratedBtn">
                <i class="fas fa-print"></i> Cetak Laporan
            </button>
        </div>
    </div>
</div>


<style>
    /* Variabel CSS */
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
        --text-muted: #95a5a6;
        
        --shadow-sm: 0 1px 3px rgba(0,0,0,0.12);
        --shadow-md: 0 4px 6px rgba(0,0,0,0.1);
        --shadow-lg: 0 10px 20px rgba(0,0,0,0.1);
        
        --radius-sm: 6px;
        --radius-md: 10px;
        --radius-lg: 14px;
        
        --transition: all 0.3s ease;
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
        border: 1px solid var(--border-color);
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
    }
    
    .stat-icon.bg-blue {
        background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
    }
    
    .stat-icon.bg-green {
        background: linear-gradient(135deg, var(--success) 0%, var(--success-dark) 100%);
    }
    
    .stat-icon.bg-orange {
        background: linear-gradient(135deg, var(--orange) 0%, var(--warning-dark) 100%);
    }
    
    .stat-icon.bg-purple {
        background: linear-gradient(135deg, var(--purple) 0%, #8e44ad 100%);
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
    
    /* Tabs */
    .tabs-container {
        background: white;
        border-radius: var(--radius-md);
        padding: 6px;
        box-shadow: var(--shadow-sm);
        border: 1px solid var(--border-color);
        margin-bottom: 25px;
    }
    
    .tabs {
        display: flex;
        gap: 4px;
    }
    
    .tab-btn {
        flex: 1;
        padding: 14px 20px;
        border: none;
        background: transparent;
        border-radius: var(--radius-sm);
        cursor: pointer;
        font-weight: 600;
        color: var(--text-light);
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
        transition: var(--transition);
        font-size: 14px;
        white-space: nowrap;
    }
    
    .tab-btn:hover {
        background-color: var(--bg-light);
        color: var(--text-dark);
    }
    
    .tab-btn.active {
        background-color: var(--primary);
        color: white;
        box-shadow: var(--shadow-sm);
    }
    
    .tab-btn.active i {
        color: white;
    }
    
    /* Tab Content */
    .tab-content {
        display: none;
        animation: fadeIn 0.3s ease;
    }
    
    .tab-content.active {
        display: block;
    }
    
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(10px); }
        to { opacity: 1; transform: translateY(0); }
    }
    
    /* Filter Section */
    .filter-section {
        background: white;
        border-radius: var(--radius-md);
        padding: 20px;
        box-shadow: var(--shadow-sm);
        border: 1px solid var(--border-color);
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
        border: 1px solid var(--border-color);
        border-radius: var(--radius-sm);
        font-size: 14px;
        color: var(--text-dark);
        background-color: white;
        transition: var(--transition);
    }
    
    .form-control:focus {
        outline: none;
        border-color: var(--primary);
        box-shadow: 0 0 0 3px rgba(52, 152, 219, 0.1);
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
        background-color: var(--success-dark);
    }
    
    /* Content Card */
    .content-card {
        background: white;
        border-radius: var(--radius-md);
        padding: 25px;
        box-shadow: var(--shadow-sm);
        border: 1px solid var(--border-color);
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
        border: 1px solid var(--border-color);
    }
    
    /* Tables */
    .table-container {
        border-radius: var(--radius-sm);
        overflow: hidden;
        border: 1px solid var(--border-color);
    }
    
    .table-responsive {
        overflow-x: auto;
    }
    
    .data-table {
        width: 100%;
        border-collapse: collapse;
        min-width: 1000px;
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
        border-bottom: 2px solid var(--border-color);
        white-space: nowrap;
    }
    
    .data-table td {
        padding: 16px;
        font-size: 14px;
        color: var(--text-dark);
        border-bottom: 1px solid var(--border-color);
        vertical-align: middle;
    }
    
    .data-table tbody tr {
        transition: var(--transition);
    }
    
    .data-table tbody tr:hover {
        background-color: var(--primary-light);
    }
    
    /* Status Badges */
    .status-badge {
        display: inline-block;
        padding: 6px 12px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 600;
        text-align: center;
        min-width: 80px;
    }
    
    .status-complete {
        background-color: #d4edda;
        color: #155724;
        border: 1px solid #c3e6cb;
    }
    
    .status-partial {
        background-color: #fff3cd;
        color: #856404;
        border: 1px solid #ffeaa7;
    }
    
    .status-pending {
        background-color: #d1ecf1;
        color: #0c5460;
        border: 1px solid #bee5eb;
    }
    
    /* Quality Badges */
    .quality-badge {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 6px 12px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 600;
    }
    
    .quality-A {
        background-color: #d4edda;
        color: #155724;
        border: 1px solid #c3e6cb;
    }
    
    .quality-B {
        background-color: #fff3cd;
        color: #856404;
        border: 1px solid #ffeaa7;
    }
    
    .quality-C {
        background-color: #f8d7da;
        color: #721c24;
        border: 1px solid #f5c6cb;
    }
    
    /* Package Badges */
    .package-badge {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 6px 12px;
        border-radius: 6px;
        font-size: 12px;
        font-weight: 600;
    }
    
    .package-kardus {
        background-color: #f5e6ca;
        color: #8b4513;
        border: 1px solid #e8d7b2;
    }
    
    .package-keranjang {
        background-color: #e8d4f7;
        color: #6a0dad;
        border: 1px solid #d9b8f3;
    }
    
    .package-peti {
        background-color: #d4e6f1;
        color: #1e3a8a;
        border: 1px solid #c2d7e8;
    }
    
    /* Progress Bar */
    .progress-container {
        width: 100px;
        height: 8px;
        background-color: var(--border-color);
        border-radius: 4px;
        overflow: hidden;
        flex-shrink: 0;
    }
    
    .progress-bar {
        height: 100%;
        border-radius: 4px;
        transition: width 0.3s ease;
    }
    
    .progress-100 { background-color: var(--success); }
    .progress-75 { background-color: #4CAF50; }
    .progress-50 { background-color: #FFC107; }
    .progress-25 { background-color: #FF9800; }
    .progress-0 { background-color: var(--danger); }
    
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
        color: var(--primary);
    }
    
    .btn-view:hover {
        background-color: var(--primary);
        color: white;
    }
    
    .btn-analytics {
        background-color: #e8f5e9;
        color: var(--success);
    }
    
    .btn-analytics:hover {
        background-color: var(--success);
        color: white;
    }
    
    /* Table Footer */
    .table-footer {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-top: 20px;
        padding-top: 20px;
        border-top: 1px solid var(--border-color);
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
        border: 1px solid var(--border-color);
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
        border: 1px solid var(--border-color);
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
    
    .page-number:disabled {
        background-color: transparent;
        border-color: transparent;
        cursor: default;
        color: var(--text-muted);
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
        border-bottom: 1px solid var(--border-color);
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
        border-top: 1px solid var(--border-color);
        display: flex;
        gap: 10px;
        justify-content: flex-end;
    }
    
    /* Charts */
    .chart-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 20px;
        margin-bottom: 20px;
    }
    
    .chart-container {
        background: var(--bg-light);
        border-radius: var(--radius-md);
        padding: 20px;
    }
    
    .chart-container h4 {
        margin: 0 0 15px 0;
        font-size: 16px;
        font-weight: 600;
        color: var(--text-dark);
        display: flex;
        align-items: center;
        gap: 8px;
    }
    
    .chart-container-full {
        background: var(--bg-light);
        border-radius: var(--radius-md);
        padding: 20px;
    }
    
    .chart-container-full h4 {
        margin: 0 0 15px 0;
        font-size: 16px;
        font-weight: 600;
        color: var(--text-dark);
        display: flex;
        align-items: center;
        gap: 8px;
    }
    
    .chart-wrapper {
        height: 200px;
        position: relative;
    }
    
    /* Detail Panen Design */
    .detail-header {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        margin-bottom: 25px;
        padding-bottom: 20px;
        border-bottom: 2px solid var(--border-color);
    }
    
    .detail-title h3 {
        margin: 0;
        font-size: 20px;
        font-weight: 700;
        color: var(--text-dark);
    }
    
    .detail-subtitle {
        color: var(--text-light);
        font-size: 14px;
        margin-top: 5px;
    }
    
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
        
        .tabs {
            flex-direction: column;
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
        
        .chart-grid {
            grid-template-columns: 1fr;
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
        
        .action-buttons {
            flex-direction: column;
        }
        
        .btn-action {
            width: 100%;
        }
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
</style>

<script>
// Data dummy panen
const panenData = [
    {
        id: 1,
        batch_panen: "PNH-2024-03-001",
        tanggal_panen: "2024-03-25",
        waktu_panen: "08:30",
        petani: "Tuan Pandiangan",
        kualitas: "A",
        jumlah_kg: 500,
        lokasi_gps: "3.182471, 98.509331",
        status: "Selesai",
        catatan: "Panen musiman, kondisi sangat baik",
        manajer: "Ronny",
        created_at: "2024-03-25 08:45:00"
    },
    {
        id: 2,
        batch_panen: "PNH-2024-03-002",
        tanggal_panen: "2024-03-26",
        waktu_panen: "09:15",
        petani: "Tuan Silalahi",
        kualitas: "B",
        jumlah_kg: 350,
        lokasi_gps: "3.183211, 98.508992",
        status: "Selesai",
        catatan: "Kualitas cukup baik, beberapa cacat kecil",
        manajer: "Rieno",
        created_at: "2024-03-26 09:30:00"
    },
    {
        id: 3,
        batch_panen: "PNH-2024-03-003",
        tanggal_panen: "2024-03-27",
        waktu_panen: "07:45",
        petani: "Tuan Siregar",
        kualitas: "A",
        jumlah_kg: 420,
        lokasi_gps: "3.184001, 98.510123",
        status: "Selesai",
        catatan: "Jeruk premium, diameter besar",
        manajer: "Risto",
        created_at: "2024-03-27 08:00:00"
    },
    {
        id: 4,
        batch_panen: "PNH-2024-03-004",
        tanggal_panen: "2024-03-28",
        waktu_panen: "10:30",
        petani: "Pak Sinuhaji",
        kualitas: "C",
        jumlah_kg: 280,
        lokasi_gps: "3.181234, 98.507891",
        status: "Selesai",
        catatan: "Kualitas ekonomis, untuk olahan",
        manajer: "Yekris",
        created_at: "2024-03-28 10:45:00"
    },
    {
        id: 5,
        batch_panen: "PNH-2024-03-005",
        tanggal_panen: "2024-03-29",
        waktu_panen: "11:20",
        petani: "Ibu Munthe",
        kualitas: "B",
        jumlah_kg: 320,
        lokasi_gps: "3.185432, 98.509876",
        status: "Proses",
        catatan: "Sedang dalam proses grading",
        manajer: "Trhesya",
        created_at: "2024-03-29 11:35:00"
    },
    {
        id: 6,
        batch_panen: "PNH-2024-03-006",
        tanggal_panen: "2024-03-30",
        waktu_panen: "08:10",
        petani: "Ibu Ginting",
        kualitas: "A",
        jumlah_kg: 450,
        lokasi_gps: "3.183765, 98.511234",
        status: "Selesai",
        catatan: "Panen pagi, kualitas premium",
        manajer: "Maharani",
        created_at: "2024-03-30 08:25:00"
    }
];

// Data dummy pengemasan
const pengemasanData = [
    {
        id: 1,
        batch_pengemasan: "KRD-001",
        batch_panen: "PNH-2024-03-001",
        jenis_kemasan: "kardus",
        jumlah_unit: 50,
        tanggal_kemas: "2024-03-26",
        berat_total: 500,
        status: "Selesai",
        catatan: "Pengemasan untuk distribusi lokal",
        manajer: "Ronny",
        created_at: "2024-03-26 14:30:00"
    },
    {
        id: 2,
        batch_pengemasan: "KRN-025",
        batch_panen: "PNH-2024-03-002",
        jenis_kemasan: "keranjang",
        jumlah_unit: 24,
        tanggal_kemas: "2024-03-27",
        berat_total: 350,
        status: "Selesai",
        catatan: "Untuk pasar tradisional",
        manajer: "Rieno",
        created_at: "2024-03-27 11:15:00"
    },
    {
        id: 3,
        batch_pengemasan: "PTI-100",
        batch_panen: "PNH-2024-03-003",
        jenis_kemasan: "peti",
        jumlah_unit: 21,
        tanggal_kemas: "2024-03-28",
        berat_total: 420,
        status: "Selesai",
        catatan: "Pengiriman ekspor",
        manajer: "Risto",
        created_at: "2024-03-28 09:45:00"
    },
    {
        id: 4,
        batch_pengemasan: "KRD-002",
        batch_panen: "PNH-2024-03-004",
        jenis_kemasan: "kardus",
        jumlah_unit: 28,
        tanggal_kemas: "2024-03-29",
        berat_total: 280,
        status: "Proses",
        catatan: "Sedang dalam proses labeling",
        manajer: "Yekris",
        created_at: "2024-03-29 13:20:00"
    },
    {
        id: 5,
        batch_pengemasan: "KRN-026",
        batch_panen: "PNH-2024-03-005",
        jenis_kemasan: "keranjang",
        jumlah_unit: 22,
        tanggal_kemas: "2024-03-30",
        berat_total: 320,
        status: "Pending",
        catatan: "Menunggu pengemasan",
        manajer: "Trhesya",
        created_at: "2024-03-30 10:00:00"
    },
    {
        id: 6,
        batch_pengemasan: "PTI-101",
        batch_panen: "PNH-2024-03-006",
        jenis_kemasan: "peti",
        jumlah_unit: 23,
        tanggal_kemas: "2024-03-31",
        berat_total: 450,
        status: "Selesai",
        catatan: "Ready for shipment",
        manajer: "Maharani",
        created_at: "2024-03-31 15:30:00"
    }
];

// State variables
let currentPanenPage = 1;
let currentPengemasanPage = 1;
let currentIntegratedPage = 1;
const itemsPerPage = 5;
let filteredPanenData = [...panenData];
let filteredPengemasanData = [...pengemasanData];

// Utility functions
function formatDate(dateString) {
    const options = { day: '2-digit', month: '2-digit', year: 'numeric' };
    return new Date(dateString).toLocaleDateString('id-ID', options);
}

function formatDateTime(dateString, timeString = '00:00') {
    return `${formatDate(dateString)} ${timeString}`;
}

function formatRupiah(angka) {
    return 'Rp ' + angka.toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.');
}

// Update statistics
function updateStatistics() {
    const totalPanen = filteredPanenData.length;
    const totalKemasan = filteredPengemasanData.length;
    const totalBerat = filteredPanenData.reduce((sum, item) => sum + item.jumlah_kg, 0);
    
    // Calculate average quality
    const qualityScores = { 'A': 3, 'B': 2, 'C': 1 };
    const avgQuality = filteredPanenData.length > 0 
        ? filteredPanenData.reduce((sum, item) => sum + qualityScores[item.kualitas], 0) / filteredPanenData.length
        : 0;
    
    let avgQualityLetter = '-';
    if (avgQuality >= 2.5) avgQualityLetter = 'A';
    else if (avgQuality >= 1.5) avgQualityLetter = 'B';
    else if (avgQuality > 0) avgQualityLetter = 'C';

    document.getElementById('totalPanen').textContent = totalPanen;
    document.getElementById('totalKemasan').textContent = totalKemasan;
    document.getElementById('totalBeratProduksi').textContent = totalBerat.toLocaleString() + ' Kg';
    document.getElementById('avgKualitas').textContent = avgQualityLetter;
}

// Render panen table
function renderPanenTable() {
    const tbody = document.getElementById('panenTableBody');
    const startIndex = (currentPanenPage - 1) * itemsPerPage;
    const endIndex = startIndex + itemsPerPage;
    const currentData = filteredPanenData.slice(startIndex, endIndex);

    if (currentData.length === 0) {
        tbody.innerHTML = `
            <tr>
                <td colspan="9">
                    <div class="empty-state">
                        <i class="fas fa-seedling"></i>
                        <h4>Tidak ada data panen ditemukan</h4>
                        <p>Coba gunakan filter yang berbeda</p>
                    </div>
                </td>
            </tr>
        `;
    } else {
        tbody.innerHTML = currentData.map((item, index) => {
            const rowNumber = startIndex + index + 1;
            return `
                <tr>
                    <td>${rowNumber}</td>
                    <td>
                        <div style="font-weight: 600; color: var(--text-dark);">${item.batch_panen}</div>
                        <div style="font-size: 12px; color: var(--text-light);">by ${item.manajer}</div>
                    </td>
                    <td>
                        <div>${formatDate(item.tanggal_panen)}</div>
                        <div style="font-size: 12px; color: var(--text-light);">${item.waktu_panen}</div>
                    </td>
                    <td>${item.petani}</td>
                    <td>
                        <span class="quality-badge quality-${item.kualitas}">
                            <i class="fas fa-star"></i>
                            Kualitas ${item.kualitas}
                        </span>
                    </td>
                    <td>
                        <div style="font-weight: 600; color: var(--text-dark);">${item.jumlah_kg.toLocaleString()} Kg</div>
                    </td>
                    <td>
                        <span style="font-size: 12px; color: var(--text-light);">${item.lokasi_gps}</span>
                    </td>
                    <td>
                        <span class="status-badge status-complete">${item.status}</span>
                    </td>
                    <td>
                        <div class="action-buttons">
                            <button class="btn-action btn-view" onclick="showDetailPanen(${item.id})" title="Detail">
                                <i class="fas fa-eye"></i>
                            </button>
                        </div>
                    </td>
                </tr>
            `;
        }).join('');
    }

    updatePanenPagination();
    updatePanenShowingCount();
}

// Render pengemasan table
function renderPengemasanTable() {
    const tbody = document.getElementById('pengemasanTableBody');
    const startIndex = (currentPengemasanPage - 1) * itemsPerPage;
    const endIndex = startIndex + itemsPerPage;
    const currentData = filteredPengemasanData.slice(startIndex, endIndex);

    if (currentData.length === 0) {
        tbody.innerHTML = `
            <tr>
                <td colspan="9">
                    <div class="empty-state">
                        <i class="fas fa-box"></i>
                        <h4>Tidak ada data pengemasan ditemukan</h4>
                        <p>Coba gunakan filter yang berbeda</p>
                    </div>
                </td>
            </tr>
        `;
    } else {
        tbody.innerHTML = currentData.map((item, index) => {
            const rowNumber = startIndex + index + 1;
            // Package badge class
            const packageClass = `package-${item.jenis_kemasan}`;
            let packageIcon = 'fa-box';
            if (item.jenis_kemasan === 'keranjang') packageIcon = 'fa-shopping-basket';
            if (item.jenis_kemasan === 'peti') packageIcon = 'fa-archive';
            
            // Status badge class
            let statusClass = 'status-complete';
            if (item.status === 'Proses') statusClass = 'status-partial';
            if (item.status === 'Pending') statusClass = 'status-pending';

            return `
                <tr>
                    <td>${rowNumber}</td>
                    <td>
                        <div style="font-weight: 600; color: var(--text-dark);">${item.batch_pengemasan}</div>
                        <div style="font-size: 12px; color: var(--text-light);">by ${item.manajer}</div>
                    </td>
                    <td>
                        <div>${item.batch_panen}</div>
                    </td>
                    <td>
                        <span class="package-badge ${packageClass}">
                            <i class="fas ${packageIcon}"></i>
                            ${item.jenis_kemasan.charAt(0).toUpperCase() + item.jenis_kemasan.slice(1)}
                        </span>
                    </td>
                    <td>
                        <div style="font-weight: 600; color: var(--text-dark);">${item.jumlah_unit} unit</div>
                    </td>
                    <td>${formatDate(item.tanggal_kemas)}</td>
                    <td>
                        <div style="font-weight: 600; color: var(--text-dark);">${item.berat_total.toLocaleString()} Kg</div>
                    </td>
                    <td>
                        <span class="status-badge ${statusClass}">${item.status}</span>
                    </td>
                    <td>
                        <div class="action-buttons">
                            <button class="btn-action btn-view" onclick="showDetailPengemasan(${item.id})" title="Detail">
                                <i class="fas fa-eye"></i>
                            </button>
                        </div>
                    </td>
                </tr>
            `;
        }).join('');
    }

    updatePengemasanPagination();
    updatePengemasanShowingCount();
}

// Render integrated table
function renderIntegratedTable() {
    const tbody = document.getElementById('integratedTableBody');
    const startIndex = (currentIntegratedPage - 1) * itemsPerPage;
    const endIndex = startIndex + itemsPerPage;
    
    // Combine data
    const integratedData = panenData.map(panen => {
        const pengemasan = pengemasanData.find(p => p.batch_panen === panen.batch_panen);
        return {
            ...panen,
            pengemasan: pengemasan || null
        };
    });
    
    const currentData = integratedData.slice(startIndex, endIndex);

    if (currentData.length === 0) {
        tbody.innerHTML = `
            <tr>
                <td colspan="10">
                    <div class="empty-state">
                        <i class="fas fa-link"></i>
                        <h4>Tidak ada data terintegrasi ditemukan</h4>
                        <p>Coba gunakan filter yang berbeda</p>
                    </div>
                </td>
            </tr>
        `;
    } else {
        tbody.innerHTML = currentData.map((item, index) => {
            const rowNumber = startIndex + index + 1;
            const hasPengemasan = item.pengemasan !== null;
            const progressPercentage = hasPengemasan ? 100 : 0;
            const progressClass = `progress-${progressPercentage}`;

            return `
                <tr>
                    <td>${rowNumber}</td>
                    <td>
                        <div style="font-weight: 600; color: var(--text-dark);">${item.batch_panen}</div>
                    </td>
                    <td>${formatDate(item.tanggal_panen)}</td>
                    <td>
                        <span class="quality-badge quality-${item.kualitas}">
                            <i class="fas fa-star"></i>
                            ${item.kualitas}
                        </span>
                    </td>
                    <td>
                        <div style="font-weight: 600; color: var(--text-dark);">${item.jumlah_kg.toLocaleString()} Kg</div>
                    </td>
                    <td>
                        ${hasPengemasan ? 
                            `<div style="font-weight: 600; color: var(--text-dark);">${item.pengemasan.batch_pengemasan}</div>` :
                            '<span style="color: var(--text-light); font-size: 12px;">Belum dikemas</span>'
                        }
                    </td>
                    <td>
                        ${hasPengemasan ? 
                            `<span class="package-badge package-${item.pengemasan.jenis_kemasan}">
                                <i class="fas fa-${item.pengemasan.jenis_kemasan === 'keranjang' ? 'shopping-basket' : 
                                                item.pengemasan.jenis_kemasan === 'peti' ? 'archive' : 'box'}"></i>
                                ${item.pengemasan.jenis_kemasan}
                            </span>` :
                            '-'
                        }
                    </td>
                    <td>
                        ${hasPengemasan ? 
                            `<div style="font-weight: 600; color: var(--text-dark);">${item.pengemasan.jumlah_unit} unit</div>` :
                            '-'
                        }
                    </td>
                    <td>
                        <div style="display: flex; align-items: center; gap: 10px;">
                            <div class="progress-container">
                                <div class="progress-bar ${progressClass}" style="width: ${progressPercentage}%"></div>
                            </div>
                            <span style="font-size: 12px; color: var(--text-light);">${progressPercentage}%</span>
                        </div>
                    </td>
                    <td>
                        <div class="action-buttons">
                            <button class="btn-action btn-view" onclick="showDetailIntegrated(${item.id})" title="Detail">
                                <i class="fas fa-eye"></i>
                            </button>
                        </div>
                    </td>
                </tr>
            `;
        }).join('');
    }

    updateIntegratedPagination();
}

// Pagination functions
function updatePanenPagination() {
    const totalPages = Math.ceil(filteredPanenData.length / itemsPerPage);
    document.getElementById('currentPanenPage').textContent = currentPanenPage;
    document.getElementById('totalPanenPages').textContent = totalPages;
    updatePageNumbers('panenPageNumbers', currentPanenPage, totalPages, goToPanenPage);
    
    document.querySelector('.prev-panen').disabled = currentPanenPage === 1;
    document.querySelector('.next-panen').disabled = currentPanenPage === totalPages || totalPages === 0;
}

function updatePengemasanPagination() {
    const totalPages = Math.ceil(filteredPengemasanData.length / itemsPerPage);
    document.getElementById('currentPengemasanPage').textContent = currentPengemasanPage;
    document.getElementById('totalPengemasanPages').textContent = totalPages;
    updatePageNumbers('pengemasanPageNumbers', currentPengemasanPage, totalPages, goToPengemasanPage);
    
    document.querySelector('.prev-pengemasan').disabled = currentPengemasanPage === 1;
    document.querySelector('.next-pengemasan').disabled = currentPengemasanPage === totalPages || totalPages === 0;
}

function updateIntegratedPagination() {
    const totalData = panenData.length;
    const totalPages = Math.ceil(totalData / itemsPerPage);
    document.getElementById('currentIntegratedPage').textContent = currentIntegratedPage;
    document.getElementById('totalIntegratedPages').textContent = totalPages;
    updatePageNumbers('integratedPageNumbers', currentIntegratedPage, totalPages, goToIntegratedPage);
    
    document.querySelector('.prev-integrated').disabled = currentIntegratedPage === 1;
    document.querySelector('.next-integrated').disabled = currentIntegratedPage === totalPages || totalPages === 0;
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
function goToPanenPage(page) {
    currentPanenPage = page;
    renderPanenTable();
}

function goToPengemasanPage(page) {
    currentPengemasanPage = page;
    renderPengemasanTable();
}

function goToIntegratedPage(page) {
    currentIntegratedPage = page;
    renderIntegratedTable();
}

// Showing count functions
function updatePanenShowingCount() {
    const startIndex = (currentPanenPage - 1) * itemsPerPage + 1;
    const endIndex = Math.min(startIndex + itemsPerPage - 1, filteredPanenData.length);
    const total = filteredPanenData.length;

    document.getElementById('showingPanen').textContent = total === 0 ? '0' : `${startIndex}-${endIndex}`;
    document.getElementById('totalPanenCount').textContent = total;
}

function updatePengemasanShowingCount() {
    const startIndex = (currentPengemasanPage - 1) * itemsPerPage + 1;
    const endIndex = Math.min(startIndex + itemsPerPage - 1, filteredPengemasanData.length);
    const total = filteredPengemasanData.length;

    document.getElementById('showingPengemasan').textContent = total === 0 ? '0' : `${startIndex}-${endIndex}`;
    document.getElementById('totalPengemasanCount').textContent = total;
}

// Filter functions
function filterData() {
    const periode = document.getElementById('filterPeriode').value;
    const kualitas = document.getElementById('filterKualitas').value;
    const petani = document.getElementById('filterPetani').value;
    const tanggalAwal = document.getElementById('filterTanggalAwal').value;
    const tanggalAkhir = document.getElementById('filterTanggalAkhir').value;

    // Filter panen data
    filteredPanenData = panenData.filter(item => {
        if (kualitas && item.kualitas !== kualitas) return false;
        if (petani && item.petani !== petani) return false;
        
        const itemDate = new Date(item.tanggal_panen);
        if (!applyDateFilter(itemDate, periode, tanggalAwal, tanggalAkhir)) return false;
        
        return true;
    });

    // Filter pengemasan data
    filteredPengemasanData = pengemasanData.filter(item => {
        const itemDate = new Date(item.tanggal_kemas);
        if (!applyDateFilter(itemDate, periode, tanggalAwal, tanggalAkhir)) return false;
        
        // If petani filter is applied, check if the corresponding panen matches
        if (petani) {
            const correspondingPanen = panenData.find(p => p.batch_panen === item.batch_panen);
            if (!correspondingPanen || correspondingPanen.petani !== petani) return false;
        }
        
        return true;
    });

    // Reset to first page
    currentPanenPage = 1;
    currentPengemasanPage = 1;
    currentIntegratedPage = 1;
    
    // Render all tables
    renderPanenTable();
    renderPengemasanTable();
    renderIntegratedTable();
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
    document.getElementById('filterKualitas').value = '';
    document.getElementById('filterPetani').value = '';
    document.getElementById('filterTanggalAwal').value = '';
    document.getElementById('filterTanggalAkhir').value = '';
    document.querySelector('.custom-date-group').style.display = 'none';
    
    filteredPanenData = [...panenData];
    filteredPengemasanData = [...pengemasanData];
    
    currentPanenPage = 1;
    currentPengemasanPage = 1;
    currentIntegratedPage = 1;
    
    renderPanenTable();
    renderPengemasanTable();
    renderIntegratedTable();
    updateStatistics();
}

// Modal functions
window.showDetailPanen = function(id) {
    const panen = panenData.find(item => item.id === id);
    
    if (!panen) return;

    const detailHTML = `
        <div class="detail-header">
            <div class="detail-title">
                <h3>${panen.batch_panen}</h3>
                <div class="detail-subtitle">Data Panen Jeruk</div>
            </div>
            <div style="text-align: right;">
                <span class="status-badge status-complete">${panen.status}</span>
            </div>
        </div>

        <div class="detail-grid">
            <div class="detail-card">
                <div class="detail-label">Informasi Petani</div>
                <div class="detail-value">
                    <i class="fas fa-user"></i>
                    ${panen.petani}
                </div>
                <div class="detail-subvalue">
                    <i class="fas fa-user-tie"></i>
                    ${panen.manajer} (Manajer)
                </div>
            </div>

            <div class="detail-card">
                <div class="detail-label">Detail Panen</div>
                <div class="detail-value">
                    <i class="fas fa-weight-hanging"></i>
                    ${panen.jumlah_kg.toLocaleString()} Kg
                </div>
                <div class="detail-subvalue">
                    <i class="fas fa-star"></i>
                    Kualitas ${panen.kualitas}
                </div>
            </div>

            <div class="detail-card">
                <div class="detail-label">Waktu & Lokasi</div>
                <div class="detail-value">
                    <i class="fas fa-calendar"></i>
                    ${formatDate(panen.tanggal_panen)}
                </div>
                <div class="detail-subvalue">
                    <i class="fas fa-clock"></i>
                    ${panen.waktu_panen} | ${panen.lokasi_gps}
                </div>
            </div>
        </div>

        <div style="background: var(--bg-light); padding: 20px; border-radius: var(--radius-md); margin-bottom: 20px;">
            <div style="font-weight: 600; margin-bottom: 10px; color: var(--text-dark);">
                <i class="fas fa-sticky-note"></i>
                Catatan Panen
            </div>
            <div style="color: var(--text-dark);">
                ${panen.catatan}
            </div>
        </div>

        <div style="background: var(--bg-light); padding: 20px; border-radius: var(--radius-md);">
            <div style="font-weight: 600; margin-bottom: 15px; color: var(--text-dark);">
                <i class="fas fa-info-circle"></i>
                Ringkasan Data
            </div>
            <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 15px;">
                <div style="text-align: center;">
                    <div style="font-size: 24px; font-weight: 700; color: var(--primary); margin-bottom: 5px;">
                        ${panen.jumlah_kg.toLocaleString()}
                    </div>
                    <div style="font-size: 12px; color: var(--text-light);">Total Berat</div>
                </div>
                <div style="text-align: center;">
                    <div style="font-size: 24px; font-weight: 700; color: var(--success); margin-bottom: 5px;">
                        ${panen.kualitas}
                    </div>
                    <div style="font-size: 12px; color: var(--text-light);">Kualitas</div>
                </div>
                <div style="text-align: center;">
                    <div style="font-size: 24px; font-weight: 700; color: var(--primary); margin-bottom: 5px;">
                        ${panen.tanggal_panen}
                    </div>
                    <div style="font-size: 12px; color: var(--text-light);">Tanggal</div>
                </div>
            </div>
        </div>
    `;

    document.getElementById('detailPanenBody').innerHTML = detailHTML;
    document.getElementById('detailPanenModal').style.display = 'flex';
};

window.showDetailPengemasan = function(id) {
    const pengemasan = pengemasanData.find(item => item.id === id);
    const panen = panenData.find(item => item.batch_panen === pengemasan.batch_panen);
    
    if (!pengemasan || !panen) return;

    const detailHTML = `
        <div class="detail-header">
            <div class="detail-title">
                <h3>${pengemasan.batch_pengemasan}</h3>
                <div class="detail-subtitle">Data Pengemasan Jeruk</div>
            </div>
            <div style="text-align: right;">
                <span class="status-badge ${pengemasan.status === 'Selesai' ? 'status-complete' : 
                                        pengemasan.status === 'Proses' ? 'status-partial' : 'status-pending'}">
                    ${pengemasan.status}
                </span>
            </div>
        </div>

        <div class="detail-grid">
            <div class="detail-card">
                <div class="detail-label">Sumber Panen</div>
                <div class="detail-value">
                    <i class="fas fa-seedling"></i>
                    ${pengemasan.batch_panen}
                </div>
                <div class="detail-subvalue">
                    <i class="fas fa-user"></i>
                    ${panen.petani}
                </div>
            </div>

            <div class="detail-card">
                <div class="detail-label">Detail Pengemasan</div>
                <div class="detail-value">
                    <i class="fas fa-layer-group"></i>
                    ${pengemasan.jumlah_unit} Unit
                </div>
                <div class="detail-subvalue">
                    <i class="fas fa-weight-hanging"></i>
                    ${pengemasan.berat_total.toLocaleString()} Kg
                </div>
            </div>

            <div class="detail-card">
                <div class="detail-label">Jenis & Waktu</div>
                <div class="detail-value">
                    <i class="fas fa-box"></i>
                    ${pengemasan.jenis_kemasan}
                </div>
                <div class="detail-subvalue">
                    <i class="fas fa-calendar"></i>
                    ${formatDate(pengemasan.tanggal_kemas)}
                </div>
            </div>
        </div>

        <div style="background: var(--bg-light); padding: 20px; border-radius: var(--radius-md); margin-bottom: 20px;">
            <div style="font-weight: 600; margin-bottom: 10px; color: var(--text-dark);">
                <i class="fas fa-sticky-note"></i>
                Catatan Pengemasan
            </div>
            <div style="color: var(--text-dark);">
                ${pengemasan.catatan}
            </div>
        </div>

        <div style="background: var(--bg-light); padding: 20px; border-radius: var(--radius-md); margin-bottom: 20px;">
            <div style="font-weight: 600; margin-bottom: 15px; color: var(--text-dark);">
                <i class="fas fa-calculator"></i>
                Ringkasan Kemasan
            </div>
            <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 15px;">
                <div style="text-align: center;">
                    <div style="font-size: 24px; font-weight: 700; color: var(--primary); margin-bottom: 5px;">
                        ${pengemasan.jumlah_unit}
                    </div>
                    <div style="font-size: 12px; color: var(--text-light);">Jumlah Unit</div>
                </div>
                <div style="text-align: center;">
                    <div style="font-size: 24px; font-weight: 700; color: var(--success); margin-bottom: 5px;">
                        ${pengemasan.berat_total.toLocaleString()}
                    </div>
                    <div style="font-size: 12px; color: var(--text-light);">Berat Total (Kg)</div>
                </div>
                <div style="text-align: center;">
                    <div style="font-size: 24px; font-weight: 700; color: var(--warning); margin-bottom: 5px;">
                        ${pengemasan.jenis_kemasan}
                    </div>
                    <div style="font-size: 12px; color: var(--text-light);">Jenis Kemasan</div>
                </div>
            </div>
        </div>
    `;

    document.getElementById('detailPengemasanBody').innerHTML = detailHTML;
    document.getElementById('detailPengemasanModal').style.display = 'flex';
};

window.showDetailIntegrated = function(id) {
    const panen = panenData.find(item => item.id === id);
    const pengemasan = pengemasanData.find(item => item.batch_panen === panen.batch_panen);
    
    if (!panen) return;

    const detailHTML = `
        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 25px; margin-bottom: 25px;">
            <!-- Panel Panen -->
            <div style="background: var(--bg-light); padding: 20px; border-radius: var(--radius-md);">
                <h4 style="margin: 0 0 15px 0; color: var(--text-dark); display: flex; align-items: center; gap: 8px;">
                    <i class="fas fa-seedling"></i> Data Panen
                </h4>
                <div style="display: grid; gap: 12px;">
                    <div>
                        <div style="font-size: 12px; color: var(--text-light); margin-bottom: 4px;">Batch Panen</div>
                        <div style="font-weight: 600; color: var(--text-dark);">${panen.batch_panen}</div>
                    </div>
                    <div>
                        <div style="font-size: 12px; color: var(--text-light); margin-bottom: 4px;">Tanggal Panen</div>
                        <div style="font-weight: 600; color: var(--text-dark);">${formatDate(panen.tanggal_panen)} ${panen.waktu_panen}</div>
                    </div>
                    <div>
                        <div style="font-size: 12px; color: var(--text-light); margin-bottom: 4px;">Petani</div>
                        <div style="font-weight: 600; color: var(--text-dark);">${panen.petani}</div>
                    </div>
                    <div>
                        <div style="font-size: 12px; color: var(--text-light); margin-bottom: 4px;">Kualitas</div>
                        <div style="font-weight: 600; color: var(--text-dark);">
                            <span class="quality-badge quality-${panen.kualitas}">
                                Kualitas ${panen.kualitas}
                            </span>
                        </div>
                    </div>
                    <div>
                        <div style="font-size: 12px; color: var(--text-light); margin-bottom: 4px;">Jumlah (Kg)</div>
                        <div style="font-weight: 600; color: var(--text-dark);">${panen.jumlah_kg.toLocaleString()} Kg</div>
                    </div>
                    <div>
                        <div style="font-size: 12px; color: var(--text-light); margin-bottom: 4px;">Status</div>
                        <div style="font-weight: 600; color: var(--text-dark);">
                            <span class="status-badge status-complete">${panen.status}</span>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Panel Pengemasan -->
            <div style="background: var(--bg-light); padding: 20px; border-radius: var(--radius-md);">
                <h4 style="margin: 0 0 15px 0; color: var(--text-dark); display: flex; align-items: center; gap: 8px;">
                    <i class="fas fa-box"></i> Data Pengemasan
                </h4>
                ${pengemasan ? `
                    <div style="display: grid; gap: 12px;">
                        <div>
                            <div style="font-size: 12px; color: var(--text-light); margin-bottom: 4px;">Batch Pengemasan</div>
                            <div style="font-weight: 600; color: var(--text-dark);">${pengemasan.batch_pengemasan}</div>
                        </div>
                        <div>
                            <div style="font-size: 12px; color: var(--text-light); margin-bottom: 4px;">Jenis Kemasan</div>
                            <div style="font-weight: 600; color: var(--text-dark);">
                                <span class="package-badge package-${pengemasan.jenis_kemasan}">
                                    ${pengemasan.jenis_kemasan}
                                </span>
                            </div>
                        </div>
                        <div>
                            <div style="font-size: 12px; color: var(--text-light); margin-bottom: 4px;">Jumlah Unit</div>
                            <div style="font-weight: 600; color: var(--text-dark);">${pengemasan.jumlah_unit} unit</div>
                        </div>
                        <div>
                            <div style="font-size: 12px; color: var(--text-light); margin-bottom: 4px;">Tanggal Kemas</div>
                            <div style="font-weight: 600; color: var(--text-dark);">${formatDate(pengemasan.tanggal_kemas)}</div>
                        </div>
                        <div>
                            <div style="font-size: 12px; color: var(--text-light); margin-bottom: 4px;">Berat Total</div>
                            <div style="font-weight: 600; color: var(--text-dark);">${pengemasan.berat_total.toLocaleString()} Kg</div>
                        </div>
                        <div>
                            <div style="font-size: 12px; color: var(--text-light); margin-bottom: 4px;">Status</div>
                            <div style="font-weight: 600; color: var(--text-dark);">
                                <span class="status-badge ${pengemasan.status === 'Selesai' ? 'status-complete' : 
                                                        pengemasan.status === 'Proses' ? 'status-partial' : 'status-pending'}">
                                    ${pengemasan.status}
                                </span>
                            </div>
                        </div>
                    </div>
                ` : `
                    <div style="text-align: center; padding: 20px;">
                        <i class="fas fa-box-open" style="font-size: 48px; color: var(--border-color); margin-bottom: 15px; opacity: 0.5;"></i>
                        <div style="color: var(--text-light); font-size: 14px;">
                            Data pengemasan belum tersedia
                        </div>
                        <div style="font-size: 12px; color: var(--text-light); margin-top: 5px;">
                            Panen ini belum melalui proses pengemasan
                        </div>
                    </div>
                `}
            </div>
        </div>
        
        <!-- Progress Summary -->
        <div style="background: var(--bg-light); padding: 20px; border-radius: var(--radius-md);">
            <h4 style="margin: 0 0 15px 0; color: var(--text-dark); display: flex; align-items: center; gap: 8px;">
                <i class="fas fa-chart-bar"></i> Ringkasan Progress
            </h4>
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px; align-items: center;">
                <div>
                    <div style="font-size: 13px; color: var(--text-light); margin-bottom: 5px;">Status Produksi</div>
                    <div style="font-weight: 600; color: var(--text-dark); font-size: 18px;">
                        ${pengemasan ? 'Selesai Dikemas' : 'Belum Dikemas'}
                    </div>
                </div>
                <div>
                    <div style="font-size: 13px; color: var(--text-light); margin-bottom: 5px;">Progress</div>
                    <div style="display: flex; align-items: center; gap: 15px;">
                        <div class="progress-container" style="flex: 1;">
                            <div class="progress-bar ${pengemasan ? 'progress-100' : 'progress-0'}" 
                                 style="width: ${pengemasan ? '100' : '0'}%"></div>
                        </div>
                        <span style="font-size: 16px; font-weight: 600; color: var(--text-dark); min-width: 40px;">
                            ${pengemasan ? '100' : '0'}%
                        </span>
                    </div>
                </div>
            </div>
        </div>
    `;

    document.getElementById('detailIntegratedBody').innerHTML = detailHTML;
    document.getElementById('detailIntegratedModal').style.display = 'flex';
};

window.showGrafik = function() {
    // Initialize charts
    initializeCharts();
    document.getElementById('grafikModal').style.display = 'flex';
};

function initializeCharts() {
    // Quality distribution chart
    const qualityCounts = {
        'A': filteredPanenData.filter(p => p.kualitas === 'A').length,
        'B': filteredPanenData.filter(p => p.kualitas === 'B').length,
        'C': filteredPanenData.filter(p => p.kualitas === 'C').length
    };

    const qualityCtx = document.getElementById('qualityChart').getContext('2d');
    if (window.qualityChartInstance) {
        window.qualityChartInstance.destroy();
    }
    window.qualityChartInstance = new Chart(qualityCtx, {
        type: 'pie',
        data: {
            labels: ['Kualitas A', 'Kualitas B', 'Kualitas C'],
            datasets: [{
                data: [qualityCounts.A, qualityCounts.B, qualityCounts.C],
                backgroundColor: ['#2ecc71', '#f39c12', '#e74c3c'],
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'bottom'
                }
            }
        }
    });

    // Trend chart
    const trendCtx = document.getElementById('trendChart').getContext('2d');
    if (window.trendChartInstance) {
        window.trendChartInstance.destroy();
    }
    window.trendChartInstance = new Chart(trendCtx, {
        type: 'line',
        data: {
            labels: ['Minggu 1', 'Minggu 2', 'Minggu 3', 'Minggu 4'],
            datasets: [{
                label: 'Produksi (Kg)',
                data: [1200, 1800, 1500, 2100],
                borderColor: '#3498db',
                backgroundColor: 'rgba(52, 152, 219, 0.1)',
                fill: true,
                tension: 0.4
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                y: {
                    beginAtZero: true,
                    title: {
                        display: true,
                        text: 'Berat (Kg)'
                    }
                }
            }
        }
    });

    // Farmer production chart
    const farmerCtx = document.getElementById('farmerChart').getContext('2d');
    const farmers = [...new Set(filteredPanenData.map(p => p.petani))];
    const farmerData = farmers.map(farmer => 
        filteredPanenData.filter(p => p.petani === farmer).reduce((sum, p) => sum + p.jumlah_kg, 0)
    );

    if (window.farmerChartInstance) {
        window.farmerChartInstance.destroy();
    }
    window.farmerChartInstance = new Chart(farmerCtx, {
        type: 'bar',
        data: {
            labels: farmers,
            datasets: [{
                label: 'Produksi per Petani (Kg)',
                data: farmerData,
                backgroundColor: farmers.map((_, i) => 
                    ['#2ecc71', '#3498db', '#f39c12', '#9b59b6', '#607d8b'][i % 5]
                ),
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                y: {
                    beginAtZero: true,
                    title: {
                        display: true,
                        text: 'Berat (Kg)'
                    }
                },
                x: {
                    ticks: {
                        maxRotation: 45,
                        minRotation: 45
                    }
                }
            }
        }
    });
}

// Initialize everything
document.addEventListener('DOMContentLoaded', function() {
    // Tab switching
    document.querySelectorAll('.tab-btn').forEach(btn => {
        btn.addEventListener('click', function() {
            const tab = this.getAttribute('data-tab');
            
            // Update active tab button
            document.querySelectorAll('.tab-btn').forEach(b => b.classList.remove('active'));
            this.classList.add('active');
            
            // Show corresponding tab content
            document.querySelectorAll('.tab-content').forEach(content => {
                content.classList.remove('active');
            });
            document.getElementById(`${tab}Tab`).classList.add('active');
        });
    });

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
    document.getElementById('exportPanenBtn').addEventListener('click', function() {
        alert('Fitur export data panen ke Excel akan diimplementasikan');
    });

    document.getElementById('exportPengemasanBtn').addEventListener('click', function() {
        alert('Fitur export data pengemasan ke Excel akan diimplementasikan');
    });

    // Print buttons
    document.getElementById('printPanenBtn').addEventListener('click', function() {
        alert('Fitur cetak detail panen akan diimplementasikan');
    });

    document.getElementById('printPengemasanBtn').addEventListener('click', function() {
        alert('Fitur cetak detail pengemasan akan diimplementasikan');
    });

    document.getElementById('printIntegratedBtn').addEventListener('click', function() {
        alert('Fitur cetak laporan terintegrasi akan diimplementasikan');
    });

    // Pagination buttons
    document.querySelector('.prev-panen').addEventListener('click', () => {
        if (currentPanenPage > 1) goToPanenPage(currentPanenPage - 1);
    });

    document.querySelector('.next-panen').addEventListener('click', () => {
        const totalPages = Math.ceil(filteredPanenData.length / itemsPerPage);
        if (currentPanenPage < totalPages) goToPanenPage(currentPanenPage + 1);
    });

    document.querySelector('.prev-pengemasan').addEventListener('click', () => {
        if (currentPengemasanPage > 1) goToPengemasanPage(currentPengemasanPage - 1);
    });

    document.querySelector('.next-pengemasan').addEventListener('click', () => {
        const totalPages = Math.ceil(filteredPengemasanData.length / itemsPerPage);
        if (currentPengemasanPage < totalPages) goToPengemasanPage(currentPengemasanPage + 1);
    });

    document.querySelector('.prev-integrated').addEventListener('click', () => {
        if (currentIntegratedPage > 1) goToIntegratedPage(currentIntegratedPage - 1);
    });

    document.querySelector('.next-integrated').addEventListener('click', () => {
        const totalData = panenData.length;
        const totalPages = Math.ceil(totalData / itemsPerPage);
        if (currentIntegratedPage < totalPages) goToIntegratedPage(currentIntegratedPage + 1);
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
        const modals = ['detailPanenModal', 'detailPengemasanModal', 'detailIntegratedModal', 'grafikModal'];
        modals.forEach(modalId => {
            const modal = document.getElementById(modalId);
            if (event.target === modal) {
                modal.style.display = 'none';
            }
        });
    });

    // Initialize
    renderPanenTable();
    renderPengemasanTable();
    renderIntegratedTable();
    updateStatistics();
});
</script>
@endsection