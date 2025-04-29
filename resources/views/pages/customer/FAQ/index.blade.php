@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])
@section('title', 'FAQ')
@section('content')
<div class="pc-container">
    <div class="pc-content">
        <div class="page-header">
            <div class="page-block">
                <div class="row align-items-center">
                    <div class="col-md-12">
                        <div class="page-header-title">
                            
                            @if(session('success'))
                                <div class="alert alert-success">
                                    {{ session('success') }}
                                </div>
                            @endif
                        </div>
                        
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
                            <li class="breadcrumb-item" aria-current="page">FAQs</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="row d-flex justify-content-center align-items-center">
            <div class="col-8">
                <h3 class="m-b-10">General FAQs</h3>
                <p class="text-gray-700">General FAQs adalah bagian yang dirancang untuk memberikan jawaban atas pertanyaan umum yang sering diajukan pengguna.</p>
                <div class="input-group mb-3">
                    <input type="search" class="form-control" id="" name="" placeholder="Cari bantuan..." value="">
                    <span class="input-group-text bg-primary">
                      <i class="ti ti-search" style="cursor: pointer; color: white;"></i>
                    </span>
                </div>       
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="accordion card" id="accordionExample">
                                    @foreach($faqs as $faq)
                                        <div class="accordion-item">
                                            <h2 class="accordion-header" id="heading{{ $faq->id }}">
                                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{ $faq->id }}" aria-expanded="false" aria-controls="collapse{{ $faq->id }}">
                                                    {{ $faq->header }}
                                                </button>
                                            </h2>
                                            <div id="collapse{{ $faq->id }}" class="accordion-collapse collapse" aria-labelledby="heading{{ $faq->id }}" data-bs-parent="#accordionExample">
                                                <div class="accordion-body">
                                                    {!! $faq->description !!} 
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>    
                            </div>
                        </div>
                    </div>
                </div>           
            </div>
        </div>
    </div>
</div>
@endsection
