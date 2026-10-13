{{-- La dichiarazione XML la aggiunge SeoController: il tag di apertura breve in un template rompe PHP con short_open_tag attivo --}}
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
@foreach ($urls as $url)
    <url>
        <loc>{{ $url['loc'] }}</loc>
@if ($url['lastmod'])
        <lastmod>{{ $url['lastmod']->toAtomString() }}</lastmod>
@endif
        <changefreq>{{ $url['changefreq'] }}</changefreq>
    </url>
@endforeach
</urlset>
