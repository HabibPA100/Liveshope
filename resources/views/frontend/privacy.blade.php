@extends('frontend.layouts.master')

@section('title', 'গোপনীয়তা নীতিমালা')

@section('content')
    <div class="bg-gray-50 py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <!-- Header -->
            <div class="text-center mb-12">
                <h1>গোপনীয়তা নীতিমালা</h1>
                <p class="text-lg text-gray-600">Live Shope আপনার ব্যক্তিগত তথ্যের নিরাপত্তা নিশ্চিত করতে দৃঢ়প্রতিজ্ঞ। নিচে আমাদের ৯টি গোপনীয়তা নীতিমালা তুলে ধরা হলো।</p>
            </div>

            <!-- Cards Grid -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">

                <!-- Card 1 -->
                <div class="bg-blue-100 p-6 rounded-xl shadow hover:shadow-lg transition">
                    <h2 class="text-xl font-bold text-blue-800 mb-2">১. তথ্য সংগ্রহ</h2>
                    <p class="text-gray-800">
                        আমরা আপনার নাম, মোবাইল নম্বর, ইমেইল এবং ঠিকানাসহ প্রয়োজনীয় তথ্য সংগ্রহ করি যখন আপনি অ্যাকাউন্ট তৈরি বা অর্ডার দেন।
                    </p>
                </div>

                <!-- Card 2 -->
                <div class="bg-green-100 p-6 rounded-xl shadow hover:shadow-lg transition">
                    <h2 class="text-xl font-bold text-green-800 mb-2">২. ব্যবহারের উদ্দেশ্য</h2>
                    <p class="text-gray-800">
                        আপনার তথ্য আমাদের সেবা উন্নয়ন, অর্ডার নিশ্চিতকরণ, এবং গ্রাহক সহায়তার জন্য ব্যবহার করা হয়।
                    </p>
                </div>

                <!-- Card 3 -->
                <div class="bg-yellow-100 p-6 rounded-xl shadow hover:shadow-lg transition">
                    <h2 class="text-xl font-bold text-yellow-800 mb-2">৩. কুকিজ নীতি</h2>
                    <p class="text-gray-800">
                        আপনার ব্রাউজিং অভিজ্ঞতা উন্নত করতে আমরা কুকিজ ও ট্র্যাকিং প্রযুক্তি ব্যবহার করি।
                    </p>
                </div>

                <!-- Card 4 -->
                <div class="bg-pink-100 p-6 rounded-xl shadow hover:shadow-lg transition">
                    <h2 class="text-xl font-bold text-pink-800 mb-2">৪. তৃতীয় পক্ষের তথ্য শেয়ার</h2>
                    <p class="text-gray-800">
                        আমরা আপনার তথ্য তৃতীয় পক্ষের কাছে বিক্রি করি না, তবে সেবা দিতে প্রয়োজনে বিশ্বস্ত পার্টনারদের সঙ্গে শেয়ার করতে পারি।
                    </p>
                </div>

                <!-- Card 5 -->
                <div class="bg-purple-100 p-6 rounded-xl shadow hover:shadow-lg transition">
                    <h2 class="text-xl font-bold text-purple-800 mb-2">৫. তথ্য নিরাপত্তা</h2>
                    <p class="text-gray-800">
                        আপনার তথ্য এনক্রিপশন ও সুরক্ষিত সার্ভারে সংরক্ষিত থাকে। আমাদের সিস্টেম সর্বোচ্চ নিরাপত্তা বজায় রাখে।
                    </p>
                </div>

                <!-- Card 6 -->
                <div class="bg-red-100 p-6 rounded-xl shadow hover:shadow-lg transition">
                    <h2 class="text-xl font-bold text-red-800 mb-2">৬. ব্যবহারকারীর অধিকার</h2>
                    <p class="text-gray-800">
                        আপনি যেকোনো সময় আপনার তথ্য দেখতে, পরিবর্তন করতে বা মুছে ফেলতে পারেন। এছাড়াও অপ্ট-আউট করার সুযোগ রয়েছে।
                    </p>
                </div>

                <!-- Card 7 -->
                <div class="bg-teal-100 p-6 rounded-xl shadow hover:shadow-lg transition">
                    <h2 class="text-xl font-bold text-teal-800 mb-2">৭. শিশুদের গোপনীয়তা</h2>
                    <p class="text-gray-800">
                        ১৩ বছরের কম বয়সী কারো কাছ থেকে আমরা ইচ্ছাকৃতভাবে কোনো তথ্য সংগ্রহ করি না এবং আমাদের সেবা তাদের জন্য নয়।
                    </p>
                </div>

                <!-- Card 8 -->
                <div class="bg-indigo-100 p-6 rounded-xl shadow hover:shadow-lg transition">
                    <h2 class="text-xl font-bold text-indigo-800 mb-2">৮. নীতিমালার পরিবর্তন</h2>
                    <p class="text-gray-800">
                        সময়ের সাথে সাথে আমাদের গোপনীয়তা নীতিমালায় পরিবর্তন হতে পারে, যা ওয়েবসাইটে আপডেট করা হবে।
                    </p>
                </div>

                <!-- Card 9 -->
                <div class="bg-orange-100 p-6 rounded-xl shadow hover:shadow-lg transition">
                    <h2 class="text-xl font-bold text-orange-800 mb-2">৯. যোগাযোগ করুন</h2>
                    <p class="text-gray-800">
                        কোনো প্রশ্ন থাকলে ইমেইল করুন <a href="mailto:support@liveshope.com" class="underline text-orange-700">support@liveshope.com</a> অথবা <a href="{{ route('contact') }}" class="underline text-orange-700">যোগাযোগ পেজ</a> ভিজিট করুন।
                    </p>
                </div>
            </div>

            <!-- CTA -->
            <div class="mt-16 text-center">
                <a href="{{ url('/') }}" class="inline-block bg-indigo-600 text-white px-6 py-3 rounded-lg hover:bg-indigo-700 transition">
                    হোম পেজে ফিরে যান
                </a>
            </div>

        </div>
    </div>
@endsection
