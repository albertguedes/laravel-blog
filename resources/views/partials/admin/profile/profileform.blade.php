<form method="POST" action="{{ $route }}" >
    @csrf
    @if(isset($method))
    <input type="hidden" name="_method" value="{{ $method }}">
    @endif
    <input type="hidden" name="profile[id]" value="{{ auth()->user()->id }}" >
    <div class="row pt-4" >
        <div class="col-3" >
            <label class="form-label" >Name</label>
            <input type="text" name="profile[name]" class="form-control @error('profile.name') is-invalid @enderror" value="{{ auth()->user()->name }}" />
            @error('profile.name')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
    </div>
    <div class="row pt-4" >
        <div class="col-3" >
            <label class="form-label" >Email</label>
            <input type="email" name="profile[email]" class="form-control @error('profile.email') is-invalid @enderror" value="{{ auth()->user()->email }}" />
            @error('profile.email')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
    </div>
    <div class="row pt-4" >
        <div class="col-3" >
            <label class="form-label" >Password</label>
            <input type="password" name="profile[password]" class="form-control @error('profile.password') is-invalid @enderror" autocomplete="off" value="" />
            <small class="text-secondary" >Keep empty to not change password</small>
            @error('profile.password')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
    </div>
    <div class="row pt-4" >
        <div class="col-3" >
            <label class="form-label" >Confirm Password</label>
            <input type="password" name="profile[password_confirmation]" class="form-control @error('profile.password_confirmation') is-invalid @enderror" autocomplete="off" value="" />
            @error('profile.password_confirmation')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
    </div>
    <div class="row pt-4" >
        <div class="col-3" >
            <input type="submit" class="btn btn-primary" value="Submit" />
        </div>
    </div>
</form>