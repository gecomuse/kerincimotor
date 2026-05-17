@extends('frontend.layouts.app')
@section('title', 'Jual Mobil Bekas di ' . $data['nama'] . ' — Harga Terbaik, Bayar Hari Ini | Kerinci Motor')
@section('description', 'Jual mobil bekas Anda di ' . $data['nama'] . ' dengan harga kompetitif. Kerinci Motor beli mobil hari ini, bayar tunai, gratis jemput lokasi. Hubungi 0877-7670-0009.')

@push('styles')
<link rel="canonical" href="https://kerincimotor.com/jual-mobil/{{ $kota }}">
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "AutoDealer",
  "name": "Kerinci Motor",
  "url": "https://kerincimotor.com",
  "telephone": "+6287776700009",
  "address": {
    "@type": "PostalAddress",
    "streetAddress": "Jl. Mustika Jaya RT.006/RW.012",
    "addressLocality": "Mustikajaya",
    "addressRegion": "Bekasi",
    "postalCode": "17158",
    "addressCountry": "ID"
  },
  "areaServed": "{{ $data['nama_lengkap'] }}",
  "description": "Dealer mobil bekas yang melayani {{ $data['nama_lengkap'] }}. Beli mobil harga kompetitif, proses cepat, bayar tunai."
}
</script>
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "FAQPage",
  "mainEntity": [
    {
      "@type": "Question",
      "name": "Apakah Kerinci Motor beli mobil bekas di {{ $data['nama'] }}?",
      "acceptedAnswer": {
        "@type": "Answer",
        "text": "Ya, kami membeli mobil bekas di seluruh wilayah {{ $data['nama'] }} dan Jabodetabek. Proses cepat, bayar tunai atau transfer langsung."
      }
    },
    {
      "@type": "Question",
      "name": "Berapa lama proses jual mobil ke Kerinci Motor di {{ $data['nama'] }}?",
      "acceptedAnswer": {
        "@type": "Answer",
        "text": "Dari inspeksi sampai uang cair bisa selesai hari itu juga. Tim kami merespons dalam 1x24 jam."
      }
    },
    {
      "@type": "Question",
      "name": "Apakah ada biaya inspeksi untuk wilayah {{ $data['nama'] }}?",
      "acceptedAnswer": {
        "@type": "Answer",
        "text": "Tidak ada biaya inspeksi. Gratis, dan kami bisa datang ke lokasi Anda di {{ $data['nama'] }}."
      }
    },
    {
      "@type": "Question",
      "name": "Jenis mobil apa yang dibeli Kerinci Motor?",
      "acceptedAnswer": {
        "@type": "Answer",
        "text": "Kami membeli MPV (Avanza, Xpander, Innova Reborn), SUV (Fortuner, Pajero Sport bensin, HR-V), dan city car (Brio, Jazz, Yaris, Agya)."
      }
    },
    {
      "@type": "Question",
      "name": "Bagaimana cara jual mobil ke Kerinci Motor dari {{ $data['nama'] }}?",
      "acceptedAnswer": {
        "@type": "Answer",
        "text": "Hubungi WhatsApp kami di 0877-7670-0009. Ceritakan kondisi mobil Anda, kami jadwalkan inspeksi gratis, deal harga, uang cair hari itu."
      }
    }
  ]
}
</script>
@endpush

@section('content')

@php $waUrl = 'https://wa.me/6287776700009?text=' . urlencode('Halo Kerinci Motor, saya ingin jual mobil saya di ' . $data['nama']); @endphp

