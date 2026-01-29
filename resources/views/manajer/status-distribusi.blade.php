@extends('layouts.manajer')

@section('title', 'Status Distribusi - PT. Mardua Holong')

@section('page-title', 'Status Distribusi')
@section('page-subtitle', 'Tracking Status Pengiriman Jeruk')

@section('content')
<div class="content-wrapper">
    <!-- Header dengan Filter -->
    <div class="content-header" style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 30px;">
        <div>
            <h1 style="font-size: 24px; font-weight: 700; color: var(--text-dark); margin-bottom: 5px;">Status Distribusi Jeruk</h1>
            <p style="color: var(--text-light); font-size: 14px;">Monitoring status perjalanan distribusi dari panen hingga diterima</p>
        </div>
        
        <div style="display: flex; gap: 10px;">
            <button type="button" id="refreshBtn" class="btn" style="background-color: var(--bg-light); color: var(--text-light);">
                <i class="fas fa-sync-alt"></i> Refresh
            </button>
            <button type="button" id="exportBtn" class="btn btn-primary">
                <i class="fas fa-file-export"></i> Export Data
            </button>
        </div>
    </div>
    
    <!-- Statistik -->
    <div class="content-grid" style="margin-bottom: 30px;">
        <div class="content-card">
            <div class="card-title">
                <span>Total Distribusi</span>
                <div class="card-icon">
                    <i class="fas fa-boxes"></i>
                </div>
            </div>
            <div class="stat-number" id="totalDistribusi">25</div>
            <div class="stat-label">Data Distribusi</div>
        </div>
        
        <div class="content-card">
            <div class="card-title">
                <span>Dipanen</span>
                <div class="card-icon">
                    <i class="fas fa-seedling"></i>
                </div>
            </div>
            <div class="stat-number" style="color: #4CAF50;" id="totalDipanen">8</div>
            <div class="stat-label">Belum Dikemas</div>
        </div>
        
        <div class="content-card">
            <div class="card-title">
                <span>Dikirim</span>
                <div class="card-icon">
                    <i class="fas fa-truck"></i>
                </div>
            </div>
            <div class="stat-number" style="color: #FF9800;" id="totalDikirim">12</div>
            <div class="stat-label">Dalam Perjalanan</div>
        </div>
        
        <div class="content-card">
            <div class="card-title">
                <span>Selesai</span>
                <div class="card-icon">
                    <i class="fas fa-check-circle"></i>
                </div>
            </div>
            <div class="stat-number" style="color: #795548;" id="totalSelesai">5</div>
            <div class="stat-label">Sudah Diterima</div>
        </div>
    </div>
    
    <!-- Filter Section -->
    <div class="content-card" style="margin-bottom: 30px;">
        <div class="card-title">
            <span>Filter Data</span>
            <div class="card-icon">
                <i class="fas fa-filter"></i>
            </div>
        </div>
        
        <div style="display: grid; grid-template-columns: repeat(4, 1fr); gap: 20px;">
            <div class="form-group">
                <label class="form-label">Status</label>
                <select class="form-control" id="filterStatus">
                    <option value="">Semua Status</option>
                    <option value="dipanen">Dipanen</option>
                    <option value="dikemas">Dikemas</option>
                    <option value="dikirim">Dikirim</option>
                    <option value="diterima">Diterima</option>
                </select>
            </div>
            
            <div class="form-group">
                <label class="form-label">Tanggal Mulai</label>
                <input type="date" class="form-control" id="filterTanggalMulai" value="{{ date('Y-m-d', strtotime('-7 days')) }}">
            </div>
            
            <div class="form-group">
                <label class="form-label">Tanggal Sampai</label>
                <input type="date" class="form-control" id="filterTanggalSampai" value="{{ date('Y-m-d') }}">
            </div>
            
            <div class="form-group">
                <label class="form-label">Petani</label>
                <select class="form-control" id="filterPetani">
                    <option value="">Semua Petani</option>
                    <option value="Tuan Sitorus">Tuan Sitorus</option>
                    <option value="Budi Santoso">Budi Santoso</option>
                    <option value="Joko Widodo">Joko Widodo</option>
                    <option value="Siti Aminah">Siti Aminah</option>
                </select>
            </div>
        </div>
        
        <div style="display: flex; gap: 10px; margin-top: 20px;">
            <button type="button" id="applyFilterBtn" class="btn btn-primary">
                <i class="fas fa-search"></i> Terapkan Filter
            </button>
            <button type="button" id="resetFilterBtn" class="btn" style="background-color: var(--bg-light); color: var(--text-light);">
                <i class="fas fa-redo"></i> Reset Filter
            </button>
        </div>
    </div>
    
    <!-- Tabel Status Distribusi -->
    <div class="content-card">
        <div class="card-title">
            <span>Daftar Status Distribusi</span>
            <div class="card-icon">
                <i class="fas fa-list"></i>
            </div>
        </div>
        
        <div style="overflow-x: auto;">
            <table style="width: 100%; border-collapse: collapse;">
                <thead>
                    <tr style="background-color: var(--bg-light); border-bottom: 2px solid var(--border);">
                        <th style="padding: 12px; text-align: left; font-weight: 600; color: var(--text-dark); width: 50px;">No</th>
                        <th style="padding: 12px; text-align: left; font-weight: 600; color: var(--text-dark);">Batch</th>
                        <th style="padding: 12px; text-align: left; font-weight: 600; color: var(--text-dark);">Petani</th>
                        <th style="padding: 12px; text-align: left; font-weight: 600; color: var(--text-dark);">Berat</th>
                        <th style="padding: 12px; text-align: left; font-weight: 600; color: var(--text-dark);">Status</th>
                        <th style="padding: 12px; text-align: left; font-weight: 600; color: var(--text-dark);">Supir</th>
                        <th style="padding: 12px; text-align: left; font-weight: 600; color: var(--text-dark);">Tujuan</th>
                        <th style="padding: 12px; text-align: left; font-weight: 600; color: var(--text-dark);">Tanggal</th>
                        <th style="padding: 12px; text-align: left; font-weight: 600; color: var(--text-dark); width: 120px;">Aksi</th>
                    </tr>
                </thead>
                <tbody id="distribusiTableBody">
                    <!-- Data akan diisi oleh JavaScript -->
                </tbody>
            </table>
        </div>
        
        <!-- Pagination -->
        <div style="display: flex; justify-content: space-between; align-items: center; margin-top: 20px; padding-top: 20px; border-top: 1px solid var(--border);">
            <div style="font-size: 14px; color: var(--text-light);">
                Menampilkan <span id="showingCount">0</span> dari <span id="totalCount">0</span> data
            </div>
            <div style="display: flex; gap: 5px;">
                <button type="button" class="btn-pagination prev" style="padding: 8px 12px; background-color: var(--primary-lighter); color: var(--primary); border: none; border-radius: 6px; cursor: pointer;">
                    <i class="fas fa-chevron-left"></i>
                </button>
                <button type="button" class="btn-pagination page active" data-page="1" style="padding: 8px 12px; background-color: var(--primary); color: white; border: none; border-radius: 6px; cursor: pointer;">1</button>
                <button type="button" class="btn-pagination page" data-page="2" style="padding: 8px 12px; background-color: var(--bg-light); color: var(--text-light); border: none; border-radius: 6px; cursor: pointer;">2</button>
                <button type="button" class="btn-pagination page" data-page="3" style="padding: 8px 12px; background-color: var(--bg-light); color: var(--text-light); border: none; border-radius: 6px; cursor: pointer;">3</button>
                <button type="button" class="btn-pagination next" style="padding: 8px 12px; background-color: var(--primary-lighter); color: var(--primary); border: none; border-radius: 6px; cursor: pointer;">
                    <i class="fas fa-chevron-right"></i>
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Section Update Status (BUKAN MODAL) -->
<div id="updateStatusSection" style="display: none; margin-top: 30px;">
    <div class="content-card">
        <div class="card-title">
            <span>Update Status Distribusi</span>
            <div class="card-icon">
                <i class="fas fa-edit"></i>
            </div>
            <button type="button" id="closeUpdateSection" style="background: none; border: none; color: var(--text-light); cursor: pointer; font-size: 16px;">
                <i class="fas fa-times"></i>
            </button>
        </div>
        
        <div style="display: grid; grid-template-columns: 1fr 2fr; gap: 30px;">
            <!-- Kolom Kiri: Informasi Data -->
            <div>
                <div style="background-color: var(--bg-light); border-radius: 10px; padding: 20px; margin-bottom: 20px;">
                    <h4 style="margin-bottom: 15px; color: var(--text-dark);">
                        <i class="fas fa-info-circle"></i> Informasi Distribusi
                    </h4>
                    <div id="dataInfo">
                        <!-- Data akan diisi oleh JavaScript -->
                    </div>
                </div>
                
                <div style="background-color: var(--primary-lighter); border-radius: 10px; padding: 20px;">
                    <h4 style="margin-bottom: 15px; color: var(--text-dark);">
                        <i class="fas fa-history"></i> Riwayat Status
                    </h4>
                    <div id="historyList">
                        <!-- Riwayat akan diisi oleh JavaScript -->
                    </div>
                </div>
            </div>
            
            <!-- Kolom Kanan: Form Update -->
            <div>
                <form id="updateStatusForm">
                    <input type="hidden" id="distribusi_id" name="distribusi_id">
                    
                    <!-- Status Flow -->
                    <div class="form-group">
                        <label class="form-label">Update ke Status *</label>
                        <div class="status-flow">
                            <div class="status-step" data-status="dipanen">
                                <div class="step-circle">
                                    <i class="fas fa-seedling"></i>
                                </div>
                                <div class="step-label">Dipanen</div>
                                <div class="step-connector"></div>
                            </div>
                            
                            <div class="status-step" data-status="dikemas">
                                <div class="step-circle">
                                    <i class="fas fa-box"></i>
                                </div>
                                <div class="step-label">Dikemas</div>
                                <div class="step-connector"></div>
                            </div>
                            
                            <div class="status-step" data-status="dikirim">
                                <div class="step-circle">
                                    <i class="fas fa-truck"></i>
                                </div>
                                <div class="step-label">Dikirim</div>
                                <div class="step-connector"></div>
                            </div>
                            
                            <div class="status-step" data-status="diterima">
                                <div class="step-circle">
                                    <i class="fas fa-check-circle"></i>
                                </div>
                                <div class="step-label">Diterima</div>
                            </div>
                        </div>
                        
                        <input type="hidden" id="status_baru" name="status" value="">
                        
                        <!-- Status Indicator -->
                        <div id="selectedStatusInfo" style="margin-top: 20px; padding: 15px; background-color: var(--bg-light); border-radius: 10px; display: none;">
                            <div style="display: flex; align-items: center; gap: 12px;">
                                <div style="font-size: 24px; color: var(--primary);">
                                    <i id="selectedIcon"></i>
                                </div>
                                <div>
                                    <div style="font-weight: 600; color: var(--text-dark); font-size: 16px;">
                                        Status yang dipilih: <span id="selectedStatusLabel"></span>
                                    </div>
                                    <div style="font-size: 13px; color: var(--text-light); margin-top: 5px;" id="selectedStatusDesc">
                                        <!-- Deskripsi akan diisi -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Tanggal Update -->
                    <div class="form-group">
                        <label class="form-label">Tanggal Update *</label>
                        <div class="input-wrapper">
                            <i class="fas fa-calendar-alt input-icon"></i>
                            <input type="datetime-local" id="tanggal_update" name="tanggal_update" class="form-control" 
                                   value="{{ date('Y-m-d\TH:i') }}" required>
                        </div>
                        <small class="form-text">Tanggal dan waktu perubahan status</small>
                    </div>
                    
                    <!-- Catatan Perubahan -->
                    <div class="form-group">
                        <label class="form-label">Catatan Perubahan</label>
                        <textarea id="catatan" name="catatan" class="form-control" rows="4" 
                                  placeholder="Masukkan catatan perubahan status (opsional)..."></textarea>
                    </div>
                    
                    <!-- Validasi Perubahan -->
                    <div id="validationWarning" style="display: none; background-color: #FFF3CD; border: 1px solid #FFEEBA; border-radius: 8px; padding: 12px; margin-bottom: 20px;">
                        <div style="display: flex; align-items: flex-start; gap: 10px;">
                            <i class="fas fa-exclamation-triangle" style="color: #FFC107; margin-top: 2px;"></i>
                            <div>
                                <div style="font-weight: 600; color: #856404;" id="warningTitle"></div>
                                <div style="font-size: 13px; color: #856404; margin-top: 5px;" id="warningMessage"></div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Tombol Aksi -->
                    <div style="display: flex; gap: 10px; margin-top: 30px;">
                        <button type="button" id="cancelUpdateBtn" class="btn btn-secondary" style="flex: 1;">
                            <i class="fas fa-times"></i> Batal
                        </button>
                        <button type="submit" id="submitUpdateBtn" class="btn btn-primary" style="flex: 2;" disabled>
                            <i class="fas fa-save"></i> Update Status
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<style>
    /* Status Badge */
    .status-badge {
        display: inline-block;
        padding: 6px 12px;
        border-radius: 6px;
        font-size: 12px;
        font-weight: 600;
        text-align: center;
        min-width: 80px;
    }
    
    .badge-dipanen {
        background-color: #E8F5E9;
        color: #2E7D32;
        border: 1px solid #C8E6C9;
    }
    
    .badge-dikemas {
        background-color: #E3F2FD;
        color: #1565C0;
        border: 1px solid #BBDEFB;
    }
    
    .badge-dikirim {
        background-color: #FFF3E0;
        color: #EF6C00;
        border: 1px solid #FFE0B2;
    }
    
    .badge-diterima {
        background-color: #F3E5F5;
        color: #7B1FA2;
        border: 1px solid #E1BEE7;
    }
    
    /* Status Flow */
    .status-flow {
        display: flex;
        justify-content: space-between;
        position: relative;
        margin-bottom: 20px;
    }
    
    .status-step {
        display: flex;
        flex-direction: column;
        align-items: center;
        position: relative;
        flex: 1;
        cursor: pointer;
        z-index: 2;
    }
    
    .step-circle {
        width: 70px;
        height: 70px;
        border-radius: 50%;
        background-color: var(--bg-light);
        border: 3px solid var(--border);
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--text-light);
        font-size: 24px;
        transition: all 0.3s ease;
        margin-bottom: 10px;
    }
    
    .step-label {
        font-size: 13px;
        color: var(--text-light);
        text-align: center;
        font-weight: 500;
        transition: all 0.3s ease;
    }
    
    .step-connector {
        position: absolute;
        top: 35px;
        right: -50%;
        width: 100%;
        height: 3px;
        background-color: var(--border);
        z-index: 1;
    }
    
    .status-step:last-child .step-connector {
        display: none;
    }
    
    /* Status Active */
    .status-step.active .step-circle {
        background-color: var(--primary);
        border-color: var(--primary);
        color: white;
        transform: scale(1.1);
        box-shadow: 0 4px 12px rgba(45, 106, 79, 0.2);
    }
    
    .status-step.active .step-label {
        color: var(--primary);
        font-weight: 600;
    }
    
    .status-step.completed .step-circle {
        background-color: #4CAF50;
        border-color: #4CAF50;
        color: white;
    }
    
    .status-step.completed .step-label {
        color: #4CAF50;
    }
    
    .status-step.completed .step-connector {
        background-color: #4CAF50;
    }
    
    /* Status Inactive */
    .status-step.inactive {
        cursor: not-allowed;
        opacity: 0.5;
    }
    
    /* Form Controls */
    .input-wrapper {
        position: relative;
    }
    
    .input-icon {
        position: absolute;
        left: 15px;
        top: 50%;
        transform: translateY(-50%);
        color: var(--text-light);
        font-size: 16px;
    }
    
    .form-control {
        padding-left: 45px !important;
    }
    
    .form-text {
        display: block;
        margin-top: 5px;
        font-size: 12px;
        color: var(--text-light);
    }
    
    /* Tabel */
    table {
        width: 100%;
    }
    
    tbody tr {
        transition: var(--transition);
    }
    
    tbody tr:hover {
        background-color: var(--primary-lighter);
    }
    
    /* Pagination */
    .btn-pagination {
        transition: var(--transition);
        min-width: 36px;
    }
    
    .btn-pagination:not(.active):hover {
        background-color: var(--primary-lighter) !important;
        color: var(--primary) !important;
    }
    
    /* Info Box */
    .info-box {
        margin-bottom: 15px;
        padding-bottom: 15px;
        border-bottom: 1px solid var(--border);
    }
    
    .info-label {
        font-size: 13px;
        color: var(--text-light);
        margin-bottom: 4px;
    }
    
    .info-value {
        font-weight: 600;
        color: var(--text-dark);
        font-size: 14px;
    }
    
    /* History Item */
    .history-item {
        display: flex;
        align-items: flex-start;
        gap: 12px;
        padding: 12px;
        background-color: white;
        border-radius: 8px;
        margin-bottom: 10px;
        border-left: 4px solid var(--primary);
    }
    
    .history-icon {
        width: 32px;
        height: 32px;
        background-color: var(--primary-lighter);
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--primary);
        font-size: 14px;
        flex-shrink: 0;
    }
    
    .history-content {
        flex: 1;
    }
    
    .history-header {
        display: flex;
        justify-content: space-between;
        margin-bottom: 4px;
    }
    
    .history-status {
        font-weight: 600;
        color: var(--text-dark);
        font-size: 13px;
    }
    
    .history-date {
        font-size: 12px;
        color: var(--text-light);
    }
    
    .history-desc {
        font-size: 12px;
        color: var(--text-light);
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
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Data dummy distribusi
    const distribusiData = [
        {
            id: 1,
            batch: 'PNH-2024-03-001',
            petani: 'Tuan Sitorus',
            berat: 500,
            status: 'dipanen',
            tanggal_panen: '2024-03-25',
            supir: 'Budi Santoso',
            kendaraan: 'TRK-001',
            tujuan: 'Medan',
            lokasi_kebun: 'Berastagi',
            jenis_jeruk: 'Sipirok',
            kualitas: 'A',
            history: [
                { status: 'dipanen', tanggal: '2024-03-25 10:30', catatan: 'Panen dilakukan pagi hari' }
            ]
        },
        {
            id: 2,
            batch: 'PNH-2024-03-002',
            petani: 'Budi Santoso',
            berat: 350,
            status: 'dikemas',
            tanggal_panen: '2024-03-26',
            supir: 'Joko Widodo',
            kendaraan: 'TRK-002',
            tujuan: 'Jakarta',
            lokasi_kebun: 'Sipirok',
            jenis_jeruk: 'Medan',
            kualitas: 'B',
            history: [
                { status: 'dipanen', tanggal: '2024-03-26 09:15', catatan: 'Panen dengan kondisi baik' },
                { status: 'dikemas', tanggal: '2024-03-26 14:30', catatan: 'Dikemas dalam 35 keranjang' }
            ]
        },
        {
            id: 3,
            batch: 'PNH-2024-03-003',
            petani: 'Joko Widodo',
            berat: 420,
            status: 'dikirim',
            tanggal_panen: '2024-03-27',
            supir: 'Rudi Hartono',
            kendaraan: 'TRK-003',
            tujuan: 'Surabaya',
            lokasi_kebun: 'Parapat',
            jenis_jeruk: 'Sipirok',
            kualitas: 'A',
            history: [
                { status: 'dipanen', tanggal: '2024-03-27 08:45', catatan: 'Panen pagi hari' },
                { status: 'dikemas', tanggal: '2024-03-27 13:20', catatan: 'Dikemas dalam 42 kardus' },
                { status: 'dikirim', tanggal: '2024-03-27 16:30', catatan: 'Dikirim ke Surabaya' }
            ]
        },
        {
            id: 4,
            batch: 'PNH-2024-03-004',
            petani: 'Siti Aminah',
            berat: 280,
            status: 'diterima',
            tanggal_panen: '2024-03-28',
            supir: 'Siti Aminah',
            kendaraan: 'TRK-004',
            tujuan: 'Bandung',
            lokasi_kebun: 'Berastagi',
            jenis_jeruk: 'Bali',
            kualitas: 'C',
            history: [
                { status: 'dipanen', tanggal: '2024-03-28 11:00', catatan: 'Panen siang hari' },
                { status: 'dikemas', tanggal: '2024-03-28 15:45', catatan: 'Dikemas dalam 28 kardus' },
                { status: 'dikirim', tanggal: '2024-03-28 17:30', catatan: 'Dikirim ke Bandung' },
                { status: 'diterima', tanggal: '2024-03-30 10:15', catatan: 'Sudah diterima di tujuan' }
            ]
        },
        {
            id: 5,
            batch: 'PNH-2024-03-005',
            petani: 'Rudi Hartono',
            berat: 320,
            status: 'dipanen',
            tanggal_panen: '2024-03-29',
            supir: 'Ahmad Fauzi',
            kendaraan: 'TRK-005',
            tujuan: 'Palembang',
            lokasi_kebun: 'Simalungun',
            jenis_jeruk: 'Medan',
            kualitas: 'B',
            history: [
                { status: 'dipanen', tanggal: '2024-03-29 09:30', catatan: 'Panen pagi hari' }
            ]
        },
        {
            id: 6,
            batch: 'PNH-2024-03-006',
            petani: 'Ani Wijaya',
            berat: 450,
            status: 'dikemas',
            tanggal_panen: '2024-03-30',
            supir: 'Budi Santoso',
            kendaraan: 'TRK-001',
            tujuan: 'Medan',
            lokasi_kebun: 'Karo',
            jenis_jeruk: 'Sipirok',
            kualitas: 'A',
            history: [
                { status: 'dipanen', tanggal: '2024-03-30 08:15', catatan: 'Panen pagi hari' },
                { status: 'dikemas', tanggal: '2024-03-30 14:00', catatan: 'Dikemas dalam 45 peti kayu' }
            ]
        },
        {
            id: 7,
            batch: 'PNH-2024-03-007',
            petani: 'Tuan Sitorus',
            berat: 380,
            status: 'dikirim',
            tanggal_panen: '2024-03-31',
            supir: 'Joko Widodo',
            kendaraan: 'TRK-002',
            tujuan: 'Jakarta',
            lokasi_kebun: 'Berastagi',
            jenis_jeruk: 'Sipirok',
            kualitas: 'A',
            history: [
                { status: 'dipanen', tanggal: '2024-03-31 10:00', catatan: 'Panen pagi hari' },
                { status: 'dikemas', tanggal: '2024-03-31 15:30', catatan: 'Dikemas dalam 38 kardus' },
                { status: 'dikirim', tanggal: '2024-04-01 09:00', catatan: 'Dikirim ke Jakarta' }
            ]
        },
        {
            id: 8,
            batch: 'PNH-2024-03-008',
            petani: 'Budi Santoso',
            berat: 290,
            status: 'diterima',
            tanggal_panen: '2024-04-01',
            supir: 'Rudi Hartono',
            kendaraan: 'TRK-003',
            tujuan: 'Surabaya',
            lokasi_kebun: 'Sipirok',
            jenis_jeruk: 'Medan',
            kualitas: 'B',
            history: [
                { status: 'dipanen', tanggal: '2024-04-01 09:45', catatan: 'Panen pagi hari' },
                { status: 'dikemas', tanggal: '2024-04-01 16:20', catatan: 'Dikemas dalam 29 keranjang' },
                { status: 'dikirim', tanggal: '2024-04-02 08:30', catatan: 'Dikirim ke Surabaya' },
                { status: 'diterima', tanggal: '2024-04-04 14:15', catatan: 'Sudah diterima di tujuan' }
            ]
        }
    ];
    
    // Data status
    const statusData = {
        dipanen: {
            label: 'Dipanen',
            icon: 'fas fa-seedling',
            description: 'Jeruk telah dipanen dari kebun dan siap untuk proses selanjutnya',
            color: '#4CAF50'
        },
        dikemas: {
            label: 'Dikemas',
            icon: 'fas fa-box',
            description: 'Jeruk sedang dalam proses pengemasan untuk distribusi',
            color: '#2196F3'
        },
        dikirim: {
            label: 'Dikirim',
            icon: 'fas fa-truck',
            description: 'Jeruk telah dikirim dan sedang dalam perjalanan ke tujuan',
            color: '#FF9800'
        },
        diterima: {
            label: 'Diterima',
            icon: 'fas fa-check-circle',
            description: 'Jeruk telah diterima di tujuan akhir',
            color: '#9C27B0'
        }
    };
    
    // Elemen DOM
    const distribusiTableBody = document.getElementById('distribusiTableBody');
    const updateStatusSection = document.getElementById('updateStatusSection');
    const totalDistribusi = document.getElementById('totalDistribusi');
    const totalDipanen = document.getElementById('totalDipanen');
    const totalDikirim = document.getElementById('totalDikirim');
    const totalSelesai = document.getElementById('totalSelesai');
    const showingCount = document.getElementById('showingCount');
    const totalCount = document.getElementById('totalCount');
    const refreshBtn = document.getElementById('refreshBtn');
    const exportBtn = document.getElementById('exportBtn');
    const applyFilterBtn = document.getElementById('applyFilterBtn');
    const resetFilterBtn = document.getElementById('resetFilterBtn');
    const closeUpdateSection = document.getElementById('closeUpdateSection');
    const cancelUpdateBtn = document.getElementById('cancelUpdateBtn');
    
    // State
    let currentFilteredData = [...distribusiData];
    let currentPage = 1;
    const itemsPerPage = 5;
    
    // Initialize
    loadTableData();
    updateStatistics();
    
    // Load table data
    function loadTableData() {
        distribusiTableBody.innerHTML = '';
        
        const startIndex = (currentPage - 1) * itemsPerPage;
        const endIndex = startIndex + itemsPerPage;
        const pageData = currentFilteredData.slice(startIndex, endIndex);
        
        if (pageData.length === 0) {
            distribusiTableBody.innerHTML = `
                <tr>
                    <td colspan="9" style="text-align: center; padding: 40px; color: var(--text-light);">
                        <i class="fas fa-inbox" style="font-size: 40px; margin-bottom: 10px; opacity: 0.5; display: block;"></i>
                        <div>Tidak ada data ditemukan</div>
                    </td>
                </tr>
            `;
        } else {
            pageData.forEach((item, index) => {
                const row = document.createElement('tr');
                const globalIndex = startIndex + index + 1;
                const statusInfo = statusData[item.status];
                
                row.innerHTML = `
                    <td style="padding: 12px; color: var(--text-light);">${globalIndex}</td>
                    <td style="padding: 12px;">
                        <div style="font-weight: 600; color: var(--text-dark);">${item.batch}</div>
                        <div style="font-size: 12px; color: var(--text-light);">${item.tanggal_panen}</div>
                    </td>
                    <td style="padding: 12px; color: var(--text-dark); font-weight: 500;">${item.petani}</td>
                    <td style="padding: 12px; color: var(--text-dark); font-weight: 600;">${item.berat} kg</td>
                    <td style="padding: 12px;">
                        <span class="status-badge badge-${item.status}">
                            <i class="${statusInfo.icon}" style="margin-right: 5px;"></i>
                            ${statusInfo.label}
                        </span>
                    </td>
                    <td style="padding: 12px; color: var(--text-dark); font-size: 14px;">${item.supir}</td>
                    <td style="padding: 12px; color: var(--text-light); font-size: 14px;">${item.tujuan}</td>
                    <td style="padding: 12px; color: var(--text-light); font-size: 14px;">
                        ${formatDate(item.tanggal_panen)}
                    </td>
                    <td style="padding: 12px;">
                        <div class="action-buttons">
                            <button type="button" class="btn-action btn-view" data-id="${item.id}" title="Lihat Detail">
                                <i class="fas fa-eye"></i>
                            </button>
                            <button type="button" class="btn-action btn-edit" data-id="${item.id}" title="Update Status">
                                <i class="fas fa-edit"></i>
                            </button>
                            <button type="button" class="btn-action btn-delete" data-id="${item.id}" title="Hapus Data">
                                <i class="fas fa-trash"></i>
                            </button>
                        </div>
                    </td>
                `;
                
                distribusiTableBody.appendChild(row);
            });
        }
        
        // Update counts
        showingCount.textContent = pageData.length;
        totalCount.textContent = currentFilteredData.length;
        
        // Update pagination
        updatePagination();
        
        // Add event listeners to action buttons
        addActionButtonListeners();
    }
    
    // Update statistics
    function updateStatistics() {
        const total = currentFilteredData.length;
        const dipanen = currentFilteredData.filter(item => item.status === 'dipanen').length;
        const dikemas = currentFilteredData.filter(item => item.status === 'dikemas').length;
        const dikirim = currentFilteredData.filter(item => item.status === 'dikirim').length;
        const diterima = currentFilteredData.filter(item => item.status === 'diterima').length;
        const selesai = diterima;
        
        totalDistribusi.textContent = total;
        totalDipanen.textContent = dipanen;
        totalDikirim.textContent = dikirim + dikemas; // gabungkan dikemas dan dikirim
        totalSelesai.textContent = selesai;
    }
    
    // Format date
    function formatDate(dateString) {
        const date = new Date(dateString);
        return date.toLocaleDateString('id-ID', {
            day: '2-digit',
            month: 'short',
            year: 'numeric'
        });
    }
    
    // Update pagination
    function updatePagination() {
        const totalPages = Math.ceil(currentFilteredData.length / itemsPerPage);
        const paginationContainer = document.querySelector('.btn-pagination.page').parentNode;
        
        // Clear existing page buttons (keep prev/next)
        const existingPages = paginationContainer.querySelectorAll('.btn-pagination.page');
        existingPages.forEach(page => page.remove());
        
        // Add page buttons
        for (let i = 1; i <= Math.min(totalPages, 3); i++) {
            const pageBtn = document.createElement('button');
            pageBtn.type = 'button';
            pageBtn.className = `btn-pagination page ${i === currentPage ? 'active' : ''}`;
            pageBtn.dataset.page = i;
            pageBtn.textContent = i;
            pageBtn.style.padding = '8px 12px';
            pageBtn.style.backgroundColor = i === currentPage ? 'var(--primary)' : 'var(--bg-light)';
            pageBtn.style.color = i === currentPage ? 'white' : 'var(--text-light)';
            pageBtn.style.border = 'none';
            pageBtn.style.borderRadius = '6px';
            pageBtn.style.cursor = 'pointer';
            
            pageBtn.addEventListener('click', function() {
                currentPage = parseInt(this.dataset.page);
                loadTableData();
            });
            
            // Insert before next button
            const nextBtn = paginationContainer.querySelector('.next');
            paginationContainer.insertBefore(pageBtn, nextBtn);
        }
        
        // Update prev/next buttons
        const prevBtn = paginationContainer.querySelector('.prev');
        const nextBtn = paginationContainer.querySelector('.next');
        
        prevBtn.disabled = currentPage === 1;
        nextBtn.disabled = currentPage === totalPages;
        
        prevBtn.style.opacity = prevBtn.disabled ? '0.5' : '1';
        nextBtn.style.opacity = nextBtn.disabled ? '0.5' : '1';
    }
    
    // Add action button listeners
    function addActionButtonListeners() {
        // View buttons
        document.querySelectorAll('.btn-view').forEach(btn => {
            btn.addEventListener('click', function() {
                const id = parseInt(this.dataset.id);
                showDetail(id);
            });
        });
        
        // Edit buttons
        document.querySelectorAll('.btn-edit').forEach(btn => {
            btn.addEventListener('click', function() {
                const id = parseInt(this.dataset.id);
                showUpdateForm(id);
            });
        });
        
        // Delete buttons
        document.querySelectorAll('.btn-delete').forEach(btn => {
            btn.addEventListener('click', function() {
                const id = parseInt(this.dataset.id);
                deleteDistribusi(id);
            });
        });
    }
    
    // Show detail
    function showDetail(id) {
        const item = distribusiData.find(d => d.id === id);
        if (!item) return;
        
        const statusInfo = statusData[item.status];
        
        alert(`
Detail Distribusi:
===================
Batch: ${item.batch}
Petani: ${item.petani}
Berat: ${item.berat} kg
Status: ${statusInfo.label}
Tanggal Panen: ${item.tanggal_panen}
Supir: ${item.supir}
Kendaraan: ${item.kendaraan}
Tujuan: ${item.tujuan}
Lokasi Kebun: ${item.lokasi_kebun}
Jenis Jeruk: ${item.jenis_jeruk}
Kualitas: ${item.kualitas}

Riwayat Status:
${item.history.map(h => `- ${statusData[h.status].label}: ${h.tanggal} (${h.catatan})`).join('\n')}
        `);
    }
    
    // Show update form
    function showUpdateForm(id) {
        const item = distribusiData.find(d => d.id === id);
        if (!item) return;
        
        // Scroll to update section
        updateStatusSection.style.display = 'block';
        updateStatusSection.scrollIntoView({ behavior: 'smooth' });
        
        // Fill data info
        document.getElementById('distribusi_id').value = item.id;
        
        const dataInfoHtml = `
            <div class="info-box">
                <div class="info-label">Batch</div>
                <div class="info-value">${item.batch}</div>
            </div>
            <div class="info-box">
                <div class="info-label">Petani</div>
                <div class="info-value">${item.petani}</div>
            </div>
            <div class="info-box">
                <div class="info-label">Berat</div>
                <div class="info-value">${item.berat} kg</div>
            </div>
            <div class="info-box">
                <div class="info-label">Status Saat Ini</div>
                <div class="info-value">
                    <span class="status-badge badge-${item.status}">
                        <i class="${statusData[item.status].icon}" style="margin-right: 5px;"></i>
                        ${statusData[item.status].label}
                    </span>
                </div>
            </div>
            <div class="info-box">
                <div class="info-label">Tujuan</div>
                <div class="info-value">${item.tujuan}</div>
            </div>
            <div class="info-box">
                <div class="info-label">Supir</div>
                <div class="info-value">${item.supir}</div>
            </div>
        `;
        
        document.getElementById('dataInfo').innerHTML = dataInfoHtml;
        
        // Fill history
        let historyHtml = '';
        if (item.history && item.history.length > 0) {
            item.history.forEach(historyItem => {
                const histStatus = statusData[historyItem.status];
                historyHtml += `
                    <div class="history-item">
                        <div class="history-icon">
                            <i class="${histStatus.icon}"></i>
                        </div>
                        <div class="history-content">
                            <div class="history-header">
                                <div class="history-status">${histStatus.label}</div>
                                <div class="history-date">${historyItem.tanggal}</div>
                            </div>
                            <div class="history-desc">${historyItem.catatan}</div>
                        </div>
                    </div>
                `;
            });
        } else {
            historyHtml = '<div style="color: var(--text-light); text-align: center; padding: 20px;">Belum ada riwayat status</div>';
        }
        document.getElementById('historyList').innerHTML = historyHtml;
        
        // Setup status flow
        setupStatusFlow(item.status);
    }
    
    // Setup status flow
    function setupStatusFlow(currentStatus) {
        // Reset all steps
        document.querySelectorAll('.status-step').forEach(step => {
            step.classList.remove('active', 'completed', 'inactive');
            step.onclick = null;
        });
        
        const statusOrder = ['dipanen', 'dikemas', 'dikirim', 'diterima'];
        const currentIndex = statusOrder.indexOf(currentStatus);
        
        // Set completed steps
        for (let i = 0; i <= currentIndex; i++) {
            const step = document.querySelector(`.status-step[data-status="${statusOrder[i]}"]`);
            step.classList.add('completed');
            
            if (i < currentIndex) {
                step.querySelector('.step-connector').style.backgroundColor = '#4CAF50';
            }
        }
        
        // Set active step
        document.querySelector(`.status-step[data-status="${currentStatus}"]`).classList.add('active');
        
        // Set next steps as clickable
        if (currentIndex < statusOrder.length - 1) {
            const nextStatus = statusOrder[currentIndex + 1];
            const nextStep = document.querySelector(`.status-step[data-status="${nextStatus}"]`);
            nextStep.classList.remove('inactive');
            
            nextStep.onclick = function() {
                selectStatus(nextStatus);
            };
            
            // Set connector after current step
            document.querySelector(`.status-step[data-status="${currentStatus}"] .step-connector`).style.backgroundColor = '#4CAF50';
        }
        
        // Set other steps as inactive
        for (let i = currentIndex + 2; i < statusOrder.length; i++) {
            const step = document.querySelector(`.status-step[data-status="${statusOrder[i]}"]`);
            step.classList.add('inactive');
        }
        
        // Reset selected status
        document.getElementById('selectedStatusInfo').style.display = 'none';
        document.getElementById('submitUpdateBtn').disabled = true;
        document.getElementById('validationWarning').style.display = 'none';
        
        // Reset datetime
        const now = new Date();
        document.getElementById('tanggal_update').value = now.toISOString().slice(0, 16);
        document.getElementById('catatan').value = '';
    }
    
    // Select status
    function selectStatus(status) {
        const currentStatus = document.querySelector('.status-step.active').getAttribute('data-status');
        const statusDataItem = statusData[status];
        
        // Update input hidden
        document.getElementById('status_baru').value = status;
        
        // Update selected status info
        document.getElementById('selectedIcon').className = statusDataItem.icon;
        document.getElementById('selectedIcon').style.color = statusDataItem.color;
        document.getElementById('selectedStatusLabel').textContent = statusDataItem.label;
        document.getElementById('selectedStatusLabel').style.color = statusDataItem.color;
        document.getElementById('selectedStatusDesc').textContent = statusDataItem.description;
        document.getElementById('selectedStatusInfo').style.display = 'block';
        
        // Update status flow visual
        document.querySelectorAll('.status-step').forEach(step => {
            step.classList.remove('active');
            const stepStatus = step.getAttribute('data-status');
            
            if (stepStatus === status) {
                step.classList.add('active');
            }
            
            const statusOrder = ['dipanen', 'dikemas', 'dikirim', 'diterima'];
            const selectedIndex = statusOrder.indexOf(status);
            const stepIndex = statusOrder.indexOf(stepStatus);
            
            if (stepIndex <= selectedIndex) {
                step.classList.add('completed');
                step.querySelector('.step-circle').style.backgroundColor = stepIndex === selectedIndex ? statusDataItem.color : '#4CAF50';
                step.querySelector('.step-circle').style.borderColor = stepIndex === selectedIndex ? statusDataItem.color : '#4CAF50';
                
                if (stepIndex < selectedIndex) {
                    step.querySelector('.step-connector').style.backgroundColor = '#4CAF50';
                }
            }
        });
        
        // Enable submit button
        document.getElementById('submitUpdateBtn').disabled = false;
        
        // Validate status change
        validateStatusChange(currentStatus, status);
    }
    
    // Validate status change
    function validateStatusChange(currentStatus, newStatus) {
        const validationDiv = document.getElementById('validationWarning');
        const warningTitle = document.getElementById('warningTitle');
        const warningMessage = document.getElementById('warningMessage');
        
        const statusOrder = ['dipanen', 'dikemas', 'dikirim', 'diterima'];
        const currentIndex = statusOrder.indexOf(currentStatus);
        const newIndex = statusOrder.indexOf(newStatus);
        
        // Reset warning
        validationDiv.style.display = 'none';
        
        // Status mundur (tidak diizinkan)
        if (newIndex < currentIndex) {
            warningTitle.textContent = 'Perubahan Status Tidak Diizinkan';
            warningMessage.textContent = 'Tidak dapat mengubah status ke sebelumnya. Status hanya dapat maju sesuai alur: Dipanen → Dikemas → Dikirim → Diterima.';
            validationDiv.style.backgroundColor = '#F8D7DA';
            validationDiv.style.borderColor = '#F5C6CB';
            validationDiv.querySelector('i').style.color = '#F44336';
            validationDiv.style.display = 'block';
            document.getElementById('submitUpdateBtn').disabled = true;
            return false;
        }
        
        // Lompat status (peringatan)
        if (newIndex > currentIndex + 1) {
            warningTitle.textContent = 'Peringatan: Loncat Status';
            warningMessage.textContent = 'Anda melompati satu atau lebih status. Pastikan semua proses antara telah selesai sebelum melanjutkan.';
            validationDiv.style.backgroundColor = '#FFF3CD';
            validationDiv.style.borderColor = '#FFEEBA';
            validationDiv.querySelector('i').style.color = '#FFC107';
            validationDiv.style.display = 'block';
            return true;
        }
        
        // Status sama (info)
        if (newIndex === currentIndex) {
            warningTitle.textContent = 'Informasi';
            warningMessage.textContent = 'Status baru sama dengan status saat ini. Tidak ada perubahan yang akan dilakukan.';
            validationDiv.style.backgroundColor = '#D1ECF1';
            validationDiv.style.borderColor = '#BEE5EB';
            validationDiv.querySelector('i').style.color = '#0C5460';
            validationDiv.style.display = 'block';
            return true;
        }
        
        return true;
    }
    
    // Delete distribusi
    function deleteDistribusi(id) {
        if (confirm('Apakah Anda yakin ingin menghapus data distribusi ini?')) {
            const index = distribusiData.findIndex(d => d.id === id);
            if (index !== -1) {
                distribusiData.splice(index, 1);
                loadTableData();
                updateStatistics();
                alert('Data distribusi berhasil dihapus!');
            }
        }
    }
    
    // Event Listeners
    // Refresh button
    refreshBtn.addEventListener('click', function() {
        this.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Loading...';
        setTimeout(() => {
            loadTableData();
            updateStatistics();
            this.innerHTML = '<i class="fas fa-sync-alt"></i> Refresh';
            alert('Data berhasil direfresh!');
        }, 1000);
    });
    
    // Export button
    exportBtn.addEventListener('click', function() {
        alert('Data berhasil diexport dalam format CSV!');
    });
    
    // Apply filter
    applyFilterBtn.addEventListener('click', function() {
        const status = document.getElementById('filterStatus').value;
        const tanggalMulai = document.getElementById('filterTanggalMulai').value;
        const tanggalSampai = document.getElementById('filterTanggalSampai').value;
        const petani = document.getElementById('filterPetani').value;
        
        currentFilteredData = distribusiData.filter(item => {
            // Filter status
            if (status && item.status !== status) return false;
            
            // Filter tanggal
            if (tanggalMulai) {
                const itemDate = new Date(item.tanggal_panen);
                const filterDate = new Date(tanggalMulai);
                if (itemDate < filterDate) return false;
            }
            
            if (tanggalSampai) {
                const itemDate = new Date(item.tanggal_panen);
                const filterDate = new Date(tanggalSampai);
                if (itemDate > filterDate) return false;
            }
            
            // Filter petani
            if (petani && item.petani !== petani) return false;
            
            return true;
        });
        
        currentPage = 1;
        loadTableData();
        updateStatistics();
    });
    
    // Reset filter
    resetFilterBtn.addEventListener('click', function() {
        document.getElementById('filterStatus').value = '';
        document.getElementById('filterTanggalMulai').value = '{{ date('Y-m-d', strtotime('-7 days')) }}';
        document.getElementById('filterTanggalSampai').value = '{{ date('Y-m-d') }}';
        document.getElementById('filterPetani').value = '';
        
        currentFilteredData = [...distribusiData];
        currentPage = 1;
        loadTableData();
        updateStatistics();
    });
    
    // Close update section
    closeUpdateSection.addEventListener('click', function() {
        updateStatusSection.style.display = 'none';
    });
    
    // Cancel update
    cancelUpdateBtn.addEventListener('click', function() {
        updateStatusSection.style.display = 'none';
    });
    
    // Submit update form
    document.getElementById('updateStatusForm').addEventListener('submit', function(e) {
        e.preventDefault();
        
        const id = parseInt(document.getElementById('distribusi_id').value);
        const status = document.getElementById('status_baru').value;
        const tanggal = document.getElementById('tanggal_update').value;
        const catatan = document.getElementById('catatan').value;
        
        const item = distribusiData.find(d => d.id === id);
        if (!item) return;
        
        const statusLabel = statusData[status].label;
        
        // Update data
        item.status = status;
        if (!item.history) item.history = [];
        item.history.push({
            status: status,
            tanggal: tanggal,
            catatan: catatan || 'Perubahan status'
        });
        
        // Reload table
        loadTableData();
        updateStatistics();
        
        // Hide update section
        updateStatusSection.style.display = 'none';
        
        // Show success message
        alert(`Status berhasil diupdate ke: ${statusLabel}`);
        
        // Scroll to top
        window.scrollTo({ top: 0, behavior: 'smooth' });
    });
    
    // Pagination prev/next
    document.querySelector('.prev').addEventListener('click', function() {
        if (currentPage > 1) {
            currentPage--;
            loadTableData();
        }
    });
    
    document.querySelector('.next').addEventListener('click', function() {
        const totalPages = Math.ceil(currentFilteredData.length / itemsPerPage);
        if (currentPage < totalPages) {
            currentPage++;
            loadTableData();
        }
    });
});
</script>
@endsection