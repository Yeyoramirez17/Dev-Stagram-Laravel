<div class="shadow bg-white p-5 mb-5">
    @auth
        <p class="text-xl font-bold text-center mb-4">
            Agrega un nuevo comentario
        </p>
        {{-- Banner message --}}
        @if (session('info'))
            <div class="bg-green-500 p-2 rounded-lg mb-6 text-white text-center uppercase font-bold">
                {{ session('info') }}
            </div>
        @endif
        <form wire:submit.prevent="save">
            @csrf
            <div class="mb-5">
                <label for="comment" class="mb-2 block uppercase text-gray-500 font-bold">
                    Añade un comentario
                </label>
                <textarea wire:model="comment" id="comment" placeholder="Agrega un comentario"
                    class="border p-3 w-full rounded-lg @error('comment') border-red-500 @enderror"></textarea>

                @error('comment')
                    <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">
                        {{ $message }}
                    </p>
                @enderror
            </div>
            {{-- Input submit --}}
            <button type="submit"
                class="bg-sky-600  hover:bg-sky-700 transition-colors cursor-pointer uppercase font-bold w-full p-3 text-white rounded-lg">
                Commentar
            </button>
        </form>

    @endauth

    <div class="bg-white shadow mb-5 max-h-96 overflow-y-scroll mt-10">
        @if ($this->comments->count())
            @foreach ($this->comments as $comment)
                <div class="p-5 border-gray-300 border-b" wire:key="comment-{{ $comment->id }}">
                    <a href="{{ route('posts.index', $comment->user) }}" class="font-bold">
                        {{ $comment->user->username }}
                    </a>
                    <p>{{ $comment->comment }}</p>
                    <p class="text-sm text-gray-500">{{ $comment->created_at->diffForHumans() }}</p>
                </div>
            @endforeach
        @else
            <p class="p-10 text-center">No Hay Comentarios Aún</p>
        @endif

    </div>
    @if ($post->comments()->count() - $count > 3)
        <div class="flex justify-end">
            <button
                wire:click="$set('count', {{ $count + 4 }})"
                class="text-sm font-semibold text-gray-500 mx-4 hover:text-gray-800 hover:underline"
            >
                Ver más
            </button>
        </div>
    @endif
</div>
