@extends('frontend.layouts.app')
@section('title','Tips & Trick Mobil Bekas | Kerinci Motor')
@section('description','Panduan lengkap beli, jual, kredit, dan perawatan mobil bekas dari tim Kerinci Motor.')

@section('content')

{{-- HERO --}}
<section style="padding:140px 0 80px;background:#fff;position:relative;overflow:hidden;" class="noise">
  <div class="orb" style="width:700px;height:700px;background:rgba(204,0,0,0.06);top:-300px;right:-200px;animation:orbFloat 16s ease-in-out infinite;pointer-events:none;"></div>
  <div class="orb" style="width:400px;height:400px;background:rgba(192,192,192,0.08);bottom:-100px;left:-100px;animation:orbFloat2 12s ease-in-out infinite 3s;pointer-events:none;"></div>
  <div style="max-width:1280px;margin:0 auto;padding:0 24px;position:relative;z-index:10;">
    <div style="max-width:780px;">
      <div class="badge-red reveal" style="margin-bottom:20px;">📚 Knowledge Hub · Automotive</div>
      <h1 class="reveal" style="font-size:clamp(3rem,7vw,6rem);font-weight:900;line-height:1.0;letter-spacing:-3px;margin-bottom:20px;font-family:'Raleway',sans-serif;">
        Tips &<br>
        <span class="tgrad-anim">Trick</span><br>
        Mobil Bekas.
      </h1>
      <p class="reveal" style="font-size:1.1rem;color:var(--g500);line-height:1.75;max-width:540px;margin-bottom:36px;font-weight:500;">
        Panduan lengkap dari tim Kerinci Motor — beli pintar, jual cepat, kredit aman.
      </p>

      {{-- SEARCH BAR --}}
      <form method="GET" action="{{ route('tips.index') }}" class="reveal" style="position:relative;max-width:520px;">
        @if(request('category'))<input type="hidden" name="category" value="{{ request('category') }}">@endif
        <input type="text" name="search" value="{{ request('search') }}"
          placeholder="Cari artikel tips..."
          style="width:100%;border:2.5px solid var(--g200);border-radius:100px;padding:18px 60px 18px 28px;font-family:'Raleway',sans-serif;font-size:1rem;outline:none;font-weight:600;transition:.3s;background:#fff;box-shadow:0 8px 32px rgba(0,0,0,0.08);"
          onfocus="this.style.borderColor='var(--red)';this.style.boxShadow='0 8px 32px rgba(204,0,0,0.15)'"
          onblur="this.style.borderColor='var(--g200)';this.style.boxShadow='0 8px 32px rgba(0,0,0,0.08)'">
        <button type="submit" style="position:absolute;right:8px;top:50%;transform:translateY(-50%);background:var(--red);border:none;width:44px;height:44px;border-radius:50%;cursor:pointer;display:flex;align-items:center;justify-content:center;font-size:1rem;transition:.3s;" onmouseover="this.style.background='#aa0000'" onmouseout="this.style.background='var(--red)'">🔍</button>
      </form>
    </div>

    {{-- STATS --}}
    <div class="reveal" style="display:flex;flex-wrap:wrap;gap:32px;margin-top:48px;padding-top:40px;border-top:1px solid var(--g100);">
      <div style="display:flex;align-items:center;gap:10px;"><div style="width:42px;height:42px;background:rgba(204,0,0,0.08);border-radius:12px;display:flex;align-items:center;justify-content:center;font-size:1.2rem;">📝</div><div><div style="font-weight:900;font-size:1.4rem;font-family:'Raleway',sans-serif;">{{ ($posts->total() + ($featuredPost ? 1 : 0)) }}+</div><div style="color:var(--g400);font-size:.78rem;font-weight:600;">Artikel</div></div></div>
      <div style="display:flex;align-items:center;gap:10px;"><div style="width:42px;height:42px;background:rgba(204,0,0,0.08);border-radius:12px;display:flex;align-items:center;justify-content:center;font-size:1.2rem;">🎯</div><div><div style="font-weight:900;font-size:1.4rem;font-family:'Raleway',sans-serif;">5</div><div style="color:var(--g400);font-size:.78rem;font-weight:600;">Kategori</div></div></div>
      <div style="display:flex;align-items:center;gap:10px;"><div style="width:42px;height:42px;background:rgba(204,0,0,0.08);border-radius:12px;display:flex;align-items:center;justify-content:center;font-size:1.2rem;">✅</div><div><div style="font-weight:900;font-size:1.4rem;font-family:'Raleway',sans-serif;">100%</div><div style="color:var(--g400);font-size:.78rem;font-weight:600;">Gratis</div></div></div>
    </div>
  </div>
