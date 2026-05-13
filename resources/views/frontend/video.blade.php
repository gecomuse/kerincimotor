@extends('frontend.layouts.app')
@section('title','Video Review Mobil Bekas — Kerinci Motor')
@section('description','Tonton video review lengkap unit mobil bekas di Kerinci Motor. Cek eksterior, interior, mesin, dan test drive — jujur tanpa filter.')

@section('content')

@php
  $videoList = isset($videos) ? $videos : collect([]);
@endphp

{{-- HERO --}}
<section style="padding-top:72px;background:linear-gradient(160deg,#fff 60%,#fff8f8);position:relative;overflow:hidden;" class="noise">
  <div class="orb" style="width:500px;height:500px;background:rgba(204,0,0,0.07);top:-100px;right:-100px;animation:orbFloat 14s ease-in-out infinite;"></div>
  <div style="max-width:1280px;margin:0 auto;padding:56px 24px 48px;text-align:center;position:relative;z-index:10;">
    <div class="badge-red reveal" style="margin-bottom:20px;justify-content:center;">📹 Video Review</div>
    <h1 class="reveal" style="font-size:clamp(2rem,5vw,4.5rem);font-weight:900;letter-spacing:-2px;font-family:'Raleway',sans-serif;margin-bottom:16px;line-height:1.05;">
      Lihat Kondisi Unit<br><span class="tgrad">Sebelum ke Showroom</span>
    </h1>
    <p class="reveal" style="color:var(--g500);font-size:1.05rem;font-weight:500;max-width:560px;margin:0 auto 32px;line-height:1.7;">Video jujur tanpa filter — cek eksterior, interior, mesin, dan test drive langsung.</p>
    <a href="https://www.youtube.com/@kerincimotorofficial" target="_blank" rel="noopener" class="btn-outline reveal" style="padding:13px 28px;border-radius:100px;font-size:.9rem;text-decoration:none;"><span>▶ Subscribe YouTube KerinciMotor</span></a>
  </div>
</section>

