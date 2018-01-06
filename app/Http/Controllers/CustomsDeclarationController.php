<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Validator;
use rndediiv2\SmartDevUsability\Facade\SmartDevUsability;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\CustomsDeclaration;
use App\CustomsDeclarationGoods;
use DB;
use Keygen;

class CustomsDeclarationController extends Controller
{
    public function getRegister() 
    {
        $arrData['action'] = url('customs-declaration');
        $arrData['country'] = SmartDevUsability::setSelectCombo("select country_id, country_name from tm_country ORDER BY country_name ASC","country_id","country_name", TRUE);
        return view('component.register.form', $arrData);
    }

    public function getBookedRegister($id)
    {
        $arrData['action'] = url('customs-declaration');
        $arrData['booking_id'] = $id;
        $arrData['country'] = SmartDevUsability::setSelectCombo("select country_id, country_name from tm_country ORDER BY country_name ASC","country_id","country_name", TRUE);
        $arrData['objCustomsDeclarations'] = CustomsDeclaration::with(['nationality','customsGoods'])->where('cd_booking_id', $id)->get()->toArray();
        return view('component.booked.form')->with($arrData);
    }

    public function getReleased($id)
    {
        $arrData['objCustomsDeclarations'] = CustomsDeclaration::with(['nationality','customsGoods'])->find($id)->toArray();
        return view('component.released.view')->with($arrData);
    }

