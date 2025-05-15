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
            <div class="card-header d-flex justify-content-between align-items-center">
                <div>Patients</div>
                <a href="{{ route('medical-history.index', $patient->id) }}" class="btn btn-primary">View Medical History</a>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4 form-group">
                        <label for="last_name">{{ __('Last Name') }}</label>
                        <div class="input-group">
                            <input name="last_name" type="text" id="view_last_name" @class(['form-control'])
                                value="{{ $patient->last_name }}" readonly>
                        </div>
                    </div>

                    <div class="col-md-4 form-group">
                        <label for="first_name">{{ __('First Name') }}</label>
                        <div class="input-group">
                            <input name="first_name" type="text" id="view_first_name" @class(['form-control'])
                                value="{{ $patient->first_name }}" readonly>
                        </div>
                    </div>

                    <div class="col-md-4 form-group">
                        <label for="middle_name">{{ __('Middle Name') }}</label>
                        <div class="input-group">
                            <input name="middle_name" type="text" id="view_middle_name" @class(['form-control'])
                                value="{{ $patient->middle_name }}" readonly>
                        </div>
                    </div>

                    <div class="col-md-4 form-group mt-3">
                        <label for="maiden_name">{{ __('Maiden Name') }}</label>
                        <div class="input-group">
                            <input name="maiden_name" type="text" id="view_maiden_name" @class(['form-control'])
                                value="{{ $patient->maiden_name }}" readonly>
                        </div>
                    </div>

                    <div class="col-md-8 form-group mt-3">
                        <label for="address">{{ __('Address') }}</label>
                        <div class="input-group">
                            <input name="address" type="text" id="view_address" @class(['form-control'])
                                value="{{ $patient->address }}" readonly>
                        </div>
                    </div>

                    <div class="col-md-4 form-group mt-3">
                        <label for="city">{{ __('City') }}</label>
                        <div class="input-group">
                            <input name="city" type="text" id="view_city" @class(['form-control'])
                                value="{{ $patient->city }}" readonly>
                        </div>
                    </div>

                    <div class="col-md-4 form-group mt-3">
                        <label for="province">{{ __('Province') }}</label>
                        <div class="input-group">
                            <input name="province" type="text" id="view_province" @class(['form-control'])
                                value="{{ $patient->province }}" readonly>
                        </div>
                    </div>

                    <div class="col-md-4 form-group mt-3">
                        <label for="zip">{{ __('ZIP Code') }}</label>
                        <div class="input-group">
                            <input name="zip" type="text" id="view_zip" @class(['form-control'])
                                value="{{ $patient->zip }}" readonly>
                        </div>
                    </div>

                    <div class="col-md-4 form-group mt-3">
                        <label for="birth_date">{{ __('Birth Date') }}</label>
                        <div class="input-group">
                            <input name="birth_date" type="date" id="view_birth_date" @class(['form-control'])
                                value="{{ $patient->birth_date }}" readonly>
                        </div>
                    </div>

                    <div class="col-md-4 form-group mt-3">
                        <label for="birth_place">{{ __('Birth Place') }}</label>
                        <div class="input-group">
                            <input name="birth_place" type="text" id="view_birth_place" @class(['form-control'])
                                value="{{ $patient->birth_place }}" readonly>
                        </div>
                    </div>

                    <div class="col-md-4 form-group mt-3">
                        <label for="phone">{{ __('Phone') }}</label>
                        <div class="input-group">
                            <input name="phone" type="text" id="view_phone" @class(['form-control'])
                                value="{{ $patient->phone }}" readonly>
                        </div>
                    </div>

                    <div class="col-md-4 form-group mt-3">
                        <label for="marital_status">{{ __('Marital Status') }}</label>
                        <div class="input-group">
                            <input name="marital_status" type="text" id="view_marital_status" @class(['form-control'])
                                value="{{ $patient->marital_status->description }}" readonly>
                        </div>
                    </div>

                    <div class="col-md-12 mt-4">
                        <h5>Spouse Information</h5>
                    </div>

                    <div class="col-md-3 form-group mt-2">
                        <label for="spouse_last_name">{{ __('Last Name') }}</label>
                        <div class="input-group">
                            <input name="spouse_last_name" type="text" id="view_spouse_last_name" @class(['form-control'])
                                value="{{ $patient->spouse_last_name }}" readonly>
                        </div>
                    </div>

                    <div class="col-md-3 form-group mt-2">
                        <label for="spouse_first_name">{{ __('First Name') }}</label>
                        <div class="input-group">
                            <input name="spouse_first_name" type="text" id="view_spouse_first_name" @class(['form-control'])
                                value="{{ $patient->spouse_first_name }}" readonly>
                        </div>
                    </div>

                    <div class="col-md-3 form-group mt-2">
                        <label for="spouse_middle_name">{{ __('Middle Name') }}</label>
                        <div class="input-group">
                            <input name="spouse_middle_name" type="text" id="view_spouse_middle_name" @class(['form-control'])
                                value="{{ $patient->spouse_middle_name }}" readonly>
                        </div>
                    </div>

                    <div class="col-md-3 form-group mt-2">
                        <label for="spouse_maiden_name">{{ __('Maiden Name') }}</label>
                        <div class="input-group">
                            <input name="spouse_maiden_name" type="text" id="view_spouse_maiden_name" @class(['form-control'])
                                value="{{ $patient->spouse_maiden_name }}" readonly>
                        </div>
                    </div>

                    <div class="col-md-12 mt-4">
                        <h5>Emergency Contact</h5>
                    </div>

                    <div class="col-md-4 form-group mt-2">
                        <label for="emergency_contact_name">{{ __('Name') }}</label>
                        <div class="input-group">
                            <input name="emergency_contact_name" type="text" id="view_emergency_contact_name" @class(['form-control'])
                                value="{{ $patient->emergency_contact_name }}" readonly>
                        </div>
                    </div>

                    <div class="col-md-4 form-group mt-2">
                        <label for="emergency_contact_relationship">{{ __('Relationship') }}</label>
                        <div class="input-group">
                            <input name="emergency_contact_relationship" type="text" id="view_emergency_contact_relationship" @class(['form-control'])
                                value="{{ $patient->emergency_contact_relationship }}" readonly>
                        </div>
                    </div>

                    <div class="col-md-4 form-group mt-2">
                        <label for="emergency_contact_phone">{{ __('Phone') }}</label>
                        <div class="input-group">
                            <input name="emergency_contact_phone" type="text" id="view_emergency_contact_phone" @class(['form-control'])
                                value="{{ $patient->emergency_contact_phone }}" readonly>
                        </div>
                    </div>

                    <div class="col-md-12 mt-4">
                        <h5>Guardian Information</h5>
                    </div>

                    <div class="col-md-6 form-group mt-2">
                        <label for="guardian_name">{{ __('Name') }}</label>
                        <div class="input-group">
                            <input name="guardian_name" type="text" id="view_guardian_name" @class(['form-control'])
                                value="{{ $patient->guardian_name }}" readonly>
                        </div>
                    </div>

                    <div class="col-md-6 form-group mt-2">
                        <label for="guardian_phone">{{ __('Phone') }}</label>
                        <div class="input-group">
                            <input name="guardian_phone" type="text" id="view_guardian_phone" @class(['form-control'])
                                value="{{ $patient->guardian_phone }}" readonly>
                        </div>
                    </div>

                    <div class="col-md-12 mt-4">
                        <h5>Physical Information</h5>
                    </div>

                    <div class="col-md-4 form-group mt-2">
                        <label for="height">{{ __('Height (cm)') }}</label>
                        <div class="input-group">
                            <input name="height" type="number" id="view_height" @class(['form-control'])
                                value="{{ $patient->height }}" readonly>
                        </div>
                    </div>

                    <div class="col-md-4 form-group mt-2">
                        <label for="weight">{{ __('Weight (kg)') }}</label>
                        <div class="input-group">
                            <input name="weight" type="number" id="view_weight" @class(['form-control'])
                                value="{{ $patient->weight }}" readonly>
                        </div>
                    </div>

                    <div class="col-md-4 form-group mt-2">
                        <label for="device_identifier">{{ __('Device Identifier') }}</label>
                        <div class="input-group">
                            <input name="device_identifier" type="text" id="view_device_identifier" @class(['form-control'])
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
                                        const y = response.sensorValue.bpm || 0;
                                        const lastPoint = series.data[series.data.length - 1];
                                        
                                        // Check if there's existing data and the timestamps match
                                        if (lastPoint && new Date(response.sensorValue.created_at).getTime() === new Date(lastPoint.created_at).getTime()) {
                                            return; // Skip adding point if timestamps match
                                        }

                                        series.addPoint([x, y], true, series.data.length >= 20);
                                        
                                        let color;
                                        if (y >= 120 || y <= 50) {
                                            color = '#ff0000'; // Red for danger (120+ or 50 below)
                                        } else {
                                            color = '#0000ff'; // Blue for normal (51-119)
                                        }
                                        
                                        series.points[series.points.length - 1].update({
                                            color: color,
                                            created_at: response.sensorValue.created_at // Store created_at for future comparison
                                        });
                                    },
                                    error: function(xhr) {
                                        console.error('Failed to fetch BPM:', xhr
                                            .status, xhr.statusText);
                                    }
                                });
                            }, 3000);
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
                    max: 200,
                    plotBands: [{
                            from: 0,
                            to: 50,
                            color: 'rgba(255, 0, 0, 0.1)', // Red tint for danger range (below 50)
                            label: {
                                text: 'Danger Range (Low)',
                                style: {
                                    color: '#ff0000'
                                }
                            }
                        },
                        {
                            from: 50,
                            to: 120,
                            color: 'rgba(68, 170, 213, 0.1)', // Light blue for normal range
                            label: {
                                text: 'Normal Range',
                                style: {
                                    color: '#0000ff'
                                }
                            }
                        },
                        {
                            from: 120,
                            to: 200,
                            color: 'rgba(255, 0, 0, 0.1)', // Red tint for danger range (above 120)
                            label: {
                                text: 'Danger Range (High)',
                                style: {
                                    color: '#ff0000'
                                }
                            }
                        }
                    ]
                },
                tooltip: {
                    headerFormat: '<b>{series.name}</b><br>',
                    pointFormat: '{point.x:%H:%M:%S}: {point.y} BPM {point.danger}',
                    pointFormatter: function() {
                        const status = (this.y >= 120 || this.y <= 50) ?
                            '<span style="color:#ff0000">(Danger)</span>' : '';
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
