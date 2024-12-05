@extends('front.layouts.app')

@section('main')
  <section class="section-5 bg-2">
    <div class="container py-5">
      <div class="row">
        <div class="col">
          <nav aria-label="breadcrumb" class=" rounded-3 p-3 mb-4">
            <ol class="breadcrumb mb-0">
              <li class="breadcrumb-item"><a href="{{ route('home') }}">Trang chủ</a></li>
              <li class="breadcrumb-item active">Cài đặt tài khoản</li>
            </ol>
          </nav>
        </div>
      </div>
      <div class="row">
        <div class="col-lg-3">
          @include('front.account.sidebar')
        </div>
        <div class="col-lg-9">
          @include('front.message')

          <form action="" method="post" id="editJobForm" name="editJobForm">
            <div class="card border-0 shadow mb-4">
              <div class="card-body card-form p-4">
                <h3 class="fs-4 mb-1">Chỉnh sửa công việc</h3>
                <div class="row">
                  <div class="col-md-6 mb-4">
                    <label for="" class="mb-2">Tiêu đề<span class="req">*</span></label>
                    <input type="text" placeholder="Tiêu đề công việc" id="title" name="title"
                      class="form-control" value="{{ $job->title }}">
                    <p></p>
                  </div>
                  <div class="col-md-6 mb-4">
                    <label for="" class="mb-2">Ngành nghề<span class="req">*</span></label>
                    <select name="category" id="category" class="form-control">
                      <option value="">Chọn ngành nghề</option>
                      @if ($careers->isNotEmpty())
                        @foreach ($careers as $career)
                          <option {{ $job->career_id == $career->id ? 'selected' : '' }} value="{{ $career->id }}">
                            {{ $career->name }}
                          </option>
                        @endforeach
                      @endif
                    </select>
                    <p></p>
                  </div>
                </div>

                <div class="row">
                  <div class="col-md-6 mb-4">
                    <label for="" class="mb-2">Hình thức làm việc<span class="req">*</span></label>
                    <select name="jobType" id="jobType" class="form-select">
                      <option value="">Chọn hình thức làm việc</option>
                      @if ($jobtypes->isNotEmpty())
                        @foreach ($jobtypes as $jobtype)
                          <option {{ $job->job_type_id == $jobtype->id ? 'selected' : '' }} value="{{ $jobtype->id }}">
                            {{ $jobtype->name }}
                          </option>
                        @endforeach
                      @endif
                    </select>
                    <p></p>
                  </div>
                  <div class="col-md-6 mb-4">
                    <label for="" class="mb-2">Số lượng tuyển<span class="req">*</span></label>
                    <input type="number" min="1" placeholder="Số lượng tuyển" id="vacancy" name="vacancy"
                      class="form-control" value="{{ $job->vacancy }}">
                    <p></p>
                  </div>
                </div>

                <div class="row">
                  <div class="mb-4 col-md-6">
                    <label for="" class="mb-2">Mức lương</label>
                    <input type="text" placeholder="Mức lương" id="salary" name="salary" class="form-control"
                      value="{{ $job->salary }}">
                  </div>

                  <div class="mb-4 col-md-6">
                    <label for="" class="mb-2">Vị trí cần tuyển<span class="req">*</span></label>
                    <input type="text" placeholder="Cấp bậc" id="level" name="level" class="form-control"
                      value="{{ $job->job_level }}">
                    <p></p>
                  </div>
                </div>

                <div class="mb-4">
                  <label for="" class="mb-2">Mô tả</label>
                  <textarea class="textarea" name="description" id="description" cols="5" rows="5"
                    placeholder="Mô tả công việc">
                                    {{ $job->description }}
                                </textarea>
                </div>
                <div class="mb-4">
                  <label for="" class="mb-2">Phúc lợi</label>
                  <textarea class="textarea" name="benefits" id="benefits" cols="5" rows="5" placeholder="Phúc lợi">
                                    {{ $job->benefits }}
                                </textarea>
                </div>
                <div class="mb-4">
                  <label for="" class="mb-2">Trách nhiệm</label>
                  <textarea class="textarea" name="responsibility" id="responsibility" cols="5" rows="5"
                    placeholder="Trách nhiệm">
                                    {{ $job->responsibility }}
                                </textarea>
                </div>
                <div class="mb-4">
                  <label for="" class="mb-2">Yêu cầu</label>
                  <textarea class="textarea" name="qualifications" id="qualifications" cols="5" rows="5"
                    placeholder="Nhập yêu cầu công việc...">
                                    {{ $job->qualifications }}
                                </textarea>
                </div>

                <div class="mb-4">
                  <label for="" class="mb-2">Kinh nghiệm</label>
                  <select name="experience" id="experience" class="form-control">
                    <option value="1" {{ $job->experience == 1 ? 'selected' : '' }}>1 năm</option>
                    <option value="2" {{ $job->experience == 2 ? 'selected' : '' }}>2 năm</option>
                    <option value="3" {{ $job->experience == 3 ? 'selected' : '' }}>3 năm</option>
                    <option value="4" {{ $job->experience == 4 ? 'selected' : '' }}>4 năm</option>
                    <option value="5" {{ $job->experience == 5 ? 'selected' : '' }}>5 năm</option>
                    <option value="6" {{ $job->experience == 6 ? 'selected' : '' }}>6 năm</option>
                    <option value="7" {{ $job->experience == 7 ? 'selected' : '' }}>7 năm</option>
                    <option value="8" {{ $job->experience == 8 ? 'selected' : '' }}>8 năm</option>
                    <option value="9" {{ $job->experience == 9 ? 'selected' : '' }}>9 năm</option>
                    <option value="10" {{ $job->experience == 10 ? 'selected' : '' }}>10 năm</option>
                    <option value="10_plus" {{ $job->experience == '10_plus' ? 'selected' : '' }}>Trên 10 năm</option>
                  </select>
                </div>

                <div class="mb-4">
                  <label for="" class="mb-2">Từ khóa<span class="req">*</span></label>
                  <input type="text" placeholder="Nhập từ khóa..." id="keywords" name="keywords"
                    class="form-control" value="{{ $job->keywords }}">
                  <p></p>
                </div>

                <h3 class="fs-4 mb-1 mt-5 border-top pt-5">Chi tiết công ty</h3>

                <div class="row">
                  <div class="mb-4">
                    <label for="" class="mb-2">Tên công ty<span class="req">*</span></label>
                    <input type="text" placeholder="Nhập tên công ty..." id="company_name" name="company_name"
                      class="form-control" value="{{ $job->company_name }}">
                    <p></p>
                  </div>

                  <div class="mb-4">
                    <label for="address" class="form-label">Địa chỉ</label>
                    <div class="input-group mb-3">
                      <select class="form-select" id="province" name="province">
                        @if (!empty($job->province))
                          <option selected>{{ $job->province }}</option>
                        @else
                          <option selected>Chọn tỉnh / thành</option>
                        @endif
                      </select>
                      <input type="hidden" id="province_name" name="province_name">

                      <select class="form-select" id="district" name="district">
                        @if (!empty($job->district))
                          <option selected>{{ $job->district }}</option>
                        @else
                          <option selected>Chọn tỉnh / thành</option>
                        @endif
                      </select>
                      <input type="hidden" id="district_name" name="district_name">

                      <select class="form-select" id="wards" name="wards">
                        @if (!empty($job->wards))
                          <option selected>{{ $job->wards }}</option>
                        @else
                          <option selected>Chọn tỉnh / thành</option>
                        @endif
                      </select>
                      <input type="hidden" id="ward_name" name="ward_name">
                    </div>
                    <label for="" class="mb-2">Địa chỉ chi tiết</label>
                    <input type="text" class="form-control" id="location_detail" name="location_detail"
                      placeholder="Ví dụ: Tầng 14, Richy Tower, Phường Yên Hoà, Quận Cầu Giấy, Thành phố Hà Nội"
                      value="{{ $job->location_detail }}">
                  </div>

                </div>

                <div class="mb-4">
                  <label for="" class="mb-2">Website</label>
                  <input type="text" placeholder="Nhập địa chỉ website..." id="company_website"
                    name="company_website" class="form-control" value="{{ $job->company_website }}">
                </div>
              </div>
              <div class="card-footer p-4">
                <button type="submit" class="btn btn-primary">Lưu công việc</button>
              </div>
            </div>
          </form>

        </div>
      </div>
    </div>
  </section>