{{-- SECTION 1: HERO --}}
<section style="padding-top:72px;background:linear-gradient(160deg,#fff 55%,#fff8f8);position:relative;overflow:hidden;padding-bottom:0;" class="noise">
  <div class="orb" style="width:500px;height:500px;background:rgba(204,0,0,0.07);top:-100px;right:-100px;animation:orbFloat 14s ease-in-out infinite;"></div>
  <div style="max-width:1280px;margin:0 auto;padding:56px 24px 64px;position:relative;z-index:10;">
    <div style="max-width:760px;">
      <div class="badge-red reveal" style="margin-bottom:20px;">💰 Jual Mobil di {{ $data['nama'] }}</div>
      <h1 class="reveal" style="font-size:clamp(2rem,5vw,3.8rem);font-weight:900;letter-spacing:-2px;font-family:'Raleway',sans-serif;margin-bottom:20px;line-height:1.05;">
        Jual Mobil Bekas di <span class="tgrad">{{ $data['nama'] }}</span><br>Harga Terbaik, Bayar Hari Ini
      </h1>
      <p class="reveal" style="color:var(--g500);font-size:1.05rem;font-weight:500;line-height:1.75;margin-bottom:36px;max-width:600px;">
        Kerinci Motor siap beli mobil Anda di {{ $data['nama'] }} hari ini. Harga kompetitif, inspeksi gratis, pembayaran tunai atau transfer langsung setelah deal.
      </p>
      <div class="reveal" style="margin-bottom:48px;">
        <a href="{{ $waUrl }}" target="_blank" rel="noopener" class="btn-red" style="padding:16px 40px;border-radius:100px;font-size:1rem;text-decoration:none;">💬 Hubungi WhatsApp Sekarang</a>
      </div>
      <div class="reveal" style="display:grid;grid-template-columns:repeat(4,1fr);gap:14px;" id="hero-highlights">
        @foreach([['⚡','Proses Cepat','1×24 jam'],['💰','Harga Fair','Sesuai pasaran'],['🔒','Aman','Tanpa biaya tersembunyi'],['🚗','Mudah','Kami yang jemput']] as [$icon,$title,$sub])
        <div style="background:#fff;border:1px solid var(--g100);border-radius:16px;padding:18px 14px;text-align:center;transition:.3s;" onmouseover="this.style.borderColor='rgba(204,0,0,0.3)';this.style.transform='translateY(-3px)'" onmouseout="this.style.borderColor='var(--g100)';this.style.transform=''">
          <div style="font-size:1.6rem;margin-bottom:6px;">{{ $icon }}</div>
          <div style="font-weight:800;font-size:.88rem;font-family:'Raleway',sans-serif;margin-bottom:2px;">{{ $title }}</div>
          <div style="color:var(--g400);font-size:.75rem;font-weight:600;">{{ $sub }}</div>
        </div>
        @endforeach
      </div>
    </div>
  </div>
  <style>@media(max-width:640px){#hero-highlights{grid-template-columns:1fr 1fr!important;}}</style>
</section>

{{-- SECTION 2: FORM --}}
<section style="padding:80px 0;background:var(--g50);position:relative;overflow:hidden;" class="noise">
  <div class="orb" style="width:400px;height:400px;background:rgba(204,0,0,0.06);top:-100px;left:-100px;animation:orbFloat2 12s ease-in-out infinite;"></div>
  <div style="max-width:1280px;margin:0 auto;padding:0 24px;position:relative;z-index:10;">
    <div style="display:grid;grid-template-columns:1fr 1fr;gap:64px;align-items:start;" id="form-grid">
      <div class="reveal-left">
        <div class="section-tag">Form Jual Mobil</div>
        <h2 style="font-size:clamp(1.6rem,3.5vw,2.6rem);font-weight:900;letter-spacing:-1px;font-family:'Raleway',sans-serif;margin-bottom:16px;line-height:1.1;">Isi Form,<br>Kami Hubungi Anda</h2>
        <p style="color:var(--g500);font-size:.95rem;line-height:1.75;font-weight:500;margin-bottom:24px;">Tim kami merespons dalam 1×24 jam via WhatsApp untuk konfirmasi dan penjadwalan inspeksi gratis.</p>
        <div style="display:flex;flex-direction:column;gap:14px;">
          @foreach([['✅','Data diri & mobil Anda diterima tim kami'],['📞','Kami hubungi via WhatsApp untuk konfirmasi'],['🔍','Inspeksi gratis — kami datang ke lokasi Anda'],['💰','Deal harga → uang cair hari itu']] as [$icon,$text])
          <div style="display:flex;align-items:center;gap:12px;">
            <div style="width:36px;height:36px;min-width:36px;background:rgba(204,0,0,0.07);border-radius:10px;display:flex;align-items:center;justify-content:center;font-size:1rem;">{{ $icon }}</div>
            <span style="font-size:.9rem;font-weight:600;color:var(--g600);">{{ $text }}</span>
          </div>
          @endforeach
        </div>
      </div>
      <div class="reveal-right" style="background:var(--black);border-radius:32px;padding:40px;position:relative;overflow:hidden;" id="sell-form-card">
        <div class="orb" style="width:300px;height:300px;background:rgba(204,0,0,0.15);top:-80px;right:-80px;animation:orbFloat2 10s ease-in-out infinite;"></div>
        <div style="position:relative;z-index:2;">
          {{-- STEP INDICATOR --}}
          <div style="display:flex;align-items:center;gap:0;margin-bottom:32px;" id="step-ind">
            @foreach([1=>'Data Diri',2=>'Data Mobil',3=>'Harga'] as $n=>$lbl)
            <div style="display:flex;align-items:center;{{ $n<3?'flex:1;':'' }}">
              <div style="display:flex;flex-direction:column;align-items:center;gap:4px;">
                <div class="sind {{ $n===1?'cur':'pend' }}" id="sind-{{ $n }}" style="font-family:'Raleway',sans-serif;">{{ $n }}</div>
                <span style="font-size:.62rem;font-weight:700;color:rgba(255,255,255,.3);text-transform:uppercase;letter-spacing:.5px;font-family:'Raleway',sans-serif;white-space:nowrap;">{{ $lbl }}</span>
              </div>
              @if($n<3)
              <div style="flex:1;height:1px;background:rgba(255,255,255,.1);margin:0 8px;margin-bottom:18px;" id="sline-{{ $n }}"></div>
              @endif
            </div>
            @endforeach
          </div>
          <form id="sell-form" novalidate>
            <input type="hidden" name="kota" value="{{ $kota }}">
            {{-- STEP 1 --}}
            <div class="step-pane on" id="sp-1">
              <h3 style="font-size:1.1rem;font-weight:900;color:#fff;font-family:'Raleway',sans-serif;margin-bottom:20px;">Langkah 1 — Data Diri</h3>
              <div style="display:flex;flex-direction:column;gap:16px;">
                <div>
                  <label style="display:block;color:rgba(255,255,255,.5);font-size:.72rem;margin-bottom:7px;font-weight:700;letter-spacing:.5px;text-transform:uppercase;">Nama Lengkap *</label>
                  <input type="text" id="f-name" name="name" placeholder="contoh: Budi Santoso" maxlength="100" style="width:100%;border:1px solid rgba(255,255,255,.15);background:rgba(255,255,255,.07);border-radius:13px;padding:12px 16px;color:#fff;font-family:'Raleway',sans-serif;font-size:.9rem;outline:none;font-weight:600;" onfocus="this.style.borderColor='rgba(204,0,0,0.7)'" onblur="this.style.borderColor='rgba(255,255,255,.15)'">
                  <div style="color:var(--red);font-size:.72rem;margin-top:4px;font-weight:700;display:none;" id="err-name"></div>
                </div>
                <div>
                  <label style="display:block;color:rgba(255,255,255,.5);font-size:.72rem;margin-bottom:7px;font-weight:700;letter-spacing:.5px;text-transform:uppercase;">Nomor WhatsApp *</label>
                  <div style="position:relative;">
                    <span style="position:absolute;left:14px;top:50%;transform:translateY(-50%);color:rgba(255,255,255,.35);font-size:.9rem;font-weight:700;">+62</span>
                    <input type="tel" id="f-wa" name="wa_number" placeholder="81234567890" maxlength="20" style="width:100%;border:1px solid rgba(255,255,255,.15);background:rgba(255,255,255,.07);border-radius:13px;padding:12px 16px 12px 52px;color:#fff;font-family:'Raleway',sans-serif;font-size:.9rem;outline:none;font-weight:600;" onfocus="this.style.borderColor='rgba(204,0,0,0.7)'" onblur="this.style.borderColor='rgba(255,255,255,.15)'">
                  </div>
                  <div style="color:rgba(255,255,255,.3);font-size:.7rem;margin-top:4px;font-weight:600;">Kami hubungi via WhatsApp ini</div>
                  <div style="color:var(--red);font-size:.72rem;margin-top:4px;font-weight:700;display:none;" id="err-wa"></div>
                </div>
                <button type="button" onclick="nextStep(2)" class="btn-red" style="width:100%;padding:13px;border-radius:100px;font-size:.9rem;justify-content:center;margin-top:4px;">Lanjut →</button>
              </div>
            </div>
            {{-- STEP 2 --}}
            <div class="step-pane" id="sp-2">
              <h3 style="font-size:1.1rem;font-weight:900;color:#fff;font-family:'Raleway',sans-serif;margin-bottom:20px;">Langkah 2 — Data Mobil</h3>
              <div style="display:flex;flex-direction:column;gap:14px;">
                <div style="display:grid;grid-template-columns:1fr 1fr;gap:12px;">
                  <div>
                    <label style="display:block;color:rgba(255,255,255,.5);font-size:.72rem;margin-bottom:7px;font-weight:700;letter-spacing:.5px;text-transform:uppercase;">Merek *</label>
                    <input type="text" id="f-make" name="car_make" placeholder="Honda, Toyota…" maxlength="100" style="width:100%;border:1px solid rgba(255,255,255,.15);background:rgba(255,255,255,.07);border-radius:13px;padding:12px 16px;color:#fff;font-family:'Raleway',sans-serif;font-size:.9rem;outline:none;font-weight:600;" onfocus="this.style.borderColor='rgba(204,0,0,0.7)'" onblur="this.style.borderColor='rgba(255,255,255,.15)'">
                    <div style="color:var(--red);font-size:.72rem;margin-top:4px;font-weight:700;display:none;" id="err-make"></div>
                  </div>
                  <div>
                    <label style="display:block;color:rgba(255,255,255,.5);font-size:.72rem;margin-bottom:7px;font-weight:700;letter-spacing:.5px;text-transform:uppercase;">Model</label>
                    <input type="text" id="f-model" name="car_model" placeholder="Brio, Avanza…" maxlength="150" style="width:100%;border:1px solid rgba(255,255,255,.15);background:rgba(255,255,255,.07);border-radius:13px;padding:12px 16px;color:#fff;font-family:'Raleway',sans-serif;font-size:.9rem;outline:none;font-weight:600;" onfocus="this.style.borderColor='rgba(204,0,0,0.7)'" onblur="this.style.borderColor='rgba(255,255,255,.15)'">
                  </div>
                </div>
                <div style="display:grid;grid-template-columns:1fr 1fr;gap:12px;">
                  <div>
                    <label style="display:block;color:rgba(255,255,255,.5);font-size:.72rem;margin-bottom:7px;font-weight:700;letter-spacing:.5px;text-transform:uppercase;">Tahun *</label>
                    <input type="number" id="f-year" name="car_year" placeholder="{{ date('Y') }}" min="1990" max="{{ date('Y') }}" style="width:100%;border:1px solid rgba(255,255,255,.15);background:rgba(255,255,255,.07);border-radius:13px;padding:12px 16px;color:#fff;font-family:'Raleway',sans-serif;font-size:.9rem;outline:none;font-weight:600;" onfocus="this.style.borderColor='rgba(204,0,0,0.7)'" onblur="this.style.borderColor='rgba(255,255,255,.15)'">
                    <div style="color:var(--red);font-size:.72rem;margin-top:4px;font-weight:700;display:none;" id="err-year"></div>
                  </div>
                  <div>
                    <label style="display:block;color:rgba(255,255,255,.5);font-size:.72rem;margin-bottom:7px;font-weight:700;letter-spacing:.5px;text-transform:uppercase;">Kilometer *</label>
                    <input type="number" id="f-km" name="km" placeholder="60000" min="0" style="width:100%;border:1px solid rgba(255,255,255,.15);background:rgba(255,255,255,.07);border-radius:13px;padding:12px 16px;color:#fff;font-family:'Raleway',sans-serif;font-size:.9rem;outline:none;font-weight:600;" onfocus="this.style.borderColor='rgba(204,0,0,0.7)'" onblur="this.style.borderColor='rgba(255,255,255,.15)'">
                    <div style="color:var(--red);font-size:.72rem;margin-top:4px;font-weight:700;display:none;" id="err-km"></div>
                  </div>
                </div>
                <div>
                  <label style="display:block;color:rgba(255,255,255,.5);font-size:.72rem;margin-bottom:10px;font-weight:700;letter-spacing:.5px;text-transform:uppercase;">Transmisi</label>
                  <div style="display:flex;gap:10px;">
                    @foreach(['automatic'=>'Automatic','manual'=>'Manual'] as $v=>$l)
                    <label style="flex:1;cursor:pointer;">
                      <input type="radio" name="transmission" value="{{ $v }}" style="display:none;" onchange="styleRadio(this)">
                      <div class="trans-opt" data-val="{{ $v }}" style="border:2px solid rgba(255,255,255,.15);border-radius:12px;padding:10px;text-align:center;font-size:.85rem;font-weight:800;color:rgba(255,255,255,.5);font-family:'Raleway',sans-serif;transition:.3s;cursor:pointer;" onclick="document.querySelector('input[name=transmission][value={{ $v }}]').click()">{{ $l }}</div>
                    </label>
                    @endforeach
                  </div>
                </div>
                <div style="display:flex;gap:10px;margin-top:4px;">
                  <button type="button" onclick="prevStep(1)" class="btn-outline" style="flex:1;padding:12px;border-radius:100px;font-size:.875rem;justify-content:center;border-color:rgba(255,255,255,.2);color:#fff;" onmouseover="this.style.background='rgba(255,255,255,.1)'" onmouseout="this.style.background='transparent'"><span>← Kembali</span></button>
                  <button type="button" onclick="nextStep(3)" class="btn-red" style="flex:2;padding:12px;border-radius:100px;font-size:.9rem;justify-content:center;">Lanjut →</button>
                </div>
              </div>
            </div>
            {{-- STEP 3 --}}
            <div class="step-pane" id="sp-3">
              <h3 style="font-size:1.1rem;font-weight:900;color:#fff;font-family:'Raleway',sans-serif;margin-bottom:20px;">Langkah 3 — Harga & Kirim</h3>
              <div style="display:flex;flex-direction:column;gap:14px;">
                <div>
                  <label style="display:block;color:rgba(255,255,255,.5);font-size:.72rem;margin-bottom:7px;font-weight:700;letter-spacing:.5px;text-transform:uppercase;">Harga Harapan *</label>
                  <input type="text" id="f-price" name="asking_price" placeholder="contoh: 150 juta" maxlength="100" style="width:100%;border:1px solid rgba(255,255,255,.15);background:rgba(255,255,255,.07);border-radius:13px;padding:12px 16px;color:#fff;font-family:'Raleway',sans-serif;font-size:.9rem;outline:none;font-weight:600;" onfocus="this.style.borderColor='rgba(204,0,0,0.7)'" onblur="this.style.borderColor='rgba(255,255,255,.15)'">
                  <div style="color:rgba(255,255,255,.3);font-size:.7rem;margin-top:4px;font-weight:600;">Tulis bebas, contoh: "150 juta" atau "Rp 150.000.000"</div>
                  <div style="color:var(--red);font-size:.72rem;margin-top:4px;font-weight:700;display:none;" id="err-price"></div>
                </div>
                <div>
                  <label style="display:block;color:rgba(255,255,255,.5);font-size:.72rem;margin-bottom:7px;font-weight:700;letter-spacing:.5px;text-transform:uppercase;">Catatan Tambahan</label>
                  <textarea id="f-notes" name="notes" rows="3" maxlength="1000" placeholder="kondisi ban, catatan kaki, riwayat servis…" style="width:100%;border:1px solid rgba(255,255,255,.15);background:rgba(255,255,255,.07);border-radius:13px;padding:12px 16px;color:#fff;font-family:'Raleway',sans-serif;font-size:.9rem;outline:none;font-weight:600;resize:vertical;" onfocus="this.style.borderColor='rgba(204,0,0,0.7)'" onblur="this.style.borderColor='rgba(255,255,255,.15)'"></textarea>
                </div>
                <div style="background:rgba(255,255,255,.05);border:1px solid rgba(255,255,255,.1);border-radius:14px;padding:14px;font-size:.78rem;" id="summary-box">
                  <div style="color:rgba(255,255,255,.5);font-weight:700;margin-bottom:8px;font-size:.7rem;text-transform:uppercase;letter-spacing:.5px;">Ringkasan</div>
                  <div style="display:grid;grid-template-columns:1fr 1fr;gap:4px 10px;color:rgba(255,255,255,.7);font-weight:600;line-height:1.6;">
                    <span style="color:rgba(255,255,255,.35);">Nama</span><span id="s-name">—</span>
                    <span style="color:rgba(255,255,255,.35);">WhatsApp</span><span id="s-wa">—</span>
                    <span style="color:rgba(255,255,255,.35);">Kendaraan</span><span id="s-car">—</span>
                    <span style="color:rgba(255,255,255,.35);">Tahun/KM</span><span id="s-ykm">—</span>
                  </div>
                </div>
                <div style="display:flex;gap:10px;margin-top:4px;">
                  <button type="button" onclick="prevStep(2)" class="btn-outline" style="flex:1;padding:12px;border-radius:100px;font-size:.875rem;justify-content:center;border-color:rgba(255,255,255,.2);color:#fff;" onmouseover="this.style.background='rgba(255,255,255,.1)'" onmouseout="this.style.background='transparent'"><span>← Kembali</span></button>
                  <button type="submit" id="submit-btn" class="btn-red" style="flex:2;padding:12px;border-radius:100px;font-size:.875rem;justify-content:center;">💬 Kirim & Chat WA</button>
                </div>
              </div>
            </div>
            {{-- SUCCESS --}}
            <div class="step-pane" id="sp-success" style="text-align:center;padding:20px 0;">
              <div style="width:64px;height:64px;background:rgba(34,197,94,0.15);border-radius:50%;display:flex;align-items:center;justify-content:center;margin:0 auto 16px;font-size:2rem;">✅</div>
              <h3 style="font-size:1.3rem;font-weight:900;color:#fff;font-family:'Raleway',sans-serif;margin-bottom:10px;">Permintaan Terkirim!</h3>
              <p style="color:rgba(255,255,255,.45);font-size:.875rem;line-height:1.6;margin-bottom:24px;">WhatsApp sudah terbuka. Tim kami akan segera merespons untuk proses valuasi.</p>
              <a href="{{ route('home') }}" class="btn-outline" style="padding:12px 28px;border-radius:100px;font-size:.875rem;text-decoration:none;border-color:rgba(255,255,255,.2);color:#fff;" onmouseover="this.style.background='rgba(255,255,255,.1)'" onmouseout="this.style.background='transparent'"><span>← Kembali ke Beranda</span></a>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
  <style>@media(max-width:900px){#form-grid{grid-template-columns:1fr!important;}}</style>
</section>

{{-- SECTION 3: JENIS MOBIL --}}
<section style="padding:80px 0;background:#fff;">
  <div style="max-width:1280px;margin:0 auto;padding:0 24px;">
    <div class="reveal" style="text-align:center;margin-bottom:48px;">
      <div class="section-tag" style="justify-content:center;">Kami Beli Semua Jenis</div>
      <h2 style="font-size:clamp(1.6rem,3.5vw,2.8rem);font-weight:900;letter-spacing:-1px;font-family:'Raleway',sans-serif;margin-bottom:12px;">Jenis Mobil yang Kami Beli<br>di {{ $data['nama'] }}</h2>
      <p style="color:var(--g500);font-size:.95rem;font-weight:500;max-width:560px;margin:0 auto;">Kerinci Motor membeli berbagai jenis mobil bekas kondisi baik di {{ $data['nama_lengkap'] }}.</p>
    </div>
    <div style="display:grid;grid-template-columns:repeat(3,1fr);gap:24px;" id="mobil-grid">
      @foreach([
        ['🚐','MPV',['Toyota Avanza','Toyota Veloz','Toyota Innova Reborn','Mitsubishi Xpander','Suzuki Ertiga']],
        ['🚙','SUV',['Toyota Fortuner','Mitsubishi Pajero Sport (bensin)','Honda HR-V','Toyota Rush']],
        ['🚗','City Car',['Honda Brio','Honda Jazz','Toyota Yaris','Daihatsu Agya','Toyota Calya']],
      ] as [$icon,$tipe,$models])
      <div class="reveal" style="background:var(--g50);border:1px solid var(--g100);border-radius:24px;padding:28px;transition:.3s;" onmouseover="this.style.borderColor='rgba(204,0,0,0.25)';this.style.background='#fff';this.style.transform='translateY(-4px)';this.style.boxShadow='0 16px 40px rgba(0,0,0,0.08)'" onmouseout="this.style.borderColor='var(--g100)';this.style.background='var(--g50)';this.style.transform='';this.style.boxShadow=''">
        <div style="font-size:2rem;margin-bottom:12px;">{{ $icon }}</div>
        <div style="font-weight:900;font-size:1.1rem;font-family:'Raleway',sans-serif;margin-bottom:14px;color:var(--black);">{{ $tipe }}</div>
        <ul style="list-style:none;display:flex;flex-direction:column;gap:8px;">
          @foreach($models as $model)
          <li style="display:flex;align-items:center;gap:8px;font-size:.875rem;font-weight:600;color:var(--g600);">
            <span style="color:var(--red);font-size:.7rem;">✓</span> {{ $model }}
          </li>
          @endforeach
        </ul>
      </div>
      @endforeach
    </div>
    <style>@media(max-width:768px){#mobil-grid{grid-template-columns:1fr!important;}}</style>
  </div>
</section>

{{-- SECTION 4: AREA LAYANAN --}}
<section style="padding:80px 0;background:var(--g50);position:relative;overflow:hidden;">
  <div class="orb" style="width:400px;height:400px;background:rgba(204,0,0,0.05);bottom:-100px;right:-100px;animation:orbFloat2 14s ease-in-out infinite;"></div>
  <div style="max-width:1280px;margin:0 auto;padding:0 24px;position:relative;z-index:10;">
    <div style="display:grid;grid-template-columns:1fr 1fr;gap:64px;align-items:center;" id="area-grid">
      <div class="reveal-left">
        <div class="section-tag">Jangkauan Layanan</div>
        <h2 style="font-size:clamp(1.6rem,3.5vw,2.6rem);font-weight:900;letter-spacing:-1px;font-family:'Raleway',sans-serif;margin-bottom:20px;line-height:1.1;">Area Layanan Kami<br>di {{ $data['nama'] }}</h2>
        <p style="color:var(--g600);line-height:1.75;font-size:.95rem;font-weight:500;margin-bottom:14px;">{{ $data['deskripsi_area'] }}</p>
        <p style="color:var(--g600);line-height:1.75;font-size:.95rem;font-weight:500;margin-bottom:14px;">{{ $data['jarak_dari_showroom'] }}</p>
        <p style="color:var(--g600);line-height:1.75;font-size:.95rem;font-weight:500;margin-bottom:8px;">Area yang sering kami layani: <strong style="color:var(--black);">{{ $data['area_populer'] }}</strong>.</p>
        <p style="color:var(--g400);font-size:.875rem;font-weight:600;font-style:italic;">Tidak ada di list? Tetap hubungi kami — kami layani seluruh Jabodetabek.</p>
      </div>
      <div class="reveal-right">
        <div style="background:#fff;border-radius:24px;padding:32px;box-shadow:0 8px 32px rgba(0,0,0,0.07);border:1px solid var(--g100);">
          <div style="font-weight:900;font-size:1rem;font-family:'Raleway',sans-serif;margin-bottom:20px;color:var(--black);">📍 Lokasi Showroom</div>
          <div style="display:flex;flex-direction:column;gap:14px;">
            @foreach([['📍','Alamat','Jl. Mustika Jaya RT.006/RW.012, Mustikajaya, Bekasi 17158'],['📞','Telepon & WA','0877-7670-0009'],['⏰','Jam Operasional','Senin – Sabtu, 08.00 – 21.00']] as [$icon,$label,$val])
            <div style="display:flex;gap:12px;align-items:flex-start;">
              <div style="width:38px;height:38px;min-width:38px;background:rgba(204,0,0,0.07);border-radius:10px;display:flex;align-items:center;justify-content:center;font-size:1rem;">{{ $icon }}</div>
              <div>
                <div style="font-weight:700;font-size:.75rem;color:var(--g400);text-transform:uppercase;letter-spacing:.5px;margin-bottom:2px;">{{ $label }}</div>
                <div style="font-weight:600;font-size:.9rem;color:var(--g600);line-height:1.5;">{{ $val }}</div>
              </div>
            </div>
            @endforeach
          </div>
          <a href="{{ $waUrl }}" target="_blank" rel="noopener" class="btn-red" style="width:100%;margin-top:24px;padding:13px;border-radius:100px;font-size:.875rem;justify-content:center;text-decoration:none;display:flex;">💬 Hubungi Sekarang</a>
        </div>
      </div>
    </div>
  </div>
  <style>@media(max-width:900px){#area-grid{grid-template-columns:1fr!important;}}</style>
</section>

{{-- SECTION 5: PROSES 3 LANGKAH --}}
<section style="padding:80px 0;background:#fff;">
  <div style="max-width:1280px;margin:0 auto;padding:0 24px;">
    <div class="reveal" style="text-align:center;margin-bottom:56px;">
      <div class="section-tag" style="justify-content:center;">Mudah & Cepat</div>
      <h2 style="font-size:clamp(1.6rem,3.5vw,2.8rem);font-weight:900;letter-spacing:-1px;font-family:'Raleway',sans-serif;">Cara Jual Mobil ke Kerinci Motor<br>di {{ $data['nama'] }}</h2>
    </div>
    <div style="display:grid;grid-template-columns:repeat(3,1fr);gap:32px;position:relative;" id="steps-grid">
      @foreach([
        ['1','💬','Hubungi via WhatsApp','Kirim pesan ke 0877-7670-0009. Ceritakan kondisi dan info singkat mobil Anda.'],
        ['2','🔍','Inspeksi Gratis','Kami jadwalkan inspeksi gratis — tim kami datang ke lokasi Anda di ' . $data['nama'] . '.'],
        ['3','💰','Uang Cair Hari Itu','Deal harga → pembayaran via transfer atau tunai langsung di hari yang sama.'],
      ] as [$num,$icon,$title,$desc])
      <div class="reveal" style="text-align:center;position:relative;">
        <div style="width:72px;height:72px;background:var(--black);border-radius:20px;display:flex;align-items:center;justify-content:center;margin:0 auto 20px;font-size:2rem;position:relative;">
          {{ $icon }}
          <div style="position:absolute;top:-10px;right:-10px;width:26px;height:26px;background:var(--red);border-radius:50%;display:flex;align-items:center;justify-content:center;font-size:.72rem;font-weight:900;color:#fff;font-family:'Raleway',sans-serif;">{{ $num }}</div>
        </div>
        <h3 style="font-weight:900;font-size:1.05rem;font-family:'Raleway',sans-serif;margin-bottom:10px;">{{ $title }}</h3>
        <p style="color:var(--g500);font-size:.875rem;line-height:1.7;font-weight:500;">{{ $desc }}</p>
      </div>
      @endforeach
    </div>
    <style>@media(max-width:768px){#steps-grid{grid-template-columns:1fr!important;}}</style>
  </div>
</section>

{{-- SECTION 6: FAQ ACCORDION --}}
<section style="padding:80px 0;background:var(--g50);">
  <div style="max-width:800px;margin:0 auto;padding:0 24px;">
    <div class="reveal" style="text-align:center;margin-bottom:48px;">
      <div class="section-tag" style="justify-content:center;">FAQ</div>
      <h2 style="font-size:clamp(1.6rem,3.5vw,2.6rem);font-weight:900;letter-spacing:-1px;font-family:'Raleway',sans-serif;">Pertanyaan Umum tentang<br>Jual Mobil di {{ $data['nama'] }}</h2>
    </div>
    <div style="display:flex;flex-direction:column;gap:12px;">
      @foreach([
        ['Apakah Kerinci Motor beli mobil bekas di ' . $data['nama'] . '?', 'Ya, kami membeli mobil bekas di seluruh wilayah ' . $data['nama'] . ' dan Jabodetabek. Proses cepat, bayar tunai atau transfer langsung.'],
        ['Berapa lama proses jual mobil ke Kerinci Motor di ' . $data['nama'] . '?', 'Dari inspeksi sampai uang cair bisa selesai hari itu juga. Tim kami merespons dalam 1×24 jam.'],
        ['Apakah ada biaya inspeksi untuk wilayah ' . $data['nama'] . '?', 'Tidak ada biaya inspeksi. Gratis, dan kami bisa datang ke lokasi Anda di ' . $data['nama'] . '.'],
        ['Jenis mobil apa yang dibeli Kerinci Motor?', 'Kami membeli MPV (Avanza, Xpander, Innova Reborn), SUV (Fortuner, Pajero Sport bensin, HR-V), dan city car (Brio, Jazz, Yaris, Agya).'],
        ['Bagaimana cara jual mobil ke Kerinci Motor dari ' . $data['nama'] . '?', 'Hubungi WhatsApp kami di 0877-7670-0009. Ceritakan kondisi mobil Anda, kami jadwalkan inspeksi gratis, deal harga, uang cair hari itu.'],
      ] as $i => [$q, $a])
      <div class="reveal faq-item" style="background:#fff;border:1px solid var(--g100);border-radius:18px;overflow:hidden;">
        <button onclick="toggleFaq({{ $i }})" style="width:100%;padding:20px 24px;background:none;border:none;cursor:pointer;display:flex;justify-content:space-between;align-items:center;gap:16px;text-align:left;" aria-expanded="false" id="faq-btn-{{ $i }}">
          <span style="font-weight:800;font-size:.95rem;font-family:'Raleway',sans-serif;color:var(--black);line-height:1.4;">{{ $q }}</span>
          <span id="faq-icon-{{ $i }}" style="font-size:1.2rem;font-weight:900;color:var(--red);flex-shrink:0;transition:transform .3s;">+</span>
        </button>
        <div id="faq-ans-{{ $i }}" style="display:none;padding:0 24px 20px;">
          <p style="color:var(--g600);font-size:.9rem;line-height:1.75;font-weight:500;border-top:1px solid var(--g100);padding-top:16px;">{{ $a }}</p>
        </div>
      </div>
      @endforeach
    </div>
  </div>
</section>

{{-- SECTION 7: CTA PENUTUP --}}
<section style="padding:96px 24px;background:var(--black);text-align:center;position:relative;overflow:hidden;" class="noise">
  <div class="orb" style="width:600px;height:600px;background:rgba(204,0,0,0.12);top:50%;left:50%;transform:translate(-50%,-50%);animation:orbFloat 10s ease-in-out infinite;"></div>
  <div style="position:relative;z-index:10;max-width:640px;margin:0 auto;">
    <div class="reveal badge-red" style="margin-bottom:24px;justify-content:center;">💰 Jual Mobil di {{ $data['nama'] }}</div>
    <h2 class="reveal" style="font-size:clamp(2rem,5vw,3.8rem);font-weight:900;letter-spacing:-2px;color:#fff;margin-bottom:20px;padding-bottom:32px;font-family:'Raleway',sans-serif;line-height:1.05;">Siap Jual Mobil Anda<br>di <span style="color:var(--red);">{{ $data['nama'] }}</span>?</h2>
    <p class="reveal" style="color:rgba(255,255,255,.5);font-size:1.05rem;margin-top:32px;margin-bottom:36px;line-height:1.7;font-weight:500;">Jangan tunda. Semakin cepat Anda hubungi kami, semakin cepat uang cair.</p>
    <div class="reveal">
      <a href="{{ $waUrl }}" target="_blank" rel="noopener" class="btn-red" style="padding:18px 44px;border-radius:100px;font-size:1.05rem;text-decoration:none;">💬 Chat WhatsApp Sekarang</a>
    </div>
  </div>
</section>

@endsection

@push('scripts')
<script>
(function(){
  var CSRF=document.querySelector('meta[name="csrf-token"]')?.content??'';
  var step=1;
  function gv(id){return(document.getElementById(id)?.value??'').trim();}
  function se(id,msg){var el=document.getElementById(id);if(el){el.textContent=msg;el.style.display=msg?'block':'none';}}
  function ce(id){se(id,'');}
  function showStep(n){
    [1,2,3,'success'].forEach(function(i){var p=document.getElementById('sp-'+i);if(p)p.className='step-pane';});
    var t=document.getElementById('sp-'+n);if(t)t.className='step-pane on';
    [1,2,3].forEach(function(i){
      var d=document.getElementById('sind-'+i);if(!d)return;
      d.className='sind '+(i<n?'done':(i===n?'cur':'pend'));
      d.textContent=i<n?'✓':i;
      if(i<3){var ln=document.getElementById('sline-'+i);if(ln)ln.style.background=i<n?'var(--red)':'rgba(255,255,255,.1)';}
    });
    step=n;
  }
  function v1(){var ok=true;ce('err-name');ce('err-wa');if(!gv('f-name')){se('err-name','Nama wajib diisi.');ok=false;}var wa=gv('f-wa').replace(/\D/g,'');if(wa.length<7){se('err-wa','Nomor tidak valid.');ok=false;}return ok;}
  function v2(){var ok=true;ce('err-make');ce('err-year');ce('err-km');if(!gv('f-make')){se('err-make','Merek wajib diisi.');ok=false;}var yr=parseInt(gv('f-year'));if(!yr||yr<1990||yr>{{ date('Y') }}){se('err-year','Tahun tidak valid.');ok=false;}var km=parseInt(gv('f-km'));if(isNaN(km)||km<0){se('err-km','Kilometer tidak valid.');ok=false;}return ok;}
  function v3(){var ok=true;ce('err-price');if(!gv('f-price')){se('err-price','Harga harapan wajib diisi.');ok=false;}return ok;}
  function fillSummary(){
    var trans=document.querySelector('input[name=transmission]:checked')?.value??'';
    document.getElementById('s-name').textContent=gv('f-name')||'—';
    document.getElementById('s-wa').textContent=gv('f-wa')?'+62'+gv('f-wa'):'—';
    document.getElementById('s-car').textContent=[gv('f-make'),gv('f-model')].filter(Boolean).join(' ')||'—';
    document.getElementById('s-ykm').textContent=[gv('f-year'),gv('f-km')?Number(gv('f-km')).toLocaleString('id-ID')+' KM':''].filter(Boolean).join(' / ')||'—';
  }
  window.nextStep=function(n){if(n===2&&!v1())return;if(n===3){if(!v2())return;fillSummary();}showStep(n);};
  window.prevStep=function(n){showStep(n);};
  window.styleRadio=function(radio){
    document.querySelectorAll('.trans-opt').forEach(function(el){el.style.borderColor='rgba(255,255,255,.15)';el.style.color='rgba(255,255,255,.5)';el.style.background='rgba(255,255,255,.03)';});
    var opt=document.querySelector('.trans-opt[data-val="'+radio.value+'"]');
    if(opt){opt.style.borderColor='var(--red)';opt.style.color='#fff';opt.style.background='rgba(204,0,0,0.1)';}
  };
  window.toggleFaq=function(i){
    var ans=document.getElementById('faq-ans-'+i);
    var icon=document.getElementById('faq-icon-'+i);
    var btn=document.getElementById('faq-btn-'+i);
    if(!ans)return;
    var open=ans.style.display==='block';
    ans.style.display=open?'none':'block';
    if(icon)icon.textContent=open?'+':'−';
    if(btn)btn.setAttribute('aria-expanded',String(!open));
  };
  document.getElementById('sell-form')?.addEventListener('submit',async function(e){
    e.preventDefault();
    if(!v3())return;
    var btn=document.getElementById('submit-btn');
    btn.disabled=true;btn.textContent='Mengirim…';
    var trans=document.querySelector('input[name=transmission]:checked')?.value??null;
    var payload={
      name:gv('f-name'),phone:'+62'+gv('f-wa').replace(/^0/,''),
      car_make:gv('f-make'),car_model:gv('f-model')||null,
      year:parseInt(gv('f-year')),mileage:parseInt(gv('f-km')),
      transmission:trans,asking_price:gv('f-price'),notes:gv('f-notes')||null
    };
    try{
      var res=await fetch('{{ route('lead.store') }}',{method:'POST',headers:{'Content-Type':'application/json','Accept':'application/json','X-CSRF-TOKEN':CSRF},body:JSON.stringify(payload)});
      var data=await res.json();
      if(data.success){showStep('success');if(data.wa_url)window.open(data.wa_url,'_blank');}
      else{throw new Error(data.message||'Gagal mengirim');}
    }catch(err){
      alert('Gagal: '+err.message+'\nSilakan hubungi kami langsung via WhatsApp.');
      btn.disabled=false;btn.textContent='💬 Kirim & Chat WA';
    }
  });
})();
</script>
@endpush
