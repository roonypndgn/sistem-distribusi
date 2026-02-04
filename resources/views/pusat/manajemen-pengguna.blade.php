@extends('layouts.pusat')

@section('title', 'Manajemen User - PT. Mardua Holong')

@section('page-title', 'Manajemen User')
@section('page-subtitle', 'Kelola data user dan akses sistem')

@section('content')
<div class="content-wrapper">
    <!-- Header -->
    <div class="content-header">
        <div class="header-left">
            <h1>Manajemen User</h1>
            <p>Kelola data pengguna sistem</p>
        </div>
        <div class="header-right">
            <button type="button" id="tambahUserBtn" class="btn btn-success">
                <i class="fas fa-user-plus"></i> Tambah User
            </button>
            <button type="button" id="exportBtn" class="btn btn-primary">
                <i class="fas fa-file-excel"></i> Export Excel
            </button>
        </div>
    </div>
    
    <!-- Statistik -->
    <div class="stats-grid" style="margin-bottom: 30px;">
        <div class="stat-card">
            <div class="stat-icon">
                <i class="fas fa-users"></i>
            </div>
            <div class="stat-content">
                <div class="stat-value" id="totalUser">0</div>
                <div class="stat-label">Total User</div>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon">
                <i class="fas fa-user-tie"></i>
            </div>
            <div class="stat-content">
                <div class="stat-value" id="totalManajer">0</div>
                <div class="stat-label">Manajer</div>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon">
                <i class="fas fa-user-hard-hat"></i>
            </div>
            <div class="stat-content">
                <div class="stat-value" id="totalKaryawan">0</div>
                <div class="stat-label">Karyawan</div>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon">
                <i class="fas fa-truck"></i>
            </div>
            <div class="stat-content">
                <div class="stat-value" id="totalSupir">0</div>
                <div class="stat-label">Supir</div>
            </div>
        </div>
    </div>
    
    <!-- Filter -->
    <div class="content-card" style="margin-bottom: 30px;">
        <div class="card-header">
            <div class="card-title">
                <i class="fas fa-filter"></i>
                <span>Filter User</span>
            </div>
        </div>
        
        <div class="filter-options">
            <div class="filter-group">
                <label class="filter-label">Role</label>
                <select id="filterRole" class="form-control">
                    <option value="">Semua Role</option>
                    <option value="manajer_lapangan">Manajer Lapangan</option>
                    <option value="karyawan_lapangan">Karyawan Lapangan</option>
                    <option value="supir">Supir</option>
                </select>
            </div>
            
            <div class="filter-group">
                <label class="filter-label">Status</label>
                <select id="filterStatus" class="form-control">
                    <option value="">Semua Status</option>
                    <option value="aktif">Aktif</option>
                    <option value="nonaktif">Nonaktif</option>
                </select>
            </div>
            
            <div class="filter-group">
                <label class="filter-label">Cari User</label>
                <div class="input-group">
                    <input type="text" id="searchUser" class="form-control" placeholder="Cari nama atau email...">
                    <button type="button" class="btn btn-secondary">
                        <i class="fas fa-search"></i>
                    </button>
                </div>
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
    
    <!-- Daftar User -->
    <div class="content-card">
        <div class="card-header">
            <div class="card-title">
                <i class="fas fa-users-cog"></i>
                <span>Daftar User</span>
            </div>
            <div class="card-info">
                Menampilkan <span id="showingCount">0</span> dari <span id="totalCount">0</span> user
            </div>
        </div>
        
        <div class="table-responsive">
            <table class="data-table">
                <thead>
                    <tr>
                        <th style="width: 50px;">No</th>
                        <th>ID User</th>
                        <th>Nama Lengkap</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Status</th>
                        <th>Terdaftar</th>
                        <th style="width: 120px;">Aksi</th>
                    </tr>
                </thead>
                <tbody id="userTableBody">
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

