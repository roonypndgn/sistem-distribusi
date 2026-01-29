@extends('layouts.manajer')

@section('title', 'Dashboard Manajer Lapangan - PT. Mardua Holong')

@section('page-title', 'Dashboard Lapangan')
@section('page-subtitle', 'Berastagi')
@section('welcome-message', 'Selamat datang, ' . (Auth::user()->name ?? 'Manajer Lapangan'))

@section('content')
    <!-- Statistik Cards -->
    <div class="content-grid">
        <div class="content-card">
            <div class="card-title">
                <span>Panen Hari Ini</span>
                <div class="card-icon">
                    <i class="fas fa-seedling"></i>
                </div>
            </div>
            <div class="stat-number">1,850 kg</div>
            <div class="stat-label">Dari 8 ladang aktif</div>
        </div>
        
        <div class="content-card">
            <div class="card-title">
                <span>Pembelian Tertunda</span>
                <div class="card-icon">
                    <i class="fas fa-money-bill-wave"></i>
                </div>
            </div>
            <div class="stat-number">3</div>
            <div class="stat-label">Menunggu verifikasi pusat</div>
        </div>
        
        <div class="content-card">
            <div class="card-title">
                <span>Pengiriman Aktif</span>
                <div class="card-icon">
                    <i class="fas fa-truck"></i>
                </div>
            </div>
            <div class="stat-number">4</div>
            <div class="stat-label">Dalam perjalanan</div>
        </div>
        
        <div class="content-card">
            <div class="card-title">
                <span>Cuaca Hari Ini</span>
                <div class="card-icon">
                    <i class="fas fa-cloud-sun"></i>
                </div>
            </div>
            <div class="stat-number">Cerah</div>
            <div class="stat-label">Suhu: 24°C, Kelembapan: 75%</div>
        </div>
    </div>
    
    <!-- Quick Input Section -->
    <div class="content-grid">
        <div class="content-card" style="grid-column: span 3;">
            <div class="card-title">
                <span>Input Data Cepat</span>
                <div class="card-icon">
                    <i class="fas fa-bolt"></i>
                </div>
            </div>
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 20px; margin-top: 15px;">
                <!-- Harga Pembelian -->
                <a href="#" class="quick-input-card">
                    <div class="quick-input-icon">
                        <i class="fas fa-money-bill-wave"></i>
                    </div>
                    <div class="quick-input-title">Input Harga Pembelian</div>
                    <div class="quick-input-desc">Catat harga beli jeruk dari petani</div>
                </a>
                
                <!-- Data Panen -->
                <a href="#" class="quick-input-card">
                    <div class="quick-input-icon">
                        <i class="fas fa-seedling"></i>
                    </div>
                    <div class="quick-input-title">Input Data Panen</div>
                    <div class="quick-input-desc">Catat hasil panen per ladang</div>
                </a>
                
                <!-- Pengemasan -->
                <a href="#" class="quick-input-card">
                    <div class="quick-input-icon">
                        <i class="fas fa-box"></i>
                    </div>
                    <div class="quick-input-title">Input Pengemasan</div>
                    <div class="quick-input-desc">Data packing & kualitas jeruk</div>
                </a>
            </div>
        </div>
    </div>
    
    <!-- Aktivitas Terbaru & Rekap -->
    <div class="content-grid">
        <div class="content-card">
            <div class="card-title">
                <span>Aktivitas Hari Ini</span>
                <div class="card-icon">
                    <i class="fas fa-history"></i>
                </div>
            </div>
            <div class="activity-list">
                <div class="activity-item">
                    <div class="activity-icon">
                        <i class="fas fa-money-bill-wave"></i>
                    </div>
                    <div class="activity-content">
                        <div class="activity-title">Input Harga Pembelian</div>
                        <div class="activity-time">Petani Sinaga - 500 kg</div>
                        <span class="status-badge status-pending">Pending</span>
                    </div>
                </div>
                <div class="activity-item">
                    <div class="activity-icon">
                        <i class="fas fa-seedling"></i>
                    </div>
                    <div class="activity-content">
                        <div class="activity-title">Data Panen Ladang Simalungun</div>
                        <div class="activity-time">750 kg - Kualitas A</div>
                        <span class="status-badge status-verified">Terverifikasi</span>
                    </div>
                </div>
                <div class="activity-item">
                    <div class="activity-icon">
                        <i class="fas fa-truck"></i>
                    </div>
                    <div class="activity-content">
                        <div class="activity-title">Pengiriman ke Jakarta</div>
                        <div class="activity-time">1.2 ton - Dalam perjalanan</div>
                    </div>
                </div>
                <div class="activity-item">
                    <div class="activity-icon">
                        <i class="fas fa-cloud-sun"></i>
                    </div>
                    <div class="activity-content">
                        <div class="activity-title">Laporan Cuaca</div>
                        <div class="activity-time">Cerah, 24°C, Kelembapan 75%</div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="content-card" style="grid-column: span 2;">
            <div class="card-title">
                <span>Rekap Harian Kegiatan</span>
                <div class="card-icon">
                    <i class="fas fa-clipboard-list"></i>
                </div>
            </div>
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin-top: 15px;">
                <div>
                    <h4 style="margin-bottom: 15px; color: var(--text-dark); font-size: 15px;">Status Verifikasi</h4>
                    <div style="background-color: #D4EDDA; padding: 15px; border-radius: 8px; margin-bottom: 10px;">
                        <div style="font-weight: 600; color: #155724;">Terverifikasi: 8</div>
                        <div style="font-size: 12px; color: #155724;">Data sudah disetujui pusat</div>
                    </div>
                    <div style="background-color: #FFF3CD; padding: 15px; border-radius: 8px; margin-bottom: 10px;">
                        <div style="font-weight: 600; color: #856404;">Pending: 3</div>
                        <div style="font-size: 12px; color: #856404;">Menunggu verifikasi</div>
                    </div>
                    <div style="background-color: #F8D7DA; padding: 15px; border-radius: 8px;">
                        <div style="font-weight: 600; color: #721C24;">Ditolak: 1</div>
                        <div style="font-size: 12px; color: #721C24;">Perlu perbaikan data</div>
                    </div>
                </div>
                
                <div>
                    <h4 style="margin-bottom: 15px; color: var(--text-dark); font-size: 15px;">Target Harian</h4>
                    <div style="margin-bottom: 20px;">
                        <div style="display: flex; justify-content: space-between; margin-bottom: 5px;">
                            <span style="font-size: 14px;">Panen (2,000 kg)</span>
                            <span style="font-weight: 600; color: var(--primary);">92%</span>
                        </div>
                        <div style="height: 8px; background-color: var(--border); border-radius: 4px; overflow: hidden;">
                            <div style="width: 92%; height: 100%; background-color: var(--success);"></div>
                        </div>
                    </div>
                    <div style="margin-bottom: 20px;">
                        <div style="display: flex; justify-content: space-between; margin-bottom: 5px;">
                            <span style="font-size: 14px;">Pengiriman (5 truk)</span>
                            <span style="font-weight: 600; color: var(--primary);">80%</span>
                        </div>
                        <div style="height: 8px; background-color: var(--border); border-radius: 4px; overflow: hidden;">
                            <div style="width: 80%; height: 100%; background-color: var(--warning);"></div>
                        </div>
                    </div>
                    <div>
                        <div style="display: flex; justify-content: space-between; margin-bottom: 5px;">
                            <span style="font-size: 14px;">Input Data (100%)</span>
                            <span style="font-weight: 600; color: var(--primary);">85%</span>
                        </div>
                        <div style="height: 8px; background-color: var(--border); border-radius: 4px; overflow: hidden;">
                            <div style="width: 85%; height: 100%; background-color: var(--primary);"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script>
    // Script khusus untuk halaman dashboard
    document.addEventListener('DOMContentLoaded', function() {
        console.log('Dashboard Manajer Lapangan loaded');
    });
</script>
@endpush