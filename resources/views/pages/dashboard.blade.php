@extends('layout.main')

@push('style')
    <link rel="stylesheet" href="{{asset('sneat/vendor/libs/apex-charts/apex-charts.css')}}" />
@endpush

@push('script')
    <script src="{{asset('sneat/vendor/libs/apex-charts/apexcharts.js')}}"></script>
    <script>
        const dailyOptions = {
            chart: { type: 'bar' },
            series: [{
                name: '{{ __('dashboard.letter_transaction') }}',
                data: [{{ $todayIncomingLetter }},{{ $todayOutgoingLetter }},{{ $todayDispositionLetter }}]
            }],
            stroke: { curve: 'smooth' },
            xaxis: {
                categories: [
                    '{{ __('dashboard.incoming_letter') }}',
                    '{{ __('dashboard.outgoing_letter') }}',
                    '{{ __('dashboard.disposition_letter') }}',
                ],
            },
            colors: ['#696cff'],
        }

        const dailyChart = new ApexCharts(document.querySelector("#today-graphic"), dailyOptions);
        dailyChart.render();

        const monthNames = {!! json_encode(array_map(fn($m) => Carbon\Carbon::create()->month($m)->isoFormat('MMM'), range(1, 12))) !!};

        const monthlyOptions = {
            chart: { type: 'line', toolbar: { show: false } },
            series: [
                { name: '{{ __('dashboard.incoming_letter') }}', data: {{ json_encode($monthlyIncoming) }} },
                { name: '{{ __('dashboard.outgoing_letter') }}', data: {{ json_encode($monthlyOutgoing) }} },
            ],
            stroke: { curve: 'smooth', width: 3 },
            xaxis: { categories: monthNames },
            colors: ['#28c76f', '#ea5455'],
            markers: { size: 5 },
            yaxis: { min: 0, forceNiceScale: true },
        }

        const monthlyChart = new ApexCharts(document.querySelector("#monthly-graphic"), monthlyOptions);
        monthlyChart.render();
    </script>
@endpush

@section('content')
    <div class="row">
        <div class="col-lg-8 mb-4 order-0">
            <div class="card mb-4">
                <div class="d-flex align-items-end row">
                    <div class="col-sm-7">
                        <div class="card-body">
                            <h4 class="card-title text-primary">{{ $greeting }}</h4>
                            <p class="mb-4">
                                {{ $currentDate }}
                            </p>
                            <p style="font-size: smaller" class="text-gray">*) {{ __('dashboard.today_report') }}</p>
                        </div>
                    </div>
                    <div class="col-sm-5 text-center text-sm-left">
                        <div class="card-body pb-0 px-0 px-md-4">
                            <img src="{{asset('sneat/img/man-with-laptop-light.png')}}" height="140"
                                 alt="View Badge User" data-app-dark-img="illustrations/man-with-laptop-dark.png"
                                 data-app-light-img="illustrations/man-with-laptop-light.png">
                        </div>
                    </div>
                </div>
            </div>

            <div class="mb-4">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between flex-sm-row flex-column gap-3"
                             style="position: relative;">
                            <div class="">
                                <div class="card-title">
                                    <h5 class="text-nowrap mb-2">{{ __('dashboard.today_graphic') }}</h5>
                                    <span class="badge bg-label-warning rounded-pill">{{ __('dashboard.today') }}</span>
                                </div>
                                <div class="mt-sm-auto">
                                    @if($percentageLetterTransaction > 0)
                                    <small class="text-success text-nowrap fw-semibold">
                                        <i class="bx bx-chevron-up"></i> {{ $percentageLetterTransaction }}%
                                    </small>
                                    @elseif($percentageLetterTransaction < 0)
                                        <small class="text-danger text-nowrap fw-semibold">
                                            <i class="bx bx-chevron-down"></i> {{ $percentageLetterTransaction }}%
                                        </small>
                                    @endif
                                    <h3 class="mb-0 display-4">{{ $todayLetterTransaction }}</h3>
                                </div>
                            </div>
                            <div id="profileReportChart" style="min-height: 80px; width: 80%">
                                <div id="today-graphic"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-4 order-1">
            <div class="row">
                <div class="col-lg-6 col-md-12 col-6 mb-4">
                    <x-dashboard-card-simple
                        :label="__('dashboard.incoming_letter')"
                        :value="$todayIncomingLetter"
                        :daily="true"
                        color="success"
                        icon="bx-envelope"
                        :percentage="$percentageIncomingLetter"
                    />
                </div>
                <div class="col-lg-6 col-md-12 col-6 mb-4">
                    <x-dashboard-card-simple
                        :label="__('dashboard.outgoing_letter')"
                        :value="$todayOutgoingLetter"
                        :daily="true"
                        color="danger"
                        icon="bx-envelope"
                        :percentage="$percentageOutgoingLetter"
                    />
                </div>
                <div class="col-lg-6 col-md-12 col-6 mb-4">
                    <x-dashboard-card-simple
                        :label="__('dashboard.disposition_letter')"
                        :value="$todayDispositionLetter"
                        :daily="true"
                        color="primary"
                        icon="bx-envelope"
                        :percentage="$percentageDispositionLetter"
                    />
                </div>
                <div class="col-lg-6 col-md-12 col-6 mb-4">
                    <x-dashboard-card-simple
                        :label="__('dashboard.active_user')"
                        :value="$activeUser"
                        :daily="false"
                        color="info"
                        icon="bx-user-check"
                        :percentage="0"
                    />
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-8 mb-4 order-0">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between flex-sm-row flex-column gap-3">
                        <div>
                            <div class="card-title">
                                <h5 class="text-nowrap mb-2">{{ __('dashboard.month_graphic') }}</h5>
                                <span class="badge bg-label-info rounded-pill">{{ __('dashboard.this_month') }}</span>
                            </div>
                            <h3 class="mb-0 display-5">{{ $monthIncomingLetter + $monthOutgoingLetter + $monthDispositionLetter }}</h3>
                        </div>
                        <div id="monthly-graphic" style="width: 100%; min-height: 250px;"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-4 order-1">
            <div class="row">
                <div class="col-lg-6 col-md-12 col-6 mb-4">
                    <x-dashboard-card-simple
                        :label="__('dashboard.month_incoming')"
                        :value="$monthIncomingLetter"
                        :daily="false"
                        color="success"
                        icon="bx-envelope"
                        :percentage="0"
                    />
                </div>
                <div class="col-lg-6 col-md-12 col-6 mb-4">
                    <x-dashboard-card-simple
                        :label="__('dashboard.month_outgoing')"
                        :value="$monthOutgoingLetter"
                        :daily="false"
                        color="danger"
                        icon="bx-envelope"
                        :percentage="0"
                    />
                </div>
                <div class="col-lg-6 col-md-12 col-6 mb-4">
                    <x-dashboard-card-simple
                        :label="__('dashboard.month_disposition')"
                        :value="$monthDispositionLetter"
                        :daily="false"
                        color="primary"
                        icon="bx-envelope"
                        :percentage="0"
                    />
                </div>
                <div class="col-lg-6 col-md-12 col-6 mb-4">
                    <x-dashboard-card-simple
                        :label="__('dashboard.undisposed')"
                        :value="$undisposedLetters"
                        :daily="false"
                        color="warning"
                        icon="bx-error-circle"
                        :percentage="0"
                    />
                </div>
            </div>
        </div>
    </div>
@endsection
