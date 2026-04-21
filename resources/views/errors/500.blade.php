<x-layouts.error title="500 - Internal Server Error" description="Error 500 - Internal Server Error" >

    <x-common.page-title title="500 - Internal Server Error" />

    <p>
        Try again later or report the problem by sending an email to
        <a href="mailto:{{ env('MAIL_TO_ADDRESS') }}" >{{ env('MAIL_TO_ADDRESS') }}</a>.
    </p>

    <p>Sorry for the inconvenience.</p>

</x-layouts.error>
