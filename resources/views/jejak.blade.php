@extends('layouts.app')

@section('content')

<div class="max-w-5xl mx-auto mt-6 mb-20 space-y-6">

    {{-- ================= PROGRESS ================= --}}
    <div class="bg-gray-200 rounded-2xl p-6 shadow flex flex-col md:flex-row items-center gap-6">

        <div class="w-40 h-40">
            <canvas id="progressChart"></canvas>
        </div>

        <div class="text-center md:text-left">
            <h2 class="text-4xl font-bold text-yellow-500">{{ $progress }}%</h2>
            <p class="text-sm">Tujuan Tercapai</p>

            <p class="text-red-500 mt-2 text-sm">
                {{ $progress >= 70 ? 'Keren banget!' : 'Luar biasa! Terus semangat!' }}
            </p>
        </div>

    </div>

    {{-- ================= MOOD CHART ================= --}}
    <div class="bg-gray-200 rounded-2xl p-6 shadow">

        <h2 class="font-semibold mb-4">📊 Grafik Mood 14 Hari Terakhir</h2>

        <canvas id="moodChart"></canvas>

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
                backgroundColor: ['#FACC15', '#E5E7EB'],
                borderWidth: 0
            }]
        },
        options: {
            cutout: '70%',
            plugins: {
                legend: { display: false }
            }
        }
    });

    // ================= LINE CHART =================
    const moodChart = new Chart(document.getElementById('moodChart'), {
        type: 'line',
        data: {
            labels: {!! json_encode($dates) !!},
            datasets: [{
                label: 'Mood',
                data: {!! json_encode($moods) !!},
                tension: 0.4,
                fill: false
            }]
        },
        options: {
            scales: {
                y: {
                    min: 0,
                    max: 5,
                    ticks: {
                        callback: function(value) {
                            const map = {
                                1: '😭',
                                2: '🥺',
                                3: '😳',
                                4: '🙂',
                                5: '🥰'
                            };
                            return map[value] ?? '';
                        }
                    }
                }
            }
        }
    });
</script>

@endsection