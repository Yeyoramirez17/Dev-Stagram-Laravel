@extends('layouts.app')

@section('titles')
    Crear una nueva publicación
@endsection

@push('styles')
    <link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" type="text/css" />
@endpush

@section('content')

    <div class="md:flex md:items-center">
        <!-- Image Post -->
        <div class="md:w-1/2 px-10">
            <form
                action="{{ route('images.store') }}"
                method="POST"
                enctype="multipart/form-data"
                id="dropzone" name="dropzone"
                class="dropzone border-dashed border-2 w-full h-96 rounded flex flex-row-reverse justify-center items-center"
            >
            @csrf
            </form>
            @error('image')
                <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">
                    {{ $message }}
                </p>
            @enderror

        </div>

        <div class="md:w-1/2 p-10 bg-white rounded-lg shadow-xl mt-10 md:mt-0">

            <form action="{{ route('posts.store') }}" method="POST">
                @csrf
                <!-- Title Post -->
                <div class="mb-5">
                    <label for="title" class="mb-2 block uppercase text-gray-500 font-bold">
                        Nombre
                    </label>
                    <input
                        id="title"
                        name="title"
                        type="text"
                        placeholder="Titulo de la publicación"
                        class="border p-3 w-full rounded-lg @error('title') border-red-500 @enderror"
                        value="{{ old('title') }}"
                    />
                    @error('title')
                        <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">
                            {{ $message }}
                        </p>
                    @enderror
                </div>
                <!-- Description Post -->
                <div class="mb-5">
                    <label for="description" class="mb-2 block uppercase text-gray-500 font-bold">
                        Descripción
                    </label>
                    <textarea
                        id="description"
                        name="description"
                        placeholder="Descripción de la publicación"
                        class="border p-3 w-full rounded-lg @error('description') border-red-500 @enderror"
                    >{{ old('description') }}</textarea>
                    @error('description')
                        <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">
                            {{ $message }}
                        </p>
                    @enderror
                </div>
                <div class="mb-5">
                    <input
                        type="hidden"
                        name="image"
                        value="{{ old('image') }}"
                    />
                    {{-- @error('image')
                        <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">
                            {{ $message }}
                        </p>
                    @enderror --}}
                </div>
                <!-- SUBMIT BUTTON -->
                <input
                    type="submit"
                    value="Crear Publicación"
                    class="bg-sky-600  hover:bg-sky-700 transition-colors cursor-pointer uppercase font-bold w-full p-3 text-white rounded-lg"
                />
            </form>

        </div>
    </div>

@endsection

