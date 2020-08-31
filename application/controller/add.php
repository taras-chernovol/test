<?php

require APPLICATION_ROOT . '/core/Storage.php';

$storage = new Storage();

$urlList = [];
for ($i = 0; $i < 30; $i++) {
    $urlList[] = 'http://www.cbr.ru/scripts/XML_daily.asp?date_req=' . date('d/m/Y', strtotime('-' . $i . 'days'));
}

foreach ($urlList as $url) {
    $result = file_get_contents($url);

    $currencyXmlList = new SimpleXMLElement($result);
    $currencyList = json_decode(json_encode($currencyXmlList), true);
    $currencyDate = date('Y-m-d', strtotime($currencyList['@attributes']['Date']));

    $currencyValuteList = [];
    foreach ($currencyList['Valute'] as $currencyItem) {
        $currencyValuteList[] = [
            'valuteId' => $currencyItem['@attributes']['ID'],
            'numCode' => $currencyItem['NumCode'],
            'charCode' => $currencyItem['CharCode'],
            'name' => $currencyItem['Name'],
            'value' => $currencyItem['Value'],
            'date' => $currencyDate,
        ];
    }

    foreach ($currencyValuteList as $currencyValute) {
        $storage->insert('currency', $currencyValute);
    }
}

$message = $currencyList['@attributes']['name'] . ' ' . $currencyList['@attributes']['Date'];

$_SESSION['messageList'] = [$message,];
header('Location: /');
exit;