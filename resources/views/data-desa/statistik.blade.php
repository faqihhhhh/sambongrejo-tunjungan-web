@extends('layouts.public')

@section('title', 'Statistik Penduduk')

@section('content')
<main class="py-8 bg-gray-50 min-h-screen">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <div class="mb-8 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
            <div>
                <h1 class="text-3xl font-serif font-bold text-blora-green-dark mb-2">Statistik Penduduk</h1>
                <p class="text-gray-600">Data demografi kependudukan Desa Sambongrejo</p>
            </div>
            
            <form action="{{ route('statistik') }}" method="GET" class="w-full sm:w-auto">
                <select name="kategori" onchange="this.form.submit()" class="w-full sm:w-64 border-gray-300 rounded-md shadow-sm focus:border-blora-green focus:ring focus:ring-blora-green focus:ring-opacity-50 text-gray-700">
                    @foreach($categories as $cat)
                        <option value="{{ $cat }}" {{ $kategori == $cat ? 'selected' : '' }}>Kategori: {{ $cat }}</option>
                    @endforeach
                </select>
            </form>
        </div>

        @if($statistik->isEmpty())
            <div class="bg-white p-8 rounded-xl shadow-sm text-center border border-gray-100">
                <svg class="w-16 h-16 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 3.055A9.001 9.001 0 1020.945 13H11V3.055z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.488 9H15V3.512A9.025 9.025 0 0120.488 9z"/></svg>
                <h3 class="text-lg font-semibold text-gray-800 mb-1">Data Belum Tersedia</h3>
                <p class="text-gray-500">Pemerintah Desa belum mengunggah data statistik untuk kategori {{ $kategori }}.</p>
            </div>
        @else
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                
                {{-- Chart Section (Pie) --}}
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
                    <div class="bg-gray-50 p-4 border-b border-gray-100">
                        <h2 class="font-semibold text-gray-800">Grafik {{ $kategori }}</h2>
                    </div>
                    <div class="p-6 relative flex justify-center items-center" style="height: 400px;">
                        <canvas id="statistikPieChart"></canvas>
                    </div>
                </div>

                {{-- Table Section --}}
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden flex flex-col">
                    <div class="bg-gray-50 p-4 border-b border-gray-100">
                        <h2 class="font-semibold text-gray-800">Rincian Data</h2>
                    </div>
                    <div class="p-0 flex-1 overflow-y-auto">
                        <table class="w-full text-sm text-left">
                            <thead>
                                <tr class="bg-gray-50 text-gray-600 font-medium border-b border-gray-100">
                                    <th class="p-4">Kelompok</th>
                                    <th class="p-4 text-right">Jumlah (Jiwa)</th>
                                    <th class="p-4 text-right">Persentase</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100">
                                @php 
                                    $total = $statistik->sum('jumlah'); 
                                @endphp
                                @foreach($statistik as $stat)
                                <tr class="hover:bg-gray-50 transition-colors">
                                    <td class="p-4 font-medium text-gray-700 flex items-center gap-3">
                                        <span class="w-3 h-3 rounded-full shadow-sm" style="background-color: {{ $stat->warna ?? '#cccccc' }}"></span>
                                        {{ $stat->nama_item }}
                                    </td>
                                    <td class="p-4 text-right text-gray-900 font-semibold">{{ number_format($stat->jumlah, 0, ',', '.') }}</td>
                                    <td class="p-4 text-right text-gray-500">
                                        {{ $total > 0 ? number_format(($stat->jumlah / $total) * 100, 1) : 0 }}%
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                            <tfoot class="bg-gray-50 border-t border-gray-200 font-bold text-gray-800">
                                <tr>
                                    <td class="p-4">TOTAL</td>
                                    <td class="p-4 text-right">{{ number_format($total, 0, ',', '.') }}</td>
                                    <td class="p-4 text-right">100%</td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>

            </div>
        @endif

    </div>
</main>

@if($statistik->isNotEmpty())
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const ctx = document.getElementById('statistikPieChart').getContext('2d');
        
        const labels = {!! json_encode($statistik->pluck('nama_item')) !!};
        const dataValues = {!! json_encode($statistik->pluck('jumlah')) !!};
        const bgColors = {!! json_encode($statistik->map(fn($s) => $s->warna ?? '#cccccc')) !!};

        const chart = new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: labels,
                datasets: [{
                    data: dataValues,
                    backgroundColor: bgColors,
                    borderWidth: 1,
                    borderColor: '#ffffff'
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: window.innerWidth < 768 ? 'bottom' : 'right',
                        labels: {
                            boxWidth: 12,
                            padding: 15,
                            font: {
                                size: 12
                            }
                        }
                    },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                let label = context.label || '';
                                if (label) {
                                    label += ': ';
                                }
                                if (context.parsed !== null) {
                                    label += new Intl.NumberFormat('id-ID').format(context.parsed) + ' Jiwa';
                                    
                                    // Calculate percentage
                                    const total = context.dataset.data.reduce((a, b) => a + b, 0);
                                    const percentage = total > 0 ? ((context.parsed / total) * 100).toFixed(1) + '%' : '0%';
                                    label += ' (' + percentage + ')';
                                }
                                return label;
                            }
                        }
                    }
                },
                cutout: '60%' // makes it a doughnut
            }
        });

        // Update legend position on window resize
        window.addEventListener('resize', function() {
            chart.options.plugins.legend.position = window.innerWidth < 768 ? 'bottom' : 'right';
            chart.update();
        });
    });
</script>
@endif
@endsection
