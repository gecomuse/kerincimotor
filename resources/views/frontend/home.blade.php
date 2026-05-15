@extends('frontend.layouts.app')
@section('title','Kerinci Motor | Dealer Mobil Bekas Terpercaya Sejabodetabek')
@section('description','Dealer mobil bekas terpercaya Sejabodetabek. Stok lengkap, harga transparan. Bebas banjir, laka, dan terbakar.')

@section('content')

{{-- HERO --}}
<section style="min-height:100vh;padding-top:72px;background:linear-gradient(160deg,#fff 55%,#fff8f8 100%);position:relative;overflow:hidden;display:flex;align-items:center;" class="noise">
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
        <div class="reveal" style="display:flex;gap:36px;margin-top:40px;padding-top:36px;border-top:1px solid var(--g100);" data-stats-section>
          <div><div data-counter="{{ $totalCars ?? 50 }}" data-suffix="+" style="font-size:1.8rem;font-weight:900;font-family:'Raleway',sans-serif;color:var(--black);">{{ $totalCars ?? '50' }}+</div><div style="color:var(--g500);font-size:.8rem;font-weight:600;margin-top:2px;">Unit Tersedia</div></div>
          <div><div data-counter="100" data-suffix="%" style="font-size:1.8rem;font-weight:900;font-family:'Raleway',sans-serif;color:var(--black);">100%</div><div style="color:var(--g500);font-size:.8rem;font-weight:600;margin-top:2px;">Jaminan KM Bebas Reset</div></div>
          <div><div data-counter="4.9" data-suffix="★" style="font-size:1.8rem;font-weight:900;font-family:'Raleway',sans-serif;color:var(--black);">4.9★</div><div style="color:var(--g500);font-size:.8rem;font-weight:600;margin-top:2px;">Rating Pelanggan</div></div>
        </div>
      </div>
      <div class="reveal-right tilt-card" style="position:relative;" id="hero-img-col">
        <div class="tilt-shine"></div>
        <div class="hero-float" style="border-radius:40px;overflow:hidden;position:relative;box-shadow:0 40px 100px rgba(0,0,0,0.14);">
          <img src="{{ $hero?->image_url ?? 'https://images.unsplash.com/photo-1503376780353-7e6692767b70?q=80&w=1400&auto=format&fit=crop' }}" style="width:100%;height:520px;object-fit:cover;display:block;" alt="Kerinci Motor Featured Car" loading="eager">
          <div style="position:absolute;inset:0;background:linear-gradient(to top,rgba(0,0,0,0.28),transparent 55%);"></div>
        </div>
        <div class="glass" style="position:absolute;bottom:-20px;left:-20px;border-radius:24px;padding:20px 24px;min-width:220px;box-shadow:0 24px 48px rgba(0,0,0,0.12);animation:orbFloat2 6s ease-in-out infinite;">
          <div style="display:flex;justify-content:space-between;margin-bottom:6px;">
            <span style="font-size:.72rem;color:var(--g400);font-weight:600;">Featured Deal</span>
            <span style="color:var(--red);font-weight:900;font-size:.72rem;">🔥 HOT</span>
          </div>
          <div style="font-weight:900;font-size:1.05rem;margin-bottom:3px;font-family:'Raleway',sans-serif;">{{ $hero?->card_name ?? 'Toyota Alphard 2023' }}</div>
          <div style="color:var(--g400);font-size:.78rem;margin-bottom:12px;font-weight:600;">{{ $hero?->card_sub ?? 'Automatic · 18.000 KM · Bebas Laka' }}</div>
          <div style="display:flex;justify-content:space-between;align-items:center;">
            <div style="font-weight:900;font-size:1.3rem;font-family:'Raleway',sans-serif;color:var(--red);">{{ $hero?->card_price ?? 'Rp 680jt' }}</div>
            <a href="{{ ($hero && $hero->car_id && $hero->car) ? route('car.detail', $hero->car->slug) : route('inventory.index') }}" class="btn-red" style="padding:8px 16px;border-radius:100px;font-size:.78rem;text-decoration:none;">Detail</a>
          </div>
        </div>
        <div class="glass" style="position:absolute;top:20px;right:20px;border-radius:14px;padding:11px 16px;box-shadow:0 8px 24px rgba(0,0,0,0.1);">
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
        <h2 style="font-size:clamp(1.8rem,4vw,3.2rem);font-weight:900;letter-spacing:-1px;font-family:'Raleway',sans-serif;margin-bottom:16px;">Flash Sale Used Car</h2>
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

    <div style="display:grid;grid-template-columns:repeat(3,1fr);gap:28px;" id="home-cards">
      @forelse($featuredCars as $car)
      @php $img = $car->thumbnail ?: 'https://images.unsplash.com/photo-1503376780353-7e6692767b70?q=80&w=800'; @endphp
      <div class="car-card tilt-card reveal" onclick="window.location='{{ route('car.detail', $car->slug) }}'" style="background:#fff;border-radius:24px;overflow:hidden;box-shadow:0 4px 24px rgba(0,0,0,0.07);">
        <div class="card-glow"></div>
        <div class="tilt-shine"></div>
        <div class="thumb" style="overflow:hidden;position:relative;">
          <img src="{{ $img }}" style="width:100%;height:220px;object-fit:cover;display:block;" alt="{{ $car->make_model }}" loading="lazy">
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

