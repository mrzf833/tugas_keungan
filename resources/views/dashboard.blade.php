@component('layouts.template.layout')
    @slot('header')
        Dashboard
    @endslot
    @slot('content')
    <div class="row">
        <!-- Earnings (Monthly) Card Example -->
        <div class="col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Pemasukan (Perbulan)</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800" id="pemasukan-card">RP. 0</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    
        <!-- Earnings (Monthly) Card Example -->
        <div class="col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Pengeluaran (Perbulan)</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800" id="pengeluaran-card">RP. 0</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-minus fa-2x text-gray-300"></i>
                            <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <!-- Pie Chart -->
        <div class="col-lg-12">
            <div class="card shadow mb-4">
                <!-- Card Header -->
                <div
                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Laporan Perbulan</h6>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <div class="chart-pie pt-4 pb-2">
                        <canvas id="myPieChart"></canvas>
                    </div>
                    <div class="mt-4 text-center small">
                        <span class="mr-2">
                            <i class="fas fa-circle text-primary"></i> Pemasukan
                        </span>
                        <span class="mr-2">
                            <i class="fas fa-circle text-success"></i> Pengeluaran
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Bar Chart -->
        <div class="col-lg-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Bar Laporan</h6>
                </div>
                <div class="card-body">
                    <div class="chart-bar">
                        <canvas id="myBarChart"></canvas>
                    </div>
                    <hr>
                    Styling for the bar chart can be found in the
                    <code>/js/demo/chart-bar-demo.js</code> file.
                </div>
            </div>
        </div>
    </div>
    @endslot
    @slot('script')
        {{-- script chart area --}}
            @component('components.chart-bar')
                @slot('id_chart_bar')
                    myBarChart
                @endslot
                @slot('label')
                    ["Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"]
                @endslot
                {{-- bar 1 --}}
                @slot('label_first')
                    Pemasukan
                @endslot
                @slot('bg_color_first')
                    #4e73df
                @endslot
                @slot('hover_bg_color_first')
                    #2e59d9
                @endslot
                @slot('border_color_first')
                    #4e73df
                @endslot
                @slot('data_first')
                    {{ json_encode($pemasukan_pertahun) }}
                @endslot
                {{-- end bar 1 --}}

                {{-- bar 2 --}}
                @slot('label_secondary')
                    Pengeluaran
                @endslot
                @slot('bg_color_secondary')
                    #1cc88a
                @endslot
                @slot('hover_bg_color_secondary')
                    #17a673
                @endslot
                @slot('border_color_secondary')
                    #1cc88a
                @endslot
                @slot('data_secondary')
                {{ json_encode($pengeluaran_pertahun) }}
                @endslot
                {{-- end bar 2 --}}
            @endcomponent
        {{-- end script chart area --}}

        {{-- script chart pie --}}
            @component('components.chart-pie')
                @slot('id_chart_pie')
                    myPieChart
                @endslot
                @slot('label')
                    ["Pengeluaran","Pemasukan"]
                @endslot
                @slot('data')
                    [{{ $pengeluaran_perbulan }}, {{ $pemasukan_perbulan }}]
                @endslot
                @slot('bg_color')
                    ['#1cc88a', '#4e73df']
                @endslot
                @slot('hover_bg_color')
                    ['#17a673', '#2e59d9']
                @endslot
            @endcomponent
        {{-- end script chart pie --}}
        <script>
            $('#pemasukan-card').text('RP. ' + number_format({{ $pemasukan_perbulan }}))
            $('#pengeluaran-card').text('RP. ' + number_format({{ $pengeluaran_perbulan }}))
        </script>
    @endslot
@endcomponent