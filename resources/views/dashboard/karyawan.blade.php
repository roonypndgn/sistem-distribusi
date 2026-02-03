@extends('layouts.karyawan')

@section('title', 'Dashboard Karyawan - PT. Mardua Holong')

@section('page-title', 'Dashboard Karyawan')
@section('page-subtitle', 'Divisi Packing')
@section('welcome-message', 'Selamat bekerja, ' . (Auth::user()->name ?? 'Karyawan') . '!')

@section('content')
    <!-- Attendance Card -->
    <div class="attendance-card">
        <div class="attendance-title">Absensi Hari Ini</div>
        <div class="attendance-time" id="currentTime">--:--</div>
        <div class="attendance-date" id="currentDate">-- --- ----</div>
        
        <div class="attendance-actions">
            <button class="attendance-btn attendance-btn-in" id="btnCheckIn">
                <i class="fas fa-sign-in-alt"></i> CHECK IN
            </button>
            <button class="attendance-btn attendance-btn-out" id="btnCheckOut" disabled>
                <i class="fas fa-sign-out-alt"></i> CHECK OUT
            </button>
        </div>
    </div>
    
    <!-- Statistik Cards -->
    <div class="content-grid">
        <div class="content-card">
            <div class="card-title">
                <span>Jam Kerja Bulan Ini</span>
                <div class="card-icon">
                    <i class="fas fa-clock"></i>
                </div>
            </div>
            <div class="stat-number">168 jam</div>
            <div class="stat-label">Target: 176 jam</div>
            <div class="progress-bar">
                <div class="progress-fill" style="width: 95%"></div>
            </div>
        </div>
        
        <div class="content-card">
            <div class="card-title">
                <span>Gaji Bulan Ini</span>
                <div class="card-icon">
                    <i class="fas fa-money-bill-wave"></i>
                </div>
            </div>
            <div class="stat-number">Rp 4.2 Jt</div>
            <div class="stat-label">Akan cair: 25 {{ date('M Y') }}</div>
        </div>
    </div>
    
    
    <!-- Jadwal & Aktivitas -->
    <div class="content-grid">
        <div class="content-card" style="grid-column: span 2;">
            <div class="card-title">
                <span>Aktivitas & Notifikasi</span>
                <div class="card-icon">
                    <i class="fas fa-history"></i>
                </div>
            </div>
            
            <div class="activity-list">
                <div class="activity-item">
                    <div class="activity-icon" style="background-color: #D4EDDA; color: #155724;">
                        <i class="fas fa-money-check-alt"></i>
                    </div>
                    <div class="activity-content">
                        <div class="activity-title">Pembayaran Gaji {{ date('F', strtotime('-1 month')) }}</div>
                        <div class="activity-time">Rp 4,150,000 telah ditransfer ke rekening Anda</div>
                        <div style="font-size: 11px; color: #155724;">2 hari yang lalu</div>
                    </div>
                </div>
                <div class="activity-item">
                    <div class="activity-icon" style="background-color: #FFF3CD; color: #856404;">
                        <i class="fas fa-exclamation-triangle"></i>
                    </div>
                    <div class="activity-content">
                        <div class="activity-title">Insentif Packing Tambahan</div>
                        <div class="activity-time">Anda mendapatkan bonus Rp 150,000 untuk performa packing bulan lalu</div>
                        <div style="font-size: 11px; color: #856404;">1 minggu yang lalu</div>
                    </div>
                </div>
                <div class="activity-item">
                    <div class="activity-icon">
                        <i class="fas fa-fingerprint"></i>
                    </div>
                    <div class="activity-content">
                        <div class="activity-title">Check In Pagi Ini</div>
                        <div class="activity-time">Anda check in pada 07:58 - Tidak terlambat</div>
                        <div style="font-size: 11px; color: var(--text-light);">Hari ini, 07:58</div>
                    </div>
                </div>
                <div class="activity-item">
                    <div class="activity-icon">
                        <i class="fas fa-boxes"></i>
                    </div>
                    <div class="activity-content">
                        <div class="activity-title">Target Packing Tercapai</div>
                        <div class="activity-time">Anda telah mencapai 95% target packing minggu ini</div>
                        <div style="font-size: 11px; color: var(--text-light);">Kemarin, 16:30</div>
                    </div>
                </div>
            </div>
            
            <div style="margin-top: 20px; padding: 15px; background-color: var(--primary-lighter); border-radius: 10px;">
                <div style="display: flex; align-items: center; gap: 10px;">
                    <i class="fas fa-info-circle" style="color: var(--primary);"></i>
                    <div>
                        <div style="font-weight: 600; color: var(--text-dark);">Info Penting:</div>
                        <div style="font-size: 13px; color: var(--text-light);">
                            Gaji bulan {{ date('F') }} akan dibayarkan pada tanggal 25 {{ date('F Y') }} melalui transfer bank.
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script>
    // Custom JavaScript for dashboard interactions
    document.addEventListener('DOMContentLoaded', function() {
        // Packing form submission handler
        const packingForm = document.getElementById('packingForm');
        if (packingForm) {
            packingForm.addEventListener('submit', function(e) {
                // In real application, this would be handled by Laravel
                // This is just for demo
                e.preventDefault();
                
                const formData = new FormData(this);
                const jenis = formData.get('jenis_packing');
                const jumlah = formData.get('jumlah_box');
                
                // Show success message
                alert(`Hasil packing ${jumlah} box ${getPackingLabel(jenis)} berhasil disimpan!`);
                this.reset();
            });
        }
        
        function getPackingLabel(jenis) {
            const labels = {
                'jeruk-besar': 'Jeruk Besar',
                'jeruk-sedang': 'Jeruk Sedang',
                'jeruk-kecil': 'Jeruk Kecil',
                'premium': 'Premium Grade A'
            };
            return labels[jenis] || jenis;
        }
    });
</script>
@endpush