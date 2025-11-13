<div
    style="max-width: 1000px; margin: 20px auto; font-family: 'Poppins', sans-serif; padding: 0 15px;">
    <div class="artistnepal-faq">
        @foreach($data['faqs'] as $faq)
            <div class="faq-item" onclick="this.classList.toggle('faq-active')">
                <div class="faq-question">
                    <div class="faq-icon">♪</div>
                    <h3 class="faq-title">{{ ucwords($faq->faq_name) }}</h3>
                    <div class="faq-toggle">+</div>
                </div>
                <div class="faq-answer">
                    <div class="faq-content">
                        <p>{!! $faq->body !!}</p>
                        <p>
                            <span class="nepali-text">{!! $faq->secondary_body !!}</span>
                        </p>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
