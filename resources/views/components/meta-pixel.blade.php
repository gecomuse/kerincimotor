{{--
    Meta Pixel base component.
    Only renders in production (APP_ENV=production).

    Place @include('components.meta-pixel') inside <head>.
    Add @stack('pixel_noscript') immediately after <body> opens.
--}}
@production
@php $pixelId = config('services.meta_pixel.id'); @endphp
@if($pixelId)
<!-- Meta Pixel Code -->
<script>
!function(f,b,e,v,n,t,s)
{if(f.fbq)return;n=f.fbq=function(){n.callMethod?
n.callMethod.apply(n,arguments):n.queue.push(arguments)};
if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
n.queue=[];t=b.createElement(e);t.async=!0;
t.src=v;s=b.getElementsByTagName(e)[0];
s.parentNode.insertBefore(t,s)}(window, document,'script',
'https://connect.facebook.net/en_US/fbevents.js');
fbq('init', '{{ $pixelId }}');
fbq('track', 'PageView');
</script>
<!-- End Meta Pixel Code -->
@push('pixel_noscript')
<noscript><img height="1" width="1" style="display:none"
src="https://www.facebook.com/tr?id={{ $pixelId }}&ev=PageView&noscript=1"
/></noscript>
@endpush
@endif
@endproduction
