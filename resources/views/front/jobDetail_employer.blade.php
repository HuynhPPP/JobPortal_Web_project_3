@extends('front.layouts.app')

@section('main')
  <section class="section-4 bg-2">
    <div class="container pt-5">
      <div class="row">
        <div class="col">
          <nav aria-label="breadcrumb" class=" rounded-3 p-3 mb-4">
            <ol class="breadcrumb mb-0">
              <li class="breadcrumb-item"><a href="{{ route('home') }}">Trang chủ</a></li>
              <li class="breadcrumb-item active">Chi tiết việc làm</li>
            </ol>
          </nav>
        </div>
      </div>
    </div>
    <div class="container job_details_area">
      <div class="row pb-5">
        <div class="col-md-8">
          <div class="card shadow border-0">
            <div class="job_details_header">
              <div class="single_jobs white-bg d-flex justify-content-between">
                <div class="jobs_left d-flex align-items-center">
                  <div class="jobs_conetent">
                    <div class="d-flex align-items-center mb-3 me-md-auto text-dark">
                      <img src="{{ asset('assets/user/profile_picture/thumb/' . $job->user->image) }}" class="bi me-2"
                        alt="logo" width="40" height="32"
                        style="width: 15%;
                                                                                                        background: #fff;
                                                                                                        border-radius: 8px;
                                                                                                        box-shadow: 0px 4px 16px rgba(0, 0, 0, 0.08);">
                      <span class="fs-4" style="margin-left: 10px; color: #212529">{{ $job->title }}</span>
                    </div>

                    <div class="links_locat d-flex align-items-center">
                      <div class="location d-flex align-items-center">
                        <i class="fa fa-map-marker" style="margin-right: 7px"></i>
                        @if (!empty($job->province) && !empty($job->district))
                          <p>{{ $job->district }}, {{ $job->province }}</p>
                        @else
                          <p style="color: red">Chưa cập nhật</p>
                        @endif
                      </div>
                      <div class="location d-flex align-items-center">
                        <i class="fa fa-clock-o" aria-hidden="true" style="margin-right: 7px"></i>
                        <p>{{ $job->jobType->name }}</p>
                      </div>
                    </div>
                    <div class="links_locat d-flex align-items-center mt-3">
                      <div class="location d-flex align-items-center">
                        <i class="fa fa-calendar" style="margin-right: 7px"></i>
                        <p>
                          Ngày đăng tuyển: {{ \Carbon\Carbon::parse($job->created_at)->format('d-m-Y') }}
                          @if ($job->expiration_date)
                            @php
                              $daysLeft = \Carbon\Carbon::now()->diffInDays(
                                  \Carbon\Carbon::parse($job->expiration_date),
                                  false,
                              );
                              if ($daysLeft < 1) {
                                  $daysLeft = 1;
                              }
                              $textColor = '';
                              if ($daysLeft < 3) {
                                  $textColor = 'color: red;';
                              } elseif ($daysLeft < 10) {
                                  $textColor = 'color: #FBBF24;';
                              }
                            @endphp
                            @if ($daysLeft >= 0)
                              - <span>Hết hạn trong: <span style="{{ $textColor }}">{{ $daysLeft }} ngày
                                  tới</span></span>
                            @endif
                          @endif
                        </p>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="descript_wrap white-bg">
              <div class="single_wrap">
                <h4 style="color: #1E40AF; font-weight:600">Mô tả công việc</h4>
                @if (empty($job->description))
                  <p>Chưa có thông tin</p>
                @endif
                {!! nl2br($job->description) !!}

              </div>
              <div class="single_wrap">
                <h4 style="color: #1E40AF; font-weight:600">Trách nhiệm công việc</h4>
                @if (empty($job->responsibility))
                  <p>Chưa có thông tin</p>
                @endif
                {!! nl2br($job->responsibility) !!}
              </div>
              <div class="single_wrap">
                <h4 style="color: #1E40AF; font-weight:600">Kỹ năng & Chuyên môn</h4>
                @if (empty($job->qualifications))
                  <p>Chưa có thông tin</p>
                @endif
                {!! nl2br($job->qualifications) !!}
              </div>
              <div class="single_wrap">
                <h4 style="color: #1E40AF; font-weight:600">Phúc lợi dành cho bạn</h4>
                @if (empty($job->benefits))
                  <p>Chưa có thông tin</p>
                @endif
                {!! nl2br($job->benefits) !!}
              </div>
            </div>
          </div>
        </div>

        <div class="col-md-4">
          <div class="card shadow border-0">
            <div class="job_sumary">
              <div class="summery_header pb-1 pt-4">
                <h3>Thông tin chung</h3>
              </div>
              <div class="job_content pt-3">
                <ul>
                  <li>Thời điểm đăng: <span>{{ \Carbon\Carbon::parse($job->created_at)->diffForHumans() }}</span></li>
                  <li>
                    @if (empty($job->job_level))
                      Cấp bậc: <span style="color: red">Chưa cập nhật</span>
                    @else
                      Cấp bậc: <span>{{ $job->job_level }}</span>
                    @endif
                  </li>
                  <li>
                    @if (empty($job->salary))
                      Mức lương: <span style="color: red">Chưa cập nhật</span>
                    @else
                      Mức lương: <span style="color: #0069DB">{{ $job->salary }}</span>
                    @endif
                  </li>
                  <li>
                    @if (empty($job->experience))
                      Năm kinh nghiệm tối thiểu: <span style="color: red">Chưa cập nhật</span>
                    @else
                      Năm kinh nghiệm tối thiểu: <span>{{ $job->experience }} năm</span>
                    @endif
                  </li>
                  <li>
                    @if (empty($job->jobType->name))
                      Hình thức làm việc: <span style="color: red">Chưa cập nhật</span>
                    @else
                      Hình thức làm việc: <span> {{ $job->jobType->name }}</span>
                    @endif
                  </li>
                  <li>
                    @if (empty($job->keywords))
                      Từ khoá: <span style="color: red">Chưa cập nhật</span>
                    @else
                      <div class="keywords-section-detail">
                        <div class="d-flex flex-wrap gap-2 mt-2">
                          @php
                            $cleanedKeywords = str_replace(['[', ']', '"'], '', $job->keywords);
                            $keywords = explode(',', $cleanedKeywords);
                          @endphp
                          Từ khoá:
                          @foreach ($keywords as $index => $keyword)
                            <a href="{{ route('jobs', ['keyword' => trim($keyword)]) }}"
                              class="keyword-badge-detail">{{ trim($keyword) }}</a>
                          @endforeach
                        </div>
                      </div>
                    @endif
                  </li>
                </ul>
              </div>
            </div>
          </div>
          <div class="card shadow border-0 my-4">
            <div class="job_sumary">
              <div class="summery_header pb-1 pt-4">
                <h3>Thông tin chi tiết công ty</h3>
              </div>
              <div class="job_content pt-3">
                <ul>
                  <li>Tên công ty: <span>{{ $job->company_name }}</span></li>
                  <li>
                    @if (!empty($job->location_detail))
                      Địa chỉ: <span>{{ $job->location_detail }}</span>
                    @elseif (!empty($job->district) && !empty($job->district))
                      Địa chỉ: <span> {{ $job->district }}, {{ $job->province }}</span>
                    @else
                      Địa chỉ: <span>{{ $job->location_detail }}</span>
                    @endif
                  </li>
                  <li>
                    @if (empty($job->company_website))
                      Webite: <span style="color: red">chưa cập nhật</span>
                    @else
                      Webite: <span><a href="{{ $job->company_website }}"
                          style="color: #0069DB">{{ $job->company_website }}</a></span>
                    @endif
                  </li>
                  <li>Nhà tuyển dụng: <span>{{ $job->user->fullname }}</span></li>
                  <li>Email liên hệ: <span>{{ $job->user->email }}</span></li>
                </ul>
              </div>
            </div>
          </div>
        </div>
        @if (Auth::user())
          @if (Auth::user()->id == $job->user_id)
            <div class="card shadow border-0 mt-4">
              <div class="job_details_header">
                <div class="single_jobs white-bg d-flex justify-content-between">
                  <div class="jobs_left d-flex align-items-center">
                    <h2>Danh sách ứng viên</h2>
                  </div>
                  <div class="jobs_right"></div>
                </div>
              </div>
              <div class="descript_wrap white-bg">
                <table class="table">
                  <tr>
                    <th class="fw-bold">Họ và tên</th>
                    <th>Email</th>
                    <th>Số điện thoại</th>
                    <th>Ngày ứng tuyển</th>
                    <th>CV</th>
                    <th>Trạng thái</th>
                    <th>Các tuỳ chỉnh</th>
                  </tr>
                  @if ($applications->isNotEmpty())
                    @foreach ($applications as $application)
                      <tr>
                        <td style="display: none"><input type="hidden" name="id" value="{{ $application->id }}">
                        </td>
                        <td>{{ $application->user->fullname }}</td>
                        <td>{{ $application->user->email }}</td>
                        <td>
                          @if (empty($application->user->mobile))
                            <p style="color: red">Chưa có thông tin</p>
                          @else
                            {{ $application->user->mobile }}
                          @endif
                        </td>
                        <td>
                          {{ \Carbon\Carbon::parse($application->applied_date)->translatedFormat('d F, Y') }}
                        </td>
                        <td>
                          <a href="{{ route('download-cv', $application->cv_path) }}" class="btn btn-primary">Tải CV</a>
                        </td>
                        <td>
                          @if ($application->status == 1)
                            <div class="job-status text-capitalize text-success">Đã phê duyệt</div>
                          @elseif ($application->status == 0)
                            <div class="job-status text-capitalize" style="color: #FBBF24">Đang chờ phê duyệt</div>
                          @endif
                        </td>
                        <td>
                          <div class="action-dots float-end">
                            <button href="#" class="btn" data-bs-toggle="dropdown" aria-expanded="false">
                              <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end">
                              <li>
                                <button type="button" class="dropdown-item"
                                  onclick="showMessagePopup(event, {{ $application->id }})">
                                  <i class="fa fa-envelope-open" aria-hidden="true"></i> Phê duyệt & Gửi thông báo
                                </button>
                              </li>
                            </ul>
                          </div>
                        </td>
                        <div class="modal fade" id="processApplicationModal{{ $application->id }}" tabindex="-1"
                          aria-labelledby="processApplicationModalLabel{{ $application->id }}" aria-hidden="true">
                          <div class="modal-dialog">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h5 class="modal-title" id="processApplicationModalLabel{{ $application->id }}">Phê
                                  duyệt và Gửi thông báo</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                  aria-label="Close"></button>
                              </div>
                              <div class="modal-body">
                                <form action="{{ route('process.application', ['id' => $application->id]) }}"
                                  method="POST">
                                  @csrf
                                  <input type="hidden" name="id" value="{{ $application->id }}">

                                  <div class="mb-3">
                                    <label for="approvalSelect{{ $application->id }}"
                                      class="form-label fs-5 mb-2">Trạng thái xét duyệt</label>
                                    <select class="form-select" id="approvalSelect{{ $application->id }}"
                                      name="approval_status">
                                      <option value="1">Phê duyệt</option>
                                      <option value="0">Huỷ phê duyệt</option>
                                    </select>
                                  </div>

                                  <div class="mb-3">
                                    <label for="messageContent_{{ $application->id }}" class="form-label fs-5 mb-2">Nội
                                      dung tin nhắn</label>
                                    <textarea class="form-control" id="messageContent_{{ $application->id }}" name="message" rows="3"></textarea>
                                  </div>

                                  <button type="submit" class="btn btn-primary">Gửi</button>
                                </form>
                              </div>
                            </div>
                          </div>
                        </div>
                      </tr>
                    @endforeach
                  @else
                    <tr>
                      <td colspan="6">
                        <p class="text-danger">Chưa có ứng viên</p>
                      </td>
                    </tr>
                  @endif
                </table>
              </div>
            </div>
          @endif
        @endif
      </div>
    </div>
  </section>
@endsection

@section('customJs')
  <script>
    function showMessagePopup(event, applicationId) {
      event.preventDefault();

      // Lấy phần tử modal từ DOM
      var modalElement = document.getElementById('processApplicationModal' + applicationId);

      if (modalElement) {
        var modal = bootstrap.Modal.getOrCreateInstance(modalElement);
        modal.show();
      } else {
        console.error('Modal với ID ' + applicationId + ' không tồn tại.');
      }
    }
  </script>
@endsection
