<x-layouts.profile title="Delete" description="Delete your account" >
    <div class="row" >

        <div class="pt-3 col-12" >
            <div class="text-center alert alert-warning" role="alert">
                <h2>
                    <i class="fas fa-exclamation-triangle"></i> Once you delete your account, there is no going back.
                </h2>
                <p class="alert-heading">Are you sure?</p>
            </div>
        </div>

        <div class="text-center col-6" >
            <a href="{{ route('profile') }}" class="py-4 btn btn-success btn-lg">
                <div class="row" >
                    <div class="text-center col-3 d-flex align-items-center justify-content-center h1" >
                        <i class="fa fa-arrow-left"></i>
                    </div>
                    <div class="col-9" >
                        <strong>No</strong> <br> i want to keep my account
                    </div>
                </div>
            </a>
        </div>

        <div class="col-6 justify-content-center" >

            <form class="p-0 m-0" action="{{ route('profile.destroy') }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="py-4 btn btn-danger btn-lg">
                    <div class="row" >
                        <div class="text-center col-3 d-flex align-items-center justify-content-center h1" >
                            <i class="fa fa-trash"></i>
                        </div>
                        <div class="col-9" >
                            <strong>Yes</strong> <br> i want to delete my account
                        </div>
                    </div>
                </button>
            </form>
        </div>

    </div>
</x-layouts.profile>
