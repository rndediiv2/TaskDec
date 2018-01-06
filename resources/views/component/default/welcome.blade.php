@extends('layout.app')
@section('content')
<div class="jumbotron" data-pages="parallax">
	<div class=" container-fluid  container-fixed-lg">
        <div class="inner">  
            <div class="row">
                <div class="col-xl-7 col-lg-6 ">
                    <div class="full-height">
                        <div class="card-block text-center">
                            <img class="image-responsive-height demo-mw-600" src="{{ URL::asset('img/tab.png') }}" alt="">
                        </div>
                    </div>
                </div>
                <div class="col-xl-5 col-lg-6 ">
                    <div class="card card-transparent">
                        <div class="card-header ">
                            <div class="card-title">Welcome To Indonesia</div>
                        </div>
                        <div class="card-block">
                            <h3>Customs Declaration</h3>
                            <p class="text-justify">Directorate General of Customs and Excise would like to thank you for your kind cooperation with Customs Offices during the inspections to identify narcotics, illegal drugs, any articles which are related to money laundering, and/or smuggling activities, that violate state laws and regulation of Indonesia</p>
                            <p class="text-justify">Bringing those goods into Indonesia and doing smuggling activities, are considered as violation and will lead to legal actions.</p>
                            <p class="pull-left m-t-30">
                                <a href="{{ url('/customs-declaration') }}" class="btn btn-success btn-cons m-b-10">Create Declarations</a> or &nbsp;<a href="#" class="btn text-white m-b-10" style="background-color: #008b70 !important; border-color: #008b70 !important;" class="allreadyFill" data-toggle="modal" data-target="#modalFillVoyage">Get My Draft Declaration</a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade fill-in" id="modalFillVoyage" tabindex="-1" role="dialog" aria-hidden="true">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
        <i class="pg-close"></i>
    </button>
    <div class="modal-dialog ">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="text-left p-b-5">
                    <span class="semi-bold">Get</span> My Draft Declaration 
                </h5>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-9 ">
                        <input type="text" placeholder="Reference Number" class="form-control input-lg" id="icon-filter" name="icon-filter">
                    </div>
                    <div class="col-lg-3 no-padding sm-m-t-10 sm-text-center">
                        <button type="button" class="btn btn-primary btn-lg btn-large fs-15 loadReservation" data-url="{{ url('/customs-loaded') }}">Load Declaration</button>
                    </div>
                </div>
            </div>
            <div class="modal-footer"></div>
        </div>
    </div>
</div>
    
@endsection