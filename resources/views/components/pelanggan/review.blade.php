<div {{
    $attributes->merge([
        'class'=> 'review-card'
    ])
}}>
    <div class="row">
        <div class="col-1 avatar">
            <div class="ava">
                <span class="innisial">AR</span>
            </div>
        </div>
        <div class="col-10 review-content">
            <span class="content-user f-title-sm">Abraham Rumayara</span>
            <div class="content-rating">
                @for ($i = 0; $i < 5; $i++)
                    <span class="icon-rating"><i class="fas fa-star"></i></span>
                @endfor
            </div>
            <p class="content-review f-body">
                Bukalapak merupakan situs belanja online terpercaya di Indonesia yang menjual beragam produk yang dibutuhkan seluruh masyarakat Indonesia.
            </p>
            <span class="content-meta-data">
                <span class="meta-data-date f-meta-data">Wednesday, 20-02-2021</span>
            </span>
        </div>
    </div>
</div>