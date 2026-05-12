@extends('frontend.layouts.app')

@section('title', 'Jual Mobil Bekas — Kerinci Motor Bekasi')
@section('description', 'Jual mobil bekas Anda dengan harga terbaik di Kerinci Motor. Proses cepat, transparan, pembayaran langsung.')

@section('content')

<section class="pt-32 pb-20 bg-brand-black min-h-screen">
    <div class="max-w-3xl mx-auto px-4 md:px-8">

        {{-- Header --}}
        <div class="text-center mb-12">
            <p class="section-label">JUAL KENDARAAN</p>
            <h1 class="section-title">Jual Mobil Anda<br class="hidden md:block"> dengan Harga Terbaik</h1>
            <p class="section-subtitle mx-auto">
                Proses cepat, harga transparan, pembayaran langsung. Isi form di bawah — tim kami akan menghubungi Anda dalam 1×24 jam.
            </p>
            <div class="divider-red mx-auto mt-6"></div>
        </div>

        {{-- USP Bar --}}
        <div class="grid grid-cols-3 gap-4 mb-10">
            @foreach([['⚡', 'Proses Cepat', '1×24 jam respon'], ['💰', 'Harga Fair', 'Sesuai pasaran'], ['🔒', 'Aman & Terpercaya', 'Tanpa potongan tersembunyi']] as [$icon, $title, $sub])
            <div class="bg-brand-dark-gray border border-white/5 rounded-xl p-4 text-center">
                <div class="text-2xl mb-1">{{ $icon }}</div>
                <div class="font-heading font-bold text-brand-white text-xs">{{ $title }}</div>
                <div class="text-brand-text-gray text-xs mt-0.5">{{ $sub }}</div>
            </div>
            @endforeach
        </div>

        {{-- Form Card --}}
        <div class="bg-brand-dark-gray border border-white/5 rounded-2xl p-8" id="sell-form-card">

            {{-- Step Indicator --}}
            <div class="flex items-center justify-between mb-8" id="step-indicator">
                @foreach([1 => 'Data Diri', 2 => 'Data Mobil', 3 => 'Harga & Kirim'] as $n => $label)
                <div class="flex items-center {{ $n < 3 ? 'flex-1' : '' }}">
                    <div class="flex flex-col items-center">
                        <div id="step-dot-{{ $n }}"
                             class="w-8 h-8 rounded-full flex items-center justify-center text-xs font-heading font-bold transition-all duration-300
                                    {{ $n === 1 ? 'bg-brand-red text-white' : 'bg-brand-mid-gray text-brand-text-gray' }}">
                            {{ $n }}
                        </div>
                        <span class="text-xs text-brand-text-gray mt-1 hidden sm:block">{{ $label }}</span>
                    </div>
                    @if($n < 3)
                    <div id="step-line-{{ $n }}" class="flex-1 h-px mx-3 transition-all duration-300 bg-white/10"></div>
                    @endif
                </div>
                @endforeach
            </div>

            <form id="sell-form" novalidate>
                @csrf

                {{-- ── Step 1: Data Diri ─────────────────────────────── --}}
                <div id="step-1" class="space-y-5">
                    <h2 class="font-heading font-bold text-brand-white text-lg mb-6">Langkah 1 — Data Diri</h2>

                    <div>
                        <label for="name" class="km-label">Nama Lengkap <span class="text-brand-red">*</span></label>
                        <input type="text" id="name" name="name"
                               placeholder="contoh: Budi Santoso"
                               class="km-input" required maxlength="100">
                        <p class="error-msg hidden text-brand-red text-xs mt-1" id="err-name"></p>
                    </div>

                    <div>
                        <label for="wa_number" class="km-label">Nomor WhatsApp <span class="text-brand-red">*</span></label>
                        <div class="relative">
                            <span class="absolute left-3 top-1/2 -translate-y-1/2 text-brand-text-gray text-sm">+62</span>
                            <input type="tel" id="wa_number" name="wa_number"
                                   placeholder="81234567890"
                                   class="km-input pl-12" required maxlength="20">
                        </div>
                        <p class="text-brand-text-gray text-xs mt-1">Kami akan menghubungi via WhatsApp ini.</p>
                        <p class="error-msg hidden text-brand-red text-xs mt-1" id="err-wa_number"></p>
                    </div>

                    <div class="pt-2 flex justify-end">
                        <button type="button" onclick="nextStep(2)"
                                class="btn-primary">
                            Lanjut →
                        </button>
                    </div>
                </div>

                {{-- ── Step 2: Data Mobil ────────────────────────────── --}}
                <div id="step-2" class="space-y-5 hidden">
                    <h2 class="font-heading font-bold text-brand-white text-lg mb-6">Langkah 2 — Data Mobil</h2>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                        <div>
                            <label for="car_make" class="km-label">Merek <span class="text-brand-red">*</span></label>
                            <input type="text" id="car_make" name="car_make"
                                   placeholder="Honda, Toyota, Daihatsu..."
                                   class="km-input" required maxlength="100">
                            <p class="error-msg hidden text-brand-red text-xs mt-1" id="err-car_make"></p>
                        </div>
                        <div>
                            <label for="car_model" class="km-label">Model</label>
                            <input type="text" id="car_model" name="car_model"
                                   placeholder="Brio, Avanza, Xenia..."
                                   class="km-input" maxlength="150">
                        </div>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                        <div>
                            <label for="car_year" class="km-label">Tahun <span class="text-brand-red">*</span></label>
                            <input type="number" id="car_year" name="car_year"
                                   placeholder="{{ date('Y') }}" min="1990" max="{{ date('Y') }}"
                                   class="km-input" required>
                            <p class="error-msg hidden text-brand-red text-xs mt-1" id="err-car_year"></p>
                        </div>
                        <div>
                            <label for="km" class="km-label">Kilometer <span class="text-brand-red">*</span></label>
                            <input type="number" id="km" name="km"
                                   placeholder="contoh: 60000" min="0"
                                   class="km-input" required>
                            <p class="error-msg hidden text-brand-red text-xs mt-1" id="err-km"></p>
                        </div>
                    </div>

                    <div>
                        <label class="km-label">Transmisi</label>
                        <div class="flex gap-3 mt-1">
                            @foreach(['automatic' => 'Automatic', 'manual' => 'Manual'] as $val => $label)
                            <label class="flex-1 cursor-pointer">
                                <input type="radio" name="transmission" value="{{ $val }}" class="sr-only peer">
                                <div class="border border-white/10 rounded-xl p-3 text-center text-sm font-heading font-semibold text-brand-text-gray
                                            peer-checked:border-brand-red peer-checked:text-brand-red peer-checked:bg-brand-red/10
                                            hover:border-white/20 transition-all duration-200">
                                    {{ $label }}
                                </div>
                            </label>
                            @endforeach
                        </div>
                    </div>

                    <div class="pt-2 flex justify-between">
                        <button type="button" onclick="prevStep(1)" class="btn-outline">← Kembali</button>
                        <button type="button" onclick="nextStep(3)" class="btn-primary">Lanjut →</button>
                    </div>
                </div>

                {{-- ── Step 3: Harga & Kirim ─────────────────────────── --}}
                <div id="step-3" class="space-y-5 hidden">
                    <h2 class="font-heading font-bold text-brand-white text-lg mb-6">Langkah 3 — Harga & Keterangan</h2>

                    <div>
                        <label for="asking_price" class="km-label">Harga Harapan <span class="text-brand-red">*</span></label>
                        <input type="text" id="asking_price" name="asking_price"
                               placeholder="contoh: 150 juta / Rp 150.000.000"
                               class="km-input" required maxlength="100">
                        <p class="text-brand-text-gray text-xs mt-1">Tulis dalam angka atau teks, misal: "150 juta"</p>
                        <p class="error-msg hidden text-brand-red text-xs mt-1" id="err-asking_price"></p>
                    </div>

                    <div>
                        <label for="notes" class="km-label">Kondisi & Catatan Tambahan</label>
                        <textarea id="notes" name="notes" rows="4"
                                  placeholder="contoh: cat orisinil, ban baru, pajak hidup, ada lecet kecil di bumper..."
                                  class="km-input resize-none" maxlength="1000"></textarea>
                        <p class="text-brand-text-gray text-xs mt-1 text-right" id="notes-counter">0 / 1000</p>
                    </div>

                    {{-- Summary Preview --}}
                    <div class="bg-brand-black/50 border border-white/5 rounded-xl p-4 space-y-2" id="summary-box">
                        <p class="font-heading font-bold text-brand-white text-sm mb-3">Ringkasan Data</p>
                        <div class="grid grid-cols-2 gap-x-4 gap-y-1 text-xs">
                            <span class="text-brand-text-gray">Nama</span>          <span class="text-brand-white" id="s-name">—</span>
                            <span class="text-brand-text-gray">WhatsApp</span>      <span class="text-brand-white" id="s-wa">—</span>
                            <span class="text-brand-text-gray">Merek & Model</span> <span class="text-brand-white" id="s-car">—</span>
                            <span class="text-brand-text-gray">Tahun / KM</span>    <span class="text-brand-white" id="s-year-km">—</span>
                            <span class="text-brand-text-gray">Transmisi</span>     <span class="text-brand-white" id="s-trans">—</span>
                        </div>
                    </div>

                    <div class="pt-2 flex justify-between items-center">
                        <button type="button" onclick="prevStep(2)" class="btn-outline">← Kembali</button>
                        <button type="submit" id="submit-btn" class="btn-wa">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/>
                            </svg>
                            Kirim & Chat via WA
                        </button>
                    </div>
                </div>

                {{-- ── Success State ─────────────────────────────────── --}}
                <div id="step-success" class="hidden text-center py-10">
                    <div class="w-16 h-16 bg-green-500/20 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                    </div>
                    <h3 class="font-heading font-extrabold text-2xl text-brand-white mb-3">Permintaan Terkirim!</h3>
                    <p class="text-brand-text-gray text-sm mb-6 max-w-sm mx-auto">
                        WhatsApp sudah terbuka di tab baru. Tim kami akan segera menghubungi Anda untuk proses valuasi.
                    </p>
                    <a href="{{ route('home') }}" class="btn-outline">← Kembali ke Beranda</a>
                </div>

            </form>
        </div>

        {{-- Trust Signals --}}
        <div class="mt-10 text-center">
            <p class="text-brand-text-gray text-xs mb-4">Dipercaya oleh ratusan pemilik kendaraan di Bekasi & sekitarnya</p>
            <div class="flex justify-center gap-2">
                @for($i = 0; $i < 5; $i++)
                <svg class="w-4 h-4 text-yellow-400" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
                </svg>
                @endfor
            </div>
            <p class="text-brand-text-gray text-xs mt-2">Rating 4.9/5 dari 200+ transaksi</p>
        </div>

    </div>
