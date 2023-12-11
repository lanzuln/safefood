<section class="services__section services__section--bg section--padding">
    <div class="container">
        <div class="section__heading text-center mb-50">
            <h2 class="section__heading--maintitle text__secondary mb-10">Our Best Service</h2>
            <p class="section__heading--desc">Beyond more stoic this along goodness this sed wow manatee mongos
                flusterd impressive man farcrud opened.</p>
        </div>
        <div class="services__inner">
            <div class="row row-cols-lg-3 row-cols-md-2 row-cols-sm-2 row-cols-2 mb--n30">
                @foreach ($services as $item)
                <div class="col custom-col mb-30">
                    <article class="services__card">
                        <a class="services__card--link" href="product-details.html">
                            <div class="services__card--topbar d-flex justify-content-between">
                                <div class="services__card--icon mb-20">
                                    <img class="display-block services_icon" src="{{asset($item->image)}}" alt="services-icon">
                                </div>
                                <div class="services__card--number">
                                    <span class="services__card--number__text">1</span>
                                </div>
                            </div>
                            <div class="services__card--content">
                                <h3 class="services__card--maintitle mb-15">{{$item->title}}</h3>
                                <p class="services__card--desc mb-15">{{$item->text}}</p>
                                <span class="services__card--readmore text__secondary"> Read More
                                    <svg class="services__card--readmore__svg" xmlns="http://www.w3.org/2000/svg" width="15.51" height="15.443" viewBox="0 0 512 512"><path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="48" d="M268 112l144 144-144 144M392 256H100"/></svg>
                                </span>
                            </div>
                        </a>
                    </article>
                </div>
                @endforeach

            </div>
        </div>
    </div>
</section>
