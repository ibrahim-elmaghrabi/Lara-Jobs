@extends('layouts.app')

@section('content')
@include('partials._hero')
@include('partials._search')


 <a href="/" class="inline-block text-black ml-4 mb-4"
                ><i class="fa-solid fa-arrow-left"></i> Back
            </a>
            <div class="mx-4">
                <div class="bg-gray-50 border border-gray-200 p-10 rounded">
                    <div
                        class="flex flex-col items-center justify-center text-center"
                    >
                        <img
                            class="w-48 mr-6 mb-6"
                            src="{{ $listing->logo ?
                                         asset('storage/' . $listing->logo ) : asset('images/no-image.png') }}"
                            alt=""
                        />

                        <h3 class="text-2xl mb-2">{{ $listing->title }}</h3>
                        <div class="text-xl font-bold mb-4">{{ $listing->company }}</div>

                           <x-tags :tags="$listing->tags" />

                        <div class="text-lg my-4">
                            <i class="fa-solid fa-location-dot"></i>
                            {{ $listing->location }}
                        </div>
                        <div class="border border-gray-200 w-full mb-6"></div>
                        <div>
                            <h3 class="text-3xl font-bold mb-4">
                                Job Description
                            </h3>
                            <div class="text-lg space-y-6">
                                <p>
                                     {{ $listing->description }}
                                </p>
                                <a
                                    href="{{ $listing->email }}"
                                    class="block bg-laravel text-white mt-6 py-2 rounded-xl hover:opacity-80"
                                    ><i class="fa-solid fa-envelope"></i>
                                    Contact Employer</a
                                >

                                <a
                                    href="{{ $listing->website }}"
                                    target="_blank"
                                    class="block bg-black text-white py-2 rounded-xl hover:opacity-80"
                                    ><i class="fa-solid fa-globe"></i> Visit
                                    Website</a
                                >
                            </div>
                        </div>
                    </div>
                </div>
                  {{-- <div class="bg-gray-50 border mt-4 flex p-2 space-x-6 border-gray-200 rounded p-6">
                    <a href="{{ route('listings.edit' , ['listing' => $listing->id]) }}">
                        <i class="fa-solid fa-pencil"></i>Edit
                    </a>

                    <form action="{{ route('listings.destroy' , ['listing' => $listing->id ]) }}" method="Post">
                        @csrf
                        @method('DELETE')
                        <button class="text-red-500 " type="submit" name="delete">
                        <i class="fa-solid fa-trash"></i>Delete
                    </button>
                     </form>
                    </div>
            </div>
 --}}
@endsection
