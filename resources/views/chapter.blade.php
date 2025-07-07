@foreach ($pages as $page)
    <img src="{{ asset('storage/'.$page->image_path) }}" style="width:100%">
@endforeach
