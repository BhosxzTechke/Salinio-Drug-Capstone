@extends('Ecommerce.Layout.ecommerce')

@section('content')


<div class="container my-5">
    <div class="row">
        <div class="col-lg-8 offset-lg-2">
            <h1 class="mb-4">Privacy Policy</h1>
            
            <div class="card shadow-sm">
                <div class="card-body">
                    <h2 class="h5 mb-3">1. Introduction</h2>
                    <p class="text-muted">We are committed to protecting your privacy. This Privacy Policy explains how we collect, use, disclose, and safeguard your information.</p>

                    <hr>

                    <h2 class="h5 mb-3">2. Information We Collect</h2>
                    <p class="text-muted">We may collect information about you in a variety of ways, including:</p>
                    <ul class="text-muted">
                        <li>Personal Data (name, email, phone number)</li>
                        <li>Payment Information</li>
                        <li>Usage Data (pages visited, time spent)</li>
                        <li>Device Information (IP address, browser type)</li>
                    </ul>

                    <hr>

                    <h2 class="h5 mb-3">3. Use of Your Information</h2>
                    <p class="text-muted">Having accurate information about you permits us to provide you with a smooth, efficient, and customized experience.</p>
                    <ul class="text-muted">
                        <li>Process transactions</li>
                        <li>Send periodic emails</li>
                        <li>Improve customer service</li>
                        <li>Monitor and analyze trends</li>
                    </ul>

                    <hr>

                    <h2 class="h5 mb-3">4. Disclosure of Your Information</h2>
                    <p class="text-muted">We may share information we have collected about you in certain situations.</p>

                    <hr>

                    <h2 class="h5 mb-3">5. Security of Your Information</h2>
                    <p class="text-muted">We use administrative, technical, and physical security measures to protect your personal information.</p>

                    <hr>

                    <h2 class="h5 mb-3">6. Contact Us</h2>
                    <p class="text-muted">If you have questions or concerns about this Privacy Policy, please contact us at:</p>
                    <p><strong>Email:</strong> privacy@example.com</p>
                    <p><strong>Address:</strong> Your Company Address</p>

                    <div class="alert alert-info mt-4" role="alert">
                        <strong>Last Updated:</strong> {{ date('F j, Y') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection