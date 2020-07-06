<?php
/**
 * Created by PhpStorm.
 * User: Deki
 * Date: 12/22/2017
 * Time: 11:35 PM
 */

namespace CmsBundle\Registry;


class PromoImageThemeConfigSettings
{

    const SETTINGS = [
        "agency_limit" => 6,
        "required_components" =>["references"],
        "required_services" =>["language", "search"],
        "logo" => "http://web.promoimage.pro/img/logo-img/logo.png",
        "navigation" => ["topmenu", "mainmenu"],
        "promoimage-telephone-1" => "+381 06 52 1387",
        "promoimage-telephone-2" => "+381 06 52 1387",
        "promoimage-telephone-3" => "+381 06 52 1387",
        "promoimage-address-1" => "Dobanovacki put 66a",
        "promoimage-address-2" => '11080 Zemun - Altina',
        "promoimage-office-mail" => 'office@promoimage.com',
        "promoimage-social-icons" => ["facebook"=>"","instagram"=>"","twitter"=>"","youtube"=>"","linkedin"=>"","google"=>"","rss"=>""]
    ];
}