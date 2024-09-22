{{ Str::words(strip_tags($featureJob->description), 5, "...") }}
{!! nl2br($job->description) !!}
{{ \Carbon\Carbon::parse($item->created_at)->format("d/m/Y") }}
{!! file_get_contents(public_path("admin/icon/circle-arrow-left.svg")) !!}
findOrFail
firstOrFail
$product = Product::findOrFail($id);
