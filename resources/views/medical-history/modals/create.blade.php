{{-- CREATE --}}

<div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="createModal" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Create Medical History</h5>

                <button type="button" data-bs-dismiss="modal" aria-label="Close" class="btn">
                    <i class="fa-solid fa-xmark"></i>
                </button>
            </div>
            <form action="{{ route('medical-history.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <input type="number" value="{{ $patient->id }}" name="patient_id" hidden>

                    <div class="form-group mt-3">
                        <label for="medical_problems">Medical Problems</label>
                        <textarea class="form-control" name="medical_problems" rows="3" placeholder="Enter medical problems"
                            required>{{ old('medical_problems') }}</textarea>
                        @error('medical_problems')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group mt-3">
                        <label for="list_all_allergies">List All Allergies</label>
                        <textarea class="form-control" name="list_all_allergies" rows="3" placeholder="Enter allergies"
                            required>{{ old('list_all_allergies') }}</textarea>
                        @error('list_all_allergies')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group mt-3">
                        <label for="list_all_medications">List All Medications</label>
                        <textarea class="form-control" name="list_all_medications" rows="3" placeholder="Enter medications"
                            required>{{ old('list_all_medications') }}</textarea>
                        @error('list_all_medications')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Save Medical History</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
