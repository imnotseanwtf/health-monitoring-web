<div>
    <a class="btn btn-info" href="{{ route('patient.show', $patient->id) }}">
        <i class="fas fa-eye fa-fw"></i>
    </a>

    <button type="button" class="editBtn btn btn-primary" data-bs-toggle="modal" data-bs-target="#editModal"
        data-patient="{{ $patient->id }}">
        <i class="fas fa-pen fa-fw"></i>
    </button>

    <button type="button" class="deleteBtn btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal"
        data-patient="{{ $patient->id }}">
        <i class="fas fa-trash"></i>
    </button>
</div>
