<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Carbon;

class CheckoutRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $now = Carbon::now()->format('H:i');
        $openTime = '08:00';
        $closeTime = '16:00';

        $rules = [
            'billing_method' => ['required'],
            'pickup_time' => [
                'required',
                'date_format:H:i',
                'after_or_equal:' . $openTime,
                'before_or_equal:' . $closeTime,
            ]
        ];

        $currentTime = Carbon::now();
        $openConfig = Carbon::today()->setTimeFromTimeString($openTime);
        $closeConfig = Carbon::today()->setTimeFromTimeString($closeTime);

        // Jika pesanan dilakukan di antara jam buka, jam pengambilan harus setelah waktu saat ini
        if ($currentTime->between($openConfig, $closeConfig)) {
            $rules['pickup_time'][] = 'after:' . $now;
        }

        return $rules;
    }

    public function messages(): array
    {
        return [
            'billing_method.required' => 'Perlu memilih metode pembayaran',
            'pickup_time.required' => 'Perlu mengisi jam pengambilan',
            'pickup_time.date_format' => 'Gunakan format waktu 24 jam (HH:MM)',
            'pickup_time.after_or_equal' => 'Kantin buka mulai pukul 08:00',
            'pickup_time.before_or_equal' => 'Kantin tutup pada pukul 16:00',
            'pickup_time.after' => 'Jam pengambilan tidak boleh kurang dari waktu saat ini',
        ];
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'billing_method' => strtolower($this->billing_method)
        ]);
    }


}
