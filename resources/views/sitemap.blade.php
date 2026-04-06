<?php echo '<?xml version="1.0" encoding="UTF-8"?>'; ?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"
        xmlns:image="http://www.google.com/schemas/sitemap-image/1.1">

  <url>
    <loc>{{ url('/') }}</loc>
    <lastmod>{{ now()->toIso8601String() }}</lastmod>
    <changefreq>weekly</changefreq>
    <priority>1.0</priority>
  </url>

  <url>
    <loc>{{ url('/katalog') }}</loc>
    <changefreq>daily</changefreq>
    <priority>0.9</priority>
  </url>

  <url>
    <loc>{{ url('/video') }}</loc>
    <changefreq>weekly</changefreq>
    <priority>0.7</priority>
  </url>

  <url>
    <loc>{{ url('/artikel') }}</loc>
    <changefreq>weekly</changefreq>
    <priority>0.8</priority>
  </url>

  <url>
    <loc>{{ url('/jual-mobil') }}</loc>
    <changefreq>monthly</changefreq>
    <priority>0.6</priority>
  </url>

  <url>
    <loc>{{ url('/lokasi') }}</loc>
    <changefreq>monthly</changefreq>
    <priority>0.5</priority>
  </url>

  @foreach($posts as $post)
  <url>
    <loc>{{ route('artikel.show', $post->slug) }}</loc>
    <lastmod>{{ $post->updated_at->toIso8601String() }}</lastmod>
    <changefreq>monthly</changefreq>
    <priority>0.8</priority>
    @if($post->getThumbnailUrl())
    <image:image>
      <image:loc>{{ $post->getThumbnailUrl() }}</image:loc>
      <image:title>{{ htmlspecialchars($post->title) }}</image:title>
    </image:image>
    @endif
  </url>
  @endforeach

  @foreach($vehicles as $vehicle)
  <url>
    <loc>{{ url('/catalog/' . ($vehicle->slug ?? $vehicle->id)) }}</loc>
    <lastmod>{{ $vehicle->updated_at->toIso8601String() }}</lastmod>
    <changefreq>weekly</changefreq>
    <priority>0.9</priority>
  </url>
  @endforeach

</urlset>
