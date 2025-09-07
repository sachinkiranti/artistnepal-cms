<rss version="2.0" xmlns:content="http://purl.org/rss/1.0/modules/content/">
    <channel>
        <title>{{ $title }}</title>
        <link>{{ url('/') }}</link>
        <description>
            A short description about your blog.
        </description>
        <language>en-us</language>
        <lastBuildDate>{{ date('c') }}</lastBuildDate>
        @forelse($news as $post)
            <item>
                <title><![CDATA[{{ $post->title }}]]></title>
                <link>{{ route('post.single', ['slug' => $post->unique_identifier]) }}</link>
                <guid>{{ $post->guid }}</guid>
                <pubDate>{{ date('c', strtotime($post->created_at)) }}</pubDate>
                <author>{{ $post->author_full_name }}</author>
                <description><![CDATA[{{ resolve_description($post->content, 200) }}]]></description>
                <content:encoded>
                    <![CDATA[
                    @include('pages.shared._rss')
                    ]]>
                </content:encoded>
            </item>
        @empty
            <item>No feeds found</item>
        @endforelse
    </channel>
</rss>
