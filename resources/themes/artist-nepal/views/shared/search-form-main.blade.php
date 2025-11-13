<form class="pr__form" action="{{ route('listing') }}">
    <div class="search-box">
        <h3>Search and book the best artist for your Event</h3>

        <div class="search-box__inputs">
            <select placeholder="Select Category" name="category[]"
                    class="search-box__options js-fancy-select" multiple>
                <option value="acting-coach">Acting coach</option>
                <option value="actor">Actor</option>
                <option value="actress">Actress</option>
                <option value="art">Art Director</option>
                <option value="artists">Artists</option>
                <option value="author">Author</option>
                <option value="belly-dancer">Belly Dancer</option>
                <option value="casting-director">Casting Director</option>
                <option value="charectorartists">Charector Artists,</option>
                <option value="child">Child Actor, Model</option>
                <option value="cinematographer">Cinematographer/DOP</option>
                <option value="comedian">Comedian Artists</option>
                <option value="contemporary-dance">Contemporary Dancer</option>
                <option value="dancechoreographer">Dance Choreographer</option>
                <option value="dancer">Dancer &amp; Performer</option>
                <option value="deaf-artist-artist">Deaf Artist</option>
                <option value="digitalartist">Digital Artist</option>
                <option value="dj">DJ/Producers</option>
                <option value="drummer">Drummer</option>
                <option value="esraj-player">Esraj Player</option>
                <option value="glamour">fashion &amp; glamour</option>
                <option value="choreographer">Fashion choreographer</option>
                <option value="fashion-designer">Fashion Designer</option>
                <option value="fashion">Fashion Photographer</option>
                <option value="film-artists">Film Artists</option>
                <option value="filmdirector">Film director</option>
                <option value="film-maker-producer">Film maker/ Producer
                </option>
                <option value="flautist">Flautist</option>
                <option value="folk">Folk Singer</option>
                <option value="folk-dancer">Folk/cultural Dancer</option>
                <option value="guinness-world-records-holder">guinness world
                    records holder</option>
                <option value="guitarist-music-instrumental-player">Guitarist
                </option>
                <option value="hip-hop">Hip Hop Dancer</option>
                <option value="journalist">Journalist</option>
                <option value="keyboardist">Keyboardist</option>
                <option value="litterateur">Literaturist</option>
                <option value="lyricist">Lyricist</option>
                <option value="madal-player">Madal Player</option>
                <option value="magician">Magician</option>
                <option value="makeup">Make-up &amp; Hair Artists</option>
                <option value="media-personality">Media personality</option>
                <option value="model">Model</option>
                <option value="music-arranger">Music Arranger</option>
                <option value="music-artists">Music artists</option>
                <option value="musicband">Music Band</option>
                <option value="music-director">Music Director</option>
                <option value="musician">Music Instructor</option>
                <option value="music-instrumental-player">Music Instrumentalist
                </option>
                <option value="video-director">Music Video TVC Director</option>
                <option value="percussionist">Percussionist</option>
                <option value="photographer">Photographer</option>
                <option value="playback">playback singer</option>
                <option value="pop-artist">pop artist</option>
                <option value="painter">Professional painter</option>
                <option value="pomotional">Promotional Model</option>
                <option value="publicity-designer">Publicity Designer</option>
                <option value="rj">Radio Jockey [RJ]</option>
                <option value="rapper">Rapper</option>
                <option value="runway">Runway Model</option>
                <option value="sarangi-player">sarangi player</option>
                <option value="saxophonist">Saxophonist</option>
                <option value="screenwriter">Screenwriter</option>
                <option value="singer-performer">Singer/ Performer</option>
                <option value="songwriter">songwriter</option>
                <option value="sound-engineer">Sound Engineer</option>
                <option value="stand-up-comedy">Stand-up comedy</option>
                <option value="tabla-players">Tabla Players</option>
                <option value="theatre">Theatre Artists</option>
                <option value="television-presenter">TV presenter/ Host</option>
                <option value="tv-producers">TV Producers</option>
                <option value="vj">video jockey (VJ)</option>
                <option value="video-film-editor">Video-film editor, animator
                </option>
                <option value="violinist">Violinist</option>
                <option value="voiceover-artist">Voiceover artist</option>
                <option value="wildlife">wililife photogrrapher</option>
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
