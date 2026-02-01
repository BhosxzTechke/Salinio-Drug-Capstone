@extends('Ecommerce.Layout.ecommerce')

@section('content')


<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <!-- Header -->
            <div class="mb-5">
                <h1 class="display-4 fw-bold mb-3">Terms and Service</h1>
                <p class="text-muted">Last updated: {{ date('F d, Y') }}</p>
            </div>

            <!-- Terms Content -->
            <div class="card border-0 shadow-sm">
                <div class="card-body p-4">
                    <!-- Section 1 -->
                    <div class="mb-4">
                        <h3 class="fw-bold text-dark mb-3">1. Agreement to Terms</h3>
                        <p class="text-secondary">By accessing and using this website, you accept and agree to be bound by the terms and provision of this agreement.</p>
                    </div>

                    <!-- Section 2 -->
                    <div class="mb-4">
                        <h3 class="fw-bold text-dark mb-3">2. Use License</h3>
                        <p class="text-secondary">Permission is granted to temporarily download one copy of the materials (information or software) on our website for personal, non-commercial transitory viewing only.</p>
                    </div>

                    <!-- Section 3 -->
                    <div class="mb-4">
                        <h3 class="fw-bold text-dark mb-3">3. Disclaimer</h3>
                        <p class="text-secondary">The materials on our website are provided on an 'as is' basis. We make no warranties, expressed or implied, and hereby disclaim and negate all other warranties including, without limitation, implied warranties or conditions of merchantability, fitness for a particular purpose, or non-infringement of intellectual property or other violation of rights.</p>
                    </div>

                    <!-- Section 4 -->
                    <div class="mb-4">
                        <h3 class="fw-bold text-dark mb-3">4. Limitations</h3>
                        <p class="text-secondary">In no event shall our company or its suppliers be liable for any damages (including, without limitation, damages for loss of data or profit, or due to business interruption) arising out of the use or inability to use the materials on our website.</p>
                    </div>

                    <!-- Section 5 -->
                    <div class="mb-4">
                        <h3 class="fw-bold text-dark mb-3">5. Accuracy of Materials</h3>
                        <p class="text-secondary">The materials appearing on our website could include technical, typographical, or photographic errors. We do not warrant that any of the materials on our website are accurate, complete, or current.</p>
                    </div>

                    <!-- Section 6 -->
                    <div class="mb-4">
                        <h3 class="fw-bold text-dark mb-3">6. Links</h3>
                        <p class="text-secondary">We have not reviewed all of the sites linked to our website and are not responsible for the contents of any such linked site. The inclusion of any link does not imply endorsement by us of the site.</p>
                    </div>

                    <!-- Section 7 -->
                    <div class="mb-4">
                        <h3 class="fw-bold text-dark mb-3">7. Modifications</h3>
                        <p class="text-secondary">We may revise these terms of service for our website at any time without notice. By using this website, you are agreeing to be bound by the then current version of these terms of service.</p>
                    </div>

                    <!-- Section 8 -->
                    <div class="mb-4">
                        <h3 class="fw-bold text-dark mb-3">8. Governing Law</h3>
                        <p class="text-secondary">These terms and conditions are governed by and construed in accordance with the laws of your jurisdiction, and you irrevocably submit to the exclusive jurisdiction of the courts in that location.</p>
                    </div>
                </div>
            </div>

            <!-- Acceptance Button -->
            <div class="mt-5 text-center">
                <button class="btn btn-primary btn-lg" onclick="window.history.back()">
                    I Acknowledge These Terms
                </button>
            </div>
        </div>
    </div>
</div>
@endsection