</section>

@push('scripts')
<script>
(function () {
    const CSRF = document.querySelector('meta[name="csrf-token"]')?.content ?? '';
    let currentStep = 1;

    function showStep(n) {
        [1, 2, 3].forEach(i => {
            document.getElementById('step-' + i)?.classList.add('hidden');
            const dot = document.getElementById('step-dot-' + i);
            if (dot) {
                dot.classList.remove('bg-brand-red', 'text-white', 'bg-green-500');
                dot.classList.add('bg-brand-mid-gray', 'text-brand-text-gray');
            }
            if (i < 3) {
                const line = document.getElementById('step-line-' + i);
                if (line) line.classList.replace('bg-brand-red', 'bg-white/10') || line.classList.add('bg-white/10');
            }
        });

        // Mark completed steps
        for (let i = 1; i < n; i++) {
            const dot = document.getElementById('step-dot-' + i);
            if (dot) {
                dot.classList.remove('bg-brand-mid-gray', 'text-brand-text-gray');
                dot.classList.add('bg-green-500', 'text-white');
                dot.textContent = '✓';
            }
            if (i < 3) {
                const line = document.getElementById('step-line-' + i);
                if (line) { line.classList.remove('bg-white/10'); line.classList.add('bg-brand-red'); }
            }
        }

        // Active step
        const activeDot = document.getElementById('step-dot-' + n);
        if (activeDot) {
            activeDot.classList.remove('bg-brand-mid-gray', 'text-brand-text-gray');
            activeDot.classList.add('bg-brand-red', 'text-white');
            activeDot.textContent = n;
        }

        document.getElementById('step-' + n)?.classList.remove('hidden');
        currentStep = n;
        window.scrollTo({ top: document.getElementById('sell-form-card').offsetTop - 100, behavior: 'smooth' });
    }

    function getVal(id) {
        return document.getElementById(id)?.value.trim() ?? '';
    }

    function showErr(id, msg) {
        const el = document.getElementById('err-' + id);
        if (el) { el.textContent = msg; el.classList.remove('hidden'); }
        document.getElementById(id)?.classList.add('border-brand-red');
    }

    function clearErr(id) {
        const el = document.getElementById('err-' + id);
        if (el) { el.textContent = ''; el.classList.add('hidden'); }
        document.getElementById(id)?.classList.remove('border-brand-red');
    }

    function validateStep1() {
        let ok = true;
        const name = getVal('name');
        const wa = getVal('wa_number');
        clearErr('name'); clearErr('wa_number');
        if (!name) { showErr('name', 'Nama wajib diisi.'); ok = false; }
        if (!wa || wa.replace(/\D/g, '').length < 8) { showErr('wa_number', 'Nomor WhatsApp tidak valid.'); ok = false; }
        return ok;
    }

    function validateStep2() {
        let ok = true;
        const make = getVal('car_make');
        const year = getVal('car_year');
        const km   = getVal('km');
        clearErr('car_make'); clearErr('car_year'); clearErr('km');
        if (!make) { showErr('car_make', 'Merek wajib diisi.'); ok = false; }
        if (!year || isNaN(year) || +year < 1990 || +year > {{ date('Y') }}) {
            showErr('car_year', 'Tahun tidak valid.'); ok = false;
        }
        if (!km || isNaN(km) || +km < 0) { showErr('km', 'Kilometer tidak valid.'); ok = false; }
        return ok;
    }

    function validateStep3() {
        let ok = true;
        const price = getVal('asking_price');
        clearErr('asking_price');
        if (!price) { showErr('asking_price', 'Harga harapan wajib diisi.'); ok = false; }
        return ok;
    }

    function updateSummary() {
        const trans = document.querySelector('input[name="transmission"]:checked')?.value ?? '';
        document.getElementById('s-name').textContent    = getVal('name') || '—';
        document.getElementById('s-wa').textContent      = '+62' + getVal('wa_number') || '—';
        document.getElementById('s-car').textContent     = [getVal('car_make'), getVal('car_model')].filter(Boolean).join(' ') || '—';
        document.getElementById('s-year-km').textContent = [getVal('car_year'), getVal('km') ? Number(getVal('km')).toLocaleString('id-ID') + ' km' : ''].filter(Boolean).join(' / ') || '—';
        document.getElementById('s-trans').textContent   = trans ? (trans.charAt(0).toUpperCase() + trans.slice(1)) : '—';
    }

    window.nextStep = function (n) {
        if (n === 2 && !validateStep1()) return;
        if (n === 3 && !validateStep2()) return;
        if (n === 3) updateSummary();
        showStep(n);
    };

    window.prevStep = function (n) { showStep(n); };

    // Notes counter
    document.getElementById('notes')?.addEventListener('input', function () {
        document.getElementById('notes-counter').textContent = this.value.length + ' / 1000';
    });

    // Form submit
    document.getElementById('sell-form')?.addEventListener('submit', async function (e) {
        e.preventDefault();
        if (!validateStep3()) return;

        const btn = document.getElementById('submit-btn');
        btn.disabled = true;
        btn.textContent = 'Mengirim...';

        const trans = document.querySelector('input[name="transmission"]:checked')?.value ?? null;

        const payload = {
            name:         getVal('name'),
            phone:        '+62' + getVal('wa_number').replace(/^0/, ''),
            car_make:     getVal('car_make'),
            car_model:    getVal('car_model') || null,
            year:         parseInt(getVal('car_year')),
            mileage:      parseInt(getVal('km')),
            transmission: trans,
            asking_price: getVal('asking_price'),
            notes:        getVal('notes') || null,
        };

        try {
            const res = await fetch('{{ route('lead.store') }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': CSRF,
                },
                body: JSON.stringify(payload),
            });

            const data = await res.json();

            if (data.success) {
                // Hide steps + step indicator, show success
                [1, 2, 3].forEach(i => document.getElementById('step-' + i)?.classList.add('hidden'));
                document.getElementById('step-indicator')?.classList.add('hidden');
                document.getElementById('step-success')?.classList.remove('hidden');

                if (data.wa_url) {
                    window.open(data.wa_url, '_blank');
                }
            } else {
                throw new Error(data.message ?? 'Terjadi kesalahan.');
            }
        } catch (err) {
            alert('Gagal mengirim: ' + err.message + '\nSilakan coba lagi atau hubungi kami langsung via WhatsApp.');
            btn.disabled = false;
            btn.innerHTML = `<svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg> Kirim & Chat via WA`;
        }
    });
})();
</script>
@endpush

@endsection
