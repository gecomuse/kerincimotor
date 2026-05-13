@extends('frontend.layouts.app')
@section('title','Tips & Trick Beli Mobil Bekas — Kerinci Motor')
@section('description','Tips dan panduan beli mobil bekas dari praktisi Kerinci Motor. Cara cek kondisi mesin, bodi, dokumen, dan negosiasi harga terbaik.')

@section('content')

{{-- HERO --}}
<section style="padding-top:72px;background:linear-gradient(160deg,#fff 60%,#fff8f8);position:relative;overflow:hidden;" class="noise">
  <div class="orb" style="width:500px;height:500px;background:rgba(204,0,0,0.07);top:-100px;right:-100px;animation:orbFloat 14s ease-in-out infinite;"></div>
  <div style="max-width:1280px;margin:0 auto;padding:56px 24px 48px;position:relative;z-index:10;">
    <div class="reveal" style="margin-bottom:12px;"><div class="section-tag">Tips & Panduan</div></div>
    <h1 class="reveal" style="font-size:clamp(2rem,5vw,4.5rem);font-weight:900;letter-spacing:-2px;font-family:'Raleway',sans-serif;margin-bottom:14px;line-height:1.05;">Tips & Trick<br><span class="tgrad">Beli Mobil Bekas</span></h1>
    <p class="reveal" style="color:var(--g500);font-size:1rem;font-weight:500;max-width:540px;line-height:1.7;">Panduan lengkap dari praktisi — agar Anda tidak salah pilih.</p>
  </div>
</section>

