@extends('layouts.app')

@section('content')
    <div class="max-w-5xl mx-auto mt-6 mb-20 space-y-6">

        {{-- ================= PROGRESS ================= --}}
        <div x-data="{ info: false }"
            class="relative bg-gray-200 rounded-2xl p-6 shadow flex flex-col md:flex-row items-center gap-6">

            {{-- tombol info --}}
            <button type="button" @click="info = !info"
                class="absolute top-4 right-4 w-8 h-8 rounded-full bg-blue-900 text-white font-bold hover:bg-blue-600 transition">
                i
            </button>

            {{-- popup info --}}
            <div x-show="info" @click.away="info = false" x-transition
                class="absolute top-16 right-4 w-72 bg-gray-800 text-white text-sm p-4 rounded-xl shadow-lg z-50">
                Fitur untuk melihat kembali perjalanan, perkembangan emosi,
                dan tujuan yang sudah atau sedang dicapai.
            </div>

            <div class="w-40 h-40">
                <canvas id="progressChart"></canvas>
            </div>

            <div class="text-center md:text-left">
                <h2 class="text-4xl font-bold text-yellow-500">{{ $progress }}%</h2>
                <p class="text-sm">Tujuan Tercapai</p>

                <p class="text-red-500 mt-2 text-sm">
                    {{ $progress >= 70 ? 'Hari ini berhasil, berarti besok harus lebih baik lagi!' : 'Belum tercapai bukan berarti gabisa' }}
                </p>
            </div>

        </div>

        {{-- ================= MOOD CHART ================= --}}
        <div class="bg-gray-200 rounded-2xl p-6 shadow">

            <h2 class="font-semibold mb-4">📊 Grafik Mood 14 Hari Terakhir</h2>

            <canvas id="moodChart"></canvas>

        </div>

        {{-- ================= EDUKASI MOOD ================= --}}
        <div class="bg-[#342967] rounded-2xl p-6 shadow flex flex-row items-center gap-4 text-white">

            {{-- ILUSTRASI --}}
            <div class="w-24 md:w-36 flex-shrink-0">
                <img src="{{ asset('images/jejak.png') }}" alt="Ilustrasi" class="w-full">
            </div>

            {{-- TEXT --}}
            <div class="flex-1 text-left">
                <p class="text-xs md:text-base leading-relaxed">
                    Bagaimana mood kamu selama ini? Naik turun atau stabil?
                    Biar lebih paham dengan dirimu, yuk kita pelajari lebih lanjut
                    mood kamu selama 1 minggu terakhir melalui lembar di bawah ya.
                </p>

                {{-- BUTTON --}}
                <a href="https://forms.gle/QvnHZLXPcqXVWFHd9" target="_blank"
                    class="inline-block mt-3 bg-yellow-400 text-black px-4 py-2 rounded-full text-sm font-semibold hover:bg-yellow-500 transition">
                    Klik Disini
                </a>
            </div>

        </div>

    </div>

    {{-- ================= CHART JS ================= --}}
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        // ================= PIE CHART =================
        const progressChart = new Chart(document.getElementById('progressChart'), {
            type: 'doughnut',
            data: {
                labels: ['Selesai', 'Belum'],
                datasets: [{
                    data: [{{ $progress }}, {{ 100 - $progress }}],
                    backgroundColor: ['#FACC15', '#aeb0b9'],
                    borderWidth: 0
                }]
            },
            options: {
                cutout: '70%',
                plugins: {
                    legend: {
                        display: false
                    }
                }
            }
        });

        // ================= LINE CHART =================
        const moodChart = new Chart(document.getElementById('moodChart'), {
            type: 'line',
            data: {
                labels: {!! json_encode($dates) !!},
                datasets: [{
                        label: '😭',
                        data: {!! json_encode($moodData['😭']) !!},
                        borderColor: '#ef4444',
                        backgroundColor: '#ef4444',
                        borderWidth: 3,
                        tension: 0.3,
                        fill: false,
                        pointRadius: 4
                    },
                    {
                        label: '😨',
                        data: {!! json_encode($moodData['😨']) !!},
                        borderColor: '#3b82f6',
                        backgroundColor: '#3b82f6',
                        borderWidth: 3,
                        tension: 0.3,
                        fill: false,
                        pointRadius: 4
                    },
                    {
                        label: '😐',
                        data: {!! json_encode($moodData['😐']) !!},
                        borderColor: '#6b7280',
                        backgroundColor: '#6b7280',
                        borderWidth: 3,
                        tension: 0.3,
                        fill: false,
                        pointRadius: 4
                    },
                    {
                        label: '😄',
                        data: {!! json_encode($moodData['😄']) !!},
                        borderColor: '#22c55e',
                        backgroundColor: '#22c55e',
                        borderWidth: 3,
                        tension: 0.3,
                        fill: false,
                        pointRadius: 4
                    },
                    {
                        label: '😡',
                        data: {!! json_encode($moodData['😡']) !!},
                        borderColor: '#eab308',
                        backgroundColor: '#eab308',
                        borderWidth: 3,
                        tension: 0.3,
                        fill: false,
                        pointRadius: 4
                    }
                ]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top'
                    }
                },
                scales: {
                    y: {
                        min: 0,
                        max: 1,
                        ticks: {
                            stepSize: 1,
                            callback: function(value) {
                                return value === 1 ? 'Ada' : '';
                            }
                        }
                    }
                }
            }
        });
    </script>
@endsection
