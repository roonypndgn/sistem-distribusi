@extends('layouts.pusat')

@section('title', 'Data Penggajian - PT. Mardua Holong')

@section('page-title', 'Data Penggajian Karyawan')
@section('page-subtitle', 'Kelola penggajian dan pembayaran karyawan')

@section('content')
<div class="content-wrapper">
    <!-- Header -->
    <div class="content-header">
        <div class="header-left">
            <h1>Data Penggajian</h1>
            <p>Kelola penggajian dan pembayaran seluruh karyawan</p>
        </div>
        <div class="header-right">
            <div class="header-stats">
                <div class="stat-item">
                    <span class="stat-label">Total Gaji Bulan Ini</span>
                    <span class="stat-value" id="totalGajiBulanIni">Rp 0</span>
                </div>
                <div class="stat-item">
                    <span class="stat-label">Belum Dibayar</span>
                    <span class="stat-value" id="belumDibayarCount">0</span>
                </div>
            </div>
            <button type="button" id="generateGajiBtn" class="btn btn-primary">
                <i class="fas fa-calculator"></i> Generate Gaji
            </button>
        </div>
    </div>
    
    <!-- Dashboard Stats -->
    <div class="dashboard-stats">
        <div class="stat-card stat-card-primary">
            <div class="stat-icon">
                <i class="fas fa-money-bill-wave"></i>
            </div>
            <div class="stat-info">
                <div class="stat-label">Total Penggajian</div>
                <div class="stat-value" id="totalPenggajian">Rp 0</div>
                <div class="stat-change">Semua periode</div>
            </div>
        </div>
        
        <div class="stat-card stat-card-success">
            <div class="stat-icon">
                <i class="fas fa-check-circle"></i>
            </div>
            <div class="stat-info">
                <div class="stat-label">Sudah Dibayar</div>
                <div class="stat-value" id="sudahDibayarCount">0</div>
                <div class="stat-change positive">Lunas 100%</div>
            </div>
        </div>
        
        <div class="stat-card stat-card-warning">
            <div class="stat-icon">
                <i class="fas fa-clock"></i>
            </div>
            <div class="stat-info">
                <div class="stat-label">Belum Dibayar</div>
                <div class="stat-value" id="belumDibayarStats">0</div>
                <div class="stat-change negative">Perlu penanganan</div>
            </div>
        </div>
        
        <div class="stat-card stat-card-info">
            <div class="stat-icon">
                <i class="fas fa-users"></i>
            </div>
            <div class="stat-info">
                <div class="stat-label">Karyawan Aktif</div>
                <div class="stat-value" id="karyawanAktifCount">0</div>
                <div class="stat-change">Jumlah penerima gaji</div>
            </div>
        </div>
    </div>
    
    <!-- Filter dan Pencarian -->
    <div class="content-card" style="margin-bottom: 30px;">
        <div class="card-header">
            <div class="card-title">
                <i class="fas fa-filter"></i>
                <span>Filter Data Penggajian</span>
            </div>
            <div class="card-actions">
                <div class="search-box">
                    <i class="fas fa-search"></i>
                    <input type="text" id="searchPenggajian" placeholder="Cari nama karyawan atau periode...">
                </div>
            </div>
        </div>
        
        <div class="filter-options">
            <div class="filter-group">
                <label class="filter-label">Periode Gaji</label>
                <select id="filterPeriode" class="form-control">
                    <option value="">Semua Periode</option>
                    <option value="2024-03">Maret 2024</option>
                    <option value="2024-02">Februari 2024</option>
                    <option value="2024-01">Januari 2024</option>
                    <option value="2023-12">Desember 2023</option>
                </select>
            </div>
            
            <div class="filter-group">
                <label class="filter-label">Status Pembayaran</label>
                <select id="filterStatus" class="form-control">
                    <option value="">Semua Status</option>
                    <option value="dibayar">Sudah Dibayar</option>
                    <option value="belum_dibayar">Belum Dibayar</option>
                </select>
            </div>
            
            <div class="filter-group">
                <label class="filter-label">Bulan</label>
                <select id="filterBulan" class="form-control">
                    <option value="">Semua Bulan</option>
                    <option value="01">Januari</option>
                    <option value="02">Februari</option>
                    <option value="03">Maret</option>
                    <option value="04">April</option>
                    <option value="05">Mei</option>
                    <option value="06">Juni</option>
                    <option value="07">Juli</option>
                    <option value="08">Agustus</option>
                    <option value="09">September</option>
                    <option value="10">Oktober</option>
                    <option value="11">November</option>
                    <option value="12">Desember</option>
                </select>
            </div>
            
            <div class="filter-group">
                <label class="filter-label">Tahun</label>
                <select id="filterTahun" class="form-control">
                    <option value="">Semua Tahun</option>
                    <option value="2024">2024</option>
                    <option value="2023">2023</option>
                    <option value="2022">2022</option>
                </select>
            </div>
            
            <div class="filter-group">
                <label class="filter-label">&nbsp;</label>
                <div style="display: flex; gap: 10px;">
                    <button type="button" id="applyFilterBtn" class="btn btn-primary">
                        <i class="fas fa-search"></i> Terapkan
                    </button>
                    <button type="button" id="resetFilterBtn" class="btn btn-secondary">
                        <i class="fas fa-redo"></i> Reset
                    </button>
                    <button type="button" id="exportExcelBtn" class="btn btn-success">
                        <i class="fas fa-file-excel"></i> Export
                    </button>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Daftar Penggajian -->
    <div class="content-card">
        <div class="card-header">
            <div class="card-title">
                <i class="fas fa-money-check-alt"></i>
                <span>Daftar Penggajian Karyawan</span>
            </div>
            <div class="card-info">
                Menampilkan <span id="showingCount">0</span> dari <span id="totalCount">0</span> data penggajian
            </div>
        </div>
        
        <div class="table-responsive">
            <table class="data-table">
                <thead>
                    <tr>
                        <th style="width: 50px;">No</th>
                        <th>Nama Karyawan</th>
                        <th>Periode</th>
                        <th>Upah Dasar</th>
                        <th>Insentif</th>
                        <th>Potongan</th>
                        <th>Total Gaji</th>
                        <th>Status</th>
                        <th>Tanggal Transfer</th>
                        <th style="width: 180px;">Aksi</th>
                    </tr>
                </thead>
                <tbody id="penggajianTableBody">
                    <!-- Data akan diisi oleh JavaScript -->
                </tbody>
            </table>
        </div>
        
        <!-- Pagination -->
        <div class="table-footer">
            <div class="showing-count">
                Halaman <span id="currentPage">1</span> dari <span id="totalPages">1</span>
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
    
    <!-- Summary Footer -->
    <div class="summary-footer">
        <div class="summary-item">
            <span class="summary-label">Total Gaji Ditampilkan:</span>
            <span class="summary-value" id="totalGajiTampil">Rp 0</span>
        </div>
        <div class="summary-item">
            <span class="summary-label">Total Insentif:</span>
            <span class="summary-value" id="totalInsentifTampil">Rp 0</span>
        </div>
        <div class="summary-item">
            <span class="summary-label">Total Potongan:</span>
            <span class="summary-value" id="totalPotonganTampil">Rp 0</span>
        </div>
        <div class="summary-item">
            <span class="summary-label">Total Bersih:</span>
            <span class="summary-value" id="totalBersihTampil">Rp 0</span>
        </div>
    </div>
</div>

