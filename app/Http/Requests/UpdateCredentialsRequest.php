<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Service\Twilio\PhoneNumberLookupService;
use App\Rules\PhoneNumber;

class UpdateCredentialsRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    private $service;

    public function __construct(PhoneNumberLookupService $service)
    {
        $this->service = $service;
    }

    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'phone' => ['required', 'string', 'unique:users,phone,' . auth()->user()->id, new PhoneNumber($this->service)],
        ];
    }
}