@endsection

@section('customJs')
  <script type="text/javascript">
    $("#editJobForm").submit(function(e) {
      e.preventDefault();
      $("button[type=submit]").prop("disabled", true);
      $.ajax({
        url: '{{ route('account.updateJob', $job->id) }}',
        type: 'POST',
        dataType: 'json',
        data: $("#editJobForm").serializeArray(),
        success: function(response) {
          $("button[type=submit]").prop("disabled", false);
          if (response.status == true) {
            $("#title").removeClass('is-invalid')
              .siblings('p')
              .removeClass('invalid-feedback')
              .html('');

            $("#category").removeClass('is-invalid')
              .siblings('p')
              .removeClass('invalid-feedback')
              .html('');

            $("#jobType").removeClass('is-invalid')
              .siblings('p')
              .removeClass('invalid-feedback')
              .html('');

            $("#vacancy").removeClass('is-invalid')
              .siblings('p')
              .removeClass('invalid-feedback')
              .html('');

            $("#location").removeClass('is-invalid')
              .siblings('p')
              .removeClass('invalid-feedback')
              .html('');

            $("#description").removeClass('is-invalid')
              .siblings('p')
              .removeClass('invalid-feedback')
              .html('');

            $("#keyword").removeClass('is-invalid')
              .siblings('p')
              .removeClass('invalid-feedback')
              .html('');

            $("#company_name").removeClass('is-invalid')
              .siblings('p')
              .removeClass('invalid-feedback')
              .html('');

            window.location.href = "{{ route('account.myJobs') }}";
          } else {
            var errors = response.errors;

            // Title
            if (errors.title) {
              $("#title").addClass('is-invalid')
                .siblings('p')
                .addClass('invalid-feedback')
                .html(errors.title);
            } else {
              $("#title").removeClass('is-invalid')
                .siblings('p')
                .removeClass('invalid-feedback')
                .html('');
            }
            // Category
            if (errors.category) {
              $("#category").addClass('is-invalid')
                .siblings('p')
                .addClass('invalid-feedback')
                .html(errors.category);
            } else {
              $("#category").removeClass('is-invalid')
                .siblings('p')
                .removeClass('invalid-feedback')
                .html('');
            }
            // JobType
            if (errors.jobType) {
              $("#jobType").addClass('is-invalid')
                .siblings('p')
                .addClass('invalid-feedback')
                .html(errors.jobType);
            } else {
              $("#jobType").removeClass('is-invalid')
                .siblings('p')
                .removeClass('invalid-feedback')
                .html('');
            }
            // Vacancy
            if (errors.vacancy) {
              $("#vacancy").addClass('is-invalid')
                .siblings('p')
                .addClass('invalid-feedback')
                .html(errors.vacancy);
            } else {
              $("#vacancy").removeClass('is-invalid')
                .siblings('p')
                .removeClass('invalid-feedback')
                .html('');
            }
            // Location
            if (errors.location) {
              $("#location").addClass('is-invalid')
                .siblings('p')
                .addClass('invalid-feedback')
                .html(errors.location);
            } else {
              $("#location").removeClass('is-invalid')
                .siblings('p')
                .removeClass('invalid-feedback')
                .html('');
            }
            // Description
            if (errors.description) {
              $("#description").addClass('is-invalid')
                .siblings('p')
                .addClass('invalid-feedback')
                .html(errors.description);
            } else {
              $("#description").removeClass('is-invalid')
                .siblings('p')
                .removeClass('invalid-feedback')
                .html('');
            }
            // Keywords
            if (errors.keyword) {
              $("#keyword").addClass('is-invalid')
                .siblings('p')
                .addClass('invalid-feedback')
                .html(errors.keyword);
            } else {
              $("#keyword").removeClass('is-invalid')
                .siblings('p')
                .removeClass('invalid-feedback')
                .html('');
            }
            // Company_name
            if (errors.company_name) {
              $("#company_name").addClass('is-invalid')
                .siblings('p')
                .addClass('invalid-feedback')
                .html(errors.company_name);
            } else {
              $("#company_name").removeClass('is-invalid')
                .siblings('p')
                .removeClass('invalid-feedback')
                .html('');
            }
          }

        }
      });
    });
  </script>

  <script>
    $(document).ready(function() {
      $.getJSON('/api/proxy/provinces', function(data_tinh) {
        if (data_tinh.error === 0) {
          $.each(data_tinh.data, function(key_tinh, val_tinh) {
            $("#province").append('<option value="' + val_tinh.id + '">' + val_tinh.full_name + '</option>');
          });



          // Khi chọn tỉnh
          $("#province").change(function(e) {
            var idtinh = $(this).val();
            var tentinh = $("#province option:selected").text();
            $("#province_name").val(tentinh); // Lưu tên tỉnh

            $.getJSON('/api/proxy/districts/' + idtinh, function(data_quan) {
              if (data_quan.error === 0) {
                $("#district").html('<option value="0">Chọn Quận / Huyện</option>');
                $("#wards").html('<option value="0">Chọn Phường / Xã</option>');

                $.each(data_quan.data, function(key_quan, val_quan) {
                  $("#district").append('<option value="' + val_quan.id + '">' + val_quan.full_name +
                    '</option>');
                });



                // Khi chọn quận
                $("#district").change(function(e) {
                  var idquan = $(this).val();
                  var tenquan = $("#district option:selected").text();
                  $("#district_name").val(tenquan); // Lưu tên huyện

                  $.getJSON('/api/proxy/wards/' + idquan, function(data_phuong) {
                    if (data_phuong.error === 0) {
                      $("#wards").html('<option value="0">Chọn Phường / Xã</option>');
                      $.each(data_phuong.data, function(key_phuong, val_phuong) {
                        $("#wards").append('<option value="' + val_phuong.id + '">' +
                          val_phuong.full_name + '</option>');
                      });



                      // Khi chọn xã
                      $("#wards").change(function(e) {
                        var tenxa = $("#wards option:selected").text();
                        $("#ward_name").val(tenxa); // Lưu tên xã
                      });
                    }
                  });
                });
              }
            });
          });
        }
      });
    });
  </script>
@endsection
