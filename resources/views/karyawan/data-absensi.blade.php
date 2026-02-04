@extends('layouts.karyawan')

@section('title', 'Absensi Harian - PT. Mardua Holong')

@section('page-title', 'Absensi Harian')
@section('page-subtitle', 'Catatan Kehadiran Harian')

@section('content')
<div class="content-wrapper">
    <!-- Header -->
    <div class="content-header">
        <div class="header-left">
        </div>
        <div class="header-right">
            <button type="button" id="todayBtn" class="btn btn-primary">
                <i class="fas fa-calendar-day"></i> Hari Ini
            </button>
            <button type="button" id="printBtn" class="btn btn-secondary">
                <i class="fas fa-print"></i> Cetak
            </button>
        </div>
    </div>
    
    <!-- Form Absensi -->
    <div class="content-card">
        <div class="card-header">
            <div class="card-title">
                <i class="fas fa-clock"></i>
                <span>Form Absensi Harian</span>
            </div>
        </div>
        
        <!-- Alert Messages -->
        <div id="successAlert" class="alert alert-success" style="display: none;">
            <i class="fas fa-check-circle"></i>
            <span id="successMessage"></span>
        </div>
        
        <div id="errorAlert" class="alert alert-error" style="display: none;">
            <i class="fas fa-exclamation-circle"></i>
            <span id="errorMessage"></span>
        </div>
        
        <form id="absensiForm">
            <div class="form-grid">
                <!-- ID Karyawan -->
                <div class="form-group">
                    <label class="form-label">
                        <i class="fas fa-id-card"></i>
                        ID Karyawan *
                    </label>
                    <div class="input-with-icon">
                        <i class="fas fa-user"></i>
                        <input type="text" id="id_karyawan" name="id_karyawan" class="form-control" 
                               value="KRY-001" readonly required>
                    </div>
                    <small class="form-text">ID karyawan terdeteksi otomatis</small>
                </div>
                
                <!-- Tanggal Kerja -->
                <div class="form-group">
                    <label class="form-label">
                        <i class="fas fa-calendar-alt"></i>
                        Tanggal Kerja *
                    </label>
                    <div class="input-with-icon">
                        <i class="fas fa-calendar"></i>
                        <input type="date" id="tanggal_kerja" name="tanggal_kerja" class="form-control" 
                               value="{{ date('Y-m-d') }}" required>
                    </div>
                    <small class="form-text">Tanggal melakukan pekerjaan</small>
                </div>
            </div>
            
            <!-- Jam Masuk & Keluar -->
            <div class="form-grid">
                <!-- Jam Masuk -->
                <div class="form-group">
                    <label class="form-label">
                        <i class="fas fa-sign-in-alt"></i>
                        Jam Masuk *
                    </label>
                    <div class="input-with-icon">
                        <i class="fas fa-clock"></i>
                        <input type="time" id="jam_masuk" name="jam_masuk" class="form-control" required>
                    </div>
                    <small class="form-text">Waktu mulai bekerja</small>
                    
                    <!-- Quick Action Buttons -->
                    <div class="quick-actions" style="margin-top: 10px;">
                        <button type="button" class="btn-time" data-time="07:00">
                            <i class="fas fa-sun"></i> 07:00
                        </button>
                        <button type="button" class="btn-time" data-time="08:00">
                            <i class="fas fa-building"></i> 08:00
                        </button>
                        <button type="button" id="nowBtn" class="btn-time now">
                            <i class="fas fa-clock"></i> Sekarang
                        </button>
                    </div>
                </div>
                
                <!-- Jam Keluar -->
                <div class="form-group">
                    <label class="form-label">
                        <i class="fas fa-sign-out-alt"></i>
                        Jam Keluar *
                    </label>
                    <div class="input-with-icon">
                        <i class="fas fa-clock"></i>
                        <input type="time" id="jam_keluar" name="jam_keluar" class="form-control" required>
                    </div>
                    <small class="form-text">Waktu selesai bekerja</small>
                    
                    <!-- Quick Action Buttons -->
                    <div class="quick-actions" style="margin-top: 10px;">
                        <button type="button" class="btn-time" data-time="16:00">
                            <i class="fas fa-home"></i> 16:00
                        </button>
                        <button type="button" class="btn-time" data-time="17:00">
                            <i class="fas fa-moon"></i> 17:00
                        </button>
                        <button type="button" id="nowOutBtn" class="btn-time now">
                            <i class="fas fa-clock"></i> Sekarang
                        </button>
                    </div>
                </div>
            </div>
            
            <!-- Jam Kerja Total -->
            <div class="form-section">
                <div class="form-group">
                    <label class="form-label">
                        <i class="fas fa-calculator"></i>
                        Jam Kerja Total
                    </label>
                    <div id="jamKerjaContainer">
                        <div class="jam-kerja-display">
                            <div class="jam-kerja-value" id="jamKerjaValue">0 jam 0 menit</div>
                            <div class="jam-kerja-detail" id="jamKerjaDetail">(0 menit)</div>
                        </div>
                        <input type="hidden" id="jam_kerja_total" name="jam_kerja_total" value="0">
                    </div>
                    <small class="form-text">Total jam kerja dihitung otomatis</small>
                    
                    <!-- Jam Kerja Indicator -->
                    <div class="jam-indicator" style="margin-top: 15px;">
                        <div class="indicator-labels">
                            <span>Kurang</span>
                            <span>Normal</span>
                            <span>Lembur</span>
                        </div>
                        <div class="indicator-bar">
                            <div id="jamMarker" class="indicator-marker"></div>
                        </div>
                        <div class="indicator-range">
                            <span style="color: #F44336;">&lt; 7 jam</span>
                            <span style="color: #4CAF50;">7-8 jam</span>
                            <span style="color: #FF9800;">&gt; 8 jam</span>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Catatan (Opsional) -->
            <div class="form-section">
                <div class="form-group">
                    <label class="form-label">
                        <i class="fas fa-sticky-note"></i>
                        Catatan (Opsional)
                    </label>
                    <textarea id="catatan" name="catatan" class="form-control" rows="3" 
                              placeholder="Masukkan catatan tambahan jika ada (contoh: lembur, rapat, dll)..."></textarea>
                </div>
            </div>
            
            <!-- Tombol Aksi -->
            <div class="form-actions">
                <button type="button" id="resetBtn" class="btn btn-secondary">
                    <i class="fas fa-redo"></i> Reset Form
                </button>
                <button type="submit" id="submitBtn" class="btn btn-success">
                    <i class="fas fa-save"></i> Simpan Absensi
                </button>
            </div>
        </form>
    </div>
    
    <!-- Riwayat Absensi -->
    <div class="content-card">
        <div class="card-header">
            <div class="card-title">
                <i class="fas fa-history"></i>
                <span>Riwayat Absensi Bulan Ini</span>
            </div>
            <div class="card-actions">
                <div class="month-selector">
                    <button type="button" id="prevMonth" class="btn-month">
                        <i class="fas fa-chevron-left"></i>
                    </button>
                    <span id="currentMonth">{{ date('F Y') }}</span>
                    <button type="button" id="nextMonth" class="btn-month">
                        <i class="fas fa-chevron-right"></i>
                    </button>
                </div>
            </div>
        </div>
        
        <!-- Statistik -->
        <div class="stats-grid" style="margin-bottom: 25px;">
            <div class="stat-card">
                <div class="stat-icon" style="color: #4CAF50;">
                    <i class="fas fa-calendar-check"></i>
                </div>
                <div class="stat-number" id="totalHari">0</div>
                <div class="stat-label">Hari Kerja</div>
            </div>
            
            <div class="stat-card">
                <div class="stat-icon" style="color: #2196F3;">
                    <i class="fas fa-clock"></i>
                </div>
                <div class="stat-number" id="totalJam">0</div>
                <div class="stat-label">Total Jam</div>
            </div>
            
            <div class="stat-card">
                <div class="stat-icon" style="color: #FF9800;">
                    <i class="fas fa-running"></i>
                </div>
                <div class="stat-number" id="rataRata">0</div>
                <div class="stat-label">Rata-rata/jam</div>
            </div>
            
            <div class="stat-card">
                <div class="stat-icon" style="color: #9C27B0;">
                    <i class="fas fa-business-time"></i>
                </div>
                <div class="stat-number" id="totalLembur">0</div>
                <div class="stat-label">Jam Lembur</div>
            </div>
        </div>
        
        <!-- Tabel Riwayat -->
        <div class="table-responsive">
            <table class="data-table">
                <thead>
                    <tr>
                        <th style="width: 50px;">No</th>
                        <th>Tanggal</th>
                        <th>Jam Masuk</th>
                        <th>Jam Keluar</th>
                        <th>Total Jam</th>
                        <th>Status</th>
                        <th style="width: 100px;">Aksi</th>
                    </tr>
                </thead>
                <tbody id="absensiTableBody">
                    <!-- Data akan diisi oleh JavaScript -->
                </tbody>
            </table>
        </div>
        
        <!-- Pagination -->
        <div class="table-footer">
            <div class="showing-count">
                Menampilkan <span id="showingCount">0</span> dari <span id="totalCount">0</span> absensi
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

