<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="icon" type="image/x-icon" href="/favicon.ico">
<link rel="icon" type="image/png" sizes="32x32" href="/images/logo.png">
<link rel="apple-touch-icon" sizes="180x180" href="/images/logo.png">
<meta name="theme-color" content="#CC0000">
<meta property="og:site_name" content="Kerinci Motor">
<meta property="og:locale" content="id_ID">
<meta name="csrf-token" content="{{ csrf_token() }}">
<title>@yield('title', 'Kerinci Motor — Dealer Mobil Bekas Terpercaya Bekasi')</title>
<meta name="description" content="@yield('description', 'Dealer mobil bekas terpercaya Sejabodetabek. Bebas banjir, laka, dan terbakar.')">
<meta property="og:title" content="@yield('title', 'Kerinci Motor')">
<meta property="og:image" content="https://kerincimotor.com/images/og-default.jpg">

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
  "openingHours": "Mo-Sa 08:00-21:00",
  "description": "Dealer mobil bekas Bekasi. Kami beli mobil Anda dengan harga kompetitif, proses cepat, bayar tunai."
}
</script>

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Raleway:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/gsap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/ScrollTrigger.min.js"></script>

@vite(['resources/css/app.css', 'resources/js/app.js'])
@stack('styles')
<x-meta-pixel />

