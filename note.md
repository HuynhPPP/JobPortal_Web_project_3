{{ Str::words(strip_tags($featureJob->description), 5, "...") }}
{!! nl2br($job->description) !!}
{{ \Carbon\Carbon::parse($item->created_at)->format("d/m/Y") }}
{!! file_get_contents(public_path("admin/icon/circle-arrow-left.svg")) !!}
findOrFail
firstOrFail
$product = Product::findOrFail($id);

<div class="row g-2">
              <div class="mb-3 col-md-6">
                <label for="title" class="form-label">Tỉnh/TP</label>
                <input type="text" class="form-control" id="title" name="title">
              </div>
              <div class="mb-3 col-md-6">
                <label for="title" class="form-label">Quận/huyện</label>
                <input type="text" class="form-control" id="title" name="title">
              </div>
            </div>
            <div class="row g-2">
              <div class="mb-3 col-md-6">
                <label for="title" class="form-label">Xã/phường</label>
                <input type="text" class="form-control" id="title" name="title">
              </div>
              <div class="mb-3 col-md-6">
                <label for="title" class="form-label">Địa chỉ cụ thể</label>
                <input type="text" class="form-control" id="title" name="title">
              </div>
</div>
