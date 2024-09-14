<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\InvokableRule;
use App\Models\Category;

class CheckCategoryDataDuplicate implements InvokableRule
{
    /**
     * Run the validation rule.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     * @return void
     */
    public function __invoke($attribute, $value, $fail)
    {
        $exists = Category::where('staff_id', auth()->user()->id)
                            ->where($attribute,$value)
                            ->exists();

        if($exists){
            $fail($value.' folder is already exists.');
        }
    }
}
