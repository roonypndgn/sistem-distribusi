@extends('layouts.manajer')

@section('title', 'Input Harga Pembelian - PT. Mardua Holong')

@section('page-title', 'Input Harga Pembelian')
@section('page-subtitle', 'Berastagi')

@section('content')
<div class="content-grid">
    <div class="content-card" style="grid-column: span 2;">
        <div class="card-title">
            <span>Form Input Harga Pembelian Jeruk</span>
            <div class="card-icon">
                <i class="fas fa-money-bill-wave"></i>
            </div>
        </div>
        
        <!-- Success Alert (akan muncul setelah submit) -->
        <div id="successAlert" class="alert-success" style="display: none;">
            <i class="fas fa-check-circle"></i>
            <span>Data harga pembelian berhasil disimpan!</span>
        </div>
        
        <!-- Error Alert -->
        <div id="errorAlert" class="alert-error" style="display: none;">
            <i class="fas fa-exclamation-circle"></i>
            <span id="errorMessage"></span>
        </div>
        
        <form id="pembelianForm" method="POST" enctype="multipart/form-data">
            @csrf
            
            <!-- Tanggal Pembelian -->
            <div class="form-group">
                <label class="form-label">Tanggal Pembelian *</label>
                <div class="input-wrapper">
                    <i class="fas fa-calendar-alt input-icon"></i>
                    <input type="date" id="tanggal_beli" name="tanggal_beli" class="form-control" 
                           value="{{ date('Y-m-d') }}" required>
                </div>
                <small class="form-text">Format: DD-MM-YYYY</small>
            </div>
            
            <!-- Ladang -->
            <div class="form-group">
                <label class="form-label">Ladang *</label>
                <div class="input-wrapper">
                    <i class="fas fa-leaf input-icon"></i>
                    <select id="kualitas" name="kualitas" class="form-control" required>
                        <option value="">-- Pilih Ladang --</option>
                        <option value="Pending">Ladang Pandiangan</option>
                        <option value="Verifikasi">Ladang Siregar</option>
                        <option value="Reject">Ladang Silalahi</option>
                    </select>
                </div>
            </div>
            <!-- Harga per Kg -->
            <div class="form-group">
                <label class="form-label">Harga per Kg (Rp) *</label>
                <div class="input-wrapper">
                    <i class="fas fa-tag input-icon"></i>
                    <input type="number" id="harga_per_kg" name="harga_per_kg" class="form-control" 
                           placeholder="Contoh: 12000" min="1000" max="50000" required>
                </div>
                <small class="form-text">Harga antara Rp 1.000 - Rp 50.000 per kg</small>
            </div>
            
            <!-- Jumlah (Kg) -->
            <div class="form-group">
                <label class="form-label">Jumlah (Kg) *</label>
                <div class="input-wrapper">
                    <i class="fas fa-weight input-icon"></i>
                    <input type="number" id="jumlah_kg" name="jumlah_kg" class="form-control" 
                           placeholder="Contoh: 500" step="0.1" min="0.1" max="10000" required>
                </div>
                <small class="form-text">Maksimal 10.000 kg per transaksi</small>
            </div>
            
            <!-- Total Harga (Auto Calculate) -->
            <div class="form-group">
                <label class="form-label">Total Harga (Rp)</label>
                <div class="input-wrapper">
                    <i class="fas fa-calculator input-icon"></i>
                    <input type="text" id="total_harga" name="total_harga" class="form-control" 
                           readonly style="background-color: #f8f9fa; font-weight: bold;">
                </div>
            </div>
            
            <!-- Status Verifikasi -->
            <div class="form-group">
                <label class="form-label">Status Verifikasi *</label>
                <div class="input-wrapper">
                    <i class="fas fa-check input-icon"></i>
                    <select id="kualitas" name="kualitas" class="form-control" required>
                        <option value="">-- Pilih Status --</option>
                        <option value="Pending">Pending</option>
                        <option value="Verifikasi">Verifikasi</option>
                        <option value="Reject">Reject</option>
                    </select>
                </div>
            </div>
            <!-- Upload Bukti Pembelian -->
            <div class="form-group">
                <label class="form-label">Upload Bukti Pembelian</label>
                <div class="file-upload-area" id="fileUploadArea">
                    <div class="file-upload-content">
                        <i class="fas fa-cloud-upload-alt"></i>
                        <p>Klik untuk upload foto kwitansi/faktur</p>
                        <small>Format: JPG, PNG (Maks. 5MB)</small>
                    </div>
                    <input type="file" id="bukti_foto" name="bukti_foto" accept="image/*" 
                           style="display: none;">
                </div>
                <div id="previewContainer" style="display: none; margin-top: 15px;">
                    <img id="imagePreview" src="#" alt="Preview" style="max-width: 200px; border-radius: 8px;">
                    <button type="button" id="removeImage" class="btn-small" style="margin-left: 10px;">
                        <i class="fas fa-times"></i> Hapus
                    </button>
                </div>
            </div>
            
            <!-- Tombol Aksi -->
            <div class="form-actions">
                <button type="button" id="resetBtn" class="btn btn-secondary">
                    <i class="fas fa-redo"></i> Reset Form
                </button>
                <button type="submit" id="submitBtn" class="btn btn-primary">
                    <i class="fas fa-paper-plane"></i> Kirim ke Pusat
                </button>
                <button type="button" id="simpanDraftBtn" class="btn btn-outline">
                    <i class="fas fa-save"></i> Simpan Draft
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
                    <i class="fas fa-calendar-check"></i>
                </div>
                <div class="guide-content">
                    <strong>Tanggal Pembelian</strong>
                    <p>Isi tanggal sesuai dengan transaksi pembelian sebenarnya</p>
                </div>
            </div>
            
            <div class="guide-item">
                <div class="guide-icon">
                    <i class="fas fa-user-check"></i>
                </div>
                <div class="guide-content">
                    <strong>Data Ladang</strong>
                    <p>Pastikan ladang sesuai dengan yang tercatat</p>
                </div>
            </div>
            
            <div class="guide-item">
                <div class="guide-icon">
                    <i class="fas fa-weight-hanging"></i>
                </div>
                <div class="guide-content">
                    <strong>Jumlah & Harga</strong>
                    <p>Total harga akan otomatis terhitung berdasarkan input</p>
                </div>
            </div>
            
            <div class="guide-item">
                <div class="guide-icon">
                    <i class="fas fa-camera"></i>
                </div>
                <div class="guide-content">
                    <strong>Bukti Foto</strong>
                    <p>Upload foto kwitansi yang jelas untuk verifikasi</p>
                </div>
            </div>
        </div>
        
        <!-- Daftar Harga Referensi -->
        <div style="margin-top: 30px;">
            <h4 style="margin-bottom: 15px; color: var(--text-dark);">Harga Referensi Terkini</h4>
            <div class="price-table">
                <div class="price-row header">
                    <div>Kualitas</div>
                    <div>Harga Rata-rata</div>
                </div>
                <div class="price-row">
                    <div><span class="quality-badge A">A</span> Grade Export</div>
                    <div>Rp 15.000 - Rp 18.000/kg</div>
                </div>
                <div class="price-row">
                    <div><span class="quality-badge B">B</span> Grade Premium</div>
                    <div>Rp 12.000 - Rp 14.000/kg</div>
                </div>
                <div class="price-row">
                    <div><span class="quality-badge C">C</span> Grade Standar</div>
                    <div>Rp 9.000 - Rp 11.000/kg</div>
                </div>
            </div>
        </div>
        
        <!-- Riwayat Input -->
        <div style="margin-top: 30px;">
            <h4 style="margin-bottom: 15px; color: var(--text-dark);">Riwayat Input Terakhir</h4>
            <div class="history-list" id="historyList">
                <!-- Data akan ditambahkan via JavaScript -->
                <div class="empty-history">
                    <i class="fas fa-history"></i>
                    <p>Belum ada riwayat input</p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Konfirmasi -->
