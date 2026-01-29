@extends('layouts.pusat')

@section('title', 'Dashboard Utama - Sistem Distribusi PT. Mardua Holong')

@section('page-title', 'Dashboard Utama')

@section('content')
    <!-- Statistik Cards -->
    <div class="content-grid">
        <div class="content-card">
            <div class="card-title">
                <span>Total Produksi Hari Ini</span>
                <div class="card-icon">
                    <i class="fas fa-seedling"></i>
                </div>
            </div>
            <div class="stat-number">2,450 kg</div>
            <div class="stat-label">+15% dari kemarin</div>
        </div>
        
        <div class="content-card">
            <div class="card-title">
                <span>Pengiriman Aktif</span>
                <div class="card-icon">
                    <i class="fas fa-truck-loading"></i>
                </div>
            </div>
            <div class="stat-number">8</div>
            <div class="stat-label">Dalam perjalanan</div>
        </div>
        
        <div class="content-card">
            <div class="card-title">
                <span>Pendapatan Bulan Ini</span>
                <div class="card-icon">
                    <i class="fas fa-money-bill-wave"></i>
                </div>
            </div>
            <div class="stat-number">Rp 850 Jt</div>
            <div class="stat-label">Target: Rp 1 M</div>
        </div>
        
        <div class="content-card">
            <div class="card-title">
                <span>Petani Aktif</span>
                <div class="card-icon">
                    <i class="fas fa-users"></i>
                </div>
            </div>
            <div class="stat-number">124</div>
            <div class="stat-label">+8 petani baru</div>
        </div>
    </div>
    
    <!-- Charts & Notifikasi -->
    <div class="content-grid">
        <div class="content-card" style="grid-column: span 2;">
            <div class="card-title">
                <span>Grafik Produksi 7 Hari Terakhir (kg)</span>
                <div class="card-icon">
                    <i class="fas fa-chart-line"></i>
                </div>
            </div>
            <div class="demo-chart">
                <div class="chart-bar" style="height: 65%;"></div>
                <div class="chart-bar" style="height: 75%;"></div>
                <div class="chart-bar" style="height: 90%;"></div>
                <div class="chart-bar" style="height: 85%;"></div>
                <div class="chart-bar" style="height: 95%;"></div>
                <div class="chart-bar" style="height: 80%;"></div>
                <div class="chart-bar" style="height: 70%;"></div>
            </div>
        </div>
        
        <div class="content-card">
            <div class="card-title">
                <span>Aktivitas Terbaru</span>
                <div class="card-icon">
                    <i class="fas fa-bell"></i>
                </div>
            </div>
            <div style="margin-top: 10px;">
                <div style="padding: 10px; background-color: var(--primary-lighter); border-radius: 8px; margin-bottom: 10px; font-size: 13px;">
                    <div style="font-weight: 600; color: var(--primary);">Panen Selesai</div>
                    <div style="color: var(--text-light);">Ladang Simalungun - 500 kg</div>
                    <div style="font-size: 11px; color: var(--text-lighter);">30 menit lalu</div>
                </div>
                <div style="padding: 10px; background-color: var(--primary-lighter); border-radius: 8px; margin-bottom: 10px; font-size: 13px;">
                    <div style="font-weight: 600; color: var(--primary);">Pengiriman #JKT-235</div>
                    <div style="color: var(--text-light);">Tiba di Jakarta - 2 jam lalu</div>
                    <div style="font-size: 11px; color: var(--text-lighter);">1.2 ton jeruk</div>
                </div>
                <div style="padding: 10px; background-color: var(--primary-lighter); border-radius: 8px; font-size: 13px;">
                    <div style="font-weight: 600; color: var(--primary);">Pembayaran Petani</div>
                    <div style="color: var(--text-light);">10 transaksi berhasil</div>
                    <div style="font-size: 11px; color: var(--text-lighter);">Total: Rp 45 juta</div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Quick Actions -->
    <div class="content-grid">
        <div class="content-card">
            <div class="card-title">
                <span>Quick Actions</span>
                <div class="card-icon">
                    <i class="fas fa-bolt"></i>
                </div>
            </div>
            <div style="display: flex; flex-direction: column; gap: 10px; margin-top: 15px;">
                <a href="#" style="padding: 10px; background-color: var(--primary-lighter); border: none; border-radius: 8px; color: var(--primary); font-weight: 500; cursor: pointer; text-align: left; display: flex; align-items: center; gap: 10px; text-decoration: none;">
                    <i class="fas fa-plus-circle"></i> Tambah Data Petani
                </a>
                <a href="#" style="padding: 10px; background-color: var(--primary-lighter); border: none; border-radius: 8px; color: var(--primary); font-weight: 500; cursor: pointer; text-align: left; display: flex; align-items: center; gap: 10px; text-decoration: none;">
                    <i class="fas fa-file-export"></i> Generate Laporan
                </a>
                <a href="#" style="padding: 10px; background-color: var(--primary-lighter); border: none; border-radius: 8px; color: var(--primary); font-weight: 500; cursor: pointer; text-align: left; display: flex; align-items: center; gap: 10px; text-decoration: none;">
                    <i class="fas fa-chart-pie"></i> Lihat Analitik
                </a>
            </div>
        </div>
        
        <div class="content-card" style="grid-column: span 2;">
            <div class="card-title">
                <span>Status Pengiriman Real-time</span>
                <div class="card-icon">
                    <i class="fas fa-map-marked-alt"></i>
                </div>
            </div>
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 15px; margin-top: 15px;">
                <div style="padding: 15px; background-color: #E8F5F0; border-radius: 10px;">
                    <div style="font-weight: 600; color: var(--primary);">#JKT-238</div>
                    <div style="font-size: 12px; color: var(--text-light);">Medan → Jakarta</div>
                    <div style="display: flex; align-items: center; gap: 5px; margin-top: 5px;">
                        <div style="width: 10px; height: 10px; background-color: #4CAF50; border-radius: 50%;"></div>
                        <span style="font-size: 12px; color: var(--text-dark);">Dalam Perjalanan</span>
                    </div>
                </div>
                <div style="padding: 15px; background-color: #E8F5F0; border-radius: 10px;">
                    <div style="font-weight: 600; color: var(--primary);">#BDG-142</div>
                    <div style="font-size: 12px; color: var(--text-light);">Berastagi → Bandung</div>
                    <div style="display: flex; align-items: center; gap: 5px; margin-top: 5px;">
                        <div style="width: 10px; height: 10px; background-color: #FFC107; border-radius: 50%;"></div>
                        <span style="font-size: 12px; color: var(--text-dark);">Loading</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Recent Reports -->
    <div class="content-card">
        <div class="card-title">
            <span>Laporan Terbaru</span>
            <div class="card-icon">
                <i class="fas fa-file-alt"></i>
            </div>
        </div>
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 15px; margin-top: 15px;">
            <div style="padding: 15px; background-color: var(--bg-light); border-radius: 10px;">
                <div style="font-weight: 600; color: var(--primary);">Laporan Harian</div>
                <div style="font-size: 12px; color: var(--text-light);">Tanggal: {{ date('d/m/Y') }}</div>
                <div style="margin-top: 10px; font-size: 14px;">Total Produksi: 2,450 kg</div>
                <a href="#" style="display: inline-block; margin-top: 10px; color: var(--primary); font-size: 12px; text-decoration: none;">
                    <i class="fas fa-download"></i> Download PDF
                </a>
            </div>
            <div style="padding: 15px; background-color: var(--bg-light); border-radius: 10px;">
                <div style="font-weight: 600; color: var(--primary);">Laporan Mingguan</div>
                <div style="font-size: 12px; color: var(--text-light);">Minggu ke-{{ date('W') }}</div>
                <div style="margin-top: 10px; font-size: 14px;">Total Pendapatan: Rp 850 Jt</div>
                <a href="#" style="display: inline-block; margin-top: 10px; color: var(--primary); font-size: 12px; text-decoration: none;">
                    <i class="fas fa-download"></i> Download Excel
                </a>
            </div>
            <div style="padding: 15px; background-color: var(--bg-light); border-radius: 10px;">
                <div style="font-weight: 600; color: var(--primary);">Analisis Tren Harga</div>
                <div style="font-size: 12px; color: var(--text-light);">Update: {{ date('d/m/Y') }}</div>
                <div style="margin-top: 10px; font-size: 14px;">Harga Rata-rata: Rp 12,500/kg</div>
                <a href="#" style="display: inline-block; margin-top: 10px; color: var(--primary); font-size: 12px; text-decoration: none;">
                    <i class="fas fa-chart-line"></i> Lihat Grafik
                </a>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script>
    // Demo chart animation
    document.addEventListener('DOMContentLoaded', function() {
        const chartBars = document.querySelectorAll('.chart-bar');
        chartBars.forEach((bar, index) => {
            // Add animation delay
            bar.style.animationDelay = `${index * 0.1}s`;
        });
    });
</script>
@endpush