<x-guest-layout>
    <div class="min-h-screen flex flex-col items-center pt-6 sm:pt-0 bg-gray-100">
        <div class="mt-8 max-w-7xl bg-white dark:bg-gray-800 shadow sm:rounded-lg">
            <div class="flex">
                <div class="p-3">
                    <form action="{{route('lots.filter')}}" method="GET">
                        <div class="p-3">
                            Choose Categories
                        </div>
                        <div class="flex p-3">
                            <div class="p-1">
                            <select multiple="" id="categories" name="categories[]">
                                @foreach($categories as $category)
                                    <option @if(isset($chosenCategories) && in_array($category->id, $chosenCategories)) selected @endif value="{{ $category->id }}">{{$category->name}}</option>
                                @endforeach
                            </select>
                            </div>
                            <div class="p-1 mt-2">
                                <a href="{{route('lots.index')}}">
                                    X
                                </a>
                            </div>
                            <div class="p-1">
                                <x-primary-button class="ml-4">
                                    Filter
                                </x-primary-button>
                            </div>

                        </div>
                    </form>
                </div>
            </div>
            <div class="flex">
                <div class="p-3">
                    <a href="{{route('lots.create')}}" class="underline">Add lot</a>
                </div>
                <div class="p-3">
                    <a href="{{route('categories.index')}}" class="underline">Show Categories</a>
                </div>
            </div>
            <div class="grid grid-cols-6">
                <div class="p-3 border-b">
                    id
                </div>
                <div class="p-3 border-b">
                    Name
                </div>
                <div class="p-3 border-b">
                    Description
                </div>
                <div class="p-3 border-b">
                    Categories
                </div>
                <div class="p-3 border-b">

                </div>
                <div class="p-3 border-b">

                </div>
            @foreach($lots as $lot)

                <div class="p-3 border-b">
                    <div class="flex items-center">
                        {{ $lot->id }}
                    </div>
                </div>
                <div class="p-3 border-b">
                    <div class="flex items-center">
                        {{ $lot->name }}
                    </div>
                </div>
                <div class="p-3 border-b">
                    <div class="flex items-center">
                        {{ $lot->desc }}
                    </div>
                </div>
                <div class="p-3 border-b">
                    <div class="flex flex-col">
                        @foreach($lot->categories as $category)
                            <div>
                                {{ $category->name }}
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="p-3 border-b">
                    <div class="flex items-center">
                        <a href="{{route('lots.edit', ['lot'=>$lot])}}" class="underline">Edit</a>
                    </div>
                </div>
                <div class="p-3 border-b">
                    <div class="flex items-center">
                        <form action="{{ route('lots.destroy', $lot->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm underline" title="Delete">Delete</button>
                        </form>
                    </div>
                </div>
            @endforeach
            </div>
        </div>
    </div>
</x-guest-layout>
