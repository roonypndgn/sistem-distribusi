@extends('layouts.manajer')

@section('title', 'Input Data Pengiriman - PT. Mardua Holong')

@section('page-title', 'Input Data Pengiriman')
@section('page-subtitle', 'Sistem Logistik Pengiriman Jeruk')

@section('content')
<div class="content-grid">
    <!-- Form Input -->
    <div class="content-card" style="grid-column: span 2;">
        <div class="card-title">
            <span>Form Input Data Pengiriman Jeruk</span>
            <div class="card-icon">
                <i class="fas fa-truck"></i>
            </div>
        </div>
        
        <!-- Success Alert -->
        <div id="successAlert" class="alert-success" style="display: none;">
            <i class="fas fa-check-circle"></i>
            <span id="successMessage">Data pengiriman berhasil disimpan!</span>
        </div>
        
        <!-- Error Alert -->
        <div id="errorAlert" class="alert-error" style="display: none;">
            <i class="fas fa-exclamation-circle"></i>
            <span id="errorMessage"></span>
        </div>
        
        <form id="pengirimanForm">
            @csrf
            
            <!-- Tanggal Kirim -->
            <div class="form-group">
                <label class="form-label">Tanggal Kirim *</label>
                <div class="input-wrapper">
                    <i class="fas fa-calendar-day input-icon"></i>
                    <input type="datetime-local" id="tanggal_kirim" name="tanggal_kirim" class="form-control" 
                           value="{{ date('Y-m-d\TH:i') }}" required>
                </div>
                <small class="form-text">Tanggal dan waktu rencana pengiriman</small>
            </div>
            
            <!-- Data Barang yang Dikirim -->
            <div class="form-group">
                <label class="form-label">Data Barang yang Dikirim *</label>
                <div style="background-color: var(--bg-light); border-radius: 10px; padding: 15px; margin-bottom: 10px;">
                    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 15px;">
                        <h4 style="color: var(--text-dark); font-size: 15px;">Pilih Barang dari Gudang</h4>
                        <button type="button" id="tambahBarangBtn" class="btn" style="background-color: var(--primary-lighter); color: var(--primary); padding: 8px 12px; font-size: 13px;">
                            <i class="fas fa-plus"></i> Tambah Barang
                        </button>
                    </div>
                    
                    <!-- Daftar Barang -->
                    <div id="daftarBarangContainer">
                        <!-- Barang akan ditambahkan via JavaScript -->
                        <div id="emptyBarang" style="text-align: center; padding: 20px; color: var(--text-light);">
                            <i class="fas fa-box-open" style="font-size: 32px; margin-bottom: 10px; opacity: 0.5;"></i>
                            <p>Belum ada barang ditambahkan</p>
                            <small>Klik "Tambah Barang" untuk menambahkan barang dari gudang</small>
                        </div>
                    </div>
                    
                    <!-- Total Barang -->
                    <div id="totalBarangInfo" style="display: none; margin-top: 15px; padding-top: 15px; border-top: 2px solid var(--border);">
                        <div style="display: flex; justify-content: space-between; font-weight: 600; color: var(--text-dark);">
                            <div>Total Barang:</div>
                            <div id="totalBarangCount">0 item</div>
                        </div>
                        <div style="display: flex; justify-content: space-between; margin-top: 5px; font-size: 14px; color: var(--text-light);">
                            <div>Total Berat:</div>
                            <div id="totalBerat">0 kg</div>
                        </div>
                    </div>
                </div>
                <small class="form-text">Pilih barang dari gudang yang akan dikirim</small>
            </div>
            
            <!-- Supir (User ID) -->
            <div class="form-group">
                <label class="form-label">Supir *</label>
                <div class="input-wrapper">
                    <i class="fas fa-user-tie input-icon"></i>
                    <select id="user_id" name="user_id" class="form-control" required>
                        <option value="">-- Pilih Supir --</option>
                        <option value="1">Supir 1: Budi Santoso (081234567890) | SIM: B2 Umum</option>
                        <option value="2">Supir 2: Joko Widodo (081298765432) | SIM: B1 Umum</option>
                        <option value="3">Supir 3: Rudi Hartono (081312345678) | SIM: B2 Umum</option>
                        <option value="4">Supir 4: Siti Aminah (081398765432) | SIM: B1 Umum</option>
                        <option value="5">Supir 5: Ahmad Fauzi (081412345678) | SIM: B2 Umum</option>
                    </select>
                </div>
                <div id="supirDetail" style="display: none; margin-top: 10px; padding: 10px; background-color: var(--primary-lighter); border-radius: 8px; font-size: 13px;">
                    <div><strong>Nama:</strong> <span id="detailNama">-</span></div>
                    <div><strong>Kontak:</strong> <span id="detailKontak">-</span></div>
                    <div><strong>SIM:</strong> <span id="detailSim">-</span></div>
                    <div><strong>Status:</strong> <span id="detailStatus" class="status-badge status-verified">Available</span></div>
                </div>
            </div>
            
            <!-- Kendaraan -->
            <div class="form-group">
                <label class="form-label">Kendaraan *</label>
                <div class="input-wrapper">
                    <i class="fas fa-truck-loading input-icon"></i>
                    <select id="kendaraan" name="kendaraan" class="form-control" required>
                        <option value="">-- Pilih Kendaraan --</option>
                        <option value="1">TRK-001: Truk Box 10 Ton | Plat: BK 1234 AB | Kapasitas: 10.000 kg</option>
                        <option value="2">TRK-002: Truk Fuso 7.5 Ton | Plat: BK 5678 CD | Kapasitas: 7.500 kg</option>
                        <option value="3">TRK-003: Truk Engkel 4 Ton | Plat: BK 9012 EF | Kapasitas: 4.000 kg</option>
                        <option value="4">TRK-004: Pickup 2 Ton | Plat: BK 3456 GH | Kapasitas: 2.000 kg</option>
                        <option value="5">TRK-005: Truk Box 12 Ton | Plat: BK 7890 IJ | Kapasitas: 12.000 kg</option>
                    </select>
                </div>
                <div id="kendaraanDetail" style="display: none; margin-top: 10px; padding: 10px; background-color: var(--primary-lighter); border-radius: 8px; font-size: 13px;">
                    <div><strong>Jenis:</strong> <span id="detailJenis">-</span></div>
                    <div><strong>Plat:</strong> <span id="detailPlat">-</span></div>
                    <div><strong>Kapasitas:</strong> <span id="detailKapasitas">-</span></div>
                    <div><strong>Status:</strong> <span id="detailKendaraanStatus" class="status-badge status-verified">Available</span></div>
                </div>
            </div>
            
            <!-- Rute -->
            <div class="form-group">
                <label class="form-label">Rute *</label>
                <div class="input-wrapper">
                    <i class="fas fa-route input-icon"></i>
                    <select id="rute" name="rute" class="form-control" required>
                        <option value="">-- Pilih Rute --</option>
                        <option value="berastagi-medan">Berastagi → Medan (Jarak: 80 km | Estimasi: 3 jam)</option>
                        <option value="berastagi-jakarta">Berastagi → Jakarta (Jarak: 1,800 km | Estimasi: 2 hari)</option>
                        <option value="berastagi-surabaya">Berastagi → Surabaya (Jarak: 2,200 km | Estimasi: 3 hari)</option>
                        <option value="berastagi-makassar">Berastagi → Makassar (Jarak: 1,500 km | Estimasi: 2.5 hari)</option>
                        <option value="berastagi-palembang">Berastagi → Palembang (Jarak: 1,200 km | Estimasi: 2 hari)</option>
                        <option value="berastagi-bandung">Berastagi → Bandung (Jarak: 2,000 km | Estimasi: 3 hari)</option>
                    </select>
                </div>
                <div id="ruteDetail" style="display: none; margin-top: 10px; padding: 10px; background-color: var(--primary-lighter); border-radius: 8px; font-size: 13px;">
                    <div><strong>Jarak:</strong> <span id="detailJarak">-</span></div>
                    <div><strong>Estimasi Waktu:</strong> <span id="detailEstimasi">-</span></div>
                    <div><strong>Biaya Tol:</strong> <span id="detailBiayaTol">-</span></div>
                    <div><strong>Kondisi Jalan:</strong> <span id="detailKondisi" class="status-badge status-verified">Normal</span></div>
                </div>
            </div>
            
            <!-- Tujuan Akhir -->
            <div class="form-group">
                <label class="form-label">Tujuan Akhir *</label>
                <div class="input-wrapper">
                    <i class="fas fa-map-marker-alt input-icon"></i>
                    <input type="text" id="tujuan_akhir" name="tujuan_akhir" class="form-control" 
                           placeholder="Contoh: Gudang Pusat Medan, Toko Jeruk Sejahtera Jakarta" required>
                </div>
                <small class="form-text">Alamat lengkap tujuan pengiriman</small>
            </div>
            
            <!-- Status -->
            <div class="form-group">
                <label class="form-label">Status *</label>
                <div class="status-options" style="display: grid; grid-template-columns: repeat(4, 1fr); gap: 10px;">
                    <label class="status-option" style="text-align: center; cursor: pointer;">
                        <input type="radio" name="status" value="dipanen" class="status-radio" style="display: none;">
                        <div class="status-card" style="padding: 15px; border: 2px solid var(--border); border-radius: 10px; transition: var(--transition);">
                            <div style="font-size: 28px; color: #4CAF50; margin-bottom: 8px;">
                                <i class="fas fa-seedling"></i>
                            </div>
                            <div style="font-weight: 600; color: var(--text-dark);">Dipanen</div>
                            <div style="font-size: 11px; color: var(--text-light);">Baru dipanen</div>
                        </div>
                    </label>
                    
                    <label class="status-option" style="text-align: center; cursor: pointer;">
                        <input type="radio" name="status" value="dikemas" class="status-radio" style="display: none;">
                        <div class="status-card" style="padding: 15px; border: 2px solid var(--border); border-radius: 10px; transition: var(--transition);">
                            <div style="font-size: 28px; color: #2196F3; margin-bottom: 8px;">
                                <i class="fas fa-box"></i>
                            </div>
                            <div style="font-weight: 600; color: var(--text-dark);">Dikemas</div>
                            <div style="font-size: 11px; color: var(--text-light);">Sedang dikemas</div>
                        </div>
                    </label>
                    
                    <label class="status-option" style="text-align: center; cursor: pointer;">
                        <input type="radio" name="status" value="dikirim" class="status-radio" style="display: none;" checked>
                        <div class="status-card" style="padding: 15px; border: 2px solid var(--border); border-radius: 10px; transition: var(--transition);">
                            <div style="font-size: 28px; color: #FF9800; margin-bottom: 8px;">
                                <i class="fas fa-truck"></i>
                            </div>
                            <div style="font-weight: 600; color: var(--text-dark);">Dikirim</div>
                            <div style="font-size: 11px; color: var(--text-light);">Dalam perjalanan</div>
                        </div>
                    </label>
                    
                    <label class="status-option" style="text-align: center; cursor: pointer;">
                        <input type="radio" name="status" value="diterima" class="status-radio" style="display: none;">
                        <div class="status-card" style="padding: 15px; border: 2px solid var(--border); border-radius: 10px; transition: var(--transition);">
                            <div style="font-size: 28px; color: #795548; margin-bottom: 8px;">
                                <i class="fas fa-check-circle"></i>
                            </div>
                            <div style="font-weight: 600; color: var(--text-dark);">Diterima</div>
                            <div style="font-size: 11px; color: var(--text-light);">Sudah diterima</div>
                        </div>
                    </label>
                </div>
            </div>
            
            <!-- Informasi Kapasitas -->
            <div id="kapasitasInfo" style="display: none; background-color: var(--bg-light); border-radius: 10px; padding: 15px; margin-bottom: 20px;">
                <h4 style="margin-bottom: 10px; color: var(--text-dark); font-size: 15px;">
                    <i class="fas fa-balance-scale"></i> Informasi Kapasitas
                </h4>
                <div style="display: grid; grid-template-columns: repeat(2, 1fr); gap: 10px; font-size: 13px;">
                    <div>
                        <div style="color: var(--text-light);">Kapasitas Kendaraan</div>
                        <div id="infoKapasitas" style="font-weight: 600; color: var(--text-dark);">- kg</div>
                    </div>
                    <div>
                        <div style="color: var(--text-light);">Total Berat Barang</div>
                        <div id="infoBerat" style="font-weight: 600; color: var(--text-dark);">- kg</div>
                    </div>
                    <div style="grid-column: span 2;">
                        <div id="kapasitasWarning" style="margin-top: 10px; padding: 8px; border-radius: 6px; display: none;"></div>
                    </div>
                </div>
            </div>
            
            <!-- Catatan Tambahan -->
            <div class="form-group">
                <label class="form-label">Catatan Tambahan</label>
                <textarea id="catatan" name="catatan" class="form-control" rows="3" 
                          placeholder="Masukkan catatan khusus untuk pengiriman (opsional)..."></textarea>
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
                    <i class="fas fa-paper-plane"></i> Kirim Data
                </button>
            </div>
        </form>
    </div>
    
    <!-- Panel Info & Tracking -->
    <div class="content-card">
        <div class="card-title">
            <span>Informasi & Tracking</span>
            <div class="card-icon">
                <i class="fas fa-shipping-fast"></i>
            </div>
        </div>
        
        <div class="guide-list">
            <div class="guide-item">
                <div class="guide-icon">
                    <i class="fas fa-user-check"></i>
                </div>
                <div class="guide-content">
                    <strong>Pilih Supir</strong>
                    <p>Pastikan supir memiliki SIM sesuai dengan jenis kendaraan</p>
                </div>
            </div>
            
            <div class="guide-item">
                <div class="guide-icon">
                    <i class="fas fa-truck"></i>
                </div>
                <div class="guide-content">
                    <strong>Kapasitas Kendaraan</strong>
                    <p>Sistem akan mengecek kapasitas kendaraan vs berat barang</p>
                </div>
            </div>
            
            <div class="guide-item">
                <div class="guide-icon">
                    <i class="fas fa-route"></i>
                </div>
                <div class="guide-content">
                    <strong>Perencanaan Rute</strong>
                    <p>Pilih rute yang optimal berdasarkan jarak dan kondisi jalan</p>
                </div>
            </div>
            
            <div class="guide-item">
                <div class="guide-icon">
                    <i class="fas fa-clipboard-check"></i>
                </div>
                <div class="guide-content">
                    <strong>Tracking Status</strong>
                    <p>Update status secara real-time untuk monitoring pengiriman</p>
                </div>
            </div>
        </div>
        
        <!-- Data Barang Tersedia di Gudang -->
        <div style="margin-top: 30px;">
            <h4 style="margin-bottom: 15px; color: var(--text-dark);">
                <i class="fas fa-warehouse"></i> Barang Tersedia di Gudang
            </h4>
            <div class="gudang-list">
                <div class="gudang-item">
                    <div class="gudang-header">
                        <div class="gudang-batch">KRD-045</div>
                        <div class="gudang-status status-verified">Tersedia</div>
                    </div>
                    <div class="gudang-details">
                        <div>Panen: PNH-2024-03-001</div>
                        <div><strong>500 kg</strong></div>
                    </div>
                    <div style="font-size: 12px; color: var(--text-light); margin-top: 5px;">
                        <i class="fas fa-box"></i> Kardus × 50 unit | <i class="fas fa-map-marker-alt"></i> Rak A-12
                    </div>
                </div>
                
                <div class="gudang-item">
                    <div class="gudang-header">
                        <div class="gudang-batch">KRN-018</div>
                        <div class="gudang-status status-verified">Tersedia</div>
                    </div>
                    <div class="gudang-details">
                        <div>Panen: PNH-2024-03-002</div>
                        <div><strong>525 kg</strong></div>
                    </div>
                    <div style="font-size: 12px; color: var(--text-light); margin-top: 5px;">
                        <i class="fas fa-shopping-basket"></i> Keranjang × 35 unit | <i class="fas fa-map-marker-alt"></i> Rak B-08
                    </div>
                </div>
                
                <div class="gudang-item">
                    <div class="gudang-header">
                        <div class="gudang-batch">PTI-012</div>
                        <div class="gudang-status status-pending">Proses</div>
                    </div>
                    <div class="gudang-details">
                        <div>Panen: PNH-2024-03-003</div>
                        <div><strong>500 kg</strong></div>
                    </div>
                    <div style="font-size: 12px; color: var(--text-light); margin-top: 5px;">
                        <i class="fas fa-archive"></i> Peti × 25 unit | <i class="fas fa-map-marker-alt"></i> Rak C-15
                    </div>
                </div>
                
                <div class="gudang-item">
                    <div class="gudang-header">
                        <div class="gudang-batch">KRD-102</div>
                        <div class="gudang-status status-verified">Tersedia</div>
                    </div>
                    <div class="gudang-details">
                        <div>Panen: PNH-2024-03-004</div>
                        <div><strong>280 kg</strong></div>
                    </div>
                    <div style="font-size: 12px; color: var(--text-light); margin-top: 5px;">
                        <i class="fas fa-box"></i> Kardus × 28 unit | <i class="fas fa-map-marker-alt"></i> Rak A-05
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Status Pengiriman Aktif -->
        <div style="margin-top: 30px;">
            <h4 style="margin-bottom: 15px; color: var(--text-dark);">
                <i class="fas fa-history"></i> Pengiriman Aktif
            </h4>
            <div class="tracking-list">
                <div class="tracking-item">
                    <div class="tracking-header">
                        <div class="tracking-code">TRK-2024-03-001</div>
                        <div class="tracking-date">28 Mar 2024</div>
                    </div>
                    <div class="tracking-details">
                        <div>Medan • 500 kg</div>
                        <div><strong>Budi Santoso</strong></div>
                    </div>
                    <div class="tracking-progress">
                        <div class="progress-bar">
                            <div class="progress-fill" style="width: 75%;"></div>
                        </div>
                        <div class="tracking-status status-pending">Dalam Perjalanan</div>
                    </div>
                </div>
                
                <div class="tracking-item">
                    <div class="tracking-header">
                        <div class="tracking-code">TRK-2024-03-002</div>
                        <div class="tracking-date">27 Mar 2024</div>
                    </div>
                    <div class="tracking-details">
                        <div>Jakarta • 525 kg</div>
                        <div><strong>Joko Widodo</strong></div>
                    </div>
                    <div class="tracking-progress">
                        <div class="progress-bar">
                            <div class="progress-fill" style="width: 50%;"></div>
                        </div>
                        <div class="tracking-status status-pending">Dalam Perjalanan</div>
                    </div>
                </div>
                
                <div class="tracking-item">
                    <div class="tracking-header">
                        <div class="tracking-code">TRK-2024-03-003</div>
                        <div class="tracking-date">26 Mar 2024</div>
                    </div>
                    <div class="tracking-details">
                        <div>Surabaya • 500 kg</div>
                        <div><strong>Rudi Hartono</strong></div>
                    </div>
                    <div class="tracking-progress">
                        <div class="progress-bar">
                            <div class="progress-fill" style="width: 100%;"></div>
                        </div>
                        <div class="tracking-status status-verified">Selesai</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Pilih Barang -->
