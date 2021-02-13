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
            <span class="content-user f-title-sm">{{$reviewInfo->pelanggan->nama}}</span>
            <div class="content-rating">
                @for ($i = 0; $i < $reviewInfo->rating; $i++)
                    <span class="icon-rating"><i class="fas fa-star"></i></span>
                @endfor
            </div>
            <p class="content-review f-body">
                {{$reviewInfo->ulasan}}
            </p>
            <span class="content-meta-data">
                <span class="meta-data-date f-meta-data">{{$reviewInfo->created_at}}</span>
            </span>
        </div>
    </div>
</div>