@extends('layouts.manajer')

@section('title', 'Laporan Cuaca Lapangan - PT. Mardua Holong')

@section('page-title', 'Laporan Cuaca Lapangan')
@section('page-subtitle', 'Monitoring Kondisi Cuaca untuk Pertanian Jeruk')

@section('content')
<div class="content-wrapper">
    <!-- Header -->
    <div class="content-header">
        <div class="header-left">
            <h1>Laporan Cuaca Lapangan</h1>
            <p>Pantau kondisi cuaca dan gangguan di ladang jeruk</p>
        </div>
        <div class="header-right">
            <button type="button" id="syncWeatherBtn" class="btn btn-secondary">
                <i class="fas fa-sync-alt"></i> Sync Data Cuaca
            </button>
            <button type="button" id="exportReportBtn" class="btn btn-primary">
                <i class="fas fa-file-export"></i> Export Laporan
            </button>
        </div>
    </div>
    
    <!-- Form Input Laporan -->
    <div class="content-card">
        <div class="card-header">
            <div class="card-title">
                <i class="fas fa-cloud-sun"></i>
                <span>Form Input Laporan Cuaca</span>
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
        
        <form id="weatherForm">
            <div class="form-grid">
                <!-- Kolom Kiri -->
                <div class="form-column">
                    <!-- Ladang -->
                    <div class="form-group">
                        <label class="form-label">
                            <i class="fas fa-tractor"></i>
                            Ladang *
                        </label>
                        <select id="ladang_id" name="ladang_id" class="form-control" required>
                            <option value="">-- Pilih Ladang --</option>
                            <option value="1">Ladang Simalungun (Berastagi) | 2.5 Ha | Tuan Pandiangan</option>
                            <option value="2">Ladang Berastagi (Pusat) | 3.0 Ha | Tuan Silalahi</option>
                            <option value="3">Ladang Sipirok | 1.8 Ha | Tuan Siregar</option>
                            <option value="4">Ladang Parapat | 2.2 Ha | Pak Sinuhaji</option>
                            <option value="5">Ladang Karo | 1.5 Ha | Ibu Munthe</option>
                        </select>
                        <small class="form-text">Pilih ladang yang akan dilaporkan</small>
                    </div>
                    
                    <!-- Info Ladang -->
                    <div id="ladangInfo" class="info-card" style="display: none;">
                        <div class="info-grid">
                            <div class="info-item">
                                <div class="info-label">Pemilik</div>
                                <div class="info-value" id="infoPemilik">-</div>
                            </div>
                            <div class="info-item">
                                <div class="info-label">Luas</div>
                                <div class="info-value" id="infoLuas">-</div>
                            </div>
                            <div class="info-item">
                                <div class="info-label">Lokasi</div>
                                <div class="info-value" id="infoLokasi">-</div>
                            </div>
                            <div class="info-item">
                                <div class="info-label">Ketinggian</div>
                                <div class="info-value" id="infoKetinggian">-</div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Tanggal -->
                    <div class="form-group">
                        <label class="form-label">
                            <i class="fas fa-calendar-alt"></i>
                            Tanggal *
                        </label>
                        <input type="date" id="tanggal" name="tanggal" class="form-control" 
                               value="{{ date('Y-m-d') }}" required>
                        <small class="form-text">Tanggal observasi cuaca</small>
                    </div>
                    
                    <!-- Waktu Observasi -->
                    <div class="form-group">
                        <label class="form-label">
                            <i class="fas fa-clock"></i>
                            Waktu Observasi
                        </label>
                        <input type="time" id="waktu" name="waktu" class="form-control" 
                               value="{{ date('H:i') }}">
                        <small class="form-text">Waktu pengamatan (opsional)</small>
                    </div>
                </div>
                
                <!-- Kolom Kanan -->
                <div class="form-column">
                    <!-- Sumber Data -->
                    <div class="form-group">
                        <label class="form-label">Sumber Data *</label>
                        <div class="data-source-options">
                            <div class="data-source-item">
                                <input type="radio" id="sumber_api" name="sumber_data" value="api" class="data-source-radio">
                                <label for="sumber_api" class="data-source-label">
                                    <div class="source-icon">
                                        <i class="fas fa-satellite-dish"></i>
                                    </div>
                                    <div class="source-content">
                                        <div class="source-title">API Cuaca</div>
                                        <div class="source-desc">Ambil data otomatis dari BMKG</div>
                                    </div>
                                    <div class="source-badge">Auto</div>
                                </label>
                            </div>
                            
                            <div class="data-source-item">
                                <input type="radio" id="sumber_manual" name="sumber_data" value="manual" class="data-source-radio" checked>
                                <label for="sumber_manual" class="data-source-label">
                                    <div class="source-icon">
                                        <i class="fas fa-user-edit"></i>
                                    </div>
                                    <div class="source-content">
                                        <div class="source-title">Manual Input</div>
                                        <div class="source-desc">Input data secara manual</div>
                                    </div>
                                    <div class="source-badge">Manual</div>
                                </label>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Cuaca Sekarang (API) -->
                    <div id="apiWeatherInfo" class="weather-card" style="display: none;">
                        <div class="weather-header">
                            <div class="weather-icon">
                                <i class="fas fa-cloud-sun-rain"></i>
                            </div>
                            <div class="weather-title">
                                <div class="title">Data Cuaca BMKG</div>
                                <div class="subtitle">Berastagi, {{ date('d M Y') }}</div>
                            </div>
                        </div>
                        <div class="weather-data" id="apiWeatherData">
                            <div class="weather-item">
                                <span class="label">Suhu:</span>
                                <span class="value" id="apiSuhu">- °C</span>
                            </div>
                            <div class="weather-item">
                                <span class="label">Kelembaban:</span>
                                <span class="value" id="apiKelembaban">- %</span>
                            </div>
                            <div class="weather-item">
                                <span class="label">Kecepatan Angin:</span>
                                <span class="value" id="apiAngin">- km/jam</span>
                            </div>
                            <div class="weather-item">
                                <span class="label">Kondisi:</span>
                                <span class="value" id="apiKondisi">-</span>
                            </div>
                        </div>
                        <div class="weather-footer">
                            <button type="button" id="loadWeatherBtn" class="btn btn-info">
                                <i class="fas fa-download"></i> Load Data Cuaca Terbaru
                            </button>
                        </div>
                    </div>
                    
                    <!-- Manual Input -->
                    <div id="manualInputSection">
                        <!-- Curah Hujan -->
                        <div class="form-group">
                            <label class="form-label">
                                <i class="fas fa-cloud-rain"></i>
                                Curah Hujan (mm) *
                            </label>
                            <div class="input-with-unit">
                                <input type="number" id="curah_hujan" name="curah_hujan" class="form-control" 
                                       placeholder="0" min="0" max="500" step="0.1" required>
                                <span class="unit">mm</span>
                            </div>
                            <small class="form-text">Jumlah hujan dalam 24 jam terakhir</small>
                            
                            <!-- Indikator Curah Hujan -->
                            <div id="rainIndicator" class="rain-indicator">
                                <div class="indicator-labels">
                                    <span>Rendah</span>
                                    <span>Tinggi</span>
                                </div>
                                <div class="indicator-bar">
                                    <div id="rainMarker" class="indicator-marker"></div>
                                </div>
                                <div class="indicator-range">
                                    <span style="color: #4CAF50;">&lt; 20mm</span>
                                    <span style="color: #FF9800;">20-100mm</span>
                                    <span style="color: #F44336;">&gt; 100mm</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Laporan Gangguan -->
            <div class="form-section">
                <div class="section-header">
                    <div class="section-title">
                        <i class="fas fa-exclamation-triangle"></i>
                        Laporan Gangguan
                    </div>
                    <button type="button" id="tambahGangguanBtn" class="btn btn-outline">
                        <i class="fas fa-plus"></i> Tambah Gangguan Baru
                    </button>
                </div>
                
                <!-- Daftar Gangguan -->
                <div id="gangguanList" class="gangguan-grid">
                    <!-- Gangguan akan ditambahkan via JavaScript -->
                </div>
                
                <!-- Catatan Gangguan -->
                <div class="form-group">
                    <label class="form-label">Catatan Detail Gangguan</label>
                    <textarea id="catatan_gangguan" name="catatan_gangguan" class="form-control" rows="3" 
                              placeholder="Deskripsikan gangguan secara detail, lokasi tepatnya, dan tindakan yang sudah dilakukan..."></textarea>
                </div>
            </div>
            
            <!-- Foto Dokumentasi -->
            <div class="form-section">
                <label class="form-label">
                    <i class="fas fa-camera"></i>
                    Foto Dokumentasi (Opsional)
                </label>
                <div class="photo-upload-area" id="photoUploadArea">
                    <div class="photo-upload-content">
                        <i class="fas fa-cloud-upload-alt"></i>
                        <p>Klik untuk upload foto kondisi ladang</p>
                        <small>Format: JPG, PNG (Maks. 5MB)</small>
                    </div>
                    <input type="file" id="foto_dokumentasi" name="foto_dokumentasi" accept="image/*" 
                           multiple style="display: none;">
                </div>
                <div id="photoPreviewContainer" class="photo-preview-container" style="display: none;">
                    <div class="photo-previews" id="photoPreviews">
                        <!-- Foto preview akan ditambahkan di sini -->
                    </div>
                </div>
            </div>
            
            <!-- Rekomendasi -->
            <div id="recommendationSection" class="recommendation-card" style="display: none;">
                <div class="recommendation-header">
                    <div class="recommendation-icon">
                        <i class="fas fa-lightbulb"></i>
                    </div>
                    <div class="recommendation-title">
                        <div class="title">Rekomendasi</div>
                        <div class="subtitle">Saran berdasarkan kondisi cuaca</div>
                    </div>
                </div>
                <div id="recommendationContent" class="recommendation-content">
                    <!-- Rekomendasi akan diisi -->
                </div>
            </div>
            
            <!-- Tombol Aksi -->
            <div class="form-actions">
                <button type="button" id="resetBtn" class="btn btn-secondary">
                    <i class="fas fa-redo"></i> Reset Form
                </button>
                <button type="button" id="simpanDraftBtn" class="btn btn-outline">
                    <i class="fas fa-save"></i> Simpan Draft
                </button>
                <button type="submit" id="submitBtn" class="btn btn-success">
                    <i class="fas fa-paper-plane"></i> Simpan Laporan
                </button>
            </div>
        </form>
    </div>
    
    <!-- Data Cuaca Terkini -->
    <div class="content-card">
        <div class="card-header">
            <div class="card-title">
                <i class="fas fa-chart-line"></i>
                <span>Data Cuaca Terkini</span>
            </div>
        </div>
        
        <div class="weather-stats">
            <div class="stat-item">
                <div class="stat-icon" style="color: #F44336;">
                    <i class="fas fa-thermometer-half"></i>
                </div>
                <div class="stat-number">26°C</div>
                <div class="stat-label">Suhu Rata-rata</div>
            </div>
            
            <div class="stat-item">
                <div class="stat-icon" style="color: #2196F3;">
                    <i class="fas fa-tint"></i>
                </div>
                <div class="stat-number">75%</div>
                <div class="stat-label">Kelembaban</div>
            </div>
            
            <div class="stat-item">
                <div class="stat-icon" style="color: #4CAF50;">
                    <i class="fas fa-cloud-rain"></i>
                </div>
                <div class="stat-number">45mm</div>
                <div class="stat-label">Curah Hujan (7 hari)</div>
            </div>
            
            <div class="stat-item">
                <div class="stat-icon" style="color: #FF9800;">
                    <i class="fas fa-wind"></i>
                </div>
                <div class="stat-number">12 km/j</div>
                <div class="stat-label">Angin Rata-rata</div>
            </div>
        </div>
        
        <!-- Grafik Curah Hujan -->
        <div class="chart-section">
            <div class="chart-header">
                <i class="fas fa-chart-bar"></i>
                <h4>Curah Hujan 7 Hari Terakhir</h4>
            </div>
            <div class="rain-chart">
                <div class="chart-bar" data-day="Sen" data-rain="15">
                    <div class="bar-value">15mm</div>
                    <div class="bar" style="height: 60px;"></div>
                    <div class="bar-label">Sen</div>
                </div>
                <div class="chart-bar" data-day="Sel" data-rain="8">
                    <div class="bar-value">8mm</div>
                    <div class="bar" style="height: 32px;"></div>
                    <div class="bar-label">Sel</div>
                </div>
                <div class="chart-bar" data-day="Rab" data-rain="25">
                    <div class="bar-value">25mm</div>
                    <div class="bar" style="height: 100px;"></div>
                    <div class="bar-label">Rab</div>
                </div>
                <div class="chart-bar" data-day="Kam" data-rain="45">
                    <div class="bar-value">45mm</div>
                    <div class="bar" style="height: 180px;"></div>
                    <div class="bar-label">Kam</div>
                </div>
                <div class="chart-bar" data-day="Jum" data-rain="12">
                    <div class="bar-value">12mm</div>
                    <div class="bar" style="height: 48px;"></div>
                    <div class="bar-label">Jum</div>
                </div>
                <div class="chart-bar" data-day="Sab" data-rain="5">
                    <div class="bar-value">5mm</div>
                    <div class="bar" style="height: 20px;"></div>
                    <div class="bar-label">Sab</div>
                </div>
                <div class="chart-bar" data-day="Min" data-rain="18">
                    <div class="bar-value">18mm</div>
                    <div class="bar" style="height: 72px;"></div>
                    <div class="bar-label">Min</div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Riwayat Laporan -->
    <div class="content-card">
        <div class="card-header">
            <div class="card-title">
                <i class="fas fa-history"></i>
                <span>Riwayat Laporan Cuaca</span>
            </div>
        </div>
        
        <div class="table-responsive">
            <table class="data-table">
                <thead>
                    <tr>
                        <th style="width: 50px;">No</th>
                        <th>Ladang</th>
                        <th>Tanggal</th>
                        <th>Curah Hujan</th>
                        <th>Gangguan</th>
                        <th>Sumber Data</th>
                        <th style="width: 120px;">Aksi</th>
                    </tr>
                </thead>
                <tbody id="reportTableBody">
                    <!-- Data akan diisi oleh JavaScript -->
                </tbody>
            </table>
        </div>
        
        <!-- Pagination -->
        <div class="table-footer">
            <div class="showing-count">
                Menampilkan <span id="showingCount">0</span> dari <span id="totalCount">0</span> laporan
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

