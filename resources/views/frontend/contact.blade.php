@extends('frontend.layouts.master')

@section('title', 'Contact Us')

@section('content')
<section class="bg-white py-16 px-6">
    <div class="max-w-4xl mx-auto text-center">
        <h1>যোগাযোগ করুন</h1>
        <p class="text-gray-600 mb-10 text-lg">
            আপনার যেকোনো প্রশ্ন, পরামর্শ বা সেবা সংক্রান্ত সহায়তার জন্য আমাদের সাথে যোগাযোগ করুন। আমরা দ্রুত সময়ের মধ্যে আপনার বার্তার উত্তর দেওয়ার চেষ্টা করব।
        </p>
    </div>

    {{-- যোগাযোগ ফর্ম --}}
    @if(session('success'))
        <div class="max-w-4xl mx-auto mt-6 bg-green-100 border border-green-400 text-green-800 px-4 py-3 rounded">
            {{ session('success') }}
        </div>
    @endif

    <div class="max-w-4xl mx-auto bg-green-50 rounded-lg shadow-md p-8">
        <form action="{{ route('contact.send') }}" method="POST" class="space-y-6">
            @csrf

            <div>
                <label for="name" class="block text-gray-700 font-medium mb-2">নাম</label>
                <input type="text" name="name" id="name" required
                       class="w-full border border-gray-300 rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-green-400">
            </div>

            <div>
                <label for="email" class="block text-gray-700 font-medium mb-2">ইমেইল</label>
                <input type="email" name="email" id="email" required
                       class="w-full border border-gray-300 rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-green-400">
            </div>

            <div>
                <label for="message" class="block text-gray-700 font-medium mb-2">বার্তা</label>
                <textarea name="message" id="message" rows="5" required
                          class="w-full border border-gray-300 rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-green-400"></textarea>
            </div>

            <div class="text-right">
                <button type="submit"
                        class="bg-green-600 hover:bg-green-700 text-white font-semibold px-6 py-3 rounded-md transition">
                    বার্তা পাঠান
                </button>
            </div>
        </form>
    </div>

    {{-- ঠিকানা ও যোগাযোগ তথ্য --}}
    <div class="max-w-4xl mx-auto mt-12 text-center text-gray-600">
        <h2 class="text-2xl font-bold text-green-700 mb-4">আমাদের ঠিকানা</h2>
        <p class="mb-1"><strong>ঠিকানা:</strong> ডেমরা স্টাফ কোয়ার্টার, সারুলিয়া, ঢাকা-১৩৬১, বাংলাদেশ</p>
        <p class="mb-1"><strong>ইমেইল:</strong> mslabdulazim2025@gmail.com</p>
        <p class="mb-1"><strong>ফোন:</strong> +880 1403022986</p>
    </div>

    {{-- লোকেশন ম্যাপ --}}
    <div class="max-w-4xl mx-auto mt-10">
        <iframe 
            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3650.5364823877936!2d90.41135557436424!3d23.79867098657645!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3755c7a353e22445%3A0x9b3b47b4b9c57b68!2sGulshan%201%2C%20Dhaka!5e0!3m2!1sen!2sbd!4v1719768158166!5m2!1sen!2sbd" 
            width="100%" height="400" style="border:0;" 
            allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"
            class="rounded-lg shadow-md"></iframe>
    </div>
</section>
@endsection
