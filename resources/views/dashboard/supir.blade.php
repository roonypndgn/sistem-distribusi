@extends('layouts.supir')

@section('title', 'Dashboard Sopir - PT. Mardua Holong')

@section('page-title', 'Dashboard Sopir')
@section('page-subtitle', 'Logistik')
@section('welcome-message', 'Selamat datang, ' . (Auth::user()->name ?? 'Sopir') . '!')

@section('content')
    <!-- Active Delivery Card -->
    <div class="active-delivery-card">
        <div class="delivery-title">Pengiriman Aktif</div>
        <div class="delivery-code">#JKT-245</div>
        <div class="delivery-route">Berastagi → Jakarta (via Medan)</div>
        <span class="delivery-status">Dalam Perjalanan</span>
        
        <div class="delivery-actions">
            <button class="delivery-btn delivery-btn-start" id="startJourneyBtn">
                <i class="fas fa-play-circle"></i> Mulai Perjalanan
            </button>
            <button class="delivery-btn delivery-btn-update" id="updateDeliveryBtn">
                <i class="fas fa-edit"></i> Update Status
            </button>
        </div>
    </div>
    
    <!-- Statistik Cards -->
    <div class="content-grid">
        <div class="content-card">
            <div class="card-title">
                <span>Total Pengiriman Bulan Ini</span>
                <div class="card-icon">
                    <i class="fas fa-truck"></i>
                </div>
            </div>
            <div class="stat-number">12</div>
            <div class="stat-label">+2 dari bulan lalu</div>
        </div>
        
        <div class="content-card">
            <div class="card-title">
                <span>Jarak Tempuh</span>
                <div class="card-icon">
                    <i class="fas fa-road"></i>
                </div>
            </div>
            <div class="stat-number">3,450 km</div>
            <div class="stat-label">Rata-rata 115 km/hari</div>
        </div>
        
        <div class="content-card">
            <div class="card-title">
                <span>Waktu Rata-rata</span>
                <div class="card-icon">
                    <i class="fas fa-clock"></i>
                </div>
            </div>
            <div class="stat-number">18.5 jam</div>
            <div class="stat-label">Per pengiriman Berastagi-Jakarta</div>
        </div>
        
        <div class="content-card">
            <div class="card-title">
                <span>Rating Pengiriman</span>
                <div class="card-icon">
                    <i class="fas fa-star"></i>
                </div>
            </div>
            <div class="stat-number">4.8/5.0</div>
            <div class="stat-label">Berdasarkan 24 penilaian</div>
        </div>
    </div>
    
    <!-- Tracking & Delivery List -->
    <div class="content-grid">
        <div class="content-card" style="grid-column: span 2;">
            <div class="card-title">
                <span>Tracking Lokasi & Rute</span>
                <div class="card-icon">
                    <i class="fas fa-map-marked-alt"></i>
                </div>
            </div>
            
            <div class="map-container">
                <!-- Map simulation -->
                <div class="map-overlay">
                    <div class="map-route">
                        <div class="map-point">
                            <div class="map-point-dot map-point-start"></div>
                            <span style="font-size: 13px; font-weight: 500;">Berastagi</span>
                        </div>
                        <div style="flex: 1; height: 2px; background-color: var(--primary); margin: 0 10px;"></div>
                        <div class="map-point">
                            <div class="map-point-dot map-point-end"></div>
                            <span style="font-size: 13px; font-weight: 500;">Jakarta</span>
                        </div>
                    </div>
                    <div class="map-eta">
                        <i class="fas fa-clock"></i> Estimasi tiba: 5 jam 30 menit lagi
                    </div>
                </div>
                
                <!-- Map markers simulation -->
                <div style="position: absolute; top: 50%; left: 40%; transform: translate(-50%, -50%);">
                    <div style="width: 30px; height: 30px; background-color: var(--primary); border-radius: 50%; border: 3px solid white; box-shadow: 0 0 10px rgba(0,0,0,0.3); display: flex; align-items: center; justify-content: center; color: white;">
                        <i class="fas fa-truck"></i>
                    </div>
                    <div style="position: absolute; top: 40px; left: -20px; background-color: white; padding: 5px 10px; border-radius: 5px; font-size: 12px; box-shadow: 0 2px 5px rgba(0,0,0,0.1); white-space: nowrap;">
                        <strong>Lokasi Saat Ini:</strong> KM 45 Tol Cipali
                    </div>
                </div>
            </div>
            
            <div class="timeline">
                <div class="timeline-item">
                    <div class="timeline-dot active"></div>
                    <div class="timeline-content">
                        <div class="timeline-title">Loading Barang Selesai</div>
                        <div class="timeline-time">Hari ini, 08:30 - Gudang Berastagi</div>
                    </div>
                </div>
                <div class="timeline-item">
                    <div class="timeline-dot active"></div>
                    <div class="timeline-content">
                        <div class="timeline-title">Berangkat dari Berastagi</div>
                        <div class="timeline-time">Hari ini, 09:15</div>
                    </div>
                </div>
                <div class="timeline-item">
                    <div class="timeline-dot"></div>
                    <div class="timeline-content">
                        <div class="timeline-title">Transit Medan</div>
                        <div class="timeline-time">Estimasi: 12:00 - 13:00</div>
                    </div>
                </div>
                <div class="timeline-item">
                    <div class="timeline-dot"></div>
                    <div class="timeline-content">
                        <div class="timeline-title">Tiba di Jakarta</div>
                        <div class="timeline-time">Estimasi: 18:00 - Gudang Jakarta</div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="content-card">
            <div class="card-title">
                <span>Daftar Pengiriman Hari Ini</span>
                <div class="card-icon">
                    <i class="fas fa-list"></i>
                </div>
            </div>
            
            <div class="delivery-list">
                <div class="delivery-item">
                    <div class="delivery-icon">
                        <i class="fas fa-truck"></i>
                    </div>
                    <div class="delivery-content">
                        <div class="delivery-header">
                            <div class="delivery-code-small">#JKT-245</div>
                            <div class="delivery-time">09:15</div>
                        </div>
                        <div class="delivery-route-small">Berastagi → Jakarta</div>
                        <span class="delivery-status-badge status-ongoing">Dalam Perjalanan</span>
                    </div>
                </div>
                
                <div class="delivery-item">
                    <div class="delivery-icon">
                        <i class="fas fa-clock"></i>
                    </div>
                    <div class="delivery-content">
                        <div class="delivery-header">
                            <div class="delivery-code-small">#BDG-189</div>
                            <div class="delivery-time">Besok, 07:00</div>
                        </div>
                        <div class="delivery-route-small">Berastagi → Bandung</div>
                        <span class="delivery-status-badge status-pending">Menunggu</span>
                    </div>
                </div>
                
                <div class="delivery-item">
                    <div class="delivery-icon">
                        <i class="fas fa-check-circle"></i>
                    </div>
                    <div class="delivery-content">
                        <div class="delivery-header">
                            <div class="delivery-code-small">#JKT-244</div>
                            <div class="delivery-time">Kemarin</div>
                        </div>
                        <div class="delivery-route-small">Berastagi → Jakarta</div>
                        <span class="delivery-status-badge status-delivered">Selesai</span>
                    </div>
                </div>
            </div>
            
            <div style="margin-top: 20px;">
                <h4 style="margin-bottom: 10px; color: var(--text-dark); font-size: 14px;">Rincian Barang</h4>
                <div style="background-color: var(--bg-light); border-radius: 8px; padding: 15px;">
                    <div style="display: flex; justify-content: space-between; margin-bottom: 8px; font-size: 13px;">
                        <span>Jeruk Grade A</span>
                        <span>800 kg</span>
                    </div>
                    <div style="display: flex; justify-content: space-between; margin-bottom: 8px; font-size: 13px;">
                        <span>Jeruk Grade B</span>
                        <span>400 kg</span>
                    </div>
                    <div style="display: flex; justify-content: space-between; font-size: 13px; font-weight: 600; border-top: 1px solid var(--border); padding-top: 8px;">
                        <span>Total</span>
                        <span>1,200 kg</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Notifikasi & Input Waktu -->
    <div class="content-grid">
        <div class="content-card">
            <div class="card-title">
                <span>Input Waktu Pengiriman</span>
                <div class="card-icon">
                    <i class="fas fa-clock"></i>
                </div>
            </div>
            
            <form id="timeForm" action="#" method="POST">
                @csrf
                <div class="form-group">
                    <label class="form-label">Kode Pengiriman</label>
                    <select name="kode_pengiriman" class="form-select" required>
                        <option value="">-- Pilih Pengiriman --</option>
                        <option value="JKT-245">#JKT-245 (Berastagi → Jakarta)</option>
                        <option value="BDG-189">#BDG-189 (Berastagi → Bandung)</option>
                    </select>
                </div>
                
                <div class="form-group">
                    <label class="form-label">Waktu Berangkat</label>
                    <input type="datetime-local" name="waktu_berangkat" class="form-control" required>
                </div>
                
                <div class="form-group">
                    <label class="form-label">Waktu Tiba</label>
                    <input type="datetime-local" name="waktu_tiba" class="form-control">
                    <small style="font-size: 12px; color: var(--text-light);">Kosongkan jika belum tiba</small>
                </div>
                
                <div class="form-group">
                    <label class="form-label">Catatan Perjalanan</label>
                    <textarea name="catatan" class="form-control" rows="3" placeholder="Kondisi jalan, cuaca, kendala..."></textarea>
                </div>
                
                <button type="submit" class="btn btn-primary btn-block">
                    <i class="fas fa-save"></i> Simpan Waktu
                </button>
            </form>
        </div>
        
        <div class="content-card" style="grid-column: span 2;">
            <div class="card-title">
                <span>Notifikasi & Aktivitas Terbaru</span>
                <div class="card-icon">
                    <i class="fas fa-bell"></i>
                </div>
            </div>
            
            <div class="delivery-list">
                <div class="delivery-item">
                    <div class="delivery-icon" style="background-color: #FFF3CD; color: #856404;">
                        <i class="fas fa-exclamation-circle"></i>
                    </div>
                    <div class="delivery-content">
                        <div class="delivery-header">
                            <div class="delivery-code-small">Peringatan Cuaca</div>
                            <div class="delivery-time">10 menit lalu</div>
                        </div>
                        <div class="delivery-route-small">Hujan sedang terjadi di sekitar Tol Cipali. Harap berhati-hati!</div>
                    </div>
                </div>
                
                <div class="delivery-item">
                    <div class="delivery-icon" style="background-color: #D4EDDA; color: #155724;">
                        <i class="fas fa-check-circle"></i>
                    </div>
                    <div class="delivery-content">
                        <div class="delivery-header">
                            <div class="delivery-code-small">Pengiriman Disetujui</div>
                            <div class="delivery-time">1 jam lalu</div>
                        </div>
                        <div class="delivery-route-small">Pengiriman #JKT-245 telah disetujui oleh pusat.</div>
                    </div>
                </div>
                
                <div class="delivery-item">
                    <div class="delivery-icon" style="background-color: #D1ECF1; color: #0C5460;">
                        <i class="fas fa-info-circle"></i>
                    </div>
                    <div class="delivery-content">
                        <div class="delivery-header">
                            <div class="delivery-code-small">Pengingat Jadwal</div>
                            <div class="delivery-time">3 jam lalu</div>
                        </div>
                        <div class="delivery-route-small">Pengiriman #BDG-189 besok pukul 07:00. Pastikan kendaraan siap!</div>
                    </div>
                </div>
                
                <div class="delivery-item">
                    <div class="delivery-icon">
                        <i class="fas fa-map-marker-alt"></i>
                    </div>
                    <div class="delivery-content">
                        <div class="delivery-header">
                            <div class="delivery-code-small">Update Lokasi</div>
                            <div class="delivery-time">4 jam lalu</div>
                        </div>
                        <div class="delivery-route-small">Lokasi Anda terdeteksi di KM 45 Tol Cipali.</div>
                    </div>
                </div>
            </div>
            
            <div style="margin-top: 20px; padding: 15px; background-color: var(--primary-lighter); border-radius: 10px;">
                <div style="display: flex; align-items: center; gap: 10px;">
                    <i class="fas fa-gas-pump" style="color: var(--primary);"></i>
                    <div>
                        <div style="font-weight: 600; color: var(--text-dark);">Info Bahan Bakar:</div>
                        <div style="font-size: 13px; color: var(--text-light);">Sisa bahan bakar: 45%. SPBU terdekat: Rest Area KM 50 Tol Cipali.</div>
                    </div>
                </div>
            </div>
            
            <!-- Vehicle Information -->
            <div style="margin-top: 20px; padding: 15px; background-color: #E8F5F0; border-radius: 10px;">
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 15px;">
                    <div>
                        <div style="font-weight: 600; color: var(--text-dark); font-size: 14px; margin-bottom: 5px;">Informasi Kendaraan</div>
                        <div style="font-size: 13px; color: var(--text-light);">
                            <div><strong>Plat:</strong> B 1234 ABC</div>
                            <div><strong>Merk:</strong> Hino</div>
                            <div><strong>Kapasitas:</strong> 5 ton</div>
                        </div>
                    </div>
                    <div>
                        <div style="font-weight: 600; color: var(--text-dark); font-size: 14px; margin-bottom: 5px;">Servis Terakhir</div>
                        <div style="font-size: 13px; color: var(--text-light);">
                            <div><strong>Tanggal:</strong> 15 {{ date('M Y', strtotime('-1 month')) }}</div>
                            <div><strong>KM:</strong> 45,320 km</div>
                            <div><strong>Servis Berikutnya:</strong> 50,000 km</div>
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
        // Update delivery progress
        function updateDeliveryProgress() {
            const progressFill = document.querySelector('.progress-fill');
            if (progressFill) {
                // Simulate progress based on time of day
                const now = new Date();
                const hour = now.getHours();
                let progress = 0;
                
                if (hour >= 9 && hour < 12) progress = 20;
                else if (hour >= 12 && hour < 15) progress = 50;
                else if (hour >= 15 && hour < 18) progress = 80;
                else if (hour >= 18) progress = 100;
                
                progressFill.style.width = progress + '%';
            }
        }
        
        // Initialize progress
        updateDeliveryProgress();
        setInterval(updateDeliveryProgress, 60000); // Update every minute
        
        // Time form submission handler
        const timeForm = document.getElementById('timeForm');
        if (timeForm) {
            timeForm.addEventListener('submit', function(e) {
                // In real application, this would be handled by Laravel
                // This is just for demo
                e.preventDefault();
                
                const formData = new FormData(this);
                const kode = formData.get('kode_pengiriman');
                const berangkat = formData.get('waktu_berangkat');
                
                // Show success message
                alert(`Waktu pengiriman ${kode} berhasil disimpan!`);
                this.reset();
            });
        }
        
        // Update status button handler
        const updateDeliveryBtn = document.getElementById('updateDeliveryBtn');
        if (updateDeliveryBtn) {
            updateDeliveryBtn.addEventListener('click', function() {
                // This would open the status modal
                console.log('Opening status update modal');
            });
        }
    });
</script>
@endpush