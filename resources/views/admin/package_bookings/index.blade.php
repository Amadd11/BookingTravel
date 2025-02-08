<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-row items-center justify-between">
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                {{ __('Manage Bookings') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="flex flex-col p-10 overflow-hidden bg-white shadow-sm sm:rounded-lg gap-y-5">

                @forelse ($package_bookings as $booking)
                    <div class="flex flex-row items-center justify-between item-card">
                        <div class="flex flex-row items-center gap-x-3">
                            <img src="{{ Storage::url($booking->PackageTour->thumbnail) }}" alt=""
                                class="rounded-2xl object-cover w-[120px] h-[90px]">
                            <div class="flex flex-col">
                                <h3 class="text-xl font-bold text-indigo-950">{{ $booking->packageTour->name }}</h3>
                                <p class="text-sm text-slate-500">{{ $booking->packageTour->category->name }}</p>
                            </div>
                        </div>
                        @if ($booking->is_paid)
                            <span class="px-3 py-2 text-sm font-bold text-white bg-green-500 rounded-full w-fit">
                                SUCCESS
                            </span>
                        @else
                            <span class="px-3 py-2 text-sm font-bold text-white bg-orange-500 rounded-full w-fit">
                                PENDING
                            </span>
                        @endif

                        <div class="flex-col hidden md:flex">
                            <p class="text-sm text-slate-500">Price</p>
                            <h3 class="text-xl font-bold text-indigo-950">Rp
                                {{ number_format($booking->total_amount, 0, ',', '.') }}</h3>
                            </h3>
                        </div>
                        <div class="flex-col hidden md:flex">
                            <p class="text-sm text-slate-500">Total Days</p>
                            <h3 class="text-xl font-bold text-indigo-950">{{ $booking->packageTour->days }}</h3>
                        </div>
                        <div class="flex-col hidden md:flex">
                            <p class="text-sm text-slate-500">Quantity</p>
                            <h3 class="text-xl font-bold text-indigo-950"> {{ $booking->quantity }} People</h3>
                        </div>
                        <div class="flex-row items-center hidden md:flex gap-x-3">
                            <a href="{{ route('admin.package_bookings.show', $booking) }}"
                                class="px-6 py-4 font-bold text-white bg-indigo-700 rounded-full">
                                Details
                            </a>
                        </div>
                    </div>
                @empty
                    <p>Belum ada pemesanan tour terbaru</p>
                @endforelse



            </div>
        </div>
    </div>
</x-app-layout>
