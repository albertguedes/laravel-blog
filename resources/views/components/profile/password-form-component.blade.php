<form class="form w-75 mx-auto" action="{{ route('profile.password.update') }}" method="POST">
    @csrf

    @method('PUT')

    <div class="input-group my-5">
        <label for="password" class="input-group-text"><i class="fas fa-key"></i></label>
        <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="Type your new password" required autocomplete="off" />
        @error('password')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="input-group my-5">
        <label for="password_confirmation" class="input-group-text"><i class="fas fa-key"></i></label>
        <input type="password" name="password_confirmation" class="form-control @error('password_confirmation') is-invalid @enderror" placeholder="Confirm your new password" required />
        @error('password_confirmation')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <x-send-button-component />

</form>
