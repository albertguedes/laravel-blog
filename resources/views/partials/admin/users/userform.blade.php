<form method="POST" action="{{ $route }}" >
    @csrf
    @if(isset($method))
    <input type="hidden" name="_method" value="{{ $method }}">
    @endif
    @if(isset($user))
    <input type="hidden" name="user[id]" value="{{ $user->id }}" >
    @endif
    <div class="row pt-4" >
        <div class="col-3" >
            <label class="form-label" >Name</label>
            <input type="text" name="user[name]" class="form-control" value="@if(isset($user)){{ $user->name }}@endif" />
        </div>
    </div>
    <div class="row pt-4" >
        <div class="col-3" >
            <label class="form-label" >Email</label>
            <input type="email" name="user[email]" class="form-control" value="@if(isset($user)){{ $user->email }}@endif" />
        </div>
    </div>
    <div class="row pt-4" >
        <div class="col-3" >
            <label class="form-label" >Password</label>
            <input type="password" name="user[password]" class="form-control" autocomplete="off" value="" />
            <small class="text-secondary" >Keep empty to not change password</small>
        </div>
    </div>
    <div class="row pt-4" >
        <div class="col-3" >
            <label class="form-label" >Confirm Password</label>
            <input type="password" name="user[password_confirmation]" class="form-control" autocomplete="off" value="" />
        </div>
    </div>
    <div class="row pt-4" >
        <div class="col-3" >
            <input type="submit" class="btn btn-primary" value="Submit" />
        </div>
    </div>
</form>