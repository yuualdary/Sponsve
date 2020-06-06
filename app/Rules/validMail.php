<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use App\companies;
use Illuminate\Support\Facades\DB;


class validMail implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($mail)
    {
        //
       $this->mail=$mail;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        //


        $companyEmail=DB::table('companies')
        ->where([['companies.website_address','=',$this->mail]])
        ->get();

        if(count($companyEmail) == NULL){

            return true;}
            else{

                return false;
            
        }
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Your email has taken by another user';
    }
}