{{-- FEATURED VIDEO --}}
@if(isset($featuredVideo) && $featuredVideo)
<section style="padding:56px 0;background:var(--black);position:relative;overflow:hidden;" class="noise">
  <div class="orb" style="width:600px;height:600px;background:rgba(204,0,0,0.1);top:50%;left:-200px;transform:translateY(-50%);animation:orbFloat 16s ease-in-out infinite;"></div>
  <div style="max-width:1280px;margin:0 auto;padding:0 24px;position:relative;z-index:10;">
    <div style="display:grid;grid-template-columns:1fr 1fr;gap:48px;align-items:center;" id="feat-vid-grid">
      <div class="reveal-left">
        <div style="border-radius:24px;overflow:hidden;position:relative;" style="aspect-ratio:9/16;max-height:560px;">
          <div style="aspect-ratio:9/16;max-height:560px;position:relative;">
            <iframe src="{{ $featuredVideo->embed_url }}" class="absolute inset-0" style="width:100%;height:100%;border:none;border-radius:24px;display:block;min-height:420px;" allow="accelerometer;autoplay;clipboard-write;encrypted-media;gyroscope;picture-in-picture" allowfullscreen loading="lazy" title="{{ $featuredVideo->title }}"></iframe>
          </div>
        </div>
      </div>
      <div class="reveal-right">
        <div class="section-tag" style="color:var(--red);">⭐ Featured Video</div>
        <h2 style="font-size:clamp(1.4rem,3vw,2.4rem);font-weight:900;color:#fff;font-family:'Raleway',sans-serif;margin-bottom:16px;line-height:1.2;">{{ $featuredVideo->title }}</h2>
        @if($featuredVideo->description)
        <p style="color:rgba(255,255,255,.5);font-size:.95rem;line-height:1.7;margin-bottom:20px;font-weight:500;">{{ $featuredVideo->description }}</p>
        @endif
        @if($featuredVideo->price_label)
        <div style="margin-bottom:24px;">
          <div style="color:rgba(255,255,255,.4);font-size:.72rem;font-weight:700;text-transform:uppercase;letter-spacing:.5px;margin-bottom:4px;">Harga</div>
          <div style="font-size:2rem;font-weight:900;color:#fff;font-family:'Raleway',sans-serif;">Rp {{ $featuredVideo->price_label }}jt</div>
        </div>
        @endif
        <div style="display:flex;flex-direction:column;gap:12px;">
          <a href="https://wa.me/6287776700009?text={{ urlencode('Halo Kerinci Motor, saya tertarik dengan unit di video: '.$featuredVideo->title) }}" target="_blank" rel="noopener" class="btn-red" style="padding:14px 28px;border-radius:100px;font-size:.95rem;text-decoration:none;justify-content:center;">💬 Tanya Unit ini via WA</a>
          <a href="{{ route('inventory.index') }}" class="btn-outline" style="padding:13px 28px;border-radius:100px;font-size:.875rem;text-decoration:none;justify-content:center;border-color:rgba(255,255,255,.2);color:#fff;" onmouseover="this.style.background='rgba(255,255,255,.1)'" onmouseout="this.style.background='transparent'"><span>Lihat Inventaris Lengkap</span></a>
        </div>
      </div>
    </div>
  </div>
  <style>@media(max-width:900px){#feat-vid-grid{grid-template-columns:1fr!important;}}</style>
</section>
@endif

{{-- VIDEO GRID --}}
<section style="padding:80px 0;background:var(--g50);">
  <div style="max-width:1280px;margin:0 auto;padding:0 24px;">
    <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:40px;flex-wrap:wrap;gap:16px;">
      <div class="reveal">
        <div class="section-tag">Semua Video</div>
        <h2 style="font-size:clamp(1.6rem,3.5vw,2.8rem);font-weight:900;font-family:'Raleway',sans-serif;letter-spacing:-1px;">Review Unit Kami</h2>
      </div>
      <a href="https://www.youtube.com/@kerincimotorofficial" target="_blank" rel="noopener" class="btn-outline reveal" style="padding:11px 24px;border-radius:100px;font-size:.875rem;text-decoration:none;"><span>▶ Semua di YouTube →</span></a>
    </div>

    <div style="display:grid;grid-template-columns:repeat(3,1fr);gap:24px;" id="vid-grid">
      @forelse($videoList as $video)
      <div class="vcard reveal" style="background:#fff;border-radius:20px;overflow:hidden;box-shadow:0 4px 20px rgba(0,0,0,0.07);border:1px solid var(--g100);">
        <div style="position:relative;">
          @php
            $embedUrl = $video->embed_url;
            $thumbUrl = "https://img.youtube.com/vi/{$video->youtube_id}/hqdefault.jpg";
          @endphp
          <div style="aspect-ratio:9/16;position:relative;overflow:hidden;cursor:pointer;" onclick="openVid('{{ $embedUrl }}')">
            <img src="{{ $thumbUrl }}" style="width:100%;height:100%;object-fit:cover;display:block;transition:transform .5s;" alt="{{ $video->title }}" loading="lazy" onmouseover="this.style.transform='scale(1.06)'" onmouseout="this.style.transform=''">
            <div style="position:absolute;inset:0;background:rgba(0,0,0,0.3);display:flex;align-items:center;justify-content:center;transition:.3s;" onmouseover="this.style.background='rgba(0,0,0,0.45)'" onmouseout="this.style.background='rgba(0,0,0,0.3)'">
              <div style="width:56px;height:56px;background:rgba(255,255,255,0.95);border-radius:50%;display:flex;align-items:center;justify-content:center;box-shadow:0 4px 20px rgba(0,0,0,0.3);transition:transform .3s;" onmouseover="this.style.transform='scale(1.15)'" onmouseout="this.style.transform=''">
                <div style="width:0;height:0;border-style:solid;border-width:9px 0 9px 18px;border-color:transparent transparent transparent var(--red);margin-left:4px;"></div>
              </div>
            </div>
          </div>
        </div>
        <div style="padding:16px;">
          <h3 style="font-weight:800;font-size:.95rem;font-family:'Raleway',sans-serif;margin-bottom:6px;line-height:1.35;overflow:hidden;display:-webkit-box;-webkit-line-clamp:2;-webkit-box-orient:vertical;">{{ $video->title }}</h3>
          @if($video->price_label)
          <div style="font-weight:900;color:var(--red);font-family:'Raleway',sans-serif;">Rp {{ $video->price_label }}jt</div>
          @else
          <div style="color:var(--g400);font-size:.8rem;font-weight:600;">Kerinci Motor</div>
          @endif
        </div>
      </div>
      @empty
      {{-- FALLBACK --}}
      @foreach([['-A3QvyQ9sP8','Review Honda Brio — Kerinci Motor'],['s9KAaHeKOu8','Review Toyota Avanza — Kerinci Motor']] as [$vid,$title])
      <div class="vcard reveal" style="background:#fff;border-radius:20px;overflow:hidden;box-shadow:0 4px 20px rgba(0,0,0,0.07);border:1px solid var(--g100);">
        <div style="aspect-ratio:9/16;position:relative;overflow:hidden;cursor:pointer;" onclick="openVid('https://www.youtube.com/embed/{{ $vid }}')">
          <img src="https://img.youtube.com/vi/{{ $vid }}/hqdefault.jpg" style="width:100%;height:100%;object-fit:cover;display:block;" alt="{{ $title }}" loading="lazy">
          <div style="position:absolute;inset:0;background:rgba(0,0,0,0.3);display:flex;align-items:center;justify-content:center;">
            <div style="width:56px;height:56px;background:rgba(255,255,255,0.95);border-radius:50%;display:flex;align-items:center;justify-content:center;">
              <div style="width:0;height:0;border-style:solid;border-width:9px 0 9px 18px;border-color:transparent transparent transparent var(--red);margin-left:4px;"></div>
            </div>
          </div>
        </div>
        <div style="padding:16px;">
          <h3 style="font-weight:800;font-size:.95rem;font-family:'Raleway',sans-serif;margin-bottom:6px;">{{ $title }}</h3>
          <div style="color:var(--g400);font-size:.8rem;font-weight:600;">Kerinci Motor</div>
        </div>
      </div>
      @endforeach
      <div class="reveal" style="background:var(--g50);border:2px dashed var(--g200);border-radius:20px;overflow:hidden;display:flex;flex-direction:column;align-items:center;justify-content:center;min-height:280px;gap:12px;text-align:center;padding:24px;">
        <div style="width:56px;height:56px;background:rgba(204,0,0,0.07);border-radius:50%;display:flex;align-items:center;justify-content:center;font-size:1.5rem;">▶</div>
        <div style="font-weight:800;font-family:'Raleway',sans-serif;color:var(--g400);">Segera Hadir</div>
        <div style="font-size:.8rem;color:var(--g400);font-weight:500;">Video berikutnya sedang disiapkan</div>
      </div>
      @endforelse
    </div>
    <style>@media(max-width:900px){#vid-grid{grid-template-columns:1fr 1fr!important;}}@media(max-width:600px){#vid-grid{grid-template-columns:1fr!important;}}</style>
  </div>
</section>

{{-- SUBSCRIBE CTA --}}
<section style="padding:72px 24px;background:var(--black);text-align:center;position:relative;overflow:hidden;" class="noise">
  <div class="orb" style="width:400px;height:400px;background:rgba(204,0,0,0.1);top:50%;left:50%;transform:translate(-50%,-50%);animation:orbFloat 12s ease-in-out infinite;"></div>
  <div style="position:relative;z-index:10;max-width:560px;margin:0 auto;">
    <div style="font-size:3rem;margin-bottom:16px;">📺</div>
    <h2 class="reveal" style="font-size:clamp(1.6rem,4vw,2.8rem);font-weight:900;color:#fff;font-family:'Raleway',sans-serif;margin-bottom:14px;letter-spacing:-1px;">Jangan Lewatkan<br>Video Terbaru</h2>
    <p class="reveal" style="color:rgba(255,255,255,.45);font-weight:500;margin-bottom:28px;line-height:1.7;">Subscribe channel YouTube kami untuk video review unit terbaru setiap minggu.</p>
    <div class="reveal" style="display:flex;gap:12px;justify-content:center;flex-wrap:wrap;">
      <a href="https://www.youtube.com/@kerincimotorofficial" target="_blank" rel="noopener" class="btn-red" style="padding:14px 32px;border-radius:100px;font-size:.95rem;text-decoration:none;">▶ Subscribe Sekarang</a>
      <a href="{{ route('whatsapp') }}" target="_blank" rel="noopener" class="btn-outline" style="padding:14px 28px;border-radius:100px;font-size:.875rem;text-decoration:none;border-color:rgba(255,255,255,.25);color:#fff;" onmouseover="this.style.background='rgba(255,255,255,.08)'" onmouseout="this.style.background='transparent'"><span>💬 Tanya Unit</span></a>
    </div>
  </div>
</section>

@endsection
