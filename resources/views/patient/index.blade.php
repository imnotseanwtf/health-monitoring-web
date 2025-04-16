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
                <div>Patients</div>
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createModal">
                    Add Patient
                </button>
            </div>
            <div class="card card-body border-0 shadow table-wrapper table-responsive">
                {{ $dataTable->table() }}
            </div>
        </div>
    </div>

    {{-- CREATE --}}
    @include('patient.modals.create')
    {{-- EDIT --}}
    @include('patient.modals.edit')
    {{-- DELETE --}}
    @include('patient.modals.delete')
@endsection

@push('scripts')
    {{ $dataTable->scripts(attributes: ['type' => 'module']) }}

    <script type="module">
        $(() => {
            const tableInstance = window.LaravelDataTables['patient_dataTable'] = $('#patient_dataTable')
                .DataTable()

            tableInstance.on('draw.dt', function() {
                $('.editBtn').click(function() {
                    fetch('/patient/' + $(this).data('patient'))
                        .then(response => response.json())
                        .then(patient => {
                            $('#edit_name').val(patient.name);

                            $('#update-form').attr('action', '/patient/' + $(this).data(
                                'patient'));
                        });
                })

                $('.deleteBtn').click(function() {
                    $('#delete-form').attr('action', '/patient/' + $(this).data('patient'));
                });
            });
        })
    </script> 
@endpush