{{-- WHY KERINCI --}}
<section style="padding:96px 0;background:#fff;position:relative;overflow:hidden;">
  <div class="orb" style="width:500px;height:500px;background:rgba(192,192,192,0.07);bottom:-150px;left:-150px;animation:orbFloat2 12s ease-in-out infinite;"></div>
  <div style="max-width:1280px;margin:0 auto;padding:0 24px;position:relative;z-index:10;">
    <div style="display:grid;grid-template-columns:1fr 1fr;gap:80px;align-items:center;" id="why-grid">
      <div class="reveal-left tilt-card" style="position:relative;">
        <div class="tilt-shine"></div>
        <img src="https://images.unsplash.com/photo-1560179707-f14e90ef3623?q=80&w=1200&auto=format&fit=crop" style="width:100%;border-radius:40px;box-shadow:0 40px 80px rgba(0,0,0,0.12);display:block;" alt="Showroom Kerinci Motor" loading="lazy">
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
          <div class="reveal" style="display:flex;gap:20px;align-items:flex-start;padding:18px;border-radius:18px;transition:all .3s;" onmouseover="this.style.background='var(--g50)';this.style.transform='translateX(8px)'" onmouseout="this.style.background='';this.style.transform=''">
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

{{-- FINANCING --}}
<section id="financing" style="padding:96px 0;background:var(--black);color:#fff;position:relative;overflow:hidden;" class="noise">
  <div class="orb" style="width:700px;height:700px;background:rgba(204,0,0,0.1);top:-200px;left:-300px;animation:orbFloat 16s ease-in-out infinite;"></div>
  <div class="orb" style="width:400px;height:400px;background:rgba(204,0,0,0.07);bottom:-100px;right:-100px;animation:orbFloat2 12s ease-in-out infinite 3s;"></div>
  <div style="max-width:1280px;margin:0 auto;padding:0 24px;position:relative;z-index:10;">
    <div style="display:grid;grid-template-columns:1fr 1fr;gap:80px;align-items:center;" id="fin-grid">
      <div class="reveal-left">
        <div class="section-tag" style="color:var(--red);">Simulasi Cicilan</div>
        <h2 style="font-size:clamp(1.8rem,3.5vw,3.2rem);font-weight:900;line-height:1.1;margin-bottom:20px;letter-spacing:-1px;font-family:'Raleway',sans-serif;">Hitung Cicilan<br>Mobil Impian Anda<br><span style="color:var(--red);">Sekarang.</span></h2>
        <p style="color:rgba(255,255,255,.5);font-size:1rem;line-height:1.7;margin-bottom:36px;font-weight:500;">DP rendah, cicilan ringan. Proses kredit cepat — ACC dalam hitungan jam!</p>
        <div style="display:grid;grid-template-columns:1fr 1fr;gap:14px;">
          <div style="border:1px solid rgba(255,255,255,.08);border-radius:20px;padding:20px;background:rgba(255,255,255,.04);transition:all .3s;" onmouseover="this.style.background='rgba(255,255,255,0.08)';this.style.transform='translateY(-4px)'" onmouseout="this.style.background='rgba(255,255,255,0.04)';this.style.transform=''">
            <div style="font-size:1.75rem;font-weight:900;color:var(--red);">0%</div>
            <div style="color:rgba(255,255,255,.4);font-size:.8rem;margin-top:4px;font-weight:600;">Biaya Admin Unit Tertentu</div>
          </div>
          <div style="border:1px solid rgba(255,255,255,.08);border-radius:20px;padding:20px;background:rgba(255,255,255,.04);transition:all .3s;" onmouseover="this.style.background='rgba(255,255,255,0.08)';this.style.transform='translateY(-4px)'" onmouseout="this.style.background='rgba(255,255,255,0.04)';this.style.transform=''">
            <div style="font-size:1.1rem;font-weight:900;line-height:1.4;color:#fff;font-family:'Raleway',sans-serif;">⚡ ACC Cepat<br><span style="font-size:.8rem;color:rgba(255,255,255,.5);font-weight:700;">Dalam hitungan jam</span></div>
          </div>
        </div>
      </div>
      <div class="reveal-right" style="background:rgba(255,255,255,.05);border:1px solid rgba(255,255,255,.1);border-radius:32px;padding:36px;box-shadow:0 32px 80px rgba(0,0,0,0.4);">
        <h3 style="font-size:1.4rem;font-weight:900;margin-bottom:24px;color:#fff;font-family:'Raleway',sans-serif;">Kalkulator Kredit</h3>
        <div style="display:flex;flex-direction:column;gap:18px;">
          <div>
            <label style="display:block;color:rgba(255,255,255,.55);font-size:.78rem;margin-bottom:8px;font-weight:700;letter-spacing:.5px;text-transform:uppercase;">Harga Cash (Rp)</label>
            <input type="number" id="calc-price" placeholder="Contoh: 300000000" oninput="calcKredit()" style="width:100%;border:1px solid rgba(255,255,255,.15);background:rgba(255,255,255,.06);border-radius:13px;padding:13px 17px;color:#fff;font-family:'Raleway',sans-serif;font-size:.95rem;outline:none;font-weight:600;" onfocus="this.style.borderColor='rgba(204,0,0,0.7)'" onblur="this.style.borderColor='rgba(255,255,255,.15)'">
          </div>
          <div>
            <label style="display:block;color:rgba(255,255,255,.55);font-size:.78rem;margin-bottom:8px;font-weight:700;letter-spacing:.5px;text-transform:uppercase;">Uang Muka / DP (Rp)</label>
            <input type="number" id="calc-dp" placeholder="Contoh: 60000000" oninput="calcKredit()" style="width:100%;border:1px solid rgba(255,255,255,.15);background:rgba(255,255,255,.06);border-radius:13px;padding:13px 17px;color:#fff;font-family:'Raleway',sans-serif;font-size:.95rem;outline:none;font-weight:600;" onfocus="this.style.borderColor='rgba(204,0,0,0.7)'" onblur="this.style.borderColor='rgba(255,255,255,.15)'">
          </div>
          <div>
            <label style="display:block;color:rgba(255,255,255,.55);font-size:.78rem;margin-bottom:8px;font-weight:700;letter-spacing:.5px;text-transform:uppercase;">Tenor</label>
            <select id="calc-tenor" oninput="calcKredit()" style="width:100%;border:1px solid rgba(255,255,255,.15);background:rgba(43,43,43,.9);border-radius:13px;padding:13px 17px;color:#fff;font-family:'Raleway',sans-serif;font-size:.95rem;outline:none;font-weight:600;">
              <option value="12">12 Bulan (1 Tahun)</option>
              <option value="24">24 Bulan (2 Tahun)</option>
              <option value="36">36 Bulan (3 Tahun)</option>
              <option value="48" selected>48 Bulan (4 Tahun)</option>
              <option value="60">60 Bulan (5 Tahun)</option>
            </select>
          </div>
          <div style="background:#fff;border-radius:20px;padding:24px;">
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

