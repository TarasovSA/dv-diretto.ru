<?php

$defaultValues = array('calc' =>
    array(
    'villaggio' =>
        array(
        'constructionEl' => 500000,
        'isExteriorTrim' => 0,
        'exteriorTrim' => 30000,
        'isInteriorTrim' => 0,
        'interiorTrim' => 30000,
        'isEngineeringSystems' => 0,
        'engineeringSystems' => 50000,
        'isProperty' => 0,
        'property' => 20000,
        'isLiability' => 0,
        'liability' => 40000
        ),
    'insurant' =>
        array(
        'name' => 'ФИО',
        'region' => 'Область или край',
        'city' => 'город, населенный пункт, дачный поселок, садовое товарищество',
        'street' => 'улица',
        'house' => 'дом',
        'housing' => 'корп/строение',
        'apartment' => 'квартира',
        'passportSeries' => 'серия',
        'passportNumber' => 'номер',
        'birthday' => '',
        'phone' => ''
        ),
    'villaggioTerritory' =>
        array(
        'region' => 'Область или край',
        'city' => 'город, населенный пункт, дачный поселок, садовое товарищество',
        'street' => 'улица',
        'house' => 'дом',
        'housing' => 'корп/строение'
        ),
    'beneficiary' =>
        array(
        'name' => '',
        'birthday' => ''
        ),
    'feliceCitta' =>
        array(
        'constructionEl' => 500000,
        'isInteriorTrim' => 1,
        'interiorTrim' => 30000,
        'isEngineeringSystems' => 1,
        'engineeringSystems' => 50000,
        'isProperty' => 1,
        'property' => 20000,
        'isLiability' => 1,
        'liability' => 40000
        ),
    'feliceCittaTerritory' =>
        array(
        'region' => 'Москва',
        'city' => 'Москва',
        'street' => '',
        'house' => '',
        'housing' => ''
        ),
    'bellaVita' =>
        array(
        'insuranceAmount' => 300000
        ),
    'bellaVitaInsured' =>
        array(
        'name' => '',
        'region' => 'Москва',
        'city' => 'Москва',
        'street' => '',
        'house' => '',
        'housing' => '',
        'apartment' => '',
        'passportSeries' => '',
        'passportNumber' => '',
        'birthday' => '',
        'phone' => ''
        ),
    'bellaVitaBeneficiary' =>
        array(
        'name' => '',
        'region' => 'Москва',
        'city' => 'Москва',
        'street' => '',
        'house' => '',
        'housing' => '',
        'apartment' => '',
        'passportSeries' => '',
        'passportNumber' => '',
        'birthday' => '',
        'phone' => ''
        ),
    'bellissimo' =>
        array(
        'typeOfCar' => '',
        'modelOfCar' => '',
        'yearOfCar' => '',
        'carAmount' => '',
        'isUnderWarranty' => 'Да'
        ),
    'bellissimoDrivers' =>
        array(
        'driver' =>
            array(
            0 =>
                array (
                'birthDay' => '15-05-1986',
                'experience' => '3'
                ),
            1 =>
                array (
                'birthDay' => '16-06-1964',
                'experience' => '8'
                )
            )
        ),
    'bellissimoOthers' =>
        array(
        'formOfCompensation' => '',
        'antiStealing' =>
            array(
            0 => 1,
            1 => 0,
            2 => 0,
            3 => 1,
            4 => 0,
            5 => 0,
            )
        ),
    'bellissimoAdditional' =>
        array(
        'isLiability' => 0,
        'liability' => '',
        'isAccident' => 0,
        'accident' => '',
        'isOptionalEquipment' => 0,
        'optionalEquipment' => ''
        ),
    'bellissimoMaintenance' =>
        array(
            'information' =>
                array(0, 0, 0),
            'VIPPackAmount' => '',
            'TotalAmount' => '',
        ),
    'bellissimoDiscount' =>
        array(
            'isTransition' => 0,
            'transition' => '',
            'isFranchise' => 0,
            'franchise' => '',
            'isPromo' => 0,
            'promo' => '',
            'isPolicyNC' => 0,
        )
    ),
    'registration' =>
        array(
        'user' =>
            array(
            'name' => '',
            'login' => '',
            'email' => '',
            'region' => '',
            'city' => '',
            'street' => '',
            'house' => '',
            'housing' => '',
            'apartment' => '',
            'passportSeries' => '',
            'passportNumber' => '',
            'birthday' => '',
            'phone' => ''
            )
    )
);