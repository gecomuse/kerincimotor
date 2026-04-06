@extends('layouts.app')

@section('seo_title', 'Video Review Unit — Kerinci Motor')
@section('seo_description', 'Tonton video review lengkap unit mobil bekas di Kerinci Motor. Cek eksterior, interior, mesin, dan test drive — jujur tanpa filter.')
@section('seo_keywords', 'video review mobil bekas, review unit kerinci motor, video mobil bekas bekasi, shorts mobil bekas')

@section('content')
<section style="background: #0A0A0A; min-height: 100vh; padding: 120px 0 80px;">
  <div style="max-width: 1200px; margin: 0 auto; padding: 0 24px;">

    {{-- Page Header --}}
    <div style="text-align: center; margin-bottom: 48px;">
      <span style="
        display: inline-block;
        font-size: 12px;
        font-weight: 700;
        letter-spacing: 0.15em;
        text-transform: uppercase;
        color: #CC0000;
        margin-bottom: 12px;
      ">VIDEO REVIEW</span>
      <h1 style="
        font-size: clamp(28px, 5vw, 44px);
        font-weight: 800;
        color: #FAFAFA;
        line-height: 1.15;
        margin-bottom: 16px;
      ">Lihat Kondisi Unit<br>Sebelum ke Showroom</h1>
      <p style="color: #9E9E9E; font-size: 15px; max-width: 520px; margin: 0 auto 20px; line-height: 1.6;">
        Video jujur tanpa filter — cek eksterior, interior, mesin, dan test drive langsung.
      </p>
      <div style="width: 40px; height: 3px; background: #CC0000; margin: 0 auto; border-radius: 2px;"></div>
    </div>

    {{-- Video Grid --}}
    <div class="video-page-grid" style="
      display: grid;
      grid-template-columns: repeat(3, 1fr);
      gap: 24px;
      margin-bottom: 48px;
    ">

      {{-- Video 1 --}}
      <div style="
        background: #141414;
        border-radius: 16px;
        overflow: hidden;
        border: 1px solid rgba(255,255,255,0.06);
        transition: transform 0.2s, box-shadow 0.2s;
      " onmouseover="this.style.transform='translateY(-4px)';this.style.boxShadow='0 12px 32px rgba(204,0,0,0.15)'"
         onmouseout="this.style.transform='translateY(0)';this.style.boxShadow='none'">
        <div style="position: relative; width: 100%; aspect-ratio: 9/16; background: #000;">
          <iframe
            src="https://www.youtube.com/embed/-A3QvyQ9sP8"
            style="position: absolute; inset: 0; width: 100%; height: 100%; border: none;"
            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
            allowfullscreen
            loading="lazy"
            title="Review Unit — Kerinci Motor">
          </iframe>
        </div>
        <div style="padding: 14px 16px;">
          <h3 style="font-size: 14px; font-weight: 600; color: #FAFAFA; margin-bottom: 4px; line-height: 1.3;">Review Unit — Kerinci Motor</h3>
          <span style="font-size: 12px; color: #9E9E9E;">Kerinci Motor</span>
        </div>
      </div>

      {{-- Video 2 --}}
      <div style="
        background: #141414;
        border-radius: 16px;
        overflow: hidden;
        border: 1px solid rgba(255,255,255,0.06);
        transition: transform 0.2s, box-shadow 0.2s;
      " onmouseover="this.style.transform='translateY(-4px)';this.style.boxShadow='0 12px 32px rgba(204,0,0,0.15)'"
         onmouseout="this.style.transform='translateY(0)';this.style.boxShadow='none'">
        <div style="position: relative; width: 100%; aspect-ratio: 9/16; background: #000;">
          <iframe
            src="https://www.youtube.com/embed/s9KAaHeKOu8"
            style="position: absolute; inset: 0; width: 100%; height: 100%; border: none;"
            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
            allowfullscreen
            loading="lazy"
            title="Review Unit — Kerinci Motor">
          </iframe>
        </div>
        <div style="padding: 14px 16px;">
          <h3 style="font-size: 14px; font-weight: 600; color: #FAFAFA; margin-bottom: 4px; line-height: 1.3;">Review Unit — Kerinci Motor</h3>
          <span style="font-size: 12px; color: #9E9E9E;">Kerinci Motor</span>
        </div>
      </div>

      {{-- Video 3 — Placeholder --}}
      <div style="
        background: #141414;
        border-radius: 16px;
        overflow: hidden;
        border: 1px solid rgba(255,255,255,0.06);
      ">
        <div style="
          position: relative;
          width: 100%;
          aspect-ratio: 9/16;
          background: #0A0A0A;
          display: flex;
          align-items: center;
          justify-content: center;
        ">
          <div style="text-align: center;">
            <div style="
              width: 56px; height: 56px;
              background: rgba(204,0,0,0.15);
              border-radius: 50%;
              display: flex;
              align-items: center;
              justify-content: center;
              margin: 0 auto 12px;
            ">
              <div style="
                width: 0; height: 0;
                border-top: 10px solid transparent;
                border-bottom: 10px solid transparent;
                border-left: 16px solid #CC0000;
                margin-left: 3px;
              "></div>
            </div>
            <p style="color: #5A5A5A; font-size: 12px;">Segera Hadir</p>
          </div>
        </div>
        <div style="padding: 14px 16px;">
          <h3 style="font-size: 14px; font-weight: 600; color: #5A5A5A; margin-bottom: 4px; line-height: 1.3;">Video Berikutnya</h3>
          <span style="font-size: 12px; color: #3A3A3A;">Segera hadir · Kerinci Motor</span>
        </div>
      </div>

    </div>{{-- /video-page-grid --}}

    {{-- CTA --}}
    <div style="text-align: center;">
      <a href="https://www.youtube.com/@kerincimotor"
         target="_blank" rel="noopener"
         style="
           display: inline-flex; align-items: center; gap: 8px;
           padding: 14px 28px;
           border: 1px solid rgba(255,255,255,0.15);
           color: #FAFAFA;
           font-size: 14px;
           font-weight: 600;
           border-radius: 10px;
           text-decoration: none;
           transition: border-color 0.2s;
         "
         onmouseover="this.style.borderColor='#CC0000'"
         onmouseout="this.style.borderColor='rgba(255,255,255,0.15)'">
        <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor"><path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/></svg>
        Subscribe YouTube Kerinci Motor →
      </a>
    </div>

  </div>
</section>

{{-- Responsive CSS --}}
<style>
@media (max-width: 768px) {
  .video-page-grid {
    grid-template-columns: 1fr !important;
    gap: 16px !important;
    max-width: 360px;
    margin-left: auto;
    margin-right: auto;
  }
}
@media (min-width: 769px) and (max-width: 1024px) {
  .video-page-grid {
    grid-template-columns: repeat(2, 1fr) !important;
  }
}
</style>
@endsection