{{-- VIDEO PREVIEW --}}
@if(isset($latestPosts) && $latestPosts->count() > 0)
<section style="padding:96px 0;background:var(--g50);position:relative;overflow:hidden;">
  <div style="max-width:1280px;margin:0 auto;padding:0 24px;">
    <div style="display:flex;justify-content:space-between;align-items:flex-end;margin-bottom:48px;flex-wrap:wrap;gap:20px;">
      <div class="reveal">
        <div class="section-tag">Tips & Panduan</div>
        <h2 style="font-size:clamp(1.8rem,4vw,3rem);font-weight:900;letter-spacing:-1px;font-family:'Raleway',sans-serif;">Tips Beli Mobil Bekas</h2>
      </div>
      <a href="{{ route('tips.index') }}" class="btn-outline reveal" style="padding:13px 28px;border-radius:100px;font-size:.875rem;text-decoration:none;"><span>Semua Artikel →</span></a>
    </div>
    <div style="display:grid;grid-template-columns:repeat(3,1fr);gap:24px;" id="tips-grid">
      @foreach($latestPosts as $post)
      <a href="{{ route('artikel.show', $post->slug) }}" style="text-decoration:none;display:block;background:#fff;border-radius:20px;overflow:hidden;box-shadow:0 4px 20px rgba(0,0,0,0.06);transition:all .4s cubic-bezier(0.34,1.56,0.64,1);position:relative;" class="reveal" onmouseover="this.style.transform='translateY(-8px)';this.style.boxShadow='0 24px 60px rgba(0,0,0,0.14)'" onmouseout="this.style.transform='';this.style.boxShadow='0 4px 20px rgba(0,0,0,0.06)'">
        @if($post->thumbnail_url)
        <img src="{{ $post->thumbnail_url }}" style="width:100%;height:180px;object-fit:cover;display:block;" alt="{{ $post->title }}" loading="lazy">
        @else
        <div style="width:100%;height:180px;background:var(--g100);display:flex;align-items:center;justify-content:center;font-size:2.5rem;">📰</div>
        @endif
        <div style="padding:20px;">
          @if($post->category)
          <span style="display:inline-block;background:rgba(204,0,0,0.07);color:var(--red);font-size:.7rem;font-weight:800;padding:4px 12px;border-radius:100px;margin-bottom:10px;text-transform:uppercase;letter-spacing:.5px;">{{ $post->category }}</span>
          @endif
          <h3 style="font-weight:800;font-size:1rem;line-height:1.45;color:var(--black);margin-bottom:10px;font-family:'Raleway',sans-serif;">{{ Str::limit($post->title,60) }}</h3>
          <div style="color:var(--g400);font-size:.76rem;font-weight:600;">{{ $post->published_at?->locale('id')->isoFormat('D MMM YYYY') }} · {{ $post->read_time ?? 5 }} mnt baca</div>
        </div>
      </a>
      @endforeach
    </div>
  </div>
  <style>@media(max-width:900px){#tips-grid{grid-template-columns:1fr 1fr!important;}}@media(max-width:640px){#tips-grid{grid-template-columns:1fr!important;}}</style>
</section>
@endif

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

{{-- FINAL CTA --}}
<section style="padding:96px 24px;background:var(--black);text-align:center;position:relative;overflow:hidden;" class="noise">
  <div class="orb" style="width:600px;height:600px;background:rgba(204,0,0,0.12);top:50%;left:50%;transform:translate(-50%,-50%);animation:orbFloat 10s ease-in-out infinite;"></div>
  <div style="position:relative;z-index:10;max-width:640px;margin:0 auto;">
    <div class="reveal badge-red" style="margin-bottom:24px;justify-content:center;">✦ Siap Membantu Anda</div>
    <h2 class="reveal" style="font-size:clamp(2rem,5vw,4rem);font-weight:900;letter-spacing:-2px;color:#fff;margin-bottom:20px;font-family:'Raleway',sans-serif;line-height:1.05;">Temukan Mobil<br><span style="color:var(--red);">Impian Anda</span><br>Hari Ini.</h2>
    <p class="reveal" style="color:rgba(255,255,255,.5);font-size:1.05rem;margin-bottom:36px;line-height:1.7;font-weight:500;">Tim kami siap membantu Anda memilih unit terbaik sesuai kebutuhan dan budget.</p>
    <div class="reveal" style="display:flex;gap:14px;justify-content:center;flex-wrap:wrap;">
      <a href="{{ route('inventory.index') }}" class="btn-red" style="padding:16px 36px;border-radius:100px;font-size:1rem;text-decoration:none;">🔥 Lihat Flash Sale</a>
      <a href="{{ route('whatsapp') }}" target="_blank" rel="noopener" class="btn-outline" style="padding:16px 36px;border-radius:100px;font-size:1rem;text-decoration:none;border-color:rgba(255,255,255,.3);color:#fff;" onmouseover="this.style.background='rgba(255,255,255,.1)'" onmouseout="this.style.background='transparent'"><span>💬 WhatsApp</span></a>
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
