@extends('frontend.layouts.app')
@section('title','Kerinci Motor | Dealer Mobil Bekas Terpercaya Sejabodetabek')
@section('description','Dealer mobil bekas terpercaya Sejabodetabek. Stok lengkap, harga transparan. Bebas banjir, laka, dan terbakar.')

@section('content')

{{-- HERO --}}
@php
$heroImg   = ($hero && $hero->image_url) ? str_replace('/storage/', '/storage_assets/', $hero->image_url) : 'https://images.unsplash.com/photo-1503376780353-7e6692767b70?q=80&w=1400&auto=format&fit=crop';
$heroName  = $hero?->card_name  ?: 'Unit Featured';
$heroSub   = $hero?->card_sub   ?: 'Automatic · Bebas Laka';
$heroPrice = $hero?->card_price ?: 'Hubungi Kami';
$heroLink  = ($hero && $hero->car_id && $hero->car) ? route('car.detail', $hero->car->slug) : route('inventory.index');
@endphp
<section id="hero-section" style="min-height:100vh;padding-top:72px;background:linear-gradient(160deg,#fff 55%,#fff8f8 100%);position:relative;overflow:hidden;display:flex;align-items:center;" class="noise">
  <div class="orb" style="width:600px;height:600px;background:rgba(204,0,0,0.08);top:-150px;left:-200px;animation:orbFloat 12s ease-in-out infinite;"></div>
  <div class="orb" style="width:400px;height:400px;background:rgba(192,192,192,0.1);bottom:-80px;right:-100px;animation:orbFloat2 10s ease-in-out infinite 2s;"></div>
  <div style="max-width:1280px;margin:0 auto;padding:72px 24px;width:100%;position:relative;z-index:10;">
    <div style="display:grid;grid-template-columns:1fr 1fr;gap:64px;align-items:center;" id="hero-grid">
      <div>
        <div class="badge-red reveal" style="margin-bottom:28px;">✦ Dealer Terpercaya Sejabodetabek</div>
        <h1 class="reveal" style="font-size:clamp(2.6rem,5.5vw,5rem);font-weight:900;line-height:1.02;letter-spacing:-3px;margin-bottom:20px;font-family:'Raleway',sans-serif;">
          Temukan<br>
          <span class="tgrad-anim">Mobil Impian</span><br>
          Anda.
        </h1>
        <p class="reveal" style="font-size:1.05rem;color:var(--g600);line-height:1.75;max-width:480px;margin-bottom:40px;font-weight:500;">
          Dealer Used Car terpercaya Sejabodetabek, bebas banjir, laka, dan terbakar. {{ $totalCars ?? 0 }}+ unit tersedia.
        </p>
        <div class="reveal" style="display:flex;flex-wrap:wrap;gap:14px;">
          <a href="{{ route('inventory.index') }}" class="btn-gradient-border" style="font-size:1rem;text-decoration:none;">🔥 Lihat Flash Sale</a>
          <a href="{{ route('sell.index') }}" class="btn-outline" style="padding:16px 36px;border-radius:100px;font-size:1rem;text-decoration:none;"><span>Jual Mobil Anda</span></a>
        </div>
        <div id="stats-section" class="reveal" style="display:flex;gap:36px;margin-top:40px;padding-top:36px;border-top:1px solid var(--g100);" data-stats-section>
          <div><div id="stat-units" data-counter="{{ $totalCars ?? 50 }}" data-suffix="+" style="font-size:1.8rem;font-weight:900;font-family:'Raleway',sans-serif;color:var(--black);">{{ $totalCars ?? '50' }}+</div><div style="color:var(--g500);font-size:.8rem;font-weight:600;margin-top:2px;">Unit Tersedia</div></div>
          <div><div data-counter="100" data-suffix="%" style="font-size:1.8rem;font-weight:900;font-family:'Raleway',sans-serif;color:var(--black);">100%</div><div style="color:var(--g500);font-size:.8rem;font-weight:600;margin-top:2px;">Jaminan KM Bebas Reset</div></div>
          <div><div id="stat-rating" data-counter="4.9" data-suffix="★" style="font-size:1.8rem;font-weight:900;font-family:'Raleway',sans-serif;color:var(--black);">4.9★</div><div style="color:var(--g500);font-size:.8rem;font-weight:600;margin-top:2px;">Rating Pelanggan</div></div>
        </div>
      </div>
      <div class="reveal-right tilt-card" style="position:relative;" id="hero-img-col">
        <div class="tilt-shine"></div>
        <div class="hero-float" style="border-radius:40px;overflow:hidden;position:relative;box-shadow:0 40px 100px rgba(0,0,0,0.14);">
          <img id="hero-main-img" src="{{ $heroImg }}" style="width:100%;height:520px;object-fit:cover;display:block;" alt="Kerinci Motor Featured Car" loading="eager">
          <div style="position:absolute;inset:0;background:linear-gradient(to top,rgba(0,0,0,0.28),transparent 55%);"></div>
        </div>
        <div id="hero-float-card" class="glass float-card" style="position:absolute;bottom:-20px;left:-20px;border-radius:24px;padding:20px 24px;min-width:220px;box-shadow:0 24px 48px rgba(0,0,0,0.12);">
          <div style="display:flex;justify-content:space-between;margin-bottom:6px;">
            <span style="font-size:.72rem;color:var(--g400);font-weight:600;">Featured Deal</span>
            <span style="color:var(--red);font-weight:900;font-size:.72rem;">🔥 HOT</span>
          </div>
          <div style="font-weight:900;font-size:1.05rem;margin-bottom:3px;font-family:'Raleway',sans-serif;">{{ $heroName }}</div>
          <div style="color:var(--g400);font-size:.78rem;margin-bottom:12px;font-weight:600;">{{ $heroSub }}</div>
          <div style="display:flex;justify-content:space-between;align-items:center;">
            <div style="font-weight:900;font-size:1.3rem;font-family:'Raleway',sans-serif;color:var(--red);">{{ $heroPrice }}</div>
            <a href="{{ $heroLink }}" class="btn-red" style="padding:8px 16px;border-radius:100px;font-size:.78rem;text-decoration:none;">Detail</a>
          </div>
        </div>
        <div class="glass float-card-alt" style="position:absolute;top:20px;right:20px;border-radius:14px;padding:11px 16px;box-shadow:0 8px 24px rgba(0,0,0,0.1);">
          <div style="font-weight:900;font-size:.8rem;color:var(--red);font-family:'Raleway',sans-serif;">✓ Bebas Banjir & Laka</div>
        </div>
      </div>
    </div>
  </div>
  <div style="position:absolute;bottom:32px;left:50%;transform:translateX(-50%);display:flex;flex-direction:column;align-items:center;gap:8px;animation:orbFloat2 2s ease-in-out infinite;">
    <span style="font-size:.72rem;font-weight:700;color:var(--g400);letter-spacing:2px;text-transform:uppercase;">Scroll</span>
    <div style="width:1px;height:32px;background:linear-gradient(to bottom,var(--g400),transparent);"></div>
  </div>
  <style>@media(max-width:900px){#hero-grid{grid-template-columns:1fr!important;}#hero-img-col{display:none!important;}}</style>
</section>

{{-- MARQUEE --}}
<section style="padding:20px 0;background:#fff;border-top:1px solid var(--g100);border-bottom:1px solid var(--g100);overflow:hidden;">
  <div class="marquee" style="margin-bottom:10px;">
    <div class="mtrack" style="font-weight:900;font-size:1.6rem;color:var(--g200);font-family:'Raleway',sans-serif;">
      @foreach(['Toyota','Honda','BMW','Mercedes','Mitsubishi','Nissan','Hyundai','Kia','Mazda','Suzuki','Daihatsu','Toyota','Honda','BMW','Mercedes','Mitsubishi','Nissan','Hyundai','Kia','Mazda','Suzuki','Daihatsu'] as $b)
      <span>{{ $b }}</span>
      @endforeach
    </div>
  </div>
  <div class="marquee">
    <div class="mtrack2" style="font-weight:900;font-size:1rem;color:var(--g100);font-family:'Raleway',sans-serif;">
      @foreach(['Bebas Banjir','✦','Bebas Laka','✦','BPKB Asli','✦','History Record','✦','Terpercaya','✦','Sejabodetabek','✦','Bebas Banjir','✦','Bebas Laka','✦','BPKB Asli','✦','History Record','✦','Terpercaya','✦','Sejabodetabek','✦'] as $t)
      <span>{{ $t }}</span>
      @endforeach
    </div>
  </div>
</section>

{{-- FLASH SALE --}}
<section style="padding:96px 0;background:var(--g50);position:relative;overflow:hidden;">
  <div class="orb" style="width:400px;height:400px;background:rgba(204,0,0,0.05);top:-100px;right:-100px;animation:orbFloat 14s ease-in-out infinite;"></div>
  <div style="max-width:1280px;margin:0 auto;padding:0 24px;position:relative;z-index:10;">
    <div style="display:flex;justify-content:space-between;align-items:flex-end;margin-bottom:48px;flex-wrap:wrap;gap:20px;">
      <div class="reveal">
        <div class="section-tag">🔥 Penawaran Terbatas</div>
        <h2 class="word-reveal" style="font-size:clamp(1.8rem,4vw,3.2rem);font-weight:900;letter-spacing:-1px;font-family:'Raleway',sans-serif;margin-bottom:16px;">Flash Sale Used Car</h2>
        <div style="display:flex;align-items:center;gap:10px;flex-wrap:wrap;">
          <span style="font-weight:700;font-size:.85rem;color:var(--g500);">Berakhir dalam:</span>
          <div style="display:flex;align-items:center;gap:6px;">
            <div class="cd-box"><div class="cd-num" id="cdH">--</div><div class="cd-lbl">Jam</div></div>
            <div style="font-weight:900;font-size:1.5rem;color:var(--g400);">:</div>
            <div class="cd-box"><div class="cd-num" id="cdM">--</div><div class="cd-lbl">Menit</div></div>
            <div style="font-weight:900;font-size:1.5rem;color:var(--g400);">:</div>
            <div class="cd-box"><div class="cd-num" id="cdS">--</div><div class="cd-lbl">Detik</div></div>
          </div>
        </div>
      </div>
      <a href="{{ route('inventory.index') }}" class="btn-outline reveal" style="padding:13px 28px;border-radius:100px;font-size:.875rem;text-decoration:none;"><span>Lihat Semua Unit →</span></a>
    </div>

    <div style="display:grid;grid-template-columns:repeat(3,1fr);gap:28px;" id="home-cards" data-stagger>
      @forelse($featuredCars as $car)
      @php
      $carImg = $car->thumbnail ?: 'https://images.unsplash.com/photo-1503376780353-7e6692767b70?q=80&w=800';
      $carImg = str_replace('/storage/', '/storage_assets/', $carImg);
      @endphp
      <div class="car-card tilt-card reveal" onclick="window.location='{{ route('car.detail', $car->slug) }}'" style="background:#fff;border-radius:24px;overflow:hidden;box-shadow:0 4px 24px rgba(0,0,0,0.07);">
        <div class="card-glow"></div>
        <div class="tilt-shine"></div>
        <div class="thumb" style="overflow:hidden;position:relative;">
          <img src="{{ $carImg }}" style="width:100%;height:220px;object-fit:cover;display:block;" alt="{{ $car->make_model }}" loading="lazy">
          @if($car->is_featured)
          <div style="position:absolute;top:12px;left:12px;background:var(--red);color:#fff;padding:5px 13px;border-radius:100px;font-weight:800;font-size:.72rem;font-family:'Raleway',sans-serif;">🔥 HOT</div>
          @endif
          <div style="position:absolute;top:12px;right:12px;background:rgba(0,0,0,.7);color:#fff;padding:5px 12px;border-radius:100px;font-size:.68rem;font-weight:700;backdrop-filter:blur(8px);">✓ Bebas Laka</div>
        </div>
        <div style="padding:22px;">
          <div style="color:var(--g400);font-size:.76rem;font-weight:600;margin-bottom:6px;">{{ $car->year }} · {{ strtoupper($car->transmission) }} · {{ $car->formatted_mileage }}</div>
          <h3 style="font-weight:900;font-size:1.1rem;margin-bottom:14px;font-family:'Raleway',sans-serif;line-clamp:2;overflow:hidden;">{{ $car->make_model }}</h3>
          <div style="display:flex;justify-content:space-between;align-items:center;">
            <div>
              <div style="font-size:.68rem;color:var(--g400);font-weight:600;">Harga</div>
              <div style="font-weight:900;font-size:1.4rem;font-family:'Raleway',sans-serif;color:var(--red);">{{ $car->formatted_price }}</div>
            </div>
            <a href="{{ route('car.detail', $car->slug) }}" class="btn-red" style="padding:9px 18px;border-radius:100px;font-size:.8rem;text-decoration:none;" onclick="event.stopPropagation()">Detail</a>
          </div>
        </div>
      </div>
      @empty
      <div style="grid-column:1/-1;text-align:center;padding:48px;color:var(--g400);font-family:'Raleway',sans-serif;font-weight:600;">
        Belum ada unit. <a href="{{ route('inventory.index') }}" style="color:var(--red);">Lihat semua →</a>
      </div>
      @endforelse

      <div class="reveal" style="background:var(--black);border-radius:24px;overflow:hidden;position:relative;" class="noise">
        <div class="orb" style="width:200px;height:200px;background:rgba(204,0,0,0.2);top:-50px;right:-50px;animation:orbFloat2 8s ease-in-out infinite;"></div>
        <div style="padding:32px;display:flex;flex-direction:column;justify-content:center;align-items:center;text-align:center;min-height:340px;gap:16px;position:relative;z-index:2;">
          <div style="font-size:2.5rem;">🚗</div>
          <h3 style="font-size:1.1rem;font-weight:900;color:#fff;font-family:'Raleway',sans-serif;">Unit Lainnya?</h3>
          <p style="color:rgba(255,255,255,.45);font-size:.85rem;line-height:1.6;">Request unit spesifik yang Anda inginkan langsung ke tim kami.</p>
          <a href="{{ route('whatsapp') }}" target="_blank" rel="noopener" class="btn-red" style="padding:13px 26px;border-radius:100px;font-size:.85rem;text-decoration:none;">💬 Konsultasi Gratis</a>
        </div>
      </div>
    </div>
  </div>
  <style>@media(max-width:1024px){#home-cards{grid-template-columns:repeat(2,1fr)!important;}}@media(max-width:640px){#home-cards{grid-template-columns:1fr!important;}}</style>
</section>

{{-- VIDEO REVIEW PREVIEW --}}
<section style="padding:96px 0;background:var(--black);color:#fff;position:relative;overflow:hidden;" class="noise">
  <div class="orb" style="width:600px;height:600px;background:rgba(204,0,0,0.1);top:-200px;right:-200px;animation:orbFloat 14s ease-in-out infinite;"></div>
  <div style="max-width:1280px;margin:0 auto;padding:0 24px;position:relative;z-index:10;">
    <div style="display:flex;justify-content:space-between;align-items:flex-end;margin-bottom:48px;flex-wrap:wrap;gap:20px;">
      <div class="reveal">
        <div class="section-tag" style="color:var(--red);">🎬 Video Review</div>
        <h2 style="font-size:clamp(1.8rem,4vw,3.2rem);font-weight:900;letter-spacing:-1px;font-family:'Raleway',sans-serif;">Review Jujur,<br><span style="color:var(--red);">Tanpa Filter.</span></h2>
      </div>
      <a href="{{ route('video.index') }}" class="btn-red reveal" style="padding:13px 28px;border-radius:100px;font-size:.875rem;text-decoration:none;">Lihat Semua →</a>
    </div>
    <div style="display:grid;grid-template-columns:repeat(3,1fr);gap:22px;" id="home-vid-grid">
      @forelse($latestVideos ?? [] as $vid)
      @php $vidThumb = "https://img.youtube.com/vi/{$vid->youtube_id}/hqdefault.jpg"; @endphp
      <div class="vcard reveal" onclick="openVid('{{ $vid->embed_url }}')" style="border-radius:20px;overflow:hidden;background:rgba(255,255,255,0.05);border:1px solid rgba(255,255,255,0.08);cursor:pointer;">
        <div style="position:relative;aspect-ratio:16/9;overflow:hidden;">
          <img src="{{ $vidThumb }}" style="width:100%;height:100%;object-fit:cover;display:block;transition:transform .5s;" onmouseover="this.style.transform='scale(1.08)'" onmouseout="this.style.transform=''">
          <div style="position:absolute;inset:0;background:rgba(0,0,0,0.25);"></div>
          <div style="position:absolute;top:50%;left:50%;transform:translate(-50%,-50%);width:52px;height:52px;background:rgba(255,255,255,.95);border-radius:50%;display:flex;align-items:center;justify-content:center;transition:all .3s;" onmouseover="this.style.background='var(--red)'" onmouseout="this.style.background='rgba(255,255,255,.95)'">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="var(--red)"><polygon points="5,3 19,12 5,21"/></svg>
          </div>
        </div>
        <div style="padding:16px;">
          <div style="font-weight:900;font-size:.95rem;color:#fff;margin-bottom:5px;font-family:'Raleway',sans-serif;overflow:hidden;display:-webkit-box;-webkit-line-clamp:2;-webkit-box-orient:vertical;">{{ $vid->title }}</div>
          @if($vid->price_label)<div style="color:var(--red);font-size:.85rem;font-weight:800;">Rp {{ $vid->price_label }}jt</div>@endif
        </div>
      </div>
      @empty
      <div style="grid-column:1/-1;text-align:center;padding:48px;color:rgba(255,255,255,0.3);">
        <div style="font-size:3rem;margin-bottom:14px;">🎬</div>
        <div style="font-weight:700;">Belum ada video. <a href="/admin/videos" style="color:var(--red);">Tambahkan via Admin →</a></div>
      </div>
      @endforelse
    </div>
  </div>
  <style>@media(max-width:1024px){#home-vid-grid{grid-template-columns:1fr 1fr!important;}}@media(max-width:640px){#home-vid-grid{grid-template-columns:1fr!important;}}</style>
</section>

{{-- FINANCING --}}
@php $finCar = $hero?->financingCar; @endphp
<section id="financing" style="padding:96px 0;background:var(--g50);color:var(--black);position:relative;overflow:hidden;" class="noise">
  <div class="orb" style="width:700px;height:700px;background:rgba(204,0,0,0.06);top:-200px;left:-300px;animation:orbFloat 16s ease-in-out infinite;"></div>
  <div class="orb" style="width:400px;height:400px;background:rgba(204,0,0,0.04);bottom:-100px;right:-100px;animation:orbFloat2 12s ease-in-out infinite 3s;"></div>
  <div style="max-width:1280px;margin:0 auto;padding:0 24px;position:relative;z-index:10;">
    <div style="display:grid;grid-template-columns:1fr 1fr;gap:80px;align-items:center;" id="fin-grid">
      <div class="reveal-left">
        <div class="section-tag">Simulasi Cicilan</div>
        <h2 style="font-size:clamp(1.8rem,3.5vw,3.2rem);font-weight:900;line-height:1.1;margin-bottom:20px;letter-spacing:-1px;font-family:'Raleway',sans-serif;">Hitung Cicilan<br>Mobil Impian Anda<br><span style="color:var(--red);">Sekarang.</span></h2>
        <p style="color:var(--g500);font-size:1rem;line-height:1.7;margin-bottom:32px;font-weight:500;">DP rendah, cicilan ringan. Proses kredit cepat — ACC dalam hitungan jam!</p>

        @if($finCar)
        {{-- CMS-selected car card --}}
        <div onclick="window.location='{{ route('car.detail', $finCar->slug) }}'" style="background:#fff;border:1px solid var(--g100);border-radius:24px;overflow:hidden;box-shadow:0 8px 32px rgba(0,0,0,0.07);cursor:pointer;transition:all .3s;" onmouseover="this.style.transform='translateY(-4px)';this.style.boxShadow='0 16px 48px rgba(0,0,0,0.12)'" onmouseout="this.style.transform='';this.style.boxShadow='0 8px 32px rgba(0,0,0,0.07)'">
          @php
          $finImg = $finCar->thumbnail ?: 'https://images.unsplash.com/photo-1503376780353-7e6692767b70?q=80&w=800';
          $finImg = str_replace('/storage/', '/storage_assets/', $finImg);
          @endphp
          <div style="position:relative;overflow:hidden;">
            <img src="{{ $finImg }}" style="width:100%;height:200px;object-fit:cover;display:block;" alt="{{ $finCar->make_model }}" loading="lazy">
            <div style="position:absolute;top:12px;left:12px;background:var(--red);color:#fff;padding:5px 14px;border-radius:100px;font-weight:800;font-size:.72rem;">💳 Unit Cicilan</div>
            <div style="position:absolute;inset:0;background:linear-gradient(to top,rgba(0,0,0,0.18),transparent 60%);"></div>
          </div>
          <div style="padding:20px;">
            <div style="color:var(--g400);font-size:.76rem;font-weight:600;margin-bottom:4px;">{{ $finCar->year }} · {{ strtoupper($finCar->transmission) }} · {{ $finCar->formatted_mileage }}</div>
            <div style="font-weight:900;font-size:1.05rem;margin-bottom:12px;font-family:'Raleway',sans-serif;">{{ $finCar->make_model }}</div>
            <div style="display:flex;justify-content:space-between;align-items:center;">
              <div style="font-weight:900;font-size:1.3rem;color:var(--red);font-family:'Raleway',sans-serif;">{{ $finCar->formatted_price }}</div>
              <div style="font-size:.72rem;font-weight:700;color:var(--g400);">Harga sudah terisi otomatis →</div>
            </div>
          </div>
        </div>
        @else
        {{-- Fallback feature cards --}}
        <div style="display:grid;grid-template-columns:1fr 1fr;gap:14px;">
          <div style="border:1px solid var(--g200);border-radius:20px;padding:20px;background:#fff;transition:all .3s;" onmouseover="this.style.transform='translateY(-4px)';this.style.boxShadow='0 12px 32px rgba(0,0,0,0.08)'" onmouseout="this.style.transform='';this.style.boxShadow=''">
            <div style="font-size:1.75rem;font-weight:900;color:var(--red);">0%</div>
            <div style="color:var(--g400);font-size:.8rem;margin-top:4px;font-weight:600;">Biaya Admin Unit Tertentu</div>
          </div>
          <div style="border:1px solid var(--g200);border-radius:20px;padding:20px;background:#fff;transition:all .3s;" onmouseover="this.style.transform='translateY(-4px)';this.style.boxShadow='0 12px 32px rgba(0,0,0,0.08)'" onmouseout="this.style.transform='';this.style.boxShadow=''">
            <div style="font-size:1.1rem;font-weight:900;line-height:1.4;color:var(--black);font-family:'Raleway',sans-serif;">⚡ ACC Cepat<br><span style="font-size:.8rem;color:var(--g400);font-weight:700;">Dalam hitungan jam</span></div>
          </div>
        </div>
        @endif
      </div>
      <div class="reveal-right" style="background:#fff;border:1px solid var(--g100);border-radius:32px;padding:36px;box-shadow:0 32px 80px rgba(0,0,0,0.08);">
        <h3 style="font-size:1.4rem;font-weight:900;margin-bottom:{{ $finCar ? '16px' : '24px' }};color:var(--black);font-family:'Raleway',sans-serif;">Kalkulator Kredit</h3>
        @if($finCar)
        <div style="background:rgba(204,0,0,0.04);border:1px solid rgba(204,0,0,0.12);border-radius:14px;padding:12px 16px;margin-bottom:20px;display:flex;align-items:center;gap:10px;">
          <span style="font-size:1.2rem;">🚗</span>
          <div><div style="font-weight:800;font-size:.85rem;font-family:'Raleway',sans-serif;">{{ $finCar->make_model }}</div><div style="font-size:.75rem;color:var(--red);font-weight:700;">{{ $finCar->formatted_price }}</div></div>
        </div>
        @endif
        <div style="display:flex;flex-direction:column;gap:18px;">
          <div>
            <label style="display:block;color:var(--g500);font-size:.78rem;margin-bottom:8px;font-weight:700;letter-spacing:.5px;text-transform:uppercase;">Harga Cash (Rp)</label>
            <input type="number" id="calc-price" placeholder="Contoh: 300000000" oninput="calcKredit()" class="finput" value="{{ $finCar ? $finCar->price : '' }}">
          </div>
          <div>
            <label style="display:block;color:var(--g500);font-size:.78rem;margin-bottom:8px;font-weight:700;letter-spacing:.5px;text-transform:uppercase;">Uang Muka / DP (Rp)</label>
            <input type="number" id="calc-dp" placeholder="Contoh: 60000000" oninput="calcKredit()" class="finput">
          </div>
          <div>
            <label style="display:block;color:var(--g500);font-size:.78rem;margin-bottom:8px;font-weight:700;letter-spacing:.5px;text-transform:uppercase;">Tenor</label>
            <select id="calc-tenor" oninput="calcKredit()" class="finput">
              <option value="12">12 Bulan (1 Tahun)</option>
              <option value="24">24 Bulan (2 Tahun)</option>
              <option value="36">36 Bulan (3 Tahun)</option>
              <option value="48" selected>48 Bulan (4 Tahun)</option>
              <option value="60">60 Bulan (5 Tahun)</option>
            </select>
          </div>
          <div style="background:var(--g50);border-radius:20px;padding:24px;border:1px solid var(--g100);">
            <div style="color:var(--g400);font-size:.8rem;margin-bottom:6px;font-weight:600;">Estimasi Cicilan Per Bulan</div>
            <div id="calc-result" style="font-size:2.2rem;font-weight:900;color:var(--black);font-family:'Raleway',sans-serif;">Rp —</div>
            <div id="calc-breakdown" style="color:var(--g400);font-size:.75rem;margin-top:6px;font-weight:600;line-height:1.6;"></div>
            <a href="{{ route('whatsapp') }}" target="_blank" rel="noopener" class="btn-red" style="width:100%;margin-top:14px;padding:13px;border-radius:16px;font-size:.9rem;justify-content:center;text-decoration:none;display:flex;">💬 Ajukan Kredit Sekarang</a>
          </div>
        </div>
      </div>
    </div>
  </div>
  <style>@media(max-width:900px){#fin-grid{grid-template-columns:1fr!important;}}</style>
</section>

{{-- TESTIMONIALS --}}
@if(isset($testimonials) && $testimonials->count() > 0)
<section style="padding:96px 0;background:#fff;overflow:hidden;position:relative;">
  <div class="orb" style="width:500px;height:500px;background:rgba(204,0,0,0.04);top:-100px;right:-150px;animation:orbFloat 18s ease-in-out infinite;"></div>
  <div style="max-width:1280px;margin:0 auto;padding:0 24px;position:relative;z-index:10;">
    <div class="reveal" style="text-align:center;margin-bottom:56px;">
      <div class="section-tag" style="justify-content:center;">Testimoni Pelanggan</div>
      <h2 style="font-size:clamp(1.8rem,4vw,3rem);font-weight:900;letter-spacing:-1px;font-family:'Raleway',sans-serif;">Kata Mereka Tentang<br>Kerinci Motor</h2>
    </div>
    <div style="overflow:hidden;">
      <div class="ttrack">
        @foreach($testimonials->concat($testimonials) as $t)
        <div style="background:var(--g50);border:1px solid var(--g100);border-radius:24px;padding:28px;min-width:320px;max-width:360px;flex-shrink:0;transition:all .3s;" onmouseover="this.style.boxShadow='0 16px 40px rgba(0,0,0,0.1)';this.style.transform='translateY(-4px)'" onmouseout="this.style.boxShadow='';this.style.transform=''">
          <div style="display:flex;gap:3px;margin-bottom:14px;">
            @for($i=0;$i<($t->rating ?? 5);$i++)
            <span style="color:#f59e0b;font-size:1rem;">★</span>
            @endfor
          </div>
          <p style="color:var(--g600);line-height:1.7;font-size:.9rem;margin-bottom:18px;font-weight:500;">"{{ $t->content }}"</p>
          <div style="display:flex;align-items:center;gap:12px;">
            <div style="width:40px;height:40px;background:var(--red);border-radius:50%;display:flex;align-items:center;justify-content:center;color:#fff;font-weight:900;font-size:.875rem;font-family:'Raleway',sans-serif;flex-shrink:0;">{{ substr($t->name,0,1) }}</div>
            <div>
              <div style="font-weight:800;font-size:.9rem;font-family:'Raleway',sans-serif;">{{ $t->name }}</div>
              @if($t->location)
              <div style="color:var(--g400);font-size:.75rem;font-weight:600;">{{ $t->location }}</div>
              @endif
            </div>
          </div>
        </div>
        @endforeach
      </div>
    </div>
  </div>
</section>
@endif

{{-- WHY KERINCI --}}
@php
$whyImg = null;
if ($featuredCars && $featuredCars->count()) {
    $firstCar = $featuredCars->first();
    $whyImg = $firstCar->getFirstMediaUrl('car_images');
    $whyImg = $whyImg ? str_replace('/storage/', '/storage_assets/', $whyImg) : null;
}
$whyImg = $whyImg ?: 'https://images.unsplash.com/photo-1549924231-f129b911e442?q=80&w=1200&auto=format&fit=crop';
@endphp
<section style="padding:96px 0;background:var(--g50);position:relative;overflow:hidden;">
  <div class="orb" style="width:500px;height:500px;background:rgba(192,192,192,0.07);bottom:-150px;left:-150px;animation:orbFloat2 12s ease-in-out infinite;"></div>
  <div style="max-width:1280px;margin:0 auto;padding:0 24px;position:relative;z-index:10;">
    <div style="display:grid;grid-template-columns:1fr 1fr;gap:80px;align-items:center;" id="why-grid">
      <div class="reveal-left tilt-card" style="position:relative;">
        <div class="tilt-shine"></div>
        <img src="{{ $whyImg }}" loading="eager" style="width:100%;border-radius:40px;box-shadow:0 40px 80px rgba(0,0,0,0.14);display:block;" alt="Kerinci Motor Showroom">
        <div class="glass" style="position:absolute;bottom:-24px;right:-24px;border-radius:22px;padding:20px;box-shadow:0 16px 40px rgba(0,0,0,0.1);max-width:210px;animation:orbFloat2 7s ease-in-out infinite;">
          <div style="font-size:1.75rem;margin-bottom:8px;">✅</div>
          <div style="font-weight:900;font-size:.95rem;font-family:'Raleway',sans-serif;">Terverifikasi Bersih</div>
          <div style="color:var(--g400);font-size:.75rem;margin-top:4px;font-weight:600;line-height:1.5;">History record & BPKB asli setiap unit</div>
        </div>
      </div>
      <div class="reveal-right">
        <div class="section-tag">Mengapa Kerinci Motor?</div>
        <h2 style="font-size:clamp(1.8rem,3.5vw,2.9rem);font-weight:900;line-height:1.1;margin-bottom:40px;letter-spacing:-1px;font-family:'Raleway',sans-serif;">Dipercaya Karena<br>Bukti, Bukan Janji.</h2>
        <div style="display:flex;flex-direction:column;gap:20px;">
          @foreach([['🔍','Inspeksi Terpercaya Bebas Laka dan Banjir','BPKB asli, history record — semua terbuka untuk Anda periksa.'],['💳','Kredit & Simulasi Cicilan','DP rendah cicilan ringan.'],['🔄','Trade-In Cepat','Estimasi harga instan. Proses bisa selesai dalam 1 hari kerja.'],['📋','Dokumen Lengkap','BPKB, STNK, faktur — semua kami bantu proses balik nama.']] as [$icon,$title,$desc])
          <div class="reveal" style="display:flex;gap:20px;align-items:flex-start;padding:18px;border-radius:18px;transition:all .3s;" onmouseover="this.style.background='#fff';this.style.transform='translateX(8px)';this.style.boxShadow='0 8px 24px rgba(0,0,0,0.06)'" onmouseout="this.style.background='';this.style.transform='';this.style.boxShadow=''">
            <div style="width:48px;height:48px;min-width:48px;background:rgba(204,0,0,0.07);border-radius:14px;display:flex;align-items:center;justify-content:center;font-size:1.25rem;">{{ $icon }}</div>
            <div><div style="font-weight:900;font-size:1rem;margin-bottom:5px;font-family:'Raleway',sans-serif;">{{ $title }}</div><div style="color:var(--g400);line-height:1.7;font-size:.875rem;font-weight:500;">{{ $desc }}</div></div>
          </div>
          @endforeach
        </div>
        <a href="{{ route('whatsapp') }}" target="_blank" rel="noopener" class="btn-red reveal" style="margin-top:36px;padding:15px 34px;border-radius:100px;font-size:.95rem;text-decoration:none;display:inline-flex;">Konsultasi Sekarang →</a>
      </div>
    </div>
  </div>
  <style>@media(max-width:900px){#why-grid{grid-template-columns:1fr!important;}}</style>
</section>

{{-- SELL CAR CTA --}}
<section style="padding:120px 24px 96px;background:var(--black);text-align:center;position:relative;overflow:hidden;" class="noise">
  <div class="orb" style="width:600px;height:600px;background:rgba(204,0,0,0.12);top:50%;left:50%;transform:translate(-50%,-50%);animation:orbFloat 10s ease-in-out infinite;"></div>
  <div style="position:relative;z-index:10;max-width:640px;margin:0 auto;">
    <div class="reveal badge-red" style="margin-bottom:24px;justify-content:center;">✦ Jual atau Beli Sekarang</div>
    <h2 class="reveal" style="font-size:clamp(2rem,5vw,4rem);font-weight:900;letter-spacing:-2px;color:#fff;margin-bottom:20px;padding-bottom:40px;font-family:'Raleway',sans-serif;line-height:1.05;">Temukan Mobil<br><span style="color:var(--red);">Impian Anda</span><br>Hari Ini.</h2>
    <p class="reveal" style="color:rgba(255,255,255,.5);font-size:1.05rem;margin-top:32px;margin-bottom:36px;line-height:1.7;font-weight:500;">Tim kami siap membantu Anda memilih atau menjual unit terbaik sesuai kebutuhan dan budget.</p>
    <div class="reveal" style="display:flex;gap:14px;justify-content:center;flex-wrap:wrap;">
      <a href="{{ route('inventory.index') }}" class="btn-red" style="padding:16px 36px;border-radius:100px;font-size:1rem;text-decoration:none;">🔥 Lihat Flash Sale</a>
      <a href="{{ route('sell.index') }}" class="btn-outline" style="padding:16px 36px;border-radius:100px;font-size:1rem;text-decoration:none;border-color:rgba(255,255,255,.3);color:#fff;" onmouseover="this.style.background='rgba(255,255,255,.1)'" onmouseout="this.style.background='transparent'"><span>💰 Jual Mobil Anda</span></a>
    </div>
  </div>
</section>

@endsection

@push('scripts')
<script>
(function(){
  // COUNTDOWN — reset daily at midnight
  function updateCountdown(){
    var now=new Date(),end=new Date(now.getFullYear(),now.getMonth(),now.getDate(),23,59,59);
    var diff=Math.max(0,Math.floor((end-now)/1000));
    var h=Math.floor(diff/3600),m=Math.floor((diff%3600)/60),s=diff%60;
    var pad=function(n){return n<10?'0'+n:n;};
    var elH=document.getElementById('cdH'),elM=document.getElementById('cdM'),elS=document.getElementById('cdS');
    if(elH)elH.textContent=pad(h);
    if(elM)elM.textContent=pad(m);
    if(elS)elS.textContent=pad(s);
  }
  updateCountdown();
  setInterval(updateCountdown,1000);

  // Auto-run calculator if price is pre-filled from CMS
  var prePrice=document.getElementById('calc-price');
  if(prePrice && prePrice.value) { setTimeout(function(){ if(window.calcKredit) window.calcKredit(); }, 50); }

  // CICILAN CALCULATOR — FIXED_INSURANCE hidden from user
  var FIXED_INSURANCE=6000000;
  window.calcKredit=function(){
    var price=parseFloat(document.getElementById('calc-price').value)||0;
    var dp=parseFloat(document.getElementById('calc-dp').value)||0;
    var tenor=parseInt(document.getElementById('calc-tenor').value)||48;
    var result=document.getElementById('calc-result');
    var breakdown=document.getElementById('calc-breakdown');
    if(!result)return;
    if(price>0&&dp>=0&&dp<price){
      var principal=(price-dp)+FIXED_INSURANCE;
      var totalBunga=principal*(0.11*(tenor/12));
      var cicilan=Math.round((principal+totalBunga)/tenor+200000);
      var totalBayar=Math.round(dp+cicilan*tenor);
      result.textContent='Rp '+cicilan.toLocaleString('id-ID');
      breakdown.textContent='Total bayar: Rp '+totalBayar.toLocaleString('id-ID')+' | DP: Rp '+dp.toLocaleString('id-ID')+' | '+tenor+' bulan';
    } else {
      result.textContent='Rp —';
      breakdown.textContent='';
    }
  };
})();
</script>
@endpush