</section>

{{-- CATEGORY PILLS --}}
<section style="background:#fff;position:sticky;top:72px;z-index:50;border-bottom:1px solid var(--g100);box-shadow:0 4px 20px rgba(0,0,0,0.04);">
  <div style="max-width:1280px;margin:0 auto;padding:0 24px;">
    <div style="display:flex;gap:8px;overflow-x:auto;padding:14px 0;scrollbar-width:none;">
      @php
        $cats = ['' => 'Semua', 'mobil-bekas' => '🚗 Mobil Bekas', 'kredit' => '💳 Tips Kredit', 'perawatan' => '🔧 Perawatan', 'perbandingan' => '⚖️ Perbandingan', 'trade-in' => '🔄 Trade-In'];
        $currentCat = request('category', '');
        $currentSearch = request('search', '');
      @endphp
      @foreach($cats as $val => $label)
      @php
        $href = route('tips.index') . ($val ? '?category=' . $val : '') . ($currentSearch ? (($val ? '&' : '?') . 'search=' . urlencode($currentSearch)) : '');
        $isActive = $currentCat === $val;
      @endphp
      <a href="{{ $href }}"
         style="display:inline-flex;align-items:center;padding:9px 20px;border-radius:100px;font-weight:700;font-size:.82rem;cursor:pointer;transition:all .25s;white-space:nowrap;text-decoration:none;flex-shrink:0;{{ $isActive ? 'background:var(--black);color:#fff;box-shadow:0 4px 16px rgba(0,0,0,0.15);' : 'background:var(--g50);color:var(--black);border:1.5px solid var(--g200);' }}">
        {{ $label }}
      </a>
      @endforeach
    </div>
  </div>
</section>