    public function setDraftRegister(Request $request)
    {
        $txCustomsDeclaration = SmartDevUsability::post2Query($request->customs);
        $validatorTxCustomsDeclaration = Validator::make($txCustomsDeclaration, [
            'cd_first_name' => 'required|max:75',
            'cd_email' => 'required|email',
            'cd_date_of_birth' => 'required|date',
            'cd_occupation' => 'required|max:100',
            'cd_nationality' => 'required|max:2',
            'cd_passport_number' => 'required|max:10',
            'cd_address_in' => 'required|max:150',
            'cd_voyage_number' => 'required|max:15',
            'cd_arrival_date' => 'required|date'
        ],[
            'cd_first_name.required' => 'First name must be fill with 75 max character',
            'cd_email.required' => 'Email must be fill',
            'cd_date_of_birth.required' => 'Date of Birth must be fill',
            'cd_occupation.required' => 'Occupation must be fill with 100 max character',
            'cd_nationality.required' => 'Nationality must be fill with 2 max character',
            'cd_passport_number.required' => 'Passport Number must be fill with 10 max character',
            'cd_address_in.required' => 'Address in must be fill with 150 max character',
            'cd_voyage_number.required' => 'Voyage number must be fill with 5 max character',
            'cd_arrival_date.required' => 'Arrival date must be fill'
        ]); 
        
        if($validatorTxCustomsDeclaration->fails())
        {
            return response()->json(['error' => $validatorTxCustomsDeclaration->errors(), 'status' => 400]);
            die();
        }
        
        if(array_key_exists('cd_bring_animals', $txCustomsDeclaration)){
            $txCustomsDeclaration['cd_bring_animals'] = ($txCustomsDeclaration['cd_bring_animals'] == 'on' ? 1 : 0);
        }
        else
        {
            $txCustomsDeclaration['cd_bring_animals'] = 0;
        }
        if(array_key_exists('cd_bring_narcotics', $txCustomsDeclaration)) 
        {
            $txCustomsDeclaration['cd_bring_narcotics'] = ($txCustomsDeclaration['cd_bring_narcotics'] == 'on' ? 1 : 0);
        }
        else
        {
            $txCustomsDeclaration['cd_bring_narcotics'] = 0;
        }
        if(array_key_exists('cd_bring_currency', $txCustomsDeclaration)) 
        {
            $txCustomsDeclaration['cd_bring_currency'] = ($txCustomsDeclaration['cd_bring_currency'] == 'on' ? 1 : 0);
        }
        else
        {
            $txCustomsDeclaration['cd_bring_currency'] = 0;
        }
        if(array_key_exists('cd_bring_cigaretes', $txCustomsDeclaration))
        {
            $txCustomsDeclaration['cd_bring_cigaretes'] = ($txCustomsDeclaration['cd_bring_cigaretes'] == 'on' ? 1 : 0);
        }
        else
        {
            $txCustomsDeclaration['cd_bring_cigaretes'] = 0;
        }
        if(array_key_exists('cd_bring_merchandise', $txCustomsDeclaration)) 
        {
            $txCustomsDeclaration['cd_bring_merchandise'] = ($txCustomsDeclaration['cd_bring_merchandise'] == 'on' ? 1 : 0);
        }
        else
        {
            $txCustomsDeclaration['cd_bring_merchandise'] = 0;
        }
        if(array_key_exists('cd_bring_goods', $txCustomsDeclaration)) 
        {
            $txCustomsDeclaration['cd_bring_goods'] = ($txCustomsDeclaration['cd_bring_goods'] == 'on' ? 1 : 0);
        }
        else
        {
            $txCustomsDeclaration['cd_bring_goods'] = 0;
        }

        if(!array_key_exists('cd_booking_id', $txCustomsDeclaration))
        {
            $txCustomsDeclaration['cd_booking_id'] = $this->generateCode();
            try {
                $countItemsGood = count($request->goods);
                $CustomsDeclaration = CustomsDeclaration::create($txCustomsDeclaration);
                if($countItemsGood > 0)
                {
                    $arrTxCustomDeclarationGoods = $request->goods;
                    $arrKeyCustomDeclarationGoods = array_keys($arrTxCustomDeclarationGoods);
                    for($a = 0; $a < count($_POST['goods']['goods_description']); $a++){
                        $txCustomDeclarationGoods = array('cd_id' => $CustomsDeclaration->cd_id);
                        for($b=0;$b<count($arrKeyCustomDeclarationGoods);$b++)
                        {
                            $txCustomDeclarationGoods[$arrKeyCustomDeclarationGoods[$b]] = $arrTxCustomDeclarationGoods[$arrKeyCustomDeclarationGoods[$b]][$a];
                        }
                        $txCustomDeclarationGoods['goods_value'] = str_replace(',', '', $txCustomDeclarationGoods['goods_value']);
                        CustomsDeclarationGoods::create($txCustomDeclarationGoods);
                    }
                }
                $objCustomsDeclaration = CustomsDeclaration::with('nationality')->find($CustomsDeclaration->cd_id);
                $objCustomsDeclarationGoods = CustomsDeclarationGoods::where('cd_id', $CustomsDeclaration->cd_id)->get();
                $beautymail = app()->make(\Snowfire\Beautymail\Beautymail::class);
                $beautymail->send('component.mail.register', [
                    'customsDeclarations' => (object)$objCustomsDeclaration,
                    'customsDeclarationsGoods' => (object)$objCustomsDeclarationGoods
                ], function($message) use ($objCustomsDeclaration)
                {
                    $message
                        ->from('rnd.ediindonesia@gmail.com')
                        ->to(trim($objCustomsDeclaration->cd_email), trim($objCustomsDeclaration->cd_full_name . ' ' . $objCustomsDeclaration->cd_last_name))
                        ->subject('Custom Declaration - Confirmation');
                });
                return response()->json([
                    'message' => 'Customs Declaration Successfully',
                    'redirect' => [
                        'statement' => true,
                        'url' => url('/customs/booked/' . $CustomsDeclaration->cd_booking_id)
                    ],
                    'status' => 200,
                    'collection' => $objCustomsDeclaration
                ]);
            } catch (Exception $e) {
                return response()->json(['error' => $e, 'status' => 400]);
            }
        }
        else
        {
            try {
                $txCustomsDeclarationExist = CustomsDeclaration::where('cd_booking_id', $txCustomsDeclaration['cd_booking_id'])->firstOrFail();
                try {
                    $countItemsGood = count($request->goods);
                    $CustomsDeclaration = CustomsDeclaration::where('cd_booking_id', $txCustomsDeclaration['cd_booking_id'])->update($txCustomsDeclaration);
                    if($countItemsGood > 0)
                    {
                        $txCustomDeclarationGoodsExist = CustomsDeclarationGoods::where('cd_id', $txCustomsDeclarationExist->cd_id);
                        if(txCustomDeclarationGoodsExist)
                        {
                            CustomsDeclarationGoods::where('cd_id', $txCustomsDeclarationExist->cd_id)->delete();
                        }
                        $arrTxCustomDeclarationGoods = $request->goods;
                        $arrKeyCustomDeclarationGoods = array_keys($arrTxCustomDeclarationGoods);
                        for($a = 0; $a < count($_POST['goods']['goods_description']); $a++){
                            $txCustomDeclarationGoods = array('cd_id' => $txCustomsDeclarationExist->cd_id);
                            for($b=0;$b<count($arrKeyCustomDeclarationGoods);$b++)
                            {
                                $txCustomDeclarationGoods[$arrKeyCustomDeclarationGoods[$b]] = $arrTxCustomDeclarationGoods[$arrKeyCustomDeclarationGoods[$b]][$a];
                            }
                            $txCustomDeclarationGoods['goods_value'] = str_replace(',', '', $txCustomDeclarationGoods['goods_value']);
                            CustomsDeclarationGoods::create($txCustomDeclarationGoods);
                        }
                    }
                    $objCustomsDeclaration = CustomsDeclaration::with('nationality')->find($txCustomsDeclarationExist->cd_id);
                    $objCustomsDeclarationGoods = CustomsDeclarationGoods::where('cd_id', $txCustomsDeclarationExist->cd_id)->get();
                    $beautymail = app()->make(\Snowfire\Beautymail\Beautymail::class);
                    $beautymail->send('component.mail.register', [
                        'customsDeclarations' => (object)$objCustomsDeclaration,
                        'customsDeclarationsGoods' => (object)$objCustomsDeclarationGoods
                    ], function($message) use ($objCustomsDeclaration)
                    {
                        $message
                            ->from('rnd.ediindonesia@gmail.com')
                            ->to(trim($objCustomsDeclaration->cd_email), trim($objCustomsDeclaration->cd_full_name . ' ' . $objCustomsDeclaration->cd_last_name))
                            ->subject('Custom Declaration - Confirmation');
                    });
                    return response()->json([
                        'message' => 'Customs Declaration Successfully',
                        'redirect' => [
                            'statement' => true,
                            'url' => url('/customs/booked/' . $txCustomsDeclarationExist->cd_booking_id)
                        ],
                        'status' => 200,
                        'collection' => $objCustomsDeclaration
                    ]);
                } catch (Exception $e) {
                    return response()->json(['error' => $e, 'status' => 400]);
                }
            } catch (ModelNotFoundException $ex) {
                return response()->json(['error' => $ex, 'status' => 400]);
            }
        }
    }

