@extends('layouts.app')

@section('content')
    <style>
        .highcharts-figure,
        .highcharts-data-table table {
            min-width: 360px;
            max-width: 800px;
            margin: 1em auto;
        }

        .highcharts-data-table table {
            font-family: Verdana, sans-serif;
            border-collapse: collapse;
            border: 1px solid #ebebeb;
            margin: 10px auto;
            text-align: center;
            width: 100%;
            max-width: 500px;
        }

        .highcharts-data-table caption {
            padding: 1em 0;
            font-size: 1.2em;
            color: #555;
        }

        .highcharts-data-table th {
            font-weight: 600;
            padding: 0.5em;
        }

        .highcharts-data-table td,
        .highcharts-data-table th,
        .highcharts-data-table caption {
            padding: 0.5em;
        }

        .highcharts-data-table thead tr,
        .highcharts-data-table tr:nth-child(even) {
            background: #f8f8f8;
        }

        .highcharts-data-table tr:hover {
            background: #f1f7ff;
        }

        .highcharts-description {
            margin: 0.3rem 10px;
        }
    </style>


    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <div>View Patient</div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-6 form-group">
                        <label for="name">{{ __('Name') }}</label>
                        <div class="input-group">
                            <input name="name" type="text" id="view_name" @class(['form-control'])
                                placeholder="{{ __('Name') }}" value="{{ $patient->name }}" readonly>
                        </div>
                    </div>

                    <div class="col-6 form-group">
                        <label for="birth_date">{{ __('Birth Date') }}</label>
                        <div class="input-group">
                            <input name="birth_date" type="date" id="view_birth_date" @class(['form-control'])
                                placeholder="{{ __('Birth Date') }}" value="{{ $patient->birth_date }}" readonly>
                        </div>
                    </div>

                    <div class="col-6 form-group mt-3">
                        <label for="height">{{ __('Height (cm)') }}</label>
                        <div class="input-group">
                            <input name="height" type="number" id="view_height" @class(['form-control'])
                                placeholder="{{ __('Height (cm)') }}" value="{{ $patient->height }}" readonly>
                        </div>
                    </div>

                    <div class="col-6 form-group mt-3">
                        <label for="weight">{{ __('Weight (kg)') }}</label>
                        <div class="input-group">
                            <input name="weight" type="number" id="view_weight" @class(['form-control'])
                                placeholder="{{ __('Weight (kg)') }}" value="{{ $patient->weight }}" readonly>
                        </div>
                    </div>

                    <div class="col-12 form-group mt-3">
                        <label for="device_identifier">{{ __('Device Identifier') }}</label>
                        <div class="input-group">
                            <input name="device_identifier" type="text" id="view_device_identifier"
                                @class(['form-control']) placeholder="{{ __('Device Identifier') }}"
                                value="{{ $patient->device_identifier }}" readonly>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card-body">
                <figure class="highcharts-figure">
                    <div id="container"></div>
                </figure>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>
<script src="https://code.highcharts.com/modules/accessibility.js"></script>

<script type="module">
    $(document).ready(function() {
        const patientId = {{ $patient->id }};
        const chart = Highcharts.chart('container', {
            chart: {
                type: 'spline',
                animation: Highcharts.svg,
                events: {
                    load: function() {
                        const series = this.series[0];
                        setInterval(function() {
                            $.ajax({
                                url: `/latest-bpm/${patientId}`,
                                method: 'GET',
                                success: function(response) {
                                    const x = new Date().getTime();
                                    const y = response.bpm || 0;
                                    series.addPoint([x, y], true, series.data.length >= 20);
                                    let color;
                                    if (y <= 50 || y >= 100) color = '#ff0000'; // Red for danger (0-50, 100-150)
                                    else color = '#0000ff'; // Blue for normal (50-100)
                                    series.points[series.points.length - 1].update({ color: color });
                                },
                                error: function(xhr) {
                                    console.error('Failed to fetch BPM:', xhr.status, xhr.statusText);
                                }
                            });
                        }, 10000);
                    }
                }
            },
            title: {
                text: 'BPM Monitor'
            },
            xAxis: {
                type: 'datetime',
                title: {
                    text: 'Time'
                }
            },
            yAxis: {
                title: {
                    text: 'Beats Per Minute (BPM)'
                },
                min: 0,
                max: 150,
                plotBands: [
                    {
                        from: 0,
                        to: 50,
                        color: 'rgba(255, 0, 0, 0.1)', // Red tint for danger range
                        label: {
                            text: 'Danger Range',
                            style: { color: '#ff0000' }
                        }
                    },
                    {
                        from: 50,
                        to: 100,
                        color: 'rgba(68, 170, 213, 0.1)', // Light blue for normal range
                        label: {
                            text: 'Normal Range',
                            style: { color: '#0000ff' }
                        }
                    },
                    {
                        from: 100,
                        to: 150,
                        color: 'rgba(255, 0, 0, 0.1)', // Red tint for danger range
                        label: {
                            text: 'Danger Range',
                            style: { color: '#ff0000' }
                        }
                    }
                ]
            },
            tooltip: {
                headerFormat: '<b>{series.name}</b><br>',
                pointFormat: '{point.x:%H:%M:%S}: {point.y} BPM {point.danger}',
                pointFormatter: function() {
                    const status = this.y <= 50 || this.y >= 100 ? '<span style="color:#ff0000">(Danger)</span>' : '';
                    return `${Highcharts.dateFormat('%H:%M:%S', this.x)}: ${this.y} BPM ${status}`;
                }
            },
            series: [{
                name: 'BPM',
                data: []
            }]
        });
    });
</script>
@endpush