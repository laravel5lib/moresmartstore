@extends('layouts.app')
@section('nav')
    @include('partials.nav')
@endsection
@section('adsconversion')
        <!-- Event snippet for สมัครใช้บริการ conversion page
    In your html page, add the snippet and call gtag_report_conversion when someone clicks on the chosen link or button. -->
    <script>
    function gtag_report_conversion(url) {
      var callback = function () {
        if (typeof(url) != 'undefined') {
          window.location = url;
        }
      };
      gtag('event', 'conversion', {
          'send_to': 'AW-625418009/TmRCCO_b0toBEJm-nKoC',
          'event_callback': callback
      });
      return false;
    }
    </script>

@endsection
@section('content')
<div id="app" class="w-full mx-auto max-w-sm sm:mt-20 md:mt-32 lg:mt-32 xl:mt-32">
    <div class="bg-white shadow-md rounded px-8 pt-6">
        <div class="font-thin text-base  text-red-500 p-2 rounded-t">
            คุณยังไม่ได้ยืนยันที่อยู่อีเมล !!
        </div>
        <div class="bg-white p-2">
            @if (session('resent'))
                <div class="bg-white border border-blue-900 text-blue-800 text-base px-4 py-3 rounded mb-4">
                    ระบบได้ส่งข้อความเพื่อการยืนยันการสมัครสมาชิกไปยังอีเมลที่คุณใช้ในการลงทะเบียนแล้ว.
                </div>
            @endif

            <div class="w-full mx-auto mt-2">
                {{ __('กรุณาตรวจสอบข้อความในกล่องจดหมายที่ระบบได้ส่งไปเพื่อยืนยันความถูกต้องของทีอยู่อีเมล ที่คุณใช้ในการลงทะเบียน') }}
                {{ __('ถ้าหากคุณยังไม่ได้รับอีเมลจากเรา ') }}
                <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                    @csrf
                    <button type="submit" class="w-full mt-8 inline-block px-2 py-2 btn btn-blue btn-blue:hover focus:outline-none focus:shadow-outline tracking-wider">
                        {{ __('คลิกเพื่อส่งอีเมลยืนยันอีกครั้ง') }}
                    </button>.
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
