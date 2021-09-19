<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use App\Service\Twilio\PhoneNumberLookupService;

class PhoneNumber implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    private $service;

    public function __construct(
        PhoneNumberLookupService $phoneNumberLookupService
    ) {
        $this->service = $phoneNumberLookupService;
    }

    public function passes($attribute, $value): bool
    {
        return $this->service->validate($value);
    }

    public function message()
    {
        return 'The phone number you provided must be in either national or international format.';
    }
}
