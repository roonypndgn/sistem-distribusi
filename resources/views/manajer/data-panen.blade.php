@extends('layouts.manajer')

@section('title', 'Input Data Panen - Dashboard Manajer Lapangan')

@section('page-title', 'Input Data Panen')
@section('page-subtitle', 'Sistem Pendataan Jeruk Berastagi')

@section('content')
<div class="content-wrapper">
    <!-- Header dengan navigasi cepat -->
    <div class="content-header" style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 30px;">
        <div>
            <h1 style="font-size: 24px; font-weight: 700; color: var(--text-dark); margin-bottom: 5px;">Input Data Panen Jeruk</h1>
            <p style="color: var(--text-light); font-size: 14px;">Lengkapi form berikut untuk mencatat hasil panen harian</p>
        </div>
        
        <div style="display: flex; gap: 10px;">
            <a href="#" class="btn" style="background-color: var(--bg-light); color: var(--text-light);">
                <i class="fas fa-history"></i> Riwayat Panen
            </a>
            <a href="#" class="btn btn-primary">
                <i class="fas fa-file-export"></i> Export Data
            </a>
        </div>
    </div>
    
    <!-- Notifikasi -->
    <div class="notification-card" style="background-color: var(--primary-lighter); border: 1px solid var(--primary); border-radius: 12px; padding: 16px; margin-bottom: 30px; display: flex; align-items: center; gap: 15px;">
        <div style="width: 40px; height: 40px; background-color: var(--primary); border-radius: 10px; display: flex; align-items: center; justify-content: center; color: white; font-size: 18px;">
            <i class="fas fa-info-circle"></i>
        </div>
        <div style="flex: 1;">
            <h3 style="font-weight: 600; color: var(--text-dark); margin-bottom: 5px; font-size: 15px;">Panduan Pengisian Form Panen</h3>
            <p style="color: var(--text-light); font-size: 14px;">Pastikan data yang diinput sesuai dengan kondisi lapangan. Data panen akan langsung tersimpan dan tidak dapat diubah setelah diverifikasi.</p>
        </div>
    </div>
    
    <!-- Form Input Data Panen -->
    <div class="content-grid">
        <!-- Form Utama -->
        <div class="content-card" style="grid-column: span 2;">
            <div class="card-title">
                <span>Form Input Data Panen Jeruk</span>
                <div class="card-icon">
                    <i class="fas fa-orange"></i>
                </div>
            </div>
            
            <form id="panenForm" action="#" method="POST">
                <div style="display: grid; grid-template-columns: repeat(2, 1fr); gap: 20px;">
                    <!-- Kolom Kiri -->
                    <div>
                        <div class="form-group">
                        <label class="form-label" for="batch_panen">
                            ID Pembelian <span style="color: red;">*</span>
                        </label>
                        
                        <select class="form-control" id="batch_panen" name="batch_panen" required>
                            <option value="" disabled selected>-- Pilih ID Pembelian --</option>
                            <option value="PNH-2024-08-001">BLI-2026-08-001</option>
                            <option value="PNH-2024-08-002">BLI-2026-08-002</option>
                            <option value="PNH-2024-08-003">BLI-2026-08-003</option>
                        </select>
                        
                        <small style="color: #666; font-size: 12px; margin-top: 5px; display: block;">
                            Pilih ID yang sesuai dengan batch panen hari ini.
                        </small>
                    </div>
                        <!-- Batch Panen -->
                        <div class="form-group">
                            <label class="form-label" for="batch_panen">
                                Batch Panen <span style="color: var(--danger);">*</span>
                            </label>
                            <div style="position: relative;">
                                <input 
                                    type="text" 
                                    class="form-control" 
                                    id="batch_panen" 
                                    name="batch_panen" 
                                    placeholder="Contoh: PNH-2024-08-001"
                                    required
                                >
                                <div style="position: absolute; right: 12px; top: 50%; transform: translateY(-50%); color: var(--text-light); font-size: 12px;">
                                    <i class="fas fa-hashtag"></i>
                                </div>
                            </div>
                            <small style="color: var(--text-light); font-size: 12px; margin-top: 5px; display: block;">
                                Format: PNH-tanggal-nomor urut
                            </small>
                        </div>
                        
                        <!-- Tanggal Panen -->
                        <div class="form-group">
                            <label class="form-label" for="tanggal_panen">
                                Tanggal & Waktu Panen <span style="color: var(--danger);">*</span>
                            </label>
                            <div style="display: grid; grid-template-columns: 1fr auto; gap: 10px;">
                                <input 
                                    type="date" 
                                    class="form-control" 
                                    id="tanggal_panen_date" 
                                    name="tanggal_panen_date" 
                                    value="{{ date('Y-m-d') }}"
                                    required
                                >
                                <input 
                                    type="time" 
                                    class="form-control" 
                                    id="tanggal_panen_time" 
                                    name="tanggal_panen_time" 
                                    value="{{ date('H:i') }}"
                                    required
                                >
                            </div>
                        </div>
                        
                        <!-- Kualitas Jeruk -->
                        <div class="form-group">
                            <label class="form-label" for="kualitas_jeruk">
                                Kualitas Jeruk <span style="color: var(--danger);">*</span>
                            </label>
                            <div class="kualitas-options" style="display: flex; gap: 10px; margin-top: 5px;">
                                <label class="kualitas-option" style="flex: 1; text-align: center; cursor: pointer;">
                                    <input type="radio" name="kualitas_jeruk" value="A" class="kualitas-radio" style="display: none;" checked>
                                    <div class="option-card" style="padding: 15px; border: 2px solid var(--border); border-radius: 10px; transition: var(--transition);">
                                        <div style="font-size: 24px; color: #4CAF50; margin-bottom: 8px;">
                                            <i class="fas fa-star"></i>
                                        </div>
                                        <div style="font-weight: 600; color: var(--text-dark);">Kualitas A</div>
                                        <div style="font-size: 12px; color: var(--text-light);">Premium</div>
                                    </div>
                                </label>
                                
                                <label class="kualitas-option" style="flex: 1; text-align: center; cursor: pointer;">
                                    <input type="radio" name="kualitas_jeruk" value="B" class="kualitas-radio" style="display: none;">
                                    <div class="option-card" style="padding: 15px; border: 2px solid var(--border); border-radius: 10px; transition: var(--transition);">
                                        <div style="font-size: 24px; color: #FF9800; margin-bottom: 8px;">
                                            <i class="fas fa-star-half-alt"></i>
                                        </div>
                                        <div style="font-weight: 600; color: var(--text-dark);">Kualitas B</div>
                                        <div style="font-size: 12px; color: var(--text-light);">Standar</div>
                                    </div>
                                </label>
                                
                                <label class="kualitas-option" style="flex: 1; text-align: center; cursor: pointer;">
                                    <input type="radio" name="kualitas_jeruk" value="C" class="kualitas-radio" style="display: none;">
                                    <div class="option-card" style="padding: 15px; border: 2px solid var(--border); border-radius: 10px; transition: var(--transition);">
                                        <div style="font-size: 24px; color: #F44336; margin-bottom: 8px;">
                                            <i class="fas fa-star"></i>
                                        </div>
                                        <div style="font-weight: 600; color: var(--text-dark);">Kualitas C</div>
                                        <div style="font-size: 12px; color: var(--text-light);">Ekonomis</div>
                                    </div>
                                </label>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Kolom Kanan -->
                    <div>
                        <!-- Lokasi GPS -->
                        <div class="form-group">
                            <label class="form-label" for="lokasi_gps">
                                Lokasi GPS <span style="color: var(--danger);">*</span>
                            </label>
                            <div style="display: flex; gap: 10px;">
                                <input 
                                    type="text" 
                                    class="form-control" 
                                    id="lokasi_gps" 
                                    name="lokasi_gps" 
                                    placeholder="Contoh: 3.182471, 98.509331"
                                    required
                                >
                                <button type="button" id="getLocationBtn" class="btn" style="background-color: var(--primary-lighter); color: var(--primary); white-space: nowrap;">
                                    <i class="fas fa-map-marker-alt"></i> Ambil Lokasi
                                </button>
                            </div>
                            <small style="color: var(--text-light); font-size: 12px; margin-top: 5px; display: block;">
                                Format: Latitude, Longitude
                            </small>
                        </div>
                        
                        <!-- Peta Mini -->
                        <div class="form-group">
                            <div style="height: 180px; background-color: #e9f5eb; border-radius: 10px; overflow: hidden; position: relative; border: 1px solid var(--border);">
                                <div style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; display: flex; flex-direction: column; align-items: center; justify-content: center; color: var(--text-light);">
                                    <i class="fas fa-map" style="font-size: 40px; margin-bottom: 10px; color: var(--primary); opacity: 0.5;"></i>
                                    <p style="font-size: 14px;">Peta akan muncul setelah lokasi diinput</p>
                                </div>
                                <!-- Di sini bisa diisi dengan peta sebenarnya jika diperlukan -->
                                <div id="miniMap" style="width: 100%; height: 100%; display: none;"></div>
                            </div>
                        </div>
                        
                        <!-- Status Form -->
                        <div class="form-group">
                            <div style="background-color: var(--bg-light); padding: 15px; border-radius: 10px;">
                                <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 10px;">
                                    <span style="font-weight: 600; color: var(--text-dark);">Status Form</span>
                                    <span class="status-badge status-pending">Draft</span>
                                </div>
                                <div style="font-size: 13px; color: var(--text-light);">
                                    <i class="fas fa-clock" style="margin-right: 5px;"></i>
                                    Form belum disimpan. Pastikan semua data sudah benar sebelum submit.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Tombol Aksi -->
                <div style="margin-top: 30px; padding-top: 20px; border-top: 1px solid var(--border); display: flex; justify-content: space-between; align-items: center;">
                    <div style="display: flex; gap: 10px;">
                        <button type="button" id="saveDraftBtn" class="btn" style="background-color: var(--bg-light); color: var(--text-light);">
                            <i class="fas fa-save"></i> Simpan Draft
                        </button>
                        <button type="button" id="resetFormBtn" class="btn" style="background-color: #FFEBEE; color: var(--danger);">
                            <i class="fas fa-redo"></i> Reset Form
                        </button>
                    </div>
                    
                    <div style="display: flex; gap: 10px;">
                        <button type="button" id="previewBtn" class="btn" style="background-color: var(--primary-lighter); color: var(--primary);">
                            <i class="fas fa-eye"></i> Preview
                        </button>
                        <button type="submit" id="submitFormBtn" class="btn btn-success">
                            <i class="fas fa-paper-plane"></i> Submit Data Panen
                        </button>
                    </div>
                </div>
            </form>
        </div>
        
        <!-- Sidebar Kanan: Informasi dan Panduan -->
        <div class="content-card">
            <div class="card-title">
                <span>Informasi Tambahan</span>
                <div class="card-icon">
                    <i class="fas fa-info-circle"></i>
                </div>
            </div>
            
            <!-- Informasi Petani -->
            <div style="background-color: var(--primary-lighter); border-radius: 10px; padding: 16px; margin-bottom: 20px;">
                <div style="display: flex; align-items: center; gap: 12px; margin-bottom: 10px;">
                    <div style="width: 40px; height: 40px; background-color: var(--primary); border-radius: 8px; display: flex; align-items: center; justify-content: center; color: white;">
                        <i class="fas fa-user"></i>
                    </div>
                    <div>
                        <div style="font-weight: 600; color: var(--text-dark);">Petani Terkait</div>
                        <div style="font-size: 14px; color: var(--text-light);">Ditemukan otomatis dari lokasi</div>
                    </div>
                </div>
                <div id="petaniInfo" style="font-size: 13px; color: var(--text-light); text-align: center; padding: 10px;">
                    <i class="fas fa-search-location"></i> Input lokasi untuk menemukan petani
                </div>
            </div>
            
            <!-- Panduan Kualitas -->
            <div style="margin-bottom: 20px;">
                <h4 style="font-weight: 600; color: var(--text-dark); margin-bottom: 12px; font-size: 15px;">
                    <i class="fas fa-clipboard-check" style="margin-right: 8px; color: var(--primary);"></i>
                    Panduan Kualitas Jeruk
                </h4>
                
                <div style="display: flex; flex-direction: column; gap: 10px;">
                    <div style="display: flex; align-items: center; gap: 10px; padding: 8px; background-color: #E8F5E9; border-radius: 8px;">
                        <div style="width: 8px; height: 8px; background-color: #4CAF50; border-radius: 50%;"></div>
                        <div style="flex: 1;">
                            <div style="font-weight: 600; color: var(--text-dark); font-size: 13px;">Kualitas A (Premium)</div>
                            <div style="font-size: 12px; color: var(--text-light);">Diameter > 7cm, warna seragam, tanpa cacat</div>
                        </div>
                    </div>
                    
                    <div style="display: flex; align-items: center; gap: 10px; padding: 8px; background-color: #FFF3E0; border-radius: 8px;">
                        <div style="width: 8px; height: 8px; background-color: #FF9800; border-radius: 50%;"></div>
                        <div style="flex: 1;">
                            <div style="font-weight: 600; color: var(--text-dark); font-size: 13px;">Kualitas B (Standar)</div>
                            <div style="font-size: 12px; color: var(--text-light);">Diameter 5-7cm, warna cukup seragam, maks 10% cacat</div>
                        </div>
                    </div>
                    
                    <div style="display: flex; align-items: center; gap: 10px; padding: 8px; background-color: #FFEBEE; border-radius: 8px;">
                        <div style="width: 8px; height: 8px; background-color: #F44336; border-radius: 50%;"></div>
                        <div style="flex: 1;">
                            <div style="font-weight: 600; color: var(--text-dark); font-size: 13px;">Kualitas C (Ekonomis)</div>
                            <div style="font-size: 12px; color: var(--text-light);">Diameter < 5cm, warna tidak seragam, cacat > 10%</div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Statistik Cepat -->
            <div>
                <h4 style="font-weight: 600; color: var(--text-dark); margin-bottom: 12px; font-size: 15px;">
                    <i class="fas fa-chart-line" style="margin-right: 8px; color: var(--secondary);"></i>
                    Statistik Panen Bulan Ini
                </h4>
                
                <div style="display: flex; flex-direction: column; gap: 12px;">
                    <div style="display: flex; justify-content: space-between; align-items: center;">
                        <div style="font-size: 13px; color: var(--text-light);">Total Batch</div>
                        <div style="font-weight: 700; color: var(--text-dark);">24</div>
                    </div>
                    
                    <div style="display: flex; justify-content: space-between; align-items: center;">
                        <div style="font-size: 13px; color: var(--text-light);">Kualitas A</div>
                        <div style="font-weight: 700; color: #4CAF50;">12</div>
                    </div>
                    
                    <div style="display: flex; justify-content: space-between; align-items: center;">
                        <div style="font-size: 13px; color: var(--text-light);">Kualitas B</div>
                        <div style="font-weight: 700; color: #FF9800;">8</div>
                    </div>
                    
                    <div style="display: flex; justify-content: space-between; align-items: center;">
                        <div style="font-size: 13px; color: var(--text-light);">Kualitas C</div>
                        <div style="font-weight: 700; color: #F44336;">4</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Preview Modal -->
    <div class="modal-overlay" id="previewModal" style="display: none;">
        <div class="modal-content" style="max-width: 600px;">
            <div class="modal-header">
                <h3 class="modal-title">Preview Data Panen</h3>
                <button type="button" class="close-modal" style="background: none; border: none; color: var(--text-light); cursor: pointer; font-size: 18px;">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <div class="modal-body">
                <div id="previewContent" style="display: flex; flex-direction: column; gap: 20px;">
                    <!-- Preview akan diisi oleh JavaScript -->
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn" id="closePreviewBtn">Tutup</button>
                <button type="button" class="btn btn-primary" id="confirmSubmitBtn">Konfirmasi & Submit</button>
            </div>
        </div>
    </div>
