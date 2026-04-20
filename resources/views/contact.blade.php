<x-layouts.main-layout-component title="Contact" description="Contact us" >
    <section class="row" itemscope itemtype="http://schema.org/ContactPage">

        <header class="col-12">
            <x-page-title-component title="Contact" />
        </header>

        <aside class="col-12 col-sm-12 col-md-4 col-lg-4 col-xl-4 col-xxl-4">
            <address itemscope itemtype="http://schema.org/PostalAddress" itemprop="address" class="text-center text-sm-center text-md-start text-lg-start text-xl-start text-xxl-start" >
                <h5><i class="fas fa-map-marked-alt"></i> Address</h5>
                <p itemprop="streetAddress">Sample Street, 123</p>
                <p itemprop="addressLocality">Sample City, AB</p>
                <br>
                <h6><i class="far fa-envelope"></i> Email</h6>
                <p itemprop="email"><a href="mailto:contact@fakemail.com">contact@fakemail.com</a></p>
                <br>
                <h6><i class="fas fa-phone-alt"></i> Telephone</h6>
                <p itemprop="telephone">+1 11 123-456-789</p>
            </address>
        </aside>

        <article class="col-12 col-sm-12 col-md-8 col-lg-8 col-xl-8 col-xxl-8" itemprop="hasPart" itemscope itemtype="http://schema.org/FormObject">
            <x-contact.contact-form-component />
        </article>

    </section>
</x-layouts.main-layout-component>
