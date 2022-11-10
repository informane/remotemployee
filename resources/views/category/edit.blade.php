<x-guest-layout>
        <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
            <div class="flex pb-3">
                <div>
                    <a href="{{route('lots.index')}}" class="underline">Show Lots</a>
                </div>
                <div class="pl-3">
                    <a href="{{route('categories.index')}}" class="underline">Show Categories</a>
                </div>
            </div>
            <h1 class="text-lg">Category @isset($category->id) edit @else create @endisset</h1>
            <form method="POST" action="@isset($category->id){{ route('categories.update',['category'=>$category]) }}@else{{ route('categories.store') }}@endisset">
                @csrf
                @isset($category->id)@method('PATCH')@endisset
                <div>
                    <x-input-label for="name" value="Name" />

                    <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" value="{{ isset($category->name) ? $category->name : old('name') }}"  autofocus />

                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                </div>

                <div class="flex items-center justify-end mt-4">

                    <x-primary-button class="ml-4">
                        Save
                    </x-primary-button>
                </div>
            </form>
        </div>
</x-guest-layout>
