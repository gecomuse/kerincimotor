<!DOCTYPE html>
<html lang="en" class="h-full">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Setup — Kerinci Motor</title>
    <meta name="robots" content="noindex, nofollow">
    @vite(['resources/css/app.css'])
</head>
<body class="min-h-full bg-brand-black flex items-center justify-center px-4 py-12">

<div class="w-full max-w-md">
    {{-- Logo --}}
    <div class="text-center mb-8">
        <img src="{{ asset('images/logo.png') }}" alt="Kerinci Motor" class="h-10 mx-auto mb-4"
             onerror="this.outerHTML='<p class=\'font-heading font-extrabold text-2xl text-white\'>KERINCI<span class=\'text-brand-red\'>MOTOR</span></p>'">
        <h1 class="font-heading font-bold text-xl text-brand-white">Pengaturan Akun Admin</h1>
        <p class="text-brand-text-gray text-sm mt-1">Buat akun administrator CMS</p>
    </div>

    {{-- Alert if admin exists --}}
    @if($adminExists)
    <div class="bg-yellow-500/10 border border-yellow-500/30 rounded-xl p-4 mb-6 text-center">
        <p class="text-yellow-400 text-sm font-semibold">⚠️ Akun admin sudah ada.</p>
        <p class="text-brand-text-gray text-xs mt-1">Anda masih bisa membuat akun tambahan di bawah.</p>
    </div>
    @endif

    {{-- Session success --}}
    @if(session('success'))
    <div class="bg-green-500/10 border border-green-500/30 rounded-xl p-4 mb-6 text-center">
        <p class="text-green-400 text-sm">{{ session('success') }}</p>
    </div>
    @endif

    <div class="bg-brand-dark-gray border border-white/5 rounded-2xl p-8">
        <form method="POST" action="{{ route('admin.register.store', $token) }}" novalidate>
            @csrf

            <div class="space-y-5">
                {{-- Name --}}
                <div>
                    <label for="name" class="km-label">Nama Lengkap</label>
                    <input id="name" type="text" name="name" value="{{ old('name') }}"
                           required autocomplete="name"
                           placeholder="Nama Admin"
                           class="km-input @error('name') border-brand-red/60 @enderror">
                    @error('name')
                    <p class="text-brand-red text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Email --}}
                <div>
                    <label for="email" class="km-label">Alamat Email</label>
                    <input id="email" type="email" name="email" value="{{ old('email') }}"
                           required autocomplete="email"
                           placeholder="admin@kerincimotor.com"
                           class="km-input @error('email') border-brand-red/60 @enderror">
                    @error('email')
                    <p class="text-brand-red text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Password --}}
                <div>
                    <label for="password" class="km-label">Kata Sandi</label>
                    <input id="password" type="password" name="password"
                           required autocomplete="new-password"
                           placeholder="Minimal 8 karakter"
                           class="km-input @error('password') border-brand-red/60 @enderror">
                    @error('password')
                    <p class="text-brand-red text-xs mt-1">{{ $message }}</p>
                    @enderror
                    <p class="text-brand-text-gray text-xs mt-1">Harus mengandung huruf besar, huruf kecil, dan angka.</p>
                </div>

                {{-- Confirm Password --}}
                <div>
                    <label for="password_confirmation" class="km-label">Konfirmasi Kata Sandi</label>
                    <input id="password_confirmation" type="password" name="password_confirmation"
                           required autocomplete="new-password"
                           placeholder="Ulangi kata sandi"
                           class="km-input">
                </div>
            </div>

            <button type="submit" class="btn-primary w-full justify-center mt-8 py-3.5">
                Buat Akun Admin
            </button>
        </form>
    </div>

    <div class="text-center mt-6">
        <a href="/admin" class="text-brand-text-gray hover:text-brand-red text-sm transition-colors">
            ← Ke Halaman Login Admin
        </a>
    </div>

    <p class="text-center text-brand-text-gray/40 text-xs mt-6">
        Halaman ini bersifat rahasia. Jangan bagikan URL ini.
    </p>
</div>

</body>
</html>
