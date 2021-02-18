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
                @for ($i = 0; $i < 5; $i++)
                    @if($reviewInfo->rating > $i)
                        <i class="fas fa-star" style="color: #E7BE45;"></i>
                    @else
                        <i class="fas fa-star"></i>
                    @endif
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