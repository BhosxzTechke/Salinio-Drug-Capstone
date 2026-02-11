@extends('Ecommerce.Layout.ecommerce')

@section('content')

<!-- Alpine (needed) -->
<script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
<div class="min-h-screen bg-white p-6 flex justify-center">
  <div class="w-full max-w-5xl">
    <!-- Profile Header -->
    <div class="card bg-white shadow-xl mb-6 border border-gray-100">
      <div class="card-body flex flex-col md:flex-row items-center gap-6 bg-white">
        <div class="card-body space-y-4 bg-white">
          <form method="POST" action="{{ route('update.customer.profile') }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <input type="hidden" name="id" value="{{ Auth::guard('customer')->user()->id }}">

            <div>
              <label class="label text-gray-800">Name</label>
              <input type="text" name="name" value="{{ Auth::guard('customer')->user()->name }}" class="input input-bordered w-full bg-white border-gray-300 text-gray-800" />
            </div>

            <div>
              <label class="label text-gray-800">Email</label>
              <input type="email" name="email" value="{{ Auth::guard('customer')->user()->email }}" class="input input-bordered w-full bg-white border-gray-300 text-gray-800" />
            </div>



                  
                  <!-- Input field for remaining digits -->
        <div>
          <label class="label text-gray-800 font-medium mb-1">Phone</label>
          <div class="flex items-center">
            <!-- Locked prefix -->
            <span class="inline-flex items-center px-4 py-2 bg-gray-200 text-gray-700 border border-r-0 border-gray-300 rounded-l-md select-none">
              +639
            </span>

            <!-- Visible input: user types 9 digits -->
            <input
              type="tel"
              id="phone-visible"
              pattern="\d{9}"
              maxlength="9"
              placeholder="XXXXXXXXX"
              value="{{ Auth::guard('customer')->user()->phone ? substr(Auth::guard('customer')->user()->phone, 4) : '' }}"
              class="input input-bordered w-full rounded-r-md border-gray-300 text-gray-800 focus:ring-2 focus:ring-blue-400 focus:border-blue-400"
              required
            />
          </div>

                {{-- // Ensure +639 is always at the start --}}
{{-- 
          <script>
                const phoneInput = document.getElementById('phone');

                // Ensure +639 is always at the start
                phoneInput.addEventListener('input', function() {
                  if (!this.value.startsWith('+639')) {
                    this.value = '+639' + this.value.replace(/^(\+?63)?9?/, '');
                  }
                });

                // Optional: remove non-numeric characters after +639
                phoneInput.addEventListener('keypress', function(e) {
                  if (!/\d/.test(e.key)) e.preventDefault();
                });
          </script> --}}


            <!-- Hidden input that will hold full number +639XXXXXXXXX -->
  <input type="hidden" name="tel" id="phone-full" />

      <script>
            const visibleInput = document.getElementById('phone-visible');
            const fullInput = document.getElementById('phone-full');

            function updateFullPhone() {
              let val = visibleInput.value.replace(/\D/g, '').slice(0, 9); // digits only, max 9 chars
              fullInput.value = '+639' + val;
            }

            // Update hidden full input on every change
            visibleInput.addEventListener('input', updateFullPhone);

            // Initialize on page load
            updateFullPhone();
          </script>


            <!-- DRAG AND DROP FILE IMAGE -->
            <div class="mb-6" x-data="imageUploader()" x-cloak>
              <label class="block text-sm font-medium text-gray-800 mb-2">Customer Image</label>

              <div
                class="flex items-center justify-center w-full"
                x-on:dragover.prevent="dragging = true"
                x-on:dragleave.prevent="dragging = false"
                x-on:drop.prevent="handleDrop($event)"
              >
                <label
                  for="image"
                  class="flex flex-col items-center justify-center w-full h-40 border-2 border-dashed rounded-xl cursor-pointer transition p-4 bg-white"
                  :class="dragging ? 'border-indigo-400 bg-indigo-50' : 'border-gray-300 hover:bg-gray-50'"
                >
                  <div class="flex flex-col items-center justify-center">
                    <svg class="w-10 h-10 mb-3 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M7 16V4m0 0l-4 4m4-4l4 4m6 4h4M3 16h18M4 20h16" />
                    </svg>
                    <p class="mb-2 text-sm text-gray-500">
                      <span class="font-semibold">Click to upload</span> or drag & drop
                    </p>
                    <p class="text-xs text-gray-400">PNG, JPG, JPEG (max 10MB)</p>
                  </div>
                  <input
                    id="image"
                    name="image"
                    type="file"
                    class="hidden"
                    accept="image/*"
                    x-ref="fileInput"
                    x-on:change="previewFile($event)"
                  >
                </label>
              </div>

              <!-- Preview -->
              <div x-show="previewUrl" class="mt-4">
                <img :src="previewUrl" alt="Preview" class="max-h-48 rounded-lg shadow-md">
                <button type="button" class="mt-2 px-3 py-1 rounded bg-gray-200" x-on:click="clear()">Remove</button>
              </div>
            </div>


              <button class="btn btn-primary mt-4 w-full md:w-auto"
                      onclick="this.disabled=true; this.innerText='Updating.'; this.form.submit();">
                  Update Changes
              </button>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>





      <script>
        
      function imageUploader() {
        return {
          dragging: false,
          previewUrl: null,
          objectUrl: null,

          previewFile(event) {
            const file = event.target.files[0];
            this.setPreview(file);
          },

          handleDrop(event) {
            this.dragging = false;
            const file = event.dataTransfer.files[0];
            if (!file) return;

            // put file into hidden input so form submission works
            const dt = new DataTransfer();
            dt.items.add(file);
            this.$refs.fileInput.files = dt.files;

            this.setPreview(file);
          },

          setPreview(file) {
            if (this.objectUrl) URL.revokeObjectURL(this.objectUrl);
            if (!file) {
              this.previewUrl = null;
              return;
            }
            this.objectUrl = URL.createObjectURL(file);
            this.previewUrl = this.objectUrl;
          },

          clear() {
            if (this.objectUrl) URL.revokeObjectURL(this.objectUrl);
            this.previewUrl = null;
            this.$refs.fileInput.value = '';
          }
        }
      }
      </script>


@endsection