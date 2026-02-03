@extends('layouts.pusat')

@section('title', 'Data Petani - PT. Mardua Holong')

@section('page-title', 'Data Petani')
@section('page-subtitle', 'Manajemen Data Petani Mitra')

@section('content')
<div class="content-wrapper">
    <!-- Header -->
    <div class="content-header" style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 30px;">
        <div>
            <h1 style="font-size: 24px; font-weight: 700; color: var(--text-dark); margin-bottom: 5px;">Data Petani</h1>
            <p style="color: var(--text-light); font-size: 14px;">Kelola data petani mitra PT. Mardua Holong</p>
        </div>
        
        <div style="display: flex; gap: 10px;">
            <button type="button" id="filterBtn" class="btn" style="background-color: var(--bg-light); color: var(--text-light);">
                <i class="fas fa-filter"></i> Filter
            </button>
            <button type="button" id="exportPetaniBtn" class="btn" style="background-color: #4CAF50; color: white;">
                <i class="fas fa-file-excel"></i> Export Excel
            </button>
            <button type="button" id="tambahPetaniBtn" class="btn btn-primary">
                <i class="fas fa-user-plus"></i> Tambah Petani
            </button>
        </div>
    </div>
    
    <!-- Filter Section -->
    <div class="content-card" id="filterSection" style="display: none; margin-bottom: 20px;">
        <div class="card-title">
            <span>Filter Data</span>
            <div class="card-icon">
                <i class="fas fa-sliders-h"></i>
            </div>
        </div>
        
        <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 20px;">
            <div class="form-group">
                <label class="form-label">Cari Nama/No. HP</label>
                <div class="input-wrapper">
                    <i class="fas fa-search input-icon"></i>
                    <input type="text" id="searchInput" class="form-control" placeholder="Cari petani...">
                </div>
            </div>
            
            <div class="form-group">
                <label class="form-label">Cari Alamat</label>
                <div class="input-wrapper">
                    <i class="fas fa-map-marker-alt input-icon"></i>
                    <input type="text" id="searchAlamat" class="form-control" placeholder="Cari alamat...">
                </div>
            </div>
            
            <div class="form-group">
                <label class="form-label">Urutkan</label>
                <select id="sortBy" class="form-control">
                    <option value="nama_asc">Nama A-Z</option>
                    <option value="nama_desc">Nama Z-A</option>
                    <option value="terbaru">Terbaru</option>
                    <option value="terlama">Terlama</option>
                </select>
            </div>
        </div>
        
        <div style="display: flex; justify-content: flex-end; gap: 10px; margin-top: 20px;">
            <button type="button" id="resetFilterBtn" class="btn btn-secondary">
                <i class="fas fa-redo"></i> Reset
            </button>
            <button type="button" id="applyFilterBtn" class="btn btn-primary">
                <i class="fas fa-check"></i> Terapkan Filter
            </button>
        </div>
    </div>
    
    <!-- Stats Cards -->
    <div style="display: grid; grid-template-columns: repeat(4, 1fr); gap: 20px; margin-bottom: 30px;">
        <div class="stat-card" style="background: linear-gradient(135deg, #4CAF50, #2E7D32);">
            <div class="stat-icon">
                <i class="fas fa-users"></i>
            </div>
            <div class="stat-content">
                <div class="stat-value" id="totalPetani">0</div>
                <div class="stat-label">Total Petani</div>
            </div>
        </div>
        
        <div class="stat-card" style="background: linear-gradient(135deg, #2196F3, #0D47A1);">
            <div class="stat-icon">
                <i class="fas fa-phone-alt"></i>
            </div>
            <div class="stat-content">
                <div class="stat-value" id="totalKontak">0</div>
                <div class="stat-label">Kontak Tersedia</div>
            </div>
        </div>
        
        <div class="stat-card" style="background: linear-gradient(135deg, #FF9800, #EF6C00);">
            <div class="stat-icon">
                <i class="fas fa-map-marked-alt"></i>
            </div>
            <div class="stat-content">
                <div class="stat-value" id="totalAlamat">0</div>
                <div class="stat-label">Alamat Lengkap</div>
            </div>
        </div>
        
        <div class="stat-card" style="background: linear-gradient(135deg, #9C27B0, #6A1B9A);">
            <div class="stat-icon">
                <i class="fas fa-calendar-alt"></i>
            </div>
            <div class="stat-content">
                <div class="stat-value" id="terbaruCount">0</div>
                <div class="stat-label">Ditambahkan Bulan Ini</div>
            </div>
        </div>
    </div>
    
    <!-- Data Petani Table -->
    <div class="content-card">
        <div class="card-title">
            <span>Daftar Petani</span>
            <div class="card-icon">
                <i class="fas fa-list"></i>
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
        
        <div style="overflow-x: auto;">
            <table style="width: 100%; border-collapse: collapse;">
                <thead>
                    <tr style="background-color: var(--bg-light); border-bottom: 2px solid var(--border);">
                        <th style="padding: 12px; text-align: left; font-weight: 600; color: var(--text-dark); width: 50px;">No</th>
                        <th style="padding: 12px; text-align: left; font-weight: 600; color: var(--text-dark);">Nama Petani</th>
                        <th style="padding: 12px; text-align: left; font-weight: 600; color: var(--text-dark);">No. Telepon</th>
                        <th style="padding: 12px; text-align: left; font-weight: 600; color: var(--text-dark);">Alamat</th>
                        <th style="padding: 12px; text-align: left; font-weight: 600; color: var(--text-dark);">Tanggal Daftar</th>
                        <th style="padding: 12px; text-align: left; font-weight: 600; color: var(--text-dark); width: 100px;">Aksi</th>
                    </tr>
                </thead>
                <tbody id="petaniTableBody">
                    <!-- Data akan diisi oleh JavaScript -->
                </tbody>
            </table>
        </div>
        
        <!-- Empty State -->
        <div id="emptyState" style="display: none; text-align: center; padding: 40px;">
            <div style="font-size: 60px; color: var(--border); margin-bottom: 20px;">
                <i class="fas fa-users-slash"></i>
            </div>
            <h3 style="color: var(--text-light); margin-bottom: 10px;">Belum ada data petani</h3>
            <p style="color: var(--text-light); margin-bottom: 20px;">Tambahkan petani pertama Anda dengan mengklik tombol "Tambah Petani"</p>
            <button type="button" id="addFirstPetaniBtn" class="btn btn-primary">
                <i class="fas fa-user-plus"></i> Tambah Petani Pertama
            </button>
        </div>
        
        <!-- Pagination -->
        <div style="display: flex; justify-content: space-between; align-items: center; margin-top: 20px; padding-top: 20px; border-top: 1px solid var(--border);">
            <div style="font-size: 14px; color: var(--text-light);">
                Menampilkan <span id="showingCount">0</span> dari <span id="totalCount">0</span> petani
            </div>
            <div style="display: flex; gap: 5px;">
                <button type="button" class="btn-pagination prev" style="padding: 8px 12px; background-color: var(--primary-lighter); color: var(--primary); border: none; border-radius: 6px; cursor: pointer;">
                    <i class="fas fa-chevron-left"></i>
                </button>
                <div id="paginationNumbers"></div>
                <button type="button" class="btn-pagination next" style="padding: 8px 12px; background-color: var(--primary-lighter); color: var(--primary); border: none; border-radius: 6px; cursor: pointer;">
                    <i class="fas fa-chevron-right"></i>
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Tambah/Edit Petani -->
<div class="modal-overlay" id="petaniModal" style="display: none;">
    <div class="modal-content" style="max-width: 500px;">
        <div class="modal-header">
            <h3 class="modal-title" id="modalTitle">Tambah Petani Baru</h3>
            <button type="button" class="close-modal" style="background: none; border: none; color: var(--text-light); cursor: pointer; font-size: 18px;">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <div class="modal-body">
            <form id="petaniForm">
                <div class="form-group">
                    <label class="form-label">Nama Petani *</label>
                    <div class="input-wrapper">
                        <i class="fas fa-user input-icon"></i>
                        <input type="text" id="nama_petani" name="nama_petani" class="form-control" placeholder="Nama lengkap petani" required>
                    </div>
                    <small class="form-text">Masukkan nama lengkap petani</small>
                </div>
                
                <div class="form-group">
                    <label class="form-label">No. Telepon *</label>
                    <div class="input-wrapper">
                        <i class="fas fa-phone input-icon"></i>
                        <input type="tel" id="no_telepon" name="no_telepon" class="form-control" placeholder="0812-3456-7890" required>
                    </div>
                    <small class="form-text">Format: 0812-3456-7890 atau +62812-3456-7890</small>
                </div>
                
                <div class="form-group">
                    <label class="form-label">Alamat Lengkap *</label>
                    <div class="input-wrapper">
                        <i class="fas fa-home input-icon"></i>
                        <textarea id="alamat" name="alamat" class="form-control" rows="4" placeholder="Alamat lengkap termasuk RT/RW, Desa, Kecamatan, Kabupaten" required></textarea>
                    </div>
                    <small class="form-text">Contoh: Jl. Jeruk No. 12, RT 01/RW 02, Desa Sukajadi, Kecamatan Berastagi, Kabupaten Karo</small>
                </div>
                
                <input type="hidden" id="petani_id" name="petani_id" value="">
            </form>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" id="cancelPetaniBtn">Batal</button>
            <button type="button" class="btn btn-primary" id="savePetaniBtn">Simpan Data</button>
        </div>
    </div>