</div>

<style>
    /* Style untuk pilihan kualitas */
    .kualitas-option input:checked + .option-card {
        border-color: var(--primary);
        background-color: var(--primary-lighter);
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.08);
    }
    
    /* Style untuk preview */
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
    
    .kualitas-badge {
        display: inline-block;
        padding: 4px 10px;
        border-radius: 6px;
        font-size: 12px;
        font-weight: 600;
    }
    
    .kualitas-a {
        background-color: #E8F5E9;
        color: #2E7D32;
    }
    
    .kualitas-b {
        background-color: #FFF3E0;
        color: #EF6C00;
    }
    
    .kualitas-c {
        background-color: #FFEBEE;
        color: #C62828;
    }
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Handler untuk pilihan kualitas
    const kualitasOptions = document.querySelectorAll('.kualitas-option');
    kualitasOptions.forEach(option => {
        option.addEventListener('click', function() {
            // Hapus selected dari semua option
            kualitasOptions.forEach(opt => {
                opt.querySelector('.option-card').style.borderColor = 'var(--border)';
                opt.querySelector('.option-card').style.backgroundColor = 'white';
                opt.querySelector('.option-card').style.transform = 'translateY(0)';
                opt.querySelector('.option-card').style.boxShadow = 'none';
            });
            
            // Tandai yang dipilih
            const card = this.querySelector('.option-card');
            card.style.borderColor = 'var(--primary)';
            card.style.backgroundColor = 'var(--primary-lighter)';
            card.style.transform = 'translateY(-2px)';
            card.style.boxShadow = '0 4px 8px rgba(0, 0, 0, 0.08)';
            
            // Check radio button yang sesuai
            this.querySelector('.kualitas-radio').checked = true;
        });
    });
    
    // Handler untuk tombol ambil lokasi
    const getLocationBtn = document.getElementById('getLocationBtn');
    const lokasiGpsInput = document.getElementById('lokasi_gps');
    
    if (getLocationBtn) {
        getLocationBtn.addEventListener('click', function() {
            if (navigator.geolocation) {
                this.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Mendeteksi...';
                this.disabled = true;
                
                navigator.geolocation.getCurrentPosition(
                    function(position) {
                        const lat = position.coords.latitude.toFixed(6);
                        const lng = position.coords.longitude.toFixed(6);
                        lokasiGpsInput.value = `${lat}, ${lng}`;
                        
                        // Update petani info
                        const petaniInfo = document.getElementById('petaniInfo');
                        petaniInfo.innerHTML = `
                            <div style="text-align: left;">
                                <div style="font-weight: 600; color: var(--text-dark); margin-bottom: 5px;">Sukardi (ID: PTN-042)</div>
                                <div style="font-size: 12px; color: var(--text-light); margin-bottom: 5px;">Kebun Jeruk Berastagi</div>
                                <div style="font-size: 11px; color: var(--primary);">Luas: 2.5 Ha | 150 Pohon</div>
                            </div>
                        `;
                        
                        // Tampilkan peta mini
                        const miniMap = document.getElementById('miniMap');
                        const mapPlaceholder = miniMap.previousElementSibling;
                        mapPlaceholder.style.display = 'none';
                        miniMap.style.display = 'block';
                        miniMap.innerHTML = `
                            <div style="width: 100%; height: 100%; background: linear-gradient(135deg, #a5d6a7 0%, #81c784 100%); display: flex; align-items: center; justify-content: center; color: white; font-weight: 600;">
                                <div style="text-align: center;">
                                    <i class="fas fa-map-marker-alt" style="font-size: 30px; margin-bottom: 10px;"></i>
                                    <div>Lokasi: ${lat}, ${lng}</div>
                                </div>
                            </div>
                        `;
                        
                        getLocationBtn.innerHTML = '<i class="fas fa-map-marker-alt"></i> Ambil Lokasi';
                        getLocationBtn.disabled = false;
                    },
                    function(error) {
                        alert('Gagal mendapatkan lokasi. Pastikan izin lokasi diaktifkan.');
                        lokasiGpsInput.value = '3.182471, 98.509331'; // Default lokasi
                        
                        getLocationBtn.innerHTML = '<i class="fas fa-map-marker-alt"></i> Ambil Lokasi';
                        getLocationBtn.disabled = false;
                    }
                );
            } else {
                alert('Browser tidak mendukung geolocation.');
                lokasiGpsInput.value = '3.182471, 98.509331'; // Default lokasi
            }
        });
    }
    
    // Handler untuk reset form
    const resetFormBtn = document.getElementById('resetFormBtn');
    if (resetFormBtn) {
        resetFormBtn.addEventListener('click', function() {
            if (confirm('Apakah Anda yakin ingin mereset form? Semua data yang telah diisi akan hilang.')) {
                document.getElementById('panenForm').reset();
                
                // Reset kualitas option
                kualitasOptions.forEach(option => {
                    const card = option.querySelector('.option-card');
                    card.style.borderColor = 'var(--border)';
                    card.style.backgroundColor = 'white';
                    card.style.transform = 'translateY(0)';
                    card.style.boxShadow = 'none';
                });
                
                // Set kualitas A sebagai default
                kualitasOptions[0].querySelector('.kualitas-radio').checked = true;
                kualitasOptions[0].querySelector('.option-card').style.borderColor = 'var(--primary)';
                kualitasOptions[0].querySelector('.option-card').style.backgroundColor = 'var(--primary-lighter)';
                kualitasOptions[0].querySelector('.option-card').style.transform = 'translateY(-2px)';
                kualitasOptions[0].querySelector('.option-card').style.boxShadow = '0 4px 8px rgba(0, 0, 0, 0.08)';
                
                // Reset info petani
                const petaniInfo = document.getElementById('petaniInfo');
                petaniInfo.innerHTML = '<i class="fas fa-search-location"></i> Input lokasi untuk menemukan petani';
                
                // Reset peta mini
                const miniMap = document.getElementById('miniMap');
                const mapPlaceholder = miniMap.previousElementSibling;
                mapPlaceholder.style.display = 'flex';
                miniMap.style.display = 'none';
                
                alert('Form berhasil direset.');
            }
        });
    }
    
    // Handler untuk preview
    const previewBtn = document.getElementById('previewBtn');
    const previewModal = document.getElementById('previewModal');
    const closePreviewBtn = document.getElementById('closePreviewBtn');
    const closeModalBtn = document.querySelector('.close-modal');
    
    if (previewBtn) {
        previewBtn.addEventListener('click', function() {
            // Validasi form terlebih dahulu
            const batch = document.getElementById('batch_panen').value;
            const tanggalDate = document.getElementById('tanggal_panen_date').value;
            const tanggalTime = document.getElementById('tanggal_panen_time').value;
            const lokasi = document.getElementById('lokasi_gps').value;
            const kualitas = document.querySelector('input[name="kualitas_jeruk"]:checked')?.value;
            
            if (!batch || !tanggalDate || !tanggalTime || !lokasi || !kualitas) {
                alert('Harap lengkapi semua field yang wajib diisi sebelum preview.');
                return;
            }
            
            // Format tanggal
            const tanggal = new Date(`${tanggalDate}T${tanggalTime}`);
            const formattedDate = tanggal.toLocaleDateString('id-ID', {
                weekday: 'long',
                year: 'numeric',
                month: 'long',
                day: 'numeric',
                hour: '2-digit',
                minute: '2-digit'
            });
            
            // Tentukan kelas badge kualitas
            let kualitasClass = '';
            let kualitasText = '';
            
            switch(kualitas) {
                case 'A':
                    kualitasClass = 'kualitas-a';
                    kualitasText = 'Kualitas A (Premium)';
                    break;
                case 'B':
                    kualitasClass = 'kualitas-b';
                    kualitasText = 'Kualitas B (Standar)';
                    break;
                case 'C':
                    kualitasClass = 'kualitas-c';
                    kualitasText = 'Kualitas C (Ekonomis)';
                    break;
            }
            
            // Isi preview content
            const previewContent = document.getElementById('previewContent');
            previewContent.innerHTML = `
                <div class="preview-item">
                    <div class="preview-label">Batch Panen</div>
                    <div class="preview-value">${batch}</div>
                </div>
                <div class="preview-item">
                    <div class="preview-label">Tanggal Panen</div>
                    <div class="preview-value">${formattedDate}</div>
                </div>
                <div class="preview-item">
                    <div class="preview-label">Kualitas Jeruk</div>
                    <div class="preview-value">
                        <span class="kualitas-badge ${kualitasClass}">${kualitasText}</span>
                    </div>
                </div>
                <div class="preview-item">
                    <div class="preview-label">Lokasi GPS</div>
                    <div class="preview-value">${lokasi}</div>
                </div>
                <div class="preview-item">
                    <div class="preview-label">Petani Terkait</div>
                    <div class="preview-value">Sukardi (ID: PTN-042) - Kebun Jeruk Berastagi</div>
                </div>
                <div style="background-color: var(--primary-lighter); padding: 15px; border-radius: 10px; margin-top: 10px;">
                    <div style="display: flex; align-items: center; gap: 10px; margin-bottom: 10px;">
                        <i class="fas fa-info-circle" style="color: var(--primary);"></i>
                        <div style="font-weight: 600; color: var(--text-dark);">Informasi</div>
                    </div>
                    <div style="font-size: 13px; color: var(--text-light);">
                        Data panen akan dicatat dalam sistem dan tidak dapat diubah setelah disubmit. Pastikan semua data sudah benar.
                    </div>
                </div>
            `;
            
            // Tampilkan modal
            previewModal.style.display = 'flex';
            document.body.style.overflow = 'hidden';
        });
    }
    
    // Handler untuk menutup preview modal
    if (closePreviewBtn) {
        closePreviewBtn.addEventListener('click', function() {
            previewModal.style.display = 'none';
            document.body.style.overflow = 'auto';
        });
    }
    
    if (closeModalBtn) {
        closeModalBtn.addEventListener('click', function() {
            previewModal.style.display = 'none';
            document.body.style.overflow = 'auto';
        });
    }
    
    // Handler untuk confirm submit dari preview
    const confirmSubmitBtn = document.getElementById('confirmSubmitBtn');
    if (confirmSubmitBtn) {
        confirmSubmitBtn.addEventListener('click', function() {
            // Simulasi submit berhasil
            previewModal.style.display = 'none';
            document.body.style.overflow = 'auto';
            
            // Tampilkan notifikasi sukses
            alert('Data panen berhasil disimpan! Data telah dicatat dalam sistem.');
            
            // Reset form setelah submit berhasil
            document.getElementById('panenForm').reset();
            
            // Reset kualitas option
            kualitasOptions.forEach(option => {
                const card = option.querySelector('.option-card');
                card.style.borderColor = 'var(--border)';
                card.style.backgroundColor = 'white';
                card.style.transform = 'translateY(0)';
                card.style.boxShadow = 'none';
            });
            
            // Set kualitas A sebagai default
            kualitasOptions[0].querySelector('.kualitas-radio').checked = true;
            kualitasOptions[0].querySelector('.option-card').style.borderColor = 'var(--primary)';
            kualitasOptions[0].querySelector('.option-card').style.backgroundColor = 'var(--primary-lighter)';
            kualitasOptions[0].querySelector('.option-card').style.transform = 'translateY(-2px)';
            kualitasOptions[0].querySelector('.option-card').style.boxShadow = '0 4px 8px rgba(0, 0, 0, 0.08)';
        });
    }
    
    // Handler untuk save draft
    const saveDraftBtn = document.getElementById('saveDraftBtn');
    if (saveDraftBtn) {
        saveDraftBtn.addEventListener('click', function() {
            alert('Data berhasil disimpan sebagai draft. Anda dapat melanjutkan pengisian nanti.');
        });
    }
    
    // Handler untuk submit form langsung
    const submitFormBtn = document.getElementById('submitFormBtn');
    const panenForm = document.getElementById('panenForm');
    
    if (panenForm) {
        panenForm.addEventListener('submit', function(e) {
            e.preventDefault();
            
            // Validasi
            const batch = document.getElementById('batch_panen').value;
            const tanggalDate = document.getElementById('tanggal_panen_date').value;
            const tanggalTime = document.getElementById('tanggal_panen_time').value;
            const lokasi = document.getElementById('lokasi_gps').value;
            const kualitas = document.querySelector('input[name="kualitas_jeruk"]:checked')?.value;
            
            if (!batch || !tanggalDate || !tanggalTime || !lokasi || !kualitas) {
                alert('Harap lengkapi semua field yang wajib diisi.');
                return;
            }
            
            // Tampilkan preview modal sebagai konfirmasi
            previewBtn.click();
        });
    }
});
</script>
@endsection