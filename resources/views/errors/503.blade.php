<x-layouts.error title="503 - Service Unavailable" description="Error 503 - Service Unavailable" >

    <x-common.page-title title="503 - Service Unavailable" />

    <p>
        Try again later or report the problem by sending an email to
        <a href="mailto:{{ env('MAIL_TO_ADDRESS') }}" >{{ env('MAIL_TO_ADDRESS') }}</a>.
    </p>

    <p>Sorry for the inconvenience.</p>

</x-layouts.error>
