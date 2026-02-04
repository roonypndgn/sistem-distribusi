@extends('layouts.pusat')

@section('title', 'Data Ladang - PT. Mardua Holong')

@section('page-title', 'Data Ladang')
@section('page-subtitle', 'Manajemen Data Ladang Jeruk')

@section('content')
<div class="content-wrapper">
    <!-- Header -->
    <div class="content-header">
        <div class="header-right">
            <button type="button" id="refreshBtn" class="btn btn-secondary">
                <i class="fas fa-sync-alt"></i> Refresh
            </button>
            <button type="button" id="exportBtn" class="btn btn-primary">
                <i class="fas fa-file-export"></i> Export Data
            </button>
        </div>
    </div>
    
    <!-- Form Input Data Ladang -->
    <div class="content-card">
        <div class="card-header">
            <div class="card-title">
                <i class="fas fa-tractor"></i>
                <span>Form Input Data Ladang</span>
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
        
        <form id="ladangForm">
            <div class="form-grid">
                <div class="form-group">
                    <label class="form-label">
                        <i class="fas fa-user"></i>
                        Petani *
                    </label>
                    <select id="petani_id" name="petani_id" class="form-control" required>
                        <option value="">-- Pilih Petani --</option>
                        <option value="1">Tuan Pandiangan</option>
                        <option value="2">Tuan Silalahi</option>
                        <option value="3">Tuan Siregar</option>
                        <option value="4">Ibu Munthe</option>
                        <option value="5">Pak Sinuhaji</option>
                        <option value="6">Ibu Ginting</option>
                    </select>
                    <small class="form-text">Pilih petani pemilik ladang</small>
                </div>
                
                <div class="form-group">
                    <label class="form-label">
                        <i class="fas fa-signature"></i>
                        Nama Ladang *
                    </label>
                    <input type="text" id="nama_ladang" name="nama_ladang" class="form-control" 
                           placeholder="Contoh: Ladang Berastagi, Ladang Sipirok, dll" required>
                    <small class="form-text">Nama ladang untuk identifikasi</small>
                </div>
                
                <div class="form-group">
                    <label class="form-label">
                        <i class="fas fa-map-marker-alt"></i>
                        Koordinat GPS *
                    </label>
                    <div class="input-group">
                        <input type="text" id="koordinat_gps" name="koordinat_gps" class="form-control" 
                               placeholder="Contoh: 3.589665, 98.673826" required>
                        <button type="button" id="getLocationBtn" class="btn btn-outline" style="border-radius: 0 8px 8px 0;">
                            <i class="fas fa-location-arrow"></i> Ambil Lokasi
                        </button>
                    </div>
                    <small class="form-text">Format: latitude, longitude (contoh: 3.589665, 98.673826)</small>
                    
                    <!-- Map Preview (optional) -->
                    <div id="mapPreview" class="map-preview" style="display: none; margin-top: 10px;">
                        <div id="map" style="height: 150px; border-radius: 8px; overflow: hidden; background-color: #f0f0f0;"></div>
                        <div id="coordinatesInfo" class="coordinates-info" style="margin-top: 5px; font-size: 12px; color: var(--text-light);"></div>
                    </div>
                </div>
                
                <div class="form-group">
                    <label class="form-label">
                        <i class="fas fa-ruler-combined"></i>
                        Luas Ladang *
                    </label>
                    <div class="input-with-unit">
                        <input type="number" id="luas_ladang" name="luas_ladang" class="form-control" 
                               placeholder="0" min="0.1" max="1000" step="0.1" required>
                        <span class="unit">Hektar</span>
                    </div>
                    <small class="form-text">Luas ladang dalam hektar (Ha)</small>
                    
                    <!-- Luas Indicator -->
                    <div id="areaIndicator" class="area-indicator" style="margin-top: 10px;">
                        <div class="indicator-labels">
                            <span>Kecil</span>
                            <span>Sedang</span>
                            <span>Besar</span>
                        </div>
                        <div class="indicator-bar">
                            <div id="areaMarker" class="indicator-marker"></div>
                        </div>
                        <div class="indicator-range">
                            <span style="color: #4CAF50;">&lt; 1 Ha</span>
                            <span style="color: #FF9800;">1-5 Ha</span>
                            <span style="color: #F44336;">&gt; 5 Ha</span>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Tombol Aksi -->
            <div class="form-actions">
                <button type="button" id="resetBtn" class="btn btn-secondary">
                    <i class="fas fa-redo"></i> Reset Form
                </button>
                <button type="submit" id="submitBtn" class="btn btn-success">
                    <i class="fas fa-save"></i> Simpan Data
                </button>
            </div>
        </form>
    </div>
    
    <!-- Data Ladang -->
    <div class="content-card">
        <div class="card-header">
            <div class="card-title">
                <i class="fas fa-table"></i>
                <span>Data Ladang</span>
            </div>
        </div>
        
        <div class="table-responsive">
            <table class="data-table">
                <thead>
                    <tr>
                        <th style="width: 50px;">No</th>
                        <th>Petani</th>
                        <th>Nama Ladang</th>
                        <th>Koordinat GPS</th>
                        <th>Luas Ladang</th>
                        <th style="width: 100px;">Aksi</th>
                    </tr>
                </thead>
                <tbody id="ladangTableBody">
                    <!-- Data akan diisi oleh JavaScript -->
                </tbody>
            </table>
        </div>
        
        <!-- Pagination -->
        <div class="table-footer">
            <div class="showing-count">
                Menampilkan <span id="showingCount">0</span> dari <span id="totalCount">0</span> data
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

