<div class="card shadow-sm border-0 rounded-4 p-4">

    <!-- Top meta -->
    <div class="d-flex justify-content-between align-items-center mb-4 p-3 rounded-3 bg-light h5">

        <div class="d-flex align-items-center gap-3 me-5">
            <div class="bg-danger bg-opacity-10 text-danger rounded-circle d-flex align-items-center justify-content-center" style="width:48px;height:48px;">
                <i class="fa fa-calendar"></i>
            </div>
            <div class="flex-grow-1" >
                <small class="text-muted d-block">Created</small>
                <strong>{{ $user->created_at->format("Y M d h:i") }}</strong>
            </div>
        </div>

        <div class="d-flex align-items-center me-auto gap-3 ">
            <div class="bg-danger bg-opacity-10 text-danger rounded-circle d-flex align-items-center justify-content-center" style="width:48px;height:48px;">
                <i class="fa fa-refresh"></i>
            </div>
            <div>
                <small class="text-muted d-block">Last updated</small>
                <strong>{{ $user->updated_at->format("Y M d h:i") }}</strong>
            </div>
        </div>

        </div>

        <!-- Profile -->
        <div class="d-flex align-items-center gap-4 my-3">

        <div class="bg-danger text-white rounded-circle d-flex align-items-center justify-content-center" style="width:90px;height:90px;font-size:32px;">
            <i class="fa fa-user"></i>
        </div>

        <div class="flex-grow-1 mb-3">
            <h1 class="mb-2 fw-semibold">{{ $user->profile->name }}</h1>

            <div class="d-flex flex-wrap gap-4 text-muted h4 mt-4">

            <div class="d-flex align-items-center gap-2">
                <i class="fas fa-id-badge text-danger"></i>
                <span>{{ $user->profile->username }}</span>
            </div>

            <div class="d-flex align-items-center gap-2">
                <i class="fa fa-envelope text-danger"></i>
                <span>{{ $user->email }}</span>
            </div>

            <div class="d-flex align-items-center gap-2">
                @if($user->roles->count())
                    <i class="px-1 fas fa-user-shield text-danger"></i>
                    @foreach($user->roles()->orderBy('title', 'ASC')->get() as $role)
                    <span class="pe-2" >{{ $role->title }}</span>
                    @endforeach
                @endif
            </div>

            </div>
        </div>
    </div>

    <hr class="my-4">

    <!-- About -->
    <div class="d-flex gap-3 mt-3">

    <div class="me-4 bg-danger bg-opacity-10 text-danger rounded-circle d-flex align-items-center justify-content-center" style="width:64px;height:64px;">
        <i class="fas fa-info-circle text-danger fs-1"></i>
    </div>

    <div class="flex-grow-1 mt-3">
        <h3 class="mb-3 fw-semibold">About</h3>

        <div class="p-3 bg-light text-muted fst-italic">
            {{ $user->profile->about }}
        </div>
    </div>
    </div>

</div>