<!-- Modal Generate Gaji -->
<div id="generateModal" class="modal">
    <div class="modal-content">
        <div class="modal-header">
            <h3 class="modal-title">Generate Penggajian</h3>
            <button type="button" class="close-generate-modal">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <form id="generateGajiForm">
            <div class="modal-body">
                <div class="alert alert-info">
                    <i class="fas fa-info-circle"></i>
                    Sistem akan menghitung gaji untuk semua karyawan aktif berdasarkan periode yang dipilih.
                </div>
                
                <div class="form-group">
                    <label class="form-label required">Periode Gaji</label>
                    <select id="generate_periode" name="periode" class="form-control" required>
                        <option value="">Pilih Periode</option>
                        <option value="2024-03">Maret 2024</option>
                        <option value="2024-02">Februari 2024</option>
                        <option value="2024-01">Januari 2024</option>
                        <option value="2023-12">Desember 2023</option>
                    </select>
                    <div class="form-hint">
                        Format: YYYY-MM (Tahun-Bulan)
                    </div>
                </div>
                
                <div class="form-group">
                    <label class="form-label">Tanggal Transfer</label>
                    <input type="date" id="generate_tanggal_transfer" name="tanggal_transfer" class="form-control">
                    <div class="form-hint">
                        Kosongkan jika belum ditentukan
                    </div>
                </div>
                
                <div class="form-group">
                    <label class="form-label">Include Insentif</label>
                    <div class="checkbox-group">
                        <label class="checkbox-label">
                            <input type="checkbox" id="include_insentif" name="include_insentif" checked>
                            <span class="checkbox-custom"></span>
                            <span class="checkbox-text">Tambahkan insentif bulanan</span>
                        </label>
                    </div>
                </div>
                
                <div class="form-group">
                    <label class="form-label">Include Potongan</label>
                    <div class="checkbox-group">
                        <label class="checkbox-label">
                            <input type="checkbox" id="include_potongan" name="include_potongan" checked>
                            <span class="checkbox-custom"></span>
                            <span class="checkbox-text">Tambahkan potongan bulanan</span>
                        </label>
                    </div>
                </div>
                
                <div class="karyawan-list">
                    <div class="list-header">
                        <h5>Daftar Karyawan yang Akan Digenerate</h5>
                        <span class="badge" id="karyawanCount">0 karyawan</span>
                    </div>
                    <div class="list-body" id="karyawanListBody">
                        <!-- List karyawan akan diisi oleh JavaScript -->
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary close-generate-modal">
                    Batal
                </button>
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-calculator"></i> Generate Gaji
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Modal Detail Penggajian -->
<div id="detailModal" class="modal">
    <div class="modal-content modal-lg">
        <div class="modal-header">
            <h3 class="modal-title">Detail Penggajian</h3>
            <button type="button" class="close-detail-modal">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <div class="modal-body" id="detailModalBody">
            <!-- Detail akan diisi oleh JavaScript -->
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary close-detail-modal">
                Tutup
            </button>
            <button type="button" class="btn btn-primary" id="cetakSlipBtn">
                <i class="fas fa-print"></i> Cetak Slip Gaji
            </button>
        </div>
    </div>
</div>

<!-- Modal Bayar Gaji -->
<div id="bayarModal" class="modal">
    <div class="modal-content">
        <div class="modal-header">
            <h3 class="modal-title">Konfirmasi Pembayaran Gaji</h3>
            <button type="button" class="close-bayar-modal">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <div class="modal-body">
            <div class="pembayaran-info">
                <div class="info-header">
                    <h5 id="namaKaryawanBayar">-</h5>
                    <div class="info-period" id="periodeGajiBayar">-</div>
                </div>
                
                <div class="amount-details">
                    <div class="amount-item">
                        <span class="amount-label">Upah Dasar</span>
                        <span class="amount-value" id="upahDasarBayar">Rp 0</span>
                    </div>
                    <div class="amount-item">
                        <span class="amount-label">Insentif</span>
                        <span class="amount-value" id="insentifBayar">Rp 0</span>
                    </div>
                    <div class="amount-item">
                        <span class="amount-label">Potongan</span>
                        <span class="amount-value" id="potonganBayar">Rp 0</span>
                    </div>
                    <div class="amount-item total">
                        <span class="amount-label">Total Dibayarkan</span>
                        <span class="amount-value" id="totalBayar">Rp 0</span>
                    </div>
                </div>
                
                <div class="form-group">
                    <label class="form-label required">Tanggal Transfer</label>
                    <input type="date" id="tanggal_transfer" class="form-control" required>
                    <div class="form-hint">
                        Tanggal transfer ke rekening karyawan
                    </div>
                </div>
                
                <div class="form-group">
                    <label class="form-label">Metode Pembayaran</label>
                    <select id="metode_pembayaran" class="form-control">
                        <option value="transfer_bank">Transfer Bank</option>
                        <option value="tunai">Tunai</option>
                        <option value="e-wallet">E-Wallet</option>
                    </select>
                </div>
                
                <div class="form-group">
                    <label class="form-label">Catatan</label>
                    <textarea id="catatan_pembayaran" class="form-control" rows="3" placeholder="Tambahkan catatan pembayaran..."></textarea>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary close-bayar-modal">
                Batal
            </button>
            <button type="button" class="btn btn-success" id="confirmBayarBtn">
                <i class="fas fa-check-circle"></i> Konfirmasi Pembayaran
            </button>
        </div>
    </div>
</div>

<!-- Modal Edit Penggajian -->
<div id="editModal" class="modal">
    <div class="modal-content">
        <div class="modal-header">
            <h3 class="modal-title">Edit Data Penggajian</h3>
            <button type="button" class="close-edit-modal">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <form id="editPenggajianForm">
            <input type="hidden" id="edit_id" name="id">
            <div class="modal-body">
                <div class="form-group">
                    <label class="form-label">Nama Karyawan</label>
                    <div class="form-control-static" id="edit_nama_karyawan">-</div>
                </div>
                
                <div class="form-group">
                    <label class="form-label">Periode Gaji</label>
                    <div class="form-control-static" id="edit_periode_gaji">-</div>
                </div>
                
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <label class="form-label required">Upah Dasar</label>
                            <div class="input-group">
                                <span class="input-group-text">Rp</span>
                                <input type="number" id="edit_total_upah_dasar" name="total_upah_dasar" 
                                       class="form-control" min="0" step="1000" required>
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label class="form-label">Insentif</label>
                            <div class="input-group">
                                <span class="input-group-text">Rp</span>
                                <input type="number" id="edit_total_insentif" name="total_insentif" 
                                       class="form-control" min="0" step="1000">
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <label class="form-label">Potongan</label>
                            <div class="input-group">
                                <span class="input-group-text">Rp</span>
                                <input type="number" id="edit_total_potongan" name="total_potongan" 
                                       class="form-control" min="0" step="1000">
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label class="form-label">Total Gaji</label>
                            <div class="form-control-static" id="edit_total_gaji">Rp 0</div>
                        </div>
                    </div>
                </div>
                
                <div class="form-group">
                    <label class="form-label">Status Pembayaran</label>
                    <select id="edit_status_pembayaran" name="status_pembayaran" class="form-control">
                        <option value="belum_dibayar">Belum Dibayar</option>
                        <option value="dibayar">Sudah Dibayar</option>
                    </select>
                </div>
                
                <div class="form-group">
                    <label class="form-label">Tanggal Transfer</label>
                    <input type="date" id="edit_tanggal_transfer" name="tanggal_transfer" class="form-control">
                </div>
                
                <div class="form-group">
                    <label class="form-label">Catatan</label>
                    <textarea id="edit_catatan" name="catatan" class="form-control" rows="3" 
                              placeholder="Tambahkan catatan jika diperlukan..."></textarea>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary close-edit-modal">
                    Batal
                </button>
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i> Update Data
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Modal Batch Payment -->
<div id="batchModal" class="modal">
    <div class="modal-content">
        <div class="modal-header">
            <h3 class="modal-title">Pembayaran Batch</h3>
            <button type="button" class="close-batch-modal">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <div class="modal-body">
            <div class="alert alert-warning">
                <i class="fas fa-exclamation-triangle"></i>
                Anda akan membayar <span id="batchCount">0</span> gaji karyawan sekaligus.
            </div>
            
            <div class="form-group">
                <label class="form-label required">Tanggal Transfer</label>
                <input type="date" id="batch_tanggal_transfer" class="form-control" required>
            </div>
            
            <div class="form-group">
                <label class="form-label">Metode Pembayaran</label>
                <select id="batch_metode_pembayaran" class="form-control">
                    <option value="transfer_bank">Transfer Bank</option>
                    <option value="tunai">Tunai</option>
                </select>
            </div>
            
            <div class="karyawan-batch-list">
                <div class="list-header">
                    <h5>Daftar Karyawan yang Akan Dibayar</h5>
                </div>
                <div class="list-body" id="batchListBody">
                    <!-- List batch akan diisi oleh JavaScript -->
                </div>
            </div>
            
            <div class="batch-summary">
                <div class="summary-item">
                    <span class="summary-label">Total Gaji:</span>
                    <span class="summary-value" id="batchTotalGaji">Rp 0</span>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary close-batch-modal">
                Batal
            </button>
            <button type="button" class="btn btn-success" id="confirmBatchBtn">
                <i class="fas fa-check-circle"></i> Bayar Semua
            </button>
        </div>
    </div>
</div>

