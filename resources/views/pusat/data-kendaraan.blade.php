{{-- resources/views/admin/kendaraan/index.blade.php --}}
@extends('layouts.pusat')

@section('title', 'Data Kendaraan - PT. Mardua Holong')

@section('page-title', 'Data Kendaraan')
@section('page-subtitle', 'Kelola data armada kendaraan perusahaan')

@section('content')
<div class="content-wrapper">
    <!-- Header -->
    <div class="content-header">
        <div class="header-left">
            <h1>Data Kendaraan</h1>
            <p>Kelola data armada kendaraan perusahaan</p>
        </div>
        <div class="header-right">
            <button type="button" id="tambahKendaraanBtn" class="btn btn-primary">
                <i class="fas fa-plus"></i> Tambah Kendaraan
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
                <div class="stat-label">Total Kendaraan</div>
                <div class="stat-value" id="totalKendaraan">0</div>
                <div class="stat-change">Semua armada</div>
            </div>
        </div>
        
        <div class="stat-card stat-card-success">
            <div class="stat-icon">
                <i class="fas fa-check-circle"></i>
            </div>
            <div class="stat-info">
                <div class="stat-label">Tersedia</div>
                <div class="stat-value" id="tersediaCount">0</div>
                <div class="stat-change positive">Siap digunakan</div>
            </div>
        </div>
        
        <div class="stat-card stat-card-warning">
            <div class="stat-icon">
                <i class="fas fa-tools"></i>
            </div>
            <div class="stat-info">
                <div class="stat-label">Perbaikan</div>
                <div class="stat-value" id="perbaikanCount">0</div>
                <div class="stat-change negative">Sedang diperbaiki</div>
            </div>
        </div>
        
        <div class="stat-card stat-card-info">
            <div class="stat-icon">
                <i class="fas fa-weight-hanging"></i>
            </div>
            <div class="stat-info">
                <div class="stat-label">Total Kapasitas</div>
                <div class="stat-value" id="totalKapasitas">0</div>
                <div class="stat-change">Ton</div>
            </div>
        </div>
    </div>
    
    <!-- Filter dan Pencarian -->
    <div class="content-card" style="margin-bottom: 30px;">
        <div class="card-header">
            <div class="card-title">
                <i class="fas fa-filter"></i>
                <span>Filter Data Kendaraan</span>
            </div>
            <div class="card-actions">
                <div class="search-box">
                    <i class="fas fa-search"></i>
                    <input type="text" id="searchKendaraan" placeholder="Cari plat nomor atau jenis kendaraan...">
                </div>
            </div>
        </div>
        
        <div class="filter-options">
            <div class="filter-group">
                <label class="filter-label">Status Kendaraan</label>
                <select id="filterStatus" class="form-control">
                    <option value="">Semua Status</option>
                    <option value="tersedia">Tersedia</option>
                    <option value="dipakai">Dipakai</option>
                    <option value="perbaikan">Perbaikan</option>
                </select>
            </div>
            
            <div class="filter-group">
                <label class="filter-label">Jenis Kendaraan</label>
                <select id="filterJenis" class="form-control">
                    <option value="">Semua Jenis</option>
                    <option value="Truk Box">Truk Box</option>
                    <option value="Truk Box Besar">Truk Box Besar</option>
                    <option value="Pickup">Pickup</option>
                    <option value="Truk Fuso">Truk Fuso</option>
                    <option value="Truk Tronton">Truk Tronton</option>
                </select>
            </div>
            
            <div class="filter-group">
                <label class="filter-label">Kapasitas</label>
                <select id="filterKapasitas" class="form-control">
                    <option value="">Semua Kapasitas</option>
                    <option value="0-2000">≤ 2 Ton</option>
                    <option value="2001-5000">2 - 5 Ton</option>
                    <option value="5001-10000">5 - 10 Ton</option>
                    <option value="10001-99999">> 10 Ton</option>
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
    
    <!-- Daftar Kendaraan -->
    <div class="content-card">
        <div class="card-header">
            <div class="card-title">
                <i class="fas fa-truck"></i>
                <span>Daftar Kendaraan</span>
            </div>
            <div class="card-info">
                Menampilkan <span id="showingCount">0</span> dari <span id="totalCount">0</span> kendaraan
            </div>
        </div>
        
        <div class="table-responsive">
            <table class="data-table">
                <thead>
                    <tr>
                        <th style="width: 50px;">No</th>
                        <th>Plat Nomor</th>
                        <th>Jenis Kendaraan</th>
                        <th>Kapasitas</th>
                        <th>Status</th>
                        <th>Tanggal Input</th>
                        <th style="width: 150px;">Aksi</th>
                    </tr>
                </thead>
                <tbody id="kendaraanTableBody">
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

