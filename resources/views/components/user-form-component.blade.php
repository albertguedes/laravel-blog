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

        @if( isset($user) && !is_null($user) )
        <input type="hidden" name="user[id]" value="{{ $user->id }}" >
        @endif

        <div class="row pt-4" >
            <div class="col-3" >
                <div class="form-check form-switch">
                    <input type="hidden" name="user[is_active]" value="0" >
                    <input class="form-check-input" type="checkbox" name="user[is_active]" id="check_is_active" {{ ( $user && $user->is_active ) ? 'checked="checked"' : '' }} value="1" >
                    <label class="form-check-label" for="check_is_active">Is Active</label>
                </div>
            </div>
        </div>

        <div class="row pt-4" >
            <div class="col-3" >
                <label class="form-label" >Name</label>
                <input type="text" name="user[name]" class="form-control @error('user.name') is-invalid @enderror" value="{{ $user->name ?? '' }}" />
                @error('user.name')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="row pt-4" >
            <div class="col-3" >
                <label class="form-label" >Username</label>
                <input type="text" name="user[username]" class="form-control @error('user.username') is-invalid @enderror" value="{{ $user->username ?? '' }}" />
                @error('user.username')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="row pt-4" >
            <div class="col-3" >
                <label class="form-label" >Email</label>
                <input type="email" name="user[email]" class="form-control @error('user.email') is-invalid @enderror" value="{{ $user->email ?? '' }}" />
                @error('user.email')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="row pt-4" >
            <div class="col-3" >
                <label class="form-label" >Password</label>
                <input type="password" name="user[password]" class="form-control @error('user.password') is-invalid @enderror" autocomplete="off" value="" />
                <small class="text-secondary" >Keep empty to not change password</small>
                @error('user.password')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="row pt-4" >
            <div class="col-3" >
                <label class="form-label" >Confirm Password</label>
                <input type="password" name="user[password_confirmation]" class="form-control @error('user.password_confirmation') is-invalid @enderror" autocomplete="off" value="" />
                @error('user.password_confirmation')
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
</div>