<style>
:root{--red:#CC0000;--black:#0A0A0A;--silver:#C0C0C0;--g50:#fafafa;--g100:#f4f4f5;--g200:#e5e7eb;--g400:#9ca3af;--g500:#6b7280;--g600:#4b5563;}
*,*::before,*::after{margin:0;padding:0;box-sizing:border-box;}
html{scroll-behavior:smooth;}
body{font-family:'Raleway',sans-serif;background:#fff;color:var(--black);overflow-x:hidden;cursor:none;}
@media(max-width:768px){body{cursor:auto;}}

#cursor-dot{width:8px;height:8px;background:var(--red);border-radius:50%;position:fixed;pointer-events:none;z-index:99999;transform:translate(-50%,-50%);}
#cursor-ring{width:36px;height:36px;border:2px solid rgba(204,0,0,0.5);border-radius:50%;position:fixed;pointer-events:none;z-index:99998;transform:translate(-50%,-50%);transition:width .3s,height .3s,background .3s;}
#cursor-ring.hovered{width:60px;height:60px;background:rgba(204,0,0,0.08);}
@media(max-width:768px){#cursor-dot,#cursor-ring{display:none;}}

#particle-canvas{position:fixed;inset:0;pointer-events:none;z-index:0;opacity:0.4;}
#page-curtain{position:fixed;inset:0;z-index:9000;background:var(--red);transform:scaleY(0);transform-origin:bottom;pointer-events:none;}

.orb{position:absolute;border-radius:9999px;filter:blur(90px);pointer-events:none;}
@keyframes orbFloat{0%,100%{transform:translate(0,0);}50%{transform:translate(20px,-20px);}}
@keyframes orbFloat2{0%,100%{transform:translate(0,0);}50%{transform:translate(-20px,15px);}}

.reveal{opacity:0;transform:translateY(40px);}
.reveal.in{opacity:1;transform:translateY(0);transition:opacity .8s ease,transform .8s cubic-bezier(0.34,1.2,0.64,1);}
.reveal-left{opacity:0;transform:translateX(-60px);}
.reveal-left.in{opacity:1;transform:translateX(0);transition:opacity .9s ease,transform .9s cubic-bezier(0.34,1.2,0.64,1);}
.reveal-right{opacity:0;transform:translateX(60px);}
.reveal-right.in{opacity:1;transform:translateX(0);transition:opacity .9s ease,transform .9s cubic-bezier(0.34,1.2,0.64,1);}
@media(max-width:768px){.reveal,.reveal-left,.reveal-right{opacity:1!important;transform:none!important;transition:none!important;}}

.tilt-card{transform-style:preserve-3d;transition:transform .15s ease;}
.tilt-shine{position:absolute;inset:0;border-radius:inherit;background:linear-gradient(135deg,rgba(255,255,255,0.15),transparent 60%);opacity:0;transition:opacity .3s;pointer-events:none;z-index:10;}
.tilt-card:hover .tilt-shine{opacity:1;}
@media(max-width:768px){.tilt-card{transform:none!important;}}

.glass{background:rgba(255,255,255,0.85);backdrop-filter:blur(24px);-webkit-backdrop-filter:blur(24px);border:1px solid rgba(255,255,255,0.5);}

.tgrad{background:linear-gradient(135deg,var(--black) 0%,var(--red) 100%);-webkit-background-clip:text;-webkit-text-fill-color:transparent;background-clip:text;}
.tgrad-anim{background:linear-gradient(90deg,var(--black),var(--red),var(--black));background-size:200%;-webkit-background-clip:text;-webkit-text-fill-color:transparent;background-clip:text;animation:shimmer 4s linear infinite;}
@keyframes shimmer{from{background-position:200%;}to{background-position:-200%;}}

.btn-red{background:var(--red);color:#fff;font-family:'Raleway',sans-serif;font-weight:800;border:none;cursor:pointer;display:inline-flex;align-items:center;gap:8px;position:relative;overflow:hidden;transition:transform .3s,box-shadow .3s;}
.btn-red:hover{transform:translateY(-3px);box-shadow:0 16px 40px rgba(204,0,0,0.35);}
.btn-outline{background:transparent;color:var(--black);font-family:'Raleway',sans-serif;font-weight:800;border:2px solid var(--black);cursor:pointer;transition:all .3s;position:relative;overflow:hidden;display:inline-flex;align-items:center;gap:8px;}
.btn-outline span{position:relative;z-index:1;}
.btn-outline::before{content:'';position:absolute;inset:0;background:var(--black);transform:scaleX(0);transform-origin:left;transition:transform .3s;z-index:0;}
.btn-outline:hover{color:#fff;}.btn-outline:hover::before{transform:scaleX(1);}

.badge-red{display:inline-flex;align-items:center;gap:7px;padding:7px 18px;border-radius:100px;background:rgba(204,0,0,0.07);border:1px solid rgba(204,0,0,0.18);color:var(--red);font-weight:800;font-size:.78rem;letter-spacing:.5px;animation:badgePulse 3s ease-in-out infinite;}
@keyframes badgePulse{0%,100%{box-shadow:0 0 0 0 rgba(204,0,0,0);}50%{box-shadow:0 0 0 6px rgba(204,0,0,0.08);}}

.car-card{transition:all .4s cubic-bezier(0.34,1.56,0.64,1);cursor:pointer;position:relative;}
.car-card:hover{transform:translateY(-12px);box-shadow:0 48px 96px rgba(0,0,0,0.15);}
.car-card .thumb img{transition:transform .6s;}
.car-card:hover .thumb img{transform:scale(1.1);}
.car-card .card-glow{position:absolute;inset:0;border-radius:inherit;background:radial-gradient(circle at 50% 0%,rgba(204,0,0,0.08),transparent 60%);opacity:0;transition:opacity .4s;pointer-events:none;}
.car-card:hover .card-glow{opacity:1;}

.marquee{overflow:hidden;white-space:nowrap;}
.mtrack{display:inline-flex;gap:80px;animation:mscroll 24s linear infinite;}
.mtrack2{display:inline-flex;gap:80px;animation:mscroll 20s linear infinite reverse;}
@keyframes mscroll{from{transform:translateX(0);}to{transform:translateX(-50%);}}

.cd-box{background:var(--black);border-radius:12px;padding:10px 14px;text-align:center;min-width:56px;position:relative;overflow:hidden;}
.cd-box::before{content:'';position:absolute;inset:0;background:linear-gradient(135deg,rgba(204,0,0,0.3),transparent);opacity:.6;}
.cd-num{font-size:1.75rem;font-weight:900;line-height:1;color:#fff;position:relative;z-index:1;}
.cd-lbl{font-size:.62rem;font-weight:700;color:rgba(255,255,255,0.5);letter-spacing:1px;text-transform:uppercase;margin-top:3px;position:relative;z-index:1;}

.ttrack{display:inline-flex;gap:24px;animation:mscroll 30s linear infinite;}
.ttrack:hover{animation-play-state:paused;}

.vcard{transition:all .4s cubic-bezier(0.34,1.56,0.64,1);cursor:pointer;}
.vcard:hover{transform:translateY(-10px) scale(1.02);box-shadow:0 32px 64px rgba(0,0,0,0.15);}

.finput{width:100%;border:2px solid var(--g200);border-radius:14px;padding:13px 17px;font-family:'Raleway',sans-serif;font-size:.95rem;outline:none;transition:all .3s;background:#fff;font-weight:500;}
.finput:focus{border-color:var(--red);box-shadow:0 0 0 5px rgba(204,0,0,0.08);}
.flabel{display:block;font-weight:700;font-size:.78rem;color:var(--g600);margin-bottom:7px;letter-spacing:.3px;text-transform:uppercase;}

.step-pane{display:none;}.step-pane.on{display:block;animation:stepIn .4s ease;}
@keyframes stepIn{from{opacity:0;transform:translateX(30px);}to{opacity:1;transform:translateX(0);}}
.sind{width:40px;height:40px;border-radius:50%;display:flex;align-items:center;justify-content:center;font-weight:900;font-size:.875rem;transition:all .4s;}
.sind.done{background:var(--red);color:#fff;}.sind.cur{background:var(--black);color:#fff;}.sind.pend{background:var(--g200);color:var(--g400);}

.pill{display:inline-flex;align-items:center;padding:9px 22px;border-radius:100px;font-weight:700;font-size:.875rem;cursor:pointer;transition:all .3s;border:2px solid transparent;text-decoration:none;}
.pill.on{background:var(--black);color:#fff;transform:scale(1.04);}
.pill.off{background:#fff;color:var(--black);border-color:var(--g200);}
.pill.off:hover{border-color:var(--black);}

.gallery-thumb{cursor:pointer;border-radius:12px;overflow:hidden;border:2px solid transparent;transition:all .25s;}
.gallery-thumb.active,.gallery-thumb:hover{border-color:var(--red);transform:scale(1.04);}
.gallery-thumb img{width:100%;height:72px;object-fit:cover;display:block;}

.spec-row{display:grid;grid-template-columns:1fr 1fr;padding:13px 0;border-bottom:1px solid var(--g100);}
.spec-row:hover{background:var(--g50);padding-left:8px;transition:all .2s;}.spec-row:last-child{border-bottom:none;}
.spec-key{font-weight:700;font-size:.875rem;color:var(--g500);}
.spec-val{font-weight:800;font-size:.875rem;text-align:right;}

::-webkit-scrollbar{width:6px;}::-webkit-scrollbar-track{background:var(--g50);}::-webkit-scrollbar-thumb{background:var(--red);border-radius:3px;}

#rdprog{position:fixed;top:72px;left:0;height:3px;background:linear-gradient(90deg,#CC0000,#ff4444,#ff6600);width:0;z-index:9999;box-shadow:0 0 10px rgba(204,0,0,0.6),0 0 20px rgba(204,0,0,0.3);transition:width .1s linear;}

#wafloat{position:fixed;bottom:28px;right:28px;z-index:500;width:60px;height:60px;border-radius:50%;background:#25D366;border:none;cursor:pointer;box-shadow:0 8px 24px rgba(37,211,102,0.4);display:flex;align-items:center;justify-content:center;font-size:1.75rem;transition:all .3s;animation:waPulse 3s ease-in-out infinite;}
#wafloat:hover{transform:scale(1.12);}
@keyframes waPulse{0%,100%{box-shadow:0 8px 24px rgba(37,211,102,0.5);}50%{box-shadow:0 8px 24px rgba(37,211,102,0.5),0 0 0 12px rgba(37,211,102,0.12);}}

.noise{position:relative;}
.noise::after{content:'';position:absolute;inset:0;opacity:.035;pointer-events:none;border-radius:inherit;background-image:url("data:image/svg+xml,%3Csvg viewBox='0 0 200 200' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='n'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.85' numOctaves='4' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23n)'/%3E%3C/svg%3E");}

#vmodal{display:none;position:fixed;inset:0;z-index:2000;background:rgba(0,0,0,0.93);backdrop-filter:blur(12px);align-items:center;justify-content:center;}
#vmodal.open{display:flex;}

.section-tag{color:var(--red);font-weight:800;font-size:.78rem;letter-spacing:2.5px;text-transform:uppercase;margin-bottom:12px;display:flex;align-items:center;gap:10px;}
.section-tag::before{content:'';display:block;width:24px;height:2px;background:var(--red);}

#mnav{display:none;position:fixed;inset:0;z-index:999;background:rgba(255,255,255,0.97);backdrop-filter:blur(24px);padding:90px 36px 36px;flex-direction:column;gap:28px;overflow-y:auto;}
#mnav.open{display:flex;}

/* 4B — split char */
.split-char{display:inline-block;opacity:0;transform:translateY(60px) rotate(6deg);transition:opacity .6s ease,transform .6s cubic-bezier(0.34,1.4,0.64,1);}
.split-char.in{opacity:1;transform:translateY(0) rotate(0);}

/* 4E — card glow follow mouse */
.car-card::after{content:'';position:absolute;inset:0;border-radius:inherit;background:radial-gradient(280px circle at var(--mouse-x,50%) var(--mouse-y,50%),rgba(204,0,0,0.10),transparent 80%);opacity:0;transition:opacity .4s;pointer-events:none;z-index:1;}
.car-card:hover::after{opacity:1;}

/* 4G — hero float */
@keyframes heroFloat{0%,100%{transform:translateY(0) scale(1);}33%{transform:translateY(-12px) scale(1.005);}66%{transform:translateY(-6px) scale(1.003);}}
.hero-float{animation:heroFloat 7s ease-in-out infinite;}

/* 4H — noise shift */
@keyframes noiseShift{0%{background-position:0 0;}25%{background-position:40px -20px;}50%{background-position:-30px 30px;}75%{background-position:20px 40px;}100%{background-position:0 0;}}
.noise::after{animation:noiseShift 8s steps(4,end) infinite!important;}

/* 4E2 — section entrance */
@keyframes sectionIn{from{opacity:0;}to{opacity:1;}}
section{animation:sectionIn .5s ease forwards;}

/* hover-lift utility */
.hover-lift{transition:transform .3s cubic-bezier(0.34,1.56,0.64,1),box-shadow .3s;}
.hover-lift:hover{transform:translateY(-8px);box-shadow:0 24px 48px rgba(0,0,0,0.12);}

/* badge-red shine sweep */
.badge-red::after{content:'';position:absolute;top:0;left:-100%;width:100%;height:100%;background:linear-gradient(90deg,transparent,rgba(255,255,255,0.3),transparent);animation:badgeShine 3s ease-in-out infinite;pointer-events:none;}
@keyframes badgeShine{0%{left:-100%;}50%{left:100%;}100%{left:100%;}}

/* card shine on hover */
.car-card:hover::before{content:'';position:absolute;top:0;left:-75%;width:50%;height:100%;background:linear-gradient(90deg,transparent,rgba(255,255,255,0.15),transparent);transform:skewX(-15deg);animation:cardShine .6s ease forwards;z-index:5;pointer-events:none;}
@keyframes cardShine{from{left:-75%;}to{left:125%;}}

/* 4I — gradient border button */
.btn-gradient-border{position:relative;background:#fff;color:var(--black);font-family:'Raleway',sans-serif;font-weight:800;border:none;cursor:pointer;display:inline-flex;align-items:center;gap:8px;padding:16px 36px;border-radius:100px;font-size:1rem;text-decoration:none;z-index:0;}
.btn-gradient-border::before{content:'';position:absolute;inset:-2px;border-radius:100px;background:linear-gradient(90deg,var(--red),#ff6b35,var(--red));background-size:200%;animation:gradBorder 3s linear infinite;z-index:-1;}
.btn-gradient-border::after{content:'';position:absolute;inset:1px;border-radius:100px;background:#fff;z-index:-1;}
@keyframes gradBorder{from{background-position:0%;}to{background-position:200%;}}
.btn-gradient-border:hover{transform:translateY(-3px);}

/* F — cursor glow trail */
.cursor-glow{position:fixed;width:300px;height:300px;border-radius:50%;background:radial-gradient(circle,rgba(204,0,0,0.07) 0%,transparent 70%);pointer-events:none;z-index:1;transform:translate(-50%,-50%);transition:left .12s ease,top .12s ease;}

/* G — clip-path reveal (sui.io style) */
.clip-reveal{clip-path:inset(0 100% 0 0);transition:clip-path 1.1s cubic-bezier(0.77,0,0.175,1);}
.clip-reveal.in{clip-path:inset(0 0% 0 0);}

/* H — floating card animations */
@keyframes floatCard{0%,100%{transform:translateY(0px) rotate(0deg);}25%{transform:translateY(-8px) rotate(0.3deg);}50%{transform:translateY(-4px) rotate(-0.2deg);}75%{transform:translateY(-10px) rotate(0.4deg);}}
.float-card{animation:floatCard 5s ease-in-out infinite;}
@keyframes floatCardAlt{0%,100%{transform:translateY(0px) translateX(0px);}33%{transform:translateY(-6px) translateX(4px);}66%{transform:translateY(4px) translateX(-3px);}}
.float-card-alt{animation:floatCardAlt 7s ease-in-out infinite;}

/* J — page load entrance */
@keyframes pageLoad{from{opacity:0;transform:translateY(12px);}to{opacity:1;transform:translateY(0);}}
#navbar{animation:pageLoad .6s ease forwards;}
</style>
</head>
<body>

<canvas id="particle-canvas"></canvas>
<div id="cursor-dot"></div>
<div id="cursor-ring"></div>
<div id="page-curtain"></div>
<div id="rdprog"></div>

{{-- VIDEO MODAL --}}
<div id="vmodal">
  <div style="position:relative;width:90%;max-width:920px;">
    <button onclick="closeVid()" style="position:absolute;top:-48px;right:0;background:none;border:none;color:#fff;font-size:1.8rem;cursor:pointer;font-weight:900;transition:transform .3s;" onmouseover="this.style.transform='rotate(90deg)'" onmouseout="this.style.transform=''">✕</button>
    <div style="border-radius:24px;overflow:hidden;aspect-ratio:16/9;box-shadow:0 40px 80px rgba(0,0,0,0.6);">
      <iframe id="ytf" width="100%" height="100%" src="" frameborder="0" allowfullscreen style="display:block;"></iframe>
    </div>
  </div>
</div>

{{-- MOBILE NAV --}}
<div id="mnav">
  <img src="/images/logo.png" alt="Kerinci Motor" style="height:40px;width:auto;object-fit:contain;">
  <div style="display:flex;flex-direction:column;gap:20px;">
    <a href="{{ route('inventory.index') }}" style="font-family:'Raleway',sans-serif;font-weight:700;font-size:1.2rem;color:var(--black);text-decoration:none;" onclick="document.getElementById('mnav').classList.remove('open')">Mobil <span style="color:var(--red);font-weight:900;">HOT DEALS!</span></a>
    <a href="{{ route('home') }}#financing" style="font-family:'Raleway',sans-serif;font-weight:700;font-size:1.2rem;color:var(--black);text-decoration:none;" onclick="document.getElementById('mnav').classList.remove('open')">Simulasi Cicilan</a>
    <a href="{{ route('video.index') }}" style="font-family:'Raleway',sans-serif;font-weight:700;font-size:1.2rem;color:var(--black);text-decoration:none;" onclick="document.getElementById('mnav').classList.remove('open')">Video Review</a>
    <a href="{{ route('tips.index') }}" style="font-family:'Raleway',sans-serif;font-weight:700;font-size:1.2rem;color:var(--black);text-decoration:none;" onclick="document.getElementById('mnav').classList.remove('open')">Tips & Trick</a>
    <a href="{{ route('sell.index') }}" style="font-family:'Raleway',sans-serif;font-weight:700;font-size:1.2rem;color:var(--black);text-decoration:none;" onclick="document.getElementById('mnav').classList.remove('open')">Jual Mobil Anda</a>
  </div>
  <a href="{{ route('whatsapp') }}" target="_blank" rel="noopener" class="btn-red" style="padding:16px 32px;border-radius:100px;font-size:.95rem;justify-content:center;text-decoration:none;">💬 WhatsApp</a>
</div>

{{-- NAVBAR --}}
<header id="navbar" style="position:fixed;top:0;left:0;right:0;z-index:1000;background:rgba(255,255,255,0.93);backdrop-filter:blur(28px);-webkit-backdrop-filter:blur(28px);border-bottom:1px solid rgba(0,0,0,0.06);transition:box-shadow .4s;">
  <div style="max-width:1280px;margin:0 auto;padding:0 24px;height:72px;display:flex;align-items:center;justify-content:space-between;">
    <a href="{{ route('home') }}" style="display:flex;align-items:center;text-decoration:none;">
      <img src="/images/logo.png" alt="Kerinci Motor" style="height:44px;width:auto;object-fit:contain;">
    </a>
    <nav style="display:flex;align-items:center;gap:28px;" id="desknav">
      <a href="{{ route('inventory.index') }}" style="font-family:'Raleway',sans-serif;font-weight:700;font-size:.875rem;color:var(--black);text-decoration:none;transition:.2s;" onmouseover="this.style.color='var(--red)'" onmouseout="this.style.color='var(--black)'">Mobil <span style="color:var(--red);font-weight:900;">HOT!</span></a>
      <a href="{{ route('home') }}#financing" style="font-family:'Raleway',sans-serif;font-weight:700;font-size:.875rem;color:var(--black);text-decoration:none;transition:.2s;" onmouseover="this.style.color='var(--red)'" onmouseout="this.style.color='var(--black)'">Simulasi Cicilan</a>
      <a href="{{ route('video.index') }}" style="font-family:'Raleway',sans-serif;font-weight:700;font-size:.875rem;color:var(--black);text-decoration:none;transition:.2s;" onmouseover="this.style.color='var(--red)'" onmouseout="this.style.color='var(--black)'">Video Review</a>
      <a href="{{ route('tips.index') }}" style="font-family:'Raleway',sans-serif;font-weight:700;font-size:.875rem;color:var(--black);text-decoration:none;transition:.2s;" onmouseover="this.style.color='var(--red)'" onmouseout="this.style.color='var(--black)'">Tips & Trick</a>
      <a href="{{ route('sell.index') }}" style="font-family:'Raleway',sans-serif;font-weight:700;font-size:.875rem;color:var(--black);text-decoration:none;transition:.2s;" onmouseover="this.style.color='var(--red)'" onmouseout="this.style.color='var(--black)'">Jual Mobil</a>
    </nav>
    <div style="display:flex;align-items:center;gap:12px;">
      <a href="{{ route('whatsapp') }}" target="_blank" rel="noopener" class="btn-red" style="padding:11px 22px;border-radius:100px;font-size:.85rem;text-decoration:none;" id="navwa">💬 WhatsApp</a>
      <button id="hbg" onclick="document.getElementById('mnav').classList.toggle('open')" style="display:none;background:none;border:none;cursor:pointer;flex-direction:column;gap:5px;padding:4px;">
        <span style="display:block;width:24px;height:2px;background:var(--black);border-radius:2px;"></span>
        <span style="display:block;width:18px;height:2px;background:var(--black);border-radius:2px;"></span>
        <span style="display:block;width:24px;height:2px;background:var(--black);border-radius:2px;"></span>
      </button>
    </div>
  </div>
</header>
<style>@media(max-width:1024px){#desknav,#navwa{display:none!important;}#hbg{display:flex!important;}}</style>

<main>@yield('content')</main>

{{-- FOOTER --}}
<footer style="background:var(--black);color:#fff;padding:72px 0 28px;position:relative;overflow:hidden;" class="noise">
  <div class="orb" style="width:500px;height:500px;background:rgba(204,0,0,0.07);top:-100px;right:-100px;animation:orbFloat 16s ease-in-out infinite;"></div>
  <div style="max-width:1280px;margin:0 auto;padding:0 24px;position:relative;z-index:10;">
    <div style="display:grid;grid-template-columns:1.5fr 1fr 1fr 1.5fr;gap:44px;margin-bottom:56px;" class="ft-grid">
      <div>
        <div style="font-weight:900;font-size:1.4rem;margin-bottom:14px;font-family:'Raleway',sans-serif;">KERINCI<span style="color:var(--red)">MOTOR</span></div>
        <p style="color:rgba(255,255,255,.35);line-height:1.7;font-size:.875rem;margin-bottom:20px;font-weight:500;">Dealer mobil bekas terpercaya Sejabodetabek. Bebas banjir, laka, dan terbakar.</p>
        <div style="display:flex;gap:10px;">
          <a href="https://instagram.com/kerincimotor" target="_blank" rel="noopener"
             style="width:42px;height:42px;border-radius:11px;display:flex;align-items:center;justify-content:center;text-decoration:none;transition:.3s;background:radial-gradient(circle at 30% 107%, #fdf497 0%, #fdf497 5%, #fd5949 45%, #d6249f 60%, #285AEB 90%);"
             onmouseover="this.style.transform='translateY(-3px) scale(1.1)'"
             onmouseout="this.style.transform=''">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="white" xmlns="http://www.w3.org/2000/svg">
              <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zM12 0C8.741 0 8.333.014 7.053.072 2.695.272.273 2.69.073 7.052.014 8.333 0 8.741 0 12c0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98C8.333 23.986 8.741 24 12 24c3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98C15.668.014 15.259 0 12 0zm0 5.838a6.162 6.162 0 100 12.324 6.162 6.162 0 000-12.324zM12 16a4 4 0 110-8 4 4 0 010 8zm6.406-11.845a1.44 1.44 0 100 2.881 1.44 1.44 0 000-2.881z"/>
            </svg>
          </a>
          <a href="https://wa.me/6287776700009" target="_blank" rel="noopener"
             style="width:42px;height:42px;border-radius:11px;display:flex;align-items:center;justify-content:center;text-decoration:none;transition:.3s;background:#25D366;"
             onmouseover="this.style.transform='translateY(-3px) scale(1.1)'"
             onmouseout="this.style.transform=''">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="white" xmlns="http://www.w3.org/2000/svg">
              <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/>
            </svg>
          </a>
        </div>
      </div>
      <div>
        <div style="font-weight:900;margin-bottom:18px;font-size:.95rem;font-family:'Raleway',sans-serif;">Menu</div>
        <div style="display:flex;flex-direction:column;gap:11px;font-size:.875rem;font-weight:600;">
          <a href="{{ route('inventory.index') }}" style="color:rgba(255,255,255,.35);text-decoration:none;transition:.2s;" onmouseover="this.style.color='#fff'" onmouseout="this.style.color='rgba(255,255,255,.35)'">Flash Sale / Inventory</a>
          <a href="{{ route('video.index') }}" style="color:rgba(255,255,255,.35);text-decoration:none;transition:.2s;" onmouseover="this.style.color='#fff'" onmouseout="this.style.color='rgba(255,255,255,.35)'">Video Review</a>
          <a href="{{ route('tips.index') }}" style="color:rgba(255,255,255,.35);text-decoration:none;transition:.2s;" onmouseover="this.style.color='#fff'" onmouseout="this.style.color='rgba(255,255,255,.35)'">Tips & Trick</a>
          <a href="{{ route('sell.index') }}" style="color:rgba(255,255,255,.35);text-decoration:none;transition:.2s;" onmouseover="this.style.color='#fff'" onmouseout="this.style.color='rgba(255,255,255,.35)'">Jual Mobil</a>
          <a href="{{ route('home') }}#financing" style="color:rgba(255,255,255,.35);text-decoration:none;transition:.2s;" onmouseover="this.style.color='#fff'" onmouseout="this.style.color='rgba(255,255,255,.35)'">Simulasi Cicilan</a>
        </div>
      </div>
      <div>
        <div style="font-weight:900;margin-bottom:18px;font-size:.95rem;font-family:'Raleway',sans-serif;">Kontak</div>
        <div style="display:flex;flex-direction:column;gap:11px;color:rgba(255,255,255,.35);font-size:.875rem;font-weight:600;line-height:1.6;">
          <div>📞 0877-7670-0009</div>
          <div>📧 kerincimotor.info@gmail.com</div>
          <div>📍 Jl. Mustika Jaya RT.006/012<br>Mustikajaya, Bekasi 17158</div>
        </div>
      </div>
      <div>
        <div style="font-weight:900;margin-bottom:18px;font-size:.95rem;font-family:'Raleway',sans-serif;">Chat Langsung</div>
        <p style="color:rgba(255,255,255,.35);font-size:.85rem;margin-bottom:14px;line-height:1.6;font-weight:500;">Tanya stok, harga, atau jadwalkan kunjungan.</p>
        <a href="{{ route('whatsapp') }}" target="_blank" rel="noopener" class="btn-red" style="width:100%;padding:13px;border-radius:100px;justify-content:center;font-size:.875rem;text-decoration:none;display:flex;">💬 WhatsApp Sekarang</a>
      </div>
    </div>
    <div style="border-top:1px solid rgba(255,255,255,.07);padding-top:24px;display:flex;justify-content:space-between;align-items:center;flex-wrap:wrap;gap:10px;">
      <div style="color:rgba(255,255,255,.25);font-size:.78rem;font-weight:600;">© {{ date('Y') }} Kerinci Motor. All rights reserved.</div>
      <div style="color:rgba(255,255,255,.25);font-size:.78rem;font-weight:600;">Jual-Beli Mobil Bekas · Sejabodetabek</div>
    </div>
  </div>
  <style>@media(max-width:1024px){.ft-grid{grid-template-columns:1fr 1fr!important;}}@media(max-width:640px){.ft-grid{grid-template-columns:1fr!important;}}</style>
</footer>

<button id="wafloat" onclick="window.open('{{ route('whatsapp') }}','_blank')" title="Chat WhatsApp">💬</button>

@stack('scripts')

<script>
(function(){
  // CURSOR
  var dot=document.getElementById('cursor-dot'),ring=document.getElementById('cursor-ring'),mx=0,my=0,rx=0,ry=0;
  document.addEventListener('mousemove',function(e){mx=e.clientX;my=e.clientY;dot.style.left=mx+'px';dot.style.top=my+'px';});
  function animRing(){rx+=(mx-rx)*.12;ry+=(my-ry)*.12;ring.style.left=rx+'px';ring.style.top=ry+'px';requestAnimationFrame(animRing);}
  animRing();
  document.querySelectorAll('a,button,.car-card,.vcard,.pill,.gallery-thumb').forEach(function(el){
    el.addEventListener('mouseenter',function(){ring.classList.add('hovered');});
    el.addEventListener('mouseleave',function(){ring.classList.remove('hovered');});
  });

  // F — CURSOR GLOW TRAIL
  var glowEl=document.createElement('div');
  glowEl.className='cursor-glow';
  document.body.appendChild(glowEl);
  document.addEventListener('mousemove',function(e){glowEl.style.left=e.clientX+'px';glowEl.style.top=e.clientY+'px';});

  // PARTICLES
  var canvas=document.getElementById('particle-canvas');
  if(canvas){
    var ctx=canvas.getContext('2d'),W,H,pts=[];
    function rsz(){W=canvas.width=window.innerWidth;H=canvas.height=window.innerHeight;}
    rsz();window.addEventListener('resize',rsz);
    for(var i=0;i<45;i++)pts.push({x:Math.random()*1600,y:Math.random()*1000,vx:(Math.random()-.5)*.25,vy:-Math.random()*.35-.1,r:Math.random()*2+.5,o:Math.random()*.25+.05});
    function draw(){
      ctx.clearRect(0,0,W,H);
      pts.forEach(function(p){
        p.x+=p.vx;p.y+=p.vy;
        if(p.y<-10){p.y=H+10;p.x=Math.random()*W;}
        if(p.x<-10)p.x=W+10;if(p.x>W+10)p.x=-10;
        ctx.beginPath();ctx.arc(p.x,p.y,p.r,0,Math.PI*2);
        ctx.fillStyle='rgba(204,0,0,'+p.o+')';ctx.fill();
      });
      requestAnimationFrame(draw);
    }
    draw();
  }

  // TILT
  function initTilt(){
    if(window.innerWidth<=768)return;
    document.querySelectorAll('.tilt-card').forEach(function(card){
      card.addEventListener('mousemove',function(e){
        var r=card.getBoundingClientRect(),x=(e.clientX-r.left)/r.width-.5,y=(e.clientY-r.top)/r.height-.5;
        card.style.transform='perspective(1200px) rotateY('+(x*10)+'deg) rotateX('+(-y*10)+'deg) scale(1.02)';
      });
      card.addEventListener('mouseleave',function(){card.style.transform='perspective(1200px) rotateY(0) rotateX(0) scale(1)';});
    });
  }

  // REVEAL + CLIP-REVEAL (G)
  function initReveal(){
    if(!window.IntersectionObserver)return;
    var obs=new IntersectionObserver(function(entries){
      entries.forEach(function(e,i){if(e.isIntersecting){setTimeout(function(){e.target.classList.add('in');},i*80);obs.unobserve(e.target);}});
    },{threshold:.08});
    document.querySelectorAll('.reveal,.reveal-left,.reveal-right,.clip-reveal').forEach(function(el){obs.observe(el);});
  }

  // A — WORD-BY-WORD REVEAL
  function initWordReveal(){
    document.querySelectorAll('.word-reveal').forEach(function(el){
      if(el.dataset.split)return;
      el.dataset.split='1';
      if(!el.querySelector('span,br,a')){
        var words=el.textContent.trim().split(/\s+/);
        el.innerHTML=words.map(function(w,i){
          return '<span style="display:inline-block;opacity:0;transform:translateY(30px);transition:opacity .5s ease '+(i*.08)+'s,transform .5s cubic-bezier(0.34,1.2,0.64,1) '+(i*.08)+'s">'+w+'</span>';
        }).join(' ');
      }
      var obs=new IntersectionObserver(function(entries){
        entries.forEach(function(e){
          if(e.isIntersecting){
            e.target.querySelectorAll('span').forEach(function(s){s.style.opacity='1';s.style.transform='translateY(0)';});
            obs.unobserve(e.target);
          }
        });
      },{threshold:.3});
      obs.observe(el);
    });
  }

  // B — MOUSE PARALLAX ON HERO
  function initParallax(){
    var hero=document.getElementById('hero-section');
    if(!hero||window.innerWidth<=900)return;
    document.addEventListener('mousemove',function(e){
      var x=(e.clientX/window.innerWidth-.5)*20,y=(e.clientY/window.innerHeight-.5)*20;
      var img=document.getElementById('hero-main-img');
      if(img)img.style.transform='scale(1.05) translate('+(x*.3)+'px,'+(y*.3)+'px)';
      hero.querySelectorAll('.orb').forEach(function(orb,i){
        orb.style.transform='translate('+((i+1)*.18*x)+'px,'+((i+1)*.18*y)+'px)';
      });
    });
  }

  // NAVBAR SCROLL + PROGRESS
  window.addEventListener('scroll',function(){
    document.getElementById('navbar').style.boxShadow=window.scrollY>20?'0 4px 40px rgba(0,0,0,0.1)':'none';
    var prog=document.getElementById('rdprog');
    if(prog){var h=document.body.scrollHeight-window.innerHeight;prog.style.width=(h>0?Math.round(window.scrollY/h*100):0)+'%';}
  });

  // VIDEO MODAL
  window.openVid=function(url){document.getElementById('ytf').src=url+'?autoplay=1&rel=0';document.getElementById('vmodal').classList.add('open');document.body.style.overflow='hidden';};
  window.closeVid=function(){document.getElementById('ytf').src='';document.getElementById('vmodal').classList.remove('open');document.body.style.overflow='';};
  var vm=document.getElementById('vmodal');
  if(vm)vm.addEventListener('click',function(e){if(e.target===this)closeVid();});

  // SMOOTH SCROLL for anchor links
  document.querySelectorAll('a[href^="#"]').forEach(function(a){
    a.addEventListener('click',function(e){
      var target=document.querySelector(a.getAttribute('href'));
      if(target){e.preventDefault();target.scrollIntoView({behavior:'smooth',block:'start'});}
    });
  });

  // STAGGERED GRID ANIMATION
  function initStagger(){
    document.querySelectorAll('[data-stagger]').forEach(function(grid){
      var items=grid.children;
      var obs=new IntersectionObserver(function(entries){
        entries.forEach(function(e){
          if(e.isIntersecting){
            Array.from(items).forEach(function(item,i){
              setTimeout(function(){item.style.opacity='1';item.style.transform='translateY(0)';},i*100);
            });
            obs.unobserve(e.target);
          }
        });
      },{threshold:.08});
      Array.from(items).forEach(function(item){
        item.style.opacity='0';item.style.transform='translateY(30px)';
        item.style.transition='opacity .6s ease,transform .6s cubic-bezier(0.34,1.2,0.64,1)';
      });
      obs.observe(grid);
    });
  }

  // NAVBAR ACTIVE LINK
  (function(){
    var path=window.location.pathname;
    document.querySelectorAll('#desknav a').forEach(function(link){
      if(link.getAttribute('href')===path){link.style.color='var(--red)';link.style.fontWeight='900';}
    });
  })();

  // IMAGE LAZY FADE
  (function(){
    if(!window.IntersectionObserver)return;
    var imgObs=new IntersectionObserver(function(entries){
      entries.forEach(function(e){
        if(e.isIntersecting){
          var img=e.target;
          img.style.transition='opacity .6s ease';
          if(img.complete){img.style.opacity='1';}
          else{img.style.opacity='0';img.onload=function(){img.style.opacity='1';};}
          imgObs.unobserve(img);
        }
      });
    },{threshold:.1});
    document.querySelectorAll('img[loading="lazy"]').forEach(function(img){imgObs.observe(img);});
  })();

  // E — MAGNETIC BUTTONS (enhanced)
  function initMagnetic(){
    if(window.innerWidth<=768)return;
    document.querySelectorAll('.btn-red,.btn-outline,.btn-gradient-border').forEach(function(btn){
      btn.addEventListener('mousemove',function(e){
        var r=btn.getBoundingClientRect(),x=(e.clientX-r.left-r.width/2)*.2,y=(e.clientY-r.top-r.height/2)*.2;
        btn.style.transform='translate('+x+'px,'+y+'px) translateY(-3px)';
        btn.style.transition='transform .1s ease';
      });
      btn.addEventListener('mouseleave',function(){
        btn.style.transform='';
        btn.style.transition='transform .5s cubic-bezier(0.34,1.56,0.64,1)';
      });
    });
  }

  // 4B — SPLIT TEXT
  window.splitText=function(el){
    if(!el||el.dataset.split)return;
    el.dataset.split='1';
    var words=el.innerText.split(' ');
    el.innerHTML=words.map(function(w,wi){
      return w.split('').map(function(c,ci){
        return '<span class="split-char" style="transition-delay:'+(wi*60+ci*30)+'ms">'+c+'</span>';
      }).join('')+' ';
    }).join('');
  };

  // 4C — COUNTER ANIMATION
  function animCounter(el){
    var target=parseFloat(el.dataset.counter),duration=1600,start=null,isFloat=String(target).includes('.');
    requestAnimationFrame(function tick(ts){
      if(!start)start=ts;
      var p=Math.min((ts-start)/duration,1),ease=1-Math.pow(1-p,4),val=target*ease;
      el.textContent=(isFloat?val.toFixed(1):Math.floor(val))+(el.dataset.suffix||'');
      if(p<1)requestAnimationFrame(tick);
    });
  }
  function initCounters(){
    if(!window.IntersectionObserver)return;
    var obs=new IntersectionObserver(function(entries){
      entries.forEach(function(e){if(e.isIntersecting){animCounter(e.target);obs.unobserve(e.target);}});
    },{threshold:.5});
    document.querySelectorAll('[data-counter]').forEach(function(el){obs.observe(el);});
  }

  // C — GSAP SCROLL ANIMATIONS (enhanced)
  function initGSAPAnimations(){
    if(typeof gsap==='undefined'||typeof ScrollTrigger==='undefined')return;
    gsap.registerPlugin(ScrollTrigger);

    // Orb parallax
    gsap.utils.toArray('.orb').forEach(function(orb,i){
      gsap.to(orb,{y:i%2===0?-100:80,ease:'none',scrollTrigger:{trigger:orb.parentElement,start:'top bottom',end:'bottom top',scrub:1.5}});
    });

    // Car cards stagger entrance
    gsap.utils.toArray('.car-card').forEach(function(card,i){
      gsap.fromTo(card,{y:80,opacity:0},{y:0,opacity:1,duration:.9,ease:'power3.out',delay:(i%3)*.1,scrollTrigger:{trigger:card,start:'top 88%',toggleActions:'play none none none'}});
    });

    // Section h2 slide in (skip hero)
    gsap.utils.toArray('h2').forEach(function(h){
      if(h.closest('#hero-section'))return;
      gsap.fromTo(h,{x:-40,opacity:0},{x:0,opacity:1,duration:1,ease:'power3.out',scrollTrigger:{trigger:h,start:'top 82%'}});
    });

    // Marquee speed boost on scroll
    var marquees=document.querySelectorAll('.mtrack');
    if(marquees.length){
      ScrollTrigger.create({trigger:marquees[0].parentElement,start:'top bottom',end:'bottom top',onUpdate:function(self){
        var vel=self.getVelocity()/1000;
        marquees.forEach(function(m){
          var cur=parseFloat(m.style.animationDuration)||24;
          m.style.animationDuration=Math.max(5,cur-vel)+'s';
          setTimeout(function(){m.style.animationDuration='';},300);
        });
      }});
    }
  }

  // 4E — CAR CARD GLOW MOUSE FOLLOW
  function initCardGlow(){
    document.querySelectorAll('.car-card').forEach(function(card){
      card.addEventListener('mousemove',function(e){
        var r=card.getBoundingClientRect();
        card.style.setProperty('--mouse-x',(e.clientX-r.left)+'px');
        card.style.setProperty('--mouse-y',(e.clientY-r.top)+'px');
      });
    });
  }

  document.addEventListener('DOMContentLoaded',function(){initReveal();initTilt();initMagnetic();initCounters();initGSAPAnimations();initCardGlow();initStagger();initWordReveal();initParallax();});
})();
</script>
</body>
</html>
