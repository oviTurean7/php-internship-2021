<?php

namespace App\Controllers;

use Swift_Attachment;
use Swift_Mailer;
use Swift_Message;
use Swift_SmtpTransport;

class EmailController extends BaseController
{
    public static function base($recipient, $title, $body, $attachment = null) {
        $transport = (new Swift_SmtpTransport('smtp.gmail.com', 465, 'ssl'))
            ->setUsername('phpproject50@gmail.com')
            ->setPassword('projectPhpLocal123!');
        $mailer = new Swift_Mailer($transport);
// Create a message
        $message = (new Swift_Message($title))
            ->setFrom(['phpproject50@gmail.com' => 'My Project'])
            ->setTo([$recipient])
            ->setBody($body);
// Send the message
        if ($attachment != null)
        {
            $message->attach(Swift_Attachment::fromPath($attachment));
        }
        $result = $mailer->send($message);
    }

    public static function mail($recepient, $token) {
        $link = 'http://php.local/confirm?token=' . $token;
        EmailController::base($recepient, 'Confirm your account', 'Confirm your account: ' . $link);
    }

    public static function order($recepient, $orderId, $totalPrice, $noOfItems, $attachment) {
        EmailController::base($recepient, "Order number $orderId placed successfully", "Your order number $orderId was placed successfully. You have $noOfItems items and a total of $totalPrice", $attachment);
    }

    public static function orderCancelled($recepient, $productNames) {
        if(count($productNames) > 1) {
            $notEnough = implode(", ", $productNames);
        }
        else {
            $notEnough = $productNames[0];
        }

        EmailController::base($recepient, "Your order cannot be fulfilled", "Your order cannot be fulfilled. We don't have enough $notEnough");
    }

    public static function passwordRecovery($recepient, $token) {
        $link = 'http://php.local/recover?token=' . $token;
        EmailController::base($recepient, 'Change your password', 'Change your password to recover your account: ' . $link);
    }
}