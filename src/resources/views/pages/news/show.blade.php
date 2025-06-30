@extends('layouts.app')

@section('title', $news->title)

@section('content')
 <!-- Detail Berita -->
 <div class="flex flex-col px-4 lg:px-14 mt-3">

    <div class="font-bold text-xl lg:text-2xl mb-6 text-center lg:text-left max-w-[300px]">
        <div class="font-normal text-slate-500 mb-3 text-xs">
            <p></p>{{ \Carbon\Carbon::parse($news->created_at)->format('d M Y') }}</p>
          </div>
      <p>{{ $news->title }}</p>
        <div>
            <p class="text-slate-400 text-base mt-5">
            </p>
        </div>
        <div class="flex items-center justify-center gap-[70px]">
            <!-- Author (lebih kecil & simetris) -->
            <a id="Author" href="{{ route('author.show', $news->author->username) }}" class="w-fit h-fit">
                <div class="flex items-center gap-3">
                <!-- Foto Author Diperkecil -->
                <div class="w-8 h-8 rounded-full overflow-hidden">
                    <img src="{{ asset('storage/' . $news->author->avatar) }}" class="object-cover w-full h-full" alt="avatar">
                </div>

                <!-- Nama dan Bio -->
                <div class="flex flex-col text-left">
                    <p class="font-bold text-xl text-black leading-tight">{{ $news->author->name }}</p>
                </div>
                </div>
            </a>
        </div>
    </div>

    <div class="flex flex-col lg:flex-row w-full gap-10">
      <!-- Berita Utama -->
        <div class="lg:w-8/12">
            <img
                src="{{ asset('storage/' . $news->thumbnail) }}"
                alt="berita1"
                class="w-full max-h-[300px] rounded-xl object-cover"
            />
            {!! $news->content !!}
        </div>
      <!-- Berita Terbaru -->
      <div class="lg:w-4/12 flex flex-col gap-10">
        <div class="sticky top-24 z-40">
            <div class="w-full max-w-sm flex flex-col gap-6">
                <p class="font-bold text-xl whitespace-nowrap">
                  Berita Terbaru Lainnya
                </p>
                  <div class="h-px w-full bg-gray-300"></div>
                </div>
          <!-- Berita Card -->
          <div class="gap-5 flex flex-col">
                @foreach ($moreFromAuthor as $item )
                <a href="{{ route('news.show', $item->slug) }}">
                    <div
                      class="flex gap-3 border border-slate-300 hover:border-primary p-3 rounded-xl"
                    >
                      <div
                        class="bg-primary text-white rounded-full w-fit px-5 py-1 ml-2 mt-2 font-normal text-xs absolute"
                      >
                        {{ $item->category->title }}
                      </div>
                      <div class="flex gap-3 flex-col lg:flex-row">
                        <img
                          src="{{ asset('storage/' .$item->thumbnail) }}"
                          alt=""
                          class="max-h-36 rounded-xl object-cover"
                          style="width: 200px"
                        />
                        <div class="">
                          <p class="font-bold text-sm lg:text-base">
                            {{ $item->title }}
                          </p>
                        </div>
                      </div>
                    </div>
                  </a>
                @endforeach
          </div>
        </div>
      </div>
    </div>
  </div>



     <!-- Advertisement -->
     <section class="flex flex-col items-center gap-5 px-4 md:px-10 lg:px-14 ">
        <div class="flex flex-col gap-3 items-center w-full max-w-sm">
            @foreach ($advertisements as $ads)
            <a href="{{ $ads->url }}">
                <div class="w-[300px] h-[80px] border border-[#EEF0F7] rounded-3xl overflow-hidden">
                    <img src="{{ asset('storage/' . $ads->thumbnail) }}" class="object-cover w-full h-full" alt="ads" />
                </div>
            </a>
            <p class="font-medium text-sm leading-[21px] text-[#A3A6AE] flex items-center gap-1">
                Our Advertisement
                <a href="{{ $ads->url }}" class="w-[18px] h-[18px]">
                    <img src="{{ asset('assets/icons/message-question.svg') }}" alt="icon" />
                </a>
            </p>
            @endforeach
        </div>
    </section>



   {{-- Comment Section --}}
    <section id="comment-section" class="flex flex-col items-center gap-5 px-4 md:px-10 lg:px-14 ">
        <div class="container mx-auto px-4 max-w-[1130px]">
            <h2 class="text-3xl font-bold mb-8 text-gray-900">Comments ({{ $news->comments->count() }})</h2>

            {{-- Alert Section (No visual changes needed, already good) --}}
            @if (session('success'))
                <div id="alert-success" class="mt-2 mb-6 bg-green-100 border-l-4 border-green-500 text-green-700 px-4 py-3 rounded-md relative" role="alert">
                    <strong class="font-bold">Sukses!</strong>
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif

            @if ($errors->any())
                <div id="alert-error" class="mt-2 mb-6 bg-red-100 border-l-4 border-red-500 text-red-700 px-4 py-3 rounded-md relative" role="alert">
                    <strong class="font-bold">Terjadi kesalahan:</strong>
                    <ul class="list-disc list-inside mt-2">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {{-- List Komentar --}}
            <div class="space-y-6">
                @forelse($news->comments as $comment)
                    {{-- Desain kartu komentar yang lebih modern dengan border halus --}}
                    <div class="bg-white p-6 rounded-xl border border-gray-200">
                        <div class="flex items-start mb-4">
                            <img src="{{ asset('assets/img/avatar.png') }}" alt="User Avatar" class="w-8 h-8 rounded-full overflow-hidden">
                            <div>
                                <h3 class="font-bold text-gray-900">{{ $comment->name }}</h3>
                                <p class="text-sm text-gray-500">Posted on {{ $comment->created_at->format('H:i, d M Y') }}</p>
                            </div>
                        </div>

                        {{-- Teks komentar dengan line-height untuk keterbacaan --}}
                        <p class="text-gray-700 leading-relaxed mb-4">{{ $comment->review }}</p>

                        {{-- Tombol Aksi (Reply) yang lebih terlihat seperti tombol --}}
                        <div class="flex items-center">
                            <button class="reply-btn inline-flex items-center gap-2 text-sm font-medium text-blue-600 hover:text-blue-800 transition-colors" data-comment-id="{{ $comment->id }}">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M7.707 3.293a1 1 0 010 1.414L5.414 7H11a7 7 0 017 7v2a1 1 0 11-2 0v-2a5 5 0 00-5-5H5.414l2.293 2.293a1 1 0 11-1.414 1.414L2.586 8l3.707-3.707a1 1 0 011.414 0z" clip-rule="evenodd" />
                                </svg>
                                Reply
                            </button>
                        </div>

                        {{-- Reply Form (Sembunyikan dan tampilkan dengan JS) --}}
                        <div id="reply-form-{{ $comment->id }}" class="reply-form hidden mt-4 pl-4 border-l-4 border-blue-200">
                            <form action="{{ route('news.reply', $comment->id) }}" method="POST" class="ml-4">
                                @csrf
                                <h4 class="text-md font-semibold mb-3 text-gray-800">Reply to {{ $comment->name }}</h4>
                                <div class="mb-3">
                                    <label for="reply-name-{{ $comment->id }}" class="sr-only">Name</label>
                                    <input type="text" id="reply-name-{{ $comment->id }}" name="name" value="{{ old('name') }}" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Your Name" required>
                                </div>
                                <div class="mb-3">
                                    <label for="reply-comment-{{ $comment->id }}" class="sr-only">Reply</label>
                                    <textarea id="reply-comment-{{ $comment->id }}" name="reply" rows="3" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Write your reply..." required>{{ old('reply') }}</textarea>
                                </div>
                                <div class="flex gap-2">
                                    <button type="submit" class="w-full sm:w-auto text-white font-bold px-6 py-3 rounded-lg focus:outline-none focus:ring-2 focus:ring-offset-2 transition-all duration-300 ease-in-out"
                                        style="background-color: #8800ff">
                                        Post Reply
                                    </button>
                                    <button type="button" class="cancel-reply bg-gray-200 text-gray-700 px-4 py-2 text-sm font-semibold rounded-md hover:bg-gray-300 transition-colors" data-comment-id="{{ $comment->id }}">
                                        Cancel
                                    </button>
                                </div>
                            </form>
                        </div>

                        {{-- Display Replies --}}
                        @if($comment->replyComments && $comment->replyComments->count() > 0)
                            <div class="replies mt-6 ml-8 space-y-4 border-l-2 border-gray-200 pl-8">
                                @foreach($comment->replyComments as $reply)
                                    <div class="bg-gray-50 p-4 rounded-lg">
                                        <div class="flex items-center mb-2">
                                            <img src="{{ asset('assets/img/avatar.png') }}" alt="User Avatar" class="w-8 h-8 rounded-full overflow-hidden">
                                            <div>
                                                <h4 class="font-bold text-sm text-gray-800">{{ $reply->name }}</h4>
                                                <p class="text-xs text-gray-500">{{ $reply->created_at->format('H:i, d M Y') }}</p>
                                            </div>
                                        </div>
                                        <p class="text-gray-700 text-sm">{{ $reply->review }}</p>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </div>
                @empty
                    <div class="bg-white text-center py-12 px-6 rounded-xl border border-gray-200">
                        <h3 class="text-lg font-medium text-gray-700">No Comments Yet</h3>
                        <p class="text-gray-500 mt-1">Be the first to share your thoughts!</p>
                    </div>
                @endforelse
            </div>

            {{-- Add Comment Form --}}
            <div class="mt-12 bg-white p-8 rounded-xl border border-gray-200 shadow-sm">
                <h3 class="text-xl font-bold text-gray-800 mb-4">Leave a Comment</h3>
                <form action="{{ route('news.comment', $news->id) }}" method="POST" class="space-y-4">
                    @csrf
                    <div>
                        <label for="name" class="block text-gray-700 font-medium mb-2">Name</label>
                        <input type="text" id="name" name="name" value="{{ old('name') }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 transition" required>
                        @error('name')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label for="comment" class="block text-gray-700 font-medium mb-2">Comment</label>
                        <textarea id="comment" name="comment" rows="4" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 transition" required>{{ old('comment') }}</textarea>
                        @error('comment')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="flex justify-end mt-4">
                        <button type="submit" class="w-full sm:w-auto text-white font-bold px-6 py-3 rounded-lg focus:outline-none focus:ring-2 focus:ring-offset-2 transition-all duration-300 ease-in-out"
                        style="background-color: #8800ff; ">
                            Post Comment
                        </button
                    </div>
                </form>
            </div>
        </div>
    </section>

          <!-- Berita Unggulan -->
          <div class="flex flex-col px-14 mt-10 ">
            <div class="flex flex-col md:flex-row justify-between items-center w-full mb-6">
              <div class="font-bold text-2xl text-center md:text-left">
                <p>Berita Unggulan</p>
                <p>Untuk Kamu</p>
              </div>
            </div>
            <div class="grid sm:grid-cols-1 gap-5 lg:grid-cols-4">
                @foreach ($featureds as $featured)
                    <a href="{{ route('news.show', $featured->slug) }}">
                        <div
                            class="border border-slate-200 p-3 rounded-xl hover:border-primary hover:cursor-pointer transition duration-300 ease-in-out"
                            style="height: 100%">
                            <div
                                class="bg-primary text-white rounded-full w-fit px-5 py-1 font-normal ml-2 mt-2 text-sm absolute">
                                {{ $featured->category->title }}
                            </div>
                            <img src="{{ asset('storage/' . $featured->thumbnail) }}" alt=""
                                class="w-full rounded-xl mb-3" style="height: 150px; object-fit: cover">
                             <p class="font-bold text-base mb-1">{{ $featured->title }}</p>
                             <p class="text-slate-400">{{ \Carbon\Carbon::parse($featured->created_at)->format('d M Y') }} </p>
                        </div>
                    </a>
                @endforeach
            </div>
          </div>
@endsection