<!-- Modal Tambah/Edit User -->
<div id="userModal" class="modal">
    <div class="modal-content">
        <div class="modal-header">
            <h3 class="modal-title" id="modalTitle">Tambah User Baru</h3>
            <button type="button" class="close-modal">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <div class="modal-body">
            <form id="userForm">
                <input type="hidden" id="userId">
                
                <div class="form-group">
                    <label class="form-label">ID User <span class="text-danger">*</span></label>
                    <div class="input-group">
                        <input type="text" id="idUser" class="form-control" placeholder="Contoh: USR-001" required>
                        <button type="button" id="generateIdBtn" class="btn btn-secondary">
                            <i class="fas fa-sync-alt"></i> Generate
                        </button>
                    </div>
                    <small class="text-muted">ID unik untuk user. Format: USR-XXX</small>
                </div>
                
                <div class="form-group">
                    <label class="form-label">Nama Lengkap <span class="text-danger">*</span></label>
                    <input type="text" id="namaUser" class="form-control" placeholder="Contoh: Budi Santoso" required>
                </div>
                
                <div class="form-group">
                    <label class="form-label">Email <span class="text-danger">*</span></label>
                    <input type="email" id="emailUser" class="form-control" placeholder="contoh@email.com" required>
                    <small class="text-muted">Email akan digunakan untuk login</small>
                </div>
                
                <div class="form-group">
                    <label class="form-label">Password <span class="text-danger">*</span></label>
                    <div class="input-group">
                        <input type="password" id="passwordUser" class="form-control" placeholder="Masukkan password" required>
                        <button type="button" id="togglePasswordBtn" class="btn btn-secondary">
                            <i class="fas fa-eye"></i>
                        </button>
                    </div>
                    <small class="text-muted">Minimal 6 karakter</small>
                </div>
                
                <div class="form-group">
                    <label class="form-label">Konfirmasi Password <span class="text-danger">*</span></label>
                    <input type="password" id="confirmPassword" class="form-control" placeholder="Ulangi password" required>
                </div>
                
                <div class="form-group">
                    <label class="form-label">Role <span class="text-danger">*</span></label>
                    <select id="roleUser" class="form-control" required>
                        <option value="">Pilih Role</option>
                        <option value="manajer_lapangan">Manajer Lapangan</option>
                        <option value="karyawan_lapangan">Karyawan Lapangan</option>
                        <option value="supir">Supir</option>
                    </select>
                    <small class="text-muted">Hak akses user dalam sistem</small>
                </div>
                
                <div class="form-group">
                    <label class="form-label">Status Akun <span class="text-danger">*</span></label>
                    <select id="statusUser" class="form-control" required>
                        <option value="aktif">Aktif</option>
                        <option value="nonaktif">Nonaktif</option>
                    </select>
                </div>
            </form>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary close-modal">
                Batal
            </button>
            <button type="button" class="btn btn-primary" id="simpanUserBtn">
                <i class="fas fa-save"></i> Simpan
            </button>
        </div>
    </div>
</div>

<!-- Modal Detail User -->
<div id="detailModal" class="modal">
    <div class="modal-content modal-lg">
        <div class="modal-header">
            <h3 class="modal-title">Detail User</h3>
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
            <button type="button" class="btn btn-primary" id="resetPasswordBtn">
                <i class="fas fa-key"></i> Reset Password
            </button>
        </div>
    </div>
</div>

<!-- Modal Hapus User -->
<div id="hapusModal" class="modal">
    <div class="modal-content">
        <div class="modal-header">
            <h3 class="modal-title">Konfirmasi Hapus</h3>
            <button type="button" class="close-hapus-modal">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <div class="modal-body">
            <div style="text-align: center; padding: 20px;">
                <i class="fas fa-exclamation-triangle" style="font-size: 48px; color: #ff9800; margin-bottom: 20px;"></i>
                <h4 style="margin-bottom: 10px;">Apakah Anda yakin?</h4>
                <p id="hapusMessage">Data user ini akan dihapus secara permanen.</p>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary close-hapus-modal">
                Batal
            </button>
            <button type="button" class="btn btn-danger" id="confirmHapusBtn">
                <i class="fas fa-trash"></i> Ya, Hapus
            </button>
        </div>
    </div>
</div>

