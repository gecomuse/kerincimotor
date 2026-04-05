{!! '<?xml version="1.0" encoding="UTF-8"?>' !!}
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
@php
    $cars = collect([]);
    try {
        $cars = \App\Models\Car::available()->latest('updated_at')->get();
    } catch (\Exception $e) {}
@endphp

  {{-- Static pages --}}
  <url>
    <loc>{{ url('/') }}</loc>
    <changefreq>weekly</changefreq>
    <priority>1.0</priority>
  </url>
  <url>
    <loc>{{ url('/catalog') }}</loc>
    <changefreq>daily</changefreq>
    <priority>0.9</priority>
  </url>
  <url>
    <loc>{{ url('/artikel') }}</loc>
    <changefreq>weekly</changefreq>
    <priority>0.8</priority>
  </url>

  {{-- Cars --}}
  @foreach ($cars as $car)
  <url>
    <loc>{{ url('/catalog/' . $car->slug) }}</loc>
    <lastmod>{{ $car->updated_at->toAtomString() }}</lastmod>
    <changefreq>weekly</changefreq>
    <priority>0.8</priority>
  </url>
  @endforeach

  {{-- Articles --}}
  @foreach ($posts as $post)
  <url>
    <loc>{{ url('/artikel/' . $post->slug) }}</loc>
    <lastmod>{{ $post->updated_at->toAtomString() }}</lastmod>
    <changefreq>monthly</changefreq>
    <priority>0.7</priority>
  </url>
  @endforeach

</urlset>
