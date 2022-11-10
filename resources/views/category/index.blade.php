<x-guest-layout>
        <x-slot name="logo">
            <a href="/">
                <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
            </a>
        </x-slot>
    <div class="min-h-screen flex flex-col items-center pt-6 sm:pt-0 bg-gray-100">
        <div class="mt-8 max-w-7xl bg-white dark:bg-gray-800 shadow sm:rounded-lg">
            <div class="flex">
                <div class="p-6">
                    <a href="{{route('categories.create')}}" class="underline">Add category</a>
                </div>
                <div class="p-6">
                    <a href="{{route('lots.index')}}" class="underline">Show Lots</a>
                </div>
            </div>
            <div class="grid grid-cols-4">
                <div class="p-3 border-b">
                    id
                </div>
                <div class="p-3 border-b">
                    Name
                </div>
                <div class="p-3 border-b">
                </div>
                <div class="p-3 border-b">
                </div>
                @foreach($categories as $category)

                    <div class="p-3 border-b">
                        <div class="flex items-center">
                            {{ $category->id }}
                        </div>
                    </div>
                    <div class="p-3 border-b">
                        <div class="flex items-center">
                            {{ $category->name }}
                        </div>
                    </div>
                    <div class="p-3 border-b">
                        <div class="flex items-center">
                            <a href="{{route('categories.edit', ['category'=>$category])}}" class="underline">Edit</a>
                        </div>
                    </div>
                    <div class="p-3 border-b">
                        <div class="flex items-center">
                            <form action="{{ route('categories.destroy', $category->id) }}" method="POST">
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
