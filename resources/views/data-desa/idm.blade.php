@extends('layouts.public')

@section('title', 'Status Indeks Desa Membangun (IDM)')

@section('content')
<main class="py-8 bg-gray-50 min-h-screen">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <div class="mb-8 text-center sm:text-left flex flex-col sm:flex-row justify-between items-center">
            <div>
                <h1 class="text-3xl font-serif font-bold text-blora-green-dark mb-2">Status IDM</h1>
                <p class="text-gray-600">Pencapaian Indeks Desa Membangun (IDM) Desa Sambongrejo</p>
            </div>
            
            @if($idms->isNotEmpty())
                @php $latestIdm = $idms->last(); @endphp
                <div class="mt-4 sm:mt-0 text-center bg-white py-2 px-6 rounded-full border border-gray-200 shadow-sm">
                    <span class="text-xs text-gray-500 uppercase tracking-wide">Status Saat Ini ({{ $latestIdm->tahun }})</span>
                    <div class="font-bold text-blora-green-dark text-lg">{{ $latestIdm->status }} <span class="text-gray-400 text-sm font-normal">({{ number_format($latestIdm->skor, 4) }})</span></div>
                </div>
            @endif
        </div>

        @if($idms->isEmpty())
            <div class="bg-white p-8 rounded-xl shadow-sm text-center border border-gray-100">
                <svg class="w-16 h-16 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/></svg>
                <h3 class="text-lg font-semibold text-gray-800 mb-1">Data Belum Tersedia</h3>
                <p class="text-gray-500">Pemerintah Desa belum mengunggah data pencapaian IDM.</p>
            </div>
        @else
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                
                {{-- Chart Section --}}
                <div class="lg:col-span-2 bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
                    <div class="bg-gray-50 p-4 border-b border-gray-100">
                        <h2 class="font-semibold text-gray-800">Perkembangan Skor IDM</h2>
                    </div>
                    <div class="p-6 relative" style="height: 400px;">
                        <canvas id="idmChart"></canvas>
                    </div>
                </div>

                {{-- Table Section --}}
                <div class="lg:col-span-1 bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
                    <div class="bg-gray-50 p-4 border-b border-gray-100">
                        <h2 class="font-semibold text-gray-800">Riwayat Status</h2>
                    </div>
                    <div class="p-0 max-h-96 overflow-y-auto">
                        <ul class="divide-y divide-gray-100">
                            @foreach($idms->reverse() as $idm)
                            <li class="p-4 hover:bg-gray-50 transition-colors">
                                <div class="flex justify-between items-center mb-1">
                                    <span class="font-bold text-gray-800">Tahun {{ $idm->tahun }}</span>
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium 
                                        {{ $idm->status == 'Mandiri' ? 'bg-green-100 text-green-800' : 
                                          ($idm->status == 'Maju' ? 'bg-blue-100 text-blue-800' : 
                                          ($idm->status == 'Berkembang' ? 'bg-yellow-100 text-yellow-800' : 'bg-red-100 text-red-800')) }}">
                                        {{ $idm->status }}
                                    </span>
                                </div>
                                <div class="text-sm text-gray-500 flex justify-between">
                                    <span>Skor: <strong class="text-gray-700">{{ number_format($idm->skor, 4) }}</strong></span>
                                    @if($idm->target_tahun_depan)
                                    <span>Target: <span class="text-gray-600">{{ $idm->target_tahun_depan }}</span></span>
                                    @endif
                                </div>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </div>

            </div>
        @endif

    </div>
</main>

@if($idms->isNotEmpty())
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const ctx = document.getElementById('idmChart').getContext('2d');
        
        const labels = {!! json_encode($idms->pluck('tahun')) !!};
        const dataScores = {!! json_encode($idms->pluck('skor')) !!};

        new Chart(ctx, {
            type: 'line',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Skor IDM',
                    data: dataScores,
                    fill: true,
                    backgroundColor: 'rgba(34, 197, 94, 0.1)', // blora-green with opacity
                    borderColor: 'rgb(21, 128, 61)', // blora-green-dark
                    borderWidth: 3,
                    pointBackgroundColor: 'rgb(21, 128, 61)',
                    pointBorderColor: '#fff',
                    pointHoverBackgroundColor: '#fff',
                    pointHoverBorderColor: 'rgb(21, 128, 61)',
                    pointRadius: 5,
                    pointHoverRadius: 7,
                    tension: 0.3
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false
                    },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                return 'Skor: ' + context.parsed.y.toFixed(4);
                            }
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: false,
                        suggestedMin: Math.max(0, Math.min(...dataScores) - 0.1),
                        suggestedMax: Math.min(1, Math.max(...dataScores) + 0.1)
                    }
                }
            }
        });
    });
</script>
@endif
@endsection
