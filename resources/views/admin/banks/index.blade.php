<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-row items-center justify-between">
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                {{ __('Manage Banks') }}
            </h2>
            <a href="{{ route('admin.package_banks.create') }}"
                class="px-6 py-2 font-bold text-white transition duration-200 bg-indigo-700 rounded-full hover:bg-indigo-800">
                Add New
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="flex flex-col p-10 overflow-hidden bg-white shadow-sm sm:rounded-lg gap-y-5">

                @forelse ($banks as $bank)
                    <div class="flex flex-row items-center justify-between p-4 border-b border-gray-200">
                        <div class="flex flex-row items-center gap-x-4">
                            <img src="{{ Storage::url($bank->logo) }}" alt="{{ $bank->bank_name }}"
                                class="rounded-2xl object-cover w-[90px] h-[90px]">
                            <div class="flex flex-col">
                                <h3 class="text-xl font-bold text-indigo-950">{{ $bank->bank_name }}</h3>
                            </div>
                        </div>
                        <div class="flex-col items-center hidden text-center md:flex">
                            <p class="text-sm text-slate-500">Date</p>
                            <h3 class="text-xl font-bold text-indigo-950">{{ $bank->created_at->format('M d, Y') }}</h3>
                        </div>
                        <div class="flex-row items-center hidden gap-x-3 md:flex">
                            <a href="{{ route('admin.package_banks.edit', $bank) }}"
                                class="px-4 py-2 font-bold text-white transition duration-200 bg-indigo-700 rounded-full hover:bg-indigo-800">
                                Edit
                            </a>
                            <form action="{{ route('admin.package_banks.destroy', $bank) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    class="px-4 py-2 font-bold text-white transition duration-200 bg-red-700 rounded-full hover:bg-red-800">
                                    Delete
                                </button>
                            </form>
                        </div>
                    </div>
                @empty
                    <p class="text-center text-gray-500">Belum ada data bank terbaru</p>
                @endforelse

            </div>
        </div>
    </div>
</x-app-layout>