<!-- Modal Tambah Gangguan -->
<div id="gangguanModal" class="modal">
    <div class="modal-content">
        <div class="modal-header">
            <h3 class="modal-title">Tambah Gangguan Baru</h3>
            <button type="button" class="close-gangguan-modal">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <div class="modal-body">
            <div class="form-group">
                <label class="form-label">Nama Gangguan *</label>
                <input type="text" id="nama_gangguan" class="form-control" placeholder="Contoh: Hama Ulat, Penyakit CVPD, dll">
            </div>
            
            <div class="form-group">
                <label class="form-label">Kategori</label>
                <select id="kategori_gangguan" class="form-control">
                    <option value="hama">Hama</option>
                    <option value="penyakit">Penyakit</option>
                    <option value="lingkungan">Lingkungan</option>
                    <option value="lainnya">Lainnya</option>
                </select>
            </div>
            
            <div class="form-group">
                <label class="form-label">Tingkat Keparahan</label>
                <div class="severity-options">
                    <label class="severity-option">
                        <input type="radio" name="tingkat" value="ringan" checked>
                        <span class="severity-badge ringan">Ringan</span>
                    </label>
                    <label class="severity-option">
                        <input type="radio" name="tingkat" value="sedang">
                        <span class="severity-badge sedang">Sedang</span>
                    </label>
                    <label class="severity-option">
                        <input type="radio" name="tingkat" value="berat">
                        <span class="severity-badge berat">Berat</span>
                    </label>
                </div>
            </div>
            
            <div class="form-group">
                <label class="form-label">Deskripsi</label>
                <textarea id="deskripsi_gangguan" class="form-control" rows="3" placeholder="Deskripsi gangguan..."></textarea>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" id="cancelGangguanBtn">Batal</button>
            <button type="button" class="btn btn-primary" id="saveGangguanBtn">Simpan Gangguan</button>
        </div>
    </div>
