@extends('layouts.public')

@section('title', 'Transparansi APBDes')

@section('content')
<main class="py-8 bg-gray-50 min-h-screen">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <div class="mb-8">
            <h1 class="text-3xl font-serif font-bold text-blora-green-dark mb-2">Transparansi APBDes</h1>
            <p class="text-gray-600">Laporan Rencana dan Realisasi Anggaran Pendapatan dan Belanja Desa</p>
        </div>

        @if($apbdesList->isEmpty())
            <div class="bg-white p-8 rounded-xl shadow-sm text-center border border-gray-100">
                <svg class="w-16 h-16 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                <h3 class="text-lg font-semibold text-gray-800 mb-1">Data Belum Tersedia</h3>
                <p class="text-gray-500">Pemerintah Desa belum mengunggah data APBDes.</p>
            </div>
        @else
            <div class="space-y-12">
                @foreach($apbdesList as $index => $apbdes)
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
                    <div class="bg-blora-green p-4 border-b border-gray-200">
                        <h2 class="text-xl font-bold text-white">Tahun Anggaran {{ $apbdes->tahun }}</h2>
                    </div>
                    <div class="p-6">
                        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                            
                            {{-- Chart Section --}}
                            <div class="bg-white p-4 rounded-lg border border-gray-100 shadow-sm relative" style="height: 400px;">
                                <canvas id="chart-{{ $apbdes->tahun }}"></canvas>
                            </div>

                            {{-- Data Table Section --}}
                            <div>
                                <h3 class="text-lg font-semibold text-gray-800 mb-4 border-b pb-2">Rincian Anggaran</h3>
                                <div class="overflow-x-auto -mx-4 sm:mx-0">
                                    <div class="inline-block min-w-full align-middle">
                                        <table class="min-w-full text-xs sm:text-sm text-left">
                                            <thead>
                                                <tr class="bg-gray-50 text-gray-600 font-medium border-y border-gray-200">
                                                    <th class="p-2 sm:p-3 whitespace-nowrap">Uraian</th>
                                                    <th class="p-2 sm:p-3 text-right whitespace-nowrap">Anggaran (Rp)</th>
                                                    <th class="p-2 sm:p-3 text-right whitespace-nowrap">Realisasi (Rp)</th>
                                                </tr>
                                            </thead>
                                            <tbody class="divide-y divide-gray-100">
                                                <tr class="hover:bg-green-50 transition-colors">
                                                    <td class="p-2 sm:p-3 font-semibold text-green-700 whitespace-nowrap">Pendapatan</td>
                                                    <td class="p-2 sm:p-3 text-right text-gray-600 whitespace-nowrap">{{ number_format($apbdes->pendapatan_anggaran, 0, ',', '.') }}</td>
                                                    <td class="p-2 sm:p-3 text-right text-gray-800 font-medium whitespace-nowrap">{{ number_format($apbdes->pendapatan_realisasi, 0, ',', '.') }}</td>
                                                </tr>
                                                <tr class="hover:bg-red-50 transition-colors">
                                                    <td class="p-2 sm:p-3 font-semibold text-red-700 whitespace-nowrap">Belanja</td>
                                                    <td class="p-2 sm:p-3 text-right text-gray-600 whitespace-nowrap">{{ number_format($apbdes->belanja_anggaran, 0, ',', '.') }}</td>
                                                    <td class="p-2 sm:p-3 text-right text-gray-800 font-medium whitespace-nowrap">{{ number_format($apbdes->belanja_realisasi, 0, ',', '.') }}</td>
                                                </tr>
                                                <tr class="hover:bg-blue-50 transition-colors">
                                                    <td class="p-2 sm:p-3 font-semibold text-blue-700 whitespace-nowrap">Penerimaan Pemb.</td>
                                                    <td class="p-2 sm:p-3 text-right text-gray-600 whitespace-nowrap">{{ number_format($apbdes->pembiayaan_penerimaan_anggaran, 0, ',', '.') }}</td>
                                                    <td class="p-2 sm:p-3 text-right text-gray-800 font-medium whitespace-nowrap">{{ number_format($apbdes->pembiayaan_penerimaan_realisasi, 0, ',', '.') }}</td>
                                                </tr>
                                                <tr class="hover:bg-orange-50 transition-colors">
                                                    <td class="p-2 sm:p-3 font-semibold text-orange-700 whitespace-nowrap">Pengeluaran Pemb.</td>
                                                    <td class="p-2 sm:p-3 text-right text-gray-600 whitespace-nowrap">{{ number_format($apbdes->pembiayaan_pengeluaran_anggaran, 0, ',', '.') }}</td>
                                                    <td class="p-2 sm:p-3 text-right text-gray-800 font-medium whitespace-nowrap">{{ number_format($apbdes->pembiayaan_pengeluaran_realisasi, 0, ',', '.') }}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        @endif

    </div>
</main>

@if($apbdesList->isNotEmpty())
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        @foreach($apbdesList as $apbdes)
        const ctx{{ $apbdes->tahun }} = document.getElementById('chart-{{ $apbdes->tahun }}').getContext('2d');
        new Chart(ctx{{ $apbdes->tahun }}, {
            type: 'bar',
            data: {
                labels: ['Pendapatan', 'Belanja', 'Penerimaan Pembiayaan', 'Pengeluaran Pembiayaan'],
                datasets: [
                    {
                        label: 'Anggaran',
                        data: [
                            {{ $apbdes->pendapatan_anggaran }},
                            {{ $apbdes->belanja_anggaran }},
                            {{ $apbdes->pembiayaan_penerimaan_anggaran }},
                            {{ $apbdes->pembiayaan_pengeluaran_anggaran }}
                        ],
                        backgroundColor: 'rgba(209, 213, 219, 0.7)', // gray-300
                        borderColor: 'rgb(156, 163, 175)',
                        borderWidth: 1,
                        borderRadius: 4
                    },
                    {
                        label: 'Realisasi',
                        data: [
                            {{ $apbdes->pendapatan_realisasi }},
                            {{ $apbdes->belanja_realisasi }},
                            {{ $apbdes->pembiayaan_penerimaan_realisasi }},
                            {{ $apbdes->pembiayaan_pengeluaran_realisasi }}
                        ],
                        backgroundColor: [
                            'rgba(34, 197, 94, 0.8)', // green
                            'rgba(239, 68, 68, 0.8)', // red
                            'rgba(59, 130, 246, 0.8)', // blue
                            'rgba(249, 115, 22, 0.8)'  // orange
                        ],
                        borderColor: [
                            'rgb(21, 128, 61)',
                            'rgb(185, 28, 28)',
                            'rgb(29, 78, 216)',
                            'rgb(194, 65, 12)'
                        ],
                        borderWidth: 1,
                        borderRadius: 4
                    }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'top',
                    },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                let label = context.dataset.label || '';
                                if (label) {
                                    label += ': ';
                                }
                                if (context.parsed.y !== null) {
                                    label += new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR' }).format(context.parsed.y);
                                }
                                return label;
                            }
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            callback: function(value, index, values) {
                                if (value >= 1000000000) {
                                    return (value / 1000000000) + ' M';
                                }
                                if (value >= 1000000) {
                                    return (value / 1000000) + ' Jt';
                                }
                                return value;
                            }
                        }
                    }
                }
            }
        });
        @endforeach
    });
</script>
@endif
@endsection