<div class="modal-overlay" id="barangModal" style="display: none;">
    <div class="modal-content" style="max-width: 700px;">
        <div class="modal-header">
            <h3 class="modal-title">Pilih Barang dari Gudang</h3>
            <button type="button" class="close-barang-modal" style="background: none; border: none; color: var(--text-light); cursor: pointer; font-size: 18px;">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <div class="modal-body">
            <div id="barangList" style="max-height: 400px; overflow-y: auto;">
                <!-- Daftar barang akan diisi oleh JavaScript -->
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn" id="cancelBarangBtn">Batal</button>
            <button type="button" class="btn btn-primary" id="confirmBarangBtn">Tambahkan Barang Terpilih</button>
        </div>
    </div>
</div>

<!-- Modal Preview -->
<div class="modal-overlay" id="previewModal" style="display: none;">
    <div class="modal-content" style="max-width: 700px;">
        <div class="modal-header">
            <h3 class="modal-title">Preview Data Pengiriman</h3>
        </div>
        <div class="modal-body">
            <div id="previewContent">
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
    
    /* Status Options */
    .status-option input:checked + .status-card {
        border-color: var(--primary);
        background-color: var(--primary-lighter);
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    }
    
    .status-card {
        transition: var(--transition);
    }
    
    .status-card:hover {
        border-color: var(--primary-light);
        background-color: var(--primary-lighter);
    }
    
    /* Barang Item */
    .barang-item {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 12px;
        background-color: var(--bg-light);
        border-radius: 8px;
        margin-bottom: 10px;
        border-left: 4px solid var(--primary);
    }
    
    .barang-checkbox {
        flex-shrink: 0;
    }
    
    .barang-content {
        flex: 1;
    }
    
    .barang-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 5px;
    }
    
    .barang-batch {
        font-weight: 600;
        color: var(--text-dark);
        font-size: 14px;
    }
    
    .barang-berat {
        font-weight: 600;
        color: var(--primary);
        font-size: 14px;
    }
    
    .barang-details {
        font-size: 13px;
        color: var(--text-light);
    }
    
    .remove-barang {
        color: var(--danger);
        cursor: pointer;
        font-size: 14px;
        padding: 5px;
        border-radius: 5px;
        transition: var(--transition);
    }
    
    .remove-barang:hover {
        background-color: #FFEBEE;
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
    
    /* Gudang List */
    .gudang-list {
        display: flex;
        flex-direction: column;
        gap: 10px;
    }
    
    .gudang-item {
        padding: 12px;
        background-color: var(--bg-light);
        border-radius: 8px;
        border-left: 4px solid var(--primary);
    }
    
    .gudang-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 5px;
    }
    
    .gudang-batch {
        font-weight: 600;
        color: var(--text-dark);
        font-size: 14px;
    }
    
    .gudang-status {
        font-size: 11px;
        padding: 3px 8px;
        border-radius: 12px;
    }
    
    .gudang-details {
        display: flex;
        justify-content: space-between;
        font-size: 13px;
        color: var(--text-light);
    }
    
    /* Tracking List */
    .tracking-list {
        display: flex;
        flex-direction: column;
        gap: 15px;
    }
    
    .tracking-item {
        padding: 15px;
        background-color: var(--bg-light);
        border-radius: 8px;
        border-left: 4px solid var(--primary);
    }
    
    .tracking-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 10px;
    }
    
    .tracking-code {
        font-weight: 600;
        color: var(--text-dark);
        font-size: 14px;
    }
    
    .tracking-date {
        font-size: 12px;
        color: var(--text-light);
    }
    
    .tracking-details {
        display: flex;
        justify-content: space-between;
        font-size: 13px;
        color: var(--text-light);
        margin-bottom: 15px;
    }
    
    .tracking-progress {
        display: flex;
        align-items: center;
        gap: 15px;
    }
    
    .progress-bar {
        flex: 1;
        height: 8px;
        background-color: var(--border);
        border-radius: 4px;
        overflow: hidden;
    }
    
    .progress-fill {
        height: 100%;
        background-color: var(--primary);
        border-radius: 4px;
        transition: width 0.3s ease;
    }
    
    .tracking-status {
        font-size: 12px;
        white-space: nowrap;
    }
    
    /* Barang Modal */
    .modal-barang-item {
        padding: 12px;
        background-color: var(--bg-light);
        border-radius: 8px;
        margin-bottom: 10px;
        display: flex;
        align-items: center;
        gap: 12px;
        cursor: pointer;
        transition: var(--transition);
    }
    
    .modal-barang-item:hover {
        background-color: var(--primary-lighter);
    }
    
    .modal-barang-item.selected {
        background-color: var(--primary-lighter);
        border: 2px solid var(--primary);
    }
    
    .modal-barang-check {
        width: 20px;
        height: 20px;
        border: 2px solid var(--border);
        border-radius: 4px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 12px;
        flex-shrink: 0;
    }
    
    .modal-barang-item.selected .modal-barang-check {
        background-color: var(--primary);
        border-color: var(--primary);
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
    
    .status-badge {
        display: inline-block;
        padding: 4px 10px;
        border-radius: 6px;
        font-size: 12px;
        font-weight: 600;
    }
    
    .badge-dipanen {
        background-color: #E8F5E9;
        color: #2E7D32;
    }
    
    .badge-dikemas {
        background-color: #E3F2FD;
        color: #1565C0;
    }
    
    .badge-dikirim {
        background-color: #FFF3E0;
        color: #EF6C00;
    }
    
    .badge-diterima {
        background-color: #F3E5F5;
        color: #7B1FA2;
    }
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Data dummy barang di gudang
    const gudangData = [
        {
            id: 'KRD-045',
            batch: 'KRD-045',
            panen: 'PNH-2024-03-001',
            berat: 500,
            jenis: 'kardus',
            jumlah_unit: 50,
            lokasi: 'Rak A-12',
            status: 'tersedia'
        },
        {
            id: 'KRN-018',
            batch: 'KRN-018',
            panen: 'PNH-2024-03-002',
            berat: 525,
            jenis: 'keranjang',
            jumlah_unit: 35,
            lokasi: 'Rak B-08',
            status: 'tersedia'
        },
        {
            id: 'PTI-012',
            batch: 'PTI-012',
            panen: 'PNH-2024-03-003',
            berat: 500,
            jenis: 'peti',
            jumlah_unit: 25,
            lokasi: 'Rak C-15',
            status: 'proses'
        },
        {
            id: 'KRD-102',
            batch: 'KRD-102',
            panen: 'PNH-2024-03-004',
            berat: 280,
            jenis: 'kardus',
            jumlah_unit: 28,
            lokasi: 'Rak A-05',
            status: 'tersedia'
        },
        {
            id: 'KRN-025',
            batch: 'KRN-025',
            panen: 'PNH-2024-03-005',
            berat: 320,
            jenis: 'keranjang',
            jumlah_unit: 22,
            lokasi: 'Rak B-12',
            status: 'tersedia'
        },
        {
            id: 'PTI-033',
            batch: 'PTI-033',
            panen: 'PNH-2024-03-006',
            berat: 450,
            jenis: 'peti',
            jumlah_unit: 23,
            lokasi: 'Rak C-08',
            status: 'tersedia'
        }
    ];
    
    // Data dummy supir
    const supirData = {
        1: {
            nama: 'Budi Santoso',
            kontak: '081234567890',
            sim: 'B2 Umum',
            status: 'available',
            pengalaman: '5 tahun'
        },
        2: {
            nama: 'Joko Widodo',
            kontak: '081298765432',
            sim: 'B1 Umum',
            status: 'available',
            pengalaman: '3 tahun'
        },
        3: {
            nama: 'Rudi Hartono',
            kontak: '081312345678',
            sim: 'B2 Umum',
            status: 'available',
            pengalaman: '7 tahun'
        },
        4: {
            nama: 'Siti Aminah',
            kontak: '081398765432',
            sim: 'B1 Umum',
            status: 'busy',
            pengalaman: '4 tahun'
        },
        5: {
            nama: 'Ahmad Fauzi',
            kontak: '081412345678',
            sim: 'B2 Umum',
            status: 'available',
            pengalaman: '2 tahun'
        }
    };
    
    // Data dummy kendaraan
    const kendaraanData = {
        1: {
            jenis: 'Truk Box 10 Ton',
            plat: 'BK 1234 AB',
            kapasitas: 10000,
            status: 'available',
            tahun: 2020
        },
        2: {
            jenis: 'Truk Fuso 7.5 Ton',
            plat: 'BK 5678 CD',
            kapasitas: 7500,
            status: 'available',
            tahun: 2019
        },
        3: {
            jenis: 'Truk Engkel 4 Ton',
            plat: 'BK 9012 EF',
            kapasitas: 4000,
            status: 'maintenance',
            tahun: 2021
        },
        4: {
            jenis: 'Pickup 2 Ton',
            plat: 'BK 3456 GH',
            kapasitas: 2000,
            status: 'available',
            tahun: 2022
        },
        5: {
            jenis: 'Truk Box 12 Ton',
            plat: 'BK 7890 IJ',
            kapasitas: 12000,
            status: 'available',
            tahun: 2020
        }
    };
    
    // Data dummy rute
    const ruteData = {
        'berastagi-medan': {
            jarak: '80 km',
            estimasi: '3 jam',
            biaya_tol: 'Rp 50.000',
            kondisi: 'normal'
        },
        'berastagi-jakarta': {
            jarak: '1,800 km',
            estimasi: '2 hari',
            biaya_tol: 'Rp 1,200.000',
            kondisi: 'padat'
        },
        'berastagi-surabaya': {
            jarak: '2,200 km',
            estimasi: '3 hari',
            biaya_tol: 'Rp 1,500.000',
            kondisi: 'normal'
        },
        'berastagi-makassar': {
            jarak: '1,500 km',
            estimasi: '2.5 hari',
            biaya_tol: 'Rp 900.000',
            kondisi: 'sedang'
        },
        'berastagi-palembang': {
            jarak: '1,200 km',
            estimasi: '2 hari',
            biaya_tol: 'Rp 800.000',
            kondisi: 'normal'
        },
        'berastagi-bandung': {
            jarak: '2,000 km',
            estimasi: '3 hari',
            biaya_tol: 'Rp 1,300.000',
            kondisi: 'padat'
        }
    };
    
    // Elemen DOM
    const form = document.getElementById('pengirimanForm');
    const tanggalKirim = document.getElementById('tanggal_kirim');
    const supirSelect = document.getElementById('user_id');
    const supirDetail = document.getElementById('supirDetail');
    const kendaraanSelect = document.getElementById('kendaraan');
    const kendaraanDetail = document.getElementById('kendaraanDetail');
    const ruteSelect = document.getElementById('rute');
    const ruteDetail = document.getElementById('ruteDetail');
    const tujuanInput = document.getElementById('tujuan_akhir');
    const statusOptions = document.querySelectorAll('.status-option');
    const tambahBarangBtn = document.getElementById('tambahBarangBtn');
    const daftarBarangContainer = document.getElementById('daftarBarangContainer');
    const emptyBarang = document.getElementById('emptyBarang');
    const totalBarangInfo = document.getElementById('totalBarangInfo');
    const kapasitasInfo = document.getElementById('kapasitasInfo');
    const resetBtn = document.getElementById('resetBtn');
    const previewBtn = document.getElementById('previewBtn');
    const submitBtn = document.getElementById('submitBtn');
    const successAlert = document.getElementById('successAlert');
    const successMessage = document.getElementById('successMessage');
    const errorAlert = document.getElementById('errorAlert');
    const errorMessage = document.getElementById('errorMessage');
    const barangModal = document.getElementById('barangModal');
    const previewModal = document.getElementById('previewModal');
    
    // Data sementara
    let selectedBarang = [];
    let selectedBarangModal = [];
    
    // Inisialisasi status option
    statusOptions.forEach(option => {
        option.addEventListener('click', function() {
            // Hapus selected dari semua option
            statusOptions.forEach(opt => {
                opt.querySelector('.status-card').style.borderColor = 'var(--border)';
                opt.querySelector('.status-card').style.backgroundColor = 'white';
                opt.querySelector('.status-card').style.transform = 'translateY(0)';
                opt.querySelector('.status-card').style.boxShadow = 'none';
            });
            
            // Tandai yang dipilih
            const card = this.querySelector('.status-card');
            card.style.borderColor = 'var(--primary)';
            card.style.backgroundColor = 'var(--primary-lighter)';
            card.style.transform = 'translateY(-2px)';
            card.style.boxShadow = '0 4px 12px rgba(0, 0, 0, 0.1)';
            
            // Check radio button yang sesuai
            this.querySelector('.status-radio').checked = true;
        });
    });
    
    // Set default status (dikirim)
    statusOptions[2].click();
    
    // Load detail supir
    supirSelect.addEventListener('change', function() {
        const supirId = this.value;
        
        if (!supirId) {
            supirDetail.style.display = 'none';
            return;
        }
        
        const supir = supirData[supirId];
        if (supir) {
            document.getElementById('detailNama').textContent = supir.nama;
            document.getElementById('detailKontak').textContent = supir.kontak;
            document.getElementById('detailSim').textContent = supir.sim;
            
            const statusBadge = document.getElementById('detailStatus');
            statusBadge.textContent = supir.status === 'available' ? 'Available' : 'Busy';
            statusBadge.className = supir.status === 'available' ? 'status-badge status-verified' : 'status-badge status-pending';
            
            supirDetail.style.display = 'block';
            updateKapasitasInfo();
        }
    });
    
    // Load detail kendaraan
    kendaraanSelect.addEventListener('change', function() {
        const kendaraanId = this.value;
        
        if (!kendaraanId) {
            kendaraanDetail.style.display = 'none';
            return;
        }
        
        const kendaraan = kendaraanData[kendaraanId];
        if (kendaraan) {
            document.getElementById('detailJenis').textContent = kendaraan.jenis;
            document.getElementById('detailPlat').textContent = kendaraan.plat;
            document.getElementById('detailKapasitas').textContent = `${kendaraan.kapasitas} kg`;
            
            const statusBadge = document.getElementById('detailKendaraanStatus');
            statusBadge.textContent = kendaraan.status === 'available' ? 'Available' : 'Maintenance';
            statusBadge.className = kendaraan.status === 'available' ? 'status-badge status-verified' : 'status-badge status-rejected';
            
            kendaraanDetail.style.display = 'block';
            updateKapasitasInfo();
        }
    });
    
    // Load detail rute
    ruteSelect.addEventListener('change', function() {
        const ruteKey = this.value;
        
        if (!ruteKey) {
            ruteDetail.style.display = 'none';
            return;
        }
        
        const rute = ruteData[ruteKey];
        if (rute) {
            document.getElementById('detailJarak').textContent = rute.jarak;
            document.getElementById('detailEstimasi').textContent = rute.estimasi;
            document.getElementById('detailBiayaTol').textContent = rute.biaya_tol;
            
            const kondisiBadge = document.getElementById('detailKondisi');
            kondisiBadge.textContent = rute.kondisi === 'normal' ? 'Normal' : 
                                      rute.kondisi === 'padat' ? 'Padat' : 'Sedang';
            kondisiBadge.className = rute.kondisi === 'normal' ? 'status-badge status-verified' : 
                                   rute.kondisi === 'padat' ? 'status-badge status-rejected' : 'status-badge status-pending';
            
            ruteDetail.style.display = 'block';
        }
    });
    
    // Tambah barang button
    tambahBarangBtn.addEventListener('click', function() {
        openBarangModal();
    });
    
    // Buka modal pilih barang
    function openBarangModal() {
        const barangList = document.getElementById('barangList');
        barangList.innerHTML = '';
        
        gudangData.forEach(barang => {
            if (barang.status === 'tersedia' && !selectedBarang.find(b => b.id === barang.id)) {
                const isSelected = selectedBarangModal.includes(barang.id);
                const barangElement = document.createElement('div');
                barangElement.className = `modal-barang-item ${isSelected ? 'selected' : ''}`;
                barangElement.setAttribute('data-id', barang.id);
                barangElement.innerHTML = `
                    <div class="modal-barang-check">
                        ${isSelected ? '✓' : ''}
                    </div>
                    <div style="flex: 1;">
                        <div style="display: flex; justify-content: space-between; margin-bottom: 5px;">
                            <div style="font-weight: 600; color: var(--text-dark);">${barang.batch}</div>
                            <div style="font-weight: 600; color: var(--primary);">${barang.berat} kg</div>
                        </div>
                        <div style="font-size: 13px; color: var(--text-light);">
                            <div>Panen: ${barang.panen} | ${barang.jenis === 'kardus' ? 'Kardus' : barang.jenis === 'keranjang' ? 'Keranjang' : 'Peti'} × ${barang.jumlah_unit} unit</div>
                            <div><i class="fas fa-map-marker-alt"></i> ${barang.lokasi}</div>
                        </div>
                    </div>
                `;
                
                barangElement.addEventListener('click', function() {
                    const barangId = this.getAttribute('data-id');
                    if (selectedBarangModal.includes(barangId)) {
                        selectedBarangModal = selectedBarangModal.filter(id => id !== barangId);
                        this.classList.remove('selected');
                        this.querySelector('.modal-barang-check').innerHTML = '';
                    } else {
                        selectedBarangModal.push(barangId);
                        this.classList.add('selected');
                        this.querySelector('.modal-barang-check').innerHTML = '✓';
                    }
                });
                
                barangList.appendChild(barangElement);
            }
        });
        
        barangModal.style.display = 'flex';
        document.body.style.overflow = 'hidden';
    }
    
    // Tambahkan barang yang dipilih
    document.getElementById('confirmBarangBtn').addEventListener('click', function() {
        selectedBarangModal.forEach(barangId => {
            const barang = gudangData.find(b => b.id === barangId);
            if (barang && !selectedBarang.find(b => b.id === barangId)) {
                selectedBarang.push(barang);
            }
        });
        
        updateDaftarBarang();
        closeBarangModal();
        updateKapasitasInfo();
    });
    
    // Close modal barang
    document.getElementById('cancelBarangBtn').addEventListener('click', closeBarangModal);
    document.querySelector('.close-barang-modal').addEventListener('click', closeBarangModal);
    
    function closeBarangModal() {
        barangModal.style.display = 'none';
        document.body.style.overflow = 'auto';
        selectedBarangModal = [];
    }
    
    // Update daftar barang yang dipilih
    function updateDaftarBarang() {
        if (selectedBarang.length === 0) {
            emptyBarang.style.display = 'block';
            totalBarangInfo.style.display = 'none';
            daftarBarangContainer.innerHTML = '';
            daftarBarangContainer.appendChild(emptyBarang);
        } else {
            emptyBarang.style.display = 'none';
            daftarBarangContainer.innerHTML = '';
            
            let totalBerat = 0;
            
            selectedBarang.forEach((barang, index) => {
                totalBerat += barang.berat;
                
                const barangElement = document.createElement('div');
                barangElement.className = 'barang-item';
                barangElement.innerHTML = `
                    <div class="barang-checkbox">
                        <input type="checkbox" checked disabled style="width: 16px; height: 16px;">
                    </div>
                    <div class="barang-content">
                        <div class="barang-header">
                            <div class="barang-batch">${barang.batch}</div>
                            <div class="barang-berat">${barang.berat} kg</div>
                        </div>
                        <div class="barang-details">
                            <div>Panen: ${barang.panen} | ${barang.jenis === 'kardus' ? 'Kardus' : barang.jenis === 'keranjang' ? 'Keranjang' : 'Peti'} × ${barang.jumlah_unit} unit</div>
                            <div><i class="fas fa-map-marker-alt"></i> ${barang.lokasi}</div>
                        </div>
                    </div>
                    <div class="remove-barang" data-index="${index}">
                        <i class="fas fa-times"></i>
                    </div>
                `;
                
                daftarBarangContainer.appendChild(barangElement);
            });
            
            // Update total info
            document.getElementById('totalBarangCount').textContent = `${selectedBarang.length} item`;
            document.getElementById('totalBerat').textContent = `${totalBerat} kg`;
            totalBarangInfo.style.display = 'block';
            
            // Add event listeners untuk remove barang
            document.querySelectorAll('.remove-barang').forEach(btn => {
                btn.addEventListener('click', function() {
                    const index = parseInt(this.getAttribute('data-index'));
                    selectedBarang.splice(index, 1);
                    updateDaftarBarang();
                    updateKapasitasInfo();
                });
            });
        }
    }
    
    // Update informasi kapasitas
    function updateKapasitasInfo() {
        const kendaraanId = kendaraanSelect.value;
        if (!kendaraanId || selectedBarang.length === 0) {
            kapasitasInfo.style.display = 'none';
            return;
        }
        
        const kendaraan = kendaraanData[kendaraanId];
        if (!kendaraan) return;
        
        const totalBerat = selectedBarang.reduce((sum, barang) => sum + barang.berat, 0);
        const kapasitas = kendaraan.kapasitas;
        
        document.getElementById('infoKapasitas').textContent = `${kapasitas} kg`;
        document.getElementById('infoBerat').textContent = `${totalBerat} kg`;
        
        // Update warning
        const warningDiv = document.getElementById('kapasitasWarning');
        warningDiv.innerHTML = '';
        
        if (totalBerat > kapasitas) {
            warningDiv.style.display = 'block';
            warningDiv.style.backgroundColor = '#F8D7DA';
            warningDiv.style.color = '#721C24';
            warningDiv.style.padding = '10px';
            warningDiv.style.borderRadius = '6px';
            warningDiv.innerHTML = `
                <i class="fas fa-exclamation-triangle"></i>
                <strong>Peringatan:</strong> Total berat barang (${totalBerat} kg) melebihi kapasitas kendaraan (${kapasitas} kg). Kurangi barang atau pilih kendaraan dengan kapasitas lebih besar.
            `;
        } else if (totalBerat > kapasitas * 0.9) {
            warningDiv.style.display = 'block';
            warningDiv.style.backgroundColor = '#FFF3CD';
            warningDiv.style.color = '#856404';
            warningDiv.style.padding = '10px';
            warningDiv.style.borderRadius = '6px';
            warningDiv.innerHTML = `
                <i class="fas fa-info-circle"></i>
                <strong>Perhatian:</strong> Total berat barang (${totalBerat} kg) mendekati kapasitas maksimal (${kapasitas} kg). Pertimbangkan untuk mengurangi sedikit berat.
            `;
        } else {
            warningDiv.style.display = 'none';
        }
        
        kapasitasInfo.style.display = 'block';
    }
    
    // Reset form
    resetBtn.addEventListener('click', function() {
        if (confirm('Apakah Anda yakin ingin mereset form? Semua data yang telah diisi akan hilang.')) {
            form.reset();
            selectedBarang = [];
            selectedBarangModal = [];
            supirDetail.style.display = 'none';
            kendaraanDetail.style.display = 'none';
            ruteDetail.style.display = 'none';
            kapasitasInfo.style.display = 'none';
            successAlert.style.display = 'none';
            errorAlert.style.display = 'none';
            updateDaftarBarang();
            
            // Reset status option
            statusOptions.forEach(option => {
                const card = option.querySelector('.status-card');
                card.style.borderColor = 'var(--border)';
                card.style.backgroundColor = 'white';
                card.style.transform = 'translateY(0)';
                card.style.boxShadow = 'none';
            });
            statusOptions[2].click();
            
            // Reset datetime
            const now = new Date();
            tanggalKirim.value = now.toISOString().slice(0, 16);
        }
    });
    
    // Validasi form
    function validateForm() {
        const errors = [];
        
        // Validasi required fields
        const requiredFields = [
            { id: 'tanggal_kirim', name: 'Tanggal Kirim' },
            { id: 'user_id', name: 'Supir' },
            { id: 'kendaraan', name: 'Kendaraan' },
            { id: 'rute', name: 'Rute' },
            { id: 'tujuan_akhir', name: 'Tujuan Akhir' }
        ];
        
        requiredFields.forEach(field => {
            const element = document.getElementById(field.id);
            if (!element.value.trim()) {
                errors.push(`${field.name} harus diisi`);
            }
        });
        
        // Validasi barang
        if (selectedBarang.length === 0) {
            errors.push('Pilih minimal 1 barang dari gudang');
        }
        
        // Validasi kapasitas
        const kendaraanId = kendaraanSelect.value;
        if (kendaraanId) {
            const kendaraan = kendaraanData[kendaraanId];
            if (kendaraan && kendaraan.status !== 'available') {
                errors.push('Kendaraan yang dipilih tidak tersedia untuk pengiriman');
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
        successMessage.innerHTML = message;
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
        const tanggal = new Date(tanggalKirim.value);
        const supirId = supirSelect.value;
        const supir = supirData[supirId];
        const kendaraanId = kendaraanSelect.value;
        const kendaraan = kendaraanData[kendaraanId];
        const ruteKey = ruteSelect.value;
        const rute = ruteData[ruteKey];
        const tujuan = tujuanInput.value;
        const status = document.querySelector('input[name="status"]:checked').value;
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
        
        // Hitung total barang
        const totalBarang = selectedBarang.length;
        const totalBerat = selectedBarang.reduce((sum, barang) => sum + barang.berat, 0);
        
        // Tentukan badge class
        let badgeClass = '';
        let statusText = '';
        switch(status) {
            case 'dipanen':
                badgeClass = 'badge-dipanen';
                statusText = 'Dipanen';
                break;
            case 'dikemas':
                badgeClass = 'badge-dikemas';
                statusText = 'Dikemas';
                break;
            case 'dikirim':
                badgeClass = 'badge-dikirim';
                statusText = 'Dikirim';
                break;
            case 'diterima':
                badgeClass = 'badge-diterima';
                statusText = 'Diterima';
                break;
        }
        
        // Isi preview content
        const previewContent = document.getElementById('previewContent');
        previewContent.innerHTML = `
            <div class="preview-item">
                <div class="preview-label">Tanggal Kirim</div>
                <div class="preview-value">${formattedDate}</div>
            </div>
            <div class="preview-item">
                <div class="preview-label">Supir</div>
                <div class="preview-value">
                    <div><strong>${supir.nama}</strong></div>
                    <div style="font-size: 13px;">${supir.kontak} | SIM: ${supir.sim}</div>
                </div>
            </div>
            <div class="preview-item">
                <div class="preview-label">Kendaraan</div>
                <div class="preview-value">
                    <div><strong>${kendaraan.jenis}</strong></div>
                    <div style="font-size: 13px;">${kendaraan.plat} | Kapasitas: ${kendaraan.kapasitas} kg</div>
                </div>
            </div>
            <div class="preview-item">
                <div class="preview-label">Rute</div>
                <div class="preview-value">
                    <div><strong>${ruteSelect.options[ruteSelect.selectedIndex].text.split(' (')[0]}</strong></div>
                    <div style="font-size: 13px;">Jarak: ${rute.jarak} | Estimasi: ${rute.estimasi}</div>
                </div>
            </div>
            <div class="preview-item">
                <div class="preview-label">Tujuan Akhir</div>
                <div class="preview-value">${tujuan}</div>
            </div>
            <div class="preview-item">
                <div class="preview-label">Status</div>
                <div class="preview-value">
                    <span class="status-badge ${badgeClass}">${statusText}</span>
                </div>
            </div>
            <div class="preview-item">
                <div class="preview-label">Barang Dikirim</div>
                <div class="preview-value">
                    <div><strong>${totalBarang} item • ${totalBerat} kg</strong></div>
                    <div style="font-size: 13px; margin-top: 5px;">
                        ${selectedBarang.map(barang => `${barang.batch} (${barang.berat} kg)`).join(', ')}
                    </div>
                </div>
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
                    <div style="font-weight: 600; color: var(--text-dark);">Ringkasan Pengiriman</div>
                </div>
                <div style="display: grid; grid-template-columns: repeat(2, 1fr); gap: 10px; font-size: 13px;">
                    <div>
                        <div style="color: var(--text-light);">Total Berat</div>
                        <div style="font-weight: 600; color: var(--text-dark);">${totalBerat} kg</div>
                    </div>
                    <div>
                        <div style="color: var(--text-light);">Kapasitas</div>
                        <div style="font-weight: 600; color: var(--text-dark);">${kendaraan.kapasitas} kg</div>
                    </div>
                    <div>
                        <div style="color: var(--text-light);">Kapasitas Terpakai</div>
                        <div style="font-weight: 600; color: ${totalBerat > kendaraan.kapasitas ? 'var(--danger)' : (totalBerat > kendaraan.kapasitas * 0.9 ? 'var(--warning)' : 'var(--success)')}">
                            ${((totalBerat / kendaraan.kapasitas) * 100).toFixed(1)}%
                        </div>
                    </div>
                    <div>
                        <div style="color: var(--text-light);">Estimasi Biaya</div>
                        <div style="font-weight: 600; color: var(--text-dark);">${rute.biaya_tol}</div>
                    </div>
                </div>
            </div>
        `;
        
        // Tampilkan modal
        previewModal.style.display = 'flex';
        document.body.style.overflow = 'hidden';
    });
    
    // Close preview modal
    document.getElementById('closePreviewBtn').addEventListener('click', function() {
        previewModal.style.display = 'none';
        document.body.style.overflow = 'auto';
    });
    
    // Confirm submit from preview
    document.getElementById('confirmSubmitBtn').addEventListener('click', function() {
        // Generate ID simulasi
        const simulatedId = 'TRK-' + Date.now() + '-' + Math.floor(Math.random() * 1000);
        
        // Ambil data untuk success message
        const supirId = supirSelect.value;
        const supir = supirData[supirId];
        const totalBerat = selectedBarang.reduce((sum, barang) => sum + barang.berat, 0);
        
        // Reset form
        form.reset();
        selectedBarang = [];
        selectedBarangModal = [];
        supirDetail.style.display = 'none';
        kendaraanDetail.style.display = 'none';
        ruteDetail.style.display = 'none';
        kapasitasInfo.style.display = 'none';
        updateDaftarBarang();
        
        // Reset status option
        statusOptions.forEach(option => {
            const card = option.querySelector('.status-card');
            card.style.borderColor = 'var(--border)';
            card.style.backgroundColor = 'white';
            card.style.transform = 'translateY(0)';
            card.style.boxShadow = 'none';
        });
        statusOptions[2].click();
        
        // Reset datetime
        const now = new Date();
        tanggalKirim.value = now.toISOString().slice(0, 16);
        
        // Close modal
        previewModal.style.display = 'none';
        document.body.style.overflow = 'auto';
        
        // Show success message
        showSuccess(`Data pengiriman berhasil disimpan!<br>ID: ${simulatedId}<br>Supir: ${supir.nama} | Total Berat: ${totalBerat} kg`);
        
        // Scroll ke atas
        window.scrollTo({ top: 0, behavior: 'smooth' });
    });
    
    // Submit form langsung
    submitBtn.addEventListener('click', function() {
        previewBtn.click();
    });
    
    // Initialize
    const now = new Date();
    tanggalKirim.value = now.toISOString().slice(0, 16);
});
</script>
@endsection