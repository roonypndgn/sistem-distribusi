@extends('layouts.manajer')

@section('title', 'Input Data Pengemasan - PT. Mardua Holong')

@section('page-title', 'Input Data Pengemasan')
@section('page-subtitle', 'Sistem Pengemasan Jeruk')

@section('content')
<div class="content-grid">
    <!-- Form Input -->
    <div class="content-card" style="grid-column: span 2;">
        <div class="card-title">
            <span>Form Input Data Pengemasan Jeruk</span>
            <div class="card-icon">
                <i class="fas fa-box"></i>
            </div>
        </div>
        
        <!-- Success Alert -->
        <div id="successAlert" class="alert-success" style="display: none;">
            <i class="fas fa-check-circle"></i>
            <span>Data pengemasan berhasil disimpan!</span>
        </div>
        
        <!-- Error Alert -->
        <div id="errorAlert" class="alert-error" style="display: none;">
            <i class="fas fa-exclamation-circle"></i>
            <span id="errorMessage"></span>
        </div>
        
        <form id="pengemasanForm">
            @csrf
            
            <!-- ID Panen (Combobox) -->
            <div class="form-group">
                <label class="form-label">ID Panen *</label>
                <div class="input-wrapper">
                    <i class="fas fa-seedling input-icon"></i>
                    <select id="panen_id" name="panen_id" class="form-control" required>
                        <option value="">-- Pilih Data Panen --</option>
                        <option value="1">PNH-2024-03-001 | Panen: 25 Mar 2024 | Kualitas: A | 500 kg | Tuan Sitorus</option>
                        <option value="2">PNH-2024-03-002 | Panen: 26 Mar 2024 | Kualitas: B | 350 kg | Budi Santoso</option>
                        <option value="3">PNH-2024-03-003 | Panen: 27 Mar 2024 | Kualitas: A | 420 kg | Joko Widodo</option>
                        <option value="4">PNH-2024-03-004 | Panen: 28 Mar 2024 | Kualitas: C | 280 kg | Siti Aminah</option>
                        <option value="5">PNH-2024-03-005 | Panen: 29 Mar 2024 | Kualitas: B | 320 kg | Rudi Hartono</option>
                        <option value="6">PNH-2024-03-006 | Panen: 30 Mar 2024 | Kualitas: A | 450 kg | Ani Wijaya</option>
                    </select>
                </div>
                <small class="form-text">Pilih data panen yang akan dikemas</small>
            </div>
            
            <!-- Detail Data Panen -->
            <div id="panenDetail" style="display: none; background-color: var(--primary-lighter); border-radius: 10px; padding: 15px; margin-bottom: 20px;">
                <div style="display: grid; grid-template-columns: repeat(2, 1fr); gap: 10px;">
                    <div>
                        <div style="font-size: 13px; color: var(--text-light);">Batch Panen</div>
                        <div id="detailBatch" style="font-weight: 600; color: var(--text-dark);">-</div>
                    </div>
                    <div>
                        <div style="font-size: 13px; color: var(--text-light);">Tanggal Panen</div>
                        <div id="detailTanggal" style="font-weight: 600; color: var(--text-dark);">-</div>
                    </div>
                    <div>
                        <div style="font-size: 13px; color: var(--text-light);">Kualitas Jeruk</div>
                        <div id="detailKualitas" style="font-weight: 600; color: var(--text-dark);">-</div>
                    </div>
                    <div>
                        <div style="font-size: 13px; color: var(--text-light);">Jumlah (kg)</div>
                        <div id="detailJumlah" style="font-weight: 600; color: var(--text-dark);">-</div>
                    </div>
                    <div style="grid-column: span 2;">
                        <div style="font-size: 13px; color: var(--text-light);">Petani</div>
                        <div id="detailPetani" style="font-weight: 600; color: var(--text-dark);">-</div>
                    </div>
                </div>
            </div>
            
            <!-- Batch Pengemasan -->
            <div class="form-group">
                <label class="form-label">Batch Pengemasan *</label>
                <div style="display: flex; gap: 10px;">
                    <div style="position: relative; flex: 1;">
                        <div class="input-wrapper">
                            <i class="fas fa-barcode input-icon"></i>
                            <input type="text" id="batch_pengemasan" name="batch_pengemasan" class="form-control" 
                                   placeholder="Contoh: KRD-001, KRN-025, PTI-100" required>
                        </div>
                    </div>
                    <button type="button" id="generateBatchBtn" class="btn" style="background-color: var(--primary-lighter); color: var(--primary); white-space: nowrap;">
                        <i class="fas fa-bolt"></i> Generate
                    </button>
                </div>
                <small class="form-text">Format: [Jenis]-[Nomor] (Contoh: KRD-001 untuk Kardus)</small>
            </div>
            
            <!-- Jumlah Kemasan -->
            <div class="form-group">
                <label class="form-label">Jumlah Kemasan *</label>
                <div class="input-wrapper">
                    <i class="fas fa-layer-group input-icon"></i>
                    <input type="number" id="jumlah_kemasan" name="jumlah_kemasan" class="form-control" 
                           placeholder="Contoh: 50" min="1" max="1000" required>
                </div>
                <small class="form-text">Jumlah total kemasan yang dibuat</small>
            </div>
            
            <!-- Jenis Kemasan -->
            <div class="form-group">
                <label class="form-label">Jenis Kemasan *</label>
                <div class="quality-options" style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 10px;">
                    <label class="quality-option" style="text-align: center; cursor: pointer;">
                        <input type="radio" name="kualitas_pengemasan" value="kardus" class="quality-radio" style="display: none;">
                        <div class="quality-card" style="padding: 20px; border: 2px solid var(--border); border-radius: 10px; transition: var(--transition);">
                            <div style="font-size: 32px; color: #795548; margin-bottom: 10px;">
                                <i class="fas fa-box-open"></i>
                            </div>
                            <div style="font-weight: 600; color: var(--text-dark);">Kardus</div>
                            <div style="font-size: 12px; color: var(--text-light); margin-top: 5px;">
                                <div>Kapasitas: 10 kg</div>
                                <div>Harga: Rp 5.000</div>
                            </div>
                        </div>
                    </label>
                    
                    <label class="quality-option" style="text-align: center; cursor: pointer;">
                        <input type="radio" name="kualitas_pengemasan" value="keranjang" class="quality-radio" style="display: none;">
                        <div class="quality-card" style="padding: 20px; border: 2px solid var(--border); border-radius: 10px; transition: var(--transition);">
                            <div style="font-size: 32px; color: #8D6E63; margin-bottom: 10px;">
                                <i class="fas fa-shopping-basket"></i>
                            </div>
                            <div style="font-weight: 600; color: var(--text-dark);">Keranjang</div>
                            <div style="font-size: 12px; color: var(--text-light); margin-top: 5px;">
                                <div>Kapasitas: 15 kg</div>
                                <div>Harga: Rp 7.500</div>
                            </div>
                        </div>
                    </label>
                    
                    <label class="quality-option" style="text-align: center; cursor: pointer;">
                        <input type="radio" name="kualitas_pengemasan" value="peti" class="quality-radio" style="display: none;">
                        <div class="quality-card" style="padding: 20px; border: 2px solid var(--border); border-radius: 10px; transition: var(--transition);">
                            <div style="font-size: 32px; color: #5D4037; margin-bottom: 10px;">
                                <i class="fas fa-archive"></i>
                            </div>
                            <div style="font-weight: 600; color: var(--text-dark);">Peti Kayu</div>
                            <div style="font-size: 12px; color: var(--text-light); margin-top: 5px;">
                                <div>Kapasitas: 20 kg</div>
                                <div>Harga: Rp 12.000</div>
                            </div>
                        </div>
                    </label>
                </div>
            </div>
            
            <!-- Tanggal Kemas -->
            <div class="form-group">
                <label class="form-label">Tanggal Kemas *</label>
                <div class="input-wrapper">
                    <i class="fas fa-calendar-day input-icon"></i>
                    <input type="datetime-local" id="tanggal_kemas" name="tanggal_kemas" class="form-control" 
                           value="{{ date('Y-m-d\TH:i') }}" required>
                </div>
                <small class="form-text">Tanggal dan waktu proses pengemasan</small>
            </div>
            
            <!-- Informasi Kalkulasi -->
            <div id="calculationInfo" style="display: none; background-color: var(--bg-light); border-radius: 10px; padding: 20px; margin-bottom: 20px;">
                <h4 style="margin-bottom: 15px; color: var(--text-dark);">
                    <i class="fas fa-calculator"></i> Informasi Kalkulasi
                </h4>
                <div style="display: grid; grid-template-columns: repeat(2, 1fr); gap: 15px;">
                    <div>
                        <div style="font-size: 13px; color: var(--text-light);">Total Berat Panen</div>
                        <div id="calcTotalBerat" style="font-weight: 600; color: var(--text-dark); font-size: 18px;">- kg</div>
                    </div>
                    <div>
                        <div style="font-size: 13px; color: var(--text-light);">Jumlah Kemasan</div>
                        <div id="calcJumlahKemasan" style="font-weight: 600; color: var(--text-dark); font-size: 18px;">- unit</div>
                    </div>
                    <div>
                        <div style="font-size: 13px; color: var(--text-light);">Berat per Kemasan</div>
                        <div id="calcBeratPerKemasan" style="font-weight: 600; color: var(--primary); font-size: 18px;">- kg/unit</div>
                    </div>
                    <div>
                        <div style="font-size: 13px; color: var(--text-light);">Kapasitas Kemasan</div>
                        <div id="calcKapasitas" style="font-weight: 600; color: var(--text-dark); font-size: 18px;">- kg</div>
                    </div>
                </div>
                <div id="calcWarning" style="margin-top: 15px; padding: 10px; border-radius: 6px; display: none;"></div>
            </div>
            
            <!-- Catatan Tambahan -->
            <div class="form-group">
                <label class="form-label">Catatan Tambahan</label>
                <textarea id="catatan" name="catatan" class="form-control" rows="3" 
                          placeholder="Masukkan catatan khusus (opsional)..."></textarea>
            </div>
            
            <!-- Tombol Aksi -->
            <div class="form-actions">
                <button type="button" id="resetBtn" class="btn btn-secondary">
                    <i class="fas fa-redo"></i> Reset Form
                </button>
                <button type="button" id="previewBtn" class="btn" style="background-color: var(--primary-lighter); color: var(--primary);">
                    <i class="fas fa-eye"></i> Preview
                </button>
                <button type="submit" id="submitBtn" class="btn btn-success">
                    <i class="fas fa-save"></i> Simpan Data
                </button>
            </div>
        </form>
    </div>
    
    <!-- Panel Info & Panduan -->
    <div class="content-card">
        <div class="card-title">
            <span>Panduan Pengisian</span>
            <div class="card-icon">
                <i class="fas fa-info-circle"></i>
            </div>
        </div>
        
        <div class="guide-list">
            <div class="guide-item">
                <div class="guide-icon">
                    <i class="fas fa-seedling"></i>
                </div>
                <div class="guide-content">
                    <strong>Pilih Data Panen</strong>
                    <p>Pilih data panen yang akan dikemas dari daftar yang tersedia</p>
                </div>
            </div>
            
            <div class="guide-item">
                <div class="guide-icon">
                    <i class="fas fa-box"></i>
                </div>
                <div class="guide-content">
                    <strong>Batch Pengemasan</strong>
                    <p>Buat atau generate batch pengemasan unik untuk tracking</p>
                </div>
            </div>
            
            <div class="guide-item">
                <div class="guide-icon">
                    <i class="fas fa-balance-scale"></i>
                </div>
                <div class="guide-content">
                    <strong>Perhitungan Otomatis</strong>
                    <p>Sistem akan menghitung berat per kemasan secara otomatis</p>
                </div>
            </div>
            
            <div class="guide-item">
                <div class="guide-icon">
                    <i class="fas fa-clipboard-check"></i>
                </div>
                <div class="guide-content">
                    <strong>Verifikasi Data</strong>
                    <p>Preview data sebelum disimpan untuk memastikan keakuratan</p>
                </div>
            </div>
        </div>
        
        <!-- Statistik Kemasan -->
        <div style="margin-top: 30px;">
            <h4 style="margin-bottom: 15px; color: var(--text-dark);">
                <i class="fas fa-chart-pie"></i> Statistik Pengemasan
            </h4>
            <div class="stats-grid">
                <div class="stat-item">
                    <div class="stat-icon" style="background-color: #E8F5E9;">
                        <i class="fas fa-boxes" style="color: #4CAF50;"></i>
                    </div>
                    <div class="stat-content">
                        <div class="stat-number">1.250</div>
                        <div class="stat-label">Total Kemasan</div>
                    </div>
                </div>
                
                <div class="stat-item">
                    <div class="stat-icon" style="background-color: #FFF3E0;">
                        <i class="fas fa-box-open" style="color: #FF9800;"></i>
                    </div>
                    <div class="stat-content">
                        <div class="stat-number">850</div>
                        <div class="stat-label">Kardus</div>
                    </div>
                </div>
                
                <div class="stat-item">
                    <div class="stat-icon" style="background-color: #E3F2FD;">
                        <i class="fas fa-shopping-basket" style="color: #2196F3;"></i>
                    </div>
                    <div class="stat-content">
                        <div class="stat-number">250</div>
                        <div class="stat-label">Keranjang</div>
                    </div>
                </div>
                
                <div class="stat-item">
                    <div class="stat-icon" style="background-color: #F3E5F5;">
                        <i class="fas fa-archive" style="color: #9C27B0;"></i>
                    </div>
                    <div class="stat-content">
                        <div class="stat-number">150</div>
                        <div class="stat-label">Peti Kayu</div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Riwayat Pengemasan -->
        <div style="margin-top: 30px;">
            <h4 style="margin-bottom: 15px; color: var(--text-dark);">
                <i class="fas fa-history"></i> Riwayat Terbaru
            </h4>
            <div class="history-list">
                <div class="history-item">
                    <div class="history-header">
                        <div class="history-batch">KRD-045</div>
                        <div class="history-date">28 Mar 2024</div>
                    </div>
                    <div class="history-details">
                        <div>50 kemasan × 10 kg</div>
                        <div><strong>500 kg</strong></div>
                    </div>
                    <div style="display: flex; justify-content: space-between; margin-top: 8px; font-size: 12px;">
                        <div>Panen: <strong>PNH-2024-03-001</strong></div>
                        <span class="status-badge status-verified">Selesai</span>
                    </div>
                </div>
                
                <div class="history-item">
                    <div class="history-header">
                        <div class="history-batch">KRN-018</div>
                        <div class="history-date">27 Mar 2024</div>
                    </div>
                    <div class="history-details">
                        <div>35 kemasan × 15 kg</div>
                        <div><strong>525 kg</strong></div>
                    </div>
                    <div style="display: flex; justify-content: space-between; margin-top: 8px; font-size: 12px;">
                        <div>Panen: <strong>PNH-2024-03-002</strong></div>
                        <span class="status-badge status-pending">Proses</span>
                    </div>
                </div>
                
                <div class="history-item">
                    <div class="history-header">
                        <div class="history-batch">PTI-012</div>
                        <div class="history-date">26 Mar 2024</div>
                    </div>
                    <div class="history-details">
                        <div>25 kemasan × 20 kg</div>
                        <div><strong>500 kg</strong></div>
                    </div>
                    <div style="display: flex; justify-content: space-between; margin-top: 8px; font-size: 12px;">
                        <div>Panen: <strong>PNH-2024-03-003</strong></div>
                        <span class="status-badge status-verified">Selesai</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Preview -->
