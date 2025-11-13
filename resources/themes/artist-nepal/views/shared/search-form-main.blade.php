<form class="pr__form" action="{{ route('listing') }}">
    <div class="search-box">
        <h3>Search and book the best artist for your Event</h3>

        <div class="search-box__inputs">
            <select placeholder="Select Category" name="category[]"
                    class="search-box__options js-fancy-select" multiple>
                @foreach($data['categories'] as $category)
                <option
                    value="{{ $category->id }}"
                    {{ in_array($category->id, old('category', request('category', []))) ? 'selected' : '' }}
                >{{ ucwords($category->category_name) }}</option>
                @endforeach

            </select>
            <input class="search-box__input mt-5"
                   placeholder="Search using Artist name ..." id="search"
                   name="search" type="text" value="{{ old('search', request('search')) }}" />

            <select name="eras" id="eras" class="search-box__input mt-5">
                <option value="">All Eras</option>

                <option value="pioneer-era-artists" {{ request('eras') == 'pioneer-era-artists' ? 'selected' : '' }}>Pioneer Era Artists</option>
                <option value="golden-era-artists" {{ request('eras') == 'golden-era-artists' ? 'selected' : '' }}>Golden Era Artists</option>
                <option value="modern-era" {{ request('eras') == 'modern-era' ? 'selected' : '' }}>Modern Era</option>
                <option value="contemporary-era" {{ request('eras') == 'contemporary-era' ? 'selected' : '' }}>Contemporary Era</option>

            </select>

            <select name="artist_status" id="artist_status"
                    class="search-box__input mt-5">
                <option value="">All Status</option>

                <option value="active" {{ request('artist_status') == 'active' ? 'selected' : '' }}>Active</option>
                <option value="renowned" {{ request('artist_status') == 'renowned' ? 'selected' : '' }}>Renowned</option>
                <option value="veteran-legendary" {{ request('artist_status') == 'veteran-legendary' ? 'selected' : '' }}>Veteran/Legendary</option>
                <option value="late" {{ request('artist_status') == 'late' ? 'selected' : '' }}>Late</option>

            </select>
        </div>

        <p>
            <button class="uk-button uk-button-primary" type="submit">Search
                Artist</button>
        </p>
    </div>
</form>
