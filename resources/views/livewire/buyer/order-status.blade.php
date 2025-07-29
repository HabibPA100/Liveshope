<div>
    @if ($orders->isNotEmpty())
        
        @foreach ($orders as $order)
            @php
                $deliveryDate = $order->created_at->copy()->addDays(3);
                $now = \Carbon\Carbon::now();
                $hideTimeline = $order->status === 'delivered' && $deliveryDate->isPast();
            @endphp

            @if($hideTimeline)
                @continue  {{-- এই অর্ডার স্কিপ করে পরেরটায় যাও --}}
            @endif

            <div class="border p-4 rounded mb-6">
                <div><strong>অর্ডার:</strong> {{ $order->unique_order_id }}</div>

                {{-- টাইমলাইন --}}
                <section class="mt-6">
                    <ol class="flex flex-col-reverse sm:flex-row justify-between relative gap-6 sm:gap-0">
                        @foreach ($statusSteps as $index => $step)
                            <li class="flex flex-row sm:flex-col items-center gap-2 text-center relative w-full">
                                
                                {{-- ড্যাশড লাইন --}}
                                @if ($index < count($statusSteps) - 1)
                                    <div class="hidden sm:block absolute top-5 left-full h-0.5 w-full border-t border-dashed 
                                        {{ $order->currentStep >= $index + 1 ? 'border-indigo-500' : 'border-gray-300' }}">
                                    </div>
                                @endif

                                {{-- সার্কেল --}}
                                <div class="w-10 h-10 flex items-center justify-center rounded-full font-bold 
                                    {{ $order->currentStep >= $index 
                                        ? 'bg-indigo-600 text-white' 
                                        : 'border-2 border-indigo-300 text-indigo-600 bg-white' }}">
                                    {{ $index + 1 }}
                                </div>

                                {{-- স্ট্যাটাস টেক্সট ও ডিটেইলস --}}
                                <div class="flex flex-col text-left sm:text-center">
                                    <p class="text-sm font-semibold">
                                        @switch($step)
                                            @case('confirmed') অর্ডার কনফার্মড @break
                                            @case('processing') প্রসেসিং @break
                                            @case('shipped') কুরিয়ারে হস্তান্তর @break
                                            @case('on_the_way') রাস্তায় আছে @break
                                            @case('delivered') ডেলিভারি সম্পন্ন @break
                                        @endswitch
                                    </p>
                                    <span class="text-sm text-gray-500">
                                        @switch($step)
                                            @case('confirmed')
                                                আপনার অর্ডারটি সফলভাবে গ্রহণ করা হয়েছে। 
                                                <br>তারিখ: {{ $order->created_at->setTimezone('Asia/Dhaka')->format('d M, h:i A') }}
                                            @break

                                            @case('processing')
                                                আমরা আপনার অর্ডারটি প্রস্তুত করছি। এটি প্যাক করা হচ্ছে। 
                                                <br>{{ $order->currentStep >= $index ? 'সম্পন্ন' : 'অপেক্ষমান' }}
                                            @break

                                            @case('shipped')
                                                অর্ডারটি কুরিয়ার সার্ভিসের কাছে হস্তান্তর করার জন্য প্রস্তুত। 
                                                <br>{{ $order->currentStep >= $index ? 'সম্পন্ন' : 'অপেক্ষমান' }}
                                            @break

                                            @case('on_the_way')
                                                আপনার অর্ডারটি এখন ডেলিভারির পথে রয়েছে। 
                                                <br>{{ $order->currentStep >= $index ? 'সম্পন্ন' : 'অপেক্ষমান' }}
                                            @break

                                            @case('delivered')
                                                আপনার অর্ডারটি শিগগিরই পৌঁছে যাবে। 
                                                <br>ডেলিভারির সম্ভাব্য তারিখ: {{ $deliveryDate->format('d M, Y') }}
                                            @break
                                        @endswitch
                                    </span>
                                </div>
                            </li>
                        @endforeach
                    </ol>
                </section>
            </div>
        @endforeach
    @endif
</div>
