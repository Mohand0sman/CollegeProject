@extends('admin.layouts.master')

@section('content')
<div class="container-fluid py-2">
    <div class="row p-3">
        <div class="card">
            <div class="card-header pb-0">
                <div class="row mb-3">
                    <div class="col-6">
                        <h6>المقالات</h6>
                    </div>
                    <div class="col-6 text-end">
                        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addModal">إضافة</button>
                    </div>
                </div>
            </div>
            <div class="card-body p-0 pb-2">
                <div class="table-responsive">
                    <table class="table align-items-center mb-0">
                        <thead>
                            <tr>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">العنوان</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">الوصف</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">الصورة</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">الإجراءات</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($articles as $article)
                                <tr>
                                    <td>{{ \Illuminate\Support\Str::limit($article->title, 50) }}</td>
                                    <td>{{ \Illuminate\Support\Str::limit($article->description, 50) }}</td>
                                    <td class="text-center">
                                        @if($article->image)
                                            <img src="{{ asset($article->image) }}" width="70">
                                        @endif
                                    </td>
                                    <td class="align-middle text-center">
                                        <form action="{{ route('admin.articles.destroy', $article->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-danger btn-sm" onclick="return confirm('هل أنت متأكد من الحذف؟')">حذف</button>
                                        </form>
                                        <button class="btn btn-outline-dark btn-sm" data-bs-toggle="modal" data-bs-target="#editModal{{ $article->id }}">تعديل</button>
                                    </td>
                                </tr>

                                <!-- Modal تعديل -->
                                <div class="modal fade" id="editModal{{ $article->id }}" tabindex="-1" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <form method="POST" action="{{ route('admin.articles.update', $article->id) }}" enctype="multipart/form-data">
                                            @csrf
                                            @method('PUT')
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">تعديل المقالة</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <input type="text" name="title" class="form-control mb-2" value="{{ $article->title }}" required>
                                                    <textarea name="description" class="form-control mb-2" required>{{ $article->description }}</textarea>
                                                    <textarea name="content" class="form-control mb-2" rows="4" required>{{ $article->content }}</textarea>
                                                    <input type="file" name="image_upload" class="form-control mb-2">
                                                    <input type="url" name="image_url" class="form-control" placeholder="أو أدخل رابط صورة">
                                                </div>
                                                <div class="modal-footer">
                                                    <button class="btn btn-success">تحديث</button>
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">إلغاء</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal إضافة -->
    <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form method="POST" action="{{ route('admin.articles.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">إضافة مقالة</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <input type="text" name="title" class="form-control mb-2" placeholder="العنوان" required>
                        <textarea name="description" class="form-control mb-2" placeholder="الوصف" required></textarea>
                        <textarea name="content" class="form-control mb-2" rows="4" placeholder="الشرح الكامل" required></textarea>
                        <input type="file" name="image_upload" class="form-control mb-2">
                        <input type="url" name="image_url" class="form-control" placeholder="أو أدخل رابط صورة">
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-primary">حفظ</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">إلغاء</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