{{-- MAIN CONTENT --}}
<section style="padding:64px 0 96px;background:var(--g50);">
  <div style="max-width:1280px;margin:0 auto;padding:0 24px;">
    <div style="display:grid;grid-template-columns:1fr 340px;gap:40px;align-items:start;" id="tips-main-grid">

      {{-- LEFT: ARTICLES --}}
      <div>
        {{-- FEATURED POST --}}
        @if(isset($featuredPost) && $featuredPost)
        <div class="reveal" onclick="window.location='{{ route('artikel.show', $featuredPost->slug) }}'"
          style="border-radius:28px;overflow:hidden;background:#fff;box-shadow:0 8px 40px rgba(0,0,0,0.08);margin-bottom:32px;cursor:pointer;transition:all .4s;"
          onmouseover="this.style.transform='translateY(-6px)';this.style.boxShadow='0 24px 60px rgba(0,0,0,0.12)'"
          onmouseout="this.style.transform='';this.style.boxShadow='0 8px 40px rgba(0,0,0,0.08)'">
          <div style="position:relative;overflow:hidden;aspect-ratio:21/9;">
            <img src="{{ str_replace('/storage/', '/storage_assets/', $featuredPost->thumbnail_url) }}"
              style="width:100%;height:100%;object-fit:cover;display:block;transition:transform .6s;"
              onmouseover="this.style.transform='scale(1.04)'" onmouseout="this.style.transform=''"
              alt="{{ $featuredPost->title }}" loading="eager">
            <div style="position:absolute;inset:0;background:linear-gradient(to top,rgba(0,0,0,0.65),transparent 50%);"></div>
            <div style="position:absolute;top:18px;left:18px;background:var(--red);color:#fff;padding:6px 16px;border-radius:100px;font-weight:800;font-size:.72rem;font-family:'Raleway',sans-serif;letter-spacing:.5px;">📌 ARTIKEL UTAMA</div>
            <div style="position:absolute;bottom:0;left:0;right:0;padding:28px;">
              <div style="display:flex;gap:10px;align-items:center;margin-bottom:10px;flex-wrap:wrap;">
                @if($featuredPost->category)
                <span style="background:rgba(255,255,255,.15);backdrop-filter:blur(10px);color:#fff;padding:4px 12px;border-radius:100px;font-size:.72rem;font-weight:700;">{{ $featuredPost->category }}</span>
                @endif
                @if($featuredPost->read_time)
                <span style="color:rgba(255,255,255,.65);font-size:.78rem;font-weight:600;">⏱ {{ $featuredPost->read_time }} mnt</span>
                @endif
                @if($featuredPost->published_at)
                <span style="color:rgba(255,255,255,.5);font-size:.75rem;font-weight:600;">{{ $featuredPost->published_at->format('d M Y') }}</span>
                @endif
              </div>
              <h2 style="font-weight:900;font-size:clamp(1.2rem,2.5vw,1.8rem);color:#fff;line-height:1.2;letter-spacing:-0.5px;font-family:'Raleway',sans-serif;">{{ $featuredPost->title }}</h2>
            </div>
          </div>
          <div style="padding:24px 28px;">
            <p style="color:var(--g600);line-height:1.75;margin-bottom:18px;font-weight:500;font-size:.95rem;">{{ Str::limit($featuredPost->excerpt ?? '', 200) }}</p>
            <div style="display:flex;align-items:center;justify-content:space-between;">
              <span style="color:var(--red);font-weight:800;font-size:.9rem;font-family:'Raleway',sans-serif;">Baca Selengkapnya →</span>
              @if($featuredPost->category)
              <span style="background:var(--g100);padding:4px 12px;border-radius:100px;font-size:.72rem;font-weight:700;color:var(--g600);">{{ $featuredPost->category }}</span>
              @endif
            </div>
          </div>
        </div>
        @endif

        {{-- FILTER RESULT LABEL --}}
        @if(request('search') || request('category'))
        <div class="reveal" style="margin-bottom:20px;display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:10px;">
          <div style="font-weight:700;color:var(--g500);font-size:.9rem;">
            @if(request('search'))Hasil: "<strong>{{ request('search') }}</strong>"@endif
            @if(request('category')) · Kategori: <strong>{{ request('category') }}</strong>@endif
            · {{ $posts->total() }} artikel
          </div>
          <a href="{{ route('tips.index') }}" style="color:var(--red);font-weight:700;font-size:.82rem;text-decoration:none;">✕ Reset</a>
        </div>
        @endif

        {{-- ARTICLE GRID --}}
        @if($posts->count() > 0)
        <div style="display:grid;grid-template-columns:1fr 1fr;gap:22px;" id="art-grid">
          @foreach($posts as $post)
          <div class="reveal" onclick="window.location='{{ route('artikel.show', $post->slug) }}'"
            style="border-radius:22px;overflow:hidden;background:#fff;box-shadow:0 4px 20px rgba(0,0,0,0.06);cursor:pointer;transition:all .4s;"
            onmouseover="this.style.transform='translateY(-8px)';this.style.boxShadow='0 24px 48px rgba(0,0,0,0.1)'"
            onmouseout="this.style.transform='';this.style.boxShadow='0 4px 20px rgba(0,0,0,0.06)'">
            <div style="overflow:hidden;aspect-ratio:16/9;">
              <img src="{{ str_replace('/storage/', '/storage_assets/', $post->thumbnail_url) }}"
                style="width:100%;height:100%;object-fit:cover;display:block;transition:transform .6s;"
                onmouseover="this.style.transform='scale(1.08)'" onmouseout="this.style.transform=''"
                alt="{{ $post->title }}" loading="lazy">
            </div>
            <div style="padding:20px;">
              <div style="display:flex;gap:6px;margin-bottom:10px;flex-wrap:wrap;align-items:center;">
                @if($post->category)
                <span style="background:rgba(204,0,0,0.08);color:var(--red);padding:3px 11px;border-radius:100px;font-size:.7rem;font-weight:800;">{{ $post->category }}</span>
                @endif
                @if($post->read_time)
                <span style="color:var(--g400);font-size:.7rem;font-weight:600;">⏱ {{ $post->read_time }} mnt</span>
                @endif
              </div>
              <h3 style="font-weight:900;font-size:1.05rem;margin-bottom:8px;line-height:1.3;font-family:'Raleway',sans-serif;overflow:hidden;display:-webkit-box;-webkit-line-clamp:2;-webkit-box-orient:vertical;">{{ $post->title }}</h3>
              <p style="color:var(--g400);font-size:.83rem;line-height:1.6;font-weight:500;margin-bottom:14px;overflow:hidden;display:-webkit-box;-webkit-line-clamp:2;-webkit-box-orient:vertical;">{{ Str::limit($post->excerpt ?? '', 100) }}</p>
              <div style="display:flex;justify-content:space-between;align-items:center;">
                <span style="color:var(--g400);font-size:.75rem;font-weight:600;">{{ $post->published_at?->format('d M Y') }}</span>
                <span style="color:var(--red);font-weight:800;font-size:.8rem;">Baca →</span>
              </div>
            </div>
          </div>
          @endforeach
        </div>

        @if($posts->hasPages())
        <div style="margin-top:40px;display:flex;justify-content:center;">
          {{ $posts->links() }}
        </div>
        @endif

        @else
        <div class="reveal" style="text-align:center;padding:72px 24px;background:#fff;border-radius:24px;">
          <div style="font-size:4rem;margin-bottom:18px;">🔍</div>
          <h3 style="font-weight:900;font-size:1.4rem;margin-bottom:10px;font-family:'Raleway',sans-serif;">Artikel tidak ditemukan</h3>
          <p style="color:var(--g400);margin-bottom:24px;font-weight:500;">Coba kata kunci lain atau lihat semua artikel.</p>
          <a href="{{ route('tips.index') }}" class="btn-red" style="padding:13px 28px;border-radius:100px;font-size:.9rem;text-decoration:none;">Lihat Semua Artikel</a>
        </div>
        @endif
      </div>

      {{-- RIGHT: SIDEBAR --}}
      <div style="position:sticky;top:140px;display:flex;flex-direction:column;gap:20px;" id="tips-sidebar">

        {{-- WA CTA --}}
        <div class="reveal" style="background:var(--black);border-radius:22px;padding:24px;position:relative;overflow:hidden;">
          <div class="orb" style="width:200px;height:200px;background:rgba(204,0,0,0.2);top:-50px;right:-50px;animation:orbFloat2 8s ease-in-out infinite;"></div>
          <div style="position:relative;z-index:2;">
            <div style="font-size:2rem;margin-bottom:12px;">🤝</div>
            <div style="font-weight:900;font-size:1.1rem;color:#fff;margin-bottom:7px;font-family:'Raleway',sans-serif;">Tanya Langsung!</div>
            <p style="color:rgba(255,255,255,.45);font-size:.83rem;line-height:1.6;margin-bottom:18px;font-weight:500;">Konsultasi gratis seputar mobil bekas bersama tim kami.</p>
            <a href="{{ route('whatsapp') }}" target="_blank" class="btn-red" style="width:100%;padding:13px;border-radius:100px;font-size:.875rem;justify-content:center;text-decoration:none;display:flex;">💬 WhatsApp Sekarang</a>
          </div>
        </div>

        {{-- HOT STOCK --}}
        @if(isset($hotStock) && $hotStock->count() > 0)
        <div class="reveal" style="background:#fff;border:2px solid var(--g100);border-radius:22px;padding:22px;">
          <div style="font-weight:900;margin-bottom:16px;font-size:.95rem;font-family:'Raleway',sans-serif;">🔥 Hot Stock</div>
          <div style="display:flex;flex-direction:column;gap:14px;">
            @foreach($hotStock as $unit)
            @php
            $unitImg = $unit->thumbnail ?: 'https://images.unsplash.com/photo-1503376780353-7e6692767b70?q=80&w=200';
            $unitImg = str_replace('/storage/', '/storage_assets/', $unitImg);
            @endphp
            <div onclick="window.location='{{ route('car.detail', $unit->slug) }}'"
              style="display:flex;gap:12px;align-items:center;cursor:pointer;padding:10px;border-radius:14px;transition:all .25s;border:1px solid transparent;"
              onmouseover="this.style.background='var(--g50)';this.style.borderColor='var(--g200)';this.style.transform='translateX(4px)'"
              onmouseout="this.style.background='';this.style.borderColor='transparent';this.style.transform=''">
              <img src="{{ $unitImg }}"
                style="width:64px;height:50px;border-radius:11px;object-fit:cover;flex-shrink:0;" alt="{{ $unit->make_model }}" loading="lazy">
              <div>
                <div style="font-weight:800;font-size:.85rem;font-family:'Raleway',sans-serif;line-height:1.2;overflow:hidden;display:-webkit-box;-webkit-line-clamp:2;-webkit-box-orient:vertical;">{{ $unit->make_model }}</div>
                <div style="color:var(--g400);font-size:.74rem;font-weight:600;margin-top:2px;">{{ $unit->year }} · {{ $unit->formatted_mileage }}</div>
                <div style="color:var(--red);font-weight:900;font-size:.85rem;margin-top:3px;font-family:'Raleway',sans-serif;">{{ $unit->formatted_price }}</div>
              </div>
            </div>
            @endforeach
          </div>
          <a href="{{ route('inventory.index') }}" style="display:block;text-align:center;margin-top:16px;color:var(--red);font-weight:800;font-size:.82rem;text-decoration:none;padding:10px;border-radius:12px;border:1.5px solid rgba(204,0,0,0.2);transition:.2s;" onmouseover="this.style.background='rgba(204,0,0,0.05)'" onmouseout="this.style.background=''">Lihat Semua Unit →</a>
        </div>
        @endif

        {{-- CATEGORIES --}}
        <div class="reveal" style="background:#fff;border:2px solid var(--g100);border-radius:22px;padding:22px;">
          <div style="font-weight:900;margin-bottom:16px;font-size:.95rem;font-family:'Raleway',sans-serif;">📂 Kategori</div>
          <div style="display:flex;flex-direction:column;gap:2px;">
            @foreach(['mobil-bekas' => ['🚗','Mobil Bekas'], 'kredit' => ['💳','Tips Kredit'], 'perawatan' => ['🔧','Perawatan'], 'perbandingan' => ['⚖️','Perbandingan'], 'trade-in' => ['🔄','Trade-In']] as $val => $data)
            <a href="{{ route('tips.index') }}?category={{ $val }}{{ request('search') ? '&search='.urlencode(request('search')) : '' }}"
              style="display:flex;align-items:center;gap:10px;padding:11px 14px;border-radius:12px;cursor:pointer;font-size:.875rem;font-weight:700;text-decoration:none;transition:all .2s;{{ request('category')==$val ? 'background:rgba(204,0,0,0.06);color:var(--red);' : 'color:var(--black);' }}"
              onmouseover="if('{{ request('category') }}'!='{{ $val }}')this.style.background='var(--g50)'"
              onmouseout="if('{{ request('category') }}'!='{{ $val }}')this.style.background=''">
              <span style="font-size:1rem;">{{ $data[0] }}</span>
              <span>{{ $data[1] }}</span>
              @if(request('category')==$val)<span style="margin-left:auto;color:var(--red);">✓</span>@endif
            </a>
            @endforeach
          </div>
        </div>

        {{-- SELL CTA --}}
        <div class="reveal" style="background:linear-gradient(135deg,var(--red),#ff4444);border-radius:22px;padding:24px;text-align:center;">
          <div style="font-size:2rem;margin-bottom:10px;">💰</div>
          <div style="font-weight:900;color:#fff;font-size:1.05rem;margin-bottom:8px;font-family:'Raleway',sans-serif;">Jual Mobil Anda</div>
          <p style="color:rgba(255,255,255,.75);font-size:.82rem;margin-bottom:18px;line-height:1.6;font-weight:500;">Harga terbaik, bayar hari yang sama.</p>
          <a href="{{ route('sell.index') }}" style="display:block;background:#fff;color:var(--red);font-weight:900;padding:12px;border-radius:100px;font-size:.875rem;text-decoration:none;font-family:'Raleway',sans-serif;transition:.2s;" onmouseover="this.style.transform='scale(1.02)'" onmouseout="this.style.transform=''">Jual Sekarang →</a>
        </div>

      </div>
    </div>
  </div>
  <style>
  @media(max-width:1024px){
    #tips-main-grid{grid-template-columns:1fr!important;}
    #tips-sidebar{position:static!important;display:grid;grid-template-columns:1fr 1fr!important;}
  }
  @media(max-width:640px){
    #tips-sidebar{grid-template-columns:1fr!important;}
    #art-grid{grid-template-columns:1fr!important;}
  }
  </style>
</section>

@endsection
