<?php

namespace App\Http\Requests;

use App\Models\Contest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\ValidationException;

class UpdateContestRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
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
        $contest = Contest::$rules;
        $contest['name'] = 'required|unique:contests,name,' . $this->input('id') . ',id,deleted_at,NULL';
        $contest['contest_details'] = 'required';
        $contest['contest_date'] = 'required';
        $contest['registration_start_date'] = 'required|before_or_equal:contest_date';
        $contest['start_time'] = 'required';
        $contest['end_time'] = 'required';
        $contest['winning_award'] = 'required';
        $contest['location_id'] = 'required_if:type,Offline';

        return $contest;
    }

    /**
     * Handle a failed validation attempt.
     *
     * @param  \Illuminate\Contracts\Validation\Validator  $validator
     * @return void
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    protected function failedValidation(Validator $validator)
    {
        $response = response()->json([
            'success' => 0,
            'message' => $validator->errors()->all()
        ]);

        throw (new ValidationException($validator, $response))
            ->errorBag($this->errorBag)
            ->redirectTo($this->getRedirectUrl());
    }

}