<!-- Modal Report -->
<div id="reportModal" class="modal">
    <div class="modal-content modal-lg">
        <div class="modal-header">
            <h3 class="modal-title">Laporan Penggajian</h3>
            <button type="button" class="close-report-modal">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <div class="modal-body">
            <div class="report-filters">
                <div class="filter-group">
                    <label class="filter-label">Periode</label>
                    <select id="report_periode" class="form-control">
                        <option value="bulan-ini">Bulan Ini</option>
                        <option value="triwulan">Triwulan Terakhir</option>
                        <option value="tahun-ini">Tahun Ini</option>
                        <option value="custom">Custom</option>
                    </select>
                </div>
                
                <div class="filter-group">
                    <label class="filter-label">Dari Tanggal</label>
                    <input type="date" id="report_start_date" class="form-control">
                </div>
                
                <div class="filter-group">
                    <label class="filter-label">Sampai Tanggal</label>
                    <input type="date" id="report_end_date" class="form-control">
                </div>
                
                <div class="filter-group">
                    <label class="filter-label">&nbsp;</label>
                    <button type="button" id="generateReportBtn" class="btn btn-primary">
                        <i class="fas fa-chart-bar"></i> Generate
                    </button>
                </div>
            </div>
            
            <div class="report-content">
                <div class="report-summary">
                    <h4>Ringkasan Laporan</h4>
                    <div class="summary-grid">
                        <div class="summary-item">
                            <div class="summary-label">Total Penggajian</div>
                            <div class="summary-value">Rp 0</div>
                        </div>
                        <div class="summary-item">
                            <div class="summary-label">Rata-rata Gaji</div>
                            <div class="summary-value">Rp 0</div>
                        </div>
                        <div class="summary-item">
                            <div class="summary-label">Total Karyawan</div>
                            <div class="summary-value">0</div>
                        </div>
                        <div class="summary-item">
                            <div class="summary-label">Status</div>
                            <div class="summary-value">-</div>
                        </div>
                    </div>
                </div>
                
                <div class="report-charts">
                    <canvas id="gajiChart" width="400" height="200"></canvas>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary close-report-modal">
                Tutup
            </button>
            <button type="button" class="btn btn-success" id="exportReportBtn">
                <i class="fas fa-file-pdf"></i> Export PDF
            </button>
        </div>
    </div>
</div>

