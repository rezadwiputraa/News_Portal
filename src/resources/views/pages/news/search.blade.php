@extends('layouts.app')

@section('title', 'Hasil pencarian')

@section('content')
    <!-- Header -->
    <div class="w-full p-24 mb-16 bg-[#F6F6F6]">
        <h1 class="text-center font-bold text-2xl">Hasil Pencarian: "{{ $query }}"</h1>

        <!-- Form Pencarian Ulang -->
        <div class="flex items-center justify-center mt-4">
            <form action="{{ route('news.search') }}" method="GET" class="relative w-full lg:w-auto">
                <input
                    type="text"
                    name="q"
                    placeholder="Cari berita..."
                    value="{{ $query }}"
                    class="border border-slate-300 rounded-full px-4 py-2 pl-8 w-full text-sm font-normal lg:w-72 focus:outline-none focus:ring-primary focus:border-primary"
                    id="searchInput"
                />
                <!-- Icon Search -->
                <button type="submit" class="absolute inset-y-0 left-3 flex items-center text-slate-400">
                    <img src="{{ asset('assets/img/search.png') }}" alt="search" class="w-4">
                </button>
            </form>
        </div>
    </div>

    <!-- Berita -->
    <div class="flex flex-col gap-5 px-4 lg:px-14">
        <div class="grid sm:grid-cols-1 gap-5 lg:grid-cols-4">

            @forelse ($results as $news)
                @if ($news) {{-- CEK agar tidak null --}}
                    <a href="{{ route('news.show', $news->slug) }}">
                        <div
                            class="border border-slate-200 p-3 rounded-xl hover:border-primary hover:cursor-pointer transition duration-300 ease-in-out relative">
                            @if ($news->category)
                                <div class="bg-primary text-white rounded-full w-fit px-5 py-1 font-normal ml-2 mt-2 text-sm absolute z-10">
                                    {{ $news->category->title }}
                                </div>
                            @endif

                            @if ($news->thumbnail)
                                <img src="{{ asset('storage/' . $news->thumbnail) }}" alt="{{ $news->title }}" class="w-full rounded-xl mb-3">
                            @endif

                            <p class="font-bold text-base mb-1">{{ $news->title }}</p>
                            <p class="text-slate-400">{{ \Carbon\Carbon::parse($news->created_at)->format('d M Y') }}</p>
                        </div>
                    </a>
                @endif
            @empty
                <p class="text-center text-slate-500 col-span-4">Tidak ada berita ditemukan untuk "{{ $query }}"</p>
            @endforelse

        </div>
    </div>
@endsection
