<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $message = $_POST['message'];
    $sel = $_POST['sel'];

    if ($_POST['secret'] == "secretkey" || $_POST['secret2'] == "secretkey" || $_POST['secret3'] == "secretkey") {
        $config = include 'config.php';

        $token = $config['token'];
        $chat_id = $config['chat_id'];

        $wp = "";
        $tg = "";
        $wp_text = "";
        $tg_text = "";

        $phone = str_replace(['(', ')', ' ', '-', '+'], '', $phone);
        $phone = urlencode($phone);

        if ($sel == 1) {
            $sel = "Позвонить по номеру телефона";

            if (substr($phone, 0, 1) != '8') {
                $phone = "%2B" . $phone;
            }

        } elseif ($sel == 2) {
            $sel = "Написать в WhatsApp";
            $wp_text = "Ссылка на ватсап: ";

            if (substr($phone, 0, 1) === '8') {
                $wp_phone = $phone;
                $wp_phone = '7' . substr($wp_phone, 1);
                $wp = "https://api.whatsapp.com/send?phone=" . $wp_phone;
            } else {
                $wp = "https://api.whatsapp.com/send?phone=" . $phone;
                $phone = "%2B" . $phone;
            }

        } elseif ($sel == 3) {
            $sel = "Написать в Telegram";

            $tg_text = "Ссылка на телеграм: (Может не работать, если человек запретил доступ по ссылке. Тогда добавить в контакты в телефоне и связаться)";

            if (substr($phone, 0, 1) === '8') {
                $tg_phone = $phone;
                $tg_phone = '7' . substr($tg_phone, 1);
                $tg = "https://t.me/%2B" . $tg_phone;

            } else {
                $phone = "%2B" . $phone;
                $tg = "https://t.me/" . $phone;
            }

        }

        $arr = array(
            'Заявка с ОСНОВОНОГО сайта:' => '',
            'Введенное имя: ' => $name,
            'Номер телефона: ' => $phone,
            'Сообщение: ' => $message,
            'Способ свзяи: ' => $sel,
            $wp_text => $wp,
            $tg_text => $tg
        );

        foreach ($arr as $key => $value) {
            $txt .= "<b>" . $key . "</b> " . $value . "%0A";
        }

        $sendToTelegram = fopen("https://api.telegram.org/bot{$token}/sendMessage?chat_id={$chat_id}&parse_mode=html&text={$txt}", "r");

        if ($sendToTelegram) {
            $response = array('status' => 'success', 'message' => 'Форма успешно отправлена! Скоро наши менеджеры свяжутся с вами');
        } else {
            $response = array('status' => 'error', 'message' => 'Ошибка отправки формы. Свяжитесь с нами по телефону или через телеграм бота');
        }

        echo json_encode($response);

    } else {
        $response = array('status' => 'error', 'message' => 'Ошибка отправки формы. Свяжитесь с нами по телефону или через телеграм бота');
        echo json_encode($response);
    }

}
?>