<!-- Modal Reset Password -->
<div id="resetModal" class="modal">
    <div class="modal-content">
        <div class="modal-header">
            <h3 class="modal-title">Reset Password</h3>
            <button type="button" class="close-reset-modal">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <div class="modal-body">
            <div class="form-group">
                <label class="form-label">User</label>
                <div id="resetUserInfo" style="padding: 10px; background-color: #f8f9fa; border-radius: 6px; margin-bottom: 15px;">
                    -</div>
            </div>
            <div class="form-group">
                <label class="form-label">Password Baru <span class="text-danger">*</span></label>
                <div class="input-group">
                    <input type="password" id="newPassword" class="form-control" placeholder="Masukkan password baru" required>
                    <button type="button" id="toggleNewPasswordBtn" class="btn btn-secondary">
                        <i class="fas fa-eye"></i>
                    </button>
                </div>
                <small class="text-muted">Minimal 6 karakter</small>
            </div>
            <div class="form-group">
                <label class="form-label">Konfirmasi Password <span class="text-danger">*</span></label>
                <input type="password" id="confirmNewPassword" class="form-control" placeholder="Ulangi password baru" required>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary close-reset-modal">
                Batal
            </button>
            <button type="button" class="btn btn-primary" id="confirmResetBtn">
                <i class="fas fa-save"></i> Reset Password
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
        background: linear-gradient(135deg, #FF9800 0%, #F57C00 100%);
    }
    
    .stat-card:nth-child(3) .stat-icon {
        background: linear-gradient(135deg, #4CAF50 0%, #388E3C 100%);
    }
    
    .stat-card:nth-child(4) .stat-icon {
        background: linear-gradient(135deg, #9C27B0 0%, #7B1FA2 100%);
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
    }
    
    .input-group .form-control {
        border-top-right-radius: 0;
        border-bottom-right-radius: 0;
        border-right: none;
        flex: 1;
    }
    
    .input-group .btn {
        border-top-left-radius: 0;
        border-bottom-left-radius: 0;
        border-left: none;
        padding: 12px 15px;
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
        min-width: 80px;
    }
    
    .badge-aktif {
        background-color: #E8F5E9;
        color: #2E7D32;
        border: 1px solid #C8E6C9;
    }
    
    .badge-nonaktif {
        background-color: #FFEBEE;
        color: #C62828;
        border: 1px solid #FFCDD2;
    }
    
    /* Role Badge */
    .role-badge {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 6px 10px;
        border-radius: 6px;
        font-size: 12px;
        font-weight: 600;
        text-align: center;
    }
    
    .badge-manajer_lapangan {
        background-color: #FFF3E0;
        color: #EF6C00;
    }
    
    .badge-karyawan_lapangan {
        background-color: #E8F5E9;
        color: #2E7D32;
    }
    
    .badge-supir {
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
    
    .btn-edit {
        background-color: #E8F5E9;
        color: #2E7D32;
    }
    
    .btn-edit:hover {
        background-color: #2E7D32;
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
    
    .btn-reset {
        background-color: #FFF3E0;
        color: #EF6C00;
    }
    
    .btn-reset:hover {
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
    
    .close-modal,
    .close-detail-modal,
    .close-hapus-modal,
    .close-reset-modal {
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
    .close-detail-modal:hover,
    .close-hapus-modal:hover,
    .close-reset-modal:hover {
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
    
    /* Form Styles */
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
    
    .form-label .text-danger {
        color: var(--danger);
    }
    
    .text-muted {
        color: var(--text-light);
        font-size: 12px;
        display: block;
        margin-top: 4px;
    }
    
    /* Detail User Design */
    .user-header {
        display: flex;
        align-items: center;
        gap: 20px;
        margin-bottom: 30px;
        padding-bottom: 20px;
        border-bottom: 2px solid var(--border);
    }
    
    .user-avatar {
        width: 80px;
        height: 80px;
        border-radius: 50%;
        background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 32px;
        font-weight: 600;
    }
    
    .user-title {
        flex: 1;
    }
    
    .user-title h3 {
        margin: 0;
        font-size: 20px;
        font-weight: 700;
        color: var(--text-dark);
    }
    
    .user-subtitle {
        color: var(--text-light);
        font-size: 14px;
        margin-top: 5px;
    }
    
    .user-info-grid {
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
    
    /* User Stats */
    .user-stats {
        margin-top: 30px;
    }
    
    .stats-title {
        font-size: 16px;
        font-weight: 600;
        color: var(--text-dark);
        margin-bottom: 15px;
    }
    
    .stats-grid-small {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
        gap: 15px;
    }
    
    .stat-card-small {
        background: white;
        padding: 15px;
        border-radius: 8px;
        border: 1px solid var(--border);
        text-align: center;
        transition: var(--transition);
    }
    
    .stat-card-small:hover {
        transform: translateY(-3px);
        box-shadow: 0 3px 10px rgba(0,0,0,0.1);
    }
    
    .stat-value-small {
        font-size: 18px;
        font-weight: 700;
        color: var(--primary);
        margin-bottom: 5px;
    }
    
    .stat-label-small {
        font-size: 12px;
        color: var(--text-light);
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
        
        .user-info-grid {
            grid-template-columns: 1fr;
        }
        
        .user-header {
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
        
        .stats-grid-small {
            grid-template-columns: repeat(2, 1fr);
        }
        
        .input-group {
            flex-direction: column;
        }
        
        .input-group .form-control,
        .input-group .btn {
            border-radius: 8px;
            width: 100%;
            margin-bottom: 5px;
        }
    }
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Data dummy user
    let userData = [
        {
            id: 1,
            user_id: "USR-001",
            nama: "Budi Santoso",
            email: "budi.santoso@example.com",
            password: "password123",
            role: "supir",
            status: "aktif",
            tanggal_daftar: "2024-01-15",
            last_login: "2024-03-20 14:30:00",
            stats: {
                total_pengiriman: 15,
                success_rate: "95%",
                rating: 4.8
            }
        },
        {
            id: 2,
            user_id: "USR-002",
            nama: "Siti Rahayu",
            email: "siti.rahayu@example.com",
            password: "password123",
            role: "manajer_lapangan",
            status: "aktif",
            tanggal_daftar: "2024-01-10",
            last_login: "2024-03-21 09:15:00",
            stats: {
                total_pengiriman: 45,
                success_rate: "98%",
                rating: 4.9
            }
        },
        {
            id: 3,
            user_id: "USR-003",
            nama: "Ahmad Fauzi",
            email: "ahmad.fauzi@example.com",
            password: "password123",
            role: "karyawan_lapangan",
            status: "aktif",
            tanggal_daftar: "2024-02-01",
            last_login: "2024-03-19 16:45:00",
            stats: {
                total_pengiriman: 25,
                success_rate: "92%",
                rating: 4.5
            }
        },
        {
            id: 4,
            user_id: "USR-004",
            nama: "Rina Wijaya",
            email: "rina.wijaya@example.com",
            password: "password123",
            role: "supir",
            status: "aktif",
            tanggal_daftar: "2024-02-15",
            last_login: "2024-03-21 11:20:00",
            stats: {
                total_pengiriman: 8,
                success_rate: "88%",
                rating: 4.2
            }
        },
        {
            id: 5,
            user_id: "USR-005",
            nama: "Dedi Kurniawan",
            email: "dedi.kurniawan@example.com",
            password: "password123",
            role: "karyawan_lapangan",
            status: "nonaktif",
            tanggal_daftar: "2024-01-20",
            last_login: "2024-02-28 13:10:00",
            stats: {
                total_pengiriman: 12,
                success_rate: "85%",
                rating: 4.0
            }
        },
        {
            id: 6,
            user_id: "USR-006",
            nama: "Maya Indah",
            email: "maya.indah@example.com",
            password: "password123",
            role: "manajer_lapangan",
            status: "aktif",
            tanggal_daftar: "2024-03-01",
            last_login: "2024-03-21 10:05:00",
            stats: {
                total_pengiriman: 30,
                success_rate: "96%",
                rating: 4.7
            }
        },
        {
            id: 7,
            user_id: "USR-007",
            nama: "Hendra Pratama",
            email: "hendra.pratama@example.com",
            password: "password123",
            role: "supir",
            status: "aktif",
            tanggal_daftar: "2024-02-20",
            last_login: "2024-03-20 08:45:00",
            stats: {
                total_pengiriman: 18,
                success_rate: "94%",
                rating: 4.6
            }
        },
        {
            id: 8,
            user_id: "USR-008",
            nama: "Linda Sari",
            email: "linda.sari@example.com",
            password: "password123",
            role: "karyawan_lapangan",
            status: "aktif",
            tanggal_daftar: "2024-01-25",
            last_login: "2024-03-19 15:30:00",
            stats: {
                total_pengiriman: 22,
                success_rate: "90%",
                rating: 4.3
            }
        }
    ];
    
    // Elemen DOM
    const tambahUserBtn = document.getElementById('tambahUserBtn');
    const exportBtn = document.getElementById('exportBtn');
    const applyFilterBtn = document.getElementById('applyFilterBtn');
    const resetFilterBtn = document.getElementById('resetFilterBtn');
    const filterRole = document.getElementById('filterRole');
    const filterStatus = document.getElementById('filterStatus');
    const searchUser = document.getElementById('searchUser');
    const userTableBody = document.getElementById('userTableBody');
    
    // Modals
    const userModal = document.getElementById('userModal');
    const detailModal = document.getElementById('detailModal');
    const hapusModal = document.getElementById('hapusModal');
    const resetModal = document.getElementById('resetModal');
    
    // Form elements
    const userForm = document.getElementById('userForm');
    const userIdInput = document.getElementById('userId');
    const idUserInput = document.getElementById('idUser');
    const namaUserInput = document.getElementById('namaUser');
    const emailUserInput = document.getElementById('emailUser');
    const passwordUserInput = document.getElementById('passwordUser');
    const confirmPasswordInput = document.getElementById('confirmPassword');
    const roleUserSelect = document.getElementById('roleUser');
    const statusUserSelect = document.getElementById('statusUser');
    const simpanUserBtn = document.getElementById('simpanUserBtn');
    const modalTitle = document.getElementById('modalTitle');
    
    // Buttons
    const generateIdBtn = document.getElementById('generateIdBtn');
    const togglePasswordBtn = document.getElementById('togglePasswordBtn');
    
    // Detail Modal
    const detailModalBody = document.getElementById('detailModalBody');
    const resetPasswordBtn = document.getElementById('resetPasswordBtn');
    
    // Hapus Modal
    const hapusMessage = document.getElementById('hapusMessage');
    const confirmHapusBtn = document.getElementById('confirmHapusBtn');
    
    // Reset Modal
    const resetUserInfo = document.getElementById('resetUserInfo');
    const newPasswordInput = document.getElementById('newPassword');
    const confirmNewPasswordInput = document.getElementById('confirmNewPassword');
    const toggleNewPasswordBtn = document.getElementById('toggleNewPasswordBtn');
    const confirmResetBtn = document.getElementById('confirmResetBtn');
    
    // State
    let currentPage = 1;
    const itemsPerPage = 8;
    let currentFilter = {
        role: '',
        status: '',
        search: ''
    };
    
    let selectedUserId = null;
    let isEditMode = false;
    let passwordVisible = false;
    
    // Initialize
    updateStatistics();
    loadUserTable();
    
    // Tambah user button
    tambahUserBtn.addEventListener('click', function() {
        isEditMode = false;
        modalTitle.textContent = 'Tambah User Baru';
        resetForm();
        userModal.style.display = 'flex';
        document.body.style.overflow = 'hidden';
    });
    
    // Generate ID button
    generateIdBtn.addEventListener('click', function() {
        const lastId = userData.reduce((max, user) => {
            const num = parseInt(user.user_id.split('-')[1]);
            return num > max ? num : max;
        }, 0);
        
        const newId = `USR-${String(lastId + 1).padStart(3, '0')}`;
        idUserInput.value = newId;
    });
    
    // Toggle password visibility
    togglePasswordBtn.addEventListener('click', function() {
        passwordVisible = !passwordVisible;
        passwordUserInput.type = passwordVisible ? 'text' : 'password';
        togglePasswordBtn.innerHTML = passwordVisible ? 
            '<i class="fas fa-eye-slash"></i>' : 
            '<i class="fas fa-eye"></i>';
    });
    
    // Toggle new password visibility
    toggleNewPasswordBtn.addEventListener('click', function() {
        const isVisible = newPasswordInput.type === 'text';
        newPasswordInput.type = isVisible ? 'password' : 'text';
        toggleNewPasswordBtn.innerHTML = isVisible ? 
            '<i class="fas fa-eye"></i>' : 
            '<i class="fas fa-eye-slash"></i>';
    });
    
    // Apply filter
    applyFilterBtn.addEventListener('click', function() {
        currentFilter = {
            role: filterRole.value,
            status: filterStatus.value,
            search: searchUser.value.trim()
        };
        
        currentPage = 1;
        loadUserTable();
        updateStatistics();
    });
    
    // Reset filter
    resetFilterBtn.addEventListener('click', function() {
        filterRole.value = '';
        filterStatus.value = '';
        searchUser.value = '';
        
        currentFilter = {
            role: '',
            status: '',
            search: ''
        };
        
        currentPage = 1;
        loadUserTable();
        updateStatistics();
    });
    
    // Export button
    exportBtn.addEventListener('click', function() {
        showNotification('Fitur export Excel akan segera tersedia', 'info');
    });
    
    // Simpan user
    simpanUserBtn.addEventListener('click', function() {
        if (!validateForm()) {
            showNotification('Harap lengkapi semua field yang wajib diisi', 'warning');
            return;
        }
        
        if (passwordUserInput.value !== confirmPasswordInput.value) {
            showNotification('Password dan konfirmasi password tidak cocok', 'warning');
            return;
        }
        
        if (passwordUserInput.value.length < 6) {
            showNotification('Password minimal 6 karakter', 'warning');
            return;
        }
        
        const userDataInput = {
            user_id: idUserInput.value.trim(),
            nama: namaUserInput.value.trim(),
            email: emailUserInput.value.trim(),
            password: passwordUserInput.value,
            role: roleUserSelect.value,
            status: statusUserSelect.value,
            tanggal_daftar: new Date().toISOString().split('T')[0],
            last_login: null,
            stats: {
                total_pengiriman: 0,
                success_rate: "0%",
                rating: 0
            }
        };
        
        if (isEditMode) {
            // Update existing user
            const index = userData.findIndex(u => u.id === parseInt(userIdInput.value));
            if (index !== -1) {
                userDataInput.id = parseInt(userIdInput.value);
                // Keep original password if not changed
                if (passwordUserInput.value === '********') {
                    userDataInput.password = userData[index].password;
                }
                userData[index] = { ...userData[index], ...userDataInput };
                showNotification('Data user berhasil diperbarui', 'success');
            }
        } else {
            // Add new user
            userDataInput.id = Date.now();
            userData.push(userDataInput);
            showNotification('User baru berhasil ditambahkan', 'success');
        }
        
        userModal.style.display = 'none';
        document.body.style.overflow = 'auto';
        loadUserTable();
        updateStatistics();
    });
    
    // Reset password button in detail modal
    resetPasswordBtn.addEventListener('click', function() {
        const user = userData.find(u => u.id === selectedUserId);
        if (user) {
            showResetModal(user);
        }
    });
    
    // Confirm reset password
    confirmResetBtn.addEventListener('click', function() {
        if (!newPasswordInput.value || !confirmNewPasswordInput.value) {
            showNotification('Harap isi semua field password', 'warning');
            return;
        }
        
        if (newPasswordInput.value.length < 6) {
            showNotification('Password minimal 6 karakter', 'warning');
            return;
        }
        
        if (newPasswordInput.value !== confirmNewPasswordInput.value) {
            showNotification('Password baru dan konfirmasi tidak cocok', 'warning');
            return;
        }
        
        const index = userData.findIndex(u => u.id === selectedUserId);
        if (index !== -1) {
            userData[index].password = newPasswordInput.value;
            showNotification('Password berhasil direset', 'success');
            resetModal.style.display = 'none';
            document.body.style.overflow = 'auto';
        }
    });
    
    // Load user table
    function loadUserTable() {
        userTableBody.innerHTML = '';
        
        const filteredData = filterData(userData);
        const startIndex = (currentPage - 1) * itemsPerPage;
        const endIndex = startIndex + itemsPerPage;
        const pageData = filteredData.slice(startIndex, endIndex);
        
        if (pageData.length === 0) {
            userTableBody.innerHTML = `
                <tr>
                    <td colspan="8" style="text-align: center; padding: 40px; color: var(--text-light);">
                        <i class="fas fa-users" style="font-size: 40px; margin-bottom: 10px; opacity: 0.5; display: block;"></i>
                        <div>Tidak ada data user</div>
                    </td>
                </tr>
            `;
        } else {
            pageData.forEach((user, index) => {
                const globalIndex = startIndex + index + 1;
                const row = document.createElement('tr');
                
                // Format tanggal
                const formatDate = (dateString) => {
                    if (!dateString) return '-';
                    const date = new Date(dateString);
                    return date.toLocaleDateString('id-ID', {
                        day: 'numeric',
                        month: 'short',
                        year: 'numeric'
                    });
                };
                
                // Get initials for avatar
                const initials = user.nama.split(' ').map(n => n[0]).join('').toUpperCase();
                
                row.innerHTML = `
                    <td style="color: var(--text-light);">${globalIndex}</td>
                    <td>
                        <div style="font-weight: 700; color: var(--text-dark); font-size: 15px;">${user.user_id}</div>
                        <div style="font-size: 11px; color: var(--text-light);">${formatDate(user.tanggal_daftar)}</div>
                    </td>
                    <td>
                        <div style="font-weight: 600; color: var(--text-dark);">${user.nama}</div>
                    </td>
                    <td>
                        <div style="color: var(--text-dark);">${user.email}</div>
                        ${user.last_login ? 
                            `<div style="font-size: 11px; color: var(--text-light);">Login: ${formatDate(user.last_login.split(' ')[0])}</div>` : 
                            ''
                        }
                    </td>
                    <td>
                        <span class="role-badge badge-${user.role}">
                            <i class="fas fa-${getRoleIcon(user.role)}"></i>
                            ${getRoleLabel(user.role)}
                        </span>
                    </td>
                    <td>
                        <span class="status-badge badge-${user.status}">
                            ${getStatusLabel(user.status)}
                        </span>
                    </td>
                    <td style="color: var(--text-light); font-size: 13px;">
                        ${formatDate(user.tanggal_daftar)}
                    </td>
                    <td>
                        <div class="action-buttons">
                            <button type="button" class="btn-action btn-view" data-id="${user.id}" title="Lihat Detail">
                                <i class="fas fa-eye"></i>
                            </button>
                            <button type="button" class="btn-action btn-edit" data-id="${user.id}" title="Edit">
                                <i class="fas fa-edit"></i>
                            </button>
                            <button type="button" class="btn-action btn-delete" data-id="${user.id}" title="Hapus">
                                <i class="fas fa-trash"></i>
                            </button>
                            <button type="button" class="btn-action btn-reset" data-id="${user.id}" title="Reset Password">
                                <i class="fas fa-key"></i>
                            </button>
                        </div>
                    </td>
                `;
                
                userTableBody.appendChild(row);
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
    
    // Update statistics
    function updateStatistics() {
        const filteredData = filterData(userData);
        
        // Total user
        document.getElementById('totalUser').textContent = filteredData.length;
        
        // Count by role
        const manajerCount = filteredData.filter(user => user.role === 'manajer_lapangan').length;
        const karyawanCount = filteredData.filter(user => user.role === 'karyawan_lapangan').length;
        const supirCount = filteredData.filter(user => user.role === 'supir').length;
        
        document.getElementById('totalManajer').textContent = manajerCount;
        document.getElementById('totalKaryawan').textContent = karyawanCount;
        document.getElementById('totalSupir').textContent = supirCount;
    }
    
    // Filter data
    function filterData(data) {
        return data.filter(user => {
            // Filter role
            if (currentFilter.role && user.role !== currentFilter.role) return false;
            
            // Filter status
            if (currentFilter.status && user.status !== currentFilter.status) return false;
            
            // Filter search
            if (currentFilter.search) {
                const searchTerm = currentFilter.search.toLowerCase();
                const namaMatch = user.nama.toLowerCase().includes(searchTerm);
                const emailMatch = user.email.toLowerCase().includes(searchTerm);
                const idMatch = user.user_id.toLowerCase().includes(searchTerm);
                
                if (!namaMatch && !emailMatch && !idMatch) return false;
            }
            
            return true;
        }).sort((a, b) => b.id - a.id); // Sort by newest first
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
                loadUserTable();
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
                const userId = parseInt(this.dataset.id);
                const user = userData.find(u => u.id === userId);
                if (user) {
                    showDetailModal(user);
                }
            });
        });
        
        // Edit buttons
        document.querySelectorAll('.btn-action.btn-edit').forEach(btn => {
            btn.addEventListener('click', function() {
                const userId = parseInt(this.dataset.id);
                const user = userData.find(u => u.id === userId);
                if (user) {
                    editUser(user);
                }
            });
        });
        
        // Delete buttons
        document.querySelectorAll('.btn-action.btn-delete').forEach(btn => {
            btn.addEventListener('click', function() {
                const userId = parseInt(this.dataset.id);
                const user = userData.find(u => u.id === userId);
                if (user) {
                    showHapusModal(user);
                }
            });
        });
        
        // Reset password buttons
        document.querySelectorAll('.btn-action.btn-reset').forEach(btn => {
            btn.addEventListener('click', function() {
                const userId = parseInt(this.dataset.id);
                const user = userData.find(u => u.id === userId);
                if (user) {
                    showResetModal(user);
                }
            });
        });
    }
    
    // Show detail modal
    function showDetailModal(user) {
        selectedUserId = user.id;
        
        // Format tanggal
        const formatDateTime = (dateString) => {
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
        
        // Get initials
        const initials = user.nama.split(' ').map(n => n[0]).join('').toUpperCase();
        
        detailModalBody.innerHTML = `
            <div class="user-header">
                <div class="user-avatar">
                    ${initials}
                </div>
                <div class="user-title">
                    <h3>${user.nama}</h3>
                    <div class="user-subtitle">
                        <span class="role-badge badge-${user.role}">
                            <i class="fas fa-${getRoleIcon(user.role)}"></i>
                            ${getRoleLabel(user.role)}
                        </span>
                        <span class="status-badge badge-${user.status}" style="margin-left: 10px;">
                            ${getStatusLabel(user.status)}
                        </span>
                    </div>
                </div>
            </div>
            
            <div class="user-info-grid">
                <div class="info-card">
                    <div class="info-label">ID User</div>
                    <div class="info-value">${user.user_id}</div>
                    <div class="info-subvalue">User ID Sistem</div>
                </div>
                
                <div class="info-card">
                    <div class="info-label">Email</div>
                    <div class="info-value">${user.email}</div>
                    <div class="info-subvalue">Email login</div>
                </div>
                
                <div class="info-card">
                    <div class="info-label">Tanggal Daftar</div>
                    <div class="info-value">${formatDateTime(user.tanggal_daftar)}</div>
                    <div class="info-subvalue">Bergabung di sistem</div>
                </div>
                
                <div class="info-card">
                    <div class="info-label">Last Login</div>
                    <div class="info-value">${formatDateTime(user.last_login)}</div>
                    <div class="info-subvalue">Terakhir aktif</div>
                </div>
            </div>
            
            <div class="user-stats">
                <div class="stats-title">Statistik User</div>
                <div class="stats-grid-small">
                    <div class="stat-card-small">
                        <div class="stat-value-small">${user.stats.total_pengiriman}</div>
                        <div class="stat-label-small">Total Tugas</div>
                    </div>
                    <div class="stat-card-small">
                        <div class="stat-value-small">${user.stats.success_rate}</div>
                        <div class="stat-label-small">Success Rate</div>
                    </div>
                    <div class="stat-card-small">
                        <div class="stat-value-small">${user.stats.rating}/5</div>
                        <div class="stat-label-small">Rating</div>
                    </div>
                    <div class="stat-card-small">
                        <div class="stat-value-small">
                            ${user.status === 'aktif' ? 
                                '<i class="fas fa-check-circle" style="color: #4CAF50;"></i>' : 
                                '<i class="fas fa-times-circle" style="color: #F44336;"></i>'
                            }
                        </div>
                        <div class="stat-label-small">Status Akun</div>
                    </div>
                </div>
            </div>
            
            <div style="margin-top: 30px; padding: 20px; background: var(--light); border-radius: 8px;">
                <div style="font-size: 14px; font-weight: 600; color: var(--text-dark); margin-bottom: 10px;">
                    Informasi Akun
                </div>
                <div style="font-size: 13px; color: var(--text-light);">
                    <div style="margin-bottom: 5px;">Role: ${getRoleLabel(user.role)}</div>
                    <div style="margin-bottom: 5px;">Status: ${getStatusLabel(user.status)}</div>
                    <div>Password terakhir diubah: ${formatDateTime(user.tanggal_daftar)}</div>
                </div>
            </div>
        `;
        
        detailModal.style.display = 'flex';
        document.body.style.overflow = 'hidden';
    }
    
    // Edit user
    function editUser(user) {
        isEditMode = true;
        modalTitle.textContent = 'Edit Data User';
        
        // Fill form with user data
        userIdInput.value = user.id;
        idUserInput.value = user.user_id;
        namaUserInput.value = user.nama;
        emailUserInput.value = user.email;
        passwordUserInput.value = '********'; // Masked password
        confirmPasswordInput.value = '********';
        roleUserSelect.value = user.role;
        statusUserSelect.value = user.status;
        
        userModal.style.display = 'flex';
        document.body.style.overflow = 'hidden';
    }
    
    // Show hapus modal
    function showHapusModal(user) {
        selectedUserId = user.id;
        hapusMessage.textContent = `User ${user.nama} (${user.user_id}) akan dihapus secara permanen.`;
        hapusModal.style.display = 'flex';
        document.body.style.overflow = 'hidden';
    }
    
    // Show reset modal
    function showResetModal(user) {
        selectedUserId = user.id;
        resetUserInfo.innerHTML = `
            <div style="font-weight: 600;">${user.nama}</div>
            <div style="font-size: 12px; color: var(--text-light);">${user.user_id} • ${getRoleLabel(user.role)}</div>
        `;
        
        // Reset form
        newPasswordInput.value = '';
        confirmNewPasswordInput.value = '';
        newPasswordInput.type = 'password';
        toggleNewPasswordBtn.innerHTML = '<i class="fas fa-eye"></i>';
        
        resetModal.style.display = 'flex';
        document.body.style.overflow = 'hidden';
    }
    
    // Confirm hapus
    confirmHapusBtn.addEventListener('click', function() {
        if (selectedUserId) {
            userData = userData.filter(u => u.id !== selectedUserId);
            showNotification('Data user berhasil dihapus', 'success');
            hapusModal.style.display = 'none';
            document.body.style.overflow = 'auto';
            loadUserTable();
            updateStatistics();
        }
    });
    
    // Close modals
    document.querySelectorAll('.close-modal').forEach(btn => {
        btn.addEventListener('click', function() {
            userModal.style.display = 'none';
            document.body.style.overflow = 'auto';
        });
    });
    
    document.querySelector('.close-detail-modal').addEventListener('click', function() {
        detailModal.style.display = 'none';
        document.body.style.overflow = 'auto';
    });
    
    document.querySelector('.close-hapus-modal').addEventListener('click', function() {
        hapusModal.style.display = 'none';
        document.body.style.overflow = 'auto';
    });
    
    document.querySelector('.close-reset-modal').addEventListener('click', function() {
        resetModal.style.display = 'none';
        document.body.style.overflow = 'auto';
    });
    
    // Close modal when clicking outside
    [userModal, detailModal, hapusModal, resetModal].forEach(modal => {
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
            loadUserTable();
        }
    });
    
    document.querySelector('.btn-pagination.next').addEventListener('click', function() {
        const filteredData = filterData(userData);
        const totalPages = Math.ceil(filteredData.length / itemsPerPage);
        
        if (currentPage < totalPages) {
            currentPage++;
            loadUserTable();
        }
    });
    
    // Helper functions
    function resetForm() {
        userForm.reset();
        userIdInput.value = '';
        generateIdBtn.click(); // Auto generate ID
        passwordVisible = false;
        passwordUserInput.type = 'password';
        togglePasswordBtn.innerHTML = '<i class="fas fa-eye"></i>';
    }
    
    function validateForm() {
        if (!idUserInput.value.trim()) return false;
        if (!namaUserInput.value.trim()) return false;
        if (!emailUserInput.value.trim()) return false;
        if (!passwordUserInput.value) return false;
        if (!confirmPasswordInput.value) return false;
        if (!roleUserSelect.value) return false;
        if (!statusUserSelect.value) return false;
        return true;
    }
    
    function getStatusLabel(status) {
        return status === 'aktif' ? 'Aktif' : 'Nonaktif';
    }
    
    function getRoleLabel(role) {
        const labels = {
            'manajer_lapangan': 'Manajer Lapangan',
            'karyawan_lapangan': 'Karyawan Lapangan',
            'supir': 'Supir'
        };
        return labels[role] || role;
    }
    
    function getRoleIcon(role) {
        const icons = {
            'manajer_lapangan': 'user-tie',
            'karyawan_lapangan': 'user-hard-hat',
            'supir': 'truck'
        };
        return icons[role] || 'user';
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
            background: ${type === 'success' ? '#4CAF50' : type === 'warning' ? '#FF9800' : type === 'danger' ? '#F44336' : '#2196F3'};
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