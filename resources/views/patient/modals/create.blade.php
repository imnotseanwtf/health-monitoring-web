{{-- CREATE --}}

<div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="createModal" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Create Patient</h5>
                <button type="button" data-bs-dismiss="modal" aria-label="Close" class="btn">
                    <i class="fa-solid fa-xmark"></i>
                </button>
            </div>
            <form action="{{ route('patient.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="last_name">Last Name</label>
                                <input type="text" class="form-control @error('last_name') is-invalid @enderror"
                                    name="last_name" placeholder="Enter last name" value="{{ old('last_name') }}"
                                    required>
                                @error('last_name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="first_name">First Name</label>
                                <input type="text" class="form-control @error('first_name') is-invalid @enderror"
                                    name="first_name" placeholder="Enter first name" value="{{ old('first_name') }}"
                                    required>
                                @error('first_name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="middle_name">Middle Name</label>
                                <input type="text" class="form-control @error('middle_name') is-invalid @enderror"
                                    name="middle_name" placeholder="Enter middle name" value="{{ old('middle_name') }}">
                                @error('middle_name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="maiden_name">Maiden Name</label>
                                <input type="text" class="form-control @error('maiden_name') is-invalid @enderror"
                                    name="maiden_name" placeholder="Enter maiden name" value="{{ old('maiden_name') }}">
                                @error('maiden_name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="marital_status">Marital Status</label>
                                <select class="form-control @error('marital_status') is-invalid @enderror"
                                    name="marital_status" required>
                                    <option value="" selected disabled>Select marital status</option>
                                    @foreach (\App\Enums\MaritalStatus::asSelectArray() as $value => $label)
                                        <option value="{{ $value }}">
                                            {{ $label }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('marital_status')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="address">Address</label>
                                <input type="text" class="form-control @error('address') is-invalid @enderror"
                                    name="address" placeholder="Enter address" value="{{ old('address') }}" required>
                                @error('address')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="city">City</label>
                                <input type="text" class="form-control @error('city') is-invalid @enderror"
                                    name="city" placeholder="Enter city" value="{{ old('city') }}" required>
                                @error('city')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="province">Province</label>
                                <input type="text" class="form-control @error('province') is-invalid @enderror"
                                    name="province" placeholder="Enter province" value="{{ old('province') }}"
                                    required>
                                @error('province')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="zip">ZIP Code</label>
                                <input type="text" class="form-control @error('zip') is-invalid @enderror"
                                    name="zip" placeholder="Enter ZIP code" value="{{ old('zip') }}"
                                    required>
                                @error('zip')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="birth_date">Birth Date</label>
                                <input type="date" class="form-control @error('birth_date') is-invalid @enderror"
                                    name="birth_date" value="{{ old('birth_date') }}" required>
                                @error('birth_date')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="birth_place">Birth Place</label>
                                <input type="text" class="form-control @error('birth_place') is-invalid @enderror"
                                    name="birth_place" placeholder="Enter birth place"
                                    value="{{ old('birth_place') }}" required>
                                @error('birth_place')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="phone">Phone Number</label>
                                <input type="text" class="form-control @error('phone') is-invalid @enderror"
                                    name="phone" placeholder="Enter phone number" value="{{ old('phone') }}"
                                    required>
                                @error('phone')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="spouse_last_name">Spouse Last Name</label>
                                <input type="text"
                                    class="form-control @error('spouse_last_name') is-invalid @enderror"
                                    name="spouse_last_name" placeholder="Enter spouse last name"
                                    value="{{ old('spouse_last_name') }}">
                                @error('spouse_last_name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="spouse_first_name">Spouse First Name</label>
                                <input type="text"
                                    class="form-control @error('spouse_first_name') is-invalid @enderror"
                                    name="spouse_first_name" placeholder="Enter spouse first name"
                                    value="{{ old('spouse_first_name') }}">
                                @error('spouse_first_name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="spouse_middle_name">Spouse Middle Name</label>
                                <input type="text"
                                    class="form-control @error('spouse_middle_name') is-invalid @enderror"
                                    name="spouse_middle_name" placeholder="Enter spouse middle name"
                                    value="{{ old('spouse_middle_name') }}">
                                @error('spouse_middle_name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="spouse_maiden_name">Spouse Maiden Name</label>
                                <input type="text"
                                    class="form-control @error('spouse_maiden_name') is-invalid @enderror"
                                    name="spouse_maiden_name" placeholder="Enter spouse maiden name"
                                    value="{{ old('spouse_maiden_name') }}">
                                @error('spouse_maiden_name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="emergency_contact_name">Emergency Contact Name</label>
                                <input type="text"
                                    class="form-control @error('emergency_contact_name') is-invalid @enderror"
                                    name="emergency_contact_name" placeholder="Enter emergency contact name"
                                    value="{{ old('emergency_contact_name') }}" required>
                                @error('emergency_contact_name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="emergency_contact_relationship">Emergency Contact Relationship</label>
                                <input type="text"
                                    class="form-control @error('emergency_contact_relationship') is-invalid @enderror"
                                    name="emergency_contact_relationship" placeholder="Enter relationship"
                                    value="{{ old('emergency_contact_relationship') }}" required>
                                @error('emergency_contact_relationship')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="emergency_contact_phone">Emergency Contact Phone</label>
                                <input type="text"
                                    class="form-control @error('emergency_contact_phone') is-invalid @enderror"
                                    name="emergency_contact_phone" placeholder="Enter emergency contact phone"
                                    value="{{ old('emergency_contact_phone') }}" required>
                                @error('emergency_contact_phone')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="guardian_name">Guardian Name</label>
                                <input type="text"
                                    class="form-control @error('guardian_name') is-invalid @enderror"
                                    name="guardian_name" placeholder="Enter guardian name"
                                    value="{{ old('guardian_name') }}">
                                @error('guardian_name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="guardian_phone">Guardian Phone</label>
                                <input type="text"
                                    class="form-control @error('guardian_phone') is-invalid @enderror"
                                    name="guardian_phone" placeholder="Enter guardian phone"
                                    value="{{ old('guardian_phone') }}">
                                @error('guardian_phone')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="height">Height (cm)</label>
                                <input type="number" class="form-control @error('height') is-invalid @enderror"
                                    name="height" placeholder="Enter height in cm" value="{{ old('height') }}"
                                    required>
                                @error('height')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="weight">Weight (kg)</label>
                                <input type="number" class="form-control @error('weight') is-invalid @enderror"
                                    name="weight" placeholder="Enter weight in kg" value="{{ old('weight') }}"
                                    required>
                                @error('weight')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="device_identifier">Device Identifier</label>
                                <input type="text"
                                    class="form-control @error('device_identifier') is-invalid @enderror"
                                    name="device_identifier" placeholder="Enter device identifier"
                                    value="{{ old('device_identifier') }}" required>
                                @error('device_identifier')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer mt-3">
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
