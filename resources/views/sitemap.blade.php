<?xml version="1.0" encoding="UTF-8"?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    {{-- Halaman Statis --}}
    <url>
        <loc>{{ url('/') }}</loc>
        <lastmod>{{ now()->tz('UTC')->toAtomString() }}</lastmod>
        <changefreq>daily</changefreq>
        <priority>1.0</priority>
    </url>
    <url>
        <loc>{{ url('/berita') }}</loc>
        <lastmod>{{ now()->tz('UTC')->toAtomString() }}</lastmod>
        <changefreq>daily</changefreq>
        <priority>0.8</priority>
    </url>
    <url>
        <loc>{{ url('/profil-desa/sejarah') }}</loc>
        <changefreq>monthly</changefreq>
        <priority>0.8</priority>
    </url>
    <url>
        <loc>{{ url('/profil-desa/visi-misi') }}</loc>
        <changefreq>monthly</changefreq>
        <priority>0.8</priority>
    </url>

    {{-- Halaman Dinamis: Berita --}}
    @foreach ($berita as $item)
    <url>
        <loc>{{ route('berita.show', $item->slug) }}</loc>
        <lastmod>{{ $item->updated_at->tz('UTC')->toAtomString() }}</lastmod>
        <changefreq>weekly</changefreq>
        <priority>0.6</priority>
    </url>
    @endforeach
</urlset>
