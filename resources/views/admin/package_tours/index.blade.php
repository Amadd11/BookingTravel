<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-row items-center justify-between">
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                {{ __('Manage Tours') }}
            </h2>
            <a href="{{ route('admin.package_tours.create') }}"
                class="px-6 py-2 font-bold text-white transition duration-200 bg-indigo-700 rounded-full hover:bg-indigo-800">
                Add New
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="flex flex-col p-10 overflow-hidden bg-white shadow-sm sm:rounded-lg gap-y-5">

                @forelse ($package_tours as $tour)
                    <div class="flex flex-row items-center justify-between p-4 border-b border-gray-200">
                        <div class="flex flex-row items-center gap-x-4">
                            <img src="{{ Storage::url($tour->thumbnail) }}" alt="{{ $tour->name }}"
                                class="rounded-2xl object-cover w-[120px] h-[90px]">
                            <div class="flex flex-col">
                                <h3 class="text-xl font-bold text-indigo-950">{{ $tour->name }}</h3>
                                <p class="text-sm text-slate-500">{{ $tour->category->name }}</p>
                            </div>
                        </div>
                        <div class="flex-col items-center hidden text-center md:flex">
                            <p class="text-sm text-slate-500">Price</p>
                            <h3 class="text-xl font-bold text-indigo-950">Rp
                                {{ number_format($tour->price, 0, ',', '.') }}</h3>
                        </div>
                        <div class="flex-col items-center hidden text-center md:flex">
                            <p class="text-sm text-slate-500">Total Days</p>
                            <h3 class="text-xl font-bold text-indigo-950">{{ $tour->days }} Days</h3>
                        </div>
                        <div class="flex-row items-center hidden md:flex gap-x-3">
                            <a href="{{ route('admin.package_tours.show', $tour) }}"
                                class="px-4 py-2 font-bold text-white transition duration-200 bg-indigo-700 rounded-full hover:bg-indigo-800">
                                Manage
                            </a>
                        </div>
                    </div>
                @empty
                    <p class="text-center text-gray-500">Belum ada package tour terbaru</p>
                @endforelse

            </div>
        </div>
    </div>
</x-app-layout>
