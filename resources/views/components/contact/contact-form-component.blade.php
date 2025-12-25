<form class="row" method="POST" action="{{ route('contact.send') }}" itemprop="url">

    @csrf

    <div class="input-group mb-3">
        <span class="input-group-text" id="name-addon"><i class="fas fa-id-card"></i></span>
        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="name" aria-describedby="nameHelp" placeholder="Type your name" value="{{ old('name') }}" itemprop="name">
        @error('name')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="input-group mb-3">
        <span class="input-group-text" id="email-addon"><i class="far fa-envelope"></i></span>
        <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" id="email" aria-describedby="emailHelp" placeholder="Type your email" value="{{ old('email') }}" itemprop="email">
        @error('email')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="input-group mb-3">
        <span class="input-group-text" id="subject-addon"><i class="far fa-list-alt"></i></span>
        <input type="text" name="subject" class="form-control @error('subject') is-invalid @enderror" id="subject" aria-describedby="subjectHelp" placeholder="Type subject of message" value="{{ old('subject') }}" itemprop="subject" >
        @error('subject')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <textarea name="message" rows=10 class="form-control @error('message') is-invalid @enderror" id="message" aria-describedby="contentHelp" placeholder="Type the message" >{{ old('message') }}</textarea>
        @error('message')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="d-flex justify-content-center mb-3">
        <x-send-button-component />
    </div>

</form>
