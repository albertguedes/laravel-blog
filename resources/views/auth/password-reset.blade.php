<x-layouts.auth-layout-component title="Password Reset" description="Page to reset password" >
    <article class="row justify-content-center" >

        <header class="text-center col-12" >
            <x-page-title-component title="Password Reset" />
        </header>

        <div class="col-6" >
            <form method="POST" action="{{ route('password.reset.update') }}">

                @csrf

                <input type="hidden" name="token" value="{{ $token }}" >

                <div class="mb-3 input-group">
                    <label for="password" class="input-group-text"><i class="px-0 fas fa-key"></i></label>
                    <input type="password" name="password" class="form-control required @error('password') is-invalid @enderror" placeholder="Type your password" required autocomplete="new-password">
                    @error('password')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3 input-group">
                    <label for="password_confirmation" class="input-group-text"><i class="px-0 fas fa-key"></i></label>
                    <input type="password" name="password_confirmation" class="form-control required @error('password_confirmation') is-invalid @enderror" placeholder="Confirm your password" required autocomplete="new-password">
                    @error('password_confirmation')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <x-send-button-component />
            </form>
        </div>

    </article>
</x-layouts.auth-layout-component>