<div class="modal-overlay" id="confirmModal" style="display: none;">
    <div class="modal-content">
        <div class="modal-header">
            <h3 class="modal-title">Konfirmasi Pengiriman</h3>
        </div>
        <div class="modal-body">
            <p>Apakah Anda yakin ingin mengirim data pembelian ini ke pusat?</p>
            <div class="summary-box">
                <div class="summary-item">
                    <span>Petani:</span>
                    <strong id="confirmPetani"></strong>
                </div>
                <div class="summary-item">
                    <span>Jumlah:</span>
                    <strong id="confirmJumlah"></strong>
                </div>
                <div class="summary-item">
                    <span>Total:</span>
                    <strong id="confirmTotal"></strong>
                </div>
            </div>
            <p class="modal-note"><i class="fas fa-info-circle"></i> Data akan diverifikasi oleh tim pusat dalam 1x24 jam</p>
        </div>
        <div class="modal-footer">
            <button class="btn" id="cancelConfirm">Edit Lagi</button>
            <button class="btn btn-primary" id="finalSubmit">Ya, Kirim Sekarang</button>
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
    
    /* Radio Group */
    .radio-group {
        display: flex;
        gap: 15px;
        flex-wrap: wrap;
    }
    
    .radio-item {
        flex: 1;
        min-width: 120px;
    }
    
    .radio-item input[type="radio"] {
        display: none;
    }
    
    .radio-label {
        display: flex;
        align-items: center;
        gap: 8px;
        padding: 12px 15px;
        background-color: var(--bg-light);
        border: 2px solid var(--border);
        border-radius: 8px;
        cursor: pointer;
        transition: var(--transition);
        text-align: center;
        justify-content: center;
    }
    
    .radio-label:hover {
        background-color: var(--primary-lighter);
        border-color: var(--primary);
    }
    
    .radio-item input[type="radio"]:checked + .radio-label {
        background-color: var(--primary-lighter);
        border-color: var(--primary);
        color: var(--primary);
        font-weight: 600;
    }
    
    /* File Upload */
    .file-upload-area {
        border: 2px dashed var(--border);
        border-radius: 8px;
        padding: 40px 20px;
        text-align: center;
        cursor: pointer;
        transition: var(--transition);
    }
    
    .file-upload-area:hover {
        border-color: var(--primary);
        background-color: var(--primary-lighter);
    }
    
    .file-upload-content i {
        font-size: 40px;
        color: var(--primary);
        margin-bottom: 10px;
    }
    
    .file-upload-content p {
        margin-bottom: 5px;
        color: var(--text-dark);
        font-weight: 500;
    }
    
    .file-upload-content small {
        color: var(--text-light);
        font-size: 12px;
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
    
    /* Price Table */
    .price-table {
        border: 1px solid var(--border);
        border-radius: 8px;
        overflow: hidden;
    }
    
    .price-row {
        display: flex;
        justify-content: space-between;
        padding: 12px 15px;
        border-bottom: 1px solid var(--border);
    }
    
    .price-row.header {
        background-color: var(--primary-lighter);
        font-weight: 600;
        color: var(--primary);
    }
    
    .price-row:last-child {
        border-bottom: none;
    }
    
    .quality-badge {
        display: inline-block;
        width: 24px;
        height: 24px;
        border-radius: 50%;
        text-align: center;
        line-height: 24px;
        font-size: 12px;
        font-weight: 600;
        margin-right: 8px;
    }
    
    .quality-badge.A {
        background-color: #4CAF50;
        color: white;
    }
    
    .quality-badge.B {
        background-color: #FF9800;
        color: white;
    }
    
    .quality-badge.C {
        background-color: #2196F3;
        color: white;
    }
    
    /* History List */
    .history-list {
        max-height: 300px;
        overflow-y: auto;
    }
    
    .empty-history {
        text-align: center;
        padding: 40px 20px;
        color: var(--text-light);
    }
    
    .empty-history i {
        font-size: 40px;
        margin-bottom: 10px;
        opacity: 0.5;
    }
    
    .history-item {
        padding: 12px;
        background-color: var(--bg-light);
        border-radius: 8px;
        margin-bottom: 10px;
        border-left: 4px solid var(--primary);
    }
    
    .history-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 5px;
    }
    
    .history-petani {
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
    
    .btn-outline {
        background-color: transparent;
        border: 2px solid var(--border);
        color: var(--text-dark);
    }
    
    .btn-outline:hover {
        background-color: var(--bg-light);
        border-color: var(--text-light);
    }
    
    .btn-small {
        padding: 5px 10px;
        font-size: 12px;
    }
    
    /* Modal Summary */
    .summary-box {
        background-color: var(--bg-light);
        border-radius: 8px;
        padding: 15px;
        margin: 15px 0;
    }
    
    .summary-item {
        display: flex;
        justify-content: space-between;
        margin-bottom: 8px;
        font-size: 14px;
    }
    
    .summary-item:last-child {
        margin-bottom: 0;
        border-top: 1px solid var(--border);
        padding-top: 8px;
        font-weight: 600;
    }
    
    .modal-note {
        font-size: 13px;
        color: var(--text-light);
        display: flex;
        align-items: center;
        gap: 8px;
        margin-top: 15px;
        padding: 10px;
        background-color: #fff9e6;
        border-radius: 6px;
        border-left: 4px solid #FFC107;
    }
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Elemen DOM
    const form = document.getElementById('pembelianForm');
    const hargaInput = document.getElementById('harga_per_kg');
    const jumlahInput = document.getElementById('jumlah_kg');
    const totalHargaInput = document.getElementById('total_harga');
    const fileUploadArea = document.getElementById('fileUploadArea');
    const fileInput = document.getElementById('bukti_foto');
    const previewContainer = document.getElementById('previewContainer');
    const imagePreview = document.getElementById('imagePreview');
    const removeImageBtn = document.getElementById('removeImage');
    const resetBtn = document.getElementById('resetBtn');
    const submitBtn = document.getElementById('submitBtn');
    const simpanDraftBtn = document.getElementById('simpanDraftBtn');
    const successAlert = document.getElementById('successAlert');
    const errorAlert = document.getElementById('errorAlert');
    const errorMessage = document.getElementById('errorMessage');
    const confirmModal = document.getElementById('confirmModal');
    const cancelConfirm = document.getElementById('cancelConfirm');
    const finalSubmit = document.getElementById('finalSubmit');
    const historyList = document.getElementById('historyList');
    
    // Data sementara (simpan di localStorage)
    let formData = JSON.parse(localStorage.getItem('pembelianDraft')) || {};
    let historyData = JSON.parse(localStorage.getItem('pembelianHistory')) || [];
    
    // Initialize form dengan data draft
    function loadDraftData() {
        if (formData.tanggal_beli) document.getElementById('tanggal_beli').value = formData.tanggal_beli;
        if (formData.nama_petani) document.getElementById('nama_petani').value = formData.nama_petani;
        if (formData.alamat_petani) document.getElementById('alamat_petani').value = formData.alamat_petani;
        if (formData.nama_ladang) document.getElementById('nama_ladang').value = formData.nama_ladang;
        if (formData.harga_per_kg) document.getElementById('harga_per_kg').value = formData.harga_per_kg;
        if (formData.jumlah_kg) document.getElementById('jumlah_kg').value = formData.jumlah_kg;
        if (formData.kualitas) document.getElementById('kualitas').value = formData.kualitas;
        if (formData.jenis_jeruk) {
            document.querySelector(`input[name="jenis_jeruk"][value="${formData.jenis_jeruk}"]`).checked = true;
        }
        if (formData.catatan) document.getElementById('catatan').value = formData.catatan;
        
        // Hitung total jika ada data
        calculateTotal();
    }
    
    // Load history data
    function loadHistoryData() {
        if (historyData.length === 0) return;
        
        historyList.innerHTML = '';
        historyData.slice(0, 5).forEach((item, index) => {
            const historyItem = document.createElement('div');
            historyItem.className = 'history-item';
            historyItem.innerHTML = `
                <div class="history-header">
                    <div class="history-petani">${item.nama_petani}</div>
                    <div class="history-date">${formatDate(item.tanggal)}</div>
                </div>
                <div class="history-details">
                    <div>${item.jumlah_kg} kg × Rp ${formatNumber(item.harga_per_kg)}</div>
                    <div><strong>Rp ${formatNumber(item.total_harga)}</strong></div>
                </div>
            `;
            historyList.appendChild(historyItem);
        });
    }
    
    // Hitung total harga otomatis
    function calculateTotal() {
        const harga = parseFloat(hargaInput.value) || 0;
        const jumlah = parseFloat(jumlahInput.value) || 0;
        const total = harga * jumlah;
        
        totalHargaInput.value = total > 0 ? `Rp ${formatNumber(total)}` : '';
        
        // Update data draft
        updateDraftData();
    }
    
    // Format angka dengan separator ribuan
    function formatNumber(num) {
        return num.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
    }
    
    // Format tanggal
    function formatDate(dateString) {
        const date = new Date(dateString);
        return date.toLocaleDateString('id-ID', {
            day: '2-digit',
            month: 'short',
            year: 'numeric'
        });
    }
    
    // Update data draft di localStorage
    function updateDraftData() {
        formData = {
            tanggal_beli: document.getElementById('tanggal_beli').value,
            nama_petani: document.getElementById('nama_petani').value,
            alamat_petani: document.getElementById('alamat_petani').value,
            nama_ladang: document.getElementById('nama_ladang').value,
            harga_per_kg: document.getElementById('harga_per_kg').value,
            jumlah_kg: document.getElementById('jumlah_kg').value,
            kualitas: document.getElementById('kualitas').value,
            jenis_jeruk: document.querySelector('input[name="jenis_jeruk"]:checked')?.value,
            catatan: document.getElementById('catatan').value
        };
        
        localStorage.setItem('pembelianDraft', JSON.stringify(formData));
    }
    
    // Event Listeners untuk kalkulasi otomatis
    hargaInput.addEventListener('input', calculateTotal);
    jumlahInput.addEventListener('input', calculateTotal);
    
    // Event Listeners untuk update draft
    form.addEventListener('input', function(e) {
        if (e.target.tagName === 'INPUT' || e.target.tagName === 'SELECT' || e.target.tagName === 'TEXTAREA') {
            updateDraftData();
        }
    });
    
    form.addEventListener('change', function(e) {
        if (e.target.name === 'jenis_jeruk') {
            updateDraftData();
        }
    });
    
    // File Upload Handler
    fileUploadArea.addEventListener('click', function() {
        fileInput.click();
    });
    
    fileInput.addEventListener('change', function(e) {
        if (this.files && this.files[0]) {
            const file = this.files[0];
            
            // Validasi ukuran file (max 5MB)
            if (file.size > 5 * 1024 * 1024) {
                showError('Ukuran file terlalu besar. Maksimal 5MB.');
                this.value = '';
                return;
            }
            
            // Validasi tipe file
            if (!file.type.match('image.*')) {
                showError('File harus berupa gambar (JPG, PNG)');
                this.value = '';
                return;
            }
            
            // Tampilkan preview
            const reader = new FileReader();
            reader.onload = function(e) {
                imagePreview.src = e.target.result;
                previewContainer.style.display = 'flex';
                previewContainer.style.alignItems = 'center';
            };
            reader.readAsDataURL(file);
        }
    });
    
    removeImageBtn.addEventListener('click', function() {
        fileInput.value = '';
        previewContainer.style.display = 'none';
        imagePreview.src = '#';
    });
    
    // Reset Form
    resetBtn.addEventListener('click', function() {
        if (confirm('Apakah Anda yakin ingin mereset form? Semua data yang belum disimpan akan hilang.')) {
            form.reset();
            fileInput.value = '';
            previewContainer.style.display = 'none';
            localStorage.removeItem('pembelianDraft');
            formData = {};
            totalHargaInput.value = '';
            successAlert.style.display = 'none';
            errorAlert.style.display = 'none';
        }
    });
    
    // Simpan Draft
    simpanDraftBtn.addEventListener('click', function() {
        updateDraftData();
        showSuccess('Data berhasil disimpan sebagai draft');
    });
    
    // Validasi Form
    function validateForm() {
        const errors = [];
        
        // Validasi required fields
        const requiredFields = [
            { id: 'tanggal_beli', name: 'Tanggal Pembelian' },
            { id: 'nama_petani', name: 'Nama Petani' },
            { id: 'alamat_petani', name: 'Alamat Petani' },
            { id: 'nama_ladang', name: 'Nama Ladang' },
            { id: 'harga_per_kg', name: 'Harga per Kg' },
            { id: 'jumlah_kg', name: 'Jumlah (Kg)' },
            { id: 'kualitas', name: 'Kualitas Jeruk' }
        ];
        
        requiredFields.forEach(field => {
            const element = document.getElementById(field.id);
            if (!element.value.trim()) {
                errors.push(`${field.name} harus diisi`);
            }
        });
        
        // Validasi harga
        const harga = parseFloat(hargaInput.value);
        if (harga < 1000 || harga > 50000) {
            errors.push('Harga per kg harus antara Rp 1.000 - Rp 50.000');
        }
        
        // Validasi jumlah
        const jumlah = parseFloat(jumlahInput.value);
        if (jumlah < 0.1 || jumlah > 10000) {
            errors.push('Jumlah harus antara 0.1 - 10.000 kg');
        }
        
        // Validasi jenis jeruk
        const jenisJeruk = document.querySelector('input[name="jenis_jeruk"]:checked');
        if (!jenisJeruk) {
            errors.push('Jenis jeruk harus dipilih');
        }
        
        return errors;
    }
    
    // Submit Form
    form.addEventListener('submit', function(e) {
        e.preventDefault();
        
        // Validasi
        const errors = validateForm();
        if (errors.length > 0) {
            showError(errors.join('<br>'));
            return;
        }
        
        // Tampilkan modal konfirmasi
        showConfirmationModal();
    });
    
    // Tampilkan modal konfirmasi
    function showConfirmationModal() {
        // Isi data di modal
        document.getElementById('confirmPetani').textContent = document.getElementById('nama_petani').value;
        document.getElementById('confirmJumlah').textContent = `${document.getElementById('jumlah_kg').value} kg`;
        document.getElementById('confirmTotal').textContent = totalHargaInput.value;
        
        // Tampilkan modal
        confirmModal.style.display = 'flex';
        document.body.style.overflow = 'hidden';
    }
    
    // Cancel confirmation
    cancelConfirm.addEventListener('click', function() {
        confirmModal.style.display = 'none';
        document.body.style.overflow = 'auto';
    });
    
    // Final submit
    finalSubmit.addEventListener('click', function() {
        // Simpan ke history
        const newEntry = {
            id: Date.now(),
            tanggal: document.getElementById('tanggal_beli').value,
            nama_petani: document.getElementById('nama_petani').value,
            alamat_petani: document.getElementById('alamat_petani').value,
            nama_ladang: document.getElementById('nama_ladang').value,
            harga_per_kg: document.getElementById('harga_per_kg').value,
            jumlah_kg: document.getElementById('jumlah_kg').value,
            total_harga: parseFloat(hargaInput.value) * parseFloat(jumlahInput.value),
            kualitas: document.getElementById('kualitas').value,
            jenis_jeruk: document.querySelector('input[name="jenis_jeruk"]:checked').value,
            catatan: document.getElementById('catatan').value,
            status: 'pending',
            timestamp: new Date().toISOString()
        };
        
        // Tambah ke history
        historyData.unshift(newEntry);
        localStorage.setItem('pembelianHistory', JSON.stringify(historyData));
        
        // Update history display
        loadHistoryData();
        
        // Reset form
        form.reset();
        fileInput.value = '';
        previewContainer.style.display = 'none';
        totalHargaInput.value = '';
        localStorage.removeItem('pembelianDraft');
        formData = {};
        
        // Tutup modal
        confirmModal.style.display = 'none';
        document.body.style.overflow = 'auto';
        
        // Tampilkan success message
        showSuccess('Data pembelian berhasil dikirim ke pusat! Akan diverifikasi dalam 1x24 jam.');
        
        // Scroll ke atas
        window.scrollTo({ top: 0, behavior: 'smooth' });
    });
    
    // Show success message
    function showSuccess(message) {
        successAlert.innerHTML = `<i class="fas fa-check-circle"></i> <span>${message}</span>`;
        successAlert.style.display = 'flex';
        errorAlert.style.display = 'none';
        
        // Auto hide after 5 seconds
        setTimeout(() => {
            successAlert.style.display = 'none';
        }, 5000);
    }
    
    // Show error message
    function showError(message) {
        errorMessage.innerHTML = message;
        errorAlert.style.display = 'flex';
        successAlert.style.display = 'none';
        
        // Auto hide after 5 seconds
        setTimeout(() => {
            errorAlert.style.display = 'none';
        }, 5000);
    }
    
    // Initialize
    loadDraftData();
    loadHistoryData();
});
</script>
@endsection