</div>

<!-- Modal Detail Laporan -->
<div id="reportDetailModal" class="modal">
    <div class="modal-content modal-lg">
        <!-- Content will be generated by JavaScript -->
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
        margin-bottom: 25px;
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
        grid-template-columns: 1fr 1fr;
        gap: 25px;
        margin-bottom: 25px;
    }
    
    @media (max-width: 992px) {
        .form-grid {
            grid-template-columns: 1fr;
        }
    }
    
    .form-section {
        margin-bottom: 25px;
        padding-bottom: 25px;
        border-bottom: 1px solid var(--border);
    }
    
    .section-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 15px;
        flex-wrap: wrap;
        gap: 10px;
    }
    
    .section-title {
        display: flex;
        align-items: center;
        gap: 10px;
        font-weight: 600;
        color: var(--text-dark);
        font-size: 15px;
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
    
    .form-text {
        display: block;
        margin-top: 5px;
        font-size: 12px;
        color: var(--text-light);
    }
    
    /* Info Card */
    .info-card {
        background-color: var(--primary-lighter);
        border-radius: 10px;
        padding: 15px;
        margin-top: 15px;
    }
    
    .info-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 10px;
    }
    
    .info-item .info-label {
        font-size: 12px;
        color: var(--text-light);
        margin-bottom: 2px;
    }
    
    .info-item .info-value {
        font-weight: 600;
        color: var(--text-dark);
        font-size: 13px;
    }
    
    /* Data Source Options */
    .data-source-options {
        display: flex;
        flex-direction: column;
        gap: 10px;
    }
    
    .data-source-item {
        position: relative;
    }
    
    .data-source-item input[type="radio"] {
        display: none;
    }
    
    .data-source-label {
        display: flex;
        align-items: center;
        gap: 15px;
        padding: 15px;
        background-color: var(--light);
        border: 2px solid var(--border);
        border-radius: 10px;
        cursor: pointer;
        transition: var(--transition);
    }
    
    .data-source-label:hover {
        border-color: var(--primary);
        background-color: var(--primary-lighter);
    }
    
    .data-source-item input[type="radio"]:checked + .data-source-label {
        border-color: var(--primary);
        background-color: var(--primary-lighter);
    }
    
    .source-icon {
        width: 48px;
        height: 48px;
        background-color: var(--primary);
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 20px;
    }
    
    .data-source-item input[type="radio"]:checked + .data-source-label .source-icon {
        background-color: var(--primary-light);
    }
    
    .source-content {
        flex: 1;
    }
    
    .source-title {
        font-weight: 600;
        color: var(--text-dark);
        font-size: 15px;
    }
    
    .source-desc {
        font-size: 13px;
        color: var(--text-light);
    }
    
    .source-badge {
        padding: 4px 10px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 600;
        background-color: var(--light);
        color: var(--text-light);
    }
    
    .data-source-item input[type="radio"]:checked + .data-source-label .source-badge {
        background-color: var(--primary);
        color: white;
    }
    
    /* Weather Card */
    .weather-card {
        background-color: #E3F2FD;
        border-radius: 10px;
        padding: 15px;
        margin-bottom: 20px;
    }
    
    .weather-header {
        display: flex;
        align-items: center;
        gap: 12px;
        margin-bottom: 10px;
    }
    
    .weather-icon {
        font-size: 32px;
        color: #2196F3;
    }
    
    .weather-title .title {
        font-weight: 600;
        color: var(--text-dark);
        font-size: 16px;
    }
    
    .weather-title .subtitle {
        font-size: 13px;
        color: var(--text-light);
    }
    
    .weather-data {
        font-size: 13px;
    }
    
    .weather-item {
        display: flex;
        justify-content: space-between;
        margin-bottom: 5px;
    }
    
    .weather-item .label {
        color: var(--text-light);
    }
    
    .weather-item .value {
        font-weight: 600;
        color: var(--text-dark);
    }
    
    .weather-footer {
        margin-top: 10px;
        padding-top: 10px;
        border-top: 1px dashed #BBDEFB;
    }
    
    /* Input with Unit */
    .input-with-unit {
        display: flex;
        align-items: center;
        gap: 10px;
    }
    
    .input-with-unit .form-control {
        flex: 1;
    }
    
    .unit {
        font-size: 14px;
        color: var(--text-light);
        min-width: 40px;
    }
    
    /* Rain Indicator */
    .rain-indicator {
        margin-top: 10px;
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
        background: linear-gradient(to right, #4CAF50, #FFEB3B, #FF9800, #F44336);
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
    
    /* Gangguan Grid */
    .gangguan-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
        gap: 10px;
        margin-bottom: 20px;
    }
    
    .gangguan-item {
        position: relative;
    }
    
    .gangguan-item input[type="checkbox"] {
        display: none;
    }
    
    .gangguan-label {
        display: flex;
        align-items: center;
        gap: 10px;
        padding: 12px;
        background-color: white;
        border: 2px solid var(--border);
        border-radius: 8px;
        cursor: pointer;
        transition: var(--transition);
    }
    
    .gangguan-label:hover {
        border-color: var(--primary);
        background-color: var(--primary-lighter);
    }
    
    .gangguan-item input[type="checkbox"]:checked + .gangguan-label {
        border-color: var(--primary);
        background-color: var(--primary-lighter);
    }
    
    .gangguan-icon {
        width: 32px;
        height: 32px;
        border-radius: 6px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 14px;
        color: white;
    }
    
    .gangguan-content {
        flex: 1;
    }
    
    .gangguan-title {
        font-weight: 600;
        color: var(--text-dark);
        font-size: 14px;
        margin-bottom: 2px;
    }
    
    .gangguan-desc {
        font-size: 12px;
        color: var(--text-light);
    }
    
    .gangguan-badge {
        padding: 2px 6px;
        border-radius: 4px;
        font-size: 10px;
        font-weight: 600;
    }
    
    .badge-ringan {
        background-color: #E8F5E9;
        color: #2E7D32;
    }
    
    .badge-sedang {
        background-color: #FFF3E0;
        color: #EF6C00;
    }
    
    .badge-berat {
        background-color: #FFEBEE;
        color: #C62828;
    }
    
    /* Photo Upload */
    .photo-upload-area {
        border: 2px dashed var(--border);
        border-radius: 8px;
        padding: 40px 20px;
        text-align: center;
        cursor: pointer;
        transition: var(--transition);
    }
    
    .photo-upload-area:hover {
        border-color: var(--primary);
        background-color: var(--primary-lighter);
    }
    
    .photo-upload-content i {
        font-size: 40px;
        color: var(--primary);
        margin-bottom: 10px;
    }
    
    .photo-upload-content p {
        margin-bottom: 5px;
        color: var(--text-dark);
        font-weight: 500;
    }
    
    .photo-upload-content small {
        color: var(--text-light);
        font-size: 12px;
    }
    
    .photo-preview-container {
        margin-top: 15px;
    }
    
    .photo-previews {
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
    }
    
    .photo-preview {
        position: relative;
        width: 120px;
        height: 120px;
        border-radius: 8px;
        overflow: hidden;
        border: 2px solid var(--border);
    }
    
    .photo-preview img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
    
    .remove-photo {
        position: absolute;
        top: 5px;
        right: 5px;
        width: 24px;
        height: 24px;
        background-color: rgba(0,0,0,0.5);
        color: white;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 12px;
        cursor: pointer;
        transition: var(--transition);
    }
    
    .remove-photo:hover {
        background-color: var(--danger);
    }
    
    /* Recommendation Card */
    .recommendation-card {
        background-color: #FFF3E0;
        border-radius: 10px;
        padding: 20px;
        margin-bottom: 20px;
    }
    
    .recommendation-header {
        display: flex;
        align-items: center;
        gap: 12px;
        margin-bottom: 15px;
    }
    
    .recommendation-icon {
        font-size: 24px;
        color: #FF9800;
    }
    
    .recommendation-title .title {
        font-weight: 600;
        color: var(--text-dark);
        font-size: 16px;
    }
    
    .recommendation-title .subtitle {
        font-size: 13px;
        color: var(--text-light);
    }
    
    .recommendation-content {
        font-size: 14px;
        color: #5D4037;
    }
    
    .recommendation-item {
        display: flex;
        align-items: flex-start;
        gap: 10px;
        margin-bottom: 8px;
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
    
    .btn-info {
        background-color: var(--info);
        color: white;
    }
    
    .btn-info:hover {
        background-color: #138496;
    }
    
    .btn-outline {
        background-color: var(--light);
        color: var(--text-dark);
        border: 1px solid var(--border);
    }
    
    .btn-outline:hover {
        background-color: #E9ECEF;
    }
    
    /* Weather Stats */
    .weather-stats {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
        gap: 20px;
        margin-bottom: 30px;
    }
    
    .stat-item {
        text-align: center;
        padding: 15px;
        background-color: var(--light);
        border-radius: 10px;
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
    
    /* Chart Section */
    .chart-section {
        margin-top: 25px;
    }
    
    .chart-header {
        display: flex;
        align-items: center;
        gap: 10px;
        margin-bottom: 15px;
    }
    
    .chart-header h4 {
        margin: 0;
        color: var(--text-dark);
        font-size: 16px;
    }
    
    .chart-header i {
        color: var(--primary);
    }
    
    .rain-chart {
        height: 200px;
        display: flex;
        align-items: flex-end;
        gap: 15px;
        padding: 20px;
        background-color: var(--light);
        border-radius: 10px;
    }
    
    .chart-bar {
        flex: 1;
        display: flex;
        flex-direction: column;
        align-items: center;
        transition: var(--transition);
    }
    
    .chart-bar:hover {
        transform: translateY(-5px);
    }
    
    .chart-bar:hover .bar {
        opacity: 0.8;
    }
    
    .chart-bar .bar-value {
        font-size: 12px;
        color: var(--text-dark);
        margin-bottom: 5px;
        font-weight: 600;
    }
    
    .chart-bar .bar {
        width: 80%;
        background: linear-gradient(to top, #2196F3, #64B5F6);
        border-radius: 4px 4px 0 0;
    }
    
    .chart-bar .bar-label {
        font-size: 12px;
        color: var(--text-light);
        margin-top: 5px;
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
    
    .close-gangguan-modal {
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
    
    .close-gangguan-modal:hover {
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
    
    /* Severity Options */
    .severity-options {
        display: flex;
        gap: 10px;
        flex-wrap: wrap;
    }
    
    .severity-option {
        display: flex;
        align-items: center;
        gap: 5px;
        cursor: pointer;
    }
    
    .severity-option input[type="radio"] {
        display: none;
    }
    
    .severity-badge {
        padding: 6px 12px;
        border-radius: 4px;
        font-size: 12px;
        font-weight: 600;
        transition: var(--transition);
    }
    
    .severity-option input[type="radio"]:checked + .severity-badge {
        transform: scale(1.05);
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    }
    
    .ringan {
        background-color: #E8F5E9;
        color: #2E7D32;
    }
    
    .sedang {
        background-color: #FFF3E0;
        color: #EF6C00;
    }
    
    .berat {
        background-color: #FFEBEE;
        color: #C62828;
    }
    
    /* Responsive Styles */
    @media (max-width: 768px) {
        .weather-stats {
            grid-template-columns: repeat(2, 1fr);
        }
        
        .rain-chart {
            gap: 10px;
            padding: 15px;
        }
        
        .chart-bar .bar {
            width: 90%;
        }
        
        .modal-footer {
            flex-direction: column;
        }
    }
    
    @media (max-width: 576px) {
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
        
        .weather-stats {
            grid-template-columns: 1fr;
        }
        
        .gangguan-grid {
            grid-template-columns: 1fr;
        }
        
        .table-footer {
            flex-direction: column;
            align-items: stretch;
        }
        
        .pagination {
            justify-content: center;
        }
    }
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Data dummy ladang
    const ladangData = {
        1: {
            nama: 'Ladang Simalungun',
            pemilik: 'Tuan Pandiangan',
            luas: '2.5 Ha',
            lokasi: 'Berastagi',
            ketinggian: '1,400 mdpl',
            jenis_tanah: 'Andosol'
        },
        2: {
            nama: 'Ladang Berastagi',
            pemilik: 'Tuan Silalahi',
            luas: '3.0 Ha',
            lokasi: 'Berastagi Pusat',
            ketinggian: '1,300 mdpl',
            jenis_tanah: 'Andosol'
        },
        3: {
            nama: 'Ladang Sipirok',
            pemilik: 'Tuan Siregar',
            luas: '1.8 Ha',
            lokasi: 'Sipirok',
            ketinggian: '1,200 mdpl',
            jenis_tanah: 'Latosol'
        },
        4: {
            nama: 'Ladang Parapat',
            pemilik: 'Pak Sinuhaji',
            luas: '2.2 Ha',
            lokasi: 'Parapat',
            ketinggian: '900 mdpl',
            jenis_tanah: 'Regosol'
        },
        5: {
            nama: 'Ladang Karo',
            pemilik: 'Ibu Munthe',
            luas: '1.5 Ha',
            lokasi: 'Karo',
            ketinggian: '1,100 mdpl',
            jenis_tanah: 'Andosol'
        }
    };
    
    // Data dummy gangguan umum
    const gangguanUmum = [
        {
            id: 1,
            nama: 'Hama Ulat',
            kategori: 'hama',
            tingkat: 'sedang',
            deskripsi: 'Ulat menyerang daun muda',
            icon: 'fas fa-bug',
            color: '#F44336'
        },
        {
            id: 2,
            nama: 'CVPD',
            kategori: 'penyakit',
            tingkat: 'berat',
            deskripsi: 'Penyakit Citrus Vein Phloem Degeneration',
            icon: 'fas fa-leaf',
            color: '#4CAF50'
        },
        {
            id: 3,
            nama: 'Busuk Akar',
            kategori: 'penyakit',
            tingkat: 'sedang',
            deskripsi: 'Pembusukan akar karena kelembaban tinggi',
            icon: 'fas fa-tree',
            color: '#795548'
        },
        {
            id: 4,
            nama: 'Kekeringan',
            kategori: 'lingkungan',
            tingkat: 'ringan',
            deskripsi: 'Kekurangan air akibat musim kemarau',
            icon: 'fas fa-sun',
            color: '#FF9800'
        },
        {
            id: 5,
            nama: 'Hujan Lebat',
            kategori: 'lingkungan',
            tingkat: 'sedang',
            deskripsi: 'Curah hujan berlebihan',
            icon: 'fas fa-cloud-showers-heavy',
            color: '#2196F3'
        },
        {
            id: 6,
            nama: 'Burung Pemakan',
            kategori: 'hama',
            tingkat: 'ringan',
            deskripsi: 'Burung memakan buah jeruk',
            icon: 'fas fa-dove',
            color: '#9C27B0'
        }
    ];
    
    // Data dummy laporan cuaca
    let weatherReports = [
        {
            id: 1,
            ladang_id: 1,
            ladang_nama: 'Ladang Simalungun',
            tanggal: '2024-03-28',
            waktu: '10:30',
            curah_hujan: 45,
            gangguan: ['Hama Ulat', 'Hujan Lebat'],
            sumber_data: 'manual',
            catatan: 'Kondisi ladang basah, ditemukan hama ulat di beberapa tanaman',
            foto: [],
            created_at: '2024-03-28 11:00:00'
        },
        {
            id: 2,
            ladang_id: 2,
            ladang_nama: 'Ladang Berastagi',
            tanggal: '2024-03-27',
            waktu: '14:15',
            curah_hujan: 25,
            gangguan: ['CVPD'],
            sumber_data: 'api',
            catatan: 'Data cuaca dari BMKG, kondisi normal',
            foto: [],
            created_at: '2024-03-27 15:30:00'
        },
        {
            id: 3,
            ladang_id: 3,
            ladang_nama: 'Ladang Sipirok',
            tanggal: '2024-03-26',
            waktu: '09:45',
            curah_hujan: 12,
            gangguan: ['Kekeringan'],
            sumber_data: 'manual',
            catatan: 'Musim kemarau, perlu penyiraman tambahan',
            foto: [],
            created_at: '2024-03-26 10:20:00'
        },
        {
            id: 4,
            ladang_id: 4,
            ladang_nama: 'Ladang Parapat',
            tanggal: '2024-03-25',
            waktu: '16:20',
            curah_hujan: 60,
            gangguan: ['Hujan Lebat', 'Busuk Akar'],
            sumber_data: 'manual',
            catatan: 'Hujan lebat menyebabkan genangan, beberapa tanaman busuk akar',
            foto: [],
            created_at: '2024-03-25 17:00:00'
        },
        {
            id: 5,
            ladang_id: 5,
            ladang_nama: 'Ladang Karo',
            tanggal: '2024-03-24',
            waktu: '11:10',
            curah_hujan: 8,
            gangguan: ['Burung Pemakan'],
            sumber_data: 'manual',
            catatan: 'Burung banyak memakan buah, perlu pemasangan jaring',
            foto: [],
            created_at: '2024-03-24 12:00:00'
        }
    ];
    
    // Data gangguan custom
    let customGangguan = [];
    
    // Elemen DOM
    const weatherForm = document.getElementById('weatherForm');
    const ladangSelect = document.getElementById('ladang_id');
    const ladangInfo = document.getElementById('ladangInfo');
    const sumberApiRadio = document.getElementById('sumber_api');
    const sumberManualRadio = document.getElementById('sumber_manual');
    const apiWeatherInfo = document.getElementById('apiWeatherInfo');
    const manualInputSection = document.getElementById('manualInputSection');
    const curahHujanInput = document.getElementById('curah_hujan');
    const rainMarker = document.getElementById('rainMarker');
    const rainIndicator = document.getElementById('rainIndicator');
    const gangguanList = document.getElementById('gangguanList');
    const tambahGangguanBtn = document.getElementById('tambahGangguanBtn');
    const photoUploadArea = document.getElementById('photoUploadArea');
    const fotoInput = document.getElementById('foto_dokumentasi');
    const photoPreviewContainer = document.getElementById('photoPreviewContainer');
    const photoPreviews = document.getElementById('photoPreviews');
    const recommendationSection = document.getElementById('recommendationSection');
    const recommendationContent = document.getElementById('recommendationContent');
    const loadWeatherBtn = document.getElementById('loadWeatherBtn');
    const resetBtn = document.getElementById('resetBtn');
    const simpanDraftBtn = document.getElementById('simpanDraftBtn');
    const submitBtn = document.getElementById('submitBtn');
    const successAlert = document.getElementById('successAlert');
    const successMessage = document.getElementById('successMessage');
    const errorAlert = document.getElementById('errorAlert');
    const errorMessage = document.getElementById('errorMessage');
    const reportTableBody = document.getElementById('reportTableBody');
    const syncWeatherBtn = document.getElementById('syncWeatherBtn');
    const exportReportBtn = document.getElementById('exportReportBtn');
    const gangguanModal = document.getElementById('gangguanModal');
    const reportDetailModal = document.getElementById('reportDetailModal');
    
    // State
    let selectedGangguan = [];
    let uploadedPhotos = [];
    let currentPage = 1;
    const itemsPerPage = 5;
    
    // Initialize
    loadGangguanList();
    loadReportTable();
    updateRainIndicator(0);
    
    // Load info ladang
    ladangSelect.addEventListener('change', function() {
        const ladangId = this.value;
        
        if (!ladangId) {
            ladangInfo.style.display = 'none';
            return;
        }
        
        const ladang = ladangData[ladangId];
        if (ladang) {
            document.getElementById('infoPemilik').textContent = ladang.pemilik;
            document.getElementById('infoLuas').textContent = ladang.luas;
            document.getElementById('infoLokasi').textContent = ladang.lokasi;
            document.getElementById('infoKetinggian').textContent = ladang.ketinggian;
            ladangInfo.style.display = 'block';
        }
    });
    
    // Toggle sumber data
    sumberApiRadio.addEventListener('change', function() {
        if (this.checked) {
            apiWeatherInfo.style.display = 'block';
            manualInputSection.style.display = 'none';
            loadWeatherData();
        }
    });
    
    sumberManualRadio.addEventListener('change', function() {
        if (this.checked) {
            apiWeatherInfo.style.display = 'none';
            manualInputSection.style.display = 'block';
        }
    });
    
    // Load data cuaca API (simulasi)
    function loadWeatherData() {
        // Simulasi data dari API BMKG
        const weatherData = {
            suhu: '26',
            kelembaban: '75',
            angin: '12',
            kondisi: 'Cerah Berawan',
            curah_hujan: '18',
            tekanan: '1013',
            arah_angin: 'Barat Daya'
        };
        
        document.getElementById('apiSuhu').textContent = weatherData.suhu + ' °C';
        document.getElementById('apiKelembaban').textContent = weatherData.kelembaban + ' %';
        document.getElementById('apiAngin').textContent = weatherData.angin + ' km/jam';
        document.getElementById('apiKondisi').textContent = weatherData.kondisi;
        
        // Set nilai curah hujan
        document.getElementById('curah_hujan').value = weatherData.curah_hujan;
        updateRainIndicator(parseFloat(weatherData.curah_hujan));
        
        // Update rekomendasi
        updateRecommendation(parseFloat(weatherData.curah_hujan));
    }
    
    // Load weather button
    loadWeatherBtn.addEventListener('click', loadWeatherData);
    
    // Update rain indicator
    curahHujanInput.addEventListener('input', function() {
        const value = parseFloat(this.value) || 0;
        updateRainIndicator(value);
        updateRecommendation(value);
    });
    
    function updateRainIndicator(value) {
        const maxRain = 200;
        const percentage = Math.min(value / maxRain * 100, 100);
        rainMarker.style.left = `calc(${percentage}% - 8px)`;
        
        if (value < 20) {
            rainMarker.style.backgroundColor = '#4CAF50';
        } else if (value < 100) {
            rainMarker.style.backgroundColor = '#FF9800';
        } else {
            rainMarker.style.backgroundColor = '#F44336';
        }
    }
    
    // Update rekomendasi
    function updateRecommendation(curahHujan) {
        let recommendations = [];
        
        if (curahHujan < 10) {
            recommendations = [
                '💧 Lakukan penyiraman tambahan untuk tanaman',
                '🌱 Pertimbangkan sistem irigasi tetes',
                '🔍 Pantau kelembaban tanah harian',
                '🌳 Tambahkan mulsa untuk mengurangi penguapan'
            ];
        } else if (curahHujan < 50) {
            recommendations = [
                '✅ Kondisi ideal untuk pertumbuhan jeruk',
                '🌿 Lanjutkan perawatan rutin',
                '🔍 Pantau kemungkinan hama',
                '📊 Catat perkembangan tanaman'
            ];
        } else if (curahHujan < 100) {
            recommendations = [
                '⚠️ Waspada genangan air',
                '🚜 Periksa sistem drainase',
                '🍃 Awasi penyakit jamur',
                '💊 Siapkan fungisida jika diperlukan'
            ];
        } else {
            recommendations = [
                '🚨 Bahaya banjir dan erosi',
                '🏃 Evakuasi alat-alat pertanian',
                '🌊 Perkuat tanggul dan drainase',
                '📞 Laporkan kondisi darurat ke pusat'
            ];
        }
        
        recommendationContent.innerHTML = recommendations.map(rec => 
            `<div class="recommendation-item">
                <i class="fas fa-check-circle" style="color: #4CAF50; margin-top: 2px;"></i>
                <span>${rec}</span>
            </div>`
        ).join('');
        
        recommendationSection.style.display = 'block';
    }
    
    // Load gangguan list
    function loadGangguanList() {
        gangguanList.innerHTML = '';
        
        const allGangguan = [...gangguanUmum, ...customGangguan];
        
        allGangguan.forEach(gangguan => {
            const item = document.createElement('div');
            item.className = 'gangguan-item';
            item.innerHTML = `
                <input type="checkbox" id="gangguan_${gangguan.id}" value="${gangguan.nama}" class="gangguan-checkbox">
                <label for="gangguan_${gangguan.id}" class="gangguan-label">
                    <div class="gangguan-icon" style="background-color: ${gangguan.color}">
                        <i class="${gangguan.icon}"></i>
                    </div>
                    <div class="gangguan-content">
                        <div class="gangguan-title">${gangguan.nama}</div>
                        <div class="gangguan-desc">${gangguan.deskripsi}</div>
                    </div>
                    <div class="gangguan-badge badge-${gangguan.tingkat}">
                        ${gangguan.tingkat}
                    </div>
                </label>
            `;
            
            gangguanList.appendChild(item);
            
            const checkbox = item.querySelector('.gangguan-checkbox');
            checkbox.addEventListener('change', function() {
                if (this.checked) {
                    if (!selectedGangguan.includes(gangguan.nama)) {
                        selectedGangguan.push(gangguan.nama);
                    }
                } else {
                    selectedGangguan = selectedGangguan.filter(g => g !== gangguan.nama);
                }
            });
        });
    }
    
    // Tambah gangguan button
    tambahGangguanBtn.addEventListener('click', function() {
        document.getElementById('nama_gangguan').value = '';
        document.getElementById('kategori_gangguan').value = 'hama';
        document.querySelector('input[name="tingkat"][value="ringan"]').checked = true;
        document.getElementById('deskripsi_gangguan').value = '';
        
        gangguanModal.style.display = 'flex';
        document.body.style.overflow = 'hidden';
    });
    
    // Save gangguan
    document.getElementById('saveGangguanBtn').addEventListener('click', function() {
        const nama = document.getElementById('nama_gangguan').value.trim();
        const kategori = document.getElementById('kategori_gangguan').value;
        const tingkat = document.querySelector('input[name="tingkat"]:checked').value;
        const deskripsi = document.getElementById('deskripsi_gangguan').value.trim();
        
        if (!nama) {
            showError('Nama gangguan harus diisi');
            return;
        }
        
        let icon, color;
        switch(kategori) {
            case 'hama':
                icon = 'fas fa-bug';
                color = '#F44336';
                break;
            case 'penyakit':
                icon = 'fas fa-leaf';
                color = '#4CAF50';
                break;
            case 'lingkungan':
                icon = 'fas fa-cloud-sun';
                color = '#2196F3';
                break;
            default:
                icon = 'fas fa-exclamation-triangle';
                color = '#FF9800';
        }
        
        const newGangguan = {
            id: Date.now(),
            nama: nama,
            kategori: kategori,
            tingkat: tingkat,
            deskripsi: deskripsi || 'Tidak ada deskripsi',
            icon: icon,
            color: color
        };
        
        customGangguan.push(newGangguan);
        loadGangguanList();
        
        gangguanModal.style.display = 'none';
        document.body.style.overflow = 'auto';
        
        showSuccess('Gangguan baru berhasil ditambahkan!');
    });
    
    // Close modal gangguan
    document.querySelector('.close-gangguan-modal').addEventListener('click', function() {
        gangguanModal.style.display = 'none';
        document.body.style.overflow = 'auto';
    });
    
    document.getElementById('cancelGangguanBtn').addEventListener('click', function() {
        gangguanModal.style.display = 'none';
        document.body.style.overflow = 'auto';
    });
    
    // Photo upload
    photoUploadArea.addEventListener('click', function() {
        fotoInput.click();
    });
    
    fotoInput.addEventListener('change', function(e) {
        if (this.files && this.files.length > 0) {
            Array.from(this.files).forEach(file => {
                if (file.size > 5 * 1024 * 1024) {
                    showError(`File ${file.name} terlalu besar. Maksimal 5MB.`);
                    return;
                }
                
                if (!file.type.match('image.*')) {
                    showError(`File ${file.name} harus berupa gambar.`);
                    return;
                }
                
                const photoId = Date.now() + Math.random();
                uploadedPhotos.push({
                    id: photoId,
                    file: file,
                    url: URL.createObjectURL(file)
                });
                
                const reader = new FileReader();
                reader.onload = function(e) {
                    const preview = document.createElement('div');
                    preview.className = 'photo-preview';
                    preview.dataset.id = photoId;
                    preview.innerHTML = `
                        <img src="${e.target.result}" alt="Preview">
                        <div class="remove-photo" data-id="${photoId}">
                            <i class="fas fa-times"></i>
                        </div>
                    `;
                    
                    photoPreviews.appendChild(preview);
                    photoPreviewContainer.style.display = 'block';
                    
                    preview.querySelector('.remove-photo').addEventListener('click', function() {
                        const id = this.dataset.id;
                        uploadedPhotos = uploadedPhotos.filter(p => p.id != id);
                        preview.remove();
                        
                        if (uploadedPhotos.length === 0) {
                            photoPreviewContainer.style.display = 'none';
                        }
                    });
                };
                reader.readAsDataURL(file);
            });
            
            this.value = '';
        }
    });
    
    // Reset form
    resetBtn.addEventListener('click', function() {
        if (confirm('Apakah Anda yakin ingin mereset form? Semua data yang telah diisi akan hilang.')) {
            weatherForm.reset();
            selectedGangguan = [];
            uploadedPhotos = [];
            ladangInfo.style.display = 'none';
            apiWeatherInfo.style.display = 'none';
            manualInputSection.style.display = 'block';
            photoPreviewContainer.style.display = 'none';
            photoPreviews.innerHTML = '';
            recommendationSection.style.display = 'none';
            successAlert.style.display = 'none';
            errorAlert.style.display = 'none';
            
            document.querySelectorAll('.gangguan-checkbox').forEach(cb => {
                cb.checked = false;
            });
            
            sumberManualRadio.checked = true;
            
            document.getElementById('tanggal').value = '{{ date('Y-m-d') }}';
            document.getElementById('waktu').value = '{{ date('H:i') }}';
            
            updateRainIndicator(0);
        }
    });
    
    // Simpan draft
    simpanDraftBtn.addEventListener('click', function() {
        const formData = {
            ladang_id: ladangSelect.value,
            tanggal: document.getElementById('tanggal').value,
            waktu: document.getElementById('waktu').value,
            sumber_data: document.querySelector('input[name="sumber_data"]:checked').value,
            curah_hujan: document.getElementById('curah_hujan').value,
            gangguan: selectedGangguan,
            catatan_gangguan: document.getElementById('catatan_gangguan').value,
            last_saved: new Date().toISOString()
        };
        
        localStorage.setItem('weatherDraft', JSON.stringify(formData));
        showSuccess('Draft laporan berhasil disimpan!');
    });
    
    // Load draft
    function loadDraft() {
        const draft = JSON.parse(localStorage.getItem('weatherDraft'));
        if (draft) {
            if (confirm('Ada draft laporan yang tersimpan. Apakah Anda ingin melanjutkan?')) {
                ladangSelect.value = draft.ladang_id;
                document.getElementById('tanggal').value = draft.tanggal;
                document.getElementById('waktu').value = draft.waktu;
                document.querySelector(`input[name="sumber_data"][value="${draft.sumber_data}"]`).checked = true;
                document.getElementById('curah_hujan').value = draft.curah_hujan;
                document.getElementById('catatan_gangguan').value = draft.catatan_gangguan;
                
                ladangSelect.dispatchEvent(new Event('change'));
                if (draft.sumber_data === 'api') {
                    sumberApiRadio.dispatchEvent(new Event('change'));
                }
                
                selectedGangguan = draft.gangguan || [];
                document.querySelectorAll('.gangguan-checkbox').forEach(cb => {
                    cb.checked = selectedGangguan.includes(cb.value);
                });
                
                updateRainIndicator(parseFloat(draft.curah_hujan) || 0);
                
                showSuccess('Draft berhasil dimuat! Terakhir disimpan: ' + new Date(draft.last_saved).toLocaleString());
            }
        }
    }
    
    // Load draft saat halaman dimuat
    setTimeout(loadDraft, 1000);
    
    // Submit form
    weatherForm.addEventListener('submit', function(e) {
        e.preventDefault();
        
        const errors = [];
        
        if (!ladangSelect.value) {
            errors.push('Pilih ladang terlebih dahulu');
        }
        
        const curahHujan = parseFloat(curahHujanInput.value);
        if (isNaN(curahHujan) || curahHujan < 0 || curahHujan > 500) {
            errors.push('Curah hujan harus antara 0-500 mm');
        }
        
        if (errors.length > 0) {
            showError(errors.join('<br>'));
            return;
        }
        
        const newReport = {
            id: Date.now(),
            ladang_id: ladangSelect.value,
            ladang_nama: ladangSelect.options[ladangSelect.selectedIndex].text.split(' (')[0],
            tanggal: document.getElementById('tanggal').value,
            waktu: document.getElementById('waktu').value || '00:00',
            curah_hujan: curahHujan,
            gangguan: [...selectedGangguan],
            sumber_data: document.querySelector('input[name="sumber_data"]:checked').value,
            catatan: document.getElementById('catatan_gangguan').value,
            foto: uploadedPhotos.map(p => p.file.name),
            created_at: new Date().toISOString()
        };
        
        weatherReports.unshift(newReport);
        
        // Reset form
        weatherForm.reset();
        selectedGangguan = [];
        uploadedPhotos = [];
        ladangInfo.style.display = 'none';
        apiWeatherInfo.style.display = 'none';
        manualInputSection.style.display = 'block';
        photoPreviewContainer.style.display = 'none';
        photoPreviews.innerHTML = '';
        recommendationSection.style.display = 'none';
        
        document.querySelectorAll('.gangguan-checkbox').forEach(cb => {
            cb.checked = false;
        });
        
        sumberManualRadio.checked = true;
        
        document.getElementById('tanggal').value = '{{ date('Y-m-d') }}';
        document.getElementById('waktu').value = '{{ date('H:i') }}';
        
        updateRainIndicator(0);
        
        loadReportTable();
        localStorage.removeItem('weatherDraft');
        showSuccess(`Laporan cuaca berhasil disimpan! ID: ${newReport.id}`);
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
    
    // Load report table
    function loadReportTable() {
        reportTableBody.innerHTML = '';
        
        const startIndex = (currentPage - 1) * itemsPerPage;
        const endIndex = startIndex + itemsPerPage;
        const pageData = weatherReports.slice(startIndex, endIndex);
        
        if (pageData.length === 0) {
            reportTableBody.innerHTML = `
                <tr>
                    <td colspan="7" style="text-align: center; padding: 40px; color: var(--text-light);">
                        <i class="fas fa-cloud" style="font-size: 40px; margin-bottom: 10px; opacity: 0.5; display: block;"></i>
                        <div>Belum ada laporan cuaca</div>
                    </td>
                </tr>
            `;
        } else {
            pageData.forEach((report, index) => {
                const globalIndex = startIndex + index + 1;
                const row = document.createElement('tr');
                
                const tanggal = new Date(report.tanggal);
                const formattedDate = tanggal.toLocaleDateString('id-ID', {
                    day: '2-digit',
                    month: 'short',
                    year: 'numeric'
                });
                
                row.innerHTML = `
                    <td style="color: var(--text-light);">${globalIndex}</td>
                    <td>
                        <div style="font-weight: 600; color: var(--text-dark);">${report.ladang_nama}</div>
                    </td>
                    <td style="color: var(--text-light);">${formattedDate}</td>
                    <td>
                        <div style="font-weight: 600; color: ${getRainColor(report.curah_hujan)};">${report.curah_hujan} mm</div>
                    </td>
                    <td style="color: var(--text-light); font-size: 13px;">
                        ${report.gangguan.slice(0, 2).join(', ')}${report.gangguan.length > 2 ? '...' : ''}
                    </td>
                    <td>
                        <span style="padding: 4px 8px; border-radius: 4px; font-size: 12px; font-weight: 600; background-color: ${report.sumber_data === 'api' ? '#E3F2FD' : '#FFF3E0'}; color: ${report.sumber_data === 'api' ? '#1565C0' : '#EF6C00'};">
                            ${report.sumber_data === 'api' ? 'API' : 'Manual'}
                        </span>
                    </td>
                    <td>
                        <div class="action-buttons">
                            <button type="button" class="btn-action btn-view" data-id="${report.id}" title="Lihat Detail">
                                <i class="fas fa-eye"></i>
                            </button>
                            <button type="button" class="btn-action btn-edit" data-id="${report.id}" title="Edit Laporan">
                                <i class="fas fa-edit"></i>
                            </button>
                            <button type="button" class="btn-action btn-delete" data-id="${report.id}" title="Hapus Laporan">
                                <i class="fas fa-trash"></i>
                            </button>
                        </div>
                    </td>
                `;
                
                reportTableBody.appendChild(row);
            });
        }
        
        document.getElementById('showingCount').textContent = pageData.length;
        document.getElementById('totalCount').textContent = weatherReports.length;
        
        updatePagination();
        addReportActionListeners();
    }
    
    // Get rain color
    function getRainColor(curahHujan) {
        if (curahHujan < 20) return '#4CAF50';
        if (curahHujan < 100) return '#FF9800';
        return '#F44336';
    }
    
    // Update pagination
    function updatePagination() {
        const totalPages = Math.ceil(weatherReports.length / itemsPerPage);
        const pageNumbers = document.getElementById('pageNumbers');
        pageNumbers.innerHTML = '';
        
        for (let i = 1; i <= Math.min(totalPages, 5); i++) {
            const pageNumber = document.createElement('button');
            pageNumber.type = 'button';
            pageNumber.className = `page-number ${i === currentPage ? 'active' : ''}`;
            pageNumber.textContent = i;
            pageNumber.addEventListener('click', function() {
                currentPage = i;
                loadReportTable();
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
    
    // Add report action listeners
    function addReportActionListeners() {
        document.querySelectorAll('.btn-action.btn-view').forEach(btn => {
            btn.addEventListener('click', function() {
                const reportId = parseInt(this.dataset.id);
                const report = weatherReports.find(r => r.id === reportId);
                if (report) showReportDetail(report);
            });
        });
        
        document.querySelectorAll('.btn-action.btn-edit').forEach(btn => {
            btn.addEventListener('click', function() {
                const reportId = parseInt(this.dataset.id);
                const report = weatherReports.find(r => r.id === reportId);
                if (report) editReport(report);
            });
        });
        
        document.querySelectorAll('.btn-action.btn-delete').forEach(btn => {
            btn.addEventListener('click', function() {
                const reportId = parseInt(this.dataset.id);
                if (confirm('Apakah Anda yakin ingin menghapus laporan ini?')) {
                    weatherReports = weatherReports.filter(r => r.id !== reportId);
                    loadReportTable();
                    showSuccess('Laporan berhasil dihapus!');
                }
            });
        });
    }
    
    // Show report detail
    function showReportDetail(report) {
        const modalContent = reportDetailModal.querySelector('.modal-content');
        
        const tanggal = new Date(report.tanggal);
        const formattedDate = tanggal.toLocaleDateString('id-ID', {
            weekday: 'long',
            year: 'numeric',
            month: 'long',
            day: 'numeric'
        });
        
        modalContent.innerHTML = `
            <div class="modal-header">
                <h3 class="modal-title">Detail Laporan Cuaca</h3>
                <button type="button" class="close-modal">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <div class="modal-body">
                <div class="report-header">
                    <div class="report-title">${report.ladang_nama}</div>
                    <div class="report-date">${formattedDate} ${report.waktu !== '00:00' ? '• ' + report.waktu : ''}</div>
                </div>
                
                <div class="report-stats">
                    <div class="stat-card">
                        <div class="stat-label">Curah Hujan</div>
                        <div class="stat-value" style="color: ${getRainColor(report.curah_hujan)};">${report.curah_hujan} mm</div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-label">Sumber Data</div>
                        <div class="stat-value">
                            <span style="padding: 4px 12px; border-radius: 20px; font-size: 14px; background-color: ${report.sumber_data === 'api' ? '#E3F2FD' : '#FFF3E0'}; color: ${report.sumber_data === 'api' ? '#1565C0' : '#EF6C00'};">${report.sumber_data === 'api' ? 'API BMKG' : 'Input Manual'}</span>
                        </div>
                    </div>
                </div>
                
                ${report.gangguan.length > 0 ? `
                <div class="report-section">
                    <div class="section-title">Gangguan yang Dilaporkan</div>
                    <div class="gangguan-tags">
                        ${report.gangguan.map(g => `
                            <span class="tag">
                                <i class="fas fa-exclamation-triangle"></i>${g}
                            </span>
                        `).join('')}
                    </div>
                </div>
                ` : ''}
                
                ${report.catatan ? `
                <div class="report-section">
                    <div class="section-title">Catatan</div>
                    <div class="note-box">
                        ${report.catatan}
                    </div>
                </div>
                ` : ''}
                
                ${report.foto && report.foto.length > 0 ? `
                <div class="report-section">
                    <div class="section-title">Foto Dokumentasi</div>
                    <div class="photo-grid">
                        ${report.foto.map((foto, index) => `
                            <div class="photo-placeholder">
                                <i class="fas fa-image"></i>
                                <span>Foto ${index + 1}</span>
                            </div>
                        `).join('')}
                    </div>
                </div>
                ` : ''}
                
                <div class="report-footer">
                    Dibuat: ${new Date(report.created_at).toLocaleString('id-ID')}
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline btn-print">
                    <i class="fas fa-print"></i> Cetak Laporan
                </button>
                <button type="button" class="btn btn-primary btn-close-modal">
                    Tutup
                </button>
            </div>
        `;
        
        reportDetailModal.style.display = 'flex';
        document.body.style.overflow = 'hidden';
        
        const closeModal = function() {
            reportDetailModal.style.display = 'none';
            document.body.style.overflow = 'auto';
        };
        
        modalContent.querySelector('.close-modal').addEventListener('click', closeModal);
        modalContent.querySelector('.btn-close-modal').addEventListener('click', closeModal);
        reportDetailModal.addEventListener('click', function(e) {
            if (e.target === reportDetailModal) closeModal();
        });
        
        modalContent.querySelector('.btn-print').addEventListener('click', function() {
            alert('Fitur cetak akan tersedia segera!');
        });
    }
    
    // Edit report
    function editReport(report) {
        ladangSelect.value = report.ladang_id;
        document.getElementById('tanggal').value = report.tanggal;
        document.getElementById('waktu').value = report.waktu;
        
        if (report.sumber_data === 'api') {
            sumberApiRadio.checked = true;
            sumberApiRadio.dispatchEvent(new Event('change'));
        } else {
            sumberManualRadio.checked = true;
            sumberManualRadio.dispatchEvent(new Event('change'));
        }
        
        document.getElementById('curah_hujan').value = report.curah_hujan;
        document.getElementById('catatan_gangguan').value = report.catatan || '';
        
        selectedGangguan = [...report.gangguan];
        document.querySelectorAll('.gangguan-checkbox').forEach(cb => {
            cb.checked = selectedGangguan.includes(cb.value);
        });
        
        ladangSelect.dispatchEvent(new Event('change'));
        updateRainIndicator(report.curah_hujan);
        updateRecommendation(report.curah_hujan);
        
        weatherReports = weatherReports.filter(r => r.id !== report.id);
        loadReportTable();
        
        document.querySelector('.content-card').scrollIntoView({ behavior: 'smooth' });
        showSuccess('Laporan dimuat untuk diedit. Silakan perbarui data dan simpan kembali.');
    }
    
    // Pagination buttons
    document.querySelector('.btn-pagination.prev').addEventListener('click', function() {
        if (currentPage > 1) {
            currentPage--;
            loadReportTable();
        }
    });
    
    document.querySelector('.btn-pagination.next').addEventListener('click', function() {
        const totalPages = Math.ceil(weatherReports.length / itemsPerPage);
        if (currentPage < totalPages) {
            currentPage++;
            loadReportTable();
        }
    });
    
    // Sync weather button
    syncWeatherBtn.addEventListener('click', function() {
        this.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Menyinkronkan...';
        this.disabled = true;
        
        setTimeout(() => {
            const newReports = [
                {
                    id: Date.now(),
                    ladang_id: '2',
                    ladang_nama: 'Ladang Berastagi',
                    tanggal: '{{ date("Y-m-d") }}',
                    waktu: '{{ date("H:i") }}',
                    curah_hujan: 22,
                    gangguan: ['Hujan Lebat'],
                    sumber_data: 'api',
                    catatan: 'Data sinkronisasi otomatis dari BMKG',
                    foto: [],
                    created_at: new Date().toISOString()
                }
            ];
            
            weatherReports = [...newReports, ...weatherReports];
            loadReportTable();
            
            this.innerHTML = '<i class="fas fa-sync-alt"></i> Sync Data Cuaca';
            this.disabled = false;
            
            showSuccess('Data cuaca berhasil disinkronkan! ' + newReports.length + ' laporan baru ditambahkan.');
        }, 1500);
    });
    
    // Export report
    exportReportBtn.addEventListener('click', function() {
        this.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Menyiapkan...';
        
        setTimeout(() => {
            const dataStr = JSON.stringify(weatherReports, null, 2);
            const dataBlob = new Blob([dataStr], { type: 'application/json' });
            
            const link = document.createElement('a');
            link.href = URL.createObjectURL(dataBlob);
            link.download = `laporan-cuaca-${new Date().toISOString().split('T')[0]}.json`;
            link.click();
            
            this.innerHTML = '<i class="fas fa-file-export"></i> Export Laporan';
            showSuccess('Laporan berhasil diexport! File telah didownload.');
        }, 1000);
    });
    
    // Simulasi data BMKG
    window.simulateBMKGData = function() {
        const mockData = {
            suhu: Math.floor(Math.random() * 10) + 22,
            kelembaban: Math.floor(Math.random() * 30) + 60,
            angin: Math.floor(Math.random() * 15) + 5,
            curah_hujan: Math.floor(Math.random() * 80),
            kondisi: ['Cerah', 'Berawan', 'Hujan Ringan', 'Hujan Sedang'][Math.floor(Math.random() * 4)]
        };
        
        if (sumberApiRadio.checked) {
            document.getElementById('apiSuhu').textContent = mockData.suhu + ' °C';
            document.getElementById('apiKelembaban').textContent = mockData.kelembaban + ' %';
            document.getElementById('apiAngin').textContent = mockData.angin + ' km/jam';
            document.getElementById('apiKondisi').textContent = mockData.kondisi;
            
            document.getElementById('curah_hujan').value = mockData.curah_hujan;
            updateRainIndicator(mockData.curah_hujan);
            updateRecommendation(mockData.curah_hujan);
            
            showSuccess('Data cuaca BMKG berhasil diupdate!');
        }
    };
});
</script>
@endsection