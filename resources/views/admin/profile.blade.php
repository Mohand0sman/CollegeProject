@extends('admin.layouts.master')

@section('content')
<div class="container py-4">
    <h3 class="mb-4 ">تعديل بيانات الحساب</h3>

    {{-- رسائل النجاح أو الخطأ --}}
    @if (session('success'))
        <div class="alert text-white alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="إغلاق"></button>
        </div>
    @elseif (session('error'))
        <div class="alert text-white alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="إغلاق"></button>
        </div>
    @endif

    {{-- نموذج التعديل --}}
    <div class="card shadow rounded">
        <div class="card-body">
            <form method="POST" action="{{ route('profile.update') }}">
                @csrf

                <div class="mb-3">
                    <label for="name" class="form-label">الاسم</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror"
                        id="name" name="name" value="{{ old('name', $user->name) }}">
                    @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">البريد الإلكتروني</label>
                    <input type="email" class="form-control @error('email') is-invalid @enderror"
                        id="email" name="email" value="{{ old('email', $user->email) }}">
                    @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <hr class="my-4">

                <div class="mb-3">
                    <label for="password" class="form-label">كلمة المرور الجديدة (اختياري)</label>
                    <div class="input-group">
                        <input type="password" class="form-control @error('password') is-invalid @enderror"
                            id="password" name="password">
                        <button class="btn btn-outline-secondary" type="button" onclick="togglePassword('password')">
                            👁️
                        </button>
                    </div>
                    @error('password') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
                </div>

                <div class="mb-3">
                    <label for="password_confirmation" class="form-label">تأكيد كلمة المرور</label>
                    <div class="input-group">
                        <input type="password" class="form-control"
                            id="password_confirmation" name="password_confirmation">
                        <button class="btn btn-outline-secondary" type="button" onclick="togglePassword('password_confirmation')">
                            👁️
                        </button>
                    </div>
                </div>

                <button type="submit" class="btn btn-success w-100">
                    حفظ التغييرات
                </button>
            </form>
        </div>
    </div>
</div>

{{-- سكريبت لإظهار/إخفاء كلمة السر --}}
<script>
function togglePassword(id) {
    const input = document.getElementById(id);
    input.type = input.type === "password" ? "text" : "password";
}
</script>
@endsection