    public function setRegister(Request $request)
    {
        $txCustomsDeclaration = SmartDevUsability::post2Query($request->customs); 
        
        $countValuesOn = array_count_values($txCustomsDeclaration);
        
        if(array_key_exists('cd_bring_animals', $txCustomsDeclaration)){
            $txCustomsDeclaration['cd_bring_animals'] = ($txCustomsDeclaration['cd_bring_animals'] == 'on' ? 1 : 0);
        }
        else
        {
            $txCustomsDeclaration['cd_bring_animals'] = 0;
        }
        if(array_key_exists('cd_bring_narcotics', $txCustomsDeclaration)) 
        {
            $txCustomsDeclaration['cd_bring_narcotics'] = ($txCustomsDeclaration['cd_bring_narcotics'] == 'on' ? 1 : 0);
        }
        else
        {
            $txCustomsDeclaration['cd_bring_narcotics'] = 0;
        }
        if(array_key_exists('cd_bring_currency', $txCustomsDeclaration)) 
        {
            $txCustomsDeclaration['cd_bring_currency'] = ($txCustomsDeclaration['cd_bring_currency'] == 'on' ? 1 : 0);
        }
        else
        {
            $txCustomsDeclaration['cd_bring_currency'] = 0;
        }
        if(array_key_exists('cd_bring_cigaretes', $txCustomsDeclaration))
        {
            $txCustomsDeclaration['cd_bring_cigaretes'] = ($txCustomsDeclaration['cd_bring_cigaretes'] == 'on' ? 1 : 0);
        }
        else
        {
            $txCustomsDeclaration['cd_bring_cigaretes'] = 0;
        }
        if(array_key_exists('cd_bring_merchandise', $txCustomsDeclaration)) 
        {
            $txCustomsDeclaration['cd_bring_merchandise'] = ($txCustomsDeclaration['cd_bring_merchandise'] == 'on' ? 1 : 0);
        }
        else
        {
            $txCustomsDeclaration['cd_bring_merchandise'] = 0;
        }
        if(array_key_exists('cd_bring_goods', $txCustomsDeclaration)) 
        {
            $txCustomsDeclaration['cd_bring_goods'] = ($txCustomsDeclaration['cd_bring_goods'] == 'on' ? 1 : 0);
        }
        else
        {
            $txCustomsDeclaration['cd_bring_goods'] = 0;
        }
        
        $validatorTxCustomsDeclaration = Validator::make($txCustomsDeclaration, [
            'cd_first_name' => 'required|max:75',
            'cd_email' => 'required|email',
            'cd_date_of_birth' => 'required|date',
            'cd_occupation' => 'required|max:100',
            'cd_nationality' => 'required|max:2',
            'cd_passport_number' => 'required|max:10',
            'cd_address_in' => 'required|max:150',
            'cd_voyage_number' => 'required|max:15',
            'cd_arrival_date' => 'required|date'
        ],[
            'cd_first_name.required' => 'First name must be fill with 75 max character',
            'cd_email.required' => 'Email must be fill',
            'cd_date_of_birth.required' => 'Date of Birth must be fill',
            'cd_occupation.required' => 'Occupation must be fill with 100 max character',
            'cd_nationality.required' => 'Nationality must be fill with 2 max character',
            'cd_passport_number.required' => 'Passport Number must be fill with 10 max character',
            'cd_address_in.required' => 'Address in must be fill with 150 max character',
            'cd_voyage_number.required' => 'Voyage number must be fill with 5 max character',
            'cd_arrival_date.required' => 'Arrival date must be fill'
        ]); 
        
        if($validatorTxCustomsDeclaration->fails())
        {
            return response()->json(['error' => $validatorTxCustomsDeclaration->errors(), 'status' => 400]);
            die();
        }

        if(($txCustomsDeclaration['cd_bring_animals'] == 1 || $txCustomsDeclaration['cd_bring_narcotics'] == 1 || $txCustomsDeclaration['cd_bring_currency'] == 1 || $txCustomsDeclaration['cd_bring_cigaretes'] == 1 || $txCustomsDeclaration['cd_bring_merchandise'] == 1 || $txCustomsDeclaration['cd_bring_goods'] == 1) AND count($request->goods) == 0)
        {
            return response()->json(['error' => 'You choice declare, but nothing goods to declared', 
                'status' => 400
            ]);
            die();
        }

        if(!array_key_exists('cd_booking_id', $txCustomsDeclaration))
        {
            /** 
             * @Normally Submit
             */

            if(count($request->goods) < $countValuesOn['on'])
            {
                return response()->json(['error' => 'Please check information goods', 
                    'status' => 400
                ]);
                die();
            }
            $txCustomsDeclaration['cd_booking_id'] = $this->generateCode();
            $txCustomsDeclaration['cd_status'] = 1;
            try {
                $countItemsGood = count($request->goods);
                $CustomsDeclaration = CustomsDeclaration::create($txCustomsDeclaration);
                if($countItemsGood > 0)
                {
                    $arrTxCustomDeclarationGoods = $request->goods;
                    $arrKeyCustomDeclarationGoods = array_keys($arrTxCustomDeclarationGoods);
                    for($a = 0; $a < count($_POST['goods']['goods_description']); $a++){
                        $txCustomDeclarationGoods = array('cd_id' => $CustomsDeclaration->cd_id);
                        for($b=0;$b<count($arrKeyCustomDeclarationGoods);$b++)
                        {
                            $txCustomDeclarationGoods[$arrKeyCustomDeclarationGoods[$b]] = $arrTxCustomDeclarationGoods[$arrKeyCustomDeclarationGoods[$b]][$a];
                        }
                        $txCustomDeclarationGoods['goods_value'] = str_replace(',', '', $txCustomDeclarationGoods['goods_value']);
                        CustomsDeclarationGoods::create($txCustomDeclarationGoods);
                    }
                }
                $objCustomsDeclaration = CustomsDeclaration::with('nationality')->find($CustomsDeclaration->cd_id);
                $objCustomsDeclarationGoods = CustomsDeclarationGoods::where('cd_id', $CustomsDeclaration->cd_id)->get();
                $beautymail = app()->make(\Snowfire\Beautymail\Beautymail::class);
                $beautymail->send('component.mail.register', [
                    'customsDeclarations' => (object)$objCustomsDeclaration,
                    'customsDeclarationsGoods' => (object)$objCustomsDeclarationGoods
                ], function($message) use ($objCustomsDeclaration)
                {
                    $message
                        ->from('rnd.ediindonesia@gmail.com')
                        ->to(trim($objCustomsDeclaration->cd_email), trim($objCustomsDeclaration->cd_full_name . ' ' . $objCustomsDeclaration->cd_last_name))
                        ->subject('Custom Declaration - Confirmation');
                });
                return response()->json([
                    'message' => 'Customs Declaration Successfully',
                    'redirect' => [
                        'statement' => true,
                        'url' => url('/customs/welcome')
                    ],
                    'status' => 200,
                    'collection' => $objCustomsDeclaration
                ]);
            } catch (Exception $e) {
                return response()->json(['error' => $e, 'status' => 400]);
            }
        }
        else
        {
            /**
             * @Submit draft to released
             */

            if(($txCustomsDeclaration['cd_bring_animals'] == 1 || $txCustomsDeclaration['cd_bring_narcotics'] == 1 || $txCustomsDeclaration['cd_bring_currency'] == 1 || $txCustomsDeclaration['cd_bring_cigaretes'] == 1 || $txCustomsDeclaration['cd_bring_merchandise'] == 1 || $txCustomsDeclaration['cd_bring_goods'] == 1) AND count($request->goods) == 0)
            {
                return response()->json(['error' => 'You choice declare, but nothing goods to declared', 
                    'status' => 400
                ]);
                die();
            }

            if(count($request->goods) < $countValuesOn['on'])
            {
                return response()->json(['error' => 'Please check information goods', 
                    'status' => 400
                ]);
                die();
            }

            try {
                $txCustomsDeclarationExist = CustomsDeclaration::where('cd_booking_id', $txCustomsDeclaration['cd_booking_id'])->firstOrFail();
                try {
                    $countItemsGood = count($request->goods);
                    $txCustomsDeclaration['cd_status'] = 1;
                    $CustomsDeclaration = CustomsDeclaration::where('cd_booking_id', $txCustomsDeclaration['cd_booking_id'])->update($txCustomsDeclaration);
                    if($countItemsGood > 0)
                    {
                        $txCustomDeclarationGoodsExist = CustomsDeclarationGoods::where('cd_id', $txCustomsDeclarationExist->cd_id);
                        if(txCustomDeclarationGoodsExist)
                        {
                            CustomsDeclarationGoods::where('cd_id', $txCustomsDeclarationExist->cd_id)->delete();
                        }
                        $arrTxCustomDeclarationGoods = $request->goods;
                        $arrKeyCustomDeclarationGoods = array_keys($arrTxCustomDeclarationGoods);
                        for($a = 0; $a < count($_POST['goods']['goods_description']); $a++){
                            $txCustomDeclarationGoods = array('cd_id' => $txCustomsDeclarationExist->cd_id);
                            for($b=0;$b<count($arrKeyCustomDeclarationGoods);$b++)
                            {
                                $txCustomDeclarationGoods[$arrKeyCustomDeclarationGoods[$b]] = $arrTxCustomDeclarationGoods[$arrKeyCustomDeclarationGoods[$b]][$a];
                            }
                            $txCustomDeclarationGoods['goods_value'] = str_replace(',','',$txCustomDeclarationGoods['goods_value']);
                            CustomsDeclarationGoods::create($txCustomDeclarationGoods);
                        }
                    }
                    $objCustomsDeclaration = CustomsDeclaration::with('nationality')->find($txCustomsDeclarationExist->cd_id);
                    $objCustomsDeclarationGoods = CustomsDeclarationGoods::where('cd_id', $txCustomsDeclarationExist->cd_id)->get();
                    $beautymail = app()->make(\Snowfire\Beautymail\Beautymail::class);
                    $beautymail->send('component.mail.register', [
                        'customsDeclarations' => (object)$objCustomsDeclaration,
                        'customsDeclarationsGoods' => (object)$objCustomsDeclarationGoods
                    ], function($message) use ($objCustomsDeclaration)
                    {
                        $message
                            ->from('rnd.ediindonesia@gmail.com')
                            ->to(trim($objCustomsDeclaration->cd_email), trim($objCustomsDeclaration->cd_full_name . ' ' . $objCustomsDeclaration->cd_last_name))
                            ->subject('Custom Declaration - Confirmation');
                    });
                    return response()->json([
                        'message' => 'Customs Declaration Successfully',
                        'redirect' => [
                            'statement' => true,
                            'url' => url('/customs/welcome')
                        ],
                        'status' => 200,
                        'collection' => $objCustomsDeclaration
                    ]);
                } catch (Exception $e) {
                    return response()->json(['error' => $e, 'status' => 400]);
                }
            } catch (ModelNotFoundException $ex) {
                return response()->json(['error' => $ex, 'status' => 400]);
            }
        }
    }

    public function getReferenceNumberBooking(Request $request)
    {
        try {
            $txCustomsDeclarationExist = CustomsDeclaration::where([
                ['cd_booking_id', '=', $request->ref]
            ])->firstOrFail();

            if($txCustomsDeclarationExist->cd_status == 0)
                $url = url('/customs/booked/' . $txCustomsDeclarationExist->cd_booking_id);
            else 
                $url = url('/customs/released/' . $txCustomsDeclarationExist->cd_id);
            return response()->json([
                'message' => 'Please be wait .. redirecting page',
                'url' => $url,
                'error' => null,
                'status' => 200
            ]);
        } catch (ModelNotFoundException $ex) {
            return response()->json([
                'message' => 'Reference Number not found',
                'error' => $ex, 
                'status' => 400
            ]);
        }
    }

    protected function generateCode()
    {
        return Keygen::bytes()->generate(
            function($key) {
                $random = Keygen::numeric()->generate();
                return substr(md5($key . $random . strrev($key)), mt_rand(0,8), 16);
            },
            function($key) {
                return join('-', str_split($key, 4));
            },
            'strtoupper'
        );
    }
}
