@extends('layouts.app')

@section('seo_title', 'Video Review Unit — Kerinci Motor')
@section('seo_description', 'Tonton video review lengkap unit mobil bekas di Kerinci Motor. Cek eksterior, interior, mesin, dan test drive — jujur tanpa filter.')
@section('seo_keywords', 'video review mobil bekas, review unit kerinci motor, video mobil bekas bekasi, shorts mobil bekas')

@section('content')
<section style="background: #0A0A0A; min-height: 100vh; padding: 120px 0 80px;">
  <div style="max-width: 1200px; margin: 0 auto; padding: 0 24px;">

    {{-- Page Header --}}
    <div style="text-align: center; margin-bottom: 48px;">
      <span style="display:inline-block;font-size:12px;font-weight:700;letter-spacing:0.15em;text-transform:uppercase;color:#CC0000;margin-bottom:12px;">VIDEO REVIEW</span>
      <h1 style="font-size:clamp(28px,5vw,44px);font-weight:800;color:#FAFAFA;line-height:1.15;margin-bottom:16px;">
        Lihat Kondisi Unit<br>Sebelum ke Showroom
      </h1>
      <p style="color:#9E9E9E;font-size:15px;max-width:520px;margin:0 auto 20px;line-height:1.6;">
        Video jujur tanpa filter — cek eksterior, interior, mesin, dan test drive langsung.
      </p>
      <div style="width:40px;height:3px;background:#CC0000;margin:0 auto;border-radius:2px;"></div>
    </div>

    {{-- Featured Video --}}
    @if($featuredVideo)
    <div style="margin-bottom:48px;background:#141414;border-radius:20px;overflow:hidden;border:1px solid rgba(255,255,255,0.08);">
      <div style="display:grid;grid-template-columns:1fr 1fr;gap:0;">
        <div style="position:relative;aspect-ratio:9/16;background:#000;">
          <iframe
            src="{{ $featuredVideo->embed_url }}"
            style="position:absolute;inset:0;width:100%;height:100%;border:none;"
            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
            allowfullscreen
            loading="lazy"
            title="{{ $featuredVideo->title }}">
          </iframe>
        </div>
        <div style="padding:32px;display:flex;flex-direction:column;justify-content:center;">
          <span style="display:inline-block;font-size:11px;font-weight:700;letter-spacing:0.12em;text-transform:uppercase;color:#CC0000;margin-bottom:12px;">FEATURED</span>
          <h2 style="font-size:clamp(18px,2.5vw,28px);font-weight:800;color:#FAFAFA;line-height:1.3;margin-bottom:12px;">{{ $featuredVideo->title }}</h2>
          @if($featuredVideo->description)
          <p style="color:#9E9E9E;font-size:14px;line-height:1.7;margin-bottom:20px;">{{ $featuredVideo->description }}</p>
          @endif
          @if($featuredVideo->price_label)
          <div style="font-size:22px;font-weight:800;color:#FAFAFA;margin-bottom:20px;">Rp {{ $featuredVideo->price_label }}jt</div>
          @endif
          <a href="https://wa.me/{{ $globalSettings['wa_number']->value ?? '6287776700009' }}?text={{ urlencode('Halo, saya tertarik dengan unit di video: ' . $featuredVideo->title) }}"
             target="_blank" rel="noopener"
             style="display:inline-flex;align-items:center;gap:8px;padding:12px 24px;background:#CC0000;color:white;font-size:14px;font-weight:600;border-radius:10px;text-decoration:none;width:fit-content;">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347z"/><path d="M12 0C5.373 0 0 5.373 0 12c0 2.625.846 5.059 2.284 7.034L.789 23.492a.5.5 0 00.611.611l4.458-1.495A11.96 11.96 0 0012 24c6.627 0 12-5.373 12-12S18.627 0 12 0zm0 22c-2.387 0-4.594-.822-6.34-2.2l-.442-.37-3.218 1.078 1.078-3.218-.37-.442A9.96 9.96 0 012 12C2 6.477 6.477 2 12 2s10 4.477 10 10-4.477 10-10 10z"/></svg>
            Tanya Unit via WA
          </a>
        </div>
      </div>
    </div>
    @endif

    {{-- Video Grid --}}
    @if($videos->count())
    <div class="video-page-grid" style="display:grid;grid-template-columns:repeat(3,1fr);gap:24px;margin-bottom:48px;">
      @foreach($videos as $video)
      <div style="background:#141414;border-radius:16px;overflow:hidden;border:1px solid rgba(255,255,255,0.06);transition:transform 0.2s,box-shadow 0.2s;"
           onmouseover="this.style.transform='translateY(-4px)';this.style.boxShadow='0 12px 32px rgba(204,0,0,0.15)'"
           onmouseout="this.style.transform='translateY(0)';this.style.boxShadow='none'">
        <div style="position:relative;width:100%;aspect-ratio:9/16;background:#000;">
          <iframe
            src="{{ $video->embed_url }}"
            style="position:absolute;inset:0;width:100%;height:100%;border:none;"
            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
            allowfullscreen
            loading="lazy"
            title="{{ $video->title }}">
          </iframe>
        </div>
        <div style="padding:14px 16px;">
          <h3 style="font-size:14px;font-weight:600;color:#FAFAFA;margin-bottom:4px;line-height:1.3;">{{ $video->title }}</h3>
          @if($video->price_label)
          <span style="font-size:13px;font-weight:700;color:#CC0000;">Rp {{ $video->price_label }}jt</span>
          @else
          <span style="font-size:12px;color:#9E9E9E;">Kerinci Motor</span>
          @endif
        </div>
      </div>
      @endforeach

      {{-- Placeholder if less than 3 videos --}}
      @for($i = $videos->count(); $i < 3 && $videos->count() < 3; $i++)
      <div style="background:#141414;border-radius:16px;overflow:hidden;border:1px solid rgba(255,255,255,0.06);">
        <div style="position:relative;width:100%;aspect-ratio:9/16;background:#0A0A0A;display:flex;align-items:center;justify-content:center;">
          <div style="text-align:center;">
            <div style="width:56px;height:56px;background:rgba(204,0,0,0.15);border-radius:50%;display:flex;align-items:center;justify-content:center;margin:0 auto 12px;">
              <div style="width:0;height:0;border-top:10px solid transparent;border-bottom:10px solid transparent;border-left:16px solid #CC0000;margin-left:3px;"></div>
            </div>
            <p style="color:#5A5A5A;font-size:12px;">Segera Hadir</p>
          </div>
        </div>
        <div style="padding:14px 16px;">
          <h3 style="font-size:14px;font-weight:600;color:#5A5A5A;margin-bottom:4px;line-height:1.3;">Video Berikutnya</h3>
          <span style="font-size:12px;color:#3A3A3A;">Segera hadir · Kerinci Motor</span>
        </div>
      </div>
      @endfor
    </div>
    @endif

    {{-- Hardcoded fallback if no videos in DB --}}
    @if($videos->isEmpty())
    <div class="video-page-grid" style="display:grid;grid-template-columns:repeat(3,1fr);gap:24px;margin-bottom:48px;">
      @foreach([['-A3QvyQ9sP8', 'Review Unit — Kerinci Motor'], ['s9KAaHeKOu8', 'Review Unit — Kerinci Motor']] as [$id, $title])
      <div style="background:#141414;border-radius:16px;overflow:hidden;border:1px solid rgba(255,255,255,0.06);transition:transform 0.2s,box-shadow 0.2s;"
           onmouseover="this.style.transform='translateY(-4px)';this.style.boxShadow='0 12px 32px rgba(204,0,0,0.15)'"
           onmouseout="this.style.transform='translateY(0)';this.style.boxShadow='none'">
        <div style="position:relative;width:100%;aspect-ratio:9/16;background:#000;">
          <iframe src="https://www.youtube.com/embed/{{ $id }}"
            style="position:absolute;inset:0;width:100%;height:100%;border:none;"
            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
            allowfullscreen loading="lazy" title="{{ $title }}"></iframe>
        </div>
        <div style="padding:14px 16px;">
          <h3 style="font-size:14px;font-weight:600;color:#FAFAFA;margin-bottom:4px;line-height:1.3;">{{ $title }}</h3>
          <span style="font-size:12px;color:#9E9E9E;">Kerinci Motor</span>
        </div>
      </div>
      @endforeach
      <div style="background:#141414;border-radius:16px;overflow:hidden;border:1px solid rgba(255,255,255,0.06);">
        <div style="position:relative;width:100%;aspect-ratio:9/16;background:#0A0A0A;display:flex;align-items:center;justify-content:center;">
          <div style="text-align:center;">
            <div style="width:56px;height:56px;background:rgba(204,0,0,0.15);border-radius:50%;display:flex;align-items:center;justify-content:center;margin:0 auto 12px;">
              <div style="width:0;height:0;border-top:10px solid transparent;border-bottom:10px solid transparent;border-left:16px solid #CC0000;margin-left:3px;"></div>
            </div>
            <p style="color:#5A5A5A;font-size:12px;">Segera Hadir</p>
          </div>
        </div>
        <div style="padding:14px 16px;">
          <h3 style="font-size:14px;font-weight:600;color:#5A5A5A;line-height:1.3;">Video Berikutnya</h3>
          <span style="font-size:12px;color:#3A3A3A;">Segera hadir · Kerinci Motor</span>
        </div>
      </div>
    </div>
    @endif

    {{-- CTA --}}
    <div style="text-align:center;">
      <a href="https://www.youtube.com/@kerincimotor" target="_blank" rel="noopener"
         style="display:inline-flex;align-items:center;gap:8px;padding:14px 28px;border:1px solid rgba(255,255,255,0.15);color:#FAFAFA;font-size:14px;font-weight:600;border-radius:10px;text-decoration:none;transition:border-color 0.2s;"
         onmouseover="this.style.borderColor='#CC0000'" onmouseout="this.style.borderColor='rgba(255,255,255,0.15)'">
        <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor"><path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/></svg>
        Subscribe YouTube Kerinci Motor →
      </a>
    </div>

  </div>
</section>

<style>
@media (max-width: 768px) {
  .video-page-grid { grid-template-columns: 1fr !important; gap: 16px !important; max-width: 360px; margin-left: auto; margin-right: auto; }
}
@media (min-width: 769px) and (max-width: 1024px) {
  .video-page-grid { grid-template-columns: repeat(2, 1fr) !important; }
}
</style>
@endsection
