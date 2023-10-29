<?php

namespace App\Http\Requests\Item;

use App\Enums\Currency;
use App\Models\Category;
use BenSampo\Enum\Rules\EnumValue;
use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
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
        return [
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'currency' => ['required', new EnumValue(Currency::class)],
            'category_id' => 'required|exists:categories,id'
        ];
    }

    public function getCategory(): Category
    {
        return Category::find($this->category_id);
    }

    public function getCurrency(): Currency
    {
        return Currency::fromValue($this->currency);
    }
}
