<?php

namespace App\Http\Controllers;
use App\Http\Requests\OfferRequest;
use App\Model\Offer;
use App\Model\Video;
use App\Events\VideoViewer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use LaravelLocalization;
use App\Traits\OfferTrait;

class CurdController extends Controller

{
     use OfferTrait;

      /**
      * Create a new controller instance.
      *
      * @return void
      */
      public function __construct()
      {
           
      }

        public function getOffers(){
         return Offer::select('name','price')->get();
       }


      /*public function store(){
         Offer::create([
             'name' => 'offer3',
             'price' => '4000',
             'details' => 'simple',
         ]);
      }*/
      public function create(){
         return view('offer.create');
        }
      public function store(OfferRequest $request){
      
          // $message =$this -> getMessage();
         //  $rules = $this -> getRule(); 
          // $validator = Validator::make($request->all(),$rules,$message);
           //  if ($validator ->fails()) {
         //    return redirect() ->back()->withErrors($validator)->withInput($request->all());
         // }
        
         $file_name =  $this -> saveImage($request -> photo ,'images/offers');
          Offer::create([
            'photo'=>$file_name,
            'name_ar' => $request ->name_ar,
            'name_en' => $request ->name_en,
            'price' =>$request -> price,
            'details_ar' => $request ->details_ar,
            'details_en' => $request ->details_en,
        ]);
        return redirect()->back()->with(['success' => 'تم اضافة العرض بنجاح']);
        
       }

        /*


        protected function getMessage(){
        return   $message =[
            'name.required' =>__("message.offer name required"),
            'name.unique' =>    'اسم العرض موجود ',
            'name.max' =>'اسم العرض كبير الرجاء الاختصار',
            'price.required'=>__("message.price name required"),
            'price.numeric'=>'يجب ادخال السعر كرقم',
            'details.required'=>__("message.details required"),
         ];
     }
     protected function  getRule(){
           return   $rules=  [
        'name' =>'required|max:100|unique:offers,name',
        'price' =>'required|numeric',
        'details'=>'required',
         ];
      }*/

        public function getAllOffers(){

          $offers =  Offer::select('id',
          'name_' . LaravelLocalization::getCurrentLocale() . ' as name',
          'price',
          'photo',
          'details_' . LaravelLocalization::getCurrentLocale() . ' as details')
           ->get();
        return view('offer.all',compact('offers')) ;
        }
        public function editOffer($offer_id)
        {
         // Offer::findOrFail($offer_id);
         $offer =Offer::find($offer_id);
         if (!$offer)
           return redirect() ->back();
           $offer =Offer::select('id','name_en','name_ar','price','photo','details_ar','details_en') -> find($offer_id);
          return view('offer.edit',compact('offer'));
        }

        public function updateOffer(OfferRequest $request,$offer_id)
        {
          //validation
          $offer =Offer::find($offer_id);
          if (!$offer)
           return redirect() ->back();
          
          
          //update
          
          $offer ->update($request->all());
          return redirect() ->back()->with(['success'=>'تم التعديل بنجاح']);
        }

       public function getVideo(){
         $video= Video::first();
         event(new VideoViewer( $video) );
         return view('video')->with('video',$video);
       }
  
  
    }
