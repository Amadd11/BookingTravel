<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-row items-center justify-between">
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                {{ __('Details Tours') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="flex flex-col p-10 overflow-hidden bg-white shadow-sm sm:rounded-lg gap-y-5">


                <div class="flex flex-row items-center justify-between item-card">
                    <div class="flex flex-row items-center gap-x-3">
                        <img src="{{ Storage::url($packageTour->thumbnail) }}" alt=""
                            class="rounded-2xl object-cover w-[120px] h-[90px]">
                        <div class="flex flex-col">
                            <h3 class="text-xl font-bold text-indigo-950">{{ $packageTour->name }}</h3>
                            <p class="text-sm text-slate-500">{{ $packageTour->category->name }}</p>
                        </div>
                    </div>
                    <div class="flex-col hidden md:flex">
                        <p class="text-sm text-slate-500">Price</p>
                        <h3 class="text-xl font-bold text-indigo-950">
                            {{ number_format($packageTour->price, 0, ',', '.') }}</h3>
                    </div>
                    <div class="flex-col hidden md:flex">
                        <p class="text-sm text-slate-500">Total Days</p>
                        <h3 class="text-xl font-bold text-indigo-950">{{ $packageTour->days }}</h3>
                    </div>
                    <div class="flex-row items-center hidden md:flex gap-x-3">
                        <a href="{{ route('admin.package_tours.edit', $packageTour) }}"
                            class="px-6 py-4 font-bold text-white bg-indigo-700 rounded-full">
                            Edit
                        </a>
                        <form action="{{ route('admin.package_tours.destroy', $packageTour) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="px-6 py-4 font-bold text-white bg-red-700 rounded-full">
                                Delete
                            </button>
                        </form>
                    </div>
                </div>

                <hr class="my-5">
                <h3 class="text-xl font-bold text-indigo-950">Gallery Photos</h3>

                <div class="flex flex-row gap-x-5">
                    @forelse ($latestPhotos as $photo)
                        <img src="{{ Storage::url($photo->photo) }}" alt=""
                            class="rounded-2xl object-cover w-[120px] h-[90px]">
                    @empty
                        <p>Belum ada foto terbaru</p>
                    @endforelse

                </div>

                <div>
                    <h3 class="text-xl font-bold text-indigo-950">About</h3>
                    <p>
                        {{ $packageTour->about }}
                    </p>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
