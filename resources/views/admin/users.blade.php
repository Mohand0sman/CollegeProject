@extends('admin.layouts.master')

@section('content')
    <div class="container-fluid py-2">
        <div class="row p-3">
            <div class="card">
                <div class="card-header pb-0">
                <div class="row mb-3">
                    <div class="col-6">
                        <h6>Admins & Writers</h6>
                    </div>
                    <div class="col-6">
                        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addUserModal">إضافة</button>
                    </div>
                </div>
                </div>
                <div class="card-body p-0 pb-2">
                    <div class="table-responsive">
                        <table class="table align-items-center mb-0">
                        <thead>
                            <tr>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">الاسم</th>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">الايميل</th>
                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">النوع</th>
                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">الاجراءات</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($admins->isNotEmpty())
                                @foreach ($admins as $admin) 
                                    <tr>
                                    <td>
                                        {{$admin->name}}
                                    </td>
                                    <td>
                                        {{$admin->email}}
                                    </td>
                                    <td class="align-middle text-center text-sm">
                                        {{$admin->role}}
                                    </td>
                                    <td class="align-middle">
                                        <form action="{{ route('admin.users.destroy', $admin->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-danger" onclick="return confirm('هل أنت متأكد من الحذف؟')">حذف</button>
                                        </form>

                                        <button class="btn btn-outline-dark" data-bs-toggle="modal" data-bs-target="#editUserModal{{$admin->id}}">تعديل</button>

                                    </td>
                                    </tr>
                                    <!-- Modal التعديل لكل مستخدم -->
                                    <div class="modal fade" id="editUserModal{{$admin->id}}" tabindex="-1" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <form method="POST" action="{{ route('admin.users.update', $admin->id) }}">
                                            @csrf
                                            @method('PUT')
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">تعديل المستخدم</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <input type="text" name="name" class="form-control mb-2" value="{{ $admin->name }}" required>
                                                    <input type="email" name="email" class="form-control mb-2" value="{{ $admin->email }}" required>
                                                    <input type="password" name="password" class="form-control mb-2" placeholder="كلمة مرور جديدة (اختياري)">
                                                    <select name="role" class="form-control" required>
                                                        <option value="admin" @selected($admin->role === 'admin')>مدير</option>
                                                        <option value="writer" @selected($admin->role === 'writer')>كاتب</option>
                                                    </select>
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
                            @endif
                        </tbody>
                        </table>
                    </div>
                </div>
            </div>
            
        </div>
        <!-- Modal الإضافة -->
<div class="modal fade" id="addUserModal" tabindex="-1" aria-labelledby="addUserModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form method="POST" action="{{ route('admin.users.store') }}">
        @csrf
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">إضافة مستخدم</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <input type="text" name="name" class="form-control mb-2" placeholder="الاسم" required>
                <input type="email" name="email" class="form-control mb-2" placeholder="الإيميل" required>
                <input type="password" name="password" class="form-control mb-2" placeholder="كلمة المرور" required>
                <select name="role" class="form-control" required>
                    <option value="admin">مدير</option>
                    <option value="writer">كاتب</option>
                </select>
            </div>
            <div class="modal-footer">
                <button class="btn btn-success">حفظ</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">إلغاء</button>
            </div>
        </div>
    </form>
  </div>
</div>

    </div>
@endsection