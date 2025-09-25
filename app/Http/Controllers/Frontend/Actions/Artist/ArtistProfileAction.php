<?php

namespace App\Http\Controllers\Frontend\Actions\Artist;

use Foundation\Enums\MediaType;
use Foundation\Models\ArtistMedia;
use Foundation\Models\Category;
use Foundation\Models\User;
use Foundation\Requests\Frontend\Artist\ArtistProfileRequest;
use Illuminate\Http\Request;
use Foundation\Models\ArtistProfile;

readonly class ArtistProfileAction
{

    public function __construct(
        private ArtistProfile $artistProfile
    ) {}

    public function __invoke(ArtistProfileRequest $request)
    {
        if ($request->isMethod('PUT')) {
            $validated = $request->validated();

            if ($request->filled('old_password') && $request->filled('new_password')) {
                if (!\Hash::check($request->old_password, auth()->user()->password)) {
                    return back()->withErrors(['old_password' => 'Old password does not match.']);
                }

                auth()->user()->update(['password' => \Hash::make($request->new_password)]);
            }

            if ($request->hasFile('banner_holder')) {
                $banner_image = ArtistProfile::attachImage($request->file('banner_holder'), false, auth()->user()->image);
            }

            $artistProfile = $this->artistProfile->newQuery()->updateOrCreate([
                'user_id' => auth()->id(),
            ], array_merge($validated, array_filter([
                'banner_image' => $banner_image ?? null,
            ])));

            $this->updateEssentials($artistProfile, $request, $validated);

            flash('success', 'Profile updated successfully.');
            return back();
        }

        $data['profile'] = $this->artistProfile->newQuery()
            ->with('testimonials', 'medias')
            ->where('user_id', auth()->id())
            ->first();


        $data['profile'] = $data['profile']->forceFill(
            auth()->user()->only([
                'dob', 'gender', 'first_name', 'middle_name', 'last_name'
            ])
        );

        $data['categories'] = Category::query()
            ->where('type', \Foundation\Enums\Category::ARTIST->value)
            ->pluck('category_name', 'id');

        return view('pages.artist.profile', compact('data'));
    }

    private function updateEssentials(ArtistProfile $artistProfile, Request $request, array $validated)
    {
        $this->updateUser($request, $validated);
        $this->updateTestimonials($artistProfile, $request, $validated);
        $this->updateMedias($artistProfile, $request, $validated);
    }

    private function updateUser(Request $request, array $validated)
    {
        $data = [];

        if ($request->filled('first_name')) {
            $data['first_name'] = $validated['first_name'];
        }

        if ($request->filled('middle_name')) {
            $data['middle_name'] = $validated['middle_name'];
        }

        if ($request->filled('last_name')) {
            $data['last_name'] = $validated['last_name'];
        }

        if ($request->filled('dob')) {
            $data['dob'] = $validated['dob'];
        }

        if ($request->filled('gender')) {
            $data['gender'] = $validated['gender'];
        }

        if ($request->hasFile('image_holder')) {
            $data['image'] = User::attachImage($request->file('image_holder'), false, auth()->user()->image);
        }

        if (!empty($data)) {
            auth()->user()->update($data);
        }
    }

    private function updateTestimonials(ArtistProfile $artistProfile, Request $request, array $validated)
    {
        if ($request->has('testimonials')) {
            $testimonials = $validated['testimonials'];

            foreach ($testimonials as $testimonialData) {
                $artistProfile->testimonials()->updateOrCreate(
                    ['id' => $testimonialData['id'] ?? null],
                    $testimonialData
                );
            }
        }
    }

    private function updateMedias(ArtistProfile $artistProfile, Request $request, array $validated)
    {
        if (!empty($validated['medias'])) {
            foreach ($validated['medias'] as $index => $mediaData) {

                if (($mediaData['media_type'] ?? null) == MediaType::IMAGE->value && $request->hasFile("medias.$index.media")) {

                    $mediaData['url'] = ArtistMedia::attachImage(
                        $request->file("medias.$index.media")
                    );
                }

                if (($mediaData['media_type'] ?? null) == MediaType::VIDEO->value) {
                    $mediaData['url'] = $mediaData['media'] ?? null;
                }

                $artistProfile->medias()->updateOrCreate(
                    ['id' => $mediaData['id'] ?? null],
                    $mediaData
                );
            }
        }
    }

}