</div>

<!-- Modal Detail Petani -->
<div class="modal-overlay" id="detailModal" style="display: none;">
    <div class="modal-content" style="max-width: 500px;">
        <div class="modal-header">
            <h3 class="modal-title">Detail Petani</h3>
            <button type="button" class="close-detail-modal" style="background: none; border: none; color: var(--text-light); cursor: pointer; font-size: 18px;">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <div class="modal-body">
            <div id="detailContent">
                <!-- Detail akan diisi oleh JavaScript -->
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-primary" id="closeDetailBtn">Tutup</button>
        </div>
    </div>
</div>

<style>
    /* Stat Cards */
    .stat-card {
        display: flex;
        align-items: center;
        padding: 20px;
        border-radius: 10px;
        color: white;
        box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        transition: transform 0.3s ease;
    }
    
    .stat-card:hover {
        transform: translateY(-5px);
    }
    
    .stat-icon {
        font-size: 40px;
        margin-right: 15px;
        opacity: 0.9;
    }
    
    .stat-content {
        flex: 1;
    }
    
    .stat-value {
        font-size: 28px;
        font-weight: 700;
        margin-bottom: 5px;
    }
    
    .stat-label {
        font-size: 14px;
        opacity: 0.9;
    }
    
    /* Table Styles */
    .petani-row {
        transition: background-color 0.3s ease;
    }
    
    .petani-row:hover {
        background-color: var(--primary-lighter);
    }
    
    /* Action Buttons */
    .action-buttons {
        display: flex;
        gap: 8px;
    }
    
    .btn-action {
        width: 36px;
        height: 36px;
        border-radius: 6px;
        border: none;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 14px;
        transition: all 0.3s ease;
    }
    
    .btn-detail {
        background-color: var(--primary-lighter);
        color: var(--primary);
    }
    
    .btn-detail:hover {
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
    
    /* Modal Detail */
    .detail-section {
        margin-bottom: 25px;
    }
    
    .detail-label {
        font-size: 12px;
        color: var(--text-light);
        margin-bottom: 5px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }
    
    .detail-value {
        font-size: 16px;
        color: var(--text-dark);
        font-weight: 500;
    }
    
    .detail-header {
        display: flex;
        align-items: center;
        gap: 15px;
        margin-bottom: 25px;
        padding-bottom: 15px;
        border-bottom: 1px solid var(--border);
    }
    
    .detail-avatar {
        width: 70px;
        height: 70px;
        border-radius: 50%;
        background-color: var(--primary);
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 28px;
        font-weight: 600;
    }
    
    .detail-info h3 {
        margin: 0;
        color: var(--text-dark);
        font-size: 22px;
    }
    
    .detail-info p {
        margin: 5px 0 0;
        color: var(--text-light);
        font-size: 14px;
    }
    
    /* Pagination */
    .btn-pagination {
        transition: all 0.3s ease;
        min-width: 36px;
    }
    
    .btn-pagination:not(.active):hover {
        background-color: var(--primary-lighter) !important;
        color: var(--primary) !important;
    }
    
    .pagination-number {
        padding: 8px 12px;
        background-color: var(--bg-light);
        color: var(--text-light);
        border: none;
        border-radius: 6px;
        cursor: pointer;
        margin: 0 2px;
    }
    
    .pagination-number.active {
        background-color: var(--primary);
        color: white;
    }
    
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
        z-index: 1;
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
    
    /* Phone number formatting */
    .phone-display {
        display: flex;
        align-items: center;
        gap: 8px;
    }
    
    .phone-icon {
        color: var(--primary);
    }
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Data dummy petani
    let petaniData = [
        {
            id: 1,
            nama: 'Tuan Sitorus',
            no_telepon: '081234567890',
            alamat: 'Jl. Perkebunan No. 123, RT 01/RW 02, Desa Gundaling, Kec. Berastagi, Kab. Karo',
            tanggal_daftar: '2024-03-15',
            created_at: '2024-03-15 10:00:00'
        },
        {
            id: 2,
            nama: 'Budi Santoso',
            no_telepon: '082345678901',
            alamat: 'Jl. Jeruk Manis No. 45, Simpang Empat, Berastagi Kota, Kec. Berastagi, Kab. Karo',
            tanggal_daftar: '2024-03-14',
            created_at: '2024-03-14 14:30:00'
        },
        {
            id: 3,
            nama: 'Siti Aminah',
            no_telepon: '083456789012',
            alamat: 'Komplek Tani Sejahtera Blok B No. 8, Desa Parapat, Kec. Girsang, Kab. Simalungun',
            tanggal_daftar: '2024-03-13',
            created_at: '2024-03-13 09:15:00'
        },
        {
            id: 4,
            nama: 'Joko Widodo',
            no_telepon: '084567890123',
            alamat: 'Dusun Sipirok, Desa Huta Ginjang, Kec. Sipirok, Kab. Toba',
            tanggal_daftar: '2024-03-12',
            created_at: '2024-03-12 11:45:00'
        },
        {
            id: 5,
            nama: 'Rudi Hartono',
            no_telepon: '085678901234',
            alamat: 'Jl. Karo No. 88, Lingkungan III, Kabanjahe, Kec. Kabanjahe, Kab. Karo',
            tanggal_daftar: '2024-03-11',
            created_at: '2024-03-11 16:20:00'
        }
    ];
    
    // Elemen DOM
    const filterSection = document.getElementById('filterSection');
    const filterBtn = document.getElementById('filterBtn');
    const searchInput = document.getElementById('searchInput');
    const searchAlamat = document.getElementById('searchAlamat');
    const sortBy = document.getElementById('sortBy');
    const resetFilterBtn = document.getElementById('resetFilterBtn');
    const applyFilterBtn = document.getElementById('applyFilterBtn');
    const tambahPetaniBtn = document.getElementById('tambahPetaniBtn');
    const addFirstPetaniBtn = document.getElementById('addFirstPetaniBtn');
    const petaniTableBody = document.getElementById('petaniTableBody');
    const emptyState = document.getElementById('emptyState');
    const petaniModal = document.getElementById('petaniModal');
    const detailModal = document.getElementById('detailModal');
    const petaniForm = document.getElementById('petaniForm');
    const savePetaniBtn = document.getElementById('savePetaniBtn');
    const cancelPetaniBtn = document.getElementById('cancelPetaniBtn');
    const exportPetaniBtn = document.getElementById('exportPetaniBtn');
    const successAlert = document.getElementById('successAlert');
    const successMessage = document.getElementById('successMessage');
    const errorAlert = document.getElementById('errorAlert');
    const errorMessage = document.getElementById('errorMessage');
    
    // Stat elements
    const totalPetani = document.getElementById('totalPetani');
    const totalKontak = document.getElementById('totalKontak');
    const totalAlamat = document.getElementById('totalAlamat');
    const terbaruCount = document.getElementById('terbaruCount');
    
    // State
    let currentPage = 1;
    const itemsPerPage = 10;
    let filteredData = [...petaniData];
    let isEditing = false;
    let currentPetaniId = null;
    
    // Initialize
    loadPetaniTable();
    updateStats();
    
    // Toggle filter section
    filterBtn.addEventListener('click', function() {
        filterSection.style.display = filterSection.style.display === 'none' ? 'block' : 'none';
        this.innerHTML = filterSection.style.display === 'block' ? 
            '<i class="fas fa-times"></i> Tutup Filter' : 
            '<i class="fas fa-filter"></i> Filter';
    });
    
    // Apply filter
    applyFilterBtn.addEventListener('click', function() {
        applyFilters();
    });
    
    // Reset filter
    resetFilterBtn.addEventListener('click', function() {
        searchInput.value = '';
        searchAlamat.value = '';
        sortBy.value = 'terbaru';
        applyFilters();
    });
    
    // Search on input
    searchInput.addEventListener('input', function() {
        applyFilters();
    });
    
    searchAlamat.addEventListener('input', function() {
        applyFilters();
    });
    
    // Apply filters function
    function applyFilters() {
        filteredData = [...petaniData];
        
        // Search by name/phone
        const searchTerm = searchInput.value.toLowerCase();
        if (searchTerm) {
            filteredData = filteredData.filter(petani => 
                petani.nama.toLowerCase().includes(searchTerm) ||
                petani.no_telepon.includes(searchTerm)
            );
        }
        
        // Search by address
        const alamatTerm = searchAlamat.value.toLowerCase();
        if (alamatTerm) {
            filteredData = filteredData.filter(petani => 
                petani.alamat.toLowerCase().includes(alamatTerm)
            );
        }
        
        // Sort data
        const sortValue = sortBy.value;
        switch(sortValue) {
            case 'nama_asc':
                filteredData.sort((a, b) => a.nama.localeCompare(b.nama));
                break;
            case 'nama_desc':
                filteredData.sort((a, b) => b.nama.localeCompare(a.nama));
                break;
            case 'terbaru':
                filteredData.sort((a, b) => new Date(b.tanggal_daftar) - new Date(a.tanggal_daftar));
                break;
            case 'terlama':
                filteredData.sort((a, b) => new Date(a.tanggal_daftar) - new Date(b.tanggal_daftar));
                break;
        }
        
        currentPage = 1;
        loadPetaniTable();
        updateStats();
    }
    
    // Tambah petani button
    tambahPetaniBtn.addEventListener('click', openAddModal);
    addFirstPetaniBtn.addEventListener('click', openAddModal);
    
    function openAddModal() {
        isEditing = false;
        document.getElementById('modalTitle').textContent = 'Tambah Petani Baru';
        document.getElementById('petaniForm').reset();
        document.getElementById('petani_id').value = '';
        
        petaniModal.style.display = 'flex';
        document.body.style.overflow = 'hidden';
    }
    
    // Open edit modal
    function openEditModal(petaniId) {
        const petani = petaniData.find(p => p.id === petaniId);
        if (!petani) return;
        
        isEditing = true;
        currentPetaniId = petaniId;
        document.getElementById('modalTitle').textContent = 'Edit Data Petani';
        
        // Fill form data
        document.getElementById('petani_id').value = petani.id;
        document.getElementById('nama_petani').value = petani.nama;
        document.getElementById('no_telepon').value = petani.no_telepon;
        document.getElementById('alamat').value = petani.alamat;
        
        petaniModal.style.display = 'flex';
        document.body.style.overflow = 'hidden';
    }
    
    // Save petani
    savePetaniBtn.addEventListener('click', function() {
        // Validation
        const errors = [];
        
        const nama = document.getElementById('nama_petani').value.trim();
        const noTelepon = document.getElementById('no_telepon').value.trim();
        const alamat = document.getElementById('alamat').value.trim();
        
        if (!nama) {
            errors.push('Nama petani harus diisi');
        }
        
        if (!noTelepon) {
            errors.push('Nomor telepon harus diisi');
        } else if (!isValidPhoneNumber(noTelepon)) {
            errors.push('Format nomor telepon tidak valid');
        }
        
        if (!alamat) {
            errors.push('Alamat harus diisi');
        } else if (alamat.length < 10) {
            errors.push('Alamat terlalu pendek, mohon isi alamat lengkap');
        }
        
        if (errors.length > 0) {
            showError(errors.join('<br>'));
            return;
        }
        
        // Format phone number
        const formattedPhone = formatPhoneNumber(noTelepon);
        
        // Get form data
        const formData = {
            id: isEditing ? currentPetaniId : Date.now(),
            nama: nama,
            no_telepon: formattedPhone,
            alamat: alamat,
            tanggal_daftar: isEditing ? petaniData.find(p => p.id === currentPetaniId)?.tanggal_daftar : new Date().toISOString().split('T')[0],
            created_at: isEditing ? petaniData.find(p => p.id === currentPetaniId)?.created_at : new Date().toISOString()
        };
        
        if (isEditing) {
            // Update existing petani
            const index = petaniData.findIndex(p => p.id === currentPetaniId);
            if (index !== -1) {
                petaniData[index] = { ...petaniData[index], ...formData };
            }
            showSuccess('Data petani berhasil diperbarui!');
        } else {
            // Add new petani
            petaniData.unshift(formData);
            showSuccess('Petani baru berhasil ditambahkan!');
        }
        
        // Close modal
        petaniModal.style.display = 'none';
        document.body.style.overflow = 'auto';
        
        // Refresh table
        applyFilters();
    });
    
    // Phone number validation
    function isValidPhoneNumber(phone) {
        // Remove all non-digit characters
        const cleaned = phone.replace(/\D/g, '');
        // Check if length is between 10-14 digits
        return cleaned.length >= 10 && cleaned.length <= 14;
    }
    
    // Format phone number
    function formatPhoneNumber(phone) {
        // Remove all non-digit characters
        let cleaned = phone.replace(/\D/g, '');
        
        // If starts with 0, convert to 62
        if (cleaned.startsWith('0')) {
            cleaned = '62' + cleaned.substring(1);
        }
        
        // If starts with 8, add 62
        if (cleaned.startsWith('8')) {
            cleaned = '62' + cleaned;
        }
        
        // Format: 62-812-3456-7890
        if (cleaned.length === 12) {
            return cleaned.replace(/(\d{2})(\d{3})(\d{4})(\d{3})/, '$1-$2-$3-$4');
        }
        
        // Format: 62-812-3456-789
        if (cleaned.length === 11) {
            return cleaned.replace(/(\d{2})(\d{3})(\d{4})(\d{2})/, '$1-$2-$3-$4');
        }
        
        return cleaned;
    }
    
    // Format phone for display
    function formatPhoneForDisplay(phone) {
        const cleaned = phone.replace(/\D/g, '');
        
        if (cleaned.startsWith('62')) {
            return '0' + cleaned.substring(2);
        }
        
        return phone;
    }
    
    // Close modal
    cancelPetaniBtn.addEventListener('click', function() {
        petaniModal.style.display = 'none';
        document.body.style.overflow = 'auto';
    });
    
    document.querySelector('.close-modal').addEventListener('click', function() {
        petaniModal.style.display = 'none';
        document.body.style.overflow = 'auto';
    });
    
    // Load petani table
    function loadPetaniTable() {
        petaniTableBody.innerHTML = '';
        
        const startIndex = (currentPage - 1) * itemsPerPage;
        const endIndex = startIndex + itemsPerPage;
        const pageData = filteredData.slice(startIndex, endIndex);
        
        if (pageData.length === 0) {
            petaniTableBody.style.display = 'none';
            emptyState.style.display = 'block';
        } else {
            petaniTableBody.style.display = 'table-row-group';
            emptyState.style.display = 'none';
            
            pageData.forEach((petani, index) => {
                const globalIndex = startIndex + index + 1;
                const row = document.createElement('tr');
                row.className = 'petani-row';
                
                // Format alamat singkat
                const alamatSingkat = petani.alamat.length > 60 ? 
                    petani.alamat.substring(0, 60) + '...' : petani.alamat;
                
                // Format tanggal
                const tanggal = new Date(petani.tanggal_daftar);
                const formattedDate = tanggal.toLocaleDateString('id-ID', {
                    day: '2-digit',
                    month: 'short',
                    year: 'numeric'
                });
                
                // Format phone for display
                const phoneDisplay = formatPhoneForDisplay(petani.no_telepon);
                
                row.innerHTML = `
                    <td style="padding: 12px; color: var(--text-light);">${globalIndex}</td>
                    <td style="padding: 12px;">
                        <div style="font-weight: 600; color: var(--text-dark);">${petani.nama}</div>
                    </td>
                    <td style="padding: 12px;">
                        <div class="phone-display">
                            <i class="fas fa-phone phone-icon"></i>
                            <span style="color: var(--text-dark);">${phoneDisplay}</span>
                        </div>
                    </td>
                    <td style="padding: 12px; color: var(--text-light); font-size: 14px;">
                        ${alamatSingkat}
                    </td>
                    <td style="padding: 12px; color: var(--text-light); font-size: 14px;">
                        ${formattedDate}
                    </td>
                    <td style="padding: 12px;">
                        <div class="action-buttons">
                            <button type="button" class="btn-action btn-detail" data-id="${petani.id}" title="Lihat Detail">
                                <i class="fas fa-eye"></i>
                            </button>
                            <button type="button" class="btn-action btn-edit" data-id="${petani.id}" title="Edit Data">
                                <i class="fas fa-edit"></i>
                            </button>
                            <button type="button" class="btn-action btn-delete" data-id="${petani.id}" title="Hapus Data">
                                <i class="fas fa-trash"></i>
                            </button>
                        </div>
                    </td>
                `;
                
                petaniTableBody.appendChild(row);
            });
        }
        
        // Update counts
        document.getElementById('showingCount').textContent = pageData.length;
        document.getElementById('totalCount').textContent = filteredData.length;
        
        // Update pagination
        updatePagination();
        
        // Add event listeners
        addActionListeners();
    }
    
    // Add action listeners to buttons
    function addActionListeners() {
        // Detail buttons
        document.querySelectorAll('.btn-action.btn-detail').forEach(btn => {
            btn.addEventListener('click', function() {
                const petaniId = parseInt(this.dataset.id);
                showPetaniDetail(petaniId);
            });
        });
        
        // Edit buttons
        document.querySelectorAll('.btn-action.btn-edit').forEach(btn => {
            btn.addEventListener('click', function() {
                const petaniId = parseInt(this.dataset.id);
                openEditModal(petaniId);
            });
        });
        
        // Delete buttons
        document.querySelectorAll('.btn-action.btn-delete').forEach(btn => {
            btn.addEventListener('click', function() {
                const petaniId = parseInt(this.dataset.id);
                deletePetani(petaniId);
            });
        });
    }
    
    // Show petani detail
    function showPetaniDetail(petaniId) {
        const petani = petaniData.find(p => p.id === petaniId);
        if (!petani) return;
        
        // Format tanggal
        const tanggalDaftar = new Date(petani.tanggal_daftar);
        const formattedDate = tanggalDaftar.toLocaleDateString('id-ID', {
            weekday: 'long',
            year: 'numeric',
            month: 'long',
            day: 'numeric'
        });
        
        // Format phone for display
        const phoneDisplay = formatPhoneForDisplay(petani.no_telepon);
        
        // Initial name for avatar
        const initials = petani.nama.split(' ').map(n => n[0]).join('').toUpperCase().substring(0, 2);
        
        const detailHTML = `
            <div class="detail-header">
                <div class="detail-avatar">
                    ${initials}
                </div>
                <div class="detail-info">
                    <h3>${petani.nama}</h3>
                    <p>Petani Mitra</p>
                </div>
            </div>
            
            <div class="detail-section">
                <div class="detail-label">No. Telepon</div>
                <div class="detail-value" style="color: var(--primary); font-size: 18px;">
                    <i class="fas fa-phone" style="margin-right: 10px;"></i>${phoneDisplay}
                </div>
            </div>
            
            <div class="detail-section">
                <div class="detail-label">Alamat Lengkap</div>
                <div class="detail-value" style="line-height: 1.6;">
                    ${petani.alamat.replace(/,/g, '<br>')}
                </div>
            </div>
            
            <div class="detail-section">
                <div class="detail-label">Tanggal Daftar</div>
                <div class="detail-value">${formattedDate}</div>
            </div>
        `;
        
        document.getElementById('detailContent').innerHTML = detailHTML;
        detailModal.style.display = 'flex';
        document.body.style.overflow = 'hidden';
    }
    
    // Close detail modal
    document.querySelector('.close-detail-modal').addEventListener('click', function() {
        detailModal.style.display = 'none';
        document.body.style.overflow = 'auto';
    });
    
    document.getElementById('closeDetailBtn').addEventListener('click', function() {
        detailModal.style.display = 'none';
        document.body.style.overflow = 'auto';
    });
    
    // Delete petani
    function deletePetani(petaniId) {
        if (confirm('Apakah Anda yakin ingin menghapus data petani ini?')) {
            petaniData = petaniData.filter(p => p.id !== petaniId);
            applyFilters();
            showSuccess('Data petani berhasil dihapus!');
        }
    }
    
    // Update pagination
    function updatePagination() {
        const totalPages = Math.ceil(filteredData.length / itemsPerPage);
        const paginationNumbers = document.getElementById('paginationNumbers');
        
        // Clear existing pagination
        paginationNumbers.innerHTML = '';
        
        // Create page numbers
        const maxVisiblePages = 5;
        let startPage = Math.max(1, currentPage - Math.floor(maxVisiblePages / 2));
        let endPage = Math.min(totalPages, startPage + maxVisiblePages - 1);
        
        if (endPage - startPage + 1 < maxVisiblePages) {
            startPage = Math.max(1, endPage - maxVisiblePages + 1);
        }
        
        for (let i = startPage; i <= endPage; i++) {
            const pageBtn = document.createElement('button');
            pageBtn.type = 'button';
            pageBtn.className = `pagination-number ${i === currentPage ? 'active' : ''}`;
            pageBtn.textContent = i;
            pageBtn.dataset.page = i;
            
            pageBtn.addEventListener('click', function() {
                currentPage = parseInt(this.dataset.page);
                loadPetaniTable();
            });
            
            paginationNumbers.appendChild(pageBtn);
        }
        
        // Update prev/next buttons
        const prevBtn = document.querySelector('.btn-pagination.prev');
        const nextBtn = document.querySelector('.btn-pagination.next');
        
        prevBtn.disabled = currentPage === 1;
        nextBtn.disabled = currentPage === totalPages;
        
        prevBtn.style.opacity = currentPage === 1 ? '0.5' : '1';
        nextBtn.style.opacity = currentPage === totalPages ? '0.5' : '1';
    }
    
    // Pagination prev/next
    document.querySelector('.btn-pagination.prev').addEventListener('click', function() {
        if (currentPage > 1) {
            currentPage--;
            loadPetaniTable();
        }
    });
    
    document.querySelector('.btn-pagination.next').addEventListener('click', function() {
        const totalPages = Math.ceil(filteredData.length / itemsPerPage);
        if (currentPage < totalPages) {
            currentPage++;
            loadPetaniTable();
        }
    });
    
    // Update stats
    function updateStats() {
        const total = petaniData.length;
        const kontak = petaniData.filter(p => p.no_telepon && p.no_telepon.trim() !== '').length;
        const alamatLengkap = petaniData.filter(p => p.alamat && p.alamat.length > 20).length;
        
        // Count petani added this month
        const currentMonth = new Date().getMonth();
        const currentYear = new Date().getFullYear();
        const terbaru = petaniData.filter(p => {
            const date = new Date(p.tanggal_daftar);
            return date.getMonth() === currentMonth && date.getFullYear() === currentYear;
        }).length;
        
        totalPetani.textContent = total;
        totalKontak.textContent = kontak;
        totalAlamat.textContent = alamatLengkap;
        terbaruCount.textContent = terbaru;
    }
    
    // Export to Excel
    exportPetaniBtn.addEventListener('click', function() {
        this.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Menyiapkan...';
        
        setTimeout(() => {
            // Create CSV content
            let csv = 'Nama,No Telepon,Alamat,Tanggal Daftar\n';
            
            petaniData.forEach(petani => {
                const row = [
                    `"${petani.nama}"`,
                    `"${formatPhoneForDisplay(petani.no_telepon)}"`,
                    `"${petani.alamat}"`,
                    `"${petani.tanggal_daftar}"`
                ];
                csv += row.join(',') + '\n';
            });
            
            // Create and download file
            const blob = new Blob([csv], { type: 'text/csv;charset=utf-8;' });
            const link = document.createElement('a');
            link.href = URL.createObjectURL(blob);
            link.download = `data-petani-${new Date().toISOString().split('T')[0]}.csv`;
            link.click();
            
            this.innerHTML = '<i class="fas fa-file-excel"></i> Export Excel';
            
            showSuccess('Data petani berhasil diexport ke file CSV!');
        }, 1000);
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
    
    // Initialize with some data
    window.addEventListener('load', function() {
        // Set default sort to newest
        sortBy.value = 'terbaru';
        applyFilters();
        
        // Add click event to table headers for sorting
        document.querySelectorAll('thead th').forEach((th, index) => {
            if (index !== 0 && index !== 5) { // Skip No and Aksi columns
                th.style.cursor = 'pointer';
                th.addEventListener('click', function() {
                    const columnName = this.textContent.trim();
                    sortTable(columnName);
                });
            }
        });
    });
    
    // Sort table by column
    function sortTable(columnName) {
        switch(columnName) {
            case 'Nama Petani':
                sortBy.value = sortBy.value === 'nama_asc' ? 'nama_desc' : 'nama_asc';
                break;
            case 'Tanggal Daftar':
                sortBy.value = sortBy.value === 'terbaru' ? 'terlama' : 'terbaru';
                break;
        }
        applyFilters();
    }
});
</script>
@endsection

@section('styles')
@endsection

@section('scripts')
@endsection