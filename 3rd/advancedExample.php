<?php

$categories = [
    'id'=>1,
    'name'=>'mobiles',
    'subCategories'=>[
                        'samsung'=>[
                            (object)[
                                'id'=>50,
                                'name'=>'NOTE 10',
                                'prices'=>[5000,6000],
                                'madeIn'=>['china','germany'],
                                'colors'=>['primary'=>'black','secondaryColors'=>['red','blue']],
                            ],(object)[
                                'id'=>60,
                                'name'=>'S20',
                                'prices'=>[7000,8000],
                                'madeIn'=>['china','germany'],
                                'colors'=>['primary'=>'white','secondaryColors'=>['brown','orange']],
                            ]
                        ],
                        'apple'=>[
                            (object)[
                                'id'=>70,
                                'name'=>'Iphone X',
                                'prices'=>20000,
                                'madeIn'=>(object)['counrty'=>'china'],
                                'colors'=>['red','green','black'],
                            ],(object)[
                                'id'=>80,
                                'name'=>'Iphone 12',
                                'prices'=>60000,
                                'madeIn'=>(object)['counrty'=>'china'],
                                'colors'=>[
                                    (object)['primary'=>'black'],
                                    (object)['secondaryColors'=>
                                                                [   'red',
                                                                    'blue'
                                                                ]
                                    ]
                                ],
                            ]
                        ],
                        'oppo'=>[
                            (object)[
                                'id'=>90,
                                'name'=>'Oppo F1',
                                'prices'=>[],
                                'madeIn'=>[],
                                'colors'=>[],
                            ],(object)[
                                'id'=>100,
                                'name'=>'Oppo F2',
                                'prices'=>[],
                                'madeIn'=>[],
                                'colors'=>[],
                            ]
                        ]
    ]
];
# example 3
// samsung : note10 , s20
// apple : iphonex , iphone12
// oppo : oppo f1 , oppo f2
$message = "";
foreach ($categories['subCategories'] as $brand => $brandProducts) {
   $message .= $brand. ':';
   foreach ($brandProducts as $index => $product) {
       $message .= $product->name.',';
   }
   $message .= "<br>";
}
echo $message;


# example 2
// Apple Products : Ihpone X , Iphone12

// $message = "Apple Products :";
// foreach ($categories['subCategories']['apple'] as $index => $value) {
//     $message .= $value->name . ',';
// }
// echo $message;

# example 1
// samsung products : NOTE 10 , S20 
// echo  "samsung products :"  . $categories['subCategories']['samsung'][0]->name . ',' 
//                             .  $categories['subCategories']['samsung'][1]->name;

