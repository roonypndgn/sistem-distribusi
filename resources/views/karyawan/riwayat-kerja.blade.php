@extends('layouts.karyawan')

@section('title', 'Riwayat Kerja - PT. Mardua Holong')

@section('page-title', 'Riwayat Kerja')
@section('page-subtitle', 'Histori Pekerjaan dan Tugas')

@section('content')
<div class="content-wrapper">
    <!-- Header -->
    <div class="content-header">
        <div class="header-left">
        </div>
        <div class="header-right">
            <button type="button" id="filterBtn" class="btn btn-secondary">
                <i class="fas fa-filter"></i> Filter
            </button>
            <button type="button" id="exportBtn" class="btn btn-primary">
                <i class="fas fa-file-export"></i> Export
            </button>
        </div>
    </div>
    
    <!-- Statistik -->
    <div class="stats-grid" style="margin-bottom: 30px;">
        <div class="stat-card">
            <div class="stat-icon" style="color: #4CAF50;">
                <i class="fas fa-tasks"></i>
            </div>
            <div class="stat-number" id="totalTugas">0</div>
            <div class="stat-label">Total Tugas</div>
        </div>
        
        <div class="stat-card">
            <div class="stat-icon" style="color: #2196F3;">
                <i class="fas fa-check-circle"></i>
            </div>
            <div class="stat-number" id="tugasSelesai">0</div>
            <div class="stat-label">Selesai</div>
        </div>
        
        <div class="stat-card">
            <div class="stat-icon" style="color: #FF9800;">
                <i class="fas fa-clock"></i>
            </div>
            <div class="stat-number" id="tugasProses">0</div>
            <div class="stat-label">Dalam Proses</div>
        </div>
        
        <div class="stat-card">
            <div class="stat-icon" style="color: #F44336;">
                <i class="fas fa-times-circle"></i>
            </div>
            <div class="stat-number" id="tugasBatal">0</div>
            <div class="stat-label">Dibatalkan</div>
        </div>
    </div>
    
    <!-- Filter Section -->
    <div id="filterSection" class="content-card" style="display: none; margin-bottom: 30px;">
        <div class="card-header">
            <div class="card-title">
                <i class="fas fa-filter"></i>
                <span>Filter Riwayat</span>
            </div>
            <button type="button" id="closeFilter" class="btn-close">
                <i class="fas fa-times"></i>
            </button>
        </div>
        
        <div class="form-grid">
            <div class="form-group">
                <label class="form-label">Status</label>
                <select id="filterStatus" class="form-control">
                    <option value="">Semua Status</option>
                    <option value="selesai">Selesai</option>
                    <option value="proses">Dalam Proses</option>
                    <option value="batal">Dibatalkan</option>
                </select>
            </div>
            
            <div class="form-group">
                <label class="form-label">Tanggal Mulai</label>
                <input type="date" id="filterStartDate" class="form-control" 
                       value="{{ date('Y-m-01') }}">
            </div>
            
            <div class="form-group">
                <label class="form-label">Tanggal Sampai</label>
                <input type="date" id="filterEndDate" class="form-control" 
                       value="{{ date('Y-m-d') }}">
            </div>
            
            <div class="form-group">
                <label class="form-label">Jenis Tugas</label>
                <select id="filterJenis" class="form-control">
                    <option value="">Semua Jenis</option>
                    <option value="panen">Panen</option>
                    <option value="pengemasan">Pengemasan</option>
                </select>
            </div>
        </div>
        
        <div class="form-actions">
            <button type="button" id="resetFilterBtn" class="btn btn-secondary">
                <i class="fas fa-redo"></i> Reset Filter
            </button>
            <button type="button" id="applyFilterBtn" class="btn btn-primary">
                <i class="fas fa-search"></i> Terapkan Filter
            </button>
        </div>
    </div>
    
    <!-- Riwayat Kerja -->
    <div class="content-card">
        <div class="card-header">
            <div class="card-title">
                <i class="fas fa-history"></i>
                <span>Daftar Riwayat Kerja</span>
            </div>
            <div class="card-info">
                <span id="filterInfo">Menampilkan semua riwayat</span>
            </div>
        </div>
        
        <!-- Tabs -->
        <div class="tabs" style="margin-bottom: 25px;">
            <button type="button" class="tab-btn active" data-view="list">
                <i class="fas fa-list"></i> List View
            </button>
            <button type="button" class="tab-btn" data-view="timeline">
                <i class="fas fa-stream"></i> Timeline
            </button>
        </div>
        
        <!-- List View -->
        <div id="listView" class="view-content">
            <div class="table-responsive">
                <table class="data-table">
                    <thead>
                        <tr>
                            <th style="width: 50px;">No</th>
                            <th>Tanggal</th>
                            <th>Jenis Tugas</th>
                            <th>Deskripsi Tugas</th>
                            <th>Lokasi</th>
                            <th>Status</th>
                            <th style="width: 120px;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="riwayatTableBody">
                        <!-- Data akan diisi oleh JavaScript -->
                    </tbody>
                </table>
            </div>
            
            <!-- Pagination -->
            <div class="table-footer">
                <div class="showing-count">
                    Menampilkan <span id="showingCount">0</span> dari <span id="totalCount">0</span> riwayat
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
        
        <!-- Timeline View -->
        <div id="timelineView" class="view-content" style="display: none;">
            <div class="timeline">
                <!-- Timeline items will be generated by JavaScript -->
            </div>
        </div>
    </div>
