@extends('frontend.layouts.app')
@section('title','Inventaris Mobil Bekas — Kerinci Motor Bekasi')
@section('description','Temukan mobil bekas berkualitas di Kerinci Motor. Stok lengkap Honda, Toyota, Daihatsu, Suzuki. Harga transparan, km jujur, inspeksi ketat.')

@section('content')

@php
  $selectedMake  = request('make','');
  $selectedTrans = request('transmission','');
  $selectedYear  = request('year','');
  $selectedMin   = request('price_min','');
  $selectedMax   = request('price_max','');
  $sort          = request('sort','featured');
@endphp

{{-- HERO --}}
<section style="padding-top:72px;background:linear-gradient(160deg,#fff 60%,#fff8f8);position:relative;overflow:hidden;padding-bottom:0;" class="noise">
  <div class="orb" style="width:500px;height:500px;background:rgba(204,0,0,0.07);top:-100px;right:-100px;animation:orbFloat 14s ease-in-out infinite;"></div>
  <div style="max-width:1280px;margin:0 auto;padding:56px 24px 40px;position:relative;z-index:10;">
    <div class="reveal" style="margin-bottom:4px;">
      <div class="section-tag">Inventaris Lengkap</div>
    </div>
    <div style="display:flex;align-items:flex-end;justify-content:space-between;flex-wrap:wrap;gap:16px;">
      <div>
        <h1 class="reveal" style="font-size:clamp(2rem,5vw,4rem);font-weight:900;letter-spacing:-2px;font-family:'Raleway',sans-serif;line-height:1.05;">Semua Unit<br><span class="tgrad">Tersedia</span></h1>
        @isset($cars)
        <p class="reveal" style="color:var(--g500);font-size:.95rem;font-weight:600;margin-top:12px;">{{ number_format($cars->total()) }} kendaraan tersedia</p>
        @endisset
      </div>
      <a href="{{ route('whatsapp') }}" target="_blank" rel="noopener" class="btn-red reveal" style="padding:13px 28px;border-radius:100px;font-size:.875rem;text-decoration:none;flex-shrink:0;">💬 Tanya Stok via WA</a>
    </div>
  </div>
</section>

