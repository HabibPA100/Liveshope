<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\DB;

class UniqueEmailAcrossTables implements Rule
{
    public function passes($attribute, $value)
    {
        // চেক করবে buyers এবং sellers উভয় টেবিলে
        $inBuyers = DB::table('buyers')->where('email', $value)->exists();
        $inSellers = DB::table('sellers')->where('email', $value)->exists();

        return !$inBuyers && !$inSellers;
    }

    public function message()
    {
        return 'এই ইমেইলটি দিয়ে ইতিমধ্যে ক্রেতা একাউন্ট তৈরি করা হয়েছে। দয়া করে নতুন একটি ইমেইল ব্যবহার করুন।';
    }
}
