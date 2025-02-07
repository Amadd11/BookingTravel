<!doctype html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{{ asset('output.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap"
        rel="stylesheet" />
</head>

<body class="text-black font-poppins">
    <section id="content" class="max-w-[640px] w-full mx-auto bg-[#F9F2EF] min-h-screen flex flex-col gap-8 pb-[120px]">
        <nav class="flex items-center justify-between w-full px-4 mt-8">
            <a href="details.html">
                <img src="{{ asset('assets/icons/back.png') }}" alt="back">
            </a>
            <p class="m-auto font-semibold text-center">Booking</p>
            <div class="w-12"></div>
        </nav>
        <form action="{{ route('front.book.store', $packageTour->slug) }}" method="POST" class="flex flex-col gap-8">
            @csrf

            <div class="flex flex-col gap-3 px-4 ">
                <p class="font-semibold">Start Date</p>
                <div
                    class="flex items-center gap-[10px] bg-white p-[16px_24px] rounded-[37px] transition-all duration-300">
                    <input type="date" name="start_date" id="start_date"
                        class="appearance-none outline-none w-full relative text-sm tracking-035 leading-[22px] [&::-webkit-calendar-picker-indicator]:absolute [&::-webkit-calendar-picker-indicator]:w-full [&::-webkit-calendar-picker-indicator]:h-full [&::-webkit-calendar-picker-indicator]:opacity-0">
                    <div class="flex w-6 h-6 shrink-0">
                        <img src="{{ asset('assets/icons/calendar-blue.svg') }}" class="w-full h-full" alt="icon">
                    </div>
                </div>
            </div>
            <div class="flex flex-col gap-3 px-4 ">
                <p class="font-semibold">Trip Destination</p>
                <div class="bg-white p-4 rounded-[26px] flex items-center gap-3">
                    <div class="w-[72px] h-[72px] flex shrink-0 rounded-xl overflow-hidden">
                        <img src="{{ Storage::url($packageTour->thumbnail) }}"
                            class="object-cover object-center w-full h-full" alt="thumbnail">
                    </div>
                    <div class="flex flex-col gap-1">
                        <p class="font-semibold text-sm tracking-035 leading-[22px]">{{ $packageTour->name }}</p>
                        <div class="flex items-center gap-1">
                            <div class="w-4 h-4">
                                <img src="{{ asset('assets/icons/location-map.svg') }}" class="w-4 h-4" alt="icon">
                            </div>
                            <span
                                class="text-darkGrey text-sm tracking-035 leading-[22px]">{{ $packageTour->location }}</span>
                        </div>
                    </div>
                    <div class="flex items-center justify-end flex-1 gap-2">
                        <button type="button" id="remove-quantity"><img
                                src="{{ asset('assets/icons/minus-square.svg') }}" alt="icon"></button>
                        <p id="quantity" class="text-sm font-semibold">1</p>
                        <input type="hidden" name="quantity" id="quantity_input" value="1" />
                        <input type="hidden" name="packageTourPrice" id="packageTourPrice"
                            value="{{ $packageTour->price }}">

                        <button type="button" id="add-quantity"><img src="{{ asset('assets/icons/add-square.svg') }}"
                                alt="icon"></button>
                    </div>
                </div>
            </div>
            <div class="flex flex-col gap-3 px-4 ">
                <p class="font-semibold">Contact Details</p>
                <div class="bg-white p-[16px_24px] rounded-[26px] flex flex-col gap-3">
                    <div class="flex justify-between items-center text-sm tracking-035 leading-[22px]">
                        <p>Name</p>
                        <p class="font-semibold">{{ Auth::user()->name }}</p>
                    </div>
                    <div class="flex justify-between items-center text-sm tracking-035 leading-[22px]">
                        <p>Email</p>
                        <p class="font-semibold">{{ Auth::user()->email }}</p>
                    </div>
                    <div class="flex justify-between items-center text-sm tracking-035 leading-[22px]">
                        <p>Phone</p>
                        <p class="font-semibold">{{ Auth::user()->phone_number }}</p>
                    </div>
                </div>
            </div>
            <div class="flex flex-col gap-3 px-4 ">
                <p class="font-semibold">Payment Summary</p>
                <div class="bg-white p-[16px_24px] rounded-[26px] flex flex-col gap-3">
                    <div class="flex justify-between items-center text-sm tracking-035 leading-[22px]">
                        <p>Sub Total</p>
                        <p id="subtotal" class="font-semibold text-blue"></p>
                    </div>
                    <div class="flex justify-between items-center text-sm tracking-035 leading-[22px]">
                        <p>Insurance <span class="text-darkGrey">x<span id="total_quantity"></span></span></p>
                        <p id="insurance" class="font-semibold text-blue"></p>
                    </div>
                    <div class="flex justify-between items-center text-sm tracking-035 leading-[22px]">
                        <p>Tax 10%</p>
                        <p id="tax" class="font-semibold text-blue"></p>
                    </div>
                </div>
            </div>
            <div
                class="navigation-bar fixed bottom-0 z-50 max-w-[640px] w-full h-[85px] bg-black rounded-t-[25px] flex items-center justify-between px-6 shadow-[-6px_-8px_20px_0_#00000008]">
                <div class="flex flex-col justify-center gap-1">
                    <p class="text-white text-sm tracking-035 leading-[22px]">Grand Total</p>
                    <p id="grandtotal" class="text-[#EED202] font-semibold text-lg leading-[26px] tracking-[0.6px]"></p>
                </div>
                <button type="submit"
                    class="p-[16px_24px] rounded-xl bg-blue w-fit text-white hover:bg-[#06C755] transition-all duration-300">Booking</button>
            </div>
        </form>
    </section>

    <script src="{{ asset('js/booking.js') }}"></script>

    <script>
        function calculatePrice() {
            let subTotal = 0;
            let quantity = parseInt(document.getElementById("quantity").textContent);
            let packageTourPrice = parseInt(
                document.getElementById("packageTourPrice").value
            );
            let insurance = 300000;
            let taxRate = 0.1; // Assuming a tax rate of 10%

            const tourPrice = packageTourPrice;
            subTotal = tourPrice * quantity;
            const totalInsurance = insurance * quantity;
            const totalTax = subTotal * taxRate;
            const totalGrandTotal = subTotal + totalInsurance + totalTax;

            const btnAddQty = document.getElementById("add-quantity");
            const btnRemoveQty = document.getElementById("remove-quantity");

            document.getElementById("quantity").textContent = quantity;

            document.getElementById("insurance").textContent =
                "Rp " + totalInsurance.toLocaleString("id");

            document.getElementById("tax").textContent =
                "Rp " + totalTax.toLocaleString("id");

            document.getElementById("subtotal").textContent =
                "Rp " + subTotal.toLocaleString("id");

            document.getElementById("total_quantity").textContent = quantity;

            document.getElementById("grandtotal").textContent =
                "Rp " + totalGrandTotal.toLocaleString("id");
        }

        function addQuantity() {
            let quantityElement = document.getElementById("quantity");
            let quantityInput = document.getElementById("quantity_input");
            let quantity = parseInt(quantityElement.textContent);
            quantity++;
            quantityInput.value = quantity; // Update hidden input
            quantityElement.textContent = quantity;
            calculatePrice();
        }

        function removeQuantity() {
            let quantityInput = document.getElementById("quantity_input");
            let quantityElement = document.getElementById("quantity");
            let quantity = parseInt(quantityElement.textContent);
            if (quantity > 1) {
                // Prevents quantity from going below 1
                quantity--;
                quantityInput.value = quantity; // Update hidden input
                quantityElement.textContent = quantity;
                calculatePrice();
            }
        }

        document.addEventListener("DOMContentLoaded", function() {
            document
                .getElementById("add-quantity")
                .addEventListener("click", addQuantity);
            document
                .getElementById("remove-quantity")
                .addEventListener("click", removeQuantity);
            calculatePrice(); // Initial calculation
        });
    </script>
</body>

</html>
