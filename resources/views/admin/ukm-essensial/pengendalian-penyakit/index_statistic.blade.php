@extends('admin.layouts.admin')
@section('content')
    <div class="card">
        <div class="card-header">
            <h2>Statistic Laporan Divisi Pengendalian Penyakit</h2>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <x-visualisasi-imunisasi-bayi :month="$currentMonth" :year="$currentYear"/>
                </div>
                <div class="col-md-6">
                    <x-visualisasi-imunisasi-baduta :month="$currentMonth" :year="$currentYear"/>
                </div>
                <div class="col-md-12">
                    <x-visualisasi-data-imunisasi-wus/>
                </div>
                <div class="col-md-6">
                    <x-visualisasi-data-pengendalian-penyakit-menular :month="$currentMonth" :year="$currentYear"/>
                </div>
                <div class="col-md-6">
                    <x-visualisasi-data-pengendalian-penyakit-tidak-menular :month="$currentMonth" :year="$currentYear"/>
                </div>
            </div>
        </div>
        <div class="card-footer">
            <form action="{{route('pengendalian-penyakit-analytics-filter')}}" method="GET" class="d-flex align-items-center">
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