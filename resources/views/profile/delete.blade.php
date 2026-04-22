<x-layouts.profile title="Delete" description="Delete your account" >

    <div class="row" >

        <div class="col-12" >
            <x-profile.profile-tabs />
        </div>

        <div class="col-12" >
            <h2 class="alert-heading text-danger my-5 text-center">
                <i class="fas fa-exclamation-triangle"></i> Once you delete your account, there is no going back.<br>
                Are you sure?
            </h2>
        </div>


        <div class="col-6 p-0 m-0 justify-content-end text-end" >
            <a href="{{ route('profile') }}" class="p-3 m-0 btn btn-success">
                <div class="row p-0 m-0" >
                    <div class="text-center p-0 m-0 col-3 d-flex align-items-center justify-content-center h1" >
                        <i class="fa fa-arrow-left p-0 m-0"></i>
                    </div>
                    <div class="col-9 p-0 m-0" >
                        <strong>No</strong> <br> i want to keep my account
                    </div>
                </div>
            </a>
        </div>

        <div class="col-6 justify-content-start" >
            <form class="p-0 m-0" action="{{ route('profile.destroy') }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="p-3 m-0 btn btn-danger">
                    <div class="row p-0 m-0" >
                        <div class="text-center p-0 m-0 col-3 d-flex align-items-center justify-content-center h1" >
                            <i class="fa fa-trash p-0 m-0"></i>
                        </div>
                        <div class="col-9 text-center p-0 m-0" >
                            <strong>Yes</strong> <br> i want to delete my account
                        </div>
                    </div>
                </button>
            </form>
        </div>

    </div>
</x-layouts.profile>
