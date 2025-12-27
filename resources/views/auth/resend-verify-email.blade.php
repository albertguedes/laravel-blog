<x-layouts.auth-layout-component title="Resend Verify Email" description="Page to resend verify email" >
    <article class="row justify-content-center" >

        <header class="text-center col-12" >
            <x-page-title-component title="Resend Verify Email" />
        </header>

        <div class="text-center col-4" >
            <form method="POST" action="{{ route('verify-email.resend') }}">
                @csrf
                <div class="mb-3 input-group">
                    <label for="email" class="input-group-text"><i class="fas fa-envelope"></i></label>
                    <input type="text" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" placeholder="Type your email" />
                    @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <button class="btn btn-dark" >Request Verify Email</button>
            </form>
        </div>

    </article>
</x-layouts.auth-layout-component>