<section style="background:#fff;padding-bottom:80px;">
  <div style="max-width:1280px;margin:0 auto;padding:0 24px;">

    {{-- FILTER --}}
    <form method="GET" action="{{ route('inventory.index') }}" style="background:var(--g50);border:1px solid var(--g200);border-radius:24px;padding:24px;margin-bottom:28px;margin-top:28px;">
      <div style="display:grid;grid-template-columns:repeat(5,1fr) auto;gap:14px;align-items:end;" id="filter-grid">
        <div>
          <label class="flabel">Merek</label>
          <input type="text" name="make" value="{{ $selectedMake }}" placeholder="Honda, Toyota…" class="finput" style="padding:11px 15px;font-size:.875rem;">
        </div>
        <div>
          <label class="flabel">Transmisi</label>
          <select name="transmission" class="finput" style="padding:11px 15px;font-size:.875rem;cursor:pointer;">
            <option value="">Semua</option>
            <option value="automatic" {{ $selectedTrans==='automatic'?'selected':'' }}>Automatic</option>
            <option value="manual" {{ $selectedTrans==='manual'?'selected':'' }}>Manual</option>
          </select>
        </div>
        <div>
          <label class="flabel">Tahun</label>
          <input type="number" name="year" value="{{ $selectedYear }}" placeholder="{{ date('Y') }}" min="2000" max="{{ date('Y') }}" class="finput" style="padding:11px 15px;font-size:.875rem;">
        </div>
        <div>
          <label class="flabel">Harga Min (jt)</label>
          <input type="number" name="price_min" value="{{ $selectedMin }}" placeholder="50" class="finput" style="padding:11px 15px;font-size:.875rem;">
        </div>
        <div>
          <label class="flabel">Harga Max (jt)</label>
          <input type="number" name="price_max" value="{{ $selectedMax }}" placeholder="500" class="finput" style="padding:11px 15px;font-size:.875rem;">
        </div>
        <div style="display:flex;gap:8px;align-items:flex-end;">
          <button type="submit" class="btn-red" style="padding:11px 22px;border-radius:100px;font-size:.875rem;white-space:nowrap;">Cari</button>
          <a href="{{ route('inventory.index') }}" style="width:40px;height:40px;border-radius:50%;background:var(--g200);display:flex;align-items:center;justify-content:center;text-decoration:none;color:var(--g600);font-size:.875rem;font-weight:700;transition:.2s;flex-shrink:0;" onmouseover="this.style.background='var(--red)';this.style.color='#fff'" onmouseout="this.style.background='var(--g200)';this.style.color='var(--g600)'">✕</a>
        </div>
      </div>
      <style>@media(max-width:1024px){#filter-grid{grid-template-columns:1fr 1fr 1fr!important;}}@media(max-width:640px){#filter-grid{grid-template-columns:1fr 1fr!important;}}</style>
    </form>

    {{-- SORT --}}
    <div style="display:flex;align-items:center;gap:12px;margin-bottom:28px;flex-wrap:wrap;">
      <span style="font-weight:700;font-size:.85rem;color:var(--g500);">Urutkan:</span>
      @foreach(['featured'=>'⭐ Unggulan','newest'=>'🕐 Terbaru','price_asc'=>'💰 Harga ↑','price_desc'=>'💰 Harga ↓'] as $val=>$label)
      <a href="{{ request()->fullUrlWithQuery(['sort'=>$val]) }}" class="pill {{ $sort===$val?'on':'off' }}" style="font-size:.8rem;">{{ $label }}</a>
      @endforeach
    </div>

    {{-- GRID --}}
    @isset($cars)
    <div style="display:grid;grid-template-columns:repeat(4,1fr);gap:24px;margin-bottom:48px;" id="inv-grid">
      @forelse($cars as $car)
      @php $img = $car->thumbnail ?: 'https://images.unsplash.com/photo-1503376780353-7e6692767b70?q=80&w=800'; @endphp
      <div class="car-card reveal" onclick="window.location='{{ route('car.detail', $car->slug) }}'" style="background:#fff;border-radius:20px;overflow:hidden;box-shadow:0 2px 16px rgba(0,0,0,0.07);border:1px solid var(--g100);">
        <div class="card-glow"></div>
        <div class="thumb" style="overflow:hidden;position:relative;">
          <img src="{{ $img }}" style="width:100%;height:190px;object-fit:cover;display:block;" alt="{{ $car->make_model }}" loading="lazy" onerror="this.src='https://images.unsplash.com/photo-1503376780353-7e6692767b70?q=80&w=800'">
          @if($car->is_featured)
          <span style="position:absolute;top:10px;left:10px;background:var(--red);color:#fff;font-size:.68rem;font-weight:800;padding:4px 10px;border-radius:100px;font-family:'Raleway',sans-serif;">🔥 HOT</span>
          @endif
          <span style="position:absolute;top:10px;right:10px;font-size:.68rem;font-weight:700;padding:4px 10px;border-radius:100px;font-family:'Raleway',sans-serif;{{ $car->is_available ? 'background:rgba(34,197,94,0.9);color:#fff;' : 'background:rgba(0,0,0,0.7);color:#fff;' }}">{{ $car->is_available ? 'TERSEDIA' : 'TERJUAL' }}</span>
        </div>
        <div style="padding:18px;">
          <div style="color:var(--g400);font-size:.72rem;font-weight:600;margin-bottom:5px;">{{ $car->year }} · {{ strtoupper($car->transmission) }} · {{ $car->formatted_mileage }}</div>
          <h3 style="font-weight:900;font-size:.95rem;margin-bottom:12px;font-family:'Raleway',sans-serif;line-height:1.3;overflow:hidden;display:-webkit-box;-webkit-line-clamp:2;-webkit-box-orient:vertical;">{{ $car->make_model }}</h3>
          <div style="font-weight:900;font-size:1.15rem;font-family:'Raleway',sans-serif;color:var(--red);margin-bottom:12px;">{{ $car->formatted_price }}</div>
          <a href="{{ route('car.detail', $car->slug) }}" class="btn-red" style="width:100%;padding:9px;border-radius:100px;font-size:.8rem;text-decoration:none;justify-content:center;" onclick="event.stopPropagation()">Lihat Detail</a>
        </div>
      </div>
      @empty
      <div style="grid-column:1/-1;text-align:center;padding:80px 24px;">
        <div style="font-size:4rem;margin-bottom:16px;">🔍</div>
        <h3 style="font-weight:900;font-size:1.4rem;font-family:'Raleway',sans-serif;margin-bottom:8px;">Unit Tidak Ditemukan</h3>
        <p style="color:var(--g400);font-weight:500;margin-bottom:20px;">Coba ubah filter pencarian Anda.</p>
        <a href="{{ route('inventory.index') }}" class="btn-outline" style="padding:13px 28px;border-radius:100px;text-decoration:none;font-size:.875rem;"><span>Reset Filter</span></a>
      </div>
      @endforelse
    </div>
    <style>@media(max-width:1024px){#inv-grid{grid-template-columns:repeat(3,1fr)!important;}}@media(max-width:768px){#inv-grid{grid-template-columns:repeat(2,1fr)!important;}}@media(max-width:480px){#inv-grid{grid-template-columns:1fr!important;}}</style>

    @if($cars->hasPages())
    <div style="display:flex;justify-content:center;margin-top:24px;">
      {{ $cars->withQueryString()->links() }}
    </div>
    @endif
    @endisset

  </div>
</section>

{{-- BOTTOM CTA --}}
<section style="background:var(--black);padding:64px 24px;text-align:center;position:relative;overflow:hidden;" class="noise">
  <div class="orb" style="width:400px;height:400px;background:rgba(204,0,0,0.1);top:50%;left:50%;transform:translate(-50%,-50%);animation:orbFloat 12s ease-in-out infinite;"></div>
  <div style="position:relative;z-index:10;max-width:560px;margin:0 auto;">
    <h2 class="reveal" style="font-size:clamp(1.6rem,3.5vw,2.5rem);font-weight:900;color:#fff;font-family:'Raleway',sans-serif;margin-bottom:14px;letter-spacing:-1px;">Tidak Menemukan Yang Anda Cari?</h2>
    <p class="reveal" style="color:rgba(255,255,255,.5);font-weight:500;margin-bottom:28px;">Request unit spesifik ke tim kami — kami bantu carikan!</p>
    <a href="{{ route('whatsapp') }}" target="_blank" rel="noopener" class="btn-red reveal" style="padding:14px 36px;border-radius:100px;font-size:.95rem;text-decoration:none;">💬 Request Unit via WA</a>
  </div>
</section>

@endsection