</div>

<!-- Modal Detail Riwayat -->
<div id="detailModal" class="modal">
    <div class="modal-content modal-lg">
        <div class="modal-header">
            <h3 class="modal-title">Detail Riwayat Kerja</h3>
            <button type="button" class="close-detail-modal">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <div class="modal-body" id="detailModalBody">
            <!-- Detail will be generated by JavaScript -->
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary close-detail-modal">
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
    
    /* Stats Grid */
    .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 15px;
        margin-bottom: 30px;
    }
    
    .stat-card {
        text-align: center;
        padding: 20px;
        background-color: white;
        border-radius: 12px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.05);
        border: 1px solid var(--border);
        transition: var(--transition);
    }
    
    .stat-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(0,0,0,0.1);
    }
    
    .stat-icon {
        font-size: 32px;
        margin-bottom: 10px;
    }
    
    .stat-number {
        font-size: 28px;
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
    
    .btn-close {
        background: none;
        border: none;
        color: var(--text-light);
        cursor: pointer;
        font-size: 16px;
        width: 36px;
        height: 36px;
        border-radius: 6px;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: var(--transition);
    }
    
    .btn-close:hover {
        background-color: var(--light);
        color: var(--text-dark);
    }
    
    /* Form Styles */
    .form-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 20px;
        margin-bottom: 25px;
    }
    
    .form-group {
        margin-bottom: 15px;
    }
    
    .form-label {
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
    
    .form-actions {
        display: flex;
        gap: 10px;
        margin-top: 20px;
    }
    
    /* Tabs */
    .tabs {
        display: flex;
        gap: 10px;
        border-bottom: 2px solid var(--border);
        padding-bottom: 5px;
    }
    
    .tab-btn {
        padding: 10px 20px;
        border: none;
        background: none;
        color: var(--text-light);
        font-size: 14px;
        font-weight: 500;
        cursor: pointer;
        border-radius: 8px 8px 0 0;
        display: flex;
        align-items: center;
        gap: 8px;
        transition: var(--transition);
    }
    
    .tab-btn:hover {
        color: var(--primary);
        background-color: var(--primary-lighter);
    }
    
    .tab-btn.active {
        color: var(--primary);
        background-color: var(--primary-lighter);
        border-bottom: 2px solid var(--primary);
    }
    
    .view-content {
        animation: fadeIn 0.5s ease;
    }
    
    @keyframes fadeIn {
        from { opacity: 0; }
        to { opacity: 1; }
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
    
    .badge-selesai {
        background-color: #E8F5E9;
        color: #2E7D32;
        border: 1px solid #C8E6C9;
    }
    
    .badge-proses {
        background-color: #E3F2FD;
        color: #1565C0;
        border: 1px solid #BBDEFB;
    }
    
    .badge-batal {
        background-color: #FFEBEE;
        color: #C62828;
        border: 1px solid #FFCDD2;
    }
    
    /* Jenis Badge */
    .jenis-badge {
        display: inline-block;
        padding: 4px 10px;
        border-radius: 6px;
        font-size: 11px;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }
    
    .badge-panen {
        background-color: #FFF3E0;
        color: #EF6C00;
    }
    
    .badge-pengemasan {
        background-color: #E8F5E9;
        color: #2E7D32;
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
    
    /* Timeline View */
    .timeline {
        position: relative;
        padding-left: 30px;
    }
    
    .timeline::before {
        content: '';
        position: absolute;
        left: 15px;
        top: 0;
        bottom: 0;
        width: 2px;
        background-color: var(--border);
    }
    
    .timeline-item {
        position: relative;
        margin-bottom: 25px;
        padding-left: 20px;
    }
    
    .timeline-item::before {
        content: '';
        position: absolute;
        left: -6px;
        top: 8px;
        width: 14px;
        height: 14px;
        border-radius: 50%;
        background-color: var(--primary);
        border: 2px solid white;
        box-shadow: 0 0 0 3px var(--primary-lighter);
    }
    
    .timeline-date {
        font-size: 12px;
        color: var(--text-light);
        margin-bottom: 5px;
        font-weight: 500;
    }
    
    .timeline-content {
        background-color: white;
        border: 1px solid var(--border);
        border-radius: 10px;
        padding: 15px;
        box-shadow: 0 2px 6px rgba(0,0,0,0.05);
    }
    
    .timeline-header {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        margin-bottom: 10px;
        flex-wrap: wrap;
        gap: 10px;
    }
    
    .timeline-title {
        font-weight: 600;
        color: var(--text-dark);
        font-size: 15px;
    }
    
    .timeline-desc {
        font-size: 14px;
        color: var(--text-light);
        margin-bottom: 10px;
        line-height: 1.5;
    }
    
    .timeline-footer {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-top: 15px;
        padding-top: 10px;
        border-top: 1px solid var(--border);
        flex-wrap: wrap;
        gap: 10px;
    }
    
    .timeline-meta {
        display: flex;
        gap: 10px;
        font-size: 12px;
        color: var(--text-light);
    }
    
    .timeline-actions {
        display: flex;
        gap: 8px;
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
        max-width: 800px;
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
    
    .close-detail-modal {
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
    
    .close-detail-modal:hover {
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
    
    /* Detail Styles */
    .detail-header {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        margin-bottom: 25px;
        padding-bottom: 15px;
        border-bottom: 1px solid var(--border);
        flex-wrap: wrap;
        gap: 15px;
    }
    
    .detail-title {
        font-size: 20px;
        font-weight: 700;
        color: var(--text-dark);
        margin-bottom: 5px;
    }
    
    .detail-subtitle {
        font-size: 14px;
        color: var(--text-light);
    }
    
    .detail-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 20px;
        margin-bottom: 25px;
    }
    
    .detail-item {
        background-color: var(--light);
        padding: 15px;
        border-radius: 8px;
    }
    
    .detail-label {
        font-size: 12px;
        color: var(--text-light);
        margin-bottom: 5px;
        font-weight: 500;
    }
    
    .detail-value {
        font-size: 15px;
        font-weight: 600;
        color: var(--text-dark);
    }
    
    .detail-section {
        margin-bottom: 25px;
    }
    
    .section-title {
        font-size: 16px;
        font-weight: 600;
        color: var(--text-dark);
        margin-bottom: 15px;
        padding-bottom: 10px;
        border-bottom: 1px solid var(--border);
        display: flex;
        align-items: center;
        gap: 10px;
    }
    
    .section-title i {
        color: var(--primary);
    }
    
    .section-content {
        font-size: 14px;
        color: var(--text-dark);
        line-height: 1.6;
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
        
        .tabs {
            width: 100%;
            overflow-x: auto;
        }
        
        .tab-btn {
            white-space: nowrap;
        }
        
        .modal-footer {
            flex-direction: column;
        }
    }
    
    @media (max-width: 576px) {
        .stats-grid {
            grid-template-columns: 1fr;
        }
        
        .form-grid {
            grid-template-columns: 1fr;
        }
        
        .form-actions {
            flex-direction: column;
        }
        
        .table-footer {
            flex-direction: column;
            align-items: stretch;
        }
        
        .pagination {
            justify-content: center;
        }
        
        .timeline-header {
            flex-direction: column;
        }
        
        .timeline-footer {
            flex-direction: column;
            align-items: flex-start;
        }
        
        .timeline-meta {
            flex-wrap: wrap;
        }
        
        .action-buttons {
            justify-content: flex-end;
            width: 100%;
        }
    }
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Data dummy riwayat kerja
    let riwayatData = [
        {
            id: 1,
            tanggal: "2024-03-28",
            jenis: "panen",
            jenis_label: "Panen",
            deskripsi: "Panen jeruk di ladang Simalungun",
            lokasi: "Ladang Simalungun, Berastagi",
            status: "selesai",
            catatan: "Panen dilakukan pagi hari dengan kondisi cuaca cerah. Hasil panen 500kg jeruk kualitas A.",
            manajer: "Tuan Pandiangan",
            durasi: "4 jam",
            waktu_mulai: "07:00",
            waktu_selesai: "11:00"
        },
        {
            id: 2,
            tanggal: "2024-03-27",
            jenis: "pengemasan",
            jenis_label: "Pengemasan",
            deskripsi: "Pengemasan jeruk untuk distribusi",
            lokasi: "Gudang Pusat",
            status: "selesai",
            catatan: "Jeruk dikemas dalam 50 kardus ukuran medium. Total 400kg jeruk siap distribusi.",
            manajer: "Tuan Silalahi",
            durasi: "3 jam",
            waktu_mulai: "08:00",
            waktu_selesai: "11:00"
        },
        {
            id: 3,
            tanggal: "2024-03-23",
            jenis: "panen",
            jenis_label: "Panen",
            deskripsi: "Panen jeruk di ladang Berastagi",
            lokasi: "Ladang Berastagi Pusat",
            status: "batal",
            catatan: "Dibatalkan karena hujan lebat. Dijadwalkan ulang untuk besok.",
            manajer: "Tuan Siregar",
            durasi: "-",
            waktu_mulai: "07:00",
            waktu_selesai: "-"
        },
        {
            id: 4,
            tanggal: "2024-03-21",
            jenis: "pengemasan",
            jenis_label: "Pengemasan",
            deskripsi: "Pengemasan jeruk ekspor",
            lokasi: "Gudang Ekspor",
            status: "selesai",
            catatan: "Jeruk dikemas khusus untuk ekspor dengan standar internasional.",
            manajer: "Pak Sinuhaji",
            durasi: "4 jam",
            waktu_mulai: "13:00",
            waktu_selesai: "17:00"
        },
        {
            id: 5,
            tanggal: "2024-03-19",
            jenis: "panen",
            jenis_label: "Panen",
            deskripsi: "Panen jeruk di ladang Parapat",
            lokasi: "Ladang Parapat",
            status: "selesai",
            catatan: "Hasil panen 350kg jeruk kualitas B. Kondisi tanaman baik.",
            manajer: "Ibu Munthe",
            durasi: "3 jam",
            waktu_mulai: "08:30",
            waktu_selesai: "11:30"
        }
    ];
    
    // Elemen DOM
    const filterSection = document.getElementById('filterSection');
    const filterBtn = document.getElementById('filterBtn');
    const closeFilterBtn = document.getElementById('closeFilter');
    const resetFilterBtn = document.getElementById('resetFilterBtn');
    const applyFilterBtn = document.getElementById('applyFilterBtn');
    const filterStatus = document.getElementById('filterStatus');
    const filterStartDate = document.getElementById('filterStartDate');
    const filterEndDate = document.getElementById('filterEndDate');
    const filterJenis = document.getElementById('filterJenis');
    const filterInfo = document.getElementById('filterInfo');
    const exportBtn = document.getElementById('exportBtn');
    
    const tabBtns = document.querySelectorAll('.tab-btn');
    const listView = document.getElementById('listView');
    const timelineView = document.getElementById('timelineView');
    const riwayatTableBody = document.getElementById('riwayatTableBody');
    const timelineContainer = document.querySelector('.timeline');
    
    const totalTugasSpan = document.getElementById('totalTugas');
    const tugasSelesaiSpan = document.getElementById('tugasSelesai');
    const tugasProsesSpan = document.getElementById('tugasProses');
    const tugasBatalSpan = document.getElementById('tugasBatal');
    
    const detailModal = document.getElementById('detailModal');
    const detailModalBody = document.getElementById('detailModalBody');
    
    // State
    let currentPage = 1;
    const itemsPerPage = 5;
    let currentFilter = {
        status: '',
        startDate: '',
        endDate: '',
        jenis: ''
    };
    
    // Initialize
    updateStatistics();
    loadRiwayatTable();
    
    // Toggle filter section
    filterBtn.addEventListener('click', function() {
        filterSection.style.display = filterSection.style.display === 'none' ? 'block' : 'none';
    });
    
    closeFilterBtn.addEventListener('click', function() {
        filterSection.style.display = 'none';
    });
    
    // Reset filter
    resetFilterBtn.addEventListener('click', function() {
        filterStatus.value = '';
        filterStartDate.value = '{{ date('Y-m-01') }}';
        filterEndDate.value = '{{ date('Y-m-d') }}';
        filterJenis.value = '';
        
        currentFilter = {
            status: '',
            startDate: '',
            endDate: '',
            jenis: ''
        };
        
        filterInfo.textContent = 'Menampilkan semua riwayat';
        currentPage = 1;
        loadRiwayatTable();
        updateStatistics();
        filterSection.style.display = 'none';
    });
    
    // Apply filter
    applyFilterBtn.addEventListener('click', function() {
        currentFilter = {
            status: filterStatus.value,
            startDate: filterStartDate.value,
            endDate: filterEndDate.value,
            jenis: filterJenis.value
        };
        
        // Update filter info
        let filterText = [];
        if (currentFilter.status) filterText.push(`Status: ${getStatusLabel(currentFilter.status)}`);
        if (currentFilter.jenis) filterText.push(`Jenis: ${getJenisLabel(currentFilter.jenis)}`);
        if (currentFilter.startDate && currentFilter.endDate) {
            filterText.push(`Tanggal: ${formatDate(currentFilter.startDate)} - ${formatDate(currentFilter.endDate)}`);
        }
        
        filterInfo.textContent = filterText.length > 0 ? 
            `Filter: ${filterText.join(', ')}` : 
            'Menampilkan semua riwayat';
        
        currentPage = 1;
        loadRiwayatTable();
        updateStatistics();
        filterSection.style.display = 'none';
    });
    
    // Tab switching
    tabBtns.forEach(btn => {
        btn.addEventListener('click', function() {
            // Remove active class from all tabs
            tabBtns.forEach(t => t.classList.remove('active'));
            // Add active class to clicked tab
            this.classList.add('active');
            
            const view = this.getAttribute('data-view');
            
            // Hide all views
            listView.style.display = 'none';
            timelineView.style.display = 'none';
            
            // Show selected view
            if (view === 'list') {
                listView.style.display = 'block';
            } else {
                timelineView.style.display = 'block';
                loadTimelineView();
            }
        });
    });
    
    // Export button
    exportBtn.addEventListener('click', function() {
        this.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Exporting...';
        
        setTimeout(() => {
            const filteredData = filterData(riwayatData);
            const exportData = filteredData.map(riwayat => ({
                Tanggal: formatDate(riwayat.tanggal),
                'Jenis Tugas': riwayat.jenis_label,
                'Deskripsi': riwayat.deskripsi,
                'Lokasi': riwayat.lokasi,
                'Status': getStatusLabel(riwayat.status),
                'Supervisor': riwayat.supervisor,
                'Durasi': riwayat.durasi
            }));
            
            const dataStr = JSON.stringify(exportData, null, 2);
            const dataBlob = new Blob([dataStr], { type: 'application/json' });
            
            const link = document.createElement('a');
            link.href = URL.createObjectURL(dataBlob);
            link.download = `riwayat-kerja-${new Date().toISOString().split('T')[0]}.json`;
            link.click();
            
            this.innerHTML = '<i class="fas fa-file-export"></i> Export';
            showNotification('Data berhasil diexport!', 'success');
        }, 1000);
    });
    
    // Update statistics
    function updateStatistics() {
        const filteredData = filterData(riwayatData);
        
        totalTugasSpan.textContent = filteredData.length;
        tugasSelesaiSpan.textContent = filteredData.filter(r => r.status === 'selesai').length;
        tugasProsesSpan.textContent = filteredData.filter(r => r.status === 'proses').length;
        tugasBatalSpan.textContent = filteredData.filter(r => r.status === 'batal').length;
    }
    
    // Filter data
    function filterData(data) {
        return data.filter(item => {
            // Filter status
            if (currentFilter.status && item.status !== currentFilter.status) return false;
            
            // Filter jenis
            if (currentFilter.jenis && item.jenis !== currentFilter.jenis) return false;
            
            // Filter tanggal
            if (currentFilter.startDate && currentFilter.endDate) {
                const itemDate = new Date(item.tanggal);
                const startDate = new Date(currentFilter.startDate);
                const endDate = new Date(currentFilter.endDate);
                
                if (itemDate < startDate || itemDate > endDate) return false;
            }
            
            return true;
        });
    }
    
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
                    <td colspan="7" style="text-align: center; padding: 40px; color: var(--text-light);">
                        <i class="fas fa-history" style="font-size: 40px; margin-bottom: 10px; opacity: 0.5; display: block;"></i>
                        <div>Tidak ada data riwayat kerja</div>
                    </td>
                </tr>
            `;
        } else {
            pageData.forEach((riwayat, index) => {
                const globalIndex = startIndex + index + 1;
                const row = document.createElement('tr');
                
                // Format tanggal
                const formattedDate = formatDate(riwayat.tanggal);
                
                // Get badge classes
                const jenisBadgeClass = `badge-${riwayat.jenis}`;
                const statusBadgeClass = `badge-${riwayat.status}`;
                
                row.innerHTML = `
                    <td style="color: var(--text-light);">${globalIndex}</td>
                    <td style="font-weight: 600; color: var(--text-dark);">
                        ${formattedDate}
                    </td>
                    <td>
                        <span class="jenis-badge ${jenisBadgeClass}">
                            ${riwayat.jenis_label}
                        </span>
                    </td>
                    <td>
                        <div style="font-weight: 500; color: var(--text-dark); margin-bottom: 2px;">
                            ${riwayat.deskripsi}
                        </div>
                        <div style="font-size: 12px; color: var(--text-light);">
                            ${riwayat.waktu_mulai} - ${riwayat.waktu_selesai} (${riwayat.durasi})
                        </div>
                    </td>
                    <td style="font-size: 13px; color: var(--text-light);">
                        ${riwayat.lokasi}
                    </td>
                    <td>
                        <span class="status-badge ${statusBadgeClass}">
                            ${getStatusLabel(riwayat.status)}
                        </span>
                    </td>
                    <td>
                        <div class="action-buttons">
                            <button type="button" class="btn-action btn-view" data-id="${riwayat.id}" title="Lihat Detail">
                                <i class="fas fa-eye"></i>
                            </button>
                        </div>
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
    
    // Load timeline view
    function loadTimelineView() {
        timelineContainer.innerHTML = '';
        
        const filteredData = filterData(riwayatData);
        
        if (filteredData.length === 0) {
            timelineContainer.innerHTML = `
                <div style="text-align: center; padding: 40px; color: var(--text-light);">
                    <i class="fas fa-history" style="font-size: 40px; margin-bottom: 10px; opacity: 0.5; display: block;"></i>
                    <div>Tidak ada data riwayat kerja</div>
                </div>
            `;
            return;
        }
        
        // Sort by date descending
        const sortedData = [...filteredData].sort((a, b) => 
            new Date(b.tanggal) - new Date(a.tanggal)
        );
        
        // Group by date
        const groupedByDate = {};
        sortedData.forEach(item => {
            if (!groupedByDate[item.tanggal]) {
                groupedByDate[item.tanggal] = [];
            }
            groupedByDate[item.tanggal].push(item);
        });
        
        // Create timeline items
        Object.keys(groupedByDate).forEach(date => {
            const dateItems = groupedByDate[date];
            
            const timelineItem = document.createElement('div');
            timelineItem.className = 'timeline-item';
            
            timelineItem.innerHTML = `
                <div class="timeline-date">${formatDate(date)}</div>
                ${dateItems.map(item => `
                    <div class="timeline-content" style="margin-bottom: 15px;">
                        <div class="timeline-header">
                            <div class="timeline-title">${item.deskripsi}</div>
                            <div style="display: flex; gap: 8px;">
                                <span class="jenis-badge badge-${item.jenis}">
                                    ${item.jenis_label}
                                </span>
                                <span class="status-badge badge-${item.status}">
                                    ${getStatusLabel(item.status)}
                                </span>
                            </div>
                        </div>
                        <div class="timeline-desc">
                            ${item.catatan.substring(0, 100)}${item.catatan.length > 100 ? '...' : ''}
                        </div>
                        <div class="timeline-footer">
                            <div class="timeline-meta">
                                <span><i class="fas fa-map-marker-alt"></i> ${item.lokasi}</span>
                                <span><i class="fas fa-clock"></i> ${item.waktu_mulai} - ${item.waktu_selesai}</span>
                                <span><i class="fas fa-user-tie"></i> ${item.supervisor}</span>
                            </div>
                            <div class="timeline-actions">
                                <button type="button" class="btn-action btn-view" data-id="${item.id}" title="Lihat Detail">
                                    <i class="fas fa-eye"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                `).join('')}
            `;
            
            timelineContainer.appendChild(timelineItem);
        });
        
        // Add event listeners for view buttons
        addActionListeners();
    }
    
    // Update pagination
    function updatePagination(totalItems) {
        const totalPages = Math.ceil(totalItems / itemsPerPage);
        const pageNumbers = document.getElementById('pageNumbers');
        pageNumbers.innerHTML = '';
        
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
                const riwayat = riwayatData.find(r => r.id === riwayatId);
                if (riwayat) {
                    showDetailModal(riwayat);
                }
            });
        });
    }
    
    // Show detail modal
    function showDetailModal(riwayat) {
        const formattedDate = formatDate(riwayat.tanggal);
        const jenisBadgeClass = `badge-${riwayat.jenis}`;
        const statusBadgeClass = `badge-${riwayat.status}`;
        
        detailModalBody.innerHTML = `
            <div class="detail-header">
                <div>
                    <h2 class="detail-title">${riwayat.deskripsi}</h2>
                    <div class="detail-subtitle">${riwayat.lokasi}</div>
                </div>
                <div style="display: flex; gap: 10px;">
                    <span class="jenis-badge ${jenisBadgeClass}">
                        ${riwayat.jenis_label}
                    </span>
                    <span class="status-badge ${statusBadgeClass}">
                        ${getStatusLabel(riwayat.status)}
                    </span>
                </div>
            </div>
            
            <div class="detail-grid">
                <div class="detail-item">
                    <div class="detail-label">Tanggal Kerja</div>
                    <div class="detail-value">${formattedDate}</div>
                </div>
                
                <div class="detail-item">
                    <div class="detail-label">Waktu</div>
                    <div class="detail-value">${riwayat.waktu_mulai} - ${riwayat.waktu_selesai}</div>
                </div>
                
                <div class="detail-item">
                    <div class="detail-label">Durasi</div>
                    <div class="detail-value">${riwayat.durasi}</div>
                </div>
                
                <div class="detail-item">
                    <div class="detail-label">Supervisor</div>
                    <div class="detail-value">${riwayat.manajer}</div>
                </div>
            </div>
            
            <div class="detail-section">
                <div class="section-title">
                    <i class="fas fa-file-alt"></i>
                    <span>Catatan Pekerjaan</span>
                </div>
                <div class="section-content">
                    ${riwayat.catatan || 'Tidak ada catatan tambahan.'}
                </div>
            </div>
            
            <div class="detail-section">
                <div class="section-title">
                    <i class="fas fa-map-marker-alt"></i>
                    <span>Lokasi</span>
                </div>
                <div class="section-content">
                    <div style="margin-bottom: 10px;">
                        <strong>Lokasi:</strong> ${riwayat.lokasi}
                    </div>
                    <div style="height: 200px; background-color: var(--light); border-radius: 8px; display: flex; align-items: center; justify-content: center; color: var(--text-light);">
                        <i class="fas fa-map" style="font-size: 32px; margin-right: 10px;"></i>
                        <span>Peta lokasi tidak tersedia</span>
                    </div>
                </div>
            </div>
        `;
        
        detailModal.style.display = 'flex';
        document.body.style.overflow = 'hidden';
    }
    
    // Close detail modal
    document.querySelector('.close-detail-modal').addEventListener('click', function() {
        detailModal.style.display = 'none';
        document.body.style.overflow = 'auto';
    });
    
    document.querySelector('.modal-footer .close-detail-modal').addEventListener('click', function() {
        detailModal.style.display = 'none';
        document.body.style.overflow = 'auto';
    });
    
    detailModal.addEventListener('click', function(e) {
        if (e.target === detailModal) {
            detailModal.style.display = 'none';
            document.body.style.overflow = 'auto';
        }
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
    function formatDate(dateString) {
        const date = new Date(dateString);
        return date.toLocaleDateString('id-ID', {
            weekday: 'long',
            day: 'numeric',
            month: 'long',
            year: 'numeric'
        });
    }
    
    function getStatusLabel(status) {
        switch(status) {
            case 'selesai': return 'Selesai';
            case 'proses': return 'Dalam Proses';
            case 'batal': return 'Dibatalkan';
            default: return status;
        }
    }
    
    function getJenisLabel(jenis) {
        switch(jenis) {
            case 'panen': return 'Panen';
            case 'pengemasan': return 'Pengemasan';
            default: return jenis;
        }
    }
    
    function showNotification(message, type = 'success') {
        // Create notification element
        const notification = document.createElement('div');
        notification.className = `alert alert-${type}`;
        notification.style.position = 'fixed';
        notification.style.top = '20px';
        notification.style.right = '20px';
        notification.style.zIndex = '9999';
        notification.innerHTML = `
            <i class="fas fa-${type === 'success' ? 'check' : 'exclamation'}-circle"></i>
            <span>${message}</span>
        `;
        
        document.body.appendChild(notification);
        
        // Remove after 3 seconds
        setTimeout(() => {
            notification.remove();
        }, 3000);
    }
});
</script>
@endsection