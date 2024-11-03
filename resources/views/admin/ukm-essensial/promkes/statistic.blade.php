@extends('admin.layouts.admin')
@section('content')
    <a href="{{ route('program-divisi-promosi-kesehatan') }}" class="btn btn-danger mb-3"><i class="fas fa-arrow-left"></i> Kembali</a>
    <div class="card">
        <div class="card-header">
            <h3>Statistic Data Report Promosi Kesehatan</h3>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <x-visualisasi-data-promkes-umum :monthNumber="$currentMonth" :year="$currentYear"/>
                </div>
                <div class="col-md-6">
                    <x-visualisasi-data-ukbm :monthNumber="$currentMonth" :year="$currentYear"/>
                </div>
                <div class="col-md-12">
                    <x-visualisasi-data-promkes-lain :monthNumber="$currentMonth" :year="$currentYear"/>
                </div>
                <div class="col-md-6">
                    <x-visualisasi-data-kader/>
                </div>
                <div class="col-md-6">
                    <x-visualisasi-data-dana/>
                </div>
            </div>
        </div>
        <div class="card-footer">
            <form action="{{ route('promkes.statistic.filter') }}" method="GET" class="d-flex align-items-center">
                @csrf
                <div class="form-group mb-0 mr-2">
                    <select name="month" class="form-control form-control-sm">
                        @for ($i = 1; $i <= 12; $i++)
                            <option value="{{ $i }}" {{ $i == $currentMonth ? 'selected' : '' }}>
                                {{ \App\Helpers\MonthHelper::getMonth($i) }}
                            </option>
                        @endfor
                    </select>
                </div>
                <div class="form-group mb-0 mr-2">
                    <select name="year" class="form-control form-control-sm">
                        @for ($i = date('Y'); $i >= date('Y') - 10; $i--)
                            <option value="{{ $i }}" {{ $i == $currentYear ? 'selected' : '' }}>
                                {{ $i }}
                            </option>
                        @endfor
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Filter</button>
            </form>
        </div>
    </div>
@endsection