<?php $curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => 'https://track.delhivery.com/api/cmu/create.json',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS =>'format=json&data={
    "shipments": [
        {
            "add": "M25,NelsonMarg",
            "address_type": "home",
            "phone": "8310418179",
            "payment_mode": "Prepaid",
            "name": "Shruti",
            "pin": "411021",
            "order": "81",
            "country": "India",
            "cod_amount": 1293.89,
            "waybill": "",
            "shipping_mode": "Surface"
        }
    ],
    "pickup_location": {
        "name": "Default Pickup Location"
    }
}',
  CURLOPT_HTTPHEADER => array(
    'Authorization: Token 06d21e20d2ea274a1c11053bd52b6fc9df389b2d',
    'Content-Type: application/json'
  ),
));

$response = curl_exec($curl);

curl_close($curl);
print_r($response);
?>