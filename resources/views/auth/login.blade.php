<x-layouts.auth-layout-component title="Login" description="User login" >
    <section class="row justify-content-center" >

        <header class="text-center col-12" >
            <x-page-title-component title="Login" />
        </header>

        <article class="col-6" >
            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="mb-4 input-group">
                    <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                    <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" placeholder="Type your email" required>
                    @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-4 input-group">
                    <span class="input-group-text"><i class="fas fa-lock"></i></span>
                    <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="Type your password" required>
                    @error('password')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="row justify-content-center" >
                    <div class="col-5" >
                        <div class="mb-4 form-check h6" >
                            <input class="form-check-input @error('remember') is-invalid @enderror" type="checkbox" value="1" id="remember" name="remember" >
                            <label class="form-check-label" for="remember">
                                {{ __('Remember me') }}
                            </label>
                        </div>
                    </div>
                </div>

                <x-send-button-component />

            </form>
        </article>

        <footer class="pt-5 mt-5 text-center h6 col-12 border-top" >
            <a class="me-5" href="{{ route('password') }}" >
                <i class="fa fa-key"></i>
                {{ __('Reset Password') }}
            </a>

            <a href="{{ route('register') }}" >
                <i class="fa fa-user-plus"></i>
                {{ __('Register') }}
            </a>
        </footer>

    </section>
</x-layouts.auth-layout-component>
