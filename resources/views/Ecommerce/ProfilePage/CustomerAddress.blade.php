

@extends('Ecommerce.Layout.ecommerce')

@section('content')
<div class="max-w-4xl mx-auto px-4 py-8">

    <!-- Page Title -->
    <h2 class="text-2xl font-semibold mb-6">My Addresses</h2>


    @foreach ($address as $addr)

    <!-- Address Card -->
    <div class="bg-white border rounded-xl shadow-sm p-6 mb-4 flex justify-between items-start">

        <!-- Address Info -->



        <div>
            <div class="flex items-center gap-2 mb-2">
                <span class="font-semibold text-lg">Home</span>

                @if ($addr->is_default ?? '')
                <span class="text-xs bg-green-100 text-green-700 px-2 py-1 rounded-full">
                    Default
                </span>
                @endif


            </div>

            <p class="text-sm text-gray-700">
                {{ $addr->full_name ?? '' }}
            </p>
            
            <p class="text-sm text-gray-600">
                {{ $addr->phone ?? '' }}
            </p>

            <p class="text-sm text-gray-600 mt-2 leading-relaxed">
                {{$addr->street ?? ''}} <br>
                {{$addr->barangay ?? ''}} <br>
                {{$addr->city ?? ''}}

            </p>
        </div>

        
        <!-- Actions -->
        <div class="flex flex-col gap-2 text-sm">
            <button onclick="EditAddressModal({{ $addr->id }})" class="text-blue-600 hover:underline" data-bs-target="#returnDetailsModal{{ $addr->id }}">
                Edit
            </button>

                        
                <div id="EditAddress{{ $addr->id }}"
                class="fixed inset-0 z-50 hidden items-center justify-center bg-black bg-opacity-50">

                    <div class="bg-white rounded-xl w-full max-w-lg p-6 relative">

                        <!-- Close Button -->
                        <button onclick="closeAddressModal({{ $addr->id }})"
                                class="absolute top-3 right-3 text-gray-400 hover:text-gray-600">
                            ✕
                        </button>

                        <!-- Modal Title -->
                        <h3 class="text-xl font-semibold mb-4">
                            Add New Address
                        </h3>


                        <!-- Address Form -->
                        <form action="{{route('update.customer.address')}}" method="POST" class="space-y-4">
                            @csrf
                            @method('PUT')

                            <!-- Full Name -->  
                            
                            <input type="hidden" name="address_id" value="{{ $addr->id ?? '' }}">

                            <div>
                                <label class="block text-sm font-medium mb-1">Full Name</label>
                                <input type="text" name="full_name" value="{{ $addr->full_name ?? '' }}"
                                    class="w-full border rounded-lg px-3 py-2 focus:outline-none focus:ring focus:ring-blue-200"
                                    placeholder="Enter Your Name">
                            </div>

                            <!-- Phone -->
                            <div>
                                <label class="block text-sm font-medium mb-1">Phone Number</label>
                                <input type="text" name="phone" value="{{ $addr->phone ?? '' }}"
                                    class="w-full border rounded-lg px-3 py-2 focus:outline-none focus:ring focus:ring-blue-200"
                                    placeholder="0912 345 6789">
                            </div>

                            <!-- Address Line -->
                            <div>
                                <label class="block text-sm font-medium mb-1">Street / House No.</label>
                                <input type="text" name="street" value="{{ $addr->street ?? '' }}"
                                    class="w-full border rounded-lg px-3 py-2 focus:outline-none focus:ring focus:ring-blue-200"
                                    placeholder="Blk 12 Lot 5">
                            </div>

                            <!-- City & Barangay -->
                            <div class="grid grid-cols-2 gap-3">
                                <div>
                                    <label class="block text-sm font-medium mb-1">City</label>
                                    <input type="text" name="city" value="{{ $addr->barangay ?? '' }}"
                                        class="w-full border rounded-lg px-3 py-2 focus:outline-none focus:ring focus:ring-blue-200"
                                        placeholder="Taguig">
                                </div>

                                <div>
                                    <label class="block text-sm font-medium mb-1">Barangay</label>
                                    <input type="text" name="barangay" value="{{ $addr->city ?? '' }}"
                                        class="w-full border rounded-lg px-3 py-2 focus:outline-none focus:ring focus:ring-blue-200"
                                        placeholder="SDH">
                                </div>
                            </div>



                            <!-- Default Checkbox -->
                            <div class="flex items-center gap-2">
                                <input type="checkbox" name="is_default" value="1" {{ $addr->is_default ? 'checked' : '' }}>
                                <span class="text-sm">Set as default address</span>
                            </div>

                            <!-- Actions -->
                            <div class="flex justify-end gap-3 pt-4">
                                <button type="button"
                                        onclick="closeAddressModal({{ $addr->id }})"
                                        class="px-4 py-2 text-sm rounded-lg border hover:bg-gray-100">
                                    Cancel
                                </button>

                                <button type="submit"
                                        class="px-4 py-2 text-sm rounded-lg bg-blue-600 text-white hover:bg-blue-700">
                                    Update Address
                                </button>
                            </div>
                        </form>

                    </div>
                </div>






                    <a href="{{ route('delete.customer.address', $addr->id) }}" 
                    class="text-red-500 hover:underline"
                    onclick="return confirm('Are you sure you want to delete this address?');">
                    Delete
                    </a>


        </div>
    </div>

                                        

    @endforeach

            <!-- Add New Address Button -->
            <div class="mt-6">
                    <button
                        onclick="openAddressModal()"
                        class="inline-flex items-center gap-2 px-4 py-2 rounded-lg bg-blue-600 text-white text-sm font-medium hover:bg-blue-700 transition">
                        + Add New Address
                    </button>
            </div>


            

