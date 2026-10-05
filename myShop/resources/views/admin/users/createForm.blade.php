@extends('admin.layout.app')
@section('mainPart')
@php
$isEdit=isset($userEdit,$roles);

@endphp

<form method="POST" action="{{$isEdit ? route('user.update') : route('user.insert')}}">
    @csrf

    @if($isEdit)
    <input type="hidden" name="id" value="{{ $userEdit->id}}">
    @endif
    <div class="row g-4 mb-4 justify-content-center">
        @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <div class="col-12 col-lg-6">
            <div class="card border-light shadow-sm p-4 h-100">
                <h5 class="card-title mb-4">User Creation Form</h5>

                <!-- Text input -->
                <div class="mb-3">
                    <label for="basicText" class="form-label-custom">Name</label>
                    <input type="text" class="form-control-custom" id="basicText" name="name"
                        value="{{ old('name', $userEdit->name ?? '')}}" placeholder="Enter username" required>
                    @error('name') <small>{{ $message }}</small> @enderror

                </div>

                <!-- Email input -->
                <div class="mb-3">
                    <label for="basicEmail" class="form-label-custom">Email Address</label>
                    <input type="email" class="form-control-custom" id="basicEmail" name="email"
                        value="{{ old('email', $userEdit->email?? '')}}" placeholder="name@example.com" required>
                    <span class="text-muted">We'll never share your email with anyone else.</span>
                    @error('email') <small>{{ $message }}</small> @enderror

                </div>

                <!-- Password input -->
                <div class="mb-3">
                    <label for="basicPassword" class="form-label-custom">Password</label>
                    <input type="password" class="form-control-custom" id="basicPassword" name="password"
                        placeholder="{{ $isEdit ? 'Leave blank to keep the current password' : 'Enter your secure password' }}"
                        {{ $isEdit ? '' : 'required' }}>
                    @error('password') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <!-- Role selection input -->
                @php
                $currentRole = old('role_id', isset($userEdit) ? $userEdit->roles->first()?->id: null);
                @endphp
                <div class="mb-3">
                    <label for="selectControl" class="form-label-custom">Role</label>
                    <select class="form-select-custom" id="selectControl" name="role_id" required>
                        <option selected disabled>Choose a role </option>
                        <option value="1" {{ $currentRole==1 ? 'selected' : '' }}>Admin</option>
                        <option value="2" {{ $currentRole==2 ? 'selected' : '' }}>Vendor Manager</option>
                        <option value="6" {{ $currentRole==6 ? 'selected' : '' }}>Vendor</option>
                    </select>
                </div>
                <div class="mb-3">
                    <button type="submit" class="form-control-custom btn-quick-action">{{ $isEdit ? 'Update' :
                        'Submit'}}</button>
                </div>
            </div>
        </div>

    </div>
</form>
@endsection