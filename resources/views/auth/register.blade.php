<x-layouts.auth-layout-component title="Register" description="User registration" >
    <article class="row justify-content-center" >

        <header class="text-center col-12" >
            <x-page-title-component title="Register" />
        </header>

        <div class="col-6" >
            <form method="POST" action="{{ route('register') }}">

                @csrf

                <div class="mb-3 input-group">
                    <label for="name" class="input-group-text"><i class="px-0 fas fa-user-circle"></i></label>
                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" placeholder="Type your name" required>
                    @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3 input-group">
                    <label for="username" class="input-group-text"><i class="px-0 fas fa-id-badge"></i></label>
                    <input type="text" name="username" class="form-control @error('username') is-invalid @enderror" value="{{ old('username') }}" placeholder="Type a cool username" required>
                    @error('username')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3 input-group">
                    <label for="email" class="input-group-text"><i class="px-0 far fa-envelope"></i></label>
                    <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" placeholder="Type your email" required>
                    @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3 input-group">
                    <label for="password" class="input-group-text"><i class="px-0 fas fa-key"></i></label>
                    <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="Type your password" required autocomplete="new-password">
                    @error('password')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3 input-group">
                    <label for="password_confirmation" class="input-group-text"><i class="px-0 fas fa-key"></i></label>
                    <input type="password" name="password_confirmation" class="form-control @error('password_confirmation') is-invalid @enderror" placeholder="Confirm your password" required autocomplete="new-password">
                    @error('password_confirmation')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3 form-group">
                    <div class="input-group">
                        <label for="about" class="input-group-text"><i class="px-0 fas fa-info-circle"></i></label>
                        <textarea name="about" class="form-control @error('about') is-invalid @enderror" placeholder="Tell us something about yourself" required>{{ old('about') }}</textarea>
                        @error('about')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <x-send-button-component />
            </form>
        </div>

        <footer class="pt-5 mt-5 text-center h6 col-12 border-top" >
            <a href="{{ route('login') }}">
                <i class="fa fa-arrow-left"></i>
                {{ __('Back') }}
            </a>
        </footer>
    </article>
</x-layouts.auth-layout-component>
