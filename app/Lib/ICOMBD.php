<?php

namespace App\Lib;

use App\Models\Student;
use App\Models\Settings;

define('USERNAME', 'elitelifes');
define('PASSWORD', 'asfdQhedf');
define('SENDER', 'Elite%20Lifes');
define('ENABLED', true);

class ICOMBD {
    public function regular($phone){
        
        if (!ENABLED) return false;
        
        if(strlen($phone) == 11){
            $phone = '88' . $phone;
        }

        $sms = 'Thank you for purchasing from ELITE LIFESTYLE. Stay with us always. FOR MORE INFO: 880244612112. https://elitelifestylebd.com';
        $url = 'http://api.icombd.com/api/v1/campaigns/sendsms/plain?username=' . USERNAME . '&password=' . PASSWORD . '&sender=' . SENDER . '&text=' . urlencode($sms) . '&to=' . urlencode($phone);
        $result = file_get_contents($url);

        return $result;
    }

    public function tailor($phone, $date, $order_number = ''){
        if (!ENABLED) return false;
        if(strlen($phone) == 11){
            $phone = '88' . $phone;
        }

        $sms = 'Greetings from ELITE LIFESTYLE. Thank you for placing order no. ' . $order_number . '. Your product delivery date is ' . $date . '. FOR MORE INFO: 8801847454455, 880244612112';
        $url = 'http://api.icombd.com/api/v1/campaigns/sendsms/plain?username=' . USERNAME . '&password=' . PASSWORD . '&sender=' . SENDER . '&text=' . urlencode($sms) . '&to=' . urlencode($phone);
        $result = file_get_contents($url);

        return $result;
    }

    public function ready($phone, $items, $order_number = '') {
        if (!ENABLED) return false;
        if(strlen($phone) == 11){
            $phone = '88' . $phone;
        }

        $aux = count($items) == 1 ? 'is' : 'are';
        $sms = 'Dear Sir/Madam, Greetings from ELITE LIFESTYLE. Your Order No. ' . $order_number . ', Items: ' . implode(', ', $items) . ' ' . $aux . ' ready for delivery. Thanks. FOR MORE INFO: 8801847454455, 880244612112';
        $url = 'http://api.icombd.com/api/v1/campaigns/sendsms/plain?username=' . USERNAME . '&password=' . PASSWORD . '&sender=' . SENDER . '&text=' . urlencode($sms) . '&to=' . urlencode($phone);
        $result = file_get_contents($url);

        return $result;
    }
}