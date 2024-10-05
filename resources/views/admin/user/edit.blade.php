@extends('admin.admin_master')
@section('content')
  <div class="page-title-head d-flex align-items-sm-center flex-sm-row flex-column gap-2">
    <div class="flex-grow-1">
      <h4 class="fs-18 fw-semibold mb-0">Quản lý ứng viên</h4>
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
    <div class="col-xl-4">
      <div class="card">
        <div class="d-flex card-header justify-content-between align-items-center">
          <h4 class="header-title">Cập nhật</h4>
        </div>
      </div>
      <div class="card-body">
        <div class="table-responsive-sm">
          <form class="needs-validation" method="POST" action="{{ route('admin.update.user', $user->id) }}">
            @csrf
            <div class="mb-3">
              <label class="form-label" for="validationCustom01">Họ và tên</label>
              <input type="text"
                class="form-control @error('fullname')
                  is-invalid
              @enderror"
                name="fullname" value="{{ $errors->has('fullname') ? '' : old('fullname', $user->fullname) }}">
              @if ($errors->has('fullname'))
                <span class="invalid-feedback">{{ $errors->first('fullname') }}</span>
              @endif
            </div>
            <div class="mb-3">
              <label class="form-label" for="validationCustom01">Email</label>
              <input type="text"
                class="form-control @error('email')
                  is-invalid
              @enderror" name="email"
                value="{{ $errors->has('email') ? '' : old('email', $user->email) }}">
              @if ($errors->has('email'))
                <span class="invalid-feedback">{{ $errors->first('email') }}</span>
              @endif
            </div>
            <div class="mb-3">
              <label class="form-label" for="validationCustom01">Số điện thoại</label>
              <input type="text"
                class="form-control @error('mobile')
                  is-invalid
              @enderror" name="mobile"
                value="{{ $errors->has('mobile') ? '' : old('mobile', $user->mobile) }}">
              @if ($errors->has('mobile'))
                <span class="invalid-feedback">{{ $errors->first('mobile') }}</span>
              @endif
            </div>
            <div class="mb-3">
              <label class="form-label" for="validationCustom02">Trạng thái</label>
              <select class="form-select @error('status')
                  is-invalid
              @enderror"
                name="status">
                <option {{ $user->status == env('STATUS_ACTIVE') ? 'selected' : '' }} value="1">Đã duyệt</option>
                <option {{ $user->status == env('STATUS_INACTIVE') ? 'selected' : '' }} value="0">Đã khóa</option>
              </select>
              <span class="invalid-feedback">{{ $errors->first('status') }}</span>
            </div>
            <button class="btn btn-primary" type="submit">Xử lý</button>
          </form>
        </div>
      </div>
    </div>
    <div class="col-xl-8">
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
                <th>Họ tên</th>
                <th>Email</th>
                <th>Số điện thoại</th>
                <th>Trạng thái</th>
                <th>Thao tác</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($users as $user)
                <tr>
                  <td>{{ $user->id }}</td>
                  <td>{{ $user->name }}</td>
                  <td>{{ $user->email }}</td>
                  <td>{{ $user->mobile }}</td>
                  <td>
                    @if ($user->status == env('STATUS_ACTIVE'))
                      <span>Đã duyệt</span>
                    @elseif ($user->status == env('STATUS_INACTIVE'))
                      <span>Đã khóa</span>
                    @endif
                  </td>
                  <td class="text-muted">
                    <a href="{{ route('admin.edit.user', $user->id) }}" class="link-reset fs-20 p-1">
                      {!! file_get_contents(public_path('admin/icon/pencil.svg')) !!}</i></a>
                    <a href="javascript: void(0);" class="link-reset fs-20 p-1"> {!! file_get_contents(public_path('admin/icon/trash.svg')) !!}</i></a>
                  </td>
                </tr>
              @endforeach
            </tbody>
          </table>
          {{ $users->links() }}
        </div> <!-- end table-responsive-->
      </div>
    </div>
  </div>
  </div>
@endsection
