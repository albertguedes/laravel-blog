<div>

    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form action="{{ $action }}" method="POST" >

        @csrf

        @if( $method )
        <input type="hidden" name="_method" value="{{ $method }}">
        @endif

        @if( isset($profile) && !is_null($profile) )
        <input type="hidden" name="profile[id]" value="{{ $profile->id }}" >
        @endif

        <div class="row pt-4" >
            <div class="col-3" >
                <div class="form-check form-switch">
                    <input type="hidden" name="profile[is_active]" value="0" >
                    <input class="form-check-input" type="checkbox" name="profile[is_active]" id="check_is_active" {{ ( $profile && $profile->is_active ) ? 'checked="checked"' : '' }} value="1" >
                    <label class="form-check-label" for="check_is_active">Is Active</label>
                </div>
            </div>
        </div>

        <div class="row pt-4" >
            <div class="col-3" >
                <label class="form-label" >Name</label>
                <input type="text" name="profile[name]" class="form-control @error('profile.name') is-invalid @enderror" value="{{ $profile->name ?? '' }}" />
                @error('profile.name')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="row pt-4" >
            <div class="col-3" >
                <label class="form-label" >Username</label>
                <input type="text" name="profile[username]" class="form-control @error('profile.username') is-invalid @enderror" value="{{ $profile->username ?? '' }}" />
                @error('profile.username')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="row pt-4" >
            <div class="col-3" >
                <label class="form-label" >Email</label>
                <input type="email" name="profile[email]" class="form-control @error('profile.email') is-invalid @enderror" value="{{ $profile->email ?? '' }}" />
                @error('profile.email')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="row pt-4" >
            <div class="col-3" >
                <label class="form-label" >Password</label>
                <input id="profile-password" type="password" name="profile[password]" class="form-control @error('profile.password') is-invalid @enderror" readonly onfocus="this.removeAttribute('readonly');" onblur="if (this.value == '') { this.value = ''; }" value="" />
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
                <input type="submit" class="btn btn-dark" value="Submit" />
            </div>
        </div>

    </form>
</div>
