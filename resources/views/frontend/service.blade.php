@extends('frontend.layouts.master')

@section('title', 'Our Services')

@section('content')
    <div class="bg-white py-16 text-lg">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <!-- Header Section -->
            <div class="text-center mb-12">
                <h1>আমাদের সেবা</h1>
                <p class="text-lg text-gray-600">
                    Live Shope-এ আমরা বিশ্বাস করি, অনলাইন কেনাকাটা হতে হবে সহজ, নিরাপদ এবং সবার জন্য। আমাদের সেবাগুলো এমনভাবে তৈরি করা হয়েছে, যাতে আপনি ঘরে বসেই এক ক্লিকে পছন্দের পণ্য কিনতে এবং বিক্রি করতে পারেন।
                </p>
            </div>

            <!-- Services Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                
                <!-- Service 1 -->
                <div class="bg-gray-50 p-6 rounded-lg shadow-md hover:shadow-xl transition">
                    <h2 class="text-xl font-semibold text-gray-800 mb-2">সহজ প্রোডাক্ট আপলোড</h2>
                    <p class="text-gray-700">
                        বিক্রেতারা খুব সহজে ছবি ও বিবরণসহ প্রোডাক্ট তালিকাভুক্ত করতে পারেন। কোনো প্রযুক্তিগত জ্ঞানের দরকার নেই।
                    </p>
                </div>

                <!-- Service 2 -->
                <div class="bg-gray-50 p-6 rounded-lg shadow-md hover:shadow-xl transition">
                    <h2 class="text-xl font-semibold text-gray-800 mb-2">নিরাপদ পেমেন্ট</h2>
                    <p class="text-gray-700">
                        আমাদের গেটওয়ে বিকাশ, নগদ, ব্যাংক কার্ডসহ সব পেমেন্ট মাধ্যম সাপোর্ট করে। প্রতিটি লেনদেন এনক্রিপটেড ও নিরাপদ। তবে এখন শুধু ক্যাশ অন ডেলিভারি শুবিধা পাবেন। 
                    </p>
                </div>

                <!-- Service 3 -->
                <div class="bg-gray-50 p-6 rounded-lg shadow-md hover:shadow-xl transition">
                    <h2 class="text-xl font-semibold text-gray-800 mb-2">দ্রুত ডেলিভারি সেবা</h2>
                    <p class="text-gray-700">
                        দেশব্যাপী কুরিয়ার পার্টনারদের মাধ্যমে দ্রুত এবং নির্ভরযোগ্য ডেলিভারি সুবিধা রয়েছে, ট্র্যাকিংসহ।
                    </p>
                </div>

                <!-- Service 4 -->
                <div class="bg-gray-50 p-6 rounded-lg shadow-md hover:shadow-xl transition">
                    <h2 class="text-xl font-semibold text-gray-800 mb-2">২৪/৭ কাস্টমার সাপোর্ট</h2>
                    <p class="text-gray-700">
                        আমাদের হেল্পডেস্ক এবং লাইভ চ্যাট টিম যেকোনো সময় আপনার সমস্যার সমাধানে প্রস্তুত।</p>
                </div>

                <!-- Service 5 -->
                <div class="bg-gray-50 p-6 rounded-lg shadow-md hover:shadow-xl transition">
                    <h2 class="text-xl font-semibold text-gray-800 mb-2">বিক্রেতাদের জন্য প্রশিক্ষণ</h2>
                    <p class="text-gray-700">
                        নতুন বিক্রেতাদের জন্য রয়েছে গাইডলাইন, ভিডিও টিউটোরিয়াল এবং সরাসরি পরামর্শ সেবা।
                    </p>
                </div>

                <!-- Service 6 -->
                <div class="bg-gray-50 p-6 rounded-lg shadow-md hover:shadow-xl transition">
                    <h2 class="text-xl font-semibold text-gray-800 mb-2">রিটার্ন এবং রিফান্ড</h2>
                    <p class="text-gray-700">
                        পণ্য ত্রুটিপূর্ণ হলে নির্ধারিত সময়ের মধ্যে রিটার্ন ও রিফান্ডের সহজ ও স্বচ্ছ প্রক্রিয়া রয়েছে।
                    </p>
                </div>

                <!-- Service 7 -->
                <div class="bg-gray-50 p-6 rounded-lg shadow-md hover:shadow-xl transition">
                    <h2 class="text-xl font-semibold text-gray-800 mb-2">বাল্ক অর্ডার ও B2B</h2>
                    <p class="text-gray-700">
                        বড় পরিমাণে পণ্য অর্ডারের জন্য কর্পোরেট ও পাইকারি ক্রেতাদের জন্য রয়েছে আলাদা সুবিধা।
                    </p>
                </div>

                <!-- Service 8 -->
                <div class="bg-gray-50 p-6 rounded-lg shadow-md hover:shadow-xl transition">
                    <h2 class="text-xl font-semibold text-gray-800 mb-2">মার্কেটিং সাপোর্ট</h2>
                    <p class="text-gray-700">
                        আপনার প্রোডাক্ট প্রচারের জন্য আমরা SEO, ফেসবুক অ্যাডস, ইমেইল ক্যাম্পেইন ইত্যাদি সাহায্য করি।
                    </p>
                </div>

                <!-- Service 9 -->
                <div class="bg-gray-50 p-6 rounded-lg shadow-md hover:shadow-xl transition">
                    <h2 class="text-xl font-semibold text-gray-800 mb-2">মোবাইল অ্যাপ</h2>
                    <p class="text-gray-700">
                        আমাদের অ্যাপ দিয়ে আপনি যে কোনো সময় পণ্য ব্রাউজ, অর্ডার ও ট্র্যাক করতে পারবেন Android ও iOS-এ।
                    </p>
                </div>
            </div>

            <!-- Why Choose Us -->
            <div class="mt-20 text-center">
                <h2 class="text-2xl font-bold text-gray-800 mb-4">কেন Live Shope বেছে নেবেন?</h2>
                <p class="text-gray-600 max-w-3xl mx-auto">
                    আমরা শুধু সেবা দিই না, আপনাকে সহযোগিতা করি ব্যবসা গড়তে। আপনার প্রয়োজনের কথা ভেবেই প্রতিটি ফিচার ডিজাইন করা হয়েছে। দ্রুত ডেলিভারি, সাপোর্ট, ট্রেইনিং, এবং নিরাপদ পেমেন্ট—সব একসাথে Live Shope-এ।
                </p>
            </div>

            <!-- CTA -->
            <div class="mt-12 text-center">
                <a href="{{ route('contact') }}" class="inline-block bg-indigo-600 text-white px-6 py-3 rounded-lg hover:bg-indigo-700 transition">
                    এখনই যোগাযোগ করুন
                </a>
            </div>
        </div>
    </div>
@endsection
