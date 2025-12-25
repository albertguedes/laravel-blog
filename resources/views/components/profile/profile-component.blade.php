<div class="row" >

    <div class="col-12 mb-5" >
        <h3 class="text-capitalize">
            <i class="fas fa-user-circle text-danger"></i> {{ $user->profile->name }}
        </h3>
    </div>

    <div class="col-12 mb-5" >
        <h3>
            <i class="fas fa-id-badge text-danger px-1"></i> {{ $user->profile->username }}
        </h3>
    </div>

    <div class="col-12 mb-5" >
        <h3>
            <i class="fa fa-envelope text-danger"></i> {{ $user->email }}
        </h3>
    </div>

    <div class="col-12 mb-5" >
        @if($user->roles->count())
        <h3>
            <i class="fas fa-user-shield text-danger px-1"></i>
            @foreach($user->roles()->orderBy('title', 'ASC')->get() as $role)
                <span class="pe-2" >{{ $role->title }}</span>
            @endforeach
        </h3>
        @endif
    </div>

    <div class="col-12 mb-5" >
        <h3>
            <i class="fas fa-info-circle text-danger"></i> About
        </h3>
        <p class="fw-bolder">{{ $user->profile->about }}</p>
    </div>

</div>