<style>
    /* ==============================
       VARIABLES & BASE STYLES
       ============================== */
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
    
    /* ==============================
       HEADER STYLES
       ============================== */
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
        align-items: center;
        gap: 30px;
    }
    
    .header-stats {
        display: flex;
        gap: 20px;
    }
    
    .stat-item {
        text-align: right;
    }
    
    .stat-label {
        display: block;
        font-size: 12px;
        color: var(--text-light);
        margin-bottom: 2px;
    }
    
    .stat-value {
        font-size: 24px;
        font-weight: 700;
        color: var(--primary);
    }
    
    /* ==============================
       DASHBOARD STATS
       ============================== */
    .dashboard-stats {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
        gap: 20px;
        margin-bottom: 30px;
    }
    
    .stat-card {
        background: white;
        border-radius: 12px;
        padding: 20px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.05);
        border: 1px solid var(--border);
        display: flex;
        align-items: center;
        gap: 15px;
        transition: var(--transition);
    }
    
    .stat-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(0,0,0,0.1);
    }
    
    .stat-card-primary {
        border-left: 4px solid var(--primary);
    }
    
    .stat-card-success {
        border-left: 4px solid var(--success);
    }
    
    .stat-card-warning {
        border-left: 4px solid var(--warning);
    }
    
    .stat-card-info {
        border-left: 4px solid var(--info);
    }
    
    .stat-icon {
        width: 50px;
        height: 50px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 24px;
        background: var(--primary-lighter);
        color: var(--primary);
    }
    
    .stat-card-success .stat-icon {
        background: #E8F5E9;
        color: var(--success);
    }
    
    .stat-card-warning .stat-icon {
        background: #FFF3E0;
        color: var(--warning);
    }
    
    .stat-card-info .stat-icon {
        background: #E3F2FD;
        color: var(--info);
    }
    
    .stat-info {
        flex: 1;
    }
    
    .stat-label {
        font-size: 12px;
        color: var(--text-light);
        margin-bottom: 5px;
    }
    
    .stat-value {
        font-size: 24px;
        font-weight: 700;
        color: var(--text-dark);
        margin-bottom: 3px;
    }
    
    .stat-change {
        font-size: 11px;
        color: var(--text-light);
    }
    
    .stat-change.positive {
        color: var(--success);
    }
    
    .stat-change.negative {
        color: var(--danger);
    }
    
    /* ==============================
       CARD STYLES
       ============================== */
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
    
    .card-info {
        font-size: 14px;
        color: var(--text-light);
    }
    
    .card-actions {
        display: flex;
        gap: 10px;
    }
    
    /* Search Box */
    .search-box {
        position: relative;
        width: 300px;
    }
    
    .search-box i {
        position: absolute;
        left: 12px;
        top: 50%;
        transform: translateY(-50%);
        color: var(--text-light);
        font-size: 14px;
    }
    
    .search-box input {
        width: 100%;
        padding: 10px 10px 10px 36px;
        border: 1px solid var(--border);
        border-radius: 8px;
        font-size: 14px;
        transition: var(--transition);
    }
    
    .search-box input:focus {
        outline: none;
        border-color: var(--primary);
        box-shadow: 0 0 0 3px rgba(45, 106, 79, 0.1);
    }
    
    /* ==============================
       FILTER STYLES
       ============================== */
    .filter-options {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 20px;
        align-items: end;
    }
    
    .filter-group {
        margin-bottom: 0;
    }
    
    .filter-label {
        display: block;
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
    
    .form-control-static {
        padding: 12px 15px;
        background-color: var(--light);
        border-radius: 8px;
        font-size: 14px;
        color: var(--text-dark);
    }
    
    /* ==============================
       TABLE STYLES
       ============================== */
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
    
    /* Amount Styles */
    .amount-cell {
        font-family: monospace;
        font-weight: 600;
    }
    
    .amount-positive {
        color: var(--success);
    }
    
    .amount-negative {
        color: var(--danger);
    }
    
    /* Status Badge */
    .status-badge {
        display: inline-block;
        padding: 6px 12px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 600;
        text-align: center;
        min-width: 120px;
    }
    
    .badge-dibayar {
        background-color: #E8F5E9;
        color: #2E7D32;
        border: 1px solid #C8E6C9;
    }
    
    .badge-belum_dibayar {
        background-color: #FFF3E0;
        color: #EF6C00;
        border: 1px solid #FFE0B2;
    }
    
    /* ==============================
       PAGINATION STYLES
       ============================== */
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
    
    .showing-count span {
        font-weight: 600;
        color: var(--text-dark);
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
    
    /* ==============================
       ACTION BUTTONS
       ============================== */
    .action-buttons {
        display: flex;
        gap: 8px;
        flex-wrap: wrap;
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
    
    .btn-bayar {
        background-color: #E8F5E9;
        color: #2E7D32;
    }
    
    .btn-bayar:hover {
        background-color: #2E7D32;
        color: white;
    }
    
    .btn-edit {
        background-color: #FFF3E0;
        color: #EF6C00;
    }
    
    .btn-edit:hover {
        background-color: #EF6C00;
        color: white;
    }
    
    .btn-print {
        background-color: #E3F2FD;
        color: #1565C0;
    }
    
    .btn-print:hover {
        background-color: #1565C0;
        color: white;
    }
    
    /* ==============================
       SUMMARY FOOTER
       ============================== */
    .summary-footer {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 20px;
        background: white;
        border-radius: 12px;
        padding: 20px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.05);
        border: 1px solid var(--border);
        margin-top: 20px;
    }
    
    .summary-item {
        text-align: center;
        padding: 15px;
        background: var(--light);
        border-radius: 8px;
    }
    
    .summary-label {
        display: block;
        font-size: 12px;
        color: var(--text-light);
        margin-bottom: 5px;
    }
    
    .summary-value {
        font-size: 18px;
        font-weight: 700;
        color: var(--primary);
        font-family: monospace;
    }
    
    /* ==============================
       MODAL STYLES
       ============================== */
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
        max-width: 600px;
        max-height: 90vh;
        overflow-y: auto;
        animation: modalFadeIn 0.3s ease;
    }
    
    .modal-lg {
        max-width: 800px;
    }
    
    .modal-sm {
        max-width: 400px;
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
    
    .close-generate-modal,
    .close-detail-modal,
    .close-bayar-modal,
    .close-edit-modal,
    .close-batch-modal,
    .close-report-modal {
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
    
    .close-generate-modal:hover,
    .close-detail-modal:hover,
    .close-bayar-modal:hover,
    .close-edit-modal:hover,
    .close-batch-modal:hover,
    .close-report-modal:hover {
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
    
    /* ==============================
       GENERATE MODAL STYLES
       ============================== */
    .alert {
        padding: 12px 16px;
        border-radius: 8px;
        margin-bottom: 20px;
        display: flex;
        align-items: flex-start;
        gap: 10px;
    }
    
    .alert-info {
        background-color: #E3F2FD;
        color: #1565C0;
        border: 1px solid #BBDEFB;
    }
    
    .alert-warning {
        background-color: #FFF3E0;
        color: #EF6C00;
        border: 1px solid #FFE0B2;
    }
    
    .karyawan-list {
        margin-top: 20px;
        border: 1px solid var(--border);
        border-radius: 8px;
        overflow: hidden;
    }
    
    .list-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 12px 16px;
        background-color: var(--light);
        border-bottom: 1px solid var(--border);
    }
    
    .list-header h5 {
        margin: 0;
        font-size: 14px;
        font-weight: 600;
        color: var(--text-dark);
    }
    
    .list-header .badge {
        background-color: var(--primary);
        color: white;
        padding: 4px 8px;
        border-radius: 20px;
        font-size: 11px;
        font-weight: 600;
    }
    
    .list-body {
        max-height: 200px;
        overflow-y: auto;
    }
    
    .karyawan-item {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 10px 16px;
        border-bottom: 1px solid var(--border);
    }
    
    .karyawan-item:last-child {
        border-bottom: none;
    }
    
    .karyawan-info {
        flex: 1;
    }
    
    .karyawan-name {
        font-weight: 600;
        color: var(--text-dark);
        margin-bottom: 2px;
    }
    
    .karyawan-role {
        font-size: 12px;
        color: var(--text-light);
    }
    
    .karyawan-salary {
        font-weight: 600;
        color: var(--primary);
        font-family: monospace;
    }
    
    /* ==============================
       DETAIL MODAL STYLES
       ============================== */
    .detail-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 20px;
        margin-bottom: 25px;
    }
    
    .detail-item {
        padding: 15px;
        background: var(--light);
        border-radius: 8px;
        border-left: 4px solid var(--primary);
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
        font-weight: 600;
        color: var(--text-dark);
    }
    
    .detail-subvalue {
        font-size: 14px;
        color: var(--text-light);
        margin-top: 3px;
    }
    
    .amount-breakdown {
        margin-top: 30px;
    }
    
    .breakdown-item {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 12px 0;
        border-bottom: 1px solid var(--border);
    }
    
    .breakdown-item:last-child {
        border-bottom: none;
    }
    
    .breakdown-label {
        font-size: 14px;
        color: var(--text-dark);
    }
    
    .breakdown-value {
        font-family: monospace;
        font-weight: 600;
        color: var(--text-dark);
    }
    
    .breakdown-total {
        font-size: 18px;
        color: var(--primary);
    }
    
    /* ==============================
       BAYAR MODAL STYLES
       ============================== */
    .pembayaran-info {
        margin-bottom: 20px;
    }
    
    .info-header {
        text-align: center;
        margin-bottom: 25px;
        padding-bottom: 15px;
        border-bottom: 1px solid var(--border);
    }
    
    .info-header h5 {
        margin: 0 0 8px 0;
        font-size: 18px;
        color: var(--text-dark);
    }
    
    .info-period {
        color: var(--text-light);
        font-size: 14px;
    }
    
    .amount-details {
        background: var(--light);
        border-radius: 8px;
        padding: 15px;
        margin-bottom: 25px;
    }
    
    .amount-item {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 8px 0;
    }
    
    .amount-item.total {
        border-top: 2px solid var(--primary);
        margin-top: 10px;
        padding-top: 12px;
    }
    
    .amount-label {
        font-size: 14px;
        color: var(--text-dark);
    }
    
    .amount-value {
        font-family: monospace;
        font-weight: 600;
        color: var(--text-dark);
    }
    
    .amount-item.total .amount-value {
        color: var(--primary);
        font-size: 18px;
    }
    
    /* ==============================
       BATCH MODAL STYLES
       ============================== */
    .karyawan-batch-list {
        margin-top: 20px;
        border: 1px solid var(--border);
        border-radius: 8px;
        overflow: hidden;
    }
    
    .batch-summary {
        margin-top: 20px;
        padding: 15px;
        background: var(--light);
        border-radius: 8px;
        text-align: center;
    }
    
    /* ==============================
       REPORT MODAL STYLES
       ============================== */
    .report-filters {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 20px;
        margin-bottom: 30px;
    }
    
    .report-content {
        margin-top: 20px;
    }
    
    .report-summary {
        margin-bottom: 30px;
    }
    
    .summary-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 20px;
    }
    
    .report-charts {
        height: 300px;
        margin-bottom: 30px;
    }
    
    /* ==============================
       FORM STYLES
       ============================== */
    .form-group {
        margin-bottom: 20px;
    }
    
    .form-label {
        display: block;
        margin-bottom: 8px;
        font-weight: 500;
        color: var(--text-dark);
        font-size: 14px;
    }
    
    .form-label.required::after {
        content: '*';
        color: var(--danger);
        margin-left: 4px;
    }
    
    .form-hint {
        font-size: 12px;
        color: var(--text-light);
        margin-top: 6px;
    }
    
    /* Input Group */
    .input-group {
        display: flex;
    }
    
    .input-group .input-group-text {
        padding: 12px 15px;
        background-color: var(--light);
        border: 1px solid var(--border);
        border-right: none;
        border-top-left-radius: 8px;
        border-bottom-left-radius: 8px;
        color: var(--text-light);
        font-size: 14px;
    }
    
    .input-group .form-control {
        border-top-left-radius: 0;
        border-bottom-left-radius: 0;
    }
    
    /* Checkbox Styles */
    .checkbox-group {
        margin-top: 10px;
    }
    
    .checkbox-label {
        display: flex;
        align-items: center;
        cursor: pointer;
    }
    
    .checkbox-label input[type="checkbox"] {
        display: none;
    }
    
    .checkbox-custom {
        width: 20px;
        height: 20px;
        border: 2px solid var(--border);
        border-radius: 4px;
        margin-right: 10px;
        position: relative;
        transition: var(--transition);
    }
    
    .checkbox-label input[type="checkbox"]:checked + .checkbox-custom {
        background-color: var(--primary);
        border-color: var(--primary);
    }
    
    .checkbox-label input[type="checkbox"]:checked + .checkbox-custom::after {
        content: '✓';
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        color: white;
        font-size: 12px;
        font-weight: bold;
    }
    
    .checkbox-text {
        font-size: 14px;
        color: var(--text-dark);
    }
    
    /* Row and Column */
    .row {
        display: flex;
        gap: 15px;
        margin-bottom: 15px;
    }
    
    .row:last-child {
        margin-bottom: 0;
    }
    
    .col-6 {
        flex: 1;
    }
    
    /* ==============================
       BUTTON STYLES
       ============================== */
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
    
    .btn-primary:disabled {
        opacity: 0.6;
        cursor: not-allowed;
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
    
    .btn-warning {
        background-color: var(--warning);
        color: var(--dark);
    }
    
    .btn-warning:hover {
        background-color: #e0a800;
    }
    
    .btn-danger {
        background-color: var(--danger);
        color: white;
    }
    
    .btn-danger:hover {
        background-color: #C82333;
    }
    
    /* ==============================
       RESPONSIVE STYLES
       ============================== */
    @media (max-width: 1200px) {
        .dashboard-stats {
            grid-template-columns: repeat(2, 1fr);
        }
        
        .summary-footer {
            grid-template-columns: repeat(2, 1fr);
        }
    }
    
    @media (max-width: 768px) {
        .content-header {
            flex-direction: column;
            align-items: flex-start;
        }
        
        .header-right {
            width: 100%;
            justify-content: space-between;
        }
        
        .header-stats {
            flex-direction: column;
            gap: 10px;
        }
        
        .stat-item {
            text-align: left;
        }
        
        .dashboard-stats {
            grid-template-columns: 1fr;
        }
        
        .filter-options {
            grid-template-columns: 1fr;
        }
        
        .card-header {
            flex-direction: column;
            align-items: flex-start;
        }
        
        .card-actions {
            width: 100%;
        }
        
        .search-box {
            width: 100%;
        }
        
        .table-footer {
            flex-direction: column;
            align-items: stretch;
        }
        
        .pagination {
            justify-content: center;
        }
        
        .summary-footer {
            grid-template-columns: 1fr;
        }
        
        .row {
            flex-direction: column;
        }
        
        .action-buttons {
            flex-direction: row;
            justify-content: center;
        }
        
        .btn-action {
            width: 36px;
            height: 36px;
            font-size: 16px;
        }
        
        .modal-content {
            padding: 10px;
        }
    }
    
    @media (max-width: 576px) {
        .btn {
            padding: 12px 16px;
            font-size: 13px;
        }
        
        .modal-content {
            padding: 0;
        }
        
        .detail-grid {
            grid-template-columns: 1fr;
        }
        
        .summary-grid {
            grid-template-columns: 1fr;
        }
        
        .report-filters {
            grid-template-columns: 1fr;
        }
    }
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
   
    let penggajianData = [
        {
            id: 1,
            user_id: 1,
            nama_karyawan: "Ronny Hartono",
            jabatan: "Supir",
            periode_gaji: "2024-03",
            total_upah_dasar: 5000000,
            total_insentif: 750000,
            total_potongan: 250000,
            total_gaji: 5500000,
            status_pembayaran: "dibayar",
            tanggal_transfer: "2024-03-05",
            catatan: "Pembayaran tepat waktu",
            created_at: "2024-03-01"
        },
        {
            id: 2,
            user_id: 2,
            nama_karyawan: "Rieno Larusta",
            jabatan: "Manajer Logistik",
            periode_gaji: "2024-03",
            total_upah_dasar: 8500000,
            total_insentif: 1200000,
            total_potongan: 300000,
            total_gaji: 9400000,
            status_pembayaran: "dibayar",
            tanggal_transfer: "2024-03-05",
            catatan: "",
            created_at: "2024-03-01"
        },
        {
            id: 3,
            user_id: 3,
            nama_karyawan: "Risto Siregar",
            jabatan: "Supir",
            periode_gaji: "2024-03",
            total_upah_dasar: 5000000,
            total_insentif: 500000,
            total_potongan: 150000,
            total_gaji: 5350000,
            status_pembayaran: "belum_dibayar",
            tanggal_transfer: null,
            catatan: "Menunggu konfirmasi",
            created_at: "2024-03-01"
        },
        {
            id: 4,
            user_id: 4,
            nama_karyawan: "Yekris Sinuhaji",
            jabatan: "Karyawan Packing",
            periode_gaji: "2024-03",
            total_upah_dasar: 3800000,
            total_insentif: 250000,
            total_potongan: 80000,
            total_gaji: 3970000,
            status_pembayaran: "belum_dibayar",
            tanggal_transfer: null,
            catatan: "Izin sakit 2 hari",
            created_at: "2024-03-01"
        },
        {
            id: 5,
            user_id: 5,
            nama_karyawan: "Trhesya Munthe",
            jabatan: "Supir",
            periode_gaji: "2024-02",
            total_upah_dasar: 5000000,
            total_insentif: 600000,
            total_potongan: 200000,
            total_gaji: 5400000,
            status_pembayaran: "dibayar",
            tanggal_transfer: "2024-02-05",
            catatan: "",
            created_at: "2024-02-01"
        },
        {
            id: 6,
            user_id: 6,
            nama_karyawan: "Maharani Ginting",
            jabatan: "Customer Service",
            periode_gaji: "2024-02",
            total_upah_dasar: 4200000,
            total_insentif: 200000,
            total_potongan: 50000,
            total_gaji: 4350000,
            status_pembayaran: "dibayar",
            tanggal_transfer: "2024-02-05",
            catatan: "",
            created_at: "2024-02-01"
        },
    ];

    // Data dummy karyawan aktif
    const karyawanAktif = [
        { id: 1, nama: "Ronny Hartono", jabatan: "Supir", gaji_pokok: 5000000 },
        { id: 2, nama: "Rieno Larusta", jabatan: "Manajer Logistik", gaji_pokok: 8500000 },
        { id: 3, nama: "Risto Siregar", jabatan: "Supir", gaji_pokok: 5000000 },
        { id: 4, nama: "Yekris Sinuhaji", jabatan: "Admin Gudang", gaji_pokok: 4500000 },
        { id: 5, nama: "Trhesya Munthe", jabatan: "Karyawan Packing", gaji_pokok: 3800000 },
        { id: 6, nama: "Maharani Ginting", jabatan: "Supir", gaji_pokok: 5000000 }
    ];

    // Elemen DOM
    const generateGajiBtn = document.getElementById('generateGajiBtn');
    const applyFilterBtn = document.getElementById('applyFilterBtn');
    const resetFilterBtn = document.getElementById('resetFilterBtn');
    const exportExcelBtn = document.getElementById('exportExcelBtn');
    const searchPenggajian = document.getElementById('searchPenggajian');
    const filterPeriode = document.getElementById('filterPeriode');
    const filterStatus = document.getElementById('filterStatus');
    const filterBulan = document.getElementById('filterBulan');
    const filterTahun = document.getElementById('filterTahun');
    const penggajianTableBody = document.getElementById('penggajianTableBody');
    
    // Modals
    const generateModal = document.getElementById('generateModal');
    const detailModal = document.getElementById('detailModal');
    const bayarModal = document.getElementById('bayarModal');
    const editModal = document.getElementById('editModal');
    const batchModal = document.getElementById('batchModal');
    const reportModal = document.getElementById('reportModal');
    
    // Forms
    const generateGajiForm = document.getElementById('generateGajiForm');
    const editPenggajianForm = document.getElementById('editPenggajianForm');
    
    // Buttons
    const cetakSlipBtn = document.getElementById('cetakSlipBtn');
    const confirmBayarBtn = document.getElementById('confirmBayarBtn');
    const confirmBatchBtn = document.getElementById('confirmBatchBtn');
    const generateReportBtn = document.getElementById('generateReportBtn');
    const exportReportBtn = document.getElementById('exportReportBtn');
    
    // State
    let currentPage = 1;
    const itemsPerPage = 8;
    let currentFilter = {
        search: '',
        periode: '',
        status: '',
        bulan: '',
        tahun: ''
    };
    
    let selectedPenggajianId = null;
    let selectedBatchIds = [];
    
    // Initialize
    loadPenggajianTable();
    updateStats();
    
    // Event Listeners
    generateGajiBtn.addEventListener('click', showGenerateModal);
    applyFilterBtn.addEventListener('click', applyFilters);
    resetFilterBtn.addEventListener('click', resetFilters);
    exportExcelBtn.addEventListener('click', exportToExcel);
    searchPenggajian.addEventListener('input', handleSearch);
    
    // Search dengan debounce
    let searchTimeout;
    function handleSearch() {
        clearTimeout(searchTimeout);
        searchTimeout = setTimeout(() => {
            currentFilter.search = searchPenggajian.value;
            currentPage = 1;
            loadPenggajianTable();
            updateStats();
        }, 500);
    }
    
    // Apply filters
    function applyFilters() {
        currentFilter = {
            search: searchPenggajian.value,
            periode: filterPeriode.value,
            status: filterStatus.value,
            bulan: filterBulan.value,
            tahun: filterTahun.value
        };
        
        currentPage = 1;
        loadPenggajianTable();
        updateStats();
    }
    
    // Reset filters
    function resetFilters() {
        searchPenggajian.value = '';
        filterPeriode.value = '';
        filterStatus.value = '';
        filterBulan.value = '';
        filterTahun.value = '';
        
        currentFilter = {
            search: '',
            periode: '',
            status: '',
            bulan: '',
            tahun: ''
        };
        
        currentPage = 1;
        loadPenggajianTable();
        updateStats();
    }
    
    // Export to Excel
    function exportToExcel() {
        showNotification('Mengekspor data ke Excel...', 'info');
        setTimeout(() => {
            showNotification('Data berhasil diekspor ke Excel', 'success');
        }, 1500);
    }
    
    // Load penggajian table
    function loadPenggajianTable() {
        penggajianTableBody.innerHTML = '';
        
        const filteredData = filterData(penggajianData);
        const startIndex = (currentPage - 1) * itemsPerPage;
        const endIndex = startIndex + itemsPerPage;
        const pageData = filteredData.slice(startIndex, endIndex);
        
        if (pageData.length === 0) {
            penggajianTableBody.innerHTML = `
                <tr>
                    <td colspan="10">
                        <div class="empty-state">
                            <div class="empty-state-icon">
                                <i class="fas fa-money-bill-wave"></i>
                            </div>
                            <h5 class="empty-state-title">Tidak ada data penggajian</h5>
                            <p class="empty-state-description">
                                ${currentFilter.search || currentFilter.periode || currentFilter.status || currentFilter.bulan || currentFilter.tahun 
                                    ? 'Coba ubah filter pencarian Anda' 
                                    : 'Generate gaji untuk periode tertentu'}
                            </p>
                            ${!currentFilter.search && !currentFilter.periode && !currentFilter.status && !currentFilter.bulan && !currentFilter.tahun 
                                ? '<button type="button" class="btn btn-primary" onclick="showGenerateModal()"><i class="fas fa-calculator"></i> Generate Gaji</button>' 
                                : '<button type="button" class="btn btn-secondary" onclick="resetFilters()"><i class="fas fa-redo"></i> Reset Filter</button>'}
                        </div>
                    </td>
                </tr>
            `;
        } else {
            pageData.forEach((penggajian, index) => {
                const globalIndex = startIndex + index + 1;
                const row = document.createElement('tr');
                
                // Format periode
                const formatPeriode = (periode) => {
                    const [tahun, bulan] = periode.split('-');
                    const bulanNames = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 
                                       'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
                    return `${bulanNames[parseInt(bulan)-1]} ${tahun}`;
                };
                
                // Format tanggal transfer
                const formatDate = (dateString) => {
                    if (!dateString) return '-';
                    const date = new Date(dateString);
                    return date.toLocaleDateString('id-ID', {
                        day: 'numeric',
                        month: 'short',
                        year: 'numeric'
                    });
                };
                
                // Format currency
                const formatCurrency = (amount) => {
                    return new Intl.NumberFormat('id-ID', {
                        style: 'currency',
                        currency: 'IDR',
                        minimumFractionDigits: 0
                    }).format(amount);
                };
                
                // Hitung total gaji
                const totalGaji = penggajian.total_gaji || 
                    (penggajian.total_upah_dasar + penggajian.total_insentif - penggajian.total_potongan);
                
                row.innerHTML = `
                    <td style="color: var(--text-light);">${globalIndex}</td>
                    <td>
                        <div style="font-weight: 600; color: var(--text-dark);">${penggajian.nama_karyawan}</div>
                        <div style="font-size: 12px; color: var(--text-light); margin-top: 3px;">${penggajian.jabatan}</div>
                    </td>
                    <td>
                        <div style="font-weight: 600; color: var(--text-dark);">${formatPeriode(penggajian.periode_gaji)}</div>
                    </td>
                    <td>
                        <div class="amount-cell">${formatCurrency(penggajian.total_upah_dasar)}</div>
                    </td>
                    <td>
                        <div class="amount-cell amount-positive">+ ${formatCurrency(penggajian.total_insentif)}</div>
                    </td>
                    <td>
                        <div class="amount-cell amount-negative">- ${formatCurrency(penggajian.total_potongan)}</div>
                    </td>
                    <td>
                        <div class="amount-cell" style="color: var(--primary); font-weight: 700;">
                            ${formatCurrency(totalGaji)}
                        </div>
                    </td>
                    <td>
                        <span class="status-badge badge-${penggajian.status_pembayaran}">
                            ${penggajian.status_pembayaran === 'dibayar' ? 'Sudah Dibayar' : 'Belum Dibayar'}
                        </span>
                    </td>
                    <td>
                        <div style="color: var(--text-dark);">${formatDate(penggajian.tanggal_transfer)}</div>
                    </td>
                    <td>
                        <div class="action-buttons">
                            <button type="button" class="btn-action btn-view" data-id="${penggajian.id}" title="Lihat Detail">
                                <i class="fas fa-eye"></i>
                            </button>
                            ${penggajian.status_pembayaran === 'belum_dibayar' ? `
                                <button type="button" class="btn-action btn-bayar" data-id="${penggajian.id}" title="Bayar Gaji">
                                    <i class="fas fa-check-circle"></i>
                                </button>
                            ` : ''}
                            <button type="button" class="btn-action btn-edit" data-id="${penggajian.id}" title="Edit">
                                <i class="fas fa-edit"></i>
                            </button>
                            <button type="button" class="btn-action btn-print" data-id="${penggajian.id}" title="Cetak Slip">
                                <i class="fas fa-print"></i>
                            </button>
                        </div>
                    </td>
                `;
                
                penggajianTableBody.appendChild(row);
            });
        }
        
        // Update counts
        document.getElementById('showingCount').textContent = pageData.length;
        document.getElementById('totalCount').textContent = filteredData.length;
        
        // Update summary footer
        updateSummaryFooter(filteredData);
        
        // Update pagination
        updatePagination(filteredData.length);
        
        // Add event listeners to action buttons
        addActionListeners();
    }
    
    // Filter data
    function filterData(data) {
        return data.filter(item => {
            // Filter search
            if (currentFilter.search) {
                const searchTerm = currentFilter.search.toLowerCase();
                if (!item.nama_karyawan.toLowerCase().includes(searchTerm) && 
                    !item.jabatan.toLowerCase().includes(searchTerm) &&
                    !item.periode_gaji.toLowerCase().includes(searchTerm)) {
                    return false;
                }
            }
            
            // Filter periode
            if (currentFilter.periode && item.periode_gaji !== currentFilter.periode) return false;
            
            // Filter status
            if (currentFilter.status && item.status_pembayaran !== currentFilter.status) return false;
            
            // Filter bulan
            if (currentFilter.bulan) {
                const [, bulan] = item.periode_gaji.split('-');
                if (bulan !== currentFilter.bulan) return false;
            }
            
            // Filter tahun
            if (currentFilter.tahun) {
                const [tahun] = item.periode_gaji.split('-');
                if (tahun !== currentFilter.tahun) return false;
            }
            
            return true;
        }).sort((a, b) => {
            // Sort by periode descending, then by nama
            if (a.periode_gaji !== b.periode_gaji) {
                return b.periode_gaji.localeCompare(a.periode_gaji);
            }
            return a.nama_karyawan.localeCompare(b.nama_karyawan);
        });
    }
    
    // Update statistics
    function updateStats() {
        const filteredData = filterData(penggajianData);
        const currentMonth = new Date().toISOString().slice(0, 7); // YYYY-MM
        
        // Total semua penggajian
        const totalPenggajian = filteredData.reduce((sum, item) => sum + (item.total_gaji || 
            (item.total_upah_dasar + item.total_insentif - item.total_potongan)), 0);
        
        // Data bulan ini
        const bulanIniData = penggajianData.filter(item => item.periode_gaji === currentMonth);
        const totalGajiBulanIni = bulanIniData.reduce((sum, item) => sum + (item.total_gaji || 
            (item.total_upah_dasar + item.total_insentif - item.total_potongan)), 0);
        
        // Status counts
        const sudahDibayar = filteredData.filter(item => item.status_pembayaran === 'dibayar').length;
        const belumDibayar = filteredData.filter(item => item.status_pembayaran === 'belum_dibayar').length;
        
        // Update UI
        document.getElementById('totalPenggajian').textContent = formatCurrency(totalPenggajian);
        document.getElementById('totalGajiBulanIni').textContent = formatCurrency(totalGajiBulanIni);
        document.getElementById('belumDibayarCount').textContent = belumDibayar;
        document.getElementById('sudahDibayarCount').textContent = sudahDibayar;
        document.getElementById('belumDibayarStats').textContent = belumDibayar;
        document.getElementById('karyawanAktifCount').textContent = karyawanAktif.length;
    }
    
    // Update summary footer
    function updateSummaryFooter(data) {
        const totals = data.reduce((acc, item) => {
            const totalGaji = item.total_gaji || 
                (item.total_upah_dasar + item.total_insentif - item.total_potongan);
            
            acc.upahDasar += item.total_upah_dasar;
            acc.insentif += item.total_insentif;
            acc.potongan += item.total_potongan;
            acc.totalGaji += totalGaji;
            return acc;
        }, { upahDasar: 0, insentif: 0, potongan: 0, totalGaji: 0 });
        
        document.getElementById('totalGajiTampil').textContent = formatCurrency(totals.upahDasar);
        document.getElementById('totalInsentifTampil').textContent = formatCurrency(totals.insentif);
        document.getElementById('totalPotonganTampil').textContent = formatCurrency(totals.potongan);
        document.getElementById('totalBersihTampil').textContent = formatCurrency(totals.totalGaji);
    }
    
    // Update pagination
    function updatePagination(totalItems) {
        const totalPages = Math.ceil(totalItems / itemsPerPage);
        const pageNumbers = document.getElementById('pageNumbers');
        pageNumbers.innerHTML = '';
        
        document.getElementById('currentPage').textContent = currentPage;
        document.getElementById('totalPages').textContent = totalPages;
        
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
                loadPenggajianTable();
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
        // View buttons
        document.querySelectorAll('.btn-action.btn-view').forEach(btn => {
            btn.addEventListener('click', function() {
                const penggajianId = parseInt(this.dataset.id);
                const penggajian = penggajianData.find(p => p.id === penggajianId);
                if (penggajian) {
                    showDetailModal(penggajian);
                }
            });
        });
        
        // Bayar buttons
        document.querySelectorAll('.btn-action.btn-bayar').forEach(btn => {
            btn.addEventListener('click', function() {
                const penggajianId = parseInt(this.dataset.id);
                const penggajian = penggajianData.find(p => p.id === penggajianId);
                if (penggajian) {
                    showBayarModal(penggajian);
                }
            });
        });
        
        // Edit buttons
        document.querySelectorAll('.btn-action.btn-edit').forEach(btn => {
            btn.addEventListener('click', function() {
                const penggajianId = parseInt(this.dataset.id);
                const penggajian = penggajianData.find(p => p.id === penggajianId);
                if (penggajian) {
                    showEditModal(penggajian);
                }
            });
        });
        
        // Print buttons
        document.querySelectorAll('.btn-action.btn-print').forEach(btn => {
            btn.addEventListener('click', function() {
                const penggajianId = parseInt(this.dataset.id);
                const penggajian = penggajianData.find(p => p.id === penggajianId);
                if (penggajian) {
                    cetakSlipGaji(penggajian);
                }
            });
        });
    }
    
    // Show generate modal
    function showGenerateModal() {
        // Reset form
        generateGajiForm.reset();
        
        // Set default tanggal transfer (5 hari dari sekarang)
        const tanggalTransfer = new Date();
        tanggalTransfer.setDate(tanggalTransfer.getDate() + 5);
        document.getElementById('generate_tanggal_transfer').value = tanggalTransfer.toISOString().split('T')[0];
        
        // Set default periode (bulan ini)
        const currentMonth = new Date().toISOString().slice(0, 7);
        document.getElementById('generate_periode').value = currentMonth;
        
        // Update karyawan list
        updateKaryawanList();
        
        generateModal.style.display = 'flex';
        document.body.style.overflow = 'hidden';
    }
    
    // Update karyawan list for generate modal
    function updateKaryawanList() {
        const karyawanListBody = document.getElementById('karyawanListBody');
        const karyawanCount = document.getElementById('karyawanCount');
        
        let html = '';
        karyawanAktif.forEach(karyawan => {
            // Hitung estimasi gaji (gaji pokok + insentif 10%)
            const insentif = Math.round(karyawan.gaji_pokok * 0.1);
            const potongan = Math.round(karyawan.gaji_pokok * 0.05);
            const estimasiGaji = karyawan.gaji_pokok + insentif - potongan;
            
            html += `
                <div class="karyawan-item">
                    <div class="karyawan-info">
                        <div class="karyawan-name">${karyawan.nama}</div>
                        <div class="karyawan-role">${karyawan.jabatan}</div>
                    </div>
                    <div class="karyawan-salary">${formatCurrency(estimasiGaji)}</div>
                </div>
            `;
        });
        
        karyawanListBody.innerHTML = html;
        karyawanCount.textContent = `${karyawanAktif.length} karyawan`;
    }
    
    // Show detail modal
    function showDetailModal(penggajian) {
        selectedPenggajianId = penggajian.id;
        
        // Format periode
        const formatPeriode = (periode) => {
            const [tahun, bulan] = periode.split('-');
            const bulanNames = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 
                               'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
            return `${bulanNames[parseInt(bulan)-1]} ${tahun}`;
        };
        
        // Format tanggal
        const formatDate = (dateString) => {
            if (!dateString) return '-';
            const date = new Date(dateString);
            return date.toLocaleDateString('id-ID', {
                weekday: 'long',
                day: 'numeric',
                month: 'long',
                year: 'numeric'
            });
        };
        
        // Hitung total gaji
        const totalGaji = penggajian.total_gaji || 
            (penggajian.total_upah_dasar + penggajian.total_insentif - penggajian.total_potongan);
        
        detailModalBody.innerHTML = `
            <div class="detail-grid">
                <div class="detail-item">
                    <div class="detail-label">Karyawan</div>
                    <div class="detail-value">${penggajian.nama_karyawan}</div>
                    <div class="detail-subvalue">${penggajian.jabatan}</div>
                </div>
                
                <div class="detail-item">
                    <div class="detail-label">Periode Gaji</div>
                    <div class="detail-value">${formatPeriode(penggajian.periode_gaji)}</div>
                </div>
                
                <div class="detail-item">
                    <div class="detail-label">Status Pembayaran</div>
                    <div class="detail-value">
                        <span class="status-badge badge-${penggajian.status_pembayaran}">
                            ${penggajian.status_pembayaran === 'dibayar' ? 'Sudah Dibayar' : 'Belum Dibayar'}
                        </span>
                    </div>
                    ${penggajian.tanggal_transfer ? `
                        <div class="detail-subvalue">${formatDate(penggajian.tanggal_transfer)}</div>
                    ` : ''}
                </div>
            </div>
            
            <div class="amount-breakdown">
                <h5 style="margin-bottom: 15px; color: var(--text-dark);">Rincian Gaji</h5>
                
                <div class="breakdown-item">
                    <span class="breakdown-label">Upah Dasar</span>
                    <span class="breakdown-value">${formatCurrency(penggajian.total_upah_dasar)}</span>
                </div>
                
                <div class="breakdown-item">
                    <span class="breakdown-label">Insentif</span>
                    <span class="breakdown-value" style="color: var(--success);">+ ${formatCurrency(penggajian.total_insentif)}</span>
                </div>
                
                <div class="breakdown-item">
                    <span class="breakdown-label">Potongan</span>
                    <span class="breakdown-value" style="color: var(--danger);">- ${formatCurrency(penggajian.total_potongan)}</span>
                </div>
                
                <div class="breakdown-item" style="border-top: 2px solid var(--primary); padding-top: 15px; margin-top: 10px;">
                    <span class="breakdown-label">Total Gaji Bersih</span>
                    <span class="breakdown-value breakdown-total">${formatCurrency(totalGaji)}</span>
                </div>
            </div>
            
            ${penggajian.catatan ? `
            <div style="margin-top: 25px;">
                <div class="detail-label">Catatan</div>
                <div style="background: var(--light); padding: 15px; border-radius: 8px; min-height: 60px;">
                    ${penggajian.catatan}
                </div>
            </div>
            ` : ''}
        `;
        
        detailModal.style.display = 'flex';
        document.body.style.overflow = 'hidden';
    }
    
    // Show bayar modal
    function showBayarModal(penggajian) {
        selectedPenggajianId = penggajian.id;
        
        // Format periode
        const formatPeriode = (periode) => {
            const [tahun, bulan] = periode.split('-');
            const bulanNames = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 
                               'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
            return `${bulanNames[parseInt(bulan)-1]} ${tahun}`;
        };
        
        // Hitung total gaji
        const totalGaji = penggajian.total_gaji || 
            (penggajian.total_upah_dasar + penggajian.total_insentif - penggajian.total_potongan);
        
        // Update info
        document.getElementById('namaKaryawanBayar').textContent = penggajian.nama_karyawan;
        document.getElementById('periodeGajiBayar').textContent = formatPeriode(penggajian.periode_gaji);
        document.getElementById('upahDasarBayar').textContent = formatCurrency(penggajian.total_upah_dasar);
        document.getElementById('insentifBayar').textContent = formatCurrency(penggajian.total_insentif);
        document.getElementById('potonganBayar').textContent = formatCurrency(penggajian.total_potongan);
        document.getElementById('totalBayar').textContent = formatCurrency(totalGaji);
        
        // Set default tanggal transfer (hari ini)
        document.getElementById('tanggal_transfer').value = new Date().toISOString().split('T')[0];
        
        bayarModal.style.display = 'flex';
        document.body.style.overflow = 'hidden';
    }
    
    // Show edit modal
    function showEditModal(penggajian) {
        selectedPenggajianId = penggajian.id;
        
        // Format periode
        const formatPeriode = (periode) => {
            const [tahun, bulan] = periode.split('-');
            const bulanNames = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 
                               'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
            return `${bulanNames[parseInt(bulan)-1]} ${tahun}`;
        };
        
        // Hitung total gaji
        const totalGaji = penggajian.total_gaji || 
            (penggajian.total_upah_dasar + penggajian.total_insentif - penggajian.total_potongan);
        
        // Fill form with data
        document.getElementById('edit_id').value = penggajian.id;
        document.getElementById('edit_nama_karyawan').textContent = `${penggajian.nama_karyawan} (${penggajian.jabatan})`;
        document.getElementById('edit_periode_gaji').textContent = formatPeriode(penggajian.periode_gaji);
        document.getElementById('edit_total_upah_dasar').value = penggajian.total_upah_dasar;
        document.getElementById('edit_total_insentif').value = penggajian.total_insentif;
        document.getElementById('edit_total_potongan').value = penggajian.total_potongan;
        document.getElementById('edit_total_gaji').textContent = formatCurrency(totalGaji);
        document.getElementById('edit_status_pembayaran').value = penggajian.status_pembayaran;
        document.getElementById('edit_tanggal_transfer').value = penggajian.tanggal_transfer || '';
        document.getElementById('edit_catatan').value = penggajian.catatan || '';
        
        // Add event listener to calculate total
        const upahInput = document.getElementById('edit_total_upah_dasar');
        const insentifInput = document.getElementById('edit_total_insentif');
        const potonganInput = document.getElementById('edit_total_potongan');
        
        const calculateTotal = () => {
            const upah = parseInt(upahInput.value) || 0;
            const insentif = parseInt(insentifInput.value) || 0;
            const potongan = parseInt(potonganInput.value) || 0;
            const total = upah + insentif - potongan;
            document.getElementById('edit_total_gaji').textContent = formatCurrency(total);
        };
        
        upahInput.addEventListener('input', calculateTotal);
        insentifInput.addEventListener('input', calculateTotal);
        potonganInput.addEventListener('input', calculateTotal);
        
        editModal.style.display = 'flex';
        document.body.style.overflow = 'hidden';
    }
    
    // Cetak slip gaji
    function cetakSlipGaji(penggajian) {
        showNotification('Mencetak slip gaji...', 'info');
        setTimeout(() => {
            showNotification('Slip gaji berhasil dicetak', 'success');
        }, 1000);
    }
    
    // Handle form submission - Generate
    generateGajiForm.addEventListener('submit', function(e) {
        e.preventDefault();
        
        const periode = document.getElementById('generate_periode').value;
        const includeInsentif = document.getElementById('include_insentif').checked;
        const includePotongan = document.getElementById('include_potongan').checked;
        
        // Cek apakah sudah ada gaji untuk periode ini
        const existingGaji = penggajianData.filter(p => p.periode_gaji === periode);
        if (existingGaji.length > 0) {
            if (!confirm(`Sudah ada ${existingGaji.length} data gaji untuk periode ${periode}. Generate ulang?`)) {
                return;
            }
        }
        
        // Simulate generate process
        showNotification('Mengenerate gaji untuk semua karyawan...', 'info');
        
        setTimeout(() => {
            // Tambahkan data dummy gaji baru
            karyawanAktif.forEach(karyawan => {
                const existing = penggajianData.find(p => p.user_id === karyawan.id && p.periode_gaji === periode);
                if (!existing) {
                    const insentif = includeInsentif ? Math.round(karyawan.gaji_pokok * 0.1) : 0;
                    const potongan = includePotongan ? Math.round(karyawan.gaji_pokok * 0.05) : 0;
                    const totalGaji = karyawan.gaji_pokok + insentif - potongan;
                    
                    const newGaji = {
                        id: Date.now() + Math.random(),
                        user_id: karyawan.id,
                        nama_karyawan: karyawan.nama,
                        jabatan: karyawan.jabatan,
                        periode_gaji: periode,
                        total_upah_dasar: karyawan.gaji_pokok,
                        total_insentif: insentif,
                        total_potongan: potongan,
                        total_gaji: totalGaji,
                        status_pembayaran: 'belum_dibayar',
                        tanggal_transfer: null,
                        catatan: 'Generate sistem',
                        created_at: new Date().toISOString().split('T')[0]
                    };
                    
                    penggajianData.push(newGaji);
                }
            });
            
            // Close modal
            generateModal.style.display = 'none';
            document.body.style.overflow = 'auto';
            
            // Refresh table
            currentPage = 1;
            loadPenggajianTable();
            updateStats();
            
            // Show success notification
            showNotification('Gaji berhasil digenerate', 'success');
        }, 2000);
    });
    
    // Handle form submission - Edit
    editPenggajianForm.addEventListener('submit', function(e) {
        e.preventDefault();
        
        // Find and update penggajian
        const index = penggajianData.findIndex(p => p.id === selectedPenggajianId);
        if (index !== -1) {
            const upah = parseInt(document.getElementById('edit_total_upah_dasar').value) || 0;
            const insentif = parseInt(document.getElementById('edit_total_insentif').value) || 0;
            const potongan = parseInt(document.getElementById('edit_total_potongan').value) || 0;
            const totalGaji = upah + insentif - potongan;
            
            penggajianData[index] = {
                ...penggajianData[index],
                total_upah_dasar: upah,
                total_insentif: insentif,
                total_potongan: potongan,
                total_gaji: totalGaji,
                status_pembayaran: document.getElementById('edit_status_pembayaran').value,
                tanggal_transfer: document.getElementById('edit_tanggal_transfer').value || null,
                catatan: document.getElementById('edit_catatan').value.trim()
            };
        }
        
        // Close modal
        editModal.style.display = 'none';
        document.body.style.overflow = 'auto';
        
        // Refresh table
        loadPenggajianTable();
        updateStats();
        
        // Show success notification
        showNotification('Data penggajian berhasil diperbarui', 'success');
    });
    
    // Confirm bayar button
    confirmBayarBtn.addEventListener('click', function() {
        const tanggalTransfer = document.getElementById('tanggal_transfer').value;
        const metodePembayaran = document.getElementById('metode_pembayaran').value;
        const catatan = document.getElementById('catatan_pembayaran').value;
        
        if (!tanggalTransfer) {
            showNotification('Tanggal transfer harus diisi', 'warning');
            return;
        }
        
        // Find and update penggajian
        const index = penggajianData.findIndex(p => p.id === selectedPenggajianId);
        if (index !== -1) {
            penggajianData[index] = {
                ...penggajianData[index],
                status_pembayaran: 'dibayar',
                tanggal_transfer: tanggalTransfer,
                catatan: catatan ? catatan + ' | ' + penggajianData[index].catatan : penggajianData[index].catatan
            };
        }
        
        // Close modal
        bayarModal.style.display = 'none';
        document.body.style.overflow = 'auto';
        
        // Refresh table
        loadPenggajianTable();
        updateStats();
        
        // Show success notification
        showNotification('Gaji berhasil dibayarkan', 'success');
    });
    
    // Cetak slip dari detail modal
    cetakSlipBtn.addEventListener('click', function() {
        const penggajian = penggajianData.find(p => p.id === selectedPenggajianId);
        if (penggajian) {
            cetakSlipGaji(penggajian);
        }
        detailModal.style.display = 'none';
        document.body.style.overflow = 'auto';
    });
    
    // Report buttons
    generateReportBtn.addEventListener('click', function() {
        showNotification('Membuat laporan penggajian...', 'info');
        setTimeout(() => {
            showNotification('Laporan berhasil digenerate', 'success');
        }, 1500);
    });
    
    exportReportBtn.addEventListener('click', function() {
        showNotification('Mengekspor laporan ke PDF...', 'info');
        setTimeout(() => {
            showNotification('Laporan berhasil diekspor ke PDF', 'success');
        }, 1500);
    });
    
    // Close modal buttons
    document.querySelectorAll('.close-generate-modal').forEach(btn => {
        btn.addEventListener('click', function() {
            generateModal.style.display = 'none';
            document.body.style.overflow = 'auto';
        });
    });
    
    document.querySelectorAll('.close-detail-modal').forEach(btn => {
        btn.addEventListener('click', function() {
            detailModal.style.display = 'none';
            document.body.style.overflow = 'auto';
        });
    });
    
    document.querySelectorAll('.close-bayar-modal').forEach(btn => {
        btn.addEventListener('click', function() {
            bayarModal.style.display = 'none';
            document.body.style.overflow = 'auto';
        });
    });
    
    document.querySelectorAll('.close-edit-modal').forEach(btn => {
        btn.addEventListener('click', function() {
            editModal.style.display = 'none';
            document.body.style.overflow = 'auto';
        });
    });
    
    document.querySelectorAll('.close-batch-modal').forEach(btn => {
        btn.addEventListener('click', function() {
            batchModal.style.display = 'none';
            document.body.style.overflow = 'auto';
        });
    });
    
    document.querySelectorAll('.close-report-modal').forEach(btn => {
        btn.addEventListener('click', function() {
            reportModal.style.display = 'none';
            document.body.style.overflow = 'auto';
        });
    });
    
    // Close modal when clicking outside
    [generateModal, detailModal, bayarModal, editModal, batchModal, reportModal].forEach(modal => {
        modal.addEventListener('click', function(e) {
            if (e.target === modal) {
                modal.style.display = 'none';
                document.body.style.overflow = 'auto';
            }
        });
    });
    
    // Pagination buttons
    document.querySelector('.btn-pagination.prev').addEventListener('click', function() {
        if (currentPage > 1) {
            currentPage--;
            loadPenggajianTable();
        }
    });
    
    document.querySelector('.btn-pagination.next').addEventListener('click', function() {
        const filteredData = filterData(penggajianData);
        const totalPages = Math.ceil(filteredData.length / itemsPerPage);
        
        if (currentPage < totalPages) {
            currentPage++;
            loadPenggajianTable();
        }
    });
    
    // Helper functions
    function formatCurrency(amount) {
        return new Intl.NumberFormat('id-ID', {
            style: 'currency',
            currency: 'IDR',
            minimumFractionDigits: 0
        }).format(amount);
    }
    
    function showNotification(message, type = 'info') {
        const existingNotification = document.querySelector('.notification');
        if (existingNotification) {
            existingNotification.remove();
        }
        
        const notification = document.createElement('div');
        notification.className = `notification notification-${type}`;
        notification.innerHTML = `
            <div style="display: flex; align-items: center; gap: 10px;">
                <i class="fas fa-${type === 'success' ? 'check-circle' : type === 'warning' ? 'exclamation-triangle' : type === 'danger' ? 'times-circle' : 'info-circle'}"></i>
                <span>${message}</span>
            </div>
            <button class="close-notification">
                <i class="fas fa-times"></i>
            </button>
        `;
        
        notification.style.cssText = `
            position: fixed;
            top: 20px;
            right: 20px;
            background: ${type === 'success' ? '#43A047' : type === 'warning' ? '#FB8C00' : type === 'danger' ? '#E53935' : '#1E88E5'};
            color: white;
            padding: 15px 20px;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.15);
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 15px;
            z-index: 9999;
            animation: slideIn 0.3s ease;
            max-width: 400px;
        `;
        
        const style = document.createElement('style');
        style.textContent = `
            @keyframes slideIn {
                from {
                    transform: translateX(100%);
                    opacity: 0;
                }
                to {
                    transform: translateX(0);
                    opacity: 1;
                }
            }
        `;
        document.head.appendChild(style);
        
        notification.querySelector('.close-notification').addEventListener('click', function() {
            notification.remove();
        });
        
        document.body.appendChild(notification);
        
        setTimeout(() => {
            if (notification.parentNode) {
                notification.remove();
            }
        }, 5000);
    }
});
</script>
@endsection