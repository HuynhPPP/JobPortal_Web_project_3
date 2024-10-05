@extends('admin.admin_master')
@section('content')
  <div class="page-title-head d-flex align-items-sm-center flex-sm-row flex-column gap-2">
    <div class="flex-grow-1">
      <h4 class="fs-18 fw-semibold mb-0">Quản lý tin tuyển dụng</h4>
    </div>
    <form class="row row-cols-lg-auto g-2 align-items-center">
      <div class="col">
        <input type="password" class="form-control" id="inputPassword2" placeholder="Tên việc cần tìm?">
      </div>
      <div class="col">
        <input class="form-control" id="example-date" type="date" name="date">
      </div>
      <div class="col">
        <button type="submit" class="btn btn-success">Tìm kiếm</button>
      </div>
    </form>
  </div>
  <div class="row">
    <div class="col-xl-12">
      <div class="card">
        <div class="d-flex card-header justify-content-between align-items-center">
          <h4 class="header-title">Danh sách</h4>
        </div>
      </div>
      <div class="card-body">
        <div class="table-responsive-sm">
          <table class="table table-striped mb-0">
            <thead>
              <tr>
                <th>ID</th>
                <th>Tiêu đề</th>
                <th>Trạng thái</th>
                <th>Tên ngành nghề</th>
                <th>Thời gian</th>
                <th class="text-center">Thao tác</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($jobs as $item)
                <tr>
                  <td>{{ $item->id }}</td>
                  <td>{{ $item->title }}</td>
                  <td>
                    @if ($item->status == 1)
                      <span>Đã duyệt</span>
                    @elseif ($item->status == 2)
                      <span>Chờ duyệt</span>
                    @elseif ($item->status == 0)
                      <span>Ẩn</span>
                    @else
                      <span>Đã hủy</span>
                    @endif
                  </td>
                  <td>{{ $item->career->name }}</td>
                  <td>{{ \Carbon\Carbon::parse($item->created_at)->format('d/m/Y') }}</td>
                  <td class="text-muted text-center">
                    <a href="{{ route('admin.edit.job', $item->id) }}" class="link-reset fs-20 p-1">
                      {!! file_get_contents(public_path('admin/icon/pencil.svg')) !!}</i></a>
                  </td>
                </tr>
              @endforeach
            </tbody>
          </table>
          {{ $jobs->links() }}
        </div> <!-- end table-responsive-->
      </div> <!-- end card body-->
    </div> <!-- end card -->
  </div><!-- end col-->
  </div>
@endsection
