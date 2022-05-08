<?php





# Function to add new subscribers to the MailChimp

function addRegistrationSubscriber($data)
{

    if (env("ISPROD")) {

        $array = [
            "email_address" => $data["email"],
            "status" => "subscribed",
            "merge_fields" => [
                "MODE" => $data["platform"],
//                "SOURCE" => $data["source"],
                "DOJ" => $data["dor"],
                "FNAME" => $data["name"],
            ]
        ];

        $json = json_encode($array);

        $ch = curl_init("https://us17.api.mailchimp.com/3.0/lists/d1b1d15403/members");

        curl_setopt($ch, CURLOPT_USERPWD, 'user:' . env('MAILCHIMP_KEY'));
        curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_TIMEOUT, 10);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $json);

        $result = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        curl_close($ch);

/*
        $exec = "curl --request POST \
                          --url 'https://us15.api.mailchimp.com/3.0/lists/c9627136dc/members' \
                          --user 'Authorization:".."' \
                          --data '" . $json . "'";

        shell_exec($exec);*/

    }


}

?>