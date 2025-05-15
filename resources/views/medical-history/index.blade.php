@extends('layouts.app')

@section('content')
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="container-fluid">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <div>{{strtoupper($patient->first_name . ' ' . $patient->middle_name . ' ' . $patient->last_name)}}</div>
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createModal">
                    Add Medical History
                </button>
            </div>
            <div class="card card-body border-0 shadow table-wrapper table-responsive">
                {{ $dataTable->table() }}
            </div>
        </div>
    </div>

    {{-- CREATE --}}
    @include('medical-history.modals.create')
    {{-- EDIT --}}
    {{-- @include('medical-history.modals.edit') --}}
    {{-- DELETE --}}
    {{-- @include('medical-history.modals.delete') --}}
@endsection

@push('scripts')
    {{ $dataTable->scripts(attributes: ['type' => 'module']) }}

    <script type="module">
        $(() => {
            const tableInstance = window.LaravelDataTables['medicalHistory_dataTable'] = $('#medicalHistory_dataTable')
                .DataTable()

            tableInstance.on('draw.dt', function() {
                $('.editBtn').click(function() {
                    fetch('/medical-history/' + $(this).data('medical'))
                        .then(response => response.json())
                        .then(medical => {
                            $('#edit_name').val(medical.name);

                            $('#update-form').attr('action', '/medical-history/' + $(this).data(
                                'medical'));
                        });
                })

                $('.deleteBtn').click(function() {
                    $('#delete-form').attr('action', '/medical-history/' + $(this).data('medical'));
                });
            });
        })
    </script> 
@endpush
