<x-layouts.auth-layout-component title="Forgot Password" description="Page to forgot password" >
    <article class="row justify-content-center" >

        <header class="text-center col-12" >
            <x-page-title-component title="Forgot Password" />
        </header>

        <div class="text-center col-6" >
            <form method="POST" action="{{ route('password.store') }}">
                @csrf
                <div class="mb-3 input-group">
                    <label for="email" class="input-group-text"><i class="fas fa-envelope"></i></label>
                    <input type="text" name="email" class="form-control required @error('email') is-invalid @enderror" value="{{ old('email') }}" placeholder="Type your email" />
                    @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <button class="btn btn-dark" >Request Reset Password</button>
            </form>
        </div>

        <footer class="pt-5 mt-5 text-center h6 col-12 border-top" >
            <a class="me-5" href="{{ route('login') }}" >
                <i class="fa fa-arrow-left"></i>
                {{ __('Back') }}
            </a>
        </footer>

    </article>
</x-layouts.auth-layout-component>