</div>



                                {{-- ADDING ADDRESS MODAL  --}}

    <!-- Address Modal -->
    <div id="addressModal" class="fixed inset-0 z-50 hidden items-center justify-center bg-black bg-opacity-50">

        <div class="bg-white rounded-xl w-full max-w-lg p-6 relative">

            <!-- Close Button -->
            <button onclick="closeAddressCreate()"
                    class="absolute top-3 right-3 text-gray-400 hover:text-gray-600">
                ✕
            </button>

            <!-- Modal Title -->
            <h3 class="text-xl font-semibold mb-4">
                Add New Address
            </h3>

            <!-- Address Form -->
            <form action="{{route('store.customer.address')}}" method="POST" class="space-y-4">
                @csrf

                <!-- Full Name -->
                <div>
                    <label class="block text-sm font-medium mb-1">Full Name</label>
                    <input type="text" name="full_name"
                        class="w-full border rounded-lg px-3 py-2 focus:outline-none focus:ring focus:ring-blue-200"
                        placeholder="Enter Your Name">
                </div>

                <!-- Phone -->
                <div>
                    <label class="block text-sm font-medium mb-1">Phone Number</label>
                    <input type="text" name="phone"
                        class="w-full border rounded-lg px-3 py-2 focus:outline-none focus:ring focus:ring-blue-200"
                        placeholder="0912 345 6789">
                </div>

                <!-- Address Line -->
                <div>
                    <label class="block text-sm font-medium mb-1">Street / House No.</label>
                    <input type="text" name="street"
                        class="w-full border rounded-lg px-3 py-2 focus:outline-none focus:ring focus:ring-blue-200"
                        placeholder="Blk 12 Lot 5">
                </div>

                <!-- City & Barangay -->
                <div class="grid grid-cols-2 gap-3">
                    <div>
                        <label class="block text-sm font-medium mb-1">City</label>
                        <input type="text" name="city"
                            class="w-full border rounded-lg px-3 py-2 focus:outline-none focus:ring focus:ring-blue-200"
                            placeholder="Taguig">
                    </div>

                    <div>
                        <label class="block text-sm font-medium mb-1">Barangay</label>
                        <input type="text" name="barangay"
                            class="w-full border rounded-lg px-3 py-2 focus:outline-none focus:ring focus:ring-blue-200"
                            placeholder="SDH">
                    </div>
                </div>

                <!-- Default Checkbox -->
                <div class="flex items-center gap-2">
                    <input type="checkbox" name="is_default" value="1" {{ old('is_default') ? 'checked' : '' }}>
                    <span class="text-sm">Set as default address</span>
                </div>

                <!-- Actions -->
                <div class="flex justify-end gap-3 pt-4">
                    <button type="button"
                            onclick="closeAddressCreate()"
                            class="px-4 py-2 text-sm rounded-lg border hover:bg-gray-100">
                        Cancel
                    </button>

                    <button type="submit"
                            class="px-4 py-2 text-sm rounded-lg bg-blue-600 text-white hover:bg-blue-700">
                        Save Address
                    </button>
                </div>
            </form>
        </div>
    </div>







    <!-- EditAddressModal -->



    


        <script>
            function openAddressModal() {
                document.getElementById('addressModal').classList.remove('hidden');
                document.getElementById('addressModal').classList.add('flex');
            }

            function closeAddressCreate() {
                document.getElementById('addressModal').classList.add('hidden');
                document.getElementById('addressModal').classList.remove('flex');
            }
        </script>


        <script>
                            function EditAddressModal(id) {
                                const modal = document.getElementById('EditAddress' + id);
                                if (modal) {
                                    modal.classList.remove('hidden');
                                    modal.classList.add('flex');
                                }
                            }

                            function closeAddressModal(id) {
                                const modal = document.getElementById('EditAddress' + id);
                                if (modal) {
                                    modal.classList.add('hidden');
                                    modal.classList.remove('flex');
                                }
                            }
        </script>






@endsection
