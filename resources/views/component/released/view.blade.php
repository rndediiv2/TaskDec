@extends('layout.app')
@section('content')
<div class=" container-fluid  container-fixed-lg">
    <div class="card card-default m-t-20">
        <div class="card-block">
            <div class="invoice padding-50 sm-padding-10">
                <div>
                    <div class="pull-left">
                        <!-- <img width="235" height="47" alt="" class="invoice-logo" data-src-retina="assets/img/invoice/squarespace2x.png" data-src="assets/img/invoice/squarespace.png" src="assets/img/invoice/squarespace.png"> !-->
                        <address class="m-t-10">
                        Directorate General of Customs and Excise
                        <br>(021) 123-45678.
                        <br>
                        </address>
                    </div>
                    <div class="pull-right sm-m-t-20">
                        <h2 class="font-montserrat all-caps hint-text">CUSTOM DECLARATIONS</h2>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <br>
                <br>
                <div class="col-12">
                    <div class="row">
                        <div class="col-lg-7 col-sm-height sm-no-padding">
                            <p class="small no-margin">Issued to</p>
                            <h5 class="semi-bold m-t-0">{{ $objCustomsDeclarations['cd_first_name'] }} {{ $objCustomsDeclarations['cd_last_name'] }}</h5>
                            <address>
                            <strong>{{ $objCustomsDeclarations['cd_occupation'] }}</strong>
                            <br>{{ $objCustomsDeclarations['nationality']['country_name'] }}
                            <br><strong>Address In</strong>
                            <br>
                            {{ $objCustomsDeclarations['cd_address_in'] }}
                            </address>
                        </div>
                        <div class="col-lg-5 sm-no-padding sm-p-b-20 d-flex align-items-end justify-content-between">
                            <div>
                                <div class="font-montserrat bold all-caps">Passport Number :</div>
                                <div class="font-montserrat bold all-caps">Flight or Voyage Number :</div>
                                <div class="font-montserrat bold all-caps">Date of Arrival :</div>
                                <div class="clearfix"></div>
                            </div>
                            <div class="text-right">
                                <div class="">{{ $objCustomsDeclarations['cd_passport_number'] }}</div>
                                <div class="">{{ $objCustomsDeclarations['cd_voyage_number'] }}</div>
                                <div class="">{{ $objCustomsDeclarations['cd_arrival_date'] }}</div>
                                <div class="clearfix"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="table-responsive table-invoice">
                    <table class="table m-t-50">
                        <thead>
                            <tr>
                                <th class="">Description of Article</th>
                                <th class="text-center">Qty</th>
                                <th class="text-center">Value</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(count($objCustomsDeclarations['customs_goods']) > 0)
                                @for($i = 0; $i < count($objCustomsDeclarations['customs_goods']); $i++)
                                    <tr>
                                        <td class="">
                                            <p class="text-black">{{ $objCustomsDeclarations['customs_goods'][$i]['goods_description'] }}</p>
                                        </td>
                                        <td class="text-center">{{ $objCustomsDeclarations['customs_goods'][$i]['goods_quantity'] }}</td>
                                        <td class="text-center">{{ $objCustomsDeclarations['customs_goods'][$i]['goods_value'] }}</td>
                                    </tr>
                                @endfor
                            @endif
                        </tbody>
                    </table>
                </div>
                <br>
                <br>
                <br>
                <br>
                <br>
                
                <br>
                <br>
                <div class="p-l-15 p-r-15">
                    <div class="row b-a b-grey">
                        <div class="col-md-12 p-l-15 sm-p-t-15 clearfix sm-p-b-15 d-flex flex-column justify-content-center">
                            <?php
                            $cd_booking_id = $objCustomsDeclarations['cd_booking_id'];
                            ?>
                            
                        </div>
                    </div>
                </div>
                <hr>
                <p class="small hint-text">Directorate General of Customs and Excise would like to thank you for your kind cooperation with Customs Offices during the inspections to identify narcotics, illegal drugs, any articles which are related to money laundering, and/or smuggling activities, that violate state laws and regulation of Indonesia</p>
                <p class="small hint-text">Bringing those goods into Indonesia and doing smuggling activities, are considered as violation and will lead to legal actions</p>
                <br>
                <hr>
                <div>
                    <!-- <img src="assets/img/logo.png" alt="logo" data-src="assets/img/logo.png" data-src-retina="assets/img/logo_2x.png" width="78" height="22"> !-->
                    <!-- <span class="m-l-70 text-black sm-pull-right">+34 346 4546 445</span>
                    <span class="m-l-40 text-black sm-pull-right">support@revox.io</span> !-->
                </div>
            </div>
        </div>
    </div>
</div>
@endsection