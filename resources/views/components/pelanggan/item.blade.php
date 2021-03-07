<div class="item-outer">
    <div {{
        $attributes->merge([
            'class'=> 'item-card'
        ])
    }}>
        <div class="thumbnail">
            <div class="thumbnail-inner" style="background: url('{{asset('images/kendaraan/'.$outlineInfo->gambar)}}') center center; background-size: cover;">
            </div>
        </div>
        <div class="title-outer">
            <h5 class="title f-title-sm"><a class="f-title-sm" href="#" title="title">{{$outlineInfo->nama_kendaraan}}</a></h5>
        </div>
        <div class="meta-outer">
            <span class="meta meta-vehicle-merk f-meta-data">{{$outlineInfo->merk}}</span>
            <span class="meta meta-vehicle-type f-meta-data">{{$outlineInfo->jenis}}</span>
            <span class="meta meta-vehicle-year f-meta-data">{{$outlineInfo->tahun}}</span>
            <span class="meta meta-vehicle-color f-meta-data">{{$outlineInfo->warna}}</span>
        </div>
        {{-- <div class="desc-outer">
            <p class="desc f-body">It appears with the code for the icon instead of the icon. I have followed the online helps but still not working</p>
        </div> --}}
        <div class="price-outer">
            <span class="f-title-md price">IDR {{$outlineInfo->harga_sewa}}/Day</span>
        </div>
        <div class="branch-outer">
            <div class="branch">
                <i class="icon fas fa-map-marker-alt"></i>
                <span class="f-meta-data">{{$outlineInfo->cabang->nama_cabang}} - {{$outlineInfo->cabang->kota->nama}}</span>
            </div>
        </div>
        <div class="cta-outer">
            <a href="{{route("pelanggan.detail.index", $outlineInfo->id_kendaraan)}}" class="btn btn-md btn-primary btn-full btn-icon">
                <i class="fas fa-handshake"></i> Rent Now
            </a>
        </div>
    </div>
</div>