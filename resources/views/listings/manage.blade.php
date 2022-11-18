@extends('layouts.app')


@section('content')
@include('partials._search')


        <div class="mx-4">
                <div class="bg-gray-50 border border-gray-200 p-10 rounded">
                    <header>
                        <h1
                            class="text-3xl text-center font-bold my-6 uppercase"
                        >
                            Manage Gigs
                        </h1>
                    </header>

                    <table class="w-full table-auto rounded-sm">
                        <tbody>
                        @unless ($listings->isEmpty())
                          @foreach ($listings as $listing )

                            <tr class="border-gray-300">
                                <td
                                    class="px-4 py-8 border-t border-b border-gray-300 text-lg"
                                >
                                    <a href="show.html">
                                            {{ $listing->title }}
                                    </a>
                                </td>
                                <td
                                    class="px-4 py-8 border-t border-b border-gray-300 text-lg"
                                >
                                    <a
                                        href="{{ route('listings.edit' , ['listing' => $listing->id]) }}"
                                        class="text-blue-400 px-6 py-2 rounded-xl"
                                        ><i
                                            class="fa-solid fa-pen-to-square"
                                        ></i>
                                        Edit</a
                                    >
                                </td>
                                <td
                                    class="px-4 py-8 border-t border-b border-gray-300 text-lg"
                                >
                                     <form action="{{ route('listings.destroy' , ['listing' => $listing->id ]) }}" method="Post">
                                        @csrf
                                        @method('DELETE')
                                        <button class="text-red-500 " type="submit" name="delete">
                                        <i class="fa-solid fa-trash"></i>Delete
                                    </button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                            @else
                            <tr class="bordre-gary-300">
                                <td class="px-8 py-8 bordre-t border-b border-gray-300 text-lg">
                                    <p>No listings found</p>
                                </td>
                            </tr>
                            @endunless
                        </tbody>
                    </table>
                </div>
            </div>
@endsection
