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
                                   0 => 1,
                                   1 => 0,
                                   2 => 0,
                                   3 => 1,
                                   4 => 0,
                                   5 => 0,
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
                               'isPolicyNC'   => 0,
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
                           'cars' => dbGetCarsTypes(),
                           'isUnderWarranty' =>
                            array(
                                1 => 'Да',
                                2 => 'Нет'
                            ),
                            'yearsOfCar' =>
                            array(
                                1 => 2000,
                                2 => 2001,
                                3 => 2002,
                                4 => 2003,
                                5 => 2004,
                                6 => 2005,
                                7 => 2006,
                                8 => 2007,
                                9 => 2008,
                                10 => 2009,
                                11 => 2010,
                                12 => 2011,
                                13 => 2012
                            ),
                            'formOfCompensation' =>
                            array (
                                1 => 'выплата по калькуляции Страховщика',
                                2 => 'ремонт по направлению Страховщика на СТОА не являющимися официальными дилерами или выплата по калькуляции Страховщика',
                                3 => 'ремонт по направлению Страховщика на СТОА официальных дилеров или выплата по калькуляции Страховщика',
                                4 => 'ремонт на СТОА по выбору Страхователя',
                                5 => 'Выплата по калькуляции Страховщика с учетом износа'
                            ))
);