<!-- Modal Edit Ladang -->
<div id="editModal" class="modal">
    <div class="modal-content">
        <div class="modal-header">
            <h3 class="modal-title">Edit Data Ladang</h3>
            <button type="button" class="close-edit-modal">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <div class="modal-body">
            <form id="editLadangForm">
                <input type="hidden" id="edit_id" name="id">
                
                <div class="form-group">
                    <label class="form-label">Petani *</label>
                    <select id="edit_petani_id" name="petani_id" class="form-control" required>
                        <option value="">-- Pilih Petani --</option>
                        <option value="1">Tuan Pandiangan</option>
                        <option value="2">Tuan Silalahi</option>
                        <option value="3">Tuan Siregar</option>
                        <option value="4">Pak Sinuhaji</option>
                        <option value="5">Ibu Munthe</option>
                        <option value="6">Ibu Ginting</option>
                    </select>
                </div>
                
                <div class="form-group">
                    <label class="form-label">Nama Ladang *</label>
                    <input type="text" id="edit_nama_ladang" name="nama_ladang" class="form-control" required>
                </div>
                
                <div class="form-group">
                    <label class="form-label">Koordinat GPS *</label>
                    <input type="text" id="edit_koordinat_gps" name="koordinat_gps" class="form-control" required>
                </div>
                
                <div class="form-group">
                    <label class="form-label">Luas Ladang *</label>
                    <div class="input-with-unit">
                        <input type="number" id="edit_luas_ladang" name="luas_ladang" class="form-control" 
                               min="0.1" max="1000" step="0.1" required>
                        <span class="unit">Hektar</span>
                    </div>
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
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 20px;
        margin-bottom: 25px;
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
    
    /* Input Group */
    .input-group {
        display: flex;
    }
    
    .input-group .form-control {
        border-radius: 8px 0 0 8px;
        flex: 1;
    }
    
    .input-group .btn {
        border-radius: 0 8px 8px 0;
        border-left: none;
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
        min-width: 70px;
        font-weight: 500;
    }
    
    /* Area Indicator */
    .area-indicator {
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
    
    /* Map Preview */
    .map-preview {
        animation: fadeIn 0.5s ease;
    }
    
    @keyframes fadeIn {
        from { opacity: 0; }
        to { opacity: 1; }
    }
    
    .coordinates-info {
        display: flex;
        justify-content: space-between;
        align-items: center;
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
    
    .btn-outline {
        background-color: var(--light);
        color: var(--text-dark);
        border: 1px solid var(--border);
    }
    
    .btn-outline:hover {
        background-color: #E9ECEF;
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
        
        .form-grid {
            grid-template-columns: 1fr;
        }
        
        .modal-footer {
            flex-direction: column;
        }
    }
    
    @media (max-width: 576px) {
        .table-footer {
            flex-direction: column;
            align-items: stretch;
        }
        
        .pagination {
            justify-content: center;
        }
        
        .input-group {
            flex-direction: column;
        }
        
        .input-group .form-control {
            border-radius: 8px;
            margin-bottom: 10px;
        }
        
        .input-group .btn {
            border-radius: 8px;
            border-left: 1px solid var(--border);
        }
    }
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Data dummy ladang
    let ladangData = [
        {
            id: 1,
            petani_id: "1",
            petani_nama: "Tuan Pandiangan",
            nama_ladang: "Ladang Simalungun",
            koordinat_gps: "3.589665, 98.673826",
            luas_ladang: 2.5
        },
        {
            id: 2,
            petani_id: "2",
            petani_nama: "Tuan Siregar",
            nama_ladang: "Ladang Berastagi",
            koordinat_gps: "3.193333, 98.508056",
            luas_ladang: 3.0
        },
        {
            id: 3,
            petani_id: "3",
            petani_nama: "Tuan Silalahi",
            nama_ladang: "Ladang Sipirok",
            koordinat_gps: "2.083333, 99.166667",
            luas_ladang: 1.8
        },
        {
            id: 4,
            petani_id: "4",
            petani_nama: "Ibu Munthe",
            nama_ladang: "Ladang Parapat",
            koordinat_gps: "2.663056, 98.932778",
            luas_ladang: 2.2
        },
        {
            id: 5,
            petani_id: "5",
            petani_nama: "Pak Sinuhaji",
            nama_ladang: "Ladang Karo",
            koordinat_gps: "3.116667, 98.316667",
            luas_ladang: 1.5
        },
        {
            id: 6,
            petani_id: "6",
            petani_nama: "Ibu Ginting",
            nama_ladang: "Ladang Medan",
            koordinat_gps: "3.595196, 98.672223",
            luas_ladang: 4.2
        }
    ];
    
    // Data petani untuk dropdown
    const petaniData = {
        "1": "Tuan Pandiangan",
        "2": "Tuan Siregar",
        "3": "Tuan Silalahi",
        "4": "Ibu Munthe",
        "5": "Pak Sinuhaji",
        "6": "Ibu Ginting"
    };
    
    // Elemen DOM
    const ladangForm = document.getElementById('ladangForm');
    const petaniSelect = document.getElementById('petani_id');
    const namaLadangInput = document.getElementById('nama_ladang');
    const koordinatGpsInput = document.getElementById('koordinat_gps');
    const luasLadangInput = document.getElementById('luas_ladang');
    const areaMarker = document.getElementById('areaMarker');
    const areaIndicator = document.getElementById('areaIndicator');
    const getLocationBtn = document.getElementById('getLocationBtn');
    const mapPreview = document.getElementById('mapPreview');
    const coordinatesInfo = document.getElementById('coordinatesInfo');
    const resetBtn = document.getElementById('resetBtn');
    const submitBtn = document.getElementById('submitBtn');
    const successAlert = document.getElementById('successAlert');
    const successMessage = document.getElementById('successMessage');
    const errorAlert = document.getElementById('errorAlert');
    const errorMessage = document.getElementById('errorMessage');
    const ladangTableBody = document.getElementById('ladangTableBody');
    const refreshBtn = document.getElementById('refreshBtn');
    const exportBtn = document.getElementById('exportBtn');
    const editModal = document.getElementById('editModal');
    
    // State
    let currentPage = 1;
    const itemsPerPage = 5;
    
    // Initialize
    loadLadangTable();
    updateAreaIndicator(0);
    
    // Update area indicator
    luasLadangInput.addEventListener('input', function() {
        const value = parseFloat(this.value) || 0;
        updateAreaIndicator(value);
    });
    
    function updateAreaIndicator(value) {
        const maxArea = 10;
        const percentage = Math.min(value / maxArea * 100, 100);
        areaMarker.style.left = `calc(${percentage}% - 8px)`;
        
        if (value < 1) {
            areaMarker.style.backgroundColor = '#4CAF50';
        } else if (value < 5) {
            areaMarker.style.backgroundColor = '#FF9800';
        } else {
            areaMarker.style.backgroundColor = '#F44336';
        }
    }
    
    // Get current location (simulasi)
    getLocationBtn.addEventListener('click', function() {
        // Simulasi koordinat GPS
        const randomLat = (Math.random() * 0.1 + 3.5).toFixed(6);
        const randomLng = (Math.random() * 0.1 + 98.6).toFixed(6);
        const coordinates = `${randomLat}, ${randomLng}`;
        
        koordinatGpsInput.value = coordinates;
        showMapPreview(coordinates);
        
        showSuccess('Lokasi berhasil diambil!');
    });
    
    // Show map preview (simulasi)
    function showMapPreview(coordinates) {
        mapPreview.style.display = 'block';
        
        const [lat, lng] = coordinates.split(',').map(coord => coord.trim());
        coordinatesInfo.innerHTML = `
            <span>Latitude: ${lat}</span>
            <span>Longitude: ${lng}</span>
        `;
        
        // Simulasi peta (hanya visual)
        const map = document.getElementById('map');
        map.style.background = `
            linear-gradient(135deg, #4CAF50 25%, transparent 25%) -50px 0,
            linear-gradient(225deg, #4CAF50 25%, transparent 25%) -50px 0,
            linear-gradient(315deg, #4CAF50 25%, transparent 25%),
            linear-gradient(45deg, #4CAF50 25%, transparent 25%)
        `;
        map.style.backgroundSize = '100px 100px';
        map.style.backgroundColor = '#81C784';
        map.style.position = 'relative';
        
        // Tambahkan marker simulasi
        map.innerHTML = `
            <div style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%);">
                <div style="width: 20px; height: 20px; background-color: var(--primary); border-radius: 50%; border: 3px solid white; box-shadow: 0 2px 5px rgba(0,0,0,0.3);"></div>
            </div>
        `;
    }
    
    // Reset form
    resetBtn.addEventListener('click', function() {
        if (confirm('Apakah Anda yakin ingin mereset form? Semua data yang telah diisi akan hilang.')) {
            ladangForm.reset();
            mapPreview.style.display = 'none';
            successAlert.style.display = 'none';
            errorAlert.style.display = 'none';
            updateAreaIndicator(0);
        }
    });
    
    // Submit form
    ladangForm.addEventListener('submit', function(e) {
        e.preventDefault();
        
        // Validasi
        const errors = [];
        
        if (!petaniSelect.value) {
            errors.push('Pilih petani terlebih dahulu');
        }
        
        if (!namaLadangInput.value.trim()) {
            errors.push('Nama ladang harus diisi');
        }
        
        const koordinat = koordinatGpsInput.value.trim();
        if (!koordinat) {
            errors.push('Koordinat GPS harus diisi');
        } else {
            const coordPattern = /^-?\d+(\.\d+)?,\s*-?\d+(\.\d+)?$/;
            if (!coordPattern.test(koordinat)) {
                errors.push('Format koordinat GPS tidak valid. Gunakan format: latitude, longitude');
            }
        }
        
        const luas = parseFloat(luasLadangInput.value);
        if (isNaN(luas) || luas < 0.1 || luas > 1000) {
            errors.push('Luas ladang harus antara 0.1 - 1000 hektar');
        }
        
        if (errors.length > 0) {
            showError(errors.join('<br>'));
            return;
        }
        
        // Simpan data
        const newLadang = {
            id: Date.now(),
            petani_id: petaniSelect.value,
            petani_nama: petaniData[petaniSelect.value],
            nama_ladang: namaLadangInput.value.trim(),
            koordinat_gps: koordinatGpsInput.value.trim(),
            luas_ladang: luas
        };
        
        ladangData.unshift(newLadang);
        
        // Reset form
        ladangForm.reset();
        mapPreview.style.display = 'none';
        updateAreaIndicator(0);
        
        // Update tabel
        loadLadangTable();
        
        // Show success
        showSuccess(`Data ladang berhasil disimpan! Nama: ${newLadang.nama_ladang}`);
        
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
    
    // Load ladang table
    function loadLadangTable() {
        ladangTableBody.innerHTML = '';
        
        const startIndex = (currentPage - 1) * itemsPerPage;
        const endIndex = startIndex + itemsPerPage;
        const pageData = ladangData.slice(startIndex, endIndex);
        
        if (pageData.length === 0) {
            ladangTableBody.innerHTML = `
                <tr>
                    <td colspan="6" style="text-align: center; padding: 40px; color: var(--text-light);">
                        <i class="fas fa-tractor" style="font-size: 40px; margin-bottom: 10px; opacity: 0.5; display: block;"></i>
                        <div>Belum ada data ladang</div>
                    </td>
                </tr>
            `;
        } else {
            pageData.forEach((ladang, index) => {
                const globalIndex = startIndex + index + 1;
                const row = document.createElement('tr');
                
                row.innerHTML = `
                    <td style="color: var(--text-light);">${globalIndex}</td>
                    <td style="font-weight: 600; color: var(--text-dark);">${ladang.petani_nama}</td>
                    <td>${ladang.nama_ladang}</td>
                    <td style="font-family: monospace; font-size: 13px; color: var(--text-light);">
                        ${ladang.koordinat_gps}
                    </td>
                    <td>
                        <div style="font-weight: 600; color: ${getAreaColor(ladang.luas_ladang)};">
                            ${ladang.luas_ladang.toFixed(1)} Ha
                        </div>
                    </td>
                    <td>
                        <div class="action-buttons">
                            <button type="button" class="btn-action btn-edit" data-id="${ladang.id}" title="Edit Data">
                                <i class="fas fa-edit"></i>
                            </button>
                            <button type="button" class="btn-action btn-delete" data-id="${ladang.id}" title="Hapus Data">
                                <i class="fas fa-trash"></i>
                            </button>
                        </div>
                    </td>
                `;
                
                ladangTableBody.appendChild(row);
            });
        }
        
        // Update counts
        document.getElementById('showingCount').textContent = pageData.length;
        document.getElementById('totalCount').textContent = ladangData.length;
        
        // Update pagination
        updatePagination();
        
        // Add event listeners
        addActionListeners();
    }
    
    // Get area color
    function getAreaColor(luas) {
        if (luas < 1) return '#4CAF50';
        if (luas < 5) return '#FF9800';
        return '#F44336';
    }
    
    // Update pagination
    function updatePagination() {
        const totalPages = Math.ceil(ladangData.length / itemsPerPage);
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
                loadLadangTable();
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
        // Edit buttons
        document.querySelectorAll('.btn-action.btn-edit').forEach(btn => {
            btn.addEventListener('click', function() {
                const ladangId = parseInt(this.dataset.id);
                const ladang = ladangData.find(l => l.id === ladangId);
                if (ladang) {
                    openEditModal(ladang);
                }
            });
        });
        
        // Delete buttons
        document.querySelectorAll('.btn-action.btn-delete').forEach(btn => {
            btn.addEventListener('click', function() {
                const ladangId = parseInt(this.dataset.id);
                deleteLadang(ladangId);
            });
        });
    }
    
    // Open edit modal
    function openEditModal(ladang) {
        document.getElementById('edit_id').value = ladang.id;
        document.getElementById('edit_petani_id').value = ladang.petani_id;
        document.getElementById('edit_nama_ladang').value = ladang.nama_ladang;
        document.getElementById('edit_koordinat_gps').value = ladang.koordinat_gps;
        document.getElementById('edit_luas_ladang').value = ladang.luas_ladang;
        
        editModal.style.display = 'flex';
        document.body.style.overflow = 'hidden';
    }
    
    // Save edit
    document.getElementById('saveEditBtn').addEventListener('click', function() {
        const id = parseInt(document.getElementById('edit_id').value);
        const petani_id = document.getElementById('edit_petani_id').value;
        const nama_ladang = document.getElementById('edit_nama_ladang').value.trim();
        const koordinat_gps = document.getElementById('edit_koordinat_gps').value.trim();
        const luas_ladang = parseFloat(document.getElementById('edit_luas_ladang').value);
        
        // Validasi
        const errors = [];
        
        if (!petani_id) {
            errors.push('Pilih petani terlebih dahulu');
        }
        
        if (!nama_ladang) {
            errors.push('Nama ladang harus diisi');
        }
        
        if (!koordinat_gps) {
            errors.push('Koordinat GPS harus diisi');
        } else {
            const coordPattern = /^-?\d+(\.\d+)?,\s*-?\d+(\.\d+)?$/;
            if (!coordPattern.test(koordinat_gps)) {
                errors.push('Format koordinat GPS tidak valid');
            }
        }
        
        if (isNaN(luas_ladang) || luas_ladang < 0.1 || luas_ladang > 1000) {
            errors.push('Luas ladang harus antara 0.1 - 1000 hektar');
        }
        
        if (errors.length > 0) {
            alert('Error:\n' + errors.join('\n'));
            return;
        }
        
        // Update data
        const index = ladangData.findIndex(l => l.id === id);
        if (index !== -1) {
            ladangData[index] = {
                ...ladangData[index],
                petani_id: petani_id,
                petani_nama: petaniData[petani_id],
                nama_ladang: nama_ladang,
                koordinat_gps: koordinat_gps,
                luas_ladang: luas_ladang
            };
            
            loadLadangTable();
            
            editModal.style.display = 'none';
            document.body.style.overflow = 'auto';
            
            showSuccess('Data ladang berhasil diperbarui!');
        }
    });
    
    // Delete ladang
    function deleteLadang(id) {
        if (confirm('Apakah Anda yakin ingin menghapus data ladang ini?')) {
            ladangData = ladangData.filter(l => l.id !== id);
            loadLadangTable();
            showSuccess('Data ladang berhasil dihapus!');
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
            loadLadangTable();
        }
    });
    
    document.querySelector('.btn-pagination.next').addEventListener('click', function() {
        const totalPages = Math.ceil(ladangData.length / itemsPerPage);
        if (currentPage < totalPages) {
            currentPage++;
            loadLadangTable();
        }
    });
    
    // Refresh button
    refreshBtn.addEventListener('click', function() {
        this.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Loading...';
        setTimeout(() => {
            loadLadangTable();
            this.innerHTML = '<i class="fas fa-sync-alt"></i> Refresh';
            showSuccess('Data berhasil direfresh!');
        }, 1000);
    });
    
    // Export button
    exportBtn.addEventListener('click', function() {
        this.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Exporting...';
        
        setTimeout(() => {
            const exportData = ladangData.map(ladang => ({
                Petani: ladang.petani_nama,
                'Nama Ladang': ladang.nama_ladang,
                'Koordinat GPS': ladang.koordinat_gps,
                'Luas Ladang': `${ladang.luas_ladang.toFixed(1)} Ha`
            }));
            
            const dataStr = JSON.stringify(exportData, null, 2);
            const dataBlob = new Blob([dataStr], { type: 'application/json' });
            
            const link = document.createElement('a');
            link.href = URL.createObjectURL(dataBlob);
            link.download = `data-ladang-${new Date().toISOString().split('T')[0]}.json`;
            link.click();
            
            this.innerHTML = '<i class="fas fa-file-export"></i> Export Data';
            showSuccess('Data ladang berhasil diexport!');
        }, 1000);
    });
});
</script>
@endsection