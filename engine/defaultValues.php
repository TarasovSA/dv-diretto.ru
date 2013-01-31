<?php

$defaultValues = array('calc'         =>
                       array(
                           'villaggio'             =>
                           array(
                               'constructionEl'       => 500000,
                               'isExteriorTrim'       => 0,
                               'exteriorTrim'         => 30000,
                               'isInteriorTrim'       => 0,
                               'interiorTrim'         => 30000,
                               'isEngineeringSystems' => 0,
                               'engineeringSystems'   => 50000,
                               'isProperty'           => 0,
                               'property'             => 20000,
                               'isLiability'          => 0,
                               'liability'            => 40000,
                               'isLandscape'          => 0,
                               'landscape'            => 50000
                           ),
                           'insurant'              =>
                           array(
                               'name'           => 'ФИО',
                               'region'         => 'Область или край',
                               'city'           => 'город, населенный пункт, дачный поселок, садовое товарищество',
                               'street'         => 'улица',
                               'house'          => 'дом',
                               'housing'        => 'корп/строение',
                               'apartment'      => 'квартира',
                               'passportSeries' => 'серия',
                               'passportNumber' => 'номер',
                               'birthday'       => '',
                               'phone'          => ''
                           ),
                           'villaggioTerritory'    =>
                           array(
                               'region'  => 'Область или край',
                               'city'    => 'город, населенный пункт, дачный поселок, садовое товарищество',
                               'street'  => 'улица',
                               'house'   => 'дом',
                               'housing' => 'корп/строение'
                           ),
                           'beneficiary'           =>
                           array(
                               'name'     => '',
                               'birthday' => ''
                           ),
                           'feliceCitta'           =>
                           array(
                               'constructionEl'       => 500000,
                               'isInteriorTrim'       => 1,
                               'interiorTrim'         => 30000,
                               'isEngineeringSystems' => 1,
                               'engineeringSystems'   => 50000,
                               'isProperty'           => 1,
                               'property'             => 20000,
                               'isLiability'          => 1,
                               'liability'            => 40000
                           ),
                           'feliceCittaTerritory'  =>
                           array(
                               'region'  => 'Москва',
                               'city'    => 'Москва',
                               'street'  => '',
                               'house'   => '',
                               'housing' => ''
                           ),
                           'bellaVita'             =>
                           array(
                               'insuranceAmount' => 300000
                           ),
                           'bellaVitaInsured'      =>
                           array(
                               'name'           => '',
                               'region'         => 'Москва',
                               'city'           => 'Москва',
                               'street'         => '',
                               'house'          => '',
                               'housing'        => '',
                               'apartment'      => '',
                               'passportSeries' => '',
                               'passportNumber' => '',
                               'birthday'       => '',
                               'phone'          => ''
                           ),
                           'bellaVitaBeneficiary'  =>
                           array(
                               'name'           => '',
                               'region'         => 'Москва',
                               'city'           => 'Москва',
                               'street'         => '',
                               'house'          => '',
                               'housing'        => '',
                               'apartment'      => '',
                               'passportSeries' => '',
                               'passportNumber' => '',
                               'birthday'       => '',
                               'phone'          => ''
                           ),
                           'bellissimo'            =>
                           array(
                               'typeOfCar'       => '',
                               'modelOfCar'      => '',
                               'yearOfCar'       => '',
                               'carAmount'       => '',
                               'isUnderWarranty' => 'Да'
                           ),
                           'bellissimoDrivers'     =>
                           array(
                               'driver' =>
                               array(
                                   0 =>
                                   array(
                                       'birthDay'   => '',
                                       'experience' => ''
                                   )
                               )
                           ),
                           'bellissimoOthers'      =>
                           array(
                               'formOfCompensation' => '',
                               'antiStealing'       =>
                               array(
                                   0 => 0,
                                   1 => 0,
                                   2 => 0,
                                   3 => 0,
                                   4 => 0,
                                   5 => 0,
                               ),
                               'antiStealingName'  =>
                                  array(
                                      0 => 'Штатная ПУС и/или иммобилайзер',
                                      1 => 'Дополнительно установленная ЭПС',
                                      2 => 'Механическая ПУС',
                                      3 => 'Гидромеханическая система (Technoblock страховой)',
                                      4 => 'С меткой присутствия',
                                      5 => 'Спутниковая система',
                                  )
                           ),
                           'bellissimoAdditional'  =>
                           array(
                               'isLiability'         => 0,
                               'liability'           => '',
                               'isAccident'          => 0,
                               'accident'            => '',
                               'isOptionalEquipment' => 0,
                               'optionalEquipment'   => ''
                           ),
                           'bellissimoMaintenance' =>
                           array(
                               'information'   =>
                               array(0, 0, 0),
                               'VIPPackAmount' => '',
                               'TotalAmount'   => '',
                           ),
                           'bellissimoDiscount'    =>
                           array(
                               'isTransition' => 0,
                               'transition'   => '',
                               'isFranchise'  => 0,
                               'franchise'    => '',
                               'isPromo'      => 0,
                               'promo'        => '',
                               'isPolicyNC'   => 1,
                           )
                       ),
                       'registration' =>
                       array(
                           'user' =>
                           array(
                               'name'           => '',
                               'login'          => '',
                               'email'          => '',
                               'region'         => '',
                               'city'           => '',
                               'street'         => '',
                               'house'          => '',
                               'housing'        => '',
                               'apartment'      => '',
                               'passportSeries' => '',
                               'passportNumber' => '',
                               'birthday'       => '',
                               'phone'          => ''
                           )
                       ),
                       'select' => array (
                           'cars' => dbGetCarsMarks(),
                           'isUnderWarranty' =>
                            array(
                                1 => 'Да',
                                2 => 'Нет'
                            ),
                            'yearsOfCar' =>
                            array(
                                1 => 'Новое ТС',
                                2 => 2013,
                                3 => 2012,
                                4 => 2011,
                                5 => 2010,
                                6 => 2009,
                                7 => 2008,
                                8 => 2007,
                                9 => 2006,
                                10 => 2005
                            ),
                            'formOfCompensation' =>
                            array (
                                1 => 'Ремонт на СТОА официального дилера',
                                2 => 'Ремонт на СТОА неофициального дилера',
                                3 => 'выплата по калькуляции Страховщика',
                                4 => 'Ремонт на СТОА Страхователя',
                            ),
                            'franchiseCar' =>
                            array (
                                1 => '6,000.00 руб.',
                                2 => '9,000.00 руб.',
                                3 => '15,000.00 руб.',
                                4 => '30,000.00 руб.',
                            ),
                           'franchiseTruck' =>
                           array (
                               1 => '15,000.00 руб.',
                               2 => '30,000.00 руб.',
                               3 => '45,000.00 руб.',
                               4 => '60,000.00 руб.',
                           ))
);