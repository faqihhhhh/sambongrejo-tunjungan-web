@extends('layouts.public')
@section('title', 'Galeri — Desa Sambongrejo')
@section('content')
<div class="page-hero">
    <div class="max-w-7xl mx-auto px-6 text-center">
        <h1 class="font-serif text-3xl sm:text-4xl font-bold text-white">Galeri</h1>
        <p class="text-green-200 mt-2">Foto dan video kegiatan Desa Sambongrejo</p>
    </div>
</div>

<div class="max-w-7xl mx-auto px-4 sm:px-6 py-6 md:py-10">
    {{-- Tab --}}
    <div class="flex gap-1 mb-8 border-b border-gray-200">
        <a href="{{ route('galeri', ['tab' => 'foto']) }}"
           class="flex items-center gap-1.5 px-6 py-2.5 text-sm font-semibold border-b-2 transition-all {{ $tab === 'foto' ? 'border-blora-gold text-blora-green-dark' : 'border-transparent text-gray-500 hover:text-blora-green-dark' }}">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
            Foto ({{ $fotos->total() }})
        </a>
        <a href="{{ route('galeri', ['tab' => 'video']) }}"
           class="flex items-center gap-1.5 px-6 py-2.5 text-sm font-semibold border-b-2 transition-all {{ $tab === 'video' ? 'border-blora-gold text-blora-green-dark' : 'border-transparent text-gray-500 hover:text-blora-green-dark' }}">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 10l4.553-2.277A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"/></svg>
            Video ({{ $videos->total() }})
        </a>
    </div>

    @if($tab === 'foto')
        @if($fotos->isNotEmpty())
        <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-3">
            @foreach($fotos as $foto)
            <div class="group relative overflow-hidden rounded-lg bg-gray-100 cursor-pointer"
                 onclick="openLightbox('{{ Storage::url($foto->file) }}', '{{ addslashes($foto->judul) }}')">
                <div class="aspect-square">
                    <img src="{{ Storage::url($foto->file) }}"
                         alt="{{ $foto->judul }}"
                         class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                </div>
                <div class="absolute inset-0 bg-blora-green-dark/0 group-hover:bg-blora-green-dark/60 transition-all duration-300 flex items-end">
                    <div class="p-3 w-full translate-y-full group-hover:translate-y-0 transition-transform duration-300">
                        <p class="text-white text-xs font-semibold line-clamp-1">{{ $foto->judul }}</p>
                        @if($foto->tanggal)<p class="text-green-300 text-xs">{{ $foto->tanggal->translatedFormat('d M Y') }}</p>@endif
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        @if($fotos->hasPages())<div class="mt-6">{{ $fotos->appends(['tab'=>'foto'])->links() }}</div>@endif
        @else
        <div class="text-center py-16 text-gray-400"><p>Belum ada foto yang diunggah.</p></div>
        @endif
    @else
        @if($videos->isNotEmpty())
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5">
            @foreach($videos as $video)
            <div class="bg-white border border-gray-200 rounded-lg overflow-hidden hover:shadow-md transition-shadow">
                <div class="aspect-video bg-gray-900">
                    <iframe src="{{ $video->embed_url }}"
                            title="{{ $video->judul }}"
                            class="w-full h-full"
                            frameborder="0"
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                            allowfullscreen
                            loading="lazy"></iframe>
                </div>
                <div class="p-3">
                    <h3 class="font-semibold text-blora-green-dark text-sm">{{ $video->judul }}</h3>
                    @if($video->tanggal)<p class="text-gray-400 text-xs mt-1">{{ $video->tanggal->translatedFormat('d F Y') }}</p>@endif
                </div>
            </div>
            @endforeach
        </div>
        @if($videos->hasPages())<div class="mt-6">{{ $videos->appends(['tab'=>'video'])->links() }}</div>@endif
        @else
        <div class="text-center py-16 text-gray-400"><p>Belum ada video yang diunggah.</p></div>
        @endif
    @endif
</div>

{{-- Lightbox --}}
<div id="lightbox" class="fixed inset-0 bg-black/90 z-50 hidden items-center justify-center p-4"
     onclick="closeLightbox()">
    <button class="absolute top-4 right-4 text-white text-3xl font-bold" onclick="closeLightbox()">×</button>
    <div class="max-w-4xl w-full" onclick="event.stopPropagation()">
        <img id="lightbox-img" src="" alt="" class="w-full max-h-[80vh] object-contain rounded">
        <p id="lightbox-caption" class="text-white text-center mt-3 text-sm"></p>
    </div>
</div>

@endsection

@push('scripts')
<script>
function openLightbox(src, caption) {
    document.getElementById('lightbox-img').src = src;
    document.getElementById('lightbox-caption').textContent = caption;
    const lb = document.getElementById('lightbox');
    lb.classList.remove('hidden');
    lb.classList.add('flex');
    document.body.style.overflow = 'hidden';
}
function closeLightbox() {
    const lb = document.getElementById('lightbox');
    lb.classList.add('hidden');
    lb.classList.remove('flex');
    document.body.style.overflow = '';
}
document.addEventListener('keydown', e => { if(e.key === 'Escape') closeLightbox(); });
</script>
@endpush
