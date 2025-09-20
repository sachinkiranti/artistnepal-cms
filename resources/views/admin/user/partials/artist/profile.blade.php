<div class="tabs-container">
    <ul class="nav nav-tabs" role="tablist">
        <li>
            <a class="nav-link active show" data-toggle="tab" href="#tab-details-about-you">
                <i class="fa fa-user-circle"></i> Details About you
            </a>
        </li>
        <li>
            <a class="nav-link" data-toggle="tab" href="#tab-contact-detail">
                <i class="fa fa-phone"></i> Contact Detail
            </a>
        </li>
        <li>
            <a class="nav-link" data-toggle="tab" href="#tab-social_links">
                <i class="fa fa-globe"></i> Website & Social Links
            </a>
        </li>
        <li>
            <a class="nav-link" data-toggle="tab" href="#tab-experiences">
                <i class="fa fa-clock-o"></i> Experiences
            </a>
        </li>
        <li>
            <a class="nav-link" data-toggle="tab" href="#tab-testimonials">
                <i class="fa fa-quote-left"></i> Testimonials
            </a>
        </li>
        <li>
            <a class="nav-link" data-toggle="tab" href="#tab-awards">
                <i class="fa fa-trophy"></i> Awards
            </a>
        </li>
        <li>
            <a class="nav-link" data-toggle="tab" href="#tab-medias">
                <i class="fa fa-camera"></i> Medias
            </a>
        </li>
    </ul>
    <div class="tab-content">

        @include('admin.user.partials.artist.details-about-you')
        @include('admin.user.partials.artist.contact-detail')
        @include('admin.user.partials.artist.social-links')
        @include('admin.user.partials.artist.experiences')
        @include('admin.user.partials.artist.testimonials')
        @include('admin.user.partials.artist.awards')
        @include('admin.user.partials.artist.medias')

    </div>


</div>
