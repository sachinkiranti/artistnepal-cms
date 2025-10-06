<?php

namespace Foundation\Requests\Frontend\Artist;

use App\Foundation\Enums\Role;
use Foundation\Enums\MediaType;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ArtistProfileRequest extends FormRequest
{

    public function authorize(): bool
    {
        return auth()->check() && auth()->user()->hasRole( Role::ROLE_ARTIST->value ) || true;
    }

    public function rules(): array
    {
        if ($this->isMethod('PUT')) {
            return [
                'first_name' => 'required|min:2',
                'middle_name' => 'sometimes|nullable|string',
                'last_name' => 'required|min:2',

                'old_password' => 'sometimes|nullable|required_with:new_password|string',
                'new_password' => 'sometimes|nullable|required_with:old_password|string|min:8|confirmed',

                'image' => 'sometimes|nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'user_id'       => ['nullable', 'integer', 'exists:users,id'],
                'gender'        => ['nullable', 'integer', 'in:0,1,2'],
                'profession_id' => ['nullable', 'integer', 'exists:categories,id'],
                'banner_image'  => ['nullable', 'image', 'mimes:jpg,jpeg,png', 'max:2048'],
                'start_year'    => ['nullable', 'digits:4', 'integer', 'min:1900', 'max:' . date('Y')],
                'father_name'   => ['nullable', 'string', 'max:100'],
                'mother_name'   => ['nullable', 'string', 'max:100'],
                'email_address' => ['nullable', 'email', 'max:150'],
                'telephone'     => ['nullable', 'string', 'max:20'],
                'mobile'        => ['nullable', 'string', 'max:20'],
                'social_links'  => ['nullable', 'array'],
                'social_links.*'=> ['nullable', 'url'],
                'bio'           => ['nullable', 'string', 'max:5000'],
                'experiences'   => ['nullable', 'string', 'max:2000'],

                'awards'        => ['nullable', 'array'],
                'awards.*.title'=> ['required_with:awards|string|max:150'],
                'awards.*.date' => ['required_with:awards|date_format:Y-m-d'],

                'dob' => ['nullable', 'date', 'before:today'],

                'testimonials'                => ['nullable', 'array'],
                'testimonials.*.id'           => ['nullable', 'integer', 'exists:artist_testimonials,id'],
                'testimonials.*.content'      => ['required', 'string', 'max:300'],
                'testimonials.*.endorser'     => ['required', 'string', 'max:150'],
                'testimonials.*.endorser_title'=> ['required', 'string', 'max:150'],

                'medias'                => ['nullable', 'array'],
                'medias.*.id'           => ['nullable', 'integer', 'exists:artist_medias,id'],
                'medias.*.media_type'   => ['required', 'integer', 'in:' . MediaType::IMAGE->value . ',' . MediaType::VIDEO->value],
                'medias.*.media'        => [
                    'required_without:medias.*.id',
                    function ($attribute, $value, $fail) {
                    $index = explode('.', $attribute)[1];
                    $type = $this->input("medias.$index.media_type");

                    if ($type == MediaType::IMAGE->value) {
                        if (!$this->hasFile("medias.$index.media")) {
                            return $fail("The {$attribute} must be an uploaded image.");
                        }
                        $file = $this->file("medias.$index.media");
                        if (!in_array($file->extension(), ['jpg','jpeg','png','gif','webp'])) {
                            return $fail("The {$attribute} must be a valid image type.");
                        }
                        if ($file->getSize() > 2*1024*1024) {
                            return $fail("The {$attribute} must not exceed 2MB.");
                        }
                    } elseif ($type == MediaType::VIDEO->value) {
                        if (!filter_var($value, FILTER_VALIDATE_URL)) {
                            return $fail("The {$attribute} must be a valid URL for video.");
                        }
                    }
                }],
                'medias.*.title'       => ['required', 'string', 'max:150'],
                'medias.*.description' => ['nullable', 'string', 'max:400'],
            ];
        }

        return [];
    }

}
