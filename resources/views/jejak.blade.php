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
                    backgroundColor: ['#FACC15', '#E5E7EB'],
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
                                    2: '😨',
                                    3: '😄',
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
