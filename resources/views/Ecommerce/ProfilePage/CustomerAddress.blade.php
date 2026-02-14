

@extends('Ecommerce.Layout.ecommerce')

@section('content')
<div class="max-w-4xl mx-auto px-4 py-8">

    <!-- Page Title -->
    <h2 class="text-2xl font-semibold mb-6">My Addresses</h2>


    @foreach ($addresses as $addr)

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
                {{$addr->barangay->name ?? ''}} <br>
                {{$addr->city->name ?? ''}}

            </p>
        </div>

        
        <!-- Actions -->
        <div class="flex flex-col gap-2 text-sm">


            <button onclick="EditAddressModal({{ $addr->id ?? '' }})" class="text-blue-600 hover:underline" data-bs-target="#returnDetailsModal{{ $addr->id ?? '' }}">
                Edit
            </button>

                                



            <a href="{{ route('delete.customer.address', $addr->id ?? '') }}" 
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
{{-- ADDING ADDRESS MODAL  --}}
<div id="addressModal" class="fixed inset-0 z-50 hidden items-center justify-center bg-black bg-opacity-50">

    <div class="bg-white rounded-xl w-full max-w-lg p-6 relative">

        <!-- Close Button -->
        <button onclick="closeAddressCreate()"
                class="absolute top-3 right-3 text-gray-400 hover:text-gray-600">
            ✕
        </button>

        <!-- Modal Title -->
        <h3 class="text-xl font-semibold mb-4">Add New Address</h3>

        <!-- Address Form -->
        <form action="{{ route('store.customer.address') }}" method="POST" class="space-y-4">
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

                <!-- Street -->
                <div>
                    <label class="block text-sm font-medium mb-1">Street / House No.</label>
                    <input type="text" name="street"
                        class="w-full border rounded-lg px-3 py-2 focus:outline-none focus:ring focus:ring-blue-200"
                        placeholder="Blk 12 Lot 5">
                </div>

            <!-- Province, City & Barangay -->
            <div class="grid grid-cols-3 gap-3">

                <!-- Province -->
                <div>
                    <label class="block text-sm font-medium mb-1">Province</label>
                    <select name="province_id" id="province_id"
                            class="w-full border rounded-lg px-3 py-2 focus:outline-none focus:ring focus:ring-blue-200">
                        <option value="">Select Province</option>
                        @foreach($provinces as $province)
                            <option value="{{ $province->id }}">{{ $province->name }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- City -->
                <div>
                    <label class="block text-sm font-medium mb-1">City</label>
                    <select name="city_id" id="city_id"
                            class="w-full border rounded-lg px-3 py-2 focus:outline-none focus:ring focus:ring-blue-200">
                        <option value="">Select City</option>
                    </select>
                </div>

                <!-- Barangay -->
                <div>
                    <label class="block text-sm font-medium mb-1">Barangay</label>
                    <select name="barangay_id" id="barangay_id"
                            class="w-full border rounded-lg px-3 py-2 focus:outline-none focus:ring focus:ring-blue-200">
                        <option value="">Select Barangay</option>
                    </select>
                </div>
            </div>

            <!-- Default Checkbox -->
            <div class="flex items-center gap-2">
                <input type="checkbox" name="is_default" value="1">
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






                                {{-- EDIT ADDRESS MODAL  --}}

    <!-- EDIT ADDRESS MODAL -->
    <div id="EditAddress{{ $addr->id ?? '' }}" class="fixed inset-0 z-50 hidden items-center justify-center bg-black bg-opacity-50">

        <div class="bg-white rounded-xl w-full max-w-lg p-6 relative">



            <!-- Modal Title -->
            <h3 class="text-xl font-semibold mb-4">
                Edit Address
            </h3>

            <!-- Address Form -->
            <form action="{{ route('update.customer.address') }}" method="POST" class="space-y-4">
                @csrf
                @method('PUT')

                <!-- Hidden Address ID -->
                <input type="hidden" name="address_id" value="{{ $addr->id ?? '' }}">

                <!-- Full Name -->
                <div>
                    <label class="block text-sm font-medium mb-1">Full Name</label>
                    <input type="text" name="full_name" value="{{ old('full_name', $addr->full_name ?? '') }}"
                        class="w-full border rounded-lg px-3 py-2 focus:outline-none focus:ring focus:ring-blue-200">
                </div>

                <!-- Phone -->
                <div>
                    <label class="block text-sm font-medium mb-1">Phone Number</label>
                    <input type="text" name="phone" value="{{ old('phone', $addr->phone ?? '') }}"
                        class="w-full border rounded-lg px-3 py-2 focus:outline-none focus:ring focus:ring-blue-200">
                </div>

                <!-- Street -->
                <div>
                    <label class="block text-sm font-medium mb-1">Street / House No.</label>
                    <input type="text" name="street" value="{{ old('street', $addr->street ?? '') }}"
                        class="w-full border rounded-lg px-3 py-2 focus:outline-none focus:ring focus:ring-blue-200">
                </div>

                <!-- Province, City & Barangay -->
                <div class="grid grid-cols-3 gap-3">

                    <!-- Province -->
                    <div>
                        <label class="block text-sm font-medium mb-1">Province</label>
                        <select name="province_id" id="province_id_{{ $addr->id ?? '' }}" 
                                class="w-full border rounded-lg px-3 py-2 focus:outline-none focus:ring focus:ring-blue-200"
                                onchange="loadCities({{ $addr->id ?? '' }})">
                            <option value="">Select Province</option>
                            @foreach($provinces as $province)
                                <option value="{{ $province->id ?? '' }}"
                                    {{ $addr->province_id == $province->id ? 'selected' : '' }}>
                                    {{ $province->name ?? '' }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- City -->
                    <div>
                        <label class="block text-sm font-medium mb-1">City</label>
                        <select name="city_id" id="city_id_{{ $addr->id ?? '' }}" 
                                class="w-full border rounded-lg px-3 py-2 focus:outline-none focus:ring focus:ring-blue-200"
                                onchange="loadBarangays({{ $addr->id ?? '' }})">
                            <option value="">Select City</option>
                            @foreach($cities as $city)
                                @if($city->province_id == $addr->province_id)
                                    <option value="{{ $city->id ?? '' }}"
                                        {{ $addr->city_id == $city->id ? 'selected' : '' }}>
                                        {{ $city->name ?? '' }}
                                    </option>
                                @endif
                            @endforeach
                        </select>
                    </div>

                    <!-- Barangay -->
                    <div>
                        <label class="block text-sm font-medium mb-1">Barangay</label>
                        <select name="barangay_id" id="barangay_id_{{ $addr->id ?? '' }}"
                                class="w-full border rounded-lg px-3 py-2 focus:outline-none focus:ring focus:ring-blue-200">
                            <option value="">Select Barangay</option>
                            @foreach($barangays as $barangay)
                                @if($barangay->city_id == $addr->city_id)
                                    <option value="{{ $barangay->id ?? '' }}"
                                        {{ $addr->barangay_id == $barangay->id ? 'selected' : '' }}>
                                        {{ $barangay->name ?? '' }}
                                    </option>
                                @endif
                            @endforeach
                        </select>
                    </div>

                </div>

                <!-- Default Checkbox -->
                <div class="flex items-center gap-2">
                    <input type="checkbox" name="is_default" value="1"
                        {{ $addr->is_default ? 'checked' : '' }}>
                    <span class="text-sm">Set as default address</span>
                </div>

                <!-- Actions -->
                <div class="flex justify-end gap-3 pt-4">
                    <a href="{{ route('customer.adress')}}" 
                            class="px-4 py-2 text-sm rounded-lg border hover:bg-gray-100">
                        Cancel
                    </a>

                    <button type="submit"
                            class="px-4 py-2 text-sm rounded-lg bg-blue-600 text-white hover:bg-blue-700">
                        Update Address
                    </button>
                </div>
            </form>

        </div>
    </div>








        <script>
                // Open/Close Modal
                function openAddressModal() {
                    const modal = document.getElementById('addressModal');
                    modal.classList.remove('hidden');
                    modal.classList.add('flex');
                }

                function closeAddressCreate() {
                    const modal = document.getElementById('addressModal');
                    modal.classList.add('hidden');
                    modal.classList.remove('flex');
                }




                // Dynamic dropdowns
                document.getElementById('province_id').addEventListener('change', function() {
                    const provinceId = this.value;
                    const citySelect = document.getElementById('city_id');
                    const barangaySelect = document.getElementById('barangay_id');

                    // Reset city & barangay
                    citySelect.innerHTML = '<option value="">Select City</option>';
                    barangaySelect.innerHTML = '<option value="">Select Barangay</option>';

                    if (!provinceId) return;

                    fetch(`/api/cities/${provinceId}`)
                        .then(res => res.json())
                        .then(data => {
                            data.forEach(city => {
                                citySelect.innerHTML += `<option value="${city.id}">${city.name}</option>`;
                            });
                        });
                });



                document.getElementById('city_id').addEventListener('change', function() {
                    const cityId = this.value;
                    const barangaySelect = document.getElementById('barangay_id');

                    barangaySelect.innerHTML = '<option value="">Select Barangay</option>';
                    if (!cityId) return;

                    fetch(`/api/barangays/${cityId}`)
                        .then(res => res.json())
                        .then(data => {
                            data.forEach(barangay => {
                                barangaySelect.innerHTML += `<option value="${barangay.id}">${barangay.name}</option>`;
                            });
                        });
                });

        </script>









<script>
    
function loadCities(addrId) {
    let provinceId = document.getElementById(`province_id_${addrId}`).value;
    let citySelect = document.getElementById(`city_id_${addrId}`);
    let barangaySelect = document.getElementById(`barangay_id_${addrId}`);

    citySelect.innerHTML = '<option value="">Loading...</option>';
    barangaySelect.innerHTML = '<option value="">Select Barangay</option>';

    if(provinceId) {
        fetch(`/api/cities?province_id=${provinceId}`)
            .then(res => res.json())
            .then(cities => {
                citySelect.innerHTML = '<option value="">Select City</option>';
                cities.forEach(city => {
                    citySelect.innerHTML += `<option value="${city.id}">${city.name}</option>`;
                });
            });
    } else {
        citySelect.innerHTML = '<option value="">Select City</option>';
    }
}

function loadBarangays(addrId) {
    let cityId = document.getElementById(`city_id_${addrId}`).value;
    let barangaySelect = document.getElementById(`barangay_id_${addrId}`);

    barangaySelect.innerHTML = '<option value="">Loading...</option>';

    if(cityId) {
        fetch(`/api/barangays?city_id=${cityId}`)
            .then(res => res.json())
            .then(barangays => {
                barangaySelect.innerHTML = '<option value="">Select Barangay</option>';
                barangays.forEach(barangay => {
                    barangaySelect.innerHTML += `<option value="${barangay.id}">${barangay.name}</option>`;
                });
            });
    } else {
        barangaySelect.innerHTML = '<option value="">Select Barangay</option>';
    }
}

// Open/Close modal functions
function EditAddressModal(addrId) {
    document.getElementById(`EditAddress${addrId}`).classList.remove('hidden');
    document.getElementById(`EditAddress${addrId}`).classList.add('flex');
}


</script>





@endsection
