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

            <h1 class="text-lg">Lot @isset($lot->id) edit @else create @endisset</h1>
            <form method="POST" action="@isset($lot->id){{ route('lots.update', ['lot'=>$lot]) }}@else{{ route('lots.store') }}@endisset">
                @csrf
                @isset($lot->id)@method('PATCH')@endisset
                <div class="mt-4">
                    <x-input-label for="name" value="Name" />

                    <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" value="{{ empty($lot->name) ? old('name') : $lot->name }}" required autofocus />

                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                </div>

                <div class="mt-4">
                    <x-input-label for="desc" value="Description" />

                    <x-text-area id="desc" class="block mt-1 w-full" type="text" name="desc" required >
                        {{ empty($lot->desc) ? old('desc') : $lot->desc }}
                    </x-text-area>

                    <x-input-error :messages="$errors->get('desc')" class="mt-2" />
                </div>

                <div class="mt-4">
                    <x-input-label for="categories" value="Categories" />

                    <select multiple="" id="categories" class="block mt-1 w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" name="categories[]" required >
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" @if(!empty($lot->categories->firstWhere('id',$category->id))) selected @endif>{{ $category->name }}</option>
                        @endforeach
                    </select>

                </div>

                <div class="flex items-center justify-end mt-4">

                    <x-primary-button class="ml-4">
                        Save
                    </x-primary-button>
                </div>
            </form>
            <!--<script type="text/javascript">
                window.onload = function() {
                    $('#categories').select2();
                };
            </script>-->
        </div>
</x-guest-layout>
