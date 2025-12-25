
<form action="{{ route('profile.update', $user) }}" method="POST">

    @csrf

    @method('PUT')

        <div class="input-group mb-3">
            <label for="name" class="input-group-text"><i class="fas fa-user-circle px-0"></i></label>
            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $user->profile->name) }}" placeholder="Type your name" required>
            @error('name')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="input-group mb-3">
            <label for="username" class="input-group-text"><i class="fas fa-id-badge px-0"></i></label>
            <input type="text" name="username" class="form-control @error('username') is-invalid @enderror" value="{{ old('username', $user->profile->username) }}" placeholder="Type a cool username" required>
            @error('username')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="input-group mb-3">
            <label for="email" class="input-group-text"><i class="far fa-envelope px-0"></i></label>
            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email', $user->email) }}" placeholder="Type your email" required>
            @error('email')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="input-group mb-3">
            <label for="about" class="input-group-text"><i class="fas fa-info-circle px-0"></i></label>
            <textarea name="about" class="form-control @error('about') is-invalid @enderror" placeholder="Type something about you" rows="4">{{ old('about', $user->profile->about) }}</textarea>
            @error('about')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <x-send-button-component />

    </div>

</form>
