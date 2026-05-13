@extends('frontend.layouts.app')
@section('title','Jual Mobil Bekas — Kerinci Motor Bekasi')
@section('description','Jual mobil bekas Anda ke Kerinci Motor. Proses cepat, harga terbaik, pembayaran langsung. Isi form dan kami hubungi via WhatsApp.')

@section('content')

{{-- HERO --}}
<section style="padding-top:72px;background:linear-gradient(160deg,#fff 55%,#fff8f8);position:relative;overflow:hidden;padding-bottom:0;" class="noise">
  <div class="orb" style="width:500px;height:500px;background:rgba(204,0,0,0.07);top:-100px;right:-100px;animation:orbFloat 14s ease-in-out infinite;"></div>
  <div style="max-width:1280px;margin:0 auto;padding:56px 24px 48px;position:relative;z-index:10;">
    <div style="display:grid;grid-template-columns:1fr 1fr;gap:64px;align-items:center;" id="sell-hero-grid">
      <div>
        <div class="badge-red reveal" style="margin-bottom:20px;">💰 Jual Kendaraan</div>
        <h1 class="reveal" style="font-size:clamp(2rem,5vw,4rem);font-weight:900;letter-spacing:-2px;font-family:'Raleway',sans-serif;margin-bottom:16px;line-height:1.05;">Jual Mobil Anda<br><span class="tgrad">Harga Terbaik</span></h1>
        <p class="reveal" style="color:var(--g500);font-size:1rem;font-weight:500;line-height:1.7;margin-bottom:32px;">Proses cepat, harga transparan, pembayaran langsung. Tim kami merespons dalam 1×24 jam.</p>
        <div class="reveal" style="display:grid;grid-template-columns:1fr 1fr;gap:14px;">
          @foreach([['⚡','Proses Cepat','Respon 1×24 jam'],['💰','Harga Fair','Sesuai pasaran'],['🔒','Aman','Tanpa biaya tersembunyi'],['📋','Mudah','Isi form, kami telepon']] as [$icon,$title,$sub])
          <div style="background:#fff;border:1px solid var(--g100);border-radius:16px;padding:16px;transition:.3s;" onmouseover="this.style.borderColor='rgba(204,0,0,0.3)';this.style.transform='translateY(-3px)'" onmouseout="this.style.borderColor='var(--g100)';this.style.transform=''">
            <div style="font-size:1.5rem;margin-bottom:6px;">{{ $icon }}</div>
            <div style="font-weight:800;font-size:.9rem;font-family:'Raleway',sans-serif;margin-bottom:2px;">{{ $title }}</div>
            <div style="color:var(--g400);font-size:.78rem;font-weight:600;">{{ $sub }}</div>
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
                {{-- SUMMARY --}}
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
  <style>@media(max-width:900px){#sell-hero-grid{grid-template-columns:1fr!important;}}</style>
</section>

{{-- TRUST SECTION --}}
<section style="padding:64px 24px;background:var(--g50);text-align:center;">
  <div style="max-width:1280px;margin:0 auto;">
    <p class="reveal" style="color:var(--g400);font-size:.85rem;font-weight:600;margin-bottom:16px;">Dipercaya oleh 500+ penjual di Bekasi & sekitarnya</p>
    <div class="reveal" style="display:flex;justify-content:center;gap:4px;margin-bottom:8px;">
      @for($i=0;$i<5;$i++)<span style="color:#f59e0b;font-size:1.25rem;">★</span>@endfor
    </div>
    <p class="reveal" style="color:var(--g500);font-size:.85rem;font-weight:700;">Rating 4.9/5 dari 500+ transaksi</p>
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
    [1,2,3,'success'].forEach(function(i){
      var p=document.getElementById('sp-'+i);if(p){p.className='step-pane';}
    });
    var t=document.getElementById('sp-'+n);if(t){t.className='step-pane on';}
    [1,2,3].forEach(function(i){
      var d=document.getElementById('sind-'+i);if(!d)return;
      d.className='sind '+(i<n?'done':(i===n?'cur':'pend'));
      d.textContent=i<n?'✓':i;
      if(i<3){var ln=document.getElementById('sline-'+i);if(ln)ln.style.background=i<n?'var(--red)':'rgba(255,255,255,.1)';}
    });
    step=n;
  }

  function v1(){
    var ok=true;
    ce('err-name');ce('err-wa');
    if(!gv('f-name')){se('err-name','Nama wajib diisi.');ok=false;}
    var wa=gv('f-wa').replace(/\D/g,'');
    if(wa.length<7){se('err-wa','Nomor tidak valid.');ok=false;}
    return ok;
  }

  function v2(){
    var ok=true;
    ce('err-make');ce('err-year');ce('err-km');
    if(!gv('f-make')){se('err-make','Merek wajib diisi.');ok=false;}
    var yr=parseInt(gv('f-year'));if(!yr||yr<1990||yr>{{ date('Y') }}){se('err-year','Tahun tidak valid.');ok=false;}
    var km=parseInt(gv('f-km'));if(isNaN(km)||km<0){se('err-km','Kilometer tidak valid.');ok=false;}
    return ok;
  }

  function v3(){
    var ok=true;
    ce('err-price');
    if(!gv('f-price')){se('err-price','Harga harapan wajib diisi.');ok=false;}
    return ok;
  }

  function fillSummary(){
    var trans=document.querySelector('input[name=transmission]:checked')?.value??'';
    document.getElementById('s-name').textContent=gv('f-name')||'—';
    document.getElementById('s-wa').textContent=gv('f-wa')?'+62'+gv('f-wa'):'—';
    document.getElementById('s-car').textContent=[gv('f-make'),gv('f-model')].filter(Boolean).join(' ')||'—';
    document.getElementById('s-ykm').textContent=[gv('f-year'),gv('f-km')?Number(gv('f-km')).toLocaleString('id-ID')+' KM':''].filter(Boolean).join(' / ')||'—';
  }

  window.nextStep=function(n){
    if(n===2&&!v1())return;
    if(n===3){if(!v2())return;fillSummary();}
    showStep(n);
  };
  window.prevStep=function(n){showStep(n);};

  window.styleRadio=function(radio){
    document.querySelectorAll('.trans-opt').forEach(function(el){
      el.style.borderColor='rgba(255,255,255,.15)';
      el.style.color='rgba(255,255,255,.5)';
      el.style.background='rgba(255,255,255,.03)';
    });
    var opt=document.querySelector('.trans-opt[data-val="'+radio.value+'"]');
    if(opt){opt.style.borderColor='var(--red)';opt.style.color='#fff';opt.style.background='rgba(204,0,0,0.1)';}
  };

  document.getElementById('sell-form')?.addEventListener('submit',async function(e){
    e.preventDefault();
    if(!v3())return;
    var btn=document.getElementById('submit-btn');
    btn.disabled=true;btn.textContent='Mengirim…';
    var trans=document.querySelector('input[name=transmission]:checked')?.value??null;
    var payload={
      name:gv('f-name'),
      phone:'+62'+gv('f-wa').replace(/^0/,''),
      car_make:gv('f-make'),
      car_model:gv('f-model')||null,
      year:parseInt(gv('f-year')),
      mileage:parseInt(gv('f-km')),
      transmission:trans,
      asking_price:gv('f-price'),
      notes:gv('f-notes')||null
    };
    try{
      var res=await fetch('{{ route('lead.store') }}',{
        method:'POST',
        headers:{'Content-Type':'application/json','Accept':'application/json','X-CSRF-TOKEN':CSRF},
        body:JSON.stringify(payload)
      });
      var data=await res.json();
      if(data.success){
        showStep('success');
        if(data.wa_url)window.open(data.wa_url,'_blank');
      } else {
        throw new Error(data.message||'Gagal mengirim');
      }
    } catch(err){
      alert('Gagal: '+err.message+'\nSilakan hubungi kami langsung via WhatsApp.');
      btn.disabled=false;
      btn.textContent='💬 Kirim & Chat WA';
    }
  });
})();
</script>
@endpush
