@extends('layouts.frontend')
@section('content')
    <div id="fh5co-contact" class="fh5co-section-gray">
        <div class="container">
            <div class="row">
                <div class="col-md-8 col-md-offset-2 text-center heading-section animate-box">
                    <h3>Terms & Conditions</h3>
                </div>
            </div>
            <div class="row animate-box">
                <div class="col-12"><h2>Terms &amp; Conditions</h2><p>Visa, MasterCard and American Express Card payments are processed through an online payment gateway system (City Bank Internet Payment Gateway) without any information passing through us. Two-Step verification* protocol implemented by your bank guarantees your transaction will be 100% safe and secure.</p><p>{{ config('app.name') }}, as a Verisign Certified Site, uses the latest 128 bit encryption technology and state-of-the-art vaulted data security to protect your credit card information. We do not retain any credit card information.</p>{{ config('app.name') }} offers you the highest standards of security protocols currently available on the internet so as to ensure that your shopping experience is private, safe and secure.<p>On the instance of a declined credit card payment, alternate payment instructions must be provided to {{ config('app.name') }} within 72 hours prior to the time of departure; else, the order is liable to be cancelled.</p><p>{{ config('app.name') }} charges a service fee on all domestic airline bookings. In case of cancellation, this fee is non-refundable.</p><h2>Amendment &amp; Cancellation Policy</h2><p>Flight date change fee = (date change charge according to the airlines policy + difference of fare (if price is more than the previous one) + BDT 500 service charge.) For flight cancelation and refund if the ticket is refundable then we follow the airlines refund policy. This cost includes (The charge by airlines policy+ Service charge BDT 1,000).</p></div>
            </div>
        </div>
    </div>
@endsection
