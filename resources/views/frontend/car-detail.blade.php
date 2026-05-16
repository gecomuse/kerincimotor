@extends('frontend.layouts.app')
@section('title', $car->make_model . ' ' . $car->year . ' Bekas | Kerinci Motor')
@section('description', 'Beli ' . $car->make_model . ' tahun ' . $car->year . ', ' . $car->formatted_mileage . ', transmisi ' . $car->transmission . '. Harga ' . $car->formatted_price . '. Hubungi Kerinci Motor via WhatsApp.')
@section('og_image', $car->getFirstMediaUrl('car_images','medium') ?: $car->getFirstMediaUrl('car_images'))

@section('content')

@php
  $images = $car->getMedia('car_images');
  $rawMain = $car->large_image ?: ($images->first()?->getUrl() ?? 'https://images.unsplash.com/photo-1503376780353-7e6692767b70?q=80&w=1400');
  $mainImg = str_replace('/storage/', '/storage_assets/', $rawMain);
  $FIXED_INSURANCE = 6000000;
  $dp30 = round($car->price * 0.30);
  $principal = ($car->price - $dp30) + $FIXED_INSURANCE;
  $tenor = 48;
  $totalBunga = $principal * (0.11 * ($tenor / 12));
  $cicilanEst = isset($cicilanPerBulan) ? $cicilanPerBulan : round(($principal + $totalBunga) / $tenor + 200000);
@endphp

{{-- STICKY CTA BAR --}}
<div id="sticky-cta" style="display:none;position:fixed;bottom:0;left:0;right:0;z-index:900;background:rgba(255,255,255,0.96);backdrop-filter:blur(20px);border-top:1px solid var(--g100);padding:14px 24px;box-shadow:0 -8px 32px rgba(0,0,0,0.1);">
  <div style="max-width:1280px;margin:0 auto;display:flex;align-items:center;justify-content:space-between;gap:16px;flex-wrap:wrap;">
    <div>
      <div style="font-weight:900;font-size:1rem;font-family:'Raleway',sans-serif;">{{ $car->make_model }} {{ $car->year }}</div>
      <div style="font-weight:900;font-size:1.25rem;color:var(--red);font-family:'Raleway',sans-serif;">{{ $car->formatted_price }}</div>
    </div>
    <div style="display:flex;gap:10px;flex-wrap:wrap;">
      <a href="{{ $car->whatsapp_url }}" target="_blank" rel="noopener" class="btn-red" style="padding:12px 24px;border-radius:100px;font-size:.875rem;text-decoration:none;">💬 Tanya via WA</a>
      <a href="{{ route('inventory.index') }}" class="btn-outline" style="padding:12px 24px;border-radius:100px;font-size:.875rem;text-decoration:none;"><span>← Kembali</span></a>
    </div>
  </div>
</div>

{{-- BREADCRUMB --}}
<div style="padding-top:72px;background:#fff;border-bottom:1px solid var(--g100);">
  <div style="max-width:1280px;margin:0 auto;padding:16px 24px;">
    <div style="display:flex;align-items:center;gap:8px;font-size:.8rem;color:var(--g400);font-weight:600;flex-wrap:wrap;">
      <a href="{{ route('home') }}" style="color:var(--g400);text-decoration:none;transition:.2s;" onmouseover="this.style.color='var(--red)'" onmouseout="this.style.color='var(--g400)'">Beranda</a>
      <span>›</span>
      <a href="{{ route('inventory.index') }}" style="color:var(--g400);text-decoration:none;transition:.2s;" onmouseover="this.style.color='var(--red)'" onmouseout="this.style.color='var(--g400)'">Inventaris</a>
      <span>›</span>
      <span style="color:var(--black);">{{ $car->make_model }} {{ $car->year }}</span>
    </div>
  </div>
</div>

<section style="padding:40px 0 80px;background:#fff;">
  <div style="max-width:1280px;margin:0 auto;padding:0 24px;">
    <div style="display:grid;grid-template-columns:1.1fr 1fr;gap:56px;align-items:start;" id="detail-grid">

      {{-- LEFT: GALLERY --}}
      <div class="reveal-left">
        <div style="border-radius:28px;overflow:hidden;background:var(--g50);margin-bottom:16px;position:relative;" id="main-img-wrap">
          <img id="main-img" src="{{ $mainImg }}" style="width:100%;height:480px;object-fit:cover;display:block;transition:opacity .3s;" alt="{{ $car->make_model }} {{ $car->year }}">
          @if($car->is_featured)
          <span style="position:absolute;top:20px;left:20px;background:var(--red);color:#fff;font-size:.78rem;font-weight:800;padding:6px 16px;border-radius:100px;font-family:'Raleway',sans-serif;">🔥 HOT DEAL</span>
          @endif
          <span style="position:absolute;top:20px;right:20px;font-size:.78rem;font-weight:800;padding:6px 14px;border-radius:100px;font-family:'Raleway',sans-serif;{{ $car->is_available ? 'background:rgba(34,197,94,0.9);color:#fff;' : 'background:rgba(0,0,0,0.8);color:#fff;' }}">{{ $car->is_available ? '✓ TERSEDIA' : '✗ TERJUAL' }}</span>
        </div>
        @if($images->count() > 1)
        <div style="display:flex;gap:10px;flex-wrap:wrap;" id="thumbs">
          @foreach($images as $i => $media)
          @php
          $url = $media->hasGeneratedConversion('thumb') ? $media->getUrl('thumb') : $media->getUrl();
          $url = str_replace('/storage/', '/storage_assets/', $url);
          $switchUrl = $media->hasGeneratedConversion('large') ? $media->getUrl('large') : $media->getUrl();
          $switchUrl = str_replace('/storage/', '/storage_assets/', $switchUrl);
          @endphp
          <div class="gallery-thumb {{ $i===0?'active':'' }}" onclick="switchImg('{{ $switchUrl }}',this)" style="width:80px;flex-shrink:0;">
            <img src="{{ $url }}" alt="Foto {{ $i+1 }}" loading="lazy">
          </div>
          @endforeach
        </div>
        @endif
      </div>

      {{-- RIGHT: INFO --}}
      <div class="reveal-right" style="position:sticky;top:92px;">
        <div style="margin-bottom:8px;">
          <div class="section-tag">{{ $car->year }} · {{ strtoupper($car->transmission) }}</div>
          <h1 style="font-size:clamp(1.6rem,3.5vw,2.6rem);font-weight:900;letter-spacing:-1px;font-family:'Raleway',sans-serif;line-height:1.1;margin-bottom:16px;">{{ $car->make_model }}</h1>
          <div style="font-size:2.4rem;font-weight:900;font-family:'Raleway',sans-serif;color:var(--red);margin-bottom:24px;">{{ $car->formatted_price }}</div>
        </div>

        {{-- SPEC TABLE --}}
        <div style="margin-bottom:28px;border-radius:20px;border:1px solid var(--g200);padding:8px 20px;background:var(--g50);">
          <div class="spec-row"><span class="spec-key">Kilometer</span><span class="spec-val">{{ $car->formatted_mileage }}</span></div>
          <div class="spec-row"><span class="spec-key">Transmisi</span><span class="spec-val">{{ ucfirst($car->transmission) }}</span></div>
          <div class="spec-row"><span class="spec-key">Tahun</span><span class="spec-val">{{ $car->year }}</span></div>
          @if($car->body_type)
          <div class="spec-row"><span class="spec-key">Tipe Bodi</span><span class="spec-val">{{ $car->body_type }}</span></div>
          @endif
          @if($car->color)
          <div class="spec-row"><span class="spec-key">Warna</span><span class="spec-val">{{ $car->color }}</span></div>
          @endif
          @if($car->fuel_type)
          <div class="spec-row"><span class="spec-key">Bahan Bakar</span><span class="spec-val">{{ ucfirst($car->fuel_type) }}</span></div>
          @endif
          <div class="spec-row"><span class="spec-key">Status</span><span class="spec-val" style="{{ $car->is_available ? 'color:#22c55e;' : 'color:var(--red);' }}">{{ $car->is_available ? '✓ Tersedia' : '✗ Terjual' }}</span></div>
        </div>

        {{-- CICILAN --}}
        <div style="background:var(--black);border-radius:20px;padding:20px;margin-bottom:24px;position:relative;overflow:hidden;">
          <div class="orb" style="width:150px;height:150px;background:rgba(204,0,0,0.2);top:-30px;right:-30px;animation:orbFloat2 6s ease-in-out infinite;"></div>
          <div style="position:relative;z-index:2;">
            <div style="color:rgba(255,255,255,.5);font-size:.75rem;font-weight:700;text-transform:uppercase;letter-spacing:.5px;margin-bottom:4px;">Estimasi Cicilan (DP 30%, 48 bln)</div>
            <div style="font-size:1.75rem;font-weight:900;color:#fff;font-family:'Raleway',sans-serif;">Rp {{ number_format($cicilanEst,0,',','.') }}<span style="font-size:1rem;font-weight:600;">/bln</span></div>
            <div style="color:rgba(255,255,255,.4);font-size:.72rem;margin-top:4px;font-weight:600;">*Estimasi, hubungi kami untuk detail kredit</div>
            <a href="{{ route('home') }}#financing" style="display:inline-flex;align-items:center;gap:6px;color:var(--red);font-size:.8rem;font-weight:800;text-decoration:none;margin-top:10px;" onmouseover="this.style.opacity='.7'" onmouseout="this.style.opacity='1'">Simulasi lebih detail →</a>
          </div>
        </div>

        {{-- CTA BUTTONS --}}
        <div style="display:flex;flex-direction:column;gap:12px;">
          <a href="{{ $car->whatsapp_url }}" target="_blank" rel="noopener" class="btn-red" style="width:100%;padding:16px;border-radius:100px;font-size:1rem;text-decoration:none;justify-content:center;">💬 Tanya / Booking via WhatsApp</a>
          <a href="{{ route('inventory.index') }}" class="btn-outline" style="width:100%;padding:14px;border-radius:100px;font-size:.9rem;text-decoration:none;justify-content:center;"><span>← Lihat Unit Lainnya</span></a>
        </div>

        {{-- TRUST --}}
        <div style="display:flex;gap:16px;margin-top:20px;padding-top:20px;border-top:1px solid var(--g100);flex-wrap:wrap;">
          @foreach(['✓ Bebas Banjir','✓ Bebas Laka','✓ BPKB Asli','✓ Garansi Mesin'] as $trust)
          <span style="font-size:.72rem;font-weight:700;color:var(--g500);">{{ $trust }}</span>
          @endforeach
        </div>
      </div>
    </div>

    {{-- DESCRIPTION --}}
    @if($car->description ?? $car->condition_notes ?? null)
    <div style="margin-top:56px;max-width:760px;">
      <h2 class="reveal" style="font-weight:900;font-size:1.5rem;font-family:'Raleway',sans-serif;margin-bottom:16px;">Deskripsi & Kondisi</h2>
      <div class="reveal" style="color:var(--g600);line-height:1.8;font-size:.95rem;font-weight:500;">{!! $car->description ?? $car->condition_notes !!}</div>
    </div>
    @endif

    {{-- RELATED CARS --}}
    @if(isset($relatedCars) && $relatedCars->count() > 0)
    <div style="margin-top:72px;">
      <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:32px;flex-wrap:wrap;gap:16px;">
        <h2 class="reveal" style="font-weight:900;font-size:1.6rem;font-family:'Raleway',sans-serif;letter-spacing:-.5px;">Unit Serupa</h2>
        <a href="{{ route('inventory.index') }}" class="btn-outline reveal" style="padding:11px 24px;border-radius:100px;font-size:.875rem;text-decoration:none;"><span>Lihat Semua →</span></a>
      </div>
      <div style="display:grid;grid-template-columns:repeat(4,1fr);gap:20px;" id="rel-grid">
        @foreach($relatedCars as $rel)
        @php
        $relImg = $rel->thumbnail ?: 'https://images.unsplash.com/photo-1503376780353-7e6692767b70?q=80&w=800';
        $relImg = str_replace('/storage/', '/storage_assets/', $relImg);
        @endphp
        <div class="car-card reveal" onclick="window.location='{{ route('car.detail', $rel->slug) }}'" style="background:#fff;border-radius:20px;overflow:hidden;box-shadow:0 2px 16px rgba(0,0,0,0.07);border:1px solid var(--g100);">
          <div class="card-glow"></div>
          <div class="thumb" style="overflow:hidden;">
            <img src="{{ $relImg }}" style="width:100%;height:160px;object-fit:cover;display:block;" alt="{{ $rel->make_model }}" loading="lazy">
          </div>
          <div style="padding:16px;">
            <div style="color:var(--g400);font-size:.7rem;font-weight:600;margin-bottom:4px;">{{ $rel->year }} · {{ $rel->formatted_mileage }}</div>
            <h4 style="font-weight:900;font-size:.9rem;font-family:'Raleway',sans-serif;margin-bottom:8px;overflow:hidden;display:-webkit-box;-webkit-line-clamp:2;-webkit-box-orient:vertical;">{{ $rel->make_model }}</h4>
            <div style="font-weight:900;font-size:1rem;color:var(--red);font-family:'Raleway',sans-serif;">{{ $rel->formatted_price }}</div>
          </div>
        </div>
        @endforeach
      </div>
      <style>@media(max-width:900px){#rel-grid{grid-template-columns:repeat(2,1fr)!important;}}</style>
    </div>
    @endif
  </div>
</section>
<style>@media(max-width:900px){#detail-grid{grid-template-columns:1fr!important;}#detail-grid>div:last-child{position:static!important;}}</style>

@endsection

@push('scripts')
<script>
// GALLERY
function switchImg(url,thumb){
  var img=document.getElementById('main-img');
  img.style.opacity='0';
  setTimeout(function(){img.src=url;img.style.opacity='1';},200);
  document.querySelectorAll('.gallery-thumb').forEach(function(t){t.classList.remove('active');});
  thumb.classList.add('active');
}

// STICKY CTA
(function(){
  var bar=document.getElementById('sticky-cta');
  if(!bar)return;
  window.addEventListener('scroll',function(){
    bar.style.display=window.scrollY>400?'block':'none';
  });
})();
</script>
@endpush
