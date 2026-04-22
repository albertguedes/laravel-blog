<div class="card mt-3" >

    <div class="card-header py-2"  >
        <h6 class="p-0 m-0 card-title text-capitalize" >
            <i class="fa fa-calendar-plus me-1"></i> {{ $user->created_at->format("Y M d h:i") }}
            <i class="fa fa-sync ms-3"></i> {{ $user->profile->updated_at->format("Y M d h:i") }}
        </h6>
    </div>

    <div class="card-body" >
        <div class="row" >

            <div class="col-12" >
                <h3 class="text-capitalize text-danger">
                    <i class="fas fa-user-circle"></i> {{ $user->profile->name }}
                </h3>
                <h6>
                    <ul class="list-unstyled d-flex" >
                        <li class="list-item me-3" >
                            <i class="px-1 fas fa-id-badge text-danger"></i> {{ $user->profile->username }}
                        </li>
                        <li class="list-item me-3" >
                            <i class="fa fa-envelope text-danger"></i> {{ $user->email }}
                        </li>
                        <li class="list-item me-3" >
                            @if($user->roles->count())
                            <i class="px-1 fas fa-user-shield text-danger"></i>
                                @foreach($user->roles()->orderBy('title', 'ASC')->get() as $role)
                                    <span class="pe-2" >{{ $role->title }}</span>
                                @endforeach
                            @endif
                        </li>
                    </ul>
                </h6>
            </div>

            <div class="mt-3 col-12" >
                <h3>
                    <i class="fas fa-info-circle text-danger"></i> About
                </h3>
                <div class="p-2 w-100 fst-italic">
                    {{ $user->profile->about }}
                </div>
            </div>

        </div>
    </div>
</div>
