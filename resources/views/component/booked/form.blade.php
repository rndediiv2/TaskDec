@extends('layout.app')
@section('content')
<style>
#overlaysScreeen{
    position:fixed;
    top:0;
    left:0;
    background:rgba(0,0,0,0.6);
    z-index:5;
    width:100%;
    height:100%;
    display:none;
}
</style>
<div id="overlaysScreeen"></div>
<div class=" container-fluid   container-fixed-lg">
    <div id="rootwizard" class="m-t-50">
        <form action="{{ $action }}" id="frmCustomDeclaration" name="frmCustomDeclaration" autocomplete="off">
            {{ csrf_field() }}
            <input type="hidden" name="customs[cd_booking_id]" readonly="readonly" value="{{ $objCustomsDeclarations[0]['cd_booking_id'] }}">
            <ul class="nav nav-tabs nav-tabs-linetriangle nav-tabs-separator nav-stack-sm" role="tablist" data-init-reponsive-tabs="dropdownfx">
                <li class="nav-item">
                    <a class="active" data-toggle="tab" href="#tab1" role="tab">
                        <i class="fa fa-user tab-icon"></i>
                        <span>Personal Information</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="" data-toggle="tab" href="#tab2" role="tab">
                        <i class="fa fa-briefcase tab-icon"></i>
                        <span>Item Checklist Information</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="" data-toggle="tab" href="#tab3" role="tab">
                        <i class="fa fa fa-shopping-cart tab-icon"></i>
                        <span>Goods Information</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="" data-toggle="tab" href="#tab4" role="tab">
                        <i class="fa fa-check tab-icon"></i>
                        <span>Summary</span>
                    </a>
                </li>
            </ul>

            <div class="tab-content">
                <div class="tab-pane padding-20 sm-no-padding active slide-left" id="tab1">
                    <div class="row row-same-height">
                        <div class="col-md-5 b-r b-dashed b-grey sm-b-b">
                            <div class="padding-30 sm-padding-5 sm-m-t-15 m-t-50"> 
                                <h2>Your personal information detail!</h2>
                                <p>Each arriving Passenger/Crew must submit Customs Declaration <br> <span class="small hint-text">(only one Customs Declaration per family is required)</span></p>
                            </div>
                        </div>
                        <div class="col-md-7">
                            <div class="form-group-attached">
                                <div class="row clearfix">
                                    <div class="col-sm-6">
                                        <div class="form-group form-group-default required">
                                            <label>First name</label>
                                            <input type="text" class="form-control input-lg" name="customs[cd_first_name]" wajib="true" value="{{ $objCustomsDeclarations[0]['cd_first_name'] }}">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group form-group-default">
                                            <label>Last name</label>
                                            <input type="text" class="form-control input-lg" name="customs[cd_last_name]" value="{{ $objCustomsDeclarations[0]['cd_last_name'] }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group form-group-default input-group col-md-12 col-sm-12 col-lg-12">
                                        <div class="form-input-group">
                                            <label>Date Of Birth</label>
                                            <input type="text" class="form-control input-lg" name="customs[cd_date_of_birth]" id="dateOfBirth" wajib="true" value="{{ $objCustomsDeclarations[0]['cd_date_of_birth'] }}">
                                        </div>
                                        <div class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="row clearfix">
                                    <div class="col-sm-12">
                                        <div class="form-group form-group-default required">
                                            <label>Occupation</label>
                                            <input type="text" class="form-control input-lg" name="customs[cd_occupation]" wajib="true" value="{{ $objCustomsDeclarations[0]['cd_occupation'] }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="row clearfix">
                                    <div class="col-sm-12">
                                        <div class="form-group form-group-default form-group-default-select2 required">
                                            <label>Nationality</label>
                                            {{ Form::select('customs[cd_nationality]', $country, $objCustomsDeclarations[0]['cd_nationality'], ['class' => 'full-width input-lg', 'data-placeholder' => 'Select Country', 'data-init-plugin' => "select2", 'wajib' => 'true']) }}
                                        </div>
                                    </div>
                                </div>
                                <div class="row clearfix">
                                    <div class="col-sm-12">
                                        <div class="form-group form-group-default required">
                                            <label>Passport Number</label>
                                            <input type="text" class="form-control input-lg" name="customs[cd_passport_number]" wajib="true" maxlength="15" value="{{ $objCustomsDeclarations[0]['cd_passport_number'] }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="row clearfix">
                                    <div class="col-sm-12">
                                        <div class="form-group form-group-default required">
                                            <label>Address in Indonesia (hotel name/residence address)</label>
                                            <input type="text" class="form-control input-lg" name="customs[cd_address_in]" wajib="true" value="{{ $objCustomsDeclarations[0]['cd_address_in'] }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="row clearfix">
                                    <div class="col-sm-12">
                                        <div class="form-group form-group-default required">
                                            <label>Flight or Voyage Number</label>
                                            <input type="text" class="form-control input-lg" name="customs[cd_voyage_number]" wajib="true" maxlength="15" value="{{ $objCustomsDeclarations[0]['cd_voyage_number'] }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group form-group-default input-group col-md-12 col-sm-12 col-lg-12">
                                        <div class="form-input-group">
                                            <label>Date Of Arrival</label>
                                            <input type="text" class="form-control input-lg" name="customs[cd_arrival_date]" id="dateOfArrival" wajib="true" value="{{ $objCustomsDeclarations[0]['cd_arrival_date'] }}">
                                        </div>
                                        <div class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="row clearfix">
                                    <div class="col-sm-4">
                                        <div class="form-group form-group-default required">
                                            <label>Number of family members traveling with you (only for Passenger)</label>
                                            <input type="text" class="form-control input-lg" name="customs[cd_member]" wajib="true" value="{{ $objCustomsDeclarations[0]['cd_member'] }}">
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group form-group-default required">
                                            <label>Number of accompanied baggage</label>
                                            <input type="text" class="form-control input-lg" name="customs[cd_number_baggage]" wajib="true" value="{{ $objCustomsDeclarations[0]['cd_number_baggage'] }}">
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group form-group-default required">
                                            <label>Number of unaccompanied baggage (if any, and see the reverse side of this form)</label>
                                            <input type="text" class="form-control input-lg" name="customs[cd_unaccompanied_baggage]" wajib="true" value="{{ $objCustomsDeclarations[0]['cd_unaccompanied_baggage'] }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="row clearfix">
                                    <div class="col-sm-12">
                                        <div class="form-group form-group-default required">
                                            <label>Email</label>
                                            <input type="text" class="form-control input-lg" name="customs[cd_email]" wajib="true" value="{{ $objCustomsDeclarations[0]['cd_email'] }}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane slide-left padding-20 sm-no-padding" id="tab2">
                    <div class="row row-same-height">
                        <div class="col-md-5 b-r b-dashed b-grey ">
                            <div class="padding-30 sm-padding-5 sm-m-t-15 m-t-50">
                                <h2>I am (We are) bringing</h2>
                                <p>If you tick "Yes" to any of the questions besides, please notify on the reverse side of this form and please go to RED CHANNEL. If you tick "No" to all of the questions side, please go to GREEN CHANNEL</p>
                            </div>
                        </div>
                        <div class="col-md-7">
                            <h5>Animals <small class="pull-right">No/Yes</small></h5>
                            <div class="form-group-attached">
                                <div class="row clearfix">
                                    <div class="col-sm-12 col-md-12 col-lg-12">
                                        <div class="form-group form-group-default input-group">
                                            <div class="form-input-group">
                                                <label class="inline">Animals, fish and plants including their products (vegetables, food, etc). </label>
                                            </div>
                                            <div class="input-group-addon bg-transparent h-c-50">
                                                <input type="checkbox" class="chkBring" data-init-plugin="switchery" data-size="small" data-color="primary" name="customs[cd_bring_animals]" <?= $objCustomsDeclarations[0]['cd_bring_animals'] == 1 ? 'checked="checked"' : ''; ?> />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <h5>Narcotics</h5>
                            <div class="form-group-attached">
                                <div class="row clearfix">
                                    <div class="col-sm-12 col-md-12 col-lg-12">
                                        <div class="form-group form-group-default input-group">
                                            <div class="form-input-group">
                                                <label class="inline">Narcotics, psychotropics, substances, precursor, drugs, fire arms, air gun, sharp object (ie. sword, knife), ammunition, explosives, pornographics articles</label>
                                            </div>
                                            <div class="input-group-addon bg-transparent h-c-50">
                                                <input type="checkbox" class="chkBring" data-init-plugin="switchery" data-size="small" data-color="primary" name="customs[cd_bring_narcotics]" <?= $objCustomsDeclarations[0]['cd_bring_narcotics'] == 1 ? 'checked="checked"' : ''; ?> />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <h5>Currency</h5>
                            <div class="form-group-attached">
                                <div class="row clearfix">
                                    <div class="col-sm-12 col-md-12 col-lg-12">
                                        <div class="form-group form-group-default input-group">
                                            <div class="form-input-group">
                                                <label class="inline">Currency and/or beare negotiable instruments in Rupiah or other currencies which equals to the amount of 100 million Rupiah or more</label>
                                            </div>
                                            <div class="input-group-addon bg-transparent h-c-50">
                                                <input type="checkbox" class="chkBring" data-init-plugin="switchery" data-size="small" data-color="primary" name="customs[cd_bring_currency]" <?= $objCustomsDeclarations[0]['cd_bring_currency'] == 1 ? 'checked="checked"' : ''; ?> />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <h5>Cigarettes</h5>
                            <div class="form-group-attached">
                                <div class="row clearfix">
                                    <div class="col-sm-12 col-md-12 col-lg-12">
                                        <div class="form-group form-group-default input-group">
                                            <div class="form-input-group">
                                                <label class="inline">More than 200 cigarettes or 25 cigars or 100 grams of sliced tobacco, and 1 liter drinks containing ethyl alcohol (for passenger); or  more than 40 cigarettes or 10 cigars or 40 grams of sliced tobacco, and 350 mililiter drinks containing ethyl alcohol (for crew)</label>
                                            </div>
                                            <div class="input-group-addon bg-transparent h-c-50">
                                                <input type="checkbox" class="chkBring" data-init-plugin="switchery" data-size="small" data-color="primary" name="customs[cd_bring_cigaretes]" <?= $objCustomsDeclarations[0]['cd_bring_cigaretes'] == 1 ? 'checked="checked"' : ''; ?> />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <h5>Commercial Merchandise</h5>
                            <div class="form-group-attached">
                                <div class="row clearfix">
                                    <div class="col-sm-12 col-md-12 col-lg-12">
                                        <div class="form-group form-group-default input-group">
                                            <div class="form-input-group">
                                                <label class="inline">(articles for sale, sample used for soliciting orders, materials of components used for industrial purposes, and/or goods that are not considered as personal effect)</label>
                                            </div>
                                            <div class="input-group-addon bg-transparent h-c-50">
                                                <input type="checkbox" class="chkBring" data-init-plugin="switchery" data-size="small" data-color="primary" name="customs[cd_bring_merchandise]" <?= $objCustomsDeclarations[0]['cd_bring_merchandise'] == 1 ? 'checked="checked"' : ''; ?> />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <h5>Goods Purchased</h5>
                            <div class="form-group-attached">
                                <div class="row clearfix">
                                    <div class="col-sm-12 col-md-12 col-lg-12">
                                        <div class="form-group form-group-default input-group">
                                            <div class="form-input-group">
                                                <label class="inline">Goods purchased/obtained abroad and will remain in Indonesia will total value exceeding USD 50.00 per person (for Crew); or USD 250.00 per person or USD 1,000.00 per family (for pasengger) </label>
                                            </div>
                                            <div class="input-group-addon bg-transparent h-c-50">
                                                <input type="checkbox" class="chkBring" data-init-plugin="switchery" data-size="small" data-color="primary" name="customs[cd_bring_goods]" <?= $objCustomsDeclarations[0]['cd_bring_goods'] == 1 ? 'checked="checked"' : ''; ?> />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane slide-left padding-20 sm-no-padding" id="tab3">
                    <div class="row row-same-height">
                        <div class="col-md-5 b-r b-dashed b-grey ">
                            <div class="padding-30 sm-padding-5 sm-m-t-15 m-t-50">
                                <h2>Goods Declared</h2>
                                <p>To expedite the customs services, please notify the goods that you are bringing/carrying with complete and correct in the Customs Declaration, then submit it to the Customs Officer</p>
                                <p class="small hint-text">Flase reporting lead to punishment in accordance with laws and regulations</p>
                            </div>
                        </div>
                        <div class="col-md-7">
                            <div class="padding-30 sm-padding-5 text-center" id="noticeGoodsContainer">
                                <h5 style="font-weight: 700;">Oops ... there's no item customs declaration selected</h5>
                                <p style="font-weight: 600;">See in item checklist information</p>
                                <img src="{{ URL::asset('img/trolley.svg') }}" width="50%" height="50%">
                            </div>
                            <div class="padding-30 sm-padding-5" id="goodsContainer">
                                <div class="form-group-attached">
                                    <div class="row clearfix">
                                        <div class="col-sm-6">
                                            <div class="form-group form-group-default">
                                                <label>Description of Articles</label>
                                                <input type="text" id="goodsDescription" class="form-control input-lg">
                                            </div>
                                        </div>
                                        <div class="col-sm-2">
                                            <div class="form-group form-group-default">
                                                <label>Qty</label>
                                                <input type="text" id="goodsQty" class="form-control input-lg numerics text-right" value="0">
                                            </div>
                                        </div>
                                        <div class="col-sm-2">
                                            <div class="form-group form-group-default">
                                                <label>Value (USD)</label>
                                                <input type="text" id="goodsValue" class="form-control input-lg currency text-right" value="0">
                                            </div>
                                        </div>
                                        <div class="col-sm-2 bg-primary padding-10">
                                            <button type="button" class="btn btn-block btn-primary btn-lg btn-larger" id="addItemGoods">Add</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group-attached m-t-10 m-b-10 blockMoreItems">
                                    <div class="row clearfix"><button class="btn btn-primary btn-lg btn-larger btn-block">Add More Items</button></div>
                                </div>
                                <div class="form-group-attached" id="tempGoodsItems" {{ @count($objCustomsDeclarations[0]['customs_goods']) > 0 ? '' : 'style=display:none;' }}> 
                                    @if(count($objCustomsDeclarations[0]['customs_goods']) > 0)
                                        @for($i = 0; $i < count($objCustomsDeclarations[0]['customs_goods']); $i++)
                                            <?php $mathRand = rand(); ?>
                                            <div class="p-t-15 listGoodItems" style="border-bottom: 1px solid #cecece;" id="{{ $mathRand }}">
                                                <div class="d-flex">
                                                    <div class="flex-1 full-width ">
                                                        <h5 class="no-margin ">{{ $objCustomsDeclarations[0]['customs_goods'][$i]['goods_description'] }}</h5>
                                                    </div>
                                                <div class="clearfix"></div>
                                            </div>
                                            <div class="m-t-5">
                                                <p class="hint-text fade pull-left"><i class="fa fa-briefcase"></i> Qty {{ $objCustomsDeclarations[0]['customs_goods'][$i]['goods_quantity'] }} , <i class="fa fa-money"></i> Values {{ $objCustomsDeclarations[0]['customs_goods'][$i]['goods_value'] }}</p>
                                                <a href="javascript:void(0);" class="pull-right text-master removeItem" id="{{ $mathRand }}" data-target="{{ $mathRand }}"><i class="pg-close"></i></a>
                                                <div class="clearfix"></div>
                                            </div>
                                            <input type="hidden" name="goods[goods_description][]" value="{{ $objCustomsDeclarations[0]['customs_goods'][$i]['goods_description'] }}">
                                            <input type="hidden" name="goods[goods_quantity][]" value="{{ $objCustomsDeclarations[0]['customs_goods'][$i]['goods_quantity'] }}">
                                            <input type="hidden" name="goods[goods_value][]" value="{{ $objCustomsDeclarations[0]['customs_goods'][$i]['goods_value'] }}"></div>
                                        @endfor
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane slide-left padding-20 sm-no-padding" id="tab4">
                    <h1>Thank you</h1>
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <hr>
                            <h5><span class="semi-bold">Disclaimer</span></h5>
                            <div class="checkbox check-success ">
                                <input type="checkbox" id="chkTermInCondition" name="termInCondition">
                                <label class="semi-bold" for="chkTermInCondition"> I have read the information on the reverse side of this form and have made a thruthful declaration</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="padding-20 sm-padding-5 sm-m-b-20 sm-m-t-20 bg-white clearfix">
                    <ul class="pager wizard no-style">
                        <li class="next">
                            <button class="btn btn-primary btn-cons btn-animated from-left fa fa-briefcase pull-right" type="button">
                                <span>Next</span>
                            </button>
                        </li>
                        <li class="next finish hidden">
                            <button class="btn btn-primary btn-cons btn-animated from-left fa fa-cog pull-right confirmSubmit" type="button" disabled="disabled">
                                <span>Submit</span>
                            </button>
                        </li>
                        <li class="previous first hidden">
                            <button class="btn btn-default btn-cons btn-animated from-left fa fa-cog pull-right" type="button">
                                <span>First</span>
                            </button>
                        </li>
                        <li class="previous">
                            <button class="btn btn-default btn-cons pull-right" type="button">
                                <span>Previous</span>
                            </button>
                        </li>
                        <li>
                            <button class="btn btn-complete btn-cons pull-left draft" type="button" id="{{ rand() }}" data-action="{{ url('/customs-draft') }}" data-serialize="#frmCustomDeclaration">
                                <span>Save As Draft</span>
                            </button>
                        </li>
                    </ul>
                </div>
                <div class="wizard-footer padding-20 bg-master-light">
                    <p class="small hint-text pull-left no-margin">Signature</p>
                    <div class="pull-right">{{ date("d/m/Y") }}</div>
                    <div class="clearfix"></div>
                </div>
            </div>
        </form>
    </div> 
</div>
<script>
    $(function(){
        $(".removeItem").click(function() {
            var $itemTarget = $(this).attr('data-target');
            $("#" + $itemTarget).trigger('remove').remove();
            return false;
        }).on('remove', function() {
            var $lengthItems = $(".listGoodItems").length;
            if ($lengthItems == 0) {
                $(".blockMoreItems").css('display', 'none');
            }
        });
    });
</script>
@endsection