{{-- resources/views/supir/riwayat.blade.php --}}
@extends('layouts.supir')

@section('title', 'Riwayat Pengiriman - PT. Mardua Holong')

@section('page-title', 'Riwayat Pengiriman')
@section('page-subtitle', 'Data historis pengiriman yang telah diselesaikan')

@section('content')
<div class="content-wrapper">
    
    <!-- Statistik Ringkas -->
    <div class="stats-grid" style="margin-bottom: 30px;">
        <div class="stat-card">
            <div class="stat-icon" style="background: #E8F5E9; color: #2E7D32;">
                <i class="fas fa-check-circle"></i>
            </div>
            <div class="stat-info">
                <div class="stat-label">Total Selesai</div>
                <div class="stat-value" id="totalSelesai">0</div>
                <div class="stat-change" id="totalSelesaiChange">-</div>
            </div>
        </div>
        
        <div class="stat-card">
            <div class="stat-icon" style="background: #E3F2FD; color: #1565C0;">
                <i class="fas fa-truck"></i>
            </div>
            <div class="stat-info">
                <div class="stat-label">Total Jarak</div>
                <div class="stat-value" id="totalJarak">0 km</div>
                <div class="stat-change" id="totalJarakChange">-</div>
            </div>
        </div>
        
        <div class="stat-card">
            <div class="stat-icon" style="background: #FFF3E0; color: #EF6C00;">
                <i class="fas fa-box"></i>
            </div>
            <div class="stat-info">
                <div class="stat-label">Total Barang</div>
                <div class="stat-value" id="totalBarang">0 kg</div>
                <div class="stat-change" id="totalBarangChange">-</div>
            </div>
        </div>
        
        <div class="stat-card">
            <div class="stat-icon" style="background: #FCE4EC; color: #C2185B;">
                <i class="fas fa-clock"></i>
            </div>
            <div class="stat-info">
                <div class="stat-label">Rata-rata Waktu</div>
                <div class="stat-value" id="rataRataWaktu">0 jam</div>
                <div class="stat-change" id="rataRataWaktuChange">-</div>
            </div>
        </div>
    </div>
    
    <!-- Daftar Riwayat -->
    <div class="content-card">
        <div class="card-header">
            <div class="card-title">
                <i class="fas fa-history"></i>
                <span>Daftar Riwayat Pengiriman</span>
            </div>
            <div class="card-info">
                Menampilkan <span id="showingCount">0</span> dari <span id="totalCount">0</span> pengiriman
            </div>
        </div>
        
        <div class="table-responsive">
            <table class="data-table">
                <thead>
                    <tr>
                        <th style="width: 50px;">No</th>
                        <th>Kode</th>
                        <th>Tanggal</th>
                        <th>Kendaraan</th>
                        <th>Tujuan</th>
                        <th>Durasi</th>
                        <th>Total Muatan</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody id="riwayatTableBody">
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


@push('styles')
<link rel="stylesheet" href="{{ asset('css/supir/riwayat-pengiriman.css') }}">
@endpush

@push('scripts')
<script src="{{ asset('js/supir/riwayat-pengiriman.js') }}"></script>
@endpush
@endsection