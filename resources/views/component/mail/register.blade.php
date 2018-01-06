
@extends('beautymail::templates.ark')


@section('content')
    @include('beautymail::templates.ark.contentStart')
    <style>
        table {
            border-collapse: collapse;
            display: table;
        }
        td {
            width: 100%;
            max-width: 100%;
            white-space: nowrap;
        }
        .b-b-grey {
            border-bottom: 1px solid #eaecee;
        }
        .m-5 {
            margin: 5px !important;
        }
        .m-b-5 {
            margin-bottom: 5px !important;
        }
        .m-10 {
            margin: 10px !important;
        }
        .f-b {
            font-weight: bold;
        }
        .f-grey-b {
            color: #C9CEC3;
        }
        .f-13 {
            font-size: 13px;
        }
        .f-18 {
            font-size: 18px;
        }
        .h-bold {
            color: #4E7697;
        }
        .pull-right {
            float: right;
        }
        .d-b-grey {
            background: #C9CEC3;
        }
        .p-t-10 {
            padding-top: 10px !important;
        }
        .p-b-10 {
            padding-bottom: 10px !important;
        }
        .text-line-through {
            text-decoration: line-through;
            font-size: 12px;
        }
        .w-300 {
            width: 300px !important;
            text-align: justify;
            word-wrap: break-word;
        }
        .w-250 {
            width: 250px !important;
        }
        .w-20 {
            width: 20px !important;
        }
        .w-70 {
            width: 70px !important;
        }
    </style>
    <h1 class="m-b-5 h-bold">Customs Declaration</h1>
    <h4 class="secondary">Hi <strong>{{ $customsDeclarations->fullName }}</strong></h4>
    <p>Here's your customs declaration</p>
    <div class="p-t-10 p-b-10">
        <h3 class="h-bold f-b d-b-grey">Personal Information</h3>
    </div>
    <table>
        <tr>
            <td class="b-b-grey m-5"><span class="f-grey-b f-b f-13">Reference Number</span>
                <div class="m-b-5 f-b f-18">{{ $customsDeclarations->cd_booking_id }} </div>
            </td>
        </tr>
        <tr>
            <td class="b-b-grey m-5"><span class="f-grey-b f-b f-13">Full Name</span>
                <div class="m-b-5 f-b f-18">{{ $customsDeclarations->fullName }}</div>
            </td>
        </tr>
        <tr>
            <td class="b-b-grey m-5"><span class="f-grey-b f-b f-13">Date Of Birth</span>
                <div class="m-b-5 f-b f-18">{{ $customsDeclarations->dateOfBirth }} </div>
            </td>
        </tr>
        <tr>
            <td class="b-b-grey m-5"><span class="f-grey-b f-b f-13">Occupation</span>
                <div class="m-b-5 f-b f-18">{{ $customsDeclarations->cd_occupation }}</div>
            </td>
        </tr>
        <tr>
            <td class="b-b-grey m-5"><span class="f-grey-b f-b f-13">Nationality</span>
                <div class="m-b-5 f-b f-18">{{ $customsDeclarations->nationality['country_name'] }}</div>
            </td>
        </tr>
        <tr>
            <td class="b-b-grey m-5"><span class="f-grey-b f-b f-13">Passport Number</span>
                <div class="m-b-5 f-b f-18">{{ $customsDeclarations->cd_passport_number }}</div>
            </td>
        </tr>
        <tr>
            <td class="b-b-grey m-5"><span class="f-grey-b f-b f-13">Address in Indonesia (Hotel Name/Residence Address)</span>
                <div class="m-b-5 f-b f-18">{{ $customsDeclarations->cd_address_in }}</div>
            </td>
        </tr>
        <tr>
            <td class="b-b-grey m-5"><span class="f-grey-b f-b f-13">Flight or Voyage Number</span>
                <div class="m-b-5 f-b f-18">{{ $customsDeclarations->cd_voyage_number }}</div>
            </td>
        </tr>
        <tr>
            <td class="b-b-grey m-5"><span class="f-grey-b f-b f-13">Date Of Arrival</span>
                <div class="m-b-5 f-b f-18">{{ $customsDeclarations->arrivalDate }}</div>
            </td>
        </tr>
        <tr>
            <td class="b-b-grey m-5"><span class="f-grey-b f-b f-13">Number Of Family Member Traveling With You (Only for Passenger)</span>
                <div class="m-b-5 f-b f-18">{{ $customsDeclarations->cd_member }}</div>
            </td>
        </tr>
        <tr>
            <td class="b-b-grey m-5"><span class="f-grey-b f-b f-13">Number of Accompanied Baggage</span>
                <div class="m-b-5 f-b f-18">{{ $customsDeclarations->cd_number_baggage }}</div>
            </td>
        </tr>
        <tr>
            <td class="b-b-grey m-5"><span class="f-grey-b f-b f-13">Number of Unaccompanied Baggage</span>
                <div class="m-b-5 f-b f-18">{{ $customsDeclarations->cd_unaccompanied_baggage }}</div>
            </td>
        </tr>
    </table>
    <div class="m-5"></div>
    <div class="p-t-10 p-b-10">
        <h3 class="h-bold f-b d-b-grey">Item Checklist Information</h3>
    </div>
    <div class="m-5 p-b-10"></div>
    <table>
        <tr>
            <?php $classAnimals = ($customsDeclarations->cd_bring_animals == 0) ? 'text-line-through' : ''; ?>
            <td class="w-300 b-b-grey m-5 {{ $classAnimals }}">Animals, fish and plants including their products (vegetables, food, etc). </td>
        </tr>
        <tr>
            <?php $classNarcotics = ($customsDeclarations->cd_bring_narcotics == 0) ? 'text-line-through' : ''; ?>
            <td class="w-300 b-b-grey m-5 {{ $classNarcotics }}">Narcotics, psychotropics, substances, precursor, drugs, fire arms, air gun, sharp object (ie. sword, knife), ammunition, explosives, pornographics articles</td>
        </tr>
        <tr>
            <?php $classCurrency = ($customsDeclarations->cd_bring_currency == 0) ? 'text-line-through' : ''; ?>
            <td class="w-300 b-b-grey m-5 {{ $classCurrency }}">Currency and/or beare negotiable instruments in Rupiah or other currencies which equals to the amount of 100 million Rupiah or more</td>
        </tr>
        <tr>
            <?php $classCigaretes = ($customsDeclarations->cd_bring_cigaretes == 0) ? 'text-line-through' : ''; ?>
            <td class="w-300 b-b-grey m-5 {{ $classCigaretes }}">More than 200 cigarettes or 25 cigars or 100 grams of sliced tobacco, and 1 liter drinks containing ethyl alcohol (for passenger); or  more than 40 cigarettes or 10 cigars or 40 grams of sliced tobacco, and 350 mililiter drinks containing ethyl alcohol (for crew)</td>
        </tr>
        <tr>
            <?php $classMerchandise = ($customsDeclarations->cd_bring_merchandise == 0) ? 'text-line-through' : ''; ?>
            <td class="w-300 b-b-grey m-5 {{ $classMerchandise }}">(articles for sale, sample used for soliciting orders, materials of components used for industrial purposes, and/or goods that are not considered as personal effect)</td>
        </tr>
        <tr>
            <?php $classGoods = ($customsDeclarations->cd_bring_goods == 0) ? 'text-line-through' : ''; ?>
            <td class="w-300 b-b-grey m-5 {{ $classGoods }}">Goods purchased/obtained abroad and will remain in Indonesia will total value exceeding USD 50.00 per person (for Crew); or USD 250.00 per person or USD 1,000.00 per family (for pasengger) </td>
        </tr>
    </table>
    <div class="m-5"></div>
    <div class="p-t-10 p-b-10">
        <h3 class="h-bold f-b d-b-grey">Goods Information</h3>
        <table>
            <thead>
                <tr>
                    <th>Description Of Articles</th>
                    <th>Qty</th>
                    <th>Value</th>
                </tr>
            </thead>
            <tbody>
                @foreach($customsDeclarationsGoods as $goods)
                    <tr>
                        <td class="w-250 b-b-grey m-5">{{ $goods->goods_description }}</td>
                        <td class="w-20 b-b-grey m-5">{{ $goods->goods_quantity }}</td>
                        <td class="w-70 b-b-grey m-5">{{ $goods->goods_value }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @include('beautymail::templates.ark.contentEnd')
    
@stop