<!-- Modal Tambah Kendaraan -->
<div id="tambahModal" class="modal">
    <div class="modal-content">
        <div class="modal-header">
            <h3 class="modal-title">Tambah Kendaraan Baru</h3>
            <button type="button" class="close-modal">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <form id="tambahKendaraanForm">
            <div class="modal-body">
                <div class="form-group">
                    <label class="form-label required">Plat Nomor</label>
                    <input type="text" id="plat_nomor" name="plat_nomor" class="form-control" 
                           placeholder="Contoh: B 1234 ABC" maxlength="15" required>
                    <div class="form-hint">
                        Format: Huruf daerah + angka + kombinasi huruf
                    </div>
                </div>
                
                <div class="form-group">
                    <label class="form-label required">Jenis Kendaraan</label>
                    <select id="jenis_kendaraan" name="jenis_kendaraan" class="form-control" required>
                        <option value="">Pilih Jenis Kendaraan</option>
                        <option value="Truk Box">Truk Box</option>
                        <option value="Truk Box Besar">Truk Box Besar</option>
                        <option value="Pickup">Pickup</option>
                        <option value="Truk Fuso">Truk Fuso</option>
                        <option value="Truk Tronton">Truk Tronton</option>
                        <option value="Truk Engkel">Truk Engkel</option>
                        <option value="Minibus">Minibus</option>
                        <option value="Lainnya">Lainnya</option>
                    </select>
                    <div class="form-hint">
                        Pilih jenis kendaraan sesuai kapasitas
                    </div>
                </div>
                
                <div class="form-group">
                    <label class="form-label required">Kapasitas (kg)</label>
                    <div class="input-group">
                        <input type="number" id="kapasitas_kg" name="kapasitas_kg" class="form-control" 
                               placeholder="Contoh: 8000" min="100" max="50000" step="100" required>
                        <span class="input-group-text">kg</span>
                    </div>
                    <div class="form-hint">
                        Kapasitas maksimal dalam kilogram (1 ton = 1000 kg)
                    </div>
                </div>
                
                <div class="form-group">
                    <label class="form-label">Catatan</label>
                    <textarea id="catatan" name="catatan" class="form-control" rows="3" 
                              placeholder="Tambahkan catatan jika diperlukan..."></textarea>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary close-modal">
                    Batal
                </button>
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i> Simpan
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Modal Edit Kendaraan -->
<div id="editModal" class="modal">
    <div class="modal-content">
        <div class="modal-header">
            <h3 class="modal-title">Edit Data Kendaraan</h3>
            <button type="button" class="close-edit-modal">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <form id="editKendaraanForm">
            <input type="hidden" id="edit_id" name="id">
            <div class="modal-body">
                <div class="form-group">
                    <label class="form-label required">Plat Nomor</label>
                    <input type="text" id="edit_plat_nomor" name="plat_nomor" class="form-control" 
                           placeholder="Contoh: B 1234 ABC" maxlength="15" required>
                    <div class="form-hint">
                        Plat nomor tidak dapat diubah setelah disimpan
                    </div>
                </div>
                
                <div class="form-group">
                    <label class="form-label required">Jenis Kendaraan</label>
                    <select id="edit_jenis_kendaraan" name="jenis_kendaraan" class="form-control" required>
                        <option value="">Pilih Jenis Kendaraan</option>
                        <option value="Truk Box">Truk Box</option>
                        <option value="Truk Box Besar">Truk Box Besar</option>
                        <option value="Pickup">Pickup</option>
                        <option value="Truk Fuso">Truk Fuso</option>
                        <option value="Truk Tronton">Truk Tronton</option>
                        <option value="Truk Engkel">Truk Engkel</option>
                        <option value="Minibus">Minibus</option>
                        <option value="Lainnya">Lainnya</option>
                    </select>
                </div>
                
                <div class="form-group">
                    <label class="form-label required">Kapasitas (kg)</label>
                    <div class="input-group">
                        <input type="number" id="edit_kapasitas_kg" name="kapasitas_kg" class="form-control" 
                               placeholder="Contoh: 8000" min="100" max="50000" step="100" required>
                        <span class="input-group-text">kg</span>
                    </div>
                    <div class="form-hint">
                        1 ton = 1000 kg
                    </div>
                </div>
                
                <div class="form-group">
                    <label class="form-label">Status Kendaraan</label>
                    <select id="edit_status" name="status" class="form-control">
                        <option value="tersedia">Tersedia</option>
                        <option value="dipakai">Dipakai</option>
                        <option value="perbaikan">Perbaikan</option>
                        <option value="nonaktif">Nonaktif</option>
                    </select>
                </div>
                
                <div class="form-group">
                    <label class="form-label">Catatan</label>
                    <textarea id="edit_catatan" name="catatan" class="form-control" rows="3" 
                              placeholder="Tambahkan catatan jika diperlukan..."></textarea>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary close-edit-modal">
                    Batal
                </button>
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i> Update
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Modal Detail Kendaraan -->
<div id="detailModal" class="modal">
    <div class="modal-content">
        <div class="modal-header">
            <h3 class="modal-title">Detail Kendaraan</h3>
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
            <button type="button" class="btn btn-primary" id="editFromDetailBtn">
                <i class="fas fa-edit"></i> Edit
            </button>
        </div>
    </div>
</div>

