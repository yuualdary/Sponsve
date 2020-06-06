<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class dateValidation implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($start,$end)
    {
        //


        $this->start=$start;
        $this->end=$end;
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

        date_default_timezone_set('Asia/Jakarta');
            $currtime=date('Y-m-d H:i');    

        if($this->start<=$currtime){

           return false;
        }
        elseif($this->start >= $this->end || $this->end <= $this->start ){

            return false;
        }
        else {


            return true;
        }



    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        

        return 'Please make sure your date is correct';
    }
}