<div class="modal-overlay" id="previewModal" style="display: none;">
    <div class="modal-content">
        <div class="modal-header">
            <h3 class="modal-title">Preview Data Pengemasan</h3>
        </div>
        <div class="modal-body">
            <div id="previewContent" style="display: flex; flex-direction: column; gap: 20px;">
                <!-- Data akan diisi oleh JavaScript -->
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn" id="closePreviewBtn">Edit Lagi</button>
            <button type="button" class="btn btn-primary" id="confirmSubmitBtn">Ya, Simpan Data</button>
        </div>
    </div>
</div>

<style>
    /* Alert Styles */
    .alert-success, .alert-error {
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
        from { transform: translateY(-20px); opacity: 0; }
        to { transform: translateY(0); opacity: 1; }
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
    
    /* Quality Options */
    .quality-option input:checked + .quality-card {
        border-color: var(--primary);
        background-color: var(--primary-lighter);
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    }
    
    .quality-card {
        transition: var(--transition);
    }
    
    .quality-card:hover {
        border-color: var(--primary-light);
        background-color: var(--primary-lighter);
    }
    
    /* Guide List */
    .guide-list {
        display: flex;
        flex-direction: column;
        gap: 15px;
    }
    
    .guide-item {
        display: flex;
        align-items: flex-start;
        gap: 12px;
        padding: 12px;
        background-color: var(--bg-light);
        border-radius: 8px;
    }
    
    .guide-icon {
        width: 36px;
        height: 36px;
        background-color: var(--primary-lighter);
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--primary);
        font-size: 16px;
        flex-shrink: 0;
    }
    
    .guide-content {
        flex: 1;
    }
    
    .guide-content strong {
        display: block;
        margin-bottom: 4px;
        color: var(--text-dark);
        font-size: 14px;
    }
    
    .guide-content p {
        font-size: 13px;
        color: var(--text-light);
        line-height: 1.4;
    }
    
    /* Stats Grid */
    .stats-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 15px;
    }
    
    .stat-item {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 12px;
        background-color: var(--bg-light);
        border-radius: 8px;
    }
    
    .stat-icon {
        width: 48px;
        height: 48px;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 20px;
        flex-shrink: 0;
    }
    
    .stat-content {
        flex: 1;
    }
    
    .stat-number {
        font-size: 20px;
        font-weight: 700;
        color: var(--text-dark);
        line-height: 1;
    }
    
    .stat-label {
        font-size: 12px;
        color: var(--text-light);
        margin-top: 4px;
    }
    
    /* History List */
    .history-list {
        display: flex;
        flex-direction: column;
        gap: 10px;
    }
    
    .history-item {
        padding: 12px;
        background-color: var(--bg-light);
        border-radius: 8px;
        border-left: 4px solid var(--primary);
    }
    
    .history-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 5px;
    }
    
    .history-batch {
        font-weight: 600;
        color: var(--text-dark);
        font-size: 14px;
    }
    
    .history-date {
        font-size: 12px;
        color: var(--text-light);
    }
    
    .history-details {
        display: flex;
        justify-content: space-between;
        font-size: 13px;
        color: var(--text-light);
    }
    
    /* Form Actions */
    .form-actions {
        display: flex;
        gap: 10px;
        margin-top: 30px;
    }
    
    .form-actions .btn {
        flex: 1;
    }
    
    /* Warning Box */
    .warning-box {
        padding: 12px;
        background-color: #FFF3CD;
        border: 1px solid #FFEEBA;
        border-radius: 8px;
        color: #856404;
        font-size: 14px;
        display: flex;
        align-items: flex-start;
        gap: 10px;
    }
    
    .warning-box i {
        color: #FFC107;
        margin-top: 2px;
    }
    
    /* Preview Item */
    .preview-item {
        display: flex;
        margin-bottom: 15px;
        padding-bottom: 15px;
        border-bottom: 1px solid var(--border);
    }
    
    .preview-label {
        width: 150px;
        font-weight: 600;
        color: var(--text-dark);
        font-size: 14px;
    }
    
    .preview-value {
        flex: 1;
        color: var(--text-light);
        font-size: 14px;
    }
    
    .kemasan-badge {
        display: inline-block;
        padding: 4px 10px;
        border-radius: 6px;
        font-size: 12px;
        font-weight: 600;
    }
    
    .badge-kardus {
        background-color: #E8F5E9;
        color: #2E7D32;
    }
    
    .badge-keranjang {
        background-color: #E3F2FD;
        color: #1565C0;
    }
    
    .badge-peti {
        background-color: #F3E5F5;
        color: #7B1FA2;
    }
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Data panen dummy
    const panenData = {
        1: {
            batch: 'PNH-2024-03-001',
            tanggal: '25 Maret 2024',
            kualitas: 'A (Premium)',
            jumlah: 500,
            petani: 'Tuan Sitorus',
            lokasi: 'Berastagi'
        },
        2: {
            batch: 'PNH-2024-03-002',
            tanggal: '26 Maret 2024',
            kualitas: 'B (Standar)',
            jumlah: 350,
            petani: 'Budi Santoso',
            lokasi: 'Sipirok'
        },
        3: {
            batch: 'PNH-2024-03-003',
            tanggal: '27 Maret 2024',
            kualitas: 'A (Premium)',
            jumlah: 420,
            petani: 'Joko Widodo',
            lokasi: 'Parapat'
        },
        4: {
            batch: 'PNH-2024-03-004',
            tanggal: '28 Maret 2024',
            kualitas: 'C (Ekonomis)',
            jumlah: 280,
            petani: 'Siti Aminah',
            lokasi: 'Berastagi'
        },
        5: {
            batch: 'PNH-2024-03-005',
            tanggal: '29 Maret 2024',
            kualitas: 'B (Standar)',
            jumlah: 320,
            petani: 'Rudi Hartono',
            lokasi: 'Simalungun'
        },
        6: {
            batch: 'PNH-2024-03-006',
            tanggal: '30 Maret 2024',
            kualitas: 'A (Premium)',
            jumlah: 450,
            petani: 'Ani Wijaya',
            lokasi: 'Karo'
        }
    };
    
    // Data kapasitas kemasan
    const kapasitasKemasan = {
        kardus: 10,
        keranjang: 15,
        peti: 20
    };
    
    // Elemen DOM
    const form = document.getElementById('pengemasanForm');
    const panenSelect = document.getElementById('panen_id');
    const panenDetail = document.getElementById('panenDetail');
    const batchInput = document.getElementById('batch_pengemasan');
    const jumlahKemasanInput = document.getElementById('jumlah_kemasan');
    const qualityOptions = document.querySelectorAll('.quality-option');
    const calculationInfo = document.getElementById('calculationInfo');
    const tanggalKemas = document.getElementById('tanggal_kemas');
    const generateBatchBtn = document.getElementById('generateBatchBtn');
    const resetBtn = document.getElementById('resetBtn');
    const previewBtn = document.getElementById('previewBtn');
    const submitBtn = document.getElementById('submitBtn');
    const successAlert = document.getElementById('successAlert');
    const errorAlert = document.getElementById('errorAlert');
    const errorMessage = document.getElementById('errorMessage');
    const previewModal = document.getElementById('previewModal');
    const closePreviewBtn = document.getElementById('closePreviewBtn');
    const confirmSubmitBtn = document.getElementById('confirmSubmitBtn');
    
    // Tampilkan detail panen saat dipilih
    panenSelect.addEventListener('change', function() {
        const selectedId = this.value;
        
        if (selectedId) {
            const data = panenData[selectedId];
            if (data) {
                document.getElementById('detailBatch').textContent = data.batch;
                document.getElementById('detailTanggal').textContent = data.tanggal;
                document.getElementById('detailKualitas').textContent = data.kualitas;
                document.getElementById('detailJumlah').textContent = `${data.jumlah} kg`;
                document.getElementById('detailPetani').textContent = data.petani;
                panenDetail.style.display = 'block';
                
                // Update calculation info
                updateCalculationInfo();
            }
        } else {
            panenDetail.style.display = 'none';
            calculationInfo.style.display = 'none';
        }
    });
    
    // Handler untuk pilihan kualitas kemasan
    qualityOptions.forEach(option => {
        option.addEventListener('click', function() {
            // Hapus selected dari semua option
            qualityOptions.forEach(opt => {
                opt.querySelector('.quality-card').style.borderColor = 'var(--border)';
                opt.querySelector('.quality-card').style.backgroundColor = 'white';
                opt.querySelector('.quality-card').style.transform = 'translateY(0)';
                opt.querySelector('.quality-card').style.boxShadow = 'none';
            });
            
            // Tandai yang dipilih
            const card = this.querySelector('.quality-card');
            card.style.borderColor = 'var(--primary)';
            card.style.backgroundColor = 'var(--primary-lighter)';
            card.style.transform = 'translateY(-2px)';
            card.style.boxShadow = '0 4px 12px rgba(0, 0, 0, 0.1)';
            
            // Check radio button yang sesuai
            this.querySelector('.quality-radio').checked = true;
            
            // Update calculation info
            updateCalculationInfo();
        });
    });
    
    // Handler untuk generate batch
    generateBatchBtn.addEventListener('click', function() {
        const kualitas = document.querySelector('input[name="kualitas_pengemasan"]:checked')?.value;
        
        if (!kualitas) {
            alert('Pilih jenis kemasan terlebih dahulu!');
            return;
        }
        
        // Prefix berdasarkan kualitas
        let prefix = '';
        switch(kualitas) {
            case 'kardus':
                prefix = 'KRD';
                break;
            case 'keranjang':
                prefix = 'KRN';
                break;
            case 'peti':
                prefix = 'PTI';
                break;
        }
        
        // Generate nomor acak
        const sequence = Math.floor(Math.random() * 999) + 1;
        const batch = `${prefix}-${sequence.toString().padStart(3, '0')}`;
        
        batchInput.value = batch;
    });
    
    // Update calculation info
    function updateCalculationInfo() {
        const panenId = panenSelect.value;
        const jumlahKemasan = parseInt(jumlahKemasanInput.value) || 0;
        const kualitas = document.querySelector('input[name="kualitas_pengemasan"]:checked')?.value;
        
        if (!panenId || !kualitas) {
            calculationInfo.style.display = 'none';
            return;
        }
        
        const dataPanen = panenData[panenId];
        if (!dataPanen) return;
        
        const totalBerat = dataPanen.jumlah;
        const kapasitas = kapasitasKemasan[kualitas];
        const beratPerKemasan = totalBerat / jumlahKemasan;
        
        // Update display
        document.getElementById('calcTotalBerat').textContent = `${totalBerat} kg`;
        document.getElementById('calcJumlahKemasan').textContent = `${jumlahKemasan} unit`;
        document.getElementById('calcBeratPerKemasan').textContent = `${beratPerKemasan.toFixed(2)} kg/unit`;
        document.getElementById('calcKapasitas').textContent = `${kapasitas} kg`;
        
        // Tampilkan warning jika ada
        const warningDiv = document.getElementById('calcWarning');
        warningDiv.style.display = 'none';
        warningDiv.innerHTML = '';
        
        if (jumlahKemasan > 0) {
            if (beratPerKemasan > kapasitas) {
                warningDiv.style.display = 'block';
                warningDiv.style.backgroundColor = '#F8D7DA';
                warningDiv.style.color = '#721C24';
                warningDiv.style.padding = '10px';
                warningDiv.style.borderRadius = '6px';
                warningDiv.innerHTML = `
                    <i class="fas fa-exclamation-triangle"></i>
                    <strong>Peringatan:</strong> Berat per kemasan (${beratPerKemasan.toFixed(2)} kg) melebihi kapasitas maksimal (${kapasitas} kg). Kurangi jumlah kemasan atau pilih kemasan dengan kapasitas lebih besar.
                `;
            } else if (beratPerKemasan < kapasitas * 0.5) {
                warningDiv.style.display = 'block';
                warningDiv.style.backgroundColor = '#FFF3CD';
                warningDiv.style.color = '#856404';
                warningDiv.style.padding = '10px';
                warningDiv.style.borderRadius = '6px';
                warningDiv.innerHTML = `
                    <i class="fas fa-info-circle"></i>
                    <strong>Saran:</strong> Berat per kemasan (${beratPerKemasan.toFixed(2)} kg) jauh di bawah kapasitas. Pertimbangkan untuk mengurangi jumlah kemasan untuk mengoptimalkan biaya.
                `;
            }
        }
        
        calculationInfo.style.display = 'block';
    }
    
    // Event listeners untuk update calculation
    jumlahKemasanInput.addEventListener('input', updateCalculationInfo);
    
    // Reset form
    resetBtn.addEventListener('click', function() {
        if (confirm('Apakah Anda yakin ingin mereset form? Semua data yang telah diisi akan hilang.')) {
            form.reset();
            panenDetail.style.display = 'none';
            calculationInfo.style.display = 'none';
            successAlert.style.display = 'none';
            errorAlert.style.display = 'none';
            
            // Reset quality cards
            qualityOptions.forEach(option => {
                const card = option.querySelector('.quality-card');
                card.style.borderColor = 'var(--border)';
                card.style.backgroundColor = 'white';
                card.style.transform = 'translateY(0)';
                card.style.boxShadow = 'none';
            });
        }
    });
    
    // Validasi form
    function validateForm() {
        const errors = [];
        
        // Validasi required fields
        const requiredFields = [
            { id: 'panen_id', name: 'ID Panen' },
            { id: 'batch_pengemasan', name: 'Batch Pengemasan' },
            { id: 'jumlah_kemasan', name: 'Jumlah Kemasan' }
        ];
        
        requiredFields.forEach(field => {
            const element = document.getElementById(field.id);
            if (!element.value.trim()) {
                errors.push(`${field.name} harus diisi`);
            }
        });
        
        // Validasi Jenis Kemasan
        const kualitas = document.querySelector('input[name="kualitas_pengemasan"]:checked');
        if (!kualitas) {
            errors.push('Jenis kemasan harus dipilih');
        }
        
        // Validasi jumlah kemasan
        const jumlah = parseInt(jumlahKemasanInput.value);
        if (jumlah < 1 || jumlah > 1000) {
            errors.push('Jumlah kemasan harus antara 1 - 1000 unit');
        }
        
        // Validasi perhitungan
        if (panenSelect.value && kualitas) {
            const dataPanen = panenData[panenSelect.value];
            const kapasitas = kapasitasKemasan[kualitas.value];
            const beratPerKemasan = dataPanen.jumlah / jumlah;
            
            if (beratPerKemasan > kapasitas) {
                errors.push(`Berat per kemasan (${beratPerKemasan.toFixed(2)} kg) melebihi kapasitas maksimal (${kapasitas} kg)`);
            }
        }
        
        return errors;
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
    
    // Show success message
    function showSuccess(message) {
        successAlert.innerHTML = `<i class="fas fa-check-circle"></i> <span>${message}</span>`;
        successAlert.style.display = 'flex';
        errorAlert.style.display = 'none';
        
        setTimeout(() => {
            successAlert.style.display = 'none';
        }, 5000);
    }
    
    // Preview button handler
    previewBtn.addEventListener('click', function() {
        const errors = validateForm();
        if (errors.length > 0) {
            showError(errors.join('<br>'));
            return;
        }
        
        // Ambil data dari form
        const panenId = panenSelect.value;
        const dataPanen = panenData[panenId];
        const batch = batchInput.value;
        const jumlahKemasan = parseInt(jumlahKemasanInput.value);
        const kualitas = document.querySelector('input[name="kualitas_pengemasan"]:checked').value;
        const tanggal = new Date(tanggalKemas.value);
        const catatan = document.getElementById('catatan').value;
        
        // Format tanggal
        const formattedDate = tanggal.toLocaleDateString('id-ID', {
            weekday: 'long',
            year: 'numeric',
            month: 'long',
            day: 'numeric',
            hour: '2-digit',
            minute: '2-digit'
        });
        
        // Hitung berat per kemasan
        const beratPerKemasan = dataPanen.jumlah / jumlahKemasan;
        const totalBerat = dataPanen.jumlah;
        
        // Tentukan badge class
        let badgeClass = '';
        let kualitasText = '';
        switch(kualitas) {
            case 'kardus':
                badgeClass = 'badge-kardus';
                kualitasText = 'Kardus (10 kg)';
                break;
            case 'keranjang':
                badgeClass = 'badge-keranjang';
                kualitasText = 'Keranjang (15 kg)';
                break;
            case 'peti':
                badgeClass = 'badge-peti';
                kualitasText = 'Peti Kayu (20 kg)';
                break;
        }
        
        // Isi preview content
        const previewContent = document.getElementById('previewContent');
        previewContent.innerHTML = `
            <div class="preview-item">
                <div class="preview-label">Batch Panen</div>
                <div class="preview-value">${dataPanen.batch}</div>
            </div>
            <div class="preview-item">
                <div class="preview-label">Tanggal Panen</div>
                <div class="preview-value">${dataPanen.tanggal}</div>
            </div>
            <div class="preview-item">
                <div class="preview-label">Petani</div>
                <div class="preview-value">${dataPanen.petani}</div>
            </div>
            <div class="preview-item">
                <div class="preview-label">Total Berat</div>
                <div class="preview-value"><strong>${totalBerat} kg</strong></div>
            </div>
            <div class="preview-item">
                <div class="preview-label">Batch Pengemasan</div>
                <div class="preview-value"><strong>${batch}</strong></div>
            </div>
            <div class="preview-item">
                <div class="preview-label">Jumlah Kemasan</div>
                <div class="preview-value">${jumlahKemasan} unit</div>
            </div>
            <div class="preview-item">
                <div class="preview-label">Berat per Kemasan</div>
                <div class="preview-value"><strong>${beratPerKemasan.toFixed(2)} kg/unit</strong></div>
            </div>
            <div class="preview-item">
                <div class="preview-label">Jenis Kemasan</div>
                <div class="preview-value">
                    <span class="kemasan-badge ${badgeClass}">${kualitasText}</span>
                </div>
            </div>
            <div class="preview-item">
                <div class="preview-label">Tanggal Kemas</div>
                <div class="preview-value">${formattedDate}</div>
            </div>
            ${catatan ? `
            <div class="preview-item">
                <div class="preview-label">Catatan</div>
                <div class="preview-value">${catatan}</div>
            </div>
            ` : ''}
            <div style="background-color: var(--primary-lighter); padding: 15px; border-radius: 10px; margin-top: 10px;">
                <div style="display: flex; align-items: center; gap: 10px; margin-bottom: 10px;">
                    <i class="fas fa-info-circle" style="color: var(--primary);"></i>
                    <div style="font-weight: 600; color: var(--text-dark);">Informasi</div>
                </div>
                <div style="font-size: 13px; color: var(--text-light);">
                    Data pengemasan akan dicatat dalam sistem. Pastikan semua data sudah benar sebelum disimpan.
                </div>
            </div>
        `;
        
        // Tampilkan modal
        previewModal.style.display = 'flex';
        document.body.style.overflow = 'hidden';
    });
    
    // Close preview modal
    closePreviewBtn.addEventListener('click', function() {
        previewModal.style.display = 'none';
        document.body.style.overflow = 'auto';
    });
    
    // Confirm submit from preview
    confirmSubmitBtn.addEventListener('click', function() {
        // Simulasi penyimpanan data
        const panenId = panenSelect.value;
        const dataPanen = panenData[panenId];
        const batch = batchInput.value;
        const jumlahKemasan = parseInt(jumlahKemasanInput.value);
        const kualitas = document.querySelector('input[name="kualitas_pengemasan"]:checked').value;
        
        // Generate ID simulasi
        const simulatedId = 'PGM-' + Date.now() + '-' + Math.floor(Math.random() * 1000);
        
        // Reset form
        form.reset();
        panenDetail.style.display = 'none';
        calculationInfo.style.display = 'none';
        
        // Reset quality cards
        qualityOptions.forEach(option => {
            const card = option.querySelector('.quality-card');
            card.style.borderColor = 'var(--border)';
            card.style.backgroundColor = 'white';
            card.style.transform = 'translateY(0)';
            card.style.boxShadow = 'none';
        });
        
        // Close modal
        previewModal.style.display = 'none';
        document.body.style.overflow = 'auto';
        
        // Show success message
        showSuccess(`Data pengemasan berhasil disimpan! ID: ${simulatedId}<br>Batch: ${batch} untuk ${dataPanen.batch}`);
        
        // Scroll ke atas
        window.scrollTo({ top: 0, behavior: 'smooth' });
    });
    
    // Submit form langsung
    submitBtn.addEventListener('click', function() {
        previewBtn.click();
    });
    
    // Initialize date time
    const now = new Date();
    tanggalKemas.value = now.toISOString().slice(0, 16);
});
</script>
@endsection