<!-- Modal Hapus Kendaraan -->
<div id="hapusModal" class="modal">
    <div class="modal-content modal-sm">
        <div class="modal-header">
            <h3 class="modal-title">Konfirmasi Hapus</h3>
            <button type="button" class="close-hapus-modal">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <div class="modal-body">
            <div class="text-center">
                <i class="fas fa-exclamation-triangle fa-3x text-warning mb-3"></i>
                <h5 class="mb-2">Hapus Data Kendaraan?</h5>
                <p class="text-muted" id="hapusKendaraanInfo">Data akan dihapus secara permanen</p>
            </div>
        </div>
        <div class="modal-footer justify-content-center">
            <button type="button" class="btn btn-secondary close-hapus-modal">
                Batal
            </button>
            <button type="button" class="btn btn-danger" id="confirmHapusBtn">
                <i class="fas fa-trash"></i> Hapus
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
    
    .header-right .btn {
        padding: 10px 24px;
        font-size: 14px;
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
    
    /* Search Box */
    .search-box {
        position: relative;
        width: 300px;
    }
    
    .search-box i {
        position: absolute;
        left: 12px;
        top: 50%;
        transform: translateY(-50%);
        color: var(--text-light);
        font-size: 14px;
    }
    
    .search-box input {
        width: 100%;
        padding: 10px 10px 10px 36px;
        border: 1px solid var(--border);
        border-radius: 8px;
        font-size: 14px;
        transition: var(--transition);
    }
    
    .search-box input:focus {
        outline: none;
        border-color: var(--primary);
        box-shadow: 0 0 0 3px rgba(45, 106, 79, 0.1);
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
    
    .form-control:disabled {
        background-color: var(--light);
        cursor: not-allowed;
    }
    
    /* Input Group */
    .input-group {
        display: flex;
    }
    
    .input-group .form-control {
        border-top-right-radius: 0;
        border-bottom-right-radius: 0;
        border-right: none;
    }
    
    .input-group .input-group-text {
        padding: 12px 15px;
        background-color: var(--light);
        border: 1px solid var(--border);
        border-left: none;
        border-top-right-radius: 8px;
        border-bottom-right-radius: 8px;
        color: var(--text-light);
        font-size: 14px;
    }
    
    /* Form Required Label */
    .form-label.required::after {
        content: '*';
        color: var(--danger);
        margin-left: 4px;
    }
    
    .form-hint {
        font-size: 12px;
        color: var(--text-light);
        margin-top: 6px;
    }
    
    /* ==============================
       TABLE STYLES
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
    
    /* Vehicle Badge */
    .vehicle-badge {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 6px 10px;
        border-radius: 6px;
        font-size: 12px;
        font-weight: 600;
    }
    
    .vehicle-badge.truk {
        background-color: var(--primary-lighter);
        color: var(--primary-dark);
    }
    
    .vehicle-badge.pickup {
        background-color: #E3F2FD;
        color: #1565C0;
    }
    
    .vehicle-badge.minibus {
        background-color: #FFF3E0;
        color: #EF6C00;
    }
    
    /* Capacity Badge */
    .capacity-badge {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 6px 10px;
        border-radius: 6px;
        font-size: 12px;
        font-weight: 600;
        background-color: #E8F5E9;
        color: #2E7D32;
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
    
    .badge-tersedia {
        background-color: #E8F5E9;
        color: #2E7D32;
        border: 1px solid #C8E6C9;
    }
    
    .badge-dipakai {
        background-color: #E3F2FD;
        color: #1565C0;
        border: 1px solid #BBDEFB;
    }
    
    .badge-perbaikan {
        background-color: #FFF3E0;
        color: #EF6C00;
        border: 1px solid #FFE0B2;
    }
    
    .badge-nonaktif {
        background-color: #F5F5F5;
        color: #757575;
        border: 1px solid #E0E0E0;
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
    
    .showing-count span {
        font-weight: 600;
        color: var(--text-dark);
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
    
    .btn-edit {
        background-color: #FFF3E0;
        color: #EF6C00;
    }
    
    .btn-edit:hover {
        background-color: #EF6C00;
        color: white;
    }
    
    .btn-delete {
        background-color: #FFEBEE;
        color: #C62828;
    }
    
    .btn-delete:hover {
        background-color: #C62828;
        color: white;
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
        max-width: 600px;
        max-height: 90vh;
        overflow-y: auto;
        animation: modalFadeIn 0.3s ease;
    }
    
    .modal-sm {
        max-width: 400px;
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
    
    .close-modal,
    .close-edit-modal,
    .close-detail-modal,
    .close-hapus-modal {
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
    
    .close-modal:hover,
    .close-edit-modal:hover,
    .close-detail-modal:hover,
    .close-hapus-modal:hover {
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
    
    /* Form Groups in Modal */
    .modal .form-group {
        margin-bottom: 20px;
    }
    
    .modal .form-label {
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
    
    /* ==============================
       DETAIL MODAL STYLES
       ============================== */
    .detail-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 20px;
        margin-bottom: 25px;
    }
    
    .detail-item {
        padding: 15px;
        background: var(--light);
        border-radius: 8px;
        border-left: 4px solid var(--primary);
    }
    
    .detail-label {
        font-size: 12px;
        color: var(--text-light);
        margin-bottom: 5px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }
    
    .detail-value {
        font-size: 16px;
        font-weight: 600;
        color: var(--text-dark);
    }
    
    .detail-subvalue {
        font-size: 14px;
        color: var(--text-light);
        margin-top: 3px;
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
    
    .btn-primary:disabled {
        opacity: 0.6;
        cursor: not-allowed;
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
    
    .btn-danger {
        background-color: var(--danger);
        color: white;
    }
    
    .btn-danger:hover {
        background-color: #C82333;
    }
    
    /* ==============================
       EMPTY STATE STYLES
       ============================== */
    .empty-state {
        text-align: center;
        padding: 60px 20px;
    }
    
    .empty-state-icon {
        font-size: 64px;
        color: var(--text-light);
        opacity: 0.3;
        margin-bottom: 20px;
    }
    
    .empty-state-title {
        font-size: 18px;
        font-weight: 600;
        color: var(--text-dark);
        margin-bottom: 10px;
    }
    
    .empty-state-description {
        color: var(--text-light);
        font-size: 14px;
        margin-bottom: 25px;
        max-width: 400px;
        margin-left: auto;
        margin-right: auto;
    }
    
    /* ==============================
       FORM VALIDATION STYLES
       ============================== */
    .is-invalid {
        border-color: var(--danger) !important;
    }
    
    .invalid-feedback {
        color: var(--danger);
        font-size: 12px;
        margin-top: 6px;
    }
    
    .is-valid {
        border-color: var(--success) !important;
    }
    
    /* ==============================
       LOADING STATES
       ============================== */
    .btn-loading {
        position: relative;
        color: transparent !important;
    }
    
    .btn-loading::after {
        content: '';
        position: absolute;
        top: 50%;
        left: 50%;
        width: 16px;
        height: 16px;
        margin-top: -8px;
        margin-left: -8px;
        border: 2px solid rgba(255, 255, 255, 0.3);
        border-top-color: white;
        border-radius: 50%;
        animation: spin 0.8s linear infinite;
    }
    
    @keyframes spin {
        to { transform: rotate(360deg); }
    }
    
    /* ==============================
       RESPONSIVE STYLES
       ============================== */
    @media (max-width: 1200px) {
        .dashboard-stats {
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
        }
        
        .header-right .btn {
            width: 100%;
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
        
        .search-box {
            width: 100%;
        }
        
        .table-footer {
            flex-direction: column;
            align-items: stretch;
        }
        
        .pagination {
            justify-content: center;
        }
        
        .action-buttons {
            flex-direction: row;
            justify-content: center;
        }
        
        .detail-grid {
            grid-template-columns: 1fr;
        }
        
        .modal-content {
            padding: 10px;
        }
    }
    
    @media (max-width: 576px) {
        .modal-content {
            padding: 0;
        }
        
        .btn-action {
            width: 36px;
            height: 36px;
            font-size: 16px;
        }
        
        .btn {
            padding: 12px 16px;
            font-size: 13px;
        }
    }
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Data dummy untuk kendaraan
    let kendaraanData = [
        {
            id: 1,
            plat_nomor: "BK 1234 ABC",
            jenis_kendaraan: "Truk Box",
            kapasitas_kg: 8000,
            status: "tersedia",
            catatan: "Kondisi baik, baru servis bulan lalu",
            created_at: "2024-02-15",
            updated_at: "2024-03-10"
        },
        {
            id: 2,
            plat_nomor: "BK 5678 XYZ",
            jenis_kendaraan: "Pickup",
            kapasitas_kg: 2000,
            status: "dipakai",
            catatan: "Sedang digunakan pengiriman ke Bandung",
            created_at: "2024-01-20",
            updated_at: "2024-03-15"
        },
        {
            id: 3,
            plat_nomor: "BB 9012 DEF",
            jenis_kendaraan: "Truk Box Besar",
            kapasitas_kg: 12000,
            status: "perbaikan",
            catatan: "Mesin overheating, sedang diperbaiki di bengkel",
            created_at: "2024-03-01",
            updated_at: "2024-03-14"
        },
        {
            id: 4,
            plat_nomor: "BK 3456 GHI",
            jenis_kendaraan: "Truk Fuso",
            kapasitas_kg: 15000,
            status: "tersedia",
            catatan: "",
            created_at: "2024-02-28",
            updated_at: "2024-03-12"
        },
        {
            id: 5,
            plat_nomor: "BB 7890 JKL",
            jenis_kendaraan: "Truk Tronton",
            kapasitas_kg: 22000,
            status: "tersedia",
            catatan: "Untuk pengiriman jarak jauh",
            created_at: "2024-02-10",
            updated_at: "2024-02-10"
        },
        {
            id: 6,
            plat_nomor: "BK 1122 MNO",
            jenis_kendaraan: "Pickup",
            kapasitas_kg: 1500,
            status: "dipakai",
            catatan: "Pengiriman dalam kota",
            created_at: "2024-03-05",
            updated_at: "2024-03-15"
        },
        {
            id: 7,
            plat_nomor: "BK 3344 PQR",
            jenis_kendaraan: "Truk Box",
            kapasitas_kg: 6000,
            status: "tersedia",
            catatan: "Kondisi sangat baik",
            created_at: "2024-02-18",
            updated_at: "2024-03-13"
        },
        {
            id: 8,
            plat_nomor: "BK 5566 STU",
            jenis_kendaraan: "Minibus",
            kapasitas_kg: 1000,
            status: "nonaktif",
            catatan: "Masa pajak habis, sedang perpanjang",
            created_at: "2024-01-15",
            updated_at: "2024-03-01"
        }
    ];

    // Elemen DOM
    const tambahKendaraanBtn = document.getElementById('tambahKendaraanBtn');
    const applyFilterBtn = document.getElementById('applyFilterBtn');
    const resetFilterBtn = document.getElementById('resetFilterBtn');
    const searchKendaraan = document.getElementById('searchKendaraan');
    const filterStatus = document.getElementById('filterStatus');
    const filterJenis = document.getElementById('filterJenis');
    const filterKapasitas = document.getElementById('filterKapasitas');
    const kendaraanTableBody = document.getElementById('kendaraanTableBody');
    
    // Modals
    const tambahModal = document.getElementById('tambahModal');
    const editModal = document.getElementById('editModal');
    const detailModal = document.getElementById('detailModal');
    const hapusModal = document.getElementById('hapusModal');
    
    // Forms
    const tambahKendaraanForm = document.getElementById('tambahKendaraanForm');
    const editKendaraanForm = document.getElementById('editKendaraanForm');
    
    // Buttons
    const confirmHapusBtn = document.getElementById('confirmHapusBtn');
    const editFromDetailBtn = document.getElementById('editFromDetailBtn');
    
    // State
    let currentPage = 1;
    const itemsPerPage = 5;
    let currentFilter = {
        search: '',
        status: '',
        jenis: '',
        kapasitas: ''
    };
    
    let selectedKendaraanId = null;
    
    // Initialize
    loadKendaraanTable();
    updateStats();
    
    // Event Listeners
    tambahKendaraanBtn.addEventListener('click', showTambahModal);
    applyFilterBtn.addEventListener('click', applyFilters);
    resetFilterBtn.addEventListener('click', resetFilters);
    searchKendaraan.addEventListener('input', handleSearch);
    
    // Search dengan debounce
    let searchTimeout;
    function handleSearch() {
        clearTimeout(searchTimeout);
        searchTimeout = setTimeout(() => {
            currentFilter.search = searchKendaraan.value;
            currentPage = 1;
            loadKendaraanTable();
            updateStats();
        }, 500);
    }
    
    // Apply filters
    function applyFilters() {
        currentFilter = {
            search: searchKendaraan.value,
            status: filterStatus.value,
            jenis: filterJenis.value,
            kapasitas: filterKapasitas.value
        };
        
        currentPage = 1;
        loadKendaraanTable();
        updateStats();
    }
    
    // Reset filters
    function resetFilters() {
        searchKendaraan.value = '';
        filterStatus.value = '';
        filterJenis.value = '';
        filterKapasitas.value = '';
        
        currentFilter = {
            search: '',
            status: '',
            jenis: '',
            kapasitas: ''
        };
        
        currentPage = 1;
        loadKendaraanTable();
        updateStats();
    }
    
    // Load kendaraan table
    function loadKendaraanTable() {
        kendaraanTableBody.innerHTML = '';
        
        const filteredData = filterData(kendaraanData);
        const startIndex = (currentPage - 1) * itemsPerPage;
        const endIndex = startIndex + itemsPerPage;
        const pageData = filteredData.slice(startIndex, endIndex);
        
        if (pageData.length === 0) {
            kendaraanTableBody.innerHTML = `
                <tr>
                    <td colspan="7">
                        <div class="empty-state">
                            <div class="empty-state-icon">
                                <i class="fas fa-truck"></i>
                            </div>
                            <h5 class="empty-state-title">Tidak ada data kendaraan</h5>
                            <p class="empty-state-description">
                                ${currentFilter.search || currentFilter.status || currentFilter.jenis || currentFilter.kapasitas 
                                    ? 'Coba ubah filter pencarian Anda' 
                                    : 'Mulai dengan menambahkan kendaraan baru'}
                            </p>
                            ${!currentFilter.search && !currentFilter.status && !currentFilter.jenis && !currentFilter.kapasitas 
                                ? '<button type="button" class="btn btn-primary" onclick="showTambahModal()"><i class="fas fa-plus"></i> Tambah Kendaraan</button>' 
                                : '<button type="button" class="btn btn-secondary" onclick="resetFilters()"><i class="fas fa-redo"></i> Reset Filter</button>'}
                        </div>
                    </td>
                </tr>
            `;
        } else {
            pageData.forEach((kendaraan, index) => {
                const globalIndex = startIndex + index + 1;
                const row = document.createElement('tr');
                
                // Determine vehicle badge class
                let badgeClass = 'truk';
                if (kendaraan.jenis_kendaraan.toLowerCase().includes('pickup')) {
                    badgeClass = 'pickup';
                } else if (kendaraan.jenis_kendaraan.toLowerCase().includes('minibus')) {
                    badgeClass = 'minibus';
                }
                
                // Format kapasitas
                const kapasitasTon = (kendaraan.kapasitas_kg / 1000).toFixed(1);
                
                // Format tanggal
                const formatDate = (dateString) => {
                    const date = new Date(dateString);
                    return date.toLocaleDateString('id-ID', {
                        day: 'numeric',
                        month: 'short',
                        year: 'numeric'
                    });
                };
                
                row.innerHTML = `
                    <td style="color: var(--text-light);">${globalIndex}</td>
                    <td>
                        <div style="font-weight: 700; color: var(--primary); font-family: monospace; font-size: 15px;">
                            ${kendaraan.plat_nomor}
                        </div>
                    </td>
                    <td>
                        <div class="vehicle-badge ${badgeClass}">
                            <i class="fas fa-${badgeClass === 'pickup' ? 'car' : 'truck'}"></i>
                            ${kendaraan.jenis_kendaraan}
                        </div>
                    </td>
                    <td>
                        <div class="capacity-badge">
                            <i class="fas fa-weight-hanging"></i>
                            ${kendaraan.kapasitas_kg.toLocaleString()} kg (${kapasitasTon} ton)
                        </div>
                    </td>
                    <td>
                        <span class="status-badge badge-${kendaraan.status}">
                            ${getStatusLabel(kendaraan.status)}
                        </span>
                    </td>
                    <td>
                        <div style="color: var(--text-dark);">${formatDate(kendaraan.created_at)}</div>
                    </td>
                    <td>
                        <div class="action-buttons">
                            <button type="button" class="btn-action btn-view" data-id="${kendaraan.id}" title="Lihat Detail">
                                <i class="fas fa-eye"></i>
                            </button>
                            <button type="button" class="btn-action btn-edit" data-id="${kendaraan.id}" title="Edit">
                                <i class="fas fa-edit"></i>
                            </button>
                            <button type="button" class="btn-action btn-delete" data-id="${kendaraan.id}" title="Hapus">
                                <i class="fas fa-trash"></i>
                            </button>
                        </div>
                    </td>
                `;
                
                kendaraanTableBody.appendChild(row);
            });
        }
        
        // Update counts
        document.getElementById('showingCount').textContent = pageData.length;
        document.getElementById('totalCount').textContent = filteredData.length;
        
        // Update pagination
        updatePagination(filteredData.length);
        
        // Add event listeners to action buttons
        addActionListeners();
    }
    
    // Filter data
    function filterData(data) {
        return data.filter(item => {
            // Filter search
            if (currentFilter.search) {
                const searchTerm = currentFilter.search.toLowerCase();
                if (!item.plat_nomor.toLowerCase().includes(searchTerm) && 
                    !item.jenis_kendaraan.toLowerCase().includes(searchTerm)) {
                    return false;
                }
            }
            
            // Filter status
            if (currentFilter.status && item.status !== currentFilter.status) return false;
            
            // Filter jenis
            if (currentFilter.jenis && item.jenis_kendaraan !== currentFilter.jenis) return false;
            
            // Filter kapasitas
            if (currentFilter.kapasitas) {
                const [min, max] = currentFilter.kapasitas.split('-').map(Number);
                if (max) {
                    if (item.kapasitas_kg < min || item.kapasitas_kg > max) return false;
                } else {
                    if (item.kapasitas_kg < min) return false;
                }
            }
            
            return true;
        }).sort((a, b) => new Date(b.created_at) - new Date(a.created_at));
    }
    
    // Update statistics
    function updateStats() {
        const filteredData = filterData(kendaraanData);
        
        const totalKendaraan = filteredData.length;
        const tersediaCount = filteredData.filter(item => item.status === 'tersedia').length;
        const perbaikanCount = filteredData.filter(item => item.status === 'perbaikan').length;
        const totalKapasitas = filteredData.reduce((sum, item) => sum + item.kapasitas_kg, 0) / 1000;
        
        document.getElementById('totalKendaraan').textContent = totalKendaraan;
        document.getElementById('tersediaCount').textContent = tersediaCount;
        document.getElementById('perbaikanCount').textContent = perbaikanCount;
        document.getElementById('totalKapasitas').textContent = totalKapasitas.toFixed(1);
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
                loadKendaraanTable();
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
                const kendaraanId = parseInt(this.dataset.id);
                const kendaraan = kendaraanData.find(k => k.id === kendaraanId);
                if (kendaraan) {
                    showDetailModal(kendaraan);
                }
            });
        });
        
        // Edit buttons
        document.querySelectorAll('.btn-action.btn-edit').forEach(btn => {
            btn.addEventListener('click', function() {
                const kendaraanId = parseInt(this.dataset.id);
                const kendaraan = kendaraanData.find(k => k.id === kendaraanId);
                if (kendaraan) {
                    showEditModal(kendaraan);
                }
            });
        });
        
        // Delete buttons
        document.querySelectorAll('.btn-action.btn-delete').forEach(btn => {
            btn.addEventListener('click', function() {
                const kendaraanId = parseInt(this.dataset.id);
                const kendaraan = kendaraanData.find(k => k.id === kendaraanId);
                if (kendaraan) {
                    showHapusModal(kendaraan);
                }
            });
        });
    }
    
    // Show tambah modal
    function showTambahModal() {
        // Reset form
        tambahKendaraanForm.reset();
        
        // Remove validation classes
        const inputs = tambahKendaraanForm.querySelectorAll('.form-control');
        inputs.forEach(input => {
            input.classList.remove('is-invalid', 'is-valid');
        });
        
        // Remove error messages
        const errorMessages = tambahKendaraanForm.querySelectorAll('.invalid-feedback');
        errorMessages.forEach(msg => msg.remove());
        
        tambahModal.style.display = 'flex';
        document.body.style.overflow = 'hidden';
    }
    
    // Show edit modal
    function showEditModal(kendaraan) {
        selectedKendaraanId = kendaraan.id;
        
        // Fill form with data
        document.getElementById('edit_id').value = kendaraan.id;
        document.getElementById('edit_plat_nomor').value = kendaraan.plat_nomor;
        document.getElementById('edit_jenis_kendaraan').value = kendaraan.jenis_kendaraan;
        document.getElementById('edit_kapasitas_kg').value = kendaraan.kapasitas_kg;
        document.getElementById('edit_status').value = kendaraan.status;
        document.getElementById('edit_catatan').value = kendaraan.catatan || '';
        
        // Disable plat nomor field (cannot be changed)
        document.getElementById('edit_plat_nomor').disabled = true;
        
        // Remove validation classes
        const inputs = editKendaraanForm.querySelectorAll('.form-control');
        inputs.forEach(input => {
            input.classList.remove('is-invalid', 'is-valid');
        });
        
        // Remove error messages
        const errorMessages = editKendaraanForm.querySelectorAll('.invalid-feedback');
        errorMessages.forEach(msg => msg.remove());
        
        editModal.style.display = 'flex';
        document.body.style.overflow = 'hidden';
    }
    
    // Show detail modal
    function showDetailModal(kendaraan) {
        selectedKendaraanId = kendaraan.id;
        
        // Format tanggal
        const formatDate = (dateString) => {
            const date = new Date(dateString);
            return date.toLocaleDateString('id-ID', {
                day: 'numeric',
                month: 'long',
                year: 'numeric'
            });
        };
        
        // Hitung kapasitas dalam ton
        const kapasitasTon = (kendaraan.kapasitas_kg / 1000).toFixed(2);
        
        // Determine vehicle icon
        let vehicleIcon = 'truck';
        if (kendaraan.jenis_kendaraan.toLowerCase().includes('pickup')) {
            vehicleIcon = 'car';
        } else if (kendaraan.jenis_kendaraan.toLowerCase().includes('minibus')) {
            vehicleIcon = 'bus';
        }
        
        detailModalBody.innerHTML = `
            <div class="detail-grid">
                <div class="detail-item">
                    <div class="detail-label">Plat Nomor</div>
                    <div class="detail-value" style="font-family: monospace; font-size: 20px; color: var(--primary);">
                        ${kendaraan.plat_nomor}
                    </div>
                </div>
                
                <div class="detail-item">
                    <div class="detail-label">Jenis Kendaraan</div>
                    <div class="detail-value">
                        <i class="fas fa-${vehicleIcon}"></i> ${kendaraan.jenis_kendaraan}
                    </div>
                </div>
                
                <div class="detail-item">
                    <div class="detail-label">Kapasitas</div>
                    <div class="detail-value">${kendaraan.kapasitas_kg.toLocaleString()} kg</div>
                    <div class="detail-subvalue">${kapasitasTon} ton</div>
                </div>
                
                <div class="detail-item">
                    <div class="detail-label">Status</div>
                    <div class="detail-value">
                        <span class="status-badge badge-${kendaraan.status}">
                            ${getStatusLabel(kendaraan.status)}
                        </span>
                    </div>
                </div>
            </div>
            
            <div style="margin-top: 25px;">
                <div class="detail-label">Catatan</div>
                <div style="background: var(--light); padding: 15px; border-radius: 8px; min-height: 80px;">
                    ${kendaraan.catatan || '<span style="color: var(--text-light); font-style: italic;">Tidak ada catatan</span>'}
                </div>
            </div>
            
            <div style="margin-top: 25px; display: grid; grid-template-columns: repeat(2, 1fr); gap: 15px;">
                <div style="background: var(--light); padding: 15px; border-radius: 8px;">
                    <div class="detail-label">Tanggal Input</div>
                    <div class="detail-value">${formatDate(kendaraan.created_at)}</div>
                </div>
                
                <div style="background: var(--light); padding: 15px; border-radius: 8px;">
                    <div class="detail-label">Terakhir Update</div>
                    <div class="detail-value">${formatDate(kendaraan.updated_at)}</div>
                </div>
            </div>
        `;
        
        detailModal.style.display = 'flex';
        document.body.style.overflow = 'hidden';
    }
    
    // Show hapus modal
    function showHapusModal(kendaraan) {
        selectedKendaraanId = kendaraan.id;
        
        document.getElementById('hapusKendaraanInfo').innerHTML = `
            Kendaraan <strong>${kendaraan.plat_nomor}</strong> (${kendaraan.jenis_kendaraan}) akan dihapus.
            <br><small class="text-danger">Aksi ini tidak dapat dibatalkan.</small>
        `;
        
        hapusModal.style.display = 'flex';
        document.body.style.overflow = 'hidden';
    }
    
    // Form validation
    function validateForm(form) {
        let isValid = true;
        const inputs = form.querySelectorAll('input[required], select[required]');
        
        // Remove previous validation
        inputs.forEach(input => {
            input.classList.remove('is-invalid', 'is-valid');
            const existingError = input.parentNode.querySelector('.invalid-feedback');
            if (existingError) {
                existingError.remove();
            }
        });
        
        // Validate each required field
        inputs.forEach(input => {
            if (!input.value.trim()) {
                isValid = false;
                input.classList.add('is-invalid');
                
                const errorDiv = document.createElement('div');
                errorDiv.className = 'invalid-feedback';
                errorDiv.textContent = 'Field ini wajib diisi';
                input.parentNode.appendChild(errorDiv);
            } else {
                input.classList.add('is-valid');
                
                // Additional validation for plat nomor
                if (input.name === 'plat_nomor') {
                    const platRegex = /^[A-Za-z]+\s+\d+\s+[A-Za-z]+$/;
                    if (!platRegex.test(input.value)) {
                        isValid = false;
                        input.classList.remove('is-valid');
                        input.classList.add('is-invalid');
                        
                        const errorDiv = document.createElement('div');
                        errorDiv.className = 'invalid-feedback';
                        errorDiv.textContent = 'Format plat nomor tidak valid. Contoh: B 1234 ABC';
                        input.parentNode.appendChild(errorDiv);
                    }
                }
                
                // Additional validation for kapasitas
                if (input.name === 'kapasitas_kg') {
                    const kapasitas = parseInt(input.value);
                    if (kapasitas < 100 || kapasitas > 50000) {
                        isValid = false;
                        input.classList.remove('is-valid');
                        input.classList.add('is-invalid');
                        
                        const errorDiv = document.createElement('div');
                        errorDiv.className = 'invalid-feedback';
                        errorDiv.textContent = 'Kapasitas harus antara 100 - 50,000 kg';
                        input.parentNode.appendChild(errorDiv);
                    }
                }
            }
        });
        
        return isValid;
    }
    
    // Handle form submission - Tambah
    tambahKendaraanForm.addEventListener('submit', function(e) {
        e.preventDefault();
        
        if (!validateForm(this)) return;
        
        // Get form data
        const formData = {
            id: Date.now(), // Generate unique ID
            plat_nomor: document.getElementById('plat_nomor').value.trim().toUpperCase(),
            jenis_kendaraan: document.getElementById('jenis_kendaraan').value,
            kapasitas_kg: parseInt(document.getElementById('kapasitas_kg').value),
            status: 'tersedia',
            catatan: document.getElementById('catatan').value.trim(),
            created_at: new Date().toISOString().split('T')[0],
            updated_at: new Date().toISOString().split('T')[0]
        };
        
        // Check if plat nomor already exists
        const existing = kendaraanData.find(k => k.plat_nomor === formData.plat_nomor);
        if (existing) {
            showNotification('Plat nomor sudah terdaftar', 'danger');
            document.getElementById('plat_nomor').classList.add('is-invalid');
            const errorDiv = document.createElement('div');
            errorDiv.className = 'invalid-feedback';
            errorDiv.textContent = 'Plat nomor sudah terdaftar';
            document.getElementById('plat_nomor').parentNode.appendChild(errorDiv);
            return;
        }
        
        // Add to data
        kendaraanData.unshift(formData);
        
        // Close modal
        tambahModal.style.display = 'none';
        document.body.style.overflow = 'auto';
        
        // Refresh table
        currentPage = 1;
        loadKendaraanTable();
        updateStats();
        
        // Show success notification
        showNotification('Kendaraan berhasil ditambahkan', 'success');
    });
    
    // Handle form submission - Edit
    editKendaraanForm.addEventListener('submit', function(e) {
        e.preventDefault();
        
        if (!validateForm(this)) return;
        
        // Get form data
        const formData = {
            jenis_kendaraan: document.getElementById('edit_jenis_kendaraan').value,
            kapasitas_kg: parseInt(document.getElementById('edit_kapasitas_kg').value),
            status: document.getElementById('edit_status').value,
            catatan: document.getElementById('edit_catatan').value.trim(),
            updated_at: new Date().toISOString().split('T')[0]
        };
        
        // Find and update kendaraan
        const index = kendaraanData.findIndex(k => k.id === selectedKendaraanId);
        if (index !== -1) {
            kendaraanData[index] = {
                ...kendaraanData[index],
                ...formData
            };
        }
        
        // Close modal
        editModal.style.display = 'none';
        document.body.style.overflow = 'auto';
        
        // Refresh table
        loadKendaraanTable();
        updateStats();
        
        // Show success notification
        showNotification('Data kendaraan berhasil diperbarui', 'success');
    });
    
    // Handle delete confirmation
    confirmHapusBtn.addEventListener('click', function() {
        // Find and remove kendaraan
        const index = kendaraanData.findIndex(k => k.id === selectedKendaraanId);
        if (index !== -1) {
            kendaraanData.splice(index, 1);
        }
        
        // Close modal
        hapusModal.style.display = 'none';
        document.body.style.overflow = 'auto';
        
        // Refresh table and stats
        currentPage = 1;
        loadKendaraanTable();
        updateStats();
        
        // Show success notification
        showNotification('Kendaraan berhasil dihapus', 'success');
    });
    
    // Edit from detail button
    editFromDetailBtn.addEventListener('click', function() {
        detailModal.style.display = 'none';
        const kendaraan = kendaraanData.find(k => k.id === selectedKendaraanId);
        if (kendaraan) {
            showEditModal(kendaraan);
        }
    });
    
    // Close modal buttons
    document.querySelectorAll('.close-modal').forEach(btn => {
        btn.addEventListener('click', function() {
            tambahModal.style.display = 'none';
            document.body.style.overflow = 'auto';
        });
    });
    
    document.querySelectorAll('.close-edit-modal').forEach(btn => {
        btn.addEventListener('click', function() {
            editModal.style.display = 'none';
            document.body.style.overflow = 'auto';
        });
    });
    
    document.querySelectorAll('.close-detail-modal').forEach(btn => {
        btn.addEventListener('click', function() {
            detailModal.style.display = 'none';
            document.body.style.overflow = 'auto';
        });
    });
    
    document.querySelectorAll('.close-hapus-modal').forEach(btn => {
        btn.addEventListener('click', function() {
            hapusModal.style.display = 'none';
            document.body.style.overflow = 'auto';
        });
    });
    
    // Close modal when clicking outside
    [tambahModal, editModal, detailModal, hapusModal].forEach(modal => {
        modal.addEventListener('click', function(e) {
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
            loadKendaraanTable();
        }
    });
    
    document.querySelector('.btn-pagination.next').addEventListener('click', function() {
        const filteredData = filterData(kendaraanData);
        const totalPages = Math.ceil(filteredData.length / itemsPerPage);
        
        if (currentPage < totalPages) {
            currentPage++;
            loadKendaraanTable();
        }
    });
    
    // Helper functions
    function getStatusLabel(status) {
        const labels = {
            'tersedia': 'Tersedia',
            'dipakai': 'Dipakai',
            'perbaikan': 'Perbaikan',
            'nonaktif': 'Nonaktif'
        };
        return labels[status] || status;
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