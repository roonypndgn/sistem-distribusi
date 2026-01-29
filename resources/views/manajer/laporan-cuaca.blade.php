# Tampilan Laporan Cuaca Lapangan

```html
@extends('layouts.manajer')

@section('title', 'Laporan Cuaca Lapangan - PT. Mardua Holong')

@section('page-title', 'Laporan Cuaca Lapangan')
@section('page-subtitle', 'Monitoring Kondisi Cuaca untuk Pertanian Jeruk')

@section('content')
<div class="content-wrapper">
    <!-- Header -->
    <div class="content-header" style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 30px;">
        <div>
            <h1 style="font-size: 24px; font-weight: 700; color: var(--text-dark); margin-bottom: 5px;">Laporan Cuaca Lapangan</h1>
            <p style="color: var(--text-light); font-size: 14px;">Pantau kondisi cuaca dan gangguan di ladang jeruk</p>
        </div>
        
        <div style="display: flex; gap: 10px;">
            <button type="button" id="syncWeatherBtn" class="btn" style="background-color: var(--bg-light); color: var(--text-light);">
                <i class="fas fa-sync-alt"></i> Sync Data Cuaca
            </button>
            <button type="button" id="exportReportBtn" class="btn btn-primary">
                <i class="fas fa-file-export"></i> Export Laporan
            </button>
        </div>
    </div>
    
    <!-- Form Input Laporan -->
    <div class="content-card" style="margin-bottom: 30px;">
        <div class="card-title">
            <span>Form Input Laporan Cuaca</span>
            <div class="card-icon">
                <i class="fas fa-cloud-sun"></i>
            </div>
        </div>
        
        <!-- Success Alert -->
        <div id="successAlert" class="alert-success" style="display: none;">
            <i class="fas fa-check-circle"></i>
            <span id="successMessage"></span>
        </div>
        
        <!-- Error Alert -->
        <div id="errorAlert" class="alert-error" style="display: none;">
            <i class="fas fa-exclamation-circle"></i>
            <span id="errorMessage"></span>
        </div>
        
        <form id="weatherForm">
            <div style="display: grid; grid-template-columns: repeat(2, 1fr); gap: 25px;">
                <!-- Kolom Kiri -->
                <div>
                    <!-- Ladang -->
                    <div class="form-group">
                        <label class="form-label">Ladang *</label>
                        <div class="input-wrapper">
                            <i class="fas fa-tractor input-icon"></i>
                            <select id="ladang_id" name="ladang_id" class="form-control" required>
                                <option value="">-- Pilih Ladang --</option>
                                <option value="1">Ladang Simalungun (Berastagi) | 2.5 Ha | Tuan Sitorus</option>
                                <option value="2">Ladang Berastagi (Pusat) | 3.0 Ha | Budi Santoso</option>
                                <option value="3">Ladang Sipirok | 1.8 Ha | Joko Widodo</option>
                                <option value="4">Ladang Parapat | 2.2 Ha | Siti Aminah</option>
                                <option value="5">Ladang Karo | 1.5 Ha | Rudi Hartono</option>
                            </select>
                        </div>
                        <small class="form-text">Pilih ladang yang akan dilaporkan</small>
                    </div>
                    
                    <!-- Info Ladang -->
                    <div id="ladangInfo" style="display: none; background-color: var(--primary-lighter); border-radius: 10px; padding: 15px; margin-top: 15px;">
                        <div style="display: grid; grid-template-columns: repeat(2, 1fr); gap: 10px; font-size: 13px;">
                            <div>
                                <div style="color: var(--text-light);">Pemilik</div>
                                <div style="font-weight: 600; color: var(--text-dark);" id="infoPemilik">-</div>
                            </div>
                            <div>
                                <div style="color: var(--text-light);">Luas</div>
                                <div style="font-weight: 600; color: var(--text-dark);" id="infoLuas">-</div>
                            </div>
                            <div>
                                <div style="color: var(--text-light);">Lokasi</div>
                                <div style="font-weight: 600; color: var(--text-dark);" id="infoLokasi">-</div>
                            </div>
                            <div>
                                <div style="color: var(--text-light);">Ketinggian</div>
                                <div style="font-weight: 600; color: var(--text-dark);" id="infoKetinggian">-</div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Tanggal -->
                    <div class="form-group">
                        <label class="form-label">Tanggal *</label>
                        <div class="input-wrapper">
                            <i class="fas fa-calendar-alt input-icon"></i>
                            <input type="date" id="tanggal" name="tanggal" class="form-control" 
                                   value="{{ date('Y-m-d') }}" required>
                        </div>
                        <small class="form-text">Tanggal observasi cuaca</small>
                    </div>
                    
                    <!-- Waktu Observasi -->
                    <div class="form-group">
                        <label class="form-label">Waktu Observasi</label>
                        <div class="input-wrapper">
                            <i class="fas fa-clock input-icon"></i>
                            <input type="time" id="waktu" name="waktu" class="form-control" 
                                   value="{{ date('H:i') }}">
                        </div>
                        <small class="form-text">Waktu pengamatan (opsional)</small>
                    </div>
                </div>
                
                <!-- Kolom Kanan -->
                <div>
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
                    <div id="apiWeatherInfo" style="display: none; background-color: #E3F2FD; border-radius: 10px; padding: 15px; margin-bottom: 20px;">
                        <div style="display: flex; align-items: center; gap: 12px; margin-bottom: 10px;">
                            <div style="font-size: 32px; color: #2196F3;">
                                <i class="fas fa-cloud-sun-rain"></i>
                            </div>
                            <div>
                                <div style="font-weight: 600; color: var(--text-dark); font-size: 16px;">Data Cuaca BMKG</div>
                                <div style="font-size: 13px; color: var(--text-light);">Berastagi, {{ date('d M Y') }}</div>
                            </div>
                        </div>
                        <div id="apiWeatherData" style="font-size: 13px;">
                            <div style="display: flex; justify-content: space-between; margin-bottom: 5px;">
                                <span style="color: var(--text-light);">Suhu:</span>
                                <span style="font-weight: 600; color: var(--text-dark);" id="apiSuhu">- °C</span>
                            </div>
                            <div style="display: flex; justify-content: space-between; margin-bottom: 5px;">
                                <span style="color: var(--text-light);">Kelembaban:</span>
                                <span style="font-weight: 600; color: var(--text-dark);" id="apiKelembaban">- %</span>
                            </div>
                            <div style="display: flex; justify-content: space-between; margin-bottom: 5px;">
                                <span style="color: var(--text-light);">Kecepatan Angin:</span>
                                <span style="font-weight: 600; color: var(--text-dark);" id="apiAngin">- km/jam</span>
                            </div>
                            <div style="display: flex; justify-content: space-between;">
                                <span style="color: var(--text-light);">Kondisi:</span>
                                <span style="font-weight: 600; color: #2196F3;" id="apiKondisi">-</span>
                            </div>
                        </div>
                        <div style="margin-top: 10px; padding-top: 10px; border-top: 1px dashed #BBDEFB;">
                            <button type="button" id="loadWeatherBtn" class="btn" style="width: 100%; padding: 8px; font-size: 13px; background-color: #2196F3; color: white;">
                                <i class="fas fa-download"></i> Load Data Cuaca Terbaru
                            </button>
                        </div>
                    </div>
                    
                    <!-- Manual Input -->
                    <div id="manualInputSection">
                        <!-- Curah Hujan -->
                        <div class="form-group">
                            <label class="form-label">Curah Hujan (mm) *</label>
                            <div style="display: flex; align-items: center; gap: 10px;">
                                <div style="position: relative; flex: 1;">
                                    <div class="input-wrapper">
                                        <i class="fas fa-cloud-rain input-icon"></i>
                                        <input type="number" id="curah_hujan" name="curah_hujan" class="form-control" 
                                               placeholder="0" min="0" max="500" step="0.1" required>
                                    </div>
                                </div>
                                <div style="font-size: 14px; color: var(--text-light);">mm</div>
                            </div>
                            <small class="form-text">Jumlah hujan dalam 24 jam terakhir</small>
                            
                            <!-- Indikator Curah Hujan -->
                            <div id="rainIndicator" style="margin-top: 10px;">
                                <div style="display: flex; justify-content: space-between; margin-bottom: 5px;">
                                    <span style="font-size: 12px; color: var(--text-light);">Rendah</span>
                                    <span style="font-size: 12px; color: var(--text-light);">Tinggi</span>
                                </div>
                                <div style="height: 8px; background: linear-gradient(to right, #4CAF50, #FFEB3B, #FF9800, #F44336); border-radius: 4px; position: relative;">
                                    <div id="rainMarker" style="position: absolute; top: -4px; width: 16px; height: 16px; background-color: var(--primary); border-radius: 50%; border: 2px solid white; box-shadow: 0 2px 4px rgba(0,0,0,0.2);"></div>
                                </div>
                                <div style="display: flex; justify-content: space-between; margin-top: 5px;">
                                    <span style="font-size: 11px; color: #4CAF50;">&lt; 20mm</span>
                                    <span style="font-size: 11px; color: #FF9800;">20-100mm</span>
                                    <span style="font-size: 11px; color: #F44336;">&gt; 100mm</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Laporan Gangguan -->
            <div class="form-group">
                <label class="form-label">Laporan Gangguan</label>
                <div style="background-color: var(--bg-light); border-radius: 10px; padding: 20px;">
                    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 15px;">
                        <div>
                            <div style="font-weight: 600; color: var(--text-dark); font-size: 15px;">Jenis Gangguan yang Ditemukan</div>
                            <div style="font-size: 13px; color: var(--text-light);">Centang gangguan yang teridentifikasi</div>
                        </div>
                        <button type="button" id="tambahGangguanBtn" class="btn" style="background-color: var(--primary-lighter); color: var(--primary); padding: 8px 12px; font-size: 13px;">
                            <i class="fas fa-plus"></i> Tambah Gangguan Baru
                        </button>
                    </div>
                    
                    <!-- Daftar Gangguan -->
                    <div id="gangguanList" style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 10px;">
                        <!-- Gangguan akan ditambahkan via JavaScript -->
                    </div>
                    
                    <!-- Catatan Gangguan -->
                    <div style="margin-top: 20px;">
                        <label class="form-label">Catatan Detail Gangguan</label>
                        <textarea id="catatan_gangguan" name="catatan_gangguan" class="form-control" rows="3" 
                                  placeholder="Deskripsikan gangguan secara detail, lokasi tepatnya, dan tindakan yang sudah dilakukan..."></textarea>
                    </div>
                </div>
            </div>
            
            <!-- Foto Dokumentasi -->
            <div class="form-group">
                <label class="form-label">Foto Dokumentasi (Opsional)</label>
                <div class="photo-upload-area" id="photoUploadArea">
                    <div class="photo-upload-content">
                        <i class="fas fa-cloud-upload-alt"></i>
                        <p>Klik untuk upload foto kondisi ladang</p>
                        <small>Format: JPG, PNG (Maks. 5MB)</small>
                    </div>
                    <input type="file" id="foto_dokumentasi" name="foto_dokumentasi" accept="image/*" 
                           multiple style="display: none;">
                </div>
                <div id="photoPreviewContainer" style="display: none; margin-top: 15px;">
                    <div style="display: flex; flex-wrap: wrap; gap: 10px;" id="photoPreviews">
                        <!-- Foto preview akan ditambahkan di sini -->
                    </div>
                </div>
            </div>
            
            <!-- Rekomendasi -->
            <div id="recommendationSection" style="display: none; background-color: #FFF3E0; border-radius: 10px; padding: 20px; margin-bottom: 20px;">
                <div style="display: flex; align-items: center; gap: 12px; margin-bottom: 15px;">
                    <div style="font-size: 24px; color: #FF9800;">
                        <i class="fas fa-lightbulb"></i>
                    </div>
                    <div>
                        <div style="font-weight: 600; color: var(--text-dark); font-size: 16px;">Rekomendasi</div>
                        <div style="font-size: 13px; color: var(--text-light);">Saran berdasarkan kondisi cuaca</div>
                    </div>
                </div>
                <div id="recommendationContent" style="font-size: 14px; color: #5D4037;">
                    <!-- Rekomendasi akan diisi -->
                </div>
            </div>
            
            <!-- Tombol Aksi -->
            <div style="display: flex; gap: 10px; margin-top: 30px;">
                <button type="button" id="resetBtn" class="btn btn-secondary" style="flex: 1;">
                    <i class="fas fa-redo"></i> Reset Form
                </button>
                <button type="button" id="simpanDraftBtn" class="btn" style="flex: 1; background-color: var(--bg-light); color: var(--text-dark);">
                    <i class="fas fa-save"></i> Simpan Draft
                </button>
                <button type="submit" id="submitBtn" class="btn btn-success" style="flex: 2;">
                    <i class="fas fa-paper-plane"></i> Simpan Laporan
                </button>
            </div>
        </form>
    </div>
    
    <!-- Data Cuaca Terkini -->
    <div class="content-card">
        <div class="card-title">
            <span>Data Cuaca Terkini</span>
            <div class="card-icon">
                <i class="fas fa-chart-line"></i>
            </div>
        </div>
        
        <div style="display: grid; grid-template-columns: repeat(4, 1fr); gap: 20px; margin-bottom: 30px;">
            <div style="text-align: center;">
                <div style="font-size: 32px; color: #F44336; margin-bottom: 5px;">
                    <i class="fas fa-thermometer-half"></i>
                </div>
                <div style="font-size: 24px; font-weight: 700; color: var(--text-dark);">26°C</div>
                <div style="font-size: 13px; color: var(--text-light);">Suhu Rata-rata</div>
            </div>
            
            <div style="text-align: center;">
                <div style="font-size: 32px; color: #2196F3; margin-bottom: 5px;">
                    <i class="fas fa-tint"></i>
                </div>
                <div style="font-size: 24px; font-weight: 700; color: var(--text-dark);">75%</div>
                <div style="font-size: 13px; color: var(--text-light);">Kelembaban</div>
            </div>
            
            <div style="text-align: center;">
                <div style="font-size: 32px; color: #4CAF50; margin-bottom: 5px;">
                    <i class="fas fa-cloud-rain"></i>
                </div>
                <div style="font-size: 24px; font-weight: 700; color: var(--text-dark);">45mm</div>
                <div style="font-size: 13px; color: var(--text-light);">Curah Hujan (7 hari)</div>
            </div>
            
            <div style="text-align: center;">
                <div style="font-size: 32px; color: #FF9800; margin-bottom: 5px;">
                    <i class="fas fa-wind"></i>
                </div>
                <div style="font-size: 24px; font-weight: 700; color: var(--text-dark);">12 km/j</div>
                <div style="font-size: 13px; color: var(--text-light);">Angin Rata-rata</div>
            </div>
        </div>
        
        <!-- Grafik Curah Hujan -->
        <div>
            <h4 style="margin-bottom: 15px; color: var(--text-dark); font-size: 16px;">
                <i class="fas fa-chart-bar"></i> Curah Hujan 7 Hari Terakhir
            </h4>
            <div style="height: 200px; display: flex; align-items: flex-end; gap: 15px; padding: 20px; background-color: var(--bg-light); border-radius: 10px;">
                <!-- Bar chart akan diisi oleh JavaScript -->
                <div class="rain-bar" data-day="Sen" data-rain="15" style="flex: 1; display: flex; flex-direction: column; align-items: center;">
                    <div class="bar-value" style="font-size: 12px; color: var(--text-dark); margin-bottom: 5px;">15mm</div>
                    <div class="bar" style="width: 80%; background: linear-gradient(to top, #2196F3, #64B5F6); border-radius: 4px 4px 0 0; height: 60px;"></div>
                    <div class="bar-label" style="font-size: 12px; color: var(--text-light); margin-top: 5px;">Sen</div>
                </div>
                <div class="rain-bar" data-day="Sel" data-rain="8" style="flex: 1; display: flex; flex-direction: column; align-items: center;">
                    <div class="bar-value" style="font-size: 12px; color: var(--text-dark); margin-bottom: 5px;">8mm</div>
                    <div class="bar" style="width: 80%; background: linear-gradient(to top, #2196F3, #64B5F6); border-radius: 4px 4px 0 0; height: 32px;"></div>
                    <div class="bar-label" style="font-size: 12px; color: var(--text-light); margin-top: 5px;">Sel</div>
                </div>
                <div class="rain-bar" data-day="Rab" data-rain="25" style="flex: 1; display: flex; flex-direction: column; align-items: center;">
                    <div class="bar-value" style="font-size: 12px; color: var(--text-dark); margin-bottom: 5px;">25mm</div>
                    <div class="bar" style="width: 80%; background: linear-gradient(to top, #2196F3, #64B5F6); border-radius: 4px 4px 0 0; height: 100px;"></div>
                    <div class="bar-label" style="font-size: 12px; color: var(--text-light); margin-top: 5px;">Rab</div>
                </div>
                <div class="rain-bar" data-day="Kam" data-rain="45" style="flex: 1; display: flex; flex-direction: column; align-items: center;">
                    <div class="bar-value" style="font-size: 12px; color: var(--text-dark); margin-bottom: 5px;">45mm</div>
                    <div class="bar" style="width: 80%; background: linear-gradient(to top, #FF9800, #FFB74D); border-radius: 4px 4px 0 0; height: 180px;"></div>
                    <div class="bar-label" style="font-size: 12px; color: var(--text-light); margin-top: 5px;">Kam</div>
                </div>
                <div class="rain-bar" data-day="Jum" data-rain="12" style="flex: 1; display: flex; flex-direction: column; align-items: center;">
                    <div class="bar-value" style="font-size: 12px; color: var(--text-dark); margin-bottom: 5px;">12mm</div>
                    <div class="bar" style="width: 80%; background: linear-gradient(to top, #2196F3, #64B5F6); border-radius: 4px 4px 0 0; height: 48px;"></div>
                    <div class="bar-label" style="font-size: 12px; color: var(--text-light); margin-top: 5px;">Jum</div>
                </div>
                <div class="rain-bar" data-day="Sab" data-rain="5" style="flex: 1; display: flex; flex-direction: column; align-items: center;">
                    <div class="bar-value" style="font-size: 12px; color: var(--text-dark); margin-bottom: 5px;">5mm</div>
                    <div class="bar" style="width: 80%; background: linear-gradient(to top, #4CAF50, #81C784); border-radius: 4px 4px 0 0; height: 20px;"></div>
                    <div class="bar-label" style="font-size: 12px; color: var(--text-light); margin-top: 5px;">Sab</div>
                </div>
                <div class="rain-bar" data-day="Min" data-rain="18" style="flex: 1; display: flex; flex-direction: column; align-items: center;">
                    <div class="bar-value" style="font-size: 12px; color: var(--text-dark); margin-bottom: 5px;">18mm</div>
                    <div class="bar" style="width: 80%; background: linear-gradient(to top, #2196F3, #64B5F6); border-radius: 4px 4px 0 0; height: 72px;"></div>
                    <div class="bar-label" style="font-size: 12px; color: var(--text-light); margin-top: 5px;">Min</div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Riwayat Laporan -->
    <div class="content-card">
        <div class="card-title">
            <span>Riwayat Laporan Cuaca</span>
            <div class="card-icon">
                <i class="fas fa-history"></i>
            </div>
        </div>
        
        <div style="overflow-x: auto;">
            <table style="width: 100%; border-collapse: collapse;">
                <thead>
                    <tr style="background-color: var(--bg-light); border-bottom: 2px solid var(--border);">
                        <th style="padding: 12px; text-align: left; font-weight: 600; color: var(--text-dark); width: 50px;">No</th>
                        <th style="padding: 12px; text-align: left; font-weight: 600; color: var(--text-dark);">Ladang</th>
                        <th style="padding: 12px; text-align: left; font-weight: 600; color: var(--text-dark);">Tanggal</th>
                        <th style="padding: 12px; text-align: left; font-weight: 600; color: var(--text-dark);">Curah Hujan</th>
                        <th style="padding: 12px; text-align: left; font-weight: 600; color: var(--text-dark);">Gangguan</th>
                        <th style="padding: 12px; text-align: left; font-weight: 600; color: var(--text-dark);">Sumber Data</th>
                        <th style="padding: 12px; text-align: left; font-weight: 600; color: var(--text-dark); width: 120px;">Aksi</th>
                    </tr>
                </thead>
                <tbody id="reportTableBody">
                    <!-- Data akan diisi oleh JavaScript -->
                </tbody>
            </table>
        </div>
        
        <!-- Pagination -->
        <div style="display: flex; justify-content: space-between; align-items: center; margin-top: 20px; padding-top: 20px; border-top: 1px solid var(--border);">
            <div style="font-size: 14px; color: var(--text-light);">
                Menampilkan <span id="showingCount">0</span> dari <span id="totalCount">0</span> laporan
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

<!-- Modal Tambah Gangguan -->
<div class="modal-overlay" id="gangguanModal" style="display: none;">
    <div class="modal-content" style="max-width: 500px;">
        <div class="modal-header">
            <h3 class="modal-title">Tambah Gangguan Baru</h3>
            <button type="button" class="close-gangguan-modal" style="background: none; border: none; color: var(--text-light); cursor: pointer; font-size: 18px;">
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
                <div style="display: flex; gap: 10px;">
                    <label style="display: flex; align-items: center; gap: 5px; cursor: pointer;">
                        <input type="radio" name="tingkat" value="ringan" checked>
                        <span style="padding: 5px 10px; background-color: #E8F5E9; color: #2E7D32; border-radius: 4px; font-size: 12px;">Ringan</span>
                    </label>
                    <label style="display: flex; align-items: center; gap: 5px; cursor: pointer;">
                        <input type="radio" name="tingkat" value="sedang">
                        <span style="padding: 5px 10px; background-color: #FFF3E0; color: #EF6C00; border-radius: 4px; font-size: 12px;">Sedang</span>
                    </label>
                    <label style="display: flex; align-items: center; gap: 5px; cursor: pointer;">
                        <input type="radio" name="tingkat" value="berat">
                        <span style="padding: 5px 10px; background-color: #FFEBEE; color: #C62828; border-radius: 4px; font-size: 12px;">Berat</span>
                    </label>
                </div>
            </div>
            
            <div class="form-group">
                <label class="form-label">Deskripsi</label>
                <textarea id="deskripsi_gangguan" class="form-control" rows="3" placeholder="Deskripsi gangguan..."></textarea>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn" id="cancelGangguanBtn">Batal</button>
            <button type="button" class="btn btn-primary" id="saveGangguanBtn">Simpan Gangguan</button>
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
        background-color: var(--bg-light);
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
        background-color: var(--bg-light);
        color: var(--text-light);
    }
    
    .data-source-item input[type="radio"]:checked + .data-source-label .source-badge {
        background-color: var(--primary);
        color: white;
    }
    
    /* Gangguan Checkbox */
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
    }
    
    .gangguan-content {
        flex: 1;
    }
    
    .gangguan-title {
        font-weight: 600;
        color: var(--text-dark);
        font-size: 14px;
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
    
    /* Table Styles */
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
    
    /* Bar Chart */
    .rain-bar {
        transition: var(--transition);
    }
    
    .rain-bar:hover .bar {
        opacity: 0.8;
        transform: scaleY(1.05);
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
    // Data dummy ladang
    const ladangData = {
        1: {
            nama: 'Ladang Simalungun',
            pemilik: 'Tuan Sitorus',
            luas: '2.5 Ha',
            lokasi: 'Berastagi',
            ketinggian: '1,400 mdpl',
            jenis_tanah: 'Andosol'
        },
        2: {
            nama: 'Ladang Berastagi',
            pemilik: 'Budi Santoso',
            luas: '3.0 Ha',
            lokasi: 'Berastagi Pusat',
            ketinggian: '1,300 mdpl',
            jenis_tanah: 'Andosol'
        },
        3: {
            nama: 'Ladang Sipirok',
            pemilik: 'Joko Widodo',
            luas: '1.8 Ha',
            lokasi: 'Sipirok',
            ketinggian: '1,200 mdpl',
            jenis_tanah: 'Latosol'
        },
        4: {
            nama: 'Ladang Parapat',
            pemilik: 'Siti Aminah',
            luas: '2.2 Ha',
            lokasi: 'Parapat',
            ketinggian: '900 mdpl',
            jenis_tanah: 'Regosol'
        },
        5: {
            nama: 'Ladang Karo',
            pemilik: 'Rudi Hartono',
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
        const maxRain = 200; // 200mm max untuk skala
        const percentage = Math.min(value / maxRain * 100, 100);
        rainMarker.style.left = `calc(${percentage}% - 8px)`;
        
        // Warna marker berdasarkan tingkat
        if (value < 20) {
            rainMarker.style.backgroundColor = '#4CAF50'; // Hijau (rendah)
        } else if (value < 100) {
            rainMarker.style.backgroundColor = '#FF9800'; // Oranye (sedang)
        } else {
            rainMarker.style.backgroundColor = '#F44336'; // Merah (tinggi)
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
            `<div style="margin-bottom: 8px; display: flex; align-items: flex-start; gap: 10px;">
                <i class="fas fa-check-circle" style="color: #4CAF50; margin-top: 2px;"></i>
                <span>${rec}</span>
            </div>`
        ).join('');
        
        recommendationSection.style.display = 'block';
    }
    
    // Load gangguan list
    function loadGangguanList() {
        gangguanList.innerHTML = '';
        
        // Gabungkan gangguan umum dan custom
        const allGangguan = [...gangguanUmum, ...customGangguan];
        
        allGangguan.forEach(gangguan => {
            const item = document.createElement('div');
            item.className = 'gangguan-item';
            item.innerHTML = `
                <input type="checkbox" id="gangguan_${gangguan.id}" value="${gangguan.nama}" class="gangguan-checkbox">
                <label for="gangguan_${gangguan.id}" class="gangguan-label">
                    <div class="gangguan-icon" style="background-color: ${gangguan.color}; color: white;">
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
            
            // Add event listener
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
            alert('Nama gangguan harus diisi');
            return;
        }
        
        // Ikon berdasarkan kategori
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
        
        // Close modal
        gangguanModal.style.display = 'none';
        document.body.style.overflow = 'auto';
        
        alert('Gangguan baru berhasil ditambahkan!');
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
                // Validasi ukuran file
                if (file.size > 5 * 1024 * 1024) {
                    alert(`File ${file.name} terlalu besar. Maksimal 5MB.`);
                    return;
                }
                
                // Validasi tipe file
                if (!file.type.match('image.*')) {
                    alert(`File ${file.name} harus berupa gambar.`);
                    return;
                }
                
                // Add to uploaded photos
                const photoId = Date.now() + Math.random();
                uploadedPhotos.push({
                    id: photoId,
                    file: file,
                    url: URL.createObjectURL(file)
                });
                
                // Create preview
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
                    
                    // Add remove event
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
            
            // Reset input
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
            
            // Reset gangguan checkboxes
            document.querySelectorAll('.gangguan-checkbox').forEach(cb => {
                cb.checked = false;
            });
            
            // Reset sumber data
            sumberManualRadio.checked = true;
            
            // Reset date
            document.getElementById('tanggal').value = '{{ date('Y-m-d') }}';
            document.getElementById('waktu').value = '{{ date('H:i') }}';
            
            updateRainIndicator(0);
        }
    });
    
    // Simpan draft
    simpanDraftBtn.addEventListener('click', function() {
        // Simpan ke localStorage
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
    
    // Load draft jika ada
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
                
                // Trigger change events
                ladangSelect.dispatchEvent(new Event('change'));
                if (draft.sumber_data === 'api') {
                    sumberApiRadio.dispatchEvent(new Event('change'));
                }
                
                // Set gangguan
                selectedGangguan = draft.gangguan || [];
                document.querySelectorAll('.gangguan-checkbox').forEach(cb => {
                    cb.checked = selectedGangguan.includes(cb.value);
                });
                
                updateRainIndicator(parseFloat(draft.curah_hujan) || 0);
                
                alert('Draft berhasil dimuat! Terakhir disimpan: ' + new Date(draft.last_saved).toLocaleString());
            }
        }
    }
    
    // Load draft saat halaman dimuat
    setTimeout(loadDraft, 1000);
    
    // Submit form
    weatherForm.addEventListener('submit', function(e) {
        e.preventDefault();
        
        // Validasi
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
        
        // Simpan laporan
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
        
        // Reset gangguan checkboxes
        document.querySelectorAll('.gangguan-checkbox').forEach(cb => {
            cb.checked = false;
        });
        
        // Reset sumber data
        sumberManualRadio.checked = true;
        
        // Reset date
        document.getElementById('tanggal').value = '{{ date('Y-m-d') }}';
        document.getElementById('waktu').value = '{{ date('H:i') }}';
        
        updateRainIndicator(0);
        
        // Update table
        loadReportTable();
        
        // Clear localStorage draft
        localStorage.removeItem('weatherDraft');
        
        // Show success
        showSuccess(`Laporan cuaca berhasil disimpan! ID: ${newReport.id}`);
        
        // Scroll to top
        window.scrollTo({ top: 0, behavior: 'smooth' });
    });
    
    // Show success message
    function showSuccess(message) {
        successMessage.textContent = message;
        successAlert.style.display = 'flex';
        errorAlert.style.display = 'none';
        
        setTimeout(() => {
            successAlert.style.display = 'none';
        }, 5000);
    }
    
    // Show error message
    function showError(message) {
        errorMessage.textContent = message;
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
                
                // Format tanggal
                const tanggal = new Date(report.tanggal);
                const formattedDate = tanggal.toLocaleDateString('id-ID', {
                    day: '2-digit',
                    month: 'short',
                    year: 'numeric'
                });
                
                row.innerHTML = `
                    <td style="padding: 12px; color: var(--text-light);">${globalIndex}</td>
                    <td style="padding: 12px;">
                        <div style="font-weight: 600; color: var(--text-dark);">${report.ladang_nama}</div>
                    </td>
                    <td style="padding: 12px; color: var(--text-light);">${formattedDate}</td>
                    <td style="padding: 12px;">
                        <div style="font-weight: 600; color: ${getRainColor(report.curah_hujan)};">${report.curah_hujan} mm</div>
                    </td>
                    <td style="padding: 12px; color: var(--text-light); font-size: 13px;">
                        ${report.gangguan.slice(0, 2).join(', ')}${report.gangguan.length > 2 ? '...' : ''}
                    </td>
                    <td style="padding: 12px;">
                        <span style="padding: 4px 8px; border-radius: 4px; font-size: 12px; font-weight: 600; background-color: ${report.sumber_data === 'api' ? '#E3F2FD' : '#FFF3E0'}; color: ${report.sumber_data === 'api' ? '#1565C0' : '#EF6C00'};">
                            ${report.sumber_data === 'api' ? 'API' : 'Manual'}
                        </span>
                    </td>
                    <td style="padding: 12px;">
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
        
        // Update counts
        document.getElementById('showingCount').textContent = pageData.length;
        document.getElementById('totalCount').textContent = weatherReports.length;
        
        // Update pagination
        updatePagination();
        
        // Add event listeners
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
        const paginationContainer = document.querySelector('.btn-pagination.page').parentNode;
        
        // Clear existing page buttons
        const existingPages = pagination
            // Create page buttons
    for (let i = 1; i <= totalPages; i++) {
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
            loadReportTable();
        });
        
        paginationContainer.insertBefore(pageBtn, document.querySelector('.btn-pagination.next'));
    }
    
    // Update prev/next buttons
    const prevBtn = document.querySelector('.btn-pagination.prev');
    const nextBtn = document.querySelector('.btn-pagination.next');
    
    prevBtn.disabled = currentPage === 1;
    nextBtn.disabled = currentPage === totalPages;
    
    prevBtn.style.opacity = currentPage === 1 ? '0.5' : '1';
    nextBtn.style.opacity = currentPage === totalPages ? '0.5' : '1';
}

// Add report action listeners
function addReportActionListeners() {
    // View buttons
    document.querySelectorAll('.btn-action.btn-view').forEach(btn => {
        btn.addEventListener('click', function() {
            const reportId = parseInt(this.dataset.id);
            const report = weatherReports.find(r => r.id === reportId);
            
            if (report) {
                showReportDetail(report);
            }
        });
    });
    
    // Edit buttons
    document.querySelectorAll('.btn-action.btn-edit').forEach(btn => {
        btn.addEventListener('click', function() {
            const reportId = parseInt(this.dataset.id);
            const report = weatherReports.find(r => r.id === reportId);
            
            if (report) {
                editReport(report);
            }
        });
    });
    
    // Delete buttons
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
    const modal = document.createElement('div');
    modal.className = 'modal-overlay';
    modal.style.display = 'flex';
    modal.style.zIndex = '1000';
    modal.style.position = 'fixed';
    modal.style.top = '0';
    modal.style.left = '0';
    modal.style.right = '0';
    modal.style.bottom = '0';
    modal.style.backgroundColor = 'rgba(0,0,0,0.5)';
    modal.style.alignItems = 'center';
    modal.style.justifyContent = 'center';
    modal.style.padding = '20px';
    
    // Format tanggal
    const tanggal = new Date(report.tanggal);
    const formattedDate = tanggal.toLocaleDateString('id-ID', {
        weekday: 'long',
        year: 'numeric',
        month: 'long',
        day: 'numeric'
    });
    
    modal.innerHTML = `
        <div class="modal-content" style="background: white; border-radius: 12px; max-width: 600px; width: 100%; max-height: 90vh; overflow-y: auto;">
            <div class="modal-header" style="display: flex; justify-content: space-between; align-items: center; padding: 20px; border-bottom: 1px solid var(--border);">
                <h3 style="margin: 0; color: var(--text-dark);">Detail Laporan Cuaca</h3>
                <button type="button" class="close-modal" style="background: none; border: none; font-size: 20px; color: var(--text-light); cursor: pointer;">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <div class="modal-body" style="padding: 20px;">
                <div style="margin-bottom: 25px;">
                    <div style="font-size: 18px; font-weight: 700; color: var(--text-dark); margin-bottom: 5px;">${report.ladang_nama}</div>
                    <div style="color: var(--text-light); font-size: 14px;">${formattedDate} ${report.waktu !== '00:00' ? '• ' + report.waktu : ''}</div>
                </div>
                
                <div style="display: grid; grid-template-columns: repeat(2, 1fr); gap: 20px; margin-bottom: 25px;">
                    <div style="background-color: var(--bg-light); padding: 15px; border-radius: 8px;">
                        <div style="color: var(--text-light); font-size: 12px; margin-bottom: 5px;">Curah Hujan</div>
                        <div style="font-size: 24px; font-weight: 700; color: ${getRainColor(report.curah_hujan)};">${report.curah_hujan} mm</div>
                    </div>
                    <div style="background-color: var(--bg-light); padding: 15px; border-radius: 8px;">
                        <div style="color: var(--text-light); font-size: 12px; margin-bottom: 5px;">Sumber Data</div>
                        <div style="font-size: 24px; font-weight: 700; color: var(--text-dark);">
                            <span style="padding: 4px 12px; border-radius: 20px; font-size: 14px; background-color: ${report.sumber_data === 'api' ? '#E3F2FD' : '#FFF3E0'}; color: ${report.sumber_data === 'api' ? '#1565C0' : '#EF6C00'};">${report.sumber_data === 'api' ? 'API BMKG' : 'Input Manual'}</span>
                        </div>
                    </div>
                </div>
                
                ${report.gangguan.length > 0 ? `
                <div style="margin-bottom: 25px;">
                    <div style="font-weight: 600; color: var(--text-dark); margin-bottom: 10px;">Gangguan yang Dilaporkan</div>
                    <div style="display: flex; flex-wrap: wrap; gap: 8px;">
                        ${report.gangguan.map(g => `
                            <span style="padding: 6px 12px; background-color: var(--primary-lighter); color: var(--primary); border-radius: 20px; font-size: 13px;">
                                <i class="fas fa-exclamation-triangle" style="margin-right: 5px;"></i>${g}
                            </span>
                        `).join('')}
                    </div>
                </div>
                ` : ''}
                
                ${report.catatan ? `
                <div style="margin-bottom: 25px;">
                    <div style="font-weight: 600; color: var(--text-dark); margin-bottom: 10px;">Catatan</div>
                    <div style="background-color: var(--bg-light); padding: 15px; border-radius: 8px; font-size: 14px; line-height: 1.6;">
                        ${report.catatan}
                    </div>
                </div>
                ` : ''}
                
                ${report.foto && report.foto.length > 0 ? `
                <div style="margin-bottom: 25px;">
                    <div style="font-weight: 600; color: var(--text-dark); margin-bottom: 10px;">Foto Dokumentasi</div>
                    <div style="display: flex; gap: 10px; overflow-x: auto; padding-bottom: 10px;">
                        ${report.foto.map(foto => `
                            <div style="min-width: 150px; height: 150px; border-radius: 8px; overflow: hidden; border: 2px solid var(--border);">
                                <div style="width: 100%; height: 100%; background-color: var(--bg-light); display: flex; align-items: center; justify-content: center; color: var(--text-light);">
                                    <i class="fas fa-image" style="font-size: 32px;"></i>
                                </div>
                            </div>
                        `).join('')}
                    </div>
                </div>
                ` : ''}
                
                <div style="color: var(--text-light); font-size: 12px; text-align: right;">
                    Dibuat: ${new Date(report.created_at).toLocaleString('id-ID')}
                </div>
            </div>
            <div class="modal-footer" style="padding: 20px; border-top: 1px solid var(--border); display: flex; gap: 10px;">
                <button type="button" class="btn btn-print" style="flex: 1; padding: 10px; background-color: var(--bg-light); color: var(--text-dark); border: none; border-radius: 8px; cursor: pointer;">
                    <i class="fas fa-print"></i> Cetak Laporan
                </button>
                <button type="button" class="btn btn-close-modal" style="flex: 1; padding: 10px; background-color: var(--primary); color: white; border: none; border-radius: 8px; cursor: pointer;">
                    Tutup
                </button>
            </div>
        </div>
    `;
    
    document.body.appendChild(modal);
    document.body.style.overflow = 'hidden';
    
    // Close modal
    modal.querySelector('.close-modal').addEventListener('click', closeModal);
    modal.querySelector('.btn-close-modal').addEventListener('click', closeModal);
    modal.addEventListener('click', function(e) {
        if (e.target === modal) {
            closeModal();
        }
    });
    
    // Print button
    modal.querySelector('.btn-print').addEventListener('click', function() {
        alert('Fitur cetak akan tersedia segera!');
    });
    
    function closeModal() {
        document.body.removeChild(modal);
        document.body.style.overflow = 'auto';
    }
}

// Edit report
function editReport(report) {
    // Isi form dengan data laporan
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
    
    // Set gangguan
    selectedGangguan = [...report.gangguan];
    document.querySelectorAll('.gangguan-checkbox').forEach(cb => {
        cb.checked = selectedGangguan.includes(cb.value);
    });
    
    // Trigger update
    ladangSelect.dispatchEvent(new Event('change'));
    updateRainIndicator(report.curah_hujan);
    updateRecommendation(report.curah_hujan);
    
    // Hapus laporan lama
    weatherReports = weatherReports.filter(r => r.id !== report.id);
    
    // Update tabel
    loadReportTable();
    
    // Scroll ke form
    document.querySelector('.content-card').scrollIntoView({ behavior: 'smooth' });
    
    showSuccess('Laporan dimuat untuk diedit. Silakan perbarui data dan simpan kembali.');
}

// Pagination prev/next
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
    
    // Simulasi sinkronisasi
    setTimeout(() => {
        // Simulasikan update data cuaca terkini
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
    // Simulasi export
    this.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Menyiapkan...';
    
    setTimeout(() => {
        // Simulasi download
        const dataStr = JSON.stringify(weatherReports, null, 2);
        const dataBlob = new Blob([dataStr], { type: 'application/json' });
        
        // Simpan sebagai file
        const link = document.createElement('a');
        link.href = URL.createObjectURL(dataBlob);
        link.download = `laporan-cuaca-${new Date().toISOString().split('T')[0]}.json`;
        link.click();
        
        this.innerHTML = '<i class="fas fa-file-export"></i> Export Laporan';
        
        showSuccess('Laporan berhasil diexport! File telah didownload.');
    }, 1000);
});

// Simulasi data BMKG (untuk demo)
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