<!-- Modal Edit Absensi -->
<div id="editModal" class="modal">
    <div class="modal-content">
        <div class="modal-header">
            <h3 class="modal-title">Edit Data Absensi</h3>
            <button type="button" class="close-edit-modal">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <div class="modal-body">
            <form id="editAbsensiForm">
                <input type="hidden" id="edit_id" name="id">
                
                <div class="form-group">
                    <label class="form-label">Tanggal Kerja *</label>
                    <input type="date" id="edit_tanggal_kerja" name="tanggal_kerja" class="form-control" required>
                </div>
                
                <div class="form-grid">
                    <div class="form-group">
                        <label class="form-label">Jam Masuk *</label>
                        <input type="time" id="edit_jam_masuk" name="jam_masuk" class="form-control" required>
                    </div>
                    
                    <div class="form-group">
                        <label class="form-label">Jam Keluar *</label>
                        <input type="time" id="edit_jam_keluar" name="jam_keluar" class="form-control" required>
                    </div>
                </div>
                
                <div class="form-group">
                    <label class="form-label">Total Jam Kerja</label>
                    <div id="editJamKerjaContainer">
                        <div class="jam-kerja-display">
                            <div class="jam-kerja-value" id="editJamKerjaValue">0 jam 0 menit</div>
                            <div class="jam-kerja-detail" id="editJamKerjaDetail">(0 menit)</div>
                        </div>
                        <input type="hidden" id="edit_jam_kerja_total" name="jam_kerja_total" value="0">
                    </div>
                </div>
                
                <div class="form-group">
                    <label class="form-label">Catatan</label>
                    <textarea id="edit_catatan" name="catatan" class="form-control" rows="3"></textarea>
                </div>
            </form>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" id="cancelEditBtn">Batal</button>
            <button type="button" class="btn btn-primary" id="saveEditBtn">Simpan Perubahan</button>
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
    
    .card-actions {
        display: flex;
        align-items: center;
        gap: 10px;
    }
    
    /* Month Selector */
    .month-selector {
        display: flex;
        align-items: center;
        gap: 15px;
        padding: 8px 15px;
        background-color: var(--light);
        border-radius: 8px;
    }
    
    .btn-month {
        background: none;
        border: none;
        color: var(--text-light);
        cursor: pointer;
        font-size: 14px;
        width: 30px;
        height: 30px;
        border-radius: 6px;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: var(--transition);
    }
    
    .btn-month:hover {
        background-color: var(--primary-lighter);
        color: var(--primary);
    }
    
    #currentMonth {
        font-weight: 600;
        color: var(--text-dark);
        min-width: 120px;
        text-align: center;
    }
    
    /* Alert Styles */
    .alert {
        padding: 15px 20px;
        border-radius: 8px;
        margin-bottom: 20px;
        display: flex;
        align-items: center;
        gap: 12px;
        animation: slideDown 0.3s ease;
    }
    
    .alert-success {
        background-color: #d4edda;
        border: 1px solid #c3e6cb;
        color: #155724;
    }
    
    .alert-error {
        background-color: #f8d7da;
        border: 1px solid #f5c6cb;
        color: #721c24;
    }
    
    @keyframes slideDown {
        from {
            transform: translateY(-20px);
            opacity: 0;
        }
        to {
            transform: translateY(0);
            opacity: 1;
        }
    }
    
    /* Form Styles */
    .form-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 20px;
        margin-bottom: 20px;
    }
    
    .form-section {
        margin-bottom: 25px;
        padding-bottom: 25px;
        border-bottom: 1px solid var(--border);
    }
    
    .form-section:last-child {
        border-bottom: none;
    }
    
    .form-group {
        margin-bottom: 20px;
    }
    
    .form-label {
        display: flex;
        align-items: center;
        gap: 8px;
        margin-bottom: 8px;
        font-weight: 500;
        color: var(--text-dark);
        font-size: 14px;
    }
    
    /* Input with Icon */
    .input-with-icon {
        position: relative;
    }
    
    .input-with-icon i {
        position: absolute;
        left: 15px;
        top: 50%;
        transform: translateY(-50%);
        color: var(--text-light);
        font-size: 16px;
        z-index: 1;
    }
    
    .input-with-icon .form-control {
        padding-left: 45px;
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
    
    .form-control[readonly] {
        background-color: var(--light);
        cursor: not-allowed;
    }
    
    .form-text {
        display: block;
        margin-top: 5px;
        font-size: 12px;
        color: var(--text-light);
    }
    
    /* Quick Actions */
    .quick-actions {
        display: flex;
        gap: 8px;
        flex-wrap: wrap;
    }
    
    .btn-time {
        padding: 6px 12px;
        border: 1px solid var(--border);
        background-color: var(--light);
        color: var(--text-dark);
        border-radius: 6px;
        font-size: 13px;
        cursor: pointer;
        transition: var(--transition);
        display: flex;
        align-items: center;
        gap: 5px;
    }
    
    .btn-time:hover {
        background-color: var(--primary-lighter);
        border-color: var(--primary);
        color: var(--primary);
    }
    
    .btn-time.now {
        background-color: var(--primary-lighter);
        color: var(--primary);
        border-color: var(--primary);
    }
    
    .btn-time.now:hover {
        background-color: var(--primary);
        color: white;
    }
    
    /* Jam Kerja Display */
    .jam-kerja-display {
        background-color: var(--light);
        padding: 15px;
        border-radius: 8px;
        text-align: center;
        border: 1px solid var(--border);
    }
    
    .jam-kerja-value {
        font-size: 24px;
        font-weight: 700;
        color: var(--primary);
        margin-bottom: 5px;
    }
    
    .jam-kerja-detail {
        font-size: 14px;
        color: var(--text-light);
    }
    
    /* Jam Indicator */
    .jam-indicator {
        margin-top: 15px;
    }
    
    .indicator-labels {
        display: flex;
        justify-content: space-between;
        margin-bottom: 5px;
        font-size: 12px;
        color: var(--text-light);
    }
    
    .indicator-bar {
        height: 8px;
        background: linear-gradient(to right, #F44336, #FFEB3B, #FF9800);
        border-radius: 4px;
        position: relative;
    }
    
    .indicator-marker {
        position: absolute;
        top: -4px;
        width: 16px;
        height: 16px;
        background-color: var(--primary);
        border-radius: 50%;
        border: 2px solid white;
        box-shadow: 0 2px 4px rgba(0,0,0,0.2);
        transform: translateX(-8px);
    }
    
    .indicator-range {
        display: flex;
        justify-content: space-between;
        margin-top: 5px;
        font-size: 11px;
    }
    
    /* Stats Grid */
    .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
        gap: 15px;
        margin-bottom: 25px;
    }
    
    .stat-card {
        text-align: center;
        padding: 15px;
        background-color: var(--light);
        border-radius: 10px;
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
        font-size: 24px;
        font-weight: 700;
        color: var(--text-dark);
        margin-bottom: 5px;
    }
    
    .stat-label {
        font-size: 13px;
        color: var(--text-light);
    }
    
    /* Form Actions */
    .form-actions {
        display: flex;
        gap: 10px;
        margin-top: 30px;
    }
    
    @media (max-width: 576px) {
        .form-actions {
            flex-direction: column;
        }
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
        background-color: #218838;
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
        padding: 4px 8px;
        border-radius: 4px;
        font-size: 12px;
        font-weight: 600;
        text-align: center;
        min-width: 80px;
    }
    
    .badge-normal {
        background-color: #E8F5E9;
        color: #2E7D32;
        border: 1px solid #C8E6C9;
    }
    
    .badge-kurang {
        background-color: #FFEBEE;
        color: #C62828;
        border: 1px solid #FFCDD2;
    }
    
    .badge-lembur {
        background-color: #FFF3E0;
        color: #EF6C00;
        border: 1px solid #FFE0B2;
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
    
    .btn-edit {
        background-color: #FFF3CD;
        color: #856404;
    }
    
    .btn-edit:hover {
        background-color: #FFEAA7;
    }
    
    .btn-delete {
        background-color: #FFEBEE;
        color: var(--danger);
    }
    
    .btn-delete:hover {
        background-color: #FFCDD2;
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
        max-width: 500px;
        max-height: 90vh;
        overflow-y: auto;
        animation: modalFadeIn 0.3s ease;
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
    
    .close-edit-modal {
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
    
    .close-edit-modal:hover {
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
        
        .card-header {
            flex-direction: column;
            align-items: flex-start;
        }
        
        .stats-grid {
            grid-template-columns: repeat(2, 1fr);
        }
        
        .modal-footer {
            flex-direction: column;
        }
    }
    
    @media (max-width: 576px) {
        .form-grid {
            grid-template-columns: 1fr;
        }
        
        .stats-grid {
            grid-template-columns: 1fr;
        }
        
        .table-footer {
            flex-direction: column;
            align-items: stretch;
        }
        
        .pagination {
            justify-content: center;
        }
        
        .quick-actions {
            flex-direction: column;
        }
        
        .btn-time {
            justify-content: center;
        }
    }
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Data dummy absensi
    let absensiData = [
        {
            id: 1,
            id_karyawan: "KRY-001",
            tanggal_kerja: "2024-03-28",
            jam_masuk: "07:30",
            jam_keluar: "16:30",
            jam_kerja_total: 540, // 9 jam dalam menit
            status: "normal",
            catatan: "Kerja seperti biasa"
        },
        {
            id: 2,
            id_karyawan: "KRY-001",
            tanggal_kerja: "2024-03-27",
            jam_masuk: "08:00",
            jam_keluar: "17:00",
            jam_kerja_total: 540,
            status: "normal",
            catatan: ""
        },
        {
            id: 3,
            id_karyawan: "KRY-001",
            tanggal_kerja: "2024-03-26",
            jam_masuk: "07:00",
            jam_keluar: "18:00",
            jam_kerja_total: 660,
            status: "lembur",
            catatan: "Lembur proyek"
        },
        {
            id: 4,
            id_karyawan: "KRY-001",
            tanggal_kerja: "2024-03-25",
            jam_masuk: "09:00",
            jam_keluar: "16:00",
            jam_kerja_total: 420,
            status: "kurang",
            catatan: "Datang terlambat"
        },
        {
            id: 5,
            id_karyawan: "KRY-001",
            tanggal_kerja: "2024-03-24",
            jam_masuk: "08:30",
            jam_keluar: "17:30",
            jam_kerja_total: 540,
            status: "normal",
            catatan: ""
        },
        {
            id: 6,
            id_karyawan: "KRY-001",
            tanggal_kerja: "2024-03-23",
            jam_masuk: "07:15",
            jam_keluar: "16:15",
            jam_kerja_total: 540,
            status: "normal",
            catatan: "Kerja Sabtu"
        },
        {
            id: 7,
            id_karyawan: "KRY-001",
            tanggal_kerja: "2024-03-22",
            jam_masuk: "08:45",
            jam_keluar: "17:45",
            jam_kerja_total: 540,
            status: "normal",
            catatan: ""
        },
        {
            id: 8,
            id_karyawan: "KRY-001",
            tanggal_kerja: "2024-03-21",
            jam_masuk: "07:00",
            jam_keluar: "19:00",
            jam_kerja_total: 720,
            status: "lembur",
            catatan: "Lembur hingga malam"
        }
    ];
    
    // Elemen DOM
    const absensiForm = document.getElementById('absensiForm');
    const idKaryawanInput = document.getElementById('id_karyawan');
    const tanggalKerjaInput = document.getElementById('tanggal_kerja');
    const jamMasukInput = document.getElementById('jam_masuk');
    const jamKeluarInput = document.getElementById('jam_keluar');
    const jamKerjaValue = document.getElementById('jamKerjaValue');
    const jamKerjaDetail = document.getElementById('jamKerjaDetail');
    const jamKerjaTotalInput = document.getElementById('jam_kerja_total');
    const jamMarker = document.getElementById('jamMarker');
    const nowBtn = document.getElementById('nowBtn');
    const nowOutBtn = document.getElementById('nowOutBtn');
    const resetBtn = document.getElementById('resetBtn');
    const submitBtn = document.getElementById('submitBtn');
    const successAlert = document.getElementById('successAlert');
    const successMessage = document.getElementById('successMessage');
    const errorAlert = document.getElementById('errorAlert');
    const errorMessage = document.getElementById('errorMessage');
    const todayBtn = document.getElementById('todayBtn');
    const printBtn = document.getElementById('printBtn');
    const absensiTableBody = document.getElementById('absensiTableBody');
    const prevMonthBtn = document.getElementById('prevMonth');
    const nextMonthBtn = document.getElementById('nextMonth');
    const currentMonthSpan = document.getElementById('currentMonth');
    const totalHariSpan = document.getElementById('totalHari');
    const totalJamSpan = document.getElementById('totalJam');
    const rataRataSpan = document.getElementById('rataRata');
    const totalLemburSpan = document.getElementById('totalLembur');
    const editModal = document.getElementById('editModal');
    
    // State
    let currentPage = 1;
    let currentMonth = new Date().getMonth();
    let currentYear = new Date().getFullYear();
    const itemsPerPage = 5;
    
    // Initialize
    setCurrentTime();
    calculateJamKerja();
    updateMonthDisplay();
    loadAbsensiTable();
    updateStatistics();
    
    // Set current time to inputs
    function setCurrentTime() {
        const now = new Date();
        const timeString = now.toTimeString().slice(0, 5);
        
        // Set default jam masuk (1 jam yang lalu)
        const oneHourAgo = new Date(now.getTime() - 60 * 60 * 1000);
        const masukTimeString = oneHourAgo.toTimeString().slice(0, 5);
        
        jamMasukInput.value = masukTimeString;
        jamKeluarInput.value = timeString;
    }
    
    // Calculate jam kerja
    function calculateJamKerja() {
        const jamMasuk = jamMasukInput.value;
        const jamKeluar = jamKeluarInput.value;
        
        if (!jamMasuk || !jamKeluar) return;
        
        const [masukHour, masukMinute] = jamMasuk.split(':').map(Number);
        const [keluarHour, keluarMinute] = jamKeluar.split(':').map(Number);
        
        let masukTotalMinutes = masukHour * 60 + masukMinute;
        let keluarTotalMinutes = keluarHour * 60 + keluarMinute;
        
        // Jika jam keluar lebih kecil dari jam masuk (lembur hingga besok)
        if (keluarTotalMinutes < masukTotalMinutes) {
            keluarTotalMinutes += 24 * 60; // Tambah 24 jam
        }
        
        const totalMinutes = keluarTotalMinutes - masukTotalMinutes;
        
        // Hitung jam dan menit
        const hours = Math.floor(totalMinutes / 60);
        const minutes = totalMinutes % 60;
        
        // Update display
        jamKerjaValue.textContent = `${hours} jam ${minutes} menit`;
        jamKerjaDetail.textContent = `(${totalMinutes} menit)`;
        jamKerjaTotalInput.value = totalMinutes;
        
        // Update indicator
        updateJamIndicator(totalMinutes);
        
        // Update edit modal jika terbuka
        if (editModal.style.display === 'flex') {
            const editJamMasuk = document.getElementById('edit_jam_masuk').value;
            const editJamKeluar = document.getElementById('edit_jam_keluar').value;
            
            if (editJamMasuk && editJamKeluar) {
                calculateEditJamKerja();
            }
        }
    }
    
    // Update jam indicator
    function updateJamIndicator(totalMinutes) {
        const maxJam = 12 * 60; // 12 jam max untuk skala
        const percentage = Math.min(totalMinutes / maxJam * 100, 100);
        jamMarker.style.left = `calc(${percentage}% - 8px)`;
        
        if (totalMinutes < 7 * 60) { // Kurang dari 7 jam
            jamMarker.style.backgroundColor = '#F44336';
            jamKerjaValue.style.color = '#F44336';
        } else if (totalMinutes <= 8 * 60) { // 7-8 jam (normal)
            jamMarker.style.backgroundColor = '#4CAF50';
            jamKerjaValue.style.color = '#4CAF50';
        } else { // Lebih dari 8 jam (lembur)
            jamMarker.style.backgroundColor = '#FF9800';
            jamKerjaValue.style.color = '#FF9800';
        }
    }
    
    // Update month display
    function updateMonthDisplay() {
        const monthNames = [
            "Januari", "Februari", "Maret", "April", "Mei", "Juni",
            "Juli", "Agustus", "September", "Oktober", "November", "Desember"
        ];
        currentMonthSpan.textContent = `${monthNames[currentMonth]} ${currentYear}`;
    }
    
    // Event listeners for jam inputs
    jamMasukInput.addEventListener('input', calculateJamKerja);
    jamKeluarInput.addEventListener('input', calculateJamKerja);
    
    // Quick action buttons
    document.querySelectorAll('.btn-time').forEach(btn => {
        if (btn.id !== 'nowBtn' && btn.id !== 'nowOutBtn') {
            btn.addEventListener('click', function() {
                const time = this.getAttribute('data-time');
                if (this.closest('.form-group').querySelector('label').textContent.includes('Masuk')) {
                    jamMasukInput.value = time;
                } else {
                    jamKeluarInput.value = time;
                }
                calculateJamKerja();
            });
        }
    });
    
    // Now button
    nowBtn.addEventListener('click', function() {
        const now = new Date();
        const timeString = now.toTimeString().slice(0, 5);
        jamMasukInput.value = timeString;
        calculateJamKerja();
    });
    
    // Now out button
    nowOutBtn.addEventListener('click', function() {
        const now = new Date();
        const timeString = now.toTimeString().slice(0, 5);
        jamKeluarInput.value = timeString;
        calculateJamKerja();
    });
    
    // Today button
    todayBtn.addEventListener('click', function() {
        const today = new Date().toISOString().split('T')[0];
        tanggalKerjaInput.value = today;
        setCurrentTime();
        calculateJamKerja();
    });
    
    // Reset form
    resetBtn.addEventListener('click', function() {
        if (confirm('Apakah Anda yakin ingin mereset form? Semua data yang telah diisi akan hilang.')) {
            absensiForm.reset();
            idKaryawanInput.value = 'KRY-001'; // Reset ID tetap sama
            tanggalKerjaInput.value = new Date().toISOString().split('T')[0];
            setCurrentTime();
            calculateJamKerja();
            successAlert.style.display = 'none';
            errorAlert.style.display = 'none';
        }
    });
    
    // Submit form
    absensiForm.addEventListener('submit', function(e) {
        e.preventDefault();
        
        // Validasi
        const errors = [];
        
        if (!jamMasukInput.value) {
            errors.push('Jam masuk harus diisi');
        }
        
        if (!jamKeluarInput.value) {
            errors.push('Jam keluar harus diisi');
        }
        
        const jamMasuk = jamMasukInput.value;
        const jamKeluar = jamKeluarInput.value;
        const [masukHour, masukMinute] = jamMasuk.split(':').map(Number);
        const [keluarHour, keluarMinute] = jamKeluar.split(':').map(Number);
        
        let masukTotalMinutes = masukHour * 60 + masukMinute;
        let keluarTotalMinutes = keluarHour * 60 + keluarMinute;
        
        if (keluarTotalMinutes <= masukTotalMinutes) {
            keluarTotalMinutes += 24 * 60;
        }
        
        const totalMinutes = keluarTotalMinutes - masukTotalMinutes;
        
        if (totalMinutes < 60) { // Minimal 1 jam
            errors.push('Jam kerja minimal 1 jam');
        }
        
        if (totalMinutes > 24 * 60) { // Maksimal 24 jam
            errors.push('Jam kerja maksimal 24 jam');
        }
        
        if (errors.length > 0) {
            showError(errors.join('<br>'));
            return;
        }
        
        // Tentukan status
        let status = 'normal';
        if (totalMinutes < 7 * 60) {
            status = 'kurang';
        } else if (totalMinutes > 8 * 60) {
            status = 'lembur';
        }
        
        // Simpan data
        const newAbsensi = {
            id: Date.now(),
            id_karyawan: idKaryawanInput.value,
            tanggal_kerja: tanggalKerjaInput.value,
            jam_masuk: jamMasukInput.value,
            jam_keluar: jamKeluarInput.value,
            jam_kerja_total: totalMinutes,
            status: status,
            catatan: document.getElementById('catatan').value.trim()
        };
        
        absensiData.unshift(newAbsensi);
        
        // Reset form
        absensiForm.reset();
        idKaryawanInput.value = 'KRY-001';
        tanggalKerjaInput.value = new Date().toISOString().split('T')[0];
        setCurrentTime();
        calculateJamKerja();
        
        // Update tabel dan statistik
        loadAbsensiTable();
        updateStatistics();
        
        // Show success
        showSuccess(`Absensi berhasil disimpan! Total kerja: ${Math.floor(totalMinutes/60)} jam ${totalMinutes%60} menit`);
        
        // Scroll to top
        window.scrollTo({ top: 0, behavior: 'smooth' });
    });
    
    // Show success message
    function showSuccess(message) {
        successMessage.innerHTML = message;
        successAlert.style.display = 'flex';
        errorAlert.style.display = 'none';
        
        setTimeout(() => {
            successAlert.style.display = 'none';
        }, 5000);
    }
    
    // Show error message
    function showError(message) {
        errorMessage.innerHTML = message;
        errorAlert.style.display = 'flex';
        successAlert.style.display = 'none';
        
        setTimeout(() => {
            errorAlert.style.display = 'none';
        }, 5000);
    }
    
    // Load absensi table
    function loadAbsensiTable() {
        absensiTableBody.innerHTML = '';
        
        // Filter data berdasarkan bulan
        const filteredData = absensiData.filter(absensi => {
            const absensiDate = new Date(absensi.tanggal_kerja);
            return absensiDate.getMonth() === currentMonth && 
                   absensiDate.getFullYear() === currentYear;
        });
        
        const startIndex = (currentPage - 1) * itemsPerPage;
        const endIndex = startIndex + itemsPerPage;
        const pageData = filteredData.slice(startIndex, endIndex);
        
        if (pageData.length === 0) {
            absensiTableBody.innerHTML = `
                <tr>
                    <td colspan="7" style="text-align: center; padding: 40px; color: var(--text-light);">
                        <i class="fas fa-clock" style="font-size: 40px; margin-bottom: 10px; opacity: 0.5; display: block;"></i>
                        <div>Tidak ada data absensi untuk bulan ini</div>
                    </td>
                </tr>
            `;
        } else {
            pageData.forEach((absensi, index) => {
                const globalIndex = startIndex + index + 1;
                const row = document.createElement('tr');
                
                // Format tanggal
                const tanggal = new Date(absensi.tanggal_kerja);
                const formattedDate = tanggal.toLocaleDateString('id-ID', {
                    day: '2-digit',
                    month: 'short',
                    year: 'numeric'
                });
                
                // Hitung jam dan menit
                const hours = Math.floor(absensi.jam_kerja_total / 60);
                const minutes = absensi.jam_kerja_total % 60;
                const jamKerjaText = `${hours} jam ${minutes} menit`;
                
                // Status badge
                let statusClass, statusText;
                switch(absensi.status) {
                    case 'normal':
                        statusClass = 'badge-normal';
                        statusText = 'Normal';
                        break;
                    case 'kurang':
                        statusClass = 'badge-kurang';
                        statusText = 'Kurang';
                        break;
                    case 'lembur':
                        statusClass = 'badge-lembur';
                        statusText = 'Lembur';
                        break;
                }
                
                row.innerHTML = `
                    <td style="color: var(--text-light);">${globalIndex}</td>
                    <td style="font-weight: 600; color: var(--text-dark);">${formattedDate}</td>
                    <td style="font-family: monospace; font-size: 15px; font-weight: 600; color: var(--primary);">
                        ${absensi.jam_masuk}
                    </td>
                    <td style="font-family: monospace; font-size: 15px; font-weight: 600; color: var(--danger);">
                        ${absensi.jam_keluar}
                    </td>
                    <td>
                        <div style="font-weight: 600; color: ${getJamColor(absensi.jam_kerja_total)};">
                            ${jamKerjaText}
                        </div>
                        <div style="font-size: 12px; color: var(--text-light);">
                            (${absensi.jam_kerja_total} menit)
                        </div>
                    </td>
                    <td>
                        <span class="status-badge ${statusClass}">
                            ${statusText}
                        </span>
                    </td>
                    <td>
                        <div class="action-buttons">
                            <button type="button" class="btn-action btn-edit" data-id="${absensi.id}" title="Edit Data">
                                <i class="fas fa-edit"></i>
                            </button>
                            <button type="button" class="btn-action btn-delete" data-id="${absensi.id}" title="Hapus Data">
                                <i class="fas fa-trash"></i>
                            </button>
                        </div>
                    </td>
                `;
                
                absensiTableBody.appendChild(row);
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
    
    // Get jam color
    function getJamColor(totalMinutes) {
        if (totalMinutes < 7 * 60) return '#F44336';
        if (totalMinutes <= 8 * 60) return '#4CAF50';
        return '#FF9800';
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
                loadAbsensiTable();
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
    
    // Update statistics
    function updateStatistics() {
        // Filter data bulan ini
        const thisMonthData = absensiData.filter(absensi => {
            const absensiDate = new Date(absensi.tanggal_kerja);
            return absensiDate.getMonth() === currentMonth && 
                   absensiDate.getFullYear() === currentYear;
        });
        
        if (thisMonthData.length === 0) {
            totalHariSpan.textContent = '0';
            totalJamSpan.textContent = '0';
            rataRataSpan.textContent = '0';
            totalLemburSpan.textContent = '0';
            return;
        }
        
        // Hitung total hari
        totalHariSpan.textContent = thisMonthData.length;
        
        // Hitung total jam dalam menit
        const totalMenit = thisMonthData.reduce((sum, absensi) => sum + absensi.jam_kerja_total, 0);
        const totalJam = Math.floor(totalMenit / 60);
        totalJamSpan.textContent = totalJam;
        
        // Hitung rata-rata per hari
        const rataRata = Math.round(totalMenit / thisMonthData.length / 60 * 10) / 10;
        rataRataSpan.textContent = rataRata.toFixed(1);
        
        // Hitung total lembur (jam > 8 jam = 480 menit)
        const totalLemburMenit = thisMonthData.reduce((sum, absensi) => {
            return sum + Math.max(0, absensi.jam_kerja_total - 480);
        }, 0);
        const totalLemburJam = Math.floor(totalLemburMenit / 60);
        totalLemburSpan.textContent = totalLemburJam;
    }
    
    // Add action listeners
    function addActionListeners() {
        // Edit buttons
        document.querySelectorAll('.btn-action.btn-edit').forEach(btn => {
            btn.addEventListener('click', function() {
                const absensiId = parseInt(this.dataset.id);
                const absensi = absensiData.find(a => a.id === absensiId);
                if (absensi) {
                    openEditModal(absensi);
                }
            });
        });
        
        // Delete buttons
        document.querySelectorAll('.btn-action.btn-delete').forEach(btn => {
            btn.addEventListener('click', function() {
                const absensiId = parseInt(this.dataset.id);
                deleteAbsensi(absensiId);
            });
        });
    }
    
    // Open edit modal
    function openEditModal(absensi) {
        document.getElementById('edit_id').value = absensi.id;
        document.getElementById('edit_tanggal_kerja').value = absensi.tanggal_kerja;
        document.getElementById('edit_jam_masuk').value = absensi.jam_masuk;
        document.getElementById('edit_jam_keluar').value = absensi.jam_keluar;
        document.getElementById('edit_catatan').value = absensi.catatan || '';
        
        // Calculate and display jam kerja
        calculateEditJamKerja();
        
        editModal.style.display = 'flex';
        document.body.style.overflow = 'hidden';
    }
    
    // Calculate jam kerja for edit modal
    function calculateEditJamKerja() {
        const jamMasuk = document.getElementById('edit_jam_masuk').value;
        const jamKeluar = document.getElementById('edit_jam_keluar').value;
        
        if (!jamMasuk || !jamKeluar) return;
        
        const [masukHour, masukMinute] = jamMasuk.split(':').map(Number);
        const [keluarHour, keluarMinute] = jamKeluar.split(':').map(Number);
        
        let masukTotalMinutes = masukHour * 60 + masukMinute;
        let keluarTotalMinutes = keluarHour * 60 + keluarMinute;
        
        if (keluarTotalMinutes < masukTotalMinutes) {
            keluarTotalMinutes += 24 * 60;
        }
        
        const totalMinutes = keluarTotalMinutes - masukTotalMinutes;
        
        // Hitung jam dan menit
        const hours = Math.floor(totalMinutes / 60);
        const minutes = totalMinutes % 60;
        
        // Update display
        document.getElementById('editJamKerjaValue').textContent = `${hours} jam ${minutes} menit`;
        document.getElementById('editJamKerjaDetail').textContent = `(${totalMinutes} menit)`;
        document.getElementById('edit_jam_kerja_total').value = totalMinutes;
        
        // Update color
        const editJamKerjaValue = document.getElementById('editJamKerjaValue');
        if (totalMinutes < 7 * 60) {
            editJamKerjaValue.style.color = '#F44336';
        } else if (totalMinutes <= 8 * 60) {
            editJamKerjaValue.style.color = '#4CAF50';
        } else {
            editJamKerjaValue.style.color = '#FF9800';
        }
    }
    
    // Event listeners for edit modal inputs
    document.getElementById('edit_jam_masuk').addEventListener('input', calculateEditJamKerja);
    document.getElementById('edit_jam_keluar').addEventListener('input', calculateEditJamKerja);
    
    // Save edit
    document.getElementById('saveEditBtn').addEventListener('click', function() {
        const id = parseInt(document.getElementById('edit_id').value);
        const tanggal_kerja = document.getElementById('edit_tanggal_kerja').value;
        const jam_masuk = document.getElementById('edit_jam_masuk').value;
        const jam_keluar = document.getElementById('edit_jam_keluar').value;
        const catatan = document.getElementById('edit_catatan').value.trim();
        
        // Validasi
        const errors = [];
        
        if (!jam_masuk) {
            errors.push('Jam masuk harus diisi');
        }
        
        if (!jam_keluar) {
            errors.push('Jam keluar harus diisi');
        }
        
        const [masukHour, masukMinute] = jam_masuk.split(':').map(Number);
        const [keluarHour, keluarMinute] = jam_keluar.split(':').map(Number);
        
        let masukTotalMinutes = masukHour * 60 + masukMinute;
        let keluarTotalMinutes = keluarHour * 60 + keluarMinute;
        
        if (keluarTotalMinutes <= masukTotalMinutes) {
            keluarTotalMinutes += 24 * 60;
        }
        
        const totalMinutes = keluarTotalMinutes - masukTotalMinutes;
        
        if (totalMinutes < 60) {
            errors.push('Jam kerja minimal 1 jam');
        }
        
        if (totalMinutes > 24 * 60) {
            errors.push('Jam kerja maksimal 24 jam');
        }
        
        if (errors.length > 0) {
            alert('Error:\n' + errors.join('\n'));
            return;
        }
        
        // Tentukan status
        let status = 'normal';
        if (totalMinutes < 7 * 60) {
            status = 'kurang';
        } else if (totalMinutes > 8 * 60) {
            status = 'lembur';
        }
        
        // Update data
        const index = absensiData.findIndex(a => a.id === id);
        if (index !== -1) {
            absensiData[index] = {
                ...absensiData[index],
                tanggal_kerja: tanggal_kerja,
                jam_masuk: jam_masuk,
                jam_keluar: jam_keluar,
                jam_kerja_total: totalMinutes,
                status: status,
                catatan: catatan
            };
            
            loadAbsensiTable();
            updateStatistics();
            
            editModal.style.display = 'none';
            document.body.style.overflow = 'auto';
            
            showSuccess('Data absensi berhasil diperbarui!');
        }
    });
    
    // Delete absensi
    function deleteAbsensi(id) {
        if (confirm('Apakah Anda yakin ingin menghapus data absensi ini?')) {
            absensiData = absensiData.filter(a => a.id !== id);
            loadAbsensiTable();
            updateStatistics();
            showSuccess('Data absensi berhasil dihapus!');
        }
    }
    
    // Close edit modal
    document.querySelector('.close-edit-modal').addEventListener('click', function() {
        editModal.style.display = 'none';
        document.body.style.overflow = 'auto';
    });
    
    document.getElementById('cancelEditBtn').addEventListener('click', function() {
        editModal.style.display = 'none';
        document.body.style.overflow = 'auto';
    });
    
    // Pagination buttons
    document.querySelector('.btn-pagination.prev').addEventListener('click', function() {
        if (currentPage > 1) {
            currentPage--;
            loadAbsensiTable();
        }
    });
    
    document.querySelector('.btn-pagination.next').addEventListener('click', function() {
        const filteredData = absensiData.filter(absensi => {
            const absensiDate = new Date(absensi.tanggal_kerja);
            return absensiDate.getMonth() === currentMonth && 
                   absensiDate.getFullYear() === currentYear;
        });
        const totalPages = Math.ceil(filteredData.length / itemsPerPage);
        
        if (currentPage < totalPages) {
            currentPage++;
            loadAbsensiTable();
        }
    });
    
    // Month navigation
    prevMonthBtn.addEventListener('click', function() {
        currentMonth--;
        if (currentMonth < 0) {
            currentMonth = 11;
            currentYear--;
        }
        currentPage = 1;
        updateMonthDisplay();
        loadAbsensiTable();
        updateStatistics();
    });
    
    nextMonthBtn.addEventListener('click', function() {
        currentMonth++;
        if (currentMonth > 11) {
            currentMonth = 0;
            currentYear++;
        }
        currentPage = 1;
        updateMonthDisplay();
        loadAbsensiTable();
        updateStatistics();
    });
    
    // Print button
    printBtn.addEventListener('click', function() {
        window.print();
    });
});
</script>
@endsection