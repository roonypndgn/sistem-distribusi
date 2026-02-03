@extends('layouts.karyawan')

@section('title', 'Slip Gaji - PT. Mardua Holong')

@section('page-title', 'Slip Gaji')
@section('page-subtitle', 'Lihat Riwayat dan Detail Gaji')

@section('content')
<div class="content-wrapper">
    <!-- Header -->
    <div class="content-header">
        <div class="header-left">
            <h1>Slip Gaji</h1>
            <p>Lihat riwayat dan detail slip gaji</p>
        </div>
        <div class="header-right">
            <button type="button" id="printBtn" class="btn btn-primary">
                <i class="fas fa-print"></i> Cetak Slip
            </button>
        </div>
    </div>
    
    <!-- Info Karyawan -->
    <div class="info-card" style="margin-bottom: 30px;">
        <div class="info-content">
            <div class="info-icon">
                <i class="fas fa-user-circle"></i>
            </div>
            <div class="info-details">
                <div class="info-name" id="namaKaryawan">-</div>
                <div class="info-id" id="idKaryawan">-</div>
            </div>
            <div class="info-stats">
                <div class="stat-item">
                    <div class="stat-label">Jabatan</div>
                    <div class="stat-value" id="jabatan">-</div>
                </div>
                <div class="stat-item">
                    <div class="stat-label">Bank</div>
                    <div class="stat-value" id="bank">-</div>
                </div>
                <div class="stat-item">
                    <div class="stat-label">No. Rekening</div>
                    <div class="stat-value" id="noRekening">-</div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Filter -->
    <div class="content-card" style="margin-bottom: 30px;">
        <div class="card-header">
            <div class="card-title">
                <i class="fas fa-filter"></i>
                <span>Filter Periode</span>
            </div>
        </div>
        
        <div class="filter-options">
            <div class="filter-group">
                <label class="filter-label">Tahun</label>
                <select id="filterTahun" class="form-control">
                    <option value="2024">2024</option>
                    <option value="2023">2023</option>
                    <option value="2022">2022</option>
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
                <label class="filter-label">Status</label>
                <select id="filterStatus" class="form-control">
                    <option value="">Semua Status</option>
                    <option value="dibayar">Dibayar</option>
                    <option value="belum">Belum Dibayar</option>
                </select>
            </div>
            
            <div class="filter-group">
                <label class="filter-label">&nbsp;</label>
                <button type="button" id="applyFilterBtn" class="btn btn-primary">
                    <i class="fas fa-search"></i> Terapkan
                </button>
            </div>
        </div>
    </div>
    
    <!-- Daftar Slip Gaji -->
    <div class="content-card">
        <div class="card-header">
            <div class="card-title">
                <i class="fas fa-file-invoice-dollar"></i>
                <span>Daftar Slip Gaji</span>
            </div>
            <div class="card-info">
                Menampilkan <span id="showingCount">0</span> dari <span id="totalCount">0</span> slip gaji
            </div>
        </div>
        
        <div class="table-responsive">
            <table class="data-table">
                <thead>
                    <tr>
                        <th style="width: 50px;">No</th>
                        <th>Periode Gaji</th>
                        <th>Gaji Pokok</th>
                        <th>Insentif</th>
                        <th>Potongan</th>
                        <th>Take Home Pay</th>
                        <th>Status</th>
                        <th style="width: 80px;">Aksi</th>
                    </tr>
                </thead>
                <tbody id="slipTableBody">
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
</div>

<!-- Modal Detail Slip Gaji -->
<div id="detailModal" class="modal">
    <div class="modal-content modal-lg">
        <div class="modal-header">
            <h3 class="modal-title">Detail Slip Gaji</h3>
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
            <button type="button" class="btn btn-primary" id="printDetailBtn">
                <i class="fas fa-print"></i> Cetak
            </button>
        </div>
    </div>
</div>

@push('styles')
<link rel="stylesheet" href="{{ asset('css/karyawan/slip-gaji.css') }}">
@endpush

@push('scripts')
<script src="{{ asset('js/karyawan/slip-gaji.js') }}"></script>
@endpush
@endsection