<section style="padding:56px 0 80px;background:#fff;">
  <div style="max-width:1280px;margin:0 auto;padding:0 24px;">
    <div style="display:grid;grid-template-columns:1fr 360px;gap:40px;align-items:start;" id="tips-layout">

      {{-- MAIN CONTENT --}}
      <div>

        {{-- FEATURED POST --}}
        @if(isset($featuredPost) && $featuredPost)
        <a href="{{ route('artikel.show', $featuredPost->slug) }}" style="text-decoration:none;display:block;background:#fff;border-radius:28px;overflow:hidden;box-shadow:0 8px 40px rgba(0,0,0,0.1);margin-bottom:36px;transition:all .4s cubic-bezier(0.34,1.56,0.64,1);border:1px solid var(--g100);" class="reveal" onmouseover="this.style.transform='translateY(-8px)';this.style.boxShadow='0 32px 80px rgba(0,0,0,0.14)'" onmouseout="this.style.transform='';this.style.boxShadow='0 8px 40px rgba(0,0,0,0.1)'">
          @php
            $fImg = $featuredPost->getFirstMediaUrl('cover') ?: ($featuredPost->thumbnail_url ?? null);
          @endphp
          @if($fImg)
          <img src="{{ $fImg }}" style="width:100%;height:300px;object-fit:cover;display:block;" alt="{{ $featuredPost->title }}" loading="eager">
          @else
          <div style="width:100%;height:280px;background:linear-gradient(135deg,var(--g100),var(--g200));display:flex;align-items:center;justify-content:center;font-size:4rem;">📰</div>
          @endif
          <div style="padding:32px;">
            <div style="display:flex;align-items:center;gap:12px;margin-bottom:14px;flex-wrap:wrap;">
              <span style="background:var(--red);color:#fff;font-size:.72rem;font-weight:800;padding:5px 14px;border-radius:100px;font-family:'Raleway',sans-serif;text-transform:uppercase;letter-spacing:.5px;">⭐ Artikel Utama</span>
              @if($featuredPost->category)
              <span style="color:var(--g400);font-size:.8rem;font-weight:600;">{{ $featuredPost->category }}</span>
              @endif
            </div>
            <h2 style="font-weight:900;font-size:1.5rem;font-family:'Raleway',sans-serif;color:var(--black);margin-bottom:10px;line-height:1.3;">{{ $featuredPost->title }}</h2>
            <p style="color:var(--g500);font-size:.9rem;line-height:1.7;margin-bottom:14px;font-weight:500;">{{ Str::limit($featuredPost->excerpt,200) }}</p>
            <div style="color:var(--g400);font-size:.78rem;font-weight:600;">{{ $featuredPost->published_at?->locale('id')->isoFormat('D MMM YYYY') }} · {{ $featuredPost->read_time ?? 5 }} mnt baca</div>
          </div>
        </a>
        @endif

        {{-- POSTS GRID --}}
        <div style="display:grid;grid-template-columns:1fr 1fr;gap:20px;" id="posts-grid">
          @forelse($posts ?? [] as $post)
          @php $pImg = $post->getFirstMediaUrl('cover') ?: $post->thumbnail_url; @endphp
          <a href="{{ route('artikel.show', $post->slug) }}" style="text-decoration:none;display:block;background:#fff;border-radius:20px;overflow:hidden;box-shadow:0 4px 20px rgba(0,0,0,0.07);border:1px solid var(--g100);transition:all .4s cubic-bezier(0.34,1.56,0.64,1);" class="reveal" onmouseover="this.style.transform='translateY(-6px)';this.style.boxShadow='0 20px 50px rgba(0,0,0,0.12)'" onmouseout="this.style.transform='';this.style.boxShadow='0 4px 20px rgba(0,0,0,0.07)'">
            @if($pImg)
            <img src="{{ $pImg }}" style="width:100%;height:160px;object-fit:cover;display:block;" alt="{{ $post->title }}" loading="lazy">
            @else
            <div style="width:100%;height:160px;background:var(--g100);display:flex;align-items:center;justify-content:center;font-size:2.5rem;">📰</div>
            @endif
            <div style="padding:18px;">
              @if($post->category)
              <span style="display:inline-block;background:rgba(204,0,0,0.07);color:var(--red);font-size:.68rem;font-weight:800;padding:3px 11px;border-radius:100px;margin-bottom:8px;text-transform:uppercase;letter-spacing:.5px;">{{ $post->category }}</span>
              @endif
              <h3 style="font-weight:800;font-size:.95rem;font-family:'Raleway',sans-serif;color:var(--black);margin-bottom:8px;line-height:1.4;overflow:hidden;display:-webkit-box;-webkit-line-clamp:2;-webkit-box-orient:vertical;">{{ $post->title }}</h3>
              <p style="color:var(--g400);font-size:.8rem;line-height:1.6;margin-bottom:10px;overflow:hidden;display:-webkit-box;-webkit-line-clamp:2;-webkit-box-orient:vertical;">{{ Str::limit($post->excerpt,100) }}</p>
              <div style="color:var(--g400);font-size:.72rem;font-weight:600;">{{ $post->published_at?->locale('id')->isoFormat('D MMM YYYY') }} · {{ $post->read_time ?? 5 }} mnt</div>
            </div>
          </a>
          @empty
          <div style="grid-column:1/-1;text-align:center;padding:60px 24px;">
            <div style="font-size:3.5rem;margin-bottom:12px;">📝</div>
            <p style="color:var(--g400);font-weight:600;">Belum ada artikel tersedia.</p>
          </div>
          @endforelse
        </div>
        <style>@media(max-width:640px){#posts-grid{grid-template-columns:1fr!important;}}</style>

        {{-- PAGINATION --}}
        @isset($posts)
        @if(method_exists($posts,'hasPages') && $posts->hasPages())
        <div style="margin-top:32px;display:flex;justify-content:center;">
          {{ $posts->withQueryString()->links() }}
        </div>
        @endif
        @endisset
      </div>

      {{-- SIDEBAR --}}
      <div style="display:flex;flex-direction:column;gap:20px;position:sticky;top:92px;" id="tips-sidebar">

        {{-- HOT STOCK --}}
        @if(isset($hotStock) && $hotStock->count())
        <div style="background:#fff;border:1px solid var(--g100);border-radius:20px;padding:22px;box-shadow:0 4px 20px rgba(0,0,0,0.06);" class="reveal">
          <h3 style="font-weight:900;font-size:1rem;font-family:'Raleway',sans-serif;margin-bottom:18px;display:flex;align-items:center;gap:8px;">🔥 Hot Stock Sekarang</h3>
          <div style="display:flex;flex-direction:column;gap:14px;">
            @foreach($hotStock as $hcar)
            @php $hImg = $hcar->thumbnail ?: 'https://images.unsplash.com/photo-1503376780353-7e6692767b70?q=80&w=400'; @endphp
            <a href="{{ route('car.detail', $hcar->slug) }}" style="display:flex;gap:12px;text-decoration:none;align-items:center;padding:8px;border-radius:14px;transition:.3s;" onmouseover="this.style.background='var(--g50)'" onmouseout="this.style.background=''">
              <div style="width:72px;height:56px;border-radius:10px;overflow:hidden;flex-shrink:0;background:var(--g100);">
                <img src="{{ $hImg }}" style="width:100%;height:100%;object-fit:cover;display:block;" alt="{{ $hcar->make_model }}" loading="lazy">
              </div>
              <div style="flex:1;min-width:0;">
                <div style="font-weight:800;font-size:.82rem;font-family:'Raleway',sans-serif;color:var(--black);overflow:hidden;display:-webkit-box;-webkit-line-clamp:2;-webkit-box-orient:vertical;line-height:1.3;margin-bottom:3px;">{{ $hcar->make_model }}</div>
                <div style="color:var(--g400);font-size:.7rem;font-weight:600;">{{ $hcar->year }} · {{ $hcar->formatted_mileage }}</div>
                <div style="font-weight:900;font-size:.875rem;color:var(--red);font-family:'Raleway',sans-serif;margin-top:2px;">{{ $hcar->formatted_price }}</div>
              </div>
            </a>
            @endforeach
          </div>
          <a href="{{ route('inventory.index') }}" class="btn-outline" style="width:100%;margin-top:16px;padding:11px;border-radius:100px;font-size:.8rem;text-decoration:none;justify-content:center;display:flex;"><span>Lihat Semua Unit →</span></a>
        </div>
        @else
        <div class="reveal" style="background:#fff;border:1px solid var(--g100);border-radius:20px;padding:22px;text-align:center;box-shadow:0 4px 20px rgba(0,0,0,0.06);">
          <div style="font-size:2.5rem;margin-bottom:10px;">🚗</div>
          <h3 style="font-weight:900;font-family:'Raleway',sans-serif;margin-bottom:6px;">Cari Mobil Bekas?</h3>
          <p style="color:var(--g400);font-size:.85rem;margin-bottom:16px;line-height:1.6;font-weight:500;">Lihat inventaris lengkap kami.</p>
          <a href="{{ route('inventory.index') }}" class="btn-red" style="width:100%;padding:11px;border-radius:100px;font-size:.85rem;text-decoration:none;justify-content:center;display:flex;">Lihat Inventaris</a>
        </div>
        @endif

        {{-- SELL CTA --}}
        <div class="reveal" style="background:var(--black);border-radius:20px;padding:22px;text-align:center;position:relative;overflow:hidden;" class="noise">
          <div class="orb" style="width:150px;height:150px;background:rgba(204,0,0,0.2);top:-30px;right:-30px;animation:orbFloat2 8s ease-in-out infinite;"></div>
          <div style="position:relative;z-index:2;">
            <div style="font-size:2rem;margin-bottom:10px;">💰</div>
            <h3 style="font-weight:900;color:#fff;font-family:'Raleway',sans-serif;margin-bottom:6px;">Jual Mobil Anda</h3>
            <p style="color:rgba(255,255,255,.45);font-size:.82rem;margin-bottom:16px;line-height:1.6;font-weight:500;">Proses cepat, harga terbaik, pembayaran langsung.</p>
            <a href="{{ route('sell.index') }}" class="btn-red" style="width:100%;padding:11px;border-radius:100px;font-size:.85rem;text-decoration:none;justify-content:center;display:flex;">Jual Sekarang →</a>
          </div>
        </div>

        {{-- WA CTA --}}
        <div class="reveal" style="background:#fff;border:1px solid var(--g100);border-radius:20px;padding:22px;text-align:center;box-shadow:0 4px 20px rgba(0,0,0,0.06);">
          <h3 style="font-weight:900;font-family:'Raleway',sans-serif;margin-bottom:6px;font-size:.95rem;">Ada Pertanyaan?</h3>
          <p style="color:var(--g400);font-size:.82rem;margin-bottom:14px;font-weight:500;">Tim kami siap membantu Anda.</p>
          <a href="{{ route('whatsapp') }}" target="_blank" rel="noopener" style="width:100%;padding:11px;border-radius:100px;font-size:.85rem;text-decoration:none;justify-content:center;display:flex;align-items:center;gap:8px;background:#25D366;color:#fff;font-weight:800;font-family:'Raleway',sans-serif;transition:.3s;" onmouseover="this.style.transform='translateY(-2px)';this.style.boxShadow='0 8px 24px rgba(37,211,102,0.4)'" onmouseout="this.style.transform='';this.style.boxShadow=''">💬 Chat via WhatsApp</a>
        </div>
      </div>

    </div>
  </div>
  <style>@media(max-width:1024px){#tips-layout{grid-template-columns:1fr!important;}#tips-sidebar{position:static!important;}}</style>
</section